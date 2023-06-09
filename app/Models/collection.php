<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class collection extends Model
{
    use HasFactory;

    protected $table = 'collections';

    protected $fillable = [
        'collection',
    ];

    public function livres(){
        return $this->belongsToMany(livres::class);
    }
}
