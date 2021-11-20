<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use App\Models\Comentary;
use App\Models\Puisi;


class PuisiController extends Controller
{
    public function index()
    {
        $judul = '';
        if (request('author')) {
            $author = Author::firstWhere('username', request('author'));
            $judul = ' dari ' . $author->name;
        }

        return view('layouts.index', [
            "title" => "Puisi",
            "judul" => 'Kumpulan Puisi' . $judul,
            "posts" => Puisi::latest()->filter(request(['author', 'search']))->get(),
        ]);

    }


    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'title' => 'required|max:30',
            'body' => 'required'
        ]);


        $validatedData['author_id'] = auth()->user()->id;
        $validatedData['penulis'] = auth()->user()->name;

        Puisi::create($validatedData);

        return redirect('/')->with('success', 'New Post Added!');

    }


    public function storeComment(Request $request)
    {

        $validatedData = $request->validate([
            'comentar' => 'required'
        ]);

        $validatedData['author_id'] = auth()->user()->id;
        $validatedData['komentator'] = auth()->user()->name;
        $validatedData['puisi_id'] = $request->puisi_id;

        Comentary::create($validatedData);

        return redirect('#')->with('success', 'New Comentary Added!');

    }


    public function destroy(Puisi $puisi)
    {
        Comentary::where('puisi_id', $puisi->id)->delete();

        Puisi::where('id', $puisi->id)->delete();

        return redirect('/')->with('success', 'Post has been deleted!');

    }


}








