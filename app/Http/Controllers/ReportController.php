<?php

namespace App\Http\Controllers;


use App\Models\CompanyDocs;
use Carbon\Carbon;
use App\Models\About;
use App\Models\Company;
use App\Models\EmployeeDoc;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function employee_doc_report(Request $request)
    {
        $companies = Company::get();
        $about = About::first();

        // Default values to show all data if the form is not submitted
        $sdate = $request->input('date_from') ?? '';


        $edate = $request->input('to_date') ?? '';
        $company_id = $request->input('company_id') ?? 'all';

        // Build the query
        $query = EmployeeDoc::query();

        // Filter by expiration date if dates are provided
        if ($sdate) {
            $query->whereDate('expiry_date', '>=', $sdate);
        }
        if ($edate) {
            $query->whereDate('expiry_date', '<=', $edate);
        }

        // Filter by company if a company is selected and it's not "All"
        if ($company_id !== 'all') {
            $query->where('employee_company_id', $company_id);
        }

        // Execute the query and get the results
        $employeeDocs = $query->get();
        $report_name = 'Employee Doc Report';

        return view('reports.employee_doc_report', compact('companies', 'about', 'employeeDocs', 'sdate', 'edate', 'report_name', 'company_id'));
    }

    public function company_doc_report(Request $request)
    {
        $companies = Company::get();
        $about = About::first();

        // Default values to show all data if the form is not submitted
        $sdate = $request->input('date_from') ?? '';


        $edate = $request->input('to_date') ?? '';
        $company_id = $request->input('company_id') ?? 'all';

        // Build the query
        $query = CompanyDocs::query();

        // Filter by expiration date if dates are provided
        if ($sdate) {
            $query->whereDate('expiry_date', '>=', $sdate);
        }
        if ($edate) {
            $query->whereDate('expiry_date', '<=', $edate);
        }

        // Filter by company if a company is selected and it's not "All"
        if ($company_id !== 'all') {
            $query->where('employee_company_id', $company_id);
        }

        // Execute the query and get the results
        $companyDocs = $query->get();
        $report_name = 'Employee Doc Report';

        return view('reports.company_doc_report', compact('companies', 'about', 'companyDocs', 'sdate', 'edate', 'report_name', 'company_id'));
    }

    public function doc_expiry(Request $request){

        $sdate = $request->input('date_from', date('Y-m-d'));
        $edate = $request->input('date_to', date('Y-m-d'));

        // Query EmployeeDoc table for documents within the date range
        $employeeDocs = EmployeeDoc::query()
            ->whereDate('expiry_date', '>=', $sdate)
            ->whereDate('expiry_date', '<=', $edate)
            ->get();

        // Query CompanyDoc table for documents within the date range
        $companyDocs = CompanyDocs::query()
            ->whereDate('expiry_date', '>=', $sdate)
            ->whereDate('expiry_date', '<=', $edate)
            ->get();

        // Combine the two collections
        $documents = $employeeDocs->merge($companyDocs)->sortBy('expiry_date');

        // Return the view with the combined data
        return view('reports.doc_expiry', compact('documents', 'sdate', 'edate'));
    }
















}
