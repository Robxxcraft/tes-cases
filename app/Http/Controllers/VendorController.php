<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\File;
use DateTime;

class VendorController extends Controller
{
    public function index(Request $request)
    {
        $files = File::when($request->has('search'), function($q)use($request){
            $q->where('filename', 'like', '%'.$request->query('search').'%')->orWhere('path', 'like', '%'.$request->query('search').'%')->orWhere('goods_qty', 'like', '%'.$request->query('search').'%');
        })->orderBy('upload_date', 'desc')->paginate(6);

        return view('vendor.manage', ['files' => $files]);
    }
    
    public function create()
    {
       return view('vendor.create');
    }

    public function createPost(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:flac,wav,mp3,m4v,avi,flv,mp4,3gp,webm,mkv,ogg,gif,jpg,png,jpeg,ppt,pptx,doc,docx,pdf,xls,xlsx,zip,rar,7z|max:8192',
            'goods_qty' => 'required|integer'
        ],
        [
            'file.required' => ':attribute not selected',
        ]);
        
        $fileName = time().'_'.$request->file('file')->getClientOriginalName();
        $path = $request->file('file')->move(public_path('files'), $fileName);

        File::create([
            'filename' => $fileName,
            'path' => $path,
            'goods_qty' => $request->goods_qty,
            'upload_date' => new DateTime(),
        ]);
            
        return redirect()->to('/vendor')->with('alert', 'File uploaded successfully')->with('alert-class', 'alert-success');
    }

    public function download($id)
    {
        $file = File::findOrFail($id);
        return response()->download($file->path);
    }
    
}