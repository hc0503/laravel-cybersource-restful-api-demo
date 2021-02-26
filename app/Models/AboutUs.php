<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\HasGuidTrait;

class AboutUs extends Model
{
    use HasGuidTrait;

    protected $table = 'about_us';
    protected $fillable = [
        'content'
    ];
}
