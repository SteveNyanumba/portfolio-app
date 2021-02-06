<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Blog::with('group')->orderBy('id', 'desc')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'image'=>'required',
            'title'=>'required',
            'content'=>'required',
            'group_id'=>'required',
        ]);

        $image = $request->file('image');
        if (isset($image)) {
            $ext = $image->getClientOriginalExtension();
            $imagename = time().'.'.$ext;

            if (!file_exists('images/blogs')) {
                mkdir('images/blogs', 0777, true);
            }

            $image->move('images/blogs', $imagename);
        }else{
            $imagename = 'default.jpg';
        }

        $blog = new Blog();
        $blog->group_id = $request->group_id;
        $blog->content = $request->content;
        $blog->title = $request->title;
        $blog->image = $imagename;

        $blog->save();
        return response('Successfully Created your blog Item');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Blog::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'image'=>'required',
            'title'=>'required',
            'content'=>'required',
            'group_id'=>'required',
        ]);

        $image = $request->file('image');
        if (isset($image)) {
            $ext = $image->getClientOriginalExtension();
            $imagename = time().'.'.$ext;

            if (!file_exists('images/blogs')) {
                mkdir('images/blogs', 0777, true);
            }

            $image->move('images/blogs', $imagename);
        }else{
            $imagename = 'default.jpg';
        }

        $blog = Blog::find($id);
        $blog->group_id = $request->group_id;
        $blog->content = $request->content;
        $blog->title = $request->title;
        $blog->image = $imagename;

        $blog->save();
        return response('Successfully Created your blog Item');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::find($id);
        unlink('images/blogs/'.$blog->image);
        $blog->delete();

        return response('Successfully Deleted your blog Item');
    }
}
