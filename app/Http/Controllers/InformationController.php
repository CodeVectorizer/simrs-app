<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Information;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class InformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Default
        $query = Information::query();

        if (request('search')) {
            $query->where(
                function ($query) {
                    return $query
                        ->where('name', 'LIKE', '%' . request('search') . '%');
                }
            );
        }

        return Inertia::render('Information/Index', [
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
        return Inertia::render('Information/Create');
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
            $folderDir = 'img/information/image';
            if (!File::isDirectory($folderDir)) {
                File::makeDirectory($folderDir, 0777, true);
            }

            $request->image->move(public_path($folderDir), $avatarName);
            $image = '/img/information/image/' . $avatarName;
        }
        Information::create(\array_merge($request->all(), ['bg_image' => $image]));


        return redirect()->route('information.index')->with('message', 'Data Information Berhasil Ditambah');
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
    public function edit(Information $information)
    {
        return Inertia::render('Information/Update', [
            'information' => $information
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
        $information = Information::find(1);
        $request->validate([
            'description' => 'required|min:6',
        ]);
        $image = $request->image;

        if ($request->file('image')) {
            $folderDir = 'img/information/image';
            if (File::exists(public_path($information->image) && $information->image != null)) {
                unlink(public_path($information->image));
            }

            $avatarName = time() . $request->description . '.' . $request->image->getClientOriginalExtension();
            if (!File::isDirectory($folderDir)) {
                File::makeDirectory($folderDir, 0777, true);
            }
            $request->image->move(public_path($folderDir), $avatarName);
            $image = '/img/information/image/' . $avatarName;
        }
        // dd($information, $id);
        // dd($image);
        $information->update(\array_merge($request->all(), ['bg_image' => $image]));
        return redirect()->route('information.edit', ['information' => 1])->with('message', 'Data Information Berhasil Diupdate');
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
    public function destroy(Information $information)
    {
        if (File::exists(public_path($information->image))) {
            unlink(public_path($information->image));
        }
        $information->delete();
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

        Information::where('id', Auth::information()->id)->update([
            'image' => $fileInfo['dirname'] . "/" . $fileInfo['basename']
        ]);
    }

    public function upload(Request $request)
    {
        $imageName = time() . '.' . $request->file->getClientOriginalExtension();


        return response()->json(['success' => 'You have successfully upload file.']);
    }
}
