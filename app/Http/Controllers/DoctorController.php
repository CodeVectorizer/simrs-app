<?php

namespace App\Http\Controllers;

use App\Models\Speciality;
use Inertia\Inertia;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Default
        $query = Doctor::query();
        $query->with('speciality');
        if (request('search')) {
            $query->where(
                function ($query) {
                    return $query
                        ->where('name', 'LIKE', '%' . request('search') . '%')
                        ->where('description', 'LIKE', '%' . request('search') . '%')
                        ->orWhere('avatar', 'LIKE', '%' . request('search') . '%');
                }
            );
        }

        return Inertia::render('Doctor/Index', [
            "Doctors" => $query->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $specialities = Speciality::get();

        return Inertia::render('Doctor/Create', [
            "specialities" => $specialities

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:6',
            'description' => 'required|min:6',
        ]);
        $avatar = null;


        // Upload
        if ($request->file('avatar')) {
            $avatarName = time() . '.' . $request->avatar->getClientOriginalExtension();
            $folderDir = 'img/doctor/avatar';
            if (!File::isDirectory($folderDir)) {
                File::makeDirectory($folderDir, 0777, true);
            }

            $request->avatar->move(public_path($folderDir), $avatarName);
            $avatar = '/img/doctor/avatar/' . $avatarName;
        }

        $poster = Doctor::create([
            'speciality_id' => $request->speciality_id,
            'name' => $request->name,
            'description' => $request->description,
            'sunday' => $request->sunday,
            'monday' => $request->monday,
            'tuesday' => $request->tuesday,
            'wednesday' => $request->wednesday,
            'thursday' => $request->thursday,
            'friday' => $request->friday,
            'saturday' => $request->saturday,
            'avatar' => $avatar,
        ]);

        return redirect()->route('doctor.index')->with('message', 'Data Doctor Berhasil Ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Doctor $doctor)
    {
        $specialities = Speciality::get();
        return Inertia::render('Doctor/Update', [
            'doctor' => $doctor,
            "specialities" => $specialities
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
        $doctor = Doctor::find($id);
        $request->validate([
            'name' => 'required|min:6',
            'description' => 'required|min:6',
        ]);
        $avatar = $request->avatar;

        if ($request->file('avatar')) {
            $folderDir = 'img/doctor/avatar';
            if (File::exists(public_path($doctor->avatar)) && $doctor->avatar != null) {
                unlink(public_path($doctor->avatar));
            }

            $avatarName = time() . '.' . $request->avatar->getClientOriginalExtension();
            if (!File::isDirectory($folderDir)) {
                File::makeDirectory($folderDir, 0777, true);
            }
            $request->avatar->move(public_path($folderDir), $avatarName);
            $avatar = '/img/doctor/avatar/' . $avatarName;
        }
        // dd($doctor, $id);
        // dd($avatar);
        $doctor->update([
            'speciality_id' => $request->speciality_id,
            'name' => $request->name,
            'description' => $request->description,
            'sunday' => $request->sunday,
            'monday' => $request->monday,
            'tuesday' => $request->tuesday,
            'wednesday' => $request->wednesday,
            'thursday' => $request->thursday,
            'friday' => $request->friday,
            'saturday' => $request->saturday,
            'avatar' => $avatar,
        ]);
        return redirect()->route('doctor.index')->with('message', 'Data Doctor Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function test(Request $request)
    {
        dd($request);
    }
    public function destroy(Doctor $doctor)
    {
        if (File::exists(public_path($doctor->avatar))) {
            unlink(public_path($doctor->avatar));
        }
        $doctor->delete();
        return \back();
    }


    public function updateAvatar(Request $request)
    {
        // For single file validation
        Filepond::field($request->avatar)->validate(['avatar' => 'required|avatar|max:2000']);

        // For multiple file validation        

        $avatarName = 'avatar-' . auth()->id();
        $folderDir = 'img/usersAvatar';
        if (!File::isDirectory($folderDir)) {
            File::makeDirectory($folderDir, 0777, true);
        }
        $fileInfo = Filepond::field($request->avatar)
            ->moveTo($folderDir . '/' . $avatarName);

        Doctor::where('id', Auth::doctor()->id)->update([
            'avatar' => $fileInfo['dirname'] . "/" . $fileInfo['basename']
        ]);
    }

    public function upload(Request $request)
    {
        $imageName = time() . '.' . $request->file->getClientOriginalExtension();


        return response()->json(['success' => 'You have successfully upload file.']);
    }
}
