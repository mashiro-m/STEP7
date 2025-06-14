<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::all();
        return view('companies.index', compact('companies'));
    }

    public function create()
    {
        return view('companies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'street_address' => 'required|string|max:255',
            'representative_name' => 'required|string|max:255',
        ]);

        Company::create($request->only([
            'company_name',
            'street_address',
            'representative_name',
        ]));

        return redirect()->route('companies.index');
    }

    public function show(Company $company)
    {
        return view('companies.show', compact('company'));
    }

    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    public function update(Request $request, Company $company)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'street_address' => 'required|string|max:255',
            'representative_name' => 'required|string|max:255',
        ]);

        $company->update($request->only([
            'company_name',
            'street_address',
            'representative_name',
        ]));

        return redirect()->route('companies.index');
    }

    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->route('companies.index');
    }
}
