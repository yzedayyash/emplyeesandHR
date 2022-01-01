<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function listEmployees()
    {
        $employees = User::isHr(0)->select('id', 'name', 'email', 'status', 'job_title')->get();

        return response()->json([
            'success' => true,
            'data' => $employees,
            'message' => 'returned successfully',
        ], 200);
    }

    public function addEmployee(Request $request)
    {
        $user = auth()->user();
        if ($user->status == 0) {
            return response()->json(['message' => 'Access Denied'], 403);

        }
        $attr = $request->validate([
            'name' => 'required|string|',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6',
            'job_title' => 'required|string',

        ]);
        $employee = new User();
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->password = \Hash::make($request->password);
        $employee->job_title = $request->job_title;
        $employee->status = 1;
        $employee->is_hr = 0;
        $employee->save();
        return response()->json([
            'success' => true,
            'data' => $employee,
            'message' => 'inserted successfully',
        ], 201);
    }

    public function deactivateEmployee(Request $request , $employee_id){
        $user = auth()->user();
        if ($user->status == 0) {
            return response()->json(['message' => 'Access Denied'], 403);

        }
        $employee = User::where('id' , $employee_id)->first();
        if(!$employee){
            return response()->json(['message' => 'User Not Found'], 404);

        }
        if($employee->is_hr == 1){
            return response()->json(['message' => 'Access Denied'], 403);

        }

        $employee->status = 0;
        $employee->save();
        return response()->json([
            'success' => true,
            'message' => 'Updated successfully',
        ], 201);
    }
    public function update(Request $request)
    {
        $user = auth()->user();
        if ($user->status == 0) {
            return response()->json(['message' => 'Access Denied'], 403);

        }
        $attr = $request->validate([
            'name' => 'required|string|',
            'email' => 'required|string|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6',

        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        if (isset($request->password)) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return response()->json([
            'success' => true,
            'data' => $user,
            'message' => 'updated successfully',
        ], 201);
    }
}
