<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $cars = Car::where('name', 'like', '%' . $search . '%')
            ->orWhere('plat', 'like', '%' . $search . '%')
            ->orWhere('price', 'like', '%' . $search . '%')
            ->latest()
            ->paginate(10);
        return view('car.index', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $text = 'Create';
        return view('car.createOrUpdate')
            ->with('text', $text);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'  =>  'required',
            'plat'  =>  'required',
            'description'  =>  'required',
            'price'  =>  'required|integer',
            'status'  =>  'required',
        ]);
        if ($request->file('image')) {
            $data['image'] = $request->file('image')->store('cars');
        }
        Car::create($data);
        return redirect()->route('car.index')->with('success', 'Data mobil   berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function show(Car $car)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function edit(Car $car)
    {
        $text = 'Edit';
        return view('car.createOrUpdate', ['car' => $car, 'text' => $text]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Car $car)
    {
        $this->validate($request, [
            'name' => 'required|min:4',
            'plat' => 'required|min:4',
        ]);
        $car->update([
            'name' => $request->name,
            'plat' => $request->plat,
        ]);
        return redirect()->route('car.index')->with('message', 'updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        if ($car->image) {
            Storage::delete($car->image);
        }
        Car::destroy($car->id);
        return redirect()->route('car.index')->with('success', 'Data mobil berhasil dihapus');
    }
}