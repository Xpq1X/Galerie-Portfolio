<?php

namespace App\Http\Controllers;

use App\Models\GalleryItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    // Constructor to apply the middleware
    public function __construct()
    {
        $this->middleware('admin'); // This applies the 'admin' middleware to all methods
    }

    public function adminGallery()
    {
        $items = GalleryItem::all();
        return view('admin.gallery', compact('items'));
    }

    public function addItem(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'name' => 'required|string',
            'image' => 'required|image',
        ]);

        // Store the image
        $path = $request->file('image')->store('gallery_images', 'public');

        // Save the new gallery item to the database
        GalleryItem::create([
            'name' => $request->name,
            'image_path' => $path,
        ]);

        return redirect()->route('admin.gallery');
    }

    public function deleteItem(GalleryItem $item)
    {
        // Delete the image file from storage
        if ($item->image_path) {
            Storage::delete('public/' . $item->image_path);  // Ensure Storage is used correctly
        }

        // Delete the gallery item from the database
        $item->delete();

        return redirect()->route('admin.gallery');
    }
}
