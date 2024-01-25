<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shipping Price Calculator</title>
</head>
<body>
    <form action="calculate_shipping.php" method="post">
        <label for="postcode">Postcode:</label>
        <input type="text" name="postcode" required pattern="\d{5}" title="Enter a 5-digit number">

        <label for="total_order_amount">Total Order Amount (€):</label>
        <input type="number" name="total_order_amount" required>

        <label for="long_product">Long Product:</label>
        <input type="checkbox" name="long_product">

        <input type="submit" value="Calculate Shipping">
    </form>
</body>
</html>
