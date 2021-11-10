<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\Puisi;


class PuisiController extends Controller
{
    public function index()
    {
            // $author = Author::pluck('name');
            // dd($author);
        return view('layouts.index', [
            "title" => "Puisi",
            "posts" => Puisi::latest()->filter(request(['author', 'search']))->get()
        ]);
    }
}








