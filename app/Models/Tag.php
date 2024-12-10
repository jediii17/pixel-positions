<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /** @use HasFactory<\Database\Factories\TagFactory> */
    use HasFactory;

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtolower($value);
    }

    public function jobs()
    {
        return $this->belongsToMany(Job::class);
    }
}
