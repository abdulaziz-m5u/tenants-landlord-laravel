<?php

namespace App\Http\Controllers\Admin;

use App\Models\Document;
use App\Models\Property;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\StoreDocumentRequest;
use App\Http\Requests\Admin\UpdateDocumentRequest;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('document_access')) {
            return abort(401);
        }

        if (request('show_deleted') == 1) {
            if (! Gate::allows('document_delete')) {
                return abort(401);
            }
            $documents = Document::onlyTrashed()->get();
        } else {
            $documents = Document::all();
        }

        return view('admin.documents.index', compact('documents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('document_create')) {
            return abort(401);
        }

        $properties = Property::get()->pluck('name', 'id');

        return view('admin.documents.create', compact('properties'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDocumentRequest $request)
    {
        if (! Gate::allows('document_create')) {
            return abort(401);
        }

        $data = $request->all();
        if($request->document){
            $data['document'] = $request->file('document')->store('assets/document', 'public');
        }

        Document::create($data + ['name' => $request->name]);

        return redirect()->route('admin.documents.index')->with('message', 'Created Successfully !');
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
    public function edit(Document $document)
    {
        if (! Gate::allows('document_edit')) {
            return abort(401);
        }

        $properties = Property::get()->pluck('name', 'id');

        return view('admin.documents.edit', compact('document', 'properties'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDocumentRequest $request,Document $document)
    {
        if (! Gate::allows('document_edit')) {
            return abort(401);
        }

        $data = $request->all();

        if($request->file('document')){
            Storage::disk('public')->delete($document->document);
            $data['document'] = $request->file('document')->store('assets/document', 'public');
        }

        $document->update($data + ['name' => $request->name]);

        return redirect()->route('admin.documents.index')->with('message', 'Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document)
    {
        if (! Gate::allows('document_delete')) {
            return abort(401);
        }

        Storage::disk('public')->delete($document->document);
        $document->delete();

        return redirect()->route('admin.documents.index')->with('message', 'Deleted Successfully !');
    }
}
