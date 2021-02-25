<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\HasGuidTrait;

class Disclaimer extends Model
{
    use HasGuidTrait;
    
    protected $table = 'disclaimers';
    protected $fillable = [
        'content'
    ];
}
