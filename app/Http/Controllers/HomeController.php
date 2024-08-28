<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;
use App\Models\Document;
use App\Models\Employee;
use App\Models\EmployeeDoc;
use App\Models\CompanyDocs;
use App\Models\DocumentHistory;
use App\Models\User;
class HomeController extends Controller
{


    public function home()
    {
        if (Auth::check() && Auth::user()->user_type == 1) {
            // If the user is authenticated, show the dashboard
            return view('dashboard.home');
        } else {
            // If the user is not authenticated, redirect to the login page with an Arabic error message
            return redirect()->route('login')->with('error', 'أنت غير مفوض للوصول إلى هذه الصفحة');
        }
    }



    public function calender (){

        return view ('main_pages.calender');
    }




    public function company_detail (){

        return view ('main_pages.company_detail');
    }

    public function timeline (){

        return view ('main_pages.timeline');
    }

    public function email (){

        return view ('main_pages.email');
    }

    public function show_expired_docs (){

        return view ('main_pages.expired_document');
    }
    public function all_expired_docs(Request $request)
    {
        $sno=0;
        // Get today's date
        $today = date('Y-m-d');

        // Get the date 30 days from now
        $dateIn30Days = date('Y-m-d', strtotime('+30 days'));

        // Example user ID to filter by
        $userId = Auth::id(); // Get the current user ID
        $user_type = Auth::user()->user_type; // Get the user type

        // For employee_docs table
        $employeeDocsQuery = EmployeeDoc::whereBetween('expiry_date', [$today, $dateIn30Days]);

        // If the user type is not 1, filter by user_id
        if ($user_type != 1) {
            $employeeDocsQuery->where('user_id', $userId);
        }

        // Fetch the employee_docs records
        $employeeDocs = $employeeDocsQuery->get();

        // For company_docs table
        $companyDocsQuery = CompanyDocs::whereBetween('expiry_date', [$today, $dateIn30Days]);

        // If the user type is not 1, filter by user_id
        if ($user_type != 1) {
            $companyDocsQuery->where('user_id', $userId);
        }

        // Fetch the company_docs records
        $companyDocs = $companyDocsQuery->get();

        // Calculate total notifications
        $total_noti = $companyDocs->count() + $employeeDocs->count();
        $emp_docs = $employeeDocs;
        $comp_docs = $companyDocs;
        
        if(count($comp_docs)>0)
        {
            foreach($comp_docs as $value)
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
                $modal='<a class="btn btn-success" href="javascript:void(0);" onclick=renew_docs("' . $value->id . '","1")>Renew</a></li>';
                if($value->doc_status==2)
                {
                    $modal='<a class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#renew_modal" href="javascript:void(0);" onclick=finish_renew("' . $value->id . '","1")>Finish Renew</a></li>';
                }
                $add_data=get_date_only($value->created_at);
                $add_date='<p style="white-space:pre-line; text-align:center;" href="javascript:void(0);">'. $add_data .'</p>';

                $sno++;
                $json[]= array(
                          '<span style="text-align: center; display: block;">' . $sno . '</span>',
                            $value->company_name,
                            "",
                            $value->added_by,
                            $document_name,
                            $expiry_date,
                            '<span style="text-align: center; display: block;">' . $renewl_period . '</span>',
                            $add_date, 
                            $modal,
                            'DT_RowAttr' => array('data-status' => $value->doc_status)
                        );
            }
            // $response = array();
            // $response['success'] = true;
            // $response['aaData'] = $json;
            // echo json_encode($response);
        }
        if(count($emp_docs)>0)
        {
            foreach($emp_docs as $value)
            {

                $document_name='<p style="text-align:center;" href="javascript:void(0);">'.$value->employeedoc_name.'</p>';


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
                $modal='<a class="btn btn-success" href="javascript:void(0);" onclick=renew_docs("' . $value->id . '","2")>Renew</a></li>';
                if($value->doc_status==2)
                {
                    $modal='<a class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#renew_modal" href="javascript:void(0);" onclick=finish_renew("' . $value->id . '","2")>Finish Renew</a></li>';
                }
                $add_data=get_date_only($value->created_at);
                $add_date='<p style="white-space:pre-line; text-align:center;" href="javascript:void(0);">'. $add_data .'</p>';

                $employee = Employee::where('id', $value->employee_id)->first();
                $company = Company::where('id', $employee->employee_company)->first();

                $sno++;
                $json[]= array(
                          '<span style="text-align: center; display: block;">' . $sno . '</span>',
                            $company->company_name,
                            $value->employee_name,
                            $value->added_by,
                            $document_name,
                            $expiry_date,
                            '<span style="text-align: center; display: block;">' . $renewl_period . '</span>',
                            $add_date, 
                            $modal,
                            'DT_RowAttr' => array('data-status' => $value->doc_status)
                        );
            }
            // $response = array();
            // $response['success'] = true;
            // $response['aaData'] = $json;
            // echo json_encode($response);
        }
       
