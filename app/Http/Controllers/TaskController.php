<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Branch;
use App\Models\Company;
use App\Models\Employee;
use App\Models\CompanyDocs;
use App\Models\EmployeeDoc;
use Illuminate\Http\Request;
use App\Models\Companydochistory;
use App\Models\DocumentHistory;
use App\Models\Employeedochistory;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function employee_task_page($id) {
        // Get the authenticated user
        $user = Auth::user();

        // Determine user type
        $user_type = $user->user_type == 1 ? 'Admin' : 'Employee';

        // Fetch the user's branch (ensure the branch exists)
        $branch = Branch::where('user_id', $user->id)->first();
        $branch_name = $branch ? $branch->branch_name : 'No Branch';

        // Fetch companies and employees related to the user
        $companies = Company::where('user_id', $user->id)->get();
        $employees = Employee::where('user_id', $user->id)->get();
        $company_count = $companies->count();
        $comps = Company::get();



        // Check if the user exists and is either the intended user or an Admin
        $user_check = User::where('id', $id)->where(function($query) {
            $query->where('user_type', 1)->orWhere('id', Auth::id());
        })->first();

        // If the user is authorized, return the view with necessary data
        if($user_check) {
            return view('main_pages.employee_task', compact('user', 'branch_name', 'user_type', 'companies',
             'comps', 'employees', 'company_count'));
        } else {
            // Redirect to login with an error message if unauthorized
            return redirect()->route('login')->with('error', 'أنت غير مفوض للوصول إلى هذه الصفحة');
        }
    }




    public function employee_task() {
        $user = Auth::user();
        $user_id = $user->id;


        // Get all companies and employees associated with the authenticated user
        $companies = Company::where('user_id', $user_id)->get();
        $employees = Employee::where('user_id', $user_id)->get();

        $employee_docs = EmployeeDoc::where('user_id', $user_id)
        ->where('doc_status', 2)
        ->get();
        $employee_docs_total = EmployeeDoc::where('user_id', $user_id)->get();
        $company_docs_total = CompanyDocs::where('user_id', $user_id)->get();

        $company_docs = CompanyDocs::where('user_id', $user_id) // Adjust the condition as needed
            ->where('doc_status', 2)
            ->get();

        $company_count = $companies->count();

        // Initialize arrays to hold documents for each company and employee
        $company_documents = [];
        $employee_documents = [];

        // Function to translate status values to human-readable strings
        function translateStatus($status) {
            switch ($status) {
                case 1:
                    return 'None';
                case 2:
                    return 'Under Process';

                default:
                    return null; // Fallback for unexpected status values
            }
        }

        // Loop through each company to get its documents
        foreach ($companies as $company) {
            $documents = CompanyDocs::where('company_id', $company->id)->get();
            foreach ($documents as $doc) {
                $company_documents[$company->id][] = [
                    'id' => $doc->id,
                    'companydoc_name' => $doc->companydoc_name,
                    'status' => translateStatus($doc->doc_status), // Translate status here
                    'expiry_date' => $doc->expiry_date,
                    'company_id' => $doc->company_id,
                ];
            }
        }

        // Loop through each employee to get their documents
        foreach ($employees as $employee) {
            $documents = EmployeeDoc::where('employee_id', $employee->id)->get();
            foreach ($documents as $doc) {
                $employee_documents[$employee->id][] = [
                    'id' => $doc->id,
                    'employeedoc_name' => $doc->employeedoc_name,
                    'status' => translateStatus($doc->doc_status), // Translate status here
                    'employee_id' => $doc->employee_id,
                    'expiry_date' => $doc->expiry_date,
                ];
            }
        }

        // Return the data as a JSON response
        return response()->json([
            'company_count' => $company_count,
            'companies' => $companies,
            'employees' => $employees,
            'company_documents' => $company_documents,
            'employee_documents' => $employee_documents,
            'employee_docs' => $employee_docs,
            'company_docs' => $company_docs,
            'employee_docs_total'=>$employee_docs_total,
            'company_docs_total'=>$company_docs_total,
        ]);
    }




    public function document_history(Request $request)
    {
        $documentId = $request->input('id');  // Retrieve the document ID
        $source = $request->input('source');  // Retrieve the source

        // Initialize the query with the document ID
        $query = DocumentHistory::where('document_id', $documentId);

        // Apply the filter based on the source
        if ($source == 'employee') {
            $query->where('employee_id', '!=', null);  // Filter by non-null employee_id
        } else {
            $query->where('company_id', '!=', null);  // Filter by non-null company_id
        }

        // Execute the query and get the results
        $history = $query->get();

        // Return the history data as a JSON response
        return response()->json([
            'success' => true,
            'data' => $history
        ]);
    }
}
