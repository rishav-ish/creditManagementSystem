<?php
	include "connect.php";
	
	session_start();
	
	
?>

<!DOCTYPE html>
<html lang = "en">
<head>
	<title>Credit Management</title>
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
	
		<?php 
		
			$select_name = htmlspecialchars($_POST["select_name"]);
			$user_name = htmlspecialchars($_SESSION["username"]);
			$amount = htmlspecialchars($_POST["amount"]);
			
			$sql = "SELECT current_credit from USER where name = '$user_name'";
			$sql2 = "SELECT current_credit from USER where name = '$select_name'";
			
			
			global $conn;
			
			$result = $conn->query($sql);
			
			$balance =  $result->fetch_assoc()["current_credit"];
			
			$previousBalance = $balance;
		
			$result = $conn->query($sql2);
				
			$deposit = $result->fetch_assoc()["current_credit"];
				
				
			if($balance > $amount && $amount > 0){
				
				
				
				
				$balance -= $amount;
				
				$deposit += $amount;
				
				$sql1 = "UPDATE USER SET current_credit = $balance  WHERE name = '$user_name'";
				$sql2 = "UPDATE USER SET current_credit = $deposit WHERE name = '$select_name'";
				$sql3 =  "INSERT INTO transaction (name,sendTo,sendAmount,status) values ('$user_name','$select_name',$amount,'send')";	
				
				$sql4 = "INSERT INTO transaction (name,receivedFrom,receivedAmount,status) values ('$select_name','$user_name',$amount,'received')"; 
				
				mysqli_autocommit($conn,FALSE);
				$conn->query($sql1);
				$conn->query($sql2);
				$conn->query($sql3);
				$conn->query($sql4);
			
				
				if(mysqli_commit($conn)){
					echo "<h2>Transaction Successful</h2>";
					echo "<h4> Previous credit = ".$previousBalance."<h4>";
					echo "<h4> Updated Credit = $balance</h2>";
					
					
				}else{
					
					echo "<h2>Not Sufficient Balance to do Transaction.</h2>";
					
				}
				
			}else if($amount < 0){
				echo "<h2>Oops there is no  money flowing backward</h2>";
				echo "<h4>Please enter the positive credit</h2>";
				
			}
			
			else{
				echo "<h2>Insufficient Balance to do Transaction.</h2>";
				echo "<h2>Your Balance $balance";
			}
			$conn->close();
			echo "<br><a href =". '"logout.php"'.">Go Back</a>";
			
			
			
	?>
		
	
		</div>	
	</div>
	
</body>
</html>