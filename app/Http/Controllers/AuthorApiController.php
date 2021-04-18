<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Validator;

class AuthorApiController extends Controller
{
    public function index() 
    {
        return json_encode(Author::all(), JSON_UNESCAPED_UNICODE);
    }

    public function store(Request $request) 
    {
        $authors = $request->all();
        $access = '';
        if (is_array($authors)) {
            $rules = [
                '*.surname' => 'required',
                '*.name' => 'required',
                '*.patronymic' => 'required',
                '*.biography' => 'required'
            ];
            $validate = $this->validate($request, $rules);
            foreach ($authors as $author) {
                $access .= Author::create([
                    'surname' => $author['surname'],
                    'name' => $author['name'],
                    'patronymic' => $author['patronymic'],
                    'biography' => $author['biography'],
                ]);
            }
        } else {
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
}
