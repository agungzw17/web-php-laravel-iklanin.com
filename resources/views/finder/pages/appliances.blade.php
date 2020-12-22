@extends('templates.appNormal')
@section('title', 'List Appliance')
@section('content')
@if(session('success'))
    <div class="flash-data" data-flashdata="<?= session('success') ?>"></div>
@endif
<div class="container my-5">
    <nav class="my-4 text-primary" style="margin-left: -40px">
        <ol>
            <li class="d-inline"><a href="{{ url('/home') }}">Home</a></li>
            <i class="fa fa-chevron-circle-right"></i>
            <li class="d-inline"><a href="#">List Paid Promote</a></li>
            <i class="fa fa-chevron-circle-right"></i>
            <li class="d-inline" aria-current="page">List Appliances</li>
        </ol>
    </nav>
    <h4>{{ $post_title }}</h4>
    <hr>
    <h5>List Appliance</h5> <br>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Foto</th>
                <th scope="col">Nama</th>
                <th scope="col">Appliance</th>
                <th scope="col">Bukti Pembayaran</th>
                <th scope="col">Bahan Postingan</th>
                <th scope="col">Status</th>
                <th scope="col">Chat</th>
            </tr>
        </thead>
        <tbody>
            @foreach($appliances as $apply)
          <tr>
            <th scope="row">{{ $apply->id }}</th>
            <td>
                <img src="{{ asset('posts-images/'.$apply->photo->content_image) }}" alt="" style="width: 300px">
            </td>
            <td>{{ $apply->user->name }}</td>
            <td>
                @if($apply->status == 0)
                    <form action="{{route('receiveAppliances.update', $apply->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group" hidden>
                            <label for="">Finder_id</label>
                            <input name="finder_id" id="" class="form-control" value="{{$apply->finder_id}}">
                        </div>
                        <div class="form-group" hidden>
                            <label for="">Giver_id</label>
                            <input name="giver_id" id="" class="form-control" value="{{$apply->giver_id}}">
                        </div>
                        <div class="form-group" hidden>
                            <label for="">Post_id</label>
                            <input name="post_id" id="" class="form-control" value="{{$apply->post_id}}">
                        </div>
                        <div class="form-group" hidden>
                            <label for="">Status</label>
                            <input name="status" id="" class="form-control" value="2">
                        </div>
                        <button class="badge badge-primary">Accept</button>
                    </form>
                    <form action="{{route('receiveAppliances.update', $apply->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group" hidden>
                            <label for="">Finder_id</label>
                            <input name="finder_id" id="" class="form-control" value="{{$apply->finder_id}}">
                        </div>
                        <div class="form-group" hidden>
                            <label for="">Giver_id</label>
                            <input name="giver_id" id="" class="form-control" value="{{$apply->giver_id}}">
                        </div>
                        <div class="form-group" hidden>
                            <label for="">Post_id</label>
                            <input name="post_id" id="" class="form-control" value="{{$apply->post_id}}">
                        </div>
                        <div class="form-group" hidden>
                            <label for="">Status</label>
                            <input name="status" id="" class="form-control" value="1">
                        </div>
                        <button class="badge badge-danger">Reject</button>
                    </form>
                @elseif($apply->status == 1)
                    <button class="badge badge-danger">
                        Rejected
                        <i class="fa fa-times"></i>
                    </button>
                @else
                    <button class="badge badge-success">
                        Accepted
                        <i class="fa fa-check"></i>
                    </button>
                @endif
            </td>
                <td>
                    <div class="form-group">
                        @if($apply->transfer_prove == null or $apply->transfer_prove == '')
                            Belum dikirim
                        @else
                        <a class="btn btn-primary btn-sm" href="{{route('getfile', $apply->transfer_prove)}}">
                            <i class="fa fa-download"></i>
                            Download
                        </a>
                        @endif

                    </div>
                </td>
                <td>
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#bahanPostingan-{{ $apply->id}}" data-id="{!! $apply->id !!}">
                        Download
                    </button>
                    <div class="modal fade" id="bahanPostingan-{{ $apply->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog " role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Detail Konten</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="container pt-3">
                                    <b>Judul</b> <br> {{$apply->content_title}} <br> <br>
                                    <b>Deskripsi</b> <br> {{$apply->content_description}}
                                    <br>
                                    <br>
                                    <b>Gambar</b>
                                    <div class="form-group">
                                        <label for="">Gambar 1</label>
                                        <a href="{{route('getContentImageFile', $apply->content_image)}}" class="form-control">
                                            <i class="fa fa-download"></i>
                                            Download
                                        </a>
                                    </div>
                                    <button class="btn btn-secondary float-right mb-3" data-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
            </td>
                <td>
                    @if($apply->transfer_prove == null or $apply->transfer_prove == '')
                        <p class="text-warning">Bukti Pembayran Belum Diupload</p>
                    @else
                        <p class="text-warning">Transaksi Selesai</p>
                    @endif
                </td>
                <td>
                    <a target="_blank" class="btn btn-success btn-sm" href="https://api.whatsapp.com/send?phone={{$apply->user->no_hp}}&text=Halo,%20Saya%20disini%20ingin%20berbicara%20mengenai%20iklan%20{{$apply->iklan->title}}">Whatsapp</a>
                </td>
          </tr>
          @endforeach
        </tbody>
      </table>
</div>

@include('templates.script')

<script>
    $(document).ready(function(){
        const flashData = $('.flash-data').data('flashdata');

        if(flashData) {
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Berhasil Memperbarui Data Appliance',
                confirmButtonText: 'Baik',
                showConfirmButton: true,
            })
        }
    })
</script>

@endsection
