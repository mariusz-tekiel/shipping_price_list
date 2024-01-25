<?php
    
    include "db_connection.php";
   
    // Fetch shipping data from the database
        $query = "SELECT * FROM shipping_data";
        $result = mysqli_query($connection, $query);

    // Check if the query was successful
    if ($result) {
        // Fetch associative array
        $shippingData = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipping Price List</title>
</head>
<body>
    <h2>Shipping Price List</h2>
    
    <?php if (!empty($shippingData)) : ?>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Postcode</th>
                    <th>Total Order Amount (Euro)</th>
                    <th>Long Product</th>
                    <th>Shipping Zone</th>
                    <th>Shipping Price (Euro)</th>
                    <th>Discounted Price (Euro)</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($shippingData as $row) : ?>
                    <tr>
                        <td><?= $row['id']; ?></td>
                        <td><?= $row['postcode']; ?></td>
                        <td><?= $row['total_order_amount']; ?></td>
                        <td><?= $row['long_product'] ? 'Yes' : 'No'; ?></td>
                        <td><?= $row['shipping_zone']; ?></td>
                        <td><?= $row['shipping_price']; ?></td>
                        <td><?= $row['discounted_price']; ?></td>
                        <td><?= $row['created_at']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>No shipping data available.</p>
    <?php endif; ?>

</body>
</html>