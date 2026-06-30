<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RentalController extends Controller
{
    // =====================
    // USER - LIST VEHICLE
    // =====================
    public function index()
    {
        $vehicles = Vehicle::latest()->get();
        return view('rental', compact('vehicles'));
    }

    // =====================
    // AJAX HITUNG TOTAL
    // =====================
    public function calculate($id, $days)
    {
        $vehicle = Vehicle::findOrFail($id);

        return response()->json([
            'total' => $vehicle->price_per_day * $days
        ]);
    }

    // =====================
    // USER - STORE RENTAL
    // =====================
    public function store(Request $request)
    {
        $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'days'       => 'required|numeric|min:1'
        ]);

        $vehicle = Vehicle::findOrFail($request->vehicle_id);

        Rental::create([
            'user_id'     => Auth::id(),
            'vehicle_id'  => $request->vehicle_id,
            'days'        => $request->days,
            'total_price' => $vehicle->price_per_day * $request->days,
            'status'      => 'pending'
        ]);

        return back()->with('success', 'Berhasil menyewa kendaraan!');
    }

    // =====================
    // USER - HISTORY
    // =====================
    public function history()
    {
        $rentals = Rental::with('vehicle')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('rentals.history', compact('rentals'));
    }

    // =====================
    // USER - CANCEL RENTAL
    // =====================
    public function cancel($id)
    {
        $rental = Rental::find($id);

        if (!$rental) {
            return back()->with('error', 'Data transaksi sewa tidak ditemukan.');
        }

        // Keamanan: pastikan data ini milik user yang login dan statusnya masih pending
        if ($rental->user_id == Auth::id() && $rental->status == 'pending') {
            $rental->delete();
            return back()->with('success', 'Penyewaan berhasil dibatalkan.');
        }

        return back()->with('error', 'Transaksi gagal dibatalkan karena sudah diproses.');
    }

    // =====================
    // ADMIN - LIST RENTAL
    // =====================
    public function admin()
    {
        $rentals = Rental::with(['user', 'vehicle'])
            ->latest()
            ->get();

        return view('rentals.admin', compact('rentals'));
    }

    // =====================
    // ADMIN - APPROVE
    // =====================
    public function approve($id)
    {
        $rental = Rental::findOrFail($id);

        if ($rental->status !== 'pending') {
            return back()->with('error', 'Rental sudah diproses sebelumnya!');
        }

        $rental->update([
            'status' => 'approved'
        ]);

        return back()->with('success', 'Rental berhasil disetujui!');
    }

    // =====================
    // ADMIN - REJECT
    // =====================
    public function reject($id)
    {
        $rental = Rental::findOrFail($id);

        if ($rental->status !== 'pending') {
            return back()->with('error', 'Rental sudah diproses sebelumnya!');
        }

        $rental->update([
            'status' => 'rejected'
        ]);

        return back()->with('success', 'Rental berhasil ditolak!');
    }
}