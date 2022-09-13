<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkadmin');
    }
    public function all_comments()
    {   
            $comments = Comment::with('user')->whereNull('comment_id')->get();
            return view('backend.comments.index',compact('comments'));
        
    } 

}
