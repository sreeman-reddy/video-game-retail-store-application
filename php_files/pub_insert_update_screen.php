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
    $sql = 'SELECT pub_id, pub_name, pub_country FROM publishers';
    $q = $pdo->query($sql);
    $q->setFetchMode(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Publishers</title>
    </head>
    <body>
        <div id="container">
            <h2>Current List of Publishers</h2>
            <table border=1 cellspacing=5 cellpadding=5>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Publisher Name</th>
                        <th>Country</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $q->fetch()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['pub_id']) ?></td>
                            <td><?php echo htmlspecialchars($row['pub_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['pub_country']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
		<br><h2>Insert new Publisher:</h2>
		<form action="/pub_insert.php" method="post">
			<table>
				<tr><td>Publisher Name:</td><td><input type="text" id="pub_name" name="pub_name" value=""></td></tr>
				<tr><td>Country:</td><td><input type="text" id="pub_country" name="pub_country" value=""></td></tr>
			</table>
			<input type="submit" value="INSERT">
		</form>
		<br>
		<h2>Update existing Publisher:<h2>
		<form action="/pub_update.php/" method "post">
			<table>
				<tr><td>Publisher ID:</td><td><input type="text" id="pub_id" name="pub_id" value=""></td></tr>
				<tr><td>New Publisher Name:</td><td><input type="text" id="new_pub_name" name="new_pub_name" value=""></td></tr>
				<tr><td>New Country:</td><td><input type="text" id="new_pub_country" name="new_pub_country" value=""></td></tr>
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
