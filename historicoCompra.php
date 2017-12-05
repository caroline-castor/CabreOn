<?php

include("header.php");
include ("conectaBD.php");


session_start();
 if(isset($_SESSION["login"])){ 
	$usuario = $_SESSION['login'];
 }
 
// buscar o id do usuario
$query = sprintf("SELECT RG FROM Cliente where apelido='$usuario';");
// executa a query
$dados = mysql_query($query, $con) or die(mysql_error());
// transforma os dados em um array
$linha = mysql_fetch_row($dados);
if(mysql_num_rows($dados)>0){
	$RGCliente=$linha[0];
	//busca as festas do usuario
	$query = sprintf("SELECT CC.ID_Festa as ID_Festa, F.nome as nome, F.valor as valor, F.dataRealizacao as dataRealizacao, F.foto as foto, F.hora as hora, F.local as local FROM Festa F,Compra_Festa CC where CC.ID_Festa=F.ID AND RG_Cliente='$RGCliente'");
	// executa a query
	$dados = mysql_query($query, $con) or die(mysql_error());
	// transforma os dados em um array
	$linha = mysql_fetch_assoc($dados);
	$total = mysql_num_rows($dados);
	//busca os eventos do usuario
	$query2 = sprintf("SELECT CE.ID_Evento as ID_Evento, E.nome as nome, E.valor as valor, E.dataRealizacao as dataRealizacao, E.foto as foto, E.hora as hora, E.local as local FROM Evento E,Compra_Evento CE where CE.ID_Evento=E.ID AND RG_Cliente='$RGCliente'");
	// executa a query
	$dados2 = mysql_query($query2, $con) or die(mysql_error());
	// transforma os dados em um array
	$linha2 = mysql_fetch_assoc($dados2);
	$total2 = mysql_num_rows($dados2);
	
}

?>

<html>
	<head>
	<title>Historico de Compras</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php
	// se o número de resultados for maior que zero, mostra os dados
	if($total > 0) {
		
		// inicia o loop que vai mostrar todos os dados
		do {
?>			<div class="row">
    		<div class="thumbnail">
    		 <div class="col-sm-3">
    		<div class='centralizaImagem'>
    		<img src="<?=$linha['foto']?>" heigth="300px" width="300px">
    		</div>
    		</div>
    		 <div class="col-sm-9">
			<div class="caption">
			<h3><?=$linha['nome'] ?></h3> 
			<p> <span class="glyphicon glyphicon-usd" aria-hidden="true"></span>	Valor R$<?=$linha['valor']?> </p>
			<?php $valor = $linha['valor'];
			?>
			<p>Data: <?=$linha['dataRealizacao']?></p>
			<p>Hora: <?=$linha['hora']?></p>
			<p>Local: <?=$linha['local']?></p>
			
			<br><br>
			
			</div>
			</div>
			</div>
			</div>
		
<?php
		// finaliza o loop que vai mostrar os dados
		}while($linha = mysql_fetch_assoc($dados));
	// fim do if 
	}
?>

<?php
	// se o número de resultados for maior que zero, mostra os dados
	if($total2 > 0) {
		
		// inicia o loop que vai mostrar todos os dados
		do {
?>			<div class="row">
    		<div class="thumbnail">
    		 <div class="col-sm-3">
    		<div class='centralizaImagem'>
    		<img src="<?=$linha2['foto']?>" heigth="300px" width="300px">
    		</div>
    		</div>
    		 <div class="col-sm-9">
			<div class="caption">
			<h3><?=$linha2['nome'] ?></h3> 
			<p> <span class="glyphicon glyphicon-usd" aria-hidden="true"></span>	Valor R$<?=$linha2['valor']?> </p>
			<?php $valor = $linha2['valor'];
			?>
			<p>Data: <?=$linha2['dataRealizacao']?></p>
			<p>Hora: <?=$linha2['hora']?></p>
			<p>Local: <?=$linha2['local']?></p>
			
			<br><br>
			
			</div>
			</div>
			</div>
			</div>
		
<?php
		// finaliza o loop que vai mostrar os dados
		}while($linha2 = mysql_fetch_assoc($dados2));
	// fim do if 
	}
	
	if($total==0 && $total2==0){
		?>
			<div class="container">
				<div class="panel panel-default">
 				 <div class="panel-body">
					<h3>Não há histórico de compras!</h3>
					</div>
				</div>
			</div>
		<?php
	}
?>
<a href="index.php">Volta ao inicio</a>
</body>
</html>
<?php
// tira o resultado da busca da memória
mysql_free_result($dados);
?>