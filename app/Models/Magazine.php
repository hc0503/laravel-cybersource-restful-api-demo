<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\HasGuidTrait;

class Magazine extends Model
{
    use HasGuidTrait;

    protected $table = 'magazines';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'genre_id',
        'frequency_id',
        'title',
        'description',
        'cover_image',
    ];

    public function genre()
    {
        return $this->belongsTo(Genre::class, 'genre_id', 'id');
    }

    public function frequency()
    {
        return $this->belongsTo(Frequency::class, 'frequency_id', 'id');
    }
}
