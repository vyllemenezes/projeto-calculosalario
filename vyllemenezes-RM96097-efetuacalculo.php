<?php
include "./vyllemenezes-RM96097-calculosalario.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Calculadora do salário líquido </title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
  <link rel="stylesheet" href="./styles.css">
</head>
<body>
  <div class="container">
      <ul>
        <li><a href="#">Home</a></li>
        <li><a href="https://play.google.com/store/apps/details?id=br.gov.meugovbr&hl=en_US&pli=1">APP</a></li> 
        <li><a href="https://www.gov.br/receitafederal/pt-br/assuntos/orientacao-tributaria/tributos/IRRF">IRRF</a></li>
        <li><a href="https://www.gov.br/pt-br">Portal Gov.br</a></li>
      </ul>

  </div>
  <div class="container2">
  <div class="calculadora">
    <form method="post">
        
        <div class="form">
        <label for="salarioBruto" class="form-label p-0"> <h5>Salario bruto</h5></label>
        <input type="number" step="0.01" class="form-control" id="bruto" name="bruto" required>
        </div>
        <div class="form">
        <label for="numeroDependentes" class="form-label p-0"><h5>Numero de dependentes</h5> </label>
        <input type="number" class="form-control" id="dependentes" name="dependentes">
        </div>
        <button type="submit" class="btn btn-primary "> Calcular <i class="bi bi-arrow-right"></i></button>
      </form>

  </div>
  <div class="resultado">
    <?php
              function handleFormatAmount($amount) {
                return number_format($amount, 2, ",", ".");
              }

              if (isset($_POST['bruto']) && isset($_POST['dependentes'])) {
                $salario_bruto = $_POST['bruto'];
                $numeroDependentes = $_POST['dependentes'];

                $salaryController = new SalaryController();

                [$recolher, $valor_base_1, $valor_base_2, $IRRF, $salario_liquido] = $salaryController->calcularINSS($salario_bruto, $numeroDependentes);
              }

    ?>

    <div>
        <div class="result-container mt-5 mb-5 rounded">
     
            <h5>Salario bruto</h5>
            <span class="text"> R$ <?php if (isset($salario_bruto)) {echo handleFormatAmount($salario_bruto);}else{echo "0,00";}?></span>
     

            <h5>INSS </h5>
            <span class="text"> R$ <?php if (isset($recolher,)) {echo handleFormatAmount($recolher);}else{echo "0,00";}?></span>
       
            <h5>Valor Base 1</h5>
            <span class="text"> R$ <?php if (isset($valor_base_1)) {echo handleFormatAmount($valor_base_1);}else{echo "0,00";}?></span>
         
            <h5>Valor Base 2</h5>
            <span class="text"> R$ <?php if (isset($valor_base_2)) {echo handleFormatAmount($valor_base_2);}else{echo "0,00";}?></span>
        
            <h5>IRRF</h5>
            <span class="text"> R$ <?php if (isset($IRRF)) {echo handleFormatAmount($IRRF);} else{echo "0,00";}?></span>
      
            <h5>Salário liquido</h5>
            <span class="text"> R$ <?php if (isset($salario_liquido)) {echo handleFormatAmount($salario_liquido);}else{echo "0,00";}?></span>
      
        </div>
      </div>

  </div>
</div>
</body>
</html>
