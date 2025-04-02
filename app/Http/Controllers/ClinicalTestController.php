<?php

namespace App\Http\Controllers;

use App\Models\ClinicalTest;
use Illuminate\Http\Request;

class ClinicalTestController extends Controller
{
    public function index()
    {
        $clinicalTests = ClinicalTest::all();
        return view('clinical_tests.index', compact('clinicalTests'));
    }

    public function create()
    {
        return view('clinical_tests.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'test_code' => 'required|unique:clinical_tests,test_code',
            'test_name' => 'required',
            'category' => 'required',
            'price' => 'required|numeric|min:0',
        ]);

        ClinicalTest::create($request->all());

        return redirect()->route('clinical_tests.index')->with('success', 'Thêm xét nghiệm thành công.');
    }

    public function edit($id)
    {
        $clinicalTest = ClinicalTest::findOrFail($id);
        return view('clinical_tests.edit', compact('clinicalTest'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'test_code' => 'required|unique:clinical_tests,test_code,' . $id,
            'test_name' => 'required',
            'category' => 'required',
            'price' => 'required|numeric|min:0',
        ]);

        $clinicalTest = ClinicalTest::findOrFail($id);
        $clinicalTest->update($request->all());

        return redirect()->route('clinical_tests.index')->with('success', 'Cập nhật xét nghiệm thành công.');
    }

    public function destroy($id)
    {
        ClinicalTest::destroy($id);
        return redirect()->route('clinical_tests.index')->with('success', 'Xóa xét nghiệm thành công.');
    }
}
