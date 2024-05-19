<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Http\Requests\Member\MemberRequest;
use App\Models\Member;
use Exception;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Anggota',
            'members' => Member::all(),
        ];

        return view('member.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Anggota',
            'action' => route('admin.members.store')
        ];

        return view('member.form', $data);
    }

    public function store(MemberRequest $request) 
    {
        try {
            Member::create($request->only(['name','email','phone','address']));

            return redirect()->route('admin.members')->with('success','Data berhasil ditambahkan');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['errors' => 'Opps! Terjadi kesalahan']);
        }
    }

    public function edit(Member $member) 
    {
        $data = [
            'title' => 'Edit Anggota',
            'action' => route('admin.members.update', $member->id),
            'data' => $member
        ];

        return view('member.form', $data);
    }

    public function update(MemberRequest $request, Member $member)
    {
        try {
            $member->update($request->only(['name','email','phone','address']));

            return redirect()->route('admin.members')->with('success','Data Berhasil diperbarui');
        } catch(Exception $e) {
            return redirect()->back()->withErrors(['errors' => 'Opps! Terjadi kesalahan']);
        }
    }

    public function destroy(Member $member) 
    {
        try {
            $member->delete();
    
            return redirect()->route('admin.members')->with('success','Data berhasil dihapus');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['errors' => 'Opps! Terjadi kesalahan']);
        }
    }
}
