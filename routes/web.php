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

    Route::middleware(['auth'])->group(function () {

        Route::prefix('auth')->group(function () {
            Route::get('sign-in', 'Auth\\AuthController@index')->name('auth.signIn');
            Route::get('logout', 'Auth\\AuthController@logout')->name('auth.logout');
        });
        
        Route::prefix('admin')->group(function () {
            Route::get('home', 'Admin\\HomeController@index')->name('admin.home');
            Route::get('detal/book', 'Admin\\DetailController@detailBook')->name('admin.datail.book');
            Route::post('detal/book/add', 'Admin\\DetailController@detailBookAdd')->name('admin.datail.book.add');
            Route::get('books', 'Admin\\BooksController@index')->name('admin.books');
            Route::get('books/add', 'Admin\\BooksController@add')->name('admin.books.add');
            Route::post('books/insert', 'Admin\\BooksController@insert')->name('admin.books.insert');
            Route::get('books/select/{id}', 'Admin\\BooksController@select')->name('admin.books.select');
            Route::post('books/update', 'Admin\\BooksController@update')->name('admin.books.update');
            Route::get('books/delete/{id}', 'Admin\\BooksController@delete')->name('admin.books.delete');
            Route::get('books/qrcode', 'Admin\\BooksController@qrcode')->name('admin.books.qrcode');
        });

    });

});
