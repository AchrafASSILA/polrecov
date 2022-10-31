<?php

namespace App\Http\Controllers\Impayes;

use App\Http\Controllers\Controller;
use App\Imports\ContactImport;
use App\Imports\ImpayesImport;
use App\Imports\ImpayesSubsImport;
use App\Mail\MailReceipt;
use App\Models\Impayes\Impayes;
use App\Models\Reminder\Reminder;
use App\Models\Subscriber\Subscriber;
use App\Repository\Impayes\ImpayesRepoInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Netflie\WhatsAppCloudApi\WhatsAppCloudApi;
use PDF;

class ImpayesController extends Controller
{
    protected $Impayes;

    public function __construct(ImpayesRepoInterface $Impayes)
    {
        $this->Impayes = $Impayes;
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
        $impayes = $this->Impayes->getAllImpayes();
        return view('pages.impayes', compact('impayes'));
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

        try {
            // call the command emails send 
            Artisan::call('emails:send');
            $request->validate(
                [
                    'subs_id' => "required",
                ],
                [
                    'subs_id.required' => "vous devez choisir des impayés s'il vous plait"
                ]

            );
            // get the contact is name from reminder 
            $subscribers = [];
            foreach ($request->subs_id as $sub) {
                $subscribers[] = explode('/', $sub)[1];
            }
            // get the groupment of all contacts 
            $subscribers =  Subscriber::whereIn('raisonsociale', array_unique($subscribers))->pluck('groupement');
            $subscribers =  json_decode(json_encode($subscribers), true);
            // check if the groupment of all reminder are same or i will throw an error 
            if (count(array_unique($subscribers)) > 1) {
                return redirect()->back()->withErrors([
                    'error' => 'vous devrez choisissez les impayés de même groupe',
                ]);
            }

            // get the data from function strucuteredSubs 
            $vars = $this->strucuteredSubs($request);
            // get receipts 
            $receipts = $vars[0];
            // get quittances 
            $quitances = $vars[1];
            // get subs princip 
            $subscriber_principale = $vars[2];
            // get a list of all files in the directory  D:\clients\ali boughaleb\quittances
            $files =  array_values(array_diff(scandir('D:\clients\ali boughaleb\quittances'), array('.', '..')));
            $files_quittances = [];
            foreach ($files as $file) {
                $files_quittances[] = ltrim(rtrim($file, '.pdf'), 'Q_');
            }

            return view('pages.print', compact('receipts', 'quitances', 'subscriber_principale', 'files_quittances'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Impayes\Impayes  $impayes
     * @return \Illuminate\Http\Response
     */
    public function show(Impayes $impayes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Impayes\Impayes  $impayes
     * @return \Illuminate\Http\Response
     */
    public function edit(Impayes $impayes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Impayes\Impayes  $impayes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Impayes $impayes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Impayes\Impayes  $impayes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Impayes $impayes)
    {
        //
    }


    //structered subscribers with there impayes
    public function strucuteredSubs($request)
    {
        // call the command emails send 
        Artisan::call('emails:send');
        return $this->Impayes->strucuteredSubs($request);
    }


    // export to pdf and send it 
    public function exportPdf(Request $request)
    {
        // try {
        Artisan::call('emails:send');
        $files_to_send =  explode(',', ($request->files_to_send));

        // get the data from function strucuteredSubs 
        $vars = $this->strucuteredSubs($request);

        // get receipts 
        $receipts = $vars[0];

        // get quittances 
        $quitances = $vars[1];

        // get subs princip 
        $subscriber_principale = $vars[2];

        // get subs name from subscriber_principale 
        // $subscriber_name = $subscriber_principale[0]['raisonsociale'];
        $subscriber_name = implode(" ", array_unique($vars[3]));

        // create the generated file name 
        $file_name = 'Q_' . implode('_', array_unique($this->strucuteredSubs($request)[3])) . '_' . time();

        // generate file 
        $this->generatePdf($request, $receipts, $file_name);
        // check if method of send == whatsapp 
        if ($request->sendType == 'Whatsaap') {
            $number = "212" . ltrim($request->number, '0');
            // return $number;

            $whatsapp_cloud_api = new WhatsAppCloudApi([
                'from_phone_number_id' => '105778422295179',
                'access_token' => 'EAAJBnYptMZCcBAHizmK60y6Dlc8NZCo8d7DvI63y9DuFiGc8WZAHvyk5Y3JQauvhdl6kZCezVXEndMDjrxrUmZCt3jKRvEo5lGnSDjZCpeHWZAsEYKXDWQoEyRvbTarUyaUzQCUy36EepHAm7k0DyuHrWVtd0VNdvZC76k3ODLr4l7Gl1chBRRmZC',
            ]);
            $this->sendToWhatsapp($number);
            // $whatsapp_cloud_api->sendTextMessage("212634328147", 'hellozzz');
            return 'whatsaap';
        }
        // else if the method are email 
        else {
            // get the message 
            $message = $request->message;
            // get the date to send 
            $dateToSend = $request->dateToSend;
            // get cc emails 
            if ($request->cc_emails) {
                $cc_emails =  implode(',', $request->cc_emails);
            } else {
                $cc_emails = "";
            }
            $default_object =  $request->default_object;
            // get email object 
            $object = $request->object;
            // get send to email 
            $to = $request->to;
            // check if the send mathod are different 
            if ($request->sendEmailType == 'Different') {
                $now = date('Y-m-d');
                if ($dateToSend > $now) {


                    $this->sendInDifferenetdate($subscriber_name, $dateToSend, $file_name, $message, $request->files_to_send, $to, $cc_emails, $object, $default_object);
                    return redirect()->route('scheduleEmail')->with([
                        'success' => 'l\'email a été planifier avec succès',
                    ]);
                } else {
                    return redirect()->back()->withErrors(['error' => 'Date Invalide']);
                }
            } else {
                $cc_emails =  array_unique(explode(',', $cc_emails));
                $this->sendEmail($to, $file_name, $files_to_send, $request->message, $cc_emails, $object, $default_object);
                Reminder::create([
                    'send_to' => $subscriber_name,
                    'isSendToMail' => 1,
                    'dateSend' => Carbon::now(),
                    'dateOfLivred' => Carbon::now(),
                    'fileName' => $file_name,
                    'email_to' => $to,
                    'user' => auth()->user()->name,
                ]);
                return redirect()->route('reminder.index')->with([
                    'success' => 'l\'email a été envoyer avec succès',
                ]);
            }
        }
        // } 
        // catch (\Exception $e) {
        //     return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        // }
    }
    // send email in different date 
    public function sendInDifferenetdate($subscriber_name, $dateToSend, $file_name, $message, $files_to_send, $to, $cc_emails, $object, $default_message)
    {
        return Reminder::create([
            'send_to' => $subscriber_name,
            'dateOfLivred' => $dateToSend,
            'fileName' => $file_name,
            'message' => $message,
            'file_to_send' => $files_to_send,
            'email_to' => $to,
            'cc' => $cc_emails,
            'object' => $object,
            'default_message' => $default_message,
            'user' => auth()->user()->name,
        ]);
    }
    // save releve to pdf file 
    public function generatePdf($request, $receipts, $file_name)
    {

        try {
            //code...
            Artisan::call('emails:send');
            view()->share('receipts', $receipts);
            $file = $file_name . '.pdf';
            $pdf = PDF::loadView('pages.data_generated_form')->setPaper('a4', 'landscape')->set_option('isRemoteEnabled', true)->save(public_path('storage\releve\\' . $file));
            // return PDF::loadView('pages.data_generated_form')->setPaper('a4', 'landscape')->set_option('isRemoteEnabled', true)->stream();
            file_put_contents('D:\test\\' . $file, $pdf->output());
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    // send to email 
    public function sendEmail($subscriber_email, $file, $files_to_send = '', $subject, $cc, $object, $default_object)
    {
        if (strlen($cc[0]) > 0) {
            Mail::to($subscriber_email)->cc(array_unique($cc))->send(new MailReceipt($file, $files_to_send, $subject, $object, $default_object));
        } else {
            // send email 
            Mail::to($subscriber_email)->send(new MailReceipt($file, $files_to_send, $subject, $object, $default_object));
        }
    }

    // send to whatsaap api 
    public function sendToWhatsapp($number)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://graph.facebook.com/v14.0/105778422295179/messages',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                "messaging_product": "whatsapp",
                "to": ' . "\"" . $number . "\"" . ',
                "type": "template",
                "template": {
                    "name": "hello_world",
                    "language": {
                        "code": "en_US"
                    }
                }
            }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer EAAJBnYptMZCcBAHizmK60y6Dlc8NZCo8d7DvI63y9DuFiGc8WZAHvyk5Y3JQauvhdl6kZCezVXEndMDjrxrUmZCt3jKRvEo5lGnSDjZCpeHWZAsEYKXDWQoEyRvbTarUyaUzQCUy36EepHAm7k0DyuHrWVtd0VNdvZC76k3ODLr4l7Gl1chBRRmZC'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }
    // get son from contactgroup table 
    public function getSubscribers($name)
    {
        // call the command emails send 
        Artisan::call('emails:send');
        return $this->Impayes->getSubscribersByParent($name);
    }

    // db view 
    public function addBaseImpayes()
    {
        return view('pages.add_base_impayes');
    }
    // db view 
    public function addBaseContact()
    {
        return view('pages.add_base_contact');
    }

    // db stored 
    public function storeBaseImpayes(Request $request)
    {
        // call the command emails send 
        Artisan::call('emails:send');
        try {
            //code...
            $request->validate([
                'excelFile' => 'required|mimes:xlsx,xls',
            ]);
            // call the function transformExcelFileToMysqlData  that stored excel file data in mysql 
            Impayes::truncate();
            $path = $request->file('excelFile');
            // Excel::import(new ImpayesImport, $path);
            Excel::import(new ImpayesSubsImport, $path);
            return redirect()->route('impayes.index')->with([
                'success' => 'la base a été insérer avec succes',
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    // db stored 
    public function storeBaseContact(Request $request)
    {
        // call the command emails send 
        Artisan::call('emails:send');
        try {
            //code...
            $request->validate([
                'excelFile' => 'required|mimes:xlsx,xls',
            ]);
            // call the function transformExcelFileToMysqlData  that stored excel file data in mysql 
            Subscriber::truncate();
            $path = $request->file('excelFile');
            Excel::import(new ContactImport, $path);
            return redirect()->route('impayes.index')->with([
                'success' => 'la base a été insérer avec succes',
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    // get all impayes unique name
    public function getAllUniqueNames($name)
    {
        $field = '%' . implode('%', explode(' ', $name)) . '%';
        $subscribers = Impayes::where('souscripteur', 'like', $field)->pluck('souscripteur');
        return array_unique(json_decode(json_encode($subscribers), true));
    }
}
