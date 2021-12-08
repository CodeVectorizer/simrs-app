<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Inertia\Inertia;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Default
        $query = Post::query();

        if (request('search')) {
            $query->where(
                function ($query) {
                    return $query
                        ->where('title', 'LIKE', '%' . request('search') . '%')
                        ->where('content', 'LIKE', '%' . request('search') . '%')
                        ->orWhere('image', 'LIKE', '%' . request('search') . '%');
                }
            );
        }

        return Inertia::render('Post/Index', [
            "Posts" => $query->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();

        return Inertia::render('Post/Create', [
            "categories" => $categories

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
            'title' => 'required|min:6',
            'content' => 'required|min:6',
        ]);
        $image = null;

        // Upload
        if ($request->file('image')) {
            $avatarName = time() . '.' . $request->image->getClientOriginalExtension();
            $folderDir = 'img/post/image';
            if (!File::isDirectory($folderDir)) {
                File::makeDirectory($folderDir, 0777, true);
            }

            $request->image->move(public_path($folderDir), $avatarName);
            $image = '/img/post/image/' . $avatarName;
        }
        Post::create([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'content' => $request->content,
            'image' => $image,
        ]);

        return redirect()->route('post.index')->with('message', 'Data Post Berhasil Ditambah');
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
    public function edit(Post $post)
    {
        $categories = Category::get();
        return Inertia::render('Post/Update', [
            'post' => $post,
            "categories" => $categories
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
        $post = Post::find($id);
        $request->validate([
            'title' => 'required|min:6',
            'content' => 'required|min:6',
        ]);
        $image = $request->image;

        if ($request->file('image')) {
            $folderDir = 'img/post/image';
            if (File::exists(public_path($post->image))) {
                unlink(public_path($post->image));
            }

            $avatarName = time() . '.' . $request->image->getClientOriginalExtension();
            if (!File::isDirectory($folderDir)) {
                File::makeDirectory($folderDir, 0777, true);
            }
            $request->image->move(public_path($folderDir), $avatarName);
            $image = '/img/post/image/' . $avatarName;
        }
        // dd($post, $id);
        // dd($image);
        $post->update([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'content' => $request->content,
            'image' => $image,
        ]);
        return redirect()->route('post.index')->with('message', 'Data Post Berhasil Diupdate');
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
    public function destroy(Post $post)
    {
        if (File::exists(public_path($post->image))) {
            unlink(public_path($post->image));
        }
        $post->delete();
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

        Post::where('id', Auth::post()->id)->update([
            'image' => $fileInfo['dirname'] . "/" . $fileInfo['basename']
        ]);
    }

    public function upload(Request $request)
    {
        $imageName = time() . '.' . $request->file->getClientOriginalExtension();


        return response()->json(['success' => 'You have successfully upload file.']);
    }
}
