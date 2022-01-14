<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Property;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTenantRequest;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tenants = User::whereIn('property_id', Property::where('user_id', auth()->user()->id)->pluck('id'))->get();
    
        return view('admin.tenants.index', compact('tenants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $properties = Property::where('user_id', auth()->user()->id)->pluck('name', 'id');
        
        return view('admin.tenants.create', compact('properties'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTenantRequest $request)
    {
        $user = User::create([
            'name'             => $request->name,
            'email'            => $request->email,
            'password'         => Str::random(),
            'property_id'      => $request->property_id,
            'invitation_token' => substr(md5(rand(0, 9) . $request->email . time()), 0, 32),
        ]);

        $user->role()->attach(3);

        return redirect()->route('admin.tenants.index')->with('message', 'Created Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Property $property)
    {
        $property->delete();

        return redirect()->route('admin.tenants.index')->with('message', 'Deleted Successfully !');
    }
}
