<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prompt extends Model
{
    protected $fillable = [
        'original_prompt',
        'improved_prompt',
        'metadata',
    ];

    protected $casts = [
        'metadata' => 'array',
    ];
}
