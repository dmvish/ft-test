<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

use Validator;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attributes = Attribute::all();

        return view('attributes.index', compact('attributes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('attributes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attrData = $request->all();

        $validator = Validator::make($attrData, [
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('attributes.create')
                ->withErrors($validator, 'store')
                ->withInput();
        }

        Attribute::create($attrData);

        Session::flash('responseMessages', [
            'success' => __('attributes.successful_added')
        ]);

        return redirect()->route('attributes.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function show(Attribute $attribute)
    {
        return view('attributes.show', compact('attribute'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function edit(Attribute $attribute)
    {
        return view('attributes.edit', compact('attribute'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attribute $attribute)
    {
        $attrData = $request->all();

        $validator = Validator::make($attrData, [
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('attributes.edit', ['attributes' => $attribute->id])
                ->withErrors($validator, 'edit')
                ->withInput();
        }

        $attribute->update($attrData);

        Session::flash('responseMessages', [
            'success' => __('attributes.successful_updated')
        ]);

        return redirect()->route('attributes.edit', ['attribute' => $attribute->id]);
    }

    /**
     * Displays the specified resource deletion confirmation form.
     *
     * @param  \App\Models\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function delete(Attribute $attribute)
    {
        return view('attributes.confirmation.delete', compact('attribute'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attribute $attribute)
    {
        $attribute->delete($attribute->id);

        Session::flash('responseMessages', [
            'success' => __('attributes.successful_deleted')
        ]);

        return redirect()->route('attributes.index');
    }
}
