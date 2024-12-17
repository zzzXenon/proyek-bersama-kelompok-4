@extends('adminlte::page')

@section('title', 'Profil Mahasiswa')
@push('css')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
        <!-- Google Fonts (Pastikan font 'Source Sans 3' terimport) -->
        <link href="https://fonts.googleapis.com/css2?family=Source+Sans+3&display=swap" rel="stylesheet">
        <style>
        body {
            font-family: 'Source Sans 3', sans-serif; /* Font */
            font-size: 15px; /* Ukuran font */
            color: #484444
        }
    </style>
@endpush
    @favicon
@section('content')
<div class="container" style="max-width:1000px">
    <div class="card border-0" style="border-radius: 23px; background-color: #E7FAFF; box-shadow: 0px 0px 25px rgba(90, 173, 194, 0.54); margin-top: 80px;">
        <div class="card-body p-4">
            
            <!-- First Row: Title "Data Mahasiswa" -->
            <div class="row">
                <div class="col-12 text-center">
                    <h3 class="title" style="font-weight: bold; font-size: 24px; color: #333;">Data Mahasiswa</h3>
                    <hr style="border-top: 3px solid #B9BBDC;" class="mx-5 mt-0" style="width: 30%;">
                </div>
            </div>
            
            <!-- Second Row: Data - Left column for photo, right column for details -->
            <div class="row">
                
                <!-- Second Column: Data -->
                <div class="col-md-8">
                    <div class="mb-2 mt-4" style="border-radius: 7px; background-color: #BBE3ED; padding: 4px 40px;">
                        <strong>Nama :</strong> 
                        <span class="rounded" style="padding-inline-start: 103px;">{{ $user->nama }}</span>
                    </div>
                    <div class="mb-2" style="border-radius: 7px; background-color: #BBE3ED; padding: 4px 40px;">
                        <strong>Angkatan :</strong> 
                        <span class="rounded" style="padding-inline-start: 80px;">{{ $user->angkatan }}</span>
                    </div>
                    <div class="mb-2" style="border-radius: 7px; background-color: #BBE3ED; padding: 4px 40px;">
                        <strong>NIM :</strong> 
                        <span class="rounded" style="padding-inline-start: 114px;">{{ $user->nim }}</span>
                    </div>
                    <div class="mb-2" style="border-radius: 7px; background-color: #BBE3ED; padding: 4px 40px;">
                        <strong>Username :</strong> 
                        <span class="rounded" style="padding-inline-start: 76px;">{{ $user->username }}</span>
                    </div>
                    <div class="mb-2" style="border-radius: 7px; background-color: #BBE3ED; padding: 4px 40px;">
                        <strong>Email Akademik :</strong> 
                        <span class="rounded" style="padding-inline-start: 40px;">{{ $user->email }}</span>
                    </div>
                    <div class="mb-2" style="border-radius: 7px; background-color: #BBE3ED; padding: 4px 40px;">
                        <strong>Kelas :</strong> 
                        <span class="rounded" style="padding-inline-start: 107px;">{{ $user->kelas }}</span>
                    </div>
                    <div class="mb-2" style="border-radius: 7px; background-color: #BBE3ED; padding: 4px 40px;">
                        <strong>Program Studi :</strong> 
                        <span class="rounded" style="padding-inline-start: 50px;">{{ $user->prodi }}</span>
                    </div>
                    <div class="mb-2" style="border-radius: 7px; background-color: #BBE3ED; padding: 4px 40px;">
                        <strong>Wali Kelas :</strong> 
                        <span class="rounded" style="padding-inline-start: 78px;">{{ $user->wali }}</span>
                    </div>
                </div>

                <!-- First Column: Photo -->
                <div class="col-md-4 text-center mt-4">
                    <img src="{{ asset($user->image ? $user->image : 'images/default-image.jpg') }}" 
                         alt="Foto Mahasiswa" 
                         class="img-fluid" 
                         style="max-width: 300px; border: 3px solid #ddd; background-color: #fff; border-radius: 17px;">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
