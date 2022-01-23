<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;
use Auth;
use App\Models\SaleDetail;
use App\Models\Employee;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\VoucherType;
use App\Models\Client;
use App\Models\User;
use DB;
class SaleController extends Controller
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
        $page_name = "Ventas";
        $page_subpage = "Registrar venta";
        $page_icon ="fab fa-shopify";
        $auth = Auth::user();
        $employees = Employee::all();
        foreach ($employees as $key) {
            if ($key->id == $auth->employee_id) {
                $user = $key;

            }
        }

        $sales = Sale::all();
        $clients = Client::all();
        $vouchers = VoucherType::all();

        return view('sale.index', compact('user', 'sales','clients', 'vouchers',"page_name","page_subpage", "page_icon"));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_name = "Ventas";
        $page_subpage = "Registrar venta";
        $page_icon ="fab fa-shopify";
        $auth = Auth::user();
        $employees = Employee::all();
        foreach ($employees as $key) {
            if ($key->id == $auth->employee_id) {
                $user = $key;

            }
        }

        $clients = Client::all();
        $vouchers = VoucherType::all();
        $categories = ProductCategory::all();
        $products = Product::all();
        return view('sale.makeSale', compact('user', 'products', 'categories', 'vouchers', 'clients',"page_name","page_subpage", "page_icon"));
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
    
        $total = 0;
        for ($i=0; $i <  sizeof($products) ; $i++) {         
            $total += Product::find($products[$i])->unit_price * $quantities[$i]; 
            Product::find($products[$i])->update([
                'stock' =>  Product::find($products[$i])->stock - $quantities[$i],
            ]);
        }
        $count = Sale::all()->count();
        if($count < 10){
            $code = "00000". ($count + 1);
        }else if($count < 100){
            $code = "0000".($count + 1);
        }else if($count < 1000){
            $code = "000". ($count + 1);
        }else if($count < 10000){
            $code = "00". ($count + 1);
        }else if($count < 100000){
            $code = "0". ($count + 1);
        }
        $sale = Sale::create([
            'code' => $code,
            'date' => date("Y-m-d"),
            'client_id' => $request->client,
            'user_id' => Auth::user()->id,
            'voucher_type_id' => $request->voucher,
            'total' => $total,
        ]);
        
        for ($i=0; $i < sizeof($products); $i++) { 
            
            $sale_product = SaleDetail::create([
                'sale_id' => $sale->id, 
                'product_id' => $products[$i], 
                'quantity' => $quantities[$i],
                'amount' => (Product::find($products[$i])->unit_price * $quantities[$i])
            ]);
        }
        return redirect()->route('invoice', ['sale' => $sale]);
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        //
        $voucher = $sale->voucher_type;
        $page_name = $voucher->type;
        $page_subpage = "Detalles";
        $page_icon ="fa fa-file-text-o";
        $auth = Auth::user();
        $employees = Employee::all();
        foreach ($employees as $key) {
            if ($key->id == $auth->employee_id) {
                $user = $key;

            }
        }

        $employee = $sale->user->employee;
        $client = $sale->client;
        $details = SaleDetail::all();
        $data = DB::select('select * from sale_details where sale_id  = ?', [$sale->id]);

        // return $data;
        return view('sale.invoice', compact('user','data', 'details', 'sale',"page_name","page_subpage", "page_icon"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function print(Sale $sale)
    {
        //
     
        $voucher = $sale->voucher_type;
        $employee = $sale->user->employee;
        $client = $sale->client;
        $details = SaleDetail::all();
        $data = DB::select('select * from sale_details where sale_id  = ?', [$sale->id]);
        // return $sale;
        // return view('sale.print', compact('data', 'details', 'sale'));
        $pdf = \PDF::loadView('sale.print', compact('data', 'details', 'sale'));
        return $pdf->stream('archivo.pdf');
    }




    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
