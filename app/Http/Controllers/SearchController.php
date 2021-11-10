<?php


// namespace App\Http\Controllers;

// use App\Models\Puisi;
// use App\Models\Author;


// use Illuminate\Http\Request;

// class SearchController
// {
//     public function __invoke(Request $request)
//     {
//         $search = $request->input('search');

//         $posts = Puisi::query()
//             ->when($search, fn ($query) => $query->where('title', 'like', '%' . $search . '%')->orWhere('title', 'like', '%' . $search . '%'));
//             // ->withCount('comments')
//             // ->paginate()

//         $posts = Author::query()
//             ->when($search, fn ($query) => $query->where('name', 'like', '%' . $search . '%'));
//             // ->withCount('comments')
//             // ->paginate()

//             return view('layouts.index', [
//             'title' => 'Cari',
//             'posts' => $posts,
//             'search' => $search
//         ]);
//     }
// }
