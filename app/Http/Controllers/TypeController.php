<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

use Validator;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Type::all();

        return view('types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $typeData = $request->all();

        $validator = Validator::make($typeData, [
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('types.create')
                ->withErrors($validator, 'store')
                ->withInput();
        }

        Type::create($typeData);

        Session::flash('responseMessages', [
            'success' => __('types.successful_added')
        ]);

        return redirect()->route('types.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function show(Type $type)
    {
        return view('types.show', compact('type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function edit(Type $type)
    {
        return view('types.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Type $type)
    {
        $typeData = $request->all();

        $validator = Validator::make($typeData, [
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('types.edit', ['type' => $type->id])
                ->withErrors($validator, 'edit')
                ->withInput();
        }

        $type->update($typeData);

        Session::flash('responseMessages', [
            'success' => __('types.successful_updated')
        ]);

        return redirect()->route('types.edit', ['type' => $type->id]);
    }

    /**
     * Displays the specified resource deletion confirmation form.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function delete(Type $type)
    {
        return view('types.confirmation.delete', compact('type'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
        $type->delete($type->id);

        Session::flash('responseMessages', [
            'success' => __('types.successful_deleted')
        ]);

        return redirect()->route('types.index');
    }
}
