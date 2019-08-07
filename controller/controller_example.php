  <?php

  class Document extends MY_controller{

  	function __construct() {
  	    //call parent constructor
  	    parent::__construct();
  	    $this->load->model('document_model');
  	  }


     
        function newcategory() {
      //First check authorisation
      $sUID = $this->session->userdata('UID');
     
      $permCode = '3554';
      if ( $this->checkPerms($sUID, $permCode) ) {

            $data['categories'] = $this->document_model->viewcategories();

             //needd for new layout start//
            $data['userid'] = $this->session->userdata('UID');
            $data['userpermissions']=$this->get_user_permissions($data['userid']);
            $muserid= $this->session->userdata('UID');
            $menu = $this->document_model->get_user_menu($muserid);
            $data['pmenu']=$menu[0]['preferred_menu'];
   
            $data['pagename']='New Category';
            $data['pageid']='1';
            $data['submenu'] = 'masterdata';
            $data['currentmenu'] = 'masterdata';
            $data['currentmodule'] = 'Document';
            $data['title'] = 'New Category';
            $data['pagenamepage'] = 'New Category';
        //needd for new layout end//

            $this->mainMenuBuild();
            //$data['menu'] = $this->getMenu('Categories','livestockPerms');
            $this->load->view('main/header2017v2', $data);
            $this->load->view('document/newcategory', $data);
      }   
      else {
        redirect('/main/permError');
      } 

    }

         function newdocument() {
      //First check authorisation

      $sUID = $this->session->userdata('UID');
     if($sUID != ""){
        $cgroup = $this->document_model->getcpermissiongroup($sUID);
      }else{
        redirect('/main/permError');
      }
     //echo '<pre>'.print_r($cgroup,true).'</pre>';exit;
     if(!is_array($cgroup) || !$this->checkPerms($sUID, '3549')){
      echo "<script>alert('You do not have Permission to create documents');</script>";
      redirect('/main/permError');
     }else{
      $permCode = '3549';

      $hcperm = '';
      $hscperm = '';
      $hcoperm = '';
      if ( $this->checkPerms($sUID, '3554') ) {
        $hcperm = 1;
      }else{
        $hcperm = 0;
      }

      if ( $this->checkPerms($sUID, '3555') ) {
        $hscperm = 1;
      }else{
        $hscperm = 0;
      }

      if ( $this->checkPerms($sUID, '3556') ) {
        $hcoperm = 1;
      }else{
        $hcoperm = 0;
      }
      if ( $this->checkPerms($sUID, $permCode) ) {

            //Load Categories
        $workplaces = $this->document_model->selectworkplaces();
       // echo $this->db->last_query();

            $workpstr = '<option value="0">--Please Select--</option>';
            if(!empty($workplaces)){ 
                 if ( $workplaces !== "false") {
                foreach ($workplaces as  $value) {
                $workpstr = $workpstr.'<option value="'.$value['id'].'">'.$value['region_name'].'</option>'."\n";
                  if($this->input->post('workplace')==""){
                    } else {
                      $workplace=$this->input->post('workplace');
                      $workpstr = $workpstr.'<option selected value="'.$workplace.'">'.$workplace.'</option>'."\n";
                    }
                }
            }
            
          }

             $categories = $this->document_model->selectcategories();


            $catestr = '<option value="0">--Please Select--</option>';
            if(!empty($categories)){ 
                 if ( $categories !== "false") {
                foreach ($categories as  $value) {
                $catestr = $catestr.'<option value="'.$value['Id'].'">'.$value['category'].'</option>'."\n";
                  if($this->input->post('category')==""){
                    } else {
                      $category=$this->input->post('category');
                      $catestr = $catestr.'<option selected value="'.$category.'">'.$category.'</option>'."\n";
                    }
                }
            }
            
          }
            //Load Categories End

          //Load Departments
            $departments = $this->document_model->selectdepartments();

            $departstr = '<option value="0">--Please Select--</option>';
            if(!empty($departments)){ 
                 if ( $departments !== "false") {
                foreach ($departments as  $value) {
                $departstr = $departstr.'<option value="'.$value['Id'].'">'.$value['department_name'].'</option>'."\n";
                  if($this->input->post('category')==""){
                    } else {
                      $department=$this->input->post('department');
                      $departstr = $departstr.'<option selected value="'.$department.'">'.$department.'</option>'."\n";
                    }
                }
            }
          }
            //Load Departments End

            //Load Segments
            $segments = $this->document_model->selectsegments();

            $segmentstr = '<option value="0">--Please Select--</option>';
            if(!empty($segments)){ 
                 if ( $segments !== "false") {
                foreach ($segments as  $value) {
                $segmentstr = $segmentstr.'<option value="'.$value['id'].'">'.$value['segment'].'</option>'."\n";
                  if($this->input->post('segment')==""){
                    } else {
                      $segment=$this->input->post('segment');
                      $segmentstr = $segmentstr.'<option selected value="'.$segment.'">'.$segment.'</option>'."\n";
                    }
                }
            }
          }
            //Load Segments End

          //Load Permission Groups
          

            $permissiongroups = $this->document_model->selectpermissiongroup($cgroup[0]['perm_level']);

            $pgroupstr = '<option value="0">--Please Select--</option>';
            if(!empty($permissiongroups)){ 
                 if ( $permissiongroups !== "false") {
                foreach ($permissiongroups as  $value) {
                $pgroupstr = $pgroupstr.'<option value="'.$value['id'].'">'.$value['classification'].'</option>'."\n";
                  if($this->input->post('permissiongroup')==""){
                    } else {
                      $permissiongroup=$this->input->post('permissiongroup');
                      $pgroupstr = $pgroupstr.'<option selected value="'.$permissiongroup.'">'.$depermissiongrouppartment.'</option>'."\n";
                    }
                }
            }
            $data = array(
             'departments' => $departstr,
             'categories' => $catestr,
             'workplaces' => $workpstr,
             'segments' => $segmentstr,
             'permissiongroups' => $pgroupstr,
             'hcperm' => $hcperm,
             'hscperm' => $hscperm,
             'hcoperm' => $hcoperm           
             );
          }
            //Load Permission Groups End


             //needd for new layout start//
          $t = $this->document_model->get_unprocessed($sUID);
          //echo '<pre>'.print_r($t,true).'</pre>';//exit;
          if($t[0]['id'] == 0){
            $data['docid']  = $this->document_model->create_document($sUID);
          }else{
            $data['docid']  = $t[0]['id'];
          }
            //$this->document_model->delete_unprocessed($sUID);
            
            $docowner  = $this->document_model->docowner($sUID);


            // $ttt  = "\" ' \" ' ' \"";
            
            // $data['ttt'] = $ttt;
            //echo '<pre>'.print_r($docowner,true).'</pre>'; 
            $data['docowner'] = $this->session->userdata('uName');
            $data['docownerid'] = $sUID;

            $data['userid'] = $this->session->userdata('UID');
            $data['userpermissions']=$this->get_user_permissions($data['userid']);
            $muserid= $this->session->userdata('UID');
            $menu = $this->document_model->get_user_menu($muserid);
            $data['pmenu']=$menu[0]['preferred_menu'];
   
            $data['pagename']='New Document';
            $data['pageid']='11';
            $data['submenu'] = 'transactions';
            $data['currentmenu'] = 'transactions';
            $data['currentmodule'] = 'Document';
            $data['title'] = 'New Document';
            $data['pagenamepage'] = 'New Document';

            $won="DOC".$data['docid'];
        $won=strtoupper($won);

        //echo "<script>alert(".$won.");</script>";
        $image = file_get_contents("https://thabiso.tekwani.co.za/capture/barcodewo/".$won);
        file_put_contents("application/barcodes/".$won.".jpg", $image);
        //needd for new layout end//

            $this->mainMenuBuild();
            $data['menu'] = $this->getMenu('New Document','livestockPerms');
            $this->load->view('main/header2017v2', $data);
            $this->load->view('document/newdocument', $data);
      }else{
        redirect('/main/permError');
      }
    }
  } 

   function getAutoCompleteContractor(){
    if (isset($_GET['term'])){
        $search = strtolower($_GET['term']);
        $this->document_model->getAllContractors($search);
      }
  }

  function getAutoCompleteCategory(){
    if (isset($_GET['term'])){
        //$search = strtolower($_GET['term']);

        if (isset($_GET['term'])){
      $search = strtolower($_GET['term']);
      $description = strtolower($_GET['catdescription']);
      $res = $this->document_model->getAllCategories($search,$description);

    }
        echo $res;
      }
  }

  function getAutoCompleteSubCategory(){
    if (isset($_GET['term'])){
        //$search = strtolower($_GET['term']);

        if (isset($_GET['term'])){
      $search = strtolower($_GET['term']);
      $description = strtolower($_GET['term']);
      $category = strtolower($_GET['catname']);
      $res = $this->document_model->getAllSubCategories($search,$category);

    }
        echo $res;
      }
  }

  function getAutoCompletehrpeople(){
    if (isset($_GET['term'])){
        $search = strtolower($_GET['term']);
        $this->document_model->getAllHrpeople($search);
        //echo $this->db->last_query();
      }
  }

   function getAutoCompletedocument(){
    if (isset($_GET['term'])){

      $link = $_SERVER['PHP_SELF'];
      $link_array = explode('/',$link);
      $docid = end($link_array);

        $search = strtolower($_GET['term']);
        $this->document_model->getAlldocuments($search,$docid);
        //echo $this->db->last_query();
      }
  }

            function newpermissiongroup() {
      //First check authorisation
      $sUID = $this->session->userdata('UID');
     
      $permCode = '1280';
      if ( $this->checkPerms($sUID, $permCode) ) {

            $data['permissiongroups'] = $this->document_model->viewpermissiongroups();
            $data['permissiongroupsorderd'] = $this->document_model->selectpermissiongrouporderd();
             //needd for new layout start//
            $data['userid'] = $this->session->userdata('UID');
            $data['userpermissions']=$this->get_user_permissions($data['userid']);
            $muserid= $this->session->userdata('UID');
            $menu = $this->document_model->get_user_menu($muserid);
            $data['pmenu']=$menu[0]['preferred_menu'];
   
            $data['pagename']='Manage Permission Group';
            $data['pageid']='6';
            $data['submenu'] = 'masterdata';
            $data['currentmenu'] = 'masterdata';
            $data['currentmodule'] = 'Document';
            $data['title'] = 'Manage Permission Group';
            $data['pagenamepage'] = 'Manage Permission Group';
        //needd for new layout end//

            $this->mainMenuBuild();
            $data['menu'] = $this->getMenu('Manage Permission Group','livestockPerms');
            $this->load->view('main/header2017v2', $data);
            $this->load->view('document/newpermissiongroup', $data);
      }   
      else {
        redirect('/main/permError');
      } 

    }

    function userpermissions() {
      //First check authorisation
      $sUID = $this->session->userdata('UID');
     
      $permCode = '3557';
      if ( $this->checkPerms($sUID, $permCode) ) {

            $data['permissiongroups'] = $this->document_model->viewpermissiongroups();

             //needd for new layout start//
            $data['userid'] = $this->session->userdata('UID');
            $data['userpermissions']=$this->get_user_permissions($data['userid']);
            $muserid= $this->session->userdata('UID');
            $menu = $this->document_model->get_user_menu($muserid);
            $data['pmenu']=$menu[0]['preferred_menu'];
   
            $data['pagename']='Manage User Permission';
            $data['pageid']='13';
            $data['submenu'] = 'masterdata';
            $data['currentmenu'] = 'masterdata';
            $data['currentmodule'] = 'Document';
            $data['title'] = 'Manage User Permission';
            $data['usergroups'] = $this->document_model->get_user_groups();
            $data['pagenamepage'] = 'Manage User Permission';
        //needd for new layout end//

            $this->mainMenuBuild();
            $data['menu'] = $this->getMenu('Manage User Permission','livestockPerms');
            $this->load->view('main/header2017v2', $data);
            $this->load->view('document/userpermissions', $data);
      }   
      else {
        redirect('/main/permError');
      } 

    }


     function newhrdepartment() {
      //First check authorisation
      $sUID = $this->session->userdata('UID');
     
      $permCode = '1280';
      if ( $this->checkPerms($sUID, $permCode) ) {

                 $managers = $this->document_model->selectmanagers();

  $catestr = '<option value="0">--Please Select--</option>';
  if(!empty($managers)){ 
                 if ( $managers !== "false") {
                foreach ($managers as  $value) {
                // echo ':'.$value['location_name'];

                $catestr = $catestr.'<option value="'.$value['UserID'].'">'.$value['employee'].'</option>'."\n";
                          }
                if($this->input->post('manager')==""){
      } else {
        $farm=$this->input->post('manager');
        $catestr = $catestr.'<option selected value="'.$farm.'">'.$farm.'</option>'."\n";
      }

              }

            }
            $data = array(
             'managers' => $catestr             
             );

            $data['hrdepartments'] = $this->document_model->viewhrdepartments();


             //needd for new layout start//
            $data['userid'] = $this->session->userdata('UID');
            $data['userpermissions']=$this->get_user_permissions($data['userid']);
            $muserid= $this->session->userdata('UID');
            $menu = $this->document_model->get_user_menu($muserid);
            $data['pmenu']=$menu[0]['preferred_menu'];
   
            $data['pagename']='New HR Department';
            $data['pageid']='4';
            $data['submenu'] = 'masterdata';
            $data['currentmenu'] = 'masterdata';
            $data['currentmodule'] = 'Document';
            $data['title'] = 'New HR Department';
            $data['pagenamepage'] = 'New HR Department';
        //needd for new layout end//

            $this->mainMenuBuild();
            $data['menu'] = $this->getMenu('New HR Department','livestockPerms');
            $this->load->view('main/header2017v2', $data);
            $this->load->view('document/newhrdepartment', $data);
      }   
      else {
        redirect('/main/permError');
      } 

    }

            function newtag() {
      //First check authorisation
      $sUID = $this->session->userdata('UID');
     
      $permCode = '1280';
      if ( $this->checkPerms($sUID, $permCode) ) {

            $data['tags'] = $this->document_model->viewtags();

             //needd for new layout start//
            $data['userid'] = $this->session->userdata('UID');
            $data['userpermissions']=$this->get_user_permissions($data['userid']);
            $muserid= $this->session->userdata('UID');
            $menu = $this->document_model->get_user_menu($muserid);
            $data['pmenu']=$menu[0]['preferred_menu'];
   
            $data['pagename']='New Tag';
            $data['pageid']='5';
            $data['submenu'] = 'masterdata';
            $data['currentmenu'] = 'masterdata';
            $data['currentmodule'] = 'Livestock';
            $data['title'] = 'New Tag';
            $data['pagenamepage'] = 'New Tag';
        //needd for new layout end//

            $this->mainMenuBuild();
            $data['menu'] = $this->getMenu('New Camps','livestockPerms');
            $this->load->view('main/header2017v2', $data);
            $this->load->view('document/newtag', $data);
      }   
      else {
        redirect('/main/permError');
      } 

    }


                function newworkplace() {
      //First check authorisation
      $sUID = $this->session->userdata('UID');
     
      $permCode = '1280';
      if ( $this->checkPerms($sUID, $permCode) ) {

            $data['workplaces'] = $this->document_model->viewworkplaces();

             //needd for new layout start//
            $data['userid'] = $this->session->userdata('UID');
            $data['userpermissions']=$this->get_user_permissions($data['userid']);
            $muserid= $this->session->userdata('UID');
            $menu = $this->document_model->get_user_menu($muserid);
            $data['pmenu']=$menu[0]['preferred_menu'];
   
            $data['pagename']='New Workplace';
            $data['pageid']='5';
            $data['submenu'] = 'masterdata';
            $data['currentmenu'] = 'masterdata';
            $data['currentmodule'] = 'Document';
            $data['title'] = 'New Workplace';
            $data['pagenamepage'] = 'New Workplace';
        //needd for new layout end//

            $this->mainMenuBuild();
            $data['menu'] = $this->getMenu('New Workplace','livestockPerms');
            $this->load->view('main/header2017v2', $data);
            $this->load->view('document/newworkplace', $data);
      }   
      else {
        redirect('/main/permError');
      } 

    }

    function searchform() {
      //First check authorisation
      $sUID = $this->session->userdata('UID');
     
      $permCode = '1280';
      if ( $this->checkPerms($sUID, $permCode) ) {

            $data['workplaces'] = $this->document_model->viewworkplaces();
            $searcharray = (isset($_POST['searcharray']) ? $_POST['searcharray'] : "");
            
             //needd for new layout start//
            $data['userid'] = $this->session->userdata('UID');
            $data['userpermissions']=$this->get_user_permissions($data['userid']);
            $muserid= $this->session->userdata('UID');
            $menu = $this->document_model->get_user_menu($muserid);
            $data['pmenu']=$menu[0]['preferred_menu'];
   
            $data['pagename']='Search Form';
            $data['pageid']='14';
            $data['submenu'] = 'transactions';

            $totalArea = 0;
            $effArea = 0;


            if($searcharray != ""){
              ob_flush();
              $results2 = $this->document_model->alldocumentssearch($searcharray);
            }else{
              $results2 = $this->document_model->alldocuments('');
            }
            //echo '<pre>'.print_r($results2,true).'</pre>';
            $data['records'] = $results2;     
            $data['totalRows'] = count($data['records']);
      //$params['currentmodule']='Documents';
            $data['showfilter']='true';

            $data['currentmenu'] = 'transactions';
            $data['currentmodule'] = 'Document';
            $data['title'] = 'Search Form';
            $data['pagenamepage'] = 'Search Form';
        //needd for new layout end//
            //Has group permission
      $cgroup = $this->document_model->getcpermissiongroup($sUID);
      $data['caccess_perm'] = $cgroup[0]['perm_level'];
      $group = $this->document_model->getpermissiongroup($sUID);
      $newarray = array();
      foreach ($group as $value) {
        $newarray[] = $value['permission_group_id'];
      }
      $data['access_perm'] = $newarray;


      //has document permission
      $group2 = $this->document_model->getpermissiondocument($sUID);
      $newarray2 = array();
      if(is_array($group2)){
         foreach ($group2 as $value2) {
        $newarray2[] = $value2['doc_id'];
      }
      
      }
     $data['access_perm2'] = $newarray2;


            $this->mainMenuBuild();
            $data['menu'] = $this->getMenu('Search Form','livestockPerms');
            $this->load->view('main/header2017v2', $data);
            $this->load->view('document/searchform', $data);
      }   
      else {
        redirect('/main/permError');
      } 

    }

    function getSearched() {
      //First check authorisation
      $sUID = $this->session->userdata('UID');
     $searcharray = $_POST['searcharray'];
      $permCode = '1280';
      if ( $this->checkPerms($sUID, $permCode) ) {

            $data['workplaces'] = $this->document_model->viewworkplaces();

             //needd for new layout start//
            $data['userid'] = $this->session->userdata('UID');
            $data['userpermissions']=$this->get_user_permissions($data['userid']);
            $muserid= $this->session->userdata('UID');
            $menu = $this->document_model->get_user_menu($muserid);
            $data['pmenu']=$menu[0]['preferred_menu'];
   
            $data['pagename']='Search Form';
            $data['pageid']='14';
            $data['submenu'] = 'transactions';

            $totalArea = 0;
            $effArea = 0;
            //echo '<pre>'.print_r($searcharray,true).'</pre>';
            $results2 = $this->document_model->alldocumentssearch($searcharray);
            $data['records'] = $results2;     
            $data['totalRows'] = count($data['records']);
      //$params['currentmodule']='Documents';
            $data['showfilter']='true';

            $data['currentmenu'] = 'transactions';
            $data['currentmodule'] = 'Document';
            $data['title'] = 'Search Form';
            $data['pagenamepage'] = 'Search Form';
        //needd for new layout end//
            //Has group permission
      $cgroup = $this->document_model->getcpermissiongroup($sUID);
      $data['caccess_perm'] = $cgroup[0]['perm_level'];
      $group = $this->document_model->getpermissiongroup($sUID);
      $newarray = array();
      foreach ($group as $value) {
        $newarray[] = $value['permission_group_id'];
      }
      $data['access_perm'] = $newarray;


      //has document permission
      $group2 = $this->document_model->getpermissiondocument($sUID);
      $newarray2 = array();
      if(is_array($group2)){
         foreach ($group2 as $value2) {
        $newarray2[] = $value2['doc_id'];
      }
      
      }
     $data['access_perm2'] = $newarray2;


            $this->mainMenuBuild();
            $data['menu'] = $this->getMenu('Search Form','livestockPerms');
            $this->load->view('main/header2017v2', $data);
            $this->load->view('document/searchform', $data);
      }   
      else {
        redirect('/main/permError');
      } 

    }


           function newsubcategory() {
      //First check authorisation
      $sUID = $this->session->userdata('UID');
     
      $permCode = '3555';
      if ( $this->checkPerms($sUID, $permCode) ) {
         $categories = $this->document_model->selectcategories();

  $catestr = '<option value="0">--Please Select--</option>';
  if(!empty($categories)){ 
                 if ( $categories !== "false") {
                foreach ($categories as  $value) {
                // echo ':'.$value['location_name'];

                $catestr = $catestr.'<option value="'.$value['Id'].'">'.$value['category'].'</option>'."\n";
                          }
                if($this->input->post('category')==""){
      } else {
        $farm=$this->input->post('category');
        $catestr = $catestr.'<option selected value="'.$farm.'">'.$farm.'</option>'."\n";
      }

              }

            }
            $data = array(
             'categories' => $catestr             
             );

            $data['subcategories'] = $this->document_model->viewsubcategories();

             //needd for new layout start//
            $data['userid'] = $this->session->userdata('UID');
            $data['userpermissions']=$this->get_user_permissions($data['userid']);
            $muserid= $this->session->userdata('UID');
            $menu = $this->document_model->get_user_menu($muserid);
            $data['pmenu']=$menu[0]['preferred_menu'];
   
            $data['pagename']='New Subcategory';
            $data['pageid']='2';
            $data['submenu'] = 'masterdata';
            $data['currentmenu'] = 'masterdata';
            $data['currentmodule'] = 'Document';
            $data['title'] = 'New Subcategory';
            $data['pagenamepage'] = 'New Subcategory';
        //needd for new layout end//

            $this->mainMenuBuild();
            $data['menu'] = $this->getMenu('New Subcategory','livestockPerms');
            $this->load->view('main/header2017v2', $data);
            $this->load->view('document/newsubcategory', $data);
      }   
      else {
        redirect('/main/permError');
      } 

    }

    function newcontractor() {
      //First check authorisation
      $sUID = $this->session->userdata('UID');
     
      $permCode = '3556';
      if ( $this->checkPerms($sUID, $permCode) ) {

            $data['contractors'] = $this->document_model->viewcontractors();

             //needd for new layout start//
            $data['userid'] = $this->session->userdata('UID');
            $data['userpermissions']=$this->get_user_permissions($data['userid']);
            $muserid= $this->session->userdata('UID');
            $menu = $this->document_model->get_user_menu($muserid);
            $data['pmenu']=$menu[0]['preferred_menu'];
   
            $data['pagename']='New Contractor';
            $data['pageid']='3';
            $data['submenu'] = 'masterdata';
            $data['currentmenu'] = 'masterdata';
            $data['currentmodule'] = 'Document';
            $data['title'] = 'New Contractor';
            $data['pagenamepage'] = 'New Contractor';
        //needd for new layout end//

            $this->mainMenuBuild();
            $data['menu'] = $this->getMenu('New Contractor','livestockPerms');
            $this->load->view('main/header2017v2', $data);
            $this->load->view('document/newcontractor', $data);
      }   
      else {
        redirect('/main/permError');
      } 

    }



function fetchsegdeprd(){
    $dep = $_POST['dep'];
    $seg = $_POST['seg'];
  $sUID = $this->session->userdata('UID');
  $searchtext = (isset($_POST['searchtext']) ? $_POST['searchtext'] : '');
    $permCode = '1280';
    if ( $this->checkPerms($sUID, $permCode) ) {
      //$cgroup = $this->document_model->getcpermissiongroup($sUID);
        $data=$this->document_model->fetchsegdeprdtags($dep,$seg,$searchtext,$sUID);
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
          
       }else {
echo 0;
    }
  }

  function fetchsegdeprdtags(){
    $dep = $_POST['dep'];
    $seg = $_POST['seg'];
    $searchtext = (isset($_POST['searchtext']) ? $_POST['searchtext'] : '');
  $sUID = $this->session->userdata('UID');
    $permCode = '3552';
    if ( $this->checkPerms($sUID, $permCode) ) {
      //$cgroup = $this->document_model->getcpermissiongroup($sUID);
        $data=$this->document_model->fetchsegdeprdtags($dep,$seg,$searchtext,$sUID);
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
          
       }else {
echo 0;
    }
  }


  function fetchdocsfordepsegua(){
    $dep = $_POST['dep'];
    $seg = $_POST['seg'];
  $sUID = $this->session->userdata('UID');
    $permCode = '3552';
    if ( $this->checkPerms($sUID, $permCode) ) {
      //$cgroup = $this->document_model->getcpermissiongroup($sUID);
        $data=$this->document_model->fetchdocsfordepsegua($dep,$seg);
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
          
       }else {
echo 0;
    }
  }

  function fetchsegdepuatags(){
    $dep = $_POST['dep'];
    $seg = $_POST['seg'];
    $searchtext = (isset($_POST['searchtext']) ? $_POST['searchtext'] : '');
  $sUID = $this->session->userdata('UID');
    $permCode = '3552';
    if ( $this->checkPerms($sUID, $permCode) ) {
      //$cgroup = $this->document_model->getcpermissiongroup($sUID);
        $data=$this->document_model->fetchsegdepuatags($dep,$seg,$searchtext,$sUID);
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
          
       }else {
echo 0;
    }
  }

   function fetchdocsfordepseg(){
    $dep = $_POST['dep'];
    $seg = $_POST['seg'];
  $sUID = $this->session->userdata('UID');
    $permCode = '3552';
    if ( $this->checkPerms($sUID, $permCode) ) {
      //$cgroup = $this->document_model->getcpermissiongroup($sUID);
        $data=$this->document_model->fetchdocsfordepseg($dep,$seg);
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
          
       }else {
echo 0;
    }
  }

  function fetchdocsfordepsegtags(){
    $dep = $_POST['dep'];
    $seg = $_POST['seg'];
    $searchtext = (isset($_POST['searchtext']) ? $_POST['searchtext'] : '');
  $sUID = $this->session->userdata('UID');
    $permCode = '3552';
    if ( $this->checkPerms($sUID, $permCode) ) {
      //$cgroup = $this->document_model->getcpermissiongroup($sUID);
        $data=$this->document_model->fetchdocsfordepsegtags($dep,$seg,$searchtext,$sUID);
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
          
       }else {
echo 0;
    }
  }

    function fetchtagsmain(){
    //$dep = $_POST['dep'];
    //$seg = $_POST['seg'];
    $searchtext = (isset($_POST['searchtext']) ? $_POST['searchtext'] : '');
  $sUID = $this->session->userdata('UID');
    $permCode = '3552';
    if ( $this->checkPerms($sUID, $permCode) ) {
      //$cgroup = $this->document_model->getcpermissiongroup($sUID);
        $data=$this->document_model->alldocumentsummary($searchtext);
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
          
       }else {
echo 0;
    }
  }

 function getuserpermission(){    // gets the father tags for auto complete
      //$this->load->model('ls_model');
      $link = $_SERVER['PHP_SELF'];
    $link_array = explode('/',$link);
   $typid = end($link_array);
        $result = $this->document_model->selectmanagers2($typid);
        //echo $this->db->last_query();
        foreach($result as $key => $value){
      $return_value[$value['employee']] = $value['UserID'];     
    }
    header('Content-Type: application/x-json; charset=utf-8');
    //echo '<pre>'.print_r(json_encode($return_value),true).'</pre>';
    echo(json_encode($return_value));
    }

    function getcats(){   
        $result = $this->document_model->getcategories();
        //echo '<pre>'.print_r($result,true).'</pre>';exit;
        foreach($result as $key => $value){
      $return_value[$value['Id']] = $value['category'];     
    }
    header('Content-Type: application/x-json; charset=utf-8');
    //echo '<pre>'.print_r(json_encode($return_value),true).'</pre>';
    echo(json_encode($return_value));
    }

    function getsubcatsdynamic(){  

    $link = $_SERVER['PHP_SELF'];
    $link_array = explode('/',$link);
   $typid = end($link_array);

        $result = $this->document_model->getsubcategoriesdynamic($typid);
        foreach($result as $key => $value){
      $return_value[$value['Id']] = $value['subcategory'];     
    }
    header('Content-Type: application/x-json; charset=utf-8');
    //echo '<pre>'.print_r(json_encode($return_value),true).'</pre>';
    echo(json_encode($return_value));
    }

     function getchosenusers(){  
      $link = $_SERVER['PHP_SELF'];
    $link_array = explode('/',$link);
   $typid = end($link_array);
        $result = $this->document_model->selectchosenusers($typid);

        foreach($result as $key => $value){
      $return_value[$value['UserID']] = $value['employee'];     
    }
    header('Content-Type: application/x-json; charset=utf-8');
    echo(json_encode($return_value));
      
    }

    function getsubcats(){  
      $link = $_SERVER['PHP_SELF'];
    $link_array = explode('/',$link);
   $typid = end($link_array);
        $result = $this->document_model->getsubcats($typid);

        foreach($result as $key => $value){
      $return_value[$value['id']] = $value['subcategory'];     
    }
    header('Content-Type: application/x-json; charset=utf-8');
    echo(json_encode($return_value));
      
    }

    function getdeparts(){  
      $link = $_SERVER['PHP_SELF'];
    $link_array = explode('/',$link);
   $typid = end($link_array);
        $result = $this->document_model->getdeparts($typid);

        foreach($result as $key => $value){
      $return_value[$value['id']] = $value['department_name'];     
    }
    header('Content-Type: application/x-json; charset=utf-8');
    echo(json_encode($return_value));
      
    }


      function getTag(){  
      $link = $_SERVER['PHP_SELF'];
    $link_array = explode('/',$link);
   $typid = end($link_array);
        $result = $this->document_model->selecttag($typid);
        //echo $this->db->last_query();
        foreach($result as $key => $value){
      $return_value[$value['id']] = $value['tag'];     
    }
    header('Content-Type: application/x-json; charset=utf-8');
    echo(json_encode($return_value));
      
    }


    function adduserpermission(){
    $groupid = $_POST['groupid'];
    $userid = $_POST['userid'];
    $datetimecreated = date('Y-m-d H:i:s');
    $createdby = $this->session->userdata('UID');
    $permission = 1;
    $deleted = 0;
    $createdby = $this->session->userdata('UID');
    $sUID = $this->session->userdata('UID');
    $permCode = '3557';
    
    if ( $this->checkPerms($sUID, $permCode) ) {
        $camp = $this->document_model->addnewuserpermission($groupid,$userid,$permission,$datetimecreated,$deleted,$createdby);
        //echo $this->db->last_query();
          echo $camp;
       }else {
echo 0;
    }
  }

  function updatestatus(){
    $docid = $_POST['docid'];
    $status = $_POST['status'];
    $datetimecreated = date('Y-m-d H:i:s');
    $userid = $this->session->userdata('UID');
    $sUID = $this->session->userdata('UID');
    $permCode = '3553';
    
    if ( $this->checkPerms($sUID, $permCode) ) {
        $status = $this->document_model->updatestatus($status,$docid,$userid,$datetimecreated);

          echo $status;
       }else {
echo 0;
    }
  }

      function addnewcategory(){
        $categoryname = $_POST['categoryname'];
        $datetimecreated = date('Y-m-d H:i:s');
        $createdby = $this->session->userdata('UID');
        $deleted = 0;
        $description = $_POST['description'];
        $hascontract = $_POST['hascontract'];
     //echo $farm;exit;
            $sUID = $this->session->userdata('UID');
    $permCode = '3554';
    
    if ( $this->checkPerms($sUID, $permCode) ) {
        $category = $this->document_model->addnewcategory2($categoryname,$description,$datetimecreated,$createdby,$deleted,$hascontract);
             echo $category;
       }else {
echo 0;
    }
  }

  function download(){

    $link = $_SERVER['PHP_SELF'];
    $link_array = explode('/',$link);
   $file = end($link_array);

    echo "<script>alert('Thabiso');</script>";
    $fileName = basename($file);
    $filePath = 'application/docs/'.$fileName;
    if(!empty($fileName) && file_exists($filePath)){
        // Define headers
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$fileName");
        header("Content-Type: application/msword");
        header("Content-Transfer-Encoding: binary");
        
        // Read the file
        readfile($filePath);
        exit;
   
}
  }

  function addnewcategorydynamic(){
        $newcategory = $_POST['newcategory'];
        $datetimecreated = date('Y-m-d H:i:s');
        $createdby = $this->session->userdata('UID');
        $deleted = 0;
        $catdescription = $_POST['catdescription'];
        $hascontract = $_POST['hascontract'];
     //echo $farm;exit;
            $sUID = $this->session->userdata('UID');
    $permCode = '3554';
    
    if ( $this->checkPerms($sUID, $permCode) ) {
        $category = $this->document_model->addnewcategory($newcategory,$catdescription,$datetimecreated,$createdby,$deleted,$hascontract);
             
             echo $category[0]['id'];
       }else {
echo 0;
    }
  }

      function save_new_document(){
        $datetimecreated = date('Y-m-d H:i:s');
        $createdby = $this->session->userdata('UID');
        $sUID = $this->session->userdata('UID');
    $permCode = '3549';
    
    if ( $this->checkPerms($sUID, $permCode) ) {
        $document=$this->document_model->save_new_document($_POST,$sUID);
    $this->load->library('email');
 
    $this->email->from('notifications@tekwani.co.za', 'Tekwani IMS - New Document Created');
    $this->email->to('thabisongubane1992@gmail.com');
 
    $cuser = $this->session->userdata('uName');
    $this->email->subject('New Document');
    $this->email->message($cuser.' has created a new document <br><a href="'.base_url().'document/viewdoc/docid/'.$_POST['docid'].'">Click to view document</a>');
    //$this->email->attach($file);
   
     if ($this->email->send()) {
        echo 1;
    } else {
      echo "fail";
      echo $this->email->print_debugger();
    }

         }else {
echo 0;
    }
      }

      function save_document_link(){
        $datetimecreated = date('Y-m-d H:i:s');
        $createdby = $this->session->userdata('UID');
        $sUID = $this->session->userdata('UID');
    $permCode = '3549';
    
    if ( $this->checkPerms($sUID, $permCode) ) {
        $document=$this->document_model->save_document_link($_POST);
        //echo $this->db->last_query(); 
        echo $document;
         }else {
echo 0;
    }
      }


      function update_document(){
        $datetimecreated = date('Y-m-d H:i:s');
        $createdby = $this->session->userdata('UID');
        $sUID = $this->session->userdata('UID');
    $permCode = '3551';
    
    if ( $this->checkPerms($sUID, $permCode) ) {
        $document=$this->document_model->save_new_document($_POST,$sUID);
        //echo $this->db->last_query();

                   //testemailsmtp(); 
    $this->load->library('email');
 
    $this->email->from('notifications@tekwani.co.za', 'Tekwani IMS - Document Updated');
    $this->email->to('thabisongubane1992@gmail.com');
 
    $cuser = $this->session->userdata('uName');
    $this->email->subject('Document Update');
    $this->email->message($cuser.' has updated document '.$_POST['docid'].' <br><a href="'.base_url().'document/viewdoc/docid/'.$_POST['docid'].'">Click to view document</a>');
    //$this->email->attach($file);
   
     if ($this->email->send()) {
      echo 1;
    } else {
      echo "fail";
      echo $this->email->print_debugger();
    }


        //echo $document;
         }else {
echo 0;
    }
      }


       function addnewpermissiongroup(){
        $permissiongroupname = $_POST['permissiongroupname'];
        $datetimecreated = date('Y-m-d H:i:s');
        $createdby = $this->session->userdata('UID');
        $deleted = 0;
        $description = $_POST['description'];
     //echo $farm;exit;
        $sUID = $this->session->userdata('UID');
    $permCode = '1280';
    
    if ( $this->checkPerms($sUID, $permCode) ) {
        $pgroup = $this->document_model->addnewpermissiongroup($permissiongroupname,$description,$datetimecreated,$createdby,$deleted);
        //echo $this->db->last_query();
        echo $pgroup;
          }else {
echo 0;
    }
      }

      function addnewhrdepartment(){
        $hrdepartmentname = $_POST['hrdepartmentname'];
        $manager = $_POST['manager'];
        $createdby = $this->session->userdata('UID');
        $description = $_POST['description'];
     //echo $farm;exit;
        $sUID = $this->session->userdata('UID');
    $permCode = '1280';
    
    if ( $this->checkPerms($sUID, $permCode) ) {
        $hrdepartment = $this->document_model->addnewhrdepartment($hrdepartmentname,$description,$manager);
        echo $hrdepartment;
        }else {
echo 0;
    }
      }

      function addnewtag(){
        $tagname = $_POST['tagname'];
        $datetimecreated = date('Y-m-d H:i:s');
        $createdby = $this->session->userdata('UID');
        $deleted = 0;
        $sUID = $this->session->userdata('UID');
    $permCode = '1280';
    
    if ( $this->checkPerms($sUID, $permCode) ) {
        $tag = $this->document_model->addnewtag($tagname,$datetimecreated,$createdby,$deleted);
        //echo $this->db->last_query();
        echo $tag;
         }else {
echo 0;
    }
      }

      function addnewworkplace(){
        $workplacename = $_POST['workplacename'];
        $datetimecreated = date('Y-m-d H:i:s');
        $createdby = $this->session->userdata('UID');
        $deleted = 0;
        $sUID = $this->session->userdata('UID');
    $permCode = '1280';
    
    if ( $this->checkPerms($sUID, $permCode) ) {
        $tag = $this->document_model->addnewworkplace($workplacename,$datetimecreated,$createdby,$deleted);
        //echo $this->db->last_query();
        echo $tag;
         }else {
echo 0;
    }
      }

      function addmoretags(){
         $link = $_SERVER['PHP_SELF'];
    $link_array = explode('/',$link);
   $name = $_POST['nam'];
   $docid = $_POST['docid'];
   $datetimecreated = date('Y-m-d H:i:s');
        $createdby = $this->session->userdata('UID');
        $deleted = 0;
        $sUID = $this->session->userdata('UID');
        $result = $this->document_model->addnewtag($name,$docid,$datetimecreated,$createdby,$deleted);
        //echo $this->db->last_query();
        echo $result;
      }

      function addnewsubcategory(){
        $subcategoryname = $_POST['subcategoryname'];
        $category = $_POST['category'];
        $datetimecreated = date('Y-m-d H:i:s');
        $createdby = $this->session->userdata('UID');
        $deleted = 0;
        $description = $_POST['description'];
     //echo $farm;exit;
        $sUID = $this->session->userdata('UID');
    $permCode = '3555';
    
    if ( $this->checkPerms($sUID, $permCode) ) {
        $subcategory = $this->document_model->addnewsubcategory2($subcategoryname,$category,$description,$datetimecreated,$createdby,$deleted);
        echo $subcategory;
         }else {
echo 0;
    }
      }
      function addnewsubcategorydynamic(){
        $newsubcategory = $_POST['newsubcategory'];
        $catname = $_POST['catname'];
        $datetimecreated = date('Y-m-d H:i:s');
        $createdby = $this->session->userdata('UID');
        $deleted = 0;
        $subcatdescription = $_POST['subcatdescription'];
     //echo $farm;exit;
        $sUID = $this->session->userdata('UID');
    $permCode = '3555';
    
    if ( $this->checkPerms($sUID, $permCode) ) {
        $subcategory = $this->document_model->addnewsubcategory($newsubcategory,$catname,$subcatdescription,$datetimecreated,$createdby,$deleted);
        echo $subcategory[0]['id'];
         }else {
echo 0;
    }
      }

       function addnewcontractor(){
        $contractorname = $_POST['contractorname'];
        $contractperson = $_POST['contractperson'];
        $address = $_POST['address'];
        $tel = $_POST['tel'];
        $email = $_POST['email'];
        $datetimecreated = date('Y-m-d H:i:s');
        $createdby = $this->session->userdata('UID');
        $deleted = 0;
     //echo $farm;exit;
        $sUID = $this->session->userdata('UID');
    $permCode = '3556';
    
    if ( $this->checkPerms($sUID, $permCode) ) {
        $contractor = $this->document_model->addnewcontractor2($contractorname,$contractperson,$address,$tel,$email,$datetimecreated,$createdby,$deleted);
        //echo $this->db->last_query();
        echo $contractor[0]['maxid'];
         }else {
echo 0;
    }
      }

      function addnewcontractordynamic(){
        $contractorname = $_POST['contractorname'];
        $contractperson = $_POST['contractperson'];
        $address = $_POST['address'];
        $tel = $_POST['tel'];
        $email = $_POST['email'];
        $datetimecreated = date('Y-m-d H:i:s');
        $createdby = $this->session->userdata('UID');
        $deleted = 0;
     //echo $farm;exit;
        $sUID = $this->session->userdata('UID');
    $permCode = '3556';
    
    if ( $this->checkPerms($sUID, $permCode) ) {
        $contractor = $this->document_model->addnewcontractor($contractorname,$contractperson,$address,$tel,$email,$datetimecreated,$createdby,$deleted);
        //echo $this->db->last_query();
        echo $contractor[0]['maxid'];
         }else {
echo 0;
    }
      }

        function editcategory() {
      //First check authorisation
      $sUID = $this->session->userdata('UID');

     
      $permCode = '3554';
      if ( $this->checkPerms($sUID, $permCode) ) {
        $uristring=$this->uri->uri_to_assoc();
        $categoryid =$uristring['category_id'];
        $data['categories'] = $this->document_model->editcategory($categoryid);
         //needd for new layout start//
        $data['userid'] = $this->session->userdata('UID');
        $data['userpermissions']=$this->get_user_permissions($data['userid']);
        $muserid= $this->session->userdata('UID');
        $menu = $this->document_model->get_user_menu($muserid);
        $data['pmenu']=$menu[0]['preferred_menu'];

        $data['pagename']='Edit Category';
        $data['pageid']='1';
        $data['submenu'] = 'masterdata';
        $data['currentmenu'] = 'masterdata';
        $data['currentmodule'] = 'Document';
        $data['title'] = 'Edit Category';
        $data['pagenamepage'] = 'Edit Category';
    //needd for new layout end//

        $this->mainMenuBuild();
        $data['menu'] = $this->getMenu('Edit Category','livestockMasterDataPerms');
        $this->load->view('main/header2017v2', $data); 
        $this->load->view('document/editcategory', $data);
      }   
      else {
        redirect('/main/permError');
      } 

    }

      function editpermissiongroup() {
      //First check authorisation
      $sUID = $this->session->userdata('UID');
      $permCode = '1280';
      if ( $this->checkPerms($sUID, $permCode) ) {
        $uristring=$this->uri->uri_to_assoc();
        $permissiongroupid =$uristring['permissiongroup_id'];
        $data['permissiongroups'] = $this->document_model->editpermissiongroup($permissiongroupid);
         //needd for new layout start//
        $data['userid'] = $this->session->userdata('UID');
        $data['userpermissions']=$this->get_user_permissions($data['userid']);
        $muserid= $this->session->userdata('UID');
        $menu = $this->document_model->get_user_menu($muserid);
        $data['pmenu']=$menu[0]['preferred_menu'];

        $data['pagename']='Edit Permission Group';
        $data['pageid']='6';
        $data['submenu'] = 'masterdata';
        $data['currentmenu'] = 'masterdata';
        $data['currentmodule'] = 'Document';
        $data['title'] = 'Edit Permission Group';
        $data['pagenamepage'] = 'Edit Permission Group';
    //needd for new layout end//

        $this->mainMenuBuild();
        $data['menu'] = $this->getMenu('Edit Permission Group','livestockMasterDataPerms');
        $this->load->view('main/header2017v2', $data); 
        $this->load->view('document/editpermissiongroup', $data);
      }   
      else {
        redirect('/main/permError');
      } 

    }

     function edittag() {
      //First check authorisation
      $sUID = $this->session->userdata('UID');

     
      $permCode = '1280';
      if ( $this->checkPerms($sUID, $permCode) ) {
        $uristring=$this->uri->uri_to_assoc();
        $tagid =$uristring['tag_id'];
        $data['tags'] = $this->document_model->edittag($tagid);
         //needd for new layout start//
        $data['userid'] = $this->session->userdata('UID');
        $data['userpermissions']=$this->get_user_permissions($data['userid']);
        $muserid= $this->session->userdata('UID');
        $menu = $this->document_model->get_user_menu($muserid);
        $data['pmenu']=$menu[0]['preferred_menu'];

        $data['pagename']='Edit Tag';
        $data['pageid']='5';
        $data['submenu'] = 'masterdata';
        $data['currentmenu'] = 'masterdata';
        $data['currentmodule'] = 'Livestock';
        $data['title'] = 'Edit Tag';
        $data['pagenamepage'] = 'Edit Tag';
    //needd for new layout end//

        $this->mainMenuBuild();
        $data['menu'] = $this->getMenu('New Camps','livestockMasterDataPerms');
        $this->load->view('main/header2017v2', $data); 
        $this->load->view('document/edittag', $data);
      }   
      else {
        redirect('/main/permError');
      } 

    }

      function editworkplace() {
      //First check authorisation
      $sUID = $this->session->userdata('UID');

     
      $permCode = '1280';
      if ( $this->checkPerms($sUID, $permCode) ) {
        $uristring=$this->uri->uri_to_assoc();
        $workplaceid =$uristring['workplace_id'];
        $data['workplaces'] = $this->document_model->editworkplace($workplaceid);
         //needd for new layout start//
        $data['userid'] = $this->session->userdata('UID');
        $data['userpermissions']=$this->get_user_permissions($data['userid']);
        $muserid= $this->session->userdata('UID');
        $menu = $this->document_model->get_user_menu($muserid);
        $data['pmenu']=$menu[0]['preferred_menu'];

        $data['pagename']='Edit Workplace';
        $data['pageid']='5';
        $data['submenu'] = 'masterdata';
        $data['currentmenu'] = 'masterdata';
        $data['currentmodule'] = 'Document';
        $data['title'] = 'Edit Workplace';
        $data['pagenamepage'] = 'Edit Workplace';
    //needd for new layout end//

        $this->mainMenuBuild();
        $data['menu'] = $this->getMenu('Edit Workplace','livestockMasterDataPerms');
        $this->load->view('main/header2017v2', $data); 
        $this->load->view('document/editworkplace', $data);
      }   
      else {
        redirect('/main/permError');
      } 

    }


      function editcontractor() {
      //First check authorisation
      $sUID = $this->session->userdata('UID');

     
      $permCode = '3556';
      if ( $this->checkPerms($sUID, $permCode) ) {
        $uristring=$this->uri->uri_to_assoc();
        $contractorid =$uristring['contractor_id'];
        $data['contractors'] = $this->document_model->editcontractor($contractorid);
         //needd for new layout start//
        $data['userid'] = $this->session->userdata('UID');
        $data['userpermissions']=$this->get_user_permissions($data['userid']);
        $muserid= $this->session->userdata('UID');
        $menu = $this->document_model->get_user_menu($muserid);
        $data['pmenu']=$menu[0]['preferred_menu'];

        $data['pagename']='Edit Contractor';
        $data['pageid']='3';
        $data['submenu'] = 'masterdata';
        $data['currentmenu'] = 'masterdata';
        $data['currentmodule'] = 'Document';
        $data['title'] = 'Edit Contractor';
        $data['pagenamepage'] = 'Edit Contractor';
    //needd for new layout end//

        $this->mainMenuBuild();
        $data['menu'] = $this->getMenu('Edit Contractor','livestockMasterDataPerms');
        $this->load->view('main/header2017v2', $data); 
        $this->load->view('document/editcontractor', $data);
      }   
      else {
        redirect('/main/permError');
      } 

    }

    function editsubcategory() {
      //First check authorisation
      $sUID = $this->session->userdata('UID');

     
      $permCode = '3555';
      if ( $this->checkPerms($sUID, $permCode) ) {
      $uristring=$this->uri->uri_to_assoc();
      $subcategoryid =$uristring['subcategory_id'];

      $data['subcategories'] = $this->document_model->editsubcategory($subcategoryid);
      $scategory = $this->document_model->selectedcategory($subcategoryid);
      $categories = $this->document_model->selectedCat($scategory[0]['category_id']);
      $categories2 = $this->document_model->selectcategories();

        $categorystr = '<option value="0">--Please Select--</option>';
        if(!empty($categories)){ 
          if ( $categories !== "false") {
            foreach ($categories2 as  $value) {
            if($scategory[0]['category_id']==$value['Id']){$farsel="selected='selected'";} else {$farsel="";}
                $categorystr = $categorystr.'<option  '.$farsel.' value="'.$value['Id'].'">'.$value['category'].'</option>'."\n";
                                }
                      if($this->input->post('category')==""){
            } else {
              $category=$this->input->post('category');
              $categorystr = $categorystr.'<option selected value="'.$category.'">'.$category.'</option>'."\n";
            }

            }

           }

            $data = array(
             'categories' => $categorystr
             
             );

            $data['subcategories'] = $this->document_model->editsubcategory($subcategoryid);
             //needd for new layout start//
            $data['userid'] = $this->session->userdata('UID');
            $data['userpermissions']=$this->get_user_permissions($data['userid']);
            $muserid= $this->session->userdata('UID');
            $menu = $this->document_model->get_user_menu($muserid);
            $data['pmenu']=$menu[0]['preferred_menu'];
   
            $data['pagename']='Edit Subcategory';
            $data['pageid']='2';
            $data['submenu'] = 'masterdata';
            $data['currentmenu'] = 'masterdata';
            $data['currentmodule'] = 'Document';
            $data['title'] = 'Edit Subcategory';
            $data['pagenamepage'] = 'Edit Subcategory';
        //needd for new layout end//

            $this->mainMenuBuild();
            $data['menu'] = $this->getMenu('Edit Subcategory','livestockMasterDataPerms');
            $this->load->view('main/header2017v2', $data);       
         

        $this->load->view('document/editsubcategory', $data);
      }   
      else {
        redirect('/main/permError');
      } 

    }


    function edit_document() {
      //First check authorisation
      $sUID = $this->session->userdata('UID');
     
      $permCode = '3551';

      $hcperm = '';
      $hscperm = '';
      $hcoperm = '';
      if ( $this->checkPerms($sUID, '3554') ) {
        $hcperm = 1;
      }else{
        $hcperm = 0;
      }

      if ( $this->checkPerms($sUID, '3555') ) {
        $hscperm = 1;
      }else{
        $hscperm = 0;
      }

      if ( $this->checkPerms($sUID, '3556') ) {
        $hcoperm = 1;
      }else{
        $hcoperm = 0;
      }

      if ( $this->checkPerms($sUID, $permCode) ) {
      $uristring=$this->uri->uri_to_assoc();
      $docid =$uristring['docid'];

      //REPOPULATE CATEGORIES START************************************************************************************************
      $selectedcat = $this->document_model->selecteddocumentcategory($docid);
      //echo $this->db->last_query();
      $allcategories = $this->document_model->selectcategories(); 
        $categorystr = '<option value="0">--Please Select--</option>';
        if(!empty($selectedcat)){ 
          if ( $selectedcat !== "false") {
            foreach ($allcategories as  $value) {
            if($selectedcat[0]['id']==$value['Id']){$farsel="selected='selected'";} else {$farsel="";}
                $categorystr = $categorystr.'<option  '.$farsel.' value="'.$value['Id'].'">'.$value['category'].'</option>'."\n";
                                }
                      if($this->input->post('category')==""){
            } else {
              $category=$this->input->post('category');
              $categorystr = $categorystr.'<option selected value="'.$category.'">'.$category.'</option>'."\n";
            }

            }

        }
      //REPOPULATE CATEGORIES END************************************************************************************************

      //REPOPULATE WORKPLACE START************************************************************************************************
      $selectedwp = $this->document_model->selecteddocumentworkplace($docid);
      $allworkplaces = $this->document_model->selectworkplaces(); 
      
        $workplacestr = '<option value="0">--Please Select--</option>';
        if(!empty($allworkplaces)){ 
          if ( $allworkplaces !== "false") {
            foreach ($allworkplaces as  $value) {
              //echo '<pre>'.print_r($selectedwp[0]['id'],true).'</pre>';
            if($selectedwp[0]['id']==$value['id']){$farsel="selected='selected'";} else {$farsel="";}
                $workplacestr = $workplacestr.'<option  '.$farsel.' value="'.$value['id'].'">'.$value['region_name'].'</option>'."\n";
                                }
                      if($this->input->post('workplacename')==""){
            } else {
              $workplace=$this->input->post('workplacename');
              $workplacestr = $workplacestr.'<option selected value="'.$workplace.'">'.$workplace.'</option>'."\n";
            }

            }

        }
        
      //REPOPULATE WORKPLACE END************************************************************************************************


      //REPOPULATE SUBCATEGORIES START*******************************************************************************************
      $selectedsubcats = $this->document_model->selecteddocumentsubcategory($docid);
      $allsubcategories = $this->document_model->selectsubcategories(); 
        $subcategorystr = '<option value="0">--Please Select--</option>';
        if(!empty($selectedsubcats)){ 
          if ( $selectedsubcats !== "false") {
            foreach ($allsubcategories as  $value) {
            if($selectedsubcats[0]['id']==$value['Id']){$farsel="selected='selected'";} else {$farsel="";}
                $subcategorystr = $subcategorystr.'<option  '.$farsel.' value="'.$value['Id'].'">'.$value['subcategory'].'</option>'."\n";
                                }
                      if($this->input->post('subcategory')==""){
            } else {
              $subcategory=$this->input->post('subcategory');
              $subcategorystr = $subcategorystr.'<option selected value="'.$subcategory.'">'.$subcategory.'</option>'."\n";
            }

            }

           }

      //REPOPULATE CATEGORIES END************************************************************************************************

      //REPOPULATE DEPARTMENTS START*******************************************************************************************
      $selecteddepart = $this->document_model->selecteddocumentdepartment($docid);
      $alldepartments = $this->document_model->selectdepartments(); 
      //echo '<pre>'.print_r($selecteddepart,true).'</pre>';exit;
        $departmentstr = '<option value="0">--Please Select--</option>';
        if(!empty($alldepartments)){ 
          if ( $alldepartments !== "false") {
            foreach ($alldepartments as  $value) {
            if($selecteddepart[0]['id']==$value['Id']){$farsel="selected='selected'";} else {$farsel="";}
                $departmentstr = $departmentstr.'<option  '.$farsel.' value="'.$value['Id'].'">'.$value['department_name'].'</option>'."\n";
                                }
                      if($this->input->post('subcategory')==""){
            } else {
              $department=$this->input->post('department');
              $departmentstr = $departmentstr.'<option selected value="'.$department.'">'.$department.'</option>'."\n";
            }

            }

           }

    
      //REPOPULATE DEPARTMENTS END************************************************************************************************

      //REPOPULATE SEGMENTS START*******************************************************************************************
      $selectedsegm = $this->document_model->selecteddocumentsegment($docid);
      $allsegments = $this->document_model->selectsegments(); 
      //echo '<pre>'.print_r($selecteddepart,true).'</pre>';exit;
        $segmentstr = '<option value="0">--Please Select--</option>';
        if(!empty($allsegments)){ 
          if ( $allsegments !== "false") {
            foreach ($allsegments as  $value) {
            if($selectedsegm[0]['id']==$value['id']){$farsel="selected='selected'";} else {$farsel="";}
                $segmentstr = $segmentstr.'<option  '.$farsel.' value="'.$value['id'].'">'.$value['segment'].'</option>'."\n";
                                }
                      if($this->input->post('segment')==""){
            } else {
              $segment=$this->input->post('segment');
              $segmentstr = $segmentstr.'<option selected value="'.$segment.'">'.$segment.'</option>'."\n";
            }

            }

           }

    
      //REPOPULATE SEGMENTS END************************************************************************************************


      //REPOPULATE PERMISSION GROUP START****************************************************************************************
      $selectedgroup = $this->document_model->selecteddocumentgroup($docid);
      
      $cgroup = $this->document_model->getcpermissiongroup($sUID);

      $allgroups = $this->document_model->selectpermissiongroup($cgroup[0]['perm_level']); 
        $groupstr = '<option value="0">--Please Select--</option>';
        if(!empty($allgroups)){ 
          if ( $allgroups !== "false") {
            foreach ($allgroups as  $value) {
            if($selectedgroup[0]['id']==$value['id']){$farsel="selected='selected'";} else {$farsel="";}
                $groupstr = $groupstr.'<option  '.$farsel.' value="'.$value['id'].'">'.$value['classification'].'</option>'."\n";
                                }
                      if($this->input->post('group')==""){
            } else {
              $group=$this->input->post('group');
              $groupstr = $groupstr.'<option selected value="'.$group.'">'.$group.'</option>'."\n";
            }

            }

           }


            $data = array(
              'categories' => $categorystr,
              'workplaces' => $workplacestr,
             'subcategories' => $subcategorystr,
             'departments' => $departmentstr,
             'segments' => $segmentstr,
             'groups' => $groupstr,
             'hcperm' => $hcperm,
             'hscperm' => $hscperm,
             'hcoperm' => $hcoperm 
             
             );
      //REPOPULATE CATEGORIES END************************************************************************************************
            $docowner  = $this->document_model->docowner($sUID);

            $data['docowner'] = $this->session->userdata('uName');

            $data['docownerid'] = $sUID;
            $data['documents'] = $this->document_model->edit_document($docid);

            //DOC OWNER
            // $data['docuowner']  = $this->document_model->docowner($data['documents'][0]['owner']);
            // echo '<pre>'.print_r($data['docuowner'][0]['owner'],true).'</pre>';exit;
            // $data['docowner']  = $data['docuowner'][0]['owner'];

            //ADDITIONAL OWNER
            $data['additionaldocowner']  = $this->document_model->docowner($data['documents'][0]['additional_owner']);
            $data['add_docowner']  = $data['additionaldocowner'][0]['owner'];

            //DECRYPT PASSWORD
            $data['password_decrypt'] = $this->encrypt->decode($data['documents'][0]['password']);

            $data['attachments'] = $this->document_model->edit_attachment($docid);
            $data['links'] = $this->document_model->edit_link($docid);
            //echo '<pre>'.print_r($data['attachments'],true).'</pre>';

            $approvedstr = '<option value="0">--Please Select--</option>';


            foreach($data['documents'] as $doc){
              $cparty = $this->document_model->selectedContractor($doc['contracting_party']);
              //$appby = $this->document_model->selectedMan($doc['approved_by']);
              //$owner = $this->document_model->selectedMan($doc['owner']);
              if($doc['approved']==1){$appsel="selected='selected'";} else {$appsel="";}               
            }

             //needd for new layout start//
            $data['userid'] = $this->session->userdata('UID');
            $data['userpermissions']=$this->get_user_permissions($data['userid']);
            $muserid= $this->session->userdata('UID');
            $menu = $this->document_model->get_user_menu($muserid);
            $data['pmenu']=$menu[0]['preferred_menu'];
            //$data['approved'] = $appsel; 
            //$data['appby'] = $appby[0]['employee'];
            //$data['owner'] = $owner[0]['employee']; 
            $data['cparty'] = $cparty[0]['contract_name'];
            $data['pagename']='Edit Document';
            $data['pageid']='12';
            $data['submenu'] = 'transactions';
            $data['currentmenu'] = 'transactions';
            $data['currentmodule'] = 'Document';
            $data['title'] = 'Edit Document';
            $data['pagenamepage'] = 'Edit Document';
        //needd for new layout end//

            $won="DOC".$docid;
            $won=strtoupper($won);

        //echo "<script>alert(".$won.");</script>";
            $image = file_get_contents("https://thabiso.tekwani.co.za/capture/barcodewo/".$won);
            file_put_contents("application/barcodes/".$won.".jpg", $image);

            $this->mainMenuBuild();
            $data['menu'] = $this->getMenu('Edit Document','livestockMasterDataPerms');
            $this->load->view('main/header2017v2', $data);       
            $cgroup = $this->document_model->getcpermissiongroup($sUID);
            //echo '<pre>'.print_r($cgroup,true).'</pre>';  exit;
            $data['caccess_perm'] = $cgroup[0]['perm_level'];

            $group = $this->document_model->getpermissiongroup($sUID);
            $data['permission_group'] = $group[0]['permission_group_id'];
            $document = $this->document_model->edit_document($docid);
               if($data['permission_group'] == $document[0]['permission_group'] || $data['caccess_perm'] <=$document[0]['permission_group']){
              $this->load->view('document/edit_document', $data);
             }else {
         redirect('/document/alldocuments');
       }
      }   
      else {
        redirect('/main/permError');
      } 

    }

    function viewdoc() {
      //First check authorisation
      $sUID = $this->session->userdata('UID');
     
      $permCode = '3550';
      if ( $this->checkPerms($sUID, $permCode) ) {
      $uristring=$this->uri->uri_to_assoc();
      $docid =$uristring['docid'];

      //REPOPULATE CATEGORIES START************************************************************************************************
      $selectedcat = $this->document_model->selecteddocumentcategory($docid);
      $allcategories = $this->document_model->selectcategories(); 
        $categorystr = '<option value="0">--Please Select--</option>';
        if(!empty($selectedcat)){ 
          if ( $selectedcat !== "false") {
            foreach ($allcategories as  $value) {
            if($selectedcat[0]['id']==$value['Id']){$farsel="selected='selected'";} else {$farsel="";}
                $categorystr = $categorystr.'<option  '.$farsel.' value="'.$value['Id'].'">'.$value['category'].'</option>'."\n";
                                }
                      if($this->input->post('category')==""){
            } else {
              $category=$this->input->post('category');
              $categorystr = $categorystr.'<option selected value="'.$category.'">'.$category.'</option>'."\n";
            }

            }

        }
      //REPOPULATE CATEGORIES END************************************************************************************************


      //REPOPULATE SUBCATEGORIES START*******************************************************************************************
      $selectedsubcats = $this->document_model->selecteddocumentsubcategory($docid);
      $allsubcategories = $this->document_model->selectsubcategories(); 
        $subcategorystr = '<option value="0">--Please Select--</option>';
        if(!empty($selectedsubcats)){ 
          if ( $selectedsubcats !== "false") {
            foreach ($allsubcategories as  $value) {
            if($selectedsubcats[0]['id']==$value['Id']){$farsel="selected='selected'";} else {$farsel="";}
                $subcategorystr = $subcategorystr.'<option  '.$farsel.' value="'.$value['Id'].'">'.$value['subcategory'].'</option>'."\n";
                                }
                      if($this->input->post('subcategory')==""){
            } else {
              $subcategory=$this->input->post('subcategory');
              $subcategorystr = $subcategorystr.'<option selected value="'.$subcategory.'">'.$subcategory.'</option>'."\n";
            }

            }

           }

      //REPOPULATE CATEGORIES END************************************************************************************************

         //REPOPULATE WORKPLACE START************************************************************************************************
      $selectedwp = $this->document_model->selecteddocumentworkplace($docid);
      $allworkplaces = $this->document_model->selectworkplaces(); 
      
        $workplacestr = '<option value="0">--Please Select--</option>';
        if(!empty($selectedwp)){ 
          if ( $selectedwp !== "false") {
            foreach ($allworkplaces as  $value) {
              //echo '<pre>'.print_r($selectedwp[0]['id'],true).'</pre>';
            if($selectedwp[0]['id']==$value['id']){$farsel="selected='selected'";} else {$farsel="";}
                $workplacestr = $workplacestr.'<option  '.$farsel.' value="'.$value['id'].'">'.$value['region_name'].'</option>'."\n";
                                }
                      if($this->input->post('workplacename')==""){
            } else {
              $workplace=$this->input->post('workplacename');
              $workplacestr = $workplacestr.'<option selected value="'.$workplace.'">'.$workplace.'</option>'."\n";
            }

            }

        }
        
      //REPOPULATE WORKPLACE END************************************************************************************************

      //REPOPULATE DEPARTMENTS START*******************************************************************************************
      $selecteddepart = $this->document_model->selecteddocumentdepartment($docid);
      $alldepartments = $this->document_model->selectdepartments(); 
        $departmentstr = '<option value="0">--Please Select--</option>';
        if(!empty($selecteddepart)){ 
          if ( $selecteddepart !== "false") {
            foreach ($alldepartments as  $value) {
            if($selecteddepart[0]['id']==$value['Id']){$farsel="selected='selected'";} else {$farsel="";}
                $departmentstr = $departmentstr.'<option  '.$farsel.' value="'.$value['Id'].'">'.$value['department_name'].'</option>'."\n";
                                }
                      if($this->input->post('subcategory')==""){
            } else {
              $department=$this->input->post('department');
              $departmentstr = $departmentstr.'<option selected value="'.$department.'">'.$department.'</option>'."\n";
            }

            }

           }

      //REPOPULATE CATEGORIES END************************************************************************************************

      //REPOPULATE PERMISSION GROUP START****************************************************************************************
      $selectedgroup = $this->document_model->selecteddocumentgroup($docid);
       $cgroup = $this->document_model->getcpermissiongroup($sUID);
      
      $allgroups = $this->document_model->selectpermissiongroup($cgroup[0]['perm_level']); 
        $groupstr = '<option value="0">--Please Select--</option>';
        if(!empty($selectedgroup)){ 
          if ( $selectedgroup !== "false") {
            foreach ($allgroups as  $value) {
            if($selectedgroup[0]['id']==$value['id']){$farsel="selected='selected'";} else {$farsel="";}
                $groupstr = $groupstr.'<option  '.$farsel.' value="'.$value['id'].'">'.$value['classification'].'</option>'."\n";
                                }
                      if($this->input->post('group')==""){
            } else {
              $group=$this->input->post('group');
              $groupstr = $groupstr.'<option selected value="'.$group.'">'.$group.'</option>'."\n";
            }

            }

           }


            $data = array(
              'categories' => $categorystr,
             'subcategories' => $subcategorystr,
             'workplaces' => $workplacestr,
             'departments' => $departmentstr,
             'groups' => $groupstr
             
             );
      //REPOPULATE CATEGORIES END************************************************************************************************
            $docowner  = $this->document_model->docowner($sUID);
            $data['docowner'] = $docowner[0]['owner'];
            $data['documents'] = $this->document_model->edit_document($docid);

            /////////////////////////////////////////////////////////////////////////////////////////////////////////////
                $docowner  = $this->document_model->docowner($sUID);

            $data['docowner'] = $this->session->userdata('uName');

            $data['docownerid'] = $sUID;
            $data['documents'] = $this->document_model->edit_document($docid);

            //ADDITIONAL OWNER
            $data['additionaldocowner']  = $this->document_model->docowner($data['documents'][0]['additional_owner']);
            $data['add_docowner']  = $data['additionaldocowner'][0]['owner'];
            //////////////////////////////////////////////////////////////////////////////////////////////////////////////
            
            $data['attachments'] = $this->document_model->edit_attachment($docid);
            $data['links'] = $this->document_model->edit_link($docid);
            //echo '<pre>'.print_r($data['documents'],true).'</pre>';


            $approvedstr = '<option value="0">--Please Select--</option>';


            foreach($data['documents'] as $doc){
              $cparty = $this->document_model->selectedContractor($doc['contracting_party']);
              //$appby = $this->document_model->selectedMan($doc['approved_by']);
              //$owner = $this->document_model->selectedMan($doc['owner']);
              if($doc['approved']==1){$appsel="selected='selected'";} else {$appsel="";} 
              if($doc['password']!=""){true;} else {false;} 
               $data['password_decrypt'] = $this->encrypt->decode($doc['password']);

               if( $data['password_decrypt'] == ""){
                 $data['password_decrypt'] = 'hide';
               }else{
                 $data['password_decrypt'] = 'show';
               }          
            }
            
             //needd for new layout start//
            $data['userid'] = $this->session->userdata('UID');
            $data['userpermissions']=$this->get_user_permissions($data['userid']);
            $muserid= $this->session->userdata('UID');
            $menu = $this->document_model->get_user_menu($muserid);
            $data['pmenu']=$menu[0]['preferred_menu'];
            //$data['approved'] = $appsel; 
            //$data['appby'] = $appby[0]['employee'];
            //$data['owner'] = $owner[0]['employee']; 
            $data['cparty'] = $cparty[0]['contract_name'];
            $data['pagename']='View Document';
            $data['pageid']='12';
            $data['submenu'] = 'transactions';
            $data['currentmenu'] = 'transactions';
            $data['currentmodule'] = 'Document';
            $data['title'] = 'View Document';
            $data['pagenamepage'] = 'View Document';
            
        //needd for new layout end//
            $cgroup = $this->document_model->getcpermissiongroup($sUID);
            $data['caccess_perm'] = $cgroup[0]['perm_level'];

            $this->mainMenuBuild();
            $data['menu'] = $this->getMenu('View Document','livestockMasterDataPerms');
            $this->load->view('main/header2017v2', $data);       
            //echo '<pre>'.print_r($document[0]['permission_group'],true).'</pre>'; exit;
            $group = $this->document_model->getpermissiongroup($sUID);
            $data['permission_group'] = $group[0]['permission_group_id'];
            $document = $this->document_model->edit_document($docid);
            $requested = $this->document_model->checkrequested($sUID,$docid);
               if((($data['permission_group'] == $document[0]['permission_group'] || $requested[0]['requested'] == 1) && $document[0]['super_approve'] != "Unauthorized") || $data['caccess_perm'] <=$document[0]['permission_group']){
              $this->load->view('document/viewdoc', $data);
             }else {
         redirect('/document/alldocuments');
       }

      }   
      else {
        redirect('/main/permError');
      } 

    }

    function checkpass(){
      $docid = $_POST['docid'];
      $pass = $_POST['pass'];
      $data = $this->document_model->getDocpass($docid);
      
      foreach($data as $doc){
               $p = $this->encrypt->decode($doc['password']);
               //echo '<pre>'.print_r($p,true).'</pre>';exit;                       
            }
      if($p == $pass){
         $files = $this->document_model->getfiles($docid);
         $this->output->set_content_type('application/json')->set_output(json_encode($files));
      }else{
      echo "0";
      }
    }


      function edithrdepartment() {
      //First check authorisation
      $sUID = $this->session->userdata('UID');

     
      $permCode = '1280';
      if ( $this->checkPerms($sUID, $permCode) ) {
      $uristring=$this->uri->uri_to_assoc();
      $hrdepartmentid =$uristring['hrdepartment_id'];

      //$data['hrdeparments'] = $this->document_model->edithrdepartment($hrdepartmentid);

      $sfarms = $this->document_model->selectedmanager($hrdepartmentid);


      //$this->out($sfarms);
      $farms = $this->document_model->selectedMan($sfarms[0]['manager']);

      $farms2 = $this->document_model->selectmanagers();

  $farmstr = '<option value="0">--Please Select--</option>';
  if(!empty($farms2)){ 
    if ( $farms2 !== "false") {
      foreach ($farms2 as  $value) {
        //echo '<pre>'.print_r($sfarms[0]['category_id'],true).'</pre>';
        //echo '<pre>'.print_r($value,true).'</pre>'; 
      if($sfarms[0]['manager']===$value['UserID']){$farsel="selected='selected'";} else {$farsel="";}
          $farmstr = $farmstr.'<option  '.$farsel.' value="'.$value['UserID'].'">'.$value['employee'].'</option>'."\n";
                          }
                if($this->input->post('category')==""){
      } else {
        $farm=$this->input->post('category');
        $farmstr = $farmstr.'<option selected value="'.$farm.'">'.$farm.'</option>'."\n";
      }

              }

            }

            $data = array(
             'managers' => $farmstr
             
             );

            $data['hrdepartments'] = $this->document_model->edithrdepartment($hrdepartmentid);
             //needd for new layout start//
            $data['userid'] = $this->session->userdata('UID');
            $data['userpermissions']=$this->get_user_permissions($data['userid']);
            $muserid= $this->session->userdata('UID');
            $menu = $this->document_model->get_user_menu($muserid);
            $data['pmenu']=$menu[0]['preferred_menu'];
   
            $data['pagename']='Edit HR Department';
            $data['pageid']='4';
            $data['submenu'] = 'masterdata';
            $data['currentmenu'] = 'masterdata';
            $data['currentmodule'] = 'Document';
            $data['title'] = 'Edit HR Department';
            $data['pagenamepage'] = 'Edit HR Department';
        //needd for new layout end//

            $this->mainMenuBuild();
            $data['menu'] = $this->getMenu('Edit HR Department','livestockMasterDataPerms');
            $this->load->view('main/header2017v2', $data);       
         

        $this->load->view('document/edithrdepartment', $data);
      }   
      else {
        redirect('/main/permError');
      } 

    }

            
    function deletecategory() {
      //First check authorisation
      $sUID = $this->session->userdata('UID');

     
      $permCode = '3554';
      if ( $this->checkPerms($sUID, $permCode) ) {
          $uristring=$this->uri->uri_to_assoc();
      $id =$uristring['category_id'];
      $datedeleted = date('Y-m-d H:i:s');

     $data = $this->document_model->deletecategory($id,$sUID,$datedeleted);
     if($data===1){
           redirect('document/newcategory', 'refresh');
         }
         else{

          echo "could not delete";
         }
      }   
      else {
        redirect('/main/permError');
      } 
    }


    function deletelink() {
      //First check authorisation
      $sUID = $this->session->userdata('UID');

     
      $permCode = '3551';
      if ( $this->checkPerms($sUID, $permCode) ) {
       $link = $_SERVER['PHP_SELF'];
      $link_array = explode('/',$link);
      $id = end($link_array);;

     $data = $this->document_model->deletelink($id);
     echo $data;
      }   
      else {
        redirect('/main/permError');
      } 
    }

    function delf() {
      //First check authorisation
      $sUID = $this->session->userdata('UID');

     
      $permCode = '3549';
      if ( $this->checkPerms($sUID, $permCode) ) {
       $link = $_SERVER['PHP_SELF'];
      $link_array = explode('/',$link);
      $id = end($link_array);

     $data = $this->document_model->delf($id);
     echo $data;
      }   
      else {
        redirect('/main/permError');
      } 
    }

      function deleteattachment(){  
      $link = $_SERVER['PHP_SELF'];
      $link_array = explode('/',$link);
      $docname = end($link_array);
      //echo '<script>alert('.$docname.');</script>';
      $result = $this->document_model->deleteattachment($docname);
      echo $result;      
    }

    function updatedescription(){  
      $id = $_POST['id'];
      $description = $_POST['description'];
      //echo '<script>alert('.$docname.');</script>';
      $result = $this->document_model->updatedescription($id,$description);
      echo $result;      
    }


    function updatedescription2(){  
      $id = $_POST['id'];
      $description = $_POST['description'];
      //echo '<script>alert('.$docname.');</script>';
      $result = $this->document_model->updatedescription2($id,$description);
      //echo $this->db->last_query();
      echo $result;      
    }

    function deletechosenuser() {
      $link = $_SERVER['PHP_SELF'];
      $link_array = explode('/',$link);
      $typid = end($link_array);
      $userid = $_POST['userid'];
      $groupid = $_POST['groupid'];
      $datedeleted = date('Y-m-d H:i:s');
      $deleted = 1;
      $cuser = $this->session->userdata('UID');
      $data = $this->document_model->deletechosenuser($datedeleted,$userid,$groupid,$cuser,$deleted);
      //echo $this->db->last_query();
      echo $data;
     
    }

      function deletepermissiongroup() {
      //First check authorisation
      $sUID = $this->session->userdata('UID');

     
      $permCode = '1280';
      if ( $this->checkPerms($sUID, $permCode) ) {
          $uristring=$this->uri->uri_to_assoc();
      $id =$uristring['permissiongroup_id'];
      $datedeleted = date('Y-m-d H:i:s');

     $data = $this->document_model->deletepermissiongroup($id,$sUID,$datedeleted);
     if($data===1){
           redirect('document/newpermissiongroup', 'refresh');
         }
         else{

          echo "could not delete";
         }
      }   
      else {
        redirect('/main/permError');
      } 
    }

    function deletetag() {
      //First check authorisation
      $sUID = $this->session->userdata('UID');

     
      $permCode = '1280';
      if ( $this->checkPerms($sUID, $permCode) ) {
          $uristring=$this->uri->uri_to_assoc();
      $id =$uristring['tag_id'];
      $datedeleted = date('Y-m-d H:i:s');

     $data = $this->document_model->deletetag($id,$sUID,$datedeleted);
     if($data===1){
           redirect('document/newtag', 'refresh');
         }
         else{

          echo "could not delete";
         }
      }   
      else {
        redirect('/main/permError');
      } 
    }

        function deleteworkplace() {
      //First check authorisation
      $sUID = $this->session->userdata('UID');

     
      $permCode = '1280';
      if ( $this->checkPerms($sUID, $permCode) ) {
          $uristring=$this->uri->uri_to_assoc();
      $id =$uristring['workplace_id'];
      $datedeleted = date('Y-m-d H:i:s');

     $data = $this->document_model->deleteworkplace($id,$sUID,$datedeleted);
     if($data===1){
           redirect('document/newworkplace', 'refresh');
         }
         else{

          echo "could not delete";
         }
      }   
      else {
        redirect('/main/permError');
      } 
    }


    function deletecontractor() {
      //First check authorisation
      $sUID = $this->session->userdata('UID');

     
      $permCode = '3556';
      if ( $this->checkPerms($sUID, $permCode) ) {
          $uristring=$this->uri->uri_to_assoc();
      $id =$uristring['contractor_id'];
      $datedeleted = date('Y-m-d H:i:s');

     $data = $this->document_model->deletecontractor($id,$sUID,$datedeleted);
     if($data===1){
           redirect('document/newcontractor', 'refresh');
         }
         else{

          echo "could not delete";
         }
      }   
      else {
        redirect('/main/permError');
      } 
    }


    function deletesubcategory() {
      //First check authorisation
      $sUID = $this->session->userdata('UID');

     
      $permCode = '3555';
      if ( $this->checkPerms($sUID, $permCode) ) {
          $uristring=$this->uri->uri_to_assoc();
      $id =$uristring['subcategory_id'];
      $datedeleted = date('Y-m-d H:i:s');

     $data = $this->document_model->deletesubcategory($id,$sUID,$datedeleted);
     if($data===1){
           redirect('document/newsubcategory', 'refresh');
         }
         else{

          echo "could not delete";
         }
      }   
      else {
        redirect('/main/permError');
      } 
    }


      function updatecategories(){
        $newcategory = $_POST['categoryname'];
        $category_id = $_POST['categoryid'];
        $description = $_POST['description'];
        $hascontract = $_POST['hascontract'];
        $createnewcategory = $this->document_model->updatecategories($newcategory,$description,$category_id,$hascontract);
        echo $createnewcategory;
      }

      function updatepermlevel(){
        $level = $_POST['level'];
        $group = $_POST['group'];
        $updatelevel = $this->document_model->updatepermlevel($level,$group);
        echo $updatelevel;
      }
      

      function updatepermissiongroup(){
        $permissiongroupname = $_POST['permissiongroupname'];
        $permissiongroupid = $_POST['permissiongroupid'];
        $description = $_POST['description'];
        $createnewpermissiongroup = $this->document_model->updatepermissiongroup($permissiongroupname,$description,$permissiongroupid);
        echo $createnewpermissiongroup;
      }

    function updatehrdepartment(){
      $hrdepartmentname = $_POST['hrdepartmentname'];
      $hrdepartmentid = $_POST['hrdepartmentid'];
      $description = $_POST['description'];
      $manager = $_POST['manager'];
      $createnewhrdepartment = $this->document_model->updatehrdepartment($hrdepartmentname,$description,$manager,$hrdepartmentid);
      echo $createnewhrdepartment;
      }

      function updatetags(){
        $newtag = $_POST['tagname'];
        $tagid = $_POST['tagid'];
        $createnewtag = $this->document_model->updatetags($newtag,$tagid);
        echo $createnewtag;
      }

       function updateworkplaces(){
        $newworkplace = $_POST['workplacename'];
        $workplaceid = $_POST['workplaceid'];
        $createnewworkplace = $this->document_model->updateworkplaces($newworkplace,$workplaceid);
        echo $createnewworkplace;
      }


      function updatecontractor(){
         $newcontractor = $_POST['contractorname'];
         $contractperson = $_POST['contractperson'];
         $address = $_POST['address'];
         $tel = $_POST['tel'];
         $email = $_POST['email'];
         $contractorid = $_POST['contractorid'];
         $createnewcontractor = $this->document_model->updatecontractor($newcontractor,$contractperson,$address,$tel,$email,$contractorid);
         //echo $this->db->last_query();
         echo $createnewcontractor;
      }

      function updatesubcategory(){
          $newsubcategory = $_POST['subcategoryname'];
           $subcategoryid = $_POST['subcategoryid'];
          $description = $_POST['description'];
          $category_id = $_POST['category'];
          $createnewsubcategory = $this->document_model->updatesubcategories($newsubcategory,$description,$subcategoryid,$category_id);
           //echo $this->db->last_query();  
          echo $createnewsubcategory;
      }

        function savehrimage(){
     $userid = $this->session->userdata('UID');
     $date = new DateTime();
     $tstamp = $date->getTimestamp();
     $newname=$_POST['newname'];
     $filenewname=$newname.'-'.$tstamp;
     $docid=$_POST['docid'];
     $instancename=$_POST['instancename'];
     //$description=$_POST['description'];
     $description=$_POST['originalfilename'];
     $filename=$_POST['newname'];
     $type=$_POST['type'];
     
     //echo '<pre>'.print_r($originalfilename,true).'</pre>';  exit;

     $targetdir = realpath(getenv("DOCUMENT_ROOT")) . '\application\docs\/';
      // name of the directory where the files should be stored
     $ext = preg_match('/[^.]+$/', $newname, $match);
     $password = md5($newname);
     $password2 = md5($newname.'-'.$tstamp).'.'.$match[0];
    
     $config = $this->config->config;    
     $datetimecreated = date('Y-m-d H:i:s');
    $key = $config['encryption_key'];
    //$password = $this->encrypt->encode($msg, $key);

  $targetfile = $targetdir.$password2;
  $name=$_FILES['file']['name'];

  if (move_uploaded_file($_FILES['file']['tmp_name'], $targetfile)) {
    
     $checkexists = $this->document_model->checkpersonimages($docid); 
     //echo '<pre>'.print_r($targetfile,true).'</pre>';  exit;
     //echo "--".$checkexists[0]['count']."--";
     if($checkexists[0]['count']>0){
      //echo "lll";
          $save = $this->document_model->update_image($type, $filenewname,$docid,$userid,$password2,$description,$datetimecreated);
     } else {
          $save = $this->document_model->insert_image($type, $filenewname,$docid,$userid,$password2,$description,$datetimecreated);
     }
     //echo $this->db->last_query();
     echo 1;
  } else { 
    echo 0;
  }
  }

  function getfiledetails(){
    $fileid =  $this->document_model->filedetails(); 
     echo $fileid[0]['encrypt_key'];
    //echo $fileid;
  }

  function getfiledetails2(){
    $fileid =  $this->document_model->filedetails2(); 
     echo $fileid[0]['id'];
   // echo $fileid;
  }

            function viewdocuments() {
       //First check authorisation


       $sUID = $this->session->userdata('UID');

       $permCode = '3550';
       if ( $this->checkPerms($sUID, $permCode) ) {

$group = $this->document_model->getpermissiongroup($sUID);

//echo $this->db->last_query();

     $document = $this->document_model->viewdocument(); //print_r($location);

     $data = array(
          'document'=>$document,

           );

            $cgroup = $this->document_model->getcpermissiongroup($sUID);
            //echo '<pre>'.print_r($cgroup,true).'</pre>';  exit;
            $data['caccess_perm'] = $cgroup[0]['perm_level'];

            $data['permission_group'] = $group[0]['permission_group_id'];
                //needd for new layout start//
            $data['userid'] = $this->session->userdata('UID');
            $data['userpermissions']=$this->get_user_permissions($data['userid']);
            $muserid= $this->session->userdata('UID');
            $menu = $this->document_model->get_user_menu($muserid);
            $data['pmenu']=$menu[0]['preferred_menu'];
   
             $data['pagename']='View Documents';
            $data['pageid']='12';
            $data['submenu'] = 'transactions';
            $data['currentmenu'] = 'transactions';
            $data['currentmodule'] = 'Document';
            $data['title'] = 'View Documents';
            $data['pagenamepage'] = 'View Documents';
        //needd for new layout end//

             $this->mainMenuBuild();
            $data['menu'] = $this->getMenu('View Documents','livestockPerms');
             $this->load->view('main/header2017v2', $data);



         $this->load->view('document/viewdocument', $data);
       }
       else {
         redirect('/main/permError');
       }

     }


      function viewunprocessed() {
       //First check authorisation


       $sUID = $this->session->userdata('UID');

       $permCode = '3553';
       if ( $this->checkPerms($sUID, $permCode) ) {

$group = $this->document_model->getpermissiongroup($sUID);

//echo $this->db->last_query();

     $document = $this->document_model->allunprocesseddocuments(); //print_r($location);

     $data = array(
          'document'=>$document,

           );

            $cgroup = $this->document_model->getcpermissiongroup($sUID);
            //echo '<pre>'.print_r($cgroup,true).'</pre>';  exit;
            $data['caccess_perm'] = $cgroup[0]['perm_level'];

            $data['permission_group'] = $group[0]['permission_group_id'];
                //needd for new layout start//
            $data['userid'] = $this->session->userdata('UID');
            $data['userpermissions']=$this->get_user_permissions($data['userid']);
            $muserid= $this->session->userdata('UID');
            $menu = $this->document_model->get_user_menu($muserid);
            $data['pmenu']=$menu[0]['preferred_menu'];
   
             $data['pagename']='View Access Requests';
            $data['pageid']='14';
            $data['submenu'] = 'transactions';
            $data['currentmenu'] = 'transactions';
            $data['currentmodule'] = 'Document';
            $data['title'] = 'View Access Requests';
            $data['pagenamepage'] = 'View Access Requests';
        //needd for new layout end//

             $this->mainMenuBuild();
            $data['menu'] = $this->getMenu('View Access Requests','livestockPerms');
             $this->load->view('main/header2017v2', $data);



         $this->load->view('document/unprocessed', $data);
       }
       else {
         redirect('/main/permError');
       }

     }

      function alldocumentsummary() {

      $sUID = $this->session->userdata('UID');
      $userinfo = $this->document_model->checkUserID($sUID);
      $millprefix=$userinfo['Prefix'];
      $mill=$userinfo['Department'];

      $permCode = '3552';
     // $this->out($_POST);
      if ( $this->checkPerms($sUID, $permCode) ) {
      $view = $this->uri->segment(3);

      $cgroup = $this->document_model->getcpermissiongroup($sUID);
      
    
    $cgroup2 = $this->document_model->getcpermissiongroup($sUID);
    $params['docownerid'] = $sUID;
      $params['caccess_perm2'] = $cgroup2[0]['perm_level'];
      $text = (isset($_POST['searchtext']) ? $_POST['searchtext'] : "");

    if(isset($_POST['searchtext'])){
     //echo "<script>alert('thabi');</script>";
      $results2 = $this->document_model->forestry_plantation_all_filter2($text,$params['caccess_perm2']);
    }else{ 
      $results2 = $this->document_model->alldocuments('all');
      
    }

    $params['records'] = $results2; 

   
      $totalArea = 0;
      $effArea = 0;     
      $params['totalRows'] = count($params['records']);
      $params['currentmodule']='Documents';
      $params['showfilter']='true';
      $params['title']='Documents - View All';  
      $data['userid'] = $this->session->userdata('UID');
      $params['userpermissions']=$this->get_user_permissions($data['userid']);

      $data['username'] = $this->session->userdata('uName');

      $muserid= $this->session->userdata('UID');
   
      //Has group permission
      $cgroup = $this->document_model->getcpermissiongroup($sUID);
      $params['caccess_perm'] = $cgroup[0]['perm_level'];
      //echo '<pre>'.print_r($params['caccess_perm'],true).'</pre>';exit;
      $group = $this->document_model->getpermissiongroup($sUID);
      $newarray = array();
      if(is_array($group)){
        foreach ($group as $value) {
        $newarray[] = $value['permission_group_id'];
      }
      $params['access_perm'] = $newarray;
    }else{
      $params['access_perm'] = array();
    }

      //has document permission
      $group2 = $this->document_model->getpermissiondocument($sUID);
      $newarray2 = array();
      if(is_array($group2)){
         foreach ($group2 as $value2) {
        $newarray2[] = $value2['doc_id'];
      }
      
      }

  //TOP DATATABLE
  $group = $this->document_model->getpermissiongroup($sUID);

//echo $this->db->last_query();

            $document = $this->document_model->alldocumentsummary($text); //print_r($location);
            $noseg = $this->document_model->getsegcount();
            $nodep = $this->document_model->getdepcount();
            $norev = $this->document_model->getrevcount();

            
            
            

            $data = array(
          'document'=>$document,
           );

            $cgroup = $this->document_model->getcpermissiongroup($sUID);
            //echo '<pre>'.print_r($cgroup,true).'</pre>';  exit;
            $data['records'] = $results2;
            $data['caccess_perm'] = $cgroup[0]['perm_level'];
            $data['segcount'] = $noseg[0]['noseg'];
            $data['depcount'] = $nodep[0]['nodep'];
            $data['revcount'] = $norev[0]['reviewdates'];
            $data['permission_group'] = $group[0]['permission_group_id'];
  //TOP DATATABLE END

     $params['access_perm2'] = $newarray2;
      //$params['requested'] = $this->document_model->checkrequested($sUID);
      //echo '<pre>'.print_r($newarray,true).'</pre>';exit;
     //needd for new layout start//
        $data['userid'] = $this->session->userdata('UID');
        $data['userpermissions']=$this->get_user_permissions($data['userid']);
        $muserid= $this->session->userdata('UID');
        $menu = $this->document_model->get_user_menu($muserid);
        $params['pmenu']=$menu[0]['preferred_menu'];

        $params['pagename']='Documents Summary';
        $params['pageid']='15';
        $params['submenu'] = 'transactions';
        $params['currentmenu'] = 'transactions';
        $params['currentmodule'] = 'Document';
        $params['title'] = 'Documents Summary';
        $params['pagenamepage'] = 'Documents Summary';
        //needd for new layout end//

        $this->mainMenuBuild();

      $params['currentmenu']='transactions';
      $this->load->view('main/header2017v2', $params);
      $this->load->view('document/alldocumentsummarys',$data);   
    }
    else {
      //redirect('/sales/permError');
       redirect('/capture/permError');
    }

     }


      function outstanding_documentation(){

    $sUID = $this->session->userdata('UID');

    $userinfo = $this->document_model->checkUserID($sUID);

    $millprefix=$userinfo['Prefix'];

    $mill=$userinfo['Department'];


      $iterator = new FilesystemIterator('application/newdocs/');

      foreach($iterator as $fileInfo){

          if($fileInfo->isFile()){

              $date = new DateTime();

              $tstamp = $date->getTimestamp();             

              $doc=$fileInfo->getFileName();

              $filenewname=$doc.'-'.$tstamp;


              //GET FILE EXTENSION

              $ext = preg_match('/[^.]+$/', $doc, $match);

              $encryptedfilename = md5($filenewname).'.'.$match[0];

              ///************************************************************

              $targetdir = realpath(getenv("DOCUMENT_ROOT")) . '\application\docs\/';

 

              //*************************************************************

              $docid = str_replace("DOC","",$doc);

              $p1 = strrpos($docid,"-");

              $subdocid = substr($docid, 0, $p1);

             

              $p = strrpos($docid,"_");

              $tr = substr_replace($subdocid, "", $p, -1);

              $date = date('Y-m-d H:i:s');

 

              $inserttss= $this->document_model->insertssdate($subdocid,$filenewname,$date,$encryptedfilename);

              //Copy file from one folder to another

              $srcfile='application/newdocs/'.$doc;

              $dstfile='application/docs/'.$encryptedfilename;

              //echo '<pre>'.print_r($srcfile,true).'</pre>';  exit;

              if(!file_exists($dstfile)){

              copy($srcfile, $dstfile);

              unlink($srcfile);

              }            

          }

      }  

  }


  function print_document() 
  {

    $this->load->helper('url');
    $sUID = $this->session->userdata('UID');
    $permCode = '3549';
    if ( $this->checkPerms($sUID, $permCode) ) {
        $get = $this->uri->uri_to_assoc(); 
        $this->load->library('Pdf');
        $won="DOC".$get['dn'];
        $won=strtoupper($won);

        //echo "<script>alert(".$won.");</script>";
        $image = file_get_contents("https://thabiso.tekwani.co.za/capture/barcodewo/".$won);
        file_put_contents("application/barcodes/".$won.".jpg", $image);

        $data['header'] = $this->document_model->get_document_header($get['dn']);
        //echo $this->db->last_query();
        //echo '<pre>'.print_r($data['header'],true).'</pre>';  exit;
        $url='application/libraries/dompdf/dompdf_config.inc.php';
        
        require_once($url);
        $this->load->view('document/print_document',$data);


    //load view end
    } else {
      redirect('/sales/permError');
    }
  }




  ///*****************************************************************************************************************************
    function alldocuments (){ 

      $sUID = $this->session->userdata('UID');
      $userinfo = $this->document_model->checkUserID($sUID);
      $millprefix=$userinfo['Prefix'];
      $mill=$userinfo['Department'];

      $permCode = '3550';

        //$sUID = $this->session->userdata('UID');
     if($sUID != ""){
        $cgroup = $this->document_model->getcpermissiongroup($sUID);
      }else{
        redirect('/main/permError');
      }
     //echo '<pre>'.print_r($cgroup,true).'</pre>';exit;
     if(!is_array($cgroup) || !$this->checkPerms($sUID, '3550')){
      echo "<script>alert('You do not have Permission to view documents');</script>";
      redirect('/main/permError');
     }
     // $this->out($_POST);
      if ( $this->checkPerms($sUID, $permCode) ) {
      $view = $this->uri->segment(3);

      $cgroup = $this->document_model->getcpermissiongroup($sUID);
      
      //Get all for each filter
      $params['categories']  = $this->document_model->selectcategories();
      $params['subcategories']  = $this->document_model->selectsubcategories();
      $params['departments']  = $this->document_model->selectdepartments();
      $params['workplaces']  = $this->document_model->selectworkplaces();     
      $params['permissiongroups']  = $this->document_model->selectpermissiongroup($cgroup[0]['perm_level']);
      $params['authorizations']  = $this->document_model->selectauthorization();
      $params['segments']  = $this->document_model->selectsegments();
      
      $pda = array();
      $fda = array();
      $bda = array();
      $gda = array();
      $sda = array();
      $ada = array();
      $sgda = array();

      $pda2 = array();
      $fda2 = array();
      $bda2 = array();
      $gda2 = array();
      $sda2 = array();
      $ada2 = array();
      $sgda2 = array();

      if(is_array($params['categories'])){
        foreach ($params['categories'] as $key => $value) {
        $pda2[$value['Id']] = $value['category']; 
      } 
      }
    
    if(is_array($params['subcategories'])){
        foreach ($params['subcategories'] as $key => $value) {
          $fda2[$value['Id']] = $value['subcategory'];
      }
    }

    if(is_array($params['departments'])){
        foreach ($params['departments'] as $key => $value) {
          $bda2[$value['Id']] = $value['department_name'];
      }
    }

    if(is_array($params['segments'])){
        foreach ($params['segments'] as $key => $value) {
          $sgda2[$value['id']] = $value['segment'];
      }
    }

    if(is_array($params['workplaces'])){
        foreach ($params['workplaces'] as $key => $value) {
          $gda2[$value['id']] = $value['region_name'];
      }
    }

    if(is_array($params['permissiongroups'])){
        foreach ($params['permissiongroups'] as $key => $value) {
          $sda2[$value['id']] = $value['classification'];
      }
    }

      
if(is_array($params['authorizations'])){
      foreach ($params['authorizations'] as $key => $value) {
          $ada2[] = $value['Auth'];
      }
    }

      $text = (isset($_POST['searchtext']) ? $_POST['searchtext'] : "");
      
      //echo '<pre>'.print_r($text,true).'</pre>';exit;

      if(isset($_POST['categoryDrop']) && !empty($_POST['categoryDrop'])){
        $categoryDrop = $_POST['categoryDrop'];
        $pfilter = 1;
      }else{
        $categoryDrop = array();
        $pfilter = 0;
      }

      if(isset($_POST['subcategoryDrop']) && !empty($_POST['subcategoryDrop'])){
        $subcategoryDrop = $_POST['subcategoryDrop'];
        $ffilter = 1;
      }else{
        $subcategoryDrop = array();
        $ffilter = 0;
      }
      if(isset($_POST['segmentDrop']) && !empty($_POST['segmentDrop'])){
        $segmentDrop = $_POST['segmentDrop'];
        $sgfilter = 1;
      }else{
        $segmentDrop = array();
        $sgfilter = 0;
      }
      if(isset($_POST['departmentDrop']) && !empty($_POST['departmentDrop'])){
        $departmentDrop = $_POST['departmentDrop'];
        $bfilter = 1;
      }else{
        $departmentDrop = array();
        $bfilter = 0;
      }
      if(isset($_POST['workplaceDrop']) && !empty($_POST['workplaceDrop'])){
        $workplaceDrop = $_POST['workplaceDrop'];
        $gfilter = 1;
      }else{
        $workplaceDrop = array();
        $gfilter = 0;
      }
      if(isset($_POST['permissiongroupDrop']) && !empty($_POST['permissiongroupDrop'])){
        $permissiongroupDrop = $_POST['permissiongroupDrop'];
        $sfilter = 1;
      }else{
        $permissiongroupDrop = array();
        $sfilter = 0;
      }
      if(isset($_POST['authorizationDrop']) && !empty($_POST['authorizationDrop'])){
        $authorizationDrop = $_POST['authorizationDrop'];
        $afilter = 1;
      }else{
        $authorizationDrop = array();
        $afilter = 0;
      }
      if(isset($_POST['columnDrop']) && !empty($_POST['columnDrop'])){
        $columnDrop = $_POST['columnDrop'];
        $cfilter = 1;
      }else{
        $columnDrop = array(
                0 => 'Category',
                1=> 'Subcategory',
                2 => 'Department',
                3 => 'Workplace',
                4 => 'Document No.',
                5 => 'Renewal Date',
                6 => 'Action'
            );
        $cfilter = 0;
      }
      if(isset($_POST['rowdisplayed'])){
      $filter = 1;//$_POST['rowdisplayed'];
    }else{
      $filter = 0;
}
    
    $cgroup2 = $this->document_model->getcpermissiongroup($sUID);
    $params['docownerid'] = $sUID;
      $params['caccess_perm2'] = $cgroup2[0]['perm_level'];
    //echo "<script>alert(".$categoryDrop.");</script>";
    //echo '<pre>'.print_r($categoryDrop,true).'</pre>';
    if((isset($categoryDrop) && !empty($categoryDrop)) || (isset($subcategoryDrop) && !empty($subcategoryDrop)) || (isset($departmentDrop) && !empty($departmentDrop)) || (isset($workplaceDrop) && !empty($workplaceDrop)) || (isset($permissiongroupDrop) && !empty($permissiongroupDrop)) || (isset($authorizationDrop) && !empty($authorizationDrop)) || (isset($segmentDrop) && !empty($segmentDrop))){
     //echo "<script>alert('thabi');</script>";
      $results2 = $this->document_model->forestry_plantation_all_filter(implode("','",$categoryDrop), implode("','",$subcategoryDrop),implode("','",$departmentDrop), implode("','",$workplaceDrop), implode("','",$permissiongroupDrop), implode("','",$authorizationDrop),$text,$params['caccess_perm2'],implode("','",$segmentDrop));
    }else{ 
      //echo "<script>alert('so');</script>";
      $results2 = $this->document_model->alldocuments('');
    }

    $excludeArray = array('category'
              ,'subcategory',
              'department_name',
              'group_name',
              'workplace',
              'renewal_date',
              'id');
    //  $results2 = $this->document_model->forestry_plantation_all_filter(implode("','",$categoryDrop), implode("','",$subcategoryDrop),implode("','",$departmentDrop), implode("','",$workplaceDrop), implode("','",$permissiongroupDrop) , implode("','",$authorizationDrop),$text);

     //echo '<pre>'.print_r($results2,true).'</pre>';exit;
    $params['records'] = $results2; 

    if(isset($results2) && !empty($results2)){
      foreach($results2[0] as $key => $value){  
        if(!in_array($key, $excludeArray)){   
            $columnDropAll[] = ucfirst (str_replace('_',' ',$key));         
          }
              
        }
    }

      $totalArea = 0;
      $effArea = 0;     
      $params['totalRows'] = count($params['records']);
      $params['currentmodule']='Documents';
      $params['showfilter']='true';
      $params['title']='Documents - View All';  
      $data['userid'] = $this->session->userdata('UID');
      $params['userpermissions']=$this->get_user_permissions($data['userid']);

      $data['username'] = $this->session->userdata('uName');
      //$params['pageid']='2';
      //$params['submenu'] = 'transactions';
      //$params['currentmenu'] = 'transactions';
      $muserid= $this->session->userdata('UID');
      //$menu = $this->document_model->get_user_menu($muserid);
      //$params['pmenu']=$menu[0]['preferred_menu'];
      //$data['pagename']='View Documents';

    // Insert the views
  
      if(isset($columnDropAll) && !empty($columnDropAll)){
        $params['columnDrop'] = $this->buildFilterDropv2($columnDropAll, $columnDrop,'columnDrop', $cfilter);
        $params['columnNames'] = $columnDropAll;  
        $params['columnNamesAll'] = $columnDropAll;   
      }

      $params['categoryDrop'] = $this->buildFilterDropv2($pda2,$categoryDrop,'categoryDrop', $pfilter);
      $params['subcategoryDrop'] = $this->buildFilterDropv2($fda2,$subcategoryDrop,'subcategoryDrop', $ffilter);
      $params['departmentDrop'] = $this->buildFilterDropv2($bda2,$departmentDrop,'departmentDrop', $bfilter);
      $params['workplaceDrop'] = $this->buildFilterDropv2($gda2,$workplaceDrop,'workplaceDrop', $gfilter);
      $params['permissiongroupDrop'] = $this->buildFilterDropv2($sda2,$permissiongroupDrop,'permissiongroupDrop', $sfilter);
      $params['authorizationDrop'] = $this->buildFilterDropv3($ada2,$authorizationDrop,'authorizationDrop', $afilter);
      $params['segmentDrop'] = $this->buildFilterDropv2($sgda2,$segmentDrop,'segmentDrop', $sgfilter);
      $params['filter'] = $filter;

      //Has group permission
      $cgroup = $this->document_model->getcpermissiongroup($sUID);
      $params['caccess_perm'] = $cgroup[0]['perm_level'];
      //echo '<pre>'.print_r($params['caccess_perm'],true).'</pre>';exit;
      $group = $this->document_model->getpermissiongroup($sUID);
      $newarray = array();
      if(is_array($group)){
        foreach ($group as $value) {
        $newarray[] = $value['permission_group_id'];
      }
      $params['access_perm'] = $newarray;
    }else{
      $params['access_perm'] = array();
    }
      


      //has document permission
      $group2 = $this->document_model->getpermissiondocument($sUID);
      $newarray2 = array();
      if(is_array($group2)){
         foreach ($group2 as $value2) {
        $newarray2[] = $value2['doc_id'];
      }
      
      }
     $params['access_perm2'] = $newarray2;
      //$params['requested'] = $this->document_model->checkrequested($sUID);
      //echo '<pre>'.print_r($newarray,true).'</pre>';exit;
     //needd for new layout start//
        $data['userid'] = $this->session->userdata('UID');
        $data['userpermissions']=$this->get_user_permissions($data['userid']);
        $muserid= $this->session->userdata('UID');
        $menu = $this->document_model->get_user_menu($muserid);
        $params['pmenu']=$menu[0]['preferred_menu'];

        $params['pagename']='View Documents';
        $params['pageid']='12';
        $params['submenu'] = 'transactions';
        $params['currentmenu'] = 'transactions';
        $params['currentmodule'] = 'Document';
        $params['title'] = 'View Documents';
        $params['pagenamepage'] = 'View Documents';
        //needd for new layout end//

        $this->mainMenuBuild();

      $params['currentmenu']='transactions';
      $this->load->view('main/header2017v2', $params);
      $this->load->view('document/forestry_plantation_all2',$data);   
    }
    else {
      //redirect('/sales/permError');
       redirect('/capture/permError');
    }
 
    }

     function buildFilterDropv2($array_info, $post_array, $dropName, $filter){
      $onclck = '';
      if($dropName == 'segmentDrop'){
          $onclck = "onchange='getdepartments(this.value)'";
      }else if($dropName == 'categoryDrop'){
        $onclck = "onchange='getsubcategories(this.value)'";
      }
        $dropstr = '<select  data-selected-text-format="count>1" '.$onclck.'  data-count-selected-text= "{0} items"   class="selectpicker" multiple data-live-search="true" data-live-search-placeholder="Search" data-actions-box="true" data-selected-text-format="count>3" data-width="auto" data-hide-disabled="false" data-dropup-auto="false" data-style="btn-inverse" data-mobile="false" data-show-subtext="true" multiple="multiple" class="'.$dropName.'s" id="'.$dropName.'" name="'.$dropName.'[]">';
       //echo '<pre>'.print_r($post_array,true).'</pre>';
        foreach ($array_info as $key => $value) {
          if($value != ''){
             if($filter==1){
              if(in_array($key, $post_array)){
                      $selected="selected='selected'"; 
                  } else {
                      $selected='';
                  }
              } else {        
                $selected="selected='selected'";    
              }
              if(strlen($value)> 21){
                $value = substr($value, 0, 21)."...";
              }
              if($value == 'All'){
                $style = "style='display:none'";
              }else{
                $style = '';
                $dropstr = $dropstr.'<option '.$style.' '.$selected.'value="'.$key.'">'.$value.'</option>'."\n";
              } 
                        
          }
        }
        $dropstr .= '</select>';
        return $dropstr;
    }

    function buildFilterDropv3($array_info, $post_array, $dropName, $filter){
        $dropstr = '<select  data-selected-text-format="count>1"  data-count-selected-text= "{0} items"   class="selectpicker" multiple data-live-search="true" data-live-search-placeholder="Search" data-actions-box="true" data-selected-text-format="count>3" data-width="auto" data-hide-disabled="false" data-dropup-auto="false" data-style="btn-inverse" data-mobile="false" data-show-subtext="true" multiple="multiple" class="'.$dropName.'s" id="'.$dropName.'" name="'.$dropName.'[]">';
        
       //echo '<pre>'.print_r($array_info,true).'</pre>';exit;
        foreach ($array_info as $key => $value) {
          if($value != ''){
             if($filter==1){
              if(in_array($value, $post_array)){
                      $selected="selected='selected'"; 
                  } else {
                      $selected='';
                  }
              } else {

              if($value == 'Approved'){
          $selected="selected='selected'";
        }else{
          $selected='';
        }        
                    
              }
              if(strlen($value)> 21){
                $value = substr($value, 0, 21)."...";
              } 
              $dropstr = $dropstr.'<option '.$selected.'value="'.$value.'">'.$value.'</option>'."\n";          
          }
        }
        $dropstr .= '</select>';
        return $dropstr;
    }

    function requestaccess(){
      $docid = $_POST['docid'];
      $docname = $_POST['docname'];
      $description = $_POST['description'];
      $userid = $this->session->userdata('UID');
      $requestdate = date('Y-m-d H:i:s');
      $processed = 0;
      $allow_unique_key = md5($user.$docid.$requestdate.'allow');
      $deny_unique_key = md5($user.$docid.$requestdate.'deny');
      $createnewrequest = $this->document_model->requestaccess($userid,$docid,$requestdate,$processed,$allow_unique_key,$deny_unique_key);
           //echo $this->db->last_query(); 
          //testemailsmtp(); 
    $this->load->library('email');
 
    $this->email->from('notifications@tekwani.co.za', 'Tekwani IMS - Access Request');
    $this->email->to('thabisongubane1992@gmail.com');
 
    $cuser = $this->session->userdata('uName');
    $this->email->subject('Request Access');
    $this->email->message($cuser.' wants access to '.$docname.','.$description.'<br><a href="'.base_url().'document/processemailrequest/'.$allow_unique_key.'">Accept</a>'.' or '.'<a href="'.base_url().'document/processemailrequest/'.$deny_unique_key.'">Deny</a>');
    //$this->email->attach($file);
   
     if ($this->email->send()) {
      echo "success";
    } else {
      echo "fail";
      echo $this->email->print_debugger();
    }

  }

  function processemailrequest(){
    $link = $_SERVER['PHP_SELF'];
      $link_array = explode('/',$link);
      $status = end($link_array);

      $checkstat = $this->document_model->checkstatus($status);
      $response = $checkstat;
      //echo $this->db->last_query();
      $field =($response == 1 ? 'allowed_unique_key' : 'deny_unique_key');

      $docdetails = $this->document_model->docdetails($status,$field);
      //echo $this->db->last_query();
      //$response = $checkstat;
      $datetimecreated = date('Y-m-d H:i:s');
      if($response == 1){
        $giveaccess = $this->document_model->giveaccess($docdetails[0]['doc_id'],$docdetails[0]['user_id'],1,$datetimecreated,0);
      }
      $processed = 1;
      $responsedate = date('Y-m-d H:i:s');
      $responsetype = 1;
      $response_by = $this->session->userdata('UID');
      $resp = $this->document_model->acceptdeny($response,$processed,$responsedate,$responsetype,$status,$field,$response_by);
      redirect('/document/viewunprocessed');    
  }


  function processemailrequest2(){
    $link = $_SERVER['PHP_SELF'];
      $link_array = explode('/',$link);
      $status = end($link_array);

      $checkstat = $this->document_model->checkstatus($status);
      $response = $checkstat;
      //echo $this->db->last_query();
      $field =($response == 1 ? 'allowed_unique_key' : 'deny_unique_key');

      $docdetails = $this->document_model->docdetails($status,$field);
      //echo $this->db->last_query();
      //$response = $checkstat;
      $datetimecreated = date('Y-m-d H:i:s');
      if($response == 1){
        $giveaccess = $this->document_model->giveaccess($docdetails[0]['doc_id'],$docdetails[0]['user_id'],1,$datetimecreated,0);
      }
      $processed = 1;
      $responsedate = date('Y-m-d H:i:s');
      $responsetype = 2;
      $response_by = $this->session->userdata('UID');
      $resp = $this->document_model->acceptdeny($response,$processed,$responsedate,$responsetype,$status,$field,$response_by);
      redirect('/document/viewunprocessed'); 
  }


  function updatedocviewlogs(){
    $sUID = $this->session->userdata('UID');
    $permCode = '3550';
    $docid = $_POST['docid'];
    $datetimecreated = date('Y-m-d H:i:s');
    $createdby = $this->session->userdata('UID');
    $cgroup = $this->document_model->getcpermissiongroup($sUID);
    $perm = $cgroup[0]['perm_level'];
    $fileid = (isset($_POST['fileid']) ? $_POST['fileid'] : '');
    $table = (isset($_POST['fileid']) ? 'document_fileview_log' : 'document_docview_log');

     //echo $farm;exit;            
    
    if ( $this->checkPerms($sUID, $permCode) ) {
        $doclog = $this->document_model->updatedocviewlogs($datetimecreated,$createdby,$docid,$perm,$fileid,$table);
        //echo $this->db->last_query();
             echo $doclog;
       }else {
echo 0;
    }
  }

  function hasCon(){
    

      $link = $_SERVER['PHP_SELF'];
      $link_array = explode('/',$link);
      $id = end($link_array);

        $res = $this->document_model->hasCon($id);
        echo $res[0]['has_contract'];
     
  }

  function conid(){

      $link = $_SERVER['PHP_SELF'];
      $link_array = explode('/',$link);
      $id = end($link_array);

      $res = $this->document_model->conid($id);
      echo $res[0]['id'];
     //echo $this->db->last_query();
  }

  function getAlldepartments(){
   $all = $this->document_model->getalldepartments();
   //echo $this->db->last_query();
   foreach($all as $key => $value){
      $return_value[$value['Id']] = $value['department_name'];     
    }
    header('Content-Type: application/x-json; charset=utf-8');
    echo(json_encode($return_value));
  }
}

?>
