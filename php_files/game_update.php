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
        <title>Update Game</title>
    </head>
    <body>
		<p>
			<?php
				echo "Updating game: " . $_REQUEST["new_game_name"] . " " . $_REQUEST["new_esrb_rating"] . " " . $_REQUEST["new_genre"] . " " . $_REQUEST["new_release_date"] . "...";  
				$sql = 'update games set game_name= "'.$_REQUEST["new_game_name"].'" , ESRB_rating="'.$_REQUEST["new_esrb_rating"].'" , genre="'.$_REQUEST["new_genre"].'" , release_date="'.$_REQUEST["new_release_date"].'" where game_id= '.$_REQUEST["game_id"].'';
				try {
					$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$conn->exec($sql);
					echo "New record created successfully";
			?>
				<p>You will be redirected in 3 seconds</p>
				<script>
					var timer = setTimeout(function() {
						window.location='/game_insert_update_screen.php'
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
