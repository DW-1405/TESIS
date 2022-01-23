<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\Employee;
use App\Models\User;
use App\Models\DocumentType;
use Auth;
use DB;
use Illuminate\Http\Request;

class SupplierController extends Controller
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
        $page_name = "Proveedores";
        $page_subpage = "Listado";
        $page_icon ="fa fa-users";
        $auth = Auth::user();
        $employees = Employee::all();
        foreach ($employees as $key) {
            if ($key->id == $auth->employee_id) {
                $user = $key;

            }
        }
        $suppliers = Supplier::all();
        return view('Supplier.index',compact("user","suppliers","page_name","page_subpage", "page_icon"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_name = "Proveedores";
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

        return view('supplier.create',compact("user","document_type","page_name","page_subpage", "page_icon"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $supplier = Supplier::create([

            'company_name' => $request->company_name,
            'document_type_id' => $request->document_type_id, 
            'number_document' => $request->number_document,            
            'telephone' => $request->telephone, 
            'address' => $request->address,
            'email' => $request->email,

        ]);

        return redirect()->route('supplier');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $Supplier
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

        $suppliers = Supplier::all();

        foreach ($suppliers as $value) {
            if ($value->id == $id) {
                $profile = $value;
            }
        }

        $page_name = "Información de Proveedor";
        $page_subpage = $profile->company_name;
        $page_icon ="fa fa-id-badge";
        $auth = Auth::user();
        $employees = Employee::all();
        foreach ($employees as $key) {
            if ($key->id == $auth->employee_id) {
                $user = $key;
            }
        }

        return view('supplier.profile', compact('user', 'profile',  "page_name","page_subpage", "page_icon"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier  $Supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $Supplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $Supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $Supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        Supplier::find($supplier->id)->delete();
        return redirect()->route('supplier');
    }
}
