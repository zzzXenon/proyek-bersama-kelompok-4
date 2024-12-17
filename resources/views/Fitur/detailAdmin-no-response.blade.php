@extends('adminlte::page') 

@section('title', 'Detail Pelanggaran')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/detail-mahasiswa.css') }}">
@endpush

@section('content')
<h3 class="title text-center mb-4 pt-5 pb-1" style="color: #333;">Detail Pelanggaran</h3>

<div class="container mt-5">
    <div class="card border-0" style="border-radius: 7px; background-color: #E4E9EF; box-shadow: 0px 6px 8px rgba(0, 111, 255, 0.25);">
        <div class="card-body p-4">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="max-width: 150px; word-wrap: break-word;">Nama</th>
                        <th style="max-width: 100px; word-wrap: break-word;">NIM</th>
                        <th style="max-width: 150px; word-wrap: break-word;">Prodi</th>
                        <th style="max-width: 200px; word-wrap: break-word; overflow: hidden; text-overflow: ellipsis;">Deskripsi Pelanggaran</th>
                        <th style="max-width: 80px; word-wrap: break-word;">Poin</th>
                        <th style="max-width: 30px; word-wrap: break-word; overflow: hidden; text-overflow: ellipsis;">Tanggal</th>
                        <th style="max-width: 100px; word-wrap: break-word; overflow: hidden; text-overflow: ellipsis;">Status</th>                     
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="max-width: 150px; word-wrap: break-word; overflow: hidden; text-overflow: ellipsis;">{{ $pelanggaran->user->nama }}</td>
                        <td style="max-width: 100px; word-wrap: break-word; overflow: hidden; text-overflow: ellipsis;">{{ $pelanggaran->user->nim }}</td>
                        <td style="max-width: 150px; word-wrap: break-word; overflow: hidden; text-overflow: ellipsis;">{{ $pelanggaran->user->prodi }}</td>
                        <td style="max-width: 200px; word-wrap: break-word; overflow: hidden; text-overflow: ellipsis;">{{ $pelanggaran->listPelanggaran->nama_pelanggaran }}</td>
                        <td style="max-width: 80px; word-wrap: break-word; overflow: hidden; text-overflow: ellipsis;">{{ $pelanggaran->listPelanggaran->poin }}</td>
                        <td>{{ $pelanggaran->created_at->format('d-m-Y') }}</td>
                        <td>
                            <!-- Status Badge -->
                            @if($pelanggaran->status == 'Sedang diproses')
                                <span class="badge badge-belum">Sedang diproses</span>
                            @elseif($pelanggaran->status == 'Selesai')
                                <span class="badge badge-selesai">Selesai</span>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="container mt-5">
    <h4>Tanggapan Sebelumnya</h4>
    @foreach ($pelanggaran->comments as $comment)
        <div class="comment mb-3 p-3 border rounded">
            <p>
                <strong>({{ $comment->user->role }}) {{ $comment->user->nama }}</strong>
                <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
            </p>
            <p>{{ $comment->comment }}</p>

            @if ($comment->file_path)
                <p>
                    <a href="{{ asset('storage/files/' . $comment->file) }}" class="btn btn-sm mt-2" style="background-color: #5AADC2; color: white;" download>
                        Download Attached File
                    </a>
                </p>
            @endif
        </div>
    @endforeach
</div>

@endsection
