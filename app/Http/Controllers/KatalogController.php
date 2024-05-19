<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Genre;
use Illuminate\Http\Request;

class KatalogController extends Controller
{
    
    public function index()
    {
        $data = [
            'title' => 'Katalog',
            'genres' => Genre::all(),
            'books' => Book::all()
        ];

        return view('katalog', $data);
    }

    public function detail()
    {
        
    }

}
