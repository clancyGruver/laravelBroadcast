@extends('layouts.app')

@section('content')
<div class="row">
    <table class="table">
    <caption>Последние данные</caption>
    <thead class="thead-dark">
        <tr>
        <th scope="col">#</th>
        <th scope="col">Артикул</th>
        <th scope="col">Наименование</th>
        <th scope="col">Цена</th>
        <th scope="col">Дата</th>
        </tr>
    </thead>
    <tbody>
        <tr>
        <th scope="row">1</th>
        <td>Mark</td>
        <td>Otto</td>
        <td>@mdo</td>
        </tr>
        <tr>
        <th scope="row">2</th>
        <td>Jacob</td>
        <td>Thornton</td>
        <td>@fat</td>
        </tr>
        <tr>
        <th scope="row">3</th>
        <td>Larry</td>
        <td>the Bird</td>
        <td>@twitter</td>
        </tr>
    </tbody>
    </table>
</div>
@endsection