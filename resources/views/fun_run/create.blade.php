@extends('layout.app')

@section('content')
    <h2 class="mb-3">Tambah Rute Lari</h2>

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
          action="{{ route('fun-run.store') }}"
          enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nama Rute</label>
            <input type="text" name="rute" class="form-control"
                   value="{{ old('rute') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Jarak (km)</label>
            <input type="number" step="0.01" name="jarak" class="form-control"
                   value="{{ old('jarak') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Elevasi (m)</label>
            <input type="number" name="elevasi" class="form-control"
                   value="{{ old('elevasi') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Keramaian</label>
            <select name="keramaian" class="form-select" required>
                <option value="">-- Pilih keramaian --</option>
                @for($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}" {{ old('keramaian') == $i ? 'selected' : '' }}>
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
            <label class="form-label">Foto Rute (opsional)</label>
            <input type="file" name="gambar" class="form-control" accept="image/*">
            <small class="text-muted">Format: JPG/PNG, maks 2MB.</small>
        </div>

        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('fun-run.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
@endsection
