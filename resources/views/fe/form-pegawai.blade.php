<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Customer</title>
	
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="icon" href="{{ asset('admin-wcms/images/material/coliss.png') }}">

	<link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('fa/css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset('bootstrap/css/ionicons.min.css') }}">
	<link rel="stylesheet" href="{{ asset('adminLTE-2/css/AdminLTE.min.css') }}">
	<link rel="stylesheet" href="{{ asset('root/c.css') }}">
	<link rel="stylesheet" href="{{ asset('admin-wcms/css/style.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('sweetalert/dist/sweetalert.min.css') }}">
  <script src="{{ asset('sweetalert/dist/sweetalert.min.js') }}"></script>
 
	<script src="{{ asset('adminLTE-2/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
	<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('adminLTE-2/plugins/iCheck/icheck.min.js') }}"></script>

	<script src="{{ asset('root/jquery.validate.min.js') }}"></script>
	<script src="{{ asset('adminLTE-2/plugins/fastclick/fastclick.js') }}"></script>

	<meta name="robots" content="noindex">
</head>

<body>

<script>
  $(document).ready(function() {  
    $("#pilih-spv").on('change', function() {
        var select_spv    = $(this).find("option[value='" + $(this).val() + "']").data('json');
        $("#nama_spv").val(select_spv.nama);
    });
  });
</script>

<section class="content">
    <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Tambah Pegawai</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              {!! Form::open(array('url' => '/form-pegawai', 'class' => 'form-horizontal', 'method' => 'post')) !!}
              <div class="card-body">
                <div class="form-group row">
                  <label for="inputID" class="col-sm-4 col-form-label">Nama</label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" placeholder="Nama Pegawai" name="nama" value="{{ old('nama') }}" required>
                  </div>
                </div>
                <div class="form-group row">
                    <label for="inputCode" class="col-sm-4 col-form-label">NIP</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" placeholder="NIP Pegawai" name="nip" value="{{ $nip }}" readonly required>
                    </div>
                </div>
                <div class="form-group row">
                  <label for="inputCode" class="col-sm-4 col-form-label">Tempat & Tanggal Lahir</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" placeholder="Tempat Lahir" name="tempat" value="{{ old('tempat') }}" required>
                  </div>
                  <div class="col-sm-4">
                    <input type="date" class="form-control" placeholder="DOB Pegawai" name="dob" value="{{ old('dob') }}" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputCode" class="col-sm-4 col-form-label">Join Date</label>
                  <div class="col-sm-5">
                    <input type="date" class="form-control" placeholder="Join Date" name="join_date" required>
                  </div>
                  @foreach ($errors->get('join_date') as $error)
                      <div style="color:red; font-size:12px">{{ $error }}</div>
                  @endforeach
                </div>
                <div class="form-group row">
                  <label for="inputCode" class="col-sm-4 col-form-label">Status</label>
                  <div class="col-sm-5">
                    <select class="form-control" name="status" required>
                      <option value="">--- Pilih Status ---</option>
                      <option value="Kontrak">Kontrak</option>
                      <option value="Tetap">Tetap</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputCode" class="col-sm-4 col-form-label">Leader</label>
                  <div class="col-sm-5">
                    <select class="form-control" name="spv" id="pilih-spv" required>
                      <option value="">--- Pilih Leader ---</option>
                      @foreach($leader as $lead)
                          <option data-json="{{ json_encode($lead) }}" value="{{ $lead->id }}">{{ $lead->nama }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-sm-4">
                    <input type="hidden" class="form-control" name="nama_spv" id="nama_spv" required>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <input type="submit" name="" class="btn btn-flat bg-green">&nbsp;&nbsp;
                <a class="btn btn-danger" href="{{ route('pegawai') }}">Back</a>
				      </div>
                <!-- /.card-footer -->
              {!! Form::close() !!}
            </div>
            </div>
        </div>
    </div>
</section>

  @if($errors->any())
    <?php
    $str = "<ul>";
    foreach ($errors->all() as $error) {
        $str .= "<li>$error</li>";
    }
    $str .= "</ul>";
    ?>
    <script>
        swal({
            type: 'error',
            html: true,
            title: 'Error Validation',
            text: '{!! $str !!}',
        });
    </script>
  @endif

  @if(session()->has('message'))
    <script>
      swal({
        type:'success',
        html:true,
        title: 'Success',
        text : '{!! Session::get("message") !!}',
      });
    </script>
	@endif

</body>
</html>