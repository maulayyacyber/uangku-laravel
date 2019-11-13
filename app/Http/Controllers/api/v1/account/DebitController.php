<?php

namespace App\Http\Controllers\api\v1\account;

use App\Debit;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DebitController extends Controller
{
    /**
     * DebitController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $debit = DB::table('debit')
            ->select('debit.id', 'debit.category_id', 'debit.user_id', 'debit.nominal', 'debit.debit_date', 'debit.description', 'categories_debit.id as id_category', 'categories_debit.name as category_name')
            ->join('categories_debit', 'debit.category_id', '=', 'categories_debit.id', 'LEFT')
            ->where('debit.user_id', Auth::user()->id)
            ->orderBy('debit.created_at', 'DESC')
            ->get();

        return response()->json([
            'success' => true,
            'data'    => $debit
        ],200);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'nominal'        => 'required',
            'debit_date'     => 'required',
            'category_id'    => 'required',
            'description'    => 'required',

        ],
            [
                'nominal.required' => 'Masukkan Nominal Debit / Uang Masuk!',
                'debit_date.required' => 'Silahkan Pilih Tanggal!',
                'category_id.required' => 'Silahkan Pilih Kategori!',
                'description.required' => 'Masukkan Keterangan!',
            ]);

        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'data'    => $validator->errors()
            ],401);

        } else {

            Debit::create([
                'user_id'       => Auth::user()->id,
                'debit_date'   => $request->input('debit_date'),
                'category_id'   => $request->input('category_id'),
                'nominal'       => str_replace(",", "", $request->input('nominal')),
                'description'   => $request->input('description'),
            ]);

            return response()->json([
                'success' => true,
                'data'    => 'Data Berhasil Disimpan !'
            ],200);

        }
    }

}
