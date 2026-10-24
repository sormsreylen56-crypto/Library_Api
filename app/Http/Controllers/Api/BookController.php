<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    private function rules() {
        return [
            'BookTitle'   => 'required|string|max:255',
            'BookTypeID'  => 'required|exists:tblBookType,BookTypeID',
            'PublishDate' => 'nullable|date',
            'NumOfPages'  => 'nullable|integer',
            'NumOfCopies' => 'nullable|integer',
            'Edition'     => 'nullable|string',
            'Publisher'   => 'nullable|string',
            'BookSource'  => 'nullable|string',
            'Remark'      => 'nullable|string',
        ];
    }

    public function index() {
        return response()->json(Book::with(['bookType', 'authors'])->get());
    }

    public function store(Request $request) {
        $book = Book::create($request->validate($this->rules()));
        return response()->json($book, 201);
    }

    public function show($id) {
        return response()->json(Book::with(['bookType', 'authors'])->findOrFail($id));
    }

    public function update(Request $request, $id) {
        $book = Book::findOrFail($id);
        $book->update($request->validate($this->rules()));
        return response()->json($book);
    }

    public function destroy($id) {
        Book::findOrFail($id)->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
