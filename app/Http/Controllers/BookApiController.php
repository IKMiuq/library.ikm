<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Validator;

class BookApiController extends Controller
{
    public function index() 
    {
        return json_encode(Book::all(), JSON_UNESCAPED_UNICODE);
    }

    public function store(Request $request) 
    {
        $books = $request->all();
        $access = '';
        if (is_array($books)) {
            $rules = [
                '*.name' => 'required',
                '*.genre' => 'required',
                '*.description' => 'required',
                '*.author' => 'required|integer'
            ];
            $validate = $this->validate($request, $rules);
            foreach ($books as $book) {
                $access .= Book::create([
                    'name' => $book['name'],
                    'genre' => $book['genre'],
                    'description' => $book['description'],
                    'author' => $book['author'],
                ]);
            }
        } else {
            request()->validate([
                'name' => 'required',
                'genre' => 'required',
                'description' => 'required',
                'author' => 'required|integer',
            ]);
            $access = Book::create([
                'name' => request('name'),
                'genre' => request('genre'),
                'description' => request('description'),
                'author' => request('author'),
            ]);
        }
        return $access;
    }

    public function update(Book $book) 
    {
        request()->validate([
            'name' => 'required',
            'genre' => 'required',
            'description' => 'required',
            'author' => 'required|integer',
        ]);
    
        $success = $book->update([
            'name' => request('name'),
            'genre' => request('genre'),
            'description' => request('description'),
            'author' => request('author'),
        ]);
    
        return [
            'success' => $success
        ];
    }

    public function delete(Book $book)
    {
        $success = $book->delete();

        return [
            'success' => $success
        ];
    }
}
