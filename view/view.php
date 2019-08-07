<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"></script>
<link rel="stylesheet" type="text/css" href="/application/css/styles.css"/>
<div id="main">
<div id="content" style="padding:0px; top:15px;" >
   <br><br>   <!-- span to enable scrolling between header and footer  // content start-->
   <!-- page title start -->
   <?php if(isset($pmenu)){ $pmenu=$pmenu; } else { $pmenu='push'; } ?>
   <?php if($pmenu=='push'){echo "<div  id='pagetitlemenuopen'>".$pagename." </div>";} ?>
   <div  id="pagetitlemenuclosed" style="top:0px;height:30px;padding-top:0px;text-align:bottom;" >
      <img onclick="openNavLeft()" style="height:20px; " src="<?php echo base_url(); ?>application/images/mout2.png" href="javascript:void(0)" id="closemenubutton" >
      <?php echo $pagename;if($pmenu!=='push'){/*echo $pagename */;} ?>
      <span style="float:right">
      </span>
   </div>
   <!-- page title end -->
   <div class="pagecontent" style="background-color:white;" >
      <!-- main content start // insert code here -->
      <div id="divadd">
         <input type="hidden" id="docid" value="<?php echo $docid; ?>">
         <input type="hidden" id="hcperm" value="<?php echo $hcperm; ?>">
         <input type="hidden" id="hscperm" value="<?php echo $hscperm; ?>">
         <input type="hidden" id="hcoperm" value="<?php echo $hcoperm; ?>">
         <input type="hidden" id="fileatt" >
         <input type="hidden" id="counter" name="counter" value="2">
         <div class="stuck"><img style="width:200px;height:60px;" src='\application\barcodes\<?php  echo 'DOC'.$docid; ?>.jpg' /></strong></div>
         <table style="border-collapse:separate; border-spacing:0.5em;">
            <tr class="divlink">
               <td>
                  <label>
                     Document Name:
               </td>
               <td><input class="textField checkEmpty" type="text" readonly="readonly" style="border: transparent;font-size: 12px" name="documentname" id="documentname" onblur="splitsentence(this.value)"  onkeyup="showbtn()"><input type="text" id="exten" style="display: none;border: transparent;font-size: 12px; width: 500px;" name="exten"></td>
            </tr>
            <tr class="divlink">  
            <td><label>Description:</td>
            <td><input class="textField checkEmpty" type="text" name="description" id="description" onkeyup="addext(this.value)"></td>
            </tr>
            <tr class="divlink">
            <td><label>Category:</td>
            <td><select class="cddropdown checkEmpty" style="width: 228px" id="categoryname" name="categoryname" onchange="showbtn2(this.value,this.text)">
            <?php echo $categories?>
            </select><a href="#" style="font-size: 12px;" onclick="newcomment('category')" id="hcp">&nbsp;Add</a></td>
            </tr>
            <tr class="divlink">
            <td><label>Sub Category:</td>
            <td><select class="cddropdown checkEmpty" style="width: 228px" id="subcategoryname" name="subcategoryname" onchange="showbtn(this.value)">
            <option>--Please Select--</option>
            </select><a href="#" style="font-size: 12px;" onclick="newcomment('subcategory')"  id="hscp">&nbsp;Add</a></td>
            </tr>
            <tr class="divlink">
            <td><label>Contracting Party:</td>
            <td><input class="textField checkEmpty" type="text" name="contractingparty" id="contractingparty" onkeyup="showbtn4()"><input type="hidden" name="contractingpartyid" id="contractingpartyid"><a href="#" id="hascon" style="font-size: 12px;" onclick="newcomment('contractor')" >&nbsp;Add</a></td>
            </tr>
            <tr class="divlink">
            <td><label>Segment:</td>
            <td><select class="cddropdown checkEmpty" style="width: 228px" id="segmentname" name="segmentname" onchange="showbtn3(this.value,this.text)">
            <?php echo $segments?>
            </select></td>
            </tr>
            <tr class="divlink">
            <td><label>Departments:</td>
            <td><select class="cddropdown checkEmpty" style="width: 228px" id="departmentname" name="departmentname" onchange="showbtn(this.value)">
            <?php echo $departments?>
            </select></td>
            </tr>
            <tr class="divlink">
            <td><label>Region:</td>
            <td><select class="cddropdown checkEmpty" style="width: 228px" id="workplacename" name="workplacename" onchange="showbtn(this.value)">
            <?php echo $workplaces?>
            </select></td>
            </tr>
            <tr class="divlink">
            <td><label>Permission Group:</td>
            <td><select class="cddropdown checkEmpty" style="width: 228px" id="groupname" name="groupname" onchange="showbtn(this.value)">
            <?php echo $permissiongroups?>
            </select></td>
            </tr>
         </table>
         <br>
         <hr style="margin-top:2px">
         <table style="height: 50px">
         <tr class="divlink">
         <td><label>Start Date</label></td>   
         <td><label>End Date</label></td>
         <td><label>Review Date</label></td>
         <td><label>Renewal Date</label></td>
         </tr>
         <tr class="divlink">
         <td><input class="datepicker checkEmpty" type="text" placeholder="Start Date" onchange="iscontract(this.value)" name="startdate" id="startdate" onkeyup="iscontract()"></td>   
         <td><input class="datepicker checkEmpty" type="text" placeholder="End Date" onchange="iscontract(this.value)" name="enddate" id="enddate" onkeyup="iscontract()"></td>
         <td><input class="datepicker checkEmpty" type="text" placeholder="Review Date" onchange="iscontract(this.value)" name="reviewdate" id="reviewdate" onkeyup="iscontract()"></td>
         <td><input class="datepicker checkEmpty" type="text" placeholder="Renewal Date" onchange="iscontract(this.value)" name="renewaldate" id="renewaldate" onkeyup="iscontract()"></td>
         </tr>
         </table>
         <br>
         <hr style="margin-top:2px">
         <table id="delnewf">
            <?php for ($i=2; $i < 30 ; $i++) { ?>
            <tr id="row<?php echo $i; ?>" style="display:none;">
               <td style="width: 160px"><label id='uploadLabel' class='label'>Upload File</td>
               <td>
                  <div id="fileDiv"></div>
                  <input type="text" placeholder="Attachment Description" onkeyup="updatedescription(<?php echo $i ?>,this.value)" style="width: 570px; display: none;" name="desc" id="desc<?php echo $i; ?>"><input type="text" style="display: none;" id="filecryp<?php echo $i ?>" name="filecryp<?php echo $i ?>"><br> 
                  <input type="file" name="fileToUpload[]" id="doc<?php echo $i; ?>" onchange="savephoto('doc<?php echo $i; ?>',<?php echo $i; ?>)" style="width:570px;" class="textField">
                  <!-- <button style="display: none;" type="button" id="addfile<?php echo $i; ?>" onclick="uploadselect('<?php echo $i; ?>',<?php echo $i; ?>)">Add File</button>  -->
               </td>
               <td><span style="font-size:9px;" id="doc<?php echo $i; ?>uploaded" ></span><span style="font-size:9px;" ><img id="loader<?php echo $i; ?>" style="display: none;" src="/application/images/preloadertb.gif"></span></td>
            </tr>
            <?php   } ?>
         </table>
         <hr style="margin-top:2px">
         <table>
            <tr>
               <td style="padding-right: 10px">Document Owner:</td>
               <td style="padding-right: 10px;color: #003418;"><?php echo $docowner?></td>
            </tr>
            <tr>
               <td style="padding-right: 10px">Additional Owner:</td>
               <td style="padding-right: 10px"><input type="text" autocomplete="false" value="" name="additionalowner" placeholder="--Optional--" id="additionalowner" class="textField"><input type="hidden" name="additionalownerid" id="additionalownerid"><input type="hidden" name="docowerid" id="docowerid" value="<?php echo $docownerid?>"></td>
            </tr>
            <tr class="divlink">
               <td style="padding-right: 10px">Optional Password:</td>
               <td style="padding-right: 10px"><input autocomplete="new-password" autocomplete="false" placeholder="Enter Password" type="password" class="textField checkEmpty" id="passwordprotection" name="passwordprotection" onkeyup="showbtn()">
               </td>
            </tr>
         </table>
         <br>
         <hr style="margin-top:2px">
         <table>
            <tr>
               <td style="width: 160px"><label  class='label'>Link Documents</td>
               <td></td>
               <td></td>
            </tr>
            <?php for ($i=2; $i < 30 ; $i++) { ?>
            <tr id="rows<?php echo $i; ?>" style="display:none;">
               <td style="width: 160px">
                  <input type="text" name="linkeddoc<?php echo $i; ?>" class="textField checkEmpty" onkeyup="autocomp(this.value)" id="linkeddoc<?php echo $i; ?>"/>
                  <input type="hidden" name="linkeddocid<?php echo $i; ?>" id="linkeddocid<?php echo $i; ?>"/>
               </td>
               <td></td>
               <td></td>
            </tr>
            <?php   } ?>
            <tr>
               <td style="width: 160px"><a href="#" onclick="addFile2()">add link</a></td>
               <td></td>
               <td></td>
            </tr>
         </table>
         <br>
         <table>
            <tr>
               <td>
                  <input id="incomp" type="button" class="incomplete" value="*Incomplete" onclick="validate()"/>
                  <input id="process" style="display:none" type="button" class="process"  value="Process" onclick="process()"/>
                  <div id="processing" style="display:none" class="processing" >&nbsp;Processing...&nbsp;</div>
                  <div id="successful"  class="successful" style="float:left;display:none " >&nbsp;Successful...&nbsp;<img src="/application/images/success.png"></div>
                  <div  id="timer"  style="float:left; display:none;">&nbsp;&nbsp; Reloading in &nbsp;</div>
                  <div id="countdown" style="float:left; color:red;"></div>
                  <div  id="timer2" style="float:left; display:none;">&nbsp; seconds. </div>
                  <div id="failed" style="display:none" class="failed" >&nbsp;Write Failed...&nbsp;<img src="/application/images/failure.png">&nbsp;</div>
               </td>
            </tr>
         </table>
         <div id="tags" style="display: none;">
            <input type="text" value="" placeholder="Add a tag" id='input'/>
         </div>
         </form>
      </div>
   </div>
   <!-- main content end // insert code here -->
</div>
<!-- content end -->
<!-- footer start -->
<div id="footer">
   <table border="0" id="footertable" style="width: 1164px; color: white; height: 20px;">
      <tbody>
         <tr>
            <td width="50%" style="padding:0px;margin:0px;">
               <b>Normandien Farms</b> | Copyright 2017  | All Rights Reserved
            </td>
            <td width="50%" style="text-align: right">
               <b>Information Management System</b>&nbsp;&nbsp;
            </td>
         </tr>
      </tbody>
   </table>
</div>
<!-- footer end -->