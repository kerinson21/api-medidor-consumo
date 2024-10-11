<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assigned;
use Illuminate\Support\Facades\DB;
use App\Models\Reading;
use Carbon\Carbon;

class AssignedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assigneds = Assigned::join('users', 'assigneds.iduser', '=', 'users.id')
                            ->join('devices', 'assigneds.iddevice', '=', 'devices.id')
                            ->select('users.name as user', 'users.email as email', 'devices.name as device', 'devices.id as iddevice')
                            ->get();
        return $assigneds;
    }
    public function readingDevice(){
        $mytime = Carbon::now('America/Guatemala');
        $result = DB::table('readings as r')
        ->select(
            DB::raw("DATE_FORMAT(r.date_hour, '%Y-%m') AS Mes"),
            DB::raw("SUM(r.consumption) AS consumo"),
            'd.name as dispositivo',
            'u.name as user'
        )
        ->join('devices as d', 'r.iddevice', '=', 'd.id')
        ->join('assigneds as a', 'r.iddevice', '=', 'a.iddevice')
        ->join('users as u', 'a.iduser', '=', 'u.id')
        ->whereMonth('r.date_hour', '=', $mytime->month)
        ->whereYear('r.date_hour', '=', $mytime->year)
        ->groupBy('Mes', 'd.name', 'u.name')
        ->orderBy('consumo', 'desc')
        ->get();

    return $result;

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
        //
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
