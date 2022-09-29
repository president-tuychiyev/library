<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user ()
    {
        return $this->belongsTo(User::class, 'userId','id');
    }

    public function book()
    {
        return $this->belongsTo(Book::class, 'bookId', 'id');
    }

    public function recUser()
    {
        return $this->belongsTo(User::class, 'recUserId', 'id');
    }
}
