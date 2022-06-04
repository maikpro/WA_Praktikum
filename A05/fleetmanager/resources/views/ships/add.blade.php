@extends('layouts.layout')

@section('content')
    <h1>Schiff hinzufügen</h1>
    @include('snippets.error')

    {!! Form::open(['url' => 'ships/save']) !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Schiffsname...']) !!}
    <br />
    {!! Form::text('description', null, ['class' => 'form-control', 'placeholder' => 'Beschreibung...']) !!}
    <br />
    {!! Form::text('shiptype', null, ['class' => 'form-control', 'placeholder' => 'Schiffstyp...']) !!}
    <br />
    {!! Form::text('width', null, ['class' => 'form-control', 'placeholder' => 'Breite...']) !!}
    <br />
    {!! Form::text('length', null, ['class' => 'form-control', 'placeholder' => 'Länge...']) !!}
    <br />
    {!! Form::text('crew', null, ['class' => 'form-control', 'placeholder' => 'Schiffsbesatzung...']) !!}
    <br />
    {!! Form::text('brt', null, ['class' => 'form-control', 'placeholder' => 'BRT...']) !!}
    <br />
    {!! Form::submit('Speichern', ['class' => 'btn btn-success']) !!}
    <a href="{{ url('ships') }}" class="btn btn-danger">Abbrechen</a>

    {!! Form::close() !!}
@endsection
