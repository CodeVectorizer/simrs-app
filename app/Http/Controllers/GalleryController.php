<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Default
        $query = Gallery::query();

        if (request('search')) {
            $query->where(
                function ($query) {
                    return $query
                        ->where('description', 'LIKE', '%' . request('search') . '%')
                        ->orWhere('image', 'LIKE', '%' . request('search') . '%');
                }
            );
        }

        return Inertia::render('Gallery/Index', [
            "galleries" => $query->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Gallery/Create');
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
            $folderDir = 'img/gallery/image';
            if (!File::isDirectory($folderDir)) {
                File::makeDirectory($folderDir, 0777, true);
            }

            $request->image->move(public_path($folderDir), $avatarName);
            $image = '/img/gallery/image/' . $avatarName;
        }
        Gallery::create([
            'description' => $request->description,
            'image' => $image,
        ]);

        return redirect()->route('gallery.index')->with('message', 'Data Gallery Berhasil Ditambah');
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
    public function edit(Gallery $gallery)
    {
        return Inertia::render('Gallery/Update', [
            'gallery' => $gallery
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
        $gallery = Gallery::find($id);
        $request->validate([
            'description' => 'required|min:6',
        ]);
        $image = $request->image;

        if ($request->file('image')) {
            $folderDir = 'img/gallery/image';
            if (File::exists(public_path($gallery->image))) {
                unlink(public_path($gallery->image));
            }

            $avatarName = time() . $request->description . '.' . $request->image->getClientOriginalExtension();
            if (!File::isDirectory($folderDir)) {
                File::makeDirectory($folderDir, 0777, true);
            }
            $request->image->move(public_path($folderDir), $avatarName);
            $image = '/img/gallery/image/' . $avatarName;
        }
        // dd($gallery, $id);
        // dd($image);
        $gallery->update([
            'description' => $request->description,
            'image' => $request->image,
            'image' => $image,
        ]);
        return redirect()->route('gallery.index')->with('message', 'Data Gallery Berhasil Diupdate');
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
    public function destroy(Gallery $gallery)
    {
        if (File::exists(public_path($gallery->image))) {
            unlink(public_path($gallery->image));
        }
        $gallery->delete();
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

        Gallery::where('id', Auth::gallery()->id)->update([
            'image' => $fileInfo['dirname'] . "/" . $fileInfo['basename']
        ]);
    }

    public function upload(Request $request)
    {
        $imageName = time() . '.' . $request->file->getClientOriginalExtension();


        return response()->json(['success' => 'You have successfully upload file.']);
    }
}
