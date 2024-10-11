<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reading;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReadingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id= $request->iduser;
        $mytime = Carbon::now('America/Guatemala');
        $fecha =  Carbon::parse($mytime->format('Y/m/d'));
        
        $readings = Reading::whereDate('date_hour', $fecha)
                           ->selectRaw("DATE_FORMAT(date_hour,'%l %p' ) as hour, SUM(consumption) as total")
                           ->groupBy('hour')
                           ->orderBy('hour')
                           ->where('iddevice', '=', $id)
                           ->get();
        return $readings;
        
    }

    public function monthly(Request $request){
        Carbon::setLocale('es');
        $id = $request->iduser;
        $mytime = Carbon::now('America/Guatemala');
        $dateNow = Carbon::parse($mytime->format('Y/m/d'));
        $result = Reading::select(
            DB::raw('YEAR(date_hour) as year'),
            DB::raw('MONTH(date_hour) as month'),
            DB::raw('SUM(consumption) as total_month')
            
        )
        ->whereMonth('date_hour', '=', $mytime->month)
        ->groupBy('year', 'month')
        ->where('iddevice', '=', $id)
        ->get();
        $now = $dateNow->isoFormat('dddd, D [de] MMMM [de] YYYY');
        return response()->json([
            'total' => $result[0],
            'date' => $now
        ]);
        
    }
    public function year(Request $request){
        
        $id = $request->iduser;
        $mytime = Carbon::now('America/Guatemala');
        //$dateNow = Carbon::parse($mytime->format('Y/m/d'));
        $result = Reading::selectRaw("MONTHNAME(date_hour) as month, SUM(consumption) as total")
        ->whereYear('date_hour', $mytime->year) // Filtra por el año actual
        ->groupBy('month')
        ->orderBy('month')
        ->where('iddevice', $id)
        ->get();
        Carbon::setLocale('es');
        return response()->json($result);
        
    }
    public function day(Request $request){
        $id= $request->iduser;
        $mytime = Carbon::now('America/Guatemala');
        $fecha =  $request->date;
        //Carbon::parse($mytime->format('Y/m/d'));
        
        $readings = Reading::whereDate('date_hour', $fecha)
                           ->selectRaw("DATE_FORMAT(date_hour,'%l %p' ) as hour, SUM(consumption) as total")
                           ->groupBy('hour')
                           ->orderBy('hour')
                           ->where('iddevice', '=', $id)
                           ->get();
        return $readings;
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
        $mytime = Carbon::now('America/Guatemala');
        $reading = new Reading();
        $reading->iddevice = $request->iddevice;
        $reading->consumption = $request->consumption;
        $reading->date_hour = $mytime->format('Y-m-d H:i:s');
        $reading->save();
        return 'Lectura Recibida';
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
