<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contracts\ChannelContract;
use Exception;

class ChannelController extends Controller{
    
    protected $channels;

    public function __construct(ChannelContract $channels) {
        $this->channels = $channels;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('admin.channels.index')->with(['channels'=>$this->channels->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('admin.channels.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $this->validate($request, []);
        
        try{
            $this->channels->create($request->all());
            return redirect()->route('admin.channels.index')->withMessage(trans('crud.record_created'));
        } catch (Exception $ex) {
            return redirect()->back()->withErrors($ex->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        return view('admin.channels.show')->with(['channel'=>$this->channels->find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        return view('admin.channels.edit')->with(['channel'=>$this->channels->find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $this->validate($request, []);
        
        try{
            $this->channels->update($id, $request->all());
            return redirect()->route('admin.channels.index')->withMessage(trans('crud.record_updated'));
        } catch (Exception $ex) {
            return redirect()->back()->withInput()->withErrors($ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        try{
            $this->channels->delete($id);
            return redirect()->route('admin.channels.index')->withMessage(trans('crud.record_deleted'));
        } catch (Exception $ex) {
            return redirect()->route('admin.channels.index')->withErrors($ex->getMessage());
        }
    }
}

