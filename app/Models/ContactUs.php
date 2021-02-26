<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\HasGuidTrait;

class ContactUs extends Model
{
    use HasGuidTrait;

    protected $table = 'contact_us';
    protected $fillable = [
        'content'
    ];
}
