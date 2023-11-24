<?php

namespace App\Http\Controllers;





use App\Models\Multi_img;
use App\Models\Propertie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
// use Intervention\Image\Facades\Image as ImageIntervention;;
// use Intervention\Image\Facades\Image;




class BienController extends Controller
{
//     public function AjoutBien()
//     {
//         return view("admin.ajoutbien");
//     }

//     public function ListeBien()
//     {
// return view("admin.listebien");
//     }



    public function index()
    {
        return view("admin.ajoutbien");
    }
    public function show ()
    {
        $user = Auth::user()->id;
        $bien = Propertie::where('user_id',$user->id)->get();
        return view("admin.listebien", compact("bien","user"));
    }

    public function store(Request $request)
    {
        $request->validate([
            "nom"=> "required|string|min:3",
            "categorie"=> "required|string",
            // "image"=> "required|image|max:5000",
            "description"=> "required|string|min:5",
            "addresse"=> "required|string",
            "status"=> "required|string",
            "date"=>"required|date",
        ]);
        $bien = new Propertie();
        $bien->nom = $request->nom;
        $bien->categorie = $request->categorie;
        // $bien->image = $request->image;

        //jeessais de modifier la partie importe image de Bass
        // $bien->image = $this->storeImage($request->file('image'));
        $image = $request->file('image_unique');
        // $imagename = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $imagename = time().'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(800,800)->save('product/imageunique'.$imagename);
        $saveUrl = 'product/imageunique'.$imagename;
       $bien_id = Propertie::insertGetId([
        'nom'=> $request->nom,
        'categorie'=> $request->categorie,
       'description'=> $request->description,
       'addresse' => $request->addresse,
       'status' => $request->status,
       'date' => $request->date,
       'dimension_bien'=>$request->dimension_bien,
       'nombre_chambre'=>$request->nombre_chambre,
       'dimension_chambre'=>$request->dimension_chambre,
       'nombre_toillette'=>$request->nombre_toillete,
       'balcons'=>$request->balcon,
       'user_id' => auth()->check() ? auth()->user()->id : null,

       'space_vert'=>$request->espace,
       'image' =>$saveUrl,
     
       ]);
        
      $images = $request->file('multi_image');
      foreach ($images as $img) {
        $image_multi = time().'.'.$img->getClientOriginalExtension();
        Image::make($img)->resize(800,800)->save('product/imagemultiple'.$image_multi);
        $chemin = 'product/imagemultiple'.$image_multi;    
        Multi_img::insert([
            'propertie_id'=>$bien_id,
            'photo_name'=>$chemin,
        ]);
      }
      return redirect()->back();
    }
    // private function storeImage($image): string
    // {
    //     return $image->store('avatars', 'public');
    // }





    // public function store(Request $request)
    // {
    //     // Validation des données du formulaire

    //     $request->validate([
    //         // Ajoute tes règles de validation ici
    //     ]);

    //     // Création d'une nouvelle instance de Bien
    //     $bien = new Propertie();
    //     $bien->nom = $request->nom;
    //     $bien->categorie = $request->categorie;
    //     $bien->description = $request->description;
    //     $bien->addresse = $request->addresse;
    //     $bien->date = $request->date;
    //     $bien->dimension_bien = $request->dimension_bien;
    //     $bien->nombre_chambre = $request->nombre_chambre;
    //     $bien->dimension_chambre = $request->dimension_chambre;
    //     $bien->nombre_toillette = $request->nombre_toillette;
    //     $bien->balcons = $request->balcon;
    //     $bien->space_vert = $request->espace;
    //     $bien->status = $request->status;

    //     // Image principale
    //     $image_unique = $request->file('image_unique');
    //     $imagename = time() . '.' . $image_unique->getClientOriginalExtension();
        
    //     ImageIntervention::make($image_unique)
    //         ->fit(800, 800)
    //         ->save('product/imageunique' . $imagename);

    //     $bien->image_unique = 'product/imageunique' . $imagename;

    //     // Enregistrement du bien
    //     $bien->save();

    //     // Images multiples
    //     if ($request->hasFile('multi_image')) {
    //         foreach ($request->file('multi_image') as $multi_img) {
    //             $image_multi_name = time() . '.' . $multi_img->getClientOriginalExtension();

    //             ImageIntervention::make($multi_img)
    //                 ->fit(800, 800)
    //                 ->save('product/imagemultiple' . $image_multi_name);

    //             // Création et enregistrement d'une nouvelle instance de MultiImage
    //             $multiImage = new Multi_img();
    //             $multiImage->propertie_id = $bien->id;
    //             $multiImage->photo_name = 'product/imagemultiple' . $image_multi_name;
    //             $multiImage->save();
    //         }
    //     }

    //     // Redirection ou autre logique selon tes besoins
    //     return redirect()->back();
    // }





   


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