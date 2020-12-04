<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Posts;
use GuzzleHttp\Client;
use App\Models\User;

class PostController extends Controller
{
    public function index() {
        // get current user id
        $author_id = $this->get_user_id();

        if(!$author_id) {
            //fetch 5 posts from database which are latest
            $posts = Posts::orderBy('created_at','desc')->paginate(5);
        } else {
            //fetch 5 posts from database which are latest
            $posts = Posts::where('author_id', $author_id)->orderBy('created_at','desc')->paginate(5);
        }
        
        $title = 'All Posts';    //page heading
        $orderby = 'desc';   // page orderby

        return view('home')->withPosts($posts)->withTitle($title)->withOrderBy($orderby);
    }

    public function home(Request $request) {
        $orderby = isset($request->orderby)? $request->orderby : 'desc';
        $title = isset($request->title)? $request->title : 'My Posts';
        $author_id = $this->get_user_id();

        if(!$author_id) {
            //fetch 5 posts from database which are latest
            $posts = Posts::orderBy('created_at', $orderby)->paginate(5);
        } else {
            //fetch 5 posts from database which are latest
            $posts = Posts::where('author_id', $author_id)->orderBy('created_at', $orderby)->paginate(5);
        }        

        return view('home')->withPosts($posts)->withTitle($title)->withOrderBy($orderby);
    }

    public function create() {        
        return view('posts.create');
    }

    public function store(Request $request) {
        $post = new Posts();
        $post->title = $request->get('title');
        $post->description = $request->get('description');
        $post->slug = Str::slug($post->title);

        // check if same blog already exist
        $duplicate = Posts::where('slug', $post->slug)->first();
        if ($duplicate) {
            return redirect('create')->withErrors('Title already exists.')->withInput();
        }

        $post->author_id = $request->user()->id;
        $post->save();

        return redirect('home');
    }

    public function get_user_id() {
        return Auth::user()? Auth::user()->id : NULL;
    }
}
