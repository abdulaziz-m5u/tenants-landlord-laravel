<?php

namespace App\Http\Controllers\Admin;

use App\Models\Note;
use App\Models\Property;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Admin\StoreNoteRequest;
use App\Http\Requests\Admin\UpdateNoteRequest;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('note_access')) {
            return abort(401);
        }

        if (request('show_deleted') == 1) {
            if (! Gate::allows('note_delete')) {
                return abort(401);
            }
            $notes = Note::onlyTrashed()->get();
        } else {
            $notes = Note::all();
        }

        return view('admin.notes.index', compact('notes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('note_create')) {
            return abort(401);
        }

        $properties = Property::get()->pluck('name', 'id');

        return view('admin.notes.create', compact('properties'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNoteRequest $request)
    {
        if (! Gate::allows('note_create')) {
            return abort(401);
        }

        Note::create($request->all());

        return redirect()->route('admin.notes.index')->with('message', 'Created Successfully !');;
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
    public function edit(Note $note)
    {
        if (! Gate::allows('note_edit')) {
            return abort(401);
        }

        $properties = Property::get()->pluck('name', 'id');

        return view('admin.notes.edit', compact('note', 'properties'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNoteRequest $request,Note $note)
    {
        if (! Gate::allows('note_edit')) {
            return abort(401);
        }

        $note->update($request->all());

        return redirect()->route('admin.notes.index')->with('message', 'Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {
        if (! Gate::allows('note_delete')) {
            return abort(401);
        }

        $note->delete();

        return redirect()->route('admin.notes.index')->with('message', 'Deleted Successfully !');   
    }
}
