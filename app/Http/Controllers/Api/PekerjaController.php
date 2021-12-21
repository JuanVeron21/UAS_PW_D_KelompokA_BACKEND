<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\Pekerja;

class PekerjaController extends Controller
{
    public function index()
    {
        $pekerjas = Pekerja::all();

        if(count($pekerjas)>0)
        {
            return response([
                'message' => 'Retrieve All Success',
                'data' => $pekerjas
            ],200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ],400);
    }

    public function show($id)
    {
        $pekerja = Pekerja::find($id);

        if(!is_null($pekerja))
        {
            return response([
                'message' => 'Retrieve Pekerja Success',
                'data' => $pekerja
            ],200);
        }

        return response([
            'message' => 'Pekerja Not Found',
            'data' => null
        ],404);
    }

    public function store(Request $request)
    {
        $storeData = $request->all();
        $validate = Validator::make($storeData,[
            'nama_pekerja' => 'required',
            'no_pekerja' => 'required',
            'lama_kerja' => 'required'
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()],400);

        $storeData['password'] = bcrypt($request->password);
        $pekerja = Pekerja::create($storeData);    
        return response([
            'message' => 'Add Pekerja Success',
            'data' => $pekerja
        ],200);
    }

    public function destroy($id)
    {
        $pekerja = Pekerja::find($id);

        if(is_null($pekerja))
        {
            return response([
                'message' => 'Pekerja Not Found',
                'data' => null
            ],404);
        }

        if($pekerja->delete())
        {
            return response([
                'message' => 'Delete Pekerjas Success',
                'data' => $pekerja
            ],404);
        }

        return response([
            'message' => 'Delete Pekerja Failed',
            'data' => null
        ],400);
    }

    public function update(Request $request,$id)
    {
        $pekerja = Pekerja::find($id);
        if(is_null($pekerja))
        {
            return response([
                'message' => 'Pekerja Not Found',
                'data' => null
            ],404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData,[
            'nama_pekerja' => 'required',
            'no_pekerja' => 'required',
            'lama_kerja' => 'required'
        ]);

        if ($validate->fails())
            return response(['message' => $validate->errors()],400);

        $pekerja->nama_pekerja = $updateData['nama_pekerja'];
        $pekerja->no_pekerja = $updateData['no_pekerja'];
        $pekerja->lama_kerja = $updateData['lama_kerja'];       

        if($pekerja->save())
        {
            return response([
                'message' => 'Update Pekerjas Success',
                'data' => $pekerja
            ],200);
        }

        return response([
            'message' => 'Update Pekerja Failed',
            'data' => null
        ],400);
    }
}
