<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\PatientDuty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PatientDutyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Default
        $query = PatientDuty::query();

        if (request('search')) {
            $query->where(
                function ($query) {
                    return $query
                        ->where('patient_duty', 'LIKE', '%' . request('search') . '%');
                }
            );
        }

        return Inertia::render('PatientDuty/Index', [
            "patientduties" => $query->paginate(15),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('PatientDuty/Create');
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
            'patient_duty' => ['required'],
        ])->validate();
        PatientDuty::create($request->all());

        return redirect()->route('duty.index')->with('message', 'Data PatientDuty Berhasil Ditambah');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(PatientDuty $duty)
    {
        return Inertia::render('PatientDuty/Update', [
            'patient_duty' => $duty
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
            'patient_duty' => ['required'],
        ])->validate();

        $duty = PatientDuty::find($id);
        $duty->update($request->all());
        return redirect()->route('duty.index')->with('message', 'Data PatientDuty Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PatientDuty $duty)
    {
        $duty->delete();
        return \back();
    }
}
