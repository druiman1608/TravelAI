<link rel="stylesheet" href="<?php echo e(asset('css/_lists/_list.blade.css')); ?>">

<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <?php if(auth()->user()->isAdmin()): ?> <th>Usuario</th> <?php endif; ?>
            <th>Reserva de </th>
            <th>Precio</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $reservations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td>#<?php echo e($res->id); ?></td>
            <?php if(auth()->user()->isAdmin()): ?> <td><?php echo e($res->user->name); ?></td> <?php endif; ?>
            <td>
                <?php if($res->package_id): ?> Paquete: <?php echo e($res->package->name); ?>

                <?php elseif($res->hotel_id): ?> Hotel: <?php echo e($res->hotel->name); ?>

                <?php elseif($res->flight_id): ?> Vuelo: <?php echo e($res->flight->airline); ?>

                <?php else: ?> Servicio eliminado <?php endif; ?>
            </td>
            <td><?php echo e($res->price); ?>€</td>
            <td>
                <strong><?php echo e($res->status); ?></strong>
            </td>
            <td>
                <a href="<?php echo e(route('reservations.show', $res->id)); ?>">Ver</a>
                | <a href="<?php echo e(route('reservations.edit', $res->id)); ?>">Editar</a> |
                <?php if(auth()->user()->isAdmin()): ?>
                <form action="<?php echo e(route('reservations.destroy', $res->id)); ?>" method="POST" style="display:inline;">
                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                    <button type="submit" onclick="return confirm('¿Cancelar reserva?')">Borrar</button>
                </form>

                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php if($reservations->isEmpty()): ?> <p>No hay reservas registradas.</p> <?php endif; ?><?php /**PATH /var/www/resources/views/reservations/_list.blade.php ENDPATH**/ ?>