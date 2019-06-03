<?php
ob_start();
?>
<img src="assets/img/logo.png" style="position: absolute;left:2;top:2;" width="100">
<h2 style="">Relatório de vendas FlipFlop. Emitido em <?php echo date("d/m/Y") ?></h2>
<table border="1" style="border-collapse: none; " width="100%">
    <tr>
        <th>ID Pedido</th>
        <th>Nome Cliente</th>
        <th>Valor total</th>
        <th>Nome atendente</th>
        <th>Data Pedido</th>
    </tr>
    <?php foreach ($pedidos as $pedido) : ?>
        <tr style="">
            <td style="padding:5px;"><?php echo $pedido['id_pedido'] ?></td>
            <td><?php echo $pedido['nome_cliente'] ?></td>
            <td><?php echo "R$ ".$pedido['valor_total'] ?></td>
            <td><?php echo $pedido['nome'] ?></td>
            <td><?php echo date("d/m/Y", strtotime($pedido['data_pedido'])) ?></td>
        </tr>
    <?php endforeach; ?>
</table>
<?php
require "vendor/autoload.php";

$mpdf = new \Mpdf\Mpdf();
$html = ob_get_contents();
ob_end_clean();

$mpdf->WriteHTML($html);
$mpdf->Output();
?>