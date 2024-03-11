<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

class AdminController extends Controller
{
    public function index(){
        return view('admin.index');
    }

    public function register(){
        return view('admin.register');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email:rfc,dns|unique:admin,email',
            'password' => 'required',
        ]);

        try {
            $validatedData['password'] = Hash::make($validatedData['password']);

            $newAdmin = Admin::create($validatedData);

            return redirect()->route('admin.index')->with('success', 'Admin created successfully.');
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];

            if ($errorCode == 1062) { // Unique constraint violation
                return response()->json(['error' => 'Email address must be unique.'], 400);
            }

            return redirect()->back()->with('error', 'Error creating admin: ' . $e->getMessage())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error creating admin: ' . $e->getMessage())->withInput();
        }
    }
}
