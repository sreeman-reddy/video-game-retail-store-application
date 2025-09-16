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
    $sql = 'SELECT game_id, game_name, ESRB_rating, genre, release_date FROM games';
    $q = $pdo->query($sql);
    $q->setFetchMode(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Games</title>
    </head>
    <body>
        <div id="container">
            <h2>Current List of Games</h2>
            <table border=1 cellspacing=5 cellpadding=5>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Game Name</th>
                        <th>ESRB rating</th>
						<th>Genre</th>
						<th>Release Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $q->fetch()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['game_id']) ?></td>
                            <td><?php echo htmlspecialchars($row['game_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['ESRB_rating']); ?></td>
							<td><?php echo htmlspecialchars($row['genre']); ?></td>
							<td><?php echo htmlspecialchars($row['release_date']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
		<br><h2>Insert new Game:</h2>
		<form action="/game_insert.php" method="post">
			<table>
				<tr><td>Game Name:</td><td><input type="text" id="game_name" name="game_name" value=""></td></tr>
				<tr><td>ESRB Rating:</td><td><select id="esrb_rating" name="esrb_rating"><option value="Everyone">Everyone</option><option value="Everyone 10+">Everyone 10+</option><option value="Teen">Teen</option><option value="Mature 17+">Mature 17+</option><option value="Adults Only 18+">Adults Only 18+</option><option value="Rating Pending">Rating Pending</option></select></td></tr>
				<tr><td>Genre:</td><td><input type="text" id="genre" name="genre" value=""></td></tr>
				<tr><td>Release Date (yyyy/mm/dd format):</td><td><input type="text" id="release_date" name="release_date" value=""></td></tr>
			</table>
			<input type="submit" value="INSERT">
		</form>
		<br>
		<h2>Update existing Games:<h2>
		<form action="/game_update.php" method "post">
			<table>
				<tr><td>Game ID:</td><td><input type="text" id="game_id" name="game_id" value=""></td></tr>
				<tr><td>New Game Name:</td><td><input type="text" id="new_game_name" name="new_game_name" value=""></td></tr>
				<tr><td>New ESRB Rating:</td><td><select id="new_esrb_rating" name="new_esrb_rating"><option value="Everyone">Everyone</option><option value="Everyone 10+">Everyone 10+</option><option value="Teen">Teen</option><option value="Mature 17+">Mature 17+</option><option value="Adults Only 18+">Adults Only 18+</option><option value="Rating Pending">Rating Pending</option></select></td></tr>
				<tr><td>New Genre:</td><td><input type="text" id="new_genre" name="new_genre" value=""></td></tr>
				<tr><td>New Release Date (yyyy-mm-dd format):</td><td><input type="text" id="new_release_date" name="new_release_date" value=""></td></tr>
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
