<?php

namespace App\Http\Controllers;

use App\Models\Sector;
use Illuminate\Http\Request;


class SectorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $setores = Sector::all();
        return view('/admin/sector.setor', compact('setores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $setores = Sector::all();
        return view('admin.sector.setor_create', compact('setores'));
    }

    public function edit($id)
    {
        $sector = Sector::find($id);

        if (!$sector) {
            return redirect()->route('sectors.index')->with('error', 'Setor não encontrado.');
    }

    return view('admin.sector.setor_edit', compact('sector'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        $sector = Sector::find($id);

        if (!$sector) {
            return redirect()->route('sectors.index')->with('error', 'Setor não encontrado.');
        }

        $sector->name = $request->input('name');
        $sector->save();

        return redirect()->route('sectors.index')->with('success', 'Setor atualizado com sucesso.');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        Sector::create([
            'name' => $request->input('name'),
        ]);

        return redirect()->route('sectors.index')->with('success', 'Setor criado com sucesso.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $sector = Sector::find($id);

        if (!$sector) {
            return redirect()->route('sectors.index')->with('error', 'Setor não encontrado.');
        }

        $sector->delete();

        return redirect()->route('sectors.index')->with('success', 'Setor excluído com sucesso.');
    }
}