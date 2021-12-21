<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();

        if(count($books)>0)
        {
            return response([
                'message' => 'Retrieve All Success',
                'data' => $books
            ],200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ],400);
    }

    public function show($id)
    {
        $book = Book::find($id);

        if(!is_null($book))
        {
            return response([
                'message' => 'Retrieve Book Success',
                'data' => $book
            ],200);
        }

        return response([
            'message' => 'Book Not Found',
            'data' => null
        ],404);
    }

    public function store(Request $request)
    {
        $storeData = $request->all();
        $validate = Validator::make($storeData,[
            'judul' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun' => 'required|numeric',
            'stok' => 'required|numeric'
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()],400);

        $book = Book::create($storeData);    
        return response([
            'message' => 'Add Book Success',
            'data' => $book
        ],200);
    }

    public function destroy($id)
    {
        $book = Book::find($id);

        if(is_null($book))
        {
            return response([
                'message' => 'Book Not Found',
                'data' => null
            ],404);
        }

        if($book->delete())
        {
            return response([
                'message' => 'Delete Books Success',
                'data' => $book
            ],200);
        }

        return response([
            'message' => 'Delete Book Failed',
            'data' => null
        ],400);
    }

    public function update(Request $request,$id)
    {
        $book = Book::find($id);
        if(is_null($book))
        {
            return response([
                'message' => 'Book Not Found',
                'data' => null
            ],404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData,[
            'judul' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun' => 'required|numeric',
            'stok' => 'required|numeric'
        ]);

        if ($validate->fails())
            return response(['message' => $validate->errors()],400);

        $book->judul = $updateData['judul'];
        $book->penulis = $updateData['penulis'];
        $book->penerbit = $updateData['penerbit'];
        $book->tahun = $updateData['tahun'];
        $book->stok = $updateData['stok'];

        if($book->save())
        {
            return response([
                'message' => 'Update Book Success',
                'data' => $book
            ],200);
        }

        return response([
            'message' => 'Update Book Failed',
            'data' => null
        ],400);
    }
}
