<?php

namespace App\Http\Controllers\Agreements;

use App\Models\Agreements\Stage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class StageController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->hasFile('file'));
        $stage = new Stage($request->All());
        if($request->hasFile('file'))
            $stage->file = $request->file('file')->store('ionline/agreements/agg_stage', ['disk' => 'gcs']);
        $stage->save();

        session()->flash('info', 'Se agregó el evento "'.$stage->type.'"');

        return redirect()->back();
    }

    public function download(Stage $file)
    {
        return Storage::disk('gcs')->response($file->file, mb_convert_encoding($file->name,'ASCII'));
    }

}
