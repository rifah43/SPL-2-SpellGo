<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;
    protected $fillable = [
        'algorithm_name',
    ];

    public function progress()
    {
        return $this->hasOne(Progress::class);
    }
    

}
