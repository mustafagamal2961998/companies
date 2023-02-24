<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    public function index(){
        $Companies = Company::all();
        $Employees = Employee::with('company')->get();
        return view('cpanel',compact('Companies','Employees'));
    }
    public function company(){
        return view('new_comp');
    }



    public function edit($id){
        $FindCompanyById = Company::find($id);
        return view('edit',compact('FindCompanyById'));
    }


    public function update($id,Request $request){

        $FindCompany = Company::find($id);
        $validator = Validator::make($request->all(), [
            'name' => 'regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/',
            'email' => 'email',
            'logo'=>'image|mimes:jpeg,jpg,png,gif|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000'
        ]);
        if($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        if ($request->hasFile('logo')){
            $image_name = md5(rand(1000,10000));
            $ext = strtolower($request->logo->extension());
            $image_full_name = $image_name.'.'.$ext;
            $upload_path='public/logo/';
            $image_url = $upload_path.$image_full_name;
            $request->logo->move($upload_path,$image_full_name);
            $logo = $image_url;
        } else {
            $logo = $FindCompany->logo;
        }

        $UpdateCompanyData = Company::find($id)->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'logo'=>$logo
        ]);
        if($UpdateCompanyData){
                return redirect()->back()->withSuccess('Updated Successfully');
        }

    }

    public function store ( Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/',
            'email' => 'email',
            'logo'=>'image|mimes:jpeg,jpg,png,gif|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000'
        ]);
        if($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }
        if ($request->hasFile('logo')){
            $image_name = md5(rand(1000,10000));
            $ext = strtolower($request->logo->extension());
            $image_full_name = $image_name.'.'.$ext;
            $upload_path='public/logo/';
            $image_url = $upload_path.$image_full_name;
            $request->logo->move($upload_path,$image_full_name);
            $logo = $image_url;
        } else {
            $logo = 'https://via.placeholder.com/100';
        }
        $AddNewCompany = Company::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'logo'=>$logo
        ]);
        if($AddNewCompany){
            return redirect()->back()->withSuccess('Added Successfully');
        }

    }

    public function destroy($id){
        Company::destroy($id);
        return redirect()->back()->withSuccess('Deleted Successfully');

    }



}
