<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function showFiles($id){
        return User::findOrFail($id)->files;
    }

    public function uploadFiles(){
        return view('file.upload');
    }

    public function storageFiles(Request $request){
        print_r($request->file('files')[1]->getClientOriginalName());

        return redirect('files/upload');
    }
}
