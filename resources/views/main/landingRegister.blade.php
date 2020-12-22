@extends('templates.appNormal')
@section('title', 'Daftar Akun')
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <style>
        label > input { /* Menyembunyikan radio button */
            visibility: hidden;
            position: absolute;
        }
        label > input + img { /* style gambar */
            cursor:pointer;
            border:2px solid transparent;
        }
        label > input:checked + img { /* (RADIO CHECKED) style gambar */
            border:2px solid #f00;
        }
    </style>
@section('content')
    <div class="container p-3 mt-2">
        <h2 style="font-weight: bold">Daftar ke <b>Iklanin</b>.com !</h2>
        <div class="container my-5 px-5" style="background-color: #EBFAFC; border-radius: 15px 50px 30px; height: 200px">
            <div class="d-inline p-5">
                <h3 style="font-weight: bold">The Finder</h3>
                <p>Finder adalah orang yang akan mendapatkan uang dengan cara mempromosikan dagangan dari Giver</p>
                <button id="modalFinder" data-toggle="modal" data-target="#pendaftaran" class="btn btn-primary mb-5">Daftar Sebagai <b>Finder</b></button>
            </div>
            <div class="d-inline float-right" style="margin-top: -5%">
                <img  src="{{ asset('core-images/finder.png') }}" alt="" style="width: 300px">
            </div>
        </div>
        <div class="container my-5 px-5" style="background-color: #E7F3EA; border-radius: 15px 50px 30px; height: 200px">
            <div class="d-inline p-5">
                <h3 style="font-weight: bold">The Giver</h3>
                <p>Giver adalah orang yang ingin dagangan / jasanya di promosikan</p>
                <button id="modalGiver" data-toggle="modal" data-target="#pendaftaran" class="btn btn-success">Daftar Sebagai <b>Giver</b></button>
            </div>
            <div class="d-inline float-right" style="margin-top: -5%">
                <img  src="{{ asset('core-images/shop.png') }}" alt="" style="width: 300px">
            </div>
        </div>
    </div>

    {{-- Modals Pendaftaran --}}
    <div class="modal fade" id="pendaftaran" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form" method="post" action="{{ route('registerPage.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="roles" id="role_name">
                        <div id="page1">
                            <div class="form-group" style="letter-spacing: 2px">
                                <label for="name" class="col-form-label mb-2" style="font-family: Poppins; font-size: 22px; color: grey"><b>Siapakah Anda ?</b></label>
                            </div>
                            <div class="form-group d-inline mx-2">
                                <label>
                                    <p class="btn btn-primary">Perorangan</p> <br>
                                    <input type="radio" name="type" id="type1" value="1">
                                    <img class="img-fluid" style="width: 350px" src="{{ asset('core-images/soloiste.jpg') }}" alt="">
                                </label>
                            </div>
                            <div class="form-group d-inline mx-2">
                                <label>
                                    <p class="btn btn-primary">Perusahaan / Organisasi</p> <br>
                                    <input type="radio" name="type" id="type2" value="2">
                                    <img class="img-fluid" style="width: 350px" src="{{ asset('core-images/organisation.jpg') }}" alt="">
                                </label>
                            </div>
                            <p id="type" class="text-danger" style="display: none">* Wajib memilih salah satu pilihan</p>
                        </div>
                        <div id="company" style="display: none">
                            <div class="form-group">
                                <label for="name" class="col-form-label">Nama Perusahaan / Organisasi</label>
                                <input type="text" id="company_name" name="company_name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-form-label">Alamat Perusahaan</label>
                                <input type="text" id="name" name="company_address" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-form-label">Nama Pemilik / Ketua</label>
                                <input type="text" id="name" name="company_ceo" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="username" class="col-form-label">Username</label>
                                <input type="text" id="username" name="company_username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-form-label">Email</label>
                                <input type="email" id="email" name="company_email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-form-label">Password</label>
                                <input type="text" id="password" name="company_password" class="form-control">
                            </div>
                        </div>
                        <div id="individual" style="display: none">
                            <div class="form-group">
                                <label for="name" class="col-form-label">Nama</label>
                                <input type="text" id="name" name="name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="username" class="col-form-label">Username</label>
                                <input type="text" id="username" name="username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-form-label">Email</label>
                                <input type="email" id="email" name="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-form-label">Password</label>
                                <input type="text" id="password" name="password" class="form-control">
                            </div>
                        </div>
                        <div id="page3" style="display: none">
                            <div class="form-group">
                                <label for="birth_date" class="col-form-label">Tanggal Lahir</label>
                                <input type="date" id="birth_date" name="birth_date" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="no_hp" class="col-form-label">Nomor Hp</label>
                                <input type="number" id="no_hp" name="no_hp" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="instagram" class="col-form-label">Link Instagram</label>
                                <input type="text" id="instagram" name="instagram" class="form-control" value="https://www.instagram.com/masukan_username_instagram_disini/">
                            </div>
                            <div class="form-group">
                                <label for="facebook" class="col-form-label">Link Facebook</label>
                                <input type="text" id="facebook" name="facebook" class="form-control" value="Masukan link facebook">
                            </div>
                            <div class="form-group">
                                <label for="twitter" class="col-form-label">Link Twitter</label>
                                <input type="text" id="twitter" name="twitter" class="form-control" value="https://twitter.com/masukan_username_twitter_disini">
                            </div>
                            <div class="form-group">
                                <label for="address" class="col-form-label">Alamat Lengkap</label>
                                <textarea type="text" id="address" name="address" class="form-control"> </textarea>
                            </div>
                            <p class="text-danger" style="font-zie: 10px">* Dengan melakukan pendaftaran anda menyetujui peraturan yang ada di <b>Iklanin</b>.com</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="backButton1" type="button" style="display: none" class="btn btn-info">Kembali</button>
                        <button id="backButton2" type="button" style="display: none" class="btn btn-info">Kembali</button>
                        <button id="nextButton1" type="button" class="btn btn-primary">Selanjutnya</button>
                        <button id="nextButton2" type="button" style="display: none" class="btn btn-primary">Selanjutnya</button>
                        <button id="submitButton" style="display: none" type="submit" class="btn btn-primary">Daftar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('templates.script')
    <script>
        $(document).ready(function(){
            // Modal Pendaftaran
            $('#modalFinder').click(function() {
                $('#pendaftaran').on('show.bs.modal');
                $('#title').text('Daftar Sebagai Finder');
                $('#role_name').val("1");
            });

            $('#modalGiver').click(function() {
                $('#pendaftaran').on('show.bs.modal');
                $('#title').text('Daftar Sebagai Giver');
                $('#role_name').val("2");
            });

            // Register
            $('#nextButton1').click(function() {
                var type1 = $("input[id='type1']:checked").val();
                var type2 = $("input[id='type2']:checked").val();
                if(type1 != undefined || type2 != undefined) {
                    if(type1 != undefined) {
                        $('#individual').show();
                    } else if(type2 != undefined) {
                        $('#company').show();
                    }

                    $('#page1').hide();
                    $('#nextButton1').hide();
                    $('#nextButton2').show();
                    $('#backButton1').show();
                } else {
                    $('#type').show();
                }
            });

            $('#nextButton2').click(function() {
                $('#nextButton1').hide();
                $('#nextButton2').hide();
                $('#backButton1').hide();
                $('#backButton2').show();
                $('#submitButton').show();
                $('#company').hide();
                $('#individual').hide();
                $('#page2').hide();
                $('#page3').show();
            });

            $('#backButton1').click(function() {
                $('#nextButton1').show();
                $('#nextButton2').hide();
                $('#backButton1').hide();
                $('#submitButton').hide();
                $('#page1').show();
                $('#company').hide();
                $('#individual').hide();
            });

            $('#backButton2').click(function() {
                var type1 = $("input[id='type1']:checked").val();
                var type2 = $("input[id='type2']:checked").val();

                if(type1 != undefined) {
                    $('#individual').show();
                } else if(type2 != undefined) {
                    $('#company').show();
                }

                $('#nextButton1').show();
                $('#backButton1').show();
                $('#backButton2').hide();
                $('#submitButton').hide();
                $('#page2').show();
                $('#page3').hide();
            });

            // Validasi Form

        // Giver
        });
    </script>
@endsection
