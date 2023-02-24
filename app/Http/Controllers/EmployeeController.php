<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    public function index(){
        $Companies = Company::all();
        return view('new_emp',compact('Companies'));
    }
    public function edit($id){
        $FindEmployeeById = Employee::find($id);
        $Companies = Company::all();
        return view('edit_emp',compact('FindEmployeeById','Companies'));
    }

    public function update($id,Request $request){

        $FindCompany = Company::find($id);
        $validator = Validator::make($request->all(), [
            'first_name' => 'regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/',
            'last_name' => 'regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/',
            'email' => 'email',
            'phone'=>'string|min:9',
            'company_name'=>'exists:companies,id',
        ]);
        if($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        $FindEmplyee = Employee::find($id)->update([
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'company_id'=>$request->company_name
        ]);
        if($FindEmplyee){
            return redirect()->back()->withSuccess('Updated Successfully');
        }
    }


    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/',
            'last_name' => 'required|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/',
            'email' => 'email',
            'phone'=>'string|min:9',
            'company_name'=>'exists:companies,id',
        ]);

        if($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }
        $NewEmplyee = Employee::create([
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'company_id'=>$request->company_name
        ]);
        if($NewEmplyee){
            return redirect()->back()->withSuccess('Added Successfully');
        }
    }


    public function destroy($id){
        Employee::destroy($id);
        return redirect()->back()->withSuccess('Deleted Successfully');
    }
}
