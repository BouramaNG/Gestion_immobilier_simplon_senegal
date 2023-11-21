<?php

namespace App\Http\Controllers;





use App\Models\User;
use App\Models\Chambre;
use App\Models\Multi_img;
use App\Models\Propertie;
use Illuminate\Http\Request;
use App\Mail\NewPropertyMail;
use Illuminate\Support\Facades\Auth;
// use Intervention\Image\Facades\Image;
// use Intervention\Image\Facades\Image as ImageIntervention;;
// use Intervention\Image\Facades\Image;




class BienController extends Controller
{



    public function index()
    {
        // $nombre_de_chambres = $request->input('nombre_de_chambres');
        // dd($request->input('nombre_de_chambres'));
        return view("admin.ajoutbien");
    }
    public function show()
    {
        $user = Auth::user();
        $bien = Propertie::where('user_id',$user->id)->get();
        return view("admin.listebien", compact("bien","user"));
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
{
    $request->validate([
        "nom"=> "required|string|min:3",
        "categorie"=> "required|string",
        "description"=> "required|string|min:5",
        "addresse"=> "required|string",
        'dimension_chambre' => 'required|array',
        'dimension_chambre.*' => 'required|numeric',
        "status"=> "required|string",
        "date"=>"required|date",
    ]);

    $bien = new Propertie();
    $bien->nom = $request->nom;
    $bien->categorie = $request->categorie;
    $bien->description = $request->description;
    $bien->addresse = $request->addresse;
    $bien->status = $request->status;
    $bien->date = $request->date;
    $bien->dimension_bien = $request->dimension_bien;
    $bien->nombre_chambre = $request->nombre_chambre;
    $bien->nombre_toillette = $request->nombre_toillete;
    $bien->balcons = $request->balcon;
    $bien->user_id = auth()->check() ? auth()->user()->id : null;
    $bien->space_vert = $request->espace;

    $image = $request->file('image_unique');
    $imagename = time().'.'.$image->getClientOriginalExtension();
    Image::make($image)->resize(800,800)->save('product/imageunique'.$imagename);
    $saveUrl = 'product/imageunique'.$imagename;
    $bien->image = $saveUrl;

    $bien->save();

    // Envoyer l'e-mail à chaque utilisateur
    foreach ($users as $user) {
        Mail::to($user->email)->send(new NewPropertyMail($bien));
    }
        $bien_id = $bien->id;
    
        $nombreChambres = $request->nombre_chambre;
    
        for ($i = 0; $i < $nombreChambres; $i++) {
            $chambre = new Chambre();
            $chambre->propertie_id = $bien->id;
            $chambre->dimension_chambre = isset($request->dimension_chambre[$i]) ? $request->dimension_chambre[$i] : null;
        
          
        
            $chambre->save();
        }
        
       
        $imagesChambres = $request->file('image_chambre');
        
        foreach ($imagesChambres as $index => $imageChambre) {
            $imageName = time() . '_' . $index . '.' . $imageChambre->getClientOriginalExtension();
            $imageChambre->move(public_path('chambre_images'), $imageName);
        
            $multiImg = new Multi_img();
            $multiImg->propertie_id = $bien->id;
            $multiImg->chambre_id = $index + 1; 
            $multiImg->photo_name = 'chambre_images/' . $imageName;
        
            $multiImg->save();
        }
        
        return redirect()->route('step2', ['bien_id' => $bien->id]);
        }


        public function showStep2($bien_id)
        {
          
            $bien = Propertie::findOrFail($bien_id);
        
            return view('step2', ['bien' => $bien]);
        }

        public function storeStep1(Request $request)
        {
    
            $request->validate([
                "nom" => "required|string|min:3",
                "categorie" => "required|string",
         
                "nombre_chambre" => "required|integer|min:1",
            ]);
            $bien = new Propertie();
            $bien->nom = $request->nom;
            $bien->categorie = $request->categorie;
            $bien->description = $request->description;
            $bien->addresse = $request->addresse;
            $bien->status = $request->status;
            $bien->date = $request->date;
            $bien->dimension_bien = $request->dimension_bien;
            $bien->nombre_chambre = $request->nombre_chambre;
            $bien->nombre_toillette = $request->nombre_toillete;
            $bien->balcons = $request->balcon;
            $bien->user_id = auth()->check() ? auth()->user()->id : null;
            $bien->space_vert = $request->espace;
            $image = $request->file('image_unique');
            $imagename = time().'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(800,800)->save('product/imageunique'.$imagename);
            $saveUrl = 'product/imageunique'.$imagename;
            $bien->image = $saveUrl;
        
            $bien->save();
            $bien_id = $bien->id;
        
            session(['nombre_chambres' => $request->nombre_chambre, 'bien_id' => $bien_id]);
        
            return redirect()->route('showFormStep2');
        }

   

        public function showFormStep2()
        {
    
            $nombreChambres = session('nombre_chambres');
        
    
            return view('admin.form_step_2', compact('nombreChambres'));
        }
    
        public function storeStep2(Request $request)
        {
            $request->validate([
                'dimension_chambre.*' => 'required|numeric|min:1',
                'image_chambre.*' => 'required|array',
                'image_chambre.*.*' => 'required|image|max:5000',
            ]);
        
            $nombreChambres = count($request->dimension_chambre);
            $bien_id = session('bien_id');
        
            for ($i = 0; $i < $nombreChambres; $i++) {
                $chambre = new Chambre();
                $chambre->propertie_id = $bien_id;
                $chambre->dimension_chambre = $request->dimension_chambre[$i];
                $chambre->save();
        
                // Enregistrez les images des chambres dans la table 'multi_imgs'
                $imagesChambre = $request->file('image_chambre')[$i] ?? [];

                foreach ($imagesChambre as $index => $image) {
                    $imageName = uniqid() . '_' . $index . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('chambre_images'), $imageName);
        // dd($imagesChambre,$imageName);
                    $multiImg = new Multi_img();
                    $multiImg->propertie_id = $bien_id;
                    $multiImg->chambre_id = $chambre->id;
                    $multiImg->photo_name = 'chambre_images/' . $imageName;
        
                    // Ajoutons des logs pour déboguer
                    info('Attempting to save image: ' . $imageName);
        
                    if ($multiImg->save()) {
                        info('Image saved successfully.');
                    } else {
                        info('Image save failed.');
                    }
                }
            }
        
            return redirect()->back()->with('success', 'Les détails des chambres ont été ajoutés avec succès.');
        }
    


    private function storeImage($image): string
    {
        return $image->store('avatars', 'public');
    }


    public function delete($id)
    {
        $bien = Propertie::find($id);
        $bien->destroy($id);
        if ($bien->save()) {
            return back()->with('delete', 'vous avez supprimer cette produit');
        }
    
        
        return back()->with('error', 'Vous n\'êtes pas autorisé à supprimer cette propriété.');
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
    // dd($bien);
    return redirect()->back()->with('message','Mise à jour réussi');


}
public function details($id)
{
    $bien = Propertie::find($id);

    return view('frontend.details', compact('bien'));
}

// Dans votre contrôleur PropertyController, par exemple

public function voir(Propertie $property)
{
    $this->authorize('view', $property);

   
}

public function search()
{
    $this->authorize('search', Propertie::class);

}


}