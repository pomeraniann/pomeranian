<?php
 
/* sessionsをクリア */
session_start();
session_destroy();
  
/* connect.phpへリダイレクト */
header('Location: http://smartboard-r.sakura.ne.jp/src/top.php');

?>