<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Requests\UserRegisterChoicesPage;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\Appliance;
use App\Http\Requests\SearchRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class MainPagesController extends Controller
{
    public function landingPage()
    {
        $user = Auth::user();

        return view('main.landing', compact('user'));
    }

    public function registerPage()
    {
        $user = Auth::user();

        return view('main.landingRegister', compact('user'));
    }

    public function homePage(Request $request)
    {
        $user = Auth::user();
        $totalSaldo = 0;
        
        if($user->role_name == "1") {
            $posts = Post::all()->where('role', "2");
            $totalSaldo = Appliance::all()->where('finder_id', $user->id)->whereNotNull('transfer_prove')->whereNotIn('transfer_prove', '')->sum('price');
            $OtherTotalSaldo = Appliance::all()->where('giver_id', $user->id)->whereNotNull('transfer_prove')->whereNotIn('transfer_prove', '')->sum('price');
            if($totalSaldo == '[]') {
                $totalSaldo = 0;
            }
            
            if($OtherTotalSaldo == '[]') {
                $OtherTotalSaldo = 0;
            }

            $TOTAL = $totalSaldo + $OtherTotalSaldo;

            $request->session()->put('all', 'active');
            $request->session()->pull('instagram', 'active');
            $request->session()->pull('facebook', 'active');
            $request->session()->pull('twitter', 'active');

            return view('main.home', compact('user', 'posts', 'totalSaldo', 'OtherTotalSaldo' ,'TOTAL'));
        }
        if($user->role_name == "2") {
            $posts = Post::all()->where('role', "1");

            $request->session()->put('all', 'active');
            $request->session()->pull('instagram', 'active');
            $request->session()->pull('facebook', 'active');
            $request->session()->pull('twitter', 'active');

            //unique_id
            $post_id = mt_rand(1, 999999999999999);

            return view('main.home', compact('user', 'posts', 'totalSaldo', 'post_id'));
        }
        $posts = Post::all();

        $request->session()->put('all', 'active');
        $request->session()->pull('instagram', 'active');
        $request->session()->pull('facebook', 'active');
        $request->session()->pull('twitter', 'active');

        return view('main.home', compact('user', 'posts', 'totalSaldo'));
    }

    public function searchHomePage(SearchRequest $request)
    {
        $user = Auth::user();
        $totalSaldo = 0;
        if($user->role_name == "1") {
            $posts = Post::query()->where('role', "2")->where('title', 'like', '%'. $request->search. '%')->get();
            $totalSaldo = Appliance::all()->where('finder_id', $user->id)->whereNotNull('transfer_prove')->whereNotIn('transfer_prove', '')->sum('price');
            $OtherTotalSaldo = Appliance::all()->where('giver_id', $user->id)->whereNotNull('transfer_prove')->whereNotIn('transfer_prove', '')->sum('price');
            if($totalSaldo == '[]') {
                $totalSaldo = 0;
            }
            
            if($OtherTotalSaldo == '[]') {
                $OtherTotalSaldo = 0;
            }

            $TOTAL = $totalSaldo + $OtherTotalSaldo;

            $request->session()->put('all', 'active');
            $request->session()->pull('instagram', 'active');
            $request->session()->pull('facebook', 'active');
            $request->session()->pull('twitter', 'active');

            return view('main.home', compact('user', 'posts', 'totalSaldo', 'OtherTotalSaldo' ,'TOTAL'));
        }
        if($user->role_name == "2") {
            $posts = Post::query()->where('role', "1")->where('title', 'like', '%'. $request->search. '%')->get();

            $request->session()->put('all', 'active');
            $request->session()->pull('instagram', 'active');
            $request->session()->pull('facebook', 'active');
            $request->session()->pull('twitter', 'active');

            //unique_id
            $post_id = mt_rand(1, 999999999999999);

            return view('main.home', compact('user', 'posts', 'totalSaldo', 'post_id'));
        }
        $posts = Post::all();

        $request->session()->put('all', 'active');
        $request->session()->pull('instagram', 'active');
        $request->session()->pull('facebook', 'active');
        $request->session()->pull('twitter', 'active');

        return view('main.home', compact('user', 'posts', 'totalSaldo'));
    }

    public function searchInstagramHomePage(SearchRequest $request)
    {
        $user = Auth::user();
        $totalSaldo = 0;
        if($user->role_name == "1") {
            $posts = Post::all()->where('role', "2")->where('share_type', $request->instagram);
            $totalSaldo = Appliance::all()->where('finder_id', $user->id)->whereNotNull('transfer_prove')->whereNotIn('transfer_prove', '')->sum('price');
            $OtherTotalSaldo = Appliance::all()->where('giver_id', $user->id)->whereNotNull('transfer_prove')->whereNotIn('transfer_prove', '')->sum('price');
            if($totalSaldo == '[]') {
                $totalSaldo = 0;
            }
            
            if($OtherTotalSaldo == '[]') {
                $OtherTotalSaldo = 0;
            }

            $TOTAL = $totalSaldo + $OtherTotalSaldo;

            $request->session()->pull('all', 'active');
            $request->session()->put('instagram', 'active');
            $request->session()->pull('facebook', 'active');
            $request->session()->pull('twitter', 'active');

            return view('main.home', compact('user', 'posts', 'totalSaldo', 'OtherTotalSaldo' ,'TOTAL'));
        }
        if($user->role_name == "2") {
            $posts = Post::all()->where('role', "1")->where('share_type', $request->instagram);

            $request->session()->pull('all', 'active');
            $request->session()->put('instagram', 'active');
            $request->session()->pull('facebook', 'active');
            $request->session()->pull('twitter', 'active');

            //unique_id
            $post_id = mt_rand(1, 999999999999999);

            return view('main.home', compact('user', 'posts', 'totalSaldo', 'post_id'));
        }
        $posts = Post::all();

        $request->session()->pull('all', 'active');
        $request->session()->put('instagram', 'active');
        $request->session()->pull('facebook', 'active');
        $request->session()->pull('twitter', 'active');

       

        return view('main.home', compact('user', 'posts', 'totalSaldo'));
    }

    public function searchFacebookHomePage(SearchRequest $request)
    {
        $user = Auth::user();
        $totalSaldo = 0;
        if($user->role_name == "1") {
            $posts = Post::all()->where('role', "2")->where('share_type', $request->facebook);
            $totalSaldo = Appliance::all()->where('finder_id', $user->id)->whereNotNull('transfer_prove')->whereNotIn('transfer_prove', '')->sum('price');
            $OtherTotalSaldo = Appliance::all()->where('giver_id', $user->id)->whereNotNull('transfer_prove')->whereNotIn('transfer_prove', '')->sum('price');
            if($totalSaldo == '[]') {
                $totalSaldo = 0;
            }
            
            if($OtherTotalSaldo == '[]') {
                $OtherTotalSaldo = 0;
            }

            $TOTAL = $totalSaldo + $OtherTotalSaldo;

            $request->session()->pull('all', 'active');
            $request->session()->pull('instagram', 'active');
            $request->session()->put('facebook', 'active');
            $request->session()->pull('twitter', 'active');

            return view('main.home', compact('user', 'posts', 'totalSaldo', 'OtherTotalSaldo' ,'TOTAL'));
        }
        if($user->role_name == "2") {
            $posts = Post::all()->where('role', "1")->where('share_type', $request->facebook);

            $request->session()->pull('all', 'active');
            $request->session()->pull('instagram', 'active');
            $request->session()->put('facebook', 'active');
            $request->session()->pull('twitter', 'active');

            //unique_id
            $post_id = mt_rand(1, 999999999999999);

            return view('main.home', compact('user', 'posts', 'totalSaldo', 'post_id'));
        }
        $posts = Post::all();

        $request->session()->pull('all', 'active');
        $request->session()->pull('instagram', 'active');
        $request->session()->put('facebook', 'active');
        $request->session()->pull('twitter', 'active');

        return view('main.home', compact('user', 'posts', 'totalSaldo'));
    }

    public function searchTwitterHomePage(SearchRequest $request)
    {
        $user = Auth::user();
        $totalSaldo = 0;
        if($user->role_name == "1") {
            $posts = Post::all()->where('role', "2")->where('share_type', $request->twitter);
            $totalSaldo = Appliance::all()->where('finder_id', $user->id)->whereNotNull('transfer_prove')->whereNotIn('transfer_prove', '')->sum('price');
            $OtherTotalSaldo = Appliance::all()->where('giver_id', $user->id)->whereNotNull('transfer_prove')->whereNotIn('transfer_prove', '')->sum('price');
            if($totalSaldo == '[]') {
                $totalSaldo = 0;
            }
            
            if($OtherTotalSaldo == '[]') {
                $OtherTotalSaldo = 0;
            }

            $TOTAL = $totalSaldo + $OtherTotalSaldo;

            $request->session()->pull('all', 'active');
            $request->session()->pull('instagram', 'active');
            $request->session()->pull('facebook', 'active');
            $request->session()->put('twitter', 'active');

            return view('main.home', compact('user', 'posts', 'totalSaldo', 'OtherTotalSaldo' ,'TOTAL'));
        }
        if($user->role_name == "2") {
            $posts = Post::all()->where('role', "1")->where('share_type', $request->twitter);

            $request->session()->pull('all', 'active');
            $request->session()->pull('instagram', 'active');
            $request->session()->pull('facebook', 'active');
            $request->session()->put('twitter', 'active');

            //unique_id
            $post_id = mt_rand(1, 999999999999999);

            return view('main.home', compact('user', 'posts', 'totalSaldo', 'post_id'));
        }
        $posts = Post::all();

        $request->session()->pull('all', 'active');
        $request->session()->pull('instagram', 'active');
        $request->session()->pull('facebook', 'active');
        $request->session()->put('twitter', 'active');

        return view('main.home', compact('user', 'posts', 'totalSaldo'));
    }

    public function searchRentangBayaranPage(SearchRequest $request)
    {
        $user = Auth::user();
        $totalSaldo = 0;
        if($user->role_name == "1") {
            if($request->rentang_bayaran == 1){
                $posts = Post::all()->where('role', "2")->where('price' , '>=', 5000)->where('price', '<=', 10000);
                // dd($posts);
            }
            if($request->rentang_bayaran == 2){
                $posts = Post::all()->where('role', "2")->where('price' , '>=', 15000)->where('price', '<=', 20000);
                // dd($posts);
            }
            $totalSaldo = Appliance::all()->where('finder_id', $user->id)->whereNotNull('transfer_prove')->whereNotIn('transfer_prove', '')->sum('price');
            $OtherTotalSaldo = Appliance::all()->where('giver_id', $user->id)->whereNotNull('transfer_prove')->whereNotIn('transfer_prove', '')->sum('price');
            if($totalSaldo == '[]') {
                $totalSaldo = 0;
            }
            
            if($OtherTotalSaldo == '[]') {
                $OtherTotalSaldo = 0;
            }

            $TOTAL = $totalSaldo + $OtherTotalSaldo;
            return view('main.home', compact('user', 'posts', 'totalSaldo', 'OtherTotalSaldo' ,'TOTAL'));
        }
        if($user->role_name == "2") {
            if($request->rentang_bayaran == 1){
                $posts = Post::all()->where('role', "1")->where('price' , '>=', 5000)->where('price', '<=', 10000);
                // dd($posts);
            }
            if($request->rentang_bayaran == 2){
                $posts = Post::all()->where('role', "1")->where('price' , '>=', 15000)->where('price', '<=', 20000);
                // dd($posts);
            }
            //unique_id
            $post_id = mt_rand(1, 999999999999999);
            return view('main.home', compact('user', 'posts', 'totalSaldo', 'post_id'));
        }
        $posts = Post::all();
        return view('main.home', compact('user', 'posts', 'totalSaldo'));
    }

    public function detailPage($id)
    {
        $user = Auth::user();
        $postDetail = Post::findOrfail($id);

        $postDetail->user_name = User::where('id', $postDetail->user_id)->first()->name;
        if(!empty(Appliance::where(['post_id' => $id, 'finder_id' => $user->id])->first())) {
            $appliances = Appliance::where(['post_id' => $id, 'finder_id' => $user->id])->first()->status;

            if($appliances != 0 || $appliances != 1 || $appliances == null) {
                $user->appliance = 1;
            } else {
                $user->appliance = 0;
            }
        } else {
            $user->appliance = 0;
        }

        $appliancesSlot = Appliance::all()->where('status', 2)->where('post_id', $id)->count();

        return view('main.detail', compact('user', 'postDetail', 'appliancesSlot'));
    }

    public function loginPage()
    {
        $user = Auth::user();

        return view('main.login', compact('user'));
    }
}
