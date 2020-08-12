<?php

namespace App\Http\Controllers;

use App\Author;
use App\Book;
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
        return view("books.index", [
            "data" => Book::orderByDesc("id")->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("books.create", [
            "authors" => Author::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = $request->file("file");
        $fileName = Str::random() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path("images"), $fileName);

        $coll = collect($request->all());
        $coll->forget("file");
        $coll->put("image", $fileName);

        $book = Book::create($coll->toArray());

        return redirect()->route("books.show", $book)->with("message", "Успешно создано");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return view("books.show", [
            "data" => $book
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        return view("books.edit", [
            "data" => $book,
            "authors" => Author::all()
        ]);
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

        return redirect()->route("books.show", $book)->with("message", "Успешно обновлено");
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

        return redirect()->route("books.index")->with("message", "Успешно удалено");
    }
}
