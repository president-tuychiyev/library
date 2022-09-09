<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $guarded = [ '_token' ];

    protected $fillable = ['userId', 'name', 'mediaId', 'isActive', 'book', 'journal'];

    public function user ()
    {
        return $this->belongsTo(User::class, 'userId','id');
    }
}
