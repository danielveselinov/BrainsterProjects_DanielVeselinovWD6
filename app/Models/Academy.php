<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Academy extends Model
{
    use HasFactory;

    protected $table = 'academies';

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }
}
