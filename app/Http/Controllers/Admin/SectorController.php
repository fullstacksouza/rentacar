<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\Sector;
class SectorController extends Controller
{
    //
    //mostrar view para cadastrar
    public function create()
    {
        
    }

    //metodo para salvar
    public function store(Sector $sector)
    {
        $newSector = $sector->create([
            'name'              => 'Administrativo',
            'responsible_email' => 'responsalvel@setoradm.com'

        ]);

        return $newSector;
    }
}
