@extends('adminlte::page')

@section('title', 'List Pelanggaran')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/detail-mahasiswa.css') }}">
@endpush

@section('content')
<div class="container mt-5">
    <div class="card border-0" style="border-radius: 7px; background-color: #E7FAFF; box-shadow: 0px 4px 4px rgba(90, 173, 194, 0.54)">
        <div class="card-body p-4">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="max-width: 200px; word-wrap: break-word; overflow: hidden; text-overflow: ellipsis;">Pelanggaran</th>
                        <th style="max-width: 80px; word-wrap: break-word;">Poin</th>
                        <th style="max-width: 30px; word-wrap: break-word; overflow: hidden; text-overflow: ellipsis;">Tanggal</th>
                        <th style="max-width: 100px; word-wrap: break-word; overflow: hidden; text-overflow: ellipsis;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="max-width: 200px; word-wrap: break-word; overflow: hidden; text-overflow: ellipsis;">
                            {{ $pelanggaran->listPelanggaran->nama_pelanggaran }}
                        </td>
                        <td style="max-width: 80px; word-wrap: break-word; overflow: hidden; text-overflow: ellipsis;">{{ $pelanggaran->listPelanggaran->poin }}</td>
                        <td>{{ $pelanggaran->created_at->format('d-m-Y') }}</td>
                        <td>
                            @if($pelanggaran->status == 'Sedang diproses')
                                <span>Kasus sedang diproses</span>
                            @elseif($pelanggaran->status == 'Selesai')
                                <span>Kasus sudah selesai diproses</span>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="container mt-5">
    <div class="timeline">
        @foreach ($pelanggaranLogs as $log)
            <div class="timeline-item">
                <div class="timeline-date">
                    {{ \Carbon\Carbon::parse($log->created_at)->format('d M Y, H:i') }}
                </div>
                <div class="timeline-content">
                    <p>
                        {{ $log->user_role }} : {{ $log->user_nama }}
                    </p>
  
                    @switch($log->action)
                        @case('Create Pelanggaran')
                            <p>{{ $log->details }}</p>
                            @break
  
                        @case('New Comment Added')
                            <p>{{ $log->details }}</p>
                            <a href="{{ route('pelanggaranMahasiswa.detail', $log->pelanggaran_id) }}" 
                               class="btn btn-sm mt-2" 
                               style="background-color: #5AADC2; color: white;">
                               Lihat
                            </a>
                            @break
  
                        @case('Update Status')
                            @if(str_contains($log->details, "to 'Diperiksa'"))
                                <p>Sedang memeriksa kasus pelanggaran</p>
                            @elseif(str_contains($log->details, "to 'Selesai'"))
                                <p>Menutup kasus pelanggaran</p>
                            @endif
                            @break
  
                        @default
                            <p>Unknown action</p>
                    @endswitch
                </div>
            </div>
        @endforeach
    </div>
</div>  

@endsection
