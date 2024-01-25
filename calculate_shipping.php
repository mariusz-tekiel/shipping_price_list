<?php
    //DB connection  
    include "db_connection.php";
    include "import_zones.php";

    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        //Sanitize input data
        $postcode = $_POST['postcode'];
        $totalOrderAmount = floatval($_POST['total_order_amount']);
        $longProduct = isset($_POST['long_product']);

        // Shipping calculation         
        $shippingZone = substr($postcode, 0, 2);
        $shippingPrice = calculateShippingPrice($shippingZone, $totalOrderAmount, $longProduct);
        $discountedPrice = applyDiscount($shippingPrice, $totalOrderAmount);

        // Insert the calculated shipping data into the database
        $insertQuery = "INSERT INTO shipping_data 
                        (postcode, total_order_amount, long_product, shipping_zone, shipping_price, discounted_price)
                        VALUES ('$postcode', '$totalOrderAmount', '$longProduct', '$shippingZone', '$shippingPrice', '$discountedPrice')";

        if ($connection->query($insertQuery) === TRUE) {
            // Success
            echo "Success !";
            exit();
        } else {
            // Handle database insertion error
            echo "Error: " . $insertQuery . "<br>" . $connection->error;
        }
    }

    function calculateShippingPrice($shippingZone, $totalOrderAmount, $longProduct) {
        // Shipping price calculation        
        $baseShippingPrice = getBaseShippingPrice($shippingZone);
        $extraLongProductCost = $longProduct ? 1995 : 0;
    
        $shippingPrice = $baseShippingPrice + $extraLongProductCost;
    
        return $shippingPrice;
    }
    
    function applyDiscount($shippingPrice, $totalOrderAmount) {
        // Apply discount if total order amount is greater than 12500 €
        if ($totalOrderAmount > 12500) {
            $discount = $shippingPrice * 0.05; // 5% discount
            $discountedPrice = $shippingPrice - $discount;
            return $discountedPrice;
        }
    
        return $shippingPrice;
    }
    
    function getBaseShippingPrice($shippingZone, $connection) {
        //Get the shipping_price based on shipping_zone
        $query = "SELECT shipping_price FROM shipping_zones WHERE zone = '$shippingZone'";
        
        $result = $connection->query($query);
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['shipping_price'];
        } else {
            echo "The shipping zone has not been found. The operational cost is 1 Euro.  ";
            return 1; 
        }
    }
    include "pricelist.php";
?>