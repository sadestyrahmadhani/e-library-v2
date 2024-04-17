<?php

namespace App\Http\Controllers\Genre;

use App\Http\Controllers\Controller;
use App\Http\Requests\Genre\GenreRequest;
use App\Models\Genre;
use Exception;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    
    public function index()
    {
        $data = [
            'title' => 'Data Genre',
            'genres' => Genre::all(),
        ];

        return view('genre.index', $data);
    }

    public function store(GenreRequest $request)
    {
        try {
            Genre::create($request->only(['name']));

            return redirect()->route('admin.genres')->with('success', 'Berhasil menambahkan genre');
        } catch(Exception $e){
            return redirect()->back()->withErrors(['errors' => 'Opps! terjadi kesalahan']);
        }
    }

    public function update(GenreRequest $request, Genre $genre)
    {
        try {
            $genre->update($request->only(['name']));

            return redirect()->route('admin.genres')->with('success', 'Berhasil mengubah genre');
        } catch(Exception $e){
            return redirect()->back()->withErrors(['errors' => 'Opps! terjadi kesalahan']);
        }
    }

    public function destroy(Genre $genre)
    {
        try {
            $genre->delete();

            return redirect()->route('admin.genres')->with('success', 'Berhasil menghapus data genre');
        } catch(Exception $e){
            return redirect()->back()->withErrors(['errors' => 'Opps! terjadi kesalahan']);
        }
    }

}
