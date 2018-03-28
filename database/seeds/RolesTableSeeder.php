<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\Permission;
use App\User;
use App\Admin\Question;
use App\Admin\Search;
use App\Admin\Sector;
use App\Admin\AnsweOption;

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
        
        $user = User::create([
            'name'         => 'Matheus Souza',
            'email'        => 'matheus.souzadv@gmail.com',
            'password'     => bcrypt('05092013'),
            'rg'           => 112233355,
            'registration' => 111224514,
            'dob'          => '2018-03-28',



        ]);
        $user->attachRole($adminRole);
        
        

    }
}
