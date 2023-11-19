<?php

namespace App\Http\Controllers;

use App\Models\Bien;
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
      $biens = Bien::all();
      $userInactive = User::all();
      return view('frontend.acceuil',compact('userInactive','biens'));
   }
}
