<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SignsList extends Model
{
    protected $fillable = [
        'kind',
        'surname',
        'file_src',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
