<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Auth;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
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
        $page_name = "Categorias";
        $page_subpage = "Listado";
        $page_icon ="fa fa-clipboard-list";
        $auth = Auth::user();
        $employees = Employee::all();
        foreach ($employees as $key) {
            if ($key->id == $auth->employee_id) {
                $user = $key;

            }
        }
        $categories = ProductCategory::all();
        return view('category.index',compact("user","categories","page_name","page_subpage", "page_icon"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_name = "Categorias";
        $page_subpage = "Registrar";
        $page_icon ="fa fa-clipboard-list";
        $auth = Auth::user();
        $employees = Employee::all();
        foreach ($employees as $key) {
            if ($key->id == $auth->employee_id) {
                $user = $key;

            }
        }
       
        $categories = ProductCategory::all();

        return view('category.create',compact("user","categories","page_name","page_subpage", "page_icon"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ProductCategory::create($request->all());
        return redirect()->route('category');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ProductCategory $productCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductCategory $productCategory)
    {
        $page_name = "Categorias";
        $page_subpage = "Actualizar";
        $page_icon ="fa fa-clipboard-list";
        $auth = Auth::user();
        $employees = Employee::all();
        foreach ($employees as $key) {
            if ($key->id == $auth->employee_id) {
                $user = $key;

            }
        }

        return view('category.edit',compact("user","productCategory","page_name","page_subpage", "page_icon"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductCategory $productCategory)
    {
        ProductCategory::find($productCategory->id)->update($request->all());
        return redirect()->route('category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductCategory $productCategory)
    {
        ProductCategory::find($productCategory->id)->delete();
        return redirect()->route('category');
    }
}
