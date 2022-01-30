<?php

use App\Http\Controllers\ParametroController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Parametro
Route::get('parametro/getApiruc/{ruc}', [ParametroController::class,'apiRuc'])->name('getApiruc');
Route::get('parametro/getApidni/{dni}', [ParametroController::class,'apiDni'])->name('getApidni');

// -------------------------
// ### Route Employee
// --------------------------
Route::get('/employee', [App\Http\Controllers\EmployeeController::class, 'index'])->name('employee');
Route::get('/employee/create', [App\Http\Controllers\EmployeeController::class, 'create'])->name('employee.create');
Route::post('employee/store', [App\Http\Controllers\EmployeeController::class, 'store'])->name('employee.store');
Route::get('employee/edit/{employee}', [App\Http\Controllers\EmployeeController::class, 'edit'])->name('employee.edit');
Route::post('employee/update/{employee}', [App\Http\Controllers\EmployeeController::class, 'update'])->name('employee.update');
Route::get('employee/destroy/{employee}', [App\Http\Controllers\EmployeeController::class, 'destroy'])->name('employee.destroy');
// update
// destroy

// -------------------------
// ### Route User
// --------------------------
Route::get('users/', [App\Http\Controllers\UserController::class, 'index'])->name('user');
Route::get('users/profile/{id}', [App\Http\Controllers\UserController::class, 'show'])->name('user.profile');

// -------------------------
// ### Route Product
// --------------------------
Route::get('products/', [App\Http\Controllers\ProductController::class, 'index'])->name('product');
Route::get('products/create', [App\Http\Controllers\ProductController::class, 'create'])->name('product.create');
Route::post('products/store', [App\Http\Controllers\ProductController::class, 'store'])->name('product.store');
Route::get('products/edit/{product}', [App\Http\Controllers\ProductController::class, 'edit'])->name('product.edit');
Route::post('products/update/{product}', [App\Http\Controllers\ProductController::class, 'update'])->name('product.update');
Route::delete('products/destroy/{product}', [App\Http\Controllers\ProductController::class, 'destroy'])->name('product.destroy');
// update
// destroy

// -------------------------
// ### Route Category
// --------------------------
Route::get('categorys', [App\Http\Controllers\ProductCategoryController::class, 'index'])->name('category');
Route::get('categorys/create', [App\Http\Controllers\ProductCategoryController::class, 'create'])->name('category.create');
Route::post('categorys/store', [App\Http\Controllers\ProductCategoryController::class, 'store'])->name('category.store');
Route::get('categorys/edit/{productCategory}', [App\Http\Controllers\ProductCategoryController::class, 'edit'])->name('category.edit');
Route::post('categorys/update/{productCategory}', [App\Http\Controllers\ProductCategoryController::class, 'update'])->name('category.update');
Route::delete('categorys/destroy/{productCategory}', [App\Http\Controllers\ProductCategoryController::class, 'destroy'])->name('category.destroy');
// update
// destroy

// -------------------------
// ### Route Brand
// --------------------------
Route::get('brands', [App\Http\Controllers\BrandController::class, 'index'])->name('brand');
Route::get('brands/create', [App\Http\Controllers\BrandController::class, 'create'])->name('brand.create');
Route::post('brands/store', [App\Http\Controllers\BrandController::class, 'store'])->name('brand.store');
Route::get('brands/edit/{brand}', [App\Http\Controllers\BrandController::class, 'edit'])->name('brand.edit');
Route::post('brands/update/{brand}', [App\Http\Controllers\BrandController::class, 'update'])->name('brand.update');
Route::delete('brands/destroy/{brand}', [App\Http\Controllers\BrandController::class, 'destroy'])->name('brand.destroy');
// update
// destroy

// -------------------------
// ### Route Client
// --------------------------
Route::get('clients/', [App\Http\Controllers\ClientController::class, 'index'])->name('client');
Route::get('clients/create', [App\Http\Controllers\ClientController::class, 'create'])->name('client.create');
Route::post('clients/store', [App\Http\Controllers\ClientController::class, 'store'])->name('client.store');
Route::get('clients/{client}', [App\Http\Controllers\ClientController::class, 'show'])->name('client.show');
Route::post('clients/update/{client}', [App\Http\Controllers\ClientController::class, 'update'])->name('client.update');
Route::delete('clients/destroy/{client}', [App\Http\Controllers\ClientController::class, 'destroy'])->name('client.destroy');
Route::post('clients/obtener', [App\Http\Controllers\ClientController::class, 'obtenerClient'])->name('clienteGetClient');
// update
// destroy

