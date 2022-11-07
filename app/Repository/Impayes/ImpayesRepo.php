<?php


namespace App\Repository\Impayes;

use App\Imports\ImpayesSubsImport;
use App\Models\Impayes\Impayes;
use App\Models\Subscriber\Subscriber;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ImpayesRepo implements ImpayesRepoInterface
{
    // get all impayes 
    public function getAllImpayes()
    {
        return DB::table('impayes')->select('exercice', 'quitance', 'cie', 'souscripteur', 'branche', 'categorie', 'risque', 'police', 'du', 'au', 'prime_total', 'mtt_ancaiss', 'ref_encaiss', 'aperiteur')->get();
    }

    //structered subscribers with there impayes
    public function strucuteredSubs($request)
    {
        $grp_id = Subscriber::where("raisonsociale", explode("/", $request->subs_id[0])[1])->pluck('groupement');
        $subscriber_principale = Subscriber::select('email', 'telephone', 'raisonsociale')->where('compte', $grp_id)->get();
        $quitances = [];
        $subs_name = [];

        foreach ($request->subs_id as $sub) {
            $sun_name = explode('/', $sub)[1];
            $subs_name[] = $sun_name;
            $sub = substr($sub, 0, strpos($sub, '/'));
            $quitances[] = $sub;
        }
        $receipts = Impayes::whereIn("quitance", $quitances)->get()->reverse();

        $rec_arr = [];
        foreach ($receipts as $rec) {
            foreach (array_unique($subs_name) as $sub) {
                if ($rec->souscripteur === $sub) {
                    $rec_arr[$rec->souscripteur][] = $rec;
                }
            }
        }
        $receipts = $rec_arr;
        $quitances = $request->subs_id;
        return [$receipts, $quitances, $subscriber_principale, $subs_name];
    }

    // get son from subcribers table 
    public function getSubscribersByParent($name)
    {
        $impaye = Subscriber::where('raisonsociale', 'like', "%$name%")->first();
        $subscribers = DB::table("subscribers")->where("groupement", $impaye->groupement)->where('compte', '!=', $impaye->compte)->pluck('raisonsociale', 'id');
        return json_encode($subscribers);
    }
    // db view 
    public function transformExcelFileToMysqlData($request)
    {
        Impayes::truncate();
        Subscriber::truncate();
        $path = $request->file('excelFile');
        Excel::import(new ImpayesSubsImport, $path);
    }
}
