<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('suppliers', 
[App\Http\Controllers\SupplierController::class, 'suppliers']);

Route::post('save_supplier', 
[App\Http\Controllers\SupplierController::class, 'saveSupplier']);

Route::delete('delete_supplier/{id}', 
[App\Http\Controllers\SupplierController::class, 'deleteSupplier']);

Route::get('get_supplier/{id}', 
[App\Http\Controllers\SupplierController::class, 'getSupplier']);

Route::post('update_supplier/{id}', 
[App\Http\Controllers\SupplierController::class, 'updateSupplier']);



?>