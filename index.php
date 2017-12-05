<?php include 'header.php'; 
include ("conectaBD.php");
?>


<html>
    <head>
        <link rel="stylesheet" href="css/bootstrap.min.css">
    </head>
    <body>
        
        <?php 
        
                if($_REQUEST['action']=='sucessCadastro'){
                ?>
                    <div class="alert alert-sucess" role="alert">
                    Cadastrado com Sucesso!
                    </div>
                <?php
                }
                if($_REQUEST['action']=='confirma'){
                    
                    $RGCliente = $_POST['rg'];
                    $idFesta = $_POST['idFesta'];
                    $quantidade = $_POST['quantidade'];
                    
                     //agora, insere na tabela Compra_Cliente
                     $query = sprintf("INSERT INTO Compra_Festa(RG_Cliente,ID_Festa,qtdIngressos) VALUES ('$RGCliente',$idFesta,$quantidade);");
                    // executa a query
                    $dados = mysql_query($query, $con) or die(mysql_error());
                    //atualiza a quantidade de ingressos
                    $query = sprintf("UPDATE Festa SET qtdIngressosRestantes=qtdIngressosRestantes-1 WHERE ID=$idFesta;");
                    // executa a query
                    $dados = mysql_query($query, $con) or die(mysql_error());  ?>
                    <div class="alert alert-success" role="alert">
                        Compra Efetuada com sucesso!
                    </div>
                    <?php
                }else{
                    if($_REQUEST['action']=='confirmaEvento'){
                        $RGCliente = $_POST['rg'];
                    $idEvento = $_POST['idEvento'];
                    $quantidade = $_POST['quantidade'];
                    
                     //agora, insere na tabela Compra_Cliente
                     $query = sprintf("INSERT INTO Compra_Evento(RG_Cliente,ID_Evento,qtdIngressos) VALUES ('$RGCliente',$idEvento,$quantidade);");
                    // executa a query
                    $dados = mysql_query($query, $con) or die(mysql_error());
                    //atualiza a quantidade de ingressos
                    $query = sprintf("UPDATE Evento SET qtdIngressosRestantes=qtdIngressosRestantes-1 WHERE ID=$idEvento;");
                    // executa a query
                    $dados = mysql_query($query, $con) or die(mysql_error());  ?>
                    <div class="alert alert-success" role="alert">
                        Compra Efetuada com sucesso!
                    </div>
                    <?php
                    }
                }
            ?>
                
     
<?php
    $query = sprintf("SELECT * FROM Festa");
    // executa a query
    $dados = mysql_query($query, $con) or die(mysql_error());
    $linha2= mysql_fetch_row($dados);
    // transforma os dados em um array
    $linha = mysql_fetch_assoc($dados);
    // calcula quantos dados retornaram
    $total = mysql_num_rows($dados);
    $query2 = sprintf("SELECT * FROM Evento");
    // executa a query
    $dados2 = mysql_query($query2, $con) or die(mysql_error());
    // transforma os dados em um array
    $linha3 = mysql_fetch_assoc($dados2);
    // calcula quantos dados retornaram
    $total2 = mysql_num_rows($dados2);
	// se o número de resultados for maior que zero, mostra os dados
	if($total > 0) {
	?>	
	
  <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
     <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
     
    <?php 
    $i=1;
    while($i<$total){?>
    <li data-target="#carousel-example-generic" data-slide-to="<?php echo $i; ?>"></li>
   <?php $i++;}
      $j=$total;
      $i=0;
      while($i<$total2){?>
          <li data-target="#carousel-example-generic" data-slide-to="<?php echo $j; ?>"></li>
      <?php
          $i++;
          $j++;
      }
   ?>
   
  </ol>
 
  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item active">
     <img src="<?=$linha2[9] ?>" alt="...">
      <div class="carousel-caption">
      	<h3><?php echo $linha2[1]; ?></h3>
      </div>
    </div>
    <?php
        // inicia o loop que vai mostrar todos os dados
		do {?>
	
    <div class="item">
      <img src="<?=$linha['foto']?>" alt="...">
      <div class="carousel-caption">
      	<h3><?php echo $linha['nome']; ?></h3>
      </div>
    </div>
 <?php
		// finaliza o loop que vai mostrar os dados
		}while($linha = mysql_fetch_assoc($dados));
	// fim do if 
	}
	    // inicia o loop que vai mostrar todos os dados
		do {?>
    <div class="item">
      <img src="<?=$linha3['foto']?>" alt="...">
      <div class="carousel-caption">
      	<h3><?php echo $linha3['nome']; ?></h3>
      </div>
    </div>
 <?php
		// finaliza o loop que vai mostrar os dados
		}while($linha3 = mysql_fetch_assoc($dados2));
	?>
  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
  </a>
  <script type="text/javascript">
    </script>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</div> <!-- Carousel -->
    		
 </body>
 </html>
		

