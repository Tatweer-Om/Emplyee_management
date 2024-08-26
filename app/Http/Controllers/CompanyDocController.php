<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Company;
use App\Models\Document;
use Nette\Utils\DateTime;
use App\Models\CompanyDocs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyDocController extends Controller
{


    public function document_addition ($id){


        $company= Company::where('id', $id)->first();

        $documents= Document::where('document_type', 1)->get();
        if (Auth::check() ) {
            // If the conditions are met, show the dashboard
            return view ('main_pages.add_document', compact('documents', 'company'));
        } else {
            // If the conditions are not met, redirect to the login page with an Arabic error message
            return redirect()->route('login')->with('error', 'أنت غير مفوض للوصول إلى هذه الصفحة');
        }



    }

    public function show_doc(Request $request)
    {
        $sno=0;
        $company_id = $request->company_id;
        $view_document = CompanyDocs::where('company_id', $company_id)->get();
        if(count($view_document)>0)
        {
            foreach($view_document as $value)
            {

                $document_name='<p style="text-align:center;" href="javascript:void(0);">'.$value->companydoc_name.'</p>';


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
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="edit_company_doc(' . $value->id . ')">Edit</a></li>

                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="del_company_doc(' . $value->id . ')">Delete</a></li>
                        </ul>
                    </div>';
                $add_data=get_date_only($value->created_at);
                $add_date='<p style="white-space:pre-line; text-align:center;" href="javascript:void(0);">'. $add_data .'</p>';

                $sno++;
                $json[]= array(
                          '<span style="text-align: center; display: block;">' . $sno . '</span>',
                            $document_name,
                            $expiry_date,
                            '<span style="text-align: center; display: block;">' . $renewl_period . '</span>',
                            $add_date,
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

    public function add_doc(Request $request)

    {

        $user_id = Auth::id();
        $data= User::find( $user_id)->first();
        $user= $data->user_name;


        if (empty($request->companydoc_id)) {
            // Add new document

            $companydoc = new CompanyDocs();
            $companydoc->companydoc_id = genUuid() . time(); // Generate a new unique ID
            // Common fields for both add and update
            $companydoc->expiry_date = $request->expiry_date;
            $companydoc->all_document = $request->all_document;
            $companydoc->companydoc_name = $request->companydoc_name;
            $companydoc->company_id = $request->company_id;
            $companydoc->company_name = $request->company_name;
            $companydoc->office_user = $user;
            $companydoc->user_id = $user_id;
            $companydoc->added_by = $user; // Set added_by for new records
            // Save the document
            $companydoc->save();

            $status = 1; // Status 1 for adding new record
        } else {
            // Update existing document
            $companydoc = CompanyDocs::where('id', $request->companydoc_id)->first();

            if (!$companydoc) {
                return response()->json(['error' => 'Document not found'], 404);
            }
            $companydoc->expiry_date = $request->expiry_date;
            $companydoc->all_document = $request->all_document;
            $companydoc->companydoc_name = $request->companydoc_name;
            $companydoc->company_id = $request->company_id;
            $companydoc->company_name = $request->company_name;
            $companydoc->updated_by = $user; // Set updated_by for existing records
            $status = 2; // Status 2 for updating existing record
            $companydoc->save();
        }



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
        $document_data = CompanyDocs::where('id', $document_id)->first();



        if (!$document_data) {
            return response()->json([trans('messages.error_lang', [], session('locale')) => trans('messages.document_not_found', [], session('locale'))], 404);
        }

        // Add more attributes as needed
        $data = [
            'companydoc_name' => $document_data->companydoc_name,
            'id' => $document_data->id,
            'all_document' => $document_data->all_document,
            'expiry_date' => $document_data->expiry_date,

            // Add more attributes as needed
        ];

        return response()->json($data);
    }


    public function delete_doc(Request $request){
        $doc_id = $request->input('id');
        $company_doc = CompanyDocs::where('id', $doc_id)->first();
        if (!$company_doc) {
            return response()->json([trans('messages.error_lang', [], session('locale')) => trans('messages.company_not_found', [], session('locale'))], 404);
        }
        $company_doc->delete();
        return response()->json([
            trans('messages.success_lang', [], session('locale')) => trans('messages.company_deleted_lang', [], session('locale'))
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



}
