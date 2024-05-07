<?php

namespace App\Http\Controllers;

use App\Models\Bien;
use Illuminate\Http\Request;

class BienCatalogueController extends Controller
{
    public function index()
    {
        $biens = Bien::with(['photos' => function ($query) {
            $query->take(1);
        }])
        ->where('disponibilite', 'Disponible')
        ->where('publie', true)
        ->get();

        return view('catalogue_bien', compact('biens'));
    }
}
