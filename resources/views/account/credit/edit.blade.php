@extends('layouts.account')

@section('title')
    Edit Uang keluar - UANGKU
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
                        <h4><i class="fas fa-money-check-alt"></i> EDIT UANG KELUAR</h4>
                    </div>

                    <div class="card-body">

                        <form action="{{ route('account.credit.update', $credit->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>NOMINAL (Rp.)</label>
                                        <input type="text" name="nominal" value="{{ old('nominal', $credit->nominal) }}" placeholder="Masukkan Nominal" class="form-control currency">

                                        @error('nominal')
                                        <div class="invalid-feedback" style="display: block">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>TANGGAL</label>
                                        <input type="text" class="form-control datetimepicker" name="credit_date" value="{{ old('credit_date', $credit->credit_date) }}" placeholder="Pilih Tanggal">

                                        @error('date_debit')
                                        <div class="invalid-feedback" style="display: block">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>KATEGORI</label>
                                        <select class="form-control select2" name="category_id" style="width: 100%">
                                            <option value="">-- PILIH KATEGORI --</option>
                                            @foreach ($categories as $hasil)
                                                @if($credit->category_id == $hasil->id)
                                                    <option value="{{ $hasil->id }}" selected> {{ $hasil->name }}</option>
                                                @else
                                                    <option value="{{ $hasil->id }}"> {{ $hasil->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>

                                        @error('category_id')
                                        <div class="invalid-feedback" style="display: block">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>KETERANGAN</label>
                                        <textarea class="form-control" name="description" rows="6" placeholder="Masukkan Keterangan">{{ old('description', $credit->description) }}</textarea>

                                        @error('description')
                                        <div class="invalid-feedback" style="display: block">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <button class="btn btn-primary mr-1 btn-submit" type="submit"><i class="fa fa-paper-plane"></i> UPDATE</button>
                            <button class="btn btn-warning btn-reset" type="reset"><i class="fa fa-redo"></i> RESET</button>

                        </form>

                    </div>
                </div>
            </div>
        </section>
    </div>
    <script>

        var cleaveC = new Cleave('.currency', {
            numeral: true,
            numeralThousandsGroupStyle: 'thousand'
        });

        var timeoutHandler = null;

        /**
         * btn submit loader
         */
        $( ".btn-submit" ).click(function()
        {
            $( ".btn-submit" ).addClass('btn-progress');
            if (timeoutHandler) clearTimeout(timeoutHandler);

            timeoutHandler = setTimeout(function()
            {
                $( ".btn-submit" ).removeClass('btn-progress');

            }, 1000);
        });

        /**
         * btn reset loader
         */
        $( ".btn-reset" ).click(function()
        {
            $( ".btn-reset" ).addClass('btn-progress');
            if (timeoutHandler) clearTimeout(timeoutHandler);

            timeoutHandler = setTimeout(function()
            {
                $( ".btn-reset" ).removeClass('btn-progress');

            }, 500);
        })

    </script>
@stop
