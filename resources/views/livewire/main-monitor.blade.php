<div wire:poll.1s='{{$refreshMode}}'>
    @isset($students)
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Jurusan</th>
                <th>Waktu Kehadiran</th>
                <th>Status</th>
                @role('Admin')
                <th>Action</th>
                @endrole
            </tr>
        </thead>
        <tbody>
            <tbody>
                @forelse ($students as $student)
                    <tr>
                        <td><img src='{{ asset('/images/'.$student->image) }}' class="img-fluid rounded-circle" width="50"></td>
                        <td>{{ $student->name  }} </td>
                        <td>{{ $student->grade->grade }}</td>
                        <td>{{ $student->grade->name }}</td>
                        <td>
                            @php
                                $firstPresence = $student->presences->first();
                                $presenceTime = $firstPresence ? \Carbon\Carbon::parse($firstPresence->created_at)->setTimezone('Asia/Jakarta')->format('H:i A') : '-';
                            @endphp
                            {{ $presenceTime }}
                        </td>
                        <td>
                                @if ($firstPresence)
                                    @php
                                        if($firstPresence->attempts == 0){
                                            $color = 'warning';
                                            $statusMessage = 'Blocked';
                                        } else {
                                            $tf = \Carbon\Carbon::parse($firstPresence->created_at);
                                            $stf = \Carbon\Carbon::createFromFormat('H:i', '07:10');
                                            $status = $tf->lessThan($stf);
                                            $diff = $stf->diff($tf)->locale('id_ID');
                                            if($status){
                                                $color = 'success';
                                                $statusMessage = 'Tepat Waktu';
                                            } else {
                                                $color = 'danger';
                                                $statusMessage = 'Terlambat ('.$diff.')';
                                            }
                                        }
                                    @endphp
                                    <span class="badge text-bg-{{$color}}">
                                        {{$statusMessage}}
                                    </span>
                                @else
                                    <span class="badge text-bg-danger">
                                        Tidak Hadir
                                    <span
                                @endif
                        </td>
                        @role('Admin')
                        <td>
                            <button type="button" class="btn btn-primary" wire:click="openDetail({{$student->id}})">
                                Details
                            </button>
                        </td>
                        @endrole
                    </tr>
                @empty
                    <tr><td colspan="6">Siswa Tidak Ditemukan!</td></tr>
                @endforelse
            </tbody>
        </tbody>
    </table>
    @endisset
</div>
