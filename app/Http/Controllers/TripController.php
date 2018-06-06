<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Trip;
use App\Destination;


class TripController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth', ['except' => ['index', 'show']]); //exceptの場合、ログインを求められない
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $trips = Trip::orderBy('created_at', 'asc')->get();
      $plucked_destinations = Destination::all()->pluck('area', 'id');

      return view('index', [
        'trips' => $trips,
        'plucked_destinations' => $plucked_destinations
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $plucked_destinations = Destination::all()->pluck('area', 'id');
      return view('create',[
        'plucked_destinations' => $plucked_destinations
      ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $validator = $request->validate([
          'trip_title' => 'required|max:255'
      ]);

      $trip = new Trip;
      //attributes
      $trip->title = $request->trip_title;
      $trip->description = $request->trip_description;
      $trip->destination_id = $request->trip_destination;

      if($request->trip_hero){
        $trip->hero_image_path = $request->trip_hero;
      } else {
        $trip->hero_image_path = asset('/image/default.jpg');
      }

      //後で調べる
      // $trip->best_season_from = $request->best_season_from;
      // $trip->best_season_to = $request->best_season_to;

      $trip->save();

      return redirect('/trips');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $plucked_destinations = Destination::all()->pluck('area', 'id');
      $trip = Trip::findOrFail($id);
      return view('show', [
        'trip' => $trip,
        'plucked_destinations' => $plucked_destinations
      ]);
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
      Trip::findOrFail($id)->delete();
      return redirect('/trips');
    }

    // custome

    /**
     * Search
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
      $q = $request->q;
      $plucked_destinations = Destination::all()->pluck('area', 'id');

      if ($q) {
        // filtering
        // SELECT * FROM Trip WHERE title LIKE '%:q%' OR description LIKE '%:q%'
        // :q <- $q <- request['q'] <- textbox
        $filtered_trips = Trip::where('title', 'LIKE', "%$q%")
                           ->orWhere('description', 'LIKE', "%$q%")
                           ->get();

        return view('index', [
          'trips' => $filtered_trips,
          'plucked_destinations' => $plucked_destinations
        ]);
      } else {
        // view index with all results
        $originals = Trip::orderBy('created_at', 'asc')->get();

        return view('index', [
          'trips' => $originals,
          'plucked_destinations' => $plucked_destinations
        ]);
      }
    }
}
