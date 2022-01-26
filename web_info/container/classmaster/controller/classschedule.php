<?php

class Classschedule extends Controller{
	private $formfield=array();
	function __construct(){
		parent::__construct();
		$this->intializeform();
		$this->view->script=$this->script();
		Session::init();
        if(!Session::get('logedin') || Session::get('slogintype') != "Teacher"){
            header('location: '. URL .'adminlogin');
            exit;
        }
	}
	private function intializeform(){

        //Main user form initialize here
        $this->formfield = array(
            "section1"=>array("ctrltype"=>"section","color"=>"alert-info", "label"=>"Class Schedule Information","rowindex"=>"0", "ctrlvalid"=>array()),

            "classsl"=>array("required"=>"*","label"=>"Class ID","ctrlfield"=>"xclass", "ctrlvalue"=>"", "ctrltype"=>"text", "readonly"=>"readonly", "ctrlvalid"=>array(),"rowindex"=>"1"),

            "itemcode"=>array("required"=>"*","label"=>"Course","ctrlfield"=>"xitemcode", "ctrlvalue"=>array(), "ctrltype"=>"select2","ctrlselected"=>"","codetype"=>"Trainer", "ctrlvalid"=>array("required"=>"true","minlength"=>"1"),"rowindex"=>"1"),

            "batch"=>array("required"=>"*","label"=>"Batch","ctrlfield"=>"xbatch", "ctrlvalue"=>array(), "ctrltype"=>"select2","ctrlselected"=>"","codetype"=>"Batch", "ctrlvalid"=>array("required"=>"true","minlength"=>"1"),"rowindex"=>"1"),

            "lesson"=>array("required"=>"*","label"=>"Class Lesson","ctrlfield"=>"xlesson", "ctrlvalue"=>array(), "ctrltype"=>"select2","ctrlselected"=>"","codetype"=>"Lesson", "ctrlvalid"=>array("required"=>"true","minlength"=>"1"),"rowindex"=>"2"),

            "venue"=>array("required"=>"*","label"=>"Vanue","ctrlfield"=>"xvenue", "ctrlvalue"=>array(), "ctrltype"=>"select2","ctrlselected"=>"","codetype"=>"Venue", "ctrlvalid"=>array("required"=>"true","minlength"=>"1"),"rowindex"=>"2"),

            "classlink"=>array("required"=>"*","label"=>"Class Link","ctrlfield"=>"xclasslink", "ctrlvalue"=>"", "ctrltype"=>"text", "ctrlvalid"=>array("required"=>"true","minlength"=>"1"),"rowindex"=>"3"),

            "joinlink"=>array("required"=>"*","label"=>"Join Link","ctrlfield"=>"xjoinlink", "ctrlvalue"=>"", "ctrltype"=>"text", "ctrlvalid"=>array("required"=>"true","minlength"=>"1"),"rowindex"=>"3"),

            "hostid"=>array("required"=>"*","label"=>"Host ID","ctrlfield"=>"xhostid", "ctrlvalue"=>"", "ctrltype"=>"text", "ctrlvalid"=>array("required"=>"true","minlength"=>"1"),"rowindex"=>"4"),

            "meetingid"=>array("required"=>"*","label"=>"Meeting ID","ctrlfield"=>"xmeetingid", "ctrlvalue"=>"", "ctrltype"=>"text", "ctrlvalid"=>array("required"=>"true","minlength"=>"1"),"rowindex"=>"4"),

            "meetingpass"=>array("required"=>"*","label"=>"Meeting Password","ctrlfield"=>"xmeetingpass", "ctrlvalue"=>"", "ctrltype"=>"text", "ctrlvalid"=>array("required"=>"true","minlength"=>"1"),"rowindex"=>"5"),

            "meetinguser"=>array("required"=>"*","label"=>"Meeting User","ctrlfield"=>"xmeetinguser", "ctrlvalue"=>"", "ctrltype"=>"text", "ctrlvalid"=>array("required"=>"true","minlength"=>"1"),"rowindex"=>"5"),

            "startdate"=>array("required"=>"*","label"=>"Start Date","ctrlfield"=>"xstartdate", "ctrlvalue"=>"", "ctrltype"=>"datepicker", "ctrlvalid"=>array("required"=>"true","minlength"=>"1"),"rowindex"=>"6"),

            "starttime"=>array("required"=>"*","label"=>"Start Time","ctrlfield"=>"xstarttime", "ctrlvalue"=>"", "ctrltype"=>"timepicker", "ctrlvalid"=>array("required"=>"true","minlength"=>"1"),"rowindex"=>"6"),
            
            "enddate"=>array("required"=>"*","label"=>"End Date","ctrlfield"=>"xenddate", "ctrlvalue"=>"", "ctrltype"=>"datepicker", "ctrlvalid"=>array("required"=>"true","minlength"=>"1"),"rowindex"=>"6"),

            "endtime"=>array("required"=>"*","label"=>"End Time","ctrlfield"=>"xendtime", "ctrlvalue"=>"", "ctrltype"=>"timepicker", "ctrlvalid"=>array("required"=>"true","minlength"=>"1"),"rowindex"=>"6"),
            
        );

        $this->formset = array(
            "formdetail"=>array("id"=>"frmclass", "title"=>"Class Schedule Create"),
            "actionbtn"=>array(                
                
            ),
            "mainbtn"=>array(
                array("btnmethod"=>"save","btntext"=>"Save Information","btnurl"=>URL."scheduleclass/savebatch","btnid"=>"batchsave", "icon"=>"<i class=\"far fa-save mr-1\"></i>","btncolor"=>"btn-primary"),
                array("btnmethod"=>"view","btntext"=>"View Information","btnurl"=>URL."scheduleclass/singleclass","btnid"=>"viewclass", "icon"=>"<i class=\"far fa-info mr-1\"></i>","btncolor"=>"btn-info"),
                array("btnmethod"=>"clearall","btntext"=>"New","btnurl"=>"","btnid"=>"clearall", "icon"=>"<i class=\"fa fa-eraser mr-1\"></i>","btncolor"=>"btn-success"),
            ),
        );

        //End of Main user form initialize here


        $this->searchfield = array(            
            
            "itmcode"=>array("required"=>"*","label"=>"Course","ctrlfield"=>"xitemcode", "ctrlvalue"=>array(), "ctrltype"=>"select2","ctrlselected"=>"","codetype"=>"Course", "ctrlvalid"=>array("required"=>"true","minlength"=>"1"),"rowindex"=>"1"),
            "batchid"=>array("required"=>"*","label"=>"Batch","ctrlfield"=>"xbatch", "ctrlvalue"=>array(), "ctrltype"=>"select2","ctrlselected"=>"","codetype"=>"Batch", "ctrlvalid"=>array("required"=>"true","minlength"=>"1"),"rowindex"=>"1"),
            
        );

        $this->searchsettings = array(
            "formdetail"=>array("id"=>"frmsearch", "title"=>"Search Course"),
            "actionbtn"=>array(),
            "mainbtn"=>array(                
                array("btnmethod"=>"search","btntext"=>"Search","btnurl"=>URL."scheduleclass/findclass","btnid"=>"searchclass", "icon"=>"<i class=\"fa fa-eraser mr-1\"></i>","btncolor"=>"btn-success"),
                array("btnmethod"=>"print","btntext"=>"Print","btnurl"=>"","btnid"=>"printuserlist", "icon"=>"<i class=\"fa fa-print mr-1\"></i>","btncolor"=>"btn-dark"),
            ),
        );
        
        
        $this->searchattfield = array(            
            
            "attitmcode"=>array("required"=>"*","label"=>"Course","ctrlfield"=>"xitemcode", "ctrlvalue"=>array(), "ctrltype"=>"select2","ctrlselected"=>"","codetype"=>"Course", "ctrlvalid"=>array("required"=>"true","minlength"=>"1"),"rowindex"=>"1"),
            "attbatchid"=>array("required"=>"*","label"=>"Batch","ctrlfield"=>"xbatch", "ctrlvalue"=>array(), "ctrltype"=>"select2","ctrlselected"=>"","codetype"=>"Batch", "ctrlvalid"=>array("required"=>"true","minlength"=>"1"),"rowindex"=>"1"),
            "attlesson"=>array("required"=>"*","label"=>"Lesson","ctrlfield"=>"xlesson", "ctrlvalue"=>array(), "ctrltype"=>"select2","ctrlselected"=>"","codetype"=>"Lesson", "ctrlvalid"=>array("required"=>"true","minlength"=>"1"),"rowindex"=>"1"),
            
        );

        $this->searchattsettings = array(
            "formdetail"=>array("id"=>"frmattsearch", "title"=>"Search Course"),
            "actionbtn"=>array(),
            "mainbtn"=>array(                
                array("btnmethod"=>"search","btntext"=>"Search","btnurl"=>URL."scheduleclass/findattendance","btnid"=>"searchattendance", "icon"=>"<i class=\"fa fa-eraser mr-1\"></i>","btncolor"=>"btn-success"),
                array("btnmethod"=>"print","btntext"=>"Print","btnurl"=>"","btnid"=>"printuserlist", "icon"=>"<i class=\"fa fa-print mr-1\"></i>","btncolor"=>"btn-dark"),
            ),
        );
        
        
    }

