<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VehicleController extends Controller
{
    // =====================
    // LIST DATA
    // =====================
   public function index()
{
    return view('vehicles.index');
}

    // =====================
    // FORM CREATE
    // =====================
    public function create()
    {
        return view('vehicles.create');
    }

    // =====================
    // SIMPAN DATA
    // =====================
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'type' => 'required',
            'price_per_day' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'description' => 'nullable'
        ]);

        // upload gambar
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('vehicles', 'public');
        }

        Vehicle::create($data);

        return redirect()->route('vehicles.index')
            ->with('success', 'Berhasil ditambahkan');
    }

    // =====================
    // FORM EDIT
    // =====================
    public function edit($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        return view('vehicles.edit', compact('vehicle'));
    }

    // =====================
    // UPDATE DATA
    // =====================
    public function update(Request $request, $id)
    {
        $vehicle = Vehicle::findOrFail($id);

        $data = $request->validate([
            'name' => 'required',
            'type' => 'required',
            'price_per_day' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'description' => 'nullable'
        ]);

        // kalau upload gambar baru
        if ($request->hasFile('image')) {

            // hapus gambar lama kalau ada
            if ($vehicle->image && Storage::disk('public')->exists($vehicle->image)) {
                Storage::disk('public')->delete($vehicle->image);
            }

            $data['image'] = $request->file('image')->store('vehicles', 'public');
        }

        $vehicle->update($data);

        return redirect()->route('vehicles.index')
            ->with('success', 'Berhasil diupdate');
    }

    // =====================
    // HAPUS DATA
    // =====================
    public function destroy($id)
    {
        $vehicle = Vehicle::findOrFail($id);

        // hapus gambar
        if ($vehicle->image && Storage::disk('public')->exists($vehicle->image)) {
            Storage::disk('public')->delete($vehicle->image);
        }

        $vehicle->delete();

        return redirect()->route('vehicles.index')
            ->with('success', 'Berhasil dihapus');
    }
}