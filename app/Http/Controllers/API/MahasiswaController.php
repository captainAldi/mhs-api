<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Mahasiswa;
use App\Http\Resources\Mahasiswa as MahasiswaResource;
use Validator;

class MahasiswaController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mahasiswa = Mahasiswa::all();

								return $this->sendResponses(MahasiswaResource::collection($mahasiswa), 'Data mahasiswa berhasil di peroleh');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'nama' => 'required',
            'nim' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $mahasiswa = Mahasiswa::create($input);
   
        return $this->sendResponses(new MahasiswaResource($mahasiswa), 'Mahasiswa created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
         $input = $request->all();
   
        $validator = Validator::make($input, [
            'nama' => 'required',
            'nim' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $mahasiswa->nama = $input['nama'];
        $mahasiswa->nim = $input['nim'];
        $mahasiswa->save();
   
        return $this->sendResponses(new MahasiswaResource($mahasiswa), 'Mahasiswa updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();

								return $this->sendResponses([], 'Mahasiswa Deleted Succesfully');
    }
}
