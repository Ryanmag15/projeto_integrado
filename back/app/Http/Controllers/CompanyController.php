<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Throw_;

class CompanyController extends Controller
{
    public function __construct() {}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::all();
        return response()->json($companies, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        try {
            $company = Company::create($request->all());
            return response()->json($company);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()],  $e->getCode() ?? 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $company = Company::findOrFail($id);
        return response()->json($company);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        try {
            $company = Company::findOrFail($id);
            $company->update($request->all());
            return response()->json($company);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()],  $e->getCode() ?? 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        try {
            Company::destroy($id);
            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()],  $e->getCode() ?? 500);
        }
    }
}
