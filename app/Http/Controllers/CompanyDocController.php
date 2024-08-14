<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Company;
use App\Models\Document;
use App\Models\CompanyDocs;
use Illuminate\Http\Request;

class CompanyDocController extends Controller
{


    public function document_addition ($id){


        $company= Company::find($id)->first();
        $documents= Document::all();

        return view ('main_pages.add_document', compact('documents', 'company'));
    }

    public function show_doc()
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

                $sno++;
                $json[]= array(
                            $sno,

                            $document_name,
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

    public function add_doc(Request $request)
    {
        if (empty($request->companydoc_id)) {
            // Add new document
            $companydoc = new CompanyDocs();
            $companydoc->companydoc_id = genUuid() . time(); // Generate a new unique ID
            $companydoc->added_by = 'admin'; // Set added_by for new records
            $status = 1; // Status 1 for adding new record
        } else {
            // Update existing document
            $companydoc = CompanyDocs::where('companydoc_id', $request->companydoc_id)->first();

            if (!$companydoc) {
                return response()->json(['error' => 'Document not found'], 404);
            }

            $companydoc->updated_by = 'admin'; // Set updated_by for existing records
            $status = 2; // Status 2 for updating existing record
        }

        // Common fields for both add and update
        $companydoc->expiry_date = $request->expiry_date;
        $companydoc->all_document = $request->all_document;
        $companydoc->companydoc_name = $request->companydoc_name;
        $companydoc->company_id = $request->company_id;
        $companydoc->company_name = $request->company_name;
        $companydoc->office_user = $request->office_user;
        $companydoc->user_id = 1;

        // Save the document
        $companydoc->save();

        // Return the response
        return response()->json([
            'status' => $status,
            'companydoc_id' => $companydoc->companydoc_id,
            'companydoc_name' => $companydoc->companydoc_name,
            'expiry_date' => $companydoc->expiry_date,
            'all_document' => $companydoc->all_document,
            'company_name' => $companydoc->company_name,
            'office_user' => $companydoc->office_user,
            'added_at' => $companydoc->created_at->format('Y-m-d'), // Example of formatted date
        ]);
    }




    public function edit_doc(Request $request){

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
            'document_detail' => $document_data->document_detail,

            // Add more attributes as needed
        ];

        return response()->json($data);
    }

    public function update_doc(Request $request){

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

        $document->updated_by = 'Admin';
        $document->save();
        return response()->json([
            trans('messages.success_lang', [], session('locale')) => trans('messages.document_update_lang', [], session('locale'))
        ]);
    }

    public function delete_doc(Request $request){


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






    public function get_documents(Request $request)
    {
        $companydoc_id = $request->input('companydoc_id');

        // Check if the companydoc_id is provided
        if (!$companydoc_id) {
            return response()->json(['error' => 'No document ID provided'], 400);
        }

        // Fetch the document based on the ID
        $companydoc = CompanyDocs::where('companydoc_id', $companydoc_id)->first();

        // Check if the document was found
        if (!$companydoc) {
            return response()->json(['error' => 'Document not found'], 404);
        }

        // Return the document data
        return response()->json(['document' => $companydoc]);
    }





    public function getDocs()
    {
        $docs = CompanyDocs::all();

        // Create an array to hold the document data with remaining time
        $data = $docs->map(function($doc) {
            $expiryDate = Carbon::parse($doc->expiry_date);
            $currentDate = Carbon::now();
            $interval = $currentDate->diff($expiryDate);

            // Construct the remaining time string
            $remainingTime = [];
            if ($expiryDate->isFuture()) {
                if ($interval->y > 0) {
                    $remainingTime[] = $interval->y . ' year' . ($interval->y > 1 ? 's' : '');
                }
                if ($interval->m > 0) {
                    $remainingTime[] = $interval->m . ' month' . ($interval->m > 1 ? 's' : '');
                }
                if ($interval->d > 0) {
                    $remainingTime[] = $interval->d . ' day' . ($interval->d > 1 ? 's' : '');
                }
                if (empty($remainingTime)) {
                    $remainingTime[] = 'Less than a day';
                }
            } else {
                $remainingTime[] = 'Expired';
            }

            // Join the array to form the final string
            $remainingTimeString = implode(' ', $remainingTime);

            $user= User::where('id', $doc->office_user)->first();
            $user_name= $user->user_name;


            return [
                'id' => $doc->id,
                'companydoc_name' => $doc->companydoc_name,
                'expiry_date' => $doc->expiry_date,
                'remaining_time' => $remainingTimeString,
                'added_by' => $doc->added_by,
                'office_user' => $user_name,
            ];
        });

        return response()->json($data);
    }




public function deleteDoc($id)
{
    $doc = CompanyDocs::find($id);
    if ($doc) {
        $doc->delete();
        return response()->json(['message' => 'Document deleted successfully']);
    }
    return response()->json(['error' => 'Document not found'], 404);
}




}
