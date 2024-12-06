<?php

namespace App\Http\Controllers;

use App\Models\Enfant;
use App\Models\Reseaux;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EnfantController extends Controller
{
    public function index()
    {
        $children = Enfant::with('reseauxSociaux')->get();
        return view('enfant.index', compact('children'));
    }

    
    public function create()
    {
        return view('enfant.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'birthday' => 'required|date',
            'gender' => 'required',
        ]);
    
        $enfant = Enfant::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'birthday' => $request->birthday,
            'gender' => $request->gender,
            'parent_id' => auth()->user()->id,
        ]);
    
        $reseaux = ['Facebook', 'Twitter', 'Instagram'];
        foreach ($reseaux as $reseau) {
            Reseaux::create([
                'name' => $reseau,
                'url' => null, 
                'enfant_id' => $enfant->id,
            ]);
        }
    
        return redirect()->route('enfant.index')->with('success', 'Enfant ajouté avec succès');
    }
    
    
    public function show($id)
{
    $enfant = Enfant::findOrFail($id);

    return view('enfant.show', compact('enfant'));
}

public function edit($id)
{
    $child = Enfant::findOrFail($id);

    return view('enfant.edit', compact('child'));
}

public function update(Request $request, $id)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'birthday' => 'required|date',
        'gender' => 'required|string',
    ]);

    $enfant = Enfant::findOrFail($id);

    $enfant->name = $validated['name'];
    $enfant->last_name = $validated['last_name'];
    $enfant->birthday = $validated['birthday'];
    $enfant->gender = $validated['gender'];
    $enfant->save();
    return redirect()->route('enfant.index')->with('success', 'Enfant mis à jour avec succès!');
}

public function updatePhoto(Request $request, $id)
{
    $request->validate([
        'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $enfant = Enfant::findOrFail($id);

    if ($request->hasFile('photo')) {
        if ($enfant->photo && Storage::exists('public/' . $enfant->photo)) {
            Storage::delete('public/' . $enfant->photo);
        }
        $photoPath = $request->file('photo')->store('photos', 'public');

        $enfant->photo=$photoPath;
        $enfant->update();

        return back()->with('success', 'Photo mise à jour avec succès !');
    }

    return back()->with('error', 'Aucune photo sélectionnée !');
}

public function deletePhoto($id)
{
    $enfant = Enfant::findOrFail($id);

    if ($enfant->photo && Storage::exists('public/' . $enfant->photo)) {
        Storage::delete('public/' . $enfant->photo);
    }

    $enfant->photo = null;
    $enfant->update();

    return back()->with('success', 'Photo supprimée avec succès !');
}


}
