<?php

    include "db_connection.php";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_FILES['zones_csv']) && $_FILES['zones_csv']['error'] === UPLOAD_ERR_OK) {
            $csvFile = $_FILES['zones_csv']['tmp_name'];

            // Process the CSV file and insert data into the database
            $csvData = array_map('str_getcsv', file($csvFile));

            foreach ($csvData as $row) {
                $zone = trim($row[0]);
                $shippingPrice = floatval(trim($row[1]));

                // Insert data into the database
                $query = "INSERT INTO shipping_zones (zone, shipping_price) VALUES ('$zone', '$shippingPrice')";
                mysqli_query($connection, $query);
            }

            // Show a success message
            echo "Success !";
            exit();
        } else {
            // Handle file upload error
            echo "File upload failed.";
        }
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Import Zones from CSV</title>
    </head>
    <body>
        <h2>Import Zones from CSV</h2>
        <form action="import_zones.php" method="post" enctype="multipart/form-data">
            <label for="zones_csv">Select CSV File:</label>
            <input type="file" name="zones_csv" accept=".csv" required>

            <input type="submit" value="Import Zones">
        </form>
    </body>
    </html>
