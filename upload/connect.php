<?php

     //サーバーに接続
     $dsn = '';
     $user = '';
     $password = '';
     $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
     
?>