@extends('templates.appNormal')
@section('title', 'Beranda')
@section('content')
    <div style="border-right: 1px solid grey;
        height: 100%;
        width: 300px;
        position: fixed;
        z-index: 1;
        top: 0;
        left: 0;
        background-color: #ffff;
        overflow-x: hidden;
        padding-top: 20px;">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}" style="color: black"><b>Iklanin</b>.com</a>
            <hr>
            <div class="input-group flex-nowrap">
                <input type="text" class="form-control" placeholder="Cari Iklanmu ...">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="addon-wrapping" style="background-color: white"><i style="color: grey" class="fa fa-search"></i></span>
                    </div>
                </div>
                <div class="my-3">
                    <select class="form-control">
                        <option value="" selected>Pilih Kategori..</option>
                    </select>
                </div>
            </div>
            <hr>
            <div class="row p-3">
                <div class="col-xl-3 col-md-6">
                    <img src="{{ asset('sope.jpg') }}" alt="..." style="border-radius: 50%; width: 100px; height: 100px">
                </div>
                <div class="col-xl-5 col-md-6 ml-5">
                    Raihan Rafid <br>
                    Prime Finder
                </div>
            </div>
            <hr>
            <div class="container">
                <b>Saldo</b> <br>
                Total Saldo Didapat: Rp 300000 <br>
                <br> <br>
                <a href="">Lihat Histori Transaksi</a>
            </div>
        </div>
    </div>

    <div class="row" style="margin-left: 320px;">
        <div class="container" style="margin-left: -5px">
            <form action="{{route('createGiver.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="">Giver_id</label>
                    <input name="giver_id" id="" class="form-control" value="{{$user->id}}"></input>
                </div>
                <div class="form-group">
                    <label for="">role</label>
                    <input name="role" id="" class="form-control" value="{{$user->role_name}}"></input>
                </div>
                <div class="form-group">
                    <label for="">Nama Postingan : </label>
                    <input name="title" id="" class="form-control"></input>
                </div>
                <div class="form-group">
                    <label for="">Deskripsi</label>
                    <textarea name="description" id="" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="">Slot :</label>
                    <input type="number" name="limit" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Harga iklan</label>
                    <input type="number" name="price" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Share via :</label>
                    <textarea name="share_type" id="" class="form-control"></textarea>
                </div>
                <div>-----------------------------------------------------------------------------------------------------------------------</div>
                <div class="form-group">
                    <label for="">Judul konten : </label>
                    <input name="content_title" id="" class="form-control"></input>
                </div>
                <div class="form-group">
                    <label for="">Deskripsi konten : </label>
                    <input name="content_description" id="" class="form-control"></input>
                </div>
                <div class="form-group">
                    <label for="">Image</label>
                    <input type="file" name="content_image">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Posting</button>
                </div>
            </form>
        </div>
    </div>
@endsection
