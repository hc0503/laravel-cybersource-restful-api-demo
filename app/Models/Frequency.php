<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\HasGuidTrait;

class Frequency extends Model
{
    use HasGuidTrait;

    protected $table = 'frequencies';

    protected $fillable = [
        'name'
    ];
}
