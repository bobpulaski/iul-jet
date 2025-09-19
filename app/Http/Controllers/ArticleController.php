<?php

namespace App\Http\Controllers;

use App\Services\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function index($slug): View
    {
        $postClass = new Post;
        $post = $postClass->getPostData($slug . '.md');
//        dd($post['meta']['title']);
        return view('article', compact('post'));
    }
}
