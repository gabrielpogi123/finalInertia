<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    // Display a listing of the documents
    public function index()
    {
        $documents = Document::all();
        return view('documents.index', compact('documents'));
    }

    // Show the form for creating a new document
    public function create()
    {
        return view('documents.create');
    }

    // Store a newly created document in storage
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'issued_date' => 'required|date',
            'expiry_date' => 'required|date',
        ]);

        $document = Document::create($validatedData);
        return redirect()->route('documents.index');
    }

    // Display the specified document
    public function show(Document $document)
    {
        return view('documents.show', compact('document'));
    }

    // Show the form for editing the specified document
    public function edit(Document $document)
    {
        return view('documents.edit', compact('document'));
    }

    // Update the specified document in storage
    public function update(Request $request, Document $document)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'issued_date' => 'required|date',
            'expiry_date' => 'required|date',
        ]);

        $document->update($validatedData);
        return redirect()->route('documents.index');
    }

    // Remove the specified document from storage
    public function destroy(Document $document)
    {
        $document->delete();
        return redirect()->route('documents.index');
    }
}
