<?php

namespace App\Http\Controllers;

use App\Models\Atlet;
use App\Models\Customer;
use App\Models\Kabupaten;
use App\Models\Pelatih;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'admin' => User::where('role', 'Admin')->count(),
            'operator' => Auth::user()->role == 'Admin' ? User::where('role', 'Operator')->count() : User::where('role', 'Operator')->where('id_kabupaten', Auth::user()->id_kabupaten)->count(),
            'atlet' =>  Auth::user()->role == 'Admin' ? Atlet::count() : Atlet::where('id_kabupaten', Auth::user()->id_kabupaten)->count(),
            'pelatih' => Auth::user()->role == 'Admin' ? Pelatih::count() : Pelatih::where('id_kabupaten', Auth::user()->id_kabupaten)->count(),
            'kabupaten' => Auth::user()->role == 'Admin' ?  Kabupaten::all() : Kabupaten::where('id', Auth::user()->id_kabupaten)->get(),
        ];
        return view('admin.dashboard', $data);
    }
    public function chartAtlet(Request $request)
    {
        $kabupaten = $request->input('id_kabupaten');

        $months = collect(range(0, 11))->map(function ($i) {
            return now()->subMonths($i)->format('m');
        })->reverse()->values();

        $labels = $months->map(function ($m) {
            return \Carbon\Carbon::create()->month($m)->format('M');
        });

        $atletCounts = $months->map(function ($m) use ($kabupaten) {
            return \App\Models\Atlet::where('id_kabupaten', $kabupaten)
                ->whereMonth('created_at', $m)
                ->whereYear('created_at', now()->year)
                ->count();
        });

        $pelatihCounts = $months->map(function ($m) use ($kabupaten) {
            return \App\Models\Pelatih::where('id_kabupaten', $kabupaten)
                ->whereMonth('created_at', $m)
                ->whereYear('created_at', now()->year)
                ->count();
        });

        return response()->json([
            'labels' => $labels,
            'atlet' => $atletCounts,
            'pelatih' => $pelatihCounts,
        ]);
    }
}
