<?php

use App\Models\EmployeeDoc;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\UserController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\CompanyDocController;
use App\Http\Controllers\EmployeeDocController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CronJobController;
use SebastianBergmann\CodeCoverage\Report\Xml\Report;



// UserController
Route::get('getAndSendEmails', [CronJobController::class, 'getAndSendEmails']);
Route::get('reset_leaves', [CronJobController::class, 'reset_leaves'])->name('reset_leaves');

Route::match(['get', 'post'], 'login', [UserController::class, 'login'])->name('login');
Route::match(['get', 'post'], 'logout', [UserController::class, 'logout'])->name('logout');
Route::match(['get', 'post'], 'login_user', [UserController::class, 'login_user'])->name('login_user');


// HomeController

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('calender', [HomeController::class, 'calender'])->name('calender');
Route::get('company_detail', [HomeController::class, 'company_detail'])->name('company_detail');
Route::get('timeline', [HomeController::class, 'timeline'])->name('timeline');
Route::get('renewed_docs', [HomeController::class, 'renewed_docs'])->name('renewed_docs');
Route::get('all_renewed_docs', [HomeController::class, 'all_renewed_docs'])->name('all_renewed_docs');
Route::get('show_expired_docs', [HomeController::class, 'show_expired_docs'])->name('show_expired_docs');
Route::get('all_expired_docs', [HomeController::class, 'all_expired_docs'])->name('all_expired_docs');
Route::post('renew_docs_request', [HomeController::class, 'renew_docs_request'])->name('renew_docs_request');
Route::post('update_employee_doc', [HomeController::class, 'update_employee_doc'])->name('update_employee_doc');
Route::get('under_process', [HomeController::class, 'under_process'])->name('under_process');
Route::get('all_expired_docs2', [HomeController::class, 'all_expired_docs2'])->name('all_expired_docs2');
Route::post('renew_docs_request2', [HomeController::class, 'renew_docs_request2'])->name('renew_docs_request2');
Route::post('update_employee_doc2', [HomeController::class, 'update_employee_doc2'])->name('update_employee_doc2');
Route::get('all_leaves', [HomeController::class, 'all_leaves'])->name('all_leaves');
Route::get('show_leaves', [HomeController::class, 'show_leaves'])->name('show_leaves');
Route::post('leave_history', [HomeController::class, 'leave_history'])->name('leave_history');
Route::post('leave_approve', [HomeController::class, 'leave_approve'])->name('leave_approve');
Route::post('leave_reject', [HomeController::class, 'leave_reject'])->name('leave_reject');
Route::post('delete_leave', [HomeController::class, 'delete_leave'])->name('delete_leave');









//company routes

Route::get('company', [CompanyController::class, 'index'])->name('company');
Route::post('add_company', [CompanyController::class, 'add_company'])->name('add_company');
Route::get('show_company', [CompanyController::class, 'show_company'])->name('show_company');
Route::post('edit_company', [CompanyController::class, 'edit_company'])->name('edit_company');
Route::post('update_company', [CompanyController::class, 'update_company'])->name('update_company');
Route::post('delete_company', [CompanyController::class, 'delete_company'])->name('delete_company');

Route::post('add_employee2', [CompanyController::class, 'add_employee2'])->name('add_employee2');
Route::post('add_employee3', [CompanyController::class, 'add_employee3'])->name('add_employee3');
Route::get('company_profile/{id}', [CompanyController::class, 'company_profile'])->name('company_profile');
Route::match(['get', 'post'], 'show_company_doc', [CompanyController::class, 'show_company_doc'])->name('show_company_doc');
Route::post('delete_employee3', [CompanyController::class, 'delete_employee3'])->name('delete_employee3');
Route::post('delete_company_doc', [CompanyController::class, 'delete_company_doc'])->name('delete_company_doc');
Route::post('delete_employee_doc', [CompanyController::class, 'delete_employee_doc'])->name('delete_employee_doc');
Route::match(['get', 'post'], 'show_company_employee', [CompanyController::class, 'show_company_employee'])->name('show_company_employee');

//Branches

Route::match(['get', 'post'], 'branch', [BranchController::class, 'index'])->name('branch');
Route::post('add_branch', [BranchController::class, 'add_branch'])->name('add_branch');
Route::get('show_branch', [BranchController::class, 'show_branch'])->name('show_branch');
Route::post('edit_branch', [BranchController::class, 'edit_branch'])->name('edit_branch');
Route::post('update_branch', [BranchController::class, 'update_branch'])->name('update_branch');
Route::post('delete_branch', [BranchController::class, 'delete_branch'])->name('delete_branch');


//About

Route::match(['get', 'post'], 'about', [AboutController::class, 'index'])->name('about');
Route::post('add_about', [AboutController::class, 'add_about'])->name('add_about');
Route::get('show_about', [AboutController::class, 'show_about'])->name('show_about');
Route::post('edit_about', [AboutController::class, 'edit_about'])->name('edit_about');
Route::post('update_about', [AboutController::class, 'update_about'])->name('update_about');
Route::post('delete_about', [AboutController::class, 'delete_about'])->name('delete_about');

//uSER

