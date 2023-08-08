<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\admin\Home_controller;
use Appcart\Iroad\app\Http\Controllers\admin\Login_controller;
// use App\Http\Controllers\admin\Dashboard_controller;
// use App\Http\Controllers\admin\User_controller;
// use App\Http\Controllers\admin\Machine_controller;
// use App\Http\Controllers\admin\Material_controller;
// use App\Http\Controllers\admin\Labour_controller; 
// use App\Http\Controllers\admin\Monitoring_controller; 
// use App\Http\Controllers\admin\Vendor_controller; 
// use App\Http\Controllers\admin\Sites_controller; 

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



Route::group(['prefix' => 'admin'], function () {
    Route::group(['middleware' => 'valid:admin,data'], function() {  
        valid();
    });

    Route::group(['middleware' => 'invalid:admin,data'], function() {  
        invalid();
    });
});

Route::group(['prefix' => 'store'], function () {
    Route::group(['middleware' => 'valid:store,data'], function() {  
        valid();
    });

    Route::group(['middleware' => 'invalid:store,data'], function() {  
        invalid();
    });
});

Route::group(['prefix' => 'purchase'], function () {
    Route::group(['middleware' => 'valid:purchase,data'], function() {  
        valid();
    });

    Route::group(['middleware' => 'invalid:purchase,data'], function() {  
        invalid();
    });
});

Route::group(['prefix' => 'manager'], function () {
    Route::group(['middleware' => 'valid:manager,data'], function() {  
        valid();
    });

    Route::group(['middleware' => 'invalid:manager,data'], function () {  
        invalid();
    });
});


function valid()
{
    Route::get('/home', [Home_controller::class, 'index']);    
    Route::get('/', [Login_controller::class, 'index']);
    Route::get('login', [Login_controller::class, 'index']);
    Route::post('login', [Login_controller::class, 'login']);
}

function invalid()
{
    Route::get('logout', [Dashboard_controller::class, 'logout']);
    Route::get('dashboard', [Dashboard_controller::class, 'index']);

    Route::get('users', [User_controller::class, 'index']);
    Route::post('add-user', [User_controller::class, 'add_user']);

    Route::get('machines', [Machine_controller::class, 'index'])->name('machines');
    Route::post('add-machines', [Machine_controller::class, 'add_machines']);
    Route::post('machines-import', [Machine_controller::class, 'machines_import']);

    Route::get('materials', [Material_controller::class, 'index'])->name('materials');
    Route::post('add-materials', [Material_controller::class, 'add_materials']);
    Route::post('material-import', [Material_controller::class, 'upload_file']);

    Route::get('labours', [Labour_controller::class, 'index']);

    Route::get('activities', [Monitoring_controller::class, 'index'])->name('activities');
    Route::post('add-activity', [Monitoring_controller::class, 'add_activity'])->name('activities');

    Route::get('vendors', [Vendor_controller::class, 'index'])->name('vendors');
    Route::post('add-vendors', [Vendor_controller::class, 'add_vendors']);
    
    Route::get('sites', [Sites_controller::class, 'index']);
    Route::post('add-site', [Sites_controller::class, 'add_site']);    
    Route::get('project-details', [Sites_controller::class, 'project_datails']);    
    Route::get('add-project-details', [Sites_controller::class, 'add_project_datails']);    
    Route::post('add-component-chainage', [Sites_controller::class, 'add_component_chainage']);    
}




