<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        return response()->json(Author::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'AuthorName' => 'required|string|max:255',
            'Gender'     => 'nullable|string|max:10',
            'DOB'        => 'nullable|date',
            'POB'        => 'nullable|string',
            'Address'    => 'nullable|string',
            'Phone'      => 'nullable|string|max:20',
            'Email'      => 'nullable|email',
            'Photo'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('Photo')) {
            $data['Photo'] = $request->file('Photo')
                ->store('authors', 'public');
        }

        $author = Author::create($data);

        return response()->json([
            'message' => 'Author created successfully',
            'data' => $author,
            'photo_url' => $author->Photo
                ? asset('storage/' . $author->Photo)
                : null,
        ], 201);
    }

    public function show($id)
    {
        return response()->json(Author::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $author = Author::findOrFail($id);

        $data = $request->validate([
            'AuthorName' => 'sometimes|required|string|max:255',
            'Gender'     => 'nullable|string|max:10',
            'DOB'        => 'nullable|date',
            'POB'        => 'nullable|string',
            'Address'    => 'nullable|string',
            'Phone'      => 'nullable|string|max:20',
            'Email'      => 'nullable|email',
            'Photo'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('Photo')) {
            $data['Photo'] = $request->file('Photo')
                ->store('authors', 'public');
        }

        $author->update($data);

        return response()->json([
            'message' => 'Author updated successfully',
            'data' => $author,
            'photo_url' => $author->Photo
                ? asset('storage/' . $author->Photo)
                : null,
        ]);
    }

    public function destroy($id)
    {
        Author::findOrFail($id)->delete();

        return response()->json([
            'message' => 'Deleted successfully'
        ]);
    }
}
