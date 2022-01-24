<?php

class Assignexam extends Controller{
	private $formfield=array();
	function __construct(){
		parent::__construct();
		$this->intializeform();
		$this->view->script=$this->script();
		Session::init();
        if(!Session::get('logedin')){
            header('location: '. URL .'adminlogin');
            exit;
        }
	}
	

	private function intializeform(){

        //Main user form initialize here
        $this->formfield = array(
            "section1"=>array("ctrltype"=>"section","color"=>"alert-info", "label"=>"Exam Assign","rowindex"=>"0", "ctrlvalid"=>array()),

			// "formdetail"=>array("id"=>"formsearch", "title"=>"Search Assigned Exam"),

			"exammstsl"=>array("required"=>"*","label"=>"Exam ID","ctrlfield"=>"xexammstsl", "ctrlvalue"=>"", "ctrltype"=>"text", "readonly"=>"readonly", "ctrlvalid"=>array(),"rowindex"=>"1"),

			"xsession"=>array("required"=>"*","label"=>"Session","ctrlfield"=>"xsession", "ctrlvalue"=>array(), "ctrltype"=>"select2","ctrlselected"=>"","codetype"=>"Trainer", "ctrlvalid"=>array("required"=>"true","minlength"=>"1"),"rowindex"=>"1"),

			"xclass"=>array("required"=>"*","label"=>"Class","ctrlfield"=>"xclass", "ctrlvalue"=>array(), "ctrltype"=>"select2","ctrlselected"=>"","codetype"=>"Trainer", "ctrlvalid"=>array("required"=>"true","minlength"=>"1"),"rowindex"=>"2"),

			"xsubject"=>array("required"=>"*","label"=>"Subject","ctrlfield"=>"xsubname", "ctrlvalue"=>array(), "ctrltype"=>"select2","ctrlselected"=>"","codetype"=>"Trainer", "ctrlvalid"=>array("required"=>"true","minlength"=>"1"),"rowindex"=>"2"),


			"xversion"=>array("required"=>"*","label"=>"Version","ctrlfield"=>"xversion", "ctrlvalue"=>array(), "ctrltype"=>"select2","ctrlselected"=>"","codetype"=>"Trainer", "ctrlvalid"=>array("required"=>"true","minlength"=>"1"),"rowindex"=>"3"),

			"xshift"=>array("required"=>"*","label"=>"Shift","ctrlfield"=>"xshift", "ctrlvalue"=>array(), "ctrltype"=>"select2","ctrlselected"=>"","codetype"=>"Trainer", "ctrlvalid"=>array("required"=>"true","minlength"=>"1"),"rowindex"=>"3"),

			"xsection"=>array("required"=>"*","label"=>"Section","ctrlfield"=>"xsection", "ctrlvalue"=>array(), "ctrltype"=>"select2","ctrlselected"=>"","codetype"=>"Trainer", "ctrlvalid"=>array("required"=>"true","minlength"=>"1"),"rowindex"=>"4"),

			"questionset"=>array("required"=>"*","label"=>"Question Set","ctrlfield"=>"xset", "ctrlvalue"=>array(), "ctrltype"=>"select2","ctrlselected"=>"","codetype"=>"Trainer", "ctrlvalid"=>array("required"=>"true","minlength"=>"1"),"rowindex"=>"4"),





			// "section1"=>array("ctrltype"=>"section","color"=>"alert-info", "label"=>"Question Information","rowindex"=>"0", "ctrlvalid"=>array()),

			// "exammstsl "=>array("required"=>"*","label"=>"Exam ID","ctrlfield"=>"xexammstsl ", "ctrlvalue"=>"", "ctrltype"=>"text", "readonly"=>"readonly", "ctrlvalid"=>array(),"rowindex"=>"1"),

			// "itemcode"=>array("required"=>"*","label"=>"Course","ctrlfield"=>"xitemcode", "ctrlvalue"=>array(), "ctrltype"=>"select2","ctrlselected"=>"","codetype"=>"Trainer", "ctrlvalid"=>array("required"=>"true","minlength"=>"1"),"rowindex"=>"1"),

			// "lesson"=>array("required"=>"*","label"=>"Lesson","ctrlfield"=>"xlessonno", "ctrlvalue"=>array(), "ctrltype"=>"select2","ctrlselected"=>"","codetype"=>"Trainer", "ctrlvalid"=>array("required"=>"true","minlength"=>"1"),"rowindex"=>"2"),			

            // "batch"=>array("required"=>"*","label"=>"Batch","ctrlfield"=>"xbatch", "ctrlvalue"=>array(), "ctrltype"=>"select2","ctrlselected"=>"","codetype"=>"Batch", "ctrlvalid"=>array("required"=>"true","minlength"=>"1"),"rowindex"=>"2"),
           

			// "section2"=>array("ctrltype"=>"section","color"=>"alert-info", "label"=>"Create Question","rowindex"=>"3", "ctrlvalid"=>array()),

			// "title"=>array("required"=>"*","label"=>"Question Title","ctrlfield"=>"ztime", "ctrlvalue"=>"", "ctrltype"=>"text", "ctrlvalid"=>array("required"=>"true","minlength"=>"1"),"rowindex"=>"4"),

			// "option1"=>array("required"=>"*","label"=>"Option 1","ctrlfield"=>"zutime", "ctrlvalue"=>"", "ctrltype"=>"text", "ctrlvalid"=>array("required"=>"true","minlength"=>"1"),"rowindex"=>"5"),

			// "option2"=>array("required"=>"*","label"=>"Option 2","ctrlfield"=>"option2", "ctrlvalue"=>"", "ctrltype"=>"text", "ctrlvalid"=>array("required"=>"true","minlength"=>"1"),"rowindex"=>"6"),


			// "option3"=>array("required"=>"*","label"=>"Option 3","ctrlfield"=>"option3", "ctrlvalue"=>"", "ctrltype"=>"text", "ctrlvalid"=>array("required"=>"true","minlength"=>"1"),"rowindex"=>"7"),

			// "option4"=>array("required"=>"*","label"=>"Option 4","ctrlfield"=>"option4", "ctrlvalue"=>"", 
			// "ctrltype"=>"text", "ctrlvalid"=>array("required"=>"true","minlength"=>"1"),"rowindex"=>"8"),

			// "section3"=>array("ctrltype"=>"section","color"=>"alert-info", "label"=>"Provide Answer","rowindex"=>"9", "ctrlvalid"=>array()),

			// "answer"=>array("required"=>"*","label"=>"Correct Answer","ctrlfield"=>"answer", "ctrlvalue"=>"", 
			// "ctrltype"=>"text", "ctrlvalid"=>array("required"=>"true","minlength"=>"1"),"rowindex"=>"10"),
            
        );

        $this->formset = array(
            "formdetail"=>array("id"=>"frmnotice", "title"=>"User Form"),
            "actionbtn"=>array(                
                array("btnmethod"=>"update","btntext"=>"Update","btnurl"=>URL."questioncreate/updatequestion","btnid"=>"noticeupdate"),
            ),
            "mainbtn"=>array(
                array("btnmethod"=>"save","btntext"=>"Assign Exam","btnurl"=>URL."examassign/assignexam","btnid"=>"usersave", "icon"=>"<i class=\"far fa-save mr-1\"></i>","btncolor"=>"btn-primary"),
                array("btnmethod"=>"view","btntext"=>"Find Exam","btnurl"=>URL."examassign/findExam","btnid"=>"findexam", "icon"=>"<i class=\"far fa-info mr-1\"></i>","btncolor"=>"btn-info"),
                array("btnmethod"=>"clearall","btntext"=>"Clear","btnurl"=>"","btnid"=>"clearall", "icon"=>"<i class=\"fa fa-eraser mr-1\"></i>","btncolor"=>"btn-success"),
            ),
        );

        //End of Main user form initialize here


        $this->searchfield = array(            
            "section1"=>array("ctrltype"=>"section","color"=>"alert-info", "label"=>"Search Exam","rowindex"=>"0", "ctrlvalid"=>array()),

			// "formdetail"=>array("id"=>"formsearch", "title"=>"Search Assigned Exam"),

			"xexammstsl"=>array("required"=>"*","label"=>"Exam ID","ctrlfield"=>"xexammstsl", "ctrlvalue"=>"", "ctrltype"=>"text", "readonly"=>"readonly", "ctrlvalid"=>array(),"rowindex"=>"1"),

			"session"=>array("required"=>"*","label"=>"Session","ctrlfield"=>"xsession", "ctrlvalue"=>array(), "ctrltype"=>"select2","ctrlselected"=>"","codetype"=>"Trainer", "ctrlvalid"=>array("required"=>"true","minlength"=>"1"),"rowindex"=>"1"),

			"class"=>array("required"=>"*","label"=>"Class","ctrlfield"=>"xclass", "ctrlvalue"=>array(), "ctrltype"=>"select2","ctrlselected"=>"","codetype"=>"Trainer", "ctrlvalid"=>array("required"=>"true","minlength"=>"1"),"rowindex"=>"2"),

			"subject"=>array("required"=>"*","label"=>"Subject","ctrlfield"=>"xsubname", "ctrlvalue"=>array(), "ctrltype"=>"select2","ctrlselected"=>"","codetype"=>"Trainer", "ctrlvalid"=>array("required"=>"true","minlength"=>"1"),"rowindex"=>"2"),


			"version"=>array("required"=>"*","label"=>"Version","ctrlfield"=>"xversion", "ctrlvalue"=>array(), "ctrltype"=>"select2","ctrlselected"=>"","codetype"=>"Trainer", "ctrlvalid"=>array("required"=>"true","minlength"=>"1"),"rowindex"=>"3"),

			"shift"=>array("required"=>"*","label"=>"Shift","ctrlfield"=>"xshift", "ctrlvalue"=>array(), "ctrltype"=>"select2","ctrlselected"=>"","codetype"=>"Trainer", "ctrlvalid"=>array("required"=>"true","minlength"=>"1"),"rowindex"=>"3"),

			"section"=>array("required"=>"*","label"=>"Section","ctrlfield"=>"xsection", "ctrlvalue"=>array(), "ctrltype"=>"select2","ctrlselected"=>"","codetype"=>"Trainer", "ctrlvalid"=>array("required"=>"true","minlength"=>"1"),"rowindex"=>"4"),

			"xquestionset"=>array("required"=>"*","label"=>"Question Set","ctrlfield"=>"xset", "ctrlvalue"=>array(), "ctrltype"=>"select2","ctrlselected"=>"","codetype"=>"Trainer", "ctrlvalid"=>array("required"=>"true","minlength"=>"1"),"rowindex"=>"4"),						
            
        );

        $this->searchsettings = array(
            "formdetail"=>array("id"=>"frmsearch", "title"=>"Search Assigned Exam"),
            "actionbtn"=>array(),
            "mainbtn"=>array(                
                array("btnmethod"=>"search","btntext"=>"Search","btnurl"=>URL."noticecreate/findnotice","btnid"=>"searchnotice", "icon"=>"<i class=\"fa fa-eraser mr-1\"></i>","btncolor"=>"btn-success"),
                array("btnmethod"=>"print","btntext"=>"Print","btnurl"=>"","btnid"=>"printuserlist", "icon"=>"<i class=\"fa fa-print mr-1\"></i>","btncolor"=>"btn-dark"),
            ),
        );
        
    }

