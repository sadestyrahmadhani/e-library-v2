<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\BookRequest;
use App\Models\Book;
use App\Models\Genre;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BookController extends Controller
{
    
    public function index()
    {
        $data = [
            'title' => 'Data Buku',
            'books' => Book::all(),
        ];

        return view('book.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Buku',
            'action' => route('admin.books.store'),
            'genres' => Genre::all(),
        ];

        return view('book.form', $data);   
    }

    public function store(BookRequest $request)
    {
        try {
            if($request->hasFile('file')){
                $path = public_path('storage/images/books');
                $file = $request->file('file');
                $filename = 'books_'.rand(0, 99999999999).'_'.rand(0, 99999999999).'.'.$file->getClientOriginalExtension();
                $file->move($path, $filename);
            }
            $request->merge(['picture' => $filename]);

            Book::create($request->only(['genre_id', 'name', 'description', 'publication_year', 'author', 'picture']));

            return redirect()->route('admin.books')->with('success', 'Data berhasil ditambahkan');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['errors' => 'Oops! Terjadi kesalahan']);
        }
    }

    public function edit(Book $book)
    {
        $data = [
            'title' => 'Edit Buku',
            'action' => route('admin.books.update', $book->id),
            'genres' => Genre::all(),
            'data' => $book
        ];

        return view('book.form', $data);
    }

    public function update(BookRequest $request, Book $book)
    {
        try {
            if($request->hasFile('file')){
                $path = public_path('storage/images/books');
                $file = $request->file('file');
                $filename = 'books_'.rand(0, 99999999999).'_'.rand(0, 99999999999).'.'.$file->getClientOriginalExtension();
                $file->move($path,$filename);

                if(file_exists(public_path('storage/images/books/'.$book->picture))){
                    File::delete(public_path('storage/images/books/'.$book->picture));
                }
            } else {
                $filename = $book->picture;
            }

            $request->merge(['picture' => $filename]);
            $book->update($request->only(['genre_id', 'name', 'description', 'publication_year', 'author', 'picture']));

            return redirect()->route('admin.books')->with('success', 'Data berhasil diubah');
        } catch(Exception $e) {
            return redirect()->back()->withErrors(['errors' => 'Oops! Terjadi kesalahan']);
        }
    }

}
