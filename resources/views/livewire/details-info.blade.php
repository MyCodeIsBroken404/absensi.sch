<div class="modal" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        @isset($student)
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{$student->name}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-md-4">
                    <img src="{{asset('/images/'.$student->image)}}" class="img-fluid rounded-start" alt="...">
                </div>
                <p>RFID: {{$student->rfid}}</p>
                <p>Kelas: {{$student->grade->grade}}</p>
                <p>Jurusan: {{$student->grade->name}}</p>
                <p>Tangga Lahir: {{$student->tgl_lahir}}</p>
                <p>Alamat: {{$student->alamat}}</p>
                <p>Kehadiran Bulan Ini: {{$student->presences->count()}}</p>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a class="btn btn-primary" href="{{route('presence.edit', $student->id)}}">Edit</a>
                @if($student->presences->where('attempts',0)->first())
                <form action="{{route('presence.unblock', $student->id)}}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button  type="submit" class="btn btn-success">Unblock</button>
                </form>
                @endif
                
            </div>
        </div>
        @endisset
    </div>
    @script
    <script>
        console.log('hey');
    </script>
    @endscript
</div>
