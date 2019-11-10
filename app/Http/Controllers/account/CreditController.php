<?php

namespace App\Http\Controllers\account;

use App\CategoriesCredit;
use App\Credit;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CreditController extends Controller
{
    /**
     * CreditController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $credit = DB::table('credit')
            ->select('credit.id', 'credit.category_id', 'credit.user_id', 'credit.nominal', 'credit.credit_date', 'credit.description', 'categories_credit.id as id_category', 'categories_credit.name')
            ->join('categories_credit', 'credit.category_id', '=', 'categories_credit.id', 'LEFT')
            ->where('credit.user_id', Auth::user()->id)
            ->orderBy('credit.created_at', 'DESC')
            ->paginate(10);
        return view('account.credit.index', compact('credit'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request)
    {
        $search = $request->get('q');
        $credit = DB::table('credit')
            ->select('credit.id', 'credit.category_id', 'credit.user_id', 'credit.nominal', 'credit.credit_date', 'credit.description', 'categories_credit.id as id_category', 'categories_credit.name')
            ->join('categories_credit', 'credit.category_id', '=', 'categories_credit.id', 'LEFT')
            ->where('credit.user_id', Auth::user()->id)
            ->where('credit.description', 'LIKE', '%' .$search. '%')
            ->orderBy('credit.created_at', 'DESC')
            ->paginate(10);
        return view('account.credit.index', compact('credit'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = CategoriesCredit::where('user_id', Auth::user()->id)
            ->get();
        return view('account.credit.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //set validasi required
        $this->validate($request, [
            'nominal'       => 'required',
            'credit_date'    => 'required',
            'category_id'   => 'required',
            'description'   => 'required'
        ],
            //set message validation
            [
                'nominal.required' => 'Masukkan Nominal Debit / Uang Keluar!',
                'credit_date.required' => 'Silahkan Pilih Tanggal!',
                'category_id.required' => 'Silahkan Pilih Kategori!',
                'description.required' => 'Masukkan Keterangan!',
            ]
        );

        //Eloquent simpan data
        $save = Credit::create([
            'user_id'       => Auth::user()->id,
            'credit_date'   => $request->input('credit_date'),
            'category_id'   => $request->input('category_id'),
            'nominal'       => str_replace(",", "", $request->input('nominal')),
            'description'   => $request->input('description'),
        ]);
        //cek apakah data berhasil disimpan
        if($save){
            //redirect dengan pesan sukses
            return redirect()->route('account.credit.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('account.credit.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Credit $credit)
    {
        $categories = CategoriesCredit::where('user_id', Auth::user()->id)
            ->get();
        return  view('account.credit.edit', compact('credit', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Credit $credit)
    {
        //set validasi required
        $this->validate($request, [
            'nominal'       => 'required',
            'credit_date'    => 'required',
            'category_id'   => 'required',
            'description'   => 'required'
        ],
            //set message validation
            [
                'nominal.required' => 'Masukkan Nominal Debit / Uang Keluar!',
                'credit_date.required' => 'Silahkan Pilih Tanggal!',
                'category_id.required' => 'Silahkan Pilih Kategori!',
                'description.required' => 'Masukkan Keterangan!',
            ]
        );

        //Eloquent simpan data
        $update = Credit::whereId($credit->id)->update([
            'user_id'       => Auth::user()->id,
            'category_id'   => $request->input('category_id'),
            'credit_date'    => $request->input('credit_date'),
            'nominal'       => str_replace(",", "", $request->input('nominal')),
            'description'   => $request->input('description'),
        ]);
        //cek apakah data berhasil disimpan
        if($update){
            //redirect dengan pesan sukses
            return redirect()->route('account.credit.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('account.credit.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Credit::find($id)->delete($id);

        if($delete){
            return response()->json([
                'status' => 'success'
            ]);
        }else{
            return response()->json([
                'status' => 'error'
            ]);
        }
    }
}
