@extends('templates.appNormal')
@section('title', 'Beranda')
@section('content')
@if(session('success'))
    <div class="flash-data" data-flashdata="<?= session('success') ?>"></div>
@endif
    <div class="container my-5">
        <nav class="text-primary" style="margin-left: 40px">
            <ol>
                <li class="d-inline"><a href="{{ url('/home') }}">Home</a></li>
                <i class="fa fa-chevron-circle-right"></i>
                <li class="d-inline"><a href="{{ url('/home') }}">List Iklan</a></li>
                <i class="fa fa-chevron-circle-right"></i>
                <li class="d-inline" aria-current="page">{{ $postDetail->title }}</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-xl-4 col-md-6 ml-5 mt-4 pl-5 mr-2 text-center" >
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                      <div class="carousel-item active">
                        <img src="{{ asset('posts-images/'.$postDetail['content_image']) }}" class="d-block w-100" alt="...">
                      </div>
                      <div class="carousel-item">
                        <img src="{{ asset('posts-images/'.$postDetail['content_image']) }}" class="d-block w-100" alt="...">
                      </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="sr-only">Next</span>
                    </a>
                  </div>
                  {{-- // Gambar konten (2 aja) --}}
                  <div class="row my-3">
                    <div class="col-sm-6" >
                        <img src="{{ asset('posts-images/'.$postDetail['content_image']) }}"  class="w-100" alt="...">
                    </div>
                    <div class="col-sm-6" >
                        <img src="{{ asset('posts-images/'.$postDetail['content_image']) }}" class="w-100" alt="...">
                    </div>
                  </div>
                @if($postDetail->user_id == 1)
                <a href="https://api.whatsapp.com/send?phone={{$postDetail->user->no_hp}}&text=Halo,%20Saya%20disini%20ingin%20berbicara%20mengenai%20iklan%20{{$postDetail->title}}" class="btn btn-success my-3">Chat Giver</a>
                @else
                <a href="https://api.whatsapp.com/send?phone={{$postDetail->user->no_hp}}&text=Halo,%20Saya%20disini%20ingin%20berbicara%20mengenai%20iklan%20{{$postDetail->title}}" class="btn btn-success my-3">Chat Finder</a>
                @endif
            </div>
            <div class="col-xl-6 col-md-6 mt-4 ml-5 pl-5 mr-2" >
                <h3>{{ $postDetail->title }}</h3>
                <p>{{ $postDetail->user_name }} <br>
                @if($postDetail->share_type == 1)
                    <h6><span class="badge badge-danger">Instagram</span></h6>
                @elseif($postDetail->share_type == 2)
                    <h6><span class="badge badge-primary">Facebook</span></h6>
                @elseif($postDetail->share_type == 3)
                   <h6><span class="badge badge-primary">Twitter</span></h6>
                @endif
                <hr>
                <h5 class="mt-3">Deskripsi:</h5>
                    {{$postDetail->description}}
                <br>
                @if($user->role_name == 1)
                    <h6 class="my-3">Slot: {{$appliancesSlot}}/<b>{{$postDetail->limit}}</b></h6>
                    <h6 class="my-3">Bayaran: Rp {{$postDetail->price}}</h6>
                @endif
                <form action="{{route('postApply.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group" hidden>
                        <label for="">Finder_id</label>
                        <input name="finder_id" id="" class="form-control" value="{{ $user->id }}">
                    </div>
                    <div class="form-group" hidden>
                        <label for="">Giver_id</label>
                        <input name="giver_id" id="" class="form-control" value="{{ $postDetail->user_id }}">
                    </div>
                    <div class="form-group" hidden>
                        <label for="">Post_id</label>
                        <input name="post_id" id="" class="form-control" value="{{ $postDetail->id }}">
                    </div>
                    <div class="form-group" hidden>
                        <label for="">Price</label>
                        <input name="price" id="" class="form-control" value="{{ $postDetail->price }}">
                    </div>
                    <div class="form-group" hidden>
                        <label for="">Status</label>
                        <input name="status" id="" class="form-control" value="0">
                    </div>
                    @if($appliancesSlot >= $postDetail->limit && $user->role_name == 1)
                        <button class="btn btn-secondary" disabled>Slot full</button>
                    @elseif($user->role_name == 1)
                            @if($user->appliance == 0)
                            <button class="btn btn-primary">Apply</button>
                            @else
                                <button class="btn btn-secondary" disabled>Applied</button>
                            @endif
                    @endif
                    @if($user->role_name == 2)
                    <br>
                            @if($user->appliance == 0)
                            <button class="btn btn-primary">Apply</button>
                            @else
                                <button class="btn btn-secondary" disabled>Applied</button>
                            @endif
                    @endif
                </form>
            </div>
        </div>
    </div>
    @include('templates.script')
    <script>
        const flashData = $('.flash-data').data('flashdata');

		if(flashData) {
			Swal.fire({
				position: 'center',
				icon: 'success',
				title: 'Berhasil Apply Iklan!',
				confirmButtonText: 'Baik',
				showConfirmButton: true,
			})
		}
    </script>
@endsection
