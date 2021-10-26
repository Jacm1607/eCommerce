<?php
use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Admin\ShowProducts;
use App\Http\Livewire\Admin\CreateProducts;
use App\Http\Livewire\Admin\EditProducts;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\RolController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Livewire\Admin\ShowCategory;
use App\Http\Livewire\Admin\BrandComponent;
use App\Http\Livewire\Admin\DepartamentComponent;
use App\Http\Livewire\Admin\PrivilegeComponent;
use App\Http\Livewire\Admin\ProvinceComponent;
use App\Http\Livewire\Admin\ShowDepartament;
use App\Http\Livewire\Admin\ShowRol;
use App\Http\Livewire\Admin\UserComponent;

Route::get('/', ShowProducts::class)->name('admin.index');

Route::get('products/create', CreateProducts::class)->name('admin.products.create');

Route::get('products/{product}/edit', EditProducts::class)->name('admin.products.edit');
Route::post('products/{product}/files', [ProductController::class, 'files'])->name('admin.products.files');

Route::get('orders', [OrderController::class, 'index'])->name('admin.orders.index');
Route::get('orders/{order}', [OrderController::class, 'show'])->name('admin.orders.show');

Route::get('categories', [AdminCategoryController::class, 'index'])->name('admin.categories.index');
Route::get('categories/{category}', ShowCategory::class)->name('admin.categories.show');

Route::get('brands', BrandComponent::class)->name('admin.brands.index');

Route::get('departments', DepartamentComponent::class)->name('admin.departaments.index');
Route::get('departments/{department}', ShowDepartament::class)->name('admin.departments.show');

Route::get('provinces/{province}', ProvinceComponent::class)->name('admin.provinces.show');

Route::get('users', UserComponent::class)->name('admin.users.index');
Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
Route::put('users/{user}/update', [UserController::class, 'update'])->name('admin.users.update');

Route::get('roles', [RolController::class, 'index'])->name('admin.roles.index');
Route::get('roles/{rol}/edit', [RolController::class, 'edit'])->name('admin.roles.edit');
Route::put('roles/{rol}/update', [RolController::class, 'update'])->name('admin.roles.update');

Route::get('privileges', PrivilegeComponent::class)->name('admin.privileges.index');
