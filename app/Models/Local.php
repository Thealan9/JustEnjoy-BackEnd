<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'address',
        'active'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
