<?php

namespace App\Http\Controllers;

use App\Models\Patrimonio;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Replicado\Bempatrimoniado;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class CentrodespesaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('manager');

        $cendsps = Arr::pluck(Bempatrimoniado::listarCentrosDespesa(), 'sglcendsp');
        return view('cendsp.index', compact('cendsps'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  String  $sglcendsp
     * @return \Illuminate\Http\Response
     */
    public function show(string $sglcendsp)
    {
        Gate::authorize('manager');

        Patrimonio::importar(['sglcendsp' => $sglcendsp]);
        // DB::enableQueryLog();
        // $patrimonios = Patrimonio::whereRaw("JSON_VALUE(replicado, '$.sglcendsp') = ?", $sglcendsp)->get();
        $patrimonios = Patrimonio::where('replicado->sglcendsp', $sglcendsp)->get();
        // print_r(DB::getQueryLog());
        // dd($patrimonios);
        return view('cendsp.show', compact('sglcendsp', 'patrimonios'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
