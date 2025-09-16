<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$username = 'sreeman';
$password = 'reddy';
$host = 'localhost';
$dbname = 'game_store_app';

function getValue($conn, $sql)
{
    $sth=$conn->prepare($sql);
	$sth->execute();
	return $sth->fetchColumn();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>New Sale</title>
    </head>
    <body>
		<p>
			<?php 
				echo "New Transaction: " . $_POST["ver_id"] . " " . $_POST["store_id"] . " " . $_POST["quantity"] . " " . $_POST["date"] . "..."; 
				try {
					$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$query1='INSERT INTO sales (ver_id, store_id, quantity, date) VALUES ('.$_POST["ver_id"] . ','.$_POST["store_id"] . ','.$_POST["quantity"] . ',"' . $_POST["date"] . '")';
					$query2='SELECT stock from inventory where store_id='.$_REQUEST["store_id"].' and ver_id='.$_REQUEST["ver_id"].'';
					$query3='UPDATE inventory set stock = '.getValue($conn,$query2).'-'. $_REQUEST["quantity"] .' where store_id='.$_REQUEST["store_id"].' and ver_id='.$_REQUEST["ver_id"].'';
					$conn->beginTransaction();
					$conn->exec($query1);
					$conn->exec($query3);
					if (getValue($conn,$query2)<0){
						$conn->rollback();
						echo "Transaction Failed";
					} else{
						$conn->commit();
						echo "Transaction Successful";
					}
			?>
				<p>You will be redirected in 3 seconds</p>
				<script>
					var timer = setTimeout(function() {
						window.location='sales_insert_screen.php'
					}, 3000);
				</script>
			<?php
				} catch(PDOException $e) {
					echo  $e->getMessage();
				}
				$conn = null;
			?>
		</p>
    </body>
</div>
</html>
