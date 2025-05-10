<?php

namespace App\Http\Controllers;

use App\Services\Post;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index($slug): string
    {
        $postClass = new Post;
        $post = $postClass->getPostData($slug . '.md');
        return view('article', compact('post'));
    }
}
