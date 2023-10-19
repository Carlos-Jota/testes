<?php
require_once 'classe/ClasseJuros.php';

if(isset($_POST['btn_calcular'])){
    $valor = floatval($_POST['valor']);
    $meses = intval($_POST['meses']);
    $taxa = floatval($_POST['taxa']);
    $aporte = floatval($_POST['aporte']);


    $objJuros = new ClasseJuros();

    $resultado = $objJuros->CalculoJuros($valor, $meses, $taxa, $aporte);

    $aportetotal = $objJuros->AporteTotal($meses, $aporte);

    $totalinvestido = $aportetotal + $valor;

    $totaljuros = $resultado - $aportetotal - $valor;

    if($resultado == 0){
        $msg_error = '<h3 style="color:red;"> <strong>Preencher os campos obrigatórios</strong> </h3>';
    }


}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de juros compostos</title>
</head>
<body style="font-family: Verdana, Geneva, Tahoma, sans-serif;">
    <form action="juros.php" method="post">
        <label>Digite o valor inicial:</label>
        <input name="valor" type="number" value="<?= isset($valor)? $valor : '' ?>">
        <br>
        <label>Digite a quantidade de meses:</label>
        <input name="meses" type="number" value="<?= isset($meses)? $meses : '' ?>">
        <br>
        <label>Digite a taxa de juros Mensal:</label>
        <input name="taxa" type="text" value="<?= isset($taxa)? $taxa : '' ?>">
        <br>
        <label>Digite os aportes mensais (Opcional):</label>
        <input name="aporte" type="number" value="<?= isset($aporte)? $aporte : '' ?>">
        <br><br>
        <button name="btn_calcular">Calcular</button>
    </form>
    <br>
    <span><?= isset($msg_error)? $msg_error : '' ?></span>
    <br>
    <span>Valor do rendimento total em <?= isset($meses)? $meses : '' ?> meses a uma taxa de <?= isset($taxa)? $taxa : '' ?> % ao mes:</span>
    <input disabled value="<?= isset($resultado)? number_format($resultado, 2, '.', '') : '' ?>">
    <br>
    <span>Total investido:</span>
    <input disabled value="<?= isset($totalinvestido)? number_format($totalinvestido, 2, '.', '') : '' ?>">
    <br>
    <span>Valor Total de ganho em juros:</span>
    <input disabled value="<?= isset($totaljuros)? number_format($totaljuros, 2, '.', '') : '' ?>">
</body>
</html>