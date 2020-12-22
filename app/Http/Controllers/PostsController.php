<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\GiverPostsRequest;
use App\Post;
use App\Http\Requests\FinderPostsRequest;
use App\Images;

class PostsController extends Controller
{
    public function createGiver()
    {
        $user = Auth::user();
        return view('giver.pages.posting', compact('user'));
    }

    public function createGiverStore(GiverPostsRequest $request)
    {
        $cekPostId = Post::all();

        foreach($cekPostId as $cek) {
            if ($cek -> post_id == $request->post_id) {
                return redirect()->back();
            }
        }

        if($file = $request->file('content_image'))
        {
            $content_image = time().$file->getClientOriginalName();
            $file->move('posts-images', $content_image);
        }
        $input = array(
            "role" => $request->role,
            "user_id" => $request->giver_id ,
            "title" => $request->title ,
            "description" => $request->description ,
            "limit" => $request->limit ,
            "price" => $request->price ,
            "share_type" => $request->share_type ,
            "content_title" => $request->content_title ,
            "content_description" => $request->content_description,
            "content_image" => $content_image,
            "post_id" => $request->post_id
         );

        $images = array();
        if($file = $request->file('file')){
            foreach ($file as $f){
                $name = time() . $f->getClientOriginalName();

                $f->move('other_posts_images', $name);
                $user = Auth::user();
                Images::create(['user_id' => $request->giver_id, 'file' => $name, 'post_id' => $request->post_id]);

            }
        }
         Post::create($input);

         return redirect('/home')->with('success', 'success');
    }

    public function createFinder()
    {
        $user = Auth::user();
        return view('finder.pages.posting', compact('user'));
    }

    public function createFinderStore(FinderPostsRequest $request)
    {
        if($file = $request->file('content_image'))
        {
            $content_image = time().$file->getClientOriginalName();
            $file->move('posts-images', $content_image);
        }
        $input = array(
            "role" => $request->role,
            "user_id" => $request->giver_id ,
            "title" => $request->title ,
            "description" => $request->description ,
            "limit" => 0 ,
            "price" =>  0,
            "share_type" => $request->share_type ,
            "content_title" => "-" ,
            "content_description" => "-",
            "content_image" => $content_image
         );
         Post::create($input);

         return redirect('/home')->with('success', 'success');
    }
}
