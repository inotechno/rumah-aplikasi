<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Portfolio extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'slug_title', 'service_id', 'url_portfolio', 'img_thumbnail', 'description', 'description_excerpt', 'status_portfolio'];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
