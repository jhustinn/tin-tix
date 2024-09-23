<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(): View {
        $totalMovies = Movie::count();
        $totalTicketSales = Booking::count();
        $totalUsers = User::count();
        $totalRevenue = DB::table('bookings')->sum('total_price');
        $recentBookings = Booking::with('movie', 'user')->latest()->take(5)->get();
        
        return view("admin.home", compact("totalMovies","totalTicketSales", "totalRevenue", "recentBookings", "totalUsers"));
    }
    
    public function java(): View {
        return view("java.index");
    }
}
