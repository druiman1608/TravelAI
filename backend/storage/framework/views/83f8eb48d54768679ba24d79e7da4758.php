<link rel="stylesheet" href="<?php echo e(asset('../../css/_list/_list.blade.css')); ?>">

<table border="1">
    <thead>
        <tr>
            <th>Rating 1-5</th>
            <th>Servicio</th>
            <th>Comentario</th>
            <th>Estado</th>
            <?php if(auth()->user()->isAdmin() || auth()->user()->isMod()): ?>
            <th>Autor</th>
            <?php endif; ?>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($review->rating); ?> / 5</td>
            <td>
                <?php if($review->package): ?> Paquete: <?php echo e($review->package->name); ?>

                <?php elseif($review->hotel): ?> Hotel: <?php echo e($review->hotel->name); ?>

                <?php elseif($review->flight): ?> Vuelo: <?php echo e($review->flight->airline); ?>

                <?php endif; ?>
            </td>
            <td><?php echo e($review->comment); ?></td>
            <td><?php echo e($review->status); ?></td>
            <?php if(auth()->user()->isAdmin() || auth()->user()->isMod()): ?>
            <td><?php echo e($review->user->name); ?></td>
            <?php endif; ?>
            <td>
                <a href="<?php echo e(route('reviews.show', $review->id)); ?>">Ver</a>

                <?php if(auth()->id() == $review->user_id || auth()->user()->isAdmin() || auth()->user()->isMod()): ?>
                | <a href="<?php echo e(route('reviews.edit', $review->id)); ?>">Editar</a>
                <?php endif; ?>

                <?php if(auth()->user()->isAdmin()): ?>
                | <form action="<?php echo e(route('reviews.destroy', $review->id)); ?>" method="POST" style="display:inline;">
                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                    <button type="submit" onclick="return confirm('¿Borrar reseña?')">Eliminar</button>
                </form>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>

<?php if($reviews->isEmpty()): ?>
<p>No hay reseñas publicadas.</p>
<?php endif; ?><?php /**PATH /var/www/resources/views/reviews/_list.blade.php ENDPATH**/ ?>