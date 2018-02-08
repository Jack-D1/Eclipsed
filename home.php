<html>
<?php
include("scripts/validation/check.php");
include("scripts/validation/connection.php");

$username = $_SESSION['username'];
$userID = $_SESSION['UserID'];
//Was used to check the session was set correctly
//echo 'Welcome back, ' . $username;
//echo '<br>';
	
?>
<head>
	<title>Home</title>
	<link rel="stylesheet" href="default.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<div class = "topbar">
	<a href="home.php"><img src="" alt="Eclipsed Logo" class="logo"></a>
	<form action="searchusers.php" style = "display: inline-block;">
   		<input name = "usersearch" type="text" autocomplete="off" placeholder = "Search for users">
   		<input type="submit" name = "search" value = "search">
	</form>	
	<form method = "post" action = "/scripts/messaging/messaging.php" style="display: inline-block;">
		<input type = "text" name = "MessagingUser" placeholder = "Username of user to message" required>
		<input type = "submit" name = "submit" value = "Send Message">
	</form>
	<img src = "uploads/<?php echo $_SESSION['UserID'];?>.jpg" alt = "Profile Photo" class="myAccPic" style = "width: 25px; height: 25px; border-radius: 50%;">
	<a href = "<?php echo $_SESSION['username']; ?>.php">My account</a>
	<a href = scripts/account/logout.php>Log Out</a>
</div>

<div  class = "makePost">
	<form name="post">
		  <input name="userpost" type="text" id="userpost" size="63" required> 
		  <input name="submitpost" type="submit" id="submitpost" value="Post">
	</form>
</div>


<div id="posts">
	<?php

		$getPosts = mysqli_query($connection, "
		SELECT postData.username, postData.displayname, postData.Post, postData.postedBy FROM following AS f,
		(SELECT * FROM post AS p INNER JOIN user AS u ON u.UserID = p.postedBy) AS postData
		WHERE f.UserID1 = '$userID' AND f.UserID2 = postData.UserID
		ORDER BY PostID DESC	
		");
		
		while($Posts = mysqli_fetch_assoc($getPosts)){
			$Loc = $Posts['username'] . ".php";
			$PF = "uploads/" . $Posts['postedBy']. ".jpg";
			echo '<table><tr><th rowspan = "2"><img src = "'.$PF.'" alt = "Profile Photo" style = "width: 40px; height: 40px; border-radius: 50%;"></th><th>';
			echo "<a href = '". $Loc ."'>";
			echo $Posts['displayname'];
			echo "</th></tr><tr><td>";
			echo "<a href = '". $Loc ."'>";
			echo $Posts['username'] ;
			echo '</td></tr></table>';
			echo $Posts['Post'];
			echo "<br>";
			echo "<br>";
		}
		
		mysqli_close($connection);
	?>
	
</div>

</body>

<script type="text/javascript"src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>

<script type = "text/javascript">

		//If the user submits a post	
		$("#submitpost").click(function(){
				event.preventDefault(); //prevents the form from reloading the page
				var clientpost = $("#userpost").val(); //Sets the variable client post equal to the value of the box
				if (clientpost){
					$.post("scripts/post/posting.php", {text: clientpost}); //Sends the variable clientpost to the posting file 
					$("#userpost").attr("value", ""); //replaces the contents of the box with blank text
					loadPost();
					return true;
				}else{
					alert("You cannot make a blank post");
					return false;
				}
		});

		function loadPost(){    
			
			$.ajax({
				url: "home.php",
				cache: false,
				success:function(html){  
					//replaces the contents of the posts div with the code for reading new posts 
					$("#posts").load("home.php #posts");			   
				}
			});
		}
		
		setInterval (loadPost, 15000);

	
</script>
		
</html>