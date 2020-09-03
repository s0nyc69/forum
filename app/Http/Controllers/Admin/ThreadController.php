<?php

namespace App\Http\Controllers\Admin;

use App\Channel;
use App\Contracts\ChannelContract;
use App\Http\Controllers\Controller;
use App\Thread;
use Illuminate\Http\Request;
use App\Contracts\ThreadContract;
use Exception;

class ThreadController extends Controller{

    protected $threads;

    public function __construct(ThreadContract $threads) {
        $this->middleware('auth')->except('index', 'show');
        $this->threads = $threads;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ChannelContract $channel){

        return view('admin.threads.index')->with([
            'threads' => $this->threads->with('posts')->orderBy('created_at', 'desc')->get(),
            'channels' => $channel->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ChannelContract $channel){
        return view('admin.threads.create')->with([
            'channels' => $channel->get()
        ]);
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
            $this->threads->create($request->all());
            return redirect()->route('admin.threads.index')->withMessage(trans('crud.record_created'));
        } catch (Exception $ex) {
            return redirect()->back()->withErrors($ex->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param ChannelContract $channel
     * @param ThreadContract $thread
     * @return \Illuminate\Http\Response
     */
    public function show(string $channelSlug, Thread $thread){
        $thread = $this->threads->with('posts', 'user', 'channel')->find($thread->id);
        return view('admin.threads.show')->with(['thread'=>$thread]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        return view('admin.threads.edit')->with(['thread'=>$this->threads->find($id)]);
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
            $this->threads->update($id, $request->all());
            return redirect()->route('admin.threads.index')->withMessage(trans('crud.record_updated'));
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
            $this->threads->delete($id);
            return redirect()->route('admin.threads.index')->withMessage(trans('crud.record_deleted'));
        } catch (Exception $ex) {
            return redirect()->route('admin.threads.index')->withErrors($ex->getMessage());
        }
    }
}

