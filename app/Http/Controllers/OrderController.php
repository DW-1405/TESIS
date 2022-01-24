<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Auth;
use App\Models\OrderDetail;
use App\Models\Employee;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Supplier;
use App\Models\User;
use DB;

class OrderController extends Controller
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
        $page_name = "Pedidos";
        $page_subpage = "Registrar orden";
        $page_icon ="icon fas fa-clipboard-list";
        $auth = Auth::user();
        $employees = Employee::all();
        foreach ($employees as $key) {
            if ($key->id == $auth->employee_id) {
                $user = $key;

            }
        }

        $orders = Order::all();
        $suppliers = Supplier::all();

        return view('order.index', compact('user', 'orders','suppliers', "page_name","page_subpage", "page_icon"));

    }

      /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_name = "Pedido";
        $page_subpage = "Registrar Compra";
        $page_icon ="icon fas fa-clipboard-list";
        $auth = Auth::user();
        $employees = Employee::all();
        foreach ($employees as $key) {
            if ($key->id == $auth->employee_id) {
                $user = $key;

            }
        }

        $suppliers = Supplier::all();
        $categories = ProductCategory::all();
        $products = Product::all();
        return view('order.makeOrder', compact('user', 'products', 'categories', 'suppliers',"page_name","page_subpage", "page_icon"));
    }


     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $products = $request->list_products;
        $quantities = $request->list_quantity;
  
        $order = Order::create([            
            'user_id' => Auth::user()->id,
            'supplier_id' => $request->supplier, 
            'date' => date("Y-m-d"),            
        ]);
        
        for ($i=0; $i < sizeof($products); $i++) { 
            
            $order_product = OrderDetail::create([
                'order_id' => $order->id, 
                'product_id' => $products[$i], 
                'product_quantity' => $quantities[$i]
            ]);
        }
        return redirect()->route('remission', ['order' => $order]);
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(order $order)
    {
        //
        $page_name = "Resumen de pedido";
        $page_subpage = "Detalles";
        $page_icon ="fa fa-file-text-o";
        $auth = Auth::user();
        $employees = Employee::all();
        foreach ($employees as $key) {
            if ($key->id == $auth->employee_id) {
                $user = $key;

            }
        }
        
        $employee = $order->user->employee;
        $supplier = $order->supplier;
        $details = OrderDetail::all();
        $data = DB::select('select * from order_details where order_id  = ?', [$order->id]);

        // return $data;
        return view('order.remission', compact('user','data', 'details', 'order',"page_name","page_subpage", "page_icon"));
    }

      /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function printer(order $order)
    {
        //
     
        $employee = $order->user->employee;
        $supplier = $order->supplier;
        $details = orderDetail::all();
        $data = DB::select('select * from order_details where order_id  = ?', [$order->id]);
        // return $order;
        // return view('order.print', compact('data', 'details', 'order'));
        $pdf = \PDF::loadView('order.printer', compact('data', 'details', 'order'));
        return $pdf->stream('archivo.pdf');
    }

   
}
