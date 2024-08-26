<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Company;
use App\Models\Employee;
use App\Models\CompanyDocs;
use App\Models\EmployeeDoc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function employee_task_page(){

        $user= Auth::user();

        $user_type = '';
        if ($user->user_type == 1) {
            $user_type = 'Admin';
        } else {
            $user_type = 'Employee';
        }
        $branch= Branch::where('user_id', $user->id)->first();
        $branch_name= $branch->branch_name;
        $user_id= $user->id;
        $companies = Company::where('user_id', $user_id )->get();
        $employees = Employee::where('user_id', $user_id )->get();
        $company_count= $companies->count();

        return view ('main_pages.employee_task', compact('user', 'branch_name', 'user_type'));
    }

    // public function employee_task() {
    //     $user = Auth::user();
    //     $user_id = $user->id;

    //     // Get all companies and employees associated with the authenticated user
    //     $companies = Company::where('user_id', $user_id)->get();
    //     $employees = Employee::where('user_id', $user_id)->get();
    //     $company_count = $companies->count();

    //     // Initialize arrays to hold documents for each company and employee
    //     $company_documents = [];
    //     $employee_documents = [];

    //     // Loop through each company to get its documents
    //     foreach ($companies as $company) {
    //         $documents = CompanyDocs::where('company_id', $company->id)->get();
    //         $company_documents[$company->id] = $documents;
    //     }

    //     // Loop through each employee to get their documents
    //     foreach ($employees as $employee) {
    //         $documents = EmployeeDoc::where('employee_id', $employee->id)->get();
    //         $employee_documents[$employee->id] = $documents;
    //     }

    //     // Return the data as a JSON response
    //     return response()->json([
    //         'company_count' => $company_count,
    //         'companies' => $companies,
    //         'employees' => $employees,
    //         'company_documents' => $company_documents,
    //         'employee_documents' => $employee_documents,
    //     ]);
    // }

    public function employee_task() {
        $user = Auth::user();
        $user_id = $user->id;

        // Get all companies and employees associated with the authenticated user
        $companies = Company::where('user_id', $user_id)->get();
        $employees = Employee::where('user_id', $user_id)->get();
        $company_count = $companies->count();

        // Initialize arrays to hold documents for each company and employee
        $company_documents = [];
        $employee_documents = [];

        // Loop through each company to get its documents
        foreach ($companies as $company) {
            $documents = CompanyDocs::where('company_id', $company->id)->get();
            foreach ($documents as $doc) {
                $company_documents[$company->id][] = [
                    'id' => $doc->id,
                    'companydoc_name' => $doc->companydoc_name,
                    'status' => $doc->doc_status,
                    'expiry_date' => $doc->expiry_date,
                    'company_id' => $doc->company_id, // Add expiry date here
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
                    'status' => $doc->doc_status,
                    'employee_id' => $doc->employee_id,
                    'expiry_date' => $doc->expiry_date,  // Add expiry date here
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
        ]);
    }


    public function update_employee_doc(Request $request){


        $employeeId = $request->input('employee_id');

dd( $employeeId );
        $expiryDate = $request->input('expiry_date');
        $newExpiry = $request->input('new_expiry');
        $documentStatus = $request->input('doc_status');
        $doc_id = $request->input('document_id');



        // Update the EmployeeDoc table
        $employeeDoc = EmployeeDoc::where('id', $employeeId)->first();
        if ($employeeDoc) {
            $employeeDoc->expiry_date = $newExpiry; // Assuming there's a field for the new expiry date
            $employeeDoc->doc_status = $documentStatus;
            $employeeDoc->save();
        }

        // Update the CompanyDoc table if needed (add similar logic if updating CompanyDoc)
        // For example:
        // $companyDoc = CompanyDoc::where('id', $employeeId)->first();
        // if ($companyDoc) {
        //     $companyDoc->expiry_date = $expiryDate;
        //     $companyDoc->new_expiry_date = $newExpiry;
        //     $companyDoc->status = $documentStatus;
        //     $companyDoc->save();
        // }

        return response()->json(['message' => 'Document updated successfully']);



    }



}
