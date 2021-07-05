<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\PostRepository;
use App\Models\Category;
use App\Models\User;

class PostController extends Controller
{ 
    protected $postRepository;
    protected $nbrPages;
    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
        $this->nbrPages = config('app.nbrPages.posts');
    }
    public function index()
    {
        $posts = $this->postRepository->getActiveOrderByDate($this->nbrPages);
        $heros = $this->postRepository->getHeros();
        return view('front.index', compact('posts', 'heros'));
    }
    public function show(Request $request, $slug)
    {
        $post = $this->postRepository->getPostBySlug($slug);
        return view('front.post', compact('post'));
    }

        public function category(Category $category)
    {
        $posts = $this->postRepository->getActiveOrderByDateForCategory($this->nbrPages, $category->slug);
        $title = __('Posts for category ') . '<strong>' . $category->title . '</strong>';
        return view('front.index', compact('posts', 'title'));
    }
    public function user(User $user)
    {
        $posts = $this->postRepository->getActiveOrderByDateForUser($this->nbrPages, $user->id);
        $title = __('Posts for author ') . '<strong>' . $user->name . '</strong>';
        return view('front.index', compact('posts', 'title'));
    }
}
