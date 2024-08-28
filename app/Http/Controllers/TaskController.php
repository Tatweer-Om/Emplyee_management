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

        // Check if the user exists and is either the intended user or an Admin
        $user_check = User::where('id', $id)->where(function($query) {
            $query->where('user_type', 1)->orWhere('id', Auth::id());
        })->first();

        // If the user is authorized, return the view with necessary data
        if($user_check) {
            return view('main_pages.employee_task', compact('user', 'branch_name', 'user_type', 'companies', 'employees', 'company_count'));
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
        ->where('doc_status', 1)
        ->get();
        $employee_docs_total = EmployeeDoc::where('user_id', $user_id)->get();
        $company_docs_total = CompanyDocs::where('user_id', $user_id)->get();

        $company_docs = CompanyDocs::where('user_id', $user_id) // Adjust the condition as needed
            ->where('doc_status', 1)
            ->get();

        $company_count = $companies->count();

        // Initialize arrays to hold documents for each company and employee
        $company_documents = [];
        $employee_documents = [];

        // Function to translate status values to human-readable strings
        function translateStatus($status) {
            switch ($status) {
                case 1:
                    return 'Under Process';
                case 2:
                    return 'Received';
                case 3:
                    return 'Some Issue';
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




    public function update_employee_doc(Request $request)
    {
        // Retrieve input data
        $employeeId = $request->input('employee_id');
        $renewl_note = $request->input('renewl_note');
        $oldExpiry = $request->input('expiry_date');
        $newExpiry = $request->input('new_expiry');
        $documentStatus = $request->input('doc_status');
        $docId = $request->input('document_id');
        $source = $request->input('source'); // Get the source (company or employee)

        $user_id = Auth::id();
        $data= User::find( $user_id)->first();
        $user= $data->user_name;

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Check the source and update the appropriate document
        if ($source === 'employee') {
            // Update the EmployeeDoc table
            $employeeDoc = EmployeeDoc::find($docId);
            if ($employeeDoc) {
                $employee = Employee::find($employeeDoc->employee_id);
                if (!$employee) {
                    return response()->json(['message' => 'Employee not found'], 404);
                }

                $company = Company::find($employee->employee_company);
                if (!$company) {
                    return response()->json(['message' => 'Company not found'], 404);
                }

                $employeeDoc->expiry_date = $newExpiry;
                $employeeDoc->doc_status = $documentStatus;
                $employeeDoc->save();

                // Create a new history record
                $history = new Employeedochistory();
                $history->employee_id = $employeeId;
                $history->company_id = $company->id;
                $history->employee_company = $company->company_name;
                $history->old_expiry_date = $oldExpiry;
                $history->new_expiry = $newExpiry;
                $history->renewl_note = $renewl_note;
                $history->doc_status = $documentStatus;
                $history->document_id = $docId;
                $history->added_by =  $user;
                $history->user_id =  $user_id;
                $history->save();
            } else {
                return response()->json(['message' => 'Employee document not found'], 404);
            }
        } elseif ($source === 'company') {
            // Update the CompanyDoc table
            $companyDoc = CompanyDocs::find($docId);
            if ($companyDoc) {
                $company = Company::find($companyDoc->company_id);
                if (!$company) {
                    return response()->json(['message' => 'Company not found'], 404);
                }

                $companyDoc->expiry_date = $newExpiry;
                $companyDoc->doc_status = $documentStatus;
                $companyDoc->save();

                // Create a new history record
                $history = new Companydochistory();
                $history->old_expiry_date = $oldExpiry;
                $history->new_expiry = $newExpiry;
                $history->company_id = $company->id;
                $history->employee_company = $company->company_name;
                $history->document_id = $docId;
                $history->renewl_note = $renewl_note;
                $history->doc_status = $documentStatus;
                $history->added_by =  $user;
                $history->user_id =  $user_id;
                $history->save();
            } else {
                return response()->json(['message' => 'Company document not found'], 404);
            }
        } else {
            return response()->json(['message' => 'Invalid document source'], 400);
        }

        return response()->json(['message' => 'Document updated successfully']);
    }



    // public function fetchCarouselData()
    // {
    //     // Fetch documents with their expiry date and other necessary details
    //     $employeeDocs = Employeedoc::select('id', 'employeedoc_name', 'expiry_date', 'status', 'employee_id')
    //         ->get()
    //         ->map(function($doc) {
    //             return [
    //                 'id' => $doc->id,
    //                 'name' => $doc->employeedoc_name,
    //                 'expiry_date' => $doc->expiry_date,
    //                 'status' => $doc->status,
    //                 'type' => 'employee',
    //                 'related_id' => $doc->employee_id
    //             ];
    //         });

    //     $companyDocs = Companydocs::select('id', 'companydoc_name', 'expiry_date', 'status', 'company_id')
    //         ->get()
    //         ->map(function($doc) {
    //             return [
    //                 'id' => $doc->id,
    //                 'name' => $doc->companydoc_name,
    //                 'expiry_date' => $doc->expiry_date,
    //                 'status' => $doc->status,
    //                 'type' => 'company',
    //                 'related_id' => $doc->company_id
    //             ];
    //         });

    //     $carouselItems = $employeeDocs->concat($companyDocs)
    //         ->sortBy('expiry_date'); // Optional: Sort by expiry date

    //     return response()->json(['carousel_items' => $carouselItems]);
    // }



}
