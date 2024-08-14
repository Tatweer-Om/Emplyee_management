<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home (){

        return view ('dashboard.home');
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
}
