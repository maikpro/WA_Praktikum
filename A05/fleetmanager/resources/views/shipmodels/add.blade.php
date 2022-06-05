@extends('layouts.layout')

@section('content')
    <h1>Modell hinzufügen</h1>
    @include('snippets.error')

    {!! Form::open(['url' => 'shipmodels/save']) !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Modellname...']) !!}
    <br />
    {!! Form::submit('Speichern', ['class' => 'btn btn-success']) !!}
    <a href="{{ url('manufacturers') }}" class="btn btn-danger">Abbrechen</a>
    {!! Form::close() !!}
@endsection
