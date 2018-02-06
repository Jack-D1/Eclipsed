<?php
include("scripts/messaging/getmsgid.php");
     

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style>
body {
    font: 12px arial;
    color: #222;
    text-align: center;
    padding: 35px;
}
 
form,p,span {
    margin: 0;
    padding: 0;
}
 
input {
    font: 12px arial;
}
 
a {
    color: #0000FF;
    text-decoration: none;
}
 
a:hover {
    text-decoration: underline;
}
 
#wrapper {
	margin-top: 70px;
    margin: 0 auto;
    padding-bottom: 25px;
    background: #505660;
    width: 504px;
    border: 1px solid #ACD8F0;
}
 

 
#chatbox {
    text-align: left;
    margin: 0 auto;
    margin-bottom: 25px;
    padding: 10px;
    background: #41464f;
    height: 270px;
    width: 430px;
    border: 1px solid #ACD8F0;
    overflow: auto;
}
 
#usermsg {
    width: 395px;
    border: 1px solid #ACD8F0;
}
 
#submit {
    width: 60px;
}
 
.error {
    color: #ff0000;
}
 
#menu {
    padding: 12.5px 25px 12.5px 25px;
}
 
.welcome {
    float: left;
}
 
.logout {
    float: right;
}
 
.msgln {
    margin: 0 0 2px 0;
}
</style>
<title>Messaging</title>
<link rel="stylesheet" href="default.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <?php
    if (! isset ( $_SESSION ['username'] )) {
        header("Location: index.html");
    } else {
        ?>
<div class = "topbar">
	<a href="home.php"><img src="" alt="Eclipsed Logo" class="logo"></a>
	<form action="searchusers.php" style = "display: inline-block;">
   		<input name = "usersearch" type="text" autocomplete="off" placeholder = "Search for users">
   		<input type="submit" name = "search" value = "search">
	</form>	
	<form method = "post" action = "messaging.php" style="display: inline-block;">
		<input type = "text" name = "MessagingUser" placeholder = "Username of user to message" required>
		<input type = "submit" name = "submit" value = "Send Message">
	</form>
	<img src = "uploads/<?php echo $_SESSION['UserID'];?>.jpg" alt = "Profile Photo" class="myAccPic" style = "width: 25px; height: 25px; border-radius: 50%;">
	<a href = "<?php echo $_SESSION['username']; ?>.php">My account</a>
	<a href = logout.php>Log Out</a> <br>
</div>
        
<div id="wrapper">
        <div id="menu">
            <p class="welcome">
                Welcome, <b><?php echo $_SESSION['username']; ?></b>, you are messaging <b><?php echo $_SESSION['UserSendTo'];?></b>
            </p>
            <p class="logout">
                <a id="exit" href="home.php">Exit Chat</a>
            </p>
            <div style="clear: both"></div>
        </div>
    
        <div id="chatbox"><?php
		$logfile = $_SESSION['file'];
        if (file_exists ($logfile) && filesize ($logfile) > 0) {
            $handle = fopen ( $logfile, "r" );
            $contents = fread ($handle, filesize($logfile));
            fclose ( $handle );
           
            echo $contents;
        }
        ?></div>
 
     <form name="message" action="">
            <input name="usermsg" type="text" id="usermsg" size="63" autocomplete="off"  /> <input
                name="submitmsg" type="submit" id="submitmsg" value="Send" />
        </form>
    </div>
    <script type="text/javascript"
			src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
    <script type="text/javascript">

			
		
//If user submits the form
$("#submitmsg").click(function(){
	event.preventDefault(); 
    var clientmsg = $("#usermsg").val();
	if(clientmsg){
		$.post("post.php", {text: clientmsg});             
		$("#usermsg").attr("value", "");
		loadLog;
		return true;
	}else{
		alert("You cannot send a blank message");
		return false;
	}
});

function loadLog(){    
	var filename = "<?php echo $logfile; ?>";
    var oldscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height before the request
    $.ajax({
        url: filename,
        cache: false,
        success: function(html){       
            $("#chatbox").html(html); //Insert chat log into the #chatbox div  
            //Auto-scroll          
            var newscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height after the request
            if(newscrollHeight > oldscrollHeight){
                $("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
            }              
        },
    });
}
 
setInterval (loadLog, 300);
</script>
<?php
    }
    ?>
    <script type="text/javascript"
        src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
    <script type="text/javascript">
</script>
</body>
</html>