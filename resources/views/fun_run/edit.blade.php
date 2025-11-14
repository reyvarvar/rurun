@extends('layout.app')

@section('content')
    <h2 class="mb-3">Edit Rute Lari</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post"
          action="{{ route('fun-run.update', $item->id) }}"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nama Rute</label>
            <input type="text" name="rute" class="form-control"
                   value="{{ old('rute', $item->rute) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Jarak (km)</label>
            <input type="number" step="0.01" name="jarak" class="form-control"
                   value="{{ old('jarak', $item->jarak) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Elevasi (m)</label>
            <input type="number" name="elevasi" class="form-control"
                   value="{{ old('elevasi', $item->elevasi) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Keramaian</label>
            <select name="keramaian" class="form-select" required>
                @for($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}" {{ old('keramaian', $item->keramaian) == $i ? 'selected' : '' }}>
                        @for($j = 1; $j <= $i; $j++)
                            ★
                        @endfor
                        ({{ $i }})
                    </option>
                @endfor
            </select>
            <small class="text-muted">
                1 = sepi, 5 = sangat ramai
            </small>
        </div>

        <div class="mb-3">
            <label class="form-label d-block">Foto Rute</label>
            @if($item->gambar)
                <div class="mb-2">
                    <img src="{{ asset('storage/'.$item->gambar) }}"
                         alt="Foto rute"
                         style="width: 120px; height: 120px; object-fit: cover;"
                         class="rounded">
                </div>
            @else
                <p class="text-muted">Belum ada foto.</p>
            @endif
            <input type="file" name="gambar" class="form-control" accept="image/*">
            <small class="text-muted">
                Kosongkan jika tidak ingin mengganti foto.
            </small>
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('fun-run.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
@endsection
