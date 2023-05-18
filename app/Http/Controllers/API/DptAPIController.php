<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateDptAPIRequest;
use App\Http\Requests\API\UpdateDptAPIRequest;
use App\Models\Dpt;
use App\Repositories\DptRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Models\Suku;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Provinsi;
use App\Models\Kabkota;
use App\Models\Kecamatan;
use App\Models\Desa;
use App\Models\Relawan;
use App\Repositories\RelawanRepository;


class DptAPIController extends AppBaseController
{
    private DptRepository $dptRepository;
    private $response;

    public function __construct(DptRepository $dptRepo)
    {
        $this->dptRepository = $dptRepo;
    }

    public function index(Request $request)
    {
        $dpts=[];
        $dataRelawanDpt=[];
        if(Auth::user()->hasAnyRole('admin-kandidat-free','admin-kandidat-premium')){
            $relawan = Relawan::where('users_id',Auth::user()->id)->first();
            $dpts=[];
            foreach( $relawan->descendants as $key=> $item){
                    if(!$item->dpts->isEmpty()){
                        $dpts[] = $item->dpts;
                    }        
            }

            $tampungData = [];
            $i = 0;

            foreach ($dpts as $value) {
                $i = count($value);
                for ($k=0; $k < $i; $k++) { 
                    $dptx = $value[$k]->load(['agama','sukus']);
                    $dptx['wilayah'] = $this->wilayahById($dptx->id_wilayah);
                    $tampungData[] = $dptx;
                }
            }

            $dpts =  $tampungData;
        }else{
            $dpts = Dpt::where('relawan_id',Auth::user()->relawan->id)->with(['agama','sukus'])->get();

            foreach ($dpts as $dpt) {
                $dpt['wilayah'] = $this->wilayahById($dpt->id_wilayah);
            }
        }
        
        return $this->sendResponse($dpts, 'DPT get successfully');
    }

    private function inArray($tree)
    {
        $a = [];
            foreach ($tree as $tre) {
                $a[] = $tre;
                if (count($tre->children) > 0) {
                    $a[] = $this->inArray($tre->children);
                }
            }
        
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $input['relawan_id'] = Auth::user()->relawan->id;
        $input['kandidat_id'] = Auth::user()->relawan->kandidat_id;
        $input['id_wilayah'] = Auth::user()->relawan->id_wilayah;

        $validator = Validator::make($input, [
            'nama' => 'required|min:3|max:250',
            'nik' => 'required|unique:dpt,nik',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'email' => '',
            'kontak' => '',
            'suku_id' => '',
            'tps' => 'required',
            'rt' => '',
            'rw' => '',
            'alamat' => 'required',
            'keterangan' => '',
            'agama_id' => 'required',          
            'id_wilayah' => 'required',//otomatis
            'kandidat_id' => 'required',//otomatis
            'relawan_id' => 'required',//otomatis
        ],[
            'nama.required' => '*Wajib di isi',
            'nama.min' => 'Nama minimal 3 karakter',
            'nik.required' => '*Wajib di isi',
            'nik.unique' => '*nik telah digunakan',
            'tempat_lahir.required' => '*Wajib di isi',
            'tanggal_lahir.required' => '*Wajib di isi',
            'tanggal_lahir.date' => '*Format tanggal salah',
            'jenis_kelamin.required' => '*Wajib di isi',
            'id_wilayah.required' => '*Wajib di isi',
            'agama_id.required' => '*Wajib di isi',
            'alamat.required' => '*Wajib di isi',
        ]);

        if ($validator->fails()) {
            $this->response['success'] = false;
            $this->response['error'] = $validator->errors();
            return response()->json($this->response, 200);
        }else{
            $dpt = $this->dptRepository->create($input);
            $dpt->load(['agama','sukus']);
            $dpt['wilayah'] = $this->wilayahById($dpt->id_wilayah);
            return $this->sendResponse($dpt->toArray(), 'DPT Berhasil ditambahkan');
        }
    }

    public function show($id): JsonResponse
    {
        $dpt = $this->dptRepository->find($id);

        if (empty($dpt)) {
            return $this->sendError('Dpt not found');
        }else{
            $dpt->load(['agama','sukus','relawan']);
            $dpt['wilayah'] = $this->wilayahById($dpt->id_wilayah);
        }

        return $this->sendResponse($dpt->toArray(), 'Dpt retrieved successfully');
    }

    public function update($id, Request $request)
    {
        $input = $request->all();

        $dpt = Dpt::find($id);
        $nikValidation = "$dpt->nik" == "$request->nik" ? '' : '|unique:dpt,nik';

        $validator = Validator::make($input, [
            'nama' => 'required|min:3|max:250',
            'nik' => 'required' . $nikValidation,
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'email' => '',
            'kontak' => '',
            'suku_id' => '',
            'tps' => 'required',
            'rt' => '',
            'rw' => '',
            'alamat' => 'required',
            'keterangan' => '',
            'agama_id' => 'required',          
            'id_wilayah' => 'required',//otomatis
        ],[
            'nama.required' => '*Wajib di isi',
            'nama.min' => 'Nama minimal 3 karakter',
            'nik.required' => '*Wajib di isi',
            'nik.unique' => 'Nik sudah digunakan',
            'tempat_lahir.required' => '*Wajib di isi',
            'tanggal_lahir.required' => '*Wajib di isi',
            'tanggal_lahir.date' => '*Format tanggal salah',
            'jenis_kelamin.required' => '*Wajib di isi',
            'id_wilayah.required' => '*Wajib di isi',
            'agama_id.required' => '*Wajib di isi',
            'alamat.required' => '*Wajib di isi',
        ]);

        if ($validator->fails()) {
            $this->response['success'] = false;
            $this->response['error'] = $validator->errors();
            return response()->json($this->response, 200);
        }

        $dpt = $this->dptRepository->find($id);
        // return $dpt->id_wilayah;
        if (empty($dpt)) {
            return $this->sendError('Dpt not found');
        }

        $input['id_wilayah'] = $dpt->id_wilayah;
        $dpt = $this->dptRepository->update($input, $id);
        $dpt['jenis_kelamin'] = $this->dptRepository->find($id)->jenis_kelamin;

        $dpt->load(['agama','sukus']);
        $dpt['wilayah'] = $this->wilayahById($dpt->id_wilayah);

        return $this->sendResponse($dpt, 'Dpt updated successfully');
    }

    public function destroy($id): JsonResponse
    {
        $dpt = $this->dptRepository->find($id);

        if (empty($dpt)) {
            return $this->sendError('Dpt not found');
        }

        $deletedData = $dpt;
        $dpt->delete();
        $deletedData->load(['agama','sukus']);
        $deletedData['wilayah'] = $this->wilayahById($deletedData->id_wilayah);

        return $this->sendResponse($deletedData ,'Dpt deleted successfully');
    }
}