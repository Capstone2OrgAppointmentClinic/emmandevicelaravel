<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentLog extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'login_at',
        'logout_at',
    ];

    public function student()
{
    return $this->belongsTo(User::class, 'user_id');
}
}
