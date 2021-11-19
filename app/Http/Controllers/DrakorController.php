<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Drakor;
use Illuminate\Http\Request;
use App\Models\ComentaryDrakor;

class DrakorController extends Controller

{
    public function index()
    {
        $judul = '';
        if (request('author')) {
            $author = Author::firstWhere('username', request('author'));
            $judul = ' dari ' . $author->name;
        }

        return view('layouts.drakor.index', [
            "title" => "Drakor",
            "judul" => 'Rekomendasi Drakor' . $judul,
            "posts" => Drakor::latest()->filter(request(['author', 'search']))->get(),
        ]);
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'body' => 'required'
        ]);


        $validatedData['author_id'] = auth()->user()->id;
        $validatedData['penulis'] = auth()->user()->name;

        Drakor::create($validatedData);

        return redirect('/drakor')->with('success', 'New Post Added!');
    }

    public function storeComment(Request $request)
    {

        $validatedData = $request->validate([
            'comentar' => 'required'
        ]);

        $validatedData['author_id'] = auth()->user()->id;
        $validatedData['komentator'] = auth()->user()->name;
        $validatedData['drakor_id'] = $request->drakor_id;

        ComentaryDrakor::create($validatedData);

        return redirect('/drakor')->with('success', 'New Comentary Added!');
    }

    public function destroy(Drakor $drakor)
    {

        ComentaryDrakor::where('drakor_id', $drakor->id)->delete();

        Drakor::where('id', $drakor->id)->delete();

        return redirect('/drakor')->with('success', 'Post has been deleted!');
    }

}
