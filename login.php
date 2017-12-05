<?php
include ("header.php");
include("conectaBD.php");
$compraFesta=3;
$erroLogin=0;

if($_REQUEST['action'] == "enviaLogin"){
    $actionBefore=$_POST['actionBefore'];
    $id=$_POST['id'];
    $quantidade=$_POST['quantidade'];
    
    session_start();
    $apelido = $_POST['apelido'];
    $senha = $_POST['senha'];
    $achou=0;
    // cria a instrução SQL que vai selecionar os dados
    $query = sprintf("SELECT apelido FROM Cliente where apelido='$apelido' AND senha='$senha';");
    // executa a query
    $dados = mysql_query($query, $con) or die(mysql_error());
  
    
    if(mysql_num_rows($dados)>0){
        $achou=1;
        $_SESSION['login']=$apelido;
          if(isset($actionBefore)){
        if($actionBefore=="loginCompraFesta"){
            //echo "<script type='text/javascript'> document.location ='checkout.php?action=checkoutFesta&idFesta=$id&quantidade=$quantidade'; </script>";
            ob_start();
            header("Location:checkout.php?action=checkoutFesta&id=$id&quantidade=$quantidade");
            ob_end_flush();
            exit;
        }else{
            if($actionBefore=="loginCompraEvento"){
                ob_start();
                header("Location:checkout.php?action=checkoutEvento&id=$id&quantidade=$quantidade");
                ob_end_flush();
                exit;
                
            }else{
                 header("Location: index.php"); 
                 exit;  
            }
        }
    }
     
    
    }else{
        $achou=0;
        $erroLogin=1;
        header("Location: login.php?action=erro"); 
        exit; 
    }
    
}


?>


<html>
    <head>
        <title>
            Login
        </title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
    </head>
    <body>
    
    <div class="container">
        <?php
            if($_REQUEST['action']=='erro'){
        ?>
            <div class="alert alert-danger" role="alert">
                Usuário ou senha incorreta!
            </div>
            <?php
            }
        ?>
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
             <div class="panel panel-danger">
            <h2 class="text-center login-title">Faça o login para continuar!</h1>
            <div class="account-wall">
                <br>
                <br>
                <form class="form-signin" action="login.php?action=enviaLogin" method="post">
                <input type="text" class="form-control" name="apelido" placeholder="User" required autofocus>
                <br>
                <input type="password" class="form-control" name="senha" placeholder="Senha" required>
                <br>
                <input type="hidden" name="actionBefore" value="<?php echo $_GET['action']; ?>"/>
               <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>"/>
               <input type="hidden" name="quantidade" value="<?php echo $_GET['quantidade']; ?>"/>
                <button class="btn btn-danger btn-lg btn-primary btn-block" type="submit">
                    Login</button>
               
                </form>
            </div>
            <a href="cadastroCliente.php" class="text-center new-account">Criar uma conta </a>
        </div>
    </div>
</div>
</div>
       <!--
         <form action="login.php?action=enviaLogin" method="post">
           <p> Login: <input type="text" name="apelido"/></p>
           <p> Senha: <input type="text" name="senha"/></p>
           <input type="hidden" name="actionBefore" value="<?php echo $_GET['action']; ?>"/>
           <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>"/>
           <input type="hidden" name="quantidade" value="<?php echo $_GET['quantidade']; ?>"/>
           <input type="submit" name="btnEnviar" value="ENVIAR"/>-->
        </form>
    </body>
</html>