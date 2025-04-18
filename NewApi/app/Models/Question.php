<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $table = 'questions';

    protected $fillable = [
        'name',
        'choice_type',
        'choices',
        'is_required',
        // for end key
        'form_id'
    ];

    protected $casts = [
        'choises' => 'array'
    ];

    //realsi ke model form
    // ambil semua cloumn dari form yg di butuhkan
    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}
