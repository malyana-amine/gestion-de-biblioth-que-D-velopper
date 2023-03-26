<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class livres extends Model
{
    use HasFactory;

    protected $table = 'livres';

    protected $fillable = [
        'genre',
        'title',
        'isbn',
        'pages_number',
        'emplacement',
        'status',
        'contenu',
        'collectionId',
        'genreId',
    ];
    public function genre(){
        return $this->belongsTo(genre::class,'genreId');
    }
    public function collection(){
        return $this->belongsTo(Collection::class,'collectionId');
    }
}
