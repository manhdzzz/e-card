<?php

namespace App\Http\Controllers\Enterprise;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    private function getCompany()
    {
        return auth()->user()->ownedCompany ?? auth()->user()->company;
    }

    public function index()
    {
        $company = $this->getCompany();
        $departments = $company->departments()->withCount('employees')->latest()->get();
        return view('enterprise.departments.index', compact('company', 'departments'));
    }

    public function create()
    {
        $company = $this->getCompany();
        return view('enterprise.departments.form', compact('company'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        $company = $this->getCompany();
        $validated['company_id'] = $company->id;
        Department::create($validated);

        return redirect()->route('enterprise.departments.index')->with('success', 'Tạo phòng ban thành công!');
    }

    public function edit(Department $department)
    {
        $company = $this->getCompany();
        if ($department->company_id !== $company->id) abort(403);
        return view('enterprise.departments.form', compact('company', 'department'));
    }

    public function update(Request $request, Department $department)
    {
        $company = $this->getCompany();
        if ($department->company_id !== $company->id) abort(403);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        $department->update($validated);
        return redirect()->route('enterprise.departments.index')->with('success', 'Cập nhật phòng ban thành công!');
    }

    public function destroy(Department $department)
    {
        $company = $this->getCompany();
        if ($department->company_id !== $company->id) abort(403);

        $department->delete();
        return back()->with('success', 'Đã xóa phòng ban.');
    }
}
