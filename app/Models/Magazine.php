<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\HasGuidTrait;

class Magazine extends Model
{
    use HasGuidTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'genre_id',
        'frequency_id',
        'title',
        'description',
        'cover_image',
    ];
}
