@extends('layouts.layout')

@section('content')
    <h1>Das Schiff "{{ $entity->name }}"</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Schiffsmodell</th>
                <th>Beschreibung</th>
                <th>Schiffstyp</th>
                <th>Breite</th>
                <th>Länge</th>
                <th>Schiffsbesatzung</th>
                <th>BRT</th>
            </tr>
        </thead>
        <tbody>

            <tr>
                <td>{{ $entity->name }}</td>
                <td>{{ $entity->shipmodel->name }}</td>
                <td>{{ $entity->description }}</td>
                <td>{{ $entity->shiptype }}</td>
                <td>{{ $entity->width }}</td>
                <td>{{ $entity->length }}</td>
                <td>{{ $entity->crew }}</td>
                <td>{{ $entity->brt }}</td>
                <th></th>
            </tr>

        </tbody>
    </table>
@endsection
