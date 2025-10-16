<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::all();

        if ($authors->isEmpty()) {
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
                'message' => 'Get all authors',
                'data' => $authors,
            ],
            200
        );
    }

    public function store(Request $request)
    {
        // 1. validator
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'bio' => 'required|string',
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

        // 3. upload image
        $image = $request->file('photo');
        $image->store('authors', 'public');


        // 4. insert data
        $author = Author::create([
            'name' => $request->name,
            'photo' => $image->hashName(),
            'bio' => $request->bio,
        ]);

        // 5. return response json
        return response()->json(
            [
                'success' => true,
                'message' => 'Author created successfully',
                'data' => $author,
            ],
            201
        );
    }
}
