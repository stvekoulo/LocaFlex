<?php

namespace App\Http\Controllers;

use App\Models\Bien;
use App\Models\User;
use App\Models\Service;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $neufDerniersBiens = Bien::with(['photos' => function ($query) {
            $query->take(1);
        }])
        ->where('publie', true)
        ->latest()
        ->take(9)
        ->get();

        $biens = Bien::with(['photos' => function ($query) {
            $query->take(1);
        }])
        ->where('disponibilite', 'Disponible')
        ->where('publie', true)
        ->take(10)
        ->get();

        $neufDerniersServices = Service::where('disponibilite', 'Disponible')
            ->where('publie', true)
            ->latest()
            ->take(9)
            ->get();

        $nombreUtilisateursTotal = User::count();
        if ($nombreUtilisateursTotal > 0) {
            $nombreUtilisateursAffichage = $nombreUtilisateursTotal - 1;
        } else {
            $nombreUtilisateursAffichage = 0;
        }

        return view('home', compact('neufDerniersBiens', 'neufDerniersServices', 'biens', 'nombreUtilisateursAffichage'));
    }
}
