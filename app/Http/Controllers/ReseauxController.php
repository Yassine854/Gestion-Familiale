<?php

namespace App\Http\Controllers;

use App\Models\Reseaux;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReseauxController extends Controller
{
    public function store(Request $request, $enfantId)
{
    $request->validate([
        'name' => 'required',
        'url' => 'nullable|string|max:255',
    ]);
    
    Reseaux::create([
        'name' => $request->name,
        'url' => $request->url, 
        'enfant_id' => $enfantId,
    ]);  

    return back()->with('success', 'Les réseau social a été ajouté avec succès.');
}


public function update(Request $request, $id)
{
    $request->validate([
        'url' => 'Required|string|max:255',
    ]);

   
    $reseau = Reseaux::findOrFail($id);
    $reseau->url= $request->url;
    $reseau->save();

    return back()->with('success', 'Le réseau social a été mis à jour avec succès.');
}

public function destroy($reseauId)
{
    $reseau = Reseaux::findOrFail($reseauId);
    $reseau->delete();

    return back()->with('success', 'Réseau supprimé avec succès!');
}

}
