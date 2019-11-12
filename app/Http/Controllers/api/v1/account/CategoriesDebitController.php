<?php

namespace App\Http\Controllers\api\v1\account;

use App\CategoriesDebit;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriesDebitController extends Controller
{
    /**
     * CategoriesDebitController constructor.
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
        $categories = CategoriesDebit::where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'DESC')
            ->get();

        return response()->json([
            'success' => true,
            'data'    => $categories
        ],200);

    }

}
