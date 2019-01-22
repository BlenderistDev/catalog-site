<?php
class Paginator
{
    private $data;
    private $pageCount;
    private $pageSize;
    private $pagedData;

    public function __construct($data,$pageSize)
    {
        $this->data = $data;
        $this->pageSize = $pageSize;
        $this->pageCount = ceil(count($data)/$this->pageSize);
        for($i=1;$i<$this->pageCount+1;$i++){
            $this->pagedData[] = array_slice($this->data, $i*($this->pageSize)-($this->pageSize), ($this->pageSize) );
        }
    }
    public function getPageCount(){
        return $this->pageCount;
    }
    public function getPage($number){
        if (isset($this->pagedData[$number-1])){
            return $this->pagedData[$number-1];
        }
        return false;
    }
}
?>