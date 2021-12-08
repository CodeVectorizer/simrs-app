<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\PatientRight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PatientRightController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Default
        $query = PatientRight::query();

        if (request('search')) {
            $query->where(
                function ($query) {
                    return $query
                        ->where('patient_right', 'LIKE', '%' . request('search') . '%');
                }
            );
        }

        return Inertia::render('PatientRight/Index', [
            "patientrights" => $query->paginate(15),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('PatientRight/Create');
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
            'patient_right' => ['required'],
        ])->validate();
        PatientRight::create($request->all());

        return redirect()->route('right.index')->with('message', 'Data PatientRight Berhasil Ditambah');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(PatientRight $right)
    {
        return Inertia::render('PatientRight/Update', [
            'patient_right' => $right
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
            'patient_right' => ['required'],
        ])->validate();

        $right = PatientRight::find($id);
        $right->update($request->all());
        return redirect()->route('right.index')->with('message', 'Data PatientRight Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PatientRight $right)
    {
        $right->delete();
        return \back();
    }
}
