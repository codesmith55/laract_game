<?php

namespace laract\Http\Controllers;

use Illuminate\Http\Request;
use laract\Unit;


class UnitController extends Controller
{

    public function index()
    {

        return Unit::all();
    }

    public function heroes()
    {

        return Unit::where('isHero', true)->get()->toArray();
    }

    public function monsters()
    {
        return Unit::where('isHero', false)->get()->toArray();
    }

    public function show(Unit $unit)
    {
        return $unit;
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            // 'title' => 'required|unique:units|max:255',
            /*'description' => 'required',
            'price' => 'integer',
            'availability' => 'boolean',*/
        ]);
        $unit = Unit::create($request->all());

        return response()->json($unit, 201);
    }

    public function update(Request $request, Unit $unit)
    {
        $unit->update($request->all());

        return response()->json($unit, 200);
    }

    public function delete(Unit $unit)
    {
        $unit->delete();

        return response()->json(null, 204);
    }

}