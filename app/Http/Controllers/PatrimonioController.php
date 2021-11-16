<?php

namespace App\Http\Controllers;

use App\Models\Bempatrimoniado;
use App\Models\Localusp;
use App\Models\Patrimonio;
use Illuminate\Http\Request;

class PatrimonioController extends Controller
{

    public function listarlocalusp($codlocusp = null)
    {
        $data = Bempatrimoniado::listarPorSala($codlocusp);
        // dd($data);
        return view('localusp', compact('data'));
    }

    public function listarPorSala(Request $request, $codlocusp = null)
    {
        $data = Bempatrimoniado::listarPorSala($codlocusp);

        $data2 = \Arr::sort($data, function ($value) {
            return $value['numpat'];
        });

        $linPorPagina = 52;
        $numCols = 2;
        $regPorPagina = $linPorPagina * $numCols;

        $out = [];
        $contRow = 0;
        $countCol = 0;
        $pag = [];
        $col = [];
        foreach ($data2 as $row) {
            $col[] = $row;
            $contRow++;

            // divide colunas
            if ($contRow == $linPorPagina) {
                $pag[] = $col;
                $col = [];
                $contRow = 0;
                $countCol++;
            }

            // divide paginas
            if ($countCol == $numCols) {
                $out[] = $pag;
                $pag = [];
                $countCol = 0;
            }
        }

        // pega ultima coluna/pagina
        $pag[] = $col;
        $out[] = $pag;

        // dd($out);

        if (isset($request->pdf)) {
            $pdf = PDF::loadView('pdf', compact('data', 'out'));
            return $pdf->download('relatorio.pdf');
        }

        return view('patrimonio.listar-por-sala', compact('data'));
    }

    public function listarPorNumero(Request $request)
    {
        $data = Bempatrimoniado::listarPorSala();

        $data = \Arr::sort($data, function ($value) {
            return $value['numpat'];
        });

        $linPorPagina = 52;
        $numCols = 2;
        $regPorPagina = $linPorPagina * $numCols;

        $out = [];
        $contRow = 0;
        $countCol = 0;
        $pag = [];
        $col = [];
        foreach ($data as $row) {
            $col[] = $row;
            $contRow++;

            // divide colunas
            if ($contRow == $linPorPagina) {
                $pag[] = $col;
                $col = [];
                $contRow = 0;
                $countCol++;
            }

            // divide paginas
            if ($countCol == $numCols) {
                $out[] = $pag;
                $pag = [];
                $countCol = 0;
            }
        }

        // pega ultima coluna/pagina
        $pag[] = $col;
        $out[] = $pag;

        // dd($out);

        if (isset($request->pdf)) {
            $pdf = PDF::loadView('pdf', compact('data', 'out'));
            return $pdf->download('relatorio.pdf');
        }

        return view('patrimonio.listar-por-numero', ['data' => $out]);
    }

    public function localusp($codlocusp = null)
    {
        \Gate::authorize('gerente');

        if (!$codlocusp) {
            return view('localusp', ['patrimonios' => [], 'localusp' => new Localusp]);
        }
        // todos do replicado
        $bensPorLocal = collect(Bempatrimoniado::listarPorSala($codlocusp));

        foreach ($bensPorLocal as $bem) {
            $patrimonio = Patrimonio::obter($bem);
            $patrimonio->save();
        }
        $patrimonios = Patrimonio::where('codlocusp', $codlocusp)
            ->orWhere('replicado->codlocusp', $codlocusp)
            ->orderBy('numpat', 'ASC')
            ->get();

        $localusp = Localusp::firstOrNew(['codlocusp' => $codlocusp]);

        return view('localusp', compact('localusp', 'patrimonios'));
    }

    public function relatorio()
    {
        \Gate::authorize('gerente');

        $setores = \Auth::user()->setores;
        $setores = "'" . implode("','", explode(',', $setores)) . "'";
        // dd($setores);

        $bens = Bempatrimoniado::listarPorSetores($setores);

        $patrimonios = Patrimonio::all();
        $pendentes = [];
        $conferidos = [];
        $naoVerificados = [];
        foreach ($bens as $bem) {
            $patrimonio = Patrimonio::obter($bem);

            if ($patrimonio->temPendencias()) {
                $pendentes[] = $patrimonio;
            } elseif ($patrimonio->conferido_em) {
                $conferidos[] = $patrimonio;
            } else {
                $naoVerificados[] = $patrimonio;
            }
            $patrimonio->isDirty() && $patrimonio->save();
        }

        return view('relatorio', compact('pendentes', 'conferidos', 'naoVerificados'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        \Gate::authorize('user');

        return view('patrimonio.index');
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
     * @param  \App\Models\Patrimonio  $patrimonio
     * @return \Illuminate\Http\Response
     */
    public function show(Patrimonio $patrimonio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Patrimonio  $patrimonio
     * @return \Illuminate\Http\Response
     */
    public function edit(Patrimonio $patrimonio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Patrimonio  $patrimonio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patrimonio $patrimonio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Patrimonio  $patrimonio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patrimonio $patrimonio)
    {
        //
    }
}
