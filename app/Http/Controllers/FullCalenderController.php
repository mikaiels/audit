<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\events;

class FullCalenderController extends Controller
{
   /**
     * Write code on Method
     *
     * @return response()
     */
    public function index(Request $request)
    {
      $joborder2['title'] = 'Calender Appointment';
        if($request->ajax()) {
       
             $data = events::whereDate('start', '>=', $request->start)
                       ->whereDate('end',   '<=', $request->end)
                       ->get(['id', 'title', 'start', 'end']);
  
             return response()->json($data);
        }
  
      //  return view('fullcalender');

        return view('fullcalender')->with($joborder2);


    }
 
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function ajax(Request $request)
    {
 
        switch ($request->type) {
           case 'add':
              $event = events::create([
                  'title' => $request->title,
                  'start' => $request->start,
                  'end' => $request->end,
              ]);
 
              return response()->json($event);
             break;
  
           case 'update':
              $event = events::find($request->id)->update([
                  'title' => $request->title,
                  'start' => $request->start,
                  'end' => $request->end,
              ]);
 
              return response()->json($event);
             break;
  
           case 'delete':
              $event = events::find($request->id)->delete();
  
              return response()->json($event);
             break;
             
           default:
             # code...
             break;
        }
    }
}
