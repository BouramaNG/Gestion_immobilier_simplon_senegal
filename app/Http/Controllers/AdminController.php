<?php

namespace App\Http\Controllers;

use App\Models\Bien;
use App\Models\Propertie;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;

class AdminController extends Controller
{
   public function AdminDashboard()
   {
    return view("admin.admindashboard");
   }

   public function ListeUser()
   {
      $user = User::all();
      return view('admin.listeuser',compact('user'));
   }

   public function InactiveUser(Request $request,$id)
   {
      $users = User::find($id);
      if ($users) {
     $users->status =($users->status ==='active' ? 'inactive' : 'active');
     $users->save();
     return redirect()->back()->with('success','vous avez desactiver avec succe le gars');

      }else {
         return redirect()->back()->with('success','oups amna lou dokhoule');
      }
   }

   public function Desactivation()
   {
      $biens = Propertie::all();
      $userInactive = User::all();
      return view('frontend.acceuil',compact('userInactive','biens'));
   }
   public function search(Request $request)
{
   $biens = Propertie::all();
    $nomBien = $request->input('nom_bien');
    $ville = $request->input('addresse');

    $results = Bien::where('nom', 'LIKE', '%' . $nomBien . '%')
        ->where('addresse', 'LIKE', '%' . $ville . '%')
        ->get();

    return view('frontend.acceuil', compact('results','biens'));
}



}
