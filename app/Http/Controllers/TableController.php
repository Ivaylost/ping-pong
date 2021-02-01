<?php

namespace App\Http\Controllers;

use App\Date;
use App\Table;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = ['tables' => Table::all()];

        return view('admin.tables', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return void
     */
    public function create(Request $request)
    {
        $result = Table::where('name', $request->input('name'))->first();

        if ($result == null){
            $table = new Table();
            $table->fill($request->input());
            $res = $table->save();
        }

        return back();
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
        //
    }


    public function edit(Request $request, $id)
    {
        $validated = $request->validate([
            'date' => 'required|after:'.Carbon::yesterday()
        ]);

        $selected_date = $request->input('date');
        $sd = Date::where('reservation_date', '=', $selected_date)->first();

        if (!$sd){
            $sd = new Date();
            $sd->reservation_date = $selected_date;
            $sd->save();
            $sd->get();
        }

        $table = Table::find($id);
        $date = $table->selectedDate($sd->id);

        if(!$date){
            $reservations = Date::default_time_span();
            $table->dates()->attach($sd->id, ['reservations' => serialize($reservations)]);
            $date = $table->selectedDate($sd->id);
        }

        $data = [
            'table' => $table,
            'dates' => unserialize($date->pivot->reservations),
            'selected_date' => $selected_date
        ];

        return view('admin.dates', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $date)
    {
        $table = Table::find($id);
        $sd = Date::where('reservation_date', '=', $date)->first();
        $reservations = $sd->update_time_span($request->input('ids'));

        $table->dates()->where('date_id', $sd->id && 'table_id', $id)->detach();
        $table->dates()->attach($sd->id, ['reservations' => serialize($reservations)]);
        return redirect()->to('tables');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function date($id)
    {
        return view('admin.date', $data = ['id' => $id]);
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
