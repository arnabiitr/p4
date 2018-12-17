<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\Claim;



class ClaimController extends Controller
{
    /*
     * GET /claims
     */
    public function index()
    {
        $claims = Claim::orderBy('member_id')->get();

        $newClaims = $claims->sortByDesc('created_at')->take(3);


    return view('claims.index')->with([
            'claims' => $claims,
            'newClaims'=>$newClaims
        ]);
    }

    /*
     * GET /members/{id}
     */
    public function show(Request $request, $id)
    {
        $claim = Claim::find($id);

        return view('claims.show')->with([
            'claim' => $claim
        ]);
    }

    /**
     * GET
     * /claims/search
     * Show the form to search for a member
     */
    public function search(Request $request)
    {
        return view('claims.search')->with([
            'searchTerm' => session('searchTerm', ''),
            'caseSensitive' => session('caseSensitive', false),
            'searchResults' => session('searchResults', []),
        ]);
    }

    /**
     *
     * GET
     * /claims/search-process
     * Process the form to search for a claims
     */
    public function searchProcess(Request $request)
    {

        $searchResults = [];


        $searchTerm = $request->input('searchTerm', null);


        if ($searchTerm) {

                # If it was a match, add it to our results

                    $searchResults=Claim::where('diagnosis_code',$searchTerm)->get();

        }

        return redirect('/claims/search')->with([
            'searchTerm' => $searchTerm,
            'caseSensitive' => $request->has('caseSensitive'),
            'searchResults' => $searchResults
        ]);
    }

    /**
     * GET /claims/create
     * Display the form to add a new member
     */
    public function create(Request $request)
    {

       $members = Member::getForDropdown();


        return view('claims.create')->with([
                'members' => $members
            ]);
    }

    /**
     * POST /claims
     * Process the form for adding a new member
     */
    public function store(Request $request)
    {


        # Validate the request data
        $request->validate([
            'total_amount' => 'numeric|required',
            'amount_paid' =>  'numeric|required',
            'diagnosis_code'=>'required|in:AR,BR,ER',
            'status'=>'required|numeric|in:0,1,2'


        ]);

        $claim = new Claim();
        $claim->member_id = $request->member_id;

        $claim->diagnosis_code = $request->diagnosis_code;

        $claim->total_amount= $request->total_amount;
        $claim->amount_paid = $request->amount_paid;
        $claim->status = $request->status;

        $claim->save();

        return redirect('/claims')->with([
            'alert' => 'Your claim was added.'
        ]);
    }

    /*
    * GET /claims/{id}/edit
    */
    public function edit($id)
    {
        $claim = Claim::find($id);
        $members = Member::getForDropdown();

        if (!$claim) {
            return redirect('/claims')->with([
                'alert' => 'Claim not found.'
            ]);
        }

        return view('claims.edit')->with([
            'claim'=>$claim,
            'members' => $members

        ]);
    }

    /*
    * PUT /claims/{id}
    */
    public function update(Request $request, $id)
    {

        # Validate the request data
         $request->validate([
            'total_amount' => 'numeric|required',
            'amount_paid' =>  'numeric|required',
             'diagnosis_code'=>'required|in:AR,BR,ER',
             'status'=>'required|numeric|in:0,1,2'

        ]);

        $claim= Claim::find($id);

        $claim->member_id = $request->member_id;

        $claim->diagnosis_code = $request->diagnosis_code;

        $claim->total_amount= $request->total_amount;
        $claim->amount_paid = $request->amount_paid;
        $claim->status = $request->status;
        $claim->save();

        return redirect('/claims/' . $id . '/edit')->with([
            'alert' => 'Your changes were saved.'
        ]);
    }

    /*
   * Asks user to confirm they actually want to delete the claim
   * GET /claims/{id}/delete
   */
    public function delete($id)
    {
        $claim= Claim::find($id);

        if (!$claim) {
            return redirect('/claims')->with('alert', 'claim not found');
        }

        return view('claims.delete')->with([
            'claim' => $claim,
        ]);
    }

    /*
    * Actually deletes the claim
    * DELETE /claims/{id}/delete
    */
    public function destroy($id)
    {
        $claim = Claim::find($id);

        $claim->delete();

        return redirect('/claims')->with([
            'alert' => '“' . $claim->id . '” was removed.'
        ]);
    }
}
