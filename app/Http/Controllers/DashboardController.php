<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\Rental;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Jika dia Admin
        if ($user->role == 'admin') {
            return view('dashboard', [
                'vehicles' => Vehicle::count(),
                'rentals' => Rental::count(),
                'users' => User::count(),
                'pending' => Rental::where('status', 'pending')->count(),
                'approved' => Rental::where('status', 'approved')->count(),
                'rejected' => Rental::where('status', 'rejected')->count(),
            ]);
        }

        // Jika dia User Biasa
        return view('dashboard', [
            'rentals' => Rental::where('user_id', $user->id)->count(),

            'pending' => Rental::where('user_id', $user->id)
                                ->where('status', 'pending')
                                ->count(),

            'approved' => Rental::where('user_id', $user->id)
                                ->where('status', 'approved')
                                ->count(),

            'rejected' => Rental::where('user_id', $user->id)
                                ->where('status', 'rejected')
                                ->count(),

            'totalSpent' => Rental::where('user_id', $user->id)
                                    ->where('status', 'approved')
                                    ->sum('total_price'),
        ]);
    }

    // ... method approve, reject, dan admin tetap sama seperti kode awal kamu
}