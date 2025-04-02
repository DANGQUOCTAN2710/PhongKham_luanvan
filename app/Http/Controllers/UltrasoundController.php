<?php

namespace App\Http\Controllers;

use App\Models\Ultrasound;
use Illuminate\Http\Request;

class UltrasoundController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ultrasounds = Ultrasound::all();
        return view('ultrasounds.index', compact('ultrasounds'));
    }

    public function create()
    {
        return view('ultrasounds.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ultrasound_code' => 'required|unique:ultrasounds,ultrasound_code',
            'ultrasound_name' => 'required',
            'price' => 'required|numeric|min:0',
        ]);

        Ultrasound::create($request->all());

        return redirect()->route('ultrasounds.index')->with('success', 'Ultrasound added successfully.');
    }

    public function edit($id)
    {
        $ultrasound = Ultrasound::findOrFail($id);
        return view('ultrasounds.edit', compact('ultrasound'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'ultrasound_code' => 'required|unique:ultrasounds,ultrasound_code,' . $id,
            'ultrasound_name' => 'required',
            'price' => 'required|numeric|min:0',
        ]);

        $ultrasound = Ultrasound::findOrFail($id);
        $ultrasound->update($request->all());

        return redirect()->route('ultrasounds.index')->with('success', 'Ultrasound updated successfully.');
    }

    public function destroy($id)
    {
        Ultrasound::destroy($id);
        return redirect()->route('ultrasounds.index')->with('success', 'Ultrasound deleted successfully.');
    }
}
