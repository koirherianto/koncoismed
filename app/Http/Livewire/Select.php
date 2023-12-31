<?php
  
namespace App\Http\Livewire;
  
use Livewire\Component;
use App\Models\Kabkota;
use App\Models\Provinsi;
use App\Models\Kecamatan;
use App\Models\Desa;
use Auth;
  
class Select extends Component
{
    public $provinsis;
    public $kabkotas;
    public $kecamatans;
    public $desas;
    public $selectedStatus;
  
    public $selectedProvinsi = NULL;
    public $selectedKabkota = NULL;
    public $selectedKecamatan = NULL;
    public $selectedDesa = NULL;
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function mount()
    {   
        if(Auth::user()->relawan->status == 'kab/kota'){
            $this->kecamatans = Kecamatan::where('kabkota_id', Auth::user()->relawan->desa->kecamatan->kabkota->id)->get();
            $this->desas = collect();
        }elseif (Auth::user()->relawan->status == 'kecamatan') {
            $this->desas = Desa::where('kecamatan_id', Auth::user()->relawan->desa->kecamatan->id)->get();
        }else{
            //milik admin-kandidat
            $this->provinsis = Provinsi::all();
            $this->kabkotas = collect();
            $this->kecamatans = collect();
            $this->desas = collect();
        }
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function render()
    {
        return view('livewire.select');
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function updatedSelectedProvinsi($provinsi)
    {
        if (!is_null($provinsi)) {
            $this->kabkotas = Kabkota::where('provinsi_id', $provinsi)->get();
            $this->selectedKecamatan = NULL;
            $this->selectedDesa = NULL;
        }
    }

    public function updatedSelectedKabkota($kabkota)
    {   
        if (!is_null($kabkota)) {
            $this->kecamatans = Kecamatan::where('kabkota_id', $kabkota)->get();
            $this->selectedDesa = NULL;
        }
    }
    public function updatedSelectedKecamatan($kecamatan)
    {
        if (!is_null($kecamatan)) {
            $this->desas = Desa::where('kecamatan_id', $kecamatan)->get();
        }
    }
    
}