<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display listing of company
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::orderBy('id', 'desc')->paginate(5);
        return view('companies.index', compact('companies'));
    }

    /**
     * Display single company
     *
     * @param Company $company
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        return view('companies.show', compact('company'));
    }

    /**
     * Show the form for creating new company
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store the data
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
        ]);

        Company::create($request->post());

        return redirect()
            ->route('companies.index')
            ->with('success', 'Company has been created successfully.');
    }

    /**
     * Show the edit page for updating company data
     *
     * @param Company $company
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    /**
     * Update company data from our storage
     *
     * @param Request $request
     * @param Company $company
     *
     * @return \Illuminate\Http\Response
     */
    public function update(
        Request $request,
        Company $company
    ) {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
        ]);

        $company->fill($request->post())->save();

        return redirect()
            ->route('companies.index')
            ->with('success', 'Company Has Been updated successfully');
    }

    /**
     * Delete company from our storage
     *
     * @param Company $company
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()
            ->route('companies.index')
            ->with('success', 'Company has been deleted successfully');
    }
}