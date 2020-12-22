@extends('templates.appNormal')
@section('title', 'Beranda')
@section('content')
<style>
    body {
        background-color: rgb(247, 247, 247)
    }
</style>
@if(session('success'))
    <div class="flash-data" data-flashdata="<?= session('success') ?>"></div>
@endif

<div style="border-right: 1px solid lightGrey;
    color: white;
    height: 100%;
    width: 275px;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    background-color: #0275d8;
    overflow-x: hidden;
    padding-top: 20px;">
        <div class="container">
            <div class="container" style="text-align: center">
                <a class="navbar-brand" href="{{ url('/home') }}" style="color: white"><b>Iklanin</b>.com</a>
            </div>
            <hr style="background-color: white">
            <div class="row px-3">
                <div class="col-xl-3 col-md-3 mr-2">
                    <img src="{{ asset('sope.jpg') }}" alt="..." style="border-radius: 50%; width: 100px; height: 100px">
                </div>
                <div class="col-xl-6 col-md-6 ml-5 mt-3" style="font-size: 14px">
                    <b>{{ $user->name }}</b>  <br>
                    @if($user->role_name == 1)
                        <span class="badge badge-pill badge-light">Finder</span>
                    @elseif($user->role_name == 2)
                        <span class="badge badge-pill badge-light">Giver</span>
                    @endif
                </div>
            </div>
            <hr style="background-color: white">
            @if($user->role_name == 2)
                <div class="container">
                    <i class="fa fa-clipboard-list mr-2 my-2" style="color: white; opacity: 0.8; font-size: 12px"></i>
                    <b style="color: white; opacity: 0.8; font-size: 12px">LIST IKLAN</b> <br>
                    <br>
                        <i class="fas fa-angle-right mr-1"></i>
                        <a href="{{route('postList', $user->id)}}" style="color: white">List Iklan</a>
                </div>
                <hr style="background-color: white">
                <div class="container" style="font-size: 14px;">
                    <i class="fa fa-id-card-alt mr-2 my-2" style="color: white; opacity: 0.8; font-size: 12px"></i>
                    <b style="color: white; opacity: 0.8; font-size: 12px">PERMOHONAN PAID PROMOTE</b> <br>
                    <br>
                        <i class="fas fa-angle-right mr-1"></i>
                        <a href="{{ url('/giver/appliedAdvertisementList', $user->id) }}" style="color: white; font-size: 14px">List Permohonan Paid Promote</a>
                </div>
            @else
                <div class="container" style="font-size: 14px;">
                    <i class="fa fa-money-bill mr-2 my-2" style="color: white; opacity: 0.5; font-size: 12px"></i>
                    <b style="color: white; opacity: 0.8; font-size: 12px">TRANSAKSI</b> <br>
                    @if($totalSaldo == null ) 
                        Pendapatan: Rp 0
                    @else
                        Pendapatan: Rp {{ $TOTAL }}
                    @endif <br>
                    <br>
                    <a href="{{ route('transactions.page', $user->id) }}" style="color: white; font-size: 14px;">
                        <i class="fas fa-angle-right mr-1"></i>
                        Lihat Histori Transaksi
                    </a>
                </div>
                <hr style="background-color: white">
                <div class="container">
                    <i class="fa fa-clipboard-list mr-2 my-2" style="color: white; opacity: 0.8; font-size: 12px"></i>
                    <b style="color: white; opacity: 0.8; font-size: 12px">LIST PAID PROMOTE</b> <br>
                    <br>
                        <i class="fas fa-angle-right mr-1"></i>
                        <a href="{{route('postListFinder', $user->id)}}" style="color: white">List Paid Promote</a>
                </div>
                <hr style="background-color: white">
                <div class="container" style="font-size: 14px;">
                    <i class="fa fa-id-card-alt mr-2 my-2" style="color: white; opacity: 0.8; font-size: 12px"></i>
                    <b style="color: white; opacity: 0.8; font-size: 12px">PERMOHONAN IKLAN</b> <br>
                    <br>
                        <i class="fas fa-angle-right mr-1"></i>
                        <a href="{{ url('/finder/appliedAdvertisementList', $user->id) }}" style="color: white; font-size: 14px">List Permohonan Iklan</a>
                </div>
            @endif
            <hr style="background-color: white">
        </div>
        {{-- <div class="container">
            <a class="btn btn-light text-primary" href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        </div> --}}
    </div>
    <div class="container" style="margin-left: 320px;">
        @if($user->role_name == 1)
            <div class="container">
                <button class="btn btn-primary mt-4" id="create_button">
                    <i class="fa fa-plus-circle"></i>
                    Buka Paid Promote
                </button>
            </div> <br>
            <div id="create_form1" style="display: none; margin-left: 15px">
                <button class="btn btn-outline-primary back">
                    <i class="fas fa-angle-left"></i>
                    Kembali
                </button>
                <br> <br>
                <h5 class="mb-3 mt-3">Promosikan Paid Promote</h5>
                <form action="{{ route('createFinder.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input style="display:none" name="giver_id" class="form-control" value="{{ $user->id }}">
                    <input style="display:none" name="role" class="form-control" value="{{ $user->role_name }}">
                    <div class="form-group">
                        <label for="">Judul</label>
                        <input name="title" id="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Deskripsi</label>
                        <textarea name="description" id="" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Gambar</label>
                        <input type="file" name="content_image" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Sebarkan Melalui</label>
                        <select name="share_type" id="" class="form-control">
                            <option value="">Pilih Sosial Media--</option>
                            <option value="1">Instagram</option>
                            <option value="2">Facebook</option>
                            <option value="3">Twitter</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary float-right">Publikasi</button>
                        <button id="close_button" type="button" class="btn btn-danger mx-2 float-right">Batal</button>
                    </div>
                </form>
            </div>
            @elseif($user->role_name == 2)
            <div class="container">
                <button class="btn btn-primary mt-4" id="create_button">
                    <i class="fa fa-plus-circle"></i>
                    Buat Iklan
                </button>
                </div> <br>
                <div id="create_form2" style="display: none; margin-left: 15px" class="pb-5 mb-3">
                    <button class="btn btn-outline-primary back">
                        <i class="fas fa-angle-left"></i>
                        Kembali
                    </button>
                    <br> <br>
                    <h5 class="mb-3 mt-3">Publikasikan Iklan</h5>
                        <form action="{{ route('createGiver.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input style="display:none" name="giver_id" class="form-control" value="{{$user->id}}">
                        <input style="display:none" name="role" class="form-control" value="{{$user->role_name}}">
                        <input style="display:none" name="post_id" class="form-control" value="{{$post_id}}">
                        <div class="form-group">
                            <label for="">Gambar iklan</label>
                            <input type="file" name="content_image" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Judul</label>
                            <input name="title" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Deskripsi</label>
                            <textarea name="description" id="" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Slot</label>
                            <input type="number" name="limit" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Harga Iklan</label>
                            <input type="number" name="price" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Sebarkan Melalui</label>
                            <select name="share_type" id="" class="form-control">
                                <option value="">Pilih Sosial Media--</option>
                                <option value="1">Instagram</option>
                                <option value="2">Facebook</option>
                                <option value="3">Twitter</option>
                            </select>
                        </div>
                        <h5 class="mb-3 mt-5">Detail Konten</h5>
                        <p class="text-danger">* Detail Konten adalah konten yang akan dipromosikan oleh <b>Finder</b> melalui sosial media.</p>
                        <div class="form-group">
                            <label for="">Judul konten</label>
                            <input name="content_title" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Deskripsi konten</label>
                            <input name="content_description" id="" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="">Gambar lebih dari 1</label>
                            <input type="file" name="file[]" class="form-control" multiple>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary float-right">Publikasi</button>
                            <button id="close_button" type="button" class="btn btn-danger mx-2 float-right">Batal</button>
                        </div>
                    </form>
                </div>
            @endif
        <div class="advertisement">
            <div class="container mb-2">
                @if(session('all'))
                    <a href="/home" class="btn btn-light mr-2 mb-3" style="background-color: #f0f9fa; border: 1.5px solid #289AD6; color: #289AD6; font-weight: bold">
                        Semua
                    </a>
                @else
                    <a href="/home" class="btn btn-light mr-2 mb-3" style="border: 1px solid grey; color: grey">
                        Semua
                    </a>
                @endif
                @if(session('instagram'))
                    <form action="{{ route('search.instagram.home') }}" method="GET" class="btn">
                        {{ method_field('GET') }}
                        <input type="text" name="instagram" value="1"  hidden>
                        <button class="btn btn-light mb-3" style="background-color: #f0f9fa; border: 1.5px solid #289AD6; color: #289AD6; font-weight: bold">
                            <i class="fa fa-instagram mr-1"></i>
                            Instagram
                        </button>
                    </form>
                @else
                    <form action="{{ route('search.instagram.home') }}" method="GET" class="btn">
                        {{ method_field('GET') }}
                        <input type="text" name="instagram" value="1"  hidden>
                        <button class="btn btn-light mb-3" style="border: 1px solid grey; color: grey">
                            <i class="fa fa-instagram mr-1"></i>
                            Instagram
                        </button>
                    </form>
                @endif

                @if(session('facebook'))
                    <form action="{{ route('search.facebook.home') }}" method="GET" class="btn">
                        {{ method_field('GET') }}
                        <input type="text" name="facebook" value="2"  hidden>
                        <button class="btn btn-light mb-3" style="background-color: #f0f9fa; border: 1.5px solid #289AD6; color: #289AD6; font-weight: bold">
                            <i class="fa fa-facebook mr-1"></i>
                            Facebook
                        </button>
                    </form>
                @else
                    <form action="{{ route('search.facebook.home') }}" method="GET" class="btn">
                        {{ method_field('GET') }}
                        <input type="text" name="facebook" value="2"  hidden>
                        <button class="btn btn-light mb-3" style="border: 1px solid grey; color: grey">
                            <i class="fa fa-facebook mr-1"></i>
                            Facebook
                        </button>
                    </form>
                @endif
                @if(session('twitter'))
                    <form action="{{ route('search.twitter.home') }}" method="GET" class="btn">
                        {{ method_field('GET') }}
                        <input type="text" name="twitter" value="3"  hidden>
                        <button class="btn btn-light mb-3" style="background-color: #f0f9fa; border: 1.5px solid #289AD6; color: #289AD6; font-weight: bold">
                            <i class="fa fa-twitter mr-1"></i>
                            Twitter
                        </button>
                    </form>
                @else
                    <form action="{{ route('search.twitter.home') }}" method="GET" class="btn">
                        {{ method_field('GET') }}
                        <input type="text" name="twitter" value="3"  hidden>
                        <button class="btn btn-light mb-3" style="border: 1px solid grey; color: grey">
                            <i class="fa fa-twitter mr-1"></i>
                            Twitter
                        </button>
                    </form>
                @endif
            </div>
            <div class="container" style="margin-top: -15px">
                <div class="row">
                    <div class="col-sm-4">
                        <form action="{{route('search.home')}}" method="GET" class="search-property-1">
                            {{ method_field('GET') }}
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Cari Iklanmu ...">
                                <div class="input-group-prepend">
                                    <button class="input-group-text" id="addon-wrapping" style="background-color: white"><i style="color: grey" class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                        <script src="jquery-1.7.1.min.js"></script>
                        <script>
                            function selectChange(val) {
                                $('#myForm').submit();
                            }
                        </script>
                        @if($user->role_name == 1)
                        <div class="form-group my-3">
                                <form id="myForm" action="{{route('search.rentang.bayaran.home')}}" method="GET">
                                    {{ method_field('GET') }}
                                    <select onChange=selectChange(this.value) class="form-control" name="rentang_bayaran">
                                        <option value="" selected readonly>Rentang Bayaran..</option>
                                        <option value="1">Rp 5000 - 10000</option>
                                        <option value="2">Rp 15000 - 20000</option>
                                    </select>
                                </form>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @if($posts == '[]')
                <div class="container text-center">
                    Belum Ada Iklan
                </div>
            @endif

            <div class="advertisement row px-3">
                @foreach($posts as $post)
                    <div class="col-xl-4 col-md-6 my-3">
                        <div class="card" style="width: 20rem">
                            <img style="height: 200px" src="{{ asset('posts-images/'.$post['content_image']) }}" class="card-img-top" alt="...">
                            <div class="card-body">
                                @if($post->share_type == 1)
                                    <h5 style="
                                    height: 25px;
                                    white-space: nowrap;
                                    overflow: hidden;
                                    text-overflow: ellipsis;" class="card-title">{{ $post->title }} <br> <h6><span class="badge badge-danger">Instagram</span></h6> </h5>
                                @elseif($post->share_type == 2)
                                    <h5 style="
                                    height: 25px;
                                    white-space: nowrap;
                                    overflow: hidden;
                                    text-overflow: ellipsis;" class="card-title">{{ $post->title }} <br> <h6><span class="badge badge-primary">Facebook</span></h6> </h5>
                                @elseif($post->share_type == 3)
                                    <h5 style="
                                    height: 25px;
                                    white-space: nowrap;
                                    overflow: hidden;
                                    text-overflow: ellipsis;" class="card-title">{{ $post->title }} <br> <h6><span class="badge badge-primary" style="background-color: lightBlue ">Twitter</span></h6> </h5>
                                @endif
                                <p style="
                                    height: 50px;
                                    white-space: nowrap;
                                    overflow: hidden;
                                    text-overflow: ellipsis;"
                                    class="card-text">{{ $post->description }}</p>
                                @if($user->role_name == 1)
                                    <p class="card-text">Bayaran: Rp {{ $post->price }}</p>
                                @else
                                @endif
                                <a href="{{ route('detail', $post->id) }}" class="btn btn-primary">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    @include('templates.script')

    <script>
        $(document).ready(function(){
            // Form Create Advertisment
            $('#create_button').click(function() {
                $('#create_form1').show();
                $('#create_form2').show();
                $('#create_button').hide();
                $('.advertisement').hide();
            });

            $('#close_button').click(function() {
                $('#create_form1').hide();
                $('#create_form2').hide();
                $('#create_button').show();
                $('.advertisement').show();
            })

            $('.back').click(function() {
                $('#create_form1').hide();
                $('#create_form2').hide();
                $('#create_button').show();
                $('.advertisement').show();
            })
        });

        const flashData = $('.flash-data').data('flashdata');

		if(flashData) {
			Swal.fire({
				position: 'center',
				icon: 'success',
				title: 'Publikasi Berhasil!',
				confirmButtonText: 'Baik',
				showConfirmButton: true,
			})
		}
    </script>
@endsection
