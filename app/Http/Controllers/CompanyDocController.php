<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Company;
use App\Models\Document;
use Nette\Utils\DateTime;
use App\Models\CompanyDocs;
use Illuminate\Http\Request;

class CompanyDocController extends Controller
{


    public function document_addition ($id){


        $company= Company::where('id', $id)->first();

        $documents= Document::where('document_type', 1)->get();


        return view ('main_pages.add_document', compact('documents', 'company'));
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
                            <li><a class="dropdown-item"  href="javascript:void(0);" onclick="printdocument(' . $value->document_id . ')">Print</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="del_company_doc(' . $value->id . ')">Delete</a></li>
                        </ul>
                    </div>';
                $add_data=get_date_only($value->created_at);
                $added_by='<p style="white-space:pre-line; text-align:center;" href="javascript:void(0);">'. $value->added_by . '<br>' . $add_data.'</p>';

                $sno++;
                $json[]= array(
                          '<span style="text-align: center; display: block;">' . $sno . '</span>',
                            $document_name,
                            $expiry_date,
                            '<span style="text-align: center; display: block;">' . $renewl_period . '</span>',
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

    public function add_doc(Request $request)
    {
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
            $companydoc->office_user = $request->office_user;
            $companydoc->user_id = 1;
            $companydoc->added_by = 'admin'; // Set added_by for new records
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
            // $companydoc->all_document = $request->all_document;
            $companydoc->all_document = 2;
            $companydoc->companydoc_name = $request->companydoc_name;
            $companydoc->company_id = $request->company_id;
            $companydoc->company_name = $request->company_name;
            $companydoc->updated_by = 'admin'; // Set updated_by for existing records
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





    // public function getDocs(Request $request)
    // {
    //     $companyId = $request->input('company_id'); // Get the company ID from the request

    //     // Retrieve documents for the specific company ID
    //     $docs = CompanyDocs::where('company_id', $companyId)->get();

    //     // Create an array to hold the document data with remaining time
    //     $data = $docs->map(function($doc) {
    //         $expiryDate = Carbon::parse($doc->expiry_date);
    //         $currentDate = Carbon::now();
    //         $interval = $currentDate->diff($expiryDate);

    //         // Construct the remaining time string
    //         $remainingTime = [];
    //         if ($expiryDate->isFuture()) {
    //             if ($interval->y > 0) {
    //                 $remainingTime[] = $interval->y . ' year' . ($interval->y > 1 ? 's' : '');
    //             }
    //             if ($interval->m > 0) {
    //                 $remainingTime[] = $interval->m . ' month' . ($interval->m > 1 ? 's' : '');
    //             }
    //             if ($interval->d > 0) {
    //                 $remainingTime[] = $interval->d . ' day' . ($interval->d > 1 ? 's' : '');
    //             }
    //             if (empty($remainingTime)) {
    //                 $remainingTime[] = 'Less than a day';
    //             }
    //         } else {
    //             $remainingTime[] = 'Expired';
    //         }

    //         // Join the array to form the final string
    //         $remainingTimeString = implode(' ', $remainingTime);

    //         $user = User::find($doc->office_user); // Use find() for simplicity
    //         $userName = $user ? $user->user_name : 'Unknown'; // Handle case where user might not be found

    //         return [
    //             'id' => $doc->id,
    //             'companydoc_name' => $doc->companydoc_name,
    //             'expiry_date' => $doc->expiry_date,
    //             'remaining_time' => $remainingTimeString,
    //             'added_by' => $doc->added_by,
    //             'office_user' => $userName,
    //         ];
    //     });

    //     return response()->json($data);
    // }





// public function deleteDoc($id)
// {
//     $doc = CompanyDocs::where('id', $id)->first();

//     if ($doc) {
//         $doc->delete();
//         return response()->json(['message' => 'Document deleted successfully']);
//     }
//     return response()->json(['error' => 'Document not found'], 404);
// }




}
