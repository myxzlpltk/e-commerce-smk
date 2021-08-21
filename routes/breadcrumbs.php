<?php

use Diglactic\Breadcrumbs\Breadcrumbs;

// Home
Breadcrumbs::for('home', function ($trail){
    $trail->push('Home', url('/'));
});

// Dashboard
Breadcrumbs::for('manage', function ($trail){
    $trail->parent('home');
    $trail->push('Dashboard', route('manage'));
});

// Buyer > Data Pengguna
Breadcrumbs::for('manage.users.show', function ($trail, $user){
    if($user->isBuyer) $trail->parent('manage.buyers.index');
    elseif($user->isSeller) $trail->parent('manage.sellers.index');
    $trail->push('Data '.__($user->role), route('manage.users.show', $user));
});

// Buyer
Breadcrumbs::for('manage.buyers.index', function ($trail){
    $trail->parent('home');
    $trail->push('Pembeli', route('manage.buyers.index'));
});

// Seller
Breadcrumbs::for('manage.sellers.index', function ($trail){
    $trail->parent('home');
    $trail->push('Penjual', route('manage.sellers.index'));
});
// Seller > Tambah Penjual
Breadcrumbs::for('manage.sellers.create', function ($trail){
    $trail->parent('manage.sellers.index');
    $trail->push('Tambah Penjual', route('manage.sellers.create'));
});

// Produk
Breadcrumbs::for('manage.products.index', function ($trail){
    $trail->parent('home');
    $trail->push('Produk', route('manage.products.index'));
});

// Produk > Lihat Produk
Breadcrumbs::for('manage.products.show', function ($trail, $product){
    $trail->parent('manage.products.index');
    $trail->push('Lihat Produk', route('manage.products.show', $product));
});

// Produk > Tambah Produk
Breadcrumbs::for('manage.products.create', function ($trail){
    $trail->parent('manage.products.index');
    $trail->push('Tambah Produk', route('manage.products.create'));
});

// Produk > Lihat Produk > Edit Produk
Breadcrumbs::for('manage.products.edit', function ($trail, $product){
    $trail->parent('manage.products.show', $product);
    $trail->push('Edit Produk', route('manage.products.edit', $product));
});

// Kategori
Breadcrumbs::for('manage.categories.index', function ($trail){
    $trail->parent('home');
    $trail->push('Kategori', route('manage.categories.index'));
});

// Kategori > Tambah Kategori
Breadcrumbs::for('manage.categories.create', function ($trail){
    $trail->parent('manage.categories.index');
    $trail->push('Tambah Kategori', route('manage.categories.create'));
});

// Kategori > Edit Kategori
Breadcrumbs::for('manage.categories.edit', function ($trail, $category){
    $trail->parent('manage.categories.index');
    $trail->push('Edit Kategori', route('manage.categories.edit', $category));
});

// Transaksi
Breadcrumbs::for('manage.orders.index', function ($trail){
    $trail->parent('home');
    $trail->push('Transaksi', route('manage.orders.index'));
});

// Transaksi > Detail Transaksi
Breadcrumbs::for('manage.orders.show', function ($trail, $order){
    $trail->parent('manage.orders.index');
    $trail->push('Detail Transaksi', route('manage.orders.show', $order));
});
