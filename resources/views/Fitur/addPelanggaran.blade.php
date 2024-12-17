@extends('adminlte::page')

@section('title', 'Form Pelanggaran')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <!-- Google Fonts (Pastikan font 'Source Sans 3' terimport) -->
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+3&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Source Sans 3', sans-serif;
            font-size: 15px;
            color: #484444
        }
    </style>
@endpush

@section('content')
<div class="container mt-5">

    <!-- Display Success -->
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <!-- Display Errors -->
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div>
        <!-- Pelanggaran Form -->
        <form action="{{ route('pelanggaran.store') }}" method="POST" class="p-4 rounded" style="max-width: 600px; margin-top: 80px; margin-left: 250px; box-shadow: 0px 0px 30px rgba(90, 173, 194, 0.54)" enctype="multipart/form-data">
            <h2 class="text-center mb-5">Form Pelanggaran</h2>
            @csrf

            <!-- Angkatan Textbox -->
            <div class="mb-3">
                <label for="angkatan" class="form-label" style="font-weight: normal;">Angkatan:</label>
                <input type="text" name="angkatan" id="angkatan" class="form-control">
            </div>

            <!-- Prodi Textbox -->
            <div class="mb-3">
                <label for="prodi" class="form-label" style="font-weight: normal;">Prodi:</label>
                <input type="text" name="prodi" id="prodi" class="form-control">
            </div>

            <!-- NIM Textbox -->
            <div class="mb-3">
                <label for="nim" class="form-label" style="font-weight: normal;">NIM:</label>
                <input type="text" name="nim" id="nim" class="form-control">
            </div>

            <!-- Nama Textbox -->
            <div class="mb-3">
                <label for="nama" class="form-label" style="font-weight: normal;">Nama:</label>
                <input type="text" name="nama" id="nama" class="form-control">
            </div>

            <!-- Jenis Pelanggaran Dropdown -->
            <div class="mb-3">
                <label for="poin_pelanggaran" class="form-label">Jenis Pelanggaran:</label>
                <select name="list_pelanggaran_id" id="poin_pelanggaran" class="form-select">
                    <option value="">Pilih Jenis Pelanggaran</option>
                    @foreach ($poinPelanggaran as $poin)
                        <option value="{{ $poin->id }}" {{ old('list_pelanggaran_id') == $poin->id ? 'selected' : '' }}>
                            {{ $poin->nama_pelanggaran }} ({{ $poin->poin }} Poin)
                        </option>
                    @endforeach
                </select>
                @if ($errors->has('poin_pelanggaran'))
                    <div class="text-danger">{{ $errors->first('poin_pelanggaran') }}</div>
                @endif
            </div>

            <!-- Laporan Comment Textbox -->
            <div class="mb-3">
                <label for="comment" class="form-label">Laporan:</label>
                <textarea name="comment" id="comment" class="form-control" rows="4" required>{{ old('comment') }}</textarea>
            </div>

            <!-- File Upload (Optional) -->
            <div class="mb-3">
                <label for="file" class="form-label">Lampirkan File (Opsional):</label>
                <input type="file" name="file" id="file" class="form-control">
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit" class="btn text-bold mt-5" style="background-color: #5AADC2; padding: 5px 22px; color: #fff">Kirim</button>
            </div>
        </form>
    </div>

@endsection

@section('css')
    <!-- CSS for Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    
    <style>
        .form-label {
            margin-bottom: 4px !important;
        }

        .form-control,
        .form-select {
            margin-top: 0 !important;
        }

        #poin_pelanggaran {
            width: 100%;
            max-width: 100%;
        }

        #poin_pelanggaran option {
            white-space: normal;
            word-wrap: break-word;
            word-break: break-word;
        }

        .select2-container--default .select2-selection--single {
            height: 30px !important;
            line-height: 30px !important;
            align-items: center !important;
            display: flex !important;
        }

        .select2-results__option--highlighted {
            background-color: #5AADC2 !important;
            color: #fff !important;
        }

        .select2-results__option {
            padding: 10px !important;
        }

        .select2-selection__clear {
            background-color: red !important;
            color: white !important;
            border-radius: 50%;
            font-size: 12px !important;
            width: 13px;
            height: 13px;
            align-items: center;
            justify-content: center;
            display: flex;
            transform: translateY(60%);
            margin-left: 5px;
        }

        .select2-selection__clear:hover {
            background-color: darkred !important;
        }
    </style>
@endsection

@section('js')
    <!-- JS for Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#poin_pelanggaran').select2({
                placeholder: 'Pilih Jenis Pelanggaran',
                allowClear: true,
                width: '100%'  // Menyesuaikan lebar dropdown dengan container
            });
        });
    </script>
@endsection
