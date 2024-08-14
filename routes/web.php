<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\CompanyDocController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('home', [HomeController::class, 'home'])->name('home');
Route::get('calender', [HomeController::class, 'calender'])->name('calender');

Route::get('company_detail', [HomeController::class, 'company_detail'])->name('company_detail');

Route::get('timeline', [HomeController::class, 'timeline'])->name('timeline');

// UserController


Route::get('login_page', [UserController::class, 'login_page'])->name('login_page');


//company routes

Route::get('company', [CompanyController::class, 'index'])->name('company');
Route::post('add_company', [CompanyController::class, 'add_company'])->name('add_company');
Route::get('show_company', [CompanyController::class, 'show_company'])->name('show_company');
Route::post('edit_company', [CompanyController::class, 'edit_company'])->name('edit_company');
Route::post('update_company', [CompanyController::class, 'update_company'])->name('update_company');
Route::post('delete_company', [CompanyController::class, 'delete_company'])->name('delete_company');


//Branches

Route::match(['get', 'post'], 'branch', [BranchController::class, 'index'])->name('branch');
Route::post('add_branch', [BranchController::class, 'add_branch'])->name('add_branch');
Route::get('show_branch', [BranchController::class, 'show_branch'])->name('show_branch');
Route::post('edit_branch', [BranchController::class, 'edit_branch'])->name('edit_branch');
Route::post('update_branch', [BranchController::class, 'update_branch'])->name('update_branch');
Route::post('delete_branch', [BranchController::class, 'delete_branch'])->name('delete_branch');


//users

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



// Route to delete a document by ID
Route::delete('/delete-doc/{id}', [CompanyDocController::class, 'deleteDoc'])->name('delete_doc');


Route::get('get-doc/{id}', [DocumentController::class, 'getDoc'])->name('get_doc');
Route::get('get-docs/{id}', [DocumentController::class, 'getDoc'])->name('get_doc');

