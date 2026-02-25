<h1>Dashboard</h1>
<p>Bienvenido, <?php echo e(auth()->user()->name); ?></p>

<hr>

<h3>Navegacion</h3>
<ul>
    <li><a href="<?php echo e(route('reservations.index')); ?>">Mis Reservas</a></li>
    <li>
        <a href="<?php echo e(route('reviews.index')); ?>">
            Reseñas <?php if(auth()->user()->isMod()): ?> (Moderacion) <?php endif; ?>
        </a>
    </li>

    <?php if(auth()->user()->isAdmin()): ?>
    <br>
    <li><strong>Administracion Global:</strong></li>
    <li><a href="<?php echo e(route('hotels.index')); ?>">Gestionar Hoteles</a></li>
    <li><a href="<?php echo e(route('flights.index')); ?>">Gestionar Vuelos</a></li>
    <li><a href="<?php echo e(route('packages.index')); ?>">Gestionar Paquetes</a></li>
    <li><a href="<?php echo e(route('activities.index')); ?>">Gestionar Actividades</a></li>
    <li><a href="<?php echo e(route('users.index')); ?>">Gestionar Usuarios</a></li>
    <?php endif; ?>
</ul>

<hr>

<?php if(auth()->user()->isAdmin()): ?>
<h3>Ultimos Usuarios Registrados</h3>
<table border="1">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $data['users']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
            <td><?php echo e($u->name); ?></td>
            <td><?php echo e($u->email); ?></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr>
            <td colspan="2">No hay usuarios nuevos.</td>
        </tr>
        <?php endif; ?>
    </tbody>
</table>
<?php endif; ?>

<h3>Ofertas</h3>
<table border="1">
    <thead>
        <tr>
            <th>Servicio</th>
            <th>Detalles</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $data['packages']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td>Paquete: <?php echo e($p->name); ?></td>
            <td><?php echo e($p->total_price); ?>€</td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php $__currentLoopData = $data['hotels']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $h): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td>Hotel: <?php echo e($h->name); ?></td>
            <td><?php echo e($h->location->city ?? 'N/A'); ?></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>

<h3>Resumen Reservas</h3>
<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Estado</th>
            <th>Precio</th>
        </tr>
    </thead>
    <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $data['reservations']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
            <td>#<?php echo e($res->id); ?></td>
            <td><?php echo e($res->status); ?></td>
            <td><?php echo e($res->price); ?>€</td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr>
            <td colspan="3">No tienes reservas registradas.</td>
        </tr>
        <?php endif; ?>
    </tbody>
</table>

<br>

<form action="<?php echo e(route('logout')); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <button type="submit">Cerrar Sesion</button>
</form><?php /**PATH /var/www/resources/views/dashboard/index.blade.php ENDPATH**/ ?>