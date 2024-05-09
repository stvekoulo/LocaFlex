<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceCatalogueController extends Controller
{
    public function index()
    {
        $services = Service::where('disponibilite', 'Disponible')->where('publie', true)->latest()->get();

        return view('catalogue_service', compact('services'));
    }
}
