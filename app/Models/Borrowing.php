<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_at',
        'end_at',
        'short_description',
        'status',
        'cancel_reason',
        'confirm_attend',
        'is_actived',
        'user_id',
        'property_id',
    ];

    public $timestamps = false;

    public function property()
    {
        return $this->belongsTo(Department::class);
    }

    public function sender()
    {
        return $this->belongsTo(User::class);
    }
}