	function init(){
 
		 $basicform = new Basicform();
 
		 $tabsettings = array(
			 0=>array("isactive"=>"active","tabdesc"=>"Class Schedule Create", "tabid"=>"tabscheduleclass", "tabcontent"=>$basicform->createform($this->formset,$this->formfield, false), "icon"=>"far fa-user"),
			 1=>array("isactive"=>"","tabdesc"=>"Search For Class", "tabid"=>"tabsearchclass", "tabcontent"=>$basicform->createform($this->searchsettings,$this->searchfield, false).'<div class="col-12" id="printdivuser"><table class="table table-striped table-bordered basic-datatable table-responsive" cellspacing="0" width="100%" id="searchtbl"></table></table></div>', "icon"=>"fa fa-search"),
			 
			 2=>array("isactive"=>"","tabdesc"=>"Search For Attendance", "tabid"=>"tabsearchatt", "tabcontent"=>$basicform->createform($this->searchattsettings,$this->searchattfield, false).'<div class="col-12" id="printdivuser"><table class="table table-striped table-bordered basic-datatable table-responsive" cellspacing="0" width="100%" id="searchatttbl"></table></table></div>', "icon"=>"fa fa-search"),
			 
		 );
		 
		 $this->view->courseform = $basicform->createtab($tabsettings);
		 
		 $this->view->render("templateadmin","abr/classschedule_view");
	 }


