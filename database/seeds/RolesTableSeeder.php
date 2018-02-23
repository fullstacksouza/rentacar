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
        
       /* $adminRole               = new Role();
        $adminRole->name         = "admin_super";
        $adminRole->display_name = "Administrador";
        $adminRole->description  = "Administrador do Sistema com controle total dos dados";
        $adminRole->save();

        //permissão para criar pesquisa
        $createSearch               = new Permission();
        $createSearch->name         = "create-search";
        $createSearch->display_name = "Criar Pesquisas";
        $createSearch->description  = "Permissão para criar pesquisas no sistema";
        $createSearch->save();*/


        //Atribuindo Permissão ao perfil 

        $adminRole = Role::find(1);
        $createSearchPermission = Permission::find(1);
        $adminRole->attachPermission($createSearchPermission);

        //Atribuindo regras ao usuario
        /*
        $user = User::find(1);
        $user->attachRole($adminRole);*/

    }
}
