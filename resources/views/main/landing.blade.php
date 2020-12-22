@extends('templates.app')
@section('title', 'Promosikan Daganganmu Semudah Itu')
@section('content')
<div class="row pl-5 py-3" style="background-color: #EBFAFC; background-opacity: 0.5; margin-top: -22px">
    <div class="col-xl-6 col-md-6 mt-4 ml-5 pl-5">
      <div style="font-size: 45px; font-weight: bold; color: #080961" class="mb-2">
        Iklankan Daganganmu,
        <br>
        Tentukan Sendiri Biayanya !
      </div>
      <p style="font-size: 20px">Daftar sebagai <b>Giver</b> untuk mempromosikan daganganmu</p>
      <button class="btn btn-primary mt-2 mb-4">Daftar Sekarang</button>
    </div>
    <div class="col-xl-3 col-md-6 mt-3 mb-4 p-3">
      <img style="width: 110%" src="{{ asset('core-images/speaker.png') }}" alt="">
    </div>
  </div>
  <div class="row p-5">
    <div class="col-xl-3 col-md-6 mt-5 ml-5 pl-5">
      <img src="{{ asset('core-images/money.png') }}" alt="">
    </div>
    <div class="col-xl-6 col-md-6 mt-4 mb-4 p-3">
      <div style="font-size: 35px; font-weight: bold" class=" mb-2">
        Ingin Punya Penghasilan Tambahan ?
      </div>
      <p style="font-size: 20px">
        Dengan mendaftar sebagai <b>Finder</b> di  <b>Iklanin</b>.com,
        anda bisa mengiklankan produk orang lain melalui social media
        dan mendapatkan penghasilan tambahan
      </p>
    </div>
  </div>
  <div class="mt-5" style="text-align: center; background-color: #EBFAFC">
      <div style="font-size: 35px; font-weight: bold; color: #080961" class="p-3 mb-2">
        Mengapa Iklanin.com ?
      </div>
      <div class="row ml-5">
        <div class="col-xl-3 col-md-6 mt-5 ml-5 pl-5 mr-2" >
          <img style="width: 150px" src="{{ asset('core-images/easy.png') }}" alt="">
        </div>
        <div class="col-xl-3 col-md-6 mt-5 ml-5 pl-5 mr-2">
          <img style="width: 150px" src="{{ asset('core-images/fast.png') }}" alt="">
        </div>
        <div class="col-xl-3 col-md-6 mt-5 ml-5 pl-5 mr-2">
          <img style="width: 150px" src="{{ asset('core-images/secure.png') }}" alt="">
        </div>
      </div>
      <div class="row ml-5" style="color: #080961">
          <div class="col-xl-3 col-md-6 mt-2 ml-5 pl-5 mr-2">
              <h3 class="mb-3"><b>Mudah</b></h3>
              <h6>
                  Cara penggunaan sederhana
                  dan tidak membingungkan
              </h6>
          </div>
          <div class="col-xl-3 col-md-6 mt-2 ml-5 pl-5 mr-2">
            <h3 class="mb-3"><b>Proses Cepat</b></h3>
            <h6>
              Cukup dengan daftar
              dan posting dagangan anda
          </h6>
          </div>
          <div class="col-xl-3 col-md-6 mt-2 ml-5 pl-5 mr-2">
            <h3 class="mb-3"><b>Keamanan Terjamin</b></h3>
            <h6>
              Konfirmasi menggunakan
              aplikasi sehingga mengurangi
                    kemungkinan penipuan
          </h6>
          </div>
        </div>
  </div>
  <div class="container mt-5 p-5">
      <h1 style="font-weight: bold">
          Kontak
      </h1>
      <p style="font-size: 35px">Hubungi kami melalui email</p>
      <h3 style="font-weight: bold">csiklanin@gmail.com</h3>
  </div>
@endsection
