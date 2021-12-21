<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\Pinjam;

class PinjamController extends Controller
{
    public function index()
    {
        $pinjams = Pinjam::all();

        if(count($pinjams)>0)
        {
            return response([
                'message' => 'Retrieve All Success',
                'data' => $pinjams
            ],200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ],400);
    }

    public function show($id)
    {
        $pinjam = Pinjam::find($id);

        if(!is_null($pinjam))
        {
            return response([
                'message' => 'Retrieve Pinjam Success',
                'data' => $pinjam
            ],200);
        }

        return response([
            'message' => 'Pinjam Not Found',
            'data' => null
        ],404);
    }

    public function store(Request $request)
    {
        $storeData = $request->all();
        $validate = Validator::make($storeData,[
            'nama_peminjam' => 'required',
            'npm' => 'required',
            'judul_buku' => 'required'
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()],400);

        $storeData['password'] = bcrypt($request->password);
        $pinjam = Pinjam::create($storeData);    
        return response([
            'message' => 'Add Pinjam Success',
            'data' => $pinjam
        ],200);
    }

    public function destroy($id)
    {
        $pinjam = Pinjam::find($id);

        if(is_null($pinjam))
        {
            return response([
                'message' => 'Pinjam Not Found',
                'data' => null
            ],404);
        }

        if($pinjam->delete())
        {
            return response([
                'message' => 'Delete Pinjams Success',
                'data' => $pinjam
            ],404);
        }

        return response([
            'message' => 'Delete Pinjam Failed',
            'data' => null
        ],400);
    }

    public function update(Request $request,$id)
    {
        $pinjam = Pinjam::find($id);
        if(is_null($pinjam))
        {
            return response([
                'message' => 'Pinjam Not Found',
                'data' => null
            ],404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData,[
            'nama_peminjam' => 'required',
            'npm' => 'required',
            'judul_buku' => 'required'
        ]);

        if ($validate->fails())
            return response(['message' => $validate->errors()],400);

        $pinjam->nama_peminjam = $updateData['nama_peminjam'];
        $pinjam->npm = $updateData['npm'];
        $pinjam->judul_buku = $updateData['judul_buku'];       

        if($pinjam->save())
        {
            return response([
                'message' => 'Update Pinjams Success',
                'data' => $pinjam
            ],200);
        }

        return response([
            'message' => 'Update Pinjam Failed',
            'data' => null
        ],400);
    }
}
