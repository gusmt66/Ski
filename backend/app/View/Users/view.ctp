<!-- File: /app/View/Users/view.ctp -->

<h1>Usuarios</h1>

<h3>Usuario: <?php echo h($user['User']['username']); ?></h3>

<p><small>Creado el: <?php echo $user['User']['created']; ?></small></p>

<p> Rol: <?php echo h($user['User']['role']); ?></p>