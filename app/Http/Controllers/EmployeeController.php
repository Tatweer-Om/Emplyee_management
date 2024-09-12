<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public function index()
{
    // Retrieve all companies
    $companies = Company::all();

    // Check if the user is authenticated
    if (Auth::check()) {
        // Retrieve the currently authenticated user
        $user = Auth::user();

        // Check if the user type is 1
        if ($user->user_type == 1) {
            // If the user type matches, show the dashboard
            return view('main_pages.employee', compact('companies'));
        } else {
            // If the user type does not match, redirect to the login page with an error message
            return redirect()->route('home')->with('error', 'أنت غير مفوض للوصول إلى هذه الصفحة');
        }
    } else {
        // If the user is not authenticated, redirect to the login page with an error message
        return redirect()->route('home')->with('error', 'أنت غير مفوض للوصول إلى هذه الصفحة');
    }
}


    public function show_employee()
    {
        $sno=0;

        $view_employee= Employee::all();
        if(count($view_employee)>0)
        {
            foreach($view_employee as $value)
            {


                $company = Company::where('id', $value->employee_company)->first();
                $company_name = "";
                if (!empty($company)) {
                    $company_name = $company->company_name;
                }
                $employee_company = '<p style="width:20px;" href="javascript:void(0);">' . $company_name . '</p>';
                $employee_name='<a style="width:20px;" href="' . url('employee_document_addition/' . $value->id) . '">'.$value->employee_name.'</a>';
                $employee_contact = '<p style="width:20px;" href="javascript:void(0);">' . $value->employee_email . ' <br> ' . $value->employee_phone . '</p>';
                $employee_detail='<p style="white-space:pre-line; text-align:justify;" href="javascript:void(0);">'.$value->employee_detail.'</p>';
                $cr_no='<p href="javascript:void(0);">'.$value->cr_no.'</p>';

                $modal='<div class="dropdown">
                        <button class="btn btn-link font-size-16 shadow-none py-0 text-muted dropdown-toggle"
                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bx bx-dots-horizontal-rounded"></i>
                        </button>
                     <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="' . url('employee_document_addition/' . $value->id) . '">إضافة مستند</a></li>
                        <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#employee_modal" href="javascript:void(0);" onclick="edit(' . $value->id . ')">تعديل</a></li>
                        <li><a class="dropdown-item" href="javascript:void(0);" onclick="del(' . $value->id . ')">حذف</a></li>
                    </ul>

                    </div>';
                $add_data=get_date_only($value->created_at);

                $sno++;
                $json[]= array(
                            $sno,
                            // '<img class="table_image" src="'.$img.'" alt="'.$value->employee_name.'">',
                            $employee_name,
                            $employee_contact,
                            $employee_company,
                            $employee_detail,
                            $value->added_by . '<br>' . $add_data,
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

    public function add_employee(Request $request){

        $user_id = Auth::id();
        $data= User::find( $user_id)->first();
        $user= $data->user_name;


        $employee = new Employee();

        $employee->employee_id = genUuid() . time();
        $employee->employee_name = $request['employee_name'];
        $employee->employee_email = $request['employee_email'];
        $employee->employee_phone = $request['employee_phone'];
        $employee->employee_company = $request['employee_company'];
        $employee->employee_detail = $request['employee_detail'];
        $employee->added_by =  $user;
        $employee->user_id =  $user_id;
        $employee->save();
        $lastInsertedId = $employee->id;
        return response()->json(['employee_id' => $employee->employee_id,'last_id'=>$lastInsertedId]);

    }

    public function edit_employee(Request $request){

        // $employee = new employee();
        $employee_id = $request->input('id');



        // Use the Eloquent where method to retrieve the employee by column name
        $employee_data = Employee::where('id', $employee_id)->first();



        if (!$employee_data) {
            return response()->json([trans('messages.error_lang', [], session('locale')) => trans('messages.employee_not_found', [], session('locale'))], 404);
        }

        // Add more attributes as needed
        $data = [

            'employee_id' => $employee_data->employee_id,
            'employee_name' => $employee_data->employee_name,
            'employee_email' => $employee_data->employee_email,
            'employee_phone' => $employee_data->employee_phone,
            'employee_company' => $employee_data->employee_company,
            'employee_detail' => $employee_data->employee_detail,

            // Add more attributes as needed
        ];

        return response()->json($data);
    }

    public function update_employee(Request $request){

        $user_id = Auth::id();
        $data= User::find( $user_id)->first();
        $user= $data->user_name;

        $employee_id = $request->input('employee_id');
        $employee = Employee::where('employee_id', $employee_id)->first();
        if (!$employee) {
            return response()->json([trans('messages.error_lang', [], session('locale')) => trans('messages.employee_not_found', [], session('locale'))], 404);
        }

        $employee->employee_name = $request->input('employee_name');
        $employee->employee_email = $request->input('employee_email');
        $employee->employee_phone = $request->input('employee_phone');
        $employee->employee_company = $request->input('employee_company');
        $employee->employee_detail = $request->input('employee_detail');
        $employee->updated_by = $user;
        $employee->save();
        return response()->json([
            trans('messages.success_lang', [], session('locale')) => trans('messages.employee_update_lang', [], session('locale'))
            ,'last_id'=>$employee->id]);
    }

    public function delete_employee(Request $request){
        $employee_id = $request->input('id');
        $employee = Employee::where('id', $employee_id)->first();
        if (!$employee) {
            return response()->json([trans('messages.error_lang', [], session('locale')) => trans('messages.employee_not_found', [], session('locale'))], 404);
        }
        $employee->delete();
        return response()->json([
            trans('messages.success_lang', [], session('locale')) => trans('messages.employee_deleted_lang', [], session('locale'))
        ]);
    }
}
