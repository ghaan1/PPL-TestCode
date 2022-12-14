@extends('layouts.layoutBerandaUser')
@section('content')
	
	<!-- breadcrumb-section -->
	<div class="breadcrumb-section breadcrumb-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						<p>WaroenkQu</p>
						<h1>Check Out Product</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->

	<!-- check out section -->
	<div class="checkout-section mt-150 mb-150">
		<div class="container">
			<div class="row">
            
				
				<div class="col-md-8 mb-4">
                <a class="btn btn-danger btn-sm" href="{{ route('checkout') }}">Refresh</a>
                <div class="cart-tax">
                    <br>
                    <button type="button" class="btn btn-sm btn-primary mb-2" data-toggle="modal" data-target="#tambahAlamatPengirimanModal">
                        Tambah Alamat Pengiriman
                    </button>
                    <div class="title-wrap">
                        <h4 class="cart-bottom-title section-bg-gray">Data Alamat Pengiriman</h4>
                    </div>
                    <div class="tax-wrapper">
                        <div class="table-content table-responsive cart-table-content">
                            <table class="w-100">
                                <thead>
                                    <tr>
                                        <th>Nama Penerima</th>
                                        <th>Alamat</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (empty($alamatpengiriman))
                                    <tr>
                                        <td colspan="4">Data alamat pengiriman masih kosong</td>
                                    </tr>
                                    @else
                                    @foreach ($alamatpengiriman as $item)
                                    <tr>
                                        <td>
                                            <span class="font-weight-bold">
                                                {{$item->nama_penerima}}
                                            </span>
                                            <br>
                                            <span>No. HP :
                                                {{$item->no_tlp}}
                                            </span>
                                        </td>
                                        <td>
                                            {{$item->alamat}},
                                            <br>
                                            {{$item->kelurahan}} - {{$item->kecamatan}} - {{$item->kota}} - {{$item->provinsi}}
                                            <br>
                                            <span>
                                                Kodepos :
                                                {{$item->kodepos}}
                                            </span>
                                        </td>
                                        <td>
                                            @if ($item->status)
                                            <span class="font-weight-bold">Utama</span>
                                            @else
                                            <span class="font-weight-bold">Opsional</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="javascript:void(0)" class="text-dark btn-edit-alamat" data-url="{{route('alamat-pengiriman.edit', $item->id)}}" data-toggle="modal" data-target="#editAlamatPengirimanModal"><i class="fa fa-edit"></i></a>
                                            <a href="javascript:void(0)" data-id="{{$item->id}}" class="text-dark mx-2 delete-alamat-pengiriman"><i class="fa fa-times"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>

				<div class="col-lg-4">
					<div class="order-details-wrap">
						<table class="order-details">
							<thead>
								<tr>
									<th>Your order Details</th>
									<th>Price</th>
								</tr>
							</thead>
							<tbody class="order-details-body">
								<tr>
									<td>Product</td>
									<td>Total</td>
								</tr>
								@foreach($cart as $carts)
								<tr>
                                <td>{{ $carts->Barang->nama_barang }}</td>
                                <td>Rp {{ number_format($carts->Barang->harga) }}</td>
								
								</tr>
								@endforeach

								
							</tbody>
							<tbody class="checkout-details">
								
								
								<tr>
									<td>Total</td>
                                    <td>Rp. {{ number_format($pesanans->jumlah_harga) }}</td>
								</tr>
							</tbody>
						</table>
						<a href="{{route('placeorder')}}" type="submit" form="finalize" class="boxed-btn" value="Place Order">Place Order</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end check out section -->
	<!-- Modal -->
<div class="modal fade" id="tambahAlamatPengirimanModal" tabindex="-1" role="dialog" aria-labelledby="tambahAlamatPengirimanModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahAlamatPengirimanModalLabel">Tambah Alamat Pengiriman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('alamat-pengiriman.store') }}" method="POST">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="tax-select mb-25px">
                                <label>Nama Penerima</label>
                                <input type="text" class="px-2 @error('nama_penerima') border-danger @enderror" name="nama_penerima" placeholder="Masukkan Nama Penerima" value="{{old('nama_penerima')}}" />
                                @error('nama_penerima')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="tax-select mb-25px">
                                <label>Nomor HP</label>
                                <input type="text" class="px-2 @error('no_tlp') border-danger @enderror" name="no_tlp" placeholder="Masukkan Nomor HP" value="{{old('no_tlp')}}" />
                                @error('no_tlp')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="tax-select mb-25px">
                                <label>Alamat</label>
                                <input type="text" class="px-2 @error('alamat') border-danger @enderror" name="alamat" placeholder="Masukkan Alamat" value="{{old('alamat')}}" />
                                @error('alamat')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="tax-select mb-25px">
                                <label>Kelurahan/Desa</label>
                                <input type="text" class="px-2 @error('kelurahan') border-danger @enderror" name="kelurahan" placeholder="Masukkan Kelurahan/Desa" value="{{old('kelurahan')}}" />
                                @error('kelurahan')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="tax-select mb-25px">
                                <label>Kecamatan</label>
                                <input type="text" class="px-2 @error('kecamatan') border-danger @enderror" name="kecamatan" placeholder="Masukkan Kecamatan" value="{{old('kecamatan')}}" />
                                @error('kecamatan')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="tax-select mb-25px">
                                <label>Kabupaten/Kota</label>
                                <input type="text" class="px-2 @error('kota') border-danger @enderror" name="kota" placeholder="Masukkan Kabuptae/Kota" value="{{old('kota')}}" />
                                @error('kota')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="tax-select mb-25px">
                                <label>Provinsi</label>
                                <input type="text" class="px-2 @error('provinsi') border-danger @enderror" name="provinsi" placeholder="Masukkan Provinsi" value="{{old('provinsi')}}" />
                                @error('provinsi')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="tax-select mb-25px">
                                <label>Kodepos</label>
                                <input type="number" class="px-2 @error('kodepos') border-danger @enderror" name="kodepos" placeholder="Masukkan Kodepos" value="{{old('kodepos')}}" />
                                @error('kodepos')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="tax-select-wrapper">
                                <div class="tax-select mb-0">
                                    <label>Status Alamat Pengiriman</label>
                                    <select class="email s-email s-wid @error('status') border-danger @enderror" name="status">
                                        <option disabled selected hidden>-- Pilih status alamat pengiriman --</option>
                                        <option value="1">Utama</option>
                                        <option value="0">Opsional</option>
                                    </select>
                                </div>
                                @error('status')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="editAlamatPengirimanModal" tabindex="-1" role="dialog" aria-labelledby="editAlamatPengirimanModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAlamatPengirimanModalLabel">Edit Alamat Pengiriman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="body-edit-alamat"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="editAlamatPengirimanModal" tabindex="-1" role="dialog" aria-labelledby="editAlamatPengirimanModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAlamatPengirimanModalLabel">Edit Alamat Pengiriman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="body-edit-alamat"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="editAlamatProdukModal" tabindex="-1" role="dialog" aria-labelledby="editAlamatProdukModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAlamatProdukModalLabel">Edit Alamat Pengiriman Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="body-edit-alamat-produk"></div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>   

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    @endsection
@section('script')
    <script>



    $('.delete-alamat-pengiriman').on("click", function() {
        var id = $(this).attr('data-id');
        $.ajax({
            type: "DELETE"
            , url: `${APP_URL}/alamat-pengiriman/${id}`
            , data: {
                "_token": "{{ csrf_token() }}",
                id: id
            }
            , success: function(res) {
                window.location.href = `${APP_URL}/checkout`;
            }
            , error: function(err) {
                alert(err.responseJSON.msg)
            }
        });
    });

    $('.btn-edit-alamat').on('click', function() {
        var url = $(this).attr('data-url')
        $.ajax({
            type: "GET"
            , url: url
            , success: function(res) {
                $('#body-edit-alamat').html(res.html)
                // window.location.href = `${APP_URL}/cart`;
            }
            , error: function(err) {
                // alert(err.responseJSON.msg)
            }
        });
    });

    
    </script>
    @endsection