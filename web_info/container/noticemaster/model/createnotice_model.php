<?php
class Createnotice_Model extends Model{
	
	function __construct(){
		parent::__construct();
	}
	function save($data, $onduplicate){
        //$this->log->modellog( serialize($data));
        return $this->db->insert('notice',$data, $onduplicate);
    }
    public function getnotice($conditions){
        return $this->db->select("notice", array("*","SUBSTRING(xdescription,1,100) as xdescription", "(select xdesc from seitem where bizid=notice.bizid and xitemcode=notice.xitemcode) as xitemdesc", "(select xbatchname from batch where bizid=notice.bizid and xbatch=notice.xbatch) as xbatchname"),$conditions);
    }
	public function getsinglenotice($notice){
        $noticedt = $this->db->select("notice", array('*',"(select xbatchname from batch where bizid=notice.bizid and xbatch=notice.xbatch) as xbatchname", "(select xdesc from seitem where bizid=notice.bizid and xitemcode=notice.xitemcode) as xitemdesc"), " bizid = ".Session::get('sbizid')." and xsl='$notice'");
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
	
}
