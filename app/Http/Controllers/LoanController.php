<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Services\LoanService;
use App\Http\Requests\Loan\CreateLoanRequest;
use App\Http\Requests\Loain\UpdateLoanRequest;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;

class LoanController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        return view('loan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        return view('loan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateLoanRequest $request): RedirectResponse
    {
        Loan::create($request->all());

        return redirect('/loan')->with('success', 'Sukses Meminjam Buku');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Loan $loan): JsonResponse
    {
        $loan->delete();

        return response()->json('Sukses Menghapus Peminjaman');
    }

    public function datatables(LoanService $loan): Object
    {
        return $loan->getDatatables();
    }
}
