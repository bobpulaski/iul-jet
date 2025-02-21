<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $fillable = ['name', 'order_number', 'document_designation'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
