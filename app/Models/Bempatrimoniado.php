<?php

namespace App\Models;

use Uspdev\Replicado\DB;

class Bempatrimoniado
{
    public static function obter($numpat)
    {
        $numpat = str_replace('.', '', $numpat);

        $query = "SELECT p.nompesttd, b.*
        FROM BEMPATRIMONIADO b
        INNER JOIN PESSOA p on p.codpes = b.codpes
        WHERE numpat = CONVERT(decimal, :numpat)
        ";

        $query = "SELECT
            B.stabem,
            B.sglcendsp setor, --predio
            CONCAT(RTRIM(l.idfblc), '+', RTRIM(l.idfadr)) piso, -- piso
            B.codlocusp, CONCAT(RTRIM(l.tiplocusp),'+', RTRIM(l.stiloc)) sala, -- local
            CONCAT(RTRIM(P.codpes),' - ', P.nompesttd) responsavel, P.nompesttd nompes, P.codpes, -- pessoa
            B.numpat,   B.epforibem,
            c.tipitmmat tipo, c.nomsgpitmmat nome, -- classificacao
            CONCAT(B.epfmarpat,' / ', B.modpat, ' / ', B.tippat) descricao
            from BEMPATRIMONIADO B
            INNER JOIN dbo.PESSOA P on P.codpes = B.codpes
            INNER JOIN dbo.LOCALUSP l on l.codlocusp = B.codlocusp
            INNER JOIN dbo.CLASSIFITEMMAT c on c.coditmmat = B.coditmmat
            WHERE numpat = CONVERT(decimal, :numpat)
            --ORDER BY
            --B.numpat ASC
            --B.sglcendsp ASC, piso ASC, B.codlocusp ASC, B.numpat ASC
        ";

        $param['numpat'] = $numpat;

        return DB::fetch($query, $param);
    }

    public static function listarPorSala()
    {
        $query = "SELECT
            B.sglcendsp setor, --predio
            CONCAT(RTRIM(l.idfblc), '+', RTRIM(l.idfadr)) piso, -- piso
            B.codlocusp localusp, CONCAT(RTRIM(l.tiplocusp),'+', RTRIM(l.stiloc)) sala, -- local
            CONCAT(RTRIM(P.codpes),' - ', P.nompesttd) responsavel, P.nompesttd nompes, -- pessoa
            B.numpat,   B.epforibem,
            c.tipitmmat tipo, c.nomsgpitmmat nome, -- classificacao
            CONCAT(B.epfmarpat,' / ', B.modpat, ' / ', B.tippat) descricao
        FROM BEMPATRIMONIADO B
        INNER JOIN dbo.PESSOA P on P.codpes = B.codpes
        INNER JOIN dbo.LOCALUSP l on l.codlocusp = B.codlocusp
        INNER JOIN dbo.CLASSIFITEMMAT c on c.coditmmat = B.coditmmat
        WHERE B.sglcendsp IN ('SET','LAMEM','LMABC') and stabem='Ativo'
        ORDER BY
            --B.numpat ASC
	        B.sglcendsp ASC, piso ASC, B.codlocusp ASC, B.numpat ASC
    ";

        return DB::fetchAll($query);
    }
}
