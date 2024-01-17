<?php

namespace App\Http\Controllers;

use App\Models\TextList;
use Illuminate\Http\Request;

class TextListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TextList::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return TextList::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(TextList $textList)
    {
        return $textList;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TextList $textList)
    {
        $textList->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TextList $textList)
    {
        $textList->delete();
    }
}
