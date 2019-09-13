<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;

class BookController extends Controller
{

    public  function  store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'release_date' => 'required',
            'author_id' => 'required'
        ]);
        $book = new Book();

        $book->title = $request->input('title');
        $book->release_date = $request->input('release_date');
        $book->author_id =  $request->input('author_id');

        if($book->save()) {
            return response()->json($book,201);
        }
        return response(["msg"=>"An error occured"],404);
    }
}
