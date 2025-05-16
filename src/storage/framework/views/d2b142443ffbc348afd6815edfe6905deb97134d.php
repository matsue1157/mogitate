<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>mogitate</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/common.css')); ?>" />
    <?php echo $__env->yieldContent('css'); ?>
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <a class="header__logo" href="<?php echo e(route('products.index')); ?>">
                mogitate
            </a>
        </div>
    </header>
    <main>
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>

</html><?php /**PATH /var/www/resources/views/layouts/app.blade.php ENDPATH**/ ?>