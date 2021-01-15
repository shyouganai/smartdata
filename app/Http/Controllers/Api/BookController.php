<?php

namespace App\Http\Controllers\Api;

use App\Book;
use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return BookResource::collection(Book::query()->orderByDesc("id")->get());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     */
    public function show(Book $book)
    {
        return new BookResource($book);
    }

    public function store(Request $request)
    {
        $v = Validator::make($request->all(), [
            'author_id' => 'required|exists:authors,id',
            'name' => 'required',
            'desc' => 'required',
            'publication_date' => 'required|date',
        ]);

        if ($v->fails())
            return response()->json($v->errors(), 422);

        $book = Book::query()->create($request->all());

        return new BookResource($book);
    }

    public function uploadImage(Request $request, $book_id)
    {
        $v = Validator::make($request->all(), [
            'file' => 'required|file',
        ]);

        if ($v->fails())
            return response()->json($v->errors(), 422);

        $book = Book::query()->findOrFail($book_id);

        $file = $request->file("file");
        $fileName = Str::random() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path("images"), $fileName);

        if (!empty($book->image))
            unlink(public_path("images/" . $book->image));

        $book->update(['image' => $fileName]);

        return response()->json(['data' => ['status' => 'ok']]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     */
    public function update(Request $request, Book $book)
    {
        $book->update($coll->toArray());
        $book->refresh();

        return new BookResource($book);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return response()->json(["id" => $book->id], 200);
    }
}
