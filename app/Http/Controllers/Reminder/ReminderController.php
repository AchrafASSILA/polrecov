<?php

namespace App\Http\Controllers\Reminder;

use App\Http\Controllers\Controller;
use App\Mail\MailReceipt;
use App\Models\Reminder\Reminder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;

class ReminderController extends Controller
{
    /**
     * Enforce middleware.
     */
    public function __construct()
    {
        $this->middleware('userconsulter', ['only' => ['index']]);
        $this->middleware('user', ['only' => ['store', 'edit', 'update', '', 'sendAnEmailNow']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // call the command emails send 
        Artisan::call('emails:send');
        // get all reminders that send by mail or whatsapp 
        $reminders = Reminder::where('isSendToMail', 1)->orWhere('isSendToWhats', 1)->get();
        return view('reminder.reminders', compact('reminders'));
    }
    public function getScheduleEmail()
    {
        // call the command emails send 
        Artisan::call('emails:send');
        // get all reminders that haven't sent yet 
        $reminders = Reminder::where('isSendToMail', 0)->get();
        return view('reminder.reminders_schedule', compact('reminders'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // call the command emails send 
        Artisan::call('emails:send');
        // get reminder 
        $reminder = Reminder::find($id);
        return view('reminder.edit_reminder', compact('reminder'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // call the command emails send 
        Artisan::call('emails:send');
        // get reminder
        $reminder = Reminder::find($id);
        // update reminder date to send 
        $now = date('Y-m-d');
        if ($request->date_of_livred >= $now) {

            $reminder->update([
                'dateOfLivred' => $request->date_of_livred,
            ]);
            return redirect()->route('scheduleEmail')->with([
                'success' => 'Le rappel à été bien modifier'
            ]);
        } else {
            return redirect()->back()->withErrors(['error' => 'Date Invalide']);
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
        // get reminder and delete it from db 
        Reminder::destroy($id);
        return redirect()->back()->with([
            'success' => 'element supprimer avec succes'
        ]);
    }

    // send an email now 
    public function sendAnEmailNow($id)
    {
        try {
            // get reminder
            $reminder = Reminder::findOrFail($id);
            if ($reminder) {
                // transform string emails cc to array  
                $emails_to_send = explode(',', $reminder->cc);
                // transform files to send to array  
                $files_to_send = explode(',', $reminder->file_to_send);
                // send this reminder now 
                if (strlen($emails_to_send[0]) > 0) {
                    // return "yes";
                    Mail::to($reminder->email_to)->cc($emails_to_send)->send(new MailReceipt($reminder->fileName, $files_to_send, $reminder->message, $reminder->object));
                } else {
                    // return "no";
                    Mail::to($reminder->email_to)->send(new MailReceipt($reminder->fileName, $files_to_send, $reminder->message, $reminder->object));
                }
                $reminder->update([
                    'isSendToMail' => 1,
                    'dateSend' => Carbon::now(),
                ]);
                return redirect()->route('reminder.index')->with(['success' => 'element envoyer avec succes']);
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
