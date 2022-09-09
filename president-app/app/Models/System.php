<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class System extends Model
{
    use HasFactory;

    protected $guarded = [ '_token' ];
    
    protected $fillable = ['facultyId', 'depId', 'group', 'isActive', 'userId'];

    public function user ()
    {
        return $this->belongsTo(User::class, 'userId','id');
    }
}
