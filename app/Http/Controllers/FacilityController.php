<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class FacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Default        
        $query = Facility::query();

        if (request('search')) {
            $query->where(
                function ($query) {
                    return $query
                        ->where('description', 'LIKE', '%' . request('search') . '%')
                        ->orWhere('image', 'LIKE', '%' . request('search') . '%');
                }
            );
        }

        return Inertia::render('Facility/Index', [
            "facilities" => $query->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Facility/Create');
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
            'description' => 'required|min:6',
        ]);
        $image = null;

        // Upload
        if ($request->file('image')) {
            $avatarName = time() . $request->description . '.' . $request->image->getClientOriginalExtension();
            $folderDir = 'img/facility/image';
            if (!File::isDirectory($folderDir)) {
                File::makeDirectory($folderDir, 0777, true);
            }

            $request->image->move(public_path($folderDir), $avatarName);
            $image = '/img/facility/image/' . $avatarName;
        }
        Facility::create([
            'description' => $request->description,
            'image' => $image,
        ]);

        return redirect()->route('facility.index')->with('message', 'Data Facility Berhasil Ditambah');
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
    public function edit(Facility $facility)
    {
        return Inertia::render('Facility/Update', [
            'facility' => $facility
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
        $facility = Facility::find($id);
        $request->validate([
            'description' => 'required|min:6',
        ]);
        $image = $request->image;

        if ($request->file('image')) {
            $folderDir = 'img/facility/image';
            if (File::exists(public_path($facility->image))) {
                unlink(public_path($facility->image));
            }

            $avatarName = time() . $request->description . '.' . $request->image->getClientOriginalExtension();
            if (!File::isDirectory($folderDir)) {
                File::makeDirectory($folderDir, 0777, true);
            }
            $request->image->move(public_path($folderDir), $avatarName);
            $image = '/img/facility/image/' . $avatarName;
        }
        // dd($facility, $id);
        // dd($image);
        $facility->update([
            'description' => $request->description,
            'image' => $request->image,
            'image' => $image,
        ]);
        return redirect()->route('facility.index')->with('message', 'Data Facility Berhasil Diupdate');
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
    public function destroy(Facility $facility)
    {
        if (File::exists(public_path($facility->image))) {
            unlink(public_path($facility->image));
        }
        $facility->delete();
        return \back();
    }


    public function updateAvatar(Request $request)
    {
        // For single file validation
        Filepond::field($request->image)->validate(['image' => 'required|image|max:2000']);

        // For multiple file validation        

        $avatarName = 'image-' . auth()->id();
        $folderDir = 'img/usersAvatar';
        if (!File::isDirectory($folderDir)) {
            File::makeDirectory($folderDir, 0777, true);
        }
        $fileInfo = Filepond::field($request->image)
            ->moveTo($folderDir . '/' . $avatarName);

        Facility::where('id', Auth::facility()->id)->update([
            'image' => $fileInfo['dirname'] . "/" . $fileInfo['basename']
        ]);
    }

    public function upload(Request $request)
    {
        $imageName = time() . '.' . $request->file->getClientOriginalExtension();


        return response()->json(['success' => 'You have successfully upload file.']);
    }
}
