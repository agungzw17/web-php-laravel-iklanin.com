<?php

namespace App\Http\Controllers\Giver;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\Http\Requests\ApplyRequest;
use App\Appliance;
use App\Http\Requests\ReceiveApplyRequest;
use App\Http\Requests\GiverPostsRequest;
use App\Images;

class GiverPagesController extends Controller
{
    public function postListPage($id)
    {
        $post = Post::all()->where('user_id', $id);

        $totalAppliances = 0;
        $totalPengiklan = 0;
        //total appliances,pengiklan
        foreach($post as $p){
            $totalAppliances = Appliance::all()->where('post_id', $p->id)->count();
            $totalPengiklan = Appliance::all()->where('post_id', $p->id)->where('status', '2')->count();
        }


        return view('giver.pages.postList', compact('post', 'totalAppliances', 'totalPengiklan'));
    }

    public function postUpdate(GiverPostsRequest $request, $id){
        $posts = Post::findOrfail($id);

        if($request->content_image == null) {
            $input = array(
                "role" => $request->role,
                "user_id" => $request->giver_id ,
                "title" => $request->title ,
                "description" => $request->description ,
                "limit" => $request->limit ,
                "price" => $request->price ,
                "share_type" => $request->share_type ,
                "content_title" => $request->content_title ,
                "content_description" => $request->content_description
             );
        } else {
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
                "content_image" => $content_image
            );
        }

        // $images = array();
        // if($file = $request->file('file')){
        //     foreach ($file as $f){
        //         $name = time() . $f->getClientOriginalName();

        //         $f->move('other_posts_images', $name);
        //         $user = Auth::user();
        //         Images::create(['user_id' => $request->giver_id, 'file' => $name, 'post_id' => $request->post_id]);

        //     }
        // }


         $posts->update($input);

         return redirect()->back()->with('success', 'success');
    }

    public function postApplyStore(ApplyRequest $request){
        $input = $request->all();
        Appliance::create($input);

        return redirect()->back()->with('success', 'success');
    }

    public function appliancesPage($id)
    {
        $post_title = Post::where('id', $id)->first()->title;
        $appliances = Appliance::all()->where('post_id', $id);
        return view('giver.pages.appliances', compact('appliances', 'post_title'));
    }

    public function receiveAppliancesUpdate(ReceiveApplyRequest $request, $id){
        $appliances = Appliance::findOrfail($id);
        $input = $request->all();
        if($request->transfer_prove == null) {
            if($file = $request->file('transfer_prove')){
                $name = time() . $file->getClientOriginalName();
                $file->move('appliances_images', $name);

                $input['transfer_prove'] = $name;
            }
            $input['status'] = $request->status;

        } else {
            if($file = $request->file('transfer_prove')){
                $name = time() . $file->getClientOriginalName();
                $file->move('appliances_images', $name);

                $input['transfer_prove'] = $name;
            }
            $input['status'] = 3;
        }
        if($file = $request->file('content_image'))
            {
                
                $content_image = time().$file->getClientOriginalName();
                $file->move('posts-images', $content_image);
            }
            $input['content_image'] = $content_image;
        $appliances->update($input);

        return redirect()->back()->with('success', 'success');
    }

    public function appliedAdvertisementLisPage($id)
    {
        $userId = $id;
        $listAppliedIklan = Appliance::all()->where('finder_id', $userId);
        $otherImages = Images::all();

        return view('giver.pages.appliedAdvertisement', compact('listAppliedIklan', 'otherImages'));
    }
}
