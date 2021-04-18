<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookApiController extends Controller
{
    public function index() 
    {
        return json_encode(Book::all(), JSON_UNESCAPED_UNICODE);
    }

    public function store() 
    {
        request()->validate([
            'surname' => 'required',
            'name' => 'required',
            'patronymic' => 'required',
            'biography' => 'required',
        ]);
    
        return Book::create([
            'surname' => request('surname'),
            'name' => request('name'),
            'patronymic' => request('patronymic'),
            'biography' => request('biography'),
        ]);
    }

    public function update(Book $book) 
    {
        request()->validate([
            'surname' => 'required',
            'name' => 'required',
            'patronymic' => 'required',
            'biography' => 'required',
        ]);
    
        $success = $book->update([
            'surname' => request('surname'),
            'name' => request('name'),
            'patronymic' => request('patronymic'),
            'biography' => request('biography'),
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
