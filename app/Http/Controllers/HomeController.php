<?php

namespace App\Http\Controllers;

use App\Models\Bien;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $troisDerniersBiens = Bien::with(['photos' => function ($query) {
            $query->take(1);
        }])
        ->where('publie', true)
        ->latest()
        ->take(3)
        ->get();

        $biens = Bien::with(['photos' => function ($query) {
            $query->take(1);
        }])
        ->where('disponibilite', 'Disponible')
        ->where('publie', true)
        ->take(10)
        ->get();

        return view('home', compact('troisDerniersBiens', 'biens'));
    }
}
