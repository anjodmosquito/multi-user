<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Inertia\Inertia;
use App\Models\Medicine;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class MedicineController extends Controller
{
    public function index()
    {
    // Retrieve all medicines using the Medicine model
    $medicines = Medicine::all();

    // Pass the retrieved data to the view using Inertia
    return Inertia::render('Admin/Medicines/Index', [
        'medicines' => $medicines
        // Passing 'medicines' instead of 'medicine' for better readability
    ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Medicines/Create');
    }

    public function store(Request $request)
    {
    $validatedData = $request->validate([
        'name' => ['required', 'string'],
        //'price' => ['required', 'string'],
        'lprice' => ['required', 'string'],
        'mprice' => ['required', 'string'],
        'hprice' => ['required', 'string'],
        'quantity' => ['required', 'string'],
        'dosage' => ['required', 'string'],
        'expdate' => ['required', 'date_format:Y-m-d'],
    ]);

    Medicine::create($validatedData);

    return redirect()->route('admin.medicines.index');
    }
    
    public function edit(Medicine $medicine)
    {
        return Inertia::render('Admin/Medicines/Edit', ['medicine' => $medicine]);  
    }
    public function update(Request $request, Medicine $medicine)
    {
    $request->validate([
        'name' => ['required', 'string'],
        //'price' => ['required', 'string'],
        'lprice' => ['required', 'string'],
        'mprice' => ['required', 'string'],
        'hprice' => ['required', 'string'],
        'quantity' => ['required', 'string'],
        'dosage' => ['required', 'string'],
        'expdate' => ['required', 'date_format:Y-m-d'],
    ]);

    $medicine->update($request->all());

    return Redirect::route('admin.medicines.index');
    }

    public function destroy(Medicine $medicine)
    {
    $medicine->delete();
    return Redirect::route('admin.medicines.index')->with('success', 'Medicine has been deleted.');
    }
}
