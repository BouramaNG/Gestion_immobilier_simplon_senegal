<?php

namespace App\Http\Controllers;

use App\Models\Chambre;
use App\Models\Multi_img;
use App\Models\Propertie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Intervention\Image\Facades\Image;
// use Intervention\Image\Facades\Image as ImageIntervention;;
// use Intervention\Image\Facades\Image;




class BienController extends Controller
{
    public function index(Request $request)
    {
        // $nombre_de_chambres = $request->input('nombre_de_chambres');
        // dd($request->input('nombre_de_chambres'));
        return view("admin.ajoutbien");
    }
    public function show()
    {
        // $user = Auth::user()->id;
        // $user = Auth::user()->id;
        $bien = Propertie::all();
        return view("admin.listebien", compact("bien"));
    }
    public function store(Request $request)
    {   
            $request->validate([
            "nom" => "required|string|min:3",
            "categorie" => "required|string",
            // "image" => "required|image|max:5000",
            // "multi_image" => "required|image",
            "description" => "required|string|min:5",
            "dimension_bien" => "required|int",
            "nombre_chambre" => "required|int",
            // "dimension_chambre" => "required|int",
            "nombre_toillette" => "required|int",
            "balcons" => "required|int",
            "space_vert" => "required",
            "addresse" => "required|string",
            "status" => "required|string",
            "date" => "required|date",
        ],[
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
        dd($request);
        $bien = new Propertie();
        $bien->user_id = 1;
        $bien->nom = $request->nom;
        $bien->categorie = $request->categorie;
        $bien->image = $this->storeImage($request->file('image'));
        $bien->dimension_bien = $request->dimension_bien;
        $bien->nombre_toillette = $request->nombre_toillette;
        $bien->nombre_chambre = $request->nombre_chambre;
        $bien->balcons = $request->balcons;
        $bien->space_vert = $request->space_vert;
        $bien->description = $request->description;
        $bien->addresse = $request->addresse;
        $bien->status = $request->status;
        $bien->date = $request->date;
        $bien->save();
        
        // $images = $request->file('multi_image');
        // $imagePaths = [];
        // foreach ($images as $images) {
        //     $imagePath = $this->storeMultiImage($images);
        //     $imagePaths[] = $imagePath;
        //     $multiImage = new Multi_img();
        //     $multiImage->propertie_id = $bien->id; // Associez l'ID de la propriété
        //     $multiImage->photo_name = $imagePath;
        //     $multiImage->save();
        // }   
        // $bien->dimension_chambre = $request->dimension_chambre;
        return back()->with('success', 'Votre produit a été ajouter');
    }
    private function storeImage($image): string
    {
        return $image->store('img', 'public');
    }
    private function storeMultiImage($images)
    {
        return $images->store('multi_image','public');
    }
    public function delete($id)
    {
        $bien = Propertie::find($id);
        $bien->destroy($id);
        if ($bien->save()) {
            return back()->with('delete', 'vous avez supprimer cette produit');
        }
    }
    public function edit($id)
    {
        $bien = Propertie::where(
            'id',
            '=',
            $id
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
        if ($request->hasFile('image')) {
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

    // Les methodes que j'ai ajouter pour chambres
    
    // Ici j'aurais les methodes qui concerne les chambres et ses images 
    public function indexChambre(Request $request)
    {
        // $bien = Propertie::all();
        $nombre_chambre = $request->nombre_chambre;
        // dd($nombre_chambre);
        return view('admin.ajoutChambre' , compact('nombre_chambre'));
    }
    public function storeChambre(Request $request)
    {
        $request->validate([
            'dimension_chambre'=> 'required|int',
            'multi_image'=> 'required|image',
        ]);
        $chambre = new Chambre;
        $chambre->dimension_chambre = $request->dimension_chambre;
        $chambre->save();

        //pour gerer les images
        $images = $request->file('multi_image');
        $imagePaths = [];
        foreach ($images as $images) {
            $imagePath = $this->storeMultiImage($images);
            $imagePaths[] = $imagePath;
            $multiImage = new Multi_img();
            // $multiImage->propertie_id = $bien->id; // Associez l'ID de la propriété
            $multiImage->chambre_id = $chambre->id; // Associez l'ID de la propriété
            $multiImage->photo_name = $imagePath;
            $multiImage->save();
        }   
        return redirect()->with('success','vous avez ajouter une chambre');
    }

    public function inputChambre(Request $request){
        $nombre_de_chambres = $request->input('nombre_de_chambres');
                            
        for ($i = 1; $i <= $nombre_de_chambres; $i++) {
            $chambre = new Chambre();
            $chambre->nom = $request->input('nom_de_la_chambre_' . $i);
            $chambre->superficie = $request->input('superficie_de_la_chambre_' . $i);
            $chambre->save();
        }
        return redirect()->back()->with('success','');
    }
}
