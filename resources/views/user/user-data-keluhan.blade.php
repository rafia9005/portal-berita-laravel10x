@extends('layout.head')

@section('container')
    @foreach ($dataKeluhanUser as $keluhan)
        <p>Nama: {{ $keluhan->nama }}</p>
        <p>Email: {{ $keluhan->email }}</p>
        <p>Keluhan: {{ $keluhan->keluhan }}</p>
        <p>Action: {{ $keluhan->action }}</p>
    @endforeach
@endsection
