<?php
// mysqliクラスのオブジェクトを作成
$mysqli = new mysqli('mysql1.webcrow-php.netowl.jp', 'smartboard_test', 'tacica023', 'smartboard_test');
if ($mysqli->connect_error) {
    echo $mysqli->connect_error;
    exit();
} else {
    $mysqli->set_charset("utf8");
}
?>