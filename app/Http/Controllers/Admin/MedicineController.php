<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Medicine;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

class MedicineController extends Controller
{
    public function index()
    {
        $medicines = Medicine::paginate(7); 
        return view('admin.layouts.pages.medicines.index', compact('medicines'));
    }

    public function create()
    {
        return view(' admin.layouts.pages.medicines.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'dosage' => 'required|string|max:255',
            'unit' => 'required|string|max:50',
            'instructions' => 'required',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0'
        ]);

        Medicine::create($request->all());

        return redirect()->route('medicines.index')->with('success', 'Thêm thuốc thành công.');
    }

    public function edit($id)
    {
        $medicine = Medicine::findOrFail($id);
        return view('admin.layouts.pages.medicines.update', compact('medicine'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'dosage' => 'required|string|max:255',
            'unit' => 'required|string|max:50',
            'instructions' => 'required',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0'
        ]);

        $medicine = Medicine::findOrFail($id);
        $medicine->update($request->all());

        return redirect()->route('medicines.index')->with('success', 'Cập nhật thuốc thành công.');
    }

    public function destroy($id)
    {
        $medicine = Medicine::findOrFail($id);
        $medicine->delete();

        return redirect()->route('medicines.index')->with('success', 'Xóa thuốc thành công.');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx'
        ]);

        $file = $request->file('file');
        $spreadsheet = IOFactory::load($file->getPathname());
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();
        Medicine::query()->delete();
        unset($rows[0]);

        foreach ($rows as $row) {
            $medicineName = $row[1] ?? ''; 
            preg_match('/([\d\.]+ ?(?:mg|g|mcg|ml|IU))/i', $medicineName, $matches);
            $dosage = $matches[1] ?? ''; 
            $quyCach = $row[4] ?? ''; 
            $result = $this->extractUnitAndStock($quyCach);

            $price = isset($row[6]) ? (float) str_replace([',', ' '], '', $row[6]) : 0;

            $now = Carbon::now();

            Medicine::create([
                'name' => $medicineName,                 
                'ingredient' => $row[2] ?? '',          
                'manufacturer' => $row[3] ?? '',        
                'dosage' => $dosage,                    
                'unit' => $result['unit'],                   
                'instructions' => $row[4] ?? '',        
                'price' => number_format($price, 2, '.', ''), 
                'stock' => (int) ($row[7] ?? 0),        
                'status' => 'Còn hàng',                
                'created_at' => $now,                   
                'updated_at' => $now,               
            ]);
        }

        return redirect()->route('medicines.index')->with('success', 'Nhập dữ liệu thành công!');
    }

    private function extractUnitAndStock($quyCach)
    {
        preg_match('/[^\d\s-]+$/', trim($quyCach), $unitMatch);
        $unit = !empty($unitMatch) ? $unitMatch[0] : 'hộp'; 

        return ['unit' => $unit];
    }
}
