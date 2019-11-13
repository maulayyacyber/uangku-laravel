<?php

namespace App\Http\Controllers\api\v1\account;

use App\Debit;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LaporanDebitController extends Controller
{
    /**
     * LaporanDebitController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'tanggal_awal'     => 'required',
            'tanggal_akhir'    => 'required',

        ],
            [
                'tanggal_awal.required'  => 'Silahkan Pilih Tanggal Awal!',
                'tanggal_akhir.required' => 'Silahkan Pilih Tanggal Akhir!',
            ]);

        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'data'    => $validator->errors()
            ],401);

        } else {

            $tanggal_awal  = $request->input('tanggal_awal');
            $tanggal_akhir = $request->input('tanggal_akhir');

            $debit = Debit::select('debit.id', 'debit.category_id', 'debit.user_id', 'debit.nominal', 'debit.debit_date', 'debit.description', 'categories_debit.id as id_category', 'categories_debit.name')
                ->join('categories_debit', 'debit.category_id', '=', 'categories_debit.id', 'LEFT')
                ->whereDate('debit.debit_date', '>=', $tanggal_awal)
                ->whereDate('debit.debit_date', '<=', $tanggal_akhir)
                ->get();

            return response()->json([
                'success' => true,
                'data'    => $debit
            ],401);

        }
    }

}
