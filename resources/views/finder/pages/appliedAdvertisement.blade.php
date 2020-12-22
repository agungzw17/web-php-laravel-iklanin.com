@extends('templates.appNormal')
@section('title', 'List Post')
@section('content')

<div class="container my-5">
    <nav class="my-4 text-primary" style="margin-left: -40px">
        <ol>
            <li class="d-inline"><a href="{{ url('/home') }}">Home</a></li>
            <i class="fa fa-chevron-circle-right"></i>
            <li class="d-inline" aria-current="page">List Applied Iklan</li>
        </ol>
    </nav>
    <h4>List Iklan</h4> <br>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Gambar</th>
            <th scope="col">Judul</th>
            <th scope="col">Pengiklan</th>
            <th scope="col">Bahan Postingan</th>
            <th scope="col">Bukti Pembayaran</th>
            <th scope="col">Status</th>
            <th scope="col">Chat</th></tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @foreach($listAppliedIklan as $listApplied)
            <tr>
                <th scope="row">{{ $i }}</th>
                <td>
                    <img src="{{ asset('posts-images/'.$listApplied->iklan->content_image) }}" alt="" style="width: 300px; height: 175px">
                </td>
                <td>{{$listApplied->iklan->title}}</td>
                <td>{{$listApplied->userGiver->name}}</td>
                <td>
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#bahanPostingan-{{ $listApplied->id}}" data-id="{!! $listApplied->id !!}">
                            Download
                        </button>
                        <div class="modal fade" id="bahanPostingan-{{ $listApplied->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog " role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Detail Konten</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="container pt-3">
                                        <b>Judul</b> <br> {{$listApplied->iklan->content_title}} <br> <br>
                                        <b>Deskripsi</b> <br> {{$listApplied->iklan->content_description}}
                                        <br>
                                        <br>
                                        <b>Gambar</b>
                                        <div class="form-group">
                                            <label for="">Gambar {{ $i }}</label>
                                            <a href="{{route('getContentImageFile', $listApplied->iklan->content_image)}}" class="form-control">
                                                <i class="fa fa-download"></i>
                                                Download
                                            </a>
                                        </div>
                                        @php
                                            $i = 2;
                                        @endphp
                                        @foreach($otherImages->where('post_id', $listApplied->iklan->post_id) as $otherPosts)
                                            <div class="form-group">
                                                <label for="">Gambar {{ $i }}</label>
                                                <a href="{{route('getOtherContentImageFile', $otherPosts->file)}}" class="form-control">
                                                    <i class="fa fa-download"></i>
                                                    Download
                                                </a>
                                            </div>
                                            @php
                                                $i++;
                                            @endphp
                                        @endforeach
                                        <button class="btn btn-secondary float-right mb-3" data-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                </td>
                <td>
                    <div class="form-group">
                        @if($listApplied->transfer_prove == null or $listApplied->transfer_prove == '')
                            Belum dikirim
                        @else
                        <a class="btn btn-primary btn-sm" href="{{route('getfile', $listApplied->transfer_prove)}}">
                            <i class="fa fa-download"></i>
                            Download
                        </a>
                        @endif

                    </div>
                </td>
                @if(!empty($listApplied->link))
                    <td class="text-success">Sudah Memasukkan Link Post</td>
                @elseif($listApplied->status == 2)
                    <td class="text-success">Sudah dikonfirmasi, silakan memasukkan bukti posting</td>
                 @elseif($listApplied->status == 1)
                    <td class="text-danger">Permintaan anda ditolak</td>
                @elseif($listApplied->status == 0)
                    <td class="text-warning">Sudah Apply (Belum Dikonfirmasi)</td>
                @elseif($listApplied->status == 3)
                    <td class="text-success">Selesai</td>
                @endif
                <td>
                    <a target="_blank" class="btn btn-success btn-sm" href="https://api.whatsapp.com/send?phone={{$listApplied->user->no_hp}}&text=Halo,%20Saya%20disini%20ingin%20berbicara%20mengenai%20iklan%20{{$listApplied->iklan->title}}">Whatsapp</a>
                </td>
            </tr>
                @php
                    $i++;
                @endphp
            @endforeach
        </tbody>
      </table>
</div>

@endsection