	 function savebatch(){
		 //echo "test";die;
		// Logdebug::appendlog('test');
        $xdate = $_POST['startdate'];
        $dt = date('Y/m/d', strtotime($xdate));
        $sdate = str_replace('/', '-', $dt);
        
        $xedate = $_POST['enddate'];
        $edt = date('Y/m/d', strtotime($xedate));
        $edate = str_replace('/', '-', $edt);
        
        $stime = strtotime($sdate." ".$_POST['starttime']);
        $etime = strtotime($edate." ".$_POST['endtime']);
        
        $duration = round(abs($etime - $stime) / 60,2);
        //Logdebug::appendlog($duration);die;
        $inputs = new Form();
            try{
				$inputs ->post("classsl")
				
						->post("itemcode")
						->val('minlength', 1)

						->post("batch")
						->val('minlength', 1)

						->post("lesson")
						->val('minlength', 1)

                        ->post("venue")
						->val('minlength', 1)

                        ->post("classlink")

                        ->post("joinlink")

                        ->post("hostid")

                        ->post("meetingid")

                        ->post("meetingpass")

                        ->post("meetinguser")

                        ->post("starttime")
						->val('minlength', 1)

						->post("endtime")
						->val('minlength', 1);

				$inputs	->submit();       
            }catch(Exception $e){
                 $res = unserialize($e->getMessage());              
                
                 echo json_encode(array('message'=>$res['response'],'result'=>'fielderror','keycode'=>$res['field']));
                exit;
            }

            $onduplicate = 'on duplicate key update xclass=VALUES(xclass), xitemcode=VALUES(xitemcode), xbatch=VALUES(xbatch),xlesson=VALUES(xlesson), xvenue=VALUES(xvenue), xclasslink=VALUES(xclasslink), xjoinlink=VALUES(xjoinlink), xhostid=VALUES(xhostid), xmeetingid=VALUES(xmeetingid), xmeetingpass=VALUES(xmeetingpass), xmeetinguser=VALUES(xmeetinguser), xstartdate=VALUES(xstartdate), xstarttime=VALUES(xstarttime), xenddate=VALUES(xenddate), xendtime=VALUES(xendtime), xduration=VALUES(xduration)';
			
            // Logdebug::appendlog($onduplicate);
            $inpdata = $inputs->fetch();
			
            $data = Apptools::form_field_to_data($inpdata, $this->formfield);
            //Logdebug::appendlog(print_r($data, true));
            $data['xstartdate']=$sdate;
            $data['xenddate']=$edate;
            $data['xduration']=$duration;
            $data['bizid']=Session::get('sbizid');			
			$data['zemail']=Session::get('suser'); //add business id to array for inserting
			date_default_timezone_set("Asia/Dhaka");
			$data['ztime']=date('Y-m-d H:i:s');
			if(!is_numeric($data['xclass'])){
				unset($data['xclass']);
			}
            //  //remove autoincrement id from inserting      
			//Logdebug::appendlog(print_r($data, true));
            $success = $this->model->save($data, $onduplicate);
            //Logdebug::appendlog(print_r($data, true));
            if($success > 0){
                $gettmdt = $this->model->getSmsDetails($data['xitemcode'], $data['xbatch']);
				$sendsms = new Sendsms();
				foreach($gettmdt as $key=>$val){
				$smstxt = "Date : ".$xdate."
Dear ".$val['xstuname'].". 
Your today's class zoom link was given in your digital class apps.

Please, login your student portal and join the class.

Regards
".Session::get('sbizlong').".
Hotline: ".Session::get('sbizmobile')."";
							$sendsms->send_single_sms($smstxt, $val['xstudentmobile']);
							}
							
                echo json_encode(array('message'=>'Class Schedule Saved Successfully','result'=>'success','keycode'=>$success));
            }else{
                echo json_encode(array('message'=>'Failed to save Class Schedule','result'=>'error','keycode'=>''));
            }
    }


