<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index (){

        $users= User::all();
        return view ('main_pages.company', compact('users'));
    }

    public function show_company()
    {
        $sno=0;

        $view_company= Company::all();
        if(count($view_company)>0)
        {
            foreach($view_company as $value)
            {


                $office = User::where('id', $value->office_user)->first();
                $office_user = $office->user_name;

                $company_name='<a style="width:20px;" href="javascript:void(0);">'.$value->company_name.'</a>';
                $office_user='<p tyle="width:20px;" href="javascript:void(0);">'.$office_user.'</p>';
                $company_contact = '<p style="width:20px;" href="javascript:void(0);">' . $value->company_email . ' <br> ' . $value->company_phone . '</p>';

                $company_address='<p tyle="width:20px;" href="javascript:void(0);">'.$value->company_address.'</p>';
                $company_detail='<p style="white-space:pre-line; text-align:justify;" href="javascript:void(0);">'.$value->company_detail.'</p>';
                $cr_no='<p href="javascript:void(0);">'.$value->cr_no.'</p>';

                $modal='<div class="dropdown">
                        <button class="btn btn-link font-size-16 shadow-none py-0 text-muted dropdown-toggle"
                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bx bx-dots-horizontal-rounded"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#company_modal" href="javascript:void(0);" onclick="edit(' . $value->id . ')">Edit</a></li>
                            <li><a class="dropdown-item"  href="javascript:void(0);" onclick="printCompany(' . $value->company_id . ')">Print</a></li>
                            <li><a class="dropdown-item" href="' . url('document_addition/' . $value->id) . '">Add Document</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="del(' . $value->id . ')">Delete</a></li>
                        </ul>
                    </div>';
                $add_data=get_date_only($value->created_at);

                $sno++;
                $json[]= array(
                            $sno,
                            // '<img class="table_image" src="'.$img.'" alt="'.$value->company_name.'">',
                            $company_name . '<br>'. $company_address,
                            $company_contact,
                            $office_user,
                            $company_detail,
                            $cr_no,
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

    public function add_company(Request $request){

        // $user_id = Auth::id();
        // $data= User::find( $user_id)->first();
        // $user= $data->username;



        $company = new Company();

        $company->company_id = genUuid() . time();
        $company->company_name = $request['company_name'];
        $company->company_email = $request['company_email'];
        $company->company_phone = $request['company_phone'];
        $company->office_user = $request['office_user'];
        $company->company_address = $request['company_address'];
        $company->company_detail = $request['company_detail'];
        $company->cr_no = $request['cr_no'];
        $company->added_by = 'admin';
        $company->user_id = 1;
        $company->save();
        return response()->json(['company_id' => $company->company_id]);

    }

    public function edit_company(Request $request){

        // $company = new Company();
        $company_id = $request->input('id');



        // Use the Eloquent where method to retrieve the company by column name
        $company_data = Company::where('id', $company_id)->first();



        if (!$company_data) {
            return response()->json([trans('messages.error_lang', [], session('locale')) => trans('messages.company_not_found', [], session('locale'))], 404);
        }

        // Add more attributes as needed
        $data = [
            'company_id' => $company_data->company_id,
            'company_name' => $company_data->company_name,
            'company_email' => $company_data->company_email,
            'company_phone' => $company_data->company_phone,
            'office_user' => $company_data->office_user,
            'company_address' => $company_data->company_address,
            'company_detail' => $company_data->company_detail,
            'cr_no' => $company_data->cr_no,

            // Add more attributes as needed
        ];

        return response()->json($data);
    }

    public function update_company(Request $request){

        // $user_id = Auth::id();
        // $data= User::find( $user_id)->first();
        // $user= $data->username;

        $company_id = $request->input('company_id');
        $company = Company::where('company_id', $company_id)->first();
        if (!$company) {
            return response()->json([trans('messages.error_lang', [], session('locale')) => trans('messages.company_not_found', [], session('locale'))], 404);
        }

        $company->company_name = $request->input('company_name');
        $company->company_email = $request->input('company_email');
        $company->company_phone = $request->input('company_phone');
        $company->office_user = $request->input('office_user');
        $company->company_address = $request->input('company_address');
        $company->company_detail = $request->input('company_detail');
        $company->cr_no = $request->input('cr_no');
        $company->updated_by = 'Admin';
        $company->save();
        return response()->json([
            trans('messages.success_lang', [], session('locale')) => trans('messages.company_update_lang', [], session('locale'))
        ]);
    }

    public function delete_company(Request $request){
        $company_id = $request->input('id');
        $company = Company::where('id', $company_id)->first();
        if (!$company) {
            return response()->json([trans('messages.error_lang', [], session('locale')) => trans('messages.company_not_found', [], session('locale'))], 404);
        }
        $company->delete();
        return response()->json([
            trans('messages.success_lang', [], session('locale')) => trans('messages.company_deleted_lang', [], session('locale'))
        ]);
    }
}
