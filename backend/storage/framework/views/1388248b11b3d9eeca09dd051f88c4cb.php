<link rel="stylesheet" href="<?php echo e(asset('css/dashboard.css')); ?>">

<div class="dashboard-container">
    <h1>Dashboard</h1>
    <p>Bienvenido, <strong><?php echo e(auth()->user()->name); ?></strong>
        <?php if(auth()->user()->isPremium()): ?> <span style="color: gold; font-weight: bold;"> [PREMIUM]</span> <?php endif; ?>
        <?php if(auth()->user()->isMod()): ?> <span style="color: #0275d8; font-weight: bold;"> [MODERADOR]</span> <?php endif; ?>
    </p>

    <hr class="hr-divider">

    <?php if(auth()->user()->isAdmin()): ?>
    <div class="admin-panel"
        style="background-color: #fff5f5; padding: 20px; border-radius: 8px; border: 1px solid #feb2b2; margin-bottom: 20px;">
        <h4 style="color: #c53030; margin-top: 0;">Panel de Administracion</h4>
        <div class="nav-menu">
            <a href="<?php echo e(route('users.index')); ?>" class="btn btn-danger">Gestionar Usuarios</a>
            <a href="<?php echo e(route('locations.index')); ?>" class="btn btn-primary">Gestionar Localizaciones</a>
            <a href="<?php echo e(route('hotels.index')); ?>" class="btn btn-secondary">Gestionar Hoteles</a>
            <a href="<?php echo e(route('flights.index')); ?>" class="btn btn-secondary">Gestionar Vuelos</a>
            <a href="<?php echo e(route('activities.index')); ?>" class="btn btn-secondary">Gestionar Actividades</a>
            <a href="<?php echo e(route('packages.index')); ?>" class="btn btn-secondary">Gestionar Paquetes</a>
            <a href="<?php echo e(route('reservations.index')); ?>" class="btn btn-secondary">Gestionar Reservas</a>
            <a href="<?php echo e(route('reviews.index')); ?>" class="btn btn-purple">Gestionar Reseñas</a>
            <a href="<?php echo e(route('aichatlogs.index')); ?>" class="btn btn-outline">Gestionar Logs IA</a>
        </div>
    </div>
    <?php endif; ?>

    <?php if(auth()->user()->isMod()): ?>
    <div class="mod-panel"
        style="background-color: #ebf8ff; padding: 20px; border-radius: 8px; border: 1px solid #bee3f8; margin-bottom: 20px;">
        <h4 style="color: #2b6cb0; margin-top: 0;">Panel de Moderacion</h4>
        <div class="nav-menu">
            <a href="<?php echo e(route('reviews.index')); ?>" class="btn btn-primary">Gestionar todas las Reseñas</a>
            <p style="font-size: 0.9em; color: #4a5568; margin-top: 10px;">Tienes permisos para aprobar o rechazar
                comentarios de usuarios.</p>
        </div>
    </div>
    <?php endif; ?>


    <?php if(!auth()->user()->isAdmin() && !auth()->user()->isMod()): ?>

    <h3>Explorar Catalogo</h3>
    <div class="catalog-menu">
        <a href="<?php echo e(route('hotels.index')); ?>" class="btn-catalog border-hotels">Ver Hoteles</a>
        <a href="<?php echo e(route('flights.index')); ?>" class="btn-catalog border-flights">Ver Vuelos</a>
        <a href="<?php echo e(route('packages.index')); ?>" class="btn-catalog border-packages">Ver Paquetes</a>
        <a href="<?php echo e(route('activities.index')); ?>" class="btn-catalog border-activities">Ver Actividades</a>
    </div>

    <h3>Mis Gestiones</h3>
    <div class="nav-menu">
        <a href="<?php echo e(route('reservations.index')); ?>" class="btn btn-primary">Mis Reservas</a>
        <a href="<?php echo e(route('reservations.create')); ?>" class="btn btn-success">Nueva Reserva</a>
        <a href="<?php echo e(route('reviews.index')); ?>" class="btn btn-secondary">Mis Reseñas</a>
        <a href="<?php echo e(route('reviews.create')); ?>" class="btn btn-purple">Escribir Reseña</a>
        <a href="<?php echo e(route('userPreferences.index')); ?>" class="btn btn-outline">Mis Preferencias</a>

        <?php if(auth()->user()->isPremium()): ?>
        <a href="<?php echo e(route('aichatlogs.create')); ?>" class="btn btn-gold"
            style="background-color: #ffd700; color: black; font-weight: bold;">Preguntar a IA</a>
        <a href="<?php echo e(route('aichatlogs.index')); ?>" class="btn btn-outline">Historial IA</a>
        <?php endif; ?>
    </div>

    <hr class="hr-divider">

    <h3>Ofertas destacadas</h3>
    <div class="offers-grid">
        <?php $__empty_1 = true; $__currentLoopData = $data['packages']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="card">
            <span class="badge badge-success">Ofertas</span>
            <h4><?php echo e($package->name); ?></h4>
            <p class="card-price"><?php echo e(number_format($package->total_price, 2)); ?>€</p>
            <a href="<?php echo e(route('packages.show', $package->id)); ?>">Ver detalles</a>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <p>No hay paquetes disponibles en este momento.</p>
        <?php endif; ?>
    </div>

    <h3>Mis ultimas reservas</h3>
    <table class="data-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Estado</th>
                <th>Precio Total</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $data['reservations']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td>#<?php echo e($res->id); ?></td>
                <td>
                    <span
                        class="badge <?php echo e($res->status == 'confirmada' ? 'badge-success' : ($res->status == 'cancelada' ? 'badge-danger' : 'badge-warning')); ?>">
                        <?php echo e(ucfirst($res->status)); ?>

                    </span>
                </td>
                <td><strong><?php echo e(number_format($res->price, 2)); ?>€</strong></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="3">Aun no has realizado ninguna reserva.</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <?php endif; ?>

    <br>
    <hr>
    <br>

    <form action="<?php echo e(route('logout')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <button type="submit" class="btn btn-danger" style="width: 100%; padding: 10px;">Cerrar Sesión</button>
    </form>
</div><?php /**PATH /var/www/resources/views/dashboard/index.blade.php ENDPATH**/ ?>