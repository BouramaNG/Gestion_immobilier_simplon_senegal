<?php

namespace App\Http\Controllers;

use App\Models\Bien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BienController extends Controller
{
    public function index()
    {
        $bien = Bien::all();
        return view("admin.ajoutbien", compact("bien"));
    }
    public function show ()
    {
        $bien = Bien::all();
        return view("admin.listebien", compact("bien"));
    }
    public function store(Request $request)
    {
        $request->validate([
            "nom"=> "required|string|min:3",
            "categorie"=> "required|string",
            "image"=> "required|image|max:5000",
            "description"=> "required|string|min:5",
            "addresse"=> "required|string",
            "status"=> "required|string",
            "date"=>"required|date",
        ]);
        $bien = new Bien();
        $bien->nom = $request->nom;
        $bien->categorie = $request->categorie;
        // $bien->image = $request->image;
        $bien->image = $this->storeImage($request->file('image'));
        $bien->description = $request->description;
        $bien->addresse = $request->addresse;
        $bien->status = $request->status;
        $bien->date = $request->date;
        $bien->save();
        return back()->with('message','Votre produit a été bien ajouter');
        
    }
    private function storeImage($image): string
    {
        return $image->store('avatars', 'public');
    }
    public function delete($id)
    {
        $bien = Bien::find($id);
        $bien->destroy($id);
        if ($bien->save())
        {
            return back()->with('success','vous avez supprimer cette produit');
        }
    }
    public function edit($id)
    {
        $bien = Bien::where(
            'id', '=', $id
        )->first();
        // $bien = Bien::find($id);
        return view("admin.modifier", compact("bien"));
    }
    public function update(Request $request, $id)
    {
    $request->validate([
        "nom" => "required|string|min:3",
        "categorie" => "required|string",
        "image" => "image|max:5000",
        "description" => "required|string|min:5",
        "addresse" => "required|string",
        "status" => "required|string",
        "date" => "required|date",
    ]);

    $bien = Bien::find($id);
    $bien->nom = $request->nom;
    $bien->categorie = $request->categorie;
    if ($request->hasFile('image')) {
        $bien->image = $this->storeImage($request->file('image'));
    }
    $bien->description = $request->description;
    $bien->addresse = $request->addresse;
    $bien->status = $request->status;
    $bien->date = $request->date;
    $bien->save();
    // dd($bien);
    return back()->with('update','Mise à jour réussi');
    }
}
