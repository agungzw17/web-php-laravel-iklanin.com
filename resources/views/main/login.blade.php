@extends('templates.appNormal')
@section('title', 'Daftar Akun')
@section('content')
   <div class="container my-5 p-3" style="width: 40%">
        <div class="card p-4">
            <div class="card-body">
                <h4 class="card-title">Masuk</h4>
                <p class="mb-4">Masukkan alamat email dan password anda</p>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                      <label for="exampleFormControlInput1">Email</label>
                      <input type="email" value="{{ old('email') }}" name="email" class="form-control" id="exampleFormControlInput1">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Password</label>
                        <input type="password" class="form-control" name="password" id="exampleFormControlInput1">
                    </div>
                    <button class="btn btn-primary my-2" style="width: 100%"> Login </button>
                </form>
                <p>Belum punya akun ? <a href="">Daftar Sekarang</a></p>
            </div>
        </div>
   </div>
@endsection
