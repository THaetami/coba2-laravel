<?php


namespace App\Http\Controllers;

use App\Models\Puisi;
use App\Models\Author;


use Illuminate\Http\Request;

class SearchController
{
    public function __invoke(Request $request)
    {
        $term = $request->input('term');

        $result = Puisi::query()
            ->when($term, fn ($query) => $query->where('title', 'like', '%' . $term . '%'));
            // ->withCount('comments')
            // ->paginate()

        $result = Author::query()
            ->when($term, fn ($query) => $query->where('name', 'like', '%' . $term . '%'));
            // ->withCount('comments')
            // ->paginate()

            return view('layouts.index', [
            'result' => $result,
            'term' => $term
        ]);
    }
}
