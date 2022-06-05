@extends('layouts.layout')

@section('content')
    <h1>Hersteller bearbeiten</h1>
    @include('snippets.error')
    {!! Form::model($entity, ['url' => 'manufacturers/update/' . $entity->id]) !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Schiffsname...']) !!}
    <br />
    {!! Form::text('founding', null, ['class' => 'form-control', 'placeholder' => 'Gründung...']) !!}
    <br />
    {!! Form::text('location', null, ['class' => 'form-control', 'placeholder' => 'Sitz...']) !!}
    <br />
    {!! Form::submit('Speichern', ['class' => 'btn btn-success']) !!}
    <a href="{{ url('manufacturers') }}" class="btn btn-danger">Abbrechen</a>

    {!! Form::close() !!}
@endsection
