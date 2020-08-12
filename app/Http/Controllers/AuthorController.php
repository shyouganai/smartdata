<?php

namespace App\Http\Controllers;

use App\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("authors.index", [
            "data" => Author::orderBy("name", "asc")->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("authors.create");
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

        $author = Author::create($coll->toArray());

        return redirect()->route("authors.show", $author)->with("message", "Успешно создано");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        return view("authors.show", [
            "data" => $author
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function edit(Author $author)
    {
        return view("authors.edit", [
            "data" => $author
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Author $author)
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
        $author->update($coll->toArray());

        return redirect()->route("authors.show", $author)->with("message", "Успешно обновлено");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        $author->delete();

        return redirect()->route("authors.index")->with("message", "Успешно удалено");
    }
}
