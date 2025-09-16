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
        <title>Update Inventory</title>
    </head>
    <body>
		<p>
			<?php
				echo "Updating item: " . $_REQUEST["new_stock"] . " " . $_REQUEST["new_price"] . "...";  
				$sql = 'update inventory set stock= "'.$_REQUEST["new_stock"].'" , price="'.$_REQUEST["new_price"].'" where inv_id= '.$_REQUEST["inv_id"].'';
				try {
					$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$conn->exec($sql);
					echo "New record created successfully";
			?>
				<p>You will be redirected in 3 seconds</p>
				<script>
					var timer = setTimeout(function() {
						window.location='/inventory_insert_update_screen.php'
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
