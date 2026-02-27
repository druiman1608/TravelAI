<h1>Detalles de <?php echo e($location->city); ?></h1>

<?php if($location->image_url): ?>
<img src="<?php echo e($location->image_url); ?>" alt="<?php echo e($location->city); ?>" style="max-width: 300px;">
<?php endif; ?>

<p><strong>Pais:</strong> <?php echo e($location->country); ?></p>
<p><strong>Continente:</strong> <?php echo e($location->continent); ?></p>
<p><strong>Clima:</strong> <?php echo e($location->weather_type); ?></p>
<p><strong>Descripcion:</strong> <?php echo e($location->description); ?></p>

<hr>
<h3>Servicios en la zona:</h3>
<ul>
    <li>Hoteles: <?php echo e($location->hotels->count()); ?></li>
    <li>Actividades: <?php echo e($location->activities->count()); ?></li>
</ul>

<br>
<a href="<?php echo e(route('locations.index')); ?>">Volver</a><?php /**PATH /var/www/resources/views/locations/show.blade.php ENDPATH**/ ?>