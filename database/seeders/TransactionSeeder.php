<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Transaction::create([
            'order_number' => 'ORD-1001',
            'customer_id' => 2,
            'book_id' => 1,
            'total_amount' => 150000.00,
        ]);
        Transaction::create([
            'order_number' => 'ORD-1002',
            'customer_id' => 3,
            'book_id' => 2,
            'total_amount' => 50000.00,
        ]);
        Transaction::create([
            'order_number' => 'ORD-1003',
            'customer_id' => 2,
            'book_id' => 3,
            'total_amount' => 70000.00,
        ]);
        Transaction::create([
            'order_number' => 'ORD-1004',
            'customer_id' => 3,
            'book_id' => 4,
            'total_amount' => 25000.00,
        ]);
        Transaction::create([
            'order_number' => 'ORD-1005',
            'customer_id' => 2,
            'book_id' => 5,
            'total_amount' => 55000.00,
        ]);
    }
}
