<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index() 
    {
        $data = [
            'title' => 'Booking',
            'transaction' => Transaction::where('status', 'pending')->where('user_id', getInfoLogin()->id)->first()
        ];

        return view('booking', $data);
    }
}
