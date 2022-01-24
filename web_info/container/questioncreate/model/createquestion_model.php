<?php
class Createquestion_Model extends Model{
	
	function __construct(){
		parent::__construct();
	}
	function save($data, $onduplicate){
        //$this->log->modellog( serialize($data));
        return $this->db->insert('eduexamdet',$data, $onduplicate);
    }
    public function getnotice($conditions){
        return $this->db->select("notice", array("*","SUBSTRING(xdescription,1,100) as xdescription", "(select xdesc from seitem where bizid=notice.bizid and xitemcode=notice.xitemcode) as xitemdesc", "(select xbatchname from batch where bizid=notice.bizid and xbatch=notice.xbatch) as xbatchname"),$conditions);
    }
	public function getsinglenotice($notice){
        $noticedt = $this->db->select("notice", array('*',"(select xbatchname from batch where bizid=notice.bizid and xbatch=notice.xbatch) as xbatchname", "(select xdesc from seitem where bizid=notice.bizid and xitemcode=notice.xitemcode) as xitemdesc"), " bizid = ".Session::get('sbizid')." and xsl='$notice'");
        return $noticedt;
    }

    public function getCourse(){
		$fields = array("xitemcode", "xdesc");
		$where = "bizid = ".Session::get('sbizid')." and zactive = '1' and xcat='Training Courses'";	
		return $this->db->select("seitem", $fields, $where);
	}

    public function getSelectBatch($course){
        $trainerdt = $this->db->select("batch", array('*'), "bizid = ".Session::get('sbizid')." and xitemcode='".$course."'");
        return $trainerdt;
    }

    public function getLesson($course){
        $lessons = $this->db->select("lesson", array('*'), "bizid = ".Session::get('sbizid')." and xitemcode='".$course."'");
        return $lessons;
    }
    public function getexammstsl($xclass,$xsession,$xversion,$xsection,$xshift){
        $exammstsl = $this->db->select("eduexammst", array('xexammstsl','xlessonname'), "bizid = ".Session::get('sbizid')." and xclass='".$xclass."' and xsession='".$xsession."' and xversion='".$xversion."' and xsection='".$xsection."' and xshift='".$xshift."'");
        return $exammstsl;
    }

    public function getClass($teacher){
        $classes = $this->db->select("batch", array('*'), "bizid = ".Session::get('sbizid')." and xteacher='".$teacher."'");
        return $classes;
    }
	
    public function getexam($data){
		return $this->db->select("eduexammst", array("*"), "xsession='".$data["xsession"]."' and xclass = '".$data["xclass"]."' and xset = '".$data["xset"]."' and xversion ='".$data["xversion"]."' and xsection ='".$data["xsection"]."' and xsubname ='".$data["xsubname"]."' and xshift ='".$data["xshift"]."' and bizid = ".$data["bizid"]." and zactive = '1'");
	}
}
