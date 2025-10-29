<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create()
    {
        return view('create');
    }

    // public function filestore(Request $request){
    //     $post = new Post;
    //     $post->name = $request->name;
    //     $post->description = $request->description;
    //     $post->image = $request->image;

    //     $post->save();
    //     //return $request->name;
    // }


    //----------------------Using the try/catch to pass a message--------------------------------------



    // public function filestore(Request $request)
    // {
    //     try {
    //         $post = new Post;
    //         $post->name = $request->name;
    //         $post->description = $request->description;
    //         $post->image = $request->image;

    //         $post->save();

    //         return "Saved!";
    //     } catch (\Exception $e) {
    //         return $e->getMessage();
    //     }
    // }

    //-------------------------------------------------------

    public function filestore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'nullable|mimes:jpg,jpeg,png'
        ]);

        try {

            //create post

            $post = new Post;
            $post->name = $request->name;
            $post->description = $request->description;

            // 📷 Handle image upload
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads'), $filename); // Save to public/uploads

                $post->image = $filename; // Save filename in DB
            } else {
                $post->image = null; // Or set a default image if you want
            }

            $post->save();

            flash()->success('Your post has been successfully created!');

            return redirect()->route('home')->with('success_animation', '1');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }








    public function editData($id)
    {
        $post = Post::findOrFail($id);
        return view('edit', ['ourPost' => $post]);
    }

    public function updateData($id, Request $request)
    {

        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'nullable|mimes:jpg,jpeg,png'
        ]);

        try {

            // update post

            $post = Post::findOrFail($id);
            $post->name = $request->name;
            $post->description = $request->description;

            // 📷 Handle image upload
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads'), $filename); // Save to public/uploads

                $post->image = $filename; // Save filename in DB
            } else {
                $post->image = null; // Or set a default image if you want
            }

            $post->save();

            flash()->success('Your post has been successfully updated!');

            return redirect()->route('home')->with('success_animation', '1');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }



    public function deleteData($id)
    {

        $post = Post::findOrFail($id);
        $post->delete();

        flash()->success('Your post has been successfully deleted!');

        return redirect()->route('home')->with('success_animation', '1');
    }
}
