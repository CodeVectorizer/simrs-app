<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Speciality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SpecialityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Default
        $query = Speciality::query();

        if (request('search')) {
            $query->where(
                function ($query) {
                    return $query
                        ->where('speciality', 'LIKE', '%' . request('search') . '%')
                        ->orWhere('description', 'LIKE', '%' . request('search') . '%');
                }
            );
        }

        return Inertia::render('Speciality/Index', [
            "specialities" => $query->paginate(15),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Speciality/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'description' => ['required'],
            'speciality' => ['required'],
        ])->validate();
        Speciality::create($request->all());

        return redirect()->route('speciality.index')->with('message', 'Data Speciality Berhasil Ditambah');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Speciality $speciality)
    {
        return Inertia::render('Speciality/Update', [
            'speciality' => $speciality
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Validator::make($request->all(), [
            'description' => ['required'],
            'speciality' => ['required'],
        ])->validate();

        $speciality = Speciality::find($id);
        $speciality->update($request->all());
        return redirect()->route('speciality.index')->with('message', 'Data Speciality Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Speciality $speciality)
    {
        $speciality->delete();
        return \back();
    }
}
