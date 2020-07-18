<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Post::orderBy('id','desc')->paginate(10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //check validation
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:10|max:255|unique:posts',
            'content' => 'required|string|min:30|max:1500',
            'user_id' => 'required|integer'
        ]);

        // validation error customize show error message
        if ($validator->fails()) {
            return ['error'=>$validator->errors()->first()];
        }else{

            // after validation if some thing went wrong
            $validator->after(function ($validator) {
                if ($this->somethingElseIsInvalid()) {
                    $validator->errors()->add('field', 'Something is wrong with this field!');
                }
            });

            // insert securely into database
            try {
                //save informations
                $post = new Post();
                    $post->title = $request['title'];
                    $post->content = $request['content'];
                    $post->user_id = $request['user_id'];
                if($post->save()){
                    //post was saved successfully
                    return Post::orderBy('id','desc')->first();
                    // return ['success'=>'post successfully saved in the database'];
                }else{
                    return ['error'=>'post does not saved'];
                }

            } catch (\Throwable $th) {
                return ['error'=>'post can not be saved'];
            }
            // return proper message
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $post = Post::find($id);
            if($post !=null){
                return $post;
            }else{
                return ['error'=>'post does not exist'];
            }

        } catch (\Throwable $th) {
            return ['error'=> 'system cant read post'];
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //validation check
        //check validation
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:10|max:255|unique:posts',
            'content' => 'required|string|min:30|max:1500',
            'user_id' => 'required|integer'
        ]);

        // validation error customize show error message
        if ($validator->fails()) {
            return ['error'=>$validator->errors()->first()];
        }else{

            // after validation if some thing went wrong
            $validator->after(function ($validator) {
                if ($this->somethingElseIsInvalid()) {
                    $validator->errors()->add('field', 'Something is wrong with this field!');
                }
            });

            // insert securely into database
            try {
                //save informations
                $post = Post::find($id);
                if($post !=null){
                    //post is already exits
                        $post->title = $request['title'];
                        $post->content = $request['content'];
                        $post->user_id = $request['user_id'];
                    if($post->update()){
                        //post was saved successfully
                        return Post::orderBy('id','desc')->first();
                        // return ['success'=>'post successfully saved in the database'];
                    }else{
                        return ['error'=>'post does not saved'];
                    }
                }else{
                    //post does not exist and i cant upate it
                    return ['error'=> 'post does not exist'];
                }

            } catch (\Throwable $th) {
                return ['error'=>'post can not be saved'];
            }
            // return proper message
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $post = Post::find($id);
            if($post !=null){

                if($post->delete()){
                    return ['success'=>'post successfully deleted'];
                }else{
                    return ['delete'=>'post cant be deleted'];
                }
            }else{
                return ['error'=>'post does not exist'];
            }

        } catch (\Throwable $th) {
            return ['error'=>'system cant delete post'];
        }
    }
}