        if(!empty($json))
        {
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
        // 
        
    }
    public function renew_docs_request(Request $request){
        $doc_id = $request->input('id');
        $type = $request->input('type');
        if($type==1)
        {
            $company_doc = CompanyDocs::where('id', $doc_id)->first();
            if (!empty($company_doc)) { 
                $company_doc->doc_status = 2;
                $company_doc->save();
            }
        }
        else{
            $employee_doc = EmployeeDoc::where('id', $doc_id)->first();
            if (!empty($employee_doc)) { 
                $employee_doc->doc_status = 2;
                $employee_doc->save();
            }
        }
       
    }

    public function update_employee_doc(Request $request){
        $user_id = Auth::id();
        $data= User::find( $user_id)->first();
        $user= $data->user_name;

        $docs_id = $request->input('docs_id');
        $docs_type = $request->input('docs_type');
        $new_expiry = $request->input('new_expiry');
        $doc_name = $request->input('doc_name');  
        $renewl_note = $request->input('renewl_note');  



        // Update the EmployeeDoc table
        if($docs_type==1)
        {
            $companyDoc = companyDocs::where('id', $docs_id)->first();
            if (!empty($companyDoc)) {
                $old_expiry= $companyDoc->expiry_date;
                $companyDoc->expiry_date = $new_expiry; // Assuming there's a field for the new expiry date
                $companyDoc->doc_status = "";
                $companyDoc->companydoc_name = $doc_name;
                $companyDoc->save();

                // history
                $document = new DocumentHistory();

                $document->document_id = $docs_id;
                $document->company_id = $companyDoc->company_id;
                $document->doc_type = $docs_type;
                $document->status = 2;
                $document->old_expiry = $old_expiry;
                $document->new_expiry = $request['new_expiry'];
                $document->doc_name = $request['doc_name'];
                $document->notes = $request['renewl_note'];
                $document->added_by = $user;
                $document->user_id = $user_id;
                $document->save();
            }

        }
        else
        {
            
            $employeeDoc = EmployeeDoc::where('id', $docs_id)->first();
            if (!empty($employeeDoc)) {
                $old_expiry= $employeeDoc->expiry_date;
                $employeeDoc->expiry_date = $new_expiry; // Assuming there's a field for the new expiry date
                $employeeDoc->doc_status = "";
                $employeeDoc->employeedoc_name = $doc_name;
                $employeeDoc->save();

                // history
                $document = new DocumentHistory();

                $document->document_id = $docs_id;
                $document->employee_id = $employeeDoc->employee_id;
                $document->doc_type = $docs_type;
                $document->status = 2;
                $document->old_expiry = $old_expiry;
                $document->new_expiry = $request['new_expiry'];
                $document->doc_name = $request['doc_name'];
                $document->notes = $request['renewl_note'];
                $document->added_by = $user;
                $document->user_id = $user_id;
                $document->save();
            }
        }
        



    }
}
