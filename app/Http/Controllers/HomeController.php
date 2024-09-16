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

    public function home()
    {
        // Check if the user is authenticated and authorized
        if (Auth::check()) {

            $userId = Auth::id();
            $user= Auth::User();

            // Retrieve counts of various models
            $users = User::count();


        $employee = 0;
        $employee_doc = 0;
        $comp_docs_cout = 0;
        $company=0;

        $companies = Company::get();
        $company= $companies->count();

            if($user->user_type != 1){



                $employee=0;
                $employee_doc= 0;
                $comp_docs_cout= 0;
                foreach($companies as $comp){

                    $employee += Employee::where('employee_company', $comp->id)->count();
                    $employee_doc += EmployeeDoc::where('employee_company_id', $comp->id)->count();
                    $comp_docs_cout += CompanyDocs::where('company_id', $comp->id)->count();
                }

            }

            $renewed = DocumentHistory::where('status', 2)->count();

            $employee_doc_count = EmployeeDoc::where('doc_status', 2)->count();
            $company_doc_count = CompanyDocs::where('doc_status', 2)->count();

            $total_docs= $employee_doc + $comp_docs_cout;
            // Calculate percentages if totalDocs > 0

            if ($total_docs > 0) {
                $employeeDocsPercent = ($employee_doc / $total_docs) * 100;
                $companyDocsPercent = ($comp_docs_cout / $total_docs) * 100;
                $renewedDocsPercent = ($renewed / $total_docs) * 100;
            } else {
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

            // Prepare carousel items with user details
            $carouselItems = [];
            foreach ($userActivity as $userId => $count) {
                $user = User::find($userId);
                if ($user) {
                    $carouselItems[] = [
                        'user_id' => $userId,
                        'count' => $count,
                        'user_name' => $user->user_name,
                        'user_detail' => $user->user_detail, // Adjust field name as needed
                    ];
                }
            }

            // Variables for storing docs
            $emps = $comps = $docs = $allData = [];

            // If the user is an admin (user_type == 1), fetch the latest 10 records
            if (Auth::user()->user_type == 1) {
                $emps = Employee::latest()->take(10)->get();
                $comps = EmployeeDoc::latest()->take(10)->get();
                $docs = CompanyDocs::latest()->take(10)->get();
            } else {
                // For non-admin users, retrieve their companies and related docs
                $comps2 = Company::where('user_id', Auth::id())->latest()->get();
                foreach ($comps2 as $comp) {
                    // Get latest 10 EmployeeDocs for each company
                    $employeedoc = EmployeeDoc::where('employee_company_id', $comp->id)
                    ->whereNotNull('expiry_date') // Ensure expiry_date is not null
                    ->orderBy('expiry_date', 'asc') // Ascending order: closest expiry dates first
                    ->latest() // Maintain latest records ordering after expiry date ordering
                    ->take(15)
                    ->get();

                // Get latest 10 CompanyDocs for each company, ordered by closest expiry date
                $comp_docs = CompanyDocs::where('company_id', $comp->id)
                    ->whereNotNull('expiry_date') // Ensure expiry_date is not null
                    ->orderBy('expiry_date', 'asc') // Ascending order: closest expiry dates first
                    ->latest() // Maintain latest records ordering after expiry date ordering
                    ->take(15)
                    ->get();

                    $array = $comps2->toArray(); // Convert to array

                    // Print the array

                    // Store data in an array
                    $allData[] = [
                        'company2' => $comps2,
                        'employee_docs' => $employeedoc,
                        'company_docs' => $comp_docs,
                    ];
                }
            }

            // Pass the data to the view
            return view('dashboard.home', compact(
                'users', 'carouselItems', 'employee',
                'employee_doc', 'total_docs', 'comp_docs_cout',
                'company', 'renewed', 'employee_doc_count',
                'company_doc_count', 'employeeDocsPercent', 'allData',
                'companyDocsPercent', 'renewedDocsPercent', 'emps', 'comps', 'docs',
            ));
        } else {
            // If the user is not authorized, redirect to the login page with an error message
            return redirect()->route('login')->with('error', 'أنت غير مفوض للوصول إلى هذه الصفحة');
        }
    }



    public function show_expired_docs (){
        $user = Auth::user();

        // Check if the user_type is 1
        if ($user ) {
            // User has the correct type, so show the view
            return view('main_pages.expired_document');
        } else {
            // User does not have the correct type, redirect to the home page
            return redirect('/');
        }
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

                // Fetch all companies for the user
        $companies = Company::where('user_id', $userId)->pluck('id'); // Get only company IDs

        // Initialize an empty array for company documents
        $companyDocs = [];

        // Fetch all company_docs records where company_id is in the user's companies and expiry_date is within the range
        if ($companies->isNotEmpty()) {
            $companyDocs = CompanyDocs::whereIn('company_id', $companies)
                            ->whereBetween('expiry_date', [$today, $dateIn30Days])
                            ->get();
        }

        // Assuming $employeeDocs is defined somewhere above
        // Calculate total notifications by summing the count of both collections
        $total_noti = $companyDocs->count() + $employeeDocs->count();

        // Assign employee and company documents to variables
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

public function under_process()
{
    // Get the currently authenticated user
    $user = Auth::user();

    // Check if the user_type is 1
    if ($user) {
        // User has the correct type, so show the view
        return view('main_pages.under_process');
    } else {
        // User does not have the correct type, redirect to the home page
        return redirect('/');
    }
}



public function all_expired_docs2(Request $request)
{
    $sno=0;

    $today = date('Y-m-d');
    $userId = Auth::id(); // Get the current user ID
    $user = Auth::user();

    // Check if the user is an admin
    $isAdmin = $user->user_type == 1;
    // Initialize collections to store documents
    $companyDocs = collect();
    $employeeDocs = collect();

    if ($isAdmin) {
        // Admin can see all company documents with doc_status = 2
        $companyDocs = CompanyDocs::where('doc_status', 2)->get();
    } else {
        // Fetch companies related to the user
        $companies = Company::where('user_id', $userId)->get();

        foreach ($companies as $comp) {
            // Get employee documents for the current company where doc_status = 2
            $employeeDocsQuery = EmployeeDoc::where('doc_status', 2)->where('employee_company_id', $comp->id);
            $employeeDocs = $employeeDocs->merge($employeeDocsQuery->get());

            // Get company documents for the current company where doc_status = 2
            $companyDocsQuery = CompanyDocs::where('doc_status', 2)->where('company_id', $comp->id);
            $companyDocs = $companyDocs->merge($companyDocsQuery->get());
        }
    }

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


public function renewed_docs()
{
    // Get the currently authenticated user
    $user = Auth::user();

    // Check if the user_type is 1
    if ($user) {
        // User has the correct type, so show the view
        return view('main_pages.renewed_docs');
    } else {
        // User does not have the correct type, redirect to the home page
        return redirect('/');
    }
}



public function all_renewed_docs(Request $request)
{
    $sno=0;

    $today = date('Y-m-d');
    $userId = Auth::id(); // Get the current user ID
    $user = Auth::user();

    // Check if the user is an admin
    $isAdmin = $user->user_type == 1;
    // Initialize collections to store documents
    $companyDocs = collect();
    $employeeDocs = collect();
    $documents_renewed = collect();

    if ($isAdmin) {
        // Admin can see all company documents with doc_status = 2
        $documents_renewed = DocumentHistory::where('status', 2)->get();
    } else {
        // Fetch companies related to the user
        $companies = Company::where('user_id', $userId)->get();

        foreach ($companies as $comp) {

          $documents_renewed = DocumentHistory::where('status', 2)->where('company_id', $comp->id)->get();

        }
    }


    $emp_docs = $employeeDocs;
    $comp_docs = $companyDocs;
    $documents_renewed= $documents_renewed;

    if(count($documents_renewed)>0)
    {
        foreach($documents_renewed as $value)
        {

            $company_name = null;
            $employee_name = null;

            if ($value->company_id) {
                // If company_id is not null, fetch company name
                $company_name = Company::where('id', $value->company_id)->value('company_name');
            }

            if ($value->employee_id) {
                // If employee_id is not null, fetch employee name
                $employee_name = Employee::where('id', $value->employee_id)->value('employee_name');
            }

            $document_name='<p style="text-align:center;" href="javascript:void(0);">'.$value->doc_name.'</p>';


            $new_expiry = get_date_only($value->new_expiry);
            $old_expiry= get_date_only($value->old_expiry);


            $office_user = $value->added_by;

            $sanad_employee='<p style="text-align:center;" href="javascript:void(0);">'.$office_user.'</p>';

            $add_data=get_date_only($value->created_at);
            $add_date='<p style="white-space:pre-line; text-align:center;" href="javascript:void(0);">'. $add_data .'</p>';

            $sno++;
            $json[]= array(
                      '<span style="text-align: center; display: block;">' . $sno . '</span>',
                      $document_name,
                       $employee_name ?? $company_name,
                     '<span style="text-align: center; display: block;">' .  $new_expiry . '</span>',
                     '<span style="text-align: center; display: block;">' .  $old_expiry. '</span>',
                        '<span style="text-align: center; display: block;">' .  $value->added_by ?? '' . '</span>',
                        $add_date,
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


}




}