	function init(){ 
 
		 $basicform = new Basicform();
 
		 $tabsettings = array(
			 0=>array("isactive"=>"active","tabdesc"=>"Assign Exam", "tabid"=>"tabcreatenotice", "tabcontent"=>$basicform->createform($this->formset,$this->formfield, false).'<div class="col-12" id="printdivuser"><table class="table table-striped table-bordered basic-datatable" cellspacing="0" width="100%" id="searchtbl"></table></table></div>', "icon"=>"far fa-user"),
			 1=>array("isactive"=>"","tabdesc"=>"Search For Exam", "tabid"=>"tabsearchnotice", "tabcontent"=>$basicform->createform($this->searchsettings,$this->searchfield, false).'<div class="col-12" id="printdivuser"><table class="table table-striped table-bordered basic-datatable" cellspacing="0" width="100%" id="searchtbl1"></table></table></div>', "icon"=>"fa fa-search"),          
			 
		 );
		 
		 $this->view->courseform = $basicform->createtab($tabsettings);
		 
		 $this->view->render("templateadmin","abr/examassign_view");
	 }


	 function findExam(){

		$xsession = $_POST['xsession'];
		$xclass = $_POST['xclass'];
		$xset = $_POST['questionset'];
		$xversion = $_POST['xversion'];
		$xsection = $_POST['xsection'];
		$xsubname = $_POST['xsubject'];
		$xshift = $_POST['xshift'];

            $data['bizid']=Session::get('sbizid');
            $data['xsession']=$xsession;
            $data['xclass']=$xclass;
            $data['xset']=$xset;
            $data['xversion']=$xversion;
            $data['xsection']=$xsection;
            $data['xsubname']=$xsubname;
            $data['xshift']=$xshift;
            // $data['questionset']=$questionset;
			
            //  //remove autoincrement id from inserting      
			// Logdebug::appendlog(print_r($data, true));
            $success = $this->model->getExam($data);
			// $exams =  $success[0];
            // Logdebug::appendlog(print_r($success, true));
            if($success > 0)
                echo json_encode(array('message'=>'Exam Available','result'=>'success','keycode'=>$success));
             else
                echo json_encode(array('message'=>'Failed to Find Exam'.$data,'result'=>'error','keycode'=>''));
    }


