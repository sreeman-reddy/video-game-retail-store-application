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
    $sql = 'select game_name, plat_name , sum(quantity)*price as revenue from games g, platforms p, versions v, sales s, inventory i where g.game_id=v.game_id and v.plat_id=p.plat_id and v.ver_id=s.ver_id and v.ver_id=i.ver_id group by s.ver_id, price order by revenue desc';
    $q = $pdo->query($sql);
    $q->setFetchMode(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Report 2</title>
    </head>
    <body>
        <div id="container">
            <h2>Revenue from Game Sales</h2>
            <table border=1 cellspacing=5 cellpadding=5>
                <thead>
                    <tr>
                        <th>Game Name</th>
                        <th>Platform Name</th>
                        <th>Revenue</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $q->fetch()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['game_name']) ?></td>
                            <td><?php echo htmlspecialchars($row['plat_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['revenue']); ?></td>
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
