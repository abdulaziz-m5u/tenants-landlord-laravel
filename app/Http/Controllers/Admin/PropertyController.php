<?php

namespace App\Http\Controllers\Admin;

use App\Models\Property;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\StorePropertyRequest;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('property_access')) {
            return abort(401);
        }

        if (request('show_deleted') == 1) {
            if (! Gate::allows('property_delete')) {
                return abort(401);
            }
            $properties = Property::onlyTrashed()->get();
        } else {
            $properties = Property::all();
        }

        return view('admin.properties.index', compact('properties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('property_create')) {
            return abort(401);
        }

        return view('admin.properties.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePropertyRequest $request)
    {
        if (! Gate::allows('property_create')) {
            return abort(401);
        }

        $data = $request->all();
        if($request->photo){
            $data['photo'] = $request->file('photo')->store('assets/images', 'public');
        }

        Property::create($data + ['user_id' => auth()->user()->id]);

        return redirect()->route('admin.properties.index')->with('message', 'Created Successfully !');;
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
    public function edit(Property $property)
    {
        if (! Gate::allows('property_edit')) {
            return abort(401);
        }

        return view('admin.properties.edit', compact('property'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Property $property)
    {
        if (! Gate::allows('property_edit')) {
            return abort(401);
        }

        $data = $request->all();

        if($request->photo){
            Storage::disk('public')->delete($property->photo);
            $data['photo'] = $request->file('photo')->store('assets/images', 'public');
        }

        $property->update($data + ['user_id' => auth()->user()->id]);

        return redirect()->route('admin.properties.index')->with('message', 'Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Property $property)
    {
        if (! Gate::allows('property_delete')) {
            return abort(401);
        }

        Storage::disk('public')->delete($property->photo);
        $property->delete();

        return redirect()->route('admin.properties.index')->with('message', 'Deleted Successfully !');
    }
}
