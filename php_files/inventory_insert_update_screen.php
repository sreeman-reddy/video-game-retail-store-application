<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$username = 'sreeman';
$password = 'reddy';
$host = 'localhost';
$dbname = 'game_store_app';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $sql = 'SELECT inv_id, store_id, ver_id, stock, price FROM inventory';
    $q = $pdo->query($sql);
    $q->setFetchMode(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Inventory</title>
    </head>
    <body>
        <div id="container">
            <h2>Current Inventory</h2>
            <table border=1 cellspacing=5 cellpadding=5>
                <thead>
                    <tr>
                        <th>Inventory ID</th>
                        <th>Store ID</th>
                        <th>Game Version ID</th>
						<th>Stock</th>
						<th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $q->fetch()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['inv_id']) ?></td>
                            <td><?php echo htmlspecialchars($row['store_id']); ?></td>
                            <td><?php echo htmlspecialchars($row['ver_id']); ?></td>
							<td><?php echo htmlspecialchars($row['stock']); ?></td>
							<td><?php echo htmlspecialchars($row['price']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
		<br><h2>Insert to Inventory:</h2>
		<form action="/inventory_insert.php" method="post">
			<table>
				<tr><td>Store ID</td><td><input type="text" id="store_id" name="store_id" value=""></td></tr>
				<tr><td>Game Version ID:</td><td><input type="text" id="ver_id" name="ver_id" value=""></td></tr>
				<tr><td>Stock:</td><td><input type="text" id="stock" name="stock" value=""></td></tr>
				<tr><td>Price:</td><td><input type="text" id="price" name="price" value=""></td></tr>
			</table>
			<input type="submit" value="INSERT">
		</form>
		<br>
		<h2>Update Inventory:<h2>
		<form action="/inventory_update.php" method "post">
			<table>
				<tr><td>Inventory ID:</td><td><input type="text" id="inv_id" name="inv_id" value=""></td></tr>			
				<tr><td>New Stock:</td><td><input type="text" id="new_stock" name="new_stock" value=""></td></tr>
				<tr><td>New Price:</td><td><input type="text" id="new_price" name="new_price" value=""></td></tr>
			</table>
			<input type="submit" value="UPDATE">
		</form>
		<br>
		<form action="MAIN.php" method="get">
			<input type="submit" value="RETURN TO MAIN">
		</form>	
		<br><br>
		</div>
    </body>
</html>
