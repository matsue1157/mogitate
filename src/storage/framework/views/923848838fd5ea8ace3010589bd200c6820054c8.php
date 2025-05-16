<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/show.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container">

    <div class="breadcrumb mb-3">
        <a href="<?php echo e(route('products.index')); ?>">商品一覧</a> &gt;
        <span><?php echo e($product->name); ?></span>
    </div>

    <h2>商品編集</h2>

    
    <form action="<?php echo e(route('products.update', ['product' => $product->id])); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        
        <div class="form-group">
            <label for="name">商品名</label>
            <input type="text" name="name" class="form-control" value="<?php echo e(old('name', $product->name)); ?>">
            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="text-danger"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        
        <div class="form-group">
            <label for="price">値段</label>
            <input type="number" name="price" class="form-control" value="<?php echo e(old('price', $product->price)); ?>">
            <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="text-danger"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        
        <div class="form-group">
            <label>季節</label><br>
            <?php
                $seasons = \App\Models\Season::all();
                $selectedSeasons = old('season_id', $product->seasons->pluck('id')->toArray());
            ?>
            <div class="d-flex flex-wrap gap-3">
                <?php $__currentLoopData = $seasons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $season): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="form-check mr-3">
                        <input class="form-check-input" type="checkbox" name="season_id[]" value="<?php echo e($season->id); ?>"
                            <?php echo e(in_array($season->id, $selectedSeasons) ? 'checked' : ''); ?>>
                        <label class="form-check-label"><?php echo e($season->name); ?></label>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        
        <div class="form-group">
            <label for="image">商品画像</label><br>
            
            <?php if($product->image): ?>
                <img src="<?php echo e(asset('storage/' . $product->image)); ?>" alt="商品画像" style="width:150px; margin-bottom:10px;">
            <?php else: ?>
                <p>画像はまだアップロードされていません</p>
            <?php endif; ?>
            <input type="file" name="image" class="form-control">
            <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="text-danger"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        
        <div class="form-group">
            <label for="description">商品説明</label>
            <textarea name="description" class="form-control" rows="4"><?php echo e(old('description', $product->description)); ?></textarea>
            <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="text-danger"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        
        <div class="form-group mt-4">
            <button type="submit" class="btn btn-primary">変更を保存</button>
            <a href="<?php echo e(route('products.index')); ?>" class="btn btn-secondary">戻る</a>
        </div>
    </form>

    
    <form action="<?php echo e(route('products.destroy', $product->id)); ?>" method="POST" class="position-absolute"
        style="right: 20px; bottom: 20px;">
        <?php echo csrf_field(); ?>
        <?php echo method_field('DELETE'); ?>
        <button type="submit" class="btn btn-danger" onclick="return confirm('本当に削除しますか？')">
            🗑️ 削除
        </button>
    </form>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/products/show.blade.php ENDPATH**/ ?>