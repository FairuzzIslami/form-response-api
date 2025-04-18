<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Responses extends Model
{
    use HasFactory;

    protected $table = 'responses';

    protected $fillable = [
        'email',
        'form_id',
        'answers'
    ];  

    protected $casts = [
        'answers' => 'array' //data json ke array
    ];
}
