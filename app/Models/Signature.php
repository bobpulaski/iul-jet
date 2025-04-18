<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Signature extends Model
{
    protected $fillable = [
        'kind',
        'surname',
        'file_src',
        'signdate',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}