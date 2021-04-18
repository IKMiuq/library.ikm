<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Validator;

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

    public function page($number, $count)
    {
        $comments = DB::table('comments')->get();
        $request = "";
        $all_count = count($comments);
        /*if ($all_count > $count) {
            $request = array_slice($comments, 0, $number);
        }*/

        return [
            'success' => $request //$number
        ];
    }
}
