<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Repositories\MemberRepository;
use App\Services\MemberService;
use App\Http\Requests\Member\CreateMemberRequest;
use App\Http\Requests\Member\UpdateMemberRequest;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        return view('member.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        return view('member.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateMemberRequest $request): RedirectResponse
    {
        Member::create($request->all());

        return redirect('/member')->with('success', 'Sukses Menambahkan Anggota');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member): View
    {
        return view('member.edit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMemberRequest $request, Member $member): RedirectResponse
    {
        $member->update($request->all());

        return redirect('/member')->with('success', 'Sukses Mengedit Anggota');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member): JsonResponse
    {
        $member->delete();

        return response()->json('Sukses Menghapus Anggota');
    }

    public function datatables(MemberService $member): Object
    {
        return $member->getDatatables();
    }

    public function search(Request $request, MemberRepository $member): Object
    {
        return $member->search($request->name);
    }
}
