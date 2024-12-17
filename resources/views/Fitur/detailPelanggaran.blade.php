@extends('adminlte::page') 

@section('title', 'Detail Pelanggaran')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/detail-mahasiswa.css') }}">
@endpush

@section('content')
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

<div class="container mt-5">
    @if ($pelanggaran->level !== "Level 5")
        @if ($pelanggaran->level == "Level 2" && Auth::user()->role == 'Kemahasiswaan')
            <form action="{{ route('pelanggaran.storeComment', $pelanggaran->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="comment" class="form-label">Tanggapan:</label>
                    <textarea name="comment" id="comment" class="form-control" rows="4" required>{{ old('comment') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="file" class="form-label">Lampirkan File (Opsional):</label>
                    <input type="file" name="file" id="file" class="form-control">
                </div>

                <div class="form-group mt-3">
                    <!-- Action buttons for level update -->
                    <button type="submit" name="action" value="level_3" class="btn btn-primary">Kirim ke Komdis</button>
                    <button type="submit" name="action" value="level_4" class="btn btn-success">Kirim ke Rektor</button>
                </div>
            </form>
        @else
            <form action="{{ route('pelanggaran.storeComment', $pelanggaran->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="comment" class="form-label">Tanggapan:</label>
                    <textarea name="comment" id="comment" class="form-control" rows="4" required>{{ old('comment') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="file" class="form-label">Lampirkan File (Opsional):</label>
                    <input type="file" name="file" id="file" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Kirim</button>
            </form>
        @endif
    @endif
</div>

@endsection
