@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Novo cliente</h3>
            <h4>{{$pessoa == \App\Client::PESSOA_JURIDICA ? 'Pessoa Júridica': 'Pessoa Física'}}</h4>

            <a href="{{ route('clients.create',['pessoa' => \App\Client::PESSOA_FISICA]) }}">Pessoa Física</a> |
            <a href="{{ route('clients.create',['pessoa' => \App\Client::PESSOA_JURIDICA]) }}">Pessoa Jurídica</a>
            <br/><br/>
            @include('errors._errors_form')
            {!! Form::open(['route' => 'clients.store', 'class' => 'form']) !!}

                @include('clients._form')

                <div class="form-group">
                    {!! Form::submit('Criar cliente', ['class' => 'btn btn-primary']) !!}
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection