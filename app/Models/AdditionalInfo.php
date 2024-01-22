<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalInfo extends Model
{
    use HasFactory;

    protected $table = 'additional_information';

    protected $fillable = [
        'name',
        'birthday',
        'phone',
        'email',
        'experience',
        'projects_finished',
        'awards',
        'customers',
    ];
}
