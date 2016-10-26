@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Listagem de clientes</h3>
            <a href="{{ route('clients.create') }}" class="btn btn-primary">Novo cliente</a>
        </div>
        <div class="row">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>CNPJ/CPF</th>
                    <th>Data Nasc.</th>
                    <th>E-mail</th>
                    <th>Telefone</th>
                    <th>Sexo</th>
                    <th>Ação</th>
                </tr>
                </thead>

                <tbody>
                @foreach($clients as $client)
                    <tr>
                        <td>{{ $client->id }}</td>
                        <td>{{ $client->nome }}</td>
                        <td>{{ $client->documento_formatted }}</td>
                        <td>{{ $client->data_nasc_formatted }}</td>
                        <td>{{ $client->email }}</td>
                        <td>{{ $client->telefone }}</td>
                        <td>{{ $client->sexo_formatted }}</td>
                        <td>
                            <ul class="list-inline list-small">
                                <li>
                                    <a class="btn btn-link btn-link-small" href="{{route('clients.edit', ['client' => $client->id])}}">Editar</a>
                                </li>
                                <li>|</li>
                                <li>
                                    <form method="POST" action="{{route('clients.destroy',['client' => $client->id])}}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button class="btn btn-link btn-link-small" type="submit">Excluir</button>
                                    </form>
                                </li>
                            </ul>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection