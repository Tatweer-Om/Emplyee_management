<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\About;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){

       $branches = Branch::all();


            if (Auth::check() && Auth::user()->user_type == 1) {
                // If the conditions are met, show the dashboard
                return view('user.users', compact('branches'));
            } else {
                // If the conditions are not met, redirect to the login page with an Arabic error message
                return redirect()->route('login')->with('error', 'أنت غير مفوض للوصول إلى هذه الصفحة');
            }


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
                $user_email='<p style="width:20px;" href="javascript:void(0);">'.$value->user_email.'</p>';

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
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="del(' . $value->id . ')">Delete</a></li>
                        </ul>
                    </div>';
                $add_data=get_date_only($value->created_at);

                $sno++;
                $json[]= array(
                            $sno,
                            $user_name,
                            $user_phone,
                            $user_email,
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

        $user_id = Auth::id();
        $data= User::find( $user_id)->first();
        $user= $data->user_name;

        $users = new User();

        $users->user_id = genUuid() . time();
        $users->user_name = $request['user_name'];
        $users->user_phone = $request['user_phone'];
        $users->user_email = $request['user_email'];
        $users->user_type = $request['user_type'];
        $users->user_detail = $request['user_detail'];
        $users->user_branch = $request['user_branch'];
        $users->user_all =  $userAll;
        $users->password = bcrypt($request['password']);
        $users->added_by = $user;

        $users->save();
        return response()->json(['user_id' => $users->id]);

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
            'user_email' => $user_data->user_email,
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

        $user_id2 = Auth::id();
        $data= User::find( $user_id2)->first();
        $user2= $data->user_name;

        $user_id = $request->input('user_id');
        $user = User::where('user_id', $user_id)->first();
        if (!$user) {
            return response()->json([trans('messages.error_lang', [], session('locale')) => trans('messages.user_not_found', [], session('locale'))], 404);
        }

        $user->user_name = $request->input('user_name');
        $user->user_phone = $request->input('user_phone');
        $user->user_email = $request->input('user_email');
        $user->user_type= $request->input('user_type');
        $user->user_detail= $request->input('user_detail');
        $user->user_all= $request->input('user_all');
        $user->user_branch= $request->input('user_branch');
        $user->password = bcrypt($request->input('password'));
        $user->updated_by = $user2;
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


        public function login(){

            $about= About::first();

            return view ('login_page.login', compact('about'));
        }


        public function login_user(Request $request)
        {
            // Retrieve input credentials
            $username = $request->input('username');
            $password = $request->input('password');

            // Attempt to find the user by username
            $user = User::where('user_name', $username)->first();
            if ($user && Hash::check($password, $user->password)) {

                Auth::login($user);
                // Authentication successful
                return response()->json([
                    'status' => 1,
                    'message' => 'Login successful!',
                    'redirect_url' => url('/')
                    // You can add more data here if needed, like a redirect URL
                ]);
            } else {
                // Authentication failed
                return response()->json([
                    'status' => 2,
                    'message' => 'Invalid username or password.',
                ]);
            }
        }




}




