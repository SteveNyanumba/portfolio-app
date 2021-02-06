<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;

class PortfoliosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Portfolio::with(['screenshots','category'])->get();
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
            'image'=>'required|mimes:png,jpg',
            'title'=>'required',
            'content'=>'required',
            'category'=>'required|integer',
            'completion'=>'required',
            'link'=>'required|active_url'
        ]);

        $image = $request->file('image');
        if (isset($image)) {
            $ext = $image->getClientOriginalExtension();
            $imagename = time().'.'.$ext;

            if (!file_exists('images/portfolio')) {
                mkdir('images/portfolio', 0777, true);
            }

            $image->move('images/portfolio', $imagename);
        }else{
            $imagename = 'default.jpg';
        }

        $portfolio = new Portfolio();
        $portfolio->category_id = $request->category;
        $portfolio->content = $request->content;
        $portfolio->title = $request->title;
        $portfolio->link = $request->link;
        $portfolio->completion = $request->completion;
        $portfolio->image = $imagename;

        $portfolio->save();
        return response('Successfully Created a new Portfolio Item');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Portfolio::find($id);
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
            'category_id'=>'required|integer',
            'link'=>'required'
        ]);

        $image = $request->file('image');
        if (isset($image)) {
            $ext = $image->getClientOriginalExtension();
            $imagename = time().'.'.$ext;

            if (!file_exists('images/portfolios')) {
                mkdir('images/portfolios', 0777, true);
            }

            $image->move('images/portfolios', $imagename);
        }else{
            $imagename = 'default.jpg';
        }

        $portfolio = Portfolio::find($id);
        $portfolio->category_id = $request->category_id;
        $portfolio->content = $request->content;
        $portfolio->title = $request->title;
        $portfolio->link = $request->link;
        $portfolio->completion = $request->completion;
        $portfolio->image = $imagename;

        $portfolio->save();
        return response('Successfully Updated your Portfolio Item');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $portfolio = Portfolio::find($id);
        unlink('images/portfolios/'.$portfolio->image);
        $portfolio->delete();

        return response('Successfully Deleted your Portfolio Item');
    }
}
