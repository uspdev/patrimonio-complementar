<?php

namespace App\Http\Controllers;

use App\Models\Localusp;
use App\Models\Patrimonio;
use App\Models\User;
use App\Replicado\Bempatrimoniado;
use Illuminate\Http\Request;
use Uspdev\Replicado\Pessoa;

class PatrimonioController extends Controller
{
    // testando lint

      public function lint() {
        // sem nada
      }

    /**
     * Gera relatório de listagem por sala com geração de PDF
     */
    public function listarPorSala(Request $request)
    {
        \Gate::authorize('manager');
        \UspTheme::activeUrl('listarPorSala');

        // $data = Bempatrimoniado::listarPorSala();

        $setores = explode(',', \Auth::user()->setores);
        $l = $localusps = Localusp::whereIn('setor', $setores)->orderBy('setor')->orderBy('codlocusp')->get();
        $view = 'tela';

        if (isset($request->pdf)) {
            $view = 'pdf';
            $pdf = \PDF::loadView('pdf', compact('localusps', 'view'));
            return $pdf->download('relatorio.pdf');
        }

        return view('patrimonio.listar-por-sala', compact('l', 'localusps', 'setores', 'view'));
    }

    public function buscarPorLocal($codlocusp = null)
    {
        \Gate::authorize('manager');
        \UspTheme::activeUrl('buscarPorLocal');

        if (!$codlocusp) {
            $l = $localusp = new Localusp;
            $patrimonios = [];
        } else {
            $l = $localusp = Localusp::firstOrNew(['codlocusp' => $codlocusp]);

            Patrimonio::importar(['codlocusp' => $codlocusp]);
            $patrimonios = Patrimonio::where('codlocusp', $codlocusp)
                ->orWhere('replicado->codlocusp', $codlocusp)
                ->orderBy('numpat', 'ASC')
                ->get();
        }

        return view('buscar-por-local', compact('l', 'localusp', 'patrimonios'));
    }

    public function buscarPorResponsavel($codpes = null)
    {
        \Gate::authorize('manager');
        \UspTheme::activeUrl('buscarPorResponsavel');

        $user = new User;
        $patrimonios = collect();

        if ($codpes) {
            Patrimonio::importar(['codpes' => $codpes]);

            $patrimonios = Patrimonio::where('codpes', $codpes)
                ->where('replicado->stabem', 'Ativo')
                ->orWhere('replicado->despes', $codpes)
                ->orderBy('numpat', 'ASC')
                ->get();

            if ($patrimonios->isNotEmpty()) {
                $user->codpes = $codpes;
                $user->name = Pessoa::nomeCompleto($codpes);
            }
        }

        return view('buscar-por-responsavel', compact('patrimonios', 'user'));
    }

    public function relatorio(Request $request, $tipo = 'Pendentes')
    {
        \Gate::authorize('manager');
        \UspTheme::activeUrl('relatorio');

        $exibir = $request->e ?? 'pendentes';

        $setores = \Auth::user()->setores;
        $setores = "'" . implode("','", explode(',', $setores)) . "'";

        $bens = Bempatrimoniado::listarPorSetores($setores);

        $pendentes = [];
        $conferidos = [];
        $naoVerificados = [];
        foreach ($bens as $bem) {
            $patrimonio = Patrimonio::importar(['bem' => $bem]);

            if ($patrimonio->temPendencias()) {
                $pendentes[] = $patrimonio;
            } elseif ($patrimonio->conferido_em) {
                $conferidos[] = $patrimonio;
            } else {
                $naoVerificados[] = $patrimonio;
            }
        }

        switch ($tipo) {
            case 'Não verificados':
                $patrimonios = $naoVerificados;
                break;
            case 'Conferidos':
                $patrimonios = $conferidos;
                break;
            default:
                $patrimonios = $pendentes;
        }

        return view('relatorio', compact('patrimonios', 'pendentes', 'conferidos', 'naoVerificados', 'exibir', 'tipo'));
    }

    /**
     * Gera lista de patrimonios por numero
     * Desativado
     */
    // public function listarPorNumero(Request $request)
    // {
    //     \Gate::authorize('manager');

    //     $data = Bempatrimoniado::listarPorSala();

    //     $data = \Arr::sort($data, function ($value) {
    //         return $value['numpat'];
    //     });

    //     $linPorPagina = 52;
    //     $numCols = 2;
    //     $regPorPagina = $linPorPagina * $numCols;

    //     $out = [];
    //     $contRow = 0;
    //     $countCol = 0;
    //     $pag = [];
    //     $col = [];
    //     foreach ($data as $row) {
    //         $col[] = $row;
    //         $contRow++;

    //         // divide colunas
    //         if ($contRow == $linPorPagina) {
    //             $pag[] = $col;
    //             $col = [];
    //             $contRow = 0;
    //             $countCol++;
    //         }

    //         // divide paginas
    //         if ($countCol == $numCols) {
    //             $out[] = $pag;
    //             $pag = [];
    //             $countCol = 0;
    //         }
    //     }

    //     // pega ultima coluna/pagina
    //     $pag[] = $col;
    //     $out[] = $pag;

    //     // dd($out);

    //     if (isset($request->pdf)) {
    //         $pdf = PDF::loadView('pdf', compact('data', 'out'));
    //         return $pdf->download('relatorio.pdf');
    //     }

    //     return view('patrimonio.listar-por-numero', ['data' => $out]);
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        \Gate::authorize('user');

        $patrimonios = collect();
        $user = \Auth::user();

        Patrimonio::importar(['codpes' => $user->codpes]);
        Patrimonio::limpar(['codpes' => $user->codpes]);

        $patrimonios = Patrimonio::where('codpes', $user->codpes)
            ->orWhere('replicado->codpes', $user->codpes)
            // ->where('replicado->stabem', 'Ativo')
            ->orderBy('numpat', 'ASC')
            ->get();

        return view('patrimonio.index', compact('user', 'patrimonios'));
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
