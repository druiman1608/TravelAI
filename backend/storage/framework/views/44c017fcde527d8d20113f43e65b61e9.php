<h1>Listado de Reseñas</h1>

<?php if(auth()->user()->isAdmin() || auth()->user()->isMod()): ?>
<p><strong>Moderador:</strong> Tienes permisos para moderar los comentarios de los usuarios.</p>
<?php else: ?>
<p>Tus opiniones sobre nuestros servicios:</p>
<?php endif; ?>

<p><a href="<?php echo e(route('dashboard')); ?>">Volver al Dashboard</a></p>
<p><a href="<?php echo e(route('reviews.create')); ?>">Escribir una nueva reseña</a></p>
<hr>
<br>

<?php echo $__env->make('reviews._list', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/resources/views/reviews/index.blade.php ENDPATH**/ ?>