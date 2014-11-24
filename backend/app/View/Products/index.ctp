<h3>Productos</h3>

<div>
    <div class="left">
        <p><?php echo $this->Html->link('Agregar Producto', array('action' => 'add')); ?></p>
    </div>

    <div class="right">
        <?php echo $this->Form->create(array('action' => 'index', 'class'=>'margin-bottom-small'));?> 
        <input type="search" name="searcher" id="searcher">
        <input name="submit" class="btn btn-primary margin-bottom-small" type="submit" value="Buscar">
        <?php echo $this->Form->end();?>
    </div>
</div>

<table class="table table-hover big_table">
    <tr>
        <th><?php echo $this->paginator->sort('name', 'Nombre'); ?></th>
        <th><?php echo $this->paginator->sort('code', 'Código'); ?></th>
        <th><?php echo $this->paginator->sort('Category.name', 'Categoría'); ?></th>
        <th>Acciones</th>
    </tr>

    <?php foreach ($products as $product): ?>
    <tr>
        <td>
            <?php echo $product['Product']['name'] ?>
        </td>
        <td><?php echo $product['Product']['code']; ?></td>
        <td><?php echo $product['Category']['name']; ?></td>
        <td>

            <?php echo $this->Html->link('Ver', array('action' => 'view', $product['Product']['id']), array('class'=>'magin-right-small')); ?>

            <?php echo $this->Html->link('Editar', array('action' => 'edit', $product['Product']['id']), array('class'=>'magin-right-small')); ?>

            <?php echo $this->Form->postLink(
                'Eliminar',
                array('action' => 'delete', $product['Product']['id']),
                array('confirm' => 'Seguro que desea eliminar este producto?'));
            ?>
 
        </td>
    </tr>
    <?php endforeach; ?>

</table>

<div class="center-text">
    <?php  echo $this->paginator->prev('« Anterior ', null, null, array('class' => 'disabled')); ?> 
    <span class='margin-left-small margin-right-small'><?php echo $this->paginator->counter(array('format' => '%page% de %pages%'));?></span>
    <?php echo $this->paginator->next(' Siguiente »', null, null, array('class' => 'disabled'));    ?>
</div>

