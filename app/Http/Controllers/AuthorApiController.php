<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthorApiController extends Controller
{
    public function index() 
    {
        return json_encode(Author::all(), JSON_UNESCAPED_UNICODE);
    }

    public function store() 
    {
        request()->validate([
            'surname' => 'required',
            'name' => 'required',
            'patronymic' => 'required',
            'biography' => 'required',
        ]);
    
        return Author::create([
            'surname' => request('surname'),
            'name' => request('name'),
            'patronymic' => request('patronymic'),
            'biography' => request('biography'),
        ]);
    }

    public function update(Author $author) 
    {
        request()->validate([
            'surname' => 'required',
            'name' => 'required',
            'patronymic' => 'required',
            'biography' => 'required',
        ]);
    
        $success = $author->update([
            'surname' => request('surname'),
            'name' => request('name'),
            'patronymic' => request('patronymic'),
            'biography' => request('biography'),
        ]);
    
        return [
            'success' => $success
        ];
    }

    public function delete(Author $author)
    {
        $success = $author->delete();

        return [
            'success' => $success
        ];
    }

    public function page($number, $count)
    {
        $authors = DB::table('authors')->get();
        $request = "";
        $all_count = count($authors);
        if ($all_count > $count) {
            $request = array_slice($authors, 0, 1);
        }

        return [
            'success' => $request //$number
        ];
    }
}
