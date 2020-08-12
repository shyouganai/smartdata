<?php

namespace App\Http\Controllers;

use App\Author;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return view("welcome", [
            "authors" => Author::all()
        ]);
    }
}
