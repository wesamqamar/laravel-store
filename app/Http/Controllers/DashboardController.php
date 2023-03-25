<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //  طريقة اخرى لتعريف الاوث غير الي في الراوت
    //  public function __construct(){
    // $this->middleware('auth');
    //                 }




   public function index(){
        return view('dashboard.index' , [
            'user' => 'Wesam Qamar',
        ]);
    }

    public function about(){
        return view('about');
    }

    public function contact(){
        return view('contact');
    }

    public function terms(){
        return view('terms');
   }
}
