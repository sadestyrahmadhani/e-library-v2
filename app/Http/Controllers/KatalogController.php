<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Genre;
use Illuminate\Http\Request;

class KatalogController extends Controller
{
    
    public function index($id = null)
    {
        $book = Book::query();

        if(!is_null($id)) {
            $book->whereGenreId($id);
        }

        $data = [
            'title' => 'Katalog',
            'genres' => Genre::all(),
            'books' => $book->get()
        ];

        return view('katalog', $data);
    }

    public function detail()
    {
        
    }

}
