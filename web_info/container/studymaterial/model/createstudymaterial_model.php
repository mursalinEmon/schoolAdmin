<?php
class Createstudymaterial_Model extends Model{
	
	function __construct(){
		parent::__construct();
	}
	function save($data, $onduplicate){
        //$this->log->modellog( serialize($data));
        return $this->db->insert('studymaterial',$data, $onduplicate);
    }
    public function getnotice($conditions){
        return $this->db->select("studymaterial", array("*", "(select xdesc from seitem where bizid=studymaterial.bizid and xitemcode=studymaterial.xitemcode) as xitemdesc", "(select xbatchname from batch where bizid=studymaterial.bizid and xbatch=studymaterial.xbatch) as xbatchname", "(select xdesc from lesson where bizid=studymaterial.bizid and xlesson=studymaterial.xlessonno) as xlessonname"),$conditions);
    }
	public function getsinglenotice($notice){
        $noticedt = $this->db->select("studymaterial", array('*',"(select xbatchname from batch where bizid=studymaterial.bizid and xbatch=studymaterial.xbatch) as xbatchname", "(select xdesc from seitem where bizid=studymaterial.bizid and xitemcode=studymaterial.xitemcode) as xitemdesc", "(select xdesc from lesson where bizid=studymaterial.bizid and xlesson=studymaterial.xlessonno) as xlessonname"), " bizid = ".Session::get('sbizid')." and xsl='$notice'");
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

    public function getSelectLesson($course){
        $trainerdt = $this->db->select("lesson", array('*'), "bizid = ".Session::get('sbizid')." and xitemcode='".$course."'");
        return $trainerdt;
    }

    public function getLessonName($course, $lesson){
        $trainerdt = $this->db->select("lesson", array('*'), "bizid = ".Session::get('sbizid')." and xitemcode='".$course."' and xlesson = '".$lesson."'");
        return $trainerdt;
    }
	
}
