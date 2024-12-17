@extends('adminlte::page')

@section('title', 'List Pelanggaran')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+3&display=swap" rel="stylesheet">
    
    <!-- CSS for Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@favicon
@section('content')

<div class="container mt-2">
    <!-- Tabel Spesial; Butuh Tanggapan -->
    @if($urgentPelanggaran->isNotEmpty())
        <h4 class="text-center mb-3" style="color: #FF5733;">BUTUH TANGGAPAN</h4>
        <table class="table text-center" style="border-collapse: separate; border-spacing: 0; width: 100%;">
            <thead>
                <tr style="background-color: #FF5733; color: #fff; border-radius: 10px;">
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Pelanggaran</th>
                    <th>Poin</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody style="background-color: #FFF0E1;">
                @foreach ($urgentPelanggaran as $item)
                <tr>
                    <td>{{ $item->user->nama }}</td>
                    <td>{{ $item->user->nim }}</td>
                    <td>{{ $item->listPelanggaran->nama_pelanggaran }}</td>
                    <td>{{ $item->listPelanggaran->poin }}</td>
                    <td>
                        <span>{{ $item->status }}</span>
                        <br>
                        <a href="{{ route('pelanggaran.showComments', $item->id) }}" class="btn btn-sm mt-2" style="background-color: #5AADC2; color: white;">Lihat</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <h3 class="title text-center mb-4 pt-5 pb-1" style="color: #333; font-weight: bold; font-size: 24px;">Data Pelanggaran</h3>
    <div class="card-body p-4">
        <!-- Form Pencarian -->
        <form action="{{ route('pelanggaran.search') }}" method="GET" class="mb-4" style="text-align: right;">
            <div class="form-inline d-flex justify-content-end">
                <div class="form-group mr-2">
                    <select name="kategori" class="form-control select2" required>
                        <option value="">Pilih Kategori</option>
                        <option value="nama">Nama</option>
                        <option value="nim">NIM</option>
                        <option value="nama_pelanggaran">Pelanggaran</option>
                        <option value="status">Status</option>
                    </select>
                </div>
                <div class="form-group mr-2">
                    <input type="text" name="search" class="form-control" placeholder="Masukkan kata kunci" style="width: 250px;" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn" style="background-color: #5AADC2; color:#fff;">Cari</button>
                </div>
            </div>
        </form>

        <!-- Tabel Utama -->
        <table class="table text-center" style="border-collapse: separate; border-spacing: 0; width: 100%;">
            <thead>
                <tr style="background-color: #5AADC2; color: #fff; border-radius: 10px; box-shadow: 0px 4px 4px rgba(90, 173, 194, 0.16)">
                    <th style="border-top-left-radius: 10px; padding: 15px 20px; max-width: 150px; word-wrap: break-word;">Nama</th>
                    <th style="padding: 15px 20px; max-width: 100px; word-wrap: break-word;">NIM</th>
                    <th style="padding: 15px 20px; max-width: 200px; word-wrap: break-word;">Pelanggaran</th>
                    <th style="padding: 15px 20px; max-width: 80px; word-wrap: break-word;">Poin</th>
                    <th style="border-top-right-radius: 10px; padding: 15px 20px; max-width: 150px; word-wrap: break-word;">Status Pelanggaran</th>
                </tr>
            </thead>
            <tbody style="background-color: #E7FAFF; box-shadow: 0px 4px 6px rgba(90, 173, 194, 0.54); border-radius: 30px;">
                @foreach ($pelanggaran as $item)
                <tr style="background-color: #E7FAFF; border-bottom: 4px solid #fff; border-radius: 30px;">
                    <td style="padding: 15px;">{{ $item->user->nama }}</td>
                    <td style="padding: 15px; max-width: 100px; word-wrap: break-word;">{{ $item->user->nim }}</td>
                    <td style="padding: 15px; max-width: 200px; word-wrap: break-word;">{{ $item->listPelanggaran->nama_pelanggaran }}</td>
                    <td style="padding: 15px; max-width: 80px; word-wrap: break-word;">{{ $item->listPelanggaran->poin }}</td>
                    <td style="padding: 15px; max-width: 150px; word-wrap: break-word;">
                        <span>{{ $item->status }}</span>
                        <br>
                        <a href="{{ route('pelanggaran.showComments', $item->id) }}" class="btn btn-sm mt-2" style="background-color: #5AADC2; color: white;">Lihat</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination Links -->
        {{ $pelanggaran->links() }}
    </div>
</div>
@endsection

@push('js')
    <!-- JS for Select2 -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize Select2
            $('.select2').select2({
            });
            
        });
    </script>
@endpush
