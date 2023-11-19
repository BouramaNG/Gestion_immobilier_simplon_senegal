<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\User;
use App\Models\Propertie;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentaireController extends Controller
{

    public function Ajoutcommentaire($id)
    {
        $bien = Propertie::find($id);

        //   dd(Auth::check());


        return view('frontend.Ajoutcommentaire', [
            'bien' => $bien,
            // permet de verifier si le user est connecter ou  pas et retoure vrai ou faux
            'isConnected' => Auth::check()

        ]);
    }
    // Recuperation du commentaires     
    public function Ajoutercommentaire(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'commentaire' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $bd = new Comment();

        $bd->content = $request->commentaire;
        $bd->user_id = Auth::id();
        $bd->property_id=$id;
        $bd->publication_date= Carbon::now();
        $bd->save();


        session()->flash('message', 'Votre commentaire a été bien enregiste.');
        return redirect()->route('frontend.Ajoutcommentaire',['id'=>$id]);
    }
    //lister les commentaire 
    public function Listercommentaire(){
        $commentaires=Comment::with(['user','property'])->get();
        // dd($commentaires);
      
        return view('admin.VoirCommentair',compact('commentaires'));
       
    }
    public function destroy($id)
{
    // Trouve le post avec l'ID donné
    $commentaires = Comment::find($id);
// dd($commentaires);
    // Supprime le post
   
    if(!$commentaires){
        return back()->with('erreur', 'commentaire deleted successfully');

    }
       $commentaires->delete($id);
    return back()->with('erreur', 'commentaire deleted successful');

    // Redirige vers la page d'index des posts avec un message de succès
    
       
}
public  function show() {
    $commentaires=Comment::all();
    return view('admin.VoirCommentair',compact('commentaires'));
    
}


}
