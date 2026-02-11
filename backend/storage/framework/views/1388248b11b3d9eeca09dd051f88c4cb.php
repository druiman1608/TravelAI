<h1>Dashboard:</h1>
<h2>Bienvenido, <?php echo e(auth()->user()->name); ?></h2>

<?php if(auth()->user()->isAdmin()): ?>
<h3>Ultimos hoteles registrados</h3>
<table border="1">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Ubicacion</th>
        </tr>
    </thead>
    <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $data['hotels']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hotel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
            <td><?php echo e($hotel->name); ?></td>
            <td><?php echo e($hotel->location->city ?? 'Sin ubicacion'); ?></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr>
            <td colspan="2">No se encontraron hoteles.</td>
        </tr>
        <?php endif; ?>
    </tbody>
</table>

<h3>Ultimos vuelos registrados</h3>
<table border="1">
    <thead>
        <tr>
            <th>Origen</th>
            <th>Destino</th>
        </tr>
    </thead>
    <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $data['flights']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $flight): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
            <td>Ciudad: <?php echo e($flight->origin); ?></td>
            <td>Ciudad: <?php echo e($flight->location->city); ?> | Pais: <?php echo e($flight->location->country); ?></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr>
            <td colspan="2">No se encontraron vuelos.</td>
        </tr>
        <?php endif; ?>
    </tbody>
</table>

<h3>Ultimos paquetes registrados</h3>
<table border="1">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Precio</th>
        </tr>
    </thead>
    <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $data['packages']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
            <td><?php echo e($package->name); ?></td>
            <td><?php echo e($package->total_price); ?></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr>
            <td colspan="2">No se encontraron paquetes.</td>
        </tr>
        <?php endif; ?>
    </tbody>
</table>

<h3>Ultimas actividades registradas</h3>
<table border="1">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Descripcion</th>
            <th>Precio</th>
        </tr>
    </thead>
    <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $data['activities']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
            <td><?php echo e($activity->name); ?></td>
            <td><?php echo e($activity->description); ?></td>
            <td><?php echo e($activity->price); ?></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr>
            <td colspan="3">No se encontraron actividades.</td>
        </tr>
        <?php endif; ?>
    </tbody>
</table>

<h3>Ultimos usuarios registrados</h3>
<table border="1">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Email</th>
            <th>Rol</th>
        </tr>
    </thead>
    <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $data['users']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
            <td><?php echo e($user->name); ?></td>
            <td><?php echo e($user->email); ?></td>
            <td><?php echo e($user->role->name ?? 'ID: ' . $user->role_id); ?></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr>
            <td colspan="3">No hay usuarios registrados.</td>
        </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php else: ?>

<h3>Hoteles:</h3>
<table border="1">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Ubicacion</th>
        </tr>
    </thead>
    <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $data['hotels']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hotel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
            <td><?php echo e($hotel->name); ?></td>
            <td><?php echo e($hotel->location->city ?? 'Sin ubicacion'); ?></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr>
            <td colspan="2">No hay hoteles disponibles.</td>
        </tr>
        <?php endif; ?>
    </tbody>
</table>

<h3>Vuelos:</h3>
<table border="1">
    <thead>
        <tr>
            <th>Origen</th>
            <th>Destino</th>
        </tr>
    </thead>
    <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $data['flights']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $flight): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
            <td>Ciudad: <?php echo e($flight->origin); ?></td>
            <td>Ciudad: <?php echo e($flight->location->city); ?> | Pais: <?php echo e($flight->location->country); ?></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr>
            <td colspan="2">No hay vuelos disponibles.</td>
        </tr>
        <?php endif; ?>
    </tbody>
</table>

<h3>Paquetes:</h3>
<table border="1">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Precio</th>
        </tr>
    </thead>
    <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $data['packages']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
            <td><?php echo e($package->name); ?></td>
            <td><?php echo e($package->total_price); ?></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr>
            <td colspan="2">No hay paquetes disponibles.</td>
        </tr>
        <?php endif; ?>
    </tbody>
</table>

<h3>Actividades:</h3>
<table border="1">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Descripcion</th>
            <th>Precio</th>
        </tr>
    </thead>
    <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $data['activities']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
            <td><?php echo e($activity->name); ?></td>
            <td><?php echo e($activity->description); ?></td>
            <td><?php echo e($activity->price); ?></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr>
            <td colspan="3">No hay actividades disponibles.</td>
        </tr>
        <?php endif; ?>
    </tbody>
</table>

<h3>Mis reservas</h3>
<table border="1">
    <thead>
        <tr>
            <th>Estado</th>
            <th>Precio</th>
        </tr>
    </thead>
    <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $data['reservations']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reservation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
            <td><?php echo e($reservation->status); ?></td>
            <td><?php echo e($reservation->price); ?>€</td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr>
            <td colspan="2">No tienes reservas.</td>
        </tr>
        <?php endif; ?>
    </tbody>
</table>

<h3>Mis Chats</h3>
<table border="1">
    <thead>
        <tr>
            <th>Pregunta</th>
            <th>Respuesta</th>
        </tr>
    </thead>
    <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $data['aichatlogs']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $aichatlog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
            <td><?php echo e($aichatlog->user_question); ?></td>
            <td><?php echo e($aichatlog->ai_answer); ?></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr>
            <td colspan="2">No hay historial de chats.</td>
        </tr>
        <?php endif; ?>
    </tbody>
</table>
<?php endif; ?>

<br>
<form action="<?php echo e(route('logout')); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <button type="submit">Cerrar Sesion</button>
</form><?php /**PATH /var/www/resources/views/dashboard/index.blade.php ENDPATH**/ ?>