<?php

namespace App\Http\Controllers;

use App\Models\DiagnosticImaging;
use Illuminate\Http\Request;

class DiagnosticImagingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $diagnosticImagings = DiagnosticImaging::all();
        return view('diagnostic_imagings.index', compact('diagnosticImagings'));
    }

    /**
     * Hiển thị form tạo mới.
     */
    public function create()
    {
        return view('diagnostic_imagings.create');
    }

    /**
     * Lưu dữ liệu chẩn đoán hình ảnh mới vào database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|unique:diagnostic_imagings,code',
            'name' => 'required|string',
            'price' => 'required|numeric|min:0',
        ]);

        DiagnosticImaging::create($request->all());

        return redirect()->route('diagnostic-imagings.index')->with('success', 'Thêm thành công!');
    }

    /**
     * Hiển thị chi tiết một chẩn đoán hình ảnh.
     */
    public function show(DiagnosticImaging $diagnosticImaging)
    {
        return view('diagnostic_imagings.show', compact('diagnosticImaging'));
    }

    /**
     * Hiển thị form chỉnh sửa.
     */
    public function edit(DiagnosticImaging $diagnosticImaging)
    {
        return view('diagnostic_imagings.edit', compact('diagnosticImaging'));
    }

    /**
     * Cập nhật dữ liệu trong database.
     */
    public function update(Request $request, DiagnosticImaging $diagnosticImaging)
    {
        $request->validate([
            'code' => 'required|string|unique:diagnostic_imagings,code,' . $diagnosticImaging->id,
            'name' => 'required|string',
            'price' => 'required|numeric|min:0',
        ]);

        $diagnosticImaging->update($request->all());

        return redirect()->route('diagnostic-imagings.index')->with('success', 'Cập nhật thành công!');
    }

    /**
     * Xóa một chẩn đoán hình ảnh.
     */
    public function destroy(DiagnosticImaging $diagnosticImaging)
    {
        $diagnosticImaging->delete();
        return redirect()->route('diagnostic-imagings.index')->with('success', 'Xóa thành công!');
    }
}
