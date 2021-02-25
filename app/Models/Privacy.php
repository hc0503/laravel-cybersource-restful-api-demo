<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\HasGuidTrait;

class Privacy extends Model
{
    use HasGuidTrait;
    
    protected $table = 'privacies';
    protected $fillable = [
        'content'
    ];
}
