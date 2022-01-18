<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use App\Models\Comentary;
use App\Models\Puisi;
use Illuminate\Support\Str;
use Prophecy\Doubler\Generator\Node\ReturnTypeNode;

class PuisiController extends Controller
{

    public function index()
    {
        $judul = '';
        $title = '';
        if (request('author')) {
            $author = Author::firstWhere('username', request('author'));
            $judul = ' ' . ucfirst(trans($author->name));
            $title = ' : ' . ucfirst(trans($author->name));
        }

        return view('layouts.index', [
            "title" => "Sastra" . $title,
            "judul" => 'Sastra dari' . $judul,
            "posts" => Puisi::latest()->filter(request(['author', 'search']))->get(),
        ]);
    }


    public function store(Request $request)
    {

        $validatedData = $request->validate(
            [
                'title' => 'required',
                'body' => 'required|regex:/\s\w+/'
            ],
            [
                'title.required' => 'Judul tidak boleh kosong',
                'body.required' => 'Tidak boleh kosong',
                'body.regex' => 'Ditolak'
            ]
        );


        $validatedData['author_id'] = auth()->user()->id;
        $validatedData['penulis'] = auth()->user()->name;
        $validatedData['romlah'] = Str::uuid();

        Puisi::create($validatedData);

        return redirect('/')->with('success', 'Sastra telah ditambahkan');
    }


    public function storeComment(Request $request)
    {

        $validatedData = $request->validate(
            [
                'comentar' => 'required|regex:/\s\w+(\S)*/'
            ],
            [
                'comentar.required' => 'Komentar tidak boleh kosong',
                'comentar.regex' => 'Komentar minimal 2 kata dan menggunakan spasi'
            ]
        );


        $validatedData['author_id'] = auth()->user()->id;
        $validatedData['komentator'] = auth()->user()->name;
        $validatedData['puisi_id'] = $request->puisi_id;


        Comentary::create($validatedData);

        return redirect('#')->with('success', 'Komentar berhasil ditambahkan!');
    }


    public function destroy(Puisi $puisi)
    {
        Comentary::where('puisi_id', $puisi->id)->delete();

        Puisi::where('romlah', $puisi->romlah)->delete();

        return redirect('/')->with('success', 'Sastra telah dihapus!');
    }


    // public function show(Puisi $puisi)
    // {
    //     dd($puisi->author->image);
    //     return view('sastra.index', [
    //         'title' => 'sastra',
    //         'post' => $puisi
    //     ]);
    // }






}
