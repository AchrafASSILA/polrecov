<?php

namespace App\Console\Commands;

use App\Mail\MailReceipt;
use App\Models\Impayes\Impayes;
use App\Models\Reminder\Reminder;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emails:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // get current date 
        $date =  Carbon::now()->format('Y-m-d');
        // get all reminders that need to send in this day 
        $impayes = Reminder::where('isSendToMail', 0)->where('dateOfLivred', $date)->get();
        if ($impayes) {
            foreach ($impayes as $impaye) {
                // transform string emails cc to array  
                $emails_to_send = explode(',', $impaye->cc);
                // transform files to send to array  
                $files_to_send = explode(',', $impaye->file_to_send);
                if (strlen($emails_to_send[0]) > 1) {
                    Mail::to($impaye->email_to)->cc($emails_to_send)->send(new MailReceipt($impaye->fileName, $files_to_send, $impaye->message, $impaye->object));
                } else {
                    Mail::to($impaye->email_to)->send(new MailReceipt($impaye->fileName, $files_to_send, $impaye->message, $impaye->object));
                }
                $impaye->update([
                    'isSendToMail' => 1,
                    'dateSend' => Carbon::now(),
                ]);
            }
        }
        return 0;
    }
}
