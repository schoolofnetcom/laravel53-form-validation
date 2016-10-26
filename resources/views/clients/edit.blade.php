@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Novo cliente</h3>
            <h4>{{$pessoa == \App\Client::PESSOA_JURIDICA ? 'Pessoa Júridica': 'Pessoa Física'}}</h4>

            @include('errors._errors_form')

            {!! Form::model($client, ['route' => ['clients.update','client' => $client->id], 'class' => 'form', 'method' => 'PUT']) !!}

                @include('clients._form')

                <div class="form-group">
                    {!! Form::submit('Salvar cliente', ['class' => 'btn btn-primary']) !!}
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection