@extends('app')



<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<style type="text/css">
		.pagination li{
			float: left;
			list-style-type: none;
			margin:5px;
		}

		.buttontengah {
    text-align: center;
}

.button {
    position: absolute;
  
}


#card-header-createjo {
   background-color: #EFE9E8;
}
#card-header-masterjo {
   background-color: #EFE9E8;
}
#card-header-pengaturan {
   background-color: #EFE9E8;
}
#card-header-csi {
   background-color: #EFE9E8;
}

.f {

float: right;

}



	</style>

	

@section('content')


@auth


<div class="card">
  <div class="card-body">
   <b>Cara Penggunaan aplikasi Create Jo Multibank</b>
<br>
<P>
1. klik import excel.
<br>
2. proses JO.
<br>
3. Download Hasil JO
<br>
4. jika sudah sesuai silahkan masukkan ke master JO
<br>
5. clear data
<br>
6. selesai
</P>
  </div>
</div>






<div class="container">
		<center>
			<h4>CREATE JOB ORDER</h4>
		</center>
 
		{{-- notifikasi form validasi --}}
		@if ($errors->has('file'))
		<span class="invalid-feedback" role="alert">
			<strong>{{ $errors->first('file') }}</strong>
		</span>
		@endif
 
		{{-- notifikasi sukses --}}
		@if ($sukses = Session::get('sukses'))
		<div class="alert alert-success alert-block">
			<button type="button" class="close" data-dismiss="alert">×</button> 
			<strong>{{ $sukses }}</strong>
		</div>
		@endif
 





<div>
		<table>
		<thead>
            <tr> 




			<th>


<form action="{{ route('createjos.truncate') }}" method="POST">
	{{ csrf_field() }}
	<button type="submit"  class="btn btn-danger align-right"  onclick="return confirm('Apakah Anda Yakin?')" >CLEAR DATA</button>
	</form>
	
	
	</th>



		<th>	
		&nbsp;
		&nbsp;
		&nbsp;				
		<button type="button" class="btn btn-primary mr-5" data-toggle="modal" data-target="#importjo">
			IMPORT EXCEL
		</button>
		&nbsp;
		</th>
		<th>
		&nbsp;
		<a href="exportHasilJo" class="btn btn-primary mr-5 f"  target="_blank">DOWNLOAD HASIL JO</a>
		&nbsp;
	</th>

		<th>








	</tr>
	</thead>
	    </table>
</div>








		<!-- Import Excel -->
		<div class="modal fade" id="importjo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<form method="post" action="importjo" enctype="multipart/form-data">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
						</div>
						<div class="modal-body">
							{{ csrf_field() }}
							<label>Pilih file excel</label>
							<div class="form-group">
								<input type="file" name="file" required="required">
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Import</button>
						</div>
					</div>
				</form>
			</div>
		</div>










		<br>







				<div class="buttontengah">

<table >
<thead>
<tr>
<th>
<div class="card" style="width: 18rem;" >
 
  <div class="card-body" id="card-header-createjo">
    <h5 class="card-title">Pemasangan Baru = {{ $jumlahPemasanganBaru }}</h5>
 	    <a href="{{ route('pemasanganbaruView') }}" class="btn btn-light">Open</a>
  </div>
</div>
</th>
<th>
<div>
&nbsp;&nbsp;&nbsp;&nbsp;
</div>
</th>
<th>
<div class="card" style="width: 18rem;">
  <div class="card-body" id="card-header-masterjo">
    <h5 class="card-title">REINIT = {{ $jumlahReinit }}</h5>
   	 <a href="{{ route('reinitView') }}" class="btn btn-light">Open</a>
  </div>
</div>
</th>
<th>
<div>
&nbsp;&nbsp;&nbsp;&nbsp;
</div>
</th>
<th>
<div class="card" style="width: 18rem;">
  
  <div class="card-body" id="card-header-pengaturan">
    <h5 class="card-title">DATA SALAH = {{ $joDataSalahs }}</h5>
  <a href="{{ route('dataJOsalah') }}" class="btn btn-light">Open</a>
  </div>
</div>
</th>

<th>
<div>
&nbsp;&nbsp;&nbsp;&nbsp;
</div>
</th>

<th>
<div class="card" style="width: 18rem;">
  
  <div class="card-body" id="card-header-csi">
    <h5 class="card-title">SISA CSI = {{ $tableCSIS }} </h5>
      <a href="{{ route('masterCSI') }}" class="btn btn-light">Open</a>
  </div>
</div>
</th>
</tr>
</thead>
</table>
</div>












<br>


<div class="card">
  <div class="card-body">
   MESSAGE = {{$resultArray}}
  </div>
</div>

<br>









<table>
		<thead>
		
		<form action="{{ route('createjos.addtomaster') }}" method="POST">
		{{ csrf_field() }}
		&nbsp;
		<button type="submit" class="btn btn-primary mr-5"  onclick="return confirm('Apakah Anda Yakin?')" >PROSES JO</button>
		</form>
	</tr>

	</thead>
	    </table>









<br>














		<table class='table table-bordered'>
			<thead>
            <tr>
										<th>No</th>
                                        <th>no_joborder</th>
										<th>merchant name</th>
										<th>MID MULTIBANK</th>
										<th>TID MULTIBANK</th>
										<th>MID OVO</th>
										<th>TID OVO</th>
                                    </tr>
			</thead>
			<tbody>
            @php $no = 1; @endphp
                                    @foreach ($buatjos as $data)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $data->spkOvo }}</td>
											<td>{{ $data->merchantName }}</td>
											<td>{{ $data->masterMID }}</td>
											<td>{{ $data->masterTID }}</td>
											<td>{{ $data->masterMIDovo }}</td>
											<td>{{ $data->masterTIDovo }}</td>

									 	<td><a href="{{ route('createjos.editHasilJo', $data->id) }}"
                                                        class="btn btn-sm btn-outline-success">Edit </a></td>

														



                                        </tr>
                                    @endforeach
			</tbody>
		</table>
	</div>
	<div class="container">
{{ $buatjos->links() }}
	</div>



<br/>









<br/>
<br>
<table>
		<thead>
		<th>
<div class="buttontengah">
<form action="{{ route('home') }}" method="GET">
	{{ csrf_field() }}
	<button type="submit"  class="btn btn-primary mr-5" >Back</button>
</form>

	</div>
	</th>
		<th>
		<form action="{{ route('createjos.PemasanganBaruSave') }}" method="POST">
		{{ csrf_field() }}
		&nbsp;
		<button type="submit" class="btn btn-primary mr-5"  onclick="return confirm('Apakah Anda Yakin?')" >SIMPAN KE MASTER JO</button>
		</form>
	</tr>

	</thead>
	    </table>

		

<br>

<br>
@endauth
@endsection