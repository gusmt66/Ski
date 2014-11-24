<!-- File: /app/View/Users/index.ctp -->

<h1>Users</h1>
<table class="table table-striped">
    <tr>
        <th>Id</th>
        <th>Username</th>
        <th>Created</th>
    </tr>

    <?php foreach ($users as $user): ?>
    <tr>
        <td><?php echo $user['User']['username']; ?></td>
        <td>
            <?php echo $this->Html->link($user['User']['role'],
array('controller' => 'users', 'action' => 'view', $user['User']['id'])); ?>
        </td>
        <td><?php echo $user['User']['created']; ?></td>
    </tr>
    <?php endforeach; ?>
    <?php unset($user); ?>
</table>