<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentApiController extends Controller
{
    public function index() 
    {
        return json_encode(Comment::all(), JSON_UNESCAPED_UNICODE);
    }

    public function store() 
    {
        request()->validate([
            'surname' => 'required',
            'name' => 'required',
            'patronymic' => 'required',
            'biography' => 'required',
        ]);
    
        return Comment::create([
            'surname' => request('surname'),
            'name' => request('name'),
            'patronymic' => request('patronymic'),
            'biography' => request('biography'),
        ]);
    }

    public function update(Comment $comment) 
    {
        request()->validate([
            'surname' => 'required',
            'name' => 'required',
            'patronymic' => 'required',
            'biography' => 'required',
        ]);
    
        $success = $comment->update([
            'surname' => request('surname'),
            'name' => request('name'),
            'patronymic' => request('patronymic'),
            'biography' => request('biography'),
        ]);
    
        return [
            'success' => $success
        ];
    }

    public function delete(Comment $comment)
    {
        $success = $comment->delete();

        return [
            'success' => $success
        ];
    }
}
