<?php
header('Content-Type: text/html; charset=UTF-8');
?>
<?php
include("header.php");
include("conectaBD.php");
if($_REQUEST['action'] == 'enviaCadastro'){
    $rg = $_POST['rg'];
    $nome = $_POST['nome'];
    $dataNascimento = $_POST['dataNascimento'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $apelido = $_POST['apelido'];
    $senha = $_POST['senha'];
   
    // cria a instrução SQL que vai selecionar os dados
    $query2=("SELECT * FROM Cliente where apelido='$apelido';");
    $dados2 = mysql_query($query2, $con) or die(mysql_error());
    $totalRetornado=mysql_num_rows($dados2);
    if(!$totalRetornado){
    $query = sprintf("INSERT INTO Cliente(RG,nome,dataNascimento,email,telefone,apelido,senha) VALUES ('$rg','$nome','$dataNascimento','$email','$telefone','$apelido','$senha');");
    // executa a query
    $dados = mysql_query($query, $con) or die(mysql_error());
    $total = mysql_affected_rows();
    //se incluiu com sucesso
    if($total>=0){
        //redireciona para index;
       echo "<script type='text/javascript'>window.top.location='index.php';</script>"; 
       exit;
    }else{
        //exibe mensagem de erro na pagina
        ?>
            <div class="alert alert-danger" role="alert">
                Ocorreu um erro, tente mais tarde!
            </div>
        <?php
    }
    }else{
        echo "<script type='text/javascript'>alert('User ja existente. Tente Novamente.');</script>";
    }
   
}
?>


<html>
    
    <head>
        <title>
            Cadastro
        </title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
    </head>
    <body>
        <!-- Page Content -->
    <div class="container">

        <form class="form-horizontal" action="cadastroCliente.php?action=enviaCadastro" method="post">
<fieldset>

<!-- Form Name -->
<legend>Cadastro do Usuário</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="nome">Nome</label>  
  <div class="col-md-5">
  <input id="nome" name="nome" type="text" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="rg">RG</label>  
  <div class="col-md-5">
  <input id="rg" name="rg" type="text" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="dataNascimento">Data de Nascimento</label>  
  <div class="col-md-5">
  <input id="dataNascimento" name="dataNascimento" type="text" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="email">Email</label>  
  <div class="col-md-5">
  <input id="email" name="email" type="text" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="telefone">Telefone</label>  
  <div class="col-md-5">
  <input id="telefone" name="telefone" type="text" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="apelido">User</label>  
  <div class="col-md-5">
  <input id="apelido" name="apelido" type="text" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Password input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="senha">Senha</label>
  <div class="col-md-5">
    <input id="senha" name="senha" type="password" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>




<!-- Button (Double) -->
<div class="form-group">
  <label class="col-md-4 control-label" for="idConfirmar"></label>
  <div class="col-md-8">
    <button id="idConfirmar" name="idConfirmar" type="submit" class="btn btn-primary">Confirmar</button>
  </div>
</div>

</fieldset>
</form>
       

    </div>
<!-- /.container -->

        <!--<form action="cadastroCliente.php?action=enviaCadastro" method=post>
           <p><input type="text" name="rg" placeholder="RG" required/></p>
           <p><input type="text" name="nome" placeholder="Nome" required/></p>
           <p><input type="date" name="dataNascimento" placeholder="Data Nascimento" required/></p>
           <p><input type="email" name="email" placeholder="Email" required/></p>
           <p><input type="text"  name="telefone" placeholder="Telefone"/></p>
           <p><input type="text" name="apelido" placeholder="Apelido" required/></p>
           <p><input type="password" name="senha" placeholder="Senha"required/></p>
           <p><input type="password" name="confirmaSenha" placeholder="Confirme a senha" required/></p>
           <input type="submit" name="btnEnviar" value="ENVIAR"/>-->
        </form>
    </body>
</html>