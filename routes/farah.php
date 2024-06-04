<?php

use App\Http\Controllers\BackgroundController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeDescriptionController;
use App\Http\Controllers\HomeProductController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/category-product', [CategoryProductController::class, 'index'])->name('category-product.index');
Route::post('/category-product/store', [CategoryProductController::class, 'store'])->name('category-product.store');
Route::put('/category-product/update/{categoryProduct}', [CategoryProductController::class, 'update'])->name('category-product.update');
Route::delete('/category-product/delete/{categoryProduct}', [CategoryProductController::class, 'destroy'])->name('category-product.destroy');


Route::get('background', [BackgroundController::class, 'index'])->name('background.index');
Route::post('background/store', [BackgroundController::class, 'store'])->name('background.store');
Route::put('background/update/{background}', [BackgroundController::class, 'update'])->name('background.update');
Route::delete('background/delete/{background}', [BackgroundController::class, 'destroy'])->name('background.destroy');

Route::get('gallery/service/{service}', [GalleryController::class, 'showFolder'])->name('gallery.showFolder');
Route::delete('galery/delete/{galery}/{galeryImage}', [GalleryController::class, 'destroy']);

Route::get('home-description', [HomeDescriptionController::class, 'index'])->name('home-description.index');
Route::post('home-description/store', [HomeDescriptionController::class, 'store'])->name('home-description.store');
Route::put('home-description/{home}', [HomeDescriptionController::class, 'update'])->name('home-description.update');
Route::delete('home-description/{home}', [HomeDescriptionController::class, 'destroy'])->name('home-description.destroy');

Route::post('coming-soon-product/store', [ProductController::class, 'storeComing'])->name('product-coming.store');
Route::put('coming-soon-product/{comingSoonProduct}', [ProductController::class, 'updateComing'])->name('product-coming.update');
Route::get('coming-soon-product/edit/{comingSoonProduct}', [ProductController::class, 'editComing'])->name('product-coming.edit');
Route::delete('coming-soon-product/{comingSoonProduct}', [ProductController::class, 'destroyComing'])->name('product-coming.delete');

Route::get('data/product/coming-soon', [HomeProductController::class, 'productComing']);

Route::get('admin/portfolio', [PortfolioController::class, 'index'])->name('portfolio.index');
Route::post('admin/portfolio', [PortfolioController::class, 'store'])->name('portfolio.store');
Route::put('admin/portfolio/update/{product}', [PortfolioController::class, 'update'])->name('portfolio.update');
Route::delete('admin/portfolio/{product}', [PortfolioController::class, 'destroy'])->name('portfolio.destroy');

Route::post('admin/product/publish/{id}', [ProductController::class, 'publishProduct'])->name('product.publish');
Route::delete('admin/product/draft/{product}', [ProductController::class, 'draft'])->name('product.draft'); 
Route::post('coming-soon-product/publish/{id}', [ProductController::class, 'publishProductComing'])->name('product-coming.publish'); 
Route::delete('coming-soon-product/draft/{comingSoonProduct}', [ProductController::class, 'comingDraft'])->name('product-coming.draft'); 