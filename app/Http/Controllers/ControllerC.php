<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ControllerC extends Controller
{
    public function add_company(Request $request){
        $validatedData = $request->validate([
            'name' => 'required'
        ]);
        $name = $request->input('name');
        \DB::insert('insert into company (idCompany, name) values (?, ?)', [NULL, $name]);
        $tables = \DB::table('company')->get();
        $type = \DB::table('type')->get();
        return view('companies', compact('tables', 'type'));
    }
    public function add_type(Request $request){
        $validatedData = $request->validate([
            'name' => 'required'
        ]);
        $name = $request->input('name');

        \DB::insert('insert into type (idType, name) values (?, ?)', [NULL, $name]);
        $tables = \DB::table('type')->get();
        return view('types', compact('tables'));
    }
    public function add_beer(Request $request){
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);
        $name = ($request)->input('name');
        $description = ($request)->input('description');
        $idCompany = ($request)->input('company');
        $idType = ($request)->input('type');

        \DB::insert('insert into beer (idBeer, name, description, idCompany, idType) values (?, ?, ?, ?, ?)', [NULL, $name, $description, $idCompany, $idType]);
        $tables = \DB::table('beer')
            ->join('company', 'beer.idCompany', '=', 'company.idCompany')
            ->join('type', 'beer.idType', '=', 'type.idType')
            ->select('beer.*', 'company.name as companyName', 'type.name as typeName')
            ->get();
        $company = \DB::table('company')->get();
        $type = \DB::table('type')->get();
        return view('index', compact('tables', 'company', 'type'));
    }

    public function edit_company(Request $request, $id){
        $validatedData = $request->validate([
            'name' => 'required'
        ]);
        $name = $request->input('name');
        \DB::update('update company set name = ? where idCompany = ?', [$name, $id]);
        $tables = \DB::table('company')->get();
        $type = \DB::table('type')->get();
        return view('companies', compact('tables', 'type'));
    }
    public function edit_type(Request $request, $id){
        $validatedData = $request->validate([
            'name' => 'required'
        ]);
        $name = $request->input('name');
        \DB::update('update type set name = ? where idType = ?', [$name, $id]);
        $tables = \DB::table('type')->get();
        return view('types', compact('tables'));
    }
    public function edit_beer(Request $request, $id){
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);
        $name = ($request)->input('name');
        $description = ($request)->input('description');
        $idCompany = ($request)->input('company');
        $idType = ($request)->input('type');
        \DB::update('update beer set name = ? where idBeer = ?', [$name, $id]);
        \DB::update('update beer set description = ? where idBeer = ?', [$description, $id]);
        \DB::update('update beer set idCompany = ? where idBeer = ?', [$idCompany, $id]);
        \DB::update('update beer set idType = ? where idBeer = ?', [$idType, $id]);
        $tables = \DB::table('beer')
            ->join('company', 'beer.idCompany', '=', 'company.idCompany')
            ->join('type', 'beer.idType', '=', 'type.idType')
            ->select('beer.*', 'company.name as companyName', 'type.name as typeName')
            ->get();
        $company = \DB::table('company')->get();
        $type = \DB::table('type')->get();
        return view('index', compact('tables', 'company', 'type'));
    }


    public function delete_company(Request $request, $id){
        \DB::table('company')->where('idCompany', '=', $id)->delete();
        $tables = \DB::table('company')->get();
        $type = \DB::table('type')->get();
        return view('companies', compact('tables', 'type'));
    }
    public function delete_type(Request $request, $id){
        \DB::table('type')->where('idType', '=', $id)->delete();
        $tables = \DB::table('type')->get();
        return view('types', compact('tables'));
    }
    public function delete_beer(Request $request, $id){
        \DB::table('beer')->where('idBeer', '=', $id)->delete();
        $tables = \DB::table('beer')
            ->join('company', 'beer.idCompany', '=', 'company.idCompany')
            ->join('type', 'beer.idType', '=', 'type.idType')
            ->select('beer.*', 'company.name as companyName', 'type.name as typeName')
            ->get();
        $company = \DB::table('company')->get();
        $type = \DB::table('type')->get();
        return view('index', compact('tables', 'company', 'type'));
    }

    public function filter_company(Request $request){
        $types = $request->input('type');
        if($types != -1){
            $tables = \DB::table('beer')
                ->join('company', 'beer.idCompany', '=', 'company.idCompany')
                ->join('type', 'beer.idType', '=', 'type.idType')
                ->select('beer.idCompany', 'company.name as name', 'beer.idType')
                ->where('beer.idType', '=', $types)
                ->groupBy('beer.idCompany', 'beer.idType')
                ->get();
            $type = \DB::table('type')->get();

        } else {
            $tables = \DB::table('company')->get();
            $type = \DB::table('type')->get();
            return view('companies', compact('tables', 'type'));
        }
        return view('companies', compact('tables', 'type'));
    }

    public function filter_beer(Request $request){
        $types = $request->input('type');
        $type = \DB::table('type')->get();
        $companies = $request->input('company');
        $company = \DB::table('company')->get();

        if($types == -1 && $companies == -1){
            $tables = \DB::table('beer')
                ->join('company', 'beer.idCompany', '=', 'company.idCompany')
                ->join('type', 'beer.idType', '=', 'type.idType')
                ->select('beer.*', 'company.name as companyName', 'type.name as typeName')
                ->get();
            return view('index', compact('tables', 'company', 'type'));

        } elseif ($types != -1 && $companies != -1){
            $tables = \DB::table('beer')
                ->join('company', 'beer.idCompany', '=', 'company.idCompany')
                ->join('type', 'beer.idType', '=', 'type.idType')
                ->select('beer.*', 'company.name as companyName', 'type.name as typeName')
                ->where([
                    ['beer.idType', '=', $types],
                    ['beer.idCompany', '=', $companies],
                ])
                ->get();
            return view('index', compact('tables', 'company', 'type'));
        } elseif($types == -1){
            $tables = \DB::table('beer')
                ->join('company', 'beer.idCompany', '=', 'company.idCompany')
                ->join('type', 'beer.idType', '=', 'type.idType')
                ->select('beer.*', 'company.name as companyName', 'type.name as typeName')
                ->where('beer.idCompany', '=', $companies)
                ->get();
            return view('index', compact('tables', 'company', 'type'));
        } else {
            $tables = \DB::table('beer')
                ->join('company', 'beer.idCompany', '=', 'company.idCompany')
                ->join('type', 'beer.idType', '=', 'type.idType')
                ->select('beer.*', 'company.name as companyName', 'type.name as typeName')
                ->where('beer.idType', '=', $types)
                ->get();
            return view('index', compact('tables', 'company', 'type'));
        }

    }

}
