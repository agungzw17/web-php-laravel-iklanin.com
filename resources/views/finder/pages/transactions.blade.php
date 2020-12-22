@extends('templates.appNormal')
@section('title', 'List Post')
@section('content')

<div class="container my-5">
    <nav class="my-4 text-primary" style="margin-left: -40px">
        <ol>
            <li class="d-inline"><a href="{{ url('/home') }}">Home</a></li>
            <i class="fa fa-chevron-circle-right"></i>
            <li class="d-inline" aria-current="page">Histori Transaksi</li>
        </ol>
    </nav>
    <ul class="list-group list-group-horizontal">
        <li class="list-group-item">
            <h4>Histori Transaksi iklan</h4> <br>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Giver</th>
                    <th scope="col">Judul Iklan</th>
                    <th scope="col">Uang Didapat</th>
                    <th scope="col">Tanggal Transaksi</th>
                </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1
                    @endphp
                    @foreach($appliances as $appliance)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{$appliance->userGiver->name}}</td>
                        <td>{{$appliance->iklan->title}}</td>
                        <td>{{$appliance->price}}</td>
                        <td>{{ date('d M Y - H:i:s', $appliance->created_at->timestamp) }}</td>
                    </tr>
                    @php
                        $i++
                    @endphp
                    @endforeach
                </tbody>
            </table>
        </li>
        <li class="list-group-item">
        <h4>Histori Transaksi paid promot</h4> <br>
        <table class="table">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Nama Giver</th>
            <th scope="col">Judul Iklan</th>
            <th scope="col">Uang Didapat</th>
            <th scope="col">Tanggal Transaksi</th>
        </tr>
        </thead>
        <tbody>
            @php
                $i = 1
            @endphp
            @foreach($otherAppliances as $otherAppliance)
            <tr>
                <td>{{ $i }}</td>
                <td>{{$otherAppliance->user->name}}</td>
                <td>{{$otherAppliance->iklan->title}}</td>
                <td>{{$otherAppliance->price}}</td>
                <td>{{ date('d M Y - H:i:s', $otherAppliance->created_at->timestamp) }}</td>
            </tr>
            @php
                $i++
            @endphp
            @endforeach
        </tbody>
      </table>
        </li>
    </ul>
    
      
</div>

@endsection
