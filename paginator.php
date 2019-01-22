<?php
class Paginator
{
    private $data;//данные
    private $pageCount;//количество страниц
    private $pageSize;//размер страницы
    private $pagedData;//данные, разбитые по страницам

    public function __construct($data,$pageSize)
    {
        $this->data = $data;
        $this->pageSize = $pageSize;
        $this->pageCount = ceil(count($data)/$this->pageSize);
        for($i=1;$i<$this->pageCount+1;$i++){
            $this->pagedData[] = array_slice($this->data, $i*($this->pageSize)-($this->pageSize), ($this->pageSize) );
        }
    }
    public function getPageCount()//геттер количества страниц
    {
        return $this->pageCount;
    }
    public function getPage($number)//геттер страницы по номеру
    {
        if (isset($this->pagedData[$number-1])){
            return $this->pagedData[$number-1];
        }
        return false;
    }
}
?>