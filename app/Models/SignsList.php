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

    public function signature()
    {
        return $this->hasOne(Signature::class, 'signs_lists_id'); // Укажите внешний ключ
    }
}
