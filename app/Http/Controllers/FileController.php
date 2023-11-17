<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFolderRequest;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class FileController extends Controller
{
    public function myFiles()
    {
        return Inertia::render('MyFiles');
    }

    public function createFolder(StoreFolderRequest $request)
    {
        $data = $request->validated();

        $parent = $request->parent;

        if (!$parent) {
            $parent = $this->getRootFolder();
        }

        $file = File::create([
            'name' => $data['name'],
            'is_folder' => true
        ]);

        $parent->appendNode($file);
    }

    private function getRootFolder() : File
    {
        return File::query()
            ->where('created_by', Auth::id())
            ->whereIsRoot()
            ->firstOrFail();
    }
}
