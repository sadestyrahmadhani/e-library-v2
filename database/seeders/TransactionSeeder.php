<?php

namespace Database\Seeders;

use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transaction = Transaction::create([
            'member_id' => 1,
            'status' => 'pending'
        ]);

        TransactionDetail::insert([
            [
                'transaction_id' => $transaction->id,
                'book_id' => 1
            ],
            [
                'transaction_id' => $transaction->id,
                'book_id' => 2
            ],
        ]);
    }
}
