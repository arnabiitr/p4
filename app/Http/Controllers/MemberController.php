<?php

namespace App\Http\Controllers;

use App\Treatment;
use Illuminate\Http\Request;
use App\Member;



class MemberController extends Controller
{
    /*
     * GET /members
     */
    public function index()
    {
        $members = Member::orderBy('first_name')->get();
        $newMembers = $members->sortByDesc('created_at')->take(3);


     return view('members.index')->with([
            'members' => $members,
            'newMembers' => $newMembers
        ]);
    }

    /*
     * GET /members/{id}
     */
    public function show(Request $request, $id)
    {
        $member = Member::find($id);

        return view('members.show')->with([
            'member' => $member
        ]);
    }

    /**
     * GET
     * /members/search
     * Show the form to search for a member
     */
    public function search(Request $request)
    {
        return view('members.search')->with([
            'searchTerm' => session('searchTerm', ''),
            'searchTerm1' => session('searchTerm1', ''),
            'caseSensitive' => session('caseSensitive', false),
            'searchResults' => session('searchResults', []),
        ]);
    }

    /**
     * TODO: Refactor to get members from database, not members.json
     * GET
     * /members/search-process
     * Process the form to search for a member
     */
    public function searchProcess(Request $request)
    {

        $searchResults = [];


        $searchTerm = $request->input('searchTerm', null);
        $searchTerm1 = $request->input('searchTerm1', null);


        if ($searchTerm && $searchTerm1==null) {

                # If it was a match, add it to our results

                    $searchResults=Member::where('first_name',$searchTerm)->get();

        }
        else if($searchTerm && $searchTerm1 ){

            $searchResults=Member::where('first_name',$searchTerm)
            ->where('last_name',$searchTerm1)
            ->get();
        }

        else if($searchTerm==null && $searchTerm1 ){

            $searchResults=Member::where('last_name',$searchTerm1)->get();
        }

        return redirect('/members/search')->with([
            'searchTerm' => $searchTerm,
            'searchTerm1' => $searchTerm1,
            'caseSensitive' => $request->has('caseSensitive'),
            'searchResults' => $searchResults
        ]);
    }

    /**
     * GET /members/create
     * Display the form to add a new member
     */
    public function create(Request $request)
    {
        $treatments= Treatment::getForCheckboxes();

        return view('members.create')->with([

            'treatments' => $treatments
        ]);
    }

    /**
     * POST /members
     * Process the form for adding a new member
     */
    public function store(Request $request)
    {


        # Validate the request data
        $request->validate([
            'first_name' => 'required|string|max:255|regex:/(^([a-zA-Z]+)(\d+)?$)/u',
            'last_name' => 'required|string|max:255|regex:/(^([a-zA-Z]+)(\d+)?$)/u',
            'ssn' => 'required',
            'insurance_id' => 'required|alpha_num',
            'insurance_expiration_date' => 'required|digits:4|min:20119',
            'dob'=>'required|digits:4|min:1910'
        ],
        [
        'insurance_expiration_date.min' => 'Insurance expiry year should be later than 2018',
            'dob.min' => 'DOB  year should be later than 1910'
            ]);

        $member = new Member();
        $member->first_name = $request->first_name;
        $member->last_name = $request->last_name;
        $member->ssn= $request->ssn;
        $member->address = $request->address;
        $member->insurance_id = $request->insurance_id;
        $member->insurance_expiration_date = $request->insurance_expiration_date;
        $member->dob = $request->dob;
        $member->save();

         $member->treatments()->sync($request->treatments);

        return redirect('/members')->with([
            'alert' => 'Your member was added.'
        ]);
    }

    /*
    * GET /members/{id}/edit
    */
    public function edit($id)
    {
        $member = Member::find($id);

        $treatments= Treatment::getForCheckboxes();
        $treatmentsForThisMember=$member->treatments()->pluck('treatments.id')->toArray();
       // dump($treatmentsForThisMember);

        if (!$member) {
            return redirect('/members')->with([
                'alert' => 'Member not found.'
            ]);
        }

        return view('members.edit')->with([
            'member' => $member,
            'treatments'=>$treatments,
            'treatmentsForThisMember'=>$treatmentsForThisMember

        ]);
    }

    /*
    * PUT /members/{id}
    */
    public function update(Request $request, $id)
    {

        # Validate the request data
        $request->validate([
            'first_name' => 'required|string|max:255|regex:/(^([a-zA-Z]+)(\d+)?$)/u',
            'last_name' => 'required|string|max:255|regex:/(^([a-zA-Z]+)(\d+)?$)/u',
            'ssn' => 'required',
            'insurance_id' => 'required|alpha_num',
            'insurance_expiration_date' => 'required|digits:4|min:2019',
            'dob'=>'required|digits:4|min:1910'
        ],
            [
                'insurance_expiration_date.min' => 'Insurance expiry year should be later than 2018',
                'dob.min' => 'DOB  year should be later than 1910'
            ]
            );

        $member = Member::find($id);
        $member->first_name = $request->first_name;

        $member->treatments()->sync($request->treatments);

        $member->last_name = $request->last_name;

        $member->ssn= $request->ssn;
        $member->address = $request->address;
        $member->insurance_id = $request->insurance_id;
        $member->insurance_expiration_date = $request->insurance_expiration_date;
        $member->dob = $request->dob;
        $member->save();

        return redirect('/members/' . $id . '/edit')->with([
            'alert' => 'Your changes were saved.'
        ]);
    }

    /*
   * Asks user to confirm they actually want to delete the member
   * GET /members/{id}/delete
   */
    public function delete($id)
    {
        $member = Member::find($id);

        if (!$member) {
            return redirect('/members')->with('alert', 'Member not found');
        }

        return view('members.delete')->with([
            'member' => $member,
        ]);
    }

    /*
    * Actually deletes the member
    * DELETE /members/{id}/delete
    */
    public function destroy($id)
    {
        $member = Member::find($id);

        $member->claim()->delete();

        $member->treatments()->detach();



        $member->delete();

        return redirect('/members')->with([
            'alert' => '“' . $member->first_name . '” was removed.'
        ]);
    }


}
