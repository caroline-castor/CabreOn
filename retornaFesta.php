<?php
include("header.php");
include("conectaBD.php");
$query = sprintf("SELECT * FROM Festa");
// executa a query
$dados = mysql_query($query, $con) or die(mysql_error());
// transforma os dados em um array
$linha = mysql_fetch_assoc($dados);
// calcula quantos dados retornaram
$total = mysql_num_rows($dados);
?>

<html>
	<head>
	<title>Festas</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
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
			<form action="checkout.php?action=checkoutFesta&id=<?php $idFesta=$linha['ID']; echo $idFesta;?>" method=POST>
			<div class="caption">
			<h3><?=$linha['nome'] ?></h3> 
			<p> <span class="glyphicon glyphicon-usd" aria-hidden="true"></span>	Valor R$<?=$linha['valor']?> </p>
			<?php $valor = $linha['valor'];
			?>
			<p>Descrição:  <?=$linha['descricao']?></p> 
			<p>Data: <?=$linha['dataRealizacao']?></p>
			<p>Hora: <?=$linha['hora']?></p>
			<p>Local: <?=$linha['local']?></p>
			<p>Ingressos Disponíveis: <?=$linha['qtdIngressosRestantes']?> </p>
			<p>
			<input type="number" value="1" name="quantidade" min="1" max="<?php 
				//usa a informação das quantidade de ingressos restantes
				$qtdIngressosRestantes=$linha['qtdIngressosRestantes'];
			    echo $qtdIngressosRestantes;
			    ?>"/>
			 
			<input type="submit" value="Comprar"/></p>
			<br><br>
			</form>
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

<a href="index.php">Volta ao inicio</a>
</body>
</html>
<?php
// tira o resultado da busca da memória
mysql_free_result($dados);
?>