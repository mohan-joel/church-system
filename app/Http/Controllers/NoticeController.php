<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Notice;

class NoticeController extends Controller
{
    //
    public function show()
    {
        $c = 1;
        $fellowships = DB::table('fellowships')->get();
        $leaders = DB::table('youths')->get();
        $preachers = DB::table('youths')->get();
        $notices = Notice::with('lead')->get();
        $notices = Notice::with('sermon')->get();
        $year = date('Y');
        return view('user.notice',compact('fellowships','leaders','preachers','notices','year','c'));
    }

    public function add(Request $req)
    {
        $req->validate([
            'fellowship'=>'required|string',
            'vanue'=>'required|string',
            'date'=>'required|date',
            'leadBy'=>'required',
            'sermonBy'=>'required'
        ]);

        $notice = new Notice();
        $notice->fellowship = $req->fellowship;
        $notice->vanue = $req->vanue;
        $notice->date = $req->date;
        $notice->lead_id = $req->leadBy;
        $notice->sermon_id = $req->sermonBy;
        $notice->save();
        $req->session()->flash('success','Notices Added Successfully');
        return redirect('/show-notices');
    }

    public function delete($id)
    {
        Notice::find($id)->delete();
        return redirect()->back()->with('success','Notice Deleted Successfully');
    }

    public function getNoticeDetail($id)
    {
        $notice = Notice::where('id',$id)->get();
        return response()->json(['data'=>$notice]);
    }

    public function update(Request $req)
    {
        $req->validate([
            'fellowship'=>'required|string',
            'date'=>'required|date',
            'vanue'=>'required|string',
            'leadBy'=>'required',
            'sermonBy'=>'required'
        ]);

        $id = $req->notice_id;
        $notice = Notice::find($id);
        $notice->fellowship = $req->fellowship;
        $notice->date = $req->date;
        $notice->leadBy = $req->leadBy;
        $notice->sermonBy = $req->sermonBy;
        $notice->update();
        $req->session()->flash('success','Notices Updated Successfully');
        return redirect('/show-notices');
    }

    public function printPreview($lead_id,$sermon_id)
    {
        $lead = DB::table('youths')->where('id',$lead_id)->value('name');
        $leadImg =  DB::table('youths')->where('id',$lead_id)->value('photo');
        $sermon = DB::table('youths')->where('id',$sermon_id)->value('name');
        $sermonImg =  DB::table('youths')->where('id',$sermon_id)->value('photo');
        $date = DB::table('notices')->where('lead_id',$lead_id)->where('sermon_id',$sermon_id)->value('date');
        $fellowship = DB::table('notices')->where('lead_id',$lead_id)->where('sermon_id',$sermon_id)->value('fellowship');
        return view('user.printPreview',compact('lead','sermon','leadImg','sermonImg','date','fellowship'));
    }

    public function noticePrintPreview()
    {
        $b=1;
        $notices = Notice::with('lead')->get();
        $notices = Notice::with('sermon')->get();
        return view('user.noticePrintPreview',compact('notices','b'));
    }

    public function SearchNotice(Request $request)
    {
        $c = 1;
        $year = date('Y');
        $fellowships = DB::table('fellowships')->get();
        $leaders = DB::table('youths')->get();
        $preachers = DB::table('youths')->get();
        $notices = Notice::with('lead')->get();
        $notices = Notice::with('sermon')->get();
        $searchNotice = $request->notices;
        $notices = Notice::where('date','like','%'.$searchNotice.'%')->get();
        return view('user.notice',compact('c','year','notices','fellowships','leaders','preachers'));
    }
}
