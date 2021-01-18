<?php

namespace App\Http\Controllers\Api;

use App\Author;
use App\Book;
use App\Http\Controllers\Controller;
use App\Http\Resources\AuthorResource;
use App\Http\Resources\BookResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Author::query()->orderByDesc('id')->get();
        return AuthorResource::collection($data);
    }

    /**
     * Display the specified resource.
     *
     */
    public function show(Author $author)
    {
        return new AuthorResource($author);
    }

    public function store(Request $request)
    {
        $v = Validator::make($request->all(), [
            'name' => 'required|unique:authors',
            'bio' => 'required',
            'birth_date' => 'required|date',
            'died_date' => 'nullable|date',
        ]);

        if ($v->fails())
            return response()->json($v->errors(), 422);

        $author = Author::query()->create($request->all());

        return new AuthorResource($author);
    }

    public function uploadImage(Request $request, $author_id)
    {
        $v = Validator::make($request->all(), [
            'file' => 'required|file',
        ]);

        if ($v->fails())
            return response()->json($v->errors(), 422);

        $author = Author::query()->findOrFail($author_id);

        $file = $request->file("file");
        $fileName = Str::random() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path("images"), $fileName);

        if (!empty($author->image))
            unlink(public_path("images/" . $author->image));

        $author->update(['image' => $fileName]);

        return response()->json(['data' => ['image' => $author->imageUrl()]]);
    }

    public function books(Request $request, $author_id)
    {
        $data = Book::query()->where('author_id', $author_id)->get();

        return BookResource::collection($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Author $author)
    {
        $v = Validator::make($request->all(), [
            'birth_date' => 'date',
            'died_date' => 'date',
        ]);

        if ($v->fails())
            return response()->json($v->errors(), 422);

        $author->update($request->all());

        return new AuthorResource($author);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        $author->books()->delete();
        $author->delete();

        return response(null, 204);
    }
}
