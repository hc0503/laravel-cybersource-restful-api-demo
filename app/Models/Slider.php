<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\HasGuidTrait;

class Slider extends Model
{
    use HasGuidTrait;
    protected $table = 'sliders';
    protected $fillable = [
        'title',
        'image',
        'url',
        'status'
    ];
}
