<?php
final class CPaging{
    public $oProduct;
    public $oResult;
	public $actualpage;
	public $totalpages;
	public $nextpage;  //next page link
	public $prevpage;  //preg page link
	public $firstpage; //first page
	public $finalpage; //last page
	public function __construct()
    {
        $this->oProduct=new CProduct();
		$this->oResult=new CResult();
    }
	public function PageCreate($page,$limit,$sql,$url)
	{
		/************ Pagination ******************/		
		$start = ($page-1)*$limit; //set the start page
		$start = round($start,0);  //rounds it  
		//---------------------------------------------
		$this->oResult=$this->oProduct->SqlQuery($sql);
		$totalrows = $this->oResult->num_rows;//Get the total rows of the table 					
		$sql.=" LIMIT $start, $limit";
		$this->oResult=$this->oProduct->SqlQuery($sql);
		$nv;        //next page
		$pv;        //prev page
		//------- Creating Pages --------------------
		$this->totalpages = $totalrows / $limit; //Gets the totalpages
		$this->totalpages = ceil($this->totalpages); //rounds them to the bigger number, so if the limit is 10 and there areresults it will show 2 paegs instead 
		$this->actualpage = "[$page]";//else actualpage is the one we get using the $_GET

		if($page < $this->totalpages)//if the page is smaller than totalpages
		{
			$nv = $page+1;//next page
			$pv = $page-1;//prev page
			$this->nextpage = "<a href=$url&page=$nv> > </a> ";//next page link
			$this->prevpage = "<a href=$url&page=$pv> < </a> ";//preg page link
			$this->firstpage = "<a href=$url&page=1>&laquo</a> ";//first page
			$this->finalpage = "<a href=$url&page=$this->totalpages>&raquo</a> ";//last page
		}
		if($page == 1)//if the page is 1
		{
			$nv = $page+1;
			$this->nextpage = "<a href=$url&page=$nv> > </a> ";
			$this->prevpage = " < ";
			$this->firstpage = "&laquo; ";
			$this->finalpage = "<a href=$url&page=$this->totalpages>&raquo</a>";
		}
		elseif($page == $this->totalpages)//is the page is equal than the totalpages
		{
			$pv = $page-1;
			$this->nextpage = " > ";
			$this->prevpage = "<a href=$url&page=$pv> < </a> ";
			$this->firstpage = "<a href=$url&page=1>&laquo</a> ";
			$this->finalpage = "&raquo;";
		}
		if($this->totalpages == 1 || $this->totalpages == 0)//if totalpages is 1 or 0
		{
			$this->nextpage = " > ";
			$this->prevpage = " < ";
			$this->firstpage = "&laquo";
			$this->finalpage = "&raquo";
		}
		return $this->oResult;
	}
}
?>