@extends('layout.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Daftar Rute Lari</h2>
        <a href="{{ route('fun-run.create') }}" class="btn btn-primary">+ Tambah Rute</a>
    </div>

    @if($items->isEmpty())
        <div class="alert alert-info">Belum ada data rute.</div>
    @else
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Rute</th>
                <th>Jarak (km)</th>
                <th>Elevasi (m)</th>
                <th>Keramaian</th>
                <th>Foto</th>
                <th style="width: 170px;">Aksi</th>
            </tr>
            </thead>
            <tbody>
            @foreach($items as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->rute }}</td>
                    <td>{{ $item->jarak }}</td>
                    <td>{{ $item->elevasi }}</td>
                    <td>
                        @for($i = 1; $i <= 5; $i++)
                            <span class="{{ $i <= $item->keramaian ? 'text-warning' : 'text-secondary' }}">
                                ★
                            </span>
                        @endfor
                        <small class="text-muted">({{ $item->keramaian }}/5)</small>
                    </td>
                    <td>
                        @if($item->gambar)
                            <img src="{{ asset('storage/'.$item->gambar) }}"
                                 alt="Foto rute"
                                 style="width: 80px; height: 80px; object-fit: cover;"
                                 class="rounded">
                        @else
                            <span class="text-muted">Tidak ada foto</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('fun-run.edit', $item->id) }}"
                           class="btn btn-sm btn-warning">Edit</a>

                        <form action="{{ route('fun-run.destroy', $item->id) }}"
                              method="post" class="d-inline"
                              onsubmit="return confirm('Yakin hapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@endsection
