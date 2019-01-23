<?php

class goodsFilter extends goods{

    protected $obj;
    protected $filtredData;
    protected $tableName;
    private $queryStr;
    private $filters;

    public function __construct($obj)
    {
        $this->obj = $obj;
        $this->tableName = $obj->tableName;
        $this->queryStr = "SELECT * FROM $this->tableName Where ";     
    }
    public function filter($data)
    {
        $this->filters = self::checkFilters($data);
        $this->amountFilter();
        $this->nameFilter();
        $this->bookingFilter();
        $this->activityFilter();
        $pdo = $this->obj->PDO;
        $query = $pdo->prepare($this->queryStr);
        $quer = $query->execute($this->filtredData);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    private static function checkFilters($data)
    {
        $filters = array();
        if (!isset($data['amountStart']) || ($data['amountStart']==="")){
            $filters['amountStart'] = 0;
        }else{
            $filters['amountStart'] = $data['amountStart'];
        }
        if (!isset($data['amountEnd'])){
            $filters['amountEnd'] = false;
        }else{
            $filters['amountEnd'] = $data['amountEnd'];
        }
        if (!isset($data['name'])){
            $filters['name']=false;
        }else{
            $filters['name'] = $data['name'];
        }
        if (!isset($data['booking'])){
            $filters['booking']=false;
        }elseif($data['booking']==="on"){
            $filters['booking'] = 1;
        }else{
            $filters['booking'] = false; 
        }

        if (!isset($data['activity'])){
            $filters['activity']=false;
        }elseif($data['activity'] === "on"){
            $filters['activity'] = 1;
        }else{
            $filters['activity']=false;
        }
        return $filters;
    }
    private function amountFilter()
    {
        $amountStart = $this->filters['amountStart'];
        $amountEnd = $this->filters['amountEnd'];
        $this->queryStr .= "amount >= :amountStart";
        $this->filtredData['amountStart']=$amountStart;
        if ($amountEnd){
            $this->queryStr .= " and amount <= :amountEnd";
            $this->filtredData['amountEnd']=$amountEnd;
        } 
    }
    private function nameFilter()
    {
        $name = $this->filters['name'];
        if ($name){
            $this->queryStr .= " and name Like :name";
            $this->filtredData['name']="%".$name."%";
        } 
    }
    private function bookingFilter()
    {
        $booking = $this->filters['booking'];
        if ($booking){
            $this->queryStr .= " and booking >= :booking";
            $this->filtredData['booking']=$booking;
        }
    }
    private function activityFilter()
    {
        $activity = $this->filters['activity'];
        if ($activity){
            $this->queryStr .= " and activity >= :activity";
            $this->filtredData['activity']=$activity;
        } 
    }
    public function getFilters(){
        $array = $this->filtredData;
        if (isset($array['name'])){
            $count = mb_strlen($array['name']);
            $array['name']=mb_substr($array['name'],1,$count-2);
        }else{
            $array['name'] = "";
        }

        if (isset($array['activity']) && $array['activity']===1){
            $array['activity']='on';
        }else{
            $array['activity']='';
        }
        if (isset($array['booking']) && $array['booking']===1){
            $array['booking']='on';
        }else{
            $array['booking']='on';
        }
        if (!isset($array['amountStart'])){
            $array['amountStart']='';
        }
        if (!isset($array['amountEnd'])){
            $array['amountEnd']='';
        }
        return $array;
    }
}
