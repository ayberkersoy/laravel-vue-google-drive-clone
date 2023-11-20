<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFolderRequest;
use App\Http\Resources\FileResource;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class FileController extends Controller
{
    public function myFiles(string $folder = null)
    {
        if ($folder) {
            $folder = File::query()
                ->where('created_by', Auth::id())
                ->where('path', $folder)
                ->firstOrFail();
        }

        if (!$folder) {
            $folder = $this->getRootFolder();
        }

        $files = File::query()
            ->where('parent_id', $folder->id)
            ->where('created_by', Auth::id())
            ->orderBy('is_folder', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        $files = FileResource::collection($files);

        return Inertia::render('MyFiles', compact('files'));
    }

    public function createFolder(StoreFolderRequest $request)
    {
        $data = $request->validated();

        $parent = $request->parent;

        if (!$parent) {
            $parent = $this->getRootFolder();
        }

        $file = new File();
        $file->name = $data['name'];
        $file->is_folder = true;

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
