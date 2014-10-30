<html>
	<head>
		<Title>Search Registrations</Title>
		<style tyle="text/css">
			body { background-color: #fff; border-top: solid 10px #000;
				color: #333; font-size: .85em; margin: 20; padding: 20;
				font-family: "Segoe UI", Verdana, Helvetica, Sans-Serif;
			}
			h1, h2, h3,{ color: #000; margin-bottom: 0; padding-bottom: 0; }
			h1 { font-size: 2em; }
			h2 { font-size: 1.75em; }
			h3 { font-size: 1.2em; }
			table { margin-top: 0.75em; }
			th { font-size: 1.2em; text-align: left; border: none; padding-left: 0; }
			td { padding: 0.25em 2em 0.25em 0em; border: 0 none; }
		</style>
	</head>
	<body>
		<h1>Search Registrations</h1>
		<p>Search:</p>
		<form method="post" action="search.php" enctype="multipart/form-data" >
			Name <input type="text" name="name" id="name"/></br>
			<input type="submit" name="submit" value = "Submit" />
		</form>
		<?php
			$host = "eu-cdbr-azure-west-b.cloudapp.net";
			$user = "b3a6e6cf186fd1";
			$pwd = "2e13d16d";
			$db = "danyaalAOKafhgnx";
			
			try {
				$conn = new PDO( "mysql:host=$host;dbname=$db", $user, $pwd);
				$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			}
			catch(Exception $e){
				die(var_dump($e));
			}
			
			if(!empty($_POST)) {
				try {
					$name = $_POST['name'];
					$sql_query = "SELECT * FROM registration_tbl WHERE name = ?";
					$stmt = $conn->prepare($sql_query);
					$stmt->bindValue(1, $name);
					$stmt->execute();
					
					if($stmt->rowCount() > 0) {
						echo "<h2>Registrants matching query:</h2>";
						echo "<table>";
						echo "<tr><th>Name</th>";
						echo "<th>Email</th>";
						echo "<th>Company</th>";
						echo "<th>Date</th></tr>";
						foreach($stmt as $registrant) {
							echo "<tr><td>".$registrant['name']."</td>";
							echo "<td>".$registrant['email']."</td>";
							echo "<td>".$registrant['company']."</td>";
							echo "<td>".$registrant['date']."</td></tr>";
						}
						echo "</table>";
					}
					else {
						echo "<h3>No one matched your query.</h3>";
					}
				}
				catch(Exception $e) {
					die(var_dump($e));
				}
			}
		?>
	</body>
</html>