<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index (){

        return view ('main_pages.documents');
    }



    public function show_document()
    {
        $sno=0;

        $view_document= Document::all();
        if(count($view_document)>0)
        {
            foreach($view_document as $value)
            {



                $document_name='<p style="text-align:center;" href="javascript:void(0);">'.$value->document_name.'</p>';

                $document_detail='<p style="white-space:pre-line; text-align:justify;" href="javascript:void(0);">'.$value->document_detail.'</p>';


                $modal='<div class="dropdown" style="text-align:center";>
                        <button class="btn btn-link font-size-16 shadow-none py-0 text-muted dropdown-toggle"
                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bx bx-dots-horizontal-rounded"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#document_modal" href="javascript:void(0);" onclick="edit(' . $value->id . ')">Edit</a></li>
                            <li><a class="dropdown-item"  href="javascript:void(0);" onclick="printdocument(' . $value->document_id . ')">Print</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="del(' . $value->id . ')">Delete</a></li>
                        </ul>
                    </div>';
                $add_data=get_date_only($value->created_at);
                $added_by='<p style="white-space:pre-line; text-align:center;" href="javascript:void(0);">'. $value->added_by . '<br>' . $add_data.'</p>';
                if ($value->document_type == 1) {
                    $doc = 'Company Document';
                } else {
                    $doc = 'Employee Document';
                }
                $sno++;
                $json[]= array(
                            $sno,

                            $document_name,
                            $doc,
                            $document_detail,
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

    public function add_document(Request $request){

        // $user_id = Auth::id();
        // $data= User::find( $user_id)->first();
        // $user= $data->username;



        $document = new Document();

        $document->document_id = genUuid() . time();
        $document->document_name = $request['document_name'];
        $document->document_detail = $request['document_detail'];
        $document->document_type = $request['document_type'];
        $document->added_by = 'admin';
        $document->user_id = 1;
        $document->save();
        return response()->json(['document_id' => $document->document_id]);

    }

    public function edit_document(Request $request){

        // $document = new document();
        $document_id = $request->input('id');

        // Use the Eloquent where method to retrieve the document by column name
        $document_data = Document::where('id', $document_id)->first();



        if (!$document_data) {
            return response()->json([trans('messages.error_lang', [], session('locale')) => trans('messages.document_not_found', [], session('locale'))], 404);
        }

        // Add more attributes as needed
        $data = [
            'document_id' => $document_data->document_id,
            'document_name' => $document_data->document_name,
            'document_type' => $document_data->document_type,
            'document_detail' => $document_data->document_detail,

            // Add more attributes as needed
        ];

        return response()->json($data);
    }

    public function update_document(Request $request){

        // $user_id = Auth::id();
        // $data= User::find( $user_id)->first();
        // $user= $data->username;

        $document_id = $request->input('document_id');


        $document = Document::where('document_id', $document_id)->first();
        if (!$document) {
            return response()->json([trans('messages.error_lang', [], session('locale')) => trans('messages.document_not_found', [], session('locale'))], 404);
        }

        $document->document_name = $request->input('document_name');
        $document->document_detail = $request->input('document_detail');
        $document->document_type = $request->input('document_type');

        $document->updated_by = 'Admin';
        $document->save();
        return response()->json([
            trans('messages.success_lang', [], session('locale')) => trans('messages.document_update_lang', [], session('locale'))
        ]);
    }

    public function delete_document(Request $request){


        $document_id = $request->input('id');


        $document = Document::where('id', $document_id)->first();
        if (!$document) {
            return response()->json([trans('messages.error_lang', [], session('locale')) => trans('messages.document_not_found', [], session('locale'))], 404);
        }
        $document->delete();
        return response()->json([
            trans('messages.success_lang', [], session('locale')) => trans('messages.document_deleted_lang', [], session('locale'))
        ]);
    }


    //document_Addition



}
