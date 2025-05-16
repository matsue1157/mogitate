<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/index.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- 全体を囲むラッパークラス -->
    <div class="product-wrapper">

        <div class="product-index__header">
            <h1 class="product-index__title">商品一覧</h1>
            <div class="product-index__add-button">
                <a href="<?php echo e(route('products.create')); ?>" class="button-add">＋ 商品を追加</a>
            </div>
        </div>

        
        <div class="product-index__main">
            <div class="product-index__sidebar">
                <form class="product-index__search-form" method="GET" action="<?php echo e(route('products.index')); ?>">
                    <input type="text" name="keyword" class="product-index__search-input" placeholder="商品名で検索"
                        value="<?php echo e(request('keyword')); ?>">
                    <button type="submit" class="product-index__search-button">検索</button>
                </form>

                
                <form action="<?php echo e(route('products.index')); ?>" method="GET" class="product-index__sort-form">
                    <select name="sort" onchange="this.form.submit()">
                        <option value="">並び替え</option>
                        <option value="price_asc" <?php echo e(request('sort') === 'price_asc' ? 'selected' : ''); ?>>価格が低い順</option>
                        <option value="price_desc" <?php echo e(request('sort') === 'price_desc' ? 'selected' : ''); ?>>価格が高い順</option>
                    </select>
                </form>

                
                <?php if(request('sort')): ?>
                    <div class="product-index__tag">
                        並び替え:
                        <span class="tag">
                            <?php if(request('sort') === 'price_asc'): ?> 価格が低い順
                            <?php elseif(request('sort') === 'price_desc'): ?> 価格が高い順
                            <?php endif; ?>
                            <a href="<?php echo e(route('products.index')); ?>" class="tag__remove">×</a>
                        </span>
                    </div>
                <?php endif; ?>

                
                <div class="product-index__cards">
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="product-card">
                            <?php if($product->image): ?>
    <img src="<?php echo e(asset('storage/' . $product->image)); ?>" alt="<?php echo e($product->name); ?>" class="product-card__image">
<?php else: ?>
    <img src="<?php echo e(asset('images/no-image.png')); ?>" alt="No image available" class="product-card__image">
<?php endif; ?>

                            <div class="product-card__content">
                                <h3 class="product-card__name"><?php echo e($product->name); ?></h3>
                                <p class="product-card__price">¥<?php echo e(number_format($product->price)); ?></p>
                                <a href="<?php echo e(route('products.show', ['product' => $product->id])); ?>"
                                    class="product-card__detail-button">詳細</a>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                
                <div class="pagination">
                    <?php echo e($products->appends(request()->query())->links()); ?>

                </div>

            </div> 
        </div> 
    </div> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/products/index.blade.php ENDPATH**/ ?>