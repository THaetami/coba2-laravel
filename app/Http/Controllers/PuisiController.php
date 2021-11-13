<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\Comentary;
use App\Models\Puisi;


class PuisiController extends Controller
{
    public function index()
    {

        return view('layouts.index', [
            "title" => "Puisi",
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

        return redirect('/')->with('success', 'New Comentary Added!');

    }


    public function destroy(Puisi $puisi)
    {

        Puisi::where('id', $puisi->id)->delete();
        return redirect('/')->with('success', 'Post has been deleted!');

    }



}








