<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Http\Requests\CompanyRequest;

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

    public function store(CompanyRequest $request)
    {
        try {
            Company::create($request->validated());
            return redirect()->route('companies.index')->with('success', '会社を登録しました');
        } catch (\Exception $e) {
            return back()->with('error', '登録に失敗しました：' . $e->getMessage());
        }
    }

    public function show(Company $company)
    {
        return view('companies.show', compact('company'));
    }

    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    public function update(CompanyRequest $request, Company $company)
    {
        try {
            $company->update($request->validated());
            return redirect()->route('companies.index')->with('success', '会社情報を更新しました');
        } catch (\Exception $e) {
            return back()->with('error', '更新に失敗しました：' . $e->getMessage());
        }
    }

    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->route('companies.index')->with('success', '会社を削除しました');
    }
}
