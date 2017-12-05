<?php
include("conectaBD.php");
include("header.php");
if($_REQUEST['action'] == 'checkoutFesta'){
    session_start();
       if(isset($_POST['quantidade'])){
            $quantidade=$_POST['quantidade'];
        }else{
          $quantidade=$_REQUEST['quantidade'];
        }
    
    $idFesta = $_REQUEST['id'];
    $loginUsuario = $_SESSION["login"];
    // cria a instrução SQL que vai procurar o RG do usuario logado
    $query = sprintf("SELECT RG from Cliente where apelido='$loginUsuario'");
    // executa a query
    $dados = mysql_query($query, $con) or die(mysql_error());
    // transforma os dados em um vetor
    $linha = mysql_fetch_row($dados);
    // calcula quantos dados retornaram
    $total = mysql_num_rows($dados);
    if($total>0){
        $RGCliente = $linha[0];
    }else{
       ob_start();
        header("Location:login.php?action=loginCompraFesta&id=$idFesta&quantidade=$quantidade");
        exit;
        ob_end_flush();
    }
}

if($_REQUEST['action'] == 'checkoutEvento'){
    session_start();
       if(isset($_POST['quantidade'])){
            $quantidade=$_POST['quantidade'];
        }else{
          $quantidade=$_REQUEST['quantidade'];
        }
    
    $idEvento = $_REQUEST['id'];
    $loginUsuario = $_SESSION["login"];
    // cria a instrução SQL que vai procurar o RG do usuario logado
    $query = sprintf("SELECT RG from Cliente where apelido='$loginUsuario'");
    // executa a query
    $dados = mysql_query($query, $con) or die(mysql_error());
    // transforma os dados em um vetor
    $linha = mysql_fetch_row($dados);
    // calcula quantos dados retornaram
    $total = mysql_num_rows($dados);
    if($total>0){
        $RGCliente = $linha[0];
    }else{
       ob_start();
        header("Location:login.php?action=loginCompraEvento&id=$idEvento&quantidade=$quantidade");
        exit;
        ob_end_flush();
    }
}

?>



<html>
<head>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <title>Checkout CabreOn</title>
  <meta name="viewport" content="width=device-width">
  
</head>
<body>

<div class="jumbotron">
  <div class="container">
  <h1>Ótima escolha!</h1>
  <p>Obrigado por comprar na CabreOn! 
  Preencha seus dados de pagamento para efetivar a compra.</p>
  <div class="container">
    <div class="row">
    <div class="col-sm-4">

  <div class="panel panel-default">
  <div class="panel-heading">
  <h2>Sua compra</h2>
  </div><!-- fim .panel-heading -->
  <div class="panel-body">
  <dl>
    <dt>Produto</dt>
    <!--nome -->
    <dd><?php 
        if($_REQUEST['action']=="checkoutFesta"){
        $query = sprintf("SELECT nome,valor,descricao,dataRealizacao from Festa where ID=$idFesta;");
        }else{
          if($_REQUEST['action']=="checkoutEvento"){
            $query = sprintf("SELECT nome,valor,descricao,dataRealizacao from Evento where ID=$idEvento;");
          }
        }
        // executa a query
        $dados = mysql_query($query, $con) or die(mysql_error());
        if(mysql_num_rows($dados)>0){
        // transforma os dados em um vetor
        $linha = mysql_fetch_row($dados);
        $nome = $linha[0];
        $valor = $linha[1];
        $descricao = $linha[2];
        $dataRealizacao = $linha[3];
        
        //printa nome da festa
        echo $nome;
        }
        
    ?></dd>

    <dt>Valor</dt>
    <dd>R$ <?php echo $valor; ?>,00</dd>

    <dt>Data Realização</dt>
    <dd><?php echo $dataRealizacao;?></dd>

    <dt>Descrição</dt>
    <dd><?php echo $descricao;?></dd>
  </dl>
</div>
</div>
</div>
<?php if($_REQUEST['action']=='checkoutFesta'){
?><form class="col-sm-8" action="index.php?action=confirma" method="POST"><?php }else{
  if($_REQUEST['action']=='checkoutEvento'){
    ?>
    <form class="col-sm-8" action="index.php?action=confirmaEvento" method="POST">
<?php    
} 
}
?>

 
  <fieldset>
  <legend>Cartão de crédito</legend>

  <div class="form-group">
    <label for="numero-cartao">Número - CVV</label>
    <input type="text" class="form-control" 
           id="numero-cartao" name="numero-cartao">
  </div>

  <div class="form-group">
    <label for="bandeira-cartao">Bandeira</label>
    <select name="bandeira-cartao" id="bandeira-cartao"
        class="form-control">
      <option value="master">MasterCard</option>
      <option value="visa">VISA</option>
      <option value="amex">American Express</option>
      <option value="elo">Elo</option>
      <option value="dinners">Dinners</option>
      <option value="hipercard">Hipercard</option>
    </select>
  </div>

  <div class="form-group">
    <label for="validade-cartao">Validade</label>
    <input type="month" class="form-control" 
           id="validade-cartao" name="validade-cartao">
  </div>
</fieldset>
  <?php
    if($_REQUEST['action']=='checkoutFesta'){
  ?>
  <input type="hidden" name= "idFesta" value="<?php echo $idFesta;?>"/>
  <?php
    }else{
      if($_REQUEST['action']=='checkoutEvento'){ ?>
        <input type="hidden" name= "idEvento" value="<?php echo $idEvento;?>"/>
        <?php
      }
    }
  ?>
  <input type="hidden" name="rg" value="<?php echo $RGCliente;?>"/>
  <input type="hidden" name="quantidade"value="<?php echo $quantidade;?>"/>
  <button type="submit" class="btn btn-primary  btn-lg">
    Confirmar Pedido
  </button>
  
</form>
</div>
</div>
</div><!-- container -->
</div><!-- jumbo -->
</body>
</html>