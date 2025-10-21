<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['user', 'book'])->get();

        if ($transactions->isEmpty()) {
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Resource data not found',
                ],
                200
            );
        }
        return response()->json(
            [
                'success' => true,
                'message' => 'Get all transactions',
                'data' => $transactions,
            ],
            200
        );
    }

    public function store(Request $request)
    {
        // 1. validator
        $validator = Validator::make($request->all(), [
            'book_id' => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'success' => false,
                    'message' => $validator->errors(),
                ],
                422
            );
        }
        // 2. generate orderNumber -> unique | ORD-XXXX
        $uniqueCode = "ORD-" . strtoupper(uniqid());

        // 3. ambil user yang sedang login & cek login (apakah ada data user?)
        $user = auth('api')->user();
        if (!$user) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Unauthorized!',
                ],
                401
            );
        }
        // 4. mencari data buku dari request book_id
        $book = Book::find($request->book_id);
        // 5. cek stock buku, jika 0 maka return error
        if ($book->stock < $request->quantity) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'stok buku tidak cukup',
                ],
                400
            );
        }
        // 6. hitung total harga = price * quantity
        $totalAmount = $book->price * $request->quantity;
        // 7. kurangi stock buku (update)
        $book->stock -= $request->quantity;
        $book->save();
        // 8. simpan data transaksi ke database
        $transactions = Transaction::create([
            'order_number' => $uniqueCode,
            'customer_id' => $user->id,
            'book_id' => $request->book_id,
            'total_amount' => $totalAmount,
        ]);
        // 9. return response json
        return response()->json(
            [
                'success' => true,
                'message' => 'Transaction created successfully',
                'data' => $transactions,
            ],
            201
        );
    }

    public function show(string $id)
    {
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Transaction not found',
                ],
                404
            );
        }

        return response()->json(
            [
                'success' => true,
                'message' => 'Get transaction details',
                'data' => $transaction,
            ],
            200
        );
    }

    public function update(Request $request, string $id)
    {
        // 1. mencari data
        $transaction = Transaction::find($id);
        if (!$transaction) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Transaction not found',
                ],
                404
            );
        }

        // 2. validator
        $validator = Validator::make($request->all(), [
            'order_number' => 'required|string|max:100',
            'customer_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'total_amount' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'success' => false,
                    'message' => $validator->errors(),
                ],
                422
            );
        }

        // 3. siapkan data yang ingin diupdate
        $data = [
            'order_number' => $request->order_number,
            'customer_id' => $request->customer_id,
            'book_id' => $request->book_id,
            'total_amount' => $request->total_amount,
        ];

        // 6. update data baru ke database
        $transaction->update($data);
        return response()->json(
            [
                'success' => true,
                'message' => 'Transaction updated successfully',
                'data' => $transaction,
            ],
            200
        );
    }

    public function destroy(string $id)
    {
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Book not found',
                ],
                404
            );
        }

        $transaction->delete();

        return response()->json(
            [
                'success' => true,
                'message' => 'Transaction deleted successfully',
            ],
            200
        );
    }
}
