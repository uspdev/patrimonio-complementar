<?php

namespace App\Http\Controllers;

use App\Models\Localusp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Uspdev\UspTheme\Facades\UspTheme;

class LocaluspController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('gerente');
        UspTheme::activeUrl('localusp');

        $setores = explode(',', Auth::user()->setores);
        // Localusp::importar();

        $localusps = Localusp::whereIn('setor', $setores)->get();

        return view('localusp.index', compact('localusps', 'setores'));
    }

    public function admin(){
        Gate::authorize('admin');
        UspTheme::activeUrl('localusp/admin');

        $setores = ['TODOS'];
        Localusp::importar();

        $localusps = Localusp::get();

        return view('localusp.index', compact('localusps', 'setores'));
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
     * @param  \App\Models\Localusp  $localusp
     * @return \Illuminate\Http\Response
     */
    public function show(Localusp $localusp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Localusp  $localusp
     * @return \Illuminate\Http\Response
     */
    public function edit(Localusp $localusp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Localusp  $localusp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Localusp $localusp)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Localusp  $localusp
     * @return \Illuminate\Http\Response
     */
    public function destroy(Localusp $localusp)
    {
        //
    }
}
