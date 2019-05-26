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
				<h1>Credit Management</h1>
				<p>simulating credit transfer between users.<p>
				
				
				
				
			</div>
		</div>
		
	
	
		<div class = "container">
		
			<button data-toggle = "collapse" data-target = "#view_user" class = "btn btn-primary">View All User</button>
			<br>
		
			<form action = <?php echo htmlspecialchars("welcome.php");?> method = "get" class = "collapse" id = "view_user">
				<div class = "form-group">
					<label for = "user">Be a User</label>
					
					<select class = "form-control" id = "user" name = "user_name">
						<?php
							
							$sql = "SELECT name from user";
							
							$result = $conn->query($sql);
							
							
							while($row = $result->fetch_assoc()){
									
									echo "<option>".$row["name"]."</option>";
									
							}
						
							$conn->close();
						?>
					</select>
				</div>
				
				<button type="submit" class="btn btn-primary">Submit</button>
				
			</form>
		</div>
								
								
						
	
	
	
</body>
</html>