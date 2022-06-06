@extends('layouts.layout')

@section('content')
    <h1>Modell bearbeiten</h1>
    @include('snippets.error')
    {!! Form::model($entity, ['url' => 'shipmodels/update/' . $entity->id]) !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Modellname...']) !!}
    <br />

    {!! Form::select('manufacturer_id', $manufacturers) !!}
    <br />

    {!! Form::submit('Speichern', ['class' => 'btn btn-success']) !!}
    <a href="{{ url('shipmodels') }}" class="btn btn-danger">Abbrechen</a>

    {!! Form::close() !!}
@endsection
