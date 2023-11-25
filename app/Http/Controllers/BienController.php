<?php

namespace App\Http\Controllers;





use App\Models\Chambre;
use App\Models\Multi_img;
use App\Models\Propertie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
// use Intervention\Image\Facades\Image as ImageIntervention;;
// use Intervention\Image\Facades\Image;




class BienController extends Controller
{



    public function index()
    {
        return view("admin.ajoutbien");
    }
    public function show ()
    {
        $user = Auth::user();
        $bien = Propertie::where('user_id',$user->id)->get();
        return view("admin.listebien", compact("bien","user"));
    }

    public function store(Request $request)
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
    
  
        session(['nombre_chambres' => $request->nombre_chambre]);
    
      
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
            'image_chambre.*' => 'required|image|max:5000',
        ]);
   
        $nombreChambres = count($request->dimension_chambre);
        $bien_id = Propertie::latest()->first()->id; 
    
        for ($i = 0; $i < $nombreChambres; $i++) {
            $chambre = new Chambre();
            $chambre->propertie_id = $bien_id;
            $chambre->dimension_chambre = $request->dimension_chambre[$i];
            $chambre->save();
    
            // Étape 2: Enregistrez les images des chambres dans la table 'multi_imgs'
            $imageChambre = $request->file('image_chambre')[$i];
            $imageName = time() . '_' . $i . '.' . $imageChambre->getClientOriginalExtension();
            $imageChambre->move(public_path('chambre_images'), $imageName);
    
            $multiImg = new Multi_img();
            $multiImg->propertie_id = $bien_id;
            $multiImg->chambre_id = $chambre->id;
            $multiImg->photo_name = 'chambre_images/' . $imageName;
            $multiImg->save();
        }
    
        return redirect()->back();
    }


    private function storeImage($image): string
    {
        return $image->store('avatars', 'public');
    }


    public function delete($id)
    {
        $bien = Propertie::find($id);
        $bien->destroy($id);
        if ($bien->save())
        {
            return back()->with('success','vous avez supprimer cette produit');
        }
    }


    public function edit($id)
    {
        $bien = Propertie::where(
            'id', '=', $id
        )->first();
        // $bien = Propertie::find($id);
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

public function voir(Propertie $property)
{
    $this->authorize('view', $property);

   
}

public function search()
{
    $this->authorize('search', Propertie::class);

}


}