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
    $sql = 'SELECT ver_id, game_id, plat_id FROM versions';
    $q = $pdo->query($sql);
    $q->setFetchMode(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Versions</title>
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
			<h2>Current List of Platforms</h2>
			<table border=1 cellspacing=5 cellpadding=5>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Platform Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $sql='SELECT plat_id, plat_name from platforms';
					$q=$pdo->query($sql)?>
					<?php while ($row = $q->fetch()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['plat_id']) ?></td>
                            <td><?php echo htmlspecialchars($row['plat_name']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>				
			</table>	
			
		<br><h2>Insert new Game Version:</h2>
		<form action="/version_insert.php" method="post">
			<table>
				<tr><td>Game ID:</td><td><input type="text" id="game_id" name="game_id" value=""></td></tr>
				<tr><td>Platform ID:</td><td><input type="text" id="plat_id" name="plat_id" value=""></td></tr>
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
