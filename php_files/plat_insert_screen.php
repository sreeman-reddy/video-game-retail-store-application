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
    $sql = 'SELECT plat_id, plat_name, manufacturer FROM platforms';
    $q = $pdo->query($sql);
    $q->setFetchMode(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Platforms</title>
    </head>
    <body>
        <div id="container">
            <h2>Current List of Platforms</h2>
            <table border=1 cellspacing=5 cellpadding=5>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Platform Name</th>
                        <th>Manufacturer</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $q->fetch()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['plat_id']) ?></td>
                            <td><?php echo htmlspecialchars($row['plat_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['manufacturer']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
		<br><h2>Insert new Platform:</h2>
		<form action="/plat_insert.php" method="post">
			<table>
				<tr><td>Platform Name:</td><td><input type="text" id="plat_name" name="plat_name" value=""></td></tr>
				<tr><td>Manufacturer:</td><td><input type="text" id="manufacturer" name="manufacturer" value=""></td></tr>
			</table>
			<input type="submit" value="INSERT">
		</form>
		<br>
		<form action="MAIN.php" method="get">
			<input type="submit" value="RETURN TO MAIN">
		</form>	
		<br><br>
		</div>
    </body>
</html>
