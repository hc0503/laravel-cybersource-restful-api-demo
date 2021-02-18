<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\HasGuidTrait;

class Document extends Model
{
    use HasGuidTrait;

    protected $table = 'documents';

    protected $fillable = [
        'name',
        'path'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_documents');
    }
}
