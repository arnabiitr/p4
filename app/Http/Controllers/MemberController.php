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

    //   dump($searchResults);


        # Redirect back to the search page w/ the searchTerm *and* searchResults (if any) stored in the session
        # Ref: https://laravel.com/docs/redirects#redirecting-with-flashed-session-data
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
        //dump($treatments);
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
            'first_name' => 'required',
            'last_name' => 'required',
            'ssn' => 'required',
            'insurance_id' => 'required',
            'insurance_expiration_date' => 'required',
            'dob'=>'required'
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

        # Note: Have to sync treatments *after* the member has been saved so there's a member_id to store in the pivot table
         dump($request->treatments);

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
            'first_name' => 'required',
            'last_name' => 'required',
            'ssn' => 'required',
            'insurance_id' => 'required',
            'insurance_expiration_date' => 'required',
            'dob'=>'required'
        ]);

        $member = Member::find($id);
        $member->first_name = $request->first_name;

        # Approach 1 - Using a relationship method
        //$author = Author::find($request->author_id);
        //$member->author()->associate($author);
        $member->treatments()->sync($request->treatments);
        # Approach 2 - Manually setting the FK (more efficient)
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

        $member->treatments()->detach();

        $member->delete();

        return redirect('/members')->with([
            'alert' => '“' . $member->first_name . '” was removed.'
        ]);
    }
}
