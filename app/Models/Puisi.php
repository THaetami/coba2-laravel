<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Author;
use Symfony\Component\CssSelector\Node\FunctionNode;

class Puisi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['author'];

    public function scopeFilter($query, array $filters)
    {


        $query->when($filters['search'] ?? false, function ($query, $search) {
        return $query->where(function ($query) use ($search) {
            $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('body', 'like', '%' . $search . '%');
            });
        });

        $query->when($filters['author'] ?? false, function ($query, $author) {
            return $query->whereHas('author', function ($query) use ($author) {
                $query->where('username', $author);
            });
        });
    }

    public function author()
    {
        return $this->belongsTo(Author::class); //relationship
    }
}
































      // $query->when($filters['search'] ?? false, function ($query, $search) {
        //     return $query->where(function ($query) use ($search) {
        //         $query->where('title', 'like', '%' . $search . '%')
        //             ->orWhere('body', 'like', '%' . $search . '%');
        //     });
        // });


        // // $query->when($filters['search'] ?? false, function ($query, $search) use ($author)  {
        // //     return $query->where('title', 'like', '%' . $search . '%')
        // //         ->orWhere('body', 'like', '%' . $search . '%');
        // // });

        // $query->when($filters['author'] ?? false, function ($query, $author) {
        //     return $query->whereHas('author', function ($query) use ($author) {
        //         $query->where('username', $author);
        //     });
        // });
