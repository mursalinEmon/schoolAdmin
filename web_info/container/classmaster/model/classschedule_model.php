<?php
class Classschedule_Model extends Model{
	
	function __construct(){
		parent::__construct();
	}
	function save($data, $onduplicate){
        //$this->log->modellog( serialize($data));
        return $this->db->insert('classdet',$data, $onduplicate);
    }

	public function getbatch($conditions){
        return $this->db->select("classdet",array("*", "DATE_FORMAT(ztime, '%d-%m-%Y %h:%i %p') as ztime", "TIME_FORMAT(xstarttime, '%h:%i %p') as xstarttime", "DATE_FORMAT(xstartdate, '%d-%m-%Y') as xstartdate", "(select xdesc from seitem where bizid=classdet.bizid and xitemcode=classdet.xitemcode) as xitemdesc", "(select xbatchname from batch where bizid=classdet.bizid and xbatch=classdet.xbatch) as xbatchname", "(select xdesc from lesson where bizid=classdet.bizid and xlesson=classdet.xlesson) as xlessonname"),$conditions);
    }
	public function getsingleclass($class){
        $classdt = $this->db->select("classdet", array('*',"(select xbatchname from batch where bizid=classdet.bizid and xbatch=classdet.xbatch) as xbatchname", "(select xdesc from seitem where bizid=classdet.bizid and xitemcode=classdet.xitemcode) as xitemdesc", "(select xdesc from lesson where bizid=classdet.bizid and xlesson=classdet.xlesson) as xlessonname"), "bizid = ".Session::get('sbizid')." and xclass='$class'");
        return $classdt;
    }

	public function getSelectLesson($course){
        $trainerdt = $this->db->select("lesson", array('*'), "bizid = ".Session::get('sbizid')." and xitemcode='".$course."'");
        return $trainerdt;
    }

    public function deleteBatch($data){
		$fields = array(
            "xemail"=>$data['xemail'], 
            "zutime"=>$data['zutime'],
            "zactive"=>'0'
        );
		$where = "bizid = ".Session::get('sbizid')." and xbatch = '".$data['batchsl']."'";	
		return $this->db->dbupdate("batch", $fields, $where);
	}

    public function getTeacher(){
		$fields = array("xteacher", "xteachername");
		$where = "bizid = ".Session::get('sbizid')." and zactive = '1'";	
		return $this->db->select("eduteacher", $fields, $where);
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
        
        $fields = array("(select xstuname from edustudent where bizid=ecomsalesdet.bizid and xstudent=ecomsalesdet.xcus) as xstuname", "(select xmobile from edustudent where bizid=ecomsalesdet.bizid and xstudent=ecomsalesdet.xcus) as xstudentmobile");
		//print_r($this->db->select("pabuziness", $fields));die;
		return $this->db->select("ecomsalesdet", $fields, " bizid = ".Session::get('sbizid')." and xitemcode = '".$item."' and xbatch = '".$batch."'");
    }
    
    public function getAttendance($cls, $item, $batch){
        $fields = array("*", "(select xmobile from edustudent where bizid=eduattendance.bizid and xstudent=eduattendance.xstudent) as xstudentmobile", "(select xbatchname from batch where bizid=".Session::get('sbizid')." and xbatch='".$batch."') as xbatchname", "(select xstuname from edustudent where bizid=eduattendance.bizid and xstudent=eduattendance.xstudent) as xstuname", "(select count(xstuname) from eduattendance where bizid=".Session::get('sbizid')." and xclass = '".$cls."') as xpresent", "(select count(xcus) from ecomsalesdet where bizid=".Session::get('sbizid')." and xitemcode = '".$item."' and xbatch = '".$batch."' and xcus not in (select xstudent from eduattendance where bizid=".Session::get('sbizid')." and xclass = '".$cls."')) as xabsent");
		$where = "bizid = ".Session::get('sbizid')." and xclass = '".$cls."'";	
		return $this->db->select("eduattendance", $fields, $where);
    }
    
    public function getAbsent($cls, $item, $batch){
        $fields = array("*", "(select xmobile from edustudent where bizid=ecomsalesdet.bizid and xstudent=ecomsalesdet.xcus) as xstudentmobile", "(select xgurdianmobile from edustudent where bizid=ecomsalesdet.bizid and xstudent=ecomsalesdet.xcus) as xgurdianmobile", "(select xbatchname from batch where bizid=".Session::get('sbizid')." and xbatch='".$batch."') as xbatchname", "(select xstuname from edustudent where bizid=ecomsalesdet.bizid and xstudent=ecomsalesdet.xcus) as xstuname", "(select xlessonname from eduattendance where bizid=".Session::get('sbizid')." and xclass='".$cls."' limit 1) as xlessonname");
		$where = "bizid = ".Session::get('sbizid')." and xitemcode = '".$item."' and xbatch = '".$batch."' and xcus not in (select xstudent from eduattendance where bizid=".Session::get('sbizid')." and xclass = '".$cls."')";	
		return $this->db->select("ecomsalesdet", $fields, $where);
    }
    
    public function clasUpdate($clas, $present, $absent){
		$fields = array(
            "xpresent"=>$present, 
            "xabsent"=>$absent,
            "xprocess"=>'1'
        );
		$where = "bizid = ".Session::get('sbizid')." and xclass = '".$clas."'";	
		return $this->db->dbupdate("classdet", $fields, $where);
	}
		
}
