<?php

namespace App\Replicado;

use Uspdev\Replicado\DB;

class Bempatrimoniado
{
    public static function obter($numpat)
    {
        $numpats = SELF::listar(['numpat' => $numpat]);
        if ($numpats) {
            return $numpats[0];
        } else {
            return [];
        }
    }

    public static function listarPorSala($codlocusp = null)
    {
        $filtros = ['l.codlocusp' => $codlocusp, 'B.stabem' => 'Ativo'];

        $setores = \Auth::user()->setores;
        $setores = "'" . implode("','", explode(',', $setores)) . "'";
        $filtrosIn = ['B.sglcendsp' => $setores];

        $numpats = SELF::listar($filtros, $filtrosIn);
        // dd($numpats);
        return $numpats;
    }

    public static function listarPorSetores($setores)
    {
        $filtros = ['B.stabem' => 'Ativo'];
        $filtrosIn = ['B.sglcendsp' => $setores];

        $numpats = SELF::listar($filtros, $filtrosIn);
        // dd($numpats);
        return $numpats;
    }

    public static function listarPorResponsavel($codpes)
    {
        $filtros = [
            'P.codpes' => $codpes,
            'B.stabem' => 'Ativo',
        ];
        $numpats = SELF::listar($filtros);
        // dd($numpats);
        return $numpats;
    }

    /**
     * Lista patrimonios usando filtros e filtro tipo IN
     */
    public static function listar($filtros = [], $filtrosIn = [])
    {
        list($filter_query, $params) = SELF::criaFiltro($filtros, []);

        if ($filtrosIn) {
            $filter_query .= $filter_query ? ' AND ' : '';
            $filter_query .= SELF::criaFiltroIn($filtrosIn);
        }

        $query = "SELECT
            P.nompesttd nompes, P.codpes, -- pessoa
            -- B.stabem,
            -- B.sglcendsp setor, --predio
            -- B.codlocusp,
            -- B.numpat,   B.epforibem,
            B.*,
            c.tipitmmat tipo, c.nomsgpitmmat nome, -- classificacao
            CONCAT(B.epfmarpat,' / ', B.modpat, ' / ', B.tippat) descricao
            FROM BEMPATRIMONIADO B
                INNER JOIN dbo.PESSOA P on P.codpes = B.codpes
                INNER JOIN dbo.LOCALUSP l on l.codlocusp = B.codlocusp
                INNER JOIN dbo.CLASSIFITEMMAT c on c.coditmmat = B.coditmmat
            WHERE {$filter_query}
            ORDER BY B.numpat ASC
        ";

        // dd($query, $params);

        return DB::fetchAll($query, $params);
    }


    /**
     * Retorna array contendo string formatada do WHERE com os filtros e
     * as colunas => valores no formato para $params
     *
     * @param array $filtros (opcional) - campo_tabela => valor
     * @param array $tipos (opcional) - campo_tabela => tipo (ex.: codpes => int)
     *
     * @return array posição [0] => string WHERE, posição [1] = 'colunas' => valores
     *
     */
    public static function criaFiltro(array $filtros, array $tipos = [])
    {
        $str_where = '';
        $params = [];
        if (!empty($filtros) && (count($filtros) > 0)) {
            foreach ($filtros as $coluna => $valor) {
                // se $coluna tiver 'tabela.coluna', vamos tirar o 'tabela.'
                $param = explode('.', $coluna);
                $param = end($param);

                if (array_key_exists($coluna, $tipos)) {
                    $str_where .= " $coluna = CONVERT({$tipos[$coluna]}, :{$param}) ";
                } else {
                    $str_where .= " {$coluna} = :{$param} ";
                }

                $params[$param] = $valor;

                // Enquanto existir um filtro, adiciona o operador AND
                $str_where .= next($filtros) ? ' AND ' : '';
            }
            $str_where = ' (' . $str_where . ') ';
        }
        return [$str_where, $params];
    }

    /**
     * Retorna string formatada do WHERE com os filtros tipo IN
     *
     * Ex. Para $filtroIn = ['codpes' => "'123','456'"], a saída será (codpes IN('123','456'))
     *
     * @param array $filtroIn (opcional) - campo_tabela => valor
     * @return string
     * @author Masaki K Neto em 1/12/2021
     */
    public static function criaFiltroIn(array $filtroIn)
    {
        $str_where = '';
        if (!empty($filtroIn) && (count($filtroIn) > 0)) {
            foreach ($filtroIn as $coluna => $valor) {
                $str_where .= "$coluna IN ($valor)";

                // Enquanto existir um filtro, adiciona o operador AND
                $str_where .= next($filtroIn) ? ' AND ' : '';
            }
            $str_where = ' (' . $str_where . ') ';
        }
        return $str_where;
    }
}