    function deletebatch(){
        //echo "test";die;
       // Logdebug::appendlog('test');
       $inputs = new Form();
           try{

                if($_POST['classsl'] == "")
                    throw new Exception('Batch code not found!');

               $inputs ->post("classsl");

               $inputs	->submit();

           }catch(Exception $e){
                $res = unserialize($e->getMessage());              
               
                echo json_encode(array('message'=>$res['response'],'result'=>'fielderror','keycode'=>$res['field']));
               exit;
           }
           
           $inpdata = $inputs->fetch();
           
           $data = Apptools::form_field_to_data($inpdata, $this->formfield);
           $data['bizid']=Session::get('sbizid');			
           $data['xemail']=Session::get('suser');
           $data['zutime']=date("Y-m-d H:i:s");
           
           $success = $this->model->deleteBatch($data);
           //Logdebug::appendlog(print_r($data, true));
           if($success)
               echo json_encode(array('message'=>'Batch Deleted Successfully','result'=>'success','keycode'=>$success));
            else
               echo json_encode(array('message'=>'Failed to Delete Batch','result'=>'error','keycode'=>''));
   }

	

	function findclass(){
        $res = "";
        $conditions = "bizid = ".Session::get('sbizid')."";
        $batchid = "";
        $itemcode = $_POST['itmcode'];
        if(isset($_POST['batchid']))
            $batchid = $_POST['batchid'];
            
        try{
        //Logdebug::appendlog(serialize($itemcode));
            if($itemcode != ""){
                $conditions .=" and xitemcode like '%".$itemcode."%'";
            }

            if($batchid != ""){
                $conditions .=" and xbatch like '%".$batchid."%'";
            }
            
            
            if($itemcode == "" || $batchid == ""){
                //Logdebug::appendlog('Please');
                throw new Exception('Please select Course and Batch!');
                
            }

        }catch(Exception $e){
                $res = $e->getMessage();              
                //Logdebug::appendlog($res);
                echo json_encode(array('message'=>$res,'result'=>'fielderror','keycode'=>''));
            exit;
        }

        if($res == ""){
            //Logdebug::appendlog('$res');
            $batchdt =  $this->model->getbatch($conditions); 
            echo json_encode($batchdt);
        }
        
    }
    
    function findattendance(){
        $res = "";
        $conditions = "bizid = ".Session::get('sbizid')."";
        $batchid = "";
        $itemcode = $_POST['attitmcode'];
        if(isset($_POST['attbatchid']))
            $batchid = $_POST['attbatchid'];
            
        $lesson = $_POST['attlesson'];
        
        try{
        //Logdebug::appendlog(serialize($itemcode));
            if($itemcode != ""){
                $conditions .=" and xitemcode like '%".$itemcode."%'";
            }

            if($batchid != ""){
                $conditions .=" and xbatch like '%".$batchid."%'";
            }
            
            if($lesson != ""){
                $conditions .=" and xlesson = '".$lesson."'";
            }
            
            
            if($itemcode == "" || $batchid == ""){
                //Logdebug::appendlog('Please');
                throw new Exception('Please select Course and Batch!');
                
            }

        }catch(Exception $e){
                $res = $e->getMessage();              
                //Logdebug::appendlog($res);
                echo json_encode(array('message'=>$res,'result'=>'fielderror','keycode'=>''));
            exit;
        }

        if($res == ""){
            //Logdebug::appendlog($conditions);
            $batchdt =  $this->model->getbatch($conditions); 
            echo json_encode($batchdt);
        }
        
    }
	
	function singleclass(){
        $class = $_POST['param']; 
        $classdt =  $this->model->getsingleclass($class);
        //Logdebug::appendlog(print_r($classdt, true));
        echo json_encode($classdt);
        
    }

    function getSelectBatch($course){
        //Logdebug::appendlog($batch);
        $batchdt =  $this->model->getSelectBatch($course);
        echo json_encode($batchdt);
        
    }

    function getSelectLesson($course){
        //Logdebug::appendlog($batch);
        $batchdt =  $this->model->getSelectLesson($course);
        echo json_encode($batchdt);
        
    }
    
    function getTeacher(){
        $teachers = $this->model->getTeacher();
        echo json_encode($teachers);
    }

    function getCourse(){
        $courses = $this->model->getCourse();
        echo json_encode($courses);
    }
    
