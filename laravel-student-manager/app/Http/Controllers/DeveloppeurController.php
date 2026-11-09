<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeveloppeurController extends Controller
{
    public function create()
    {
        $langages = DB::table('langages')->orderBy('langage')->get();
        $developpeurs = DB::table('developpeur_web')->latest()->get();

        return view('developpeurs.create', compact('langages', 'developpeurs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomPrenom' => ['required', 'string', 'max:255', 'regex:/\s/'],
            'langages' => 'required|array|min:1',
            // only accept languages that exist in the table, not anything the client sends
            'langages.*' => 'string|exists:langages,langage',
        ], [
            'nomPrenom.required' => 'Le nom et prénom est requis',
            'nomPrenom.regex' => 'Le champ doit contenir un espace (nom et prénom)',
            'langages.required' => 'Vous devez sélectionner au moins un langage',
            'langages.min' => 'Vous devez sélectionner au moins un langage',
            'langages.*.exists' => 'Langage inconnu',
        ]);

        DB::table('developpeur_web')->insert([
            'nomPrenom' => trim($validated['nomPrenom']),
            'langages' => json_encode($validated['langages']),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('developpeurs.create')
            ->with('success', 'Développeur enregistré avec succès!');
    }
}
