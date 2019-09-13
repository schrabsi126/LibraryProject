<?php

namespace App\Http\Controllers;

use App\Author;
use App\Book;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Validator;

class AuthorController extends Controller
{

    public function index()
    {
        $authors= Author::all();
        foreach ($authors as $author)
        {
            $author['books']=$author->books();
        }
        return $authors;
    }

    public function showView(Request $request)
    {
        $authors= Author::paginate(5);
        foreach ($authors as $author)
        {
            $author['books']=$author->books();
        }

        if ($request->ajax()) {
            return view('showAuthors', compact('authors'));
        }

        return view('create',compact('authors'));
    }

    public  function  store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'age' => 'required',
            'address' => 'required',
            'release_date'=> 'required',
            'title'=> 'required'
        ]);
        $author =  new Author();
        $author->name = $request->input('name');
        $author->age = $request->input('age');
        $author->address =  $request->input('address');
        if($author->save()) {
            $BookController= new BookController();
            $bookRequest=new Request([
                'title' =>$request->input('title'),
                'release_date'=> $request->input('release_date'),
                'author_id' => $author->id
            ]);
            $BookController->store($bookRequest);
            return 'Data is successfully added';
            //return $this->showView(new Request());

        }
        return response(["msg"=>"An error occured"],404);
    }
}
