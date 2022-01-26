<?php
class Smssend_Model extends Model{
	
	function __construct(){
		parent::__construct();
	}
	function save($data){
        //$this->log->modellog( serialize($data));
        return $this->db->insert('stusms',$data);
    }
    
    public function getSmsDetails($item, $batch){
        
        $fields = array("(select xmobile from edustudent where bizid=ecomsalesdet.bizid and xstudent=ecomsalesdet.xcus) as xstudentmobile");
		//print_r($this->db->select("pabuziness", $fields));die;
		return $this->db->select("ecomsalesdet", $fields, " bizid = ".Session::get('sbizid')." and xitemcode = '".$item."' and xbatch = '".$batch."'");
    }
    
    public function getnotice($conditions){
        return $this->db->select("stusms", array("*", "DATE_FORMAT(ztime, '%d/%m/%Y %h:%m:%s %p') as ztime", "(select xdesc from seitem where bizid=stusms.bizid and xitemcode=stusms.xitemcode) as xitemdesc", "(select xbatchname from batch where bizid=stusms.bizid and xbatch=stusms.xbatch) as xbatchname"),$conditions." order by xsl desc");
    }
	public function getsinglenotice($notice){
        $noticedt = $this->db->select("stusms", array('*',"(select xbatchname from batch where bizid=stusms.bizid and xbatch=stusms.xbatch) as xbatchname", "(select xdesc from seitem where bizid=stusms.bizid and xitemcode=stusms.xitemcode) as xitemdesc"), " bizid = ".Session::get('sbizid')." and xsl='$notice'");
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
    public function getstudentmobile($data){
        $studentsmobile = $this->db->select("edustudent", array('xmobile'), "bizid = ".Session::get('sbizid')." and xstudent='".$data['xcus']."'");
        return $studentsmobile;
    }
	
}
