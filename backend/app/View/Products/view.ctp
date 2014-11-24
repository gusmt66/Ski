<h3>Producto <?php echo h($product['Product']['name']); ?></h3>

<table class="table table-bordered">
    <thead>
        <th colspan="2" class="header_table">Informaci&oacute;n del Producto</th>
    </thead>
    <tbody>
        <tr>
            <td><span class="bold">Nombre</span></td>
            <td><?php echo h($product['Product']['name']); ?></td>
        </tr>
        <tr>
            <td><span class="bold">C&oacute;digo</span></td>
            <td><?php echo h($product['Product']['code']); ?></td>
        </tr>
        <tr>
            <td><span class="bold">Categor&iacute;a</span></td>
            <td><?php echo h($product['Category']['name']); ?></td>
        </tr>
        <tr>
            <td><span class="bold">Imagen</span></td>
            <td><?php echo $this->Html->image($folder . "/" . $product['Product']['filename'], array('fullBase' => true)); ?></td>
        </tr>
    </tbody>
</table>

<p><?php echo $this->Html->link('Volver a la lista de Productos', array('action' => 'index')); ?></p>