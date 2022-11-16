<?php

namespace App\Http\Controllers\Subscriber;

use App\Http\Controllers\Controller;
use App\Models\Reminder\Reminder;
use App\Models\Subscriber\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class SubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // call the command emails send 
        Artisan::call('emails:send');
        // get all contact records from table subscribers 
        $contacts = Subscriber::all();
        return view('contacts.contacts', compact('contacts'));
    }
    public function getContactGroups($id)
    {
        // call the command emails send 
        Artisan::call('emails:send');
        // get single contact from table subscribers 
        $contact =  Subscriber::where('id', $id)->first();
        $father = null;
        $groupements = null;
        if ($contact->compte === $contact->groupement) {
            $groupements = Subscriber::where('groupement', $contact->groupement)->where('compte', '!=', $contact->groupement)->get();
        } else {
            $father = Subscriber::where('compte', $contact->groupement)->first();
        }
        // get the groupement of contacts by the field groupement (should be the same)  
        return json_decode(json_encode([$contact, $father, $groupements]), true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subscriber\Subscriber  $subscriber
     * @return \Illuminate\Http\Response
     */
    public function show(Subscriber $subscriber)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subscriber\Subscriber  $subscriber
     * @return \Illuminate\Http\Response
     */
    public function edit(Subscriber $subscriber)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subscriber\Subscriber  $subscriber
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subscriber $subscriber)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subscriber\Subscriber  $subscriber
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscriber $subscriber)
    {
        //
    }
}
