<h1>Detalles de la Actividad</h1>

<p><strong>ID:</strong> <?php echo e($activity->id); ?></p>
<p><strong>Nombre:</strong> <?php echo e($activity->name); ?></p>
<p><strong>Ubicacion:</strong> <?php echo e($activity->location->city); ?>, <?php echo e($activity->location->country); ?></p>
<p><strong>Descripcion:</strong> <?php echo e($activity->description); ?></p>
<p><strong>Precio:</strong> <?php echo e($activity->price); ?>€</p>

<br>

<?php if(auth()->user()->isAdmin()): ?>
<a href="<?php echo e(route('activities.edit', $activity->id)); ?>">Editar Actividad</a>
<?php endif; ?>

<br>
<a href="<?php echo e(route('activities.index')); ?>">Volver</a><?php /**PATH /var/www/resources/views/activities/show.blade.php ENDPATH**/ ?>