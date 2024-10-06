<?php

namespace App\Http\Controllers\Programmings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Programmings\ActivityItem;
use App\Models\Establishment;
use App\Models\Commune;
use App\Models\Programmings\Programming;

class ActivitiesItemController extends Controller
{
    public function index(Request $request)
    {
        //dd($request->id);
        $activityitems = ActivityItem::where('activity_id',$request->activityprogram_id)->OrderBy('id')->get();
        return view('programmings/activityItems/index')->withActivityItems($activityitems);
    }

    public function create(Request $request)
    {
        $establishments = Establishment::where('type','CESFAM')->OrderBy('name')->get();
        $communes = Commune::All()->SortBy('name');
        return view('programmings/activityItems/create')->withEstablishments($establishments)->withCommunes($communes);
    }

    public function store(Request $request)
    {
        //dd($request->All());
        $programming = new Programming($request->All());
        $programming->year = date('Y', strtotime($request->date));
        $programming->description = $request->description;
        $programming->establishment_id = $request->establishment;
        $programming->user_id = '16966444';
       
        $programming->save();

        session()->flash('info', 'Se ha iniciado una nueva Programación Operativa');

        return redirect()->back();
    }
}
