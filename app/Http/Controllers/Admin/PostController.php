<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\ThreadContract;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contracts\PostContract;
use Exception;

class PostController extends Controller{

    protected $posts, $thread;

    public function __construct(PostContract $posts, ThreadContract $thread) {
        $this->middleware('auth')->except('index', 'show');
        $this->posts = $posts;
        $this->thread = $thread;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('admin.posts.index')->with(['posts'=>$this->posts->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('admin.posts.create');
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
            if ($request->has('thread_id')){
                $this->thread->addPost($request);
            }
            return redirect()->back()->withMessage(trans('crud.record_created'));
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
        return view('admin.posts.show')->with(['post'=>$this->posts->find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        return view('admin.posts.edit')->with(['post'=>$this->posts->find($id)]);
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
            $this->posts->update($id, $request->all());
            return redirect()->route('admin.posts.index')->withMessage(trans('crud.record_updated'));
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
            $this->posts->delete($id);
            return redirect()->route('admin.posts.index')->withMessage(trans('crud.record_deleted'));
        } catch (Exception $ex) {
            return redirect()->route('admin.posts.index')->withErrors($ex->getMessage());
        }
    }
}

