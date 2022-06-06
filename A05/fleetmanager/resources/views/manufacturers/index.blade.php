@extends('layouts.layout')

@section('content')
    <h1>Alle Hersteller</h1>
    {{ $entities->links() }}
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Gründung</th>
                <th>Sitz</th>
                <th>Shipmodel_name</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($entities as $index => $manufacturer)
                <tr>
                    <td>{{ $manufacturer->name }}</td>
                    <td>{{ $manufacturer->founding }}</td>
                    <td>{{ $manufacturer->location }}</td>
                    <td>{{ $manufacturer->shipmodels[0]->name }}</td>
                    <td>
                        <a href="{{ url('manufacturers/show/' . $manufacturer->id) }}" class="btn btn-success">Show</a>
                        <a href="{{ url('manufacturers/edit/' . $manufacturer->id) }}" class="btn btn-success">Edit</a>
                        <a href="{{ url('manufacturers/delete/' . $manufacturer->id) }}" class="btn btn-danger">Del</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <a href="{{ url('manufacturers/add') }}" class="btn btn-success">Add</a>
                </td>
            </tr>
        </tfoot>
    </table>
    {{ $entities->links() }}
@endsection
