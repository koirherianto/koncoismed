<div>
    {{-- logika status relawan  --}}
    @if(Auth::user()->relawan->status == 'kab/kota')
        <div class="col-13">
            <!-- Status Field -->
                <div class="form-group">
                {!! Form::label('status', 'Status',['class'=>' text-uppercase']) !!}
                {!! Form::select('status', ['' => 'Pilih Status Relawan','kecamatan' => 'Kecamatan','kel/desa' => 'Kel/Desa'], null, ['class' => 'form-control border-light-green border-darken-4 border-left-6 text-bold-600 black font-medium-2','wire:model'=>'selectedStatus']) !!}
                </div>
        </div>
    @elseif(Auth::user()->relawan->status == 'kecamatan')
        {!! Form::hidden('status','kel/desa', ['class' => 'form-control']) !!}
    @elseif(Auth::user()->relawan->status == 'kel/desa')
        {!! Form::hidden('status',auth()->user()->relawan->status, ['class' => 'form-control']) !!}
    @else
        {{-- untuk admin-kandidat --}}
        <div class="col-13">
            <!-- Status Field -->
                <div class="form-group">
                {!! Form::label('status', 'Status',['class'=>' text-uppercase']) !!}
                {!! Form::select('status', ['' => 'Pilih Status Relawan','kab/kota' => 'Kab/Kota', 'kecamatan' => 'Kecamatan','kel/desa' => 'Kel/Desa'], null, ['class' => 'form-control border-light-green border-darken-4 border-left-6 text-bold-600 black font-medium-2','wire:model'=>'selectedStatus']) !!}
                </div>
        </div>
    @endif
    
    {{-- logika milik relawan kab/kota --}}
    @if(Auth::user()->relawan->status == 'kab/kota')
        <div class="form-group row">
            <label for="id_wilayah">Kecamatan</label>
            <div class="col-13">
                <select class="form-control border-light-green border-darken-4 border-left-6 text-bold-600 black font-medium-2" wire:model="selectedKecamatan" name="id_wilayah">
                    <option value="" selected>Pilih Kecamatan</option>
                    @foreach($kecamatans as $kecamatan)
                        <option value="{{ $kecamatan->id }}">{{ $kecamatan->nama }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        @if (!is_null($selectedKecamatan))
            <div class="form-group row">
                <label for="id_wilayah">Kel/Desa</label>
                <div class="col-13">
                    <select class="form-control border-light-green border-darken-4 border-left-6 text-bold-600 black font-medium-2" wire:model="selectedDesa" name="id_wilayah">
                        <option value="" selected>Pilih Kel/Desa</option>
                        @foreach($desas as $desa)
                            <option value="{{ $desa->id }}">{{ $desa->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endif

    {{-- logika milik relawan kecamatan --}}
    @elseif(Auth::user()->relawan->status == 'kecamatan')
        <div class="form-group row">
            <label for="id_wilayah">Kel/Desa</label>
            <div class="col-13">
                <select class="form-control border-light-green border-darken-4 border-left-6 text-bold-600 black font-medium-2" wire:model="selectedDesa" name="id_wilayah">
                    <option value="" selected>Pilih Kel/Desa</option>
                    @foreach($desas as $desa)
                        <option value="{{ $desa->id }}">{{ $desa->nama }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    {{-- logika milik relawan desa --}}
    @elseif(Auth::user()->relawan->status == 'kel/desa')
        {!! Form::hidden('id_wilayah',auth()->user()->relawan->id_wilayah, ['class' => 'form-control']) !!}
    @else
        {{-- logika milik admin-kandidat --}}
        <div class="form-group row">
            <label for="provinsi">Provinsi</label>
            <div class="col-13">
                <select wire:model="selectedProvinsi" class="form-control border-light-green border-darken-4 border-left-6 text-bold-600 black font-medium-2">
                    <option value="" selected>Pilih Provinsi</option>
                    @foreach($provinsis as $provinsi)
                        <option value="{{ $provinsi->id }}">{{ $provinsi->nama }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        @if (!is_null($selectedProvinsi))
            <div class="form-group row">
                <label for="id_wilayah">Kab/Kota</label>

                <div class="col-13">
                    <select class="form-control border-light-green border-darken-4 border-left-6 text-bold-600 black font-medium-2"wire:model="selectedKabkota" name="id_wilayah">
                        <option value="" selected>Pilih Kab/Kota</option>
                        @foreach($kabkotas as $kabkota)
                            <option value="{{ $kabkota->id }}">{{ $kabkota->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endif
        @if (!is_null($selectedKabkota))
            <div class="form-group row">
                <label for="id_wilayah">Kecamatan</label>
                <div class="col-13">
                    <select class="form-control border-light-green border-darken-4 border-left-6 text-bold-600 black font-medium-2" wire:model="selectedKecamatan" name="id_wilayah">
                        <option value="" selected>Pilih Kecamatan</option>
                        @foreach($kecamatans as $kecamatan)
                            <option value="{{ $kecamatan->id }}">{{ $kecamatan->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endif
        @if (!is_null($selectedKecamatan))
        {{-- @if ($selectedStatus == 'kel/desa') --}}
            <div class="form-group row">
                <label for="id_wilayah">Kel/Desa</label>
                <div class="col-13">
                    <select class="form-control border-light-green border-darken-4 border-left-6 text-bold-600 black font-medium-2" wire:model="selectedDesa" name="id_wilayah">
                        <option value="" selected>Pilih Kel/Desa</option>
                        @foreach($desas as $desa)
                            <option value="{{ $desa->id }}">{{ $desa->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endif
    @endif
</div>