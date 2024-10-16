<?php

namespace App\Http\Controllers;

use DateTime;
use App\Http\Controllers\Controller;
use App\Models\EmployeeDoc;
use App\Models\CompanyDocs;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendReminderEmail; // Use your mailable class

class CronJobController extends Controller
{
    public function getAndSendEmails()
    {

        $today = date('Y-m-d');
        // Get the date 30 days from now
        $dateIn30Days = date('Y-m-d', strtotime('+30 days'));
        // For employee_docs table
        $employeeDocsQuery = EmployeeDoc::whereBetween('expiry_date', [$today, $dateIn30Days]);
        $employeeDocs = $employeeDocsQuery->get();
        // For company_docs table
        $companyDocsQuery = CompanyDocs::whereBetween('expiry_date', [$today, $dateIn30Days]);
        $companyDocs = $companyDocsQuery->get();
        if(count($companyDocs)>0)
        {
            foreach($companyDocs as $cd)
            {
                $user_data = User::where('id', $cd->user_id)->first();
                // تحليل تاريخ انتهاء الصلاحية
                $expiryDate = new DateTime($cd->expiry_date);

                // الحصول على التاريخ الحالي
                $today = new DateTime();

                // حساب الفرق ككائن DateInterval
                $interval = $today->diff($expiryDate);

                // استخراج الفرق بالسنوات والشهور والأيام
                $diffInYears = (int)$interval->y;
                $diffInMonths = (int)$interval->m;
                $diffInDays = (int)$interval->d;

                // حساب إجمالي الأيام المتبقية
                $totalDaysRemaining = (int)$today->diff($expiryDate)->days;

                // تحديد إذا كان منتهي الصلاحية
                if ($totalDaysRemaining < 1) {
                    $renewl_period2 = $cd->companydoc_name.' of '.$cd->company_name.' is expired';
                } else {
                    // تنسيق الفرق باللغة العربية
                    $yearsText = $diffInYears > 1 ? 'سنوات' : 'سنة';
                    $monthsText = $diffInMonths > 1 ? 'أشهر' : 'شهر';
                    $daysText = $diffInDays > 1 ? 'أيام' : 'يوم';

                    $timeLeft = "$diffInYears $yearsText, $diffInMonths $monthsText, $diffInDays $daysText";

                    // تحديد لون الشارة بناءً على إجمالي الأيام المتبقية
                    $badgeClass = $totalDaysRemaining <= 30 ? 'badge badge-soft-danger font-size-15' : 'badge badge-soft-success font-size-15';

                    // إخراج الوقت المتبقي وإجمالي الأيام المتبقية
                    $renewl_period2 = $cd->companydoc_name." of ".$cd->company_name." is expiring in " . $totalDaysRemaining . ' days';
                }
                $sms_text="Hey ".$user_data->user_name."\n";
                $sms_text.=$renewl_period2;
                //send whatsapp
                sms_module($user_data->user_phone, $sms_text);
                // $content = view('email.email', [
                //     'emailText' => $renewl_period2,
                //     'userName' => $user_data->user_name
                // ])->render();
                // echo $content;
                // exit;
                // Send email
                Mail::to($user_data->user_email)->send(new SendReminderEmail($renewl_period2, $user_data));
            }
        }


        if(count($employeeDocs)>0)
        {
            foreach($employeeDocs as $ed)
            {
                $user_data = User::where('id', $ed->user_id)->first();
                // تحليل تاريخ انتهاء الصلاحية
                $expiryDate = new DateTime($ed->expiry_date);

                // الحصول على التاريخ الحالي
                $today = new DateTime();

                // حساب الفرق ككائن DateInterval
                $interval = $today->diff($expiryDate);

                // استخراج الفرق بالسنوات والشهور والأيام
                $diffInYears = (int)$interval->y;
                $diffInMonths = (int)$interval->m;
                $diffInDays = (int)$interval->d;

                // حساب إجمالي الأيام المتبقية
                $totalDaysRemaining = (int)$today->diff($expiryDate)->days;

                // تحديد إذا كان منتهي الصلاحية
                if ($totalDaysRemaining < 1) {
                    $renewl_period2 = $ed->employeedoc_name.' of '.$ed->employee_name.' from '.$ed->employee_company.' is expired';
                } else {
                    // تنسيق الفرق باللغة العربية
                    $yearsText = $diffInYears > 1 ? 'سنوات' : 'سنة';
                    $monthsText = $diffInMonths > 1 ? 'أشهر' : 'شهر';
                    $daysText = $diffInDays > 1 ? 'أيام' : 'يوم';

                    $timeLeft = "$diffInYears $yearsText, $diffInMonths $monthsText, $diffInDays $daysText";

                    // تحديد لون الشارة بناءً على إجمالي الأيام المتبقية
                    $badgeClass = $totalDaysRemaining <= 30 ? 'badge badge-soft-danger font-size-15' : 'badge badge-soft-success font-size-15';

                    // إخراج الوقت المتبقي وإجمالي الأيام المتبقية
                    $renewl_period2 = $ed->employeedoc_name." of ".$ed->employee_name.' from '.$ed->employee_company." is expiring in " . $totalDaysRemaining . ' days';
                }
                $sms_text="Hey ".$user_data->user_name."\n";
                $sms_text.=$renewl_period2;
                //send whatsapp
                sms_module($user_data->user_phone, $sms_text);
                // $content = view('email.email', [
                //     'emailText' => $renewl_period2,
                //     'userName' => $user_data->user_name
                // ])->render();
                // echo $content;
                // exit;
                // Send email
                Mail::to($user_data->user_email)->send(new SendReminderEmail($renewl_period2, $user_data));
            }
        }
    }


    public function reset_leaves()
{
    // Update the total_leaves and remaining_leaves for all users
    User::query()->update([
        'total_leaves' => 30,
        'remaining_leaves' => 30
    ]);


}

}
