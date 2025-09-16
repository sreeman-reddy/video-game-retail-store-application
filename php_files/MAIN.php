<!DOCTYPE html>
<html>
    <head>
	<style>
		h1 {text-align: center;}
		div {text-align: center;}
		input[type=submit] {
		  background-color: #4CAF50;
		  border: none;
		  color: white;
		  padding: 16px 32px;
		  text-decoration: none;
		  margin: 4px 2px;
		  cursor: pointer;
		}
	</style>	
        <title>Game Store Application</title>
    </head>
    <body>
        <div id="container">
            <h1>Game Store Application</h1>
		<br><h2>Select a Table</h2>
		<br>
		<form action="pub_insert_update_screen.php" method="get">
			<input type="submit" value="PUBLISHERS">
		</form>	
		<br>
		<form action="dev_insert_update_screen.php" method="get">
			<input type="submit" value="DEVELOPERS">
		</form>	
		<br>
		<form action="game_insert_update_screen.php" method="get">
			<input type="submit" value="GAMES">
		</form>	
		<br>
		<form action="plat_insert_screen.php" method="get">
			<input type="submit" value="PLATFORMS">
		</form>	
		<br>
		<form action="stores_insert_delete_screen.php" method="get">
			<input type="submit" value="STORES">
		</form>	
		<br><form action="production_insert_screen.php" method="get">
			<input type="submit" value="PRODUCTION">
		</form>	
		<br>
		<form action="version_insert_screen.php" method="get">
			<input type="submit" value="VERSIONS">
		</form>	
		<br>
		<form action="inventory_insert_update_screen.php" method="get">
			<input type="submit" value="INVENTORY">
		</form>	
		<br>
		<form action="sales_insert_screen.php" method="get">
			<input type="submit" value="SALE">
		</form>	
		<br>
		<form action="report1.php" method="get">
			<input type="submit" value="REPORT 1">
		</form>
		<br>		
		<form action="report2.php" method="get">
			<input type="submit" value="REPORT 2">
		</form>	
		<br><br><br>
    </body>
</div>
</html>
