<?php
$doc = JFactory::getDocument();
$session = JFactory::getSession();
$jinput  = JFactory::getApplication()->input;
$option = $jinput->get('option');
$adapter = $jinput->get('adapter');
$doc->addScript(JURI::base()."components/com_osian/js/bulkedit/jquery.min.js");
$doc->addScript(JURI::base()."components/".$option."/js/import/handsontable.full.min.js");
//$doc->addScript(JURI::base()."components/com_osian/js/import/handsontable.js");
$doc->addScript(JURI::base()."components/".$option."/js/import/importdata.js");

$doc->addStyleSheet(JURI::base().'components/'.$option.'/style/import/handsontable.full.css');
$doc->addStyleSheet(JURI::base().'components/'.$option.'/style/import/samples.css');
$doc->addStyleSheet(JURI::base().'components/'.$option.'/style/import/bulkimport.css');



$columns = $session->get('columns');
?>
<div style="margin-bottom : 8px;margin-left : -33px;">
		<h4><?php echo "Step2 : Paste data from csv here according to columns." ?></h4>
</div>
<form id="step2" name="step2" action="" method="post">
	<div id="addbutton">
		<input type="button" id="validateb" name ="validateb" value="Validate"  class="btn btn-default" onclick="submitForm(0,0,'add');" style="margin-right:15px;"/>
	</div>
	<!--<input type="button" id="go" name ="go" value="Go"  class="btn btn-default" onclick="validateData(0,0);" style="margin-right:15px;"/>-->
	<!-- code for showing progress bar starts -->
	<div style="margin-left:-38px">
		<div id='addblur' style=""></div>
		<div id="mdiv" style="display:none;">
			<div id="percentbar">
						<div id="processtitle"><h4>Processing before validation starts</h4></div>
						<div id="showpercentbar" class="showborder">
							<div id="progress"></div>
						</div>
						<div style="float:right" id="perct"></div>
			<div>
		</div>
	</div>
	</div>
	<!-- code for showing progress bar ends -->
		<div id="pastedata" class="handsontable" style="margin-top:14px;" ></div>
	<input type="hidden" name="option" id="option" value="<?php echo $option; ?>" />
	<input type="hidden" name="task" id="task" value="import.storeCSVData" />
	<input type="hidden" name="controller" id="controller" value="import" />
	<input type="hidden" name="view" id="view" value="import" />
	<input type="hidden" name="layout" id="layout" value="pastedata" />
	<input type="hidden" name="csvdata" id="csvdata" value="" />
	<input type="hidden" name="adapter" id="adapter" value="<?php echo $adapter ?>" /> 
	
</form>
<script type="text/javascript">
	
jQuery(document).ready(function () {
	loadTable('pastedata',<?php echo json_encode($columns); ?>);
});
</script>
