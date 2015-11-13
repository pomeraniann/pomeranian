<?php
 
/* sessionsをクリア */
session_start();
session_destroy();
  
/* connect.phpへリダイレクト */
header('Location: http://smartboard.webcrow.jp/src/connect.php');

?>