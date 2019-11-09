<?php

namespace App\Http\Controllers\account;

use App\CategoriesCredit;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriesCreditController extends Controller
{
    /**
     * CategoriesCreditController constructor.
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
        $categories = CategoriesCredit::where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
        return view('account.categories_credit.index', compact('categories'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request)
    {
        $search = $request->get('q');
        $categories = CategoriesCredit::where('user_id', Auth::user()->id)
            ->where('name', 'LIKE', '%' .$search. '%')
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
        return view('account.categories_credit.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('account.categories_credit.create');
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
            'name'  => 'required'
        ],
            //set message validation
            [
                'name.required' => 'Masukkan Nama Kategori !',
            ]
        );

        //Eloquent simpan data
        $save = CategoriesCredit::create([
            'user_id'       => Auth::user()->id,
            'name'          => $request->input('name')
        ]);
        //cek apakah data berhasil disimpan
        if($save){
            //redirect dengan pesan sukses
            return redirect()->route('account.categories_credit.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('account.categories_credit.index')->with(['error' => 'Data Gagal Disimpan!']);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, CategoriesCredit $categoriesCredit)
    {
        return view('account.categories_credit.edit', compact('categoriesCredit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CategoriesCredit $categoriesCredit)
    {
        //set validasi required
        $this->validate($request, [
            'name'  => 'required'
        ],
            //set message validation
            [
                'name.required' => 'Masukkan Nama Kategori !',
            ]
        );

        //Eloquent simpan data
        $update = CategoriesCredit::whereId($categoriesCredit->id)->update([
            'user_id'       => Auth::user()->id,
            'name'          => $request->input('name')
        ]);
        //cek apakah data berhasil disimpan
        if($update){
            //redirect dengan pesan sukses
            return redirect()->route('account.categories_credit.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('account.categories_credit.index')->with(['error' => 'Data Gagal Diupdate!']);
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
        $delete = CategoriesCredit::find($id)->delete($id);

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
