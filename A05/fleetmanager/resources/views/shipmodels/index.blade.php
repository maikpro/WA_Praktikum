@extends('layouts.layout')

@section('content')
    <h1>Alle Modelle</h1>
    {{ $entities->links() }}
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($entities as $index => $shipmodel)
                <tr>
                    <td>{{ $shipmodel->name }}</td>
                    <td>
                        <a href="{{ url('shipmodels/show/' . $shipmodel->id) }}" class="btn btn-success">Show</a>
                        <a href="{{ url('shipmodels/edit/' . $shipmodel->id) }}" class="btn btn-success">Edit</a>
                        <a href="{{ url('shipmodels/delete/' . $shipmodel->id) }}" class="btn btn-danger">Del</a>
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
                    <a href="{{ url('shipmodels/add') }}" class="btn btn-success">Add</a>
                </td>
            </tr>
        </tfoot>
    </table>
    {{ $entities->links() }}
@endsection
