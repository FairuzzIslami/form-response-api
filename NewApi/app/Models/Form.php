<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    protected $table = 'forms';

    protected $fillable = [
        'name',
        'slug',
        'allowed_domains',
        'description',
        'limit_one_response',
        'creator_id'
    ];  

    // Jika ada kolom yang otomatis dijadikan JSON, tambahkan di sini
    protected $casts = [
        'allowed_domains' => 'array',
        'limit_one_response' => 'boolean'
    ];

    //Relasi ke  model question
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

}
