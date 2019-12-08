<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Helper;

use App\Branch;
use App\Member;
use App\Classification;

use Session;
use DB;

class PageController extends Controller
{
    public function __construct() {
        $this->middleware('auth', ['except' => ['login']]);
    }

    public function index(Request $request) {
        $username = $request->input('qr_code');
        $member = [];

        if (!$username) {
            $member = Member::first();
        } else {
            $member = Member::where('username', $username)->first();
        }

        if ($member == null) $member = [];
        
        return view('dashboard', ['data' => $member]);
    }

    public function login() {
        $ldate = date('F d, Y l');
        return view('index', ['ldate' => $ldate]);
    }

    public function members(Request $request) {
        $user = auth()->user();
        
        $stats = $this->getStats();
        $statinfo = [0, 0, 0];
        $overallMembers = 0;

        foreach($stats['data'] as $val) {
            $statinfo[$val['classification_id'] - 1] = $val['total'];
            $overallMembers += $val['total'];
        }

        $branchMemberCount = Member::select(DB::raw('count(*) as total'))
            ->where('branch_id', $user->branch_id)
            ->groupBy('branch_id')
            ->get()->toArray()[0]['total'];

        $overallPercentage = 0;

        if ($overallMembers > 0) {
            $overallPercentage = $branchMemberCount / $overallMembers * 100;
        }

        $records = $request->query('records');
        $search = $request->query('search');

        if (!$records) $records = 5;

        // $members = Member::paginate($records);

        if ($search == '') {
            $members = Member::paginate($records);
        } else {
            $members = Member::where('firstname', 'like', '%' . $search . '%')
                ->orWhere('lastname', 'like', '%' . $search . '%')
                ->orWhere('middlename', 'like', '%' . $search . '%')
                ->orWhere('address', 'like', '%' . $search . '%')
                ->orWhere('username', '=', $search)
                ->paginate($records);
        }

        $total = $members->total();
        $currPage = $members->currentPage();
        $totalPages = ceil($total / $records);

        $from = min(max(($currPage - 1) * $records, 1), $total);
        $to = min($from + $records, $total);
    
        $first = $currPage > 1 ? '?page=1&records=' . $records . '&search=' . $search . '#member-list' : '#';
        $next = $currPage < $totalPages ? '?page=' . ($currPage + 1) . '&records=' . $records . '&search=' . $search . '#member-list' : '#';
        $prev = $currPage > 1 ? '?page=' . ($currPage - 1) . '&records=' . $records . '&search=' . $search . '#member-list' : '#';
        $last = $currPage < $totalPages ? '?page=' . $totalPages . '&records=' . $records . '&search=' . $search . '#member-list' : '#';

        return view('member', [
            'data' => $members, 
            'total' => $members->total(),
            'from' => $from,
            'to' => $to,
            'first' => $first,
            'next' => $next,
            'prev' => $prev,
            'last' => $last,
            'leaders' => $statinfo[0],
            'staffs' => $statinfo[1],
            'members' => $statinfo[2],
            'overallPercentage' => number_format((float)$overallPercentage, 2, '.', '')
        ]);
    }

    public function branches(Request $request) {
        $records = $request->query('records');
        $search = $request->query('search');

        if (!$records) $records = 5;

        // $branches = Branch::paginate($records);
        if ($search == '') {
            $branches = Branch::paginate($records);
        } else {
            $branches = Branch::where('name', 'like', '%' . $search . '%')
                ->orWhere('address', 'like', '%' . $search . '%')
                ->paginate($records);
        }

        $total = $branches->total();
        $currPage = $branches->currentPage();
        $totalPages = ceil($total / $records);

        $from = min(max(($currPage - 1) * $records, 1), $total);
        $to = min($from + $records, $total);
    
        $first = $currPage > 1 ? '?page=1&records=' . $records . '&search=' . $search . '#branch-list' : '#';
        $next = $currPage < $totalPages ? '?page=' . ($currPage + 1) . '&records=' . $records . '&search=' . $search . '#branch-list' : '#';
        $prev = $currPage > 1 ? '?page=' . ($currPage - 1) . '&records=' . $records . '&search=' . $search . '#branch-list' : '#';
        $last = $currPage < $totalPages ? '?page=' . $totalPages . '&records=' . $records . '&search=' . $search . '#branch-list' : '#';

        return view('branch', [
            'data' => $branches, 
            'total' => $branches->total(),
            'from' => $from,
            'to' => $to,
            'first' => $first,
            'next' => $next,
            'prev' => $prev,
            'last' => $last
        ]);
    }

    public function profiling() {
        $classifications = Classification::select('id', 'name')
            ->get()->toArray();
            //->where('id', '!=', 1)->get()->toArray();
        $branches = Branch::select('id', 'name')->get()->toArray();

        $member = Member::latest('id')->first();

        return view('profiling', [
            'classifications' => $classifications,
            'branches' => $branches,
            'nextid' => $member->id + 1
        ]);
    }

    public function uploadPic(Request $request) {
        $png_url = "product-".time().".png";
        $path = public_path() . '/images/pics/' . $png_url;

        //Image::make(file_get_contents($request->base64image))->save($path); 
        $img = $request->input('base64image');
        $img = substr($img, strpos($img, ",")+1);
        $imagedata = base64_decode($img);
        file_put_contents($path, $imagedata); 

        $response = array(
            'status' => 'success',
        );
        return response( $response  );
    }

    public function getStats() {
        $members = Member::select('classification_id', DB::raw('count(*) as total'))
            ->groupBy('classification_id')
            ->get()->toArray();

        return ['data' => $members];
    }
}
