<?php

namespace App\Http\Controllers;
use App\Models\Propertie;
use Illuminate\Http\Request;
class BienController extends Controller
{
    public function index()
    {
        return view("admin.ajoutbien");
    }
    public function show()
    {
        $bien = Propertie::all();
        return view("admin.listebien", compact("bien"));
    }
    public function store(Request $request)
    {
        $request->validate([
            "nom" => "required|string|min:3",
            "categorie" => "required|string",
            "image" => "required|image|max:5000",
            "multi_image"=> "required|image",
            "description" => "required|string|min:5",
            "dimension_bien"=> "required|integer",
            "nombre_chambre"=> "required|integer",
            "dimension_chambre"=> "requires|integer",
            "nombre_toillette"=> "required|integer",
            "balcons"=> "required|integer",
            "space_vert"=> "required|enum",
            "addresse" => "required|string",
            "status" => "required|string",
            "date" => "required|date",
        ]);
        $bien = new Propertie();
        $bien->nom = $request->nom;
        $bien->categorie = $request->categorie;
        //I comment the Boura's method
        //jeessais de modifier la partie importe image de Bass
        // $image = $request->image;
        // $imagename = time().'.'.$image->getClientOriginalExtension();
        // $request->image->move('product', $imagename);
        // $bien->image= $imagename;
        $bien->image = $this->storeImage($request->file('image'));
        // $bien->multi_image = $request->multi_image;
        // POUR MULTI IMAGE
        // $bien->multi_image = $this->storeImage($request->file('multi_image'));
        $bien->dimension_bien = $request->dimension_bien;
        $bien->nombre_chambre = $request->nombre_chambre;
        $bien->dimension_chambre = $request->dimension_chambre;
        $bien->nombre_toillette = $request->nombre_toillette;
        $bien->balcons = $request->balcons;
        $bien->space_vert = $request->space_vert;
        $bien->description = $request->description;
        $bien->addresse = $request->addresse;
        $bien->status = $request->status;
        $bien->date = $request->date;
        $bien->save();
        return back()->with('success', 'Votre produit a été ajouter');
    }
    private function storeImage($image): string
    {
        return $image->store('multi_image', 'public');
    }

    public function delete($id)
    {
        $bien = Propertie::find($id);
        $bien->destroy($id);
        if ($bien->save()) 
        {
            return back()->with('delete', 'vous avez supprimer cette produit');
        }
    }
    public function edit($id)
    {
        $bien = Propertie::where(
            'id', '=',$id
        )->first();
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
        ], [
            'nom.required' => 'Le champ Nom est obligatoire.',
            'nom.min' => 'Le champ Nom doit avoir au moins :min caractères.',
            'categorie.required' => 'Le champ Catégorie est obligatoire.',
            'image.required' => 'Le champ Image est obligatoire.',
            'image.image' => 'Le fichier doit être une image.',
            'image.max' => 'L\'image ne doit pas dépasser :max kilo-octets.',
            'description.required' => 'Le champ Description est obligatoire.',
            'description.min' => 'Le champ Description doit avoir au moins :min caractères.',
            'addresse.required' => 'Le champ Adresse est obligatoire.',
            'status.required' => 'Le champ Statut est obligatoire.',
            'date.required' => 'Le champ Date est obligatoire.',
            'date.date' => 'Le champ Date doit être une date valide.',
        ]);
        $bien = Propertie::find($id);
        $bien->nom = $request->nom;
        $bien->categorie = $request->categorie;
        if ($request->hasFile('image')) 
        {
            $bien->image = $this->storeImage($request->file('image'));
        }
        $bien->description = $request->description;
        $bien->addresse = $request->addresse;
        $bien->status = $request->status;
        $bien->date = $request->date;
        $bien->save();
        return redirect()->back()->with('update', 'Mise à jour réussi');
    }
    public function details($id)
    {
        $bien = Propertie::find($id);
        return view('frontend.details', compact('bien'));
    }
    public function voir(Propertie $property)
    {
        $this->authorize('view', $property);
    }
    public function search()
    {
        $this->authorize('search', Propertie::class);
    }
}
