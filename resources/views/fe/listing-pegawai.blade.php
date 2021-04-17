<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Product</title>
	
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
	<meta name="robots" content="noindex">
</head>
<style>
    div.gallery {
      border: 1px solid #ccc;
    }

    div.gallery:hover {
      border: 1px solid #777;
    }

    div.gallery img {
      width: 100%;
      height: auto;
    }

    div.desc {
      padding: 15px;
      text-align: center;
    }

    * {
      box-sizing: border-box;
    }

    .responsive {
      padding: 0 6px;
      float: left;
      width: 24.99999%;
    }

    @media only screen and (max-width: 700px) {
      .responsive {
        width: 49.99999%;
        margin: 6px 0;
      }
    }

    @media only screen and (max-width: 500px) {
      .responsive {
        width: 100%;
      }
    }

    .clearfix:after {
      content: "";
      display: table;
      clear: both; 
    }
</style>    
    
<body>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
                    <tr>
                        <td>
                            <a href="{{ url('form-pegawai') }}" class="btn btn-flat bg-blue"><i class="fa fa-book"></i> Tambah Pegawai</a>&nbsp;
                        </td>
                        <td>
                            <a href="{{ url('/') }}" class="btn btn-flat bg-green"><i class="fa  fa-backward"></i> Back To Home</a>&nbsp;
                        </td>
                    </tr>
                </div>
            </div>
            <div class="row">
                <table class="table">
                  <thead class="thead-dark">
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Nama</th>
                      <th scope="col">NIP</th>
                      <th scope="col">SPV</th>
                      <th scope="col">DOB Pegawai</th>
                      <th scope="col">Status</th>
                      <th scope="col">Edit</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                      $num = 1;
                    @endphp  
                    @foreach($pegawai as $key => $val)
                        <tr>
                          <th scope="row">{{ $num }}</th>
                          <td>{{ $val->nama }}</td>
                          <td>{{ $val->nip }}</td>
                          <td>{{ $val->spv }}</td>
                          <td>{{ $val->dob }}</td>
                          <td>{{ $val->status }}</td>
                            <td>
                                <a href="{{ url('edit-pegawai', $val->id) }}" class="btn btn-flat bg-green"><i class="fa fa-edit"></i></a>
                            </td>
                        </tr>
                        @php
                          $num++;
                        @endphp  
                    @endforeach
                  </tbody>
                </table>
            </div>
        </div>
    </section>

    <div class="clearfix"></div>
    
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
    
	<script src="{{ asset('adminLTE-2/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
	<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('adminLTE-2/plugins/iCheck/icheck.min.js') }}"></script>

	<script src="{{ asset('root/jquery.validate.min.js') }}"></script>
	<script src="{{ asset('adminLTE-2/plugins/fastclick/fastclick.js') }}"></script>
	<script src="{{ asset('adminLTE-2/dist/js/app.min.js') }}"></script>
</body>
</html>