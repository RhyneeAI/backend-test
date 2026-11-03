<?php

namespace App\Http\Controllers\Api;

use App\Support\TenantContext;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use Exception;
use Illuminate\Http\Request;

// p.s : Error handling is on bootstrap/app.php
class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $employees = Employee::with('user')->orderBy('name')->get();

        return response()->json([
            'success' => true,
            'data' => EmployeeResource::collection($employees),
        ], 201);
    }

    public function store(EmployeeRequest $request)
    {
        try {
            $employee = Employee::create([
                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address,
                'phone' => $request->phone,
                'birth_date' => $request->birth_date,
                'is_active' => 1,
            ]);
            
            return response()->json([
                'success' => true,
                'data' => new EmployeeResource($employee),
            ], 201);
        } catch(Exception $e) {
            return response()->json(['message' => 'Server error'], 500);
        }
    }

    public function show(Employee $employee)
    {
        $employee->loadMissing('user');
        return response()->json([
            'success' => true,
            'data' => new EmployeeResource($employee),
        ], 200);
    }

    public function update(EmployeeRequest $request, Employee $employee)
    {
        try {
            $employee = Employee::update([
                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address,
                'phone' => $request->phone,
                'birth_date' => $request->birth_date,
                'is_active' => 1,
            ]);

            return response()->json([
                'success' => true,
                'data' => new EmployeeResource($employee),
            ]);
        } catch(Exception $e) {
            return response()->json(['message' => 'Server error'], 500);
        }
    }

    public function destroy(Employee $employee)
    {
        try {
            $employee->delete();
    
            return response()->json([
                'success' => true,
            ], 200);
        } catch(Exception $e) {
            return response()->json(['message' => 'Server error'], 500);
        }
    }
}
