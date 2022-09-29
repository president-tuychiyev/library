<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes |powered by President Tuychiyev
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::redirect('/', '/uz');

Route::prefix(Config::get('language', 'uz'))->group(function () {

    Route::get('/', function () {
        return view('auth.sign-in');
    });

    Route::prefix('auth')->group(function () {
        Route::post('check', 'Auth\\AuthController@check')->name('auth.check');
    });

    Route::middleware(['auth', 'permission'])->group(function () {

        Route::prefix('auth')->group(function () {
            Route::get('sign-in', 'Auth\\AuthController@index')->name('auth.signIn');
            Route::get('logout', 'Auth\\AuthController@logout')->name('auth.logout');
        });

        Route::prefix('admin')->group(function () {
            Route::get('home', 'Admin\\HomeController@index')->name('admin.home');

            Route::prefix('details')->group(function () {
                Route::get('book', 'Admin\\DetailController@detailBook')->name('admin.datail.book');
                Route::post('book/add', 'Admin\\DetailController@detailBookAdd')->name('admin.datail.book.add');
                Route::post('book/update', 'Admin\\DetailController@detailBookUpdate')->name('admin.datail.book.update');
                Route::get('book/delete/{id}', 'Admin\\DetailController@detailBookDelete')->name('admin.datail.book.delete');
            });

            Route::prefix('books')->group(function () {
                Route::get('/', 'Admin\\BookController@index')->name('admin.books');
                Route::get('add', 'Admin\\BookController@add')->name('admin.books.add');
                Route::post('insert', 'Admin\\BookController@insert')->name('admin.books.insert');
                Route::get('select/{id}', 'Admin\\BookController@select')->name('admin.books.select');
                Route::post('update', 'Admin\\BookController@update')->name('admin.books.update');
                Route::get('delete/{id}', 'Admin\\BookController@delete')->name('admin.books.delete');
                Route::get('qrcode', 'Admin\\BookController@qrcode')->name('admin.books.qrcode');
                Route::get('view/{id}', 'Admin\\BookController@view')->name('admin.books.view');
                Route::post('give', 'Admin\\BookController@give')->name('admin.books.give');
            });

            Route::prefix('journals')->group(function () {
                Route::get('/', 'Admin\\JournalController@index')->name('admin.journals');
            });

            Route::prefix('systems')->group(function () {
                Route::get('/', 'Admin\\SystemController@index')->name('admin.system');
                Route::post('add', 'Admin\\SystemController@add')->name('admin.system.add');
                Route::post('update', 'Admin\\SystemController@update')->name('admin.system.update');
                Route::get('delete/{id}', 'Admin\\SystemController@delete')->name('admin.system.delete');
            });

            Route::prefix('authors')->group(function () {
                Route::get('/', 'Admin\\AuthorController@index')->name('admin.authors');
                Route::post('add', 'Admin\\AuthorController@add')->name('admin.authors.add');
                Route::post('update', 'Admin\\AuthorController@update')->name('admin.authors.update');
                Route::get('delete/{id}', 'Admin\\AuthorController@delete')->name('admin.authors.delete');
            });

            Route::prefix('orders')->group(function () {
                Route::get('/', 'Admin\\OrderController@index')->name('admin.orders');
                Route::get('update/{id}/{status}', 'Admin\\OrderController@update')->name('admin.orders.update');
            });

            Route::prefix('workmans')->group(function () {
                Route::get('/', 'Admin\\UserController@workmansIndex')->name('admin.workmans');
                Route::post('add', 'Admin\\UserController@workmansAdd')->name('admin.workmans.add');
                Route::post('update', 'Admin\\UserController@workmansUpdate')->name('admin.workmans.update');
                Route::get('delete/{id}', 'Admin\\UserController@workmansDelete')->name('admin.workmans.delete');
            });

            Route::prefix('users')->group(function () {
                Route::get('teachers', 'Admin\\UserController@teachers')->name('admin.users.teachers');
                Route::get('students', 'Admin\\UserController@students')->name('admin.users.students');
                Route::post('add', 'Admin\\UserController@usersAdd')->name('admin.users.add');
                Route::post('update', 'Admin\\UserController@usersUpdate')->name('admin.users.update');
                Route::get('delete/{id}', 'Admin\\UserController@usersDelete')->name('admin.users.delete');
                Route::post('check', 'Admin\\UserController@check')->name('admin.users.check');
            });

            Route::prefix('roles')->group(function () {
                Route::get('/', 'Admin\\RoleController@index')->name('admin.roles');
                Route::post('add', 'Admin\\RoleController@add')->name('admin.roles.add');
                Route::post('update', 'Admin\\RoleController@update')->name('admin.roles.update');
                Route::get('delete/{id}', 'Admin\\RoleController@delete')->name('admin.roles.delete');
            });

        });

    });

});
