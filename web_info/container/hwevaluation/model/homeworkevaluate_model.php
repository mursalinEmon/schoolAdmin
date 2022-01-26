<?php
class Homeworkevaluate_Model extends Model{
	
	function __construct(){
		parent::__construct();
	}
    public function getnotice($conditions){
        return $this->db->select("homework_submit",array("*", "(select xassocimage from pabuziness where bizid = ".Session::get('sbizid').") as hwanslocation", "DATE_FORMAT(xdate, '%d/%m/%Y') as xdate", "SUBSTRING(xdescription,1,100) as xdescription", "(select xstuname from edustudent where bizid=homework_submit.bizid and xstudent=homework_submit.xstudent) as xstuname"),$conditions);
    }

    public function getCourse(){
		$fields = array("xitemcode", "(select xdesc from seitem where bizid=batch.bizid and xitemcode=batch.xitemcode) as xdesc");
		$where = " bizid = ".Session::get('sbizid')." and xteacher = '".Session::get('suser')."' and zactive = '1' group by xitemcode";
		return $this->db->select("batch", $fields, $where);
	}

    public function getSelectBatch($course){
        $fields = array("xbatch", "xbatchname");
		$where = "bizid = ".Session::get('sbizid')." and xteacher = '".Session::get('suser')."' and zactive = '1' and xitemcode='".$course."'";	
		return $this->db->select("batch", $fields, $where);
    }

    public function updateTemp($fields, $where){
			
		return $this->db->dbupdate("homework_submit", $fields, $where);
	}
	
}
