<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    use HasFactory;
    protected $fillable = [
        'level_id',
        'user_id',
        'is_complete',
        'best_time',
        'best_score',
    ];

    public function level()
{
    return $this->belongsTo(Level::class);
}

}
