<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$username = 'sreeman';
$password = 'reddy';
$host = 'localhost';
$dbname = 'game_store_app';

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Insert into Games</title>
    </head>
    <body>
		<p>
			<?php 
				echo "Inserting new game: " . $_POST["game_name"] . " " . $_POST["esrb_rating"] . " " . $_POST["genre"] . " " . $_POST["release_date"] . "..."; 
				$sql = 'INSERT INTO games (game_name, esrb_rating, genre, release_date) ';
				$sql = $sql . 'VALUES ("'.$_POST["game_name"] . '","' . $_POST["esrb_rating"] . '","' . $_POST["genre"] . '","' . $_POST["release_date"] . '")';
				try {
					$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$conn->exec($sql);
					echo "New record created successfully";
			?>
				<p>You will be redirected in 3 seconds</p>
				<script>
					var timer = setTimeout(function() {
						window.location='game_insert_update_screen.php'
					}, 3000);
				</script>
			<?php
				} catch(PDOException $e) {
					echo $sql . "<br>" . $e->getMessage();
				}
				$conn = null;
			?>
		</p>
    </body>
</div>
</html>
