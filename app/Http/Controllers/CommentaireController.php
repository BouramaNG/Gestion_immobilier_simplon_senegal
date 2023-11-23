<?php

namespace App\Http\Controllers;

use App\Models\Propertie;
use Carbon\Carbon;
use App\Models\Bien;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentaireController extends Controller
{
    public function Ajoutcommentaire($id)
    {
        $bien = Propertie::find($id);
        $comment = Comment::with(['user', 'bien'])->get();
        //   dd(Auth::check());
        return view('frontend.ajoutcommentaire', [
            'bien' => $bien,
            'comment' => $comment,
            'isConnected' => Auth::check()
        ]);
    }
    // Recuperation du commentaires     
    public function Ajoutercommentaire(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'commentaire' => 'required|string',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $bd = new Comment;
        $bd->content = $request->commentaire;
        $bd->user_id = Auth::id();
        $bd->bien_id = $id;
        $bd->publication_date = Carbon::now();
        $bd->save();
        session()->flash('message', 'Votre commentaire a été bien enregiste.');
        return redirect()->route('frontend.Ajoutcommentaire', ['id' => $id]);
    }
    //lister les commentaire 
    public function Listercommentaire()
    {
        $commentaires = Comment::with(['user', 'bien'])->get();
        // dd($commentaires);
        return view('admin.VoirCommentair', compact('commentaires'));
    }
    public function Commentaire()
    {
        $comment = Comment::with(['user', 'bien'])->get();
        // dd($commentaires);
        return view('frontend.ajoutercommentaire', compact('comment'));
    }
    public function destroy($id)
    {
        // Trouve le post avec l'ID donné
        $commentaires = Comment::find($id);
        // dd($commentaires);
        // Supprime le post
        if (!$commentaires) 
        {
            return back()->with('erreur', 'commentaire deleted successfully');
        }
        $commentaires->delete($id);
        return back()->with('erreur', 'commentaire deleted successful');
        // Redirige vers la page d'index des posts avec un message de succès
    }
    public function Supp($id)
    {
        // Trouve le post avec l'ID donné
        $commentaires = Comment::find($id);
        $commentaires->delete();
        return redirect()->back()->with('message', 'votre commentaire a ete supprimer avec succe');
        // Redirige vers la page d'index des posts avec un message de succès
    }
    public  function show()
    {
        $commentaires = Comment::all();
        return view('admin.VoirCommentair', compact('commentaires'));
    }
}
