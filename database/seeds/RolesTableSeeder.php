<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\Permission;
use App\User;
use App\Admin\Question;
use App\Admin\TypeQuestion;
use App\Admin\Search;
use App\Admin\Sector;
use App\Admin\Answer;
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

        $adminRole = new Role();
        $adminRole->name = "super-admin";
        $adminRole->display_name = "Administrador Total";
        $adminRole->description = "Administrador do Sistema com controle total dos dados";
        $adminRole->save();

        //permissão para criar pesquisa
        $createSearch = new Permission();
        $createSearch->name = "create-user";
        $createSearch->display_name = "Criar Usuários";
        $createSearch->description = "Permissão para criar Usuarios no sistema";
        $createSearch->save();
        //permissao para gerenciamento
        $manager = new Permission();
        $manager->name = "manager";
        $manager->display_name = "Gerenciar Conteúdo";
        $manager->description = "Permissão para gerenciar o sistema";
        $manager->save();


        //Atribuindo Permissão ao perfil

        $adminRole = Role::find(1);
        //$createUserPermission = Permission::find(1);
        //$adminRole->attachPermission($createUserPermission);

        $mangerPermission = Permission::find(2);
       // $adminRole->attachPermission($mangerPermission);
        //Atribuindo regras ao usuario

        $user = User::create([
            'name' => 'Matheus Souza',
            'email' => 'matheus.souzadv@gmail.com',
            'password' => bcrypt('05092013'),
            'rg' => 112233355,
            'registration' => 111224514,
            'dob' => '2018-03-28',



        ]);
        $user->attachRole($adminRole);

        $user = User::create([
            'name' => 'Administrador(a)',
            'email' => 'adm@rentacar.com',
            'password' => bcrypt('rentacar'),
            'rg' => 112233355,
            'registration' => 111224514,
            'dob' => '2018-03-25',



        ]);

        $user = User::find(1);

        $user->attachPermission($mangerPermission);

        $user = User::find(2);

        $user->attachPermission($mangerPermission);
        $typeQuestion = TypeQuestion::create([
            'name' => 'Multipla escolha'
        ]);

        $sector = Sector::create([
            'name' => 'Ti',
            'responsible_email' => 'ti@gmail.com'
        ]);

    }
}
