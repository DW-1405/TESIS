<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SaleDetail;
use App\Models\Employee;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\VoucherType;
use App\Models\Client;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Exception;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Session;
use Luecano\NumeroALetras\NumeroALetras;
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
        $legends = self::obtenerLeyenda($sale);
            $legends = json_encode($legends,true);
            $legends = json_decode($legends,true);
        $pdf = PDF::loadView('sale.print', compact('data', 'details','legends', 'sale'));
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

    //LO HIZO CARLESSI
    public function obtenerLeyenda($documento)
    {
        $formatter = new NumeroALetras();
        $convertir = $formatter->toInvoice($documento->total, 2, 'SOLES');

        //CREAR LEYENDA DEL COMPROBANTE
        $arrayLeyenda = Array();
        $arrayLeyenda[] = array(
            "code" => "1000",
            "value" => $convertir
        );
        return $arrayLeyenda;
    }

    public function obtenerProductos($id)
    {
        $detalles = SaleDetail::where('sale_id',$id)->get();
        $arrayProductos = Array();
        foreach($detalles as $detalle){

            $arrayProductos[] = array(
                "codProducto" => 1000 + $detalle->id,
                "unidad" => 'NIU',
                "descripcion"=> $detalle->product->name,
                "cantidad" => (float)$detalle->quantity,
                "mtoValorUnitario" => (float)($detalle->amount / 1.18),
                "mtoValorVenta" => (float)(($detalle->amount * $detalle->quantity) / 1.18),
                "mtoBaseIgv" => (float)(($detalle->amount * $detalle->quantity) / 1.18),
                "porcentajeIgv" => 18,
                "igv" => (float)(($detalle->amount * $detalle->quantity) - (($detalle->amount * $detalle->quantity) / 1.18)),
                "tipAfeIgv" => 10,
                "totalImpuestos" =>  (float)(($detalle->amount * $detalle->quantity) - (($detalle->amount * $detalle->quantity) / 1.18)),
                "mtoPrecioUnitario" => (float)$detalle->amount

            );
        }

        return $arrayProductos;
    }

    public function obtenerFecha($fecha)
    {
        $date = strtotime($fecha);
        $fecha_emision = date('Y-m-d', $date);
        $hora_emision = date('H:i:s', $date);
        $fecha = $fecha_emision.'T'.$hora_emision.'-05:00';

        return $fecha;
    }

    public function sunat($id)
    {

        try
        {
            $documento = Sale::findOrFail($id);

            if ($documento->sunat != '1') {
                //ARREGLO COMPROBANTE
                $arreglo_comprobante = array(
                    "tipoOperacion" => '0101',
                    "tipoDoc"=> $documento->voucher_type->code,
                    "serie" => $documento->voucher_type->serie,
                    "correlativo" => $documento->id,
                    "fechaEmision" => self::obtenerFecha($documento->date),
                    "fecVencimiento" => self::obtenerFecha($documento->date),
                    "observacion" => 'NN',
                    "formaPago" => array(
                        "moneda" => 'PEN',
                        "tipo" =>  'Contado',
                        "monto" => (float)$documento->total,
                    ),
                    "tipoMoneda" => 'PEN',
                    "client" => array(
                        "tipoDoc" => $documento->client->document_type->document == 'DNI' ? 1 : 6,
                        "numDoc" => $documento->client->number_document,
                        "rznSocial" => $documento->client->name,
                        "address" => array(
                            "direccion" => $documento->client->address,
                        )
                    ),
                    "company" => array(
                        "ruc" =>  '10802398307',
                        "razonSocial" => 'SISCOM FAC',
                        "address" => array(
                            "direccion" => 'AV ESPAÑA 1319',
                        )),
                    "mtoOperGravadas" => (float)$documento->total / 1.18,
                    "mtoOperExoneradas" => 0,
                    "mtoIGV" => (float)($documento->total - ($documento->total / 1.18)),

                    "valorVenta" => (float)$documento->total / 1.18,
                    "totalImpuestos" => (float)($documento->total - ($documento->total / 1.18)),
                    "subTotal" => (float)$documento->total,
                    "mtoImpVenta" => (float)$documento->total,
                    "ublVersion" => "2.1",
                    "details" => self::obtenerProductos($documento->id),
                    "legends" =>  self::obtenerLeyenda($documento),
                );

                //return $arreglo_comprobante;
                //OBTENER JSON DEL COMPROBANTE EL CUAL SE ENVIARA A SUNAT
                $data = enviarComprobanteapi(json_encode($arreglo_comprobante));

                //RESPUESTA DE LA SUNAT EN JSON
                $json_sunat = json_decode($data);

                if ($json_sunat->sunatResponse->success == true) {

                    $documento->sunat = '1';

                    $data_comprobante = generarComprobanteapi(json_encode($arreglo_comprobante));
                    $name = $documento->voucher_type->serie."-".$documento->id.'.pdf';

                    if(!file_exists(storage_path('app'.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'sunat'))) {
                        mkdir(storage_path('app'.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'sunat'));
                    }

                    $pathToFile = storage_path('app'.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'sunat'.DIRECTORY_SEPARATOR.$name);

                    file_put_contents($pathToFile, $data_comprobante);

                    $arreglo_qr = array(
                        "ruc" => '10802398307',
                        "tipo" => $documento->voucher_type->code,
                        "serie" => $documento->voucher_type->serie,
                        "numero" => $documento->id,
                        "emision" => self::obtenerFecha($documento->date),
                        "igv" => 18,
                        "total" => (float)$documento->total,
                        "clienteTipo" => $documento->client->document_type->document == 'DNI' ? 1 : 6,
                        "clienteNumero" => $documento->client->number_document
                    );

                    /********************************/
                    $data_qr = generarQrApi(json_encode($arreglo_qr), $documento->empresa_id);

                    $name_qr = $documento->voucher_type->serie."-".$documento->id.'.svg';

                    if(!file_exists(storage_path('app'.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'qrs'))) {
                        mkdir(storage_path('app'.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'qrs'));
                    }

                    $pathToFile_qr = storage_path('app'.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'qrs'.DIRECTORY_SEPARATOR.$name_qr);

                    file_put_contents($pathToFile_qr, $data_qr);

                    /********************************/

                    $data_xml = generarXmlapi(json_encode($arreglo_comprobante), $documento->empresa_id);
                    $name_xml = $documento->voucher_type->serie.'-'.$documento->id.'.xml';
                    $pathToFile_xml = storage_path('app'.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'xml'.DIRECTORY_SEPARATOR.$name_xml);
                    if(!file_exists(storage_path('app'.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'xml'))) {
                        mkdir(storage_path('app'.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'xml'));
                    }
                    file_put_contents($pathToFile_xml, $data_xml);

                    /********************************* */

                    $documento->hash = $json_sunat->hash;
                    $documento->ruta_pdf = 'public/sunat/'.$name;
                    $documento->ruta_qr = 'public/qrs/'.$name_qr;
                    $documento->update();

                    Session::flash('success','Documento de Venta enviada a Sunat con exito.');

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

                    return view('sale.index',[

                        'id_sunat' => $json_sunat->sunatResponse->cdrResponse->id,
                        'descripcion_sunat' => $json_sunat->sunatResponse->cdrResponse->description,
                        'notas_sunat' => $json_sunat->sunatResponse->cdrResponse->notes,
                        'sunat_exito' => true,
                        'user' => $user, 'sales' => $sales,'clients' => $clients, 'vouchers' => $vouchers,"page_name" => $page_name,"page_subpage" => $page_subpage, "page_icon" => $page_icon

                    ])->with('sunat_exito', 'success');

                }else{

                    //COMO SUNAT NO LO ADMITE VUELVE A SER 0
                    $documento->sunat = '0';

                    if ($json_sunat->sunatResponse->error) {
                        $id_sunat = $json_sunat->sunatResponse->error->code;
                        $descripcion_sunat = $json_sunat->sunatResponse->error->message;
                    }else {
                        $id_sunat = $json_sunat->sunatResponse->cdrResponse->id;
                        $descripcion_sunat = $json_sunat->sunatResponse->cdrResponse->description;
                    };

                    $documento->update();

                    Session::flash('error','Documento de Venta sin exito en el envio a sunat.');

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
                    return view('ventas.documentos.index',[
                        'id_sunat' =>  $id_sunat,
                        'descripcion_sunat' =>  $descripcion_sunat,
                        'sunat_error' => true,
                        'user' => $user, 'sales' => $sales,'clients' => $clients, 'vouchers' => $vouchers,"page_name" => $page_name,"page_subpage" => $page_subpage, "page_icon" => $page_icon

                    ])->with('sunat_error', 'error');
                }
            }else{
                $documento->sunat = '1';
                $documento->update();
                Session::flash('error','Documento de venta fue enviado a Sunat.');
                return redirect()->route('sale')->with('sunat_existe', 'error');
            }
        }
        catch(Exception $e)
        {
            return $e->getMessage();
            $documento = Sale::findOrFail($id);
            $documento->sunat = '0';
            $documento->update();
            Session::flash('error', 'No se puede conectar con el servidor, porfavor intentar nuevamente.'); //$e->getMessage()
            return redirect()->route('sale');
        }

    }
}
