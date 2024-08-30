<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class branchController extends Controller
{
    public function index (){

        if (Auth::check() && Auth::user()->user_type == 1) {
            // If the conditions are met, show the dashboard
            return view('user.branch');
        } else {
            // If the conditions are not met, redirect to the login page with an Arabic error message
            return redirect()->route('login')->with('error', 'أنت غير مفوض للوصول إلى هذه الصفحة');
        }
    }

    public function show_branch()
    {
        $sno=0;

        $view_branch= Branch::all();
        if(count($view_branch)>0)
        {
            foreach($view_branch as $value)
            {

                $branch_name='<p style="text-align:center;" href="javascript:void(0);">'.$value->branch_name.'</p>';
                $branch_phone='<p style="text-align:center;" href="javascript:void(0);">'.$value->branch_phone.'</p>';
                $branch_address='<p style="text-align:center;" href="javascript:void(0);">'.$value->branch_address.'</p>';
                $branch_detail='<p style="white-space:pre-line; text-align:justify;" href="javascript:void(0);">'.$value->branch_detail.'</p>';


                $modal='<div class="dropdown" style="text-align:center";>
                        <button class="btn btn-link font-size-16 shadow-none py-0 text-muted dropdown-toggle"
                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bx bx-dots-horizontal-rounded"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#branch_modal" href="javascript:void(0);" onclick="edit(' . $value->id . ')">Edit</a></li>

                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="del(' . $value->id . ')">Delete</a></li>
                        </ul>
                    </div>';
                $add_data=get_date_only($value->created_at);
                $added_by='<p style="white-space:pre-line; text-align:center;" href="javascript:void(0);">'. $value->added_by . '<br>' . $add_data.'</p>';

                $sno++;
                $json[]= array(
                            $sno,

                            $branch_name,
                            $branch_address,
                            $branch_phone,
                            $branch_detail,
                            $added_by,
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

    public function add_branch(Request $request){

        $user = Auth::user();

        if ($user) {

            $username = $user->user_name;

            $user_id = $user->id;

        } else {
            $username = null;
            $user_id = null;
        }





        $branch = new Branch();

        $branch->branch_id = genUuid() . time();
        $branch->branch_name = $request['branch_name'];

        $branch->branch_phone = $request['branch_phone'];
        $branch->branch_address = $request['branch_address'];
        $branch->branch_detail = $request['branch_detail'];

        $branch->added_by =  $username;
        $branch->user_id =  $user_id;
        $branch->save();
        return response()->json(['branch_id' => $branch->branch_id]);

    }

    public function edit_branch(Request $request){

        // $branch = new branch();
        $branch_id = $request->input('id');
        // Use the Eloquent where method to retrieve the branch by column name
        $branch_data = Branch::where('id', $branch_id)->first();



        if (!$branch_data) {
            return response()->json([trans('messages.error_lang', [], session('locale')) => trans('messages.branch_not_found', [], session('locale'))], 404);
        }

        // Add more attributes as needed
        $data = [
            'branch_id' => $branch_data->branch_id,
            'branch_name' => $branch_data->branch_name,

            'branch_phone' => $branch_data->branch_phone,
            'branch_address' => $branch_data->branch_address,
            'branch_detail' => $branch_data->branch_detail,


            // Add more attributes as needed
        ];

        return response()->json($data);
    }

    public function update_branch(Request $request){
        $user = Auth::user();

        if ($user) {

            $username = $user->user_name;

            $user_id = $user->id;

        } else {
            $username = null;
            $user_id = null;
        }

        $branch_id = $request->input('branch_id');
        $branch = Branch::where('branch_id', $branch_id)->first();
        if (!$branch) {
            return response()->json([trans('messages.error_lang', [], session('locale')) => trans('messages.branch_not_found', [], session('locale'))], 404);
        }

        $branch->branch_name = $request->input('branch_name');

        $branch->branch_phone = $request->input('branch_phone');
        $branch->branch_address = $request->input('branch_address');
        $branch->branch_detail = $request->input('branch_detail');

        $branch->updated_by =  $username;
        $branch->save();
        return response()->json([
            trans('messages.success_lang', [], session('locale')) => trans('messages.branch_update_lang', [], session('locale'))
        ]);
    }

    public function delete_branch(Request $request){


        $branch_id = $request->input('id');


        $branch = Branch::where('id', $branch_id)->first();
        if (!$branch) {
            return response()->json([trans('messages.error_lang', [], session('locale')) => trans('messages.branch_not_found', [], session('locale'))], 404);
        }
        $branch->delete();
        return response()->json([
            trans('messages.success_lang', [], session('locale')) => trans('messages.branch_deleted_lang', [], session('locale'))
        ]);
    }
}
