<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\Permission;
use App\User;
class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $adminRole               = new Role();
        $adminRole->name         = "super-admin";
        $adminRole->display_name = "Administrador Total";
        $adminRole->description  = "Administrador do Sistema com controle total dos dados";
        $adminRole->save();

        //permissão para criar pesquisa
        $createSearch               = new Permission();
        $createSearch->name         = "create-user";
        $createSearch->display_name = "Criar Usuários";
        $createSearch->description  = "Permissão para criar Usuarios no sistema";
        $createSearch->save();



        //Atribuindo Permissão ao perfil 

        $adminRole = Role::find(1);
        $createUserPermission = Permission::find(1);
        $adminRole->attachPermission($createUserPermission);

        //Atribuindo regras ao usuario
        
        $user = User::find(1);
        $user->attachRole($adminRole);

    }
}
