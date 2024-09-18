<?php

namespace App\Http\Controllers;


use App\Models\CompanyDocs;
use Carbon\Carbon;
use App\Models\About;
use App\Models\Company;
use App\Models\DocumentHistory;
use App\Models\EmployeeDoc;
use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function employee_doc_report(Request $request)
    {
        $companies = Company::get();
        $about = About::first();
        $today=date('Y-m-d');
        // Default values to show all data if the form is not submitted

        $sdate = !empty($request['date_from']) ? $request['date_from'] : date('Y-m-d');
        $edate = !empty($request['to_date']) ? $request['to_date'] : date('Y-m-d');
        $company_id = $request->input('company_id');


        $employeeDocs = EmployeeDoc::whereDate('expiry_date', '>=', $sdate)
                ->whereDate('expiry_date', '<=', $edate);

        // Filter by company if a company is selected and it's not "All"
        if (!empty($company_id)) {
            $employeeDocs->where('employee_company_id', $company_id);
        }

        // Execute the query and get the results
        $employeeDocs = $employeeDocs->get();

        $report_name = 'Employee Doc Report';

        return view('reports.employee_doc_report', compact('companies', 'about', 'employeeDocs', 'sdate', 'edate', 'report_name', 'company_id'));
    }

    public function company_doc_report(Request $request)
    {
        $companies = Company::get();
        $about = About::first();

        $today=date('Y-m-d');

        $sdate = !empty($request['date_from']) ? $request['date_from'] : date('Y-m-d');
        $edate = !empty($request['to_date']) ? $request['to_date'] : date('Y-m-d');
        $company_id = $request->input('company_id');


        $companyDocs = CompanyDocs::whereDate('expiry_date', '>=', $sdate)
                ->whereDate('expiry_date', '<=', $edate);

        // Filter by company if a company is selected and it's not "All"
        if (!empty($company_id)) {
            $companyDocs->where('company_id', $company_id);
        }

        // Execute the query and get the results
        $companyDocs = $companyDocs->get();

        $report_name = 'Employee Doc Report';

        return view('reports.company_doc_report', compact('companies', 'about', 'companyDocs', 'sdate', 'edate', 'report_name', 'company_id'));
    }

    public function doc_expiry(Request $request){
        $about = About::first();
        $sdate = !empty($request['date_from']) ? $request['date_from'] : date('Y-m-d');
        $edate = !empty($request['to_date']) ? $request['to_date'] : date('Y-m-d');

        $today=date('Y-m-d');
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
        // $documents = $employeeDocs->merge($companyDocs)->sortBy('expiry_date');
        $report_name = 'Documnet Expiry Report';
        // Return the view with the combined data
        return view('reports.doc_expiry', compact('about','companyDocs','employeeDocs', 'sdate', 'edate','report_name'));
    }


    public function employee_task_report(Request $request)
    {
        // Get all users
        $users = User::get();


        $about = About::first();

        // Get today's date
        $today = date('Y-m-d');

        // Date range selection, defaults to today's date
        $sdate = !empty($request['date_from']) ? $request['date_from'] : $today;
        $edate = !empty($request['to_date']) ? $request['to_date'] : $today;

        // Get the selected user ID, or fallback to old input if available
        $user_id = $request->input('user_id') ?? old('user_id');

        // Fetch company documents filtered by user ID and date range
        $companyDocs = CompanyDocs::where('user_id', $user_id)
            ->whereDate('expiry_date', '>=', $sdate)
            ->whereDate('expiry_date', '<=', $edate)
            ->get();

        // Report name
        $report_name = 'Employee Task Report';

        // Return data to the view, passing the about object
        return view('reports.employee_task_report', compact('users', 'user_id', 'report_name', 'companyDocs', 'sdate', 'edate', 'about'));
    }



    public function task_complete(Request $request){

        $users = User::get();


        $about = About::first();

        // Get today's date
        $today = date('Y-m-d');

        // Date range selection, defaults to today's date
        $sdate = !empty($request['date_from']) ? $request['date_from'] : $today;
        $edate = !empty($request['to_date']) ? $request['to_date'] : $today;

        // Get the selected user ID, or fallback to old input if available
        $user_id = $request->input('user_id') ?? old('user_id');

        // Fetch company documents filtered by user ID and date range
        $tasks = DocumentHistory::where('user_id', $user_id)
            ->whereDate('created_at', '>=', $sdate)
            ->whereDate('created_at', '<=', $edate)
            ->get();

        // Report name
        $report_name = 'Employee Task COMPLETION Report';

        // Return data to the view, passing the about object
        return view('reports.task_completion_report', compact('users', 'user_id', 'report_name', 'tasks', 'sdate', 'edate', 'about'));

    }














}
