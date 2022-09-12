<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [ 'userId', 'nameuz', 'nameru', 'nameen' ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userId', 'id');
    }

    public function permission()
    {
        return $this->hasMany(Permission::class, 'roleId', 'id');
    }
}
