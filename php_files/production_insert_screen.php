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
    $sql = 'SELECT prod_id, game_id, dev_id, pub_id from production';
    $q = $pdo->query($sql);
    $q->setFetchMode(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Production</title>
    </head>
    <body>
        <div id="container">
            <h2>Current List of Games</h2>
            <table border=1 cellspacing=5 cellpadding=5>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Game Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $sql='SELECT game_id, game_name from games';
					$q=$pdo->query($sql)?>
					<?php while ($row = $q->fetch()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['game_id']) ?></td>
                            <td><?php echo htmlspecialchars($row['game_name']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>				
			</table>
			<h2>Current List of Developers</h2>
			<table border=1 cellspacing=5 cellpadding=5>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Developer Name</th>
                    </tr>
                </thead>
				<tbody>
                    <?php $sql='SELECT dev_id, dev_name from developers';
					$q=$pdo->query($sql)?>
					<?php while ($row = $q->fetch()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['dev_id']) ?></td>
                            <td><?php echo htmlspecialchars($row['dev_name']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
			</table>	
			<h2>Current List of Publishers</h2>
			<table border=1 cellspacing=5 cellpadding=5>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Publisher Name</th>
                    </tr>
                </thead>
				<tbody>
                    <?php $sql='SELECT pub_id, pub_name from publishers';
					$q=$pdo->query($sql) ?>
					<?php while ($row = $q->fetch()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['pub_id']) ?></td>
                            <td><?php echo htmlspecialchars($row['pub_name']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
		<br><h2>Insert new Production:</h2>
		<form action="/production_insert.php" method="post">
			<table>
				<tr><td>Game ID:</td><td><input type="text" id="game_id" name="game_id" value=""></td></tr>
				<tr><td>Developer ID:</td><td><input type="text" id="dev_id" name="dev_id" value=""></td></tr>
				<tr><td>Publisher ID:</td><td><input type="text" id="pub_id" name="pub_id" value=""></td></tr>
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
