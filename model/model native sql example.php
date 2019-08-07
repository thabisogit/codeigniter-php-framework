<?php
// (Array of Strings)
class Ls_model extends MY_Model{



function selectsexreports(){

           $sql =("
  SELECT DISTINCT sex

FROM         dbo.ls_master 

  ");

          // echo $this->db->last_query();
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }
  
 function get_user_menu($user_id){
      // Required for the versioning screen
      // Get all assoc parents for a compartment
      $sql = $this->db->query("  
SELECT [preferred_menu]  FROM [thabiso].[dbo].[Users] where [userid] =$user_id
");
     // echo $this->db->last_query();
      if($sql->num_rows() > 0){
        return $sql->result_array();
      }else{
        return false;
      }
  }


function selectsourcereports(){

           $sql =("
  SELECT DISTINCT source

FROM         dbo.ls_master 

  ");

          // echo $this->db->last_query();
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }
function selecttypesreports(){

           $sql =("
  SELECT  DISTINCT dbo.ls_master.type_id,  dbo.ls_type.type_name

FROM         dbo.ls_master INNER JOIN

                      dbo.ls_type ON dbo.ls_master.type_id = dbo.ls_type.type_id 

  ");

          // echo $this->db->last_query();
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }


  function selecttypes(){

           $sql =("select type_id,type_name from ls_type");

          // echo $this->db->last_query();
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }

function selectlocationssreports(){

           $sql =("
  SELECT  DISTINCT dbo.ls_master.location_id,  dbo.ls_location.location_name

FROM         dbo.ls_master INNER JOIN

                      dbo.ls_location ON dbo.ls_master.location_id = dbo.ls_location.location_id 

  ");

          // echo $this->db->last_query();
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }

function selectbreedsreports(){

           $sql =("
  SELECT  DISTINCT dbo.ls_master.breed_id,  dbo.ls_breed.breed_name

FROM         dbo.ls_master INNER JOIN

                      dbo.ls_breed ON dbo.ls_master.breed_id = dbo.ls_breed.breed_id 

  ");

          // echo $this->db->last_query();
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }

  function selectvperiods(){

           $sql =("select id,name from ls_VaccinSchedules");

          // echo $this->db->last_query();
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }
function getallbreeds(){

           $sql =("
  SELECT   DISTINCT dbo.ls_master.breed_id,  dbo.ls_breed.breed_name

FROM         dbo.ls_master INNER JOIN

                      dbo.ls_breed ON dbo.ls_master.breed_id = dbo.ls_breed.breed_id 

  ");

          // echo $this->db->last_query();
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }
  function getbreedname($id){

           $sql =("
 SELECT 
      [breed_name]
  FROM [thabiso].[dbo].[ls_breed]
  WHERE breed_id='$id'
  ");

          // echo $this->db->last_query();
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }


 
  function editbreedsusingtype($type){

           $sql =("
 SELECT [breed_id]
      ,[breed_name]
  FROM [thabiso].[dbo].[ls_breed]
  WHERE type_id='$type'
  ");

          // echo $this->db->last_query();
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }
    else
    {
      return false;
    }

  }


  function viewcat(){

           $sql =("
                    SELECT dbo.ls_location.location_name,   dbo.ls_breed.breed_name, dbo.ls_type.type_name,

lm.breed_id,lm.location_id,

(select count(*) from ls_master where location_id=lm.location_id and breed_id=lm.breed_id and type_id=lm.type_id and sex='female') female,
(select count(*) from ls_master where location_id=lm.location_id and breed_id=lm.breed_id and type_id=lm.type_id and sex='male') male,
count(*) total

  FROM         dbo.ls_master  lm
    JOIN
                        dbo.ls_breed ON dbo.ls_breed.breed_id = lm.breed_id 
             JOIN
                        dbo.ls_type ON dbo.ls_breed.type_id = dbo.ls_type.type_id
             JOIN
                        dbo.ls_location ON dbo.ls_location.location_id = lm.location_id
  GROUP BY dbo.ls_breed.breed_name, dbo.ls_type.type_name,location_name
  ,lm.breed_id,lm.location_id,lm.type_id
  
  
  
                         ");

          // echo $this->db->last_query();
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }

      function getLocationPrefix($id){

           $sql =("
 SELECT forestry_farm.animal_prefix FROM ls_herd LEFT JOIN ls_camp ON ls_herd.camp_id = ls_camp.camp_id LEFT JOIN forestry_farm ON ls_camp.farm_id = forestry_farm.farm_id WHERE herd_id = $id
  ");

          // echo $this->db->last_query();
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }



   function deletetables()
  {
 $query = "
  delete from  [thabiso].[dbo].[ls_disposal_reasons]
 
  ";

   if($this->db->query($query)){
    return 1;
   } else {
    return 0;
   }
}
function changemotherstatus($mother){
$query = "
 UPDATE [thabiso].[dbo].[ls_pregnancy]
   SET [status] = 'Successful'
             
 WHERE [tag] = '$mother'";

   if($this->db->query($query)){


    return 1;
   } else {
    return 0;
   }
}

function sickanimal($tagold,$updatedby){
   $query = "
 UPDATE [thabiso].[dbo].[ls_master]
   SET [status] = 'Sick',
        [updatedby] = '$updatedby'
     
 WHERE [master_id] = '$tagold'";

   if($this->db->query($query)){
    return 1;
   } else {
    return 0;
   }
}
function healanimal($tagold,$updatedby){
   $query = "
 UPDATE [thabiso].[dbo].[ls_master]
   SET [status] = 'Alive',
        [updatedby] = '$updatedby'
     
 WHERE [master_id] = '$tagold'";

   if($this->db->query($query)){
    return 1;
   } else {
    return 0;
   }
}



    function getactualoffsprings($tag,$dob){

           $sql =("
                      SELECT count(*)
                FROM   dbo.ls_master
                          WHERE [details_of_parents_mother]='$tag' AND [dob]='$dob'
                         ");

          // echo $this->db->last_query();
    $results = $this->db->query($sql);
//echo $this->db->last_query();
    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }
  function getoffsprings($tag){

           $sql =("
                      SELECT *
                FROM   dbo.ls_master
                          WHERE [details_of_parents_mother]='$tag'
                         ");

          // echo $this->db->last_query();
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }


  function getuom($id){

           $sql =("
                      SELECT uom,feed_id
                FROM   dbo.ls_feed
                          WHERE [feed_id]='$id'
                         ");

          // echo $this->db->last_query();
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }

function getpregtests($tag){

           $sql =("
 select one.tag,one.offspringQTY expected,duedate,offspring actualoff,v.asset_vendor_name,dateoftest,fatherdetails,status,ai,multiplefathers,faileddate,failedreason from (

SELECT

      p.[tag],

      p.preg_id  ,p.status

         ,p.dateoftest   

      ,[offspringQTY]

         ,p.fatherdetails
          ,p.multiplefathers
          ,p.ai
,p.faileddate
,p.failedreason
      ,[duedate]

         ,p.asset_vendor_id vendor

         ,DATEADD(month, -t.[pregnancy_window], p.duedate) mindate, DATEADD(month, +t.[pregnancy_window], p.duedate)maxdate

  FROM [thabiso].[dbo].[ls_pregnancy] p

  join ls_master m

                           on m.tag=p.tag
  join ls_type t

on m.type_id=t.type_id

  ) one join

  (

select p.preg_id,count(m.dob) offspring

from [thabiso].[dbo].[ls_pregnancy] p


left join (

select m.tag,m.details_of_parents_mother,t.pregnancy_window,m.dob from ls_master m

 join ls_type t

on m.type_id=t.type_id) m

on m.details_of_parents_mother=p.tag

and m.dob between DATEADD(month, -m.[pregnancy_window], p.duedate) and  DATEADD(month, +m.[pregnancy_window], p.duedate)

  

       group by preg_id

) two

on one. preg_id=two.preg_id

join assets_vendors v on v.asset_vendor_id=one.vendor

where one.tag = '$tag' 
                         ");

          // echo $this->db->last_query();
    $results = $this->db->query($sql);
   // echo $this->db->last_query();

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }
  function get_customersv1($q){
    $query = $this->db->query("
SELECT dbo.ls_master.*, dbo.ls_type.type_name, dbo.ls_breed.breed_name, dbo.ls_location.location_name

FROM ls_master
JOIN dbo.ls_location ON dbo.ls_master.location_id = dbo.ls_location.location_id 
JOIN dbo.ls_type ON dbo.ls_master.type_id = dbo.ls_type.type_id 
JOIN dbo.ls_breed ON dbo.ls_master.breed_id = dbo.ls_breed.breed_id 
WHERE  tag  LIKE '%".$q."%' AND [status]!='Disposed'");

   echo $this->db->last_query();
    if($query->num_rows > 0){
        foreach ($query->result_array() as $row){
            $row_set[] = htmlentities(stripslashes($row['tag']));
                   }
        $this->output->set_content_type('application/json')->set_output(json_encode($row_set));
    } 
  }


  function get_validtag($q){
    $query = $this->db->query("SELECT tag FROM ls_master WHERE  tag  LIKE '%".$q."%' AND [status]!='Disposed'");

   //echo $this->db->last_query();
    if($query->num_rows > 0){
        foreach ($query->result_array() as $row){
            $row_set[] = htmlentities(stripslashes($row['tag']));
                   }
        $this->output->set_content_type('application/json')->set_output(json_encode($row_set));
    } 
  }

   function checkTagfather($tagid,$details_of_parents_fatherid){

        $sql =(" SELECT*
  FROM [thabiso].[dbo].[ls_master]
  WHERE  [status] != 'Disposed' AND [tag]  = '$details_of_parents_fatherid'
  ");

          
    $results = $this->db->query($sql);
//echo $this->db->last_query();
    if($results->num_rows() > 0)
    {
      return 1;
    }

    else
    {
      return 0;
    }



  }

 function checkTagMotherid($tagid,$details_of_parents_motherid){

        $sql =("
 SELECT*
  FROM [thabiso].[dbo].[ls_master]
  WHERE [type_id] = '$tagid' AND [status] != 'Disposed' AND [tag] = '$details_of_parents_motherid'
  ");

          
    $results = $this->db->query($sql);
//echo $this->db->last_query();
    if($results->num_rows() > 0)
    {
      return 1;
    }

    else
    {
      return 0;
    }



  }

   function pregtags($q){
    $query = $this->db->query("
SELECT dbo.ls_master.*, dbo.ls_type.type_name, dbo.ls_breed.breed_name, dbo.ls_camp.camp_name

FROM ls_master
JOIN dbo.ls_camp ON dbo.ls_master.location_id = dbo.ls_camp.camp_id 
JOIN dbo.ls_type ON dbo.ls_master.type_id = dbo.ls_type.type_id 
JOIN dbo.ls_breed ON dbo.ls_master.breed_id = dbo.ls_breed.breed_id 
WHERE  tag  IN(SELECT ls_pregnancy.tag FROM ls_pregnancy where ls_pregnancy.tag LIKE '%".$q."%' AND ls_pregnancy.status = 'Pregnant') AND [sex] ='Female' AND [status]!='Disposed'");

   //echo $this->db->last_query();
    if($query->num_rows > 0){
        foreach ($query->result_array() as $row){
            $row_set[] = htmlentities(stripslashes($row['tag']));
                   }
        $this->output->set_content_type('application/json')->set_output(json_encode($row_set));
    } 
  }

  

  function checkTagExistsPreg($tagid){

        $sql =("
 SELECT*,(SELECT [status]
  FROM [thabiso].[dbo].[ls_pregnancy]
  WHERE [tag] = '$tagid' AND  [status] = 'Pregnant') preg
  FROM [thabiso].[dbo].[ls_master]
  WHERE  [status] != 'Disposed' AND [tag] = '$tagid'
  and version = (select max(version) from ls_master)
  ");

          
    $results = $this->db->query($sql);
echo $this->db->last_query();
    if($results->num_rows() > 0)
    {
      return 1;
    }

    else
    {
      return 0;
    }



  }
  function checkTagExists($tagid){

        $sql =("
 SELECT*
  FROM [thabiso].[dbo].[ls_master]
  WHERE [tag] = '$tagid'
  ");

          
    $results = $this->db->query($sql);
//echo $this->db->last_query();
    if($results->num_rows() > 0)
    {
      return 1;
    }

    else
    {
      return 0;
    }



  }


  function checkexists($rn,$table){

        $sql =("
 SELECT *
  FROM $table
  WHERE [rn] = '$rn'
  ");

          
    $results = $this->db->query($sql);
//echo $this->db->last_query();
    if($results->num_rows() > 0)
    {
      return 1;
    }

    else
    {
      return 0;
    }



  }




  function checkexists2($rn){

        $sql =("
 SELECT*
  FROM [thabiso].[dbo].[ls_feed_issuing]
  WHERE [rn] = '$rn'
  ");

          
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return 1;
    }

    else
    {
      return 0;
    }



  }

     function getfathers($q){
    $query = $this->db->query("
SELECT dbo.ls_master.*, dbo.ls_type.type_name, dbo.ls_breed.breed_name, dbo.ls_location.location_name

FROM ls_master
left JOIN dbo.ls_location ON dbo.ls_master.location_id = dbo.ls_location.location_id 
left JOIN dbo.ls_type ON dbo.ls_master.type_id = dbo.ls_type.type_id 
left JOIN dbo.ls_breed ON dbo.ls_master.breed_id = dbo.ls_breed.breed_id 
WHERE  tag  LIKE '%".$q."%' AND [sex] ='Male' AND [status] !='Disposed'");

   // echo $this->db->last_query();
    if($query->num_rows > 0){
        foreach ($query->result_array() as $row){
            $row_set[] = htmlentities(stripslashes($row['tag']));
                   }
        $this->output->set_content_type('application/json')->set_output(json_encode($row_set));
    } 
  }

function gettagdetails($tag){

           $sql =("
SELECT dbo.ls_master.*, dbo.ls_type.type_name, dbo.ls_breed.breed_name, dbo.ls_location.location_name

FROM ls_master
JOIN dbo.ls_location ON dbo.ls_master.location_id = dbo.ls_location.location_id 
JOIN dbo.ls_type ON dbo.ls_master.type_id = dbo.ls_type.type_id 
JOIN dbo.ls_breed ON dbo.ls_master.breed_id = dbo.ls_breed.breed_id
  WHERE [tag] = '$tag'
  ");

         
    $results = $this->db->query($sql);
    //echo $this->db->last_query();

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }

   function GetMillFromCustomer($q){
    $query = $this->db->query("
SELECT dbo.ls_master.*, dbo.ls_type.type_name, dbo.ls_breed.breed_name, dbo.ls_camp.camp_name

FROM ls_master
LEFT JOIN dbo.ls_camp ON dbo.ls_master.location_id = dbo.ls_camp.camp_id 
LEFT JOIN dbo.ls_type ON dbo.ls_master.type_id = dbo.ls_type.type_id 
LEFT JOIN dbo.ls_breed ON dbo.ls_master.breed_id = dbo.ls_breed.breed_id 
WHERE  tag  LIKE '%".$q."%' and status = 'Alive'");

   //echo $this->db->last_query();
    if($query->num_rows > 0){
        foreach ($query->result_array() as $row){

            $row_set[] = htmlentities(stripslashes($row['type_name']));
              $row_set[] = htmlentities(stripslashes($row['sex']));
              $row_set[] = htmlentities(stripslashes($row['breed_name']));
                $row_set[] = htmlentities(stripslashes($row['type_id']));
                   }
        $this->output->set_content_type('application/json')->set_output(json_encode($row_set));
    } 
  }
  function editbreedss($breedsid){

           $sql =("
 SELECT        dbo.ls_breed.*, dbo.ls_type.type_name
FROM            dbo.ls_type INNER JOIN
                         dbo.ls_breed ON dbo.ls_type.type_id = dbo.ls_breed.type_id
  WHERE [breed_id] = '$breedsid'
  ");

         
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }

function saveeditnewanimaldisposed($tag){
   $query = "
 UPDATE [thabiso].[dbo].[ls_master]
   SET [status] = 'Disposed'
     
 WHERE [tag] = '$tag'";

   if($this->db->query($query)){
    return 1;
   } else {
    return 0;
   }
}
function saveeditnewanimalundisposed($tagold){
   $query = "
 UPDATE [thabiso].[dbo].[ls_master]
   SET [status] = 'Alive'
     
 WHERE [tag] = '$tagold'";

   if($this->db->query($query)){
    return 1;
   } else {
    return 0;
   }
}



   function saveeditdisposal($id,$tag,$disposal_id,$date,$price,$reason_id,$createdby){
   $query = "
 UPDATE [dbo].[ls_disposal_animals]
   SET[disposal_id] = '$disposal_id'
      ,[date] = '$date'
      ,[price] = '$price'
      ,[reason_id] = '$reason_id'
      ,[updatedby] = '$createdby'
      ,[tag]='$tag'
      ,[dateupdated] = getdate()
       WHERE [disposalanimalid]='$id'";


      

   if($this->db->query($query)){

   // echo $this->db->last_query();
    return 1;
   } else {
    return 0;
   }
 }

  function saveeditpreganimal($ai,$mfather,$id,$asset_vendor_id,$tag,$dateoftest,$offspringQTY,$duedate,$createdby,$datetimecreated,$fatherdetails,$status,$updatedby){
   $query = "
 UPDATE [dbo].[ls_pregnancy]
   SET[dateoftest] = '$dateoftest'
      ,[asset_vendor_id] = '$asset_vendor_id'
      ,[offspringQTY] = '$offspringQTY'
      ,[duedate] = '$duedate'
      ,[updatedby] = '$createdby'
      ,[dateupdated] = getdate()
      ,[fatherdetails] = '$fatherdetails'
      ,[status] = '$status'
      ,[tag] = '$tag'
      ,[ai] = '$ai'
      ,[multiplefathers] = '$mfather'
      
      WHERE [preg_id]='$id'";


      

   if($this->db->query($query)){
   // echo $this->db->last_query();
    return 1;
   } else {
    return 0;
   }
}
 function savefailedpregnancy($updatedby,$dateoftest,$tag,$reason){
   $query = "
 UPDATE [dbo].[ls_pregnancy]
   SET
      [updatedby] = '$updatedby'
      ,[dateupdated] = getdate()
      ,[faileddate] = '$dateoftest' 
      ,[status] = 'Failed' 
      ,[failedreason] = '$reason'         
      WHERE [tag]='$tag'";


      

   if($this->db->query($query)){
  //echo $this->db->last_query();
    return 1;
   } else {
    return 0;
   }
}



    function vieweditdisposal($tagid){

           $sql =("
SELECT dbo.ls_disposal_animals.*, dbo.ls_disposal_reasons.reason_type, dbo.ls_disposal_types.disposal_type 
FROM dbo.ls_disposal_animals 
LEFT JOIN dbo.ls_disposal_reasons ON dbo.ls_disposal_animals.reason_id = dbo.ls_disposal_reasons.reason_id 
LEFT JOIN dbo.ls_disposal_types ON dbo.ls_disposal_animals.disposal_id = dbo.ls_disposal_types.disposal_id 
 WHERE [disposalanimalid]='$tagid'
                         ");

          
    $results = $this->db->query($sql);
//echo $this->db->last_query();
    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }

  function vieweditpregnancy($tag){

           $sql =("
 SELECT        dbo.ls_type.type_name, dbo.ls_breed.breed_name, dbo.ls_location.location_name, dbo.ls_master.*, dbo.assets_vendors.asset_vendor_name
FROM            dbo.ls_master LEFT JOIN
                         dbo.ls_location ON dbo.ls_master.location_id = dbo.ls_location.location_id LEFT JOIN
                         dbo.ls_type ON dbo.ls_master.type_id = dbo.ls_type.type_id LEFT JOIN
                         dbo.ls_breed ON dbo.ls_master.breed_id = dbo.ls_breed.breed_id LEFT JOIN
                         dbo.assets_vendors ON dbo.ls_master.asset_vendor_id = dbo.assets_vendors.asset_vendor_id
                          WHERE [tag]='$tag'
                         ");

          // echo $this->db->last_query();
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }
  function vieweditpregnancyv1($tagid){

           $sql =("
SELECT        dbo.Users.UserName, dbo.assets_vendors.asset_vendor_name, dbo.ls_pregnancy.*
FROM            dbo.ls_pregnancy INNER JOIN
                         dbo.assets_vendors ON dbo.ls_pregnancy.asset_vendor_id = dbo.assets_vendors.asset_vendor_id INNER JOIN
                         dbo.Users ON dbo.ls_pregnancy.UserID = dbo.Users.UserID
                          WHERE [preg_id]='$tagid'
                         ");

          // echo $this->db->last_query();
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }



   function vieweditanimals($tagid){

           $sql =("SELECT     distinct   dbo.ls_master.*, dbo.ls_type.type_name, dbo.ls_breed.breed_name, dbo.ls_camp.camp_name
FROM            dbo.ls_master INNER JOIN
                         dbo.ls_camp ON dbo.ls_master.camp = dbo.ls_camp.camp_id INNER JOIN
                         dbo.ls_type ON dbo.ls_master.type_id = dbo.ls_type.type_id INNER JOIN
                         dbo.ls_breed ON dbo.ls_master.breed_id = dbo.ls_breed.breed_id
             WHERE [tag] ='$tagid' and version = 
        (select max(version) from ls_master st where st.tag = '$tagid')");

         // echo $this->db->last_query();
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }


function vieweditanimalshistory($tagid){

           $sql =("SELECT        dbo.ls_master.*, dbo.ls_type.type_name, dbo.ls_breed.breed_name, dbo.ls_camp.camp_name
FROM            dbo.ls_master INNER JOIN
                         dbo.ls_camp ON dbo.ls_master.camp = dbo.ls_camp.camp_id INNER JOIN
                         dbo.ls_type ON dbo.ls_master.type_id = dbo.ls_type.type_id INNER JOIN
                         dbo.ls_breed ON dbo.ls_master.breed_id = dbo.ls_breed.breed_id
             WHERE [tag] ='$tagid' order by version desc");

         // echo $this->db->last_query();
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }


  function addnewanimalv1($statusid,$typeid,$sourcename,$tagid,$locationid,$purid,$sexid,$commentsid,$dobid,$dateid,$breedid,$details_of_parents_father,$details_of_parents_mother,$vetid){
   $query = "
  INSERT INTO [thabiso].[dbo].[ls_master]
           ([status]
           ,[source]
           ,[date]
           ,[dob]
           ,[type_id]
           ,[breed_id]
           ,[purchase_price]
           ,[details_of_parents_mother]
           ,[details_of_parents_father]
           ,[sex]
           ,[comments]
           ,[location_id]
           ,[tag],[asset_vendor_id])
     VALUES
           ('$statusid'
           ,'$sourcename'
           ,'$dateid'
           ,'$dobid'
           ,'$typeid'
           ,'$breedid'
           ,'$purid'
           ,'$details_of_parents_mother'
           ,'$details_of_parents_father'
           ,'$sexid'
           ,'$commentsid'
           ,'$locationid','$tagid','$vetid')";

   if($this->db->query($query)){
    return 1;
   } else {
    return 0;
   }
}


  function addnewanimal2($value,$typeid,$sexid,$breedid,$locationid,$herddescription,$camp,$campid,$vetid,$tagid,$details_of_parents_mother,$details_of_parents_father,$dob,$purchase_price,$commentsid,$dateid,$createdby,$ai,$mfather,$weight,$version){
   $query = "Insert into ls_master([source],[type_id],[sex],[breed_id],[location_id],[herd_description] ,[camp],[asset_vendor_id]
            ,[status],[date],[tag],[details_of_parents_mother],[details_of_parents_father],[dob],[purchase_price],[comments]
           ,[createdby],[datecreated],[ai]
            ,[multiplefathers]
            ,[weight]
            ,[version])

select yt.herd_id,$value,$typeid,$sexid,$breedid,$locationid,$herddescription,$camp,$campid,$vetid,$tagid,$details_of_parents_mother,$details_of_parents_father,$dob,$purchase_price,$commentsid,$dateid,$createdby,$ai,$mfather,$weight,$version,yt.version+1
   from ls_master yt
    where version = 
        (select max(version) from ls_master st where yt.tag=$tagid)";
//echo $this->db->last_query();
   if($this->db->query($query)){
    return 1;
   } else {
    return 0;
   }
}


 function saveeditnewanimal($weight,$id,$statusid,$typeid,$sourcename,$tagid,$locationid,$purid,$sexid,$commentsid,$dobid,$dateid,$breedid,$details_of_parents_father,$details_of_parents_mother,$vetid,$updatedby){
   $query = "
 UPDATE [thabiso].[dbo].[ls_master]
   SET [status] = '$statusid'
      ,[source] = '$sourcename'
      ,[date] = '$dateid'
      ,[dob] = '$dobid'
      ,[type_id] = '$typeid'
      ,[breed_id] =  '$breedid'
      ,[purchase_price] = '$purid'
      ,[details_of_parents_mother] = '$details_of_parents_mother'
      ,[details_of_parents_father] = '$details_of_parents_father'
      ,[sex] = '$sexid'
      ,[comments] = '$commentsid'
      ,[location_id] = '$locationid'
      ,[asset_vendor_id] ='$vetid'
      ,[tag] = '$tagid'
      ,[weight] = '$weight'
      ,[updatedby] ='$updatedby'
      ,[dateupdated] = getdate()      
 WHERE [master_id] = '$id'";

   if($this->db->query($query)){
    return 1;
   } else {
    return 0;
   }
}


 function addnewanimalVersion($weight,$id,$statusid,$typeid,$sourcename,$tagid,$locationid,$purid,$sexid,$commentsid,$dobid,$dateid,$breedid,$details_of_parents_father,$details_of_parents_mother,$vetid,$updatedby){
   $query = "Insert into ls_master([status],[source],[date],[dob],[type_id],[breed_id] ,[purchase_price],[details_of_parents_mother]
            ,[details_of_parents_father],[sex],[comments],[location_id],[asset_vendor_id],[tag],[weight],[updatedby]
           ,[dateupdated],[version],[createdby],[datecreated],[herd_description],[camp],[ai],[multiplefathers])

select '$statusid','$sourcename','$dateid','$dobid','$typeid','$breedid','$purid','$details_of_parents_mother','$details_of_parents_father','$sexid','$commentsid','$locationid','$vetid','$tagid','$weight','$updatedby',getdate(),yt.version+1,'$updatedby',getdate(),(select herd_description from ls_master yt
    where version = 
        (select max(version) from ls_master st where yt.tag='$tagid')),(select camp from ls_master yt
    where version = 
        (select max(version) from ls_master st where yt.tag='$tagid')),(select ai from ls_master yt
    where version = 
        (select max(version) from ls_master st where yt.tag='$tagid')),(select multiplefathers from ls_master yt
    where version = 
        (select max(version) from ls_master st where yt.tag='$tagid'))
   from ls_master yt
    where version = 
        (select max(version) from ls_master st where yt.tag='$tagid')";
//echo $this->db->last_query();
   if($this->db->query($query)){
    return 1;
   } else {
    return 0;
   }
}

  function addnewanimal($value,$typeid,$sexid,$breedid,$locationid,$herddescription,$camp,$campid,$vetid,$tagid,$details_of_parents_mother,$details_of_parents_father,$dob,$purchase_price,$commentsid,$dateid,$createdby,$ai,$mfather,$weight,$version){
    $query = "BEGIN TRANSACTION ";
        $query.="
  INSERT INTO [thabiso].[dbo].[ls_master]
           ([source]
            ,[type_id]
            ,[sex]
            ,[breed_id]
            ,[location_id]
            ,[herd_description]
            ,[camp]
            ,[asset_vendor_id]
            ,[status]
            ,[date]
            ,[tag]
            ,[details_of_parents_mother]
           ,[details_of_parents_father]
           ,[dob]
           ,[purchase_price]
           ,[comments]
           ,[createdby]
            ,[datecreated]
            ,[ai]
            ,[multiplefathers]
            ,[weight]
            ,[version]
           )
     VALUES
           ('$value'
            ,'$typeid'
            ,'$sexid'
            ,'$breedid'
            ,'$locationid'
            ,'$herddescription'
            ,'$campid'
            ,'$vetid'
            ,'Alive'
            ,'$dateid'
            ,'$tagid'
            ,'$details_of_parents_mother'
           ,'$details_of_parents_father'
           ,'$dob'
           ,'$purchase_price'
           ,'$commentsid'
           ,'$createdby'
           ,getdate()
           ,'$ai'
           ,'$mfather'
           ,'$weight'
           ,'$version'
           );";
        $query.="UPDATE [thabiso].[dbo].[ls_pregnancy] SET [status] = 'Successful' WHERE [tag] = '$tagid';";        
        $query.=" COMMIT";

   

   if($this->db->query($query)){
    //echo $this->db->last_query();
    return 1;
   } else {
    return 0;
   }
}

   function viewpregnancy(){

           $sql =("
 SELECT        dbo.Users.UserName, dbo.assets_vendors.asset_vendor_name, dbo.ls_pregnancy.*
FROM            dbo.ls_pregnancy INNER JOIN
                         dbo.assets_vendors ON dbo.ls_pregnancy.asset_vendor_id = dbo.assets_vendors.asset_vendor_id INNER JOIN
                         dbo.Users ON dbo.ls_pregnancy.UserID = dbo.Users.UserID
                          WHERE [status] = 'Pregnant'
                         ");

          // echo $this->db->last_query();
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }

   function viewpregnancyall($typefilter,$filter){
    if($filter==0){$typewhere='';} else {
 

  $typewhere="and [asset_vendor_name] in ($typefilter)";

}


           $sql =("
 SELECT        dbo.Users.UserName, dbo.assets_vendors.asset_vendor_name, dbo.ls_pregnancy.*
FROM            dbo.ls_pregnancy LEFT JOIN
                         dbo.assets_vendors ON dbo.ls_pregnancy.asset_vendor_id = dbo.assets_vendors.asset_vendor_id LEFT JOIN
                         dbo.Users ON dbo.ls_pregnancy.UserID = dbo.Users.UserID
                          WHERE [status] = 'Pregnant' $typewhere
                         ");

          // echo $this->db->last_query();
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }

 function viewdisposalsall($typefilter,$filter){
  if($filter==0){$typewhere='';} else {
 

  $typewhere="WHERE [disposal_type] in ($typefilter)";

}

           $sql =("
 SELECT dbo.ls_disposal_animals.*, dbo.ls_disposal_reasons.reason_type, dbo.ls_disposal_types.disposal_type 
 FROM dbo.ls_disposal_animals 
 LEFT JOIN dbo.ls_disposal_reasons ON dbo.ls_disposal_animals.reason_id = dbo.ls_disposal_reasons.reason_id 
 LEFT JOIN dbo.ls_disposal_types ON dbo.ls_disposal_animals.disposal_id = dbo.ls_disposal_types.disposal_id
 $typewhere

 ");

          
    $results = $this->db->query($sql);
    //echo $this->db->last_query();
    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }
  function viewdisposals(){

           $sql =("
 SELECT dbo.ls_disposal_animals.*, dbo.ls_disposal_reasons.reason_type, dbo.ls_disposal_types.disposal_type 
 FROM dbo.ls_disposal_animals 
 LEFT JOIN dbo.ls_disposal_reasons ON dbo.ls_disposal_animals.reason_id = dbo.ls_disposal_reasons.reason_id 
 LEFT JOIN dbo.ls_disposal_types ON dbo.ls_disposal_animals.disposal_id = dbo.ls_disposal_types.disposal_id");

          // echo $this->db->last_query();
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }

    function viewanimalswithouturi($breedfilter,$greateroff,$numoff,$greater,$num,$sectionfilter,$filter,$sourcefilter,$locationfilter,$typefilter){
     if($filter==0){$sectionwhere='';} else {
 

  $sectionwhere="and [sex] in ($sectionfilter)";

}   
  if($filter==0){$sourcewhere='';} else {
 

  $sourcewhere="and [source] in ($sourcefilter)";

}  if($filter==0){$locationwhere='';} else {
 

  $locationwhere="and [location_name] in ($locationfilter)";

}

 if($filter==0){$breedwhere='';} else {
 

  $breedwhere="and [breed_name] in ($breedfilter)";

}
if($filter==0){$typewhere='';} else {
 

  $typewhere="and [type_name] in ($typefilter)";

}
 if($num==0){$offwhere='';} else {
 

  $offwhere="where failed $greater $num";

}
 if($numoff==0){$offwheres='';} else {
 

  $offwheres="where offspring $greateroff $numoff";

}
           $sql =("

  select * from
 (
 select lu.*, lo.offspringQTY, lo.duedate 
from (
 SELECT dbo.ls_type.type_name, thabiso.dbo.ls_breed.breed_name,
    dbo.ls_location.location_name, dbo.ls_master.*, dbo.assets_vendors.asset_vendor_name, ls_master.dob dob2
  FROM thabiso.dbo.ls_master
  LEFT JOIN thabiso.dbo.ls_location ON dbo.ls_master.location_id = dbo.ls_location.location_id 
  LEFT JOIN thabiso.dbo.ls_type ON dbo.ls_master.type_id = dbo.ls_type.type_id 
  LEFT JOIN dbo.ls_breed ON thabiso.dbo.ls_master.breed_id = dbo.ls_breed.breed_id 
  LEFT JOIN dbo.assets_vendors ON dbo.ls_master.asset_vendor_id = dbo.assets_vendors.asset_vendor_id
  WHERE ls_master.status !='Disposed'  $locationwhere $sourcewhere $sectionwhere $typewhere $breedwhere ) lu 
  left join
   ( SELECT tag, max(duedate) duedate, max(offspringQTY) offspringQTY 
   FROM thabiso.[dbo].ls_pregnancy  i
    WHERE status = 'Pregnant' GROUP BY tag  ) lo
    on lu.tag=lo.tag
    ) t
    left join 
    (
     select details_of_parents_mother mothertag,count(tag) offspring,max(dob) dob
    FROM thabiso.[dbo].[ls_master] one
    group by details_of_parents_mother
    ) qty
   on t.tag=qty.mothertag
    left join 
    (
    select tag getd, count(tag) failed,max(faileddate) failedd
    FROM thabiso.[dbo].[ls_pregnancy] one
  where [status]='Failed' 
  group by tag
    ) f

   on t.tag=f.getd
$offwhere
$offwheres
 ");

        
    $results = $this->db->query($sql);
 // echo $this->db->last_query();
   

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }


   function viewanimals($herdid,$typefilter,$breedfilter,$sourcefilter,$sexfilter){

    //echo '<pre>'.print_r($gender,true).'</pre>';exit;

     if($herdid == ''){$herdwhere='';} else {
 

  $herdwhere="and ls_master.location_id in ('$herdid')";

}   
  if($sourcefilter == ''){$sourcewhere='';} else {
 

  $sourcewhere="and [source] in ('$sourcefilter')";

}

if($typefilter==''){$typewhere='';} else {
 

  $typewhere="and ls_master.type_id in ('$typefilter')";

}

if($sexfilter==''){$sexwhere='';} else {
 

  $sexwhere="and [sex] in ('$sexfilter')";

}


 
           $sql =("

  select * from
 (
 select lu.*, lo.offspringQTY, lo.duedate 
from (
 SELECT dbo.ls_type.type_name, thabiso.dbo.ls_breed.breed_name,
    dbo.ls_location.location_name, dbo.ls_master.*, dbo.assets_vendors.asset_vendor_name, ls_master.dob dob2
  FROM thabiso.dbo.ls_master
  LEFT JOIN thabiso.dbo.ls_location ON dbo.ls_master.location_id = dbo.ls_location.location_id 
  LEFT JOIN thabiso.dbo.ls_type ON dbo.ls_master.type_id = dbo.ls_type.type_id 
  LEFT JOIN dbo.ls_breed ON thabiso.dbo.ls_master.breed_id = dbo.ls_breed.breed_id 
  LEFT JOIN dbo.assets_vendors ON dbo.ls_master.asset_vendor_id = dbo.assets_vendors.asset_vendor_id
  WHERE ls_master.status !='Disposed' and ls_master.breed_id='$breedfilter' $herdwhere  $sourcewhere $sexwhere $typewhere ) lu 
  left join
   ( SELECT tag, max(duedate) duedate, max(offspringQTY) offspringQTY 
   FROM thabiso.[dbo].ls_pregnancy  i
    WHERE status = 'Pregnant' GROUP BY tag  ) lo
    on lu.tag=lo.tag
    ) t
    left join 
    (
     select details_of_parents_mother mothertag,count(tag) offspring,max(dob) dob
    FROM thabiso.[dbo].[ls_master] one
    group by details_of_parents_mother
    ) qty
   on t.tag=qty.mothertag
    left join 
    (
    select tag getd, count(tag) failed,max(faileddate) failedd
    FROM thabiso.[dbo].[ls_pregnancy] one
  where [status]='Failed' 
  group by tag
    ) f

   on t.tag=f.getd

 ");

        
    $results = $this->db->query($sql);
  //echo $this->db->last_query();
   

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }

  function viewanimalsv1($sectionfilter,$filter,$sourcefilter,$typefilter,$locationfilter){
     if($filter==0){$sectionwhere='';} else {
 

  $sectionwhere="and [sex] in ($sectionfilter)";

}    if($filter==0){$typewhere='';} else {
 

  $typewhere="and [type_name] in ($typefilter)";

} 
  if($filter==0){$sourcewhere='';} else {
 

  $sourcewhere="and [source] in ($sourcefilter)";

}  if($filter==0){$locationwhere='';} else {
 

  $locationwhere="and [location_name] in ($locationfilter)";

}
 
           $sql =("select lu.*, lo.offspringQTY, lo.duedate from ( 
SELECT dbo.ls_type.type_name, dbo.ls_breed.breed_name,dbo.ls_location.location_name, dbo.ls_master.*, dbo.assets_vendors.asset_vendor_name 
FROM dbo.ls_master 
LEFT JOIN dbo.ls_location ON dbo.ls_master.location_id = dbo.ls_location.location_id 
LEFT JOIN dbo.ls_type ON dbo.ls_master.type_id = dbo.ls_type.type_id 
LEFT JOIN dbo.ls_breed ON dbo.ls_master.breed_id = dbo.ls_breed.breed_id 
LEFT JOIN dbo.assets_vendors ON dbo.ls_master.asset_vendor_id = dbo.assets_vendors.asset_vendor_id 
WHERE ls_master.status ='Alive' $sectionwhere $typewhere $sourcewhere $locationwhere ) lu 
left join
 ( SELECT * FROM thabiso.[dbo].ls_pregnancy  i  WHERE [status]   ='Pregnant' ) lo
  on lu.tag=lo.tag  ");

        
    $results = $this->db->query($sql);
    //echo $this->db->last_query();

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }

  function viewanimalsall(){
    
 
           $sql =("
 SELECT top 20 dbo.ls_type.type_name,ls_type.type_id, dbo.ls_breed.breed_name, dbo.ls_breed.breed_id,dbo.ls_location.location_name, dbo.ls_master.*, dbo.assets_vendors.asset_vendor_name
FROM            dbo.ls_master LEFT JOIN
                         dbo.ls_location ON dbo.ls_master.location_id = dbo.ls_location.location_id LEFT JOIN
                         dbo.ls_type ON dbo.ls_master.type_id = dbo.ls_type.type_id LEFT JOIN
                         dbo.ls_breed ON dbo.ls_master.breed_id = dbo.ls_breed.breed_id LEFT JOIN
                         dbo.assets_vendors ON dbo.ls_master.asset_vendor_id = dbo.assets_vendors.asset_vendor_id

               WHERE ls_master.status ='Alive'  
                         ");

        
    $results = $this->db->query($sql);
    //echo $this->db->last_query();

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }

function viewvendorss(){

           $sql =("
 SELECT [asset_vendor_id]
      ,[asset_vendor_name]
  FROM [thabiso].[dbo].[assets_vendors]
  ORDER BY [asset_vendor_name] ASC
  ");

          // echo $this->db->last_query();
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }


  function addnewpreganimal($ai,$mfather,$tag,$dateoftest,$vet,$offspringQTY,$duedate,$createdby,$datetimecreated,$fatherdetails,$status){
   $query = "
  INSERT INTO [thabiso].[dbo].[ls_pregnancy]
           ([tag]
           ,[dateoftest]
           ,[asset_vendor_id]
           ,[offspringQTY]
           ,[duedate]
           ,[UserID]
           ,[datetimecreated]
           ,[fatherdetails]
           ,[status]
           ,[multiplefathers]
           ,[ai]

           )
     VALUES
           ('$tag'
           ,'$dateoftest'
           ,'$vet'
           ,'$offspringQTY'
           ,'$duedate' 
           ,'$createdby'
           ,'$datetimecreated'
           ,'$fatherdetails'
           ,'$status'
           ,'$mfather'
           ,'$ai'


           )";

   if($this->db->query($query)){

    //echo $this->db->last_query();
    return 1;
   } else {
    return 0;
   }
}


  function addnewcamp($campname,$farm,$description,$datetimecreated,$createdby){
   $query = "
  INSERT INTO [thabiso].[dbo].[ls_camp]
           ([camp_name]
           ,[farm_id]
           ,[description]
           ,[date_created]
           ,[created_by]

           )
     VALUES
           ('$campname'
           ,'$farm'
           ,'$description'
           ,'$datetimecreated'
           ,'$createdby'
           )";
//echo $this->db->last_query();
   if($this->db->query($query)){

    //echo $this->db->last_query();
    return 1;
   } else {
    return 0;
   }
}


function addnewvaccineschedule($schedulename,$vaccineperiod,$gender,$type,$breed,$datetimecreated,$createdby){
   $query = "
  INSERT INTO [thabiso].[dbo].[ls_VaccineSchedules]
           ([Name]
           ,[VaccinePeriod]
           ,[Gender]
           ,[Animal_type]
           ,[Breed]
           ,[datecreated]
           ,[createdby]
           )
     VALUES
           ('$schedulename'
           ,'$vaccineperiod'
           ,'$gender'
           ,'$type'
           ,'$breed'
           ,'$datetimecreated'
           ,'$createdby'
           )";

   if($this->db->query($query)){
    //echo $this->db->last_query();
    return 1;
   } else {
    return 0;
   }
}

function addnewboosterschedule($schedulename,$gender,$type,$breed,$datetimecreated,$createdby,$daysbefore,$daysafter,$link,$months){
   $query = "
  INSERT INTO [thabiso].[dbo].[ls_BoostersSchedules]
           ([Name]
           ,[Gender]
           ,[Animal_type]
           ,[Breed]
           ,[datecreated]
           ,[createdby]
           ,[DaysBefore]
           ,[DaysAfter]
           ,[Link]
           ,[Months]
           )
     VALUES
           ('$schedulename'
           ,'$gender'
           ,'$type'
           ,'$breed'
           ,'$datetimecreated'
           ,'$createdby'
           ,'$daysbefore'
           ,'$daysafter'
           ,$link
           ,'$months'
           )";

   if($this->db->query($query)){
    
    return 1;
   } else {
    return 0;
   }
}

function insertmonths($checkBox,$freqid){
   $query = "
  INSERT INTO [thabiso].[dbo].[ls_freq_months]
           ([freq_id]
           ,[month]

           )
     VALUES
           ('$freqid'
           ,'$checkBox'
           )";
//echo $this->db->last_query();
   if($this->db->query($query)){

    //echo $this->db->last_query();
    return 1;
   } else {
    return 0;
   }
}

function addnewfeed($feedname,$uom,$units,$cost,$datetimecreated,$createdby){
   $query = "
  INSERT INTO [thabiso].[dbo].[ls_feed]
           ([feed_name]
           ,[uom]
           ,[qty]
           ,[cost]
           ,[date_created]
           ,[created_by]

           )
     VALUES
           ('$feedname'
           ,'$uom'
           ,'$units'
           ,'$cost'
           ,'$datetimecreated'
           ,'$createdby'
           )";
//echo $this->db->last_query();
   if($this->db->query($query)){

    //echo $this->db->last_query();
    return 1;
   } else {
    return 0;
   }
}

function addnewmedicine($medicinename,$uom,$qty,$cost,$datetimecreated,$createdby){
   $query = "
  INSERT INTO [thabiso].[dbo].[ls_medicine]
           ([medicine_name]
           ,[uom]
           ,[qty]
           ,[cost]
           ,[date_created]
           ,[created_by]

           )
     VALUES
           ('$medicinename'
           ,'$uom'
           ,'$qty'
           ,'$cost'
           ,'$datetimecreated'
           ,'$createdby'
           )";
//echo $this->db->last_query();
   if($this->db->query($query)){

    //echo $this->db->last_query();
    return 1;
   } else {
    return 0;
   }
}

function addnewtreatment($treatmentname,$datetimecreated,$createdby,$comment){
   $query = "
  INSERT INTO [thabiso].[dbo].[ls_treatment]
           ([treatment_name]
           ,[comment]
           ,[date_created]
           ,[created_by]

           )
     VALUES
           ('$treatmentname'
           ,'$comment'
           ,'$datetimecreated'
           ,'$createdby'
           )";
//echo $this->db->last_query();
   if($this->db->query($query)){

    //echo $this->db->last_query();
    return 1;
   } else {
    return 0;
   }
}

function addnewdiagnosis($diagnosisname,$datetimecreated,$createdby,$vaccination){
   $query = "
  INSERT INTO [thabiso].[dbo].[ls_diagnosis]
           ([diagnosis_name]
           ,[vaccination]
           ,[date_created]
           ,[created_by]

           )
     VALUES
           ('$diagnosisname'
           ,'$vaccination'
           ,'$datetimecreated'
           ,'$createdby'
           )";
//echo $this->db->last_query();
   if($this->db->query($query)){

    //echo $this->db->last_query();
    return 1;
   } else {
    return 0;
   }
}


function addnewmovereason($reason,$description,$datetimecreated,$createdby){
   $query = "
  INSERT INTO [thabiso].[dbo].[ls_move_reason]
           ([reason]
           ,[description]
           ,[date_created]
           ,[created_by]

           )
     VALUES
           ('$reason'
           ,'$description'
           ,'$datetimecreated'
           ,'$createdby'
           )";
//echo $this->db->last_query();
   if($this->db->query($query)){

    //echo $this->db->last_query();
    return 1;
   } else {
    return 0;
   }
}

  function addnewherd($herdname,$camp,$description,$datetimecreated,$createdby,$version){
   $query = "
  INSERT INTO [thabiso].[dbo].[ls_herd]
           ([herd_name]
           ,[camp_id]
           ,[description]
           ,[date_created]           
           ,[created_by]
           ,[version]

           )
     VALUES
           ('$herdname'
           ,'$camp'
           ,'$description'
           ,'$datetimecreated'           
           ,'$createdby'
           ,'$version'
           )";
//echo $this->db->last_query();
   if($this->db->query($query)){
    return 1;
   } else {
    return 0;
   }
}


  function addnewmoveherd($herd,$datetimecreated,$createdby,$campid,$campselect,$movedate,$reason,$version){
   $query = "
  INSERT INTO [thabiso].[dbo].[ls_move_herd]
           ([herd_id]
           ,[date_created]           
           ,[created_by]           
           ,[from_camp]
           ,[to_camp]
           ,[move_date]
           ,[reason]
           ,[version]
           )
     VALUES
           ('$herd'
           ,'$datetimecreated'
           ,'$createdby'
           ,'$campid'           
           ,'$campselect'
           ,'$movedate'
           ,'$reason'
           ,'$version'
           )";
//echo $this->db->last_query();
   if($this->db->query($query)){
    return 1;
   } else {
    return 0;
   }
}


function addnewmoveanimal($date,$tagno,$cherdid,$ccamp,$toherd,$tocamp,$version,$cherdd){
    $query = "BEGIN TRANSACTION ";
        $query.="
  INSERT INTO [thabiso].[dbo].[ls_move_animal]
           ([tag]
           ,[date_moved]           
           ,[from_herd]           
           ,[from_camp]
           ,[to_herd]
           ,[to_camp]
           ,[version]
           )
     VALUES
           ('$tagno'
           ,'$date'           
           ,'$cherdid'
           ,'$ccamp'
           ,'$toherd'
           ,'$tocamp'
           ,'$version'
           );";
        $query.="UPDATE [thabiso].[dbo].[ls_master] SET [camp] = $tocamp, [herd_description]='$cherdd' WHERE [tag] = '$tagno';";        
        $query.=" COMMIT";
//echo $this->db->last_query();
   if($this->db->query($query)){
    return 1;
   } else {
    return 0;
   }
}

  function addnewmoveherd2($herd,$datetimecreated,$createdby,$campid,$campselect,$movedate,$reason){

        $query="Insert into ls_move_herd(herd_id,date_created,created_by,from_camp,to_camp,move_date,reason,version)
select yt.herd_id,'$datetimecreated','$createdby','$campid','$campselect','$movedate','$reason',yt.version+1
   from ls_move_herd yt
    where version = 
        (select max(version) from ls_move_herd st where yt.herd_id=$herd);";
                
       
//echo $this->db->last_query();
   if($this->db->query($query)){
    return 1;
   } else {
    return 0;
   }
}


function addnewmoveanimal2($date,$tag,$cherdid,$ccamp,$toherd,$tocamp,$cherdd){
  $query = "BEGIN TRANSACTION ";
   $query .= "Insert into ls_move_animal(tag,date_moved,from_herd,from_camp,to_herd,to_camp,version)
select yt.tag,'$date','$cherdid','$ccamp','$toherd','$tocamp',yt.version+1
   from ls_move_animal yt
    where version = 
        (select max(version) from ls_move_animal st where yt.tag='$tag')";
        $query.="UPDATE [thabiso].[dbo].[ls_master] SET [camp] = $tocamp, [herd_description]='$cherdd' WHERE [tag] = '$tag';";
        $query.=" COMMIT";
echo $this->db->last_query();
   if($this->db->query($query)){
    return 1;
   } else {
    return 0;
   }
}

function addnewdisposalanimal($tag,$disposal_id,$date,$price,$reason_id,$createdby){
   $query = "
  INSERT INTO [thabiso].[dbo].[ls_disposal_animals]
           ([tag]
           ,[disposal_id]
           ,[date]
           ,[price]
           ,[reason_id]
            ,[createdby]
            ,[createddate]
           )
     VALUES
           ('$tag'
           ,'$disposal_id'
           ,'$date'
           ,'$price'
           ,'$reason_id'
           ,'$createdby'
            ,getdate()
           )";

   if($this->db->query($query)){
    return 1;
   } else {
    return 0;
   }
}

public function get_customers($q)
{
  $this->db->select('ls_master.sex');
  $this->db->from('ls_master');
  $this->db->like('ls_master.sex',$q);
  $query = $this->db->get();


    if($query->num_rows > 0){
        foreach ($query->result_array() as $row){
          $array = array(
              'master_id' => htmlentities(stripslashes($row['sex']))
            );
            $row_set[] = $array;
       }
       $this->output->set_content_type('application/json')->set_output(json_encode($row_set));
    } 
}

public function get_sex1($q)
{
  $this->db->select('dbo.ls_master.*, dbo.ls_type.type_name, dbo.ls_breed.breed_name, dbo.ls_location.location_name');
  $this->db->from('ls_master');
  $this->db->join('dbo.ls_location ON dbo.ls_master.location_id = dbo.ls_location.location_id', 'inner');
 // $this->db->join('dbo.ls_type ON dbo.ls_master.type_id = dbo.ls_type.type_id', 'INNER');
 // $this->db->join('dbo.ls_breed ON dbo.ls_master.breed_id = dbo.ls_breed.breed_id', 'INNER');
  $this->db->like('tag',$q);
  $query = $this->db->get();


    if($query->num_rows > 0){
        foreach ($query->result_array() as $row){
          $array = array(
              'sex' => htmlentities(stripslashes($row['sex']))
            );
            $row_set[] = $array;
       }
       $this->output->set_content_type('application/json')->set_output(json_encode($row_set));
    } 
}
  function get_sex11($q){

    

    $query = $this->db->query(" SELECT *  FROM [thabiso].[dbo].[ls_master]
  where [tag] like '%$q'");


    if($query->num_rows > 0){
      foreach ($query->result_array() as $row){
        $array = array( 
        'sex' => htmlentities(stripslashes($row['sex'])),
         'tagid' => htmlentities(stripslashes($row['tag']))
        ); 
        $row_set[] = $array;//build an array
        
      }
      $this->output->set_content_type('application/json')->set_output(json_encode($row_set));

    }
  }
  function get_sex($q){

    $this->db->select('*');
    $this->db->like('tag', $q);
    $query = $this->db->get('[thabiso].[dbo].[ls_master]');
    if($query->num_rows > 0){
      foreach ($query->result_array() as $row){
        $row_set[] = htmlentities(stripslashes($row['tag'])); //build an array
        $row_set[] = htmlentities(stripslashes($row['sex']));
        
      }
      $this->output->set_content_type('application/json')->set_output(json_encode($row_set));

    }
  }

   function getMotherDetails($q){
    $query = $this->db->query("
SELECT dbo.ls_master.*, dbo.ls_type.type_name, dbo.ls_breed.breed_name, dbo.ls_camp.camp_name

FROM ls_master
JOIN dbo.ls_camp ON dbo.ls_master.location_id = dbo.ls_camp.camp_id 
JOIN dbo.ls_type ON dbo.ls_master.type_id = dbo.ls_type.type_id 
JOIN dbo.ls_breed ON dbo.ls_master.breed_id = dbo.ls_breed.breed_id 
WHERE  tag  LIKE '%".$q."%' AND [sex] ='Female' AND [status]!='Disposed'");

   //echo $this->db->last_query();
    if($query->num_rows > 0){
        foreach ($query->result_array() as $row){
            $row_set[] = htmlentities(stripslashes($row['tag']));
                   }
        $this->output->set_content_type('application/json')->set_output(json_encode($row_set));
    } 
  }

  function getanimaltags($q){
      $query = $this->db->query("
SELECT dbo.vw_livestock_currentanimal.*, dbo.ls_type.type_name, dbo.ls_breed.breed_name, dbo.ls_location.location_name,(select camp_name from ls_camp where camp_id = vw_livestock_currentanimal.camp) loc

FROM vw_livestock_currentanimal
LEFT JOIN dbo.ls_location ON dbo.vw_livestock_currentanimal.location_id = dbo.ls_location.location_id 
LEFT JOIN dbo.ls_type ON dbo.vw_livestock_currentanimal.type_id = dbo.ls_type.type_id 
LEFT JOIN dbo.ls_breed ON dbo.vw_livestock_currentanimal.breed_id = dbo.ls_breed.breed_id 
WHERE  tag  LIKE '%".$q."%' AND [status] <> 'Disposed'");

    //echo $this->db->last_query();
    if($query->num_rows > 0){
        foreach ($query->result_array() as $row){
                $array = array(
                    'loc' => htmlentities(stripslashes($row['loc'])),
                    'sex' => htmlentities(stripslashes($row['sex'])),
                    'herd_description' => htmlentities(stripslashes($row['herd_description'])),
                    'weight' => htmlentities(stripslashes($row['weight'])),
                    'tag' => htmlentities(stripslashes($row['tag']))
                    );          
                $row_set[] = $array;
                   }
        $this->output->set_content_type('application/json')->set_output(json_encode($row_set));
    } 

  }

  function addnewdisposal($statusid,$typeid,$sourcename,$tagid,$locationid,$purid,$sexid,$commentsid,$dobid,$dateid,$breedid,$details_of_parents_father,$details_of_parents_mother){
   $query = "
  INSERT INTO [thabiso].[dbo].[ls_master]
           ([status]
           ,[source]
           ,[date]
           ,[dob]
           ,[type_id]
           ,[breed_id]
           ,[purchase_price]
           ,[details_of_parents_mother]
           ,[details_of_parents_father]
           ,[sex]
           ,[comments]
           ,[location],[tag])
     VALUES
           ('$statusid'
           ,'$sourcename'
           ,'$dateid'
           ,'$dobid'
           ,'$typeid'
           ,'$breedid'
           ,'$purid'
           ,'$details_of_parents_mother'
           ,'$details_of_parents_father'
           ,'$sexid'
           ,'$commentsid'
           ,'$locationid','$tagid')";

   if($this->db->query($query)){
    return 1;
   } else {
    return 0;
   }
}


    function select_reason($id){

   $query = $this->db->query(" SELECT * FROM ls_disposal_reasons WHERE disposal_id=$id");

           if($query->num_rows > 0){

            foreach ($query->result_array() as $row){

                $reason_type[] = htmlentities(stripslashes($row['reason_type']));

               $reason_id[] = htmlentities(stripslashes($row['reason_id']));

           }
           $row_set['reason_type'] = $reason_type;

          $row_set['reason_id'] = $reason_id;

           return $row_set;

        }

        else {

            $row_set[] = htmlentities(stripslashes('noresults'));

       return $row_set;

    }

      }


function select_breed($id){

   $query = $this->db->query("SELECT * FROM ls_breed WHERE type_id=$id");

           if($query->num_rows > 0){

            foreach ($query->result_array() as $row){

                $breed_name[] = htmlentities(stripslashes($row['breed_name']));

               $breed_id[] = htmlentities(stripslashes($row['breed_id']));

           }
           $row_set['breed_name'] = $breed_name;

          $row_set['breed_id'] = $breed_id;

           return $row_set;

        }

        else {

            $row_set[] = htmlentities(stripslashes('noresults'));

       return $row_set;

    }

      }





   function deletereasons($id)
  {
 $query = "
  delete from  [thabiso].[dbo].[ls_disposal_reasons]
  where [reason_id]='$id';
  ";

   if($this->db->query($query)){
    return 1;
   } else {
    return 0;
   }
}


   function deletevaccineschedule($id)
  {
 $query = "delete from  [thabiso].[dbo].[ls_VaccineSchedules] where [Id]='$id';";

   if($this->db->query($query)){
    return 1;
   } else {
    return 0;
   }
}


 function deleteboosterschedule($id)
  {
 $query = "delete from  [thabiso].[dbo].[ls_BoostersSchedules] where [Id]='$id';";

   if($this->db->query($query)){
    return 1;
   } else {
    return 0;
   }
}

function updatereasons($id,$newloc,$typeid){
 $query = "
  update [thabiso].[dbo].[ls_disposal_reasons]
  set [reason_type]='$newloc',[disposal_id]='$typeid' where [reason_id]='$id';
  ";
//echo $this->last_query();
   if($this->db->query($query)){
    return 1;
   } else {
    return 0;
   }
}




function editreasonss($reasonsid){

           $sql =("
            SELECT   dbo.ls_disposal_reasons.*, dbo.ls_disposal_types.disposal_type
FROM            dbo.ls_disposal_reasons INNER JOIN
                         dbo.ls_disposal_types ON dbo.ls_disposal_reasons.disposal_id = dbo.ls_disposal_types.disposal_id
 WHERE [reason_id] = '$reasonsid'
  ");

         
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }
function addnewreasons($newloc,$disposal_id){
 $query = "
  insert into [thabiso].[dbo].[ls_disposal_reasons]([reason_type],[disposal_id])  values ('$newloc','$disposal_id')
  ";
   if($this->db->query($query)){
    return 1;
   } else {
    return 0;
   }
}
  
function viewreasonss(){

           $sql =("
SELECT        dbo.ls_disposal_reasons.*, dbo.ls_disposal_types.disposal_type
FROM            dbo.ls_disposal_reasons LEFT JOIN
                         dbo.ls_disposal_types ON dbo.ls_disposal_reasons.disposal_id = dbo.ls_disposal_types.disposal_id");

          // echo $this->db->last_query();
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }


 function deletedisposals($id)
  {
 $query = "
  delete from  [thabiso].[dbo].[ls_disposal_types]
  where [disposal_id]='$id';
  ";

   if($this->db->query($query)){
    return 1;
   } else {
    return 0;
   }
}

function updatedisposals($id,$newloc){
 $query = "
  update [thabiso].[dbo].[ls_disposal_types]
  set [disposal_type]='$newloc' where [disposal_id]='$id';
  ";

   if($this->db->query($query)){
    return 1;
   } else {
    return 0;
   }
}




function editdisposalss($disposalsid){

           $sql =("
 SELECT [disposal_id]
      ,[disposal_type]
  FROM [thabiso].[dbo].[ls_disposal_types]
  WHERE [disposal_id] = '$disposalsid'
  ");

         
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }
function addnewdisposals($newloc){
 $query = "
  insert into [thabiso].[dbo].[ls_disposal_types](disposal_type)  values ('$newloc')
  ";
   if($this->db->query($query)){
    return 1;
   } else {
    return 0;
   }
}
  
function viewdisposalss(){

           $sql =("
 SELECT [disposal_id]
      ,[disposal_type]
  FROM [thabiso].[dbo].[ls_disposal_types]
  ");

          // echo $this->db->last_query();
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }

  function deletebreeds($id)
  {
 $query = "
  delete from  [thabiso].[dbo].[ls_breed]
  where [breed_id]='$id';
  ";

   if($this->db->query($query)){
    return 1;
   } else {
    return 0;
   }
}

function updatebreeds($id,$newloc,$typeid){
 $query = "
  update [thabiso].[dbo].[ls_breed]
  set [breed_name]='$newloc', [type_id]='$typeid' where [breed_id]='$id';
  ";

   if($this->db->query($query)){
    return 1;
   } else {
    return 0;
   }
}
function viewbreedss(){

           $sql =("
 SELECT [breed_id]
      ,[breed_name]
  FROM [thabiso].[dbo].[ls_breed]
  ");

          // echo $this->db->last_query();
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }


  function viewbreeds(){

           $sql =("
 SELECT [breed_id]
      ,[breed_name],(select type_name from ls_type where type_id = ls_breed.type_id) typeName
  FROM [thabiso].[dbo].[ls_breed]
  ");

          // echo $this->db->last_query();
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }

function viewbreedsss($newloc){

           $sql =("
 SELECT [breed_id]
      ,[breed_name]
      ,[type_id]
  FROM [thabiso].[dbo].[ls_breed]
  WHERE [type_id]='$newloc';

  ");

          // echo $this->db->last_query();
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }



function edittypess($typesid){

           $sql =("
 SELECT *
  FROM [thabiso].[dbo].[ls_type]
  WHERE [type_id] = '$typesid'
  ");

         
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }

  function editcamps($campid){

           $sql =("
 SELECT *
  FROM [thabiso].[dbo].[ls_camp]
  WHERE [camp_id] = '$campid'
  ");

         
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }

  function editfeed($feedid){

           $sql =("
 SELECT *
  FROM [thabiso].[dbo].[ls_feed]
  WHERE [feed_id] = '$feedid'
  ");

         
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }

function editmedicine($medicineid){

           $sql =("
 SELECT *
  FROM [thabiso].[dbo].[ls_medicine]
  WHERE [medicine_id] = '$medicineid'
  ");

         
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }

  function edittreatment($treatmentid){

           $sql =("
 SELECT *
  FROM [thabiso].[dbo].[ls_treatment]
  WHERE [treatment_id] = '$treatmentid'
  ");

         
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }


   function editdiagnosis($diagnosisid){

           $sql =("
 SELECT *
  FROM [thabiso].[dbo].[ls_diagnosis]
  WHERE [diagnosis_id] = '$diagnosisid'
  ");

         
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }

  function editvaccineschedule($vaccine_id){

           $sql =("
 SELECT *
  FROM [thabiso].[dbo].[ls_VaccineSchedules]
  WHERE [Id] = '$vaccine_id'
  ");

         
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }


  function editboosterschedule($id){

           $sql =("
 SELECT *
  FROM [thabiso].[dbo].[ls_BoostersSchedules]
  WHERE [Id] = '$id'
  ");

         
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }

    function editmovereason($reasonid){

           $sql =("
 SELECT *
  FROM [thabiso].[dbo].[ls_move_reason]
  WHERE [reason_id] = '$reasonid'
  ");

         
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }

   function editherds($herdid){

           $sql =("
 SELECT *
  FROM [thabiso].[dbo].[ls_herd]
  WHERE [herd_id] = '$herdid'
  ");

         
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }

function addnewtypes($newloc,$windowz){
 $query = "
  insert into [thabiso].[dbo].[ls_type](type_name,pregnancy_window)  values ('$newloc', '$windowz')
  ";
   if($this->db->query($query)){
    return 1;
   } else {
    return 0;
   }
}
  
function viewtypess(){

           $sql =("
 SELECT *
  FROM [thabiso].[dbo].[ls_type]
  ");

          // echo $this->db->last_query();
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }

  function viewcamps(){

           $sql =("
 SELECT *,(select farm_name from forestry_farm where farm_id = ls_camp.farm_id) farm_name
  FROM [thabiso].[dbo].[ls_camp] order by camp_name ASC
  ");

          // echo $this->db->last_query();
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }

    function viewherdsincamps(){

           $sql =("
 SELECT *,(select farm_name from forestry_farm where farm_id = ls_camp.farm_id) farm_name, 
(select camp_name from ls_camp where camp_id = ls_move_herd.to_camp) ccamp
, (select camp_name from ls_camp where camp_id = ls_move_herd.from_camp) pcamp
  FROM [thabiso].[dbo].[ls_camp]
  left join ls_herd on ls_camp.camp_id = ls_herd.camp_id
  left join ls_move_herd on ls_herd.herd_id = ls_move_herd.herd_id order by camp_name ASC
  ");

          // echo $this->db->last_query();
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }

    function viewfrequencies(){

           $sql =("
 SELECT *
  FROM [thabiso].[dbo].[ls_frequency]
  ");

          // echo $this->db->last_query();
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }


  function viewboosters(){

           $sql =("select ls_boostersschedules.name schedule_name,
ls_boostersschedules.gender ,ls_boostersschedules.Id Id, ls_breed.breed_name breed, ls_type.type_name typename
, ls_boostersschedules.link, ls_boostersschedules.months
from ls_boostersschedules 
left join ls_breed on ls_boostersschedules.breed = ls_breed.breed_id
left join ls_type on ls_boostersschedules.animal_type = ls_type.type_id
  ");

          // echo $this->db->last_query();
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }


  function viewvaccines(){

           $sql =("select ls_vaccinschedules.name schedule_period,ls_vaccineschedules.name schedule_name,
ls_vaccineschedules.gender ,ls_vaccineschedules.Id Id, ls_breed.breed_name breed, ls_type.type_name typename
from ls_vaccineschedules 
left join ls_vaccinschedules on ls_vaccineschedules.VaccinePeriod = ls_vaccinschedules.id
left join ls_breed on ls_vaccineschedules.breed = ls_breed.breed_id
left join ls_type on ls_vaccineschedules.animal_type = ls_type.type_id
  ");

          // echo $this->db->last_query();
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }

function viewfeeds(){

           $sql =("
 SELECT *, ls_uom.uom
  FROM [thabiso].[dbo].[ls_feed] left join ls_uom on ls_feed.uom = ls_uom.id
  ");

          // echo $this->db->last_query();
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }

  function viewmedicines(){

           $sql =("
 SELECT *, ls_uom.uom
  FROM [thabiso].[dbo].[ls_medicine] left join ls_uom on ls_medicine.uom = ls_uom.id
  ");

          // echo $this->db->last_query();
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }

    function viewtreatments(){

           $sql =("
 SELECT *
  FROM [thabiso].[dbo].[ls_treatment]
  ");

          // echo $this->db->last_query();
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }

      function viewdiagnosis(){

           $sql =("
 SELECT *
  FROM [thabiso].[dbo].[ls_diagnosis]");

    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }

  function viewmovereasons(){

           $sql =("
 SELECT *
  FROM [thabiso].[dbo].[ls_move_reason]
  ");

          // echo $this->db->last_query();
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }
  }

  

  function viewherds(){

           $sql =("
 SELECT *
  FROM [thabiso].[dbo].[ls_herd]
  ");

          // echo $this->db->last_query();
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }

    function getfarmname($id){

           $sql =("
 SELECT farm_name
  FROM [thabiso].[dbo].[forestry_farm] WHERE farm_id = '$id'
  ");

          // echo $this->db->last_query();
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }

  function deletetypes($id)
  {
 $query = "
  delete from  [thabiso].[dbo].[ls_type]
  where [type_id]='$id';
  ";

   if($this->db->query($query)){
    return 1;
   } else {
    return 0;
   }
}
function deletecamps($id)
  {
 $query = "
  delete from  [thabiso].[dbo].[ls_camp]
  where [camp_id]='$id';
  ";

   if($this->db->query($query)){
    return 1;
   } else {
    return 0;
   }
}

function deletevaccine($id)
  {
 $query = "
  delete from  [thabiso].[dbo].[ls_vaccineschedules]
  where [Id]='$id';
  ";

   if($this->db->query($query)){
    return 1;
   } else {
    return 0;
   }
}

function deletebooster($id)
  {
 $query = "
  delete from  [thabiso].[dbo].[ls_BoostersSchedules]
  where [Id]='$id';
  ";

   if($this->db->query($query)){
    return 1;
   } else {
    return 0;
   }
}

function deletefeed($id)
  {
 $query = "
  delete from  [thabiso].[dbo].[ls_feed]
  where [feed_id]='$id';
  ";

   if($this->db->query($query)){
    return 1;
   } else {
    return 0;
   }
}

function deletemedicine($id)
  {
 $query = "
  delete from  [thabiso].[dbo].[ls_medicine]
  where [medicine_id]='$id';
  ";

   if($this->db->query($query)){
    return 1;
   } else {
    return 0;
   }
}

function deletetreatment($id)
  {
 $query = "
  delete from  [thabiso].[dbo].[ls_treatment]
  where [treatment_id]='$id';
  ";

   if($this->db->query($query)){
    return 1;
   } else {
    return 0;
   }
}


function deletediagnosis($id)
  {
 $query = "
  delete from  [thabiso].[dbo].[ls_diagnosis]
  where [diagnosis_id]='$id';
  ";

   if($this->db->query($query)){
    return 1;
   } else {
    return 0;
   }
}


function deletemovereason($id)
  {
 $query = "
  delete from  [thabiso].[dbo].[ls_move_reason]
  where [reason_id]='$id';
  ";

   if($this->db->query($query)){
    return 1;
   } else {
    return 0;
   }
}

function deleteherds($id)
  {
 $query = "
  delete from  [thabiso].[dbo].[ls_herd]
  where [herd_id]='$id';
  ";

   if($this->db->query($query)){
    return 1;
   } else {
    return 0;
   }
}

function updatetypes($id,$newloc,$windowz){
 $query = "
  update [thabiso].[dbo].[ls_type]
  set [type_name]='$newloc', [pregnancy_window]='$windowz' where [type_id]='$id';
  ";

   if($this->db->query($query)){
    return 1;
   } else {
    return 0;
   }
}

function updatecamps($newcamp,$farmid,$description,$camp_id){
 $query = "
  update [thabiso].[dbo].[ls_camp]
  set [camp_name]='$newcamp', [farm_id]='$farmid', [description]='$description' where [camp_id]='$camp_id';
  ";
//echo $this->db->last_query();
   if($this->db->query($query)){
    //echo $this->db->last_query();
    return 1;
   } else {
    //echo $this->db->last_query();
    return 0;
   }
}

function updatefeed($feedname,$uom,$feed_id,$units,$uom,$cost){
 $query = "
  update [thabiso].[dbo].[ls_feed]
  set [feed_name]='$feedname', [uom]='$uom', [qty]='$units', [cost]='$cost' where [feed_id]='$feed_id';
  ";
echo $this->db->last_query();
   if($this->db->query($query)){
    //echo $this->db->last_query();
    return 1;
   } else {
    //echo $this->db->last_query();
    return 0;
   }
}

function updatemedicine($medicinename,$uom,$medicine_id,$qty,$uom,$cost){
 $query = "
  update [thabiso].[dbo].[ls_medicine]
  set [medicine_name]='$medicinename', [uom]='$uom', [qty]='$qty', [cost]='$cost' where [medicine_id]='$medicine_id';
  ";
echo $this->db->last_query();
   if($this->db->query($query)){
    //echo $this->db->last_query();
    return 1;
   } else {
    //echo $this->db->last_query();
    return 0;
   }
}

function updatetreatment($treatmentname,$comment,$treatment_id){
 $query = "
  update [thabiso].[dbo].[ls_treatment]
  set [treatment_name]='$treatmentname', [comment]='$comment' where [treatment_id]='$treatment_id';
  ";
echo $this->db->last_query();
   if($this->db->query($query)){
    //echo $this->db->last_query();
    return 1;
   } else {
    //echo $this->db->last_query();
    return 0;
   }
}

function updatediagnosis($diagnosisname,$vaccination,$diagnosisid){
 $query = "
  update [thabiso].[dbo].[ls_diagnosis]
  set [diagnosis_name]='$diagnosisname', [vaccination]='$vaccination' where [diagnosis_id]='$diagnosisid';
  ";
   if($this->db->query($query)){
    //echo $this->db->last_query();
    return 1;
   } else {
    //echo $this->db->last_query();
    return 0;
   }
}

function updatemovereasons($reason,$description,$reasonid){
 $query = "
  update [thabiso].[dbo].[ls_move_reason]
  set [reason]='$reason', [description]='$description' where [reason_id]='$reasonid';
  ";
//echo $this->db->last_query();
   if($this->db->query($query)){
    return 1;
   } else {
    return 0;
   }
}

function updatedcamp($herd,$campid){
 $query = "
  update [thabiso].[dbo].[ls_herd]
  set [camp_id]='$campid' where [herd_id]='$herd';
  ";
//echo $this->db->last_query();
   if($this->db->query($query)){
    return 1;
   } else {
    return 0;
   }
}

function updateherds($newherd,$campid,$description,$herd_id){
 $query = "
  update [thabiso].[dbo].[ls_herd]
  set [herd_name]='$newherd', [camp_id]='$campid', [description]='$description' where [herd_id]='$herd_id';
  ";
//echo $this->db->last_query();
   if($this->db->query($query)){
    //echo $this->db->last_query();
    return 1;
   } else {
    //echo $this->db->last_query();
    return 0;
   }
}

function editlocations($locationid){

           $sql =("
 SELECT *
  FROM [thabiso].[dbo].[ls_location]
  WHERE [location_id] = '$locationid'
  ");

         
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }

  function addnewbreedss($newloc,$typeid){
 $query = "
  insert into [thabiso].[dbo].[ls_breed]([breed_name],[type_id])  values ('$newloc','$typeid')";

 // echo $this->db->last_query();
   if($this->db->query($query)){
    return 1;
   } else {
    return 0;
   }
}
function addnewlocation($newloc,$prefix){
 $query = "
  insert into [thabiso].[dbo].[ls_location](location_name,prefix)  values ('$newloc','$prefix')
  ";
   if($this->db->query($query)){
    echo $this->db->last_query();
    return 1;
   } else {
    return 0;
   }
}


  
function viewlocations(){

           $sql =("
 SELECT *
  FROM [thabiso].[dbo].[ls_herd] order by herd_name asc
  ");

          // echo $this->db->last_query();
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }

  function selectfarms(){

           $sql =("
 SELECT farm_name,farm_id
  FROM [thabiso].[dbo].[forestry_farm] ORDER BY farm_name ASC
  ");

          // echo $this->db->last_query();
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }



    function selectmovereasons(){

           $sql =("
 SELECT reason,reason_id
  FROM [thabiso].[dbo].[ls_move_reason]
  ");

          // echo $this->db->last_query();
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }

 function selectcamps(){

           $sql =("
 SELECT camp_name,camp_id
  FROM [thabiso].[dbo].[ls_camp]
  ");

          // echo $this->db->last_query();
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }

  function selectherds(){

           $sql =("
 SELECT herd_name,herd_id
  FROM [thabiso].[dbo].[ls_herd]
  ");

          // echo $this->db->last_query();
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }

  function selectherd(){

           $sql =("select distinct ls_production_plan.herd_id,ls_herd.herd_name from ls_production_plan
left join ls_herd on ls_production_plan.herd_id = ls_herd.herd_id");

          // echo $this->db->last_query();
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }

   function selectdescription($id){

           $sql =("
 SELECT description
  FROM [thabiso].[dbo].[ls_camp] WHERE camp_id = '$id'
  ");

          // echo $this->db->last_query();
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }

   function selectproducts($table){
    $cols = '';
if($table == 'ls_feed'){
  $cols = 'feed_id,feed_name';
}elseif ($table == 'ls_medicine') {
  $cols = 'medicine_id,medicine_name';
}
           $sql =("SELECT $cols FROM $table");

          
    $results = $this->db->query($sql);
// echo $this->db->last_query();
    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }

  function selectherddescription($id){

           $sql =("
 SELECT description
  FROM [thabiso].[dbo].[ls_herd] WHERE herd_id = '$id'
  ");

          
    $results = $this->db->query($sql);
//echo $this->db->last_query();
    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }

  function selectherdcampid($id){

           $sql =("
 SELECT camp_id
  FROM [thabiso].[dbo].[ls_herd] WHERE herd_id = '$id'
  ");

          
    $results = $this->db->query($sql);
//echo $this->db->last_query();
    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }

  function selectcampname($id){

           $sql =("
 SELECT camp_name
  FROM [thabiso].[dbo].[ls_camp] WHERE camp_id = '$id'
  ");

          
    $results = $this->db->query($sql);
//echo $this->db->last_query();
    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }

   function getlastfreqid(){

           $sql =("
            SELECT TOP 1 frequency_id FROM [thabiso].[dbo].[ls_frequency] ORDER BY frequency_id DESC
  ");

          
    $results = $this->db->query($sql);
//echo $this->db->last_query();
    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }


    function selectcurrentcampname($id){

           $sql =("SELECT camp_name FROM ls_camp
WHERE camp_id = (
SELECT yt.to_camp
    FROM [thabiso].[dbo].[ls_move_herd] yt
    WHERE version = 
        (SELECT max(version) FROM [thabiso].[dbo].[ls_move_herd] st WHERE yt.herd_id=$id))
  ");
         }

           function selectcurrentcampid($id){

           $sql =("SELECT camp_id FROM ls_camp
WHERE camp_id = (
SELECT yt.to_camp
    FROM [thabiso].[dbo].[ls_move_herd] yt
    WHERE version = 
        (SELECT max(version) FROM [thabiso].[dbo].[ls_move_herd] st WHERE yt.herd_id=$id))
  ");

          
    $results = $this->db->query($sql);
//echo $this->db->last_query();
    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }

  function selectedcamp($id){

           $sql =("
 SELECT farm_id
  FROM [thabiso].[dbo].[ls_camp] WHERE camp_id = '$id'
  ");

          // echo $this->db->last_query();
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }

  function selectedherd($id){

           $sql =("
 SELECT camp_id
  FROM [thabiso].[dbo].[ls_herd] WHERE herd_id = '$id'
  ");

          // echo $this->db->last_query();
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }


  function selectedfarm($id){

           $sql =("
 SELECT farm_name,farm_id
  FROM [thabiso].[dbo].[forestry_farm] WHERE farm_id = $id
  ");

          
    $results = $this->db->query($sql);
 echo $this->db->last_query();
    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }

    function selectedcamps($id){

           $sql =("
 SELECT camp_name,camp_id
  FROM [thabiso].[dbo].[ls_camp] WHERE camp_id = $id
  ");

          
    $results = $this->db->query($sql);
 echo $this->db->last_query();
    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }

  function deletelocation($id)
  {
 $query = "
  delete from  [thabiso].[dbo].[ls_location]
  where [location_id]='$id';
  ";

   if($this->db->query($query)){
    return 1;
   } else {
    return 0;
   }
}

function updatelocation($id,$newloc,$prefix){
 $query = "
  update [thabiso].[dbo].[ls_location]
  set [location_name]='$newloc',[prefix]='$prefix' where [location_id]='$id';
  ";

   if($this->db->query($query)){
    return 1;
   } else {
    return 0;
   }
}

  function herdexists($id){

           $sql =("
 SELECT *
  FROM [thabiso].[dbo].[ls_move_herd] WHERE herd_id = '$id'
  ");

          // echo $this->db->last_query();
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }

  function animalexists($id){

           $sql =("
 SELECT *
  FROM [thabiso].[dbo].[ls_move_animal] WHERE tag = '$id'
  ");

          // echo $this->db->last_query();
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }

  function tagexists($id){

           $sql =("
 SELECT *
  FROM [thabiso].[dbo].[ls_master] WHERE tag = '$id'
  ");

          // echo $this->db->last_query();
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }


     function GetBreed($q){
    $query = $this->db->query("
SELECT [breed_id],[breed_name]
  FROM [thabiso].[dbo].[ls_breed] 
WHERE type_id = $q");

   // echo $this->db->last_query();
    if($query->num_rows > 0){
        return $query->result_array();
        //$this->output->set_content_type('application/json')->set_output(json_encode($row_set));
    } 
  }


  function getvaccines(){

           $sql =("select * from ls_VaccineSchedules");

          // echo $this->db->last_query();
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }

  function getboosters(){

           $sql =("select * from ls_BoostersSchedules");

          // echo $this->db->last_query();
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }

  function getdiagnosis(){

           $sql =("select * from ls_diagnosis");

          // echo $this->db->last_query();
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }


   function editoperationschecklist($id){

           $sql =("  select distinct *,ls_operations.Id Opid from ls_operations
left join
(
select branding Id,header_id,
(select operation from ls_operations where Id = branding) operation_name,comment  
from ls_brandings where header_id = $id) vs on vs.Id = ls_operations.Id");

          
    $results = $this->db->query($sql);
 echo $this->db->last_query();
    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }


  function getoperations(){

           $sql =("select *,ls_operations.Id Opid from ls_operations
left join ls_brandings on ls_brandings.branding = ls_operations.Id");

          // echo $this->db->last_query();
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }


  function newheader($date,$tagno,$sex,$weight,$herdinfo,$location,$sick,$vaccine,$booster){

    $texists = $this->ls_model->tagexists($tagno);

  if($texists[0]['tag'] == $tagno ){
    $ult = $this->ls_model->addnewanimal3($weight,$tagno);

        $query = "BEGIN TRANSACTION ";
        $query.=" update [thabiso].[dbo].[ls_master] set [weight] ='$weight' where tag = '$tagno'";
        $query.=" update [thabiso].[dbo].[ls_master] set [version] = (select version from ls_master where master_id = $ult) + 1 where master_id = $ult"; 
        $query.=" COMMIT";
        $this->db->query($query);
  }

   $query = "BEGIN TRANSACTION ";
        $query.="insert into [thabiso].[dbo].[ls_cattle_checklist]([date],[tag],[sex],[weight],[herdinfo],[location],[sick],[vaccines],[boosters])  values ('$date','$tagno','$sex','$weight','$herdinfo','$location',$sick,$vaccine,$booster);"; 
        

        if($this->db->query($query)){

    //return $ult;
    return $this->db->insert_id();
   } else {
    return 0;
   }
   
   


}


function addnewanimal3($weight,$tagno){

   $query = $this->db->query("Insert into ls_master 
select status,source,date,dob,type_id,breed_id,purchase_price,details_of_parents_mother,details_of_parents_father,sex,comments,location_id,
tag,asset_vendor_id,createdby,datecreated,updatedby,dateupdated,ai,multiplefathers,weight,herd_description,camp,version from ls_master where tag = '$tagno'
");
//echo $this->db->last_query();exit;
   if($this->db->query($query)){
    return $this->db->insert_id();
   } else {
    return 0;
   }
}

  function updateheader($header,$tagno,$sex,$weight,$herdinfo,$location,$datec){

   $query = "BEGIN TRANSACTION ";
        $query.="update [thabiso].[dbo].[ls_cattle_checklist] set [date] ='$datec',[tag] ='$tagno',[sex] = '$sex',[weight] = '$weight',[herdinfo] = '$herdinfo',[location] = '$location' where id = '$header';";        
        $query.=" COMMIT";
   if($this->db->query($query)){

    //echo $this->db->last_query();
    return 1;
   } else {
    return 0;
   }
}

function newbrandings($brandid,$brandcomment,$headerid,$cnt){

   $query = "BEGIN TRANSACTION ";
        
        if($cnt == 0){
  $query.="delete from ls_brandings where header_id = '$headerid'; ";
 }

        $query.="insert into [thabiso].[dbo].[ls_brandings]([branding],[comment],[header_id])  values ('$brandid','$brandcomment','$headerid');";        
        $query.=" COMMIT";
   if($this->db->query($query)){

    //echo $this->db->last_query();
    return 1;
   } else {
    return 0;
   }
}


function diagnosisused($diagnosisid,$diagnosiscomment,$qty,$headerid,$datecreated,$cnt){
 
 $query = "BEGIN TRANSACTION ";
 if($cnt == 0){
  $query.="delete from ls_products_used where header_id = '$headerid'; ";
 }
        
        $query.="insert into [thabiso].[dbo].[ls_products_used]([diagnosis],[product_used],[qty],[header_id],[date],[sick])  values ('$diagnosisid','$diagnosiscomment','$qty','$headerid','$datecreated',1);";        
        $query.=" COMMIT";
   if($this->db->query($query)){

    //echo $this->db->last_query();
    return 1;
   } else {
    return 0;
   }
}

function vaccineused($vaccineid,$vaccinecomment,$headerid,$cnt,$datecreated){

   $query = "BEGIN TRANSACTION ";
        
              if($cnt == 0){
  $query.="delete from ls_vaccine_used where header_id = '$headerid'; ";
 }
        $query.="insert into [thabiso].[dbo].[ls_vaccine_used]([vaccine],[comment],[header_id],[date])  values ('$vaccineid','$vaccinecomment','$headerid','$datecreated');";        
        $query.=" COMMIT";
   if($this->db->query($query)){

    return 1;
   } else {
    return 0;
   }
}

function boostersused($boosterid,$boostercomment,$headerid,$cnt,$datecreated){


   $query = "BEGIN TRANSACTION ";
        
                  if($cnt == 0){
  $query.="delete from ls_booster_used where header_id = '$headerid'; ";
 }
        $query.="insert into [thabiso].[dbo].[ls_booster_used]([booster],[comment],[header_id],[date])  values ('$boosterid','$boostercomment','$headerid','$datecreated');";        
        $query.=" COMMIT";
   if($this->db->query($query)){

    //echo $this->db->last_query();
    return 1;
   } else {
    return 0;
   }
}


function getchecklists(){

           $sql =("SELECT * FROM [thabiso].[dbo].[ls_cattle_checklist]");

          // echo $this->db->last_query();
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }


  function getproductionplans(){

           $sql =("SELECT * FROM [thabiso].[dbo].[ls_production_plan] LEFT JOIN ls_camp on ls_production_plan.camp_id = ls_camp.camp_id");

          // echo $this->db->last_query();
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return $results->result_array();
    }

  }


  function getreceipts(){

           $sql =("SELECT *,ls_uom.id uomid FROM [thabiso].[dbo].[ls_receipts] LEFT JOIN ls_uom on ls_receipts.uom = ls_uom.id LEFT JOIN forestry_farm on ls_receipts.farm_id = forestry_farm.farm_id");

          // echo $this->db->last_query();
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return $results->result_array();
    }

  }

   function getanimalfeed(){

        $sql =("SELECT * FROM [thabiso].[dbo].[ls_feed_issuing] LEFT JOIN ls_camp on ls_feed_issuing.camp_id = ls_camp.camp_id");

              
        $results = $this->db->query($sql);

        if($results->num_rows() > 0)
        {
          return $results->result_array();
        }

        else
        {
          return $results->result_array();
        }

  }

    function getproductionplansfilter($statusDrop = array(),$activityDrop = array(),$startdate,$enddate,$herdDrop = array()){

      $str = '';
      $str2= '';
      $str3= '';
      $str4= '';

      if($statusDrop!= '' || $activityDrop!= '' || $herdDrop!= ''){
      $str = ' WHERE ';
        
            $str = $str."ls_production_plan.status IN ('".$statusDrop."')";

            if(isset($activityDrop) && !empty($activityDrop)){
        $str2 = " AND ls_production_plan.activity IN ('".$activityDrop."')";
      }

         if(isset($startdate) && !empty($startdate)){
        $str3 = " AND ls_production_plan.start_date between '".$startdate."' AND '".$enddate."'";

      $str3 .= " AND ls_production_plan.end_date between '".$startdate."' AND '".$enddate."'";
      }

      if(isset($herdDrop) && !empty($herdDrop)){
        $str4 = " AND ls_production_plan.herd_id IN ('".$herdDrop."')";
      }
          
      }else{
        $str = '';
        $str2 = '';
        $str3 = '';
        $str4 = '';

      }

      

$sql =("SELECT * FROM [thabiso].[dbo].[ls_production_plan] LEFT JOIN ls_camp on ls_production_plan.camp_id = ls_camp.camp_id ".$str." ".$str2." ".$str3." ".$str4);

           
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return $results->result_array();
    }

  }

  function deleteplan($planid)
  {
$query = "
  delete from [thabiso].[dbo].[ls_production_plan]
  where [rn]='$planid';
  ";
   if($this->db->query($query)){
    return 1;
   } else {
    return 0;
   }
}


function deletefeedissuing($feedid)
  {
$query = "
  delete from [thabiso].[dbo].[ls_feed_issuing]
  where [rn]='$feedid';
  ";
   if($this->db->query($query)){
    return 1;
   } else {
    return 0;
   }
}



  function editvaccineschecklist($id){

           $sql =("select *,ls_VaccineSchedules.Id vid from ls_VaccineSchedules
left join
(
select vaccine Id,
(select Name from ls_VaccineSchedules where Id = vaccine) vaccine,comment  
from ls_vaccine_used where header_id = '$id') vs on vs.Id = ls_VaccineSchedules.Id");

          // echo $this->db->last_query();
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }

  function editboosterschecklist($id){

           $sql =("select *,ls_BoostersSchedules.Id bid from ls_BoostersSchedules
left join
(
select booster Id,
(select Name from ls_BoostersSchedules where Id = booster) booster,comment  
from ls_booster_used where header_id = $id) bs on bs.Id = ls_BoostersSchedules.Id");

          // echo $this->db->last_query();
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }

  function editdiagnosischecklist($id){

           $sql =("
select * from
(select * from ls_diagnosis
left join (
select * from(
select diagnosis Id,(select ls_diagnosis.diagnosis_name from ls_diagnosis where diagnosis_id = diagnosis) diagnosis_names, product_used, qty 
from ls_products_used where header_id = '$id') as Main group by Main.Id, Main.diagnosis_names,Main.product_used,Main.qty) d 
on d.Id = ls_diagnosis.diagnosis_id) as l");

          // echo $this->db->last_query();
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }

  function editheaderchecklist($id){

           $sql =("select * from ls_cattle_checklist where Id = $id");

          // echo $this->db->last_query();
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }


  function fetchanimalsbasedonherd($herd_id,$tag){
        $userId = $this->session->userdata('UID');
  
         $sql = $this->db->query("select * from (select id,tag,sex,herdinfo,location,weight,(select camp_id from ls_camp where camp_name = main.location) camp_id,
(select count(*) from ls_products_used where header_id = main.Id) diagnosis,
(select count(*) from ls_vaccine_used where header_id = main.Id) vaccines,
(select count(*) from ls_booster_used where header_id = main.Id) boosters,
(select count(*) from ls_brandings where header_id = main.Id) operations
from ls_cattle_checklist main) sup
left join ls_herd on ls_herd.camp_id = sup.camp_id
where herd_id = $herd_id and tag = '$tag'
");

      //echo $this->db->last_query();
      if($sql->num_rows() > 0){
        return $sql->result_array();
      }else{
        return false;
      } 
  }


    function fetchpreg($herd_id,$tag){
        $userId = $this->session->userdata('UID');
  
         $sql = $this->db->query("select vw_livestock_currentanimal.tag,ls_pregnancy.offspringQTY,ls_pregnancy.dateoftest,ls_pregnancy.duedate,vw_livestock_currentanimal.sex,vw_livestock_currentanimal.herd_description,vw_livestock_currentanimal.weight from vw_livestock_currentanimal
left join ls_pregnancy on vw_livestock_currentanimal.tag = ls_pregnancy.tag
where vw_livestock_currentanimal.tag = '$tag'");

      //echo $this->db->last_query();
      if($sql->num_rows() > 0){
        return $sql->result_array();
      }else{
        return false;
      }
  }

function fetchoperations($header){
        $userId = $this->session->userdata('UID');

        if($header == 'null'){
          $header = 0;
        }
         $sql = $this->db->query("select *,(select operation from ls_operations where Id = branding) op from ls_brandings left join ls_operations on ls_brandings.header_id = ls_operations.Id where header_id = '$header'");
        

      //echo $this->db->last_query();
      if($sql->num_rows() > 0){
        return $sql->result_array();
      }else{
        return false;
      }
  }

  function fetchoperationscount($header){
        $userId = $this->session->userdata('UID');

        if($header == 'null'){
          $header = 0;
        }
         $sql = $this->db->query("select count(*) from ls_brandings left join ls_operations on ls_brandings.header_id = ls_operations.Id where header_id = '$header'");
        

      //echo $this->db->last_query();
      if($sql->num_rows() > 0){
        return $sql->result_array();
      }else{
        return false;
      }
  }

function selectoperations(){

           $sql =("
 SELECT operation,id
  FROM [thabiso].[dbo].[ls_operations]
  ");

          // echo $this->db->last_query();
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }



  function selectfeeds(){

           $sql =("
 SELECT feed_name,feed_id
  FROM [thabiso].[dbo].[ls_feed]
  ");

    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }




   function selectuoms(){

           $sql =("
 SELECT uom,feed_id
  FROM [thabiso].[dbo].[ls_feed]
  ");

    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }


  function uomdropdowns(){

           $sql =("
 SELECT uom,id
  FROM [thabiso].[dbo].[ls_uom]
  ");

    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }


  function selectboosters(){

           $sql =("
 SELECT Name,Id
  FROM [thabiso].[dbo].[ls_boostersschedules]
  ");

          // echo $this->db->last_query();
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }

  function selectvaccines(){

           $sql =("
 SELECT Name,Id
  FROM [thabiso].[dbo].[ls_VaccinSchedules]
  ");

          // echo $this->db->last_query();
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }

function alllivestocksgroups($text){
      //   $userId = $this->session->userdata('UID');
  
         $sql = $this->db->query("select main_table.camp_name, avg(main_table.location_id) herdid,
count(main_table.Totalanimals) totalanimals, 
main_table.Males males, 
main_table.Females females, 
sum(main_table.cows) cows, 
sum(main_table.h) h,
sum(main_table.cattles) cattles,
sum(main_table.sheeps) sheeps,
sum(main_table.goats) goats,
sum(main_table.sick) sick,
max(isnull(count,0))animalsneedingvaccine ,
max(isnull(animalsneedingbooster,0))animalsneedingbooster ,
(select herd_name from ls_herd where camp_id =  main_table.camp) herd,(select herd_id from ls_herd where camp_id =  main_table.camp) herd_id,main_table.camp 
from(
select ls_camp.camp_name,mastr.Totalanimals,male.Males ,female.Females,mastr.camp,location_id,
(select count(preg_id) from ls_pregnancy where ls_pregnancy.tag = mastr.tag) cows,
(select count(sick) from ls_cattle_checklist where tag = mastr.tag and sick=1) sick,
(select count(vw_livestock_currentanimal.tag) from vw_livestock_currentanimal where vw_livestock_currentanimal.tag not in(select ls_pregnancy.tag from ls_pregnancy where ls_pregnancy.tag = mastr.tag) and vw_livestock_currentanimal.sex = 'Female' and vw_livestock_currentanimal.tag = mastr.tag) h,
(select count(vw_livestock_currentanimal.tag) from vw_livestock_currentanimal where  vw_livestock_currentanimal.type_id = 1 and vw_livestock_currentanimal.tag = mastr.tag) cattles,
(select count(vw_livestock_currentanimal.tag) from vw_livestock_currentanimal where  vw_livestock_currentanimal.type_id = 8 and vw_livestock_currentanimal.tag = mastr.tag) sheeps,
(select count(vw_livestock_currentanimal.tag) from vw_livestock_currentanimal where  vw_livestock_currentanimal.type_id = 9 and vw_livestock_currentanimal.tag = mastr.tag) goats
from (select camp, count(master_id) Totalanimals,tag,location_id
from vw_livestock_currentanimal where status !='Disposed' group by camp,tag,location_id) mastr
left join ls_camp on mastr.camp =  ls_camp.camp_id
left join (select count(sex) Males, vw_livestock_currentanimal.camp from vw_livestock_currentanimal where vw_livestock_currentanimal.sex = 'Male' and status !='Disposed' and camp = vw_livestock_currentanimal.camp group by vw_livestock_currentanimal.camp) male on mastr.camp = male.camp
left join (select count(sex) Females, vw_livestock_currentanimal.camp from vw_livestock_currentanimal where vw_livestock_currentanimal.sex = 'Female'  and status !='Disposed' group by vw_livestock_currentanimal.camp) female on mastr.camp = female.camp
) main_table
left join 
-- vaccine start
(select location_id,count(location_id)count from ((select location_id,tag,count(tag)  count from thabiso.dbo.[vw_livestock_currentanimal] a
join (
SELECT vs.[Id]
      ,vs.[Name]
      ,vs.[VaccinePeriod]
      ,vs.[Gender]
      ,vs.[Animal_type]
      ,vs.[Breed]
      ,vs.[datecreated]
      ,vs.[createdby]
  ,vp.VaccineDayStart
  ,vp.VaccineDayEnd

  FROM [thabiso].[dbo].[ls_VaccineSchedules] vs
  join [thabiso].[dbo].[ls_VaccinSchedules] vp 
on vs.VaccinePeriod=vp.Id
) vac on ((a.vaccineage between vac.VaccineDayStart -15 and vac.VaccineDayEnd+15))
and vac.Animal_type=a.type_id
and vac.Breed=a.breed_id
and (vac.Gender=a.sex OR vac.Gender='both')
group by location_id,tag)
) t
group by location_id) vac
-- vaccins end
on cast(vac.location_id as varchar(50))=main_table.location_id
left join 
-- booster start
(select herd_id,count(tag)animalsneedingbooster from (
select distinct herd_id,tag from (
-- booster month start
select tag,location_id herd_id,name from thabiso.dbo.[vw_livestock_currentanimal] a
join (select * from (
-- add 15 days start
SELECT *
,UPPER(LEFT(SUBSTRING('JAN FEB MAR APR MAY JUN JUL AUG SEP OCT NOV DEC', (datepart(month,dateadd(day,15,getdate())) * 4) - 3, 3),1))+LOWER(SUBSTRING(SUBSTRING('JAN FEB MAR APR MAY JUN JUL AUG SEP OCT NOV DEC', (datepart(month,dateadd(day,15,getdate())) * 4) - 3, 3),2,LEN(SUBSTRING('JAN FEB MAR APR MAY JUN JUL AUG SEP OCT NOV DEC', (datepart(month,dateadd(day,15,getdate())) * 4) - 3, 3)))) cmonth
  FROM [thabiso].[dbo].ls_BoostersSchedules vs
  -- add 15 days end
  UNION
  -- subtract 15 days start
  SELECT *
,UPPER(LEFT(SUBSTRING('JAN FEB MAR APR MAY JUN JUL AUG SEP OCT NOV DEC', (datepart(month,dateadd(day,-15,getdate())) * 4) - 3, 3),1))+LOWER(SUBSTRING(SUBSTRING('JAN FEB MAR APR MAY JUN JUL AUG SEP OCT NOV DEC', (datepart(month,dateadd(day,-15,getdate())) * 4) - 3, 3),2,LEN(SUBSTRING('JAN FEB MAR APR MAY JUN JUL AUG SEP OCT NOV DEC', (datepart(month,dateadd(day,-15,getdate())) * 4) - 3, 3)))) cmonth
  FROM [thabiso].[dbo].ls_BoostersSchedules vs
  -- subtract 15 days end
) t
where CHARINDEX(cmonth,Months)>0 and CHARINDEX(cmonth,Months) is not null
 
 ) boo 
on boo.Animal_type=a.type_id
and boo.Breed=a.breed_id
and (boo.Gender=a.sex OR boo.Gender='both')
-- booster month end

UNION

-- booster pregnancy before start

SELECT a.tag,a.location_id herd_id,name
from  [thabiso].[dbo].[vw_livestock_currentanimal] a
    left join [thabiso].[dbo].[ls_pregnancy] p
  on p.tag=a.tag
join [thabiso].[dbo].[ls_BoostersSchedules] bp
  on 
  (DaysBefore between  (DATEDIFF(day,getdate(),duedate)-15) and (DATEDIFF(day,getdate(),duedate)+15))
  and a.type_id=bp.Animal_type 
  and a.breed_id=bp.Breed 
  and (bp.Gender=a.sex OR bp.Gender='both')
  where link=1 and p.status='pregnant'


-- booster pregnancy before end

UNION

-- booster pregnancy after start

SELECT a.tag,a.location_id herd_id,name
from  [thabiso].[dbo].[vw_livestock_currentanimal] a
    left join [thabiso].[dbo].[ls_pregnancy] p
  on p.tag=a.tag
left join [thabiso].[dbo].[vw_livestock_currentanimal] os 
on os.details_of_parents_mother=a.tag

join [thabiso].[dbo].[ls_BoostersSchedules] bp
  on 
  (DaysAfter between  (DATEDIFF(day,getdate(),os.dob)-15) and (DATEDIFF(day,getdate(),os.dob)+15))
  and a.type_id=bp.Animal_type 
  and a.breed_id=bp.Breed 
  and (bp.Gender=a.sex OR bp.Gender='both')
  where link=1 and p.status='successful'


--bbooster pregnancy after end
UNION
--booaster before mating start

SELECT tag,herd_id,name
  FROM [thabiso].[dbo].[ls_production_plan]pp
  join [thabiso].[dbo].[ls_BoostersSchedules] bs
  on bs.link=2 and (
  (bs.DaysBefore+15)>(DATEDIFF(day,start_date,end_date)) 
  or 
  DATEDIFF(day,start_date,end_date)<0
  
  )
  join [thabiso].[dbo].[vw_livestock_currentanimal] a
  on a.location_id=pp.herd_id

  where activity = (select id from [thabiso].[dbo].[ls_operations] where operation='mating') and pp.status in (1,2)
  
-- booster before matng end
) t
)t group by herd_id) boo
on boo.herd_id=main_table.location_id


-- booster end
group by camp_name,camp,main_table.Males,main_table.Females");

      //echo $this->db->last_query();
      if($sql->num_rows() > 0){
        return $sql->result_array();
      }else{
        return false;
      }
  }

    function fetchdiagnosis($tag,$searchtext,$cuser){
     
           $sql =("select header_id,Id product_used_id,diagnosis,product_used,qty,date,sick,
(select diagnosis_name from ls_diagnosis where diagnosis_id = main.diagnosis) diagnosis_name
 from ls_products_used main where header_id = $tag");

          
    $results = $this->db->query($sql);
//echo $this->db->last_query();
    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }



  function fetchanimals($camp,$herd_id,$option){
    //echo '<pre>'.print_r($gender,true).'</pre>';exit;
    $str = '';
          if($option == ''){
            $str = '';
          }else{
            $str = " and sex = '$option'"; 
          }
     
     if($option == 'cow'){
      $sql = "select *,(select count(*) as vacs from (select tag,dob,location_id,[type_id],breed_id,sex,herd_description,camp,vaccineage,name vaccine,VaccineDayStart,VaccineDayEnd from thabiso.dbo.[vw_livestock_currentanimal] a
join (
SELECT vs.[Id]
      ,vs.[Name]
      ,vs.[VaccinePeriod]
      ,vs.[Gender]
      ,vs.[Animal_type]
      ,vs.[Breed]
      ,vs.[datecreated]
      ,vs.[createdby]
  ,vp.VaccineDayStart
  ,vp.VaccineDayEnd

  FROM [thabiso].[dbo].[ls_VaccineSchedules] vs
  join [thabiso].[dbo].[ls_VaccinSchedules] vp 
on vs.VaccinePeriod=vp.Id
) vac on ((a.vaccineage between vac.VaccineDayStart -15 and vac.VaccineDayEnd+15))
and vac.Animal_type=a.type_id
and vac.Breed=a.breed_id
and (vac.Gender=a.sex OR vac.Gender='both')
where tag = main.tag)t) as needvaccine from (select *,vw_livestock_currentanimal.tag mtag,vw_livestock_currentanimal.sex msex,vw_livestock_currentanimal.weight mweight from vw_livestock_currentanimal where vw_livestock_currentanimal.status !='Disposed' and tag in(select tag from ls_pregnancy where ls_pregnancy.tag = vw_livestock_currentanimal.tag)) main
left join (select tag,sick,(select count(*) ops from ls_vaccine_used where header_id = ls_cattle_checklist.Id) vaccines,(select  count(tag) from (

-- booster month start

select tag,name,location_id from thabiso.dbo.[vw_livestock_currentanimal] a

join (select * from (

-- add 15 days start

SELECT *

,UPPER(LEFT(SUBSTRING('JAN FEB MAR APR MAY JUN JUL AUG SEP OCT NOV DEC', (datepart(month,dateadd(day,15,getdate())) * 4) - 3, 3),1))+LOWER(SUBSTRING(SUBSTRING('JAN FEB MAR APR MAY JUN JUL AUG SEP OCT NOV DEC', (datepart(month,dateadd(day,15,getdate())) * 4) - 3, 3),2,LEN(SUBSTRING('JAN FEB MAR APR MAY JUN JUL AUG SEP OCT NOV DEC', (datepart(month,dateadd(day,15,getdate())) * 4) - 3, 3)))) cmonth

  FROM [thabiso].[dbo].ls_BoostersSchedules vs

  -- add 15 days end

  UNION

  -- subtract 15 days start

  SELECT *

,UPPER(LEFT(SUBSTRING('JAN FEB MAR APR MAY JUN JUL AUG SEP OCT NOV DEC', (datepart(month,dateadd(day,-15,getdate())) * 4) - 3, 3),1))+LOWER(SUBSTRING(SUBSTRING('JAN FEB MAR APR MAY JUN JUL AUG SEP OCT NOV DEC', (datepart(month,dateadd(day,-15,getdate())) * 4) - 3, 3),2,LEN(SUBSTRING('JAN FEB MAR APR MAY JUN JUL AUG SEP OCT NOV DEC', (datepart(month,dateadd(day,-15,getdate())) * 4) - 3, 3)))) cmonth

  FROM [thabiso].[dbo].ls_BoostersSchedules vs

  -- subtract 15 days end

) t

where CHARINDEX(cmonth,Months)>0 and CHARINDEX(cmonth,Months) is not null


 ) boo

on boo.Animal_type=a.type_id

and boo.Breed=a.breed_id

and (boo.Gender=a.sex OR boo.Gender='both')

-- booster month end

 

UNION

 

-- booster pregnancy before start

 

SELECT a.tag,name,a.location_id

from  [thabiso].[dbo].[vw_livestock_currentanimal] a

    left join [thabiso].[dbo].[ls_pregnancy] p

  on p.tag=a.tag

join [thabiso].[dbo].[ls_BoostersSchedules] bp

  on

  (DaysBefore between  (DATEDIFF(day,getdate(),duedate)-15) and (DATEDIFF(day,getdate(),duedate)+15))

  and a.type_id=bp.Animal_type

  and a.breed_id=bp.Breed

  and (bp.Gender=a.sex OR bp.Gender='both')

  where link=1 and p.status='pregnant'

 

 

-- booster pregnancy before end

 

UNION

 

-- booster pregnancy after start

 

SELECT a.tag,name,a.location_id

from  [thabiso].[dbo].[vw_livestock_currentanimal] a

    left join [thabiso].[dbo].[ls_pregnancy] p

         on p.tag=a.tag

       left join [thabiso].[dbo].[vw_livestock_currentanimal] os

       on os.details_of_parents_mother=a.tag

 

join [thabiso].[dbo].[ls_BoostersSchedules] bp

  on

  (DaysAfter between  (DATEDIFF(day,getdate(),os.dob)-15) and (DATEDIFF(day,getdate(),os.dob)+15))

  and a.type_id=bp.Animal_type

  and a.breed_id=bp.Breed

  and (bp.Gender=a.sex OR bp.Gender='both')

  where link=1 and p.status='successful'

 

 

--bbooster pregnancy after end

)a where location_id = $camp and tag = ls_cattle_checklist.tag group by location_id,tag) boosters,Id header,(select count(*) ops from ls_brandings left join ls_operations on ls_brandings.header_id = ls_operations.Id where header_id = ls_cattle_checklist.Id) hasoperation from ls_cattle_checklist) cl on main.tag = cl.tag
left join (select status,tag from ls_pregnancy) preg on main.tag = preg.tag";
     }else if($option == 'heifer'){
        $sql = "select *,(select count(*) as vacs from (select tag,dob,location_id,[type_id],breed_id,sex,herd_description,camp,vaccineage,name vaccine,VaccineDayStart,VaccineDayEnd from thabiso.dbo.[vw_livestock_currentanimal] a
join (
SELECT vs.[Id]
      ,vs.[Name]
      ,vs.[VaccinePeriod]
      ,vs.[Gender]
      ,vs.[Animal_type]
      ,vs.[Breed]
      ,vs.[datecreated]
      ,vs.[createdby]
  ,vp.VaccineDayStart
  ,vp.VaccineDayEnd

  FROM [thabiso].[dbo].[ls_VaccineSchedules] vs
  join [thabiso].[dbo].[ls_VaccinSchedules] vp 
on vs.VaccinePeriod=vp.Id
) vac on ((a.vaccineage between vac.VaccineDayStart -15 and vac.VaccineDayEnd+15))
and vac.Animal_type=a.type_id
and vac.Breed=a.breed_id
and (vac.Gender=a.sex OR vac.Gender='both')
where tag = main.tag)t) as needvaccine from (select *,vw_livestock_currentanimal.tag mtag,vw_livestock_currentanimal.sex msex,vw_livestock_currentanimal.weight mweight from vw_livestock_currentanimal where tag in(select tag from vw_livestock_currentanimal 
where vw_livestock_currentanimal.status !='Disposed' and vw_livestock_currentanimal.tag not in(select ls_pregnancy.tag from ls_pregnancy where ls_pregnancy.tag = vw_livestock_currentanimal.tag) 
and vw_livestock_currentanimal.tag = vw_livestock_currentanimal.tag) and vw_livestock_currentanimal.sex = 'Female'  and camp = $camp) main
left join (select tag,sick,(select count(*) ops from ls_vaccine_used where header_id = ls_cattle_checklist.Id) vaccines,(select  count(tag) from (

-- booster month start

select tag,name,location_id from thabiso.dbo.[vw_livestock_currentanimal] a

join (select * from (

-- add 15 days start

SELECT *

,UPPER(LEFT(SUBSTRING('JAN FEB MAR APR MAY JUN JUL AUG SEP OCT NOV DEC', (datepart(month,dateadd(day,15,getdate())) * 4) - 3, 3),1))+LOWER(SUBSTRING(SUBSTRING('JAN FEB MAR APR MAY JUN JUL AUG SEP OCT NOV DEC', (datepart(month,dateadd(day,15,getdate())) * 4) - 3, 3),2,LEN(SUBSTRING('JAN FEB MAR APR MAY JUN JUL AUG SEP OCT NOV DEC', (datepart(month,dateadd(day,15,getdate())) * 4) - 3, 3)))) cmonth

  FROM [thabiso].[dbo].ls_BoostersSchedules vs

  -- add 15 days end

  UNION

  -- subtract 15 days start

  SELECT *

,UPPER(LEFT(SUBSTRING('JAN FEB MAR APR MAY JUN JUL AUG SEP OCT NOV DEC', (datepart(month,dateadd(day,-15,getdate())) * 4) - 3, 3),1))+LOWER(SUBSTRING(SUBSTRING('JAN FEB MAR APR MAY JUN JUL AUG SEP OCT NOV DEC', (datepart(month,dateadd(day,-15,getdate())) * 4) - 3, 3),2,LEN(SUBSTRING('JAN FEB MAR APR MAY JUN JUL AUG SEP OCT NOV DEC', (datepart(month,dateadd(day,-15,getdate())) * 4) - 3, 3)))) cmonth

  FROM [thabiso].[dbo].ls_BoostersSchedules vs

  -- subtract 15 days end

) t

where CHARINDEX(cmonth,Months)>0 and CHARINDEX(cmonth,Months) is not null


 ) boo

on boo.Animal_type=a.type_id

and boo.Breed=a.breed_id

and (boo.Gender=a.sex OR boo.Gender='both')

-- booster month end

 

UNION

 

-- booster pregnancy before start

 

SELECT a.tag,name,a.location_id

from  [thabiso].[dbo].[vw_livestock_currentanimal] a

    left join [thabiso].[dbo].[ls_pregnancy] p

  on p.tag=a.tag

join [thabiso].[dbo].[ls_BoostersSchedules] bp

  on

  (DaysBefore between  (DATEDIFF(day,getdate(),duedate)-15) and (DATEDIFF(day,getdate(),duedate)+15))

  and a.type_id=bp.Animal_type

  and a.breed_id=bp.Breed

  and (bp.Gender=a.sex OR bp.Gender='both')

  where link=1 and p.status='pregnant'

 

 

-- booster pregnancy before end

 

UNION

 

-- booster pregnancy after start

 

SELECT a.tag,name,a.location_id

from  [thabiso].[dbo].[vw_livestock_currentanimal] a

    left join [thabiso].[dbo].[ls_pregnancy] p

         on p.tag=a.tag

       left join [thabiso].[dbo].[vw_livestock_currentanimal] os

       on os.details_of_parents_mother=a.tag

 

join [thabiso].[dbo].[ls_BoostersSchedules] bp

  on

  (DaysAfter between  (DATEDIFF(day,getdate(),os.dob)-15) and (DATEDIFF(day,getdate(),os.dob)+15))

  and a.type_id=bp.Animal_type

  and a.breed_id=bp.Breed

  and (bp.Gender=a.sex OR bp.Gender='both')

  where link=1 and p.status='successful'

 

 

--bbooster pregnancy after end

)a where location_id = $camp and tag = ls_cattle_checklist.tag group by location_id,tag) boosters,Id header,(select count(*) ops from ls_brandings left join ls_operations on ls_brandings.header_id = ls_operations.Id where header_id = ls_cattle_checklist.Id) hasoperation from ls_cattle_checklist) cl on main.tag = cl.tag
left join (select status,tag from ls_pregnancy) preg on main.tag = preg.tag";
     }else if($option == '9'){
        $sql = "select *,(select count(*) as vacs from (select tag,dob,location_id,[type_id],breed_id,sex,herd_description,camp,vaccineage,name vaccine,VaccineDayStart,VaccineDayEnd from thabiso.dbo.[vw_livestock_currentanimal] a
join (
SELECT vs.[Id]
      ,vs.[Name]
      ,vs.[VaccinePeriod]
      ,vs.[Gender]
      ,vs.[Animal_type]
      ,vs.[Breed]
      ,vs.[datecreated]
      ,vs.[createdby]
  ,vp.VaccineDayStart
  ,vp.VaccineDayEnd

  FROM [thabiso].[dbo].[ls_VaccineSchedules] vs
  join [thabiso].[dbo].[ls_VaccinSchedules] vp 
on vs.VaccinePeriod=vp.Id
) vac on ((a.vaccineage between vac.VaccineDayStart -15 and vac.VaccineDayEnd+15))
and vac.Animal_type=a.type_id
and vac.Breed=a.breed_id
and (vac.Gender=a.sex OR vac.Gender='both')
where tag = main.tag)t) as needvaccine from (select *,vw_livestock_currentanimal.tag mtag,vw_livestock_currentanimal.sex msex,vw_livestock_currentanimal.weight mweight from vw_livestock_currentanimal where tag in(select tag from vw_livestock_currentanimal 
where vw_livestock_currentanimal.status !='Disposed' and vw_livestock_currentanimal.type_id = 9
and vw_livestock_currentanimal.tag = vw_livestock_currentanimal.tag)  and camp = $camp) main
left join (select tag,sick,(select count(*) ops from ls_vaccine_used where header_id = ls_cattle_checklist.Id) vaccines,(select  count(tag) from (

-- booster month start

select tag,name,location_id from thabiso.dbo.[vw_livestock_currentanimal] a

join (select * from (

-- add 15 days start

SELECT *

,UPPER(LEFT(SUBSTRING('JAN FEB MAR APR MAY JUN JUL AUG SEP OCT NOV DEC', (datepart(month,dateadd(day,15,getdate())) * 4) - 3, 3),1))+LOWER(SUBSTRING(SUBSTRING('JAN FEB MAR APR MAY JUN JUL AUG SEP OCT NOV DEC', (datepart(month,dateadd(day,15,getdate())) * 4) - 3, 3),2,LEN(SUBSTRING('JAN FEB MAR APR MAY JUN JUL AUG SEP OCT NOV DEC', (datepart(month,dateadd(day,15,getdate())) * 4) - 3, 3)))) cmonth

  FROM [thabiso].[dbo].ls_BoostersSchedules vs

  -- add 15 days end

  UNION

  -- subtract 15 days start

  SELECT *

,UPPER(LEFT(SUBSTRING('JAN FEB MAR APR MAY JUN JUL AUG SEP OCT NOV DEC', (datepart(month,dateadd(day,-15,getdate())) * 4) - 3, 3),1))+LOWER(SUBSTRING(SUBSTRING('JAN FEB MAR APR MAY JUN JUL AUG SEP OCT NOV DEC', (datepart(month,dateadd(day,-15,getdate())) * 4) - 3, 3),2,LEN(SUBSTRING('JAN FEB MAR APR MAY JUN JUL AUG SEP OCT NOV DEC', (datepart(month,dateadd(day,-15,getdate())) * 4) - 3, 3)))) cmonth

  FROM [thabiso].[dbo].ls_BoostersSchedules vs

  -- subtract 15 days end

) t

where CHARINDEX(cmonth,Months)>0 and CHARINDEX(cmonth,Months) is not null


 ) boo

on boo.Animal_type=a.type_id

and boo.Breed=a.breed_id

and (boo.Gender=a.sex OR boo.Gender='both')

-- booster month end

 

UNION

 

-- booster pregnancy before start

 

SELECT a.tag,name,a.location_id

from  [thabiso].[dbo].[vw_livestock_currentanimal] a

    left join [thabiso].[dbo].[ls_pregnancy] p

  on p.tag=a.tag

join [thabiso].[dbo].[ls_BoostersSchedules] bp

  on

  (DaysBefore between  (DATEDIFF(day,getdate(),duedate)-15) and (DATEDIFF(day,getdate(),duedate)+15))

  and a.type_id=bp.Animal_type

  and a.breed_id=bp.Breed

  and (bp.Gender=a.sex OR bp.Gender='both')

  where link=1 and p.status='pregnant'

 

 

-- booster pregnancy before end

 

UNION

 

-- booster pregnancy after start

 

SELECT a.tag,name,a.location_id

from  [thabiso].[dbo].[vw_livestock_currentanimal] a

    left join [thabiso].[dbo].[ls_pregnancy] p

         on p.tag=a.tag

       left join [thabiso].[dbo].[vw_livestock_currentanimal] os

       on os.details_of_parents_mother=a.tag

 

join [thabiso].[dbo].[ls_BoostersSchedules] bp

  on

  (DaysAfter between  (DATEDIFF(day,getdate(),os.dob)-15) and (DATEDIFF(day,getdate(),os.dob)+15))

  and a.type_id=bp.Animal_type

  and a.breed_id=bp.Breed

  and (bp.Gender=a.sex OR bp.Gender='both')

  where link=1 and p.status='successful'

 

 

--bbooster pregnancy after end

)a where location_id = $camp and tag = ls_cattle_checklist.tag group by location_id,tag) boosters,Id header,(select count(*) ops from ls_brandings left join ls_operations on ls_brandings.header_id = ls_operations.Id where header_id = ls_cattle_checklist.Id) hasoperation from ls_cattle_checklist) cl on main.tag = cl.tag
left join (select status,tag from ls_pregnancy) preg on main.tag = preg.tag";
     }else if($option == '4'){
        $sql = "select *,(select count(*) as vacs from (select tag,dob,location_id,[type_id],breed_id,sex,herd_description,camp,vaccineage,name vaccine,VaccineDayStart,VaccineDayEnd from thabiso.dbo.[vw_livestock_currentanimal] a
join (
SELECT vs.[Id]
      ,vs.[Name]
      ,vs.[VaccinePeriod]
      ,vs.[Gender]
      ,vs.[Animal_type]
      ,vs.[Breed]
      ,vs.[datecreated]
      ,vs.[createdby]
  ,vp.VaccineDayStart
  ,vp.VaccineDayEnd

  FROM [thabiso].[dbo].[ls_VaccineSchedules] vs
  join [thabiso].[dbo].[ls_VaccinSchedules] vp 
on vs.VaccinePeriod=vp.Id
) vac on ((a.vaccineage between vac.VaccineDayStart -15 and vac.VaccineDayEnd+15))
and vac.Animal_type=a.type_id
and vac.Breed=a.breed_id
and (vac.Gender=a.sex OR vac.Gender='both')
where tag = main.tag)t) as needvaccine from (select *,vw_livestock_currentanimal.tag mtag,vw_livestock_currentanimal.sex msex,vw_livestock_currentanimal.weight mweight from vw_livestock_currentanimal where tag in(select tag from vw_livestock_currentanimal 
where vw_livestock_currentanimal.status !='Disposed' and vw_livestock_currentanimal.type_id = 1
and vw_livestock_currentanimal.tag = vw_livestock_currentanimal.tag)  and camp = $camp) main
left join (select tag,sick,(select count(*) ops from ls_vaccine_used where header_id = ls_cattle_checklist.Id) vaccines,(select  count(tag) from (

-- booster month start

select tag,name,location_id from thabiso.dbo.[vw_livestock_currentanimal] a

join (select * from (

-- add 15 days start

SELECT *

,UPPER(LEFT(SUBSTRING('JAN FEB MAR APR MAY JUN JUL AUG SEP OCT NOV DEC', (datepart(month,dateadd(day,15,getdate())) * 4) - 3, 3),1))+LOWER(SUBSTRING(SUBSTRING('JAN FEB MAR APR MAY JUN JUL AUG SEP OCT NOV DEC', (datepart(month,dateadd(day,15,getdate())) * 4) - 3, 3),2,LEN(SUBSTRING('JAN FEB MAR APR MAY JUN JUL AUG SEP OCT NOV DEC', (datepart(month,dateadd(day,15,getdate())) * 4) - 3, 3)))) cmonth

  FROM [thabiso].[dbo].ls_BoostersSchedules vs

  -- add 15 days end

  UNION

  -- subtract 15 days start

  SELECT *

,UPPER(LEFT(SUBSTRING('JAN FEB MAR APR MAY JUN JUL AUG SEP OCT NOV DEC', (datepart(month,dateadd(day,-15,getdate())) * 4) - 3, 3),1))+LOWER(SUBSTRING(SUBSTRING('JAN FEB MAR APR MAY JUN JUL AUG SEP OCT NOV DEC', (datepart(month,dateadd(day,-15,getdate())) * 4) - 3, 3),2,LEN(SUBSTRING('JAN FEB MAR APR MAY JUN JUL AUG SEP OCT NOV DEC', (datepart(month,dateadd(day,-15,getdate())) * 4) - 3, 3)))) cmonth

  FROM [thabiso].[dbo].ls_BoostersSchedules vs

  -- subtract 15 days end

) t

where CHARINDEX(cmonth,Months)>0 and CHARINDEX(cmonth,Months) is not null


 ) boo

on boo.Animal_type=a.type_id

and boo.Breed=a.breed_id

and (boo.Gender=a.sex OR boo.Gender='both')

-- booster month end

 

UNION

 

-- booster pregnancy before start

 

SELECT a.tag,name,a.location_id

from  [thabiso].[dbo].[vw_livestock_currentanimal] a

    left join [thabiso].[dbo].[ls_pregnancy] p

  on p.tag=a.tag

join [thabiso].[dbo].[ls_BoostersSchedules] bp

  on

  (DaysBefore between  (DATEDIFF(day,getdate(),duedate)-15) and (DATEDIFF(day,getdate(),duedate)+15))

  and a.type_id=bp.Animal_type

  and a.breed_id=bp.Breed

  and (bp.Gender=a.sex OR bp.Gender='both')

  where link=1 and p.status='pregnant'

 

 

-- booster pregnancy before end

 

UNION

 

-- booster pregnancy after start

 

SELECT a.tag,name,a.location_id

from  [thabiso].[dbo].[vw_livestock_currentanimal] a

    left join [thabiso].[dbo].[ls_pregnancy] p

         on p.tag=a.tag

       left join [thabiso].[dbo].[vw_livestock_currentanimal] os

       on os.details_of_parents_mother=a.tag

 

join [thabiso].[dbo].[ls_BoostersSchedules] bp

  on

  (DaysAfter between  (DATEDIFF(day,getdate(),os.dob)-15) and (DATEDIFF(day,getdate(),os.dob)+15))

  and a.type_id=bp.Animal_type

  and a.breed_id=bp.Breed

  and (bp.Gender=a.sex OR bp.Gender='both')

  where link=1 and p.status='successful'

 

 

--bbooster pregnancy after end

)a where location_id = $camp and tag = ls_cattle_checklist.tag group by location_id,tag) boosters,Id header,(select count(*) ops from ls_brandings left join ls_operations on ls_brandings.header_id = ls_operations.Id where header_id = ls_cattle_checklist.Id) hasoperation from ls_cattle_checklist) cl on main.tag = cl.tag
left join (select status,tag from ls_pregnancy) preg on main.tag = preg.tag";
     }else if($option == '8'){
        $sql = "select *,(select count(*) as vacs from (select tag,dob,location_id,[type_id],breed_id,sex,herd_description,camp,vaccineage,name vaccine,VaccineDayStart,VaccineDayEnd from thabiso.dbo.[vw_livestock_currentanimal] a
join (
SELECT vs.[Id]
      ,vs.[Name]
      ,vs.[VaccinePeriod]
      ,vs.[Gender]
      ,vs.[Animal_type]
      ,vs.[Breed]
      ,vs.[datecreated]
      ,vs.[createdby]
  ,vp.VaccineDayStart
  ,vp.VaccineDayEnd

  FROM [thabiso].[dbo].[ls_VaccineSchedules] vs
  join [thabiso].[dbo].[ls_VaccinSchedules] vp 
on vs.VaccinePeriod=vp.Id
) vac on ((a.vaccineage between vac.VaccineDayStart -15 and vac.VaccineDayEnd+15))
and vac.Animal_type=a.type_id
and vac.Breed=a.breed_id
and (vac.Gender=a.sex OR vac.Gender='both')
where tag = main.tag)t) as needvaccine from (select *,vw_livestock_currentanimal.tag mtag,vw_livestock_currentanimal.sex msex,vw_livestock_currentanimal.weight mweight from vw_livestock_currentanimal where tag in(select tag from vw_livestock_currentanimal 
where vw_livestock_currentanimal.status !='Disposed' and vw_livestock_currentanimal.type_id = 8
and vw_livestock_currentanimal.tag = vw_livestock_currentanimal.tag)  and camp = $camp) main
left join (select tag,sick,(select count(*) ops from ls_vaccine_used where header_id = ls_cattle_checklist.Id) vaccines,(select  count(tag) from (

-- booster month start

select tag,name,location_id from thabiso.dbo.[vw_livestock_currentanimal] a

join (select * from (

-- add 15 days start

SELECT *

,UPPER(LEFT(SUBSTRING('JAN FEB MAR APR MAY JUN JUL AUG SEP OCT NOV DEC', (datepart(month,dateadd(day,15,getdate())) * 4) - 3, 3),1))+LOWER(SUBSTRING(SUBSTRING('JAN FEB MAR APR MAY JUN JUL AUG SEP OCT NOV DEC', (datepart(month,dateadd(day,15,getdate())) * 4) - 3, 3),2,LEN(SUBSTRING('JAN FEB MAR APR MAY JUN JUL AUG SEP OCT NOV DEC', (datepart(month,dateadd(day,15,getdate())) * 4) - 3, 3)))) cmonth

  FROM [thabiso].[dbo].ls_BoostersSchedules vs

  -- add 15 days end

  UNION

  -- subtract 15 days start

  SELECT *

,UPPER(LEFT(SUBSTRING('JAN FEB MAR APR MAY JUN JUL AUG SEP OCT NOV DEC', (datepart(month,dateadd(day,-15,getdate())) * 4) - 3, 3),1))+LOWER(SUBSTRING(SUBSTRING('JAN FEB MAR APR MAY JUN JUL AUG SEP OCT NOV DEC', (datepart(month,dateadd(day,-15,getdate())) * 4) - 3, 3),2,LEN(SUBSTRING('JAN FEB MAR APR MAY JUN JUL AUG SEP OCT NOV DEC', (datepart(month,dateadd(day,-15,getdate())) * 4) - 3, 3)))) cmonth

  FROM [thabiso].[dbo].ls_BoostersSchedules vs

  -- subtract 15 days end

) t

where CHARINDEX(cmonth,Months)>0 and CHARINDEX(cmonth,Months) is not null


 ) boo

on boo.Animal_type=a.type_id

and boo.Breed=a.breed_id

and (boo.Gender=a.sex OR boo.Gender='both')

-- booster month end

 

UNION

 

-- booster pregnancy before start

 

SELECT a.tag,name,a.location_id

from  [thabiso].[dbo].[vw_livestock_currentanimal] a

    left join [thabiso].[dbo].[ls_pregnancy] p

  on p.tag=a.tag

join [thabiso].[dbo].[ls_BoostersSchedules] bp

  on

  (DaysBefore between  (DATEDIFF(day,getdate(),duedate)-15) and (DATEDIFF(day,getdate(),duedate)+15))

  and a.type_id=bp.Animal_type

  and a.breed_id=bp.Breed

  and (bp.Gender=a.sex OR bp.Gender='both')

  where link=1 and p.status='pregnant'

 

 

-- booster pregnancy before end

 

UNION

 

-- booster pregnancy after start

 

SELECT a.tag,name,a.location_id

from  [thabiso].[dbo].[vw_livestock_currentanimal] a

    left join [thabiso].[dbo].[ls_pregnancy] p

         on p.tag=a.tag

       left join [thabiso].[dbo].[vw_livestock_currentanimal] os

       on os.details_of_parents_mother=a.tag

 

join [thabiso].[dbo].[ls_BoostersSchedules] bp

  on

  (DaysAfter between  (DATEDIFF(day,getdate(),os.dob)-15) and (DATEDIFF(day,getdate(),os.dob)+15))

  and a.type_id=bp.Animal_type

  and a.breed_id=bp.Breed

  and (bp.Gender=a.sex OR bp.Gender='both')

  where link=1 and p.status='successful'

 

 

--bbooster pregnancy after end

)a where location_id = $camp and tag = ls_cattle_checklist.tag group by location_id,tag) boosters,Id header,(select count(*) ops from ls_brandings left join ls_operations on ls_brandings.header_id = ls_operations.Id where header_id = ls_cattle_checklist.Id) hasoperation from ls_cattle_checklist) cl on main.tag = cl.tag
left join (select status,tag from ls_pregnancy) preg on main.tag = preg.tag";
     }else if($option == 'sick'){
        $sql = "select *,(select count(*) as vacs from (select tag,dob,location_id,[type_id],breed_id,sex,herd_description,camp,vaccineage,name vaccine,VaccineDayStart,VaccineDayEnd from thabiso.dbo.[vw_livestock_currentanimal] a
join (
SELECT vs.[Id]
      ,vs.[Name]
      ,vs.[VaccinePeriod]
      ,vs.[Gender]
      ,vs.[Animal_type]
      ,vs.[Breed]
      ,vs.[datecreated]
      ,vs.[createdby]
  ,vp.VaccineDayStart
  ,vp.VaccineDayEnd

  FROM [thabiso].[dbo].[ls_VaccineSchedules] vs
  join [thabiso].[dbo].[ls_VaccinSchedules] vp 
on vs.VaccinePeriod=vp.Id
) vac on ((a.vaccineage between vac.VaccineDayStart -15 and vac.VaccineDayEnd+15))
and vac.Animal_type=a.type_id
and vac.Breed=a.breed_id
and (vac.Gender=a.sex OR vac.Gender='both')
where tag = main.tag)t) as needvaccine from (select *,vw_livestock_currentanimal.tag mtag,vw_livestock_currentanimal.sex msex,vw_livestock_currentanimal.weight mweight from vw_livestock_currentanimal where tag in(select tag from vw_livestock_currentanimal 
where vw_livestock_currentanimal.status !='Disposed' and  vw_livestock_currentanimal.tag in(select ls_cattle_checklist.tag from ls_cattle_checklist where sick  = 1) 
and vw_livestock_currentanimal.tag = vw_livestock_currentanimal.tag) and camp = $camp) main
left join (select tag,sick,(select count(*) ops from ls_vaccine_used where header_id = ls_cattle_checklist.Id) vaccines,(select  count(tag) from (

-- booster month start

select tag,name,location_id from thabiso.dbo.[vw_livestock_currentanimal] a

join (select * from (

-- add 15 days start

SELECT *

,UPPER(LEFT(SUBSTRING('JAN FEB MAR APR MAY JUN JUL AUG SEP OCT NOV DEC', (datepart(month,dateadd(day,15,getdate())) * 4) - 3, 3),1))+LOWER(SUBSTRING(SUBSTRING('JAN FEB MAR APR MAY JUN JUL AUG SEP OCT NOV DEC', (datepart(month,dateadd(day,15,getdate())) * 4) - 3, 3),2,LEN(SUBSTRING('JAN FEB MAR APR MAY JUN JUL AUG SEP OCT NOV DEC', (datepart(month,dateadd(day,15,getdate())) * 4) - 3, 3)))) cmonth

  FROM [thabiso].[dbo].ls_BoostersSchedules vs

  -- add 15 days end

  UNION

  -- subtract 15 days start

  SELECT *

,UPPER(LEFT(SUBSTRING('JAN FEB MAR APR MAY JUN JUL AUG SEP OCT NOV DEC', (datepart(month,dateadd(day,-15,getdate())) * 4) - 3, 3),1))+LOWER(SUBSTRING(SUBSTRING('JAN FEB MAR APR MAY JUN JUL AUG SEP OCT NOV DEC', (datepart(month,dateadd(day,-15,getdate())) * 4) - 3, 3),2,LEN(SUBSTRING('JAN FEB MAR APR MAY JUN JUL AUG SEP OCT NOV DEC', (datepart(month,dateadd(day,-15,getdate())) * 4) - 3, 3)))) cmonth

  FROM [thabiso].[dbo].ls_BoostersSchedules vs

  -- subtract 15 days end

) t

where CHARINDEX(cmonth,Months)>0 and CHARINDEX(cmonth,Months) is not null


 ) boo

on boo.Animal_type=a.type_id

and boo.Breed=a.breed_id

and (boo.Gender=a.sex OR boo.Gender='both')

-- booster month end

 

UNION

 

-- booster pregnancy before start

 

SELECT a.tag,name,a.location_id

from  [thabiso].[dbo].[vw_livestock_currentanimal] a

    left join [thabiso].[dbo].[ls_pregnancy] p

  on p.tag=a.tag

join [thabiso].[dbo].[ls_BoostersSchedules] bp

  on

  (DaysBefore between  (DATEDIFF(day,getdate(),duedate)-15) and (DATEDIFF(day,getdate(),duedate)+15))

  and a.type_id=bp.Animal_type

  and a.breed_id=bp.Breed

  and (bp.Gender=a.sex OR bp.Gender='both')

  where link=1 and p.status='pregnant'

 

 

-- booster pregnancy before end

 

UNION

 

-- booster pregnancy after start

 

SELECT a.tag,name,a.location_id

from  [thabiso].[dbo].[vw_livestock_currentanimal] a

    left join [thabiso].[dbo].[ls_pregnancy] p

         on p.tag=a.tag

       left join [thabiso].[dbo].[vw_livestock_currentanimal] os

       on os.details_of_parents_mother=a.tag

 

join [thabiso].[dbo].[ls_BoostersSchedules] bp

  on

  (DaysAfter between  (DATEDIFF(day,getdate(),os.dob)-15) and (DATEDIFF(day,getdate(),os.dob)+15))

  and a.type_id=bp.Animal_type

  and a.breed_id=bp.Breed

  and (bp.Gender=a.sex OR bp.Gender='both')

  where link=1 and p.status='successful'

 

 

--bbooster pregnancy after end

)a where location_id = $camp and tag = ls_cattle_checklist.tag group by location_id,tag) boosters,Id header,(select count(*) ops from ls_brandings left join ls_operations on ls_brandings.header_id = ls_operations.Id where header_id = ls_cattle_checklist.Id) hasoperation from ls_cattle_checklist) cl on main.tag = cl.tag
left join (select status,tag from ls_pregnancy) preg on main.tag = preg.tag";
     }else if($option == 'vaccine'){
        $sql = "select *,(select count(*) as vacs from (select tag,dob,location_id,[type_id],breed_id,sex,herd_description,camp,vaccineage,name vaccine,VaccineDayStart,VaccineDayEnd from thabiso.dbo.[vw_livestock_currentanimal] a
join (
SELECT vs.[Id]
      ,vs.[Name]
      ,vs.[VaccinePeriod]
      ,vs.[Gender]
      ,vs.[Animal_type]
      ,vs.[Breed]
      ,vs.[datecreated]
      ,vs.[createdby]
  ,vp.VaccineDayStart
  ,vp.VaccineDayEnd

  FROM [thabiso].[dbo].[ls_VaccineSchedules] vs
  join [thabiso].[dbo].[ls_VaccinSchedules] vp 
on vs.VaccinePeriod=vp.Id
) vac on ((a.vaccineage between vac.VaccineDayStart -15 and vac.VaccineDayEnd+15))
and vac.Animal_type=a.type_id
and vac.Breed=a.breed_id
and (vac.Gender=a.sex OR vac.Gender='both')
where tag = main.tag)t) as needvaccine from (select *,vw_livestock_currentanimal.tag mtag,vw_livestock_currentanimal.sex msex,vw_livestock_currentanimal.weight mweight from vw_livestock_currentanimal where tag in(select tag from vw_livestock_currentanimal 
where vw_livestock_currentanimal.status !='Disposed' and vw_livestock_currentanimal.tag in((select tag from thabiso.dbo.[vw_livestock_currentanimal] a
join (
SELECT vs.[Id]
      ,vs.[Name]
      ,vs.[VaccinePeriod]
      ,vs.[Gender]
      ,vs.[Animal_type]
      ,vs.[Breed]
      ,vs.[datecreated]
      ,vs.[createdby]
  ,vp.VaccineDayStart
  ,vp.VaccineDayEnd

  FROM [thabiso].[dbo].[ls_VaccineSchedules] vs
  join [thabiso].[dbo].[ls_VaccinSchedules] vp 
on vs.VaccinePeriod=vp.Id
) vac on ((a.vaccineage between vac.VaccineDayStart -15 and vac.VaccineDayEnd+15))
and vac.Animal_type=a.type_id
and vac.Breed=a.breed_id
and (vac.Gender=a.sex OR vac.Gender='both')
where location_id = $camp 
group by tag,location_id,camp
)) 
and vw_livestock_currentanimal.tag = vw_livestock_currentanimal.tag) and camp = $camp) main
left join (select tag,sick,(select count(*) ops from ls_vaccine_used where header_id = ls_cattle_checklist.Id) vaccines,(select  count(tag) from (

-- booster month start

select tag,name,location_id from thabiso.dbo.[vw_livestock_currentanimal] a

join (select * from (

-- add 15 days start

SELECT *

,UPPER(LEFT(SUBSTRING('JAN FEB MAR APR MAY JUN JUL AUG SEP OCT NOV DEC', (datepart(month,dateadd(day,15,getdate())) * 4) - 3, 3),1))+LOWER(SUBSTRING(SUBSTRING('JAN FEB MAR APR MAY JUN JUL AUG SEP OCT NOV DEC', (datepart(month,dateadd(day,15,getdate())) * 4) - 3, 3),2,LEN(SUBSTRING('JAN FEB MAR APR MAY JUN JUL AUG SEP OCT NOV DEC', (datepart(month,dateadd(day,15,getdate())) * 4) - 3, 3)))) cmonth

  FROM [thabiso].[dbo].ls_BoostersSchedules vs

  -- add 15 days end

  UNION

  -- subtract 15 days start

  SELECT *

,UPPER(LEFT(SUBSTRING('JAN FEB MAR APR MAY JUN JUL AUG SEP OCT NOV DEC', (datepart(month,dateadd(day,-15,getdate())) * 4) - 3, 3),1))+LOWER(SUBSTRING(SUBSTRING('JAN FEB MAR APR MAY JUN JUL AUG SEP OCT NOV DEC', (datepart(month,dateadd(day,-15,getdate())) * 4) - 3, 3),2,LEN(SUBSTRING('JAN FEB MAR APR MAY JUN JUL AUG SEP OCT NOV DEC', (datepart(month,dateadd(day,-15,getdate())) * 4) - 3, 3)))) cmonth

  FROM [thabiso].[dbo].ls_BoostersSchedules vs

  -- subtract 15 days end

) t

where CHARINDEX(cmonth,Months)>0 and CHARINDEX(cmonth,Months) is not null


 ) boo

on boo.Animal_type=a.type_id

and boo.Breed=a.breed_id

and (boo.Gender=a.sex OR boo.Gender='both')

-- booster month end

 

UNION

 

-- booster pregnancy before start

 

SELECT a.tag,name,a.location_id

from  [thabiso].[dbo].[vw_livestock_currentanimal] a

    left join [thabiso].[dbo].[ls_pregnancy] p

  on p.tag=a.tag

join [thabiso].[dbo].[ls_BoostersSchedules] bp

  on

  (DaysBefore between  (DATEDIFF(day,getdate(),duedate)-15) and (DATEDIFF(day,getdate(),duedate)+15))

  and a.type_id=bp.Animal_type

  and a.breed_id=bp.Breed

  and (bp.Gender=a.sex OR bp.Gender='both')

  where link=1 and p.status='pregnant'

 

 

-- booster pregnancy before end

 

UNION

 

-- booster pregnancy after start

 

SELECT a.tag,name,a.location_id

from  [thabiso].[dbo].[vw_livestock_currentanimal] a

    left join [thabiso].[dbo].[ls_pregnancy] p

         on p.tag=a.tag

       left join [thabiso].[dbo].[vw_livestock_currentanimal] os

       on os.details_of_parents_mother=a.tag

 

join [thabiso].[dbo].[ls_BoostersSchedules] bp

  on

  (DaysAfter between  (DATEDIFF(day,getdate(),os.dob)-15) and (DATEDIFF(day,getdate(),os.dob)+15))

  and a.type_id=bp.Animal_type

  and a.breed_id=bp.Breed

  and (bp.Gender=a.sex OR bp.Gender='both')

  where link=1 and p.status='successful'

 

 

--bbooster pregnancy after end

)a where location_id = $camp and tag = ls_cattle_checklist.tag group by location_id,tag) boosters,Id header,(select count(*) ops from ls_brandings left join ls_operations on ls_brandings.header_id = ls_operations.Id where header_id = ls_cattle_checklist.Id) hasoperation from ls_cattle_checklist) cl on main.tag = cl.tag
left join (select status,tag from ls_pregnancy) preg on main.tag = preg.tag";
     }else if($option == 'booster'){
        $sql = "select * from (select *,vw_livestock_currentanimal.tag mtag,vw_livestock_currentanimal.sex msex,vw_livestock_currentanimal.weight mweight from vw_livestock_currentanimal where vw_livestock_currentanimal.status !='Disposed' and tag in(select tag from vw_livestock_currentanimal 
where vw_livestock_currentanimal.tag in(select tag from (

-- booster month start

select tag,name,location_id from thabiso.dbo.[vw_livestock_currentanimal] a

join (select * from (

-- add 15 days start

SELECT *

,UPPER(LEFT(SUBSTRING('JAN FEB MAR APR MAY JUN JUL AUG SEP OCT NOV DEC', (datepart(month,dateadd(day,15,getdate())) * 4) - 3, 3),1))+LOWER(SUBSTRING(SUBSTRING('JAN FEB MAR APR MAY JUN JUL AUG SEP OCT NOV DEC', (datepart(month,dateadd(day,15,getdate())) * 4) - 3, 3),2,LEN(SUBSTRING('JAN FEB MAR APR MAY JUN JUL AUG SEP OCT NOV DEC', (datepart(month,dateadd(day,15,getdate())) * 4) - 3, 3)))) cmonth

  FROM [thabiso].[dbo].ls_BoostersSchedules vs

  -- add 15 days end

  UNION

  -- subtract 15 days start

  SELECT *

,UPPER(LEFT(SUBSTRING('JAN FEB MAR APR MAY JUN JUL AUG SEP OCT NOV DEC', (datepart(month,dateadd(day,-15,getdate())) * 4) - 3, 3),1))+LOWER(SUBSTRING(SUBSTRING('JAN FEB MAR APR MAY JUN JUL AUG SEP OCT NOV DEC', (datepart(month,dateadd(day,-15,getdate())) * 4) - 3, 3),2,LEN(SUBSTRING('JAN FEB MAR APR MAY JUN JUL AUG SEP OCT NOV DEC', (datepart(month,dateadd(day,-15,getdate())) * 4) - 3, 3)))) cmonth

  FROM [thabiso].[dbo].ls_BoostersSchedules vs

  -- subtract 15 days end

) t

where CHARINDEX(cmonth,Months)>0 and CHARINDEX(cmonth,Months) is not null


 ) boo

on boo.Animal_type=a.type_id

and boo.Breed=a.breed_id

and (boo.Gender=a.sex OR boo.Gender='both')

-- booster month end

 

UNION

 

-- booster pregnancy before start

 

SELECT a.tag,name,a.location_id

from  [thabiso].[dbo].[vw_livestock_currentanimal] a

    left join [thabiso].[dbo].[ls_pregnancy] p

  on p.tag=a.tag

join [thabiso].[dbo].[ls_BoostersSchedules] bp

  on

  (DaysBefore between  (DATEDIFF(day,getdate(),duedate)-15) and (DATEDIFF(day,getdate(),duedate)+15))

  and a.type_id=bp.Animal_type

  and a.breed_id=bp.Breed

  and (bp.Gender=a.sex OR bp.Gender='both')

  where link=1 and p.status='pregnant'

 

 

-- booster pregnancy before end

 

UNION

 

-- booster pregnancy after start

 

SELECT a.tag,name,a.location_id

from  [thabiso].[dbo].[vw_livestock_currentanimal] a

    left join [thabiso].[dbo].[ls_pregnancy] p

         on p.tag=a.tag

       left join [thabiso].[dbo].[vw_livestock_currentanimal] os

       on os.details_of_parents_mother=a.tag

 

join [thabiso].[dbo].[ls_BoostersSchedules] bp

  on

  (DaysAfter between  (DATEDIFF(day,getdate(),os.dob)-15) and (DATEDIFF(day,getdate(),os.dob)+15))

  and a.type_id=bp.Animal_type

  and a.breed_id=bp.Breed

  and (bp.Gender=a.sex OR bp.Gender='both')

  where link=1 and p.status='successful'

 

 

--bbooster pregnancy after end

)a) 
and vw_livestock_currentanimal.tag = vw_livestock_currentanimal.tag) and camp = $camp) main
left join (select tag,sick,(select count(*) ops from ls_vaccine_used where header_id = ls_cattle_checklist.Id) vaccines,(select  count(tag) from (

-- booster month start

select tag,name,location_id from thabiso.dbo.[vw_livestock_currentanimal] a

join (select * from (

-- add 15 days start

SELECT *

,UPPER(LEFT(SUBSTRING('JAN FEB MAR APR MAY JUN JUL AUG SEP OCT NOV DEC', (datepart(month,dateadd(day,15,getdate())) * 4) - 3, 3),1))+LOWER(SUBSTRING(SUBSTRING('JAN FEB MAR APR MAY JUN JUL AUG SEP OCT NOV DEC', (datepart(month,dateadd(day,15,getdate())) * 4) - 3, 3),2,LEN(SUBSTRING('JAN FEB MAR APR MAY JUN JUL AUG SEP OCT NOV DEC', (datepart(month,dateadd(day,15,getdate())) * 4) - 3, 3)))) cmonth

  FROM [thabiso].[dbo].ls_BoostersSchedules vs

  -- add 15 days end

  UNION

  -- subtract 15 days start

  SELECT *

,UPPER(LEFT(SUBSTRING('JAN FEB MAR APR MAY JUN JUL AUG SEP OCT NOV DEC', (datepart(month,dateadd(day,-15,getdate())) * 4) - 3, 3),1))+LOWER(SUBSTRING(SUBSTRING('JAN FEB MAR APR MAY JUN JUL AUG SEP OCT NOV DEC', (datepart(month,dateadd(day,-15,getdate())) * 4) - 3, 3),2,LEN(SUBSTRING('JAN FEB MAR APR MAY JUN JUL AUG SEP OCT NOV DEC', (datepart(month,dateadd(day,-15,getdate())) * 4) - 3, 3)))) cmonth

  FROM [thabiso].[dbo].ls_BoostersSchedules vs

  -- subtract 15 days end

) t

where CHARINDEX(cmonth,Months)>0 and CHARINDEX(cmonth,Months) is not null


 ) boo

on boo.Animal_type=a.type_id

and boo.Breed=a.breed_id

and (boo.Gender=a.sex OR boo.Gender='both')

-- booster month end

 

UNION

 

-- booster pregnancy before start

 

SELECT a.tag,name,a.location_id

from  [thabiso].[dbo].[vw_livestock_currentanimal] a

    left join [thabiso].[dbo].[ls_pregnancy] p

  on p.tag=a.tag

join [thabiso].[dbo].[ls_BoostersSchedules] bp

  on

  (DaysBefore between  (DATEDIFF(day,getdate(),duedate)-15) and (DATEDIFF(day,getdate(),duedate)+15))

  and a.type_id=bp.Animal_type

  and a.breed_id=bp.Breed

  and (bp.Gender=a.sex OR bp.Gender='both')

  where link=1 and p.status='pregnant'

 

 

-- booster pregnancy before end

 

UNION

 

-- booster pregnancy after start

 

SELECT a.tag,name,a.location_id

from  [thabiso].[dbo].[vw_livestock_currentanimal] a

    left join [thabiso].[dbo].[ls_pregnancy] p

         on p.tag=a.tag

       left join [thabiso].[dbo].[vw_livestock_currentanimal] os

       on os.details_of_parents_mother=a.tag

 

join [thabiso].[dbo].[ls_BoostersSchedules] bp

  on

  (DaysAfter between  (DATEDIFF(day,getdate(),os.dob)-15) and (DATEDIFF(day,getdate(),os.dob)+15))

  and a.type_id=bp.Animal_type

  and a.breed_id=bp.Breed

  and (bp.Gender=a.sex OR bp.Gender='both')

  where link=1 and p.status='successful'

 

 

--bbooster pregnancy after end

)a where location_id = $camp and tag = ls_cattle_checklist.tag group by location_id,tag) boosters,Id header,(select count(*) ops from ls_brandings left join ls_operations on ls_brandings.header_id = ls_operations.Id where header_id = ls_cattle_checklist.Id) hasoperation from ls_cattle_checklist) cl on main.tag = cl.tag
left join (select status,tag from ls_pregnancy) preg on main.tag = preg.tag";
     }else{
      $sql =("select *,(select count(*) as vacs from (select tag,dob,location_id,[type_id],breed_id,sex,herd_description,camp,vaccineage,name vaccine,VaccineDayStart,VaccineDayEnd from thabiso.dbo.[vw_livestock_currentanimal] a
join (
SELECT vs.[Id]
      ,vs.[Name]
      ,vs.[VaccinePeriod]
      ,vs.[Gender]
      ,vs.[Animal_type]
      ,vs.[Breed]
      ,vs.[datecreated]
      ,vs.[createdby]
  ,vp.VaccineDayStart
  ,vp.VaccineDayEnd

  FROM [thabiso].[dbo].[ls_VaccineSchedules] vs
  join [thabiso].[dbo].[ls_VaccinSchedules] vp 
on vs.VaccinePeriod=vp.Id
) vac on ((a.vaccineage between vac.VaccineDayStart -15 and vac.VaccineDayEnd+15))
and vac.Animal_type=a.type_id
and vac.Breed=a.breed_id
and (vac.Gender=a.sex OR vac.Gender='both')
where tag = main.tag)t) as needvaccine from (select *,vw_livestock_currentanimal.tag mtag,vw_livestock_currentanimal.sex msex,vw_livestock_currentanimal.weight mweight from vw_livestock_currentanimal where status !='Disposed' and camp = $camp".$str.") main
left join (select tag,sick,(select count(*) ops from ls_vaccine_used where header_id = ls_cattle_checklist.Id) vaccines,(select  count(tag) from (

-- booster month start

select tag,name,location_id from thabiso.dbo.[vw_livestock_currentanimal] a

join (select * from (

-- add 15 days start

SELECT *

,UPPER(LEFT(SUBSTRING('JAN FEB MAR APR MAY JUN JUL AUG SEP OCT NOV DEC', (datepart(month,dateadd(day,15,getdate())) * 4) - 3, 3),1))+LOWER(SUBSTRING(SUBSTRING('JAN FEB MAR APR MAY JUN JUL AUG SEP OCT NOV DEC', (datepart(month,dateadd(day,15,getdate())) * 4) - 3, 3),2,LEN(SUBSTRING('JAN FEB MAR APR MAY JUN JUL AUG SEP OCT NOV DEC', (datepart(month,dateadd(day,15,getdate())) * 4) - 3, 3)))) cmonth

  FROM [thabiso].[dbo].ls_BoostersSchedules vs

  -- add 15 days end

  UNION

  -- subtract 15 days start

  SELECT *

,UPPER(LEFT(SUBSTRING('JAN FEB MAR APR MAY JUN JUL AUG SEP OCT NOV DEC', (datepart(month,dateadd(day,-15,getdate())) * 4) - 3, 3),1))+LOWER(SUBSTRING(SUBSTRING('JAN FEB MAR APR MAY JUN JUL AUG SEP OCT NOV DEC', (datepart(month,dateadd(day,-15,getdate())) * 4) - 3, 3),2,LEN(SUBSTRING('JAN FEB MAR APR MAY JUN JUL AUG SEP OCT NOV DEC', (datepart(month,dateadd(day,-15,getdate())) * 4) - 3, 3)))) cmonth

  FROM [thabiso].[dbo].ls_BoostersSchedules vs

  -- subtract 15 days end

) t

where CHARINDEX(cmonth,Months)>0 and CHARINDEX(cmonth,Months) is not null


 ) boo

on boo.Animal_type=a.type_id

and boo.Breed=a.breed_id

and (boo.Gender=a.sex OR boo.Gender='both')

-- booster month end

 

UNION

 

-- booster pregnancy before start

 

SELECT a.tag,name,a.location_id

from  [thabiso].[dbo].[vw_livestock_currentanimal] a

    left join [thabiso].[dbo].[ls_pregnancy] p

  on p.tag=a.tag

join [thabiso].[dbo].[ls_BoostersSchedules] bp

  on

  (DaysBefore between  (DATEDIFF(day,getdate(),duedate)-15) and (DATEDIFF(day,getdate(),duedate)+15))

  and a.type_id=bp.Animal_type

  and a.breed_id=bp.Breed

  and (bp.Gender=a.sex OR bp.Gender='both')

  where link=1 and p.status='pregnant'

 

 

-- booster pregnancy before end

 

UNION

 

-- booster pregnancy after start

 

SELECT a.tag,name,a.location_id

from  [thabiso].[dbo].[vw_livestock_currentanimal] a

    left join [thabiso].[dbo].[ls_pregnancy] p

         on p.tag=a.tag

       left join [thabiso].[dbo].[vw_livestock_currentanimal] os

       on os.details_of_parents_mother=a.tag

 

join [thabiso].[dbo].[ls_BoostersSchedules] bp

  on

  (DaysAfter between  (DATEDIFF(day,getdate(),os.dob)-15) and (DATEDIFF(day,getdate(),os.dob)+15))

  and a.type_id=bp.Animal_type

  and a.breed_id=bp.Breed

  and (bp.Gender=a.sex OR bp.Gender='both')

  where link=1 and p.status='successful'

 

 

--bbooster pregnancy after end

)a where location_id = $camp and tag = ls_cattle_checklist.tag group by location_id,tag) boosters,Id header,(select count(*) ops from ls_brandings left join ls_operations on ls_brandings.header_id = ls_operations.Id where header_id = ls_cattle_checklist.Id) hasoperation from ls_cattle_checklist) cl on main.tag = cl.tag
left join (select status,tag from ls_pregnancy) preg on main.tag = preg.tag");
      
     }
           

          
    $results = $this->db->query($sql);
//echo $this->db->last_query();
    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }


  function fetchvaccines($tag){
     
           $sql =("select tag,dob,location_id,[type_id],breed_id,sex,herd_description,camp,vaccineage,name vaccine,VaccineDayStart,VaccineDayEnd from thabiso.dbo.[vw_livestock_currentanimal] a
join (
SELECT vs.[Id]
      ,vs.[Name]
      ,vs.[VaccinePeriod]
      ,vs.[Gender]
      ,vs.[Animal_type]
      ,vs.[Breed]
      ,vs.[datecreated]
      ,vs.[createdby]
  ,vp.VaccineDayStart
  ,vp.VaccineDayEnd

  FROM [thabiso].[dbo].[ls_VaccineSchedules] vs
  join [thabiso].[dbo].[ls_VaccinSchedules] vp 
on vs.VaccinePeriod=vp.Id
) vac on ((a.vaccineage between vac.VaccineDayStart -15 and vac.VaccineDayEnd+15))
and vac.Animal_type=a.type_id
and vac.Breed=a.breed_id
and (vac.Gender=a.sex OR vac.Gender='both')
where tag = '$tag'
 ");

          
    $results = $this->db->query($sql);
//echo $this->db->last_query();
    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }

  function selecttags(){
     
           $sql =("select distinct tag from ls_master where status !='Disposed' order by tag asc");

          
    $results = $this->db->query($sql);
//echo $this->db->last_query();
    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }


  function fetchboosters($tag){
     
           $sql =("select header_id,(select Name from ls_BoostersSchedules where Id = main.booster) booster,comment,date
 from ls_booster_used main where header_id = $tag");

          
    $results = $this->db->query($sql);
//echo $this->db->last_query();
    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }

  function updatesickness($diagnosis,$product,$header){
   $query = "
 UPDATE [dbo].[ls_products_used]
   SET
      [sick] = 0 WHERE [diagnosis]='$diagnosis' and [Id]='$product' and [header_id]='$header'";


      

   if($this->db->query($query)){
  //echo $this->db->last_query();
    return 1;
   } else {
    return 0;
   }
}


 function getsickcount($header,$product){
   $query = $this->db->query("select count(*) numsick from ls_products_used where header_id = '$header' and sick = 1 ");
//echo $this->db->last_query();
   if($query->num_rows() > 0){
        return $query->result_array();
      }else{
        return false;
      }
}


function updatechecklistsick($header){
   $query = "
 UPDATE [dbo].[ls_cattle_checklist]
   SET
      [sick] = 0 WHERE [Id]='$header'";
      

   if($this->db->query($query)){
  //echo $this->db->last_query();
    return 1;
   } else {
    return 0;
   }
}




function productionplanfigures($herd){
      //   $userId = $this->session->userdata('UID');
  
         $sql = $this->db->query("select * from (select main_table.camp_name, avg(main_table.location_id) herdid,
count(main_table.Totalanimals) totalanimals, 
main_table.Males males, 
main_table.Females females, 
sum(main_table.cows) cows, 
sum(main_table.h) h,
sum(main_table.cattles) cattles,
sum(main_table.sheeps) sheeps,
sum(main_table.goats) goats,
sum(main_table.sick) sick,
(select herd_name from ls_herd where camp_id =  main_table.camp) herd,(select herd_id from ls_herd where camp_id =  main_table.camp) herd_id,main_table.camp 
from(
select ls_camp.camp_name,mastr.Totalanimals,male.Males ,female.Females,mastr.camp,location_id,
(select count(preg_id) from ls_pregnancy where ls_pregnancy.tag = mastr.tag) cows,
(select count(sick) from ls_cattle_checklist where tag = mastr.tag) sick,
(select count(vw_livestock_currentanimal.tag) from vw_livestock_currentanimal where vw_livestock_currentanimal.tag not in(select ls_pregnancy.tag from ls_pregnancy where ls_pregnancy.tag = mastr.tag) and vw_livestock_currentanimal.sex = 'Female' and vw_livestock_currentanimal.tag = mastr.tag) h,
(select count(vw_livestock_currentanimal.tag) from vw_livestock_currentanimal where  vw_livestock_currentanimal.type_id = 1 and vw_livestock_currentanimal.tag = mastr.tag) cattles,
(select count(vw_livestock_currentanimal.tag) from vw_livestock_currentanimal where  vw_livestock_currentanimal.type_id = 8 and vw_livestock_currentanimal.tag = mastr.tag) sheeps,
(select count(vw_livestock_currentanimal.tag) from vw_livestock_currentanimal where  vw_livestock_currentanimal.type_id = 9 and vw_livestock_currentanimal.tag = mastr.tag) goats
from (select camp, count(master_id) Totalanimals,tag,location_id
from vw_livestock_currentanimal where status !='Disposed' group by camp,tag,location_id) mastr
left join ls_camp on mastr.camp =  ls_camp.camp_id
left join (select count(sex) Males, vw_livestock_currentanimal.camp from vw_livestock_currentanimal where vw_livestock_currentanimal.sex = 'Male' and status !='Disposed' and camp = vw_livestock_currentanimal.camp group by vw_livestock_currentanimal.camp) male on mastr.camp = male.camp
left join (select count(sex) Females, vw_livestock_currentanimal.camp from vw_livestock_currentanimal where vw_livestock_currentanimal.sex = 'Female'  and status !='Disposed' group by vw_livestock_currentanimal.camp) female on mastr.camp = female.camp
) main_table 

group by camp_name,camp,main_table.Males,main_table.Females) df where herd_id = $herd
");

      //echo $this->db->last_query();
      if($sql->num_rows() > 0){
        return $sql->result_array();
      }else{
        return false;
      }
  }



  function saveproductionplan($post) {
    
    $query = $this->db->query("INSERT INTO [thabiso].[dbo].[ls_production_plan]
           ([herd_id]
           ,[camp_id]
           ,[activity]
           ,[start_date]
           ,[end_date]
           ,[status]
           ,[date_completed]
           ,[totalanimals]
           ,[females]
           ,[males]
           ,[rn]
           ,[groupid])
     VALUES
           ('".$post['herdid']."'
           ,'".$post['campid']."'
           ,'".$post['activity']."'
           ,'".$post['startdate']."'
           ,'".$post['enddate']."'
           ,'".$post['status']."'
           ,'".$post['datecompleted']."'
           ,'".$post['totalanimals']."'
           ,'".$post['females']."'
           ,'".$post['males']."'
           ,'".$post['rn']."'
           ,'".$post['group']."')
  ");
           //echo $this->db->last_query();
  if($query) 
    {
         return 1;
    } else {
        return 0;
    }
  }



function savereceipt($post,$rn) {
    
    $query = $this->db->query("INSERT INTO [thabiso].[dbo].[ls_receipts]
           ([Farm_id]
           ,[datecreated]
           ,[source]
           ,[qty]
           ,[uom]
           ,[product]
           ,[cost]
           ,[rn])
     VALUES
           (
           '".$post['farm']."'
           ,'".$post['date']."'
           ,'".$post['source']."'
           ,'".$post['qty']."'
           ,'".$post['uom']."'
           ,'".$post['product']."'
           ,'".$post['cost']."'
           ,'".$post['rn']."')
  ");
           //echo $this->db->last_query();
  if($query) 
    {
         return 1;
    } else {
        return 0;
    }
  }


   function saveanimalfeed($post) {
    
    $query = $this->db->query("INSERT INTO [thabiso].[dbo].[ls_feed_issuing]
           ([herd_id]
           ,[camp_id]
           ,[feed]
           ,[qty]
           ,[totalanimals]
           ,[females]
           ,[males]
           ,[rn]
           ,[uom])
     VALUES
           ('".$post['herdid']."'
           ,'".$post['campid']."'
           ,'".$post['feed']."'
           ,'".$post['qty']."'
           ,'".$post['totalanimals']."'
           ,'".$post['females']."'
           ,'".$post['males']."'
           ,'".$post['rn']."'
           ,'".$post['uom']."')
  ");
           //echo $this->db->last_query();
  if($query) 
    {
         return 1;
    } else {
        return 0;
    }
  }


   function updateproductionplan($post) {

    $query = $this->db->query("
      update [thabiso].[dbo].[ls_production_plan]
      set [herd_id]='".$post['herdid']."'
      ,[camp_id]='".$post['campid']."'
      ,[activity]='".$post['activity']."'
      ,[start_date]='".$post['startdate']."'
      ,[end_date]='".$post['enddate']."'
      ,[status]='".$post['status']."'
      ,[date_completed]='".$post['datecompleted']."'
      ,[totalanimals]='".$post['totalanimals']."'
      ,[females]='".$post['females']."'
      ,[males]='".$post['males']."' 
      ,[groupid] = '".$post['group']."'

      where rn='".$post['rn']."'
  ");
           //echo $this->db->last_query();
  if($query) 
    {
         return 1;
    } else {
        return 0;
    }
  }


  function updatereceipt($post) {

    $query = $this->db->query("
      update [thabiso].[dbo].[ls_receipts]
      set [farm_id]='".$post['farm']."'
      ,[datecreated]='".$post['date']."'
      ,[source]='".$post['source']."'
      ,[qty]='".$post['qty']."'
      ,[uom]='".$post['uom']."'
      ,[product]='".$post['product']."'
      ,[cost]='".$post['cost']."'
      where rn='".$post['rn']."'
  ");
           //echo $this->db->last_query();
  if($query) 
    {
         return 1;
    } else {
        return 0;
    }
  }


function updateanimalfeed($post) {

    $query = $this->db->query("
      update [thabiso].[dbo].[ls_feed_issuing]
      set [herd_id]='".$post['herdid']."'
      ,[camp_id]='".$post['campid']."'
      ,[feed]='".$post['feed']."'
      ,[qty]='".$post['qty']."'
      ,[totalanimals]='".$post['totalanimals']."'
      ,[females]='".$post['females']."'
      ,[males]='".$post['males']."' 
      ,[uom]='".$post['uom']."' 
      where rn='".$post['rn']."'
  ");
           //echo $this->db->last_query();
  if($query) 
    {
         return 1;
    } else {
        return 0;
    }
  }

    function selectstatus(){
    
 
           $sql =("select distinct status from ls_production_plan");

        
    $results = $this->db->query($sql);
    //echo $this->db->last_query();

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }


  function selectactivity(){
    
 
           $sql =("select distinct activity,ls_operations.operation from ls_production_plan
left join ls_operations on ls_production_plan.activity = ls_operations.id");

        
    $results = $this->db->query($sql);
    //echo $this->db->last_query();

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }

  function getfathertagdetails($tag){

$sql =("SELECT dbo.ls_master.*, dbo.ls_type.type_name, dbo.ls_breed.breed_name, dbo.ls_location.location_name

FROM ls_master
left JOIN dbo.ls_location ON dbo.ls_master.location_id = dbo.ls_location.location_id 
left JOIN dbo.ls_type ON dbo.ls_master.type_id = dbo.ls_type.type_id 
left JOIN dbo.ls_breed ON dbo.ls_master.breed_id = dbo.ls_breed.breed_id 
WHERE  tag = '$tag' AND [sex] ='Male' AND [status] !='Disposed'
  ");

          
    $results = $this->db->query($sql);
//echo $this->db->last_query();
    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }


    function getmothertagdetails($tag){

$sql =("SELECT dbo.ls_master.*, dbo.ls_type.type_name, dbo.ls_breed.breed_name, dbo.ls_location.location_name

FROM ls_master
left JOIN dbo.ls_location ON dbo.ls_master.location_id = dbo.ls_location.location_id 
left JOIN dbo.ls_type ON dbo.ls_master.type_id = dbo.ls_type.type_id 
left JOIN dbo.ls_breed ON dbo.ls_master.breed_id = dbo.ls_breed.breed_id 
WHERE  tag = '$tag' AND [sex] ='Female' AND [status] !='Disposed'
  ");

          
    $results = $this->db->query($sql);
//echo $this->db->last_query();
    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }


  function gettagdetailschecklist($tag){

$sql =("SELECT dbo.vw_livestock_currentanimal.*, dbo.ls_type.type_name, dbo.ls_breed.breed_name, dbo.ls_location.location_name,(select camp_name from ls_camp where camp_id = vw_livestock_currentanimal.camp) loc,
  (select herd_id from ls_herd where ls_herd.description = vw_livestock_currentanimal.herd_description) herdid,
  (select herd_name from ls_herd where ls_herd.description = vw_livestock_currentanimal.herd_description) herd

FROM vw_livestock_currentanimal
LEFT JOIN dbo.ls_location ON dbo.vw_livestock_currentanimal.location_id = dbo.ls_location.location_id 
LEFT JOIN dbo.ls_type ON dbo.vw_livestock_currentanimal.type_id = dbo.ls_type.type_id 
LEFT JOIN dbo.ls_breed ON dbo.vw_livestock_currentanimal.breed_id = dbo.ls_breed.breed_id 
WHERE  tag ='$tag' AND [status] <> 'Disposed'");

          
    $results = $this->db->query($sql);
//echo $this->db->last_query();
    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }


    function gettag($tag){

    $query = $this->db->query("SELECT count(*) exts from ls_master where tag='$tag'");
    //echo $this->db->last_query();
    if($query->num_rows > 0){
       return $query->result_array();
    } else { 
       return 0;
    }
  }


  function getanimalmovehistory($tagid){

           $sql =("SELECT tag,date_moved, (select herd_name from ls_herd where herd_id = ls_move_animal.to_herd) to_herd
, (select camp_name from ls_camp where camp_id = ls_move_animal.to_camp) to_camp
, (select herd_name from ls_herd where herd_id = ls_move_animal.from_herd) from_herd
, (select camp_name from ls_camp where camp_id = ls_move_animal.from_camp) from_camp
, (select herd_name from ls_herd where herd_id = ls_move_animal.to_herd) toherd from ls_move_animal
             WHERE [tag] ='$tagid' order by version desc");

         // echo $this->db->last_query();
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result_array();
    }

    else
    {
      return false;
    }

  }


  function updatevacschedule($schedulename,$vaccineperiod,$gender,$type,$breed,$datetimecreated,$createdby,$scheduleid){
 $query = "
  update [thabiso].[dbo].[ls_VaccineSchedules]
  set [Name]='$schedulename', [VaccinePeriod]='$vaccineperiod', [Gender]='$gender', [Animal_type]='$type', [Breed]='$breed' where [Id]='$scheduleid';
  ";

   if($this->db->query($query)){
    //echo $this->db->last_query();
    //echo $this->db->last_query();
    return 1;
   } else {
    //echo $this->db->last_query();
    return 0;
   }
}



function updateboostsschedule($schedulename,$gender,$type,$breed,$datetimecreated,$createdby,$daysbefore,$daysafter,$link,$months,$scheduleid){
 $query = "
  update [thabiso].[dbo].[ls_BoostersSchedules]
  set [Name]='$schedulename', [Gender]='$gender', [Animal_type]='$type', [Breed]='$breed', [DaysBefore]='$daysbefore', [DaysAfter]='$daysafter', [Link]='$link', [Months]='$months' where [Id]='$scheduleid';
  ";

   if($this->db->query($query)){
    //echo $this->db->last_query();
    return 1;
   } else {
    return 0;
   }
}


function viewuom() 
  {
    $sql="SELECT *
      
  FROM [thabiso].[dbo].[ls_uom]";
    $results = $this->db->query($sql);

    if($results->num_rows() > 0)
    {
      return $results->result();
    }

    else
    {
      return false;
    }

  }

  

function add_new_uom($uom, $sUID)
  {
     $sql="insert into [thabiso].[dbo].[ls_uom]
           (
           [uom]
           ,[created_by]
           ,[create_date_time]
           ,[edited_by]
           ,[edit_date_time])
           
     values
           ('$uom','$sUID',getdate()
           ,'$sUID', getdate())";
    if($this->db->query($sql)){
      return 1;} else {return 0;}
  }

    function UpdateUOM($uom_id, $uom, $sUID)
  {
    $sql="UPDATE [thabiso].[dbo].[ls_uom]
  
  SET [uom] ='$uom',
  edited_by='$sUID' 

  WHERE [id]='$uom_id'";
  if($this->db->query($sql)){
    return 1;
  } else {
    return 0;
  }

  }


  function deleteUOM($uom_id)
  {
    $sql="DELETE FROM [thabiso].[dbo].[ls_uom] WHERE [id]='$uom_id'";
    $results = $this->db->query($sql);

    if($results)
    {
      return 1;
    }
    else
    {
      return 0;
    }

  }





    
}
?>