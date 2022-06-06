@extends('layouts.layout')

@section('content')
    <h1>Das Modell "{{ $entity->name }}"</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Hersteller</th>
            </tr>
        </thead>
        <tbody>

            <tr>
                <th>{{ $entity->name }}</th>
                <td>{{ $entity->manufacturer->name }}</td>
                <th></th>
            </tr>

        </tbody>
    </table>
@endsection
