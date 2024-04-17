<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    
    public function index() {
        $data = [
            'title' => "Home",
            'popularBooks' => Book::withCount(['transactionDetail'])->orderBy('transaction_detail_count', 'desc')->limit(4)->get(),
            'latestBooks' => Book::orderBy('created_at', 'desc')->limit(4)->get(),
        ];
        return view('home', $data);
    }

}
