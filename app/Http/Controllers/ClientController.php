<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use Exception;
use Facade\FlareClient\Http\Client;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = DB::table('clients')
            ->orderBy('id', 'desc')
            ->get();

        return response()->json($client, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $client = $request->all();

            if ($client) {
                Clients::create($client);
                return response()->json(['data' => 'success'], 200);
            } else {
                return response()->json(['data' => 'error'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['data' => 'erro do servidor'], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            if ($id) {
                $client = Clients::find($id);

                if ($client) {
                    return response()->json($client, 200);
                } else {
                    return response()->json(['data' => 'cliente não encontrado'], 404);
                }
            }
        } catch (\Exception $e) {
            return response()->json(['data' => 'erro no servidor'], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //$method = $request->method() // Recuperar o tipo de metodo enviado
        if ($request->isMethod('put')) {
            try {
                $client = Clients::find($id);
                $dados = $request->all();

                if ($client) {
                    $client->update($dados);
                    return response()->json(['data' => 'success'], 200);
                } else {
                    return response()->json(['data' => 'error'], 404);
                }
            } catch (Exception $e) {
                return response()->json(['data' => 'erro do servidor'], 500);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            if ($id) {
                Clients::find($id)->delete();
                return response()->json(['data' => 'success'], 200);
            } else {
                return response()->json(['data' => 'error'], 404);
            }
        } catch (Exception $e) {
            return response()->json(['data' => 'error do servidor'], 404);
        }
    }
}
