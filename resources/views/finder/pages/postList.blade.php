@extends('templates.appNormal')
@section('title', 'List Post')
@section('content')
@if(session('success'))
    <div class="flash-data" data-flashdata="<?= session('success') ?>"></div>
@endif
<div class="container my-5">
    <nav class="my-4 text-primary" style="margin-left: -40px">
        <ol>
            <li class="d-inline"><a href="{{ url('/home') }}">Home</a></li>
            <i class="fa fa-chevron-circle-right"></i>
            <li class="d-inline" aria-current="page">List Paid Promote</li>
        </ol>
    </nav>
    <h4>List Paid Promote</h4> <br>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Gambar</th>
            <th scope="col">Judul</th>
            <th scope="col">Jumlah Appliances</th>
            <th scope="col">Jumlah Pengiklan</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
        @php
            $i = 1
        @endphp
        @foreach($post as $posts)
            <tr>
                <th scope="row">{{ $i }}</th>
                <td>
                    <img src="{{ asset('posts-images/'.$posts['content_image']) }}" alt="" style="width: 300px; height: 175px">
                </td>
                <td>{{$posts->title}}</td>
                <td>{{ \App\Appliance::where(['post_id' => $posts->id])->pluck('id')->count('id') }}</td>
                <td>{{ \App\Appliance::where(['post_id' => $posts->id])->where(['status' => 2])->pluck('id')->count('id') }}</td>

                <td>
                    <a type="button" data-toggle="modal" data-target="#edit-{{ $posts->id}}" data-id="{!! $posts->id !!}">
                        <span class="badge badge-primary">Edit</span>
                    </a>
                    <div class="modal fade" id="edit-{{ $posts->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Post</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="container">
                                <br>
                                    <form action="{{route('post.update', $posts->id)}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group" hidden>
                                            <label for="">Giver_id</label>
                                            <input name="giver_id" id="" class="form-control" value="{{$posts->user_id}}" ></input>
                                        </div>
                                        <div class="form-group" hidden>
                                            <label for="">role</label>
                                            <input name="role" id="" class="form-control" value="{{$posts->role}}" ></input>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Judul Postingan</label>
                                            <input name="title" id="" class="form-control" value="{{$posts->title}}"></input>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Deskripsi</label>
                                            <textarea name="description" id="" class="form-control" value="{{$posts->description}}">{{$posts->description}}</textarea>
                                        </div>
                                        <div class="form-group" hidden>
                                            <label for="">Slot</label>
                                            <input type="number" name="limit" class="form-control" value="{{$posts->limit}}">
                                        </div>
                                        <div class="form-group" hidden>
                                            <label for="">Harga Iklan</label>
                                            <input type="number" name="price" class="form-control" value="{{$posts->price}}">
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
                                        <div class="text-danger" hidden>* Detail Konten</div> <br>
                                        <div class="form-group" hidden>
                                            <label for="">Judul Konten</label>
                                            <input name="content_title" id="" class="form-control" value="{{$posts->content_title}}"></input>
                                        </div>
                                        <div class="form-group" hidden>
                                            <label for="">Deskripsi Konten</label>
                                            <input name="content_description" id="" class="form-control" value="{{$posts->content_description}}"></input>
                                        </div>
                                        <div class="form-group" hidden>
                                            <label for="">Gambar</label> <br>
                                            <input type="file" name="content_image" value="{{$posts->content_image}}">
                                        </div>
                                        <button type="submit" class="btn btn-primary float-right">Perbarui</button>
                                    </form>
                                    <br> <br>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('applianceListFinder', $posts->id) }}">
                        <span class="badge badge-primary">Lihat Appliances</span>
                    </a>
                </td>
            </tr>
        @php
            $i++
        @endphp
        @endforeach
        </tbody>
    </table>
</div>

@include('templates.script')

<script>
    const flashData = $('.flash-data').data('flashdata');

    if(flashData) {
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Berhasil Perbarui Post!',
            confirmButtonText: 'Baik',
            showConfirmButton: true,
        })
    }
</script>
@endsection
