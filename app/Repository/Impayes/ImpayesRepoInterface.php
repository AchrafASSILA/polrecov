<?php


namespace App\Repository\Impayes;




interface ImpayesRepoInterface
{
    // get all impayes 
    public function getAllImpayes();

    //structered subscribers with there impayes
    public function strucuteredSubs($request);

    // get son from subcribers table 
    public function getSubscribersByParent($name);

    // db view 
    public function transformExcelFileToMysqlData($request);
}
