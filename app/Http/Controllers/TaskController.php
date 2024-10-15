<?php

namespace App\Http\Controllers;

use App\Models\Approval;
use App\Models\User;
use App\Models\Leave;
use App\Models\Branch;
use App\Models\Company;
use App\Models\Employee;
use App\Models\CompanyDocs;
use App\Models\EmployeeDoc;
use Illuminate\Http\Request;
use App\Models\DocumentHistory;
use App\Models\Companydochistory;
use App\Models\Employeedochistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class TaskController extends Controller
{
    public function employee_task_page($id)
    {




        // Get the authenticated user
        $users = Auth::user();

        if (!$users) {
            return redirect()->route('login')->with('error', 'أنت غير مفوض للوصول إلى هذه الصفحة');
        }



        // Determine user type
        $user_type = $users->user_type == 1 ? 'Admin' : 'Employee';
        // Fetch the user's branch (ensure the branch exists)
        $user = User::where('id', $id)->first();

        $gained_holidays= $user->total_leaves - $user->remaining_leaves;

        $branch = Branch::where('user_id', $id)->first();
        $branch_name = $branch ? $branch->branch_name : 'No Branch';

        // Fetch companies and employees related to the authenticated user
        $companies = Company::where('user_id', $id)->get();
        $employees = Employee::where('user_id', $id)->get();
        $company_count = $companies->count();
        $comps = Company::all();

        // Allow Admin to view any user's profile, or allow non-admins to view only their own profile
        if ($users->user_type == 1 || $users->id == $id) {
            // Admin can see any user's profile, or user can see their own profile

           // Sum of durations for sick leaves
            $sick = Approval::where('employee_id', $id)
            ->where('approval_status', 1)
            ->where('leave_type', 1)
            ->sum('duration');

            // Sum of durations for yearly leaves
            $years = Approval::where('employee_id', $id)
            ->where('approval_status', 1)
            ->where('leave_type', 2)
            ->sum('duration');

            $total= $sick + $years;
            return view('main_pages.employee_task', compact(
                'user',
                'branch_name',
                'user_type',
                'sick',
                'years',
                'companies',
                'comps',
                'employees',
                'company_count',
                'total'

            ));
        } else {
            // Redirect to login with an error message if unauthorized
            return redirect()->route('login')->with('error', 'أنت غير مفوض للوصول إلى هذه الصفحة');
        }
    }







    public function employee_task(Request $request)
    {
        $user = Auth::user();
        $user_id = $user->id;
        $id = $request->input('emp_id');

        // Fetch companies based on the employee user ID
        $companies = Company::where('user_id', $id)->get();

        // Initialize variables
        $employees = collect(); // To store employees across all companies
        $employee_docs_total = collect(); // To store all employee docs
        $company_docs_total = collect(); // To store all company docs
        $renew_employee_documents = collect(); // To store employee docs where doc_status = 2
        $renew_company_documents = collect(); // To store company docs where doc_status = 2

        // Loop through each company to get employees and their documents
        foreach ($companies as $comp) {
            // Get employees for the current company
            $company_employees = Employee::where('employee_company', $comp->id)->get();
            $employees = $employees->merge($company_employees); // Add employees to the collection

            // Get employee documents for the current company where doc_status = 2
            $employee_docs = EmployeeDoc::where('employee_company_id', $comp->id)
                ->where('doc_status', 2)
                ->get();
            $renew_employee_documents = $renew_employee_documents->merge($employee_docs); // Add to the collection

            // Get total employee documents for the current company
            $employee_docs_total = $employee_docs_total->merge(
                EmployeeDoc::where('employee_company_id', $comp->id)->get()
            );

            // Get total company documents for the current company
            $company_docs_total = $company_docs_total->merge(
                CompanyDocs::where('company_id', $comp->id)->get()
            );

            // Get company documents where doc_status = 2
            $company_docs = CompanyDocs::where('company_id', $comp->id)
                ->where('doc_status', 2)
                ->get();
            $renew_company_documents = $renew_company_documents->merge($company_docs); // Add to the collection
        }

        // The rest of the code stays the same
        $company_count = $companies->count();

        $company_documents = [];
        foreach ($companies as $company) {
            $documents = CompanyDocs::where('company_id', $company->id)->orderBy('expiry_date', 'asc')->get();
            foreach ($documents as $doc) {
                $company_documents[$company->id][] = [
                    'id' => $doc->id,
                    'companydoc_name' => $doc->companydoc_name,
                    'status' => $doc->doc_status, // Translate status here
                    'expiry_date' => $doc->expiry_date,
                    'company_id' => $doc->company_id,
                ];
            }
        }

        $employee_documents = [];
        foreach ($employees as $employee) {
            $documents = EmployeeDoc::where('employee_id', $employee->id)->orderBy('expiry_date', 'asc')->get();
            foreach ($documents as $doc) {
                $employee_documents[$employee->id][] = [
                    'id' => $doc->id,
                    'employeedoc_name' => $doc->employeedoc_name,
                    'status' => $doc->doc_status, // Translate status here
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
            'employee_docs' => $renew_employee_documents,
            'company_docs' => $renew_company_documents,
            'employee_docs_total' => $employee_docs_total,
            'company_docs_total' => $company_docs_total,
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


    public function add_employee4(Request $request)
    {
        $user_id = Auth::id();
        $data = User::find($user_id)->first();
        $user = $data->user_name;




        $employee = new Employee();

        $employee->employee_id = genUuid() . time();
        $employee->employee_name = $request['employee_name'];
        $employee->employee_email = $request['employee_email'];
        $employee->employee_phone = $request['employee_phone'];
        $employee->employee_company = $request['comp_id'];
        $employee->employee_detail = $request['employee_detail'];
        $employee->added_by =  $user;
        $employee->user_id =  $user_id;
        $employee->save();
        $lastInsertedId = $employee->id;
        return response()->json(['employee_id' => $employee->employee_id, 'last_id' => $lastInsertedId]);
    }





    public function add_company4(Request $request)
    {

        $user_id = Auth::id();
        $data = User::find($user_id)->first();
        $user = $data->user_name;

        $company = new Company();

        $company->company_id = genUuid() . time();
        $company->company_name = $request['company_name'];
        $company->company_email = $request['company_email'];
        $company->company_phone = $request['company_phone'];
        $company->office_user = $request['office_user'];
        $company->company_address = $request['company_address'];
        $company->company_detail = $request['company_detail'];
        $company->cr_no = $request['cr_no'];
        $company->added_by = $user;
        $company->user_id = $user_id;
        $company->save();
        $lastInsertedId = $company->id;
        return response()->json(['company_id' => $company->company_id, 'last_id' => $lastInsertedId]);
    }


    public function document_renew(Request $request)
    {


        // Retrieve the document ID and source
        $documentId = $request->input('id');
        $source = $request->input('source');

        // Initialize document variable
        $doc = null;

        try {
            // Retrieve the document based on the source
            if ($source == '1') {
                $doc = EmployeeDoc::where('id', $documentId)->first();
            } elseif ($source == '2') {
                $doc = CompanyDocs::where('id', $documentId)->first();
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid source provided.'
                ], 400);
            }

            // Check if the document was found
            if (!$doc) {
                return response()->json([
                    'success' => false,
                    'message' => 'Document not found.'
                ], 404);
            }

            // Format the expiry date
            $expiryDate = $doc->expiry_date;
            $formattedExpiryDate = 'N/A'; // Default value

            if ($expiryDate) {
                try {
                    $formattedExpiryDate = (new \DateTime($expiryDate))->format('Y-m-d');
                } catch (\Exception $e) {
                    $formattedExpiryDate = 'Invalid date format';
                }
            }

            // Return the document data as a JSON response
            return response()->json([
                'success' => true,
                'data' => [
                    'expiry_date' => $formattedExpiryDate
                ]
            ]);
        } catch (\Exception $e) {
            // Handle unexpected errors
            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . $e->getMessage()
            ], 500);
        }
    }


    public function document_renew_confirm(Request $request)
    {
        // Validate the request data
        $request->validate([
            'id' => 'required|integer',
            'source' => 'required|string'
        ]);

        // Retrieve the document ID and source
        $docId = $request->input('id');
        $source = $request->input('source');

        // Initialize variable for document
        $doc = null;

        try {
            // Retrieve the document based on the source
            if ($source == '1') {
                $doc = EmployeeDoc::where('id', $docId)->first();
            } else {
                $doc = CompanyDocs::where('id', $docId)->first();
            }

            // Check if the document was found
            if ($doc) {
                // Update document status
                $doc->doc_status = '2'; // Update to the desired status
                $doc->save();

                // Return success response
                return response()->json(['success' => 'Document renewed successfully.']);
            } else {
                // Document not found
                return response()->json(['error' => 'Document not found.'], 404);
            }
        } catch (\Exception $e) {
            // Handle unexpected errors
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }


    public function add_leave(Request $request)
    {

        $user_id = Auth::id();
        $data = User::find($user_id)->first();
        $user = $data->user_name;


        $user_data = User::where('id', $request['user'])->first();
        $employee_name = $user_data->user_name ?? '';
        $employee_phone = $user_data->user_phone ?? '';
        $leave_type = $request['leave_type'];


        $user_leaves = $user_data->total_leaves ?? 0;

        $duration = $request['days'];
        $leaveu = Leave::where('user_id', $request['user'])->latest()->first();

        if ($leaveu === null) {

            $remaining_leave = $user_leaves;
        } else {

            $remaining_leave = $user_data->remaining_leaves ?? 0;
        }



        $duration = is_numeric($request['days']) ? $request['days'] : 0;
        $remaining_leave = is_numeric($remaining_leave) ? $remaining_leave : 0;

        if ($duration > $remaining_leave && $leave_type == 2) {
            return response(['status' => 3]);
        }


        $leave_image = "";
        if ($request->hasFile('leave_image')) {
            $folderPath = public_path('images/leave_images');

            if (!File::isDirectory($folderPath)) {
                File::makeDirectory($folderPath, 0777, true, true);
            }
            $leave_image = time() . '.' . $request->file('leave_image')->extension();
            $request->file('leave_image')->move(public_path('images/leave_images'), $leave_image);
        }


        $leave = new Leave();

        $leave->leave_type = $leave_type;
        $leave->employee_id = $request['user'];
        $leave->employee_name = $employee_name;
        $leave->employee_phone = $employee_phone;
        $leave->approval_status =  0;

        if( $leave->leave_type==1){
            $leave->total_leaves = $leaveu->total_leaves;
            $leave->remaining_leaves = $leaveu->remaining_leaves;
        }
        else{
            $leave->remaining_leaves = $remaining_leave;
            $leave->total_leaves = $user_leaves;
        }
        $leave->leave_image = $leave_image;
        $leave->start_date = $request['start_date'];
        $leave->end_date = $request['end_date'];
        $leave->duration = $duration;
        $leave->notes = $request['notes'];
        $leave->added_by = $user;
        $leave->user_id = $user_id;
        $saved = $leave->save();

        if ($saved) {

            $approve = new Approval();

            $approve->leave_id = $leave->id;
            $approve->leave_type = $leave->leave_type;
            $approve->employee_id =  $leave->employee_id;
            $approve->employee_name = $leave->employee_name;
            $approve->employee_phone =  $leave->employee_phone;
            if( $approve->leave_type==1){
                $approve->total_leaves = $leaveu->total_leaves;
                $approve->remaining_leaves = $leaveu->remaining_leaves;
            }
            else{
                $approve->remaining_leaves = $remaining_leave;
                $approve->total_leaves = $user_leaves;
            }
            $approve->start_date =  $leave->start_date;
            $approve->end_date =  $leave->end_date;
            $approve->attachment =  $leave->leave_image;
            $approve->duration =  $leave->duration;
            $approve->approval_status =  0;
            $approve->notes = $request['notes'];
            $approve->approved_by = null;
            $approve->approved_id = null;
            $approve->approved_at = null;
            $approve->added_by = $user;
            $approve->user_id = $user_id;
            $approve->save();
        }

        return response()->json(['leave_id' => $leave->leave_id]);
    }


}
