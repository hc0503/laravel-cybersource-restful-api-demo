<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\HasGuidTrait;

class ContactEmail extends Model
{
    use HasGuidTrait;

    protected $table = 'contact_emails';
    protected $fillable = [
        'name',
        'email'
    ];
}
