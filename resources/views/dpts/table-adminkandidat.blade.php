<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table table-hover table-borderless mb-1" id="dpts-table">
            <thead>
            <tr>
                <th>KTP</th>
                <th>Nama</th>
                <th>NIK</th>
                {{-- <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Email</th>
                <th>Kontak</th>
                <th>Agama</th>
                <th>Suku</th>
                <th>TPS</th>
                <th>RT</th>
                <th>RW</th>
                <th>Alamat</th>
                <th>Keterangan</th> --}}
                <th>Kontak</th>
                <th>Relawan</th>
                <th>Aksi</th>
            </tr>
            </thead>
            <tbody>

            @foreach($dataRelawanDpt as $item)
                @foreach($item->dpts as $dataDpt)
                <tr>
                    <td><img src="{{$dataDpt->getFirstMediaUrl()}}"width="80px"></td>
                    <td>{{ $dataDpt->nama }}</td>
                    <td>{{ $dataDpt->nik }}</td>
                    {{-- <td>{{ $dataDpt->tempat_lahir }}</td>
                    <td>{{ $dataDpt->tanggal_lahir }}</td>
                    <td>{{ $dataDpt->jenis_kelamin }}</td>
                    <td>{{ $dataDpt->email }}</td>
                    <td>{{ $dataDpt->kontak }}</td>
                    <td>{{ $dataDpt->agama->nama }}</td>
                    <td>{{ $dataDpt->suku }}</td>
                    <td>{{ $dataDpt->tps }}</td>
                    <td>{{ $dataDpt->rt }}</td>
                    <td>{{ $dataDpt->rw }}</td>
                    <td>{{ $dataDpt->alamat }}</td>
                    <td>{{ $dataDpt->keterangan }}</td> --}}
                    <td>{{ $dataDpt->kontak }}</td>
                    <td>{{ $dataDpt->relawan->users->name }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['dpts.destroy', $dataDpt->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('dpts.show', [$dataDpt->id]) }}"
                            class='btn btn-outline-success'><span class="fa fa-eye"></span>
                            </a>
                            @role('relawan-free|relawan-premium')
                            <a href="{{ route('dpts.edit', [$dataDpt->id]) }}"
                            class='btn btn-outline-warning'><span class="fa fa-pencil"></span>
                            </a>
                            {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-outline-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                            @endrole
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
                @endforeach
                @foreach($item->descendants as $data)
                    @foreach($data->dpts as $dpt)
                    <tr>
                        <td><img src="{{$dpt->getFirstMediaUrl()}}"width="80px"></td>
                        <td>{{ $dpt->nama }}</td>
                        <td>{{ $dpt->nik }}</td>
                        {{-- <td>{{ $dpt->tempat_lahir }}</td>
                        <td>{{ $dpt->tanggal_lahir }}</td>
                        <td>{{ $dpt->jenis_kelamin }}</td>
                        <td>{{ $dpt->email }}</td>
                        <td>{{ $dpt->kontak }}</td>
                        <td>{{ $dpt->agama->nama }}</td>
                        <td>{{ $dpt->suku }}</td>
                        <td>{{ $dpt->tps }}</td>
                        <td>{{ $dpt->rt }}</td>
                        <td>{{ $dpt->rw }}</td>
                        <td>{{ $dpt->alamat }}</td>
                        <td>{{ $dpt->keterangan }}</td> --}}
                        <td>{{ $dpt->id_wilayah }}</td>
                        <td>{{ $dpt->relawan->users->name }}</td>
                        <td  style="width: 120px">
                            {!! Form::open(['route' => ['dpts.destroy', $dpt->id], 'method' => 'delete']) !!}
                            <div class='btn-group'>
                                <a href="{{ route('dpts.show', [$dpt->id]) }}"
                                class='btn btn-outline-success'><span class="fa fa-eye"></span>
                                </a>
                                @role('relawan-free|relawan-premium')
                                <a href="{{ route('dpts.edit', [$dpt->id]) }}"
                                class='btn btn-outline-warning'><span class="fa fa-pencil"></span>
                                </a>
                                {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-outline-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                                @endrole
                            </div>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                    @endforeach
                @endforeach
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="card-footer clearfix">
        <div class="float-right">
            {{-- @include('adminlte-templates::common.paginate', ['records' => $dpts]) --}}
        </div>
    </div>
</div>