<?php

namespace App\Http\Controllers\API;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data['post']=Post::all();
        return response()->json([
            'status' => true,
            'message' => 'All post data',
            'data' => $data
        ],200);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateUser = Validator::make(
            $request->all(),
            [
                'title' => 'required',
                'descripton' => 'required',
                'image' => 'required|mimes:png,jpg,jpeg,gif',
            ]
        );
    
        if ($validateUser->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation Error',
                'errors' => $validateUser->errors()->all()
            ], 401);
        }
    
        $img = $request->image;
        $ext = $img->getClientOriginalExtension();
        $imageName = time() . '.' . $ext;
        $img->move(public_path() . '/uploads', $imageName);
    
        $post = Post::create([
            'title' => $request->title,
            'descripton' => $request->descripton,
            'image' => $imageName,
            'author' => $request->user()->email, // Automatically set author using the logged-in user's email
        ]);
    
        return response()->json([
            'status' => true,
            'message' => 'Post Created Successfully',
            'post' => $post,
        ], 200);
    }
    

    /**
     * Display the specified resource.
     */
    
    public function show(string $id)
    {
        //
        $data['post'] = Post::select(
            'id',
            'title',
            'descripton',
            'image'
        )->where(['id' => $id])->get();
        return response() -> json([
            'status' => true,
            'post' => 'Your Single Post',
            'data' => $data

        ],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validateUser = Validator::make(
            $request->all(),
            [
                'title' => 'required',
                'descripton' => 'required',
                'image' => 'required|mimes:png,jpg,jpeg,gif',
            ]
            ); 

        if($validateUser->fails()){
            return response() -> json([
                'status' => false,
                'message' => 'Validation Error',
                'errors' => $validateUser->errors()->all()
            ],401);
        }
        $postImage = Post::select('id','image')
        ->where(['id' => $id])->get();
        if($request->image != ''){
            $path = public_path(). '/uploads';

            if ($postImage[0]->image != '' && $postImage[0]->image != null){
                $old_file = $path. $postImage[0]->image;
                if(file_exists($old_file)){
                    unlink($old_file);
                }
            }
        }else{
            $imageName = $postImage[0]->image;
        }



        $img = $request->image;
        $ext = $img->getClientOriginalExtension();
        $imageName = time(). '.' . $ext;
        $img->move(public_path(). '/uploads',$imageName);

        $post = Post::where(['id' => $id])->update([
            'title' => $request->title,
            'descripton' => $request->descripton,
            'image' => $imageName,

        ]);
        return response() -> json([
            'status' => true,
            'message' => 'Post updated Successfully',
            'post' => $post,    
        ],200);

        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $imagePath = Post::select('image')->where('id',$id)->get();



        $filePath = public_path(). '/uploads/'. $imagePath[0]['image'];
        unlink($filePath);

        $post = Post::where('id',$id)->delete();    

        return response() -> json([
            'status' => true,
            'message' => 'Post deleted Successfully',
            'post' => $post,    
        ],200);
    }
}
