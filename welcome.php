<?php
	
	include "connect.php";
	
	session_start();
	
	$_SESSION["username"] = htmlspecialchars($_GET["user_name"]);
	
	
?>

<!DOCTYPE html>
<html lang = "en">
<head>
	<title>Welcome <?php echo $_GET["user_name"]; ?></title>
	<meta charset = "utf-8">
	<meta name = "viewport" content = "width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	
</head>

<body>
	
	<div class = "jumbotron jumbotron-fluid">
			<div class = "container">
				<h1>Welcome, <?php echo $_SESSION["username"];?></h1>
				<p>Here is your credit details!<p>
				
				<h3>Current Credits : <?php $sql = "SELECT current_credit FROM USER where name = '".$_SESSION["username"]."'"; $result = $conn->query($sql); echo $result->fetch_assoc()["current_credit"];?></h3>
			</div>
	</div>
	
	<div class = "container">
		<button data-toggle = "collapse" data-target = "#view_transaction" class = "btn btn-primary">Transaction History</button>
	</div>
	
	<div class = "container collapse" id = "view_transaction">
			
		<div class = "table-responsive">
			<table class = "table table-striped">
				
				<thead>
					<tr>
						<th>Id</th>
						
						<th>Send To</th>
						<th>Send Amount</th>
						<th>Date/Time</th>
					</tr>
				</thead>
				
				<tbody>
					
						<?php 
						
							$sql = "SELECT id,sendTo,sendAmount,stamp from Transaction where name  = '".$_SESSION["username"]."' and status = 'send'";
							
							$result = $conn->query($sql);
							
	
							while($rows = $result->fetch_assoc()){
								echo "<tr>";
								echo "<td>".$rows["id"]."</td>";
								
								echo "<td>".$rows["sendTo"]."</td>";
								echo "<td>".$rows["sendAmount"]."</td>";
								echo "<td>".$rows["stamp"]."</td>";
								echo "</tr>";
							}
						?>
				</tbody>
			</table>
			
			
			<table class = "table table-striped">
				
				<thead>
					<tr>
						<th>Id</th>
						
						<th>RecivedFrom To</th>
						<th>Recived Amount</th>
						<th>Date/Time</th>
					</tr>
				</thead>
				
				<tbody>
					
						<?php 
						
							$sql = "SELECT id,receivedFrom,receivedAmount,stamp from Transaction where name  = '".$_SESSION["username"]."' and status = 'received'";
							
							$result = $conn->query($sql);
							
							
	
							while($rows = $result->fetch_assoc()){
								echo "<tr>";
								echo "<td>".$rows["id"]."</td>";
								
								echo "<td>".$rows["receivedFrom"]."</td>";
								echo "<td>".$rows["receivedAmount"]."</td>";
								echo "<td>".$rows["stamp"]."</td>";
								echo "</tr>";
							}
							
						?>
				</tbody>
			</table>
		</div>
	
		</div>
	
		<br>
		
	
	
	<div class = "container">
		<button data-toggle = "collapse" data-target = "#view_user" class = "btn btn-primary">Transfer Credit</button>
	</div>

	
	
	<div class = "container collapse" id = "view_user">
		<form action = <?php echo htmlspecialchars("transaction.php");?> method = "post" id = "view_user">
				<div class = "form-group">
					<label for = "user">Select a User</label>
					
					<select class = "form-control" id = "user" name = "select_name">
						<?php
						
							
							
							$sql = "SELECT name from user";
							
							
							
							$result = $conn->query($sql);
							
							
							while($row = $result->fetch_assoc()){
									
									if($row["name"]==$_SESSION["username"])
										continue;
									
									echo "<option>".$row["name"]."</option>\n";
									
							}
						
							$conn->close();
						?>
					</select>
				</div>
				
				<div class = "form-group">
					<label for = "amount">Enter Amount:</label>
					<input type="number" class="form-control" name = "amount" required>
				</div>
				
				<button type="submit" class="btn btn-primary">Submit</button>
				
			</form>
		</div>
		
		<br>
	
		<div class = "container">
			<a href = "logout.php" class = "btn btn-primary" role = "button">Go Back</a>
		</div>
		
	
</body>
</html>