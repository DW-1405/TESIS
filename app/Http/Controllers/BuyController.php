<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Buy;
use Illuminate\Http\Request;
use Auth;
use App\Models\Employee;
use App\Models\Supplier;
use App\Models\User;
use DB;

class BuyController extends Controller
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
        //
        $page_name = "Compras";
        $page_subpage = "Registrar compra";
        $page_icon ="fab fa-shopify";
        $auth = Auth::user();
        $employees = Employee::all();
        foreach ($employees as $key) {
            if ($key->id == $auth->employee_id) {
                $user = $key;

            }
        }

        $buys = Buy::all();
        $suppliers = Supplier::all();

        return view('buy.index', compact('user', 'buys','suppliers', "page_name","page_subpage", "page_icon"));

    }
      /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_name = "Compras";
        $page_subpage = "Registrar Compra";
        $page_icon ="fab fa-shopify";
        $auth = Auth::user();
        $employees = Employee::all();
        foreach ($employees as $key) {
            if ($key->id == $auth->employee_id) {
                $user = $key;

            }
        }

        $orders = DB::select("SELECT DISTINCT orders.id FROM orders inner join buys WHERE orders.id != buys.order_id order by orders.id ");


        return view('buy.makeBuy', compact('user', 'orders',"page_name","page_subpage", "page_icon"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $buys = Buy::create([

            'order_id' => $request->order,
            'date' => date("Y-m-d"),
            'state' => $request->state,

        ]);

        return redirect()->route('buy');
    }
     /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Buy  $Buy
     * @return \Illuminate\Http\Response
     */
    public function edit(Buy $buy)
    {
        //
        $page_name = "Compras";
        $page_subpage = "Atender pedido";
        $page_icon ="fab fa-shopify";
        $auth = Auth::user();
        $employees = Employee::all();
        foreach ($employees as $key) {
            if ($key->id == $auth->employee_id) {
                $user = $key;

            }
        }

        return view('Buy.edit',compact("user", "buy","page_name","page_subpage", "page_icon"));
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Buy  $buy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Buy $buy)
    {
        //

        Buy::find($buy->id)->update($request->all());
        return redirect()->route('buy');

    }

}
