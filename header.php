<?php
header('Content-Type: text/html; charset=UTF-8');
?>
<html>
    <head>
        <link rel="stylesheet" href="css/bootstrap.min.css">
    </head>
    <body>
        <nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">
          <img alt="Brand" width="90px" height="35px" src="images/cabecalho1.jpg">
      </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="retornaFesta.php">Festas <span class="sr-only">(current)</span></a></li>
        <li><a href="retornaEventos.php">Evento</a></li>
        
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Contato <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="contato.php">Fale Conosco</a></li>
            <li><a href="sobre.php">Sobre</a></li>
          </ul>
        </li>
      </ul>
     
      <ul class="nav navbar-nav navbar-right">
        <?php
          session_start();
          if(!isset($_SESSION["login"])){
            ?>
            <li><a href="cadastroCliente.php">Ainda não tem uma conta? Cadastre-se</a></li>
            <li><a href="login.php">Login</a></li>
         <?php }else{
           ?>
           <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
             <?php 
            $logado=false;
            // Inicia sessões 
            session_start(); 

            // Verifica se existe os dados da sessão de login 
              if(isset($_SESSION["login"])){ 
                  $logado=true;
                    $loginDoUsuario = $_SESSION["login"]; 
                    // Busca o nome do usuario no banco de dados para exibir
                    // definições de host, database, usuário e senha
                    $host = "localhost";
                    $db   = "CABREON";
                    $user = "carolinecdsantos";
                    $pass = "";
                    // conecta ao banco de dados
                    $con = mysql_pconnect($host, $user, $pass) or trigger_error(mysql_error(),E_USER_ERROR); 
                    // seleciona a base de dados em que vamos trabalhar
                    mysql_select_db($db, $con);
                    // cria a instrução SQL que vai selecionar os dados
                    $query = sprintf("SELECT nome FROM Cliente where apelido='$loginDoUsuario';");
                    // executa a query
                    $dados = mysql_query($query, $con) or die(mysql_error());
                    // transforma os dados em um vetor primeiro elemento é o primeiro dado do select
                    $linha = mysql_fetch_row($dados);
                    $nomedoUsuario = $linha[0];
                    echo $nomedoUsuario;
                }
            ?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
          
            <li><a href="historicoCompra.php">Historico de Compras</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="logout.php">Logout</a></li>
          </ul>
        </li>
           <?php
         }
         ?>
        
        
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<script src="jquery-3.2.1.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
    $(document).ready(function () {
        $('.dropdown-toggle').dropdown();
    });
</script>
    </body>
</html>

