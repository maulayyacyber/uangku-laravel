<?php

namespace App\Http\Controllers\api\v1\account;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SaldoController extends Controller
{
    /**
     * SaldoController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $uang_masuk_bulan_ini  = DB::table('debit')
            ->selectRaw('sum(nominal) as nominal')
            ->whereYear('debit_date', Carbon::now()->year)
            ->whereMonth('debit_date', Carbon::now()->month)
            ->where('user_id', Auth::user()->id)
            ->first();

        $uang_keluar_bulan_ini = DB::table('credit')
            ->selectRaw('sum(nominal) as nominal')
            ->whereYear('credit_date', Carbon::now()->year)
            ->whereMonth('credit_date', Carbon::now()->month)
            ->where('user_id', Auth::user()->id)
            ->first();

        $uang_masuk_bulan_lalu  = DB::table('debit')
            ->selectRaw('sum(nominal) as nominal')
            ->whereYear('debit_date', Carbon::now()->year)
            ->whereMonth('debit_date', Carbon::now()->subMonths())
            ->where('user_id', Auth::user()->id)
            ->first();

        $uang_keluar_bulan_lalu = DB::table('credit')
            ->selectRaw('sum(nominal) as nominal')
            ->whereYear('credit_date', Carbon::now()->year)
            ->whereMonth('credit_date', Carbon::now()->subMonths())
            ->where('user_id', Auth::user()->id)
            ->first();

        $uang_masuk_selama_ini  = DB::table('debit')
            ->selectRaw('sum(nominal) as nominal')
            ->where('user_id', Auth::user()->id)
            ->first();

        $uang_keluar_selama_ini = DB::table('credit')
            ->selectRaw('sum(nominal) as nominal')
            ->where('user_id', Auth::user()->id)
            ->first();


        //saldo bulan ini
        $saldo_bulan_ini = $uang_masuk_bulan_ini->nominal - $uang_keluar_bulan_ini->nominal;

        //saldo bulan lalu
        $saldo_bulan_lalu     = $uang_masuk_bulan_lalu->nominal - $uang_keluar_bulan_lalu->nominal;

        //saldo selama ini
        $saldo_selama_ini = $uang_masuk_selama_ini->nominal - $uang_keluar_selama_ini->nominal;

        return response()->json([
            'success' => true,
            'data'    =>
            [
                'saldo_selama_ini' => $saldo_selama_ini,
                'saldo_bulan_ini'  => $saldo_bulan_ini,
                'saldo_bulan_lalu' => $saldo_bulan_lalu,

            ]
        ],200);

    }

}
