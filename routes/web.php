<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

// Main Route
Route::get('/', 'MainPagesController@landingPage')->name('landingPage');
Route::get('/masuk', 'MainPagesController@loginPage')->name('loginPage');

Route::get('/pilihanDaftar', 'MainPagesController@registerPage')->name('registerPage');
// Store Register
Route::post('/pilihanDaftar/store', 'AuthController@registerStore')->name('registerPage.store');

// Beranda
Route::middleware('auth')->group(function (){
    Route::get('/home', 'MainPagesController@homePage')->name('home');

    Route::get('/home/posts/giver/create', 'PostsController@createGiver')->name('create.post.giver');
    Route::post('/home/posts/giver/create/store', 'PostsController@createGiverStore')->name('createGiver.store');

    Route::get('/home/posts/finder/create', 'PostsController@createFinder')->name('create.post.finder');
    Route::post('/home/posts/finder/create/store', 'PostsController@createFinderStore')->name('createFinder.store');
 
    Route::get('/giver/permintaanIklan/{id}', 'Giver\GiverPagesController@appliancesPage')->name('applianceList');
    Route::get('/finder/permintaanIklan/{id}', 'Finder\FinderPagesController@appliancesPage')->name('applianceListFinder');

    Route::get('/giver/listPost/{id}', 'Giver\GiverPagesController@postListPage')->name('postList');
    Route::get('/finder/listPost/{id}', 'Finder\FinderPagesController@postListPage')->name('postListFinder');

    // Detail Iklan
    Route::get('/detail/{id}', 'MainPagesController@detailPage')->name('detail');
    // Store Apply
    Route::post('/detail/store', 'Giver\GiverPagesController@postApplyStore')->name('postApply.store');

    // Finder
    Route::get('/finder/appliedAdvertisementList/{id}', 'Finder\FinderPagesController@appliedAdvertisementLisPage')->name('appliedAdvertisementLisPage');
    Route::get('/giver/appliedAdvertisementList/{id}', 'Giver\GiverPagesController@appliedAdvertisementLisPage')->name('appliedAdvertisementLisPageGiver');

    //Accept||Reject Appliances
    Route::post('/giver/permintaanIklan/receive/update/{id}', 'Giver\GiverPagesController@receiveAppliancesUpdate')->name('receiveAppliances.update');
    Route::post('/finder/permintaanIklan/inputHarga/update/{id}', 'Finder\FinderPagesController@appliancesUpdate')->name('appliancesUpdate.update');
    //Finder masukan link
    Route::post('/finder/appliedAdvertisementList/update/{id}', 'Finder\FinderPagesController@appliedAdvertisementLisPageUpdate')->name('appliedAdvertisementLisPage.update');
    Route::get('/finder/transactions/{id}', 'Finder\FinderPagesController@transactionsPage')->name('transactions.page');

    Route::get('/home/search', 'MainPagesController@searchHomePage')->name('search.home');
    Route::get('/home/instagram', 'MainPagesController@searchInstagramHomePage')->name('search.instagram.home');
    Route::get('/home/facebook', 'MainPagesController@searchFacebookHomePage')->name('search.facebook.home');
    Route::get('/home/twitter', 'MainPagesController@searchTwitterHomePage')->name('search.twitter.home');
    Route::get('/home/rentang-bayaran', 'MainPagesController@searchRentangBayaranPage')->name('search.rentang.bayaran.home');

    Route::post('/giver/post/update/{id}', 'Giver\GiverPagesController@postUpdate')->name('post.update');

    Route::get('get/{filename}', 'Finder\FinderPagesController@getFile')->name('getfile');
    Route::get('getContentImage/{filename}', 'Finder\FinderPagesController@getContentImageFile')->name('getContentImageFile');
    Route::get('getOtherContentImage/{filename}', 'Finder\FinderPagesController@getOtherContentImageFile')->name('getOtherContentImageFile');

    Route::post('/finder/PostList/update/{id}', 'Finder\FinderPagesController@postListPageUpdate')->name('postListPageFinder.update');
});

Route::get('/for-logout', 'HomeController@index');


