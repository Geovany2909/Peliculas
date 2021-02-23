<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class UsuariosController extends Controller
{
    public function __construct()
    {   
        $this->middleware('verified');
    }
    public function index(){
        //Si el usuario es cliente solo muestra su usuario y no los demas
        if(Auth::user()->hasRole('Cliente')){
            $users = User::where('id', Auth::user()->id)->paginate(1);
        }else{
            $users = User::paginate(4);
        }
        return view('dashboard.dashboard', compact('users'));
    }

    public function edit($id){
        $roles = Role::all();
        $user = User::findOrFail($id);
        return view('dashboard.usuarios.edit', compact('user', 'roles'));
    }

    /**
     * Sirve para cambiar de roles a los usuarios, solo funciona si es un admin
     * esto se valida en la vista de dashboard
     * Para los roles y permisos se hizo uso de spatie/laravel-permission
     */
    public function update(Request $request, $id){
        DB::beginTransaction();
        $user = User::findOrFail($id);
        $user->name = $request->name;
        if ($request->rol) {
            $user->removeRole($user->roles()->first()->name);
            $user->assignRole($request->rol);
        }
        $user->update();
        DB::commit();
        Alert::info('Actualizado!', 'El rol del usuario fue actualizado correctamente');
        return redirect()->route('users.index');
    }
}
