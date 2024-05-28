<?php

namespace App\Http\Controllers\Borrow;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Member;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class BorrowController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Peminjaman Buku',
            'members' =>  Member::all(),
            'transaction' => TransactionDetail::whereNull('transaction_id')->get(),
            'books' => Book::all()
        ];
        // dd($data);
        return view('borrow.index', $data);
    }

    public function destroy(TransactionDetail $transactionDetail) 
    {
        try {
            $transactionDetail->delete();

            return redirect()->route('admin.borrows')->with('success','Berhasil menghapus data transaksi buku');
        } catch(Exception $e) {
            return redirect()->back()->withErrors(['errors' => 'Opps! terjadi kesalahan']);
        }
    }

    public function store($book_id) 
    {
        try {
            $check = TransactionDetail::whereBookId($book_id)->whereNull('transaction_id')->count();

            if($check == 0) {
                TransactionDetail::create(['book_id' => $book_id]);
            }

            return redirect()->back();
        } catch(Exception $e) {
            return redirect()->back()->withErrors(['errors' => 'Opps! terjadi kesalahan']);
        }
    }

    public function checkout(Request $request) 
    {   
        $request->validate([
            'member_id' => 'required',
            'date_return' => 'required',
        ]);
        try {
            $transactionCount = Transaction::all()->count();
            $transaction = Transaction::create([
                'transaction_code' => 'TRX'.date('Ymd').str_pad($transactionCount, 3, STR_PAD_LEFT),
                'user_id' => getInfoLogin()->id,
                'member_id' => $request->member_id,
                'date' => Carbon::now(),
                'date_of_return' => $request->date_return,
                'status' => 'not_be_restored'
            ]);

            TransactionDetail::whereNull('transaction_id')->update(['transaction_id' => $transaction->id, 'date_of_return' => $transaction->date_of_return]);

            return redirect()->back()->with('success', 'Berhasil menyimpan transaksi');
        } catch(Exception $e) {
            return redirect()->back()->withErrors(['errors' => 'Opps! terjadi kesalahan']);
        }
    }
}
