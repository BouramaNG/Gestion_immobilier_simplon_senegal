<?php

namespace App\Http\Controllers;

use App\Models\Propertie;

use Illuminate\Http\Request;

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
        $bien = Propertie::all();
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
        $bien = new Propertie();
        $bien->nom = $request->nom;
        $bien->categorie = $request->categorie;
        // $bien->image = $request->image;

        //jeessais de modifier la partie importe image de Bass
        // $bien->image = $this->storeImage($request->file('image'));
        $image = $request->image;
        $imagename = time().'.'.$image->getClientOriginalExtension();
        $request->image->move('product', $imagename);
        $bien->image= $imagename;
        $bien->description = $request->description;
        $bien->addresse = $request->addresse;
        $bien->status = $request->status;
        $bien->date = $request->date;
        $bien->save();
        return back()->with('success','Votre produit a été ajouter');
        
    }
    // private function storeImage($image): string
    // {
    //     return $image->store('avatars', 'public');
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
    return back()->with('success','Mise à jour réussi');


}
public function details($id)
{
    $bien = Propertie::find($id);

    return view('frontend.details', compact('bien'));
}

}