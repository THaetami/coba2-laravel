<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComentaryDrakor extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function author()
    {
        return $this->belongsTo(Author::class); //relationship
    }

    public function drakor()
    {
        return $this->belongsTo(Drakor::class);
    }
}
