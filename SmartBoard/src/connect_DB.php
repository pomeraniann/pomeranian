<?php

$url = "localhost";
$user = "root";
$pass = "root";
$db = "smartboardDB";

// MySQLへ接続する
$link = mysql_connect($url,$user,$pass) or die("MySQLへの接続に失敗しました。");

// データベースを選択する
$sdb = mysql_select_db($db,$link) or die("データベースの選択に失敗しました。");

// クエリを送信する
//$sql = "SELECT * FROM T01Prefecture";
//$result = mysql_query($sql, $link) or die("クエリの送信に失敗しました。<br />SQL:".$sql);

//結果セットの行数を取得する
//$rows = mysql_num_rows($result);

//結果保持用メモリを開放する
mysql_free_result($result);

// MySQLへの接続を閉じる
mysql_close($link) or die("MySQL切断に失敗しました。");
?>