Route::match(['get', 'post'], 'user', [UserController::class, 'index'])->name('user');
Route::post('add_user', [UserController::class, 'add_user'])->name('add_user');
Route::get('show_user', [UserController::class, 'show_user'])->name('show_user');
Route::post('edit_user', [UserController::class, 'edit_user'])->name('edit_user');
Route::post('update_user', [UserController::class, 'update_user'])->name('update_user');
Route::post('delete_user', [UserController::class, 'delete_user'])->name('delete_user');



//Employee

Route::match(['get', 'post'], 'employee', [EmployeeController::class, 'index'])->name('employee');
Route::post('add_employee', [EmployeeController::class, 'add_employee'])->name('add_employee');
Route::get('show_employee', [EmployeeController::class, 'show_employee'])->name('show_employee');
Route::post('edit_employee', [EmployeeController::class, 'edit_employee'])->name('edit_employee');
Route::post('update_employee', [EmployeeController::class, 'update_employee'])->name('update_employee');
Route::post('delete_employee', [EmployeeController::class, 'delete_employee'])->name('delete_employee');


//document

Route::match(['get', 'post'], 'document', [DocumentController::class, 'index'])->name('document');
Route::post('add_document', [DocumentController::class, 'add_document'])->name('add_document');
Route::get('show_document', [DocumentController::class, 'show_document'])->name('show_document');
Route::post('edit_document', [DocumentController::class, 'edit_document'])->name('edit_document');
Route::post('update_document', [DocumentController::class, 'update_document'])->name('update_document');
Route::post('delete_document', [DocumentController::class, 'delete_document'])->name('delete_document');

Route::match(['get', 'post'], 'document_addition/{id}', [CompanyDocController::class, 'document_addition'])->name('document_addition');
Route::post('add_doc', [CompanyDocController::class, 'add_doc'])->name('add_doc');
Route::get('show_doc', [CompanyDocController::class, 'show_doc'])->name('show_doc');
Route::post('edit_doc', [CompanyDocController::class, 'edit_doc'])->name('edit_doc');
Route::post('update_doc', [CompanyDocController::class, 'update_doc'])->name('update_doc');
Route::post('delete_doc', [CompanyDocController::class, 'delete_doc'])->name('delete_doc');

// web.php
Route::get('get_documents', [CompanyDocController::class, 'get_documents'])->name('get_documents');
Route::get('get_all', [CompanyDocController::class, 'get_all'])->name('get_all');
Route::get('/get-docs', [CompanyDocController::class, 'getDocs'])->name('get_docs');
Route::delete('/delete-doc/{id}', [CompanyDocController::class, 'deleteDoc'])->name('delete_doc');
Route::get('get-doc/{id}', [DocumentController::class, 'getDoc'])->name('get_doc');
Route::get('get-docs/{id}', [DocumentController::class, 'getDoc'])->name('get_doc');


//employeedoc

Route::match(['get', 'post'], 'employee_document_addition/{id}', [EmployeeDocController::class, 'employee_document_addition'])->name('employee_document_addition');
Route::post('add_employeedoc', [EmployeeDocController::class, 'add_employeedoc'])->name('add_employeedoc');
Route::get('show_employeedoc', [EmployeeDocController::class, 'show_employeedoc'])->name('show_employeedoc');
Route::post('edit_employeedoc', [EmployeeDocController::class, 'edit_employeedoc'])->name('edit_employeedoc');
Route::post('update_employeedoc', [EmployeeDocController::class, 'update_employeedoc'])->name('update_employeedoc');
Route::post('delete_employeedoc', [EmployeeDocController::class, 'delete_employeedoc'])->name('delete_employeedoc');


//task
Route::get('employee_task_page/{id}', [TaskController::class, 'employee_task_page'])->name('employee_task_page');
Route::get('employee_task', [TaskController::class, 'employee_task'])->name('employee_task');// web.php (routes file)
Route::get('document_history', [TaskController::class, 'document_history'])->name('document_history');
Route::get('document_renew', [TaskController::class, 'document_renew'])->name('document_renew');
Route::post('document_renew_confirm', [TaskController::class, 'document_renew_confirm'])->name('document_renew_confirm');
Route::post('add_employee4', [TaskController::class, 'add_employee4'])->name('add_employee4');
Route::match(['get', 'post'],'show_employee4', [TaskController::class, 'show_employee4'])->name('show_employee4');
Route::post('add_company4', [TaskController::class, 'add_company4'])->name('add_company4');
Route::match(['get', 'post'], 'show_company4', [TaskController::class, 'show_company4'])->name('show_company4');
Route::post( 'add_leave', [TaskController::class, 'add_leave'])->name('add_leave');




Route::match(['get', 'post'],'employee_doc_report', [ReportController::class, 'employee_doc_report'])->name('employee_doc_report');
Route::match(['get', 'post'],'doc_expiry', [ReportController::class, 'doc_expiry'])->name('doc_expiry');
Route::match(['get', 'post'],'company_doc_report', [ReportController::class, 'company_doc_report'])->name('company_doc_report');
Route::match(['get', 'post'],'employee_task_report', [ReportController::class, 'employee_task_report'])->name('employee_task_report');
Route::match(['get', 'post'],'task_complete', [ReportController::class, 'task_complete'])->name('task_complete');









