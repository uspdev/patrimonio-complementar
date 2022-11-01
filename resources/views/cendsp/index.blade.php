@extends('layouts.app')

@section('content')
  <h4>Centros de despesa <span class="badge badge-primary">{{ count($cendsps) }}</span></h4>
  <div class="mb-3">
    Centros de despesa que possuem algum patrimônio alocado nele.
  </div>
  <table class="table table-sm table-bordered datatable">
    <thead>
      <tr>
        <th>Centro de despesa</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($cendsps as $cendsp)
        <tr>
          <td><a href="cendsp/{{ $cendsp }}">{{ $cendsp }}</a> </td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection
