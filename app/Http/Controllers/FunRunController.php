<?php

namespace App\Http\Controllers;

use App\Models\FunRun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FunRunController extends Controller
{
    public function index()
    {
        $items = FunRun::orderBy('id', 'asc')->get();
        return view('fun_run.index', compact('items'));
    }

    public function create()
    {
        return view('fun_run.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'rute'      => 'required|string|max:255',
            'jarak'     => 'required|numeric',
            'elevasi'   => 'required|numeric',
            'keramaian' => 'required|integer|min:1|max:5',
            'gambar'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('fun_run', 'public');
        }

        FunRun::create([
            'rute'      => $validated['rute'],
            'jarak'     => $validated['jarak'],
            'elevasi'   => $validated['elevasi'],
            'keramaian' => $validated['keramaian'],
            'gambar'    => $path,
        ]);

        return redirect()->route('fun-run.index')
            ->with('success', 'Data rute berhasil ditambahkan.');
    }

    public function show($id)
    {
        return redirect()->route('fun-run.edit', $id);
    }

    public function edit($id)
    {
        $item = FunRun::findOrFail($id);
        return view('fun_run.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = FunRun::findOrFail($id);

        $validated = $request->validate([
            'rute'      => 'required|string|max:255',
            'jarak'     => 'required|numeric',
            'elevasi'   => 'required|numeric',
            'keramaian' => 'required|integer|min:1|max:5',
            'gambar'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $path = $item->gambar;

        if ($request->hasFile('gambar')) {
            if ($path && Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }

            $path = $request->file('gambar')->store('fun_run', 'public');
        }

        $item->update([
            'rute'      => $validated['rute'],
            'jarak'     => $validated['jarak'],
            'elevasi'   => $validated['elevasi'],
            'keramaian' => $validated['keramaian'],
            'gambar'    => $path,
        ]);

        return redirect()->route('fun-run.index')
            ->with('success', 'Data rute berhasil diupdate.');
    }

    public function destroy($id)
    {
        $item = FunRun::findOrFail($id);

        if ($item->gambar) {
            Storage::disk('public')->delete($item->gambar);
        }

        $item->delete();

        return redirect()->route('fun-run.index')
            ->with('success', 'Data rute berhasil dihapus.');
    }
}

