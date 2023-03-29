<?php

class SalaryController{
function calcularINSS($valorBruto, $dependente){

    $tab_desconto = [0.075 , 0.09 , 0.12, 0.14];
    $tab_salario = [1302, 2571.29, 3856.94, 7507.49];
    $inss = 0;

    if($valorBruto <= $tab_salario[0]){$desconto = 1;}
    else if($valorBruto <= $tab_salario[1]){$desconto = 2;}
    else if($valorBruto <= $tab_salario[2]){$desconto = 3;}
    else if($valorBruto <= $tab_salario[3]){$desconto = 4;}
    else{$desconto = 5;}
    
    
    switch ($desconto){
        case 0:
            break;
        case 1:
            $inss = $valorBruto * $tab_desconto[0];
            break;
        case 2:
            $inss = (($valorBruto - $tab_salario[0]) * $tab_desconto[1]) + 97.65;
            break;
        case 3:
            $inss = (($valorBruto - $tab_salario[1]) * $tab_desconto[2]) + 211.88;
            break;
        case 4:
            $inss = (($valorBruto - $tab_salario[2]) * $tab_desconto[3]) + 366.15;
            break;
        case 5:
            $inss = 877.24;
            break;
    }

    function calculaIRRF($valorBruto, $inss, $dependente){

        $valor_base_1 = $valorBruto - $inss;
        if($dependente != null){
        $tab_dependente = 189.59 * $dependente;
        $valor_base_2 = $valor_base_1 - $tab_dependente; 
        }else{
        $valor_base_2 = $valor_base_1; 
        }
        $IRRF = 0;

        $calculo_mensal = [1903.98, 2826.65, 3751.05, 4664.68];
        $tab_aliquota = [0.075, 0.15, 0.225, 0.275];
        $tab_deducao = [142.80, 354.80, 636.13, 869.36];

        if($valor_base_2 <= $calculo_mensal[0]){$opcao = 0;}
        else if($valor_base_2 <= $calculo_mensal[1]){$opcao = 1;}
        else if($valor_base_2 <= $calculo_mensal[2]){$opcao = 2;}
        else if($valor_base_2 <= $calculo_mensal[3]){$opcao = 3;}
        else{$opcao = 4;}

        switch($opcao){
            case 0:
                $IRRF = 0;
                break;
            case 1:
                $IRRF = (($valor_base_2 * $tab_aliquota[0]) - $tab_deducao[0]);
                break;
            case 2:
                $IRRF = (($valor_base_2 * $tab_aliquota[1]) - $tab_deducao[1]);
                break;
            case 3:
                $IRRF = (($valor_base_2 * $tab_aliquota[2]) - $tab_deducao[2]);
                break;  
            case 4:
                $IRRF = (($valor_base_2 * $tab_aliquota[3]) - $tab_deducao[3]);
                break;
                

        }
        
         return [$valor_base_1, $valor_base_2, $IRRF];
    }
    [$valor_base_1, $valor_base_2, $IRRF] = calculaIRRF($valorBruto, $inss, $dependente);
    $salario_liquido = $valorBruto - $IRRF - $inss;
    return [$inss, $valor_base_1, $valor_base_2, $IRRF, $salario_liquido];
}
}
?>