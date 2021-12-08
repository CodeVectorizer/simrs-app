<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Default
        $query = Video::query();

        if (request('search')) {
            $query->where(
                function ($query) {
                    return $query
                        ->where('link', 'LIKE', '%' . request('search') . '%')
                        ->orWhere('description', 'LIKE', '%' . request('search') . '%');
                }
            );
        }

        return Inertia::render('Video/Index', [
            "videos" => $query->paginate(15),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Video/Create');
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
            'link' => ['required'],
        ])->validate();
        Video::create($request->all());

        return redirect()->route('video.index')->with('message', 'Data Video Berhasil Ditambah');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        return Inertia::render('Video/Update', [
            'video' => $video
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
            'link' => ['required'],
        ])->validate();

        $video = Video::find($id);
        $video->update($request->all());
        return redirect()->route('video.index')->with('message', 'Data Video Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
    {
        $video->delete();
        return \back();
    }
}
