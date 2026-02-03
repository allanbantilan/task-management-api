<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'color',
        'icon',
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
