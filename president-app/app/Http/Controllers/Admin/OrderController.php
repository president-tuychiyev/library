<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $books = Book::orderBy('');
        return view('interfaces.admin.orders', compact('books'));
    }
}
