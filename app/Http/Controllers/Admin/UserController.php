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
        return view("dashboard/users/create",compact('roles','sectors'));
       
        return view('dashboard/users/create',compact('roles','sectors'));
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
        $newUser         = $user->create([
            'name'      => $request->name,
            'email'     => $request->email,
            'sector_id' => 1,
            'password'  => bcrypt($request->password),
            
        ]);
        
        $role            = $role->find(1);
    
        //atribuindo permições
        $newUser->attachRole($role);
        return $newUser;
    }
}
