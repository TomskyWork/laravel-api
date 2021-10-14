<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//import Employee model
use App\Models\Employee;

class ApiController extends Controller
{
    // Create API - POST request type
    // Request instance -> HTTP body params
    public function createEmployee(Request $request) {
        // validation rules for fields inputs, can set length or required integer etc..
        // email address should be unique inside EMPLOYEE table
        
        $request->validate([
            "name" => "required",
            "email" => "required|email|unique:employees",
            "phone_no" => "required",
            "gender" => "required",
            "age" => "required"
        ]);
        //error_log($request);

        //create data
        // create an instance from model
        $employee = new Employee();

        // assign values from request
        //table column    requested param
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->phone_no = $request->phone_no;
        $employee->gender = $request->gender;
        $employee->age = $request->age;
        
        $employee->save();
        

        // alternative to save()
        // Employee::create([
        //     "name" => $request->name,
        //     //... set each value 
        // ])
        //send response
        return response()->json([
            "status" => 1,
            "message" => "Employee created successfuly"
        ]);    
    }

    // List API - GET
    public function listEmployees() {
        
        $employees = Employee::get(); //call model Employee

        //print_r($employees);   //returns array of objects
        return response()->json([
            "status" => 1,
            "message" => "Listing Employees",
            "data" => $employees
        ],200);    //HTTP response code is optional
    }

    // Single detail API - GET
    public function getSingleEmployee($id) {
        if(Employee::where("id",$id)->exists()) {
            // where compares Employee model table id to passed id
            $employee_detail = Employee::where("id",$id)->first();

            return response()->json([
                "status" => 1,
                "message" => "Employee found",
                "data" => $employee_detail
            ]);
        } else {
            return response()->json([
                "status" => 0,
                "message" => "Employee not found"
            ],404);
        }
    }

    // Update API - PUT
    public function updateEmployee(Request $request, $id) {
        if(Employee::where("id",$id)->exists()) {

            $employee = Employee::find($id);    //finds the data by primary key

            // validate if request has a value POSTed then use that if not, use the name from model's table
            $employee-> name = !empty($request->name) ? $request->name : $employee->name;
            $employee-> email = !empty($request->email) ? $request->email :$request->email;
            $employee-> phone_no = !empty($request->phone_no) ? $request->phone_no :$request->phone_no;
            $employee-> gender = !empty($request->gender) ? $request->gender :$request->gender;
            $employee-> age = !empty($request->age) ? $request->age :$request->age;
            
            $employee->save();

            return response()->json([
                "status" => 1,
                "message" => "Employee updated, successfully"
            ],200);

        } else {
            return response()->json([
                "status" => 0,
                "message" => "Employee not found"
            ],404);
        }
    }

    //Delete API - DELETE
    public function deleteEmployee($id) {
        if(Employee::where("id",$id)->exists()) {
            $employee = Employee::find($id);  

            $employee->delete();

            return response()->json([
                "status" => 1,
                "message" => "Employee deleted, successfully"
            ],200);

        } else {
            return response()->json([
                "status" => 0,
                "message" => "Employee not found"
            ],404);
        }
        
    }
}
