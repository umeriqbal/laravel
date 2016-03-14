<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NiceAction;
use App\NiceActionLog;
use DB;

class NiceActionController extends Controller
{
    public function getHome()
    {
        $actions = NiceAction::orderBy('niceness', 'desc')->get();
        //$actions = DB::table('nice_actions')->get();
        //$logged_actions = NiceActionLog::whereHas('nice_action', function($query){
            //$query->where('name', '=', 'Hug');
        //})->get();
        $logged_actions = NiceActionLog::all();
        //$query = DB::table('nice_action_logs')
        //            ->join('nice_actions', 'nice_action_logs.nice_action_id', '=', 'nice_actions.id')
        //            ->where('nice_actions.name', '=', 'Hug')
        //            ->get();
        //$query = DB::table('nice_action_logs')
        //            ->where('id', '>', '3')
        //            ->count();
        
        //this will return true/false depending on query execution            
        //$query = DB::table('nice_action_logs')
        //                ->insert([
        //                    'nice_action_id' => DB::table('nice_actions')->select('id')->where('name', 'laugh')->first()->id
        //                   ]);
        
        //this will return insert ID
        //$query = DB::table('nice_action_logs')
        //              ->insertGetId([
        //                   'nice_action_id' => DB::table('nice_actions')->select('id')->where('name', 'laugh')->first()->id
        //                  ]);
               
        //$nice_action = NiceAction::where('name', 'laugh')->first();
        //$nice_action_log = new NiceActionLog();
        //$nice_action->logged_action()->save($nice_action_log);
        
        $hug = NiceAction::where('name', 'Smile')->first();
        if ($hug)
        {
            $hug->name = 'Laugh';
            $hug->update;
        }
        
        $smile = NiceAction::where('name', 'Smile')->first();
        if ($smile){
            //$smile->delete();
            
        }
        
        
        return view('home', ['actions' => $actions, 'logged_actions' => $logged_actions, 'db' => null]);
    }
    public function getNiceAction($action, $name = null)
    {
        if ($name === null){
            $name = 'you';
        }
        
        $nice_action = NiceAction::where('name', $action)->first();
        $nice_action_log = new NiceActionLog();
        $nice_action->logged_action()->save($nice_action_log);
        return view('actions.nice', ['action' => $action, 'name' => $name]);
    }
    
    public function postInsertNiceAction(Request $request)
    {
        $this->validate($request, [
                'name' => 'required | alpha | unique:nice_actions',
                'niceness' =>'required | numeric'
        ]);
        
        $action = new NiceAction();
        $action->name = strtolower($request['name']);
        $action->niceness = $request['niceness'];
        $action->save();
        
        $actions = NiceAction::all();
        return redirect()->route('home', ['action' => $actions]);
        //return view('home', ['actions' => $actions]);

    }
    
    private function transformName($name)
    {
        $prefix = 'King ';
        return $prefix . strtoupper($name);
    }
}