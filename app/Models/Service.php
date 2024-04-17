<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['service_name', 'service_slug', 'service_icon', 'service_description'];

    public function portfolios()
    {
        return $this->hasMany(Portfolio::class);
    }
}
