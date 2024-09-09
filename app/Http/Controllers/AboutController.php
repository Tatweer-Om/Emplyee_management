<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AboutController extends Controller
{
    public function index (){

        if (Auth::check() && Auth::user()->user_type == 1) {
            // If the conditions are met, show the dashboard
            return view('main_pages.about');
        } else {
            // If the conditions are not met, redirect to the login page with an Arabic error message
            return redirect()->route('login')->with('error', 'أنت غير مفوض للوصول إلى هذه الصفحة');
        }
    }

    public function show_about()
    {
        $sno=0;

        $view_about= About::all();
        if(count($view_about)>0)
        {
            foreach($view_about as $value)
            {

                $about_name='<p style="text-align:center;" href="javascript:void(0);">'.$value->about_name.'</p>';
                $about_phone='<p style="text-align:center;" href="javascript:void(0);">'.$value->about_phone.'</p>';
                $about_address='<p style="text-align:center;" href="javascript:void(0);">'.$value->about_address.'</p>';
                $about_detail='<p style="white-space:pre-line; text-align:justify;" href="javascript:void(0);">'.$value->about_detail.'</p>';


                $modal='<div class="dropdown" style="text-align:center";>
                        <button class="btn btn-link font-size-16 shadow-none py-0 text-muted dropdown-toggle"
                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bx bx-dots-horizontal-rounded"></i>
                        </button>
                     <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#about_modal" href="javascript:void(0);" onclick="edit(' . $value->id . ')">تعديل</a></li>
                        <li><a class="dropdown-item" href="javascript:void(0);" onclick="del(' . $value->id . ')">حذف</a></li>
                    </ul>

                    </div>';
                $add_data=get_date_only($value->created_at);
                $added_by='<p style="white-space:pre-line; text-align:center;" href="javascript:void(0);">'. $value->added_by . '<br>' . $add_data.'</p>';

                $sno++;
                $json[]= array(
                            $sno,

                            $about_name,
                            $about_address,
                            $about_phone,
                            $about_detail,
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

    public function add_about(Request $request) {
        $user = Auth::user();
        $username = $user ? $user->user_name : null;
        $user_id = $user ? $user->id : null;

        // Check if an 'About' record already exists for the current user
        $about = About::where('user_id', $user_id)->first();

        if ($about) {
            // If the record exists, update it
            $about->about_name = $request->input('about_name');
            $about->about_phone = $request->input('about_phone');
            $about->about_address = $request->input('about_address');
            $about->about_detail = $request->input('about_detail');
            $about->updated_by = $username;
        } else {
            // If the record does not exist, create a new one
            $about = new About();
            $about->about_id = genUuid() . time(); // Ensure genUuid() returns a valid UUID
            $about->about_name = $request->input('about_name');
            $about->about_phone = $request->input('about_phone');
            $about->about_address = $request->input('about_address');
            $about->about_detail = $request->input('about_detail');
            $about->added_by = $username;
            $about->user_id = $user_id;
        }

        $about->save();

        return response()->json([
            'about_id' => $about->about_id,
            'message' => trans('messages.about_save_success', [], session('locale'))
        ]);
    }


    public function edit_about(Request $request){

        // $about = new about();
        $about_id = $request->input('id');
        // Use the Eloquent where method to retrieve the about by column name
        $about_data = About::where('id', $about_id)->first();



        if (!$about_data) {
            return response()->json([trans('messages.error_lang', [], session('locale')) => trans('messages.about_not_found', [], session('locale'))], 404);
        }

        // Add more attributes as needed
        $data = [
            'about_id' => $about_data->about_id,
            'about_name' => $about_data->about_name,

            'about_phone' => $about_data->about_phone,
            'about_address' => $about_data->about_address,
            'about_detail' => $about_data->about_detail,


            // Add more attributes as needed
        ];

        return response()->json($data);
    }

    public function update_about(Request $request){
        $user = Auth::user();

        if ($user) {

            $username = $user->user_name;

            $user_id = $user->id;

        } else {
            $username = null;
            $user_id = null;
        }

        $about_id = $request->input('about_id');
        $about = About::where('about_id', $about_id)->first();
        if (!$about) {
            return response()->json([trans('messages.error_lang', [], session('locale')) => trans('messages.about_not_found', [], session('locale'))], 404);
        }

        $about->about_name = $request->input('about_name');

        $about->about_phone = $request->input('about_phone');
        $about->about_address = $request->input('about_address');
        $about->about_detail = $request->input('about_detail');

        $about->updated_by =  $username;
        $about->save();
        return response()->json([
            trans('messages.success_lang', [], session('locale')) => trans('messages.about_update_lang', [], session('locale'))
        ]);
    }

    public function delete_about(Request $request){


        $about_id = $request->input('id');


        $about = About::where('id', $about_id)->first();
        if (!$about) {
            return response()->json([trans('messages.error_lang', [], session('locale')) => trans('messages.about_not_found', [], session('locale'))], 404);
        }
        $about->delete();
        return response()->json([
            trans('messages.success_lang', [], session('locale')) => trans('messages.about_deleted_lang', [], session('locale'))
        ]);
    }
}
