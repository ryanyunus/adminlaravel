@extends('layout.admin')

@section('content')
<body>
  <h1 class="text-center mb-4">Edit Data Pegawai!</h1>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-8">
        <div class="card">
          <div class="card-body">
            <form action="/updatedata/{{$data->id}}" method="POST" enctype="multipart/form-data">
              @csrf
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Nama Lengkap</label>
                  <input type="text" name="nama" class="form-control" id="exampleInputEmail1" 
                  aria-describedby="emailHelp" value="{{$data->nama}}"> 
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Jenis Kelamin</label>
                  <select class="form-select" name="jeniskelamin" aria-label="Default select example">
                        <option selected>{{$data->jeniskelamin}}</option>
                        <option value="1">Laki-Laki</option>
                        <option value="2">Perempuan</option>
                  </select> 
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">No Telpon</label>
                  <input type="number" name="notelpon" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$data->notelpon}}"> 
                </div>
                <div class="mb-3">
                  <label for="exampleInputFile" class="form-label">Foto</label>
                  <input type="file" class="form-control" name="foto" id="exampleInputFile">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
          </div>
        </div>
        </div>
      </div>
    </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
@endsection