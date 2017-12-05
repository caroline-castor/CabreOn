<?php
    session_start();
    // Verifica se existe os dados da sessão de login 
if(isset($_SESSION["login"])) 
{ 
    unset($_SESSION['login']);
 
header("Location: index.php"); 
exit; 
} 
?>