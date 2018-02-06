<?php
session_start();
date_default_timezone_set('Europe/London');
if(isset($_SESSION['username'])){
    $text = $_POST['text'];
    $logfile = $_SESSION['file'];
    $fp = fopen($logfile, 'a');
    fwrite($fp, "<div class='msgln'>(".date("g:i A ").") <b>".$_SESSION['username']."</b>: ".stripslashes(htmlspecialchars($text))."<br></div>");
    fclose($fp);
}
?>