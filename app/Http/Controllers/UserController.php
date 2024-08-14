<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Branch;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){

       $branches = Branch::all();
            return view('user.users', compact('branches'));


    }





    public function show_user()
    {
        $sno=0;

        $view_user= User::all();
        if(count($view_user)>0)
        {
            foreach($view_user as $value)
            {


                $branch_check = Branch::where('id', $value->user_branch)->first();
                $branch = $branch_check->branch_name ?? '';


                $user_name='<a style="width:20px;" href="javascript:void(0);">'.$value->user_name.'</a>';

                $user_phone='<p style="width:20px;" href="javascript:void(0);">'.$value->user_phone.'</p>';

                $user_type = '<p style="width:20px;" href="javascript:void(0);">' . ($value->user_type == 1 ? 'Admin' : 'User') . '</p>';
                $user_detail='<p style="white-space:pre-line; text-align:justify;" href="javascript:void(0);">'.$value->user_detail.'</p>';
                $user_all = '<p style="width:20px;" href="javascript:void(0);">' . ($value->user_all ? 'All Branches' :  $branch) . '</p>';


                $modal='<div class="dropdown">
                        <button class="btn btn-link font-size-16 shadow-none py-0 text-muted dropdown-toggle"
                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bx bx-dots-horizontal-rounded"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#user_modal" href="javascript:void(0);" onclick="edit(' . $value->id . ')">Edit</a></li>
                            <li><a class="dropdown-item"  href="javascript:void(0);" onclick="printuser(' . $value->user_id . ')">Print</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="del(' . $value->id . ')">Delete</a></li>
                        </ul>
                    </div>';
                $add_data=get_date_only($value->created_at);

                $sno++;
                $json[]= array(
                            $sno,
                            $user_name,
                            $user_phone,
                            $user_detail,
                            $user_type . '<br>' . $user_all,
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

    public function add_user(Request $request){


        $userAll = $request->has('user_all');



        $user = new User();

        $user->user_id = genUuid() . time();
        $user->user_name = $request['user_name'];
        $user->user_phone = $request['user_phone'];
        $user->user_type = $request['user_type'];
        $user->user_detail = $request['user_detail'];
        $user->user_branch = $request['user_branch'];
        $user->user_all =  $userAll;
        $user->password = bcrypt($request['password']);
        $user->added_by = 'user';

        $user->save();
        return response()->json(['user_id' => $user->id]);

    }

    public function edit_user(Request $request){

        $user_id = $request->input('id');

        // Use the Eloquent where method to retrieve the user by column name
        $user_data = User::where('id', $user_id)->first();

        if (!$user_data) {
            return response()->json(['error' => 'user Not Found'], 404);
        }

        // Add more attributes as needed
        $data = [
            'user_id' => $user_data->user_id,
            'user_name' => $user_data->user_name,
            'user_phone' => $user_data->user_phone,
            'user_type' => $user_data->user_type,
            'user_detail' => $user_data->user_detail,
            'user_all' => $user_data->user_all,
            'user_branch' => $user_data->user_branch,
            'password' => $user_data->password,


            // Add more attributes as needed
        ];

        return response()->json($data);
    }

    public function update_user(Request $request){



        $user_id = $request->input('user_id');
        $user = User::where('user_id', $user_id)->first();
        if (!$user) {
            return response()->json([trans('messages.error_lang', [], session('locale')) => trans('messages.user_not_found', [], session('locale'))], 404);
        }

        $user->user_name = $request->input('user_name');
        $user->user_phone = $request->input('user_phone');
        $user->user_type= $request->input('user_type');
        $user->user_detail= $request->input('user_detail');
        $user->user_all= $request->input('user_all');
        $user->user_branch= $request->input('user_branch');
        $user->password = bcrypt($request->input('password'));
        $user->updated_by = 'user';
        $user->save();
        return response()->json([
            'success'=> 'user Updated Successfully'
        ]);
    }

    public function delete_user(Request $request){
        $user_id = $request->input('id');
        $user = User::where('user_id', $user_id)->first();
        if (!$user) {
            return response()->json([trans('messages.error_lang', [], session('locale')) => trans('messages.user_not_found', [], session('locale'))], 404);
        }
        $user->delete();
        return response()->json([
            'success'=> 'user Deleted Successfully'
        ]);
    }






        public function logout()
        {
            Auth::logout();
            return redirect('/')->with('success', 'You Are Logged Out');
        }


}
