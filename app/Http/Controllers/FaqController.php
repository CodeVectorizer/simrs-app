<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Default
        $query = Faq::query();

        if (request('search')) {
            $query->where(
                function ($query) {
                    return $query
                        ->where('question', 'LIKE', '%' . request('search') . '%')
                        ->orWhere('answer', 'LIKE', '%' . request('search') . '%');
                }
            );
        }

        return Inertia::render('Faq/Index', [
            "faqs" => $query->paginate(15),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Faq/Create');
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
            'answer' => ['required'],
            'question' => ['required'],
        ])->validate();
        Faq::create($request->all());

        return redirect()->route('faq.index')->with('message', 'Data Faq Berhasil Ditambah');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Faq $faq)
    {
        return Inertia::render('Faq/Update', [
            'faq' => $faq
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
            'answer' => ['required'],
            'question' => ['required'],
        ])->validate();

        $faq = Faq::find($id);
        $faq->update($request->all());
        return redirect()->route('faq.index')->with('message', 'Data Faq Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faq $faq)
    {
        $faq->delete();
        return \back();
    }
}
