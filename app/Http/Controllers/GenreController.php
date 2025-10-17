<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::all();

        if ($genres->isEmpty()) {
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
                'message' => 'Get all genres',
                'data' => $genres,
            ],
            200
        );
    }

    public function store(Request $request)
    {
        // 1. validator
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'description' => 'required|string',
        ]);
        // 2. check validator error
        if ($validator->fails()) {
            return response()->json(
                [
                    'success' => false,
                    'message' => $validator->errors(),
                ],
                422
            );
        }

        // 3. insert data
        $genre = Genre::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        // 4. return response json
        return response()->json(
            [
                'success' => true,
                'message' => 'Genre created successfully',
                'data' => $genre,
            ],
            201
        );
    }


    public function show(string $id)
    {
        $genre = Genre::find($id);

        if (!$genre) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Genre not found',
                ],
                404
            );
        }

        return response()->json(
            [
                'success' => true,
                'message' => 'Get genre details',
                'data' => $genre,
            ],
            200
        );
    }

    public function update(Request $request, string $id)
    {
        // 1. mencari data
        $genre = Genre::find($id);
        if (!$genre) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Genre not found',
                ],
                404
            );
        }

        // 2. validator
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'description' => 'required|string',
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
            'name' => $request->name,
            'description' => $request->description,
        ];

        // 5. update data baru ke database
        $genre->update($data);
        return response()->json(
            [
                'success' => true,
                'message' => 'Genre updated successfully',
                'data' => $genre,
            ],
            200
        );
    }

    public function destroy(string $id)
    {
        $genre = Genre::find($id);

        if (!$genre) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Genre not found',
                ],
                404
            );
        }
        $genre->delete();

        return response()->json(
            [
                'success' => true,
                'message' => 'Genre deleted successfully',
            ],
            200
        );
    }
}
