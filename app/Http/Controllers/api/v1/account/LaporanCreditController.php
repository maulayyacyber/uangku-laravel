<?php

namespace App\Http\Controllers\api\v1\account;

use App\Credit;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LaporanCreditController extends Controller
{
    /**
     * LaporanCreditController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
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

            $credit = Credit::select('credit.id', 'credit.category_id', 'credit.user_id', 'credit.nominal', 'credit.credit_date', 'credit.description', 'categories_credit.id as id_category', 'categories_credit.name')
                ->join('categories_credit', 'credit.category_id', '=', 'categories_credit.id', 'LEFT')
                ->whereDate('credit.credit_date', '>=', $tanggal_awal)
                ->whereDate('credit.credit_date', '<=', $tanggal_akhir)
                ->get();

            return response()->json([
                'success' => true,
                'data'    => $credit
            ],401);

        }
    }
}
