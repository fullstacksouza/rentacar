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

    public function testPermission(User $user)
    {
        $myUser = $user->find(1);
        
        
        
        if($myUser->hasRole('admin_super'))
        {
            return "O Usuario possui a permissão";
        }
        return "O usuario não possui a permissao";
    }

    public function store(User $user,Role $role,Request $request)
    {
        $role            = $role->find(1);
        $sector  = Sector::find(1);

            $user->name = $request->name;
            $user->password = bcrypt($request->password);
            $user->email = $request->email;
            $user->sector()->associate($sector);
            
            $user->save();
            $user->attachRole($role);
        return redirect()->back()->with('info','Usuario Cadastrado com Sucesso');
    }
}
