<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $fillable = [
        'is_title',
        'is_footer',
        'file_type',
        'algorithm',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
