<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UpdateInfo extends Model
{
    use HasFactory;

    protected $table = 'update_info'; 

    protected $fillable = [
        'availability',
        'my_info',
    ];
}
