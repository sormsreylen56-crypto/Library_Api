<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\BookAuthor;
use Illuminate\Http\Request;

class BookAuthorController extends Controller
{
    public function index() {
        return response()->json(BookAuthor::with(['book', 'author'])->get());
    }

    public function store(Request $request) {
        $data = $request->validate([
            'BookID'     => 'required|exists:tblBook,BookID',
            'AuthorID'   => 'required|exists:tblAuthor,AuthorID',
            'AuthorDate' => 'nullable|date',
            'Remark'     => 'nullable|string',
        ]);
        return response()->json(BookAuthor::create($data), 201);
    }

    public function show($bookId, $authorId) {
        $row = BookAuthor::with(['book', 'author'])
            ->where('BookID', $bookId)->where('AuthorID', $authorId)->firstOrFail();
        return response()->json($row);
    }

   public function update(Request $request, $id)
{
    $author = Author::findOrFail($id);

    $request->validate([
        'AuthorName' => 'sometimes|string|max:255',
        'Photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    $author->AuthorName = $request->AuthorName
        ?? $author->AuthorName;

    if ($request->hasFile('Photo')) {
        $path = $request->file('Photo')
            ->store('authors', 'public');

        $author->Photo = $path;
    }

    $author->save();

    return response()->json([
        'message' => 'Author updated successfully',
        'data' => $author,
        'photo_url' => $author->Photo
            ? asset('storage/' . $author->Photo)
            : null,
    ]);
}

    public function destroy($bookId, $authorId) {
        $deleted = BookAuthor::where('BookID', $bookId)
            ->where('AuthorID', $authorId)->delete();
        abort_unless($deleted, 404);
        return response()->json(['message' => 'Deleted successfully']);
    }
}