	function searchExam(){

		$xsession = $_POST['session'];
		$xclass = $_POST['class'];
		$xset = $_POST['xquestionset'];
		$xversion = $_POST['version'];
		$xsection = $_POST['section'];
		$xsubname = $_POST['subject'];
		$xshift = $_POST['shift'];

            $data['bizid']=Session::get('sbizid');
            $data['xsession']=$xsession;
            $data['xclass']=$xclass;
            $data['xset']=$xset;
            $data['xversion']=$xversion;
            $data['xsection']=$xsection;
            $data['xsubname']=$xsubname;
            $data['xshift']=$xshift;
            // $data['questionset']=$questionset;
			
            //  //remove autoincrement id from inserting      
			Logdebug::appendlog(print_r($data, true));
            $success = $this->model->getExam($data);
			// $exams =  $success[0];
            // Logdebug::appendlog(print_r($success, true));
            if($success > 0)
                echo json_encode(array('message'=>'Exam Available','result'=>'success','keycode'=>$success));
             else
                echo json_encode(array('message'=>'Failed to Find Exam'.$data,'result'=>'error','keycode'=>''));
    }

	function assignExam(){
		// Logdebug::appendlog('hello');
		$exammstsl = $_POST['exammstsl'];
		$exam = $this->model->getSingleExam($exammstsl);
            Logdebug::appendlog(print_r($exam, true));
		$exam =$exam[0];
		$onduplicate="";
		$data=array(
			"bizid" => Session::get('sbizid'),
			"xsession" => $exam["xsession"],
			"xexammstsl" => $exam["xexammstsl"],
			"xset" => $exam["xset"],
			"xclass" => $exam["xclass"],
			"xsection" => $exam["xsection"],
			"xshift" => $exam["xshift"],
			"xversion" => $exam["xversion"],
			"xsubname" => $exam["xsubname"],
			"xitemcode" => $exam["xitemcode"],
			"xstartdate" => $exam["xdate"],
			"xenddate" => $exam["xdate"],
			"xstarttime" => $exam["xstarttime"],
			"xendtime" => $exam["xendtime"],
			"zactive" => 1,
			
		);
        // Logdebug::appendlog(print_r($data, true));


		$success = $this->model->assign($data, $onduplicate);
        // Logdebug::appendlog(print_r($success, true));
		if($success > 0){

			echo json_encode(array('message'=>'Exam Assigned Successfully','result'=>'success','keycode'=>$success));
		}else{

			 echo json_encode(array('message'=>'Failed to Assign Exam'.$data,'result'=>'error','keycode'=>''));
		 }

	}
	
