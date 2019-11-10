@extends('layouts.account')

@section('title')
    Uang Keluar - UANGKU
@stop

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1> UANG KELUAR</h1>
            </div>

            <div class="section-body">

                <div class="card">
                    <div class="card-header">
                        <h4><i class="fas fa-money-check-alt"></i> UANG KELUAR</h4>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('account.credit.search') }}" method="GET">
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <a href="{{ route('account.credit.create') }}" class="btn btn-primary" style="padding-top: 10px;"><i class="fa fa-plus-circle"></i> TAMBAH</a>
                                    </div>
                                    <input type="text" class="form-control" name="q"
                                           placeholder="cari berdasarkan keterangan">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> CARI
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col" style="text-align: center;width: 6%">NO.</th>
                                    <th scope="col">KATEGORI</th>
                                    <th scope="col">NOMINAL</th>
                                    <th scope="col">KETERANGAN</th>
                                    <th scope="col">TANGGAL</th>
                                    <th scope="col" style="width: 15%;text-align: center">AKSI</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($credit as $hasil)
                                    <tr>
                                        <th scope="row" style="text-align: center">{{ $no }}</th>
                                        <td>{{ $hasil->name }}</td>
                                        <td>{{ rupiah($hasil->nominal) }}</td>
                                        <td>{{ $hasil->description }}</td>
                                        <td>{{ $hasil->credit_date }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('account.credit.edit', $hasil->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fa fa-pencil-alt"></i>
                                            </a>
                                            <button onClick="Delete(this.id)" class="btn btn-sm btn-danger" id="{{ $hasil->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @php
                                        $no++;
                                    @endphp
                                @endforeach
                                </tbody>
                            </table>
                            <div style="text-align: center">
                                {{$credit->links("vendor.pagination.bootstrap-4")}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        /**
         * Sweet alert
         */
        @if($message = Session::get('success'))
        swal({
            type: "success",
            icon: "success",
            title: "BERHASIL!",
            text: "{{ $message }}",
            timer: 1500,
            showConfirmButton: false,
            showCancelButton: false,
            buttons: false,
        });
        @elseif($message = Session::get('error'))
        swal({
            type: "error",
            icon: "error",
            title: "GAGAL!",
            text: "{{ $message }}",
            timer: 1500,
            showConfirmButton: false,
            showCancelButton: false,
            buttons: false,
        });
        @endif

        // delete
        function Delete(id)
        {
            var id = id;
            var token = $("meta[name='csrf-token']").attr("content");

            swal({
                title: "APAKAH KAMU YAKIN ?",
                text: "INGIN MENGHAPUS DATA INI!",
                icon: "warning",
                buttons: [
                    'TIDAK',
                    'YA'
                ],
                dangerMode: true,
            }).then(function(isConfirm) {
                if (isConfirm) {

                    //ajax delete
                    jQuery.ajax({
                        url: "{{ route("account.credit.index") }}/"+id,
                        data: 	{
                            "id": id,
                            "_token": token
                        },
                        type: 'DELETE',
                        success: function (response) {
                            if (response.status == "success") {
                                swal({
                                    title: 'BERHASIL!',
                                    text: 'DATA BERHASIL DIHAPUS!',
                                    icon: 'success',
                                    timer: 1000,
                                    showConfirmButton: false,
                                    showCancelButton: false,
                                    buttons: false,
                                }).then(function() {
                                    location.reload();
                                });
                            }else{
                                swal({
                                    title: 'GAGAL!',
                                    text: 'DATA GAGAL DIHAPUS!',
                                    icon: 'error',
                                    timer: 1000,
                                    showConfirmButton: false,
                                    showCancelButton: false,
                                    buttons: false,
                                }).then(function() {
                                    location.reload();
                                });
                            }
                        }
                    });

                } else {
                    return true;
                }
            })
        }
    </script>

@stop
