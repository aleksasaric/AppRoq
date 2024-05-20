<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Rules\HasNameRule;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class UploadController
{
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'file_upload' => ['mimes:pdf','max:2048', new HasNameRule('proposal')],
        ]);

        $file = $request->file('file_upload');
        $fileName = $file->getClientOriginalName();
        $filePath = $file->store('uploads', 'public');

        $uploadedFile = File::updateOrCreate(['size' => $file->getSize(), 'file_name' => $fileName],[
            'file_name' => $fileName,
            'original_name' => $file->getClientOriginalName(),
            'file_path' => $filePath,
            'size' => $file->getSize()
        ]);

        // Redirect back to the index page with a success message
        return redirect()->route('uploads.index')
            ->with('success', "File `{$uploadedFile->original_name}` uploaded successfully.");
    }

    public function create()
    {
        return view('uploads.create');
    }

    public function index()
    {
        $uploadedFiles = File::get();
        return view('uploads.index', compact('uploadedFiles'));
    }
}
