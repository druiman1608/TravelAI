<h1>Detalles del paquete: <?php echo e($package->name); ?></h1>

<div style="border: 1px solid #ccc; padding: 20px; border-radius: 8px;">
    <h3>Este paquete incluye:</h3>
    <ul>
        <?php if($package->hotel): ?>
        <li><strong>Hotel:</strong> <?php echo e($package->hotel->name); ?> (<?php echo e($package->hotel->location->city); ?>)</li>
        <?php endif; ?>

        <?php if($package->flight): ?>
        <li><strong>Vuelo:</strong> <?php echo e($package->flight->airline); ?> (<?php echo e($package->flight->origin); ?> a
            <?php echo e($package->flight->location->city); ?>)
        </li>
        <?php endif; ?>

        <?php if($package->activity): ?>
        <li><strong>Actividad:</strong> <?php echo e($package->activity->name); ?> en <?php echo e($package->activity->location->city); ?></li>
        <?php endif; ?>
    </ul>

    <hr>
    <h2>Precio final: <?php echo e($package->total_price); ?>€</h2>

    <?php if(!auth()->user()->isAdmin()): ?>
    <form action="<?php echo e(route('reservations.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="package_id" value="<?php echo e($package->id); ?>">
        <button type="submit"
            style="background-color: #28a745; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
            Reservar
        </button>
    </form>
    <?php else: ?>
    <p><a href="<?php echo e(route('packages.edit', $package->id)); ?>">Modificar paquete</a></p>
    <?php endif; ?>
</div>

<br>
<a href="<?php echo e(route('packages.index')); ?>">Volver</a><?php /**PATH /var/www/resources/views/packages/show.blade.php ENDPATH**/ ?>