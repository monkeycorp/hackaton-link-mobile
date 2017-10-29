<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TemporalToken extends Model
{
    protected $table = 'temporal_tokens';
    protected $fillable = [
        'token',
        'deleted_at',
        'user_id',
    ];
}
