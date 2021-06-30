<?php

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
//Items Route
Route::get('view-items', 'Controller@viewItems');
Route::post('save-item-record', 'Controller@saveItemRecord');
//Customers Route
Route::get('view-customers', 'Controller@viewCustomers');
Route::post('save-customer-record', 'Controller@saveCustomerRecord');
Route::get('get-all-customers', 'Controller@getAllCustomers');
//Create Bill
Route::post('create-bill', 'Controller@createBill');
//Bill Headers Added via git master - copy
Route::get('get-all-bills', 'Controller@getAllBill');
Route::get('get-detailed-bill', 'Controller@getDetailedBill');