    function getAttendance(){
        $cls = $_POST['xcls'];
        $item = $_POST['xitm'];
        $batch = $_POST['xbatch'];
        $attendance =  $this->model->getAttendance($cls, $item, $batch);
        $getabsent =  $this->model->getAbsent($cls, $item, $batch);
        if(count($attendance) > 0){
            $clsupdate = $this->model->clasUpdate($cls, $attendance[0]['xpresent'], $attendance[0]['xabsent']);
        }
        //Logdebug::appendlog(count($getabsent));
        if(count($attendance) > 0){
            $sendsms = new Sendsms();
			foreach($attendance as $key=>$val){
			$smstxt = "Dear ".$val['xstuname'].". 
Thank you for joining today's class (Batch : ".$val['xbatchname'].",  Class No : ".$val['xlessonname'].").

Please review the class recoding and practice properly.

Cordially requested not to miss the next class.

Regards
".Session::get('sbizlong').".
Hotline: ".Session::get('sbizmobile')."";
						$sendsms->send_single_sms($smstxt, $val['xstudentmobile']);
						}
        }
        
        if(count($getabsent) > 0){
            $sendsms = new Sendsms();
			foreach($getabsent as $key=>$val){
			$smstxt = "Dear ".$val['xstuname'].". 
Sorry to say that you missed today's class (Batch : ".$val['xbatchname'].",  Class No : ".$val['xlessonname'].").

Please review the class recoding and practice properly.

Cordially requested not to miss the next class.

Regards
".Session::get('sbizlong').".
Hotline: ".Session::get('sbizmobile')."";

$smstxtgurdian = "Dear Sir /Honourable Guardian,
We are cordially informing you that your son/daughter is the student of (Batch : ".$val['xbatchname'].",  Class No : ".$val['xlessonname'].").

Sorry to say that he/she missed today's class.

Cordially requested  to inform him/her to continue the next classes timely.

Expected Cooperation.

Regards
".Session::get('sbizlong').".
Hotline: ".Session::get('sbizmobile')."";
$sendsms->send_single_sms($smstxt, $val['xstudentmobile']);
$sendsms->send_single_sms($smstxtgurdian, $val['xgurdianmobile']);
						}
        }
        
        //Logdebug::appendlog(print_r($attendance, true));
        echo json_encode($attendance);
        
    }

