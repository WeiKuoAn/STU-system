<?php

namespace App\Http\Controllers;

use App\Models\WorkSheet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class WorkSheetController extends Controller
{
    public function index(Request $request)
    {
        $worksheets = WorkSheet::where('status', '0');
        if($request){
            $startdate = $request->startdate;
            if($startdate){
                $worksheets = $worksheets->where('created_at','>=',$startdate);
            }
            $lastdate = $request->lastdate;
            if($lastdate){
                $worksheets = $worksheets->where('created_at','<=',$lastdate);
            }
            $title = $request->title;
            if($title){
                $worksheets = $worksheets->where('title','like',"%".$title."%");
            }
            $person = $request->person;
            if($person){
                $worksheets = $worksheets->where('contact_person','like',"%".$person."%");
            }
        }
        $worksheets = $worksheets->orderby('updated_at','DESC')->get();
        return view('worksheet')->with(['worksheets' => $worksheets])->with(['request'=>$request]);
    }

    public function overindex(Request $request)
    {
        $oversheets = WorkSheet::where('status', '1');
        if($request){
            $startdate = $request->startdate;
            if($startdate){
                $oversheets = $oversheets->where('created_at','>=',$startdate);
            }
            $lastdate = $request->lastdate;
            if($lastdate){
                $oversheets = $oversheets->where('created_at','<=',$lastdate);
            }
            $title = $request->title;
            if($title){
                $oversheets = $oversheets->where('title','like',"%".$title."%");
            }
            $person = $request->person;
            if($person){
                $oversheets = $oversheets->where('contact_person','like',"%".$person."%");
            }
        }
        $oversheets = $oversheets->orderby('updated_at','DESC')->get();
        return view('oversheet')->with(['oversheets' => $oversheets])->with(['request'=>$request]);
    }

    public function create()
    {
        return view('addworksheet');
    }

    public function store(Request $request)
    {
        $worksheet = new WorkSheet;
        $worksheet->user_id = Auth::user()->id;
        $worksheet->title = $request->title;
        $worksheet->data_where = $request->data_where;
        $worksheet->contact_person = $request->contact_person;
        $worksheet->condition = $request->condition;
        $worksheet->save();
        return redirect()->route('worksheet');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($workId)
    {
        $worksheet = WorkSheet::where('id', $workId)->first();
        return view('editWorksheet')->with('worksheet',$worksheet);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        if ($request->work_edit) {
            $worksheet = WorkSheet::where('id', $request->work_edit)->first();
            $old_condition = $worksheet->condition;
            if ($old_condition != $request->condition) {
                $worksheet->condition = $request->condition;
                $worksheet->save();
            }
        } elseif ($request->work_over) {
            $worksheet = WorkSheet::where('id', $request->work_over)->first();
            $worksheet->status = '1';
            $worksheet->check_user_id = Auth::user()->id;
            $worksheet->save();
        }elseif ($request->work_del) {
            $worksheet = WorkSheet::where('id', $request->work_del)->first();
            $worksheet->delete();
        }
        return redirect()->action([WorkSheetController::class, 'index']);
    }

    public function update(Request $request , $workId)
    {
        $worksheet = WorkSheet::where('id', $workId)->first();
        $worksheet->title = $request->title;
        $worksheet->data_where = $request->data_where;
        $worksheet->contact_person = $request->contact_person;
        $worksheet->condition = $request->condition;
        $worksheet->save();
        return redirect()->action([WorkSheetController::class, 'index']);
    }

    public function overupdate(Request $request)
    {
        if ($request->work_update) {
            $worksheet = WorkSheet::where('id', $request->work_update)->first();
            $worksheet->status = '0';
            $worksheet->check_user_id = Auth::user()->id;
            $worksheet->save();
        }
        return redirect()->action([WorkSheetController::class, 'overindex']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
}
