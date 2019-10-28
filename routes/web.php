<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $tables = DB::table('beer')
        ->join('company', 'beer.idCompany', '=', 'company.idCompany')
        ->join('type', 'beer.idType', '=', 'type.idType')
        ->select('beer.*', 'company.name as companyName', 'type.name as typeName')
        ->get();
    $company = DB::table('company')->get();
    $type = DB::table('type')->get();
    return view('index', compact('tables', 'company', 'type'));
});
Route::get('/comps', function () {
    $tables = DB::table('company')->get();
    $type = DB::table('type')->get();
    return view('companies', compact('tables', 'type'));
});
Route::get('/types', function () {
    $tables = DB::table('type')->get();
    return view('types', compact('tables'));
});

Route::get('/get/company/{id}', function ($id) {
    $tables = DB::table('beer')
        ->join('company', 'beer.idCompany', '=', 'company.idCompany')
        ->join('type', 'beer.idType', '=', 'type.idType')
        ->select('beer.*', 'company.name as companyName', 'type.name as typeName')
        ->where('beer.idCompany', '=', $id)
        ->get();
    $company = DB::table('company')->get();
    $type = DB::table('type')->get();
    return view('index', compact('tables', 'company', 'type'));
});
Route::get('/get/type/{id}', function ($id) {
    $tables = DB::table('beer')
        ->join('company', 'beer.idCompany', '=', 'company.idCompany')
        ->join('type', 'beer.idType', '=', 'type.idType')
        ->select('beer.*', 'company.name as companyName', 'type.name as typeName')
        ->where('type.idType', '=', $id)
        ->get();
    $company = DB::table('company')->get();
    $type = DB::table('type')->get();
    return view('index', compact('tables', 'company', 'type'));
});


Route::get('/getDB/{table}', function ($table) {
    $tables = DB::table($table)->get();
    return view('dataBase', compact('tables'));
});


Route::post("/add_c", "ControllerC@add_company");
Route::post("/add_t", "ControllerC@add_type");
Route::post("/add_b", "ControllerC@add_beer");

Route::get('/add_company', function () {
    return view('add_company');
});
Route::get('/add_type', function () {
    return view('add_type');
});
Route::get('/add_beer', function () {
    $company = DB::table('company')->get();
    $type = DB::table('type')->get();
    return view('add_beer', compact('company', 'type'));
});

Route::post("/edit_c/{id}", "ControllerC@edit_company");
Route::post("/edit_t/{id}", "ControllerC@edit_type");
Route::post("/edit_b/{id}", "ControllerC@edit_beer");

Route::get('/edit/company/{id}', function ($id) {
    $info = DB::table('company')->where('idCompany', '=', $id)->get()->first();
    return view('edit_company', compact('info'));
});
Route::get('/edit/type/{id}', function ($id) {
    $info = DB::table('type')->where('idType', '=', $id)->get()->first();
    return view('edit_type', compact('info'));
});
Route::get('/edit/beer/{id}', function ($id) {
    $info = DB::table('beer')->where('idBeer', '=', $id)
        ->join('company', 'beer.idCompany', '=', 'company.idCompany')
        ->join('type', 'beer.idType', '=', 'type.idType')
        ->select('beer.*', 'company.name as companyName', 'type.name as typeName')
        ->get()->first();
    $company = DB::table('company')->get();
    $type = DB::table('type')->get();
    return view('edit_beer', compact('info', 'company', 'type'));
});

Route::post("/delete/company/{id}", "ControllerC@delete_company");
Route::post("/delete/type/{id}", "ControllerC@delete_type");
Route::post("/delete/beer/{id}", "ControllerC@delete_beer");


Route::post("/filter/company", "ControllerC@filter_company");
Route::post("/filter/beer", "ControllerC@filter_beer");


