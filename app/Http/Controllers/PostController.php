<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function search(Request $request)
    {
        $q = $request->get('q');
        $paginator = [];
        if ($q) {
            $paginator = Post::search($q)->paginate();
        }

        return view('search', compact('paginator', 'q'));
    }
}
