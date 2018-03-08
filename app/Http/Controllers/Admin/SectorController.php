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

        return view("dashboard/sectors/create");
    }

    public function list()
    {
        $sectors = Sector::all();
        return view('dashboard/sectors/list',compact('sectors'));
    }

    //metodo para salvar
    public function store(Request $request,Sector $sector)
    {
        $sector->name              = $request->name;
        $sector->responsible_email = $request->responsible_email;
        $sector->save();

        
        return redirect()->back()->with('info','Setor Cadastrado com Sucesso');
    }

    public function edit(Request $request)
    {
        $sectorEdit = Sector::findOrFail($request->id);

        return view('dashboard/sectors/edit',compact('sectorEdit'));
    }

    public function update(Request $request,Sector $sector)
    {
        $sectorEdit = $sector->findOrFail($request->id);
        $sectorEdit->name              = $request->name;
        $sectorEdit->responsible_email = $request->responsible_email;
        $sectorEdit->save();

        
        return redirect()->back()->with('info','Setor Atualizado com Sucesso');
    }
}
