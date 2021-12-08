<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Mitra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MitraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Default        
        $query = Mitra::query();

        if (request('search')) {
            $query->where(
                function ($query) {
                    return $query
                        ->where('description', 'LIKE', '%' . request('search') . '%')
                        ->orWhere('image', 'LIKE', '%' . request('search') . '%');
                }
            );
        }

        return Inertia::render('Mitra/Index', [
            "mitras" => $query->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Mitra/Create');
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
            $folderDir = 'img/mitra/image';
            if (!File::isDirectory($folderDir)) {
                File::makeDirectory($folderDir, 0777, true);
            }

            $request->image->move(public_path($folderDir), $avatarName);
            $image = '/img/mitra/image/' . $avatarName;
        }
        Mitra::create([
            'description' => $request->description,
            'image' => $image,
        ]);

        return redirect()->route('mitra.index')->with('message', 'Data Mitra Berhasil Ditambah');
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
    public function edit(Mitra $mitra)
    {
        return Inertia::render('Mitra/Update', [
            'mitra' => $mitra
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
        $mitra = Mitra::find($id);
        $request->validate([
            'description' => 'required|min:6',
        ]);
        $image = $request->image;

        if ($request->file('image')) {
            $folderDir = 'img/mitra/image';
            if (File::exists(public_path($mitra->image))) {
                unlink(public_path($mitra->image));
            }

            $avatarName = time() . $request->description . '.' . $request->image->getClientOriginalExtension();
            if (!File::isDirectory($folderDir)) {
                File::makeDirectory($folderDir, 0777, true);
            }
            $request->image->move(public_path($folderDir), $avatarName);
            $image = '/img/mitra/image/' . $avatarName;
        }
        // dd($mitra, $id);
        // dd($image);
        $mitra->update([
            'description' => $request->description,
            'image' => $request->image,
            'image' => $image,
        ]);
        return redirect()->route('mitra.index')->with('message', 'Data Mitra Berhasil Diupdate');
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
    public function destroy(Mitra $mitra)
    {
        if (File::exists(public_path($mitra->image))) {
            unlink(public_path($mitra->image));
        }
        $mitra->delete();
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

        Mitra::where('id', Auth::mitra()->id)->update([
            'image' => $fileInfo['dirname'] . "/" . $fileInfo['basename']
        ]);
    }

    public function upload(Request $request)
    {
        $imageName = time() . '.' . $request->file->getClientOriginalExtension();


        return response()->json(['success' => 'You have successfully upload file.']);
    }
}