// -------------------------
// ### Route Supplier
// --------------------------
Route::get('supplier/', [App\Http\Controllers\SupplierController::class, 'index'])->name('supplier');
Route::get('suppliers/create', [App\Http\Controllers\SupplierController::class, 'create'])->name('supplier.create');
Route::post('suppliers/store', [App\Http\Controllers\SupplierController::class, 'store'])->name('supplier.store');
Route::get('suppliers/{id}', [App\Http\Controllers\SupplierController::class, 'show'])->name('supplier.show');
Route::post('suppliers/update/{supplier}', [App\Http\Controllers\SupplierController::class, 'update'])->name('supplier.update');
Route::delete('suppliers/destroy/{supplier}', [App\Http\Controllers\SupplierController::class, 'destroy'])->name('supplier.destroy');
// update
// destroy

// -------------------------
// ### Route Sale
// --------------------------
Route::get('sale/', [App\Http\Controllers\SaleController::class, 'index'])->name('sale');
Route::get('sale/create', [App\Http\Controllers\SaleController::class, 'create'])->name('sale.create');
Route::post('sale/store', [App\Http\Controllers\SaleController::class, 'store'])->name('sale.store');
Route::get('invoice/{sale}', [App\Http\Controllers\SaleController::class, 'show'])->name('invoice');
Route::get('print/{sale}', [App\Http\Controllers\SaleController::class, 'print'])->name('print');
Route::get('sunat/{id}', [App\Http\Controllers\SaleController::class, 'sunat'])->name('sale.sunat');

// -------------------------
// ### Route Order
// --------------------------
Route::get('order/', [App\Http\Controllers\OrderController::class, 'index'])->name('order');
Route::get('order/create', [App\Http\Controllers\OrderController::class, 'create'])->name('order.create');
Route::post('order/store', [App\Http\Controllers\OrderController::class, 'store'])->name('order.store');
Route::get('remission/{order}', [App\Http\Controllers\OrderController::class, 'show'])->name('remission');
Route::get('printer/{order}', [App\Http\Controllers\OrderController::class, 'printer'])->name('printer');

// -------------------------
// ### Route Buy
// --------------------------
Route::get('buy/', [App\Http\Controllers\BuyController::class, 'index'])->name('buy');
Route::get('buy/create', [App\Http\Controllers\BuyController::class, 'create'])->name('buy.create');
Route::post('buy/store', [App\Http\Controllers\BuyController::class, 'store'])->name('buy.store');
Route::get('buy/edit/{buy}', [App\Http\Controllers\BuyController::class, 'edit'])->name('buy.edit');
Route::post('buy/update/{buy}', [App\Http\Controllers\BuyController::class, 'update'])->name('buy.update');

Route::get('ruta', function(){
    //return prueba();
});

// -------------------------
// ### Route Report
// --------------------------
Route::get('/almacen', [App\Http\Controllers\ReportController::class, 'almacen'])->name('almacen.report');

Route::get('/venta_fecha', [App\Http\Controllers\ReportController::class, 'venta_fecha'])->name('ventas.fecha');
Route::post('/venta_resultados', [App\Http\Controllers\ReportController::class, 'venta_resultados'])->name('ventas.resultados');

Route::get('/compra_fecha', [App\Http\Controllers\ReportController::class, 'compra_fecha'])->name('compras.fecha');
Route::post('/compra_resultados', [App\Http\Controllers\ReportController::class, 'compra_resultados'])->name('compras.resultados');

Route::post('/ventapdf', [App\Http\Controllers\ReportController::class, 'generarvPDF'])->name('ventas.pdf');
Route::post('/comprapdf', [App\Http\Controllers\ReportController::class, 'generarcPDF'])->name('compras.pdf');
Route::post('/almacenpdf', [App\Http\Controllers\ReportController::class, 'almacenPDF'])->name('almacen.pdf');