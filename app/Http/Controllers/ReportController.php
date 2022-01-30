<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use App\Models\Employee;
use App\Models\Supplier;
use App\Models\Sale;
use App\Models\Buy;
use Illuminate\Support\Facades\DB;
use Exception;
use Barryvdh\DomPDF\Facade as PDF;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function venta_fecha($fi=null,$ff=null){

        $page_name = "Reporte Ventas";
        $page_subpage = "Reporte de ventas";
        $page_icon ="icon fas fa-clipboard-list";
        $auth = Auth::user();
        $employees = Employee::all();
        foreach ($employees as $key) {
            if ($key->id == $auth->employee_id) {
                $user = $key;

            }
        }
        
        $ventas = Sale::whereDate('date', Carbon::today('America/Lima'))->get();
        return view('report.ventas', compact('user', "page_name","page_subpage", "page_icon",'ventas','fi','ff'));
    }


    public function venta_resultados(Request $request){

        $page_name = "Reporte ";
        $page_subpage = "Reporte de ventas";
        $page_icon ="icon fas fa-clipboard-list";
        $auth = Auth::user();
        $employees = Employee::all();
        foreach ($employees as $key) {
            if ($key->id == $auth->employee_id) {
                $user = $key;

            }
        }

        $fi = $request->fecha_ini. ' 00:00:00';
        $ff = $request->fecha_fin. ' 23:59:59';
        $ventas = Sale::whereBetween('date', [$fi, $ff])->get();
        return view('report.ventas', compact('user', "page_name","page_subpage", "page_icon",'ventas','fi','ff'));
    }

    public function compra_fecha($fi=null,$ff=null){

        $page_name = "Reporte Compras";
        $page_subpage = "Reporte de compras";
        $page_icon ="icon fas fa-clipboard-list";
        $auth = Auth::user();
        $employees = Employee::all();
        foreach ($employees as $key) {
            if ($key->id == $auth->employee_id) {
                $user = $key;

            }
        }

        $suppliers = Supplier::all();
        $compras = Buy::whereDate('date', Carbon::today('America/Lima'))->get();
        return view('report.compras', compact('user',"suppliers", "page_name","page_subpage", "page_icon",'compras','fi','ff'));
    }
    public function compra_resultados(Request $request){

        $page_name = "Reporte Compras";
        $page_subpage = "Reporte de compras";
        $page_icon ="icon fas fa-clipboard-list";
        $auth = Auth::user();
        $employees = Employee::all();
        foreach ($employees as $key) {
            if ($key->id == $auth->employee_id) {
                $user = $key;

            }
        }

        $suppliers = Supplier::all();
        $fi = $request->fecha_ini. ' 00:00:00';
        $ff = $request->fecha_fin. ' 23:59:59';
        $compras = Buy::whereBetween('date', [$fi, $ff])->get();
        return view('report.compras', compact('user', "page_name","suppliers","page_subpage", "page_icon",'compras','fi','ff'));

    }

    public function almacen(){
        $productosv=DB::select('SELECT sum(dv.cantidad) as cantidad, p.nombre as nombre , p.id as id from productos p 
        inner join detalle_ventas dv on p.id=dv.producto_id 
        inner join ventas v on dv.venta_id=v.id where v.estado="VALIDO" 
        and year(v.venta_date)=year(curdate()) 
        group by p.nombre, p.id order by sum(dv.cantidad) desc limit 5');
        return view('admin.reporte.reporte_almacen',compact('productosv'));
    }

    public function generarvPDF(Request $request){

        $page_name = "Reporte ";
        $page_subpage = "Reporte de ventas";
        $page_icon ="icon fas fa-clipboard-list";
        $auth = Auth::user();
        $employees = Employee::all();
        foreach ($employees as $key) {
            if ($key->id == $auth->employee_id) {
                $user = $key;

            }
        }

        $fi = $request->fi;
        $ff = $request->ff;
        $ventas = Sale::whereBetween('date', [$fi, $ff])->get();

        // $pdf = PDF::loadView('report.pdfventa', compact('user', "page_name","page_subpage", "page_icon",'ventas','fi','ff'));
        // return $pdf->stream('archivo.pdf');
        return view('report.pdfventa', compact('user',"page_name","page_subpage", "page_icon",'ventas','fi','ff'));
    }

    public function generarcPDF(Request $request){

        $page_name = "Reporte Compras";
        $page_subpage = "Reporte de compras";
        $page_icon ="icon fas fa-clipboard-list";
        $auth = Auth::user();
        $employees = Employee::all();
        foreach ($employees as $key) {
            if ($key->id == $auth->employee_id) {
                $user = $key;

            }
        }

        $fi = $request->fi;
        $ff = $request->ff;
        
        $suppliers = Supplier::all();
        $compras = Buy::whereBetween('date', [$fi, $ff])->get();
        return view('report.pdfcompras', compact('user',"suppliers","page_name","page_subpage", "page_icon",'compras','fi','ff'));
    }

    public function almacenPDF(){
        $productosv=DB::select('SELECT sum(dv.cantidad) as cantidad, p.nombre as nombre , p.id as id from productos p 
        inner join detalle_ventas dv on p.id=dv.producto_id 
        inner join ventas v on dv.venta_id=v.id where v.estado="VALIDO" 
        and year(v.venta_date)=year(curdate()) 
        group by p.nombre, p.id order by sum(dv.cantidad) desc limit 5');
        return view('admin.reporte.pdfalmacen',compact('productosv'));
    }
}
