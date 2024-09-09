<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Company;
use App\Models\Document;
use App\Models\Employee;
use App\Models\CompanyDocs;
use App\Models\EmployeeDoc;
use Illuminate\Http\Request;
use App\Models\DocumentHistory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{


    // public function home()
    // {
    //     // Check if the user is authenticated and is of user_type 1 (admin or authorized user)
    //     if (Auth::check() && Auth::user()->user_type == 1) {
    //         // Retrieve counts of various models
    //         $users = User::count();
    //         $employee = Employee::count();
    //         $employee_doc = EmployeeDoc::count();

    //         $comp_docs = CompanyDocs::count();
    //         $company = Company::count();
    //         $renewed = DocumentHistory::where('status', 2)->count();

    //         $employee_doc = EmployeeDoc::count();
    //         $comp_docs = CompanyDocs::count();
    //         $employee_doc_count = EmployeeDoc::where('doc_status', 2)->count();
    //         $company_doc_count = CompanyDocs::where('doc_status', 2)->count();


    //         $total_docs= $employee_doc+$comp_docs;

    //         $companyCounts = DB::table('companies')
    //         ->select('user_id', DB::raw('count(*) as count'))
    //         ->groupBy('user_id')
    //         ->get();

    //     $employeeCounts = DB::table('employees')
    //         ->select('user_id', DB::raw('count(*) as count'))
    //         ->groupBy('user_id')
    //         ->get();

    //     $companyDocsCounts = DB::table('company_docs')
    //         ->select('user_id', DB::raw('count(*) as count'))
    //         ->groupBy('user_id')
    //         ->get();

    //     $employeeDocsCounts = DB::table('employee_docs')
    //         ->select('user_id', DB::raw('count(*) as count'))
    //         ->groupBy('user_id')
    //         ->get();

    //     // Merge all counts and sum by user_id
    //     $userActivity = collect()
    //         ->merge($companyCounts)
    //         ->merge($employeeCounts)
    //         ->merge($companyDocsCounts)
    //         ->merge($employeeDocsCounts)
    //         ->mapToGroups(function ($item) {
    //             return [$item->user_id => $item->count];
    //         })
    //         ->map(function ($group) {
    //             return $group->sum();
    //         })
    //         ->sortDesc()
    //         ->take(8);  // Limit to the top 8 users

    //     // Fetch user details and prepare data for the view
    //     $carouselItems = [];
    //     foreach ($userActivity as $userId => $count) {
    //         $user = User::find($userId); // Use find() to get the user by ID
    //         if ($user) { // Ensure user exists
    //             $carouselItems[] = [
    //                 'user_id' => $userId,
    //                 'count' => $count,
    //                 'user_name' => $user->user_name, // Adjust field name as needed
    //             ];
    //         }
    //     }


    //         // Pass the data to the view
    //         return view('dashboard.home', compact('users', 'carouselItems', 'employee',
    //         'employee_doc', 'total_docs', 'comp_docs', 'company', 'renewed',
    //         'employee_doc_count', 'company_doc_count'));
    //     } else {
    //         // If the user is not authorized, redirect to the login page with an error message
    //         return redirect()->route('login')->with('error', 'أنت غير مفوض للوصول إلى هذه الصفحة');
    //     }
    // }

    public function home()
{
    // Check if the user is authenticated and authorized
    if (Auth::check() && Auth::user()->user_type == 1) {
        // Retrieve counts of various models
        $users = User::count();
        $employee = Employee::count();
        $employee_doc = EmployeeDoc::count();
        $comp_docs = CompanyDocs::count();
        $company = Company::count();
        $renewed = DocumentHistory::where('status', 2)->count();



        $employee_doc_count = EmployeeDoc::where('doc_status', 2)->count();
        $company_doc_count = CompanyDocs::where('doc_status', 2)->count();

        $totalDocs = $employee_doc + $comp_docs + $renewed;
        $total_docs = $employee_doc + $comp_docs;

        if ($totalDocs > 0) {
            $employeeDocsPercent = ($employee_doc / $totalDocs) * 100;
            $companyDocsPercent = ($comp_docs / $totalDocs) * 100;
            $renewedDocsPercent = ($renewed / $totalDocs) * 100;
        } else {
            // Handle the case where totalDocs is 0
            $employeeDocsPercent = 0;
            $companyDocsPercent = 0;
            $renewedDocsPercent = 0;
        }
        // Get counts per user_id from various tables
        $companyCounts = DB::table('companies')
            ->select('user_id', DB::raw('count(*) as count'))
            ->groupBy('user_id')
            ->get()
            ->keyBy('user_id');

        $employeeCounts = DB::table('employees')
            ->select('user_id', DB::raw('count(*) as count'))
            ->groupBy('user_id')
            ->get()
            ->keyBy('user_id');

        $companyDocsCounts = DB::table('company_docs')
            ->select('user_id', DB::raw('count(*) as count'))
            ->groupBy('user_id')
            ->get()
            ->keyBy('user_id');

        $employeeDocsCounts = DB::table('employee_docs')
            ->select('user_id', DB::raw('count(*) as count'))
            ->groupBy('user_id')
            ->get()
            ->keyBy('user_id');

        // Merge all counts and sum by user_id
        $userActivity = collect()
            ->merge($companyCounts)
            ->merge($employeeCounts)
            ->merge($companyDocsCounts)
            ->merge($employeeDocsCounts)
            ->mapToGroups(function ($item, $key) {
                return [$key => $item->count];
            })
            ->map(function ($group) {
                return $group->sum();
            })
            ->sortDesc()
            ->take(8);  // Limit to the top 8 users

        // Fetch user details and prepare data for the view
        $carouselItems = [];
        foreach ($userActivity as $userId => $count) {
            $user = User::find($userId); // Use find() to get the user by ID
            if ($user) { // Ensure user exists
                $carouselItems[] = [
                    'user_id' => $userId,
                    'count' => $count,
                    'user_name' => $user->user_name,
                    'user_detail'=>$user->user_detail, // Adjust field name as needed
                ];
            }
        }

        $emps = Employee::latest()->take(10)->get();
        $comps = EmployeeDoc::latest()->take(10)->get();
        $docs = CompanyDocs::latest()->take(10)->get();


        // Pass the data to the view
        return view('dashboard.home', compact(
            'users', 'carouselItems', 'employee',
            'employee_doc', 'total_docs', 'comp_docs',
            'company', 'renewed', 'employee_doc_count',
            'company_doc_count', 'employeeDocsPercent', 'companyDocsPercent', 'renewedDocsPercent', 'emps', 'comps', 'docs',
        ));
    } else {
        // If the user is not authorized, redirect to the login page with an error message
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
                $modal='<a class="btn btn-success" href="javascript:void(0);" onclick=renew_docs("' . $value->id . '","1")>تجديد</a></li>';
                if($value->doc_status==2)
                {
                    $modal='<a class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#renew_modal" href="javascript:void(0);" onclick=finish_renew("' . $value->id . '","1")>إنهاء التجديد </a></li>';
                }
                $add_data=get_date_only($value->created_at);
                $add_date='<p style="white-space:pre-line; text-align:center;" href="javascript:void(0);">'. $add_data .'</p>';

                $sno++;
                $json[]= array(
                          '<span style="text-align: center; display: block;">' . $sno . '</span>',
                            $value->company_name,
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
                $modal='<a class="btn btn-success" href="javascript:void(0);" onclick=renew_docs("' . $value->id . '","2")>تجديد</a></li>';
                if($value->doc_status==2)
                {
                    $modal='<a class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#renew_modal" href="javascript:void(0);" onclick=finish_renew("' . $value->id . '","2")> إنهاء التجديد</a></li>';
                }
                $add_data=get_date_only($value->created_at);
                $add_date='<p style="white-space:pre-line; text-align:center;" href="javascript:void(0);">'. $add_data .'</p>';

                $employee = Employee::where('id', $value->employee_id)->first();
                $company = Company::where('id', $employee->employee_company)->first();

                $sno++;
                $json[]= array(
                          '<span style="text-align: center; display: block;">' . $sno . '</span>',

                            $value->employee_name .'<br>'.$company->company_name,
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

        $docs_type = $request->input('docs_type');
        $docs_id = $request->input('docs_id');

        $new_expiry = $request->input('new_expiry');
        $renewl_note = $request->input('renewl_note');



        // Update the EmployeeDoc table
        if($docs_type==1)
        {
            $companyDoc = companyDocs::where('id', $docs_id)->first();
            if (!empty($companyDoc)) {
                $old_expiry= $companyDoc->expiry_date;
                $companyDoc->expiry_date = $new_expiry; // Assuming there's a field for the new expiry date
                $companyDoc->doc_status = "";
                $companyDoc->companydoc_name = $companyDoc->companydoc_name;
                $companyDoc->save();

                // history
                $document = new DocumentHistory();

                $document->document_id = $docs_id;
                $document->company_id = $companyDoc->company_id;
                $document->doc_type = $docs_type;
                $document->status = 2;
                $document->old_expiry = $old_expiry;
                $document->new_expiry = $request['new_expiry'];
                $document->doc_name = $companyDoc->companydoc_name;
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
                $employeeDoc->employeedoc_name = $employeeDoc->employeedoc_name;
                $employeeDoc->save();

                // history
                $document = new DocumentHistory();

                $document->document_id = $docs_id;
                $document->employee_id = $employeeDoc->employee_id;
                $document->doc_type = $docs_type;
                $document->status = 2;
                $document->old_expiry = $old_expiry;
                $document->new_expiry = $request['new_expiry'];
                $document->doc_name = $employeeDoc->employeedoc_name;
                $document->notes = $request['renewl_note'];
                $document->added_by = $user;
                $document->user_id = $user_id;
                $document->save();
            }
        }




    }


//under_process

public function under_process (){

    return view ('main_pages.under_process');
}
public function all_expired_docs2(Request $request)
{
    $sno=0;

    $today = date('Y-m-d');
    $userId = Auth::id(); // Get the current user ID
    $user_type = Auth::user()->user_type; // Get the user type
    $employeeDocsQuery = EmployeeDoc::where('doc_status', 2);

    if ($user_type != 1) {
        $employeeDocsQuery->where('user_id', $userId);
    }

    $employeeDocs = $employeeDocsQuery->get();
    $companyDocsQuery = CompanyDocs::where('doc_status', 2);

    if ($user_type != 1) {
        $companyDocsQuery->where('user_id', $userId);
    }

    $companyDocs = $companyDocsQuery->get();

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
                $badgeClass = $totalDaysRemaining < 60 ? 'badge badge-soft-danger font-size-15' : 'badge badge-soft-success font-size-15';

                $renewl_period = '<p style="text-align:center;">' . $timeLeft . '</p>'
                    . '<br>'
                    . '<span class="' . $badgeClass . '" >' . $totalDaysRemaining . ' يوم متبقي</span>';
            }

                $expiry_date='<p style="text-align:center;" href="javascript:void(0);">'.$value->expiry_date.'</p>';


            $office_user = $value->added_by;

            $sanad_employee='<p style="text-align:center;" href="javascript:void(0);">'.$office_user.'</p>';
            $modal = '<a class="btn btn-success" href="javascript:void(0);" onclick="renew_docs2(\'' . $value->id . '\', \'1\')">تجديد</a>';
            if($value->doc_status==2)
            {
                $modal = '<a class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#renew_modal" href="javascript:void(0);" onclick="finish_renew(\'' . $value->id . '\', \'1\')">إنهاء التجديد</a>';
            }
            $add_data=get_date_only($value->created_at);
            $add_date='<p style="white-space:pre-line; text-align:center;" href="javascript:void(0);">'. $add_data .'</p>';

            $sno++;
            $json[]= array(
                      '<span style="text-align: center; display: block;">' . $sno . '</span>',
                        $value->company_name ?? '',
                        '<span style="text-align: center; display: block;">' .  $value->added_by ?? '' . '</span>',
                        $document_name,
                        $expiry_date,
                        // '<span style="text-align: center; display: block;">' . $renewl_period . '</span>',
                        $add_date,
                        $modal,
                        'DT_RowAttr' => array('data-status' => $value->doc_status)
                    );
        }

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
            $modal='<a class="btn btn-success" href="javascript:void(0);" onclick=renew_docs("' . $value->id . '","2")>تجديد</a></li>';
            if($value->doc_status==2)
            {
                $modal='<a class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#renew_modal" href="javascript:void(0);" onclick=finish_renew("' . $value->id . '","2")>إنهاء التجديد</a></li>';
            }
            $add_data=get_date_only($value->created_at);
            $add_date='<p style="white-space:pre-line; text-align:center;" href="javascript:void(0);">'. $add_data .'</p>';

            $employee = Employee::where('id', $value->employee_id)->first();
            // $company = Company::where('id', $employee->employee_company)->first();

            $sno++;
            $json[]= array(
                '<span style="text-align: center; display: block;">' . $sno . '</span>',
                ($value ? ($value->employee_name ?? '') . '<br>' . ($value->employee_company ?? '') : ''),

                '<span style="text-align: center; display: block;">' .  $value->added_by ?? '' . '</span>',
                $document_name ?? '',
                $expiry_date ?? '',
                $add_date ?? '',
                $modal ?? '',
                'DT_RowAttr' => array('data-status' => $value->doc_status)
            );


        }

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
public function renew_docs_request2(Request $request){
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

public function update_employee_doc2(Request $request){
    $user_id = Auth::id();
    $data= User::find( $user_id)->first();
    $user= $data->user_name;

    $docs_type = $request->input('docs_type');
    $docs_id = $request->input('docs_id');

    $new_expiry = $request->input('new_expiry');
    $renewl_note = $request->input('renewl_note');



    // Update the EmployeeDoc table
    if($docs_type==1)
    {
        $companyDoc = companyDocs::where('id', $docs_id)->first();
        if (!empty($companyDoc)) {
            $old_expiry= $companyDoc->expiry_date;
            $companyDoc->expiry_date = $new_expiry; // Assuming there's a field for the new expiry date
            $companyDoc->doc_status = "";
            $companyDoc->companydoc_name = $companyDoc->companydoc_name;
            $companyDoc->save();

            // history
            $document = new DocumentHistory();

            $document->document_id = $docs_id;
            $document->company_id = $companyDoc->company_id;
            $document->doc_type = $docs_type;
            $document->status = 2;
            $document->old_expiry = $old_expiry;
            $document->new_expiry = $request['new_expiry'];
            $document->doc_name = $companyDoc->companydoc_name;
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
            $employeeDoc->employeedoc_name = $employeeDoc->employeedoc_name;
            $employeeDoc->save();

            // history
            $document = new DocumentHistory();

            $document->document_id = $docs_id;
            $document->employee_id = $employeeDoc->employee_id;
            $document->doc_type = $docs_type;
            $document->status = 2;
            $document->old_expiry = $old_expiry;
            $document->new_expiry = $request['new_expiry'];
            $document->doc_name = $employeeDoc->employeedoc_name;
            $document->notes = $request['renewl_note'];
            $document->added_by = $user;
            $document->user_id = $user_id;
            $document->save();
        }
    }




}

}
