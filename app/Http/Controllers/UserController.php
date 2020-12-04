<?php
namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Posts;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller {
  /*
   * Display all of the posts of a particular user
   * 
   * @param Request $request
   * @return view
   */
    public function user_posts_all() {
        $user = Auth::user();
        $posts = Posts::where('author_id',$user->id)->orderBy('created_at','desc')->paginate(5);
        $title = "My Posts";
        $orderby = 'desc';
        return view('home')->withPosts($posts)->withTitle($title)->withOrderBy($orderby);
    }

    public function logout() {
        Auth::logout();
    }
}