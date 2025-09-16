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
    $sql = 'SELECT store_id, location FROM stores';
    $q = $pdo->query($sql);
    $q->setFetchMode(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Stores</title>
    </head>
    <body>
        <div id="container">
            <h2>Current List of Stores</h2>
            <table border=1 cellspacing=5 cellpadding=5>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Location</th>
						<th>Delete?</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $q->fetch()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['store_id']) ?></td>
                            <td><?php echo htmlspecialchars($row['location']); ?></td>
                            <td><?php echo '<form action="/stores_delete.php" method="post"><input type="submit" value="DELETE"><input type="hidden" name="store_id" value="' . htmlspecialchars($row['store_id']) . '"></form>'; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
		<br><h2>Insert new Store:</h2>
		<form action="/stores_insert.php" method="post">
			<table>
				<tr><td>Location:</td><td><input type="text" id="location" name="location" value=""></td></tr>
			</table>
			<input type="submit" value="INSERT">
		</form>
		<br>
		<form action="MAIN.php" method="get">
			<input type="submit" value="RETURN TO MAIN">
		</form>	
		<br><br><br>
		</div>
    </body>
</html>
