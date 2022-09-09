<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $guarded = [ '_token' ];

    public function user ()
    {
        return $this->belongsTo(User::class, 'userId','id');
    }
    
    public function type()
    {
        return $this->belongsTo(Detail::class, 'docTypeId', 'id');
    }

    public function lang()
    {
        return $this->belongsTo(Detail::class, 'docLangId', 'id');
    }

    public function text()
    {
        return $this->belongsTo(Detail::class, 'textTypeId', 'id');
    }

    public function format()
    {
        return $this->belongsTo(Detail::class, 'docFormatId', 'id');
    }

    public function file()
    {
        return $this->belongsTo(Detail::class, 'fileTypeId', 'id');
    }

    public function direct()
    {
        return $this->belongsTo(Detail::class, 'directId', 'id');
    }

    public function author ()
    {
        return $this->belongsTo(Author::class, 'authorId', 'id');
    }

    public function cover()
    {
        return $this->belongsTo(Media::class, 'coverMediaId', 'id');
    }

    public function doc()
    {
        return $this->belongsTo(Media::class, 'docMediaId', 'id');
    }

}
