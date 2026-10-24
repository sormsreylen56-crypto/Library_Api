<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BookType;
use Illuminate\Http\Request;

class BookTypeController extends Controller
{
    public function index() {
        return response()->json(BookType::all());
    }

    public function store(Request $request) {
        $data = $request->validate(['BookTypeName' => 'required|string|max:255']);
        return response()->json(BookType::create($data), 201);
    }

    public function show($id) {
        return response()->json(BookType::findOrFail($id));
    }

    public function update(Request $request, $id) {
        $type = BookType::findOrFail($id);
        $data = $request->validate(['BookTypeName' => 'required|string|max:255']);
        $type->update($data);
        return response()->json($type);
    }

    public function destroy($id) {
        BookType::findOrFail($id)->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
