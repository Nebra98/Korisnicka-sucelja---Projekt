<?php

namespace App\Http\Controllers;

use App\Album;
use App\Photo;
use App\User;
use Auth;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $photos = Photo::where([

            ['songName', '!=', Null],
            [function ($query) use ($request){
                if (($term = $request->term)) {
                    $query->orWhere('songName', 'LIKE', '%' . $term . '%')->get();
                }
            }]
        ])->orderBy("songName", "asc")->paginate(2);

        $albums = Album::where([

            ['name', '!=', Null],
            [function ($query) use ($request){
                if (($term = $request->term)) {
                    $query->orWhere('name', 'LIKE', '%' . $term . '%')->get();
                }
            }]
        ])->orderBy("name", "asc")->paginate(5);

        $users = User::all();
        // $albums = Album::all();

        return view('index', compact('photos'))
            ->with('i', (request()->input('page', 1)-1)*5)->with('users', $users)->with('albums', $albums);






       // return view('index')->with('users', $users)->with('albums', $albums)->with('photos', $photos);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $album = Album::with('Photos')->findOrFail($id);
        $files  =   Photo::all();
        $users = User::all();

        return view('show', compact('files'))->with('album', $album)->with('users', $users);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
