<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Company;
use App\Models\Document;
use App\Models\Employee;
use App\Models\EmployeeDoc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeDocController extends Controller
{
    public function employee_document_addition ($id){


        $employee= Employee::where('id', $id)->first();
        $company_id= $employee->employee_company;

        $company= Company::where('id',  $company_id )->first();
        $company_name= $company->company_name;

        $documents= Document::where('document_type', 2)->get();

        if (Auth::check() ) {
            // If the conditions are met, show the dashboard
            return view ('main_pages.add_employee_doc', compact('documents', 'employee', 'company_name'));
        } else {
            // If the conditions are not met, redirect to the login page with an Arabic error message
            return redirect()->route('login')->with('error', 'أنت غير مفوض للوصول إلى هذه الصفحة');
        }

    }

    public function show_employeedoc(Request $request)
    {
        $sno=0;
        $employee_id = $request->employee_id;

        $view_employee = EmployeeDoc::where('employee_id', $employee_id)->get();
        if(count($view_employee)>0)
        {
            foreach($view_employee as $value)
            {

                $document_name='<p style="text-align:center;" href="javascript:void(0);">'.$value->employeedoc_name.'</p>';
                $expiryDate = Carbon::parse($value->expiry_date);

                // Get the current date
                $today = Carbon::now();

                // Calculate the difference as exact integers
                $diffInYears = (int)$today->diffInYears($expiryDate);
                $diffInMonths = (int)$today->copy()->addYears($diffInYears)->diffInMonths($expiryDate);
                $diffInDays = (int)$today->copy()->addYears($diffInYears)->addMonths($diffInMonths)->diffInDays($expiryDate);

                // Calculate total days remaining
                $totalDaysRemaining = (int)$today->diffInDays($expiryDate);

                // Determine if expired
                if ($totalDaysRemaining < 1) {
                    $renewl_period = '<p style="text-align:center; color: red;">منتهي الصلاحية</p>';
                } else {
                    // Format the difference in Arabic
                    $yearsText = $diffInYears > 1 ? 'سنوات' : 'سنة';
                    $monthsText = $diffInMonths > 1 ? 'أشهر' : 'شهر';
                    $daysText = $diffInDays > 1 ? 'أيام' : 'يوم';

                    $timeLeft = "$diffInYears $yearsText, $diffInMonths $monthsText, $diffInDays $daysText";

                    // Determine badge color based on total days remaining
                    $badgeClass = $totalDaysRemaining < 60 ? 'badge badge-soft-danger font-size-15' : 'badge badge-soft-success font-size-15';

                    // Output the time left and total days remaining
                    $renewl_period = '<p style="text-align:center;">' . $timeLeft . '</p>'
                        . '<br>'
                        . '<span class="' . $badgeClass . '" >' . $totalDaysRemaining . ' يوم متبقي</span>';
                }
                $expiry_date='<p style="text-align:center;" href="javascript:void(0);">'.$value->expiry_date.'</p>';


                $office_user = $value->added_by;

                $sanad_employee='<p style="text-align:center;" href="javascript:void(0);">'.$office_user.'</p>';

                $modal='<div class="dropdown" style="text-align:center";>
                        <button class="btn btn-link font-size-16 shadow-none py-0 text-muted dropdown-toggle"
                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bx bx-dots-horizontal-rounded"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="edit_employeedoc(' . $value->id . ')">Edit</a></li>
                            <li><a class="dropdown-item"  href="javascript:void(0);" onclick="printemployee(' . $value->employee_id . ')">Print</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="del_employee_doc(' . $value->id . ')">Delete</a></li>
                        </ul>
                    </div>';
                $add_data=get_date_only($value->created_at);
                $added_by='<p style="white-space:pre-line; text-align:center;" href="javascript:void(0);">'. $value->added_by . '<br>' . $add_data.'</p>';

                $sno++;
                $json[]= array(
                          '<span style="text-align: center; display: block;">' . $sno . '</span>',
                            $document_name,
                            $expiry_date,

                            '<span style="text-align: center; display: block;">' .  $renewl_period . '</span>',
                            $added_by,
                            $sanad_employee,
                            $modal
                        );
            }
            $response = array();
            $response['success'] = true;
            $response['aaData'] = $json;
            echo json_encode($response);
        }
        else
        {
            $response = array();
            $response['sEcho'] = 0;
            $response['iTotalRecords'] = 0;
            $response['iTotalDisplayRecords'] = 0;
            $response['aaData'] = [];
            echo json_encode($response);
        }
    }

    public function add_employeedoc(Request $request)
    {

        $user_id = Auth::id();
        $data= User::find( $user_id)->first();
        $user= $data->user_name;
        if (empty($request->employeedoc_id)) {
            // Add new employee

            $employeedoc = new EmployeeDoc();
            $employeedoc->employeedoc_id = genUuid() . time(); // Generate a new unique ID
            $employeedoc->expiry_date = $request->expiry_date;
            $employeedoc->all_document = $request->all_document;
            $employeedoc->employeedoc_name = $request->employeedoc_name;
            $employeedoc->employee_id = $request->employee_id;
            $employeedoc->employee_name = $request->employee_name;
            $employeedoc->office_user = $request->office_user;
            $employeedoc->user_id = $user_id;
            $employeedoc->added_by = $user;

            $employeedoc->save();

            $status = 1;
        } else {

            $employeedoc = EmployeeDoc::where('id', $request->employeedoc_id)->first();

            if (!$employeedoc) {
                return response()->json(['error' => 'employee not found'], 404);
            }
            $employeedoc->expiry_date = $request->expiry_date;
            $employeedoc->all_document = $request->all_document;
            $employeedoc->employeedoc_name = $request->employeedoc_name;
            $employeedoc->employee_id = $request->employee_id;
            $employeedoc->employee_name = $request->employee_name;
            $employeedoc->updated_by = $user;
            $status = 2;
            $employeedoc->save();
        }



        // Return the response
        return response()->json([
            'status' => $status,
            'employeedoc_id' => $employeedoc->employeedoc_id,
            'employeedoc_name' => $employeedoc->employeedoc_name,
            'expiry_date' => $employeedoc->expiry_date,
            'all_employee' => $employeedoc->all_employee,
            'employee_name' => $employeedoc->employee_name,
            'office_user' => $employeedoc->office_user,
            'added_at' => $employeedoc->created_at->format('Y-m-d'), // Example of formatted date
        ]);
    }




    public function edit_employeedoc(Request $request){

        // $employee = new employee();
        $doc_id = $request->input('id');



        // Use the Eloquent where method to retrieve the employee by column name
        $employee_data = EmployeeDoc::where('id', $doc_id)->first();



        if (!$employee_data) {
            return response()->json([trans('error', [], session('locale')) => trans('messages.employee_not_found', [], session('locale'))], 404);
        }

        // Add more attributes as needed
        $data = [
            'employeedoc_name' => $employee_data->employeedoc_name,
            'id' => $employee_data->id,
            'all_document' => $employee_data->all_document,
            'expiry_date' => $employee_data->expiry_date,

            // Add more attributes as needed
        ];

        return response()->json($data);
    }



}
