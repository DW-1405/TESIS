<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use App\Models\User;
use App\Home;
use Auth;
use DB;
use Illuminate\Http\Request;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $page_name = "Inicio";
        $page_subpage = "Estadisticas";
        $page_icon ="fa fa-home";
        $auth = Auth::user();
        $employees = Employee::all();
        foreach ($employees as $key) {
            if ($key->id == $auth->employee_id) {
                $user = $key;
            }
        }
        $id = $auth->id;
        $type_data;
        if(User::find($id)->employee->workstation->work == "ADMINISTRADOR"){
            $type_data = "Ventas mensuales";
            $data = DB::select('CALL total_monthly_sales()');
        }
        else{
            $type_data = "Mis ventas mensuales";
            $data = DB::select('CALL monthly_sales('.$id.')');

        }

        return view('home', compact("user", "data","type_data","page_name","page_subpage", "page_icon"));
    }

    public function ayuda()
    {

        $page_name = "Ayuda";
        $page_subpage = "Ayuda en linea";
        $page_icon ="fa fa-info";
        $auth = Auth::user();
        $employees = Employee::all();
        foreach ($employees as $key) {
            if ($key->id == $auth->employee_id) {
                $user = $key;
            }
        }
       
        return view('ayuda', compact("user", "page_name","page_subpage", "page_icon"));
    }

    // public function chart(Request $request)
    // {
    //     $auth = Auth::user();
    //     $id = $auth->id;
    //     $mes = date("m");
    //     $data = array();

    //     $data = DB::select('CALL monthly_sales('.$id.')');


    //     // return $data;

    //     return response(json_encode($data),200)->header('Content-type', 'text/plain');
    // }

}
