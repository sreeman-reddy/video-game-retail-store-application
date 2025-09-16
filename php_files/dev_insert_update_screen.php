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
    $sql = 'SELECT dev_id, dev_name, dev_country FROM developers';
    $q = $pdo->query($sql);
    $q->setFetchMode(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Developers</title>
    </head>
    <body>
        <div id="container">
            <h2>Current List of Developers</h2>
            <table border=1 cellspacing=5 cellpadding=5>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Developer Name</th>
                        <th>Country</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $q->fetch()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['dev_id']) ?></td>
                            <td><?php echo htmlspecialchars($row['dev_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['dev_country']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
		<br><h2>Insert new Developer:</h2>
		<form action="/dev_insert.php" method="post">
			<table>
				<tr><td>Developer Name:</td><td><input type="text" id="dev_name" name="dev_name" value=""></td></tr>
				<tr><td>Country:</td><td><input type="text" id="dev_country" name="dev_country" value=""></td></tr>
			</table>
			<input type="submit" value="INSERT">
		</form>
		<br>
		<h2>Update existing Developers:<h2>
		<form action="/dev_update.php" method "post">
			<table>
				<tr><td>Developer ID:</td><td><input type="text" id="dev_id" name="dev_id" value=""></td></tr>			
				<tr><td>New Developer Name:</td><td><input type="text" id="new_dev_name" name="new_dev_name" value=""></td></tr>
				<tr><td>New Country:</td><td><input type="text" id="new_dev_country" name="new_dev_country" value=""></td></tr>
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
