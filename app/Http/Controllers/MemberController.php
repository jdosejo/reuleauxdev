<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\Http\Resources\Member as MemberResource;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;

use App\Helpers\Helper;

class MemberController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $records = $request->query('records');
        //$search = $request->query('search');

        if (!$records) $records = 10;

        $members = Member::paginate($records);

        // if ($search == '') {
        //     $members = Member::paginate($records);
        // } else {
        //     $members = Member::where('firstname', 'like', '%' . $search . '%')
        //         ->orWhere('lastname', 'like', '%' . $search . '%')
        //         ->orWhere('middlename', 'like', '%' . $search . '%')
        //         ->orWhere('address', 'like', '%' . $search . '%')
        //         ->paginate($records);
        // }
        

        $total = $members->total();
        $currPage = $members->currentPage();
        $totalPages = ceil($total / $records);

        $from = min(max(($currPage - 1) * $records, 1), $total);
        $to = min($from + $records, $total);
    
        $first = $currPage > 1 ? '?page=1&records=' . $records : '';
        $next = $currPage < $totalPages ? '?page=' . ($currPage + 1) . '&records=' . $records : '';
        $prev = $currPage > 1 ? '?page=' . ($currPage - 1) . '&records=' . $records : '';
        $last = $currPage < $totalPages ? '?page=' . $totalPages . '&records=' . $records : '';
        
        $members->put('paginate', [
            'first' => $first,
            'next' => $next,
            'prev' => $prev,
            'last' => $last
        ]);

        return json_encode(MemberResource::collection($members));

        // return view('member', [
        //     'data' => $members, 
        //     'total' => $members->total(),
        //     'from' => $from,
        //     'to' => $to,
        //     'first' => $first,
        //     'next' => $next,
        //     'prev' => $prev,
        //     'last' => $last
        // ]);

        // $members = Member::paginate(10);
        // return json_encode(MemberResource::collection($members));
    }

    // public function members(Request $request) {
    //     $records = $request->query('records');

    //     if (!$records) $records = 5;

    //     $members = Member::paginate($records);

    //     $total = $members->total();
    //     $currPage = $members->currentPage();
    //     $totalPages = ceil($total / $records);

    //     $from = min(max(($currPage - 1) * $records, 1), $total);
    //     $to = min($from + $records, $total);
    
    //     $first = $currPage > 1 ? '?page=1&records=' . $records . '#member-list' : '#';
    //     $next = $currPage < $totalPages ? '?page=' . ($currPage + 1) . '&records=' . $records . '#member-list' : '#';
    //     $prev = $currPage > 1 ? '?page=' . ($currPage - 1) . '&records=' . $records . '#member-list' : '#';
    //     $last = $currPage < $totalPages ? '?page=' . $totalPages . '&records=' . $records . '#member-list' : '#';

    //     return view('member', [
    //         'data' => $members, 
    //         'total' => $members->total(),
    //         'from' => $from,
    //         'to' => $to,
    //         'first' => $first,
    //         'next' => $next,
    //         'prev' => $prev,
    //         'last' => $last
    //     ]);
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $member = $request->isMethod('put') ? 
            Member::findOrFail($request->id) : new Member;

        $member->firstname = $request->input('firstname');
        $member->lastname = $request->input('lastname');
        $member->middlename = $request->input('middlename');
        $member->age = $request->input('age');
        $member->birthdate = $request->input('birthdate');
        $member->address = $request->input('address');
        $member->status = $request->input('status');
        $member->classification_id = $request->input('classification_id');
        $member->contact = $request->input('contact');
        $member->picture = $request->input('picture');
        
        if ($request->input('password') != "")
            $member->password = bcrypt($request->input('password'));

        $member->username = $request->input('username');
        $member->signature = $request->input('signature');

        if ($request->imgbase64 != "") {
            $this->uploadPic('/images/pics/', $request->username, $request->imgbase64);
        }

        if ($request->sigbase64 != "") {
            $this->uploadPic('/images/signatures/', $request->username, $request->sigbase64);
        }

        if ($member->save()) {
            return new MemberResource($member);
        } else {
            return response(['error' => $member]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (is_numeric($id)) {
            $member = Member::findOrFail($id);
        } else {
            $member = Member::where('username', '=', $id)->first();
        }
        
        return new MemberResource($member);
    }

    public function scan(Request $request) {
        $member = Member::where('username', '=', $request->input('id'))->get();
        $member = Member::findOrFail($member[0]->id);

        $member->access_token = $request->input('qr_code');

        if ($member->save()) {
            $member = Member::where('username', '=', $request->input('qr_code'))->get();
            return new MemberResource($member);
        } else {
            return response(['error' => $member]);
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
        $member = Member::findOrFail($id);

        if ($member->delete()) {
            return new MemberResource($member);
        }
    }

    public function uploadPic($path, $fn, $b64) {
        $path = public_path() . $path . $fn . ".png";

        $img = substr($b64, strpos($b64, ",") + 1);
        $imagedata = base64_decode($img);
        file_put_contents($path, $imagedata); 
    }
}
