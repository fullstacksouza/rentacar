<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use App\Admin\Sector;
class UserController extends Controller
{
    public function create(Role $role,Sector $sector,User $user)
    {

        $roles = $role->all();
        $sectors = $sector->all();
       
       
        return view('dashboard/users/create',compact('roles','sectors'));
    }

    public function list(User $user)
    {
    $users = $user->all();
   
       return view('dashboard/users/list',compact("users"));
    }


    public function store(User $user,Role $role,Request $request)
    {
        dd($request->all());
        /*
        $role               = $role->find(1);
        $sector             = Sector::find($request->sector_id);

        $user->name     = $request->name;
        $user->password = bcrypt($request->password);
        $user->email    = $request->email;
        //atribuindo o setor
        $user->sector()->associate($sector);
            
        $user->save();
        //atribuindo o perfil
        $user->attachRole($role);
        return redirect()->back()->with('info','Usuario Cadastrado com Sucesso');*/
    }

    public function edit(Request $request)
    {
        $roles    = Role::all();
        $sectors  = Sector::all();
        
        $userEdit = User::findOrFail($request->id);
        return view("dashboard/users/edit",compact('userEdit','roles','sectors'));
    }

    public function update(Request $request, User $user,Role $role)
    {
        $sector = Sector::find($request->sector);
        $editUser  = $user->findOrFail($request->id);
        $editUser->name = $request->name;

        
        $currentRole = $editUser->roles;
        $roles = $role->find($request->role);
        if($roles)
        {
        //verificando se houve alteração de perfil no formulario
        if(!$currentRole = $roles->id)
        {
            $editUser->attachRole($roles);
        }
    }
        
        $currentSector = $user->sector;
       
        //verificando se houve alteração de setor no formulario
        if(!$currentSector === $sector->id || $currentSector === NULL)
        {
            //return "setor alterado";
            $editUser->sector()->associate($sector);
        }
        
        $editUser->save();

        
        return redirect()->back()->with('info','Usuario Atualizado com Sucesso');

    }
}
