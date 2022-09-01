<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;

    protected $fillable = ['userId', 'type', 'nameuz', 'nameru', 'nameen', 'isActive'];
    protected $guarded = [ '_token' ];

    public function user ()
    {
        return $this->belongsTo(User::class, 'userId','id');
    }
}
