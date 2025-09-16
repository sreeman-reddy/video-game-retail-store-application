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
    $sql = 'SELECT sale_id, ver_id, store_id, quantity, date FROM sales';
    $q = $pdo->query($sql);
    $q->setFetchMode(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Sales (Admin)</title>
    </head>
    <body>
        <div id="container"> 
			<h2>Current Sales List</h2>
            <table border=1 cellspacing=5 cellpadding=5>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Game Version ID</th>
                        <th>Store ID</th>
						<th>Quantity</th>
						<th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $q->fetch()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['sale_id']) ?></td>
                            <td><?php echo htmlspecialchars($row['ver_id']); ?></td>
                            <td><?php echo htmlspecialchars($row['store_id']); ?></td>
							<td><?php echo htmlspecialchars($row['quantity']); ?></td>
							<td><?php echo htmlspecialchars($row['date']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
		<br>		
		<h2>New Sale:</h2>
		<form action="/sales_insert.php" method="post">
			<table>
				<tr><td>Game Version ID</td><td><input type="text" id="ver_id" name="ver_id" value=""></td></tr>
				<tr><td>Store ID:</td><td><input type="text" id="store_id" name="store_id" value=""></td></tr>
				<tr><td>Quantity:</td><td><input type="text" id="quantity" name="quantity" value=""></td></tr>
				<tr><td>Date:</td><td><input type="text" id="date" name="date" value=""></td></tr>
			</table>
			<input type="submit" value="INSERT">
		</form>
		</form>
		<br>
		<form action="MAIN.php" method="get">
			<input type="submit" value="RETURN TO MAIN">
		</form>	
		<br><br><br>
		</div>
    </body>
</html>
