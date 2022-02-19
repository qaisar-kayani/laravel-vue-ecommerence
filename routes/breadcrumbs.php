<?php
use App\Models\catalog\category;
// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});

// Home > Blog > [Category]
Breadcrumbs::for('category', function ($trail, $category) {
    if ($category->parent_id) {
        $parent2 = category::whereIn('_id', $category->parent_id)->first();
        if ($parent2->parent_id) {
            $parent = category::whereIn('_id', $parent2->parent_id)->first();
            $trail->push(ucfirst($parent->name), route('category.products', $parent->slug));
        }

        $trail->push(ucfirst($parent2->name), route('category.products', $parent2->slug));
    }
    $trail->push(ucfirst($category->name), route('category.products', $category->slug));
});

Breadcrumbs::for('product', function ($trail, $product) {
    $category = category::whereIn('_id', $product->category_id)->first();
    $trail->parent('category', $category);
    $trail->push(ucfirst($product->name), route('product.singleProduct', [$product->slug, $product->_id]));
});

// shoping cart
Breadcrumbs::for('cart', function ($trail) {
    $trail->parent('home');
    $trail->push('Shoping Cart', route('cartList'));
});
Breadcrumbs::for('login', function ($trail) {
    // $trail->parent('home');
    $trail->push('Account', route('login'));
    $trail->push('login', route('login'));
});