	function script(){
		$basicform = new Basicform(); 
		return "
		<script>

		//-----------------------
		// save update delete ajax
		//-----------------------
		".$basicform->returnajax($this->formset, "classsl")."
		//-----------------------
		//user form validation frmclass
		//-----------------------
		".$basicform->validateform($this->formfield, 'frmclass')." 

        //-----------------------
		//user form validation frmsearch
		//-----------------------
        ".$basicform->validateform($this->searchfield, 'frmsearch')." 
        
        //-----------------------
		//user form validation frmattsearch
		//-----------------------
        ".$basicform->validateform($this->searchattfield, 'frmattsearch')." 
	   

	   $('#clearall').on('click', function(){
			$('#frmclass').trigger('reset');
            $('#frmclass').find('select').append('<option selected=\"selected\"></option>');
		})
   
		$('#searchclass').on('click', function(){
            
			var url = '".URL."scheduleclass/findclass';
			var formid = 'frmsearch';
				
					$.ajax({
						url:url, 
						type : 'POST',
						dataType : 'json', 						
						data : $('#'+formid).serialize(), 
						beforeSend:function(){
							$(this).addClass('disabled');
							loaderon(); 
						},
						success : function(result) {
							//console.log(result);
							loaderoff();
							var tblhtml ='';
						   $(this).removeClass('disabled');

                           if(result.result=='fielderror'){
                                toastr.error(result.message);
                            }
                            if(!result.result){
                                tblhtml='<thead><th>Class ID</th><th>Create Time</th><th>Lesson</th><th>Start Date</th><th>Time</th><th>Venue</th><th>Duration</th><th>Host ID</th><th>Meeting ID</th><th>Passcode</th><th>Join Link</th></thead>';
                                tblhtml+='<tbody>';
                                $.each(result, function(key, value){
                                
                                    tblhtml+='<tr><td><a class=\"btn btn-primary tblrow\" style=\"border-radius:60px; font-size: 12px; href=\"javascript:void(0)\">'+value.xclass+'</a></td><td>'+value.ztime+'</td><td>'+value.xlessonname+'</td><td>'+value.xstartdate+'</td><td>'+value.xstarttime+'</td><td>'+value.xvenue+'</td><td>'+value.xduration+'</td><td>'+value.xhostid+'</td><td>'+value.xmeetingid+'</td><td>'+value.xmeetingpass+'</td><td><a class=\"btn btn-success\" style=\"border-radius:60px; font-size: 12px; padding: 5px 5px\" href=\"'+value.xjoinlink+'\" target=\"_blank\">Join Link</a></td></tr>';
                                            
                                });
                            }
						   tblhtml+='</tbody>';
						   $('#searchtbl').html(tblhtml);

                           if(result.result=='error'){
                                toastr.error(result.message);                               
                            }
						   
								  
						},
						error: function(xhr, resp, text) {
							loaderoff();
							$(this).removeClass('disabled');
						   
							console.log(xhr, resp, text);
						}
					});
					return false;
		});
		
		
		$('#searchattendance').on('click', function(){
            
			var url = '".URL."scheduleclass/findattendance';
			var formid = 'frmattsearch';
				
					$.ajax({
						url:url, 
						type : 'POST',
						dataType : 'json', 						
						data : $('#'+formid).serialize(), 
						beforeSend:function(){
							$(this).addClass('disabled');
							loaderon(); 
						},
						success : function(result) {
							//console.log(result);
							loaderoff();
							var tblhtml ='';
						   $(this).removeClass('disabled');

                           if(result.result=='fielderror'){
                                toastr.error(result.message);
                            }
                            if(!result.result){
                                tblhtml='<thead><th>Class ID</th><th>Create Time</th><th>Lesson</th><th>Start Date</th><th>Time</th><th>Venue</th><th>Duration</th><th>Present</th><th>Absent</th><th>Action</th></thead>';
                                tblhtml+='<tbody>';
                                $.each(result, function(key, value){
                                
                                    tblhtml+='<tr><td>'+value.xclass+'</td><td>'+value.ztime+'</td><td>'+value.xlessonname+'</td><td>'+value.xstartdate+'</td><td>'+value.xstarttime+'</td><td>'+value.xvenue+'</td><td>'+value.xduration+'</td><td id=\"present'+value.xclass+'\">'+value.xpresent+'</td><td id=\"absent'+value.xclass+'\">'+value.xabsent+'</td>';
                                    if(value.xprocess == 0){
                                        tblhtml+='<td class=\"text-center\" id=\"modid'+value.xclass+'\"><a class=\"btn btn-success\" style=\"border-radius:60px; font-size: 12px; padding: 5px 5px\" data-toggle=\"modal\" data-target=\"#myModal\" onClick=\"open_modal(\''+value.xclass+'\', \''+value.xitemcode+'\', \''+value.xbatch+'\')\">Attendance Process</a></td>';
                                    }else{
                                        tblhtml+='<td class=\"text-center\" id=\"modid'+value.xclass+'\">Processed</td></tr>';
                                    }
                                            
                                });
                            }
						   tblhtml+='</tbody>';
						   $('#searchatttbl').html(tblhtml);

                           if(result.result=='error'){
                                toastr.error(result.message);                               
                            }
						   
								  
						},
						error: function(xhr, resp, text) {
							loaderoff();
							$(this).removeClass('disabled');
						   
							console.log(xhr, resp, text);
						}
					});
					return false;
		});
		
		//---------------------
        // Attendance show in modal
        //---------------------
        
        function open_modal(cls, itm, batch){
            //alert(status)
            $('#ntitle').html('');
            $('#ndescription').html('');
            var url = '".URL."scheduleclass/getAttendance';
            //console.log(url);
            var tblhtml ='';
             $.ajax({
                        url:url, 
                        type : 'POST',
                        dataType : 'json', 						
                        data : {xcls:cls, xitm:itm, xbatch:batch}, // post data || get data
                        beforeSend:function(){
                            loaderon(); 
                        },
                        success : function(response) {
                            //console.log(response[0]);
                            $('#ntitle').html(response[0].xbatchname);
                            $('#present'+cls).html(response[0].xpresent);
                            $('#absent'+cls).html(response[0].xabsent);
                            loaderoff();
                           tblhtml='<table  class=\"table table-striped table-bordered basic-datatable\" cellspacing=\"0\" width=\"100%\"><thead><th>SL</th><th>Student ID</th><th>Name</th></thead>';
                           var sl = 0;
                           $.each(response, function(key, value){
                                sl++;
                                    tblhtml+='<tr><td>'+sl+'</td><td>'+value.xstudent+'</td><td>'+value.xstuname+'</td></tr>';
                                });
                                tblhtml+='</tbody></table>';
                                $('#ndescription').append(tblhtml);
                                $('#modid'+cls).html('');
                                $('#modid'+cls).append('Processed');
                        },
                        error: function(xhr, resp, text) {
                            loaderoff();
                            console.log(xhr, resp, text);
                        }
                    });
        }
		
		
		    //-----------------------
            // show user
           //-----------------------
                $('#viewclass').on('click', function(){
                    var url = $(this).val();
                    var uid = $('#classsl').val();
                    //console.log(url)
                    $.ajax({
                        url:url, 
                        type : 'POST',
                        dataType : 'json', 						
                        data : {param:uid}, // post data || get data
                        beforeSend:function(){
                            $('#viewclass').addClass('disabled');
                            loaderon(); 
                        },
                        success : function(response) {
                            //console.log(response[0]);
                            loaderoff();
                           
                           $('#viewclass').removeClass('disabled');
                           
                           const myObjStr = response; 
						   $('#classsl').val(myObjStr[0].xclass);
						   $('#itemcode').html('<option value=\"'+myObjStr[0].xitemcode+'\">'+myObjStr[0].xitemdesc+'</option>');
                           $('#batch').html('<option value=\"'+myObjStr[0].xbatch+'\">'+myObjStr[0].xbatchname+'</option>');
						   $('#lesson').html('<option value=\"'+myObjStr[0].xlesson+'\">'+myObjStr[0].xlessonname+'</option>');
						   $('#venue').html('<option value=\"'+myObjStr[0].xvenue+'\">'+myObjStr[0].xvenue+'</option>');
						   $('#classlink').val(myObjStr[0].xclasslink);
						   $('#joinlink').val(myObjStr[0].xjoinlink);
						   $('#hostid').val(myObjStr[0].xhostid);
						   $('#meetingid').val(myObjStr[0].xmeetingid);
                           $('#meetingpass').val(myObjStr[0].xmeetingpass);
						   $('#meetinguser').val(myObjStr[0].xmeetinguser);
						   $('#startdate').val(myObjStr[0].xstartdate);
						   $('#starttime').val(myObjStr[0].xstarttime);
						   $('#enddate').val(myObjStr[0].xenddate);
						   $('#endtime').val(myObjStr[0].xendtime);


                           //----------------------------
                            // Venu Append data for view //
                            //---------------------

                            $('#venue').append(
                                            $('<option>', {value: 'Online', text: 'Online'}), 
                                            $('<option>', {value: 'Classroom-01', text: 'Classroom-01'}), 
                                            $('<option>', {value: 'Classroom-02', text: 'Classroom-02'})
                                        );

                            //----------------------------
                            // Course Select data for view //
                            //----------------------------

                            var courses = '".URL."scheduleclass/getCourse';
                            //console.log(courses);
                            $('#itemcode').append('<option></option>')
                            $.get(courses, function(o){
                                //console.log(o);
                                for(var i = 0; i < o.length; i++){ 					
                                    $('#itemcode').append($('<option>', {value: o[i].xitemcode, text: o[i].xdesc}));
                                }
                            }, 'json');

                            //----------------------------
                            // Batch Select data for view//
                            //---------------------

                            //var val = $('#itemcode').val();
                            var batchs = '".URL."scheduleclass/getSelectBatch/'+myObjStr[0].xitemcode;
                            $('#batch').append('<option></option>')
                            $.get(batchs, function(o){
                                //console.log(o);
                                for(var i = 0; i < o.length; i++){ 					
                                    $('#batch').append($('<option>', {value: o[i].xbatch, text: o[i].xbatchname}));
                                }
                            }, 'json');
            
                            //----------------------------
                            // Lesson Select data //
                            //---------------------
            
                            //$('#lesson').find('option').remove();
                            //var val = $('#itemcode').val();
                            var lessons = '".URL."scheduleclass/getSelectLesson/'+myObjStr[0].xitemcode;
                            $('#lesson').append('<option></option>')
                            $.get(lessons, function(o){
                                //console.log(o);
                                for(var i = 0; i < o.length; i++){ 					
                                    $('#lesson').append($('<option>', {value: o[i].xlesson, text: o[i].xdesc}));
                                }
                            }, 'json');
                                    
                        },
                        error: function(xhr, resp, text) {
                            loaderoff();
                            $('#viewclass').removeClass('disabled');
                           
                            console.log(xhr, resp, text);
                        }
                    });


                })

				$('#classsl').on('keyup', function (e) {
                    if (e.keyCode === 13) {
                        $('#viewclass').click();
                        
                    }
                });


		$('body').on('click','.tblrow', function(){
			_this = $(this).html();                    
			$('.nav-tabs a[href=\"#tabscheduleclass\"]').tab('show');
			$('#classsl').val(_this);
			$('#viewclass').click();
		});

		$('#printcourselist').on('click', function(){
			//$('#printdivcourse').print();
			var divToPrint=document.getElementById('printdivcourse');

			var newWin=window.open('','Print-Window');

			newWin.document.open();
			newWin.document.write('<html><head><link rel=\"stylesheet\" href=\"./asset_admin/dist/css/style.css\" /><title>Print Document</title></head>');
			newWin.document.write('<body onload=\"window.print()\">'+divToPrint.innerHTML+'</body></html>');

			newWin.document.close();

			setTimeout(function(){newWin.close();},10);
		})

            //----------------------------
            // Teacher Select data //
            //----------------------------

            var doctype = '".URL."scheduleclass/getTeacher';
            //console.log(doctype);
            $('#teacher').append('<option></option>')
            $.get(doctype, function(o){
                //console.log(o);
                for(var i = 0; i < o.length; i++){ 					
                    $('#teacher').append($('<option>', {value: o[i].xteacher, text: o[i].xteachername}));
                }
            }, 'json');


            //----------------------------
            // Coursr select data //
            //----------------------------

            //$('#itemcode').attr('onChange', 'getperdistrict(this.value)');

            var courses = '".URL."scheduleclass/getCourse';
            //console.log(courses);
            $('#itemcode').append('<option></option>')
            $.get(courses, function(o){
                //console.log(o);
                for(var i = 0; i < o.length; i++){ 					
                    $('#itemcode').append($('<option>', {value: o[i].xitemcode, text: o[i].xdesc}));
                }
            }, 'json');

            //----------------------------
            // Course Select data for search //
            //---------------------

            var courses = '".URL."scheduleclass/getCourse';
            //console.log(courses);
            $('#itmcode').append('<option></option>')
            $.get(courses, function(o){
                //console.log(o);
                for(var i = 0; i < o.length; i++){ 					
                    $('#itmcode').append($('<option>', {value: o[i].xitemcode, text: o[i].xdesc}));
                }
            }, 'json');

            //----------------------------
            // Batch Select data for search //
            //---------------------
            
            $('#itmcode').on('change',function(){
                
                $('#batchid').find('option').remove();
                var val = $('#itmcode').val();
                var batchs = '".URL."scheduleclass/getSelectBatch/'+val;
                $('#batchid').append('<option></option>')
                $.get(batchs, function(o){
                    //console.log(o);
                    for(var i = 0; i < o.length; i++){ 					
                        $('#batchid').append($('<option>', {value: o[i].xbatch, text: o[i].xbatchname}));
                    }
                }, 'json');

            })


            //----------------------------
            // Batch Select data //
            //---------------------
            
            $('#itemcode').on('change',function(){
                
                $('#batch').find('option').remove();
                var val = $('#itemcode').val();
                var batchs = '".URL."scheduleclass/getSelectBatch/'+val;
                $('#batch').append('<option></option>')
                $.get(batchs, function(o){
                    //console.log(o);
                    for(var i = 0; i < o.length; i++){ 					
                        $('#batch').append($('<option>', {value: o[i].xbatch, text: o[i].xbatchname}));
                    }
                }, 'json');

                //----------------------------
                // Lesson Select data //
                //---------------------

                $('#lesson').find('option').remove();
                var val = $('#itemcode').val();
                var lessons = '".URL."scheduleclass/getSelectLesson/'+val;
                $('#lesson').append('<option></option>')
                $.get(lessons, function(o){
                    //console.log(o);
                    for(var i = 0; i < o.length; i++){ 					
                        $('#lesson').append($('<option>', {value: o[i].xlesson, text: o[i].xdesc}));
                    }
                }, 'json');

            })
            
            //----------------------------
            // Course Select data for search //
            //---------------------

            var courses = '".URL."scheduleclass/getCourse';
            //console.log(courses);
            $('#attitmcode').append('<option></option>')
            $.get(courses, function(o){
                //console.log(o);
                for(var i = 0; i < o.length; i++){ 					
                    $('#attitmcode').append($('<option>', {value: o[i].xitemcode, text: o[i].xdesc}));
                }
            }, 'json');
            
            //----------------------------
            // Batch Select data //
            //---------------------
            
            $('#attitmcode').on('change',function(){
                
                $('#attbatchid').find('option').remove();
                var val = $('#attitmcode').val();
                var batchs = '".URL."scheduleclass/getSelectBatch/'+val;
                $('#attbatchid').append('<option></option>')
                $.get(batchs, function(o){
                    //console.log(o);
                    for(var i = 0; i < o.length; i++){ 					
                        $('#attbatchid').append($('<option>', {value: o[i].xbatch, text: o[i].xbatchname}));
                    }
                }, 'json');

                //----------------------------
                // Lesson Select data //
                //---------------------

                $('#attlesson').find('option').remove();
                var val = $('#attitmcode').val();
                var lessons = '".URL."scheduleclass/getSelectLesson/'+val;
                $('#attlesson').append('<option></option>')
                $.get(lessons, function(o){
                    //console.log(o);
                    for(var i = 0; i < o.length; i++){ 					
                        $('#attlesson').append($('<option>', {value: o[i].xlesson, text: o[i].xdesc}));
                    }
                }, 'json');

            })

            //----------------------------
            // Venu Append data //
            //---------------------

            $('#venue').append(
                            $('<option>', {value: 'Online', text: 'Online'}), 
                            $('<option>', {value: 'Classroom-01', text: 'Classroom-01'}), 
                            $('<option>', {value: 'Classroom-02', text: 'Classroom-02'})
                        );

            //----------------------------
            // Venu wise hide Show data //
            //----------------------------

            $('#row-3').css('display','block');
            $('#row-4').css('display','block');

            $('#venue').on('click',function(){
                var venu = $(this).val();
                if(venu == 'Online'){
                    $('#row-3').css('display','block');
                    $('#row-4').css('display','block');
                }else{
                    $('#row-3').css('display','none');
                    $('#row-4').css('display','none');
                }

            })
        

		</script>";
	}

} 