	function getClass(){
        $teacher = Session::get('suser');

        $classes = $this->model->getClass($teacher);
        // $classes = $classes[0];
        //    Logdebug::appendlog(print_r($classes, true));

           if($classes > 0)
                echo json_encode(array('message'=>'Class Found Successfully','result'=>'success','keycode'=>$classes));
             else
                echo json_encode(array('message'=>'Failed to find Class','result'=>'error','keycode'=>''));
    }

	function findnotice(){
        $res = "";
        $batchid = "";
		$conditions = "bizid = ".Session::get('sbizid')."";
        $itemcode = $_POST['itmcode'];
        if(isset($_POST['batchid']))
            $batchid = $_POST['batchid'];
            
        try{
        //Logdebug::appendlog(serialize($itemcode));
            if($batchid!=""){
                $conditions .=" and xbatch like '%".$batchid."%'";
            }
            if($itemcode!=""){
                $conditions .=" and xitemcode like '%".$itemcode."%'";
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
            $batchdt =  $this->model->getnotice($conditions); 
            echo json_encode($batchdt);
        }
        
    }
	
	function singlenotice(){
        $notice = $_POST['param']; 
        $noticedt =  $this->model->getsinglenotice($notice);
        //Logdebug::appendlog(print_r($noticedt, true));
        echo json_encode($noticedt);
        
    }

	function singlenoticemodal($notice){
        $noticedt =  $this->model->getsinglenotice($notice);
        //Logdebug::appendlog(print_r($noticedt, true));
        echo json_encode($noticedt);
        
    }

	function getCourse(){
        $courses = $this->model->getCourse();
        // Logdebug::appendlog($courses);
        echo json_encode($courses);
    }

	function getSelectBatch($course){
        //Logdebug::appendlog($batch);
        $batchdt =  $this->model->getSelectBatch($course);
        echo json_encode($batchdt);
        
    }
	function getLesson($course){
		$lessons =  $this->model->getLesson($course);
        // Logdebug::appendlog(print_r($lessons, true));
        echo json_encode($lessons);
        
    }
    

	function script(){
		$basicform = new Basicform(); 
		return "
		<script>

		
		$('#questionset').append(
			$('<option>', {value: '', text: '--Select--'}), 
			$('<option>', {value: 'Set-A', text: 'Set-A'}), 
			$('<option>', {value: 'Set-B', text: 'Set-B'}), 
			$('<option>', {value: 'Set-C', text: 'Set-C'}), 
			$('<option>', {value: 'Set-D', text: 'Set-D'})
		);
		
		$('#xquestionset').append(
			$('<option>', {value: '', text: '--Select--'}), 
			$('<option>', {value: 'Set-A', text: 'Set-A'}), 
			$('<option>', {value: 'Set-B', text: 'Set-B'}), 
			$('<option>', {value: 'Set-C', text: 'Set-C'}), 
			$('<option>', {value: 'Set-D', text: 'Set-D'})
		);
		

		//-----------------------
		// save update delete ajax
		//-----------------------
		".$basicform->returnajax($this->formset, "noticesl")."
		//-----------------------
		//user form validation
		//-----------------------
		".$basicform->validateform($this->formfield, 'frmnotice')."            
		 

	   $('#clearall').on('click', function(){
			$('#frmnotice').trigger('reset');
			$('#imglist').html('No image found!');
		})

		var classes = '".URL."studymaterial/getClass';

		$.get(classes, function(o){
            var cls = o.keycode;
            console.log(o.keycode);

            for(var i = 0; i < cls.length; i++){ 					
                $('#xsession').append($('<option>', {value: cls[i].xsession, text: cls[i].xsession}));
                $('#xclass').append($('<option>', {value: cls[i].xclass, text: cls[i].xclass}));
                $('#xversion').append($('<option>', {value: cls[i].xversion, text: cls[i].xversion}));
                $('#xshift').append($('<option>', {value: cls[i].xshift, text: cls[i].xshift}));
                $('#xsection').append($('<option>', {value: cls[i].xsection, text: cls[i].xsection}));
                $('#xsubject').append($('<option>', {value: cls[i].xsubname, text: cls[i].xsubname}));
                $('#xitemcode').append($('<option>', {value: cls[i].xsubcode, text: cls[i].xsubcode}));


				$('#session').append($('<option>', {value: cls[i].xsession, text: cls[i].xsession}));
                $('#class').append($('<option>', {value: cls[i].xclass, text: cls[i].xclass}));
                $('#version').append($('<option>', {value: cls[i].xversion, text: cls[i].xversion}));
                $('#shift').append($('<option>', {value: cls[i].xshift, text: cls[i].xshift}));
                $('#section').append($('<option>', {value: cls[i].xsection, text: cls[i].xsection}));
                $('#subject').append($('<option>', {value: cls[i].xsubname, text: cls[i].xsubname}));
                $('#itemcode').append($('<option>', {value: cls[i].xsubcode, text: cls[i].xsubcode}));
            }
            
        }, 'json');

		$('#findexam').on('click',function(){
			var url = $(this).val();
			var formid = 'frmnotice';
			console.log(url);

			$.ajax({
				url:url, 
				type : 'POST',
				dataType : 'json', 						
				data : $('#'+formid).serialize(), 
				beforeSend:function(){
					$(this).addClass('disabled');
					// loaderon(); 
				},
				success : function(result) {

					console.log(result);
					var exams = result.keycode;
					console.log(typeof(exam));

					
					loaderoff();
							var tblhtml ='';
						   $(this).removeClass('disabled');

						   if(result.result=='fielderror'){
								toastr.error(result.message);
							}
						if(result.result='success'){
						   tblhtml='<thead><th>Exam ID</th><th>Subject</th><th>Lesson</th><th>Exam Date</th><th>Exam Start Time</th><th>Exam End Time</th><th>Action</th></thead>';
						   tblhtml+='<tbody>';
						   
							$.each(exams, function(key, value){
								console.log(value);
								tblhtml+='<tr><td><a class=\"btn btn-primary tblrow\" style=\"border-radius:60px; font-size: 12px; href=\"javascript:void(0)\">'+value.xexammstsl+'</a></td><td>'+value.xsubname+'</td><td>'+value.xlessonname+'</td><td>'+value.xstarttime+'</td><td>'+value.xdate+'</td><td>'+value.xendtime+'...</td><td><a class=\"btn btn-primary\" style=\"border-radius:60px; font-size: 12px; padding: 5px 5px\" onclick=\"assignexamnow('+value.xexammstsl+')\">Assign Exam</a></td></tr>';    
								
								
									
							});
					
						   tblhtml+='</tbody>';
						   $('#searchtbl').html(tblhtml);

						   if(result.result=='error'){
								toastr.error(result.message);                               
							}

							
				}
						  
				},
				error: function(xhr, resp, text) {
					loaderoff();
					$(this).removeClass('disabled');
				   
					console.log(xhr, resp, text);
				}
			});
			return false;
		})
		
		function assignexamnow(exammstsl){
			var url = '".URL."examassign/assignExam';
			// console.log(exammstsl);
			// console.log(exam);
			var exam = exam;
			$.ajax({
				url:url, 
				type : 'POST',
				dataType : 'json', 						
				data : {exammstsl:exammstsl}, 
				success : function(result) {

					console.log(result.message);
					toastr.success(result.message);
					
						  
				},
				error: function(xhr, resp, text) {
					loaderoff();
					$(this).removeClass('disabled');
				   
					console.log(xhr, resp, text);
				}
			});
			return false;
			console.log('assignExam');
		}

		$('#searchnotice').on('click', function(){
            
			var url = '".URL."examassign/searchExam';
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
							
							loaderoff();
					var exams = result.keycode;

							var tblhtml ='';
						   $(this).removeClass('disabled');

						   if(result.result=='fielderror'){
								toastr.error(result.message);
							}
						if(result.result=='success'){
							tblhtml='<thead><th>Exam ID</th><th>Subject</th><th>Lesson</th><th>Exam Date</th><th>Exam Start Time</th><th>Exam End Time</th><th>Action</th></thead>';
							tblhtml+='<tbody>';
							
							 $.each(exams, function(key, value){
								 console.log(value);
								 tblhtml+='<tr><td><a class=\"btn btn-primary tblrow\" style=\"border-radius:60px; font-size: 12px; href=\"javascript:void(0)\">'+value.xexammstsl+'</a></td><td>'+value.xsubname+'</td><td>'+value.xlessonname+'</td><td>'+value.xstarttime+'</td><td>'+value.xdate+'</td><td>'+value.xendtime+'...</td><td><a class=\"btn btn-primary\" style=\"border-radius:60px; font-size: 12px; padding: 5px 5px\" onclick=\"deactiveexamnow('+value.xexammstsl+')\">Deactive Exam</a></td></tr>';    
								 
								 
									 
							 });
						   tblhtml+='</tbody>';
						   $('#searchtbl1').html(tblhtml);

						   if(result.result=='error'){
								toastr.error(result.message);                               
							}
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

		function deactiveexamnow(exammstsl){
			var url = '".URL."examassign/deactiveexam';
			// console.log(exammstsl);
			// console.log(exam);
			var exam = exam;
			$.ajax({
				url:url, 
				type : 'POST',
				dataType : 'json', 						
				data : {exammstsl:exammstsl}, 
				success : function(result) {

					console.log(result.message);
					toastr.success(result.message);
					
						  
				},
				error: function(xhr, resp, text) {
					loaderoff();
					$(this).removeClass('disabled');
				   
					console.log(xhr, resp, text);
				}
			});
			return false;
			console.log('assignExam');
		}

		//---------------------
        // batch show in modal
        //---------------------
        
        function open_modal(sl){
            //alert(status)
            $('#ntitle').html('');
            $('#ndescription').html('');
            var notices = '".URL."noticecreate/singlenoticemodal/'+sl;
            //console.log(notices);
            $.get(notices, function(o){
                //console.log(o);
                $('#ntitle').append(o[0].xtitle);
				$('#ndescription').append(o[0].xdescription);
            }, 'json');
        }

		//-----------------------
		// show user & uploaded image
		//-----------------------
			$('#viewnotice').on('click', function(){
				var url = $(this).val();
				var uid = $('#noticesl').val();
				$.ajax({
					url:url, 
					type : 'POST',
					dataType : 'json', 						
					data : {param:uid}, // post data || get data
					
					success : function(response) {
						
						loaderoff();
						
						$('#viewnotice').removeClass('disabled');
						
						const myObjStr = response;
						console.log(myObjStr); 
						$('#noticesl').val(myObjStr[0].xsl);
						$('#itemcode').html('<option value=\"'+myObjStr[0].xitemcode+'\">'+myObjStr[0].xitemdesc+'</option>');
						$('#batch').html('<option value=\"'+myObjStr[0].xbatch+'\">'+myObjStr[0].xbatchname+'</option>');
						$('#title').val(myObjStr[0].xtitle);
						CKEDITOR.instances['description'].setData(myObjStr[0].xdescription);
						$('#description').val(myObjStr[0].xdescription);
						//console.log(myObjStr[0].xdescription);
						//----------------------------
						// Course Select data for view //
						//----------------------------

						var courses = '".URL."examassign/getCourse';
						//console.log(courses);
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
						var batchs = '".URL."examassign/getSelectBatch/'+myObjStr[0].xitemcode;
						$.get(batchs, function(o){
							//console.log(o);
							for(var i = 0; i < o.length; i++){ 					
								$('#batch').append($('<option>', {value: o[i].xbatch, text: o[i].xbatchname}));
							}
						}, 'json');

								
					},
					error: function(xhr, resp, text) {
						loaderoff();
						$('#viewnotice').removeClass('disabled');
						
						console.log(xhr, resp, text);
					}
				});
			})

			$('#noticesl').on('keyup', function (e) {
				if (e.keyCode === 13) {
					$('#viewnotice').click();
					
				}
			});


		$('body').on('click','.tblrow', function(){
			_this = $(this).html();                    
			$('.nav-tabs a[href=\"#tabcreatenotice\"]').tab('show');
			$('#noticesl').val(_this);
			$('#viewnotice').click();
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
		// Coursr select data //
		//----------------------------

		//$('#itemcode').attr('onChange', 'getperdistrict(this.value)');

		var courses = '".URL."questioncreate/getCourse';
		console.log(courses);
		$('#itemcode').append('<option>--select--</option>')
		$.get(courses, function(o){
			// console.log(o);
			for(var i = 0; i < o.length; i++){ 					
				$('#itemcode').append($('<option>', {value: o[i].xitemcode, text: o[i].xdesc}));
			}
		}, 'json');


		//----------------------------
		// Batch Select data //
		//---------------------
		
		$('#itemcode').on('change',function(){
			
			$('#batch').find('option').remove();
			var val = $('#itemcode').val();
			var batchs = '".URL."questioncreate/getSelectBatch/'+val;
			$('#batch').append('<option>--select--</option>')
			$.get(batchs, function(o){
				//console.log(o);
				for(var i = 0; i < o.length; i++){ 					
					$('#batch').append($('<option>', {value: o[i].xbatch, text: o[i].xbatchname}));
				}
			}, 'json');

		})

		//----------------------------
		// Lesson Select data //
		//---------------------
		
		$('#itemcode').on('change',function(){
			
			$('#lesson').find('option').remove();
			var val = $('#itemcode').val();
			var lessons = '".URL."questioncreate/getLesson/'+val;
			// console.log(lessons);
			$('#lesson').append('<option>--select--</option>')
			$.get(lessons, function(o){
				// console.log(o);
				for(var i = 0; i < o.length; i++){ 					
					$('#lesson').append($('<option>', {value: o[i].xlesson, text: o[i].xdesc}));
				}
			}, 'json');
		})

		//----------------------------
		// Course Select data for search //
		//---------------------

		var courses = '".URL."questioncreate/getCourse';
		//console.log(courses);
		$('#itmcode').append('<option>--select--</option>')
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
			var batchs = '".URL."questioncreate/getSelectBatch/'+val;
			$('#batchid').append('<option>--select--</option>')
			$.get(batchs, function(o){
				//console.log(o);
				for(var i = 0; i < o.length; i++){ 					
					$('#batchid').append($('<option>', {value: o[i].xbatch, text: o[i].xbatchname}));
				}
			}, 'json');

		})

		</script>";
	}
			
} 