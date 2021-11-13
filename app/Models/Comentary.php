<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentary extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    // protected $with = ['author', 'puisis'];


    public function author()
    {
        return $this->belongsTo(Author::class); //relationship
    }

    public function puisis()
    {
        return $this->belongsTo(Puisi::class);
    }

}
