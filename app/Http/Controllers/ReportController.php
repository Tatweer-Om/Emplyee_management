<?php

namespace App\Http\Controllers;

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

        dd( $sdate);
        $edate = $request->input('date_to') ?? '';
        $company_id = $request->input('company_id') ?? 'all';

        // Build the query
        $query = EmployeeDoc::query();

        // Filter by expiration date if dates are provided
        if ($sdate) {
            $query->where('expiry_date', '>=', $sdate);
        }
        if ($edate) {
            $query->where('expiry_date', '<=', $edate);
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




}
