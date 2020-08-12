<?php

namespace App\Http\Controllers\Api\V1;

use App\Book;
use App\Http\Controllers\Controller;
use App\Http\Resources\BookCollection;
use App\Http\Resources\BookResource;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return BookResource::collection(Book::orderByDesc("id")->get());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return new BookResource($book);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $coll = collect($request->all());
        if ($request->hasFile("file")) {
            $file = $request->file("file");
            $fileName = Str::random() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path("images"), $fileName);
            $coll->forget("file");
            $coll->put("image", $fileName);
            unlink(public_path("images/" . $request->image));
        }
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
