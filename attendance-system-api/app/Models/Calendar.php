<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MiddleGenre extends Model
{
    use HasFactory;
    // protected $table = 'middle_genres';
    protected $fillable =
    [
        'date',
        'is_holiday',
        'holiday_name'
    ];
}
