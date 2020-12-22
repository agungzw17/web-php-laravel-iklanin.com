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
            <th scope="col">Bukti Pembayaran</th>
            <th scope="col">Status</th>
            <th scope="col">Pilih iklan</th>
            <th scope="col">Chat</th></tr>
        </thead>
        <tbody>
            @foreach($listAppliedIklan as $listApplied)
            <tr>
                <th scope="row">{{$listApplied->id}}</th>
                <td>
                    <img src="{{ asset('posts-images/'.$listApplied->iklan->content_image) }}" alt="" style="width: 300px; height: 175px">
                </td>
                <td>{{$listApplied->iklan->title}}</td>
                <td>{{$listApplied->userGiver->name}}</td>
                {{-- <td>
                @if($listApplied->price == null or $listApplied->price == 0 or $listApplied->price == '')
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#price-{{ $listApplied->id}}" data-id="{!! $listApplied->id !!}">
                        Masukan Harga
                    </button> --}}
                    {{-- <div class="modal fade" id="price-{{ $listApplied->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Masukan harga</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="container">
                                    <img src="{{ asset('appliances_images/'.$listApplied->transfer_prove) }}" alt="" style="width: 300px">
                                    <br>
                                    <form action="{{route('appliancesUpdate.update', $listApplied->id)}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="number" name="price">
                                        <br>
                                        <button class="btn btn-primary float-right">Masukan</button>
                                    </form>
                                    <br> <br>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                {{-- @else
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#price-{{ $listApplied->id}}" data-id="{!! $listApplied->id !!}">
                        Edit Harga
                    </button>
                    <div class="modal fade" id="price-{{ $listApplied->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Masukan harga</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="container">
                                    <p>Harga yg telah didiskusikan : Rp. {{$listApplied->price}}</p>

                                    <form action="{{route('appliancesUpdate.update', $listApplied->id)}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="number" name="price">
                                        <br>
                                        <button class="btn btn-primary float-right">Masukan</button>
                                    </form>
                                    <br> <br>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif --}}
            {{-- </td> --}}
            <td>
                @if($listApplied->transfer_prove == null or $listApplied->transfer_prove == '')
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#upload-{{ $listApplied->id}}" data-id="{!! $listApplied->id !!}">
                        Upload Bukti Pembayaran
                    </button>
                    <div class="modal fade" id="upload-{{ $listApplied->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Upload Bukti Pembayaran</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="container">
                                    <img src="{{ asset('appliances_images/'.$listApplied->transfer_prove) }}" alt="" style="width: 300px">
                                    <br>
                                    <form action="{{route('receiveAppliances.update', $listApplied->id)}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="">Jumlah Nominal (Rupiah)</label>
                                            <input type="number" name="price" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Bukti Transaksi</label>
                                            <input type="file" name="transfer_prove" class="form-control">
                                        </div> 
                                        <br>
                                        <button class="btn btn-primary float-right">Simpan</button>
                                    </form>
                                    <br> <br>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#upload-{{ $listApplied->id}}" data-id="{!! $listApplied->id !!}">
                        Edit Bukti Pembayaran
                    </button>

                    <div class="modal fade" id="upload-{{ $listApplied->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Upload bukti pembayaraan dibawah</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="container">
                                    <br>
                                    <img src="{{ asset('appliances_images/'.$listApplied->transfer_prove) }}" alt="" style="width: 300px">
                                    <br>
                                    <form action="{{route('receiveAppliances.update', $listApplied->id)}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="file" name="transfer_prove">
                                        <br>
                                        <button class="btn btn-primary btn-sm">Upload</button>
                                    </form>
                                </div>
                                    <br>
                            </div>
                        </div>
                    </div>
                @endif
            </td>
            @if($listApplied->status == 3)
                @if($listApplied->status == 3 and $listApplied->transfer_prove != null)
                <td class="text-success">
                    Sudah Melakukan pembayaran <br>
                </td>
                @else
                <td class="text-danger">
                    Belum Melakukan pembayaran <br>
                    * Silakan Melakukan Pembayaran dan Upload Bukti Pembayaran
                </td>
                @endif
            @elseif($listApplied->status == 1)
                <td class="text-danger">
                    Permohonan Ditolak
                </td>
            @elseif($listApplied->status == 0)
                <td class="text-warning">
                    Permohonan Belum Dikonfirmasi
                </td>
            @else
                <td class="text-warning">Silakan Upload Bukti Pembayaran</td>
            @endif
            </td>
            <td>
                    @if($listApplied->content_title  != null)
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#bahanPostingan-{{ $listApplied->id}}" data-id="{!! $listApplied->id !!}">
                        Edit iklan
                    </button>
                    <div class="modal fade" id="bahanPostingan-{{ $listApplied->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog " role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Masukan iklan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="container pt-3">
                                <div class="form-group my-3">
                                            <form id="myForm" action="{{route('receiveAppliances.update', $listApplied->id)}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <p class="text-danger">* Detail Konten adalah konten yang akan dipromosikan oleh <b>Finder</b> melalui sosial media.</p>
                                            <div class="form-group">
                                                <label for="">Judul konten</label>
                                                <input name="content_title" id="" class="form-control" value="{{$listApplied->content_title}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Deskripsi konten</label>
                                                <input name="content_description" id="" class="form-control" value="{{$listApplied->content_description}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Gambar lebih dari 1</label>
                                                <input type="file" name="content_image" class="form-control" value="{{$listApplied->content_image}}">
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary float-right">Publikasi</button>
                                            </div>
                                        </form>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#bahanPostingan-{{ $listApplied->id}}" data-id="{!! $listApplied->id !!}">
                        Masukan iklan
                    </button>
                    <div class="modal fade" id="bahanPostingan-{{ $listApplied->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog " role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Masukan iklan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="container pt-3">
                                <div class="form-group my-3">
                                            <form id="myForm" action="{{route('receiveAppliances.update', $listApplied->id)}}" method="post" enctype="multipart/form-data">
                                            @csrf
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
                                                <input type="file" name="content_image" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary float-right">Publikasi</button>
                                            </div>
                                        </form>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
            </td>
                <td>
                <a target="_blank" class="btn btn-success" href="https://api.whatsapp.com/send?phone={{$listApplied->user->no_hp}}&text=Halo,%20Saya%20disini%20ingin%20berbicara%20mengenai%20iklan%20{{$listApplied->iklan->title}}" class="btn btn-success my-3">WhatsApp</a>
                </td>
            </tr>
            @endforeach
        </tbody>
      </table>
</div>

@endsection
