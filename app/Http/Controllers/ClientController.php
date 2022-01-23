<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Employee;
use App\Models\User;
use App\Models\DocumentType;
use Auth;
use DB;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
       * Create a new controller instance.
       *
       * @return void
    */
    public function __construct()
    {
      $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_name = "Clientes";
        $page_subpage = "Listado";
        $page_icon ="fa fa-users";
        $auth = Auth::user();
        $employees = Employee::all();
        foreach ($employees as $key) {
            if ($key->id == $auth->employee_id) {
                $user = $key;

            }
        }
        $clients = Client::all();
        return view('client.index',compact("user","clients","page_name","page_subpage", "page_icon"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_name = "Clientes";
        $page_subpage = "Registrar";
        $page_icon ="fa fa-users";
        $auth = Auth::user();
        $employees = Employee::all();
        foreach ($employees as $key) {
            if ($key->id == $auth->employee_id) {
                $user = $key;

            }
        }
        
        $document_type = DocumentType::all();

        return view('client.create',compact("user","document_type","page_name","page_subpage", "page_icon"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $client = Client::create([

            'name' => $request->name, 
            'lastname' => $request->lastname, 
            'document_type_id' => $request->document_type_id, 
            'number_document' => $request->number_document,            
            'telephone' => $request->telephone, 
            'address' => $request->address,

        ]);

        return redirect()->route('client');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        Client::find($client->id)->delete();
        return redirect()->route('client');
    }
}
