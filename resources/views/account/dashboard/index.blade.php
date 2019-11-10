@extends('layouts.account')

@section('title')
    Dashboard - UANGKU
@stop

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <div class="card card-statistic-2">
                        <div class="card-icon shadow-primary bg-primary">
                            <i class="fas fa-money-check-alt"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>SEMUA SALDO </h4>
                            </div>
                            <div class="card-body" style="font-size: 20px">
                                {{ rupiah($saldo_selama_ini) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <div class="card card-statistic-2">
                        <div class="card-icon shadow-primary bg-primary">
                            <i class="fas fa-money-check-alt"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>SALDO BULAN INI</h4>
                            </div>
                            <div class="card-body" style="font-size: 20px">
                                {{ rupiah($saldo_bulan_ini) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <div class="card card-statistic-2">
                        <div class="card-icon shadow-primary bg-primary">
                            <i class="fas fa-money-check-alt"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>SALDO BULAN LALU</h4>
                            </div>
                            <div class="card-body" style="font-size: 20px">
                                {{ rupiah($saldo_bulan_lalu) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>
@stop
