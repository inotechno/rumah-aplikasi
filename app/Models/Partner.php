<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Partner extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'logo', 'website_link', 'instagram_link', 'facebook_link', 'twitter_link', 'linkedin_link'];
}
