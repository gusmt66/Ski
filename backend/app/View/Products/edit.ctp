<div class="form">
<?php echo $this->Form->create('Product', array('type'=>'file')); ?>

    <fieldset>
    <legend>Editar Producto</legend>
        <?php echo $this->Form->input('id', array('type'=>'hidden'));?>
    	<?php echo $this->Form->input('name', array('label'=>'Nombre'));?>
    	<?php echo $this->Form->input('code', array('label'=>'Código'));?>
    	<?php echo $this->Form->input('category_id', array('label'=>'Categoria', 'type' => 'select', 'options' => $category, 'empty' => 'Seleccione..'));?>

		<?php echo $this->Html->image($folder . "/" . $product['Product']['filename'], array('fullBase' => true)); ?>

    	<?php echo $this->Form->input('filename', array('label'=>'Imagen', 'type'=>'file', 'escape'=>false))?>

    </fieldset>

	<?php 
		echo $this->Form->submit('Guardar', array('name'=>'submit', 'class'=>'btn btn-primary margin-top-medium', 'type'=>'submit')); 
	?>
</div>

<p><?php echo $this->Html->link('Volver a la lista de Productos', array('action' => 'index')); ?></p>