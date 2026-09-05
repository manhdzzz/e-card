<?php

namespace App\Http\Controllers\Enterprise;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    private function getCompany()
    {
        return auth()->user()->ownedCompany ?? auth()->user()->company;
    }

    public function index(Request $request)
    {
        $company = $this->getCompany();
        $query = $company->employees()->with('department');

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('full_name', 'like', "%{$s}%")
                  ->orWhere('email', 'like', "%{$s}%")
                  ->orWhere('phone', 'like', "%{$s}%");
            });
        }

        if ($request->filled('department') && $request->department !== 'all') {
            $query->where('department_id', $request->department);
        }

        $employees = $query->latest()->paginate(15)->withQueryString();
        $departments = $company->departments()->get();

        return view('enterprise.employees.index', compact('company', 'employees', 'departments'));
    }

    public function create()
    {
        $company = $this->getCompany();
        $departments = $company->departments()->get();
        return view('enterprise.employees.form', compact('company', 'departments'));
    }

    public function store(Request $request)
    {
        $company = $this->getCompany();

        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'department_id' => 'nullable|exists:departments,id',
            'create_account' => 'nullable|boolean',
            'password' => 'nullable|string|min:6',
        ]);

        $userId = null;

        // Optionally create a user account for the employee
        if ($request->create_account && $validated['email']) {
            $existingUser = User::where('email', $validated['email'])->first();
            if ($existingUser) {
                $userId = $existingUser->id;
                $existingUser->update(['company_id' => $company->id, 'account_type' => 'enterprise']);
            } else {
                $user = User::create([
                    'name' => $validated['full_name'],
                    'email' => $validated['email'],
                    'password' => Hash::make($request->password ?? 'ecard123'),
                    'role' => 'user',
                    'account_type' => 'enterprise',
                    'company_id' => $company->id,
                ]);
                $userId = $user->id;
            }
        }

        Employee::create([
            'company_id' => $company->id,
            'department_id' => $validated['department_id'] ?? null,
            'user_id' => $userId,
            'full_name' => $validated['full_name'],
            'position' => $validated['position'] ?? null,
            'phone' => $validated['phone'] ?? null,
            'email' => $validated['email'] ?? null,
        ]);

        return redirect()->route('enterprise.employees.index')->with('success', 'Thêm nhân viên thành công!');
    }

    public function edit(Employee $employee)
    {
        $company = $this->getCompany();
        if ($employee->company_id !== $company->id) abort(403);

        $departments = $company->departments()->get();
        return view('enterprise.employees.form', compact('company', 'employee', 'departments'));
    }

    public function update(Request $request, Employee $employee)
    {
        $company = $this->getCompany();
        if ($employee->company_id !== $company->id) abort(403);

        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'department_id' => 'nullable|exists:departments,id',
            'is_active' => 'required|boolean',
        ]);

        $employee->update($validated);
        return redirect()->route('enterprise.employees.index')->with('success', 'Cập nhật nhân viên thành công!');
    }

    public function destroy(Employee $employee)
    {
        $company = $this->getCompany();
        if ($employee->company_id !== $company->id) abort(403);

        $employee->delete();
        return back()->with('success', 'Đã xóa nhân viên.');
    }
}
