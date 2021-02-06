<?php

namespace App\Http\Controllers;

use App\Models\Screenshot;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ScreenshotsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Screenshot::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'portfolio_id'=>'required',
            'screenshot'=>'required',
        ]);

        $image = $request->file('screenshot');
        if (isset($image)) {
            $title = 'port_'.$request->portfolio_id;
            $time = Carbon::now()->getTimestamp();
            $ext = $image->getClientOriginalExtension();

            $shotname = $title.'-'.$time.'.'.$ext;

            if (!file_exists('images/portfolio/screenshots')){
                mkdir('images/portfolio/screenshots');
            }

            $image->move('images/portfolio/screenshots', $shotname);
        }else{
            $shotname = 'default.jpg';
        }

        $shot = new Screenshot();
        $shot->portfolio_id = $request->portfolio_id;
        $shot->screenshot = $shotname;

        $shot->save();
        return response('Successfully uploaded a screenshot your Portfolio Item');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Screenshot::find($id);
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
        $this->validate($request,[
            'portfolio_id'=>'required',
            'screenshot'=>'required',
        ]);

        $image = $request->file('screenshot');
        if (isset($image)) {
            $title = 'port_'.$request->portfolio_id;
            $time = Carbon::now()->getTimestamp();
            $ext = $image->getClientOriginalExtension();

            $shotname = $title.'-'.$time.'.'.$ext;

            if (!file_exists('images/portfolio/screenshots')){
                mkdir('images/portfolio/screenshots');
            }

            $image->move('images/portfolio/screenshots', $shotname);

        }

        $shot = Screenshot::find($id);
        $shot->portfolio_id = $request->portfolio_id;
        $shot->screenshot = $shotname;

        $shot->save();
        return response('Successfully edited a screenshot your Portfolio Item');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shot = Screenshot::find($id);
        $shot->unlink('images/portfolio/screenshot/'.$shot->screenshot);
        $shot->delete();

        return response('Successfully Deleted your screenshot', 204);
    }
}
