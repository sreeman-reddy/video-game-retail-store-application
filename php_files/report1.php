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
    $sql = 'select s.store_id, game_name, plat_name, stock from games g, platforms p, versions v, inventory i, stores s where g.game_id=v.game_id and v.plat_id=p.plat_id and v.ver_id=i.ver_id and i.store_id=s.store_id order by stock desc';
    $q = $pdo->query($sql);
    $q->setFetchMode(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Report 1</title>
    </head>
    <body>
        <div id="container">
            <h2>Stock of Games in Each Store</h2>
            <table border=1 cellspacing=5 cellpadding=5>
                <thead>
                    <tr>
                        <th>Store ID</th>
                        <th>Game Name</th>
                        <th>Platform Name</th>
						<th>Stock</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $q->fetch()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['store_id']) ?></td>
                            <td><?php echo htmlspecialchars($row['game_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['plat_name']); ?></td>
							<td><?php echo htmlspecialchars($row['stock']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
			<br>
			<form action="MAIN.php" method="get">
				<input type="submit" value="RETURN TO MAIN">
			</form>	
			<br><br>
		</div>
    </body>
</html>
