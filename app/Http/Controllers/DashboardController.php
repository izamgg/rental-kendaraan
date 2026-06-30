<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\Rental;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'vehicles' => Vehicle::count(),
            'rentals' => Rental::count(),
            'users' => User::count(),
        ]);
    }
    public function approve($id)
{
    $rental = Rental::findOrFail($id);
    $rental->status = 'approved';
    $rental->save();

    return back()->with('success', 'Rental disetujui');
}

public function reject($id)
{
    $rental = Rental::findOrFail($id);
    $rental->status = 'rejected';
    $rental->save();

    return back()->with('success', 'Rental ditolak');
}
public function admin()
{
    $rentals = Rental::with('user', 'vehicle')->latest()->get();
    return view('rentals.admin', compact('rentals'));
}
}