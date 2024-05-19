<?php

namespace App\Http\Controllers\BookReturn;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Carbon\Carbon;
use Exception;

class BookReturnController extends Controller
{
    public function index()
    {
        $transaction = Transaction::where('status','=','not_be_restored')->get();
        $data = [
            'title' => 'Pengembalian Buku',
            'transaction' => $transaction->map(function($item) {
                if(strtotime($item->date_of_return) > strtotime(date('Y-m-d'))) {
                    $late = 0;
                } else {
                    $late = date_diff(date_create(date('Y-m-d')), date_create($item->date_of_return))->format('%a');
                }
                $item->late = $late;

                return $item;
            })
        ];

        return view('bookReturn.index', $data);
    }
    
    public function show(Transaction $transaction)
    {
        if(strtotime($transaction->date_of_return) > strtotime(date('Y-m-d'))) {
            $late = 0;
        } else {
            $late = date_diff(date_create(date('Y-m-d')), date_create($transaction->date_of_return))->format('%a');
        }

        $data = [
            'title' => 'Lihat Detail',
            'transaction' => $transaction,
            'late' => $late
        ];

        return view('bookReturn.show', $data);
    }

    public function returned(TransactionDetail $transactionDetail)
    {
        try {
            $transactionDetail->update(['date_of_return' => Carbon::now()]);
            $check = TransactionDetail::whereNull('date_of_return')->whereTransactionId($transactionDetail->transaction_id)->get();
            if($check->count() == 0) {
                Transaction::whereId($transactionDetail->transaction_id)->update(['status' => 'returned']);
            }

            return redirect()->back();
        } catch(Exception $e) {
            return redirect()->back()->withErrors(['errors' => 'Opps! terjadi kesalahan']);
        }
    }
}
