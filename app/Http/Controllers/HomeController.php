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
        $userId = Auth::id(); // Replace with the actual user ID

        // For employee_docs table
        $employeeDocs = EmployeeDoc::
            whereBetween('expiry_date', [$today, $dateIn30Days])
            ->where('user_id', $userId);

        // For company_docs table
        $companyDocs = CompanyDocs::
            whereBetween('expiry_date', [$today, $dateIn30Days])
            ->where('user_id', $userId);

        $total_noti = $companyDocs->count() + $employeeDocs->count();

        $emp_docs = $employeeDocs->get();
        $comp_docs = $companyDocs->get();
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

                $modal='<a class="btn btn-success" href="javascript:void(0);" onclick=edit_company_doc("' . $value->id . '","company")>Renew</a></li>';
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
                            $modal
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

                $modal='<a class="btn btn-success" href="javascript:void(0);" onclick=edit_company_doc("' . $value->id . '","employee")>Renew</a></li>';
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
                            $modal
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
    }
}
