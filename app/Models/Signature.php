<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Signature extends Model
{
    protected $fillable = [
        'signs_lists_id',
        'kind',
        'surname',
        'file_src',
        'signdate',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function signsList()
    {
        return $this->belongsTo(SignsList::class, 'signs_lists_id'); // Укажите внешний ключ
    }
}