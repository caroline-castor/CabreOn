<?php
include("header.php");
include("conectaBD.php");
if($_REQUEST['action'] == 'enviaContato'){
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $mensagem = $POST['mensagem'];
    // cria a instrução SQL que vai selecionar os dados
    $query = sprintf("INSERT INTO Contato(nome,email,telefone,mensagem) VALUES ('$nome','$email','$telefone','$mensagem');");
    // executa a query
    $dados = mysql_query($query, $con) or die(mysql_error());
    ?><div class="alert alert-success" role="alert">
        Sua mensagem foi enviada com sucesso!
    </div><?php
    
   
}
?>


<html>
    <head>
        <title>
            Contato
        </title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
    </head>
    <body>
         <div class="col">
        <fieldset class"row-md-6">
        <div class="panel panel-default">
          <div class="panel-body">
              <h1>Contato</h1>
                  Preencha os campos abaixo com sua mensagem e em breve responderemos
        </fieldset>
        <fieldset class"row-md-6">
        <div class="well well-lg">
        <form action="contato.php?action=enviaContato" method=post>
        <div class="input-group">
            <input type="text" name="nome" class="form-control" placeholder="Nome" aria-describedby="sizing-addon1"/>
        </div>
        <br>
        <div class="input-group">
            <input type="text" name="email" class="form-control" placeholder="Email" aria-describedby="sizing-addon1"/>
        </div>
        <br>
        <div class="input-group">
            <input type="text" name="telefone" class="form-control" placeholder="Telefone" aria-describedby="sizing-addon1"/>
        </div>
        <br>
        <div class="input-group">
             <textarea rows="4" cols="50" class="form-control" placeholder="Mensagem">
            </textarea> 
        </div>
        <br>
      <input type="submit" name="btnEnviar" value="ENVIAR"/>
           
        </form>
        </fieldset>
        </div>
        </div>
        </div>
        </div>
    </body>
</html>