<?php
 $host = "localhost";
    $db   = "CABREON";
    $user = "carolinecdsantos";
    $pass = "";
    // conecta ao banco de dados
    $con = mysql_pconnect($host, $user, $pass) or trigger_error(mysql_error(),E_USER_ERROR); 
    mysql_set_charset('utf8',$con);
    // seleciona a base de dados em que vamos trabalhar
    mysql_select_db($db, $con);

?>