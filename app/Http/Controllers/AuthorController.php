<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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


    public function show(string $id)
    {
        $author = Author::find($id);

        if (!$author) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Author not found',
                ],
                404
            );
        }

        return response()->json(
            [
                'success' => true,
                'message' => 'Get author details',
                'data' => $author,
            ],
            200
        );
    }

    public function update(Request $request, string $id)
    {
        // 1. mencari data
        $author = Author::find($id);
        if (!$author) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Author not found',
                ],
                404
            );
        }

        // 2. validator
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'bio' => 'required|string',
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
            'bio' => $request->bio,
        ];

        // 4. handle image (upload & hapus yang lama)
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $image->store('authors', 'public');

            if ($author->photo) {
                Storage::disk('public')->delete('authors/' . $author->photo);
            }
            $data['photo'] = $image->hashName();
        }

        // 5. update data baru ke database
        $author->update($data);
        return response()->json(
            [
                'success' => true,
                'message' => 'Author updated successfully',
                'data' => $author,
            ],
            200
        );
    }

    public function destroy(string $id)
    {
        $author = Author::find($id);

        if (!$author) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Author not found',
                ],
                404
            );
        }
        if ($author->photo) {
            // Delete cover photo from storage
            Storage::disk('public')->delete('authors/' . $author->photo);
        }

        $author->delete();

        return response()->json(
            [
                'success' => true,
                'message' => 'Author deleted successfully',
            ],
            200
        );
    }
}
