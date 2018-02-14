<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\User;
use App\Role;
use App\Like;
use DB;
class PagesController extends Controller
{
    public function posts() {
        $posts = Post::all();
        return view('content.posts', compact('posts'));
    }

    public function post(Post $post) {

        return view('content.post', compact('post'));
    }

    public function cat() {
        $cats = DB::table('categories')->get();
        return view('content.posts', compact('cats'));
    }


    public function category($name) {
        $cats = DB::table('categories')->where('name', $name)->value('id');
        $posts= DB::table('posts')->where('category_id', $cats)->get();
        return view('content.category', compact('posts'));
    }

    public function store(Request $request) {
        $this->validate(request(), [
            'title' => 'required|min:5|max:32',
            'body'  => 'required|min:5|max:120',
            'url'   => "image|mimes:jpg,jpeg,gif,png|max:3072",

        ]);
        $img_name = time() . "." . $request->url->getClientOriginalExtension();

        $post = new Post;
        $post->title = request('title');
        $post->body = request('body');
        $post->url = $img_name;
        $post->category_id = request('cat');
        $post->save();

        $request->url->move(public_path('upload'), $img_name);

        return redirect('/posts');
    }

    public  function  admin() {
        $users = User::all();
        return view('content.admin', compact('users'));
    }

    public function addRole(Request $request) {
        $user = user::where('id', $request['id'])->first();
        $user->roles()->detach();
        if ($request['role-user']) {
            $user->roles()->attach(Role::where('name', 'user')->first());
        }
        if ($request['role-admin']) {
            $user->roles()->attach(Role::where('name', 'admin')->first());
        }
        return redirect()->back();
    }

    public function destroy(Post $post) {
        $post->delete();
        return back();
    }

    public function like(Request $request) {
        $like_s = $request->like_s;
        $post_id = $request->post_id;
        $change_like = 0;
        $like = DB::table('likes')->where('post_id', $post_id)->where('user_id', Auth::user()->id)->first();
        if (!$like) {
            $new_like = new Like;
            $new_like->post_id = $post_id;
            $new_like->user_id = Auth::user()->id;
            $new_like->like = 1;
            $new_like->save();
            $is_like = 1;
        } elseif($like->like == 1) {
            DB::table('likes')->where('post_id', $post_id)->where('user_id', Auth::user()->id)->delete();
            $is_like = 0;
        } elseif($like->like == 0) {
            DB::table('likes')->where('post_id', $post_id)->where('user_id', Auth::user()->id)->update(['like' => 1]);
            $is_like = 1;
            $change_like = 1;
        }
        $response = array(
                'is_like' => $is_like,
                'change_like'   => $change_like,
        );
        return response()->json($response,200);
    }
    public function dislike(Request $request) {
        $like_s = $request->like_s;
        $post_id = $request->post_id;
        $change_dislike = 0;
        $dislike = DB::table('likes')->where('post_id', $post_id)->where('user_id', Auth::user()->id)->first();
        if (!$dislike) {
            $new_like = new Like;
            $new_like->post_id = $post_id;
            $new_like->user_id = Auth::user()->id;
            $new_like->like = 0;
            $new_like->save();
            $is_dislike = 1;
        } elseif($dislike->like == 0) {
            DB::table('likes')->where('post_id', $post_id)->where('user_id', Auth::user()->id)->delete();
            $is_dislike = 0;
        } elseif($dislike->like == 1) {
            DB::table('likes')->where('post_id', $post_id)->where('user_id', Auth::user()->id)->update(['like' => 0]);
            $is_dislike = 1;
            $change_dislike = 1;
        }
        $response = array(
            'is_dislike' => $is_dislike,
            'change_dislike' => $change_dislike,
        );
        return response()->json($response,200);
    }
}
