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

    $results = Propertie::where('nom', 'LIKE', '%' . $nomBien . '%')
        ->where('addresse', 'LIKE', '%' . $ville . '%')
        ->get();

    return view('frontend.acceuil', compact('results','biens'));
}
public function AdAdmin()
{
   return view('admin.admin');
}
public function addAdmin(Request $request)
{
    // Validate the form data
    $validatedData = $request->validate([
        'adminEmail' => 'required|email|unique:users,email',
        'adminPassword' => 'required|min:6',
    ]);

    // Create a new admin
    $admin = new User();
    $admin->email = $validatedData['adminEmail'];
    $admin->password = bcrypt($validatedData['adminPassword']);
    $admin->role = 'admin'; // Set the role to 'admin'
    $admin->save();

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Admin added successfully');
}


}
