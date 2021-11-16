@extends('layouts.app')

@section('content')
  <div class="h3">
      Listar por número de patrimônio <br>
    Total: {{ count($data) }} páginas <br>
    <a href="?pdf=1">Baixar pdf</a> |

    <hr />
  </div>
  <style>
    table {
      border-collapse: collapse;
      width: 100%;
    }

    table,
    th,
    td {
      border: 1px solid black;
      padding: 5px;
    }

  </style>

  @foreach ($data as $pagecount => $page)
    {{-- {{ $pagecount+1 }} --}}
    <table>
      <tr>
        @foreach ($page as $col)
          <td>
            @foreach ($col as $row)
              {{ formatarNumpat($row['numpat']) }} | {{ $row['codlocusp'] }} |
              {{ truncateMiddle($row['nompes'], 9) }}<br>
            @endforeach
          </td>
        @endforeach
      </tr>
    </table>
  @endforeach
  <hr />
@endsection
