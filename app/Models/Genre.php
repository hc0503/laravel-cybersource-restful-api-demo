<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\HasGuidTrait;

class Genre extends Model
{
    use HasGuidTrait;

    protected $table = 'genres';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    public function magazines()
    {
        return $this->hasMany(Magazine::class, 'genre_id', 'id');
    }
}
