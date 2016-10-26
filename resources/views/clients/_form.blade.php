{!! Form::hidden('pessoa', $pessoa) !!}

<div class="form-group">
    {!! Form::label('nome', 'Nome') !!}
    {!! Form::text('nome', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('documento', $pessoa == \App\Client::PESSOA_JURIDICA ? 'CNPJ': 'CPF') !!}
    {!! Form::text('documento', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('email', 'E-mail') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('telefone', 'Telefone') !!}
    {!! Form::text('telefone', null, ['class' => 'form-control']) !!}
</div>
@if($pessoa == \App\Client::PESSOA_JURIDICA)
    <div class="form-group">
        {!! Form::label('fantasia', 'Fantasia') !!}
        {!! Form::text('fantasia', null, ['class' => 'form-control']) !!}
    </div>
@else
    <div class="form-group">
        {!! Form::label('estado_civil', 'Estado Civil') !!}
        {!! Form::select('estado_civil', array_merge([0 => 'Selecione'],\App\Client::ESTADOS_CIVIS), null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('data_nasc', 'Data Nascimento') !!}
        {!! Form::date('data_nasc', null, ['class' => 'form-control']) !!}
    </div>

    <div class="radio">
        <label>
            {!! Form::radio('sexo', 'm', true) !!} Masculino
        </label>
    </div>

    <div class="radio">
        <label>
            {!! Form::radio('sexo', 'f', false) !!} Feminino
        </label>
    </div>

    <div class="form-group">
        {!! Form::label('deficiencia_fisica', 'Deficiência Física') !!}
        {!! Form::text('deficiencia_fisica', null , ['class' => 'form-control']) !!}
    </div>
@endif


<div class="checkbox">
    <label>
        {!! Form::checkbox('inadimplente', 'inadimplente') !!} Inadimplente?
    </label>
</div>