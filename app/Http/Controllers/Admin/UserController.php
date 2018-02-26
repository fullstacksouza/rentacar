<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use App\Admin\Sector;
use Exception;
class UserController extends Controller
{
    //Functions of Get Method requests
    public function edit(Request $request,User $users,Role $role,Sector $sector)
    {
       $user    = $users->findOrFail($request->id);
       $roles   = $role->all();
       //actually role user
       $roleUser = $user->roles;
        //dd($roleUser);
       $userRole;
       foreach($roleUser as $role)
       {
           $userRole = $role->id;
       }

       $sectors = $sector->all();
         return view('dashboard/users/edit',compact('user','roles','sectors','userRole'));
    }
    public function create(Role $role,Sector $sector,User $user)
    {

        $roles   = $role->all();
        $sectors = $sector->all();
       
       
        return view('dashboard/users/create',compact('roles','sectors'));
    }

    public function list(User $user,Sector $sector)
    {
        $users = $user->find(1);

        $sectors = $sector->find(1);

        $sectors->users()->attach($users);

        //$users = $user->with('setor')->get();
       
        //$sectors = $sector->find(1)->user;
        //dd($sectors);
        return view('dashboard/users/list',compact("users"));
    }


    //Functions of POST methods Request
    public function store(User $user,Role $roles,Request $request,Sector $sector)
    {

        //dd($request->all());

       /* $newUser         =User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => bcrypt($request->password)
            
            
        ]);
        
        $role            = $roles->find($request->role);
    
        //atribuindo permições
        $newUser->attachRole($role);

        $newUser->sectors()->sync([1]);*/
        $users = $user->find(1);

        $sectors = $sector->find(1);

        $users->sectors()->attach($sectors);
        return redirect()->back()->with('info','Usuario cadastrado com sucesso!');
    }

    public function update(Request $request,User $users)
    { 
        //dd($request->all());
        $user = $users->find($request->id);
        if($user == null)
        {
            return redirect()->back();
        }
        //remover perfil atual, e atribuir  o novo que veio do form
        //actually role user
        $roleUser = $user->roles;
    
        $userRole;
        foreach($roleUser as $role)
        {
           $userRole = $role->id;
        }
        
        //verificando se o perfil do usuairo foi alterado
        if($userRole != $request->role)
        {
            $user->detachRole($userRole);
            $user->attachRole($request->role);  
        }
        //atribuindo o que veio do form
        

        $user->name = $request->name;
        $user->email = $request->email;
        $user->sector_id = $request->sector;
        $user->save();
        return redirect()->back()->with('info','Dados do usuario atualizados com sucesso!');
        
    }
}
