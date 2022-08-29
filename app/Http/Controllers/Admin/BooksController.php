<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BooksController extends Controller
{

    public function __construct()
    {
        $this->lang = app()->getLocale();
    }

    public function index ()
    {
        $books = Book::join('users', 'users.id', '=', 'books.userId')
            ->select('books.id', "books.name{$this->lang} as name", 'users.name as username')->paginate(20);

        return view('interfaces.admin.books', compact('books'));
    }

    public function add ()
    {
        return view('interfaces.admin.books-create-update');
    }
}
