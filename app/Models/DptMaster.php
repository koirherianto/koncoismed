<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Auth;

class DptMaster extends Model implements FromCollection, WithHeadings, WithMapping
{
    public $table = 'dpt';

    public $fillable = [
        'nik',
        'nama',
        'tps',
        'id_wilayah'
    ];

    protected $casts = [
        'nik' => 'string',
        'nama' => 'string',
        'tps' => 'string'
    ];

    public static $rules = [
        'nik' => 'required|string|max:45',
        'nama' => 'required|string|max:225',
        'tps' => 'nullable',
        'id_wilayah' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public static function countDptMaster()
    {
        return self::count();
    }

    public static function cariNik($nik) : bool
    {
        $dpt = self::where('nik', $nik)->first();

        return $dpt ? true : false;
    }
    
    public function collection()
    {
        if(Auth::user()->hasRole(['admin-kandidat-free', 'admin-kandidat-premium','super-admin'])){
            
            return DptMaster::all();
        }
    }

    public function headings(): array
    {
        return [
            'NIK',
            'Nama',
            'TPS',
            'Wilayah'
        ];
    }

    public function map($dpt): array
    {
        return [
            $dpt->nama,
            $dpt->nik,
            $dpt->tps,
            $dpt->id_wilayah
        ];
    }

 
}
