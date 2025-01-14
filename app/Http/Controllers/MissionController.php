<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use PDF;
use App\Models\Driver;
use App\Models\Ville;
use App\Models\Car;
use App\Models\Region;
use Illuminate\Http\Request;

class MissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $missions = Mission::with("driver")->orderBy('created_at', 'desc')->get();
        return view('missions.index', ['missions' => $missions]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $cars = Car::all();
        $driver = Driver::all();
        // $region = Region::all();
        $ville = Ville::all();
        $missionCount = Mission::all()->count();
        $models = $cars->groupBy('model');
        // dd($region);
        return view('missions.store', [
            'drivers' => $driver, 
            'cars' => $cars, 
            "models" => $models,
            // 'regions' => $region, 
            'count' => $missionCount,
            'villes' => $ville
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        $req->validate([
            "serial_number" => "required",
            "car" => "required",
            "type" => "required",
            "driver" => "required",
            "date_start" => "required",
            "date_end" => "required",
            "avance" => "required",
            'permission' => "required",
            "agent" => "required"

        ]);

        $mission = Mission::create([
            'serial_number' => $req->serial_number . "/" . date('Y'),
            'start_date' => $req->date_start,
            'end_date' => $req->date_end,
            "type" => $req->type,
            "agent" => $req->agent,
            'car_id' => $req->car,
            'driver_id' => $req->driver,
            'des_coll_terr' => $req->des_coll_terr,
            'dep_coll_terr' => $req->dep_coll_terr,
            "avance" => $req->avance,
            "reste" => $req->reste,
            'depart_ville' => $req->dep_ville,
            'destination_ville' => $req->des_ville,
            'permission' => $req->permission,
            'user_id' => auth()->user()->id
        ]);

        if($req->download == "true"){

            $notification = array(
                'message' =>  __('translation.createdSuccess'),
                'alert_type' => 'success',
                'download_url' => '/downloadPdf'. '/' . $mission->id
            );

            return response()->json($notification);
        }

        $notification = array(
            'message' =>  __('translation.createdSuccess'),
            'alert_type' => 'success',
        );

        return response()->json($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(Mission $mission)
    {
        //
        return view('missions.show', [
            'mission' => $mission
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mission $mission)
    {
        //

        $cars = Car::all();
        $driver = Driver::all();
        $ville = Ville::all();
        $missionCount = Mission::all()->count();
        $models = $cars->groupBy('model');
        return view('missions.edit', [
            'drivers' => $driver, 
            'cars' => $cars, 
            "models" => $models,
            'villes' => $ville,
            'mission' => $mission
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, Mission $mission)
    {
        // 
        $req->validate([
            "serial_number" => "required",
            "car" => "required",
            "type" => "required",
            "driver" => "required",
            "date_start" => "required",
            "date_end" => "required",
            "avance" => "required",
            'permission' => "required",
            "agent" => "required"
        ]);


        $mission->serial_number = $req->serial_number . "/" . date('Y');
        $mission->start_date = $req->date_start;
        $mission->end_date = $req->date_end;
        $mission->type = $req->type;
        $mission->agent = $req->agent;
        $mission->car_id = $req->car;
        $mission->driver_id = $req->driver;
        $mission->dep_coll_terr = $req->des_coll_terr;
        $mission->des_coll_terr = $req->dep_coll_terr;
        $mission->avance = $req->avance;
        $mission->reste = $req->reste;
        $mission->depart_ville = $req->dep_ville;
        $mission->destination_ville = $req->des_ville;
        $mission->permission = $req->permission;
        $mission->save();

        // dd($req->download);
        if($req->download == "true"){
            $notification = array(
                'message' =>  __('translation.updatedSuccess'),
                'alert_type' => 'success',
                'download_url' => '/downloadPdf'. '/' . $mission->id
            );

            return response()->json($notification);
        }

        $notification = array(
            'message' =>  __('translation.updatedSuccess'),
            'alert_type' => 'success',
        );

        return response()->json($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mission $mission)
    {
        //
        Mission::where('id', $mission->id)->delete();
        $notification = array(
            'message' =>  __('translation.deletedSuccess'),
            'alert-type' => 'success',
        );
        return response()->json($notification);
    }

    public function deleteMany(Request $req)
    {
        $req->validate([
            "ids" => "required|array",
        ]);

        Mission::whereIn('id', $req->ids)->delete();

        $notification = array(
            'message' => 'Many Mission Deleted Successfully',
            'alert-type' => 'success'
        );
        return response()->json($notification);
    }

    public function downloadPDF(Request $req)
    {
        $mission = Mission::find($req->id);
        $pdf = PDF::loadView('missions.pdf', [
            "mission" => $mission->load('car', 'driver', 'desVille', 'depVille')
        ]);
        return $pdf->download('missions_'. $mission->serial_number . '.pdf');
    }

    public function filter(Request $req)
    {

        $query = Mission::with("driver")->orderBy('created_at', 'desc');
        
        if($req->year != "all"){
            $query->whereRaw("YEAR(created_at) = ?", [$req->year]);
        }

        if($req->month != "all"){
            $query->whereRaw("MONTH(created_at) = ?", [$req->month]);
        }

        $missions = $query->get();

        // dd($req->month);
        return view("missions.index", [
            "missions" => $missions, 
            "sMonth" => $req->month, 
            "count" => $missions->count(), 
            "sYear" => ($req->year != "all") ? $req->year : null,
        ]);
    }
}
