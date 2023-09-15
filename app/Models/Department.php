<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'detail',
    ];

    public $timestamps = false;

    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
