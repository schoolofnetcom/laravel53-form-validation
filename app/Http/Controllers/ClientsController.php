<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

use App\Http\Requests;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all();
        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $paramPessoa = $request->get('pessoa');
        $pessoa = Client::getPessoa($paramPessoa);

        return view('clients.create', compact('pessoa'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\ClientRequest $request)
    {
        $data = $request->all();
        $data['pessoa'] = Client::getPessoa($request->get('pessoa'));
        $data['inadimplente'] = $request->has('inadimplente') ? true : false;
        Client::create($data);
        return redirect()->route('clients.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!($client = Client::find($id))) {
            throw new ModelNotFoundException("Cliente não foi encontrado");
        }
        $pessoa = $client->pessoa;
        return view('clients.edit', compact('client', 'pessoa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\ClientRequest $request, $id)
    {
        if (!($client = Client::find($id))) {
            throw new ModelNotFoundException("Cliente não foi encontrado");
        }

        $data = $request->all();
        $data['inadimplente'] = $request->has('inadimplente') ? true : false;
        $client->fill($data);
        $client->save();

        return redirect()->route('clients.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!($client = Client::find($id))) {
            throw new ModelNotFoundException("Cliente não foi encontrado");
        }

        $client->delete();
        return redirect()->route('clients.index');
    }
}
