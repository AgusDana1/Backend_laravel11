<?php

namespace App\Http\Controllers\Api;

// import model "Post"
use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// import Facade "Validator"
use Illuminate\Support\Facades\Validator;

// import facade "Storage"
use Illuminate\Support\Facades\Storage;

// import Resource "PostResource"
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    /**
     * index/ latihan CRUD
     * 
     * @return void
     */

     public function index()
     {
        // mengambil semua post menggunakan pagination (6) halaman
        $posts = Post::latest()->paginate(6);

        // return collection dari post ke resource
        return new PostResource(true, 'List Post Succes', $posts);
     }

     /**
      * menambahkan method store untuk menginput data
      * 
      * @param mixed $request
      * @return void
      */

      public function store(Request $request)
      {
        // Mendefinisikan validator 
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpg,png,svg,gif,jpeg|max:2048', 
            'title' => 'required',
            'content' => 'required',
        ]); 

        // check apakah validasi data terkirim
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // upload image dan hashing nama file img agar tidak terjadi konflik
        $image = $request->file('image');
        $image->storeAs('public/posts', $image->hashName());

        // create new post 
        $post = Post::create([
            'image' => $image->hashName(),
            'title' => $request->title,
            'content' => $request->content,
        ]);

        // return collection
        return new PostResource(true, 'Data succes Added!', $post);
      }

      /**
       * menampilkan data with show
       * 
       * @param mixed $post
       * @return void
       */

       public function show($id)
       {
        // Cari post menggunakan ID
        $post = Post::find($id);

        // return collection for show data
        return new PostResource(true, 'Detail Data Post!', $post);
       }

       /**
        * update data
        * 
        * @param mixed $request
        * @param mixed $post
        * @return void
        */

        public function update(Request $request, $id) 
        {
            // definisikan validasi rules tanpa menambahkan image didalamnya
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'content' => 'required',
            ]);

            // check kesalahan menggunakan validator
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            // Cari post menggunakan ID
            $post = Post::find($id);

            // check jika image tidak kosong
            if ($request->hasFile('image')) {

                // upload image dan hashing nama file img agar tidak terjadi konflik
                $image = $request->file('image');
                $image->storeAs('public/posts', $image->hashName());

                // delete img yang lama
                Storage::delete('public/posts/'.basename($post->image));

                // update img dengan img yang baru
                $post->update([
                    'image' => $image->hashName(),
                    'title' => $request->title,
                    'content' => $request->content,
                ]);
            }else {
                // update post tanpa menggunakan img
                $post->update([
                    'title' => $request->title,
                    'content' => $request->content,
                ]);
            }

            // return collection
            return new PostResource(true, 'Data succes Update', $post);
        }

        /**
         * delete 
         * 
         * @param mixed $post
         * @return void
         */

         public function destroy($id)
         {
            // Cari post berdasarkan id
            $post = Post::find($id);

            // delete image
            Storage::delete('public/posts/'.basename($post->image));

            // delete post yang dibuat
            $post->delete();

            // return collection
            return new PostResource(true, 'Post Data succes Delete!', null);
         }
}
