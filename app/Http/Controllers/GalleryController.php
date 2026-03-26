<?php

namespace App\Http\Controllers;

use App\Models\Gallery; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; 

class GalleryController extends Controller
{
   
    public function index()
    {
        $images = Gallery::orderBy('created_at')->paginate(12); 

    return view('gallery.index', compact('images'));
    }

  
    public function store(Request $request)
    {
        $request->validate([
            'images' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048' // Array validation
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                
                $path = $image->store('gallery', 'public');
                
                Gallery::create([
                    'image' => $path, 
                ]);
            }
        }

        return redirect()->route('gallery.index')->with('success', 'Images uploaded successfully!');
    }

   
    public function destroy(string $id)
    {
        $image = Gallery::findOrFail($id);
        
        Storage::disk('public')->delete($image->image);
        
        $image->delete();

        return redirect()->route('gallery.index')->with('success', 'Image deleted successfully!');
    }
}