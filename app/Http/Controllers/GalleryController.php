<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Http\Requests\StoreGalleryRequest;
use App\Http\Requests\UpdateGalleryRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $author = $request->input('author');

        $galleries = Gallery::with(['firstImage', 'user']);

        if ($author) {
            $galleries->whereUserId($author);
        };

        return response()->json($galleries->paginate(10));
    }

    public function store(StoreGalleryRequest $request)
    {
        $validated = $request->validated();

        $newGallery = new Gallery($validated);
        $newGallery->user()->associate(Auth::user());
        $newGallery->save();

        foreach ($validated['url'] as $url) {
            $newUrlArray[] = ['url' => $url];
        };
        $newGallery->images()->createMany($newUrlArray);

        return response()->json($newGallery);
    }

    public function show(Gallery $gallery)
    {
        $gallery->load(['images', 'user'])->get();

        return response()->json($gallery);
    }

    public function update(StoreGalleryRequest $request, Gallery $gallery)
    {
        if ($gallery->user->id != Auth::id()) {
            return response()->json(['errors' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
        }

        $validated = $request->validated();

        $gallery->update($validated);

        $gallery->images()->delete();

        foreach ($validated['url'] as $url) {
            $newUrlArray[] = ['url' => $url];
        };
        $gallery->images()->createMany($newUrlArray);

        return response()->json($gallery);
    }

    public function destroy(Gallery $gallery)
    {

        if ($gallery->user->id != Auth::id()) {
            return response()->json(['errors' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
        }

        $gallery->delete();
        return response($gallery);
    }
}
