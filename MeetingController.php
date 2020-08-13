<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\file;
use DataTables;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class MeetingController extends Controller
{
    public function meeting(){
        $documents = file::all();

        return view('meeting',['files' => $documents]);
    }

    public function getMeeting(){
        $file = file::select('id', 'name','jenis_doc','file_path','created_at')->where('jenis_doc','meeting');
        return DataTables::of($file)
            ->addColumn('action', function($file) {
                $result = '';
                $result .= '<a href="'.route('meeting.download', $file->id).'" class="btn btn-success btn-sm"><i class="fa fa-download"></i></a>';
                return $result;
            })
            ->make(true);
        
    }

    public function download($id)
    {
        $data = file::findOrFail($id);
        return Storage::disk('public')->download($data->file_path);
    }



}
