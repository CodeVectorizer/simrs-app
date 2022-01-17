<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Default
        $query = Testimonial::query();

        if (request('search')) {
            $query->where(
                function ($query) {
                    return $query
                        ->where('testimonial', 'LIKE', '%' . request('search') . '%')
                        ->orWhere('photo', 'LIKE', '%' . request('search') . '%');
                }
            );
        }

        return Inertia::render('Testimonial/Index', [
            "testimonials" => $query->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Testimonial/Create');
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
            'testimonial' => 'required|min:6',
        ]);
        $photo = null;

        // Upload
        if ($request->file('photo')) {
            // dd($request->all());
            $avatarName = time() . $request->testimonial . '.' . $request->photo->getClientOriginalExtension();
            $folderDir = 'img/testimonial/photo';
            if (!File::isDirectory($folderDir)) {
                File::makeDirectory($folderDir, 0777, true);
            }

            $request->photo->move(public_path($folderDir), $avatarName);
            $photo = '/img/testimonial/photo/' . $avatarName;
        }
        // Testimonial::create([
        //     'testimonial' => $request->testimonial,
        //     'photo' => $photo,
        // ]);

        Testimonial::create(\array_merge($request->all(), ['photo' => $photo]));

        return redirect()->route('testimonial.index')->with('message', 'Data Testimonial Berhasil Ditambah');
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
    public function edit(Testimonial $testimonial)
    {
        return Inertia::render('Testimonial/Update', [
            'testimonial' => $testimonial
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
        $testimonial = Testimonial::find($id);
        $request->validate([
            'testimonial' => 'required|min:6',
        ]);
        $photo = $request->photo;

        if ($request->file('photo')) {
            $folderDir = 'img/testimonial/photo';
            if (File::exists(public_path($testimonial->photo)) && $testimonial->photo != null) {
                unlink(public_path($testimonial->photo));
            }

            $avatarName = time() . $request->testimonial . '.' . $request->photo->getClientOriginalExtension();
            if (!File::isDirectory($folderDir)) {
                File::makeDirectory($folderDir, 0777, true);
            }
            $request->photo->move(public_path($folderDir), $avatarName);
            $photo = '/img/testimonial/photo/' . $avatarName;
        }
        // dd($testimonial, $id);
        // dd($photo);
        // $testimonial->update([
        //     'testimonial' => $request->testimonial,
        //     'photo' => $request->photo,
        //     'photo' => $photo,
        // ]);
        $testimonial->update(\array_merge($request->all(), ['photo' => $photo]));


        return redirect()->route('testimonial.index')->with('message', 'Data Testimonial Berhasil Diupdate');
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
    public function destroy(Testimonial $testimonial)
    {
        if (File::exists(public_path($testimonial->photo))) {
            unlink(public_path($testimonial->photo));
        }
        $testimonial->delete();
        return \back();
    }


    public function updateAvatar(Request $request)
    {
        // For single file validation
        Filepond::field($request->photo)->validate(['photo' => 'required|photo|max:2000']);

        // For multiple file validation

        $avatarName = 'photo-' . auth()->id();
        $folderDir = 'img/usersAvatar';
        if (!File::isDirectory($folderDir)) {
            File::makeDirectory($folderDir, 0777, true);
        }
        $fileInfo = Filepond::field($request->photo)
            ->moveTo($folderDir . '/' . $avatarName);

        Testimonial::where('id', Auth::testimonial()->id)->update([
            'photo' => $fileInfo['dirname'] . "/" . $fileInfo['basename']
        ]);
    }

    public function upload(Request $request)
    {
        $imageName = time() . '.' . $request->file->getClientOriginalExtension();


        return response()->json(['success' => 'You have successfully upload file.']);
    }
}
