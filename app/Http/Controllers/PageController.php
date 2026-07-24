<?php

namespace App\Http\Controllers;

use App\Models\Actualite;
use App\Models\Projet;
use App\Models\Conseil;

class PageController extends Controller
{
    public function Accueil()
    {
        $featuredProjects = Projet::query()
            ->orderByDesc('featured')
            ->orderByDesc('created_at')
            ->take(3)
            ->get();

        $latestActualites = Actualite::publie()
            ->orderByDesc('date_publication')
            ->orderByDesc('created_at')
            ->take(4)
            ->get();

        return view('pages.Accueil', [
            'featuredProjects' => $featuredProjects,
            'latestActualites' => $latestActualites,
        ]);
    }

    public function propos()
    {
        return view('pages.A propos');
    }

    public function actualites()
    {
        $vedette = Actualite::publie()->orderByDesc('date_publication')->first();
        $actualites = Actualite::publie()
            ->when($vedette, fn($q) => $q->where('id', '!=', $vedette->id))
            ->orderByDesc('date_publication')
            ->paginate(12);

        return view('pages.actualites', [
            'vedette' => $vedette,
            'actualites' => $actualites,
        ]);
    }

    public function conseils()
    {
        $conseils = Conseil::publie()->orderByDesc('date_publication')->get();

        return view('pages.conseils', [
            'conseils' => $conseils,
        ]);
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function don()
    {
        return view('pages.don');
    }

    public function reservation()
    {
        return view('pages.reservation');
    }
}
