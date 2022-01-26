<?php
class Homeworkquestion_Model extends Model{
	
	function __construct(){
		parent::__construct();
	}
	function save($data, $onduplicate){
        //$this->log->modellog( serialize($data));
        return $this->db->insert('homework_questions',$data, $onduplicate);
    }
    public function getnotice($conditions){
        return $this->db->select("homework_questions",array("*", "DATE_FORMAT(xdate, '%d/%m/%Y') as xdate", "DATE_FORMAT(xduedate, '%d/%m/%Y') as xduedate", "SUBSTRING(xdescription,1,100) as xdescription", "(select xdesc from seitem where bizid=homework_questions.bizid and xitemcode=homework_questions.xitemcode) as xitemdesc", "(select xbatchname from batch where bizid=homework_questions.bizid and xbatch=homework_questions.xbatch) as xbatchname"),$conditions);
    }
	public function getsinglenotice($notice){
        $noticedt = $this->db->select("homework_questions", array('*',"DATE_FORMAT(xdate, '%m/%d/%Y') as xdate" ,"DATE_FORMAT(xduedate, '%m/%d/%Y') as xduedate","(select xbatchname from batch where bizid=homework_questions.bizid and xbatch=homework_questions.xbatch) as xbatchname", "(select xdesc from seitem where bizid=homework_questions.bizid and xitemcode=homework_questions.xitemcode) as xitemdesc"), " bizid = ".Session::get('sbizid')." and xquesid='$notice'");
        return $noticedt;
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
    
     public function getSmsDetails($item, $batch){
        $fields = array("*", "(select xmobile from edustudent where bizid=ecomsalesdet.bizid and xstudent=ecomsalesdet.xcus) as xstudentmobile", "(select xstuname from edustudent where bizid=ecomsalesdet.bizid and xstudent=ecomsalesdet.xcus) as xstuname");
		$where = "bizid = ".Session::get('sbizid')." and xitemcode = '".$item."' and xbatch = '".$batch."'";	
		return $this->db->select("ecomsalesdet", $fields, $where);
    }
	
}
