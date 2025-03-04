<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Signature extends Model
{
    protected $fillable = [
        'kind',
        'surname',
        'signdate',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
