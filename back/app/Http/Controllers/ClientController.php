<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Deve retornar todos os clientes
     */

    public function index()
    {
        $clients = Client::all();

        return response()->json($clients);
    }

    /**
     * Deve criar um novo cliente
     */

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email',
            'phone' => 'required|string',
            'address' => 'required|string',
        ]);

        $client = Client::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return response()->json($client);
    }

    /**
     * Deve retornar um cliente específico
     */

    public function show($id)
    {
        $client = Client::find($id);

        return response()->json($client);
    }

    /**
     * Deve atualizar um cliente específico
     */

    public function update(Request $request, $id)

    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email',
            'phone' => 'required|string',
            'address' => 'required|string',
        ]);

        $client = Client::find($id);

        $client->name = $request->name;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->address = $request->address;

        $client->save();

        return response()->json($client);
    }

    /**
     * Deve deletar um cliente específico
     */

    public function destroy($id)
    {
        $client = Client::find($id);

        $client->delete();

        return response()->json(['message' => 'Cliente deletado com sucesso']);
    }
}
