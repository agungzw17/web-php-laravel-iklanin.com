<?php

namespace App\Http\Controllers\Finder;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\Http\Requests\ApplyRequest;
use App\Appliance;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AppliedAdvertisementRequest;

use Illuminate\Support\Facades\Storage;
use Response;
use File;
use App\Images;
use App\Http\Requests\FinderPostsRequest;
use App\Http\Requests\ReceiveApplyRequest;


class FinderPagesController extends Controller
{
    public function appliedAdvertisementLisPage($id)
    {
        $userId = $id;
        $listAppliedIklan = Appliance::all()->where('finder_id', $userId);
        $otherImages = Images::all();

        return view('finder.pages.appliedAdvertisement', compact('listAppliedIklan', 'otherImages'));
    }

    public function appliedAdvertisementLisPageUpdate(AppliedAdvertisementRequest $request, $id)
    {
        $appliances = Appliance::findOrfail($id);
        $appliances->update($request->all());

        return redirect()->back();
    }

    public function transactionsPage($id)
    {
        $appliances = Appliance::all()->where('finder_id', $id)->whereNotNull('transfer_prove')->whereNotIn('transfer_prove', '');
        $otherAppliances = Appliance::all()->where('giver_id', $id)->whereNotNull('transfer_prove')->whereNotIn('transfer_prove', '');
        return view('finder.pages.transactions', compact('appliances', 'otherAppliances'));
    }

    function getFile($filename){
        $file= public_path(). "/appliances_images/$filename";
        return response()->download($file);
    }

    function getContentImageFile($filename){
        $file= public_path(). "/posts-images/$filename";
        return response()->download($file);
    }
    function getOtherContentImageFile($filename){
        $file= public_path(). "/other_posts_images/$filename";
        return response()->download($file);
    }

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


        return view('finder.pages.postList', compact('post', 'totalAppliances', 'totalPengiklan'));
    }

    public function postListPageUpdate(FinderPostsRequest $request, $id){
        $post = Post::findOrfail($id);
        $input = $request->all();
        $input['price'] = $request->price;

        $post->update($input);

        return redirect()->back()->with('success', 'success');
    }

    public function appliancesPage($id)
    {
        $post_title = Post::where('id', $id)->first()->title;
        $appliances = Appliance::all()->where('post_id', $id);
        $otherImages = Images::all();
        return view('finder.pages.appliances', compact('appliances', 'otherImages', 'post_title'));
    }

    public function appliancesUpdate(ReceiveApplyRequest $request, $id){
        $appliances = Appliance::findOrfail($id);
        $input = $request->all();

        $appliances->update($input);

        return redirect()->back()->with('success', 'success');
    }
}
