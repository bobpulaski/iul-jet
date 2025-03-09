<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $fillable = ['name', 'order_number', 'document_designation', 'document_name', 'version_number', 'responsible_persons', 'hash', 'file_name', 'formatted_date', 'file_size', 'algorithm', 'description', 'page', 'pages', 'is_title', 'header_type', 'is_footer', 'remember_signatures', 'file_type'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
