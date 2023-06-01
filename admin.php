<?php
# admin.php - VICIDIAL administration page
#
# Copyright (C) 2022  Matt Florell <vicidial@gmail.com>    LICENSE: AGPLv2
# 

$startMS = microtime();
$php_script='admin.php';

require("dbconnect_mysqli.php");
require("functions.php");

######################################################################################################
######################################################################################################
#######   static variable settings for display options
######################################################################################################
######################################################################################################

$page_width='770';
$section_width='750';
$header_font_size='12';
$subheader_font_size='11';
$subcamp_font_size='11';
$header_selected_bold='<b>';
$header_nonselected_bold='';
$users_color =		'#FFFF99';
$campaigns_color =	'#FFCC99';
$lists_color =		'#FFCCCC';
$ingroups_color =	'#CC99FF';
$remoteagent_color ='#CCFFCC';
$usergroups_color =	'#CCFFFF';
$scripts_color =	'#99FFCC';
$filters_color =	'#CCCCCC';
$admin_color =		'#FF99FF';
$reports_color =	'#99FF33';
	$times_color =		'#FF33FF';
	$shifts_color =		'#FF33FF';
	$phones_color =		'#FF33FF';
	$conference_color =	'#FF33FF';
	$server_color =		'#FF33FF';
	$templates_color =	'#FF33FF';
	$carriers_color =	'#FF33FF';
	$settings_color = 	'#FF33FF';
	$label_color =		'#FF33FF';
	$status_color = 	'#FF33FF';
	$moh_color = 		'#FF33FF';
	$vm_color = 		'#FF33FF';
	$tts_color = 		'#FF33FF';
	$cc_color = 		'#FF33FF';
	$cts_color = 		'#FF33FF';
$subcamp_color =	'#FF9933';
$users_font =		'BLACK';
$campaigns_font =	'BLACK';
$lists_font =		'BLACK';
$ingroups_font =	'BLACK';
$remoteagent_font =	'BLACK';
$usergroups_font =	'BLACK';
$scripts_font =		'BLACK';
$filters_font =		'BLACK';
$admin_font =		'BLACK';
$qc_font =			'BLACK';
$reports_font =		'BLACK';
	$times_font =		'BLACK';
	$phones_font =		'BLACK';
	$conference_font =	'BLACK';
	$server_font =		'BLACK';
	$settings_font = 	'BLACK';
	$label_font = 	'BLACK';
	$status_font = 	'BLACK';
	$moh_font = 	'BLACK';
	$vm_font = 		'BLACK';
	$tts_font = 	'BLACK';
	$cc_font =		'BLACK';
	$cts_font = 	'BLACK';
$subcamp_font =		'BLACK';

### comment this section out for colorful section headings
$users_color =		'#E6E6E6';
$campaigns_color =	'#E6E6E6';
$lists_color =		'#E6E6E6';
$ingroups_color =	'#E6E6E6';
$remoteagent_color ='#E6E6E6';
$usergroups_color =	'#E6E6E6';
$scripts_color =	'#E6E6E6';
$filters_color =	'#E6E6E6';
$admin_color =		'#E6E6E6';
$qc_color =			'#E6E6E6';
$reports_color =	'#E6E6E6';
	$times_color =		'#C6C6C6';
	$shifts_color =		'#C6C6C6';
	$phones_color =		'#C6C6C6';
	$conference_color =	'#C6C6C6';
	$server_color =		'#C6C6C6';
	$templates_color =	'#C6C6C6';
	$carriers_color =	'#C6C6C6';
	$settings_color = 	'#C6C6C6';
	$label_color =		'#C6C6C6';
	$colors_color =		'#C6C6C6';
	$status_color = 	'#C6C6C6';
	$moh_color = 		'#C6C6C6';
	$vm_color = 		'#C6C6C6';
	$tts_color = 		'#C6C6C6';
	$cc_color = 		'#C6C6C6';
	$cts_color = 		'#C6C6C6';
	$sc_color = 		'#C6C6C6';
	$sg_color = 		'#C6C6C6';
	$ar_color = 		'#C6C6C6';
	$il_color = 		'#C6C6C6';
	$cg_color = 		'#C6C6C6';
	$vmmg_color = 		'#C6C6C6';
$subcamp_color =	'#C6C6C6';

$Msubhead_color =	'#E6E6E6';
$Mselected_color =	'#C6C6C6';
$Mhead_color =		'#A3C3D6';
$Mmain_bgcolor =	'#015B91';

###


$PHP_AUTH_USER=$_SERVER['PHP_AUTH_USER'];
$PHP_AUTH_PW=$_SERVER['PHP_AUTH_PW'];
$PHP_SELF=$_SERVER['PHP_SELF'];
$PHP_SELF = preg_replace('/\.php.*/i','.php',$PHP_SELF);
$QUERY_STRING = getenv("QUERY_STRING");
$groups=array();

$Vreports = 'NONE, Real-Time Main Report, Real-Time Campaign Summary, Real-Time Whiteboard Report, Inbound Report, Inbound Report by DID, Inbound Service Level Report, Inbound Summary Hourly Report, Inbound Daily Report, Inbound DID Report, Inbound DID Summary Report, Agent DID Report, Inbound IVR Report, Inbound Forecasting Report, Advanced Forecasting Report, Outbound Calling Report, Outbound Summary Interval Report, Outbound IVR Report, Callmenu Survey Report, Outbound Lead Source Report, Fronter - Closer Report, Fronter - Closer Detail Report, Lists Campaign Statuses Report, Lists Statuses Report, Campaign Status List Report, Export Calls Report, Export Leads Report, Agent Time Detail, Agent Status Detail, Agent Inbound Status Summary, Agent Performance Detail, Team Performance Detail, Performance Comparison Report, Single Agent Daily, Single Agent Daily Time, User Group Login Report, User Group Hourly Report, User Group Detail Hourly Report, User Timeclock Report, User Group Timeclock Status Report, User Timeclock Detail Report, Server Performance Report, Administration Change Log, List Update Stats, User Stats, User Time Sheet, Download List, Dialer Inventory Report, Maximum System Stats, Maximum Stats Detail, Search Leads Logs, Email Log Report, Carrier Log Report, Campaign Debug, Shared Debug, Asterisk Debug, Hangup Cause Report, Lists Pass Report, Called Counts List IDs Report, Agent Debug Log Report, Agent Parked Call Report, Agent-Manager Chat Log, Recording Access Log Report, API Log Report, Real-Time Monitoring Log Report, AMD Log Report, SIP Event Report, Caller ID Log Report, Quality Control Report, Settings Compare, Phone Stats';

$UGreports = 'ALL REPORTS, NONE, Real-Time Main Report, Real-Time Campaign Summary, Real-Time Whiteboard Report, Inbound Report, Inbound Report by DID, Inbound Service Level Report, Inbound Summary Hourly Report, Inbound Daily Report, Inbound DID Report, Inbound DID Summary Report, Agent DID Report, Inbound Email Report, Inbound Chat Report, Inbound IVR Report, Inbound Forecasting Report, Advanced Forecasting Report, Outbound Calling Report, Outbound Summary Interval Report, Outbound IVR Report, Callmenu Survey Report, Outbound Lead Source Report, Fronter - Closer Report, Fronter - Closer Detail Report, Lists Campaign Statuses Report, Lists Statuses Report, Campaign Status List Report, Export Calls Report, Export Leads Report, Agent Time Detail, Agent Status Detail, Agent Inbound Status Summary, Agent Performance Detail, Team Performance Detail, Performance Comparison Report, Single Agent Daily, Single Agent Daily Time, User Group Login Report, User Group Hourly Report, User Group Detail Hourly Report, User Timeclock Report, User Group Timeclock Status Report, User Timeclock Detail Report, Server Performance Report, Administration Change Log, List Update Stats, User Stats, User Time Sheet, Download List, Dialer Inventory Report, Custom Reports Links, CallCard Search, Maximum System Stats, Maximum Stats Detail, Search Leads Logs, Email Log Report, Lists Pass Report, Called Counts List IDs Report, Front Page System Summary, Report Page Servers Summary, Admin Utilities Page, Agent Debug Log Report, Agent Parked Call Report, Agent-Manager Chat Log, Recording Access Log Report, API Log Report, Real-Time Monitoring Log Report, AMD Log Report, SIP Event Report, Caller ID Log Report, Quality Control Report, Settings Compare, Phone Stats, VERM QA Links';

$Vtables = 'NONE,log_noanswer,did_agent_log,contact_information';

$APIfunctions = 'ALL_FUNCTIONS add_group_alias add_lead add_list add_phone add_phone_alias add_user agent_ingroup_info agent_stats_export agent_status audio_playback blind_monitor call_agent callid_info change_ingroups check_phone_number copy_user did_log_export external_add_lead external_dial external_hangup external_pause external_status in_group_status logout moh_list park_call pause_code preview_dial_action ra_call_control recording recording_lookup send_dtmf server_refresh set_timer_action sounds_list st_get_agent_active_lead st_login_log transfer_conference update_fields update_lead batch_update_lead update_list list_info list_custom_fields update_log_entry update_phone update_phone_alias update_user user_group_status vm_list webphone_url webserver logged_in_agents update_campaign update_alt_url update_presets add_did update_did lead_field_info lead_all_info phone_number_log switch_lead ccc_lead_info lead_status_search lead_search call_status_stats calls_in_queue_count force_fronter_leave_3way force_fronter_audio_stop update_cid_group_entry add_dnc_phone add_fpg_phone';

$browser_alert_sounds_list = 'bark_dog,beep_double,beep_five,beep_up,bell_double,bell_school,bird,blaster1,blaster2,buzz1,buzz2,cash_register,chat_alert,click_single,click_double,click_quiet,close_encounter,confirmation,ding,droplet,droplet_double,elephant,email_alert,hold_tone,horn_bike,horn_car,horn_car_triple,horn_clown,horn_double,horn_train,meow_cat,scream_wilhelm,silence_quick,siren,slide_down,slide_up,swish,teleport1,teleport2,ticking_two,ticking_four,ticking_six,whip,whistle_up,whistle_two,whistle_three,whoosh,xylophone1,xylophone2,xylophone3,xylophone4';

### BEGIN housecleaning of old static report files, if not done before ###
if (!file_exists('old_clear'))
	{
	array_map('unlink', glob("./*.csv"));
	array_map('unlink', glob("./*.xls"));
	array_map('unlink', glob("./ploticus/*"));
	unlink('project_auth_entries.txt');

	$clear_file=fopen('old_clear', "w");
	fwrite($clear_file, '1');
	fclose($clear_file);
	}
if (file_exists('project_auth_entries.txt'))
	{
	unlink('project_auth_entries.txt');
	}
### END housecleaning of old static report files ###


######################################################################################################
######################################################################################################
#######   Form variable declaration
######################################################################################################
######################################################################################################

if (isset($_GET["DB"]))				{$DB=$_GET["DB"];}
	elseif (isset($_POST["DB"]))	{$DB=$_POST["DB"];}
if (isset($_GET["access_recordings"]))			{$access_recordings=$_GET["access_recordings"];}
	elseif (isset($_POST["access_recordings"]))	{$access_recordings=$_POST["access_recordings"];}
if (isset($_GET["active"]))				{$active=$_GET["active"];}
	elseif (isset($_POST["active"]))	{$active=$_POST["active"];}
if (isset($_GET["adaptive_dl_diff_target"]))			{$adaptive_dl_diff_target=$_GET["adaptive_dl_diff_target"];}
	elseif (isset($_POST["adaptive_dl_diff_target"]))	{$adaptive_dl_diff_target=$_POST["adaptive_dl_diff_target"];}
if (isset($_GET["adaptive_dropped_percentage"]))		{$adaptive_dropped_percentage=$_GET["adaptive_dropped_percentage"];}
	elseif (isset($_POST["adaptive_dropped_percentage"])){$adaptive_dropped_percentage=$_POST["adaptive_dropped_percentage"];}
if (isset($_GET["adaptive_intensity"]))	{$adaptive_intensity=$_GET["adaptive_intensity"];}
	elseif (isset($_POST["adaptive_intensity"]))	{$adaptive_intensity=$_POST["adaptive_intensity"];}
if (isset($_GET["adaptive_latest_server_time"]))	{$adaptive_latest_server_time=$_GET["adaptive_latest_server_time"];}
	elseif (isset($_POST["adaptive_latest_server_time"])){$adaptive_latest_server_time=$_POST["adaptive_latest_server_time"];}
if (isset($_GET["adaptive_maximum_level"]))	{$adaptive_maximum_level=$_GET["adaptive_maximum_level"];}
	elseif (isset($_POST["adaptive_maximum_level"]))	{$adaptive_maximum_level=$_POST["adaptive_maximum_level"];}
if (isset($_GET["SUB"]))			{$SUB=$_GET["SUB"];}
	elseif (isset($_POST["SUB"]))	{$SUB=$_POST["SUB"];}
if (isset($_GET["ADD"]))			{$ADD=$_GET["ADD"];}
	elseif (isset($_POST["ADD"]))	{$ADD=$_POST["ADD"];}
if (isset($_GET["admin_hangup_enabled"]))	{$admin_hangup_enabled=$_GET["admin_hangup_enabled"];}
	elseif (isset($_POST["admin_hangup_enabled"]))	{$admin_hangup_enabled=$_POST["admin_hangup_enabled"];}
if (isset($_GET["admin_hijack_enabled"]))	{$admin_hijack_enabled=$_GET["admin_hijack_enabled"];}
	elseif (isset($_POST["admin_hijack_enabled"]))	{$admin_hijack_enabled=$_POST["admin_hijack_enabled"];}
if (isset($_GET["admin_monitor_enabled"]))	{$admin_monitor_enabled=$_GET["admin_monitor_enabled"];}
	elseif (isset($_POST["admin_monitor_enabled"]))	{$admin_monitor_enabled=$_POST["admin_monitor_enabled"];}
if (isset($_GET["AFLogging_enabled"]))	{$AFLogging_enabled=$_GET["AFLogging_enabled"];}
	elseif (isset($_POST["AFLogging_enabled"]))	{$AFLogging_enabled=$_POST["AFLogging_enabled"];}
if (isset($_GET["agent_choose_ingroups"]))	{$agent_choose_ingroups=$_GET["agent_choose_ingroups"];}
	elseif (isset($_POST["agent_choose_ingroups"]))	{$agent_choose_ingroups=$_POST["agent_choose_ingroups"];}
if (isset($_GET["agentcall_manual"]))	{$agentcall_manual=$_GET["agentcall_manual"];}
	elseif (isset($_POST["agentcall_manual"]))	{$agentcall_manual=$_POST["agentcall_manual"];}
if (isset($_GET["agentonly_callbacks"]))	{$agentonly_callbacks=$_GET["agentonly_callbacks"];}
	elseif (isset($_POST["agentonly_callbacks"]))	{$agentonly_callbacks=$_POST["agentonly_callbacks"];}
if (isset($_GET["AGI_call_logging_enabled"]))	{$AGI_call_logging_enabled=$_GET["AGI_call_logging_enabled"];}
	elseif (isset($_POST["AGI_call_logging_enabled"]))	{$AGI_call_logging_enabled=$_POST["AGI_call_logging_enabled"];}
if (isset($_GET["agi_output"]))	{$agi_output=$_GET["agi_output"];}
	elseif (isset($_POST["agi_output"]))	{$agi_output=$_POST["agi_output"];}
if (isset($_GET["allcalls_delay"]))	{$allcalls_delay=$_GET["allcalls_delay"];}
	elseif (isset($_POST["allcalls_delay"]))	{$allcalls_delay=$_POST["allcalls_delay"];}
if (isset($_GET["allow_closers"]))	{$allow_closers=$_GET["allow_closers"];}
	elseif (isset($_POST["allow_closers"]))	{$allow_closers=$_POST["allow_closers"];}
if (isset($_GET["alt_number_dialing"]))	{$alt_number_dialing=$_GET["alt_number_dialing"];}
	elseif (isset($_POST["alt_number_dialing"]))	{$alt_number_dialing=$_POST["alt_number_dialing"];}
if (isset($_GET["alter_agent_interface_options"]))	{$alter_agent_interface_options=$_GET["alter_agent_interface_options"];}
	elseif (isset($_POST["alter_agent_interface_options"]))	{$alter_agent_interface_options=$_POST["alter_agent_interface_options"];}
if (isset($_GET["am_message_exten"]))	{$am_message_exten=$_GET["am_message_exten"];}
	elseif (isset($_POST["am_message_exten"]))	{$am_message_exten=$_POST["am_message_exten"];}
if (isset($_GET["amd_send_to_vmx"]))	{$amd_send_to_vmx=$_GET["amd_send_to_vmx"];}
	elseif (isset($_POST["amd_send_to_vmx"]))	{$amd_send_to_vmx=$_POST["amd_send_to_vmx"];}
if (isset($_GET["answer_transfer_agent"]))	{$answer_transfer_agent=$_GET["answer_transfer_agent"];}
	elseif (isset($_POST["answer_transfer_agent"]))	{$answer_transfer_agent=$_POST["answer_transfer_agent"];}
if (isset($_GET["ast_admin_access"]))	{$ast_admin_access=$_GET["ast_admin_access"];}
	elseif (isset($_POST["ast_admin_access"]))	{$ast_admin_access=$_POST["ast_admin_access"];}
if (isset($_GET["ast_delete_phones"]))	{$ast_delete_phones=$_GET["ast_delete_phones"];}
	elseif (isset($_POST["ast_delete_phones"]))	{$ast_delete_phones=$_POST["ast_delete_phones"];}
if (isset($_GET["asterisk_version"]))	{$asterisk_version=$_GET["asterisk_version"];}
	elseif (isset($_POST["asterisk_version"]))	{$asterisk_version=$_POST["asterisk_version"];}
if (isset($_GET["ASTmgrSECRET"]))	{$ASTmgrSECRET=$_GET["ASTmgrSECRET"];}
	elseif (isset($_POST["ASTmgrSECRET"]))	{$ASTmgrSECRET=$_POST["ASTmgrSECRET"];}
if (isset($_GET["ASTmgrUSERNAME"]))	{$ASTmgrUSERNAME=$_GET["ASTmgrUSERNAME"];}
	elseif (isset($_POST["ASTmgrUSERNAME"]))	{$ASTmgrUSERNAME=$_POST["ASTmgrUSERNAME"];}
if (isset($_GET["ASTmgrUSERNAMElisten"]))	{$ASTmgrUSERNAMElisten=$_GET["ASTmgrUSERNAMElisten"];}
	elseif (isset($_POST["ASTmgrUSERNAMElisten"]))	{$ASTmgrUSERNAMElisten=$_POST["ASTmgrUSERNAMElisten"];}
if (isset($_GET["ASTmgrUSERNAMEsend"]))	{$ASTmgrUSERNAMEsend=$_GET["ASTmgrUSERNAMEsend"];}
	elseif (isset($_POST["ASTmgrUSERNAMEsend"]))	{$ASTmgrUSERNAMEsend=$_POST["ASTmgrUSERNAMEsend"];}
if (isset($_GET["ASTmgrUSERNAMEupdate"]))	{$ASTmgrUSERNAMEupdate=$_GET["ASTmgrUSERNAMEupdate"];}
	elseif (isset($_POST["ASTmgrUSERNAMEupdate"]))	{$ASTmgrUSERNAMEupdate=$_POST["ASTmgrUSERNAMEupdate"];}
if (isset($_GET["attempt_delay"]))	{$attempt_delay=$_GET["attempt_delay"];}
	elseif (isset($_POST["attempt_delay"]))	{$attempt_delay=$_POST["attempt_delay"];}
if (isset($_GET["attempt_maximum"]))	{$attempt_maximum=$_GET["attempt_maximum"];}
	elseif (isset($_POST["attempt_maximum"]))	{$attempt_maximum=$_POST["attempt_maximum"];}
if (isset($_GET["auto_dial_level"]))	{$auto_dial_level=$_GET["auto_dial_level"];}
	elseif (isset($_POST["auto_dial_level"]))	{$auto_dial_level=$_POST["auto_dial_level"];}
if (isset($_GET["auto_dial_next_number"]))	{$auto_dial_next_number=$_GET["auto_dial_next_number"];}
	elseif (isset($_POST["auto_dial_next_number"]))	{$auto_dial_next_number=$_POST["auto_dial_next_number"];}
if (isset($_GET["available_only_ratio_tally"]))	{$available_only_ratio_tally=$_GET["available_only_ratio_tally"];}
	elseif (isset($_POST["available_only_ratio_tally"])){$available_only_ratio_tally=$_POST["available_only_ratio_tally"];}
if (isset($_GET["call_out_number_group"]))	{$call_out_number_group=$_GET["call_out_number_group"];}
	elseif (isset($_POST["call_out_number_group"]))	{$call_out_number_group=$_POST["call_out_number_group"];}
if (isset($_GET["call_parking_enabled"]))	{$call_parking_enabled=$_GET["call_parking_enabled"];}
	elseif (isset($_POST["call_parking_enabled"]))	{$call_parking_enabled=$_POST["call_parking_enabled"];}
if (isset($_GET["call_time_comments"]))	{$call_time_comments=$_GET["call_time_comments"];}
	elseif (isset($_POST["call_time_comments"]))	{$call_time_comments=$_POST["call_time_comments"];}
if (isset($_GET["call_time_id"]))	{$call_time_id=$_GET["call_time_id"];}
	elseif (isset($_POST["call_time_id"]))	{$call_time_id=$_POST["call_time_id"];}
if (isset($_GET["call_time_name"]))	{$call_time_name=$_GET["call_time_name"];}
	elseif (isset($_POST["call_time_name"]))	{$call_time_name=$_POST["call_time_name"];}
if (isset($_GET["CallerID_popup_enabled"]))	{$CallerID_popup_enabled=$_GET["CallerID_popup_enabled"];}
	elseif (isset($_POST["CallerID_popup_enabled"]))	{$CallerID_popup_enabled=$_POST["CallerID_popup_enabled"];}
if (isset($_GET["campaign_cid"]))	{$campaign_cid=$_GET["campaign_cid"];}
	elseif (isset($_POST["campaign_cid"]))	{$campaign_cid=$_POST["campaign_cid"];}
if (isset($_GET["campaign_detail"]))	{$campaign_detail=$_GET["campaign_detail"];}
	elseif (isset($_POST["campaign_detail"]))	{$campaign_detail=$_POST["campaign_detail"];}
if (isset($_GET["campaign_id"]))	{$campaign_id=$_GET["campaign_id"];}
	elseif (isset($_POST["campaign_id"]))	{$campaign_id=$_POST["campaign_id"];}
if (isset($_GET["campaign_name"]))	{$campaign_name=$_GET["campaign_name"];}
	elseif (isset($_POST["campaign_name"]))	{$campaign_name=$_POST["campaign_name"];}
if (isset($_GET["campaign_rec_exten"]))	{$campaign_rec_exten=$_GET["campaign_rec_exten"];}
	elseif (isset($_POST["campaign_rec_exten"]))	{$campaign_rec_exten=$_POST["campaign_rec_exten"];}
if (isset($_GET["campaign_rec_filename"]))	{$campaign_rec_filename=$_GET["campaign_rec_filename"];}
	elseif (isset($_POST["campaign_rec_filename"]))	{$campaign_rec_filename=$_POST["campaign_rec_filename"];}
if (isset($_GET["ingroup_rec_filename"]))	{$ingroup_rec_filename=$_GET["ingroup_rec_filename"];}
	elseif (isset($_POST["ingroup_rec_filename"]))	{$ingroup_rec_filename=$_POST["ingroup_rec_filename"];}
if (isset($_GET["campaign_recording"]))	{$campaign_recording=$_GET["campaign_recording"];}
	elseif (isset($_POST["campaign_recording"]))	{$campaign_recording=$_POST["campaign_recording"];}
if (isset($_GET["campaign_vdad_exten"]))	{$campaign_vdad_exten=$_GET["campaign_vdad_exten"];}
	elseif (isset($_POST["campaign_vdad_exten"]))	{$campaign_vdad_exten=$_POST["campaign_vdad_exten"];}
if (isset($_GET["change_agent_campaign"]))	{$change_agent_campaign=$_GET["change_agent_campaign"];}
	elseif (isset($_POST["change_agent_campaign"]))	{$change_agent_campaign=$_POST["change_agent_campaign"];}
if (isset($_GET["client_browser"]))	{$client_browser=$_GET["client_browser"];}
	elseif (isset($_POST["client_browser"]))	{$client_browser=$_POST["client_browser"];}
if (isset($_GET["closer_default_blended"]))	{$closer_default_blended=$_GET["closer_default_blended"];}
	elseif (isset($_POST["closer_default_blended"]))	{$closer_default_blended=$_POST["closer_default_blended"];}
if (isset($_GET["company"]))	{$company=$_GET["company"];}
	elseif (isset($_POST["company"]))	{$company=$_POST["company"];}
if (isset($_GET["computer_ip"]))	{$computer_ip=$_GET["computer_ip"];}
	elseif (isset($_POST["computer_ip"]))	{$computer_ip=$_POST["computer_ip"];}
if (isset($_GET["conf_exten"]))	{$conf_exten=$_GET["conf_exten"];}
	elseif (isset($_POST["conf_exten"]))	{$conf_exten=$_POST["conf_exten"];}
if (isset($_GET["conf_on_extension"]))	{$conf_on_extension=$_GET["conf_on_extension"];}
	elseif (isset($_POST["conf_on_extension"]))	{$conf_on_extension=$_POST["conf_on_extension"];}
if (isset($_GET["conferencing_enabled"]))	{$conferencing_enabled=$_GET["conferencing_enabled"];}
	elseif (isset($_POST["conferencing_enabled"]))	{$conferencing_enabled=$_POST["conferencing_enabled"];}
if (isset($_GET["CoNfIrM"]))	{$CoNfIrM=$_GET["CoNfIrM"];}
	elseif (isset($_POST["CoNfIrM"]))	{$CoNfIrM=$_POST["CoNfIrM"];}
if (isset($_GET["ct_default_start"]))	{$ct_default_start=$_GET["ct_default_start"];}
	elseif (isset($_POST["ct_default_start"]))	{$ct_default_start=$_POST["ct_default_start"];}
if (isset($_GET["ct_default_stop"]))	{$ct_default_stop=$_GET["ct_default_stop"];}
	elseif (isset($_POST["ct_default_stop"]))	{$ct_default_stop=$_POST["ct_default_stop"];}
if (isset($_GET["ct_friday_start"]))	{$ct_friday_start=$_GET["ct_friday_start"];}
	elseif (isset($_POST["ct_friday_start"]))	{$ct_friday_start=$_POST["ct_friday_start"];}
if (isset($_GET["ct_friday_stop"]))	{$ct_friday_stop=$_GET["ct_friday_stop"];}
	elseif (isset($_POST["ct_friday_stop"]))	{$ct_friday_stop=$_POST["ct_friday_stop"];}
if (isset($_GET["ct_monday_start"]))	{$ct_monday_start=$_GET["ct_monday_start"];}
	elseif (isset($_POST["ct_monday_start"]))	{$ct_monday_start=$_POST["ct_monday_start"];}
if (isset($_GET["ct_monday_stop"]))	{$ct_monday_stop=$_GET["ct_monday_stop"];}
	elseif (isset($_POST["ct_monday_stop"]))	{$ct_monday_stop=$_POST["ct_monday_stop"];}
if (isset($_GET["ct_saturday_start"]))	{$ct_saturday_start=$_GET["ct_saturday_start"];}
	elseif (isset($_POST["ct_saturday_start"]))	{$ct_saturday_start=$_POST["ct_saturday_start"];}
if (isset($_GET["ct_saturday_stop"]))	{$ct_saturday_stop=$_GET["ct_saturday_stop"];}
	elseif (isset($_POST["ct_saturday_stop"]))	{$ct_saturday_stop=$_POST["ct_saturday_stop"];}
if (isset($_GET["ct_sunday_start"]))	{$ct_sunday_start=$_GET["ct_sunday_start"];}
	elseif (isset($_POST["ct_sunday_start"]))	{$ct_sunday_start=$_POST["ct_sunday_start"];}
if (isset($_GET["ct_sunday_stop"]))	{$ct_sunday_stop=$_GET["ct_sunday_stop"];}
	elseif (isset($_POST["ct_sunday_stop"]))	{$ct_sunday_stop=$_POST["ct_sunday_stop"];}
if (isset($_GET["ct_thursday_start"]))	{$ct_thursday_start=$_GET["ct_thursday_start"];}
	elseif (isset($_POST["ct_thursday_start"]))	{$ct_thursday_start=$_POST["ct_thursday_start"];}
if (isset($_GET["ct_thursday_stop"]))	{$ct_thursday_stop=$_GET["ct_thursday_stop"];}
	elseif (isset($_POST["ct_thursday_stop"]))	{$ct_thursday_stop=$_POST["ct_thursday_stop"];}
if (isset($_GET["ct_tuesday_start"]))	{$ct_tuesday_start=$_GET["ct_tuesday_start"];}
	elseif (isset($_POST["ct_tuesday_start"]))	{$ct_tuesday_start=$_POST["ct_tuesday_start"];}
if (isset($_GET["ct_tuesday_stop"]))	{$ct_tuesday_stop=$_GET["ct_tuesday_stop"];}
	elseif (isset($_POST["ct_tuesday_stop"]))	{$ct_tuesday_stop=$_POST["ct_tuesday_stop"];}
if (isset($_GET["ct_wednesday_start"]))	{$ct_wednesday_start=$_GET["ct_wednesday_start"];}
	elseif (isset($_POST["ct_wednesday_start"]))	{$ct_wednesday_start=$_POST["ct_wednesday_start"];}
if (isset($_GET["ct_wednesday_stop"]))	{$ct_wednesday_stop=$_GET["ct_wednesday_stop"];}
	elseif (isset($_POST["ct_wednesday_stop"]))	{$ct_wednesday_stop=$_POST["ct_wednesday_stop"];}
if (isset($_GET["DBX_database"]))	{$DBX_database=$_GET["DBX_database"];}
	elseif (isset($_POST["DBX_database"]))	{$DBX_database=$_POST["DBX_database"];}
if (isset($_GET["DBX_pass"]))	{$DBX_pass=$_GET["DBX_pass"];}
	elseif (isset($_POST["DBX_pass"]))	{$DBX_pass=$_POST["DBX_pass"];}
if (isset($_GET["DBX_port"]))	{$DBX_port=$_GET["DBX_port"];}
	elseif (isset($_POST["DBX_port"]))	{$DBX_port=$_POST["DBX_port"];}
if (isset($_GET["DBX_server"]))	{$DBX_server=$_GET["DBX_server"];}
	elseif (isset($_POST["DBX_server"]))	{$DBX_server=$_POST["DBX_server"];}
if (isset($_GET["DBX_user"]))	{$DBX_user=$_GET["DBX_user"];}
	elseif (isset($_POST["DBX_user"]))	{$DBX_user=$_POST["DBX_user"];}
if (isset($_GET["DBY_database"]))	{$DBY_database=$_GET["DBY_database"];}
	elseif (isset($_POST["DBY_database"]))	{$DBY_database=$_POST["DBY_database"];}
if (isset($_GET["DBY_pass"]))	{$DBY_pass=$_GET["DBY_pass"];}
	elseif (isset($_POST["DBY_pass"]))	{$DBY_pass=$_POST["DBY_pass"];}
if (isset($_GET["DBY_port"]))	{$DBY_port=$_GET["DBY_port"];}
	elseif (isset($_POST["DBY_port"]))	{$DBY_port=$_POST["DBY_port"];}
if (isset($_GET["DBY_server"]))	{$DBY_server=$_GET["DBY_server"];}
	elseif (isset($_POST["DBY_server"]))	{$DBY_server=$_POST["DBY_server"];}
if (isset($_GET["DBY_user"]))	{$DBY_user=$_GET["DBY_user"];}
	elseif (isset($_POST["DBY_user"]))	{$DBY_user=$_POST["DBY_user"];}
if (isset($_GET["delete_call_times"]))	{$delete_call_times=$_GET["delete_call_times"];}
	elseif (isset($_POST["delete_call_times"]))	{$delete_call_times=$_POST["delete_call_times"];}
if (isset($_GET["delete_campaigns"]))	{$delete_campaigns=$_GET["delete_campaigns"];}
	elseif (isset($_POST["delete_campaigns"]))	{$delete_campaigns=$_POST["delete_campaigns"];}
if (isset($_GET["delete_filters"]))	{$delete_filters=$_GET["delete_filters"];}
	elseif (isset($_POST["delete_filters"]))	{$delete_filters=$_POST["delete_filters"];}
if (isset($_GET["delete_ingroups"]))	{$delete_ingroups=$_GET["delete_ingroups"];}
	elseif (isset($_POST["delete_ingroups"]))	{$delete_ingroups=$_POST["delete_ingroups"];}
if (isset($_GET["delete_lists"]))	{$delete_lists=$_GET["delete_lists"];}
	elseif (isset($_POST["delete_lists"]))	{$delete_lists=$_POST["delete_lists"];}
if (isset($_GET["delete_remote_agents"]))	{$delete_remote_agents=$_GET["delete_remote_agents"];}
	elseif (isset($_POST["delete_remote_agents"]))	{$delete_remote_agents=$_POST["delete_remote_agents"];}
if (isset($_GET["delete_scripts"]))	{$delete_scripts=$_GET["delete_scripts"];}
	elseif (isset($_POST["delete_scripts"]))	{$delete_scripts=$_POST["delete_scripts"];}
if (isset($_GET["delete_user_groups"]))	{$delete_user_groups=$_GET["delete_user_groups"];}
	elseif (isset($_POST["delete_user_groups"]))	{$delete_user_groups=$_POST["delete_user_groups"];}
if (isset($_GET["delete_users"]))	{$delete_users=$_GET["delete_users"];}
	elseif (isset($_POST["delete_users"]))	{$delete_users=$_POST["delete_users"];}
if (isset($_GET["dial_method"]))	{$dial_method=$_GET["dial_method"];}
	elseif (isset($_POST["dial_method"]))	{$dial_method=$_POST["dial_method"];}
if (isset($_GET["dial_prefix"]))	{$dial_prefix=$_GET["dial_prefix"];}
	elseif (isset($_POST["dial_prefix"]))	{$dial_prefix=$_POST["dial_prefix"];}
if (isset($_GET["dial_status_a"]))	{$dial_status_a=$_GET["dial_status_a"];}
	elseif (isset($_POST["dial_status_a"]))	{$dial_status_a=$_POST["dial_status_a"];}
if (isset($_GET["dial_status_b"]))	{$dial_status_b=$_GET["dial_status_b"];}
	elseif (isset($_POST["dial_status_b"]))	{$dial_status_b=$_POST["dial_status_b"];}
if (isset($_GET["dial_status_c"]))	{$dial_status_c=$_GET["dial_status_c"];}
	elseif (isset($_POST["dial_status_c"]))	{$dial_status_c=$_POST["dial_status_c"];}
if (isset($_GET["dial_status_d"]))	{$dial_status_d=$_GET["dial_status_d"];}
	elseif (isset($_POST["dial_status_d"]))	{$dial_status_d=$_POST["dial_status_d"];}
if (isset($_GET["dial_status_e"]))	{$dial_status_e=$_GET["dial_status_e"];}
	elseif (isset($_POST["dial_status_e"]))	{$dial_status_e=$_POST["dial_status_e"];}
if (isset($_GET["dial_timeout"]))	{$dial_timeout=$_GET["dial_timeout"];}
	elseif (isset($_POST["dial_timeout"]))	{$dial_timeout=$_POST["dial_timeout"];}
if (isset($_GET["dialplan_number"]))	{$dialplan_number=$_GET["dialplan_number"];}
	elseif (isset($_POST["dialplan_number"]))	{$dialplan_number=$_POST["dialplan_number"];}
if (isset($_GET["drop_call_seconds"]))	{$drop_call_seconds=$_GET["drop_call_seconds"];}
	elseif (isset($_POST["drop_call_seconds"]))	{$drop_call_seconds=$_POST["drop_call_seconds"];}
if (isset($_GET["drop_exten"]))	{$drop_exten=$_GET["drop_exten"];}
	elseif (isset($_POST["drop_exten"]))	{$drop_exten=$_POST["drop_exten"];}
if (isset($_GET["drop_action"]))	{$drop_action=$_GET["drop_action"];}
	elseif (isset($_POST["drop_action"]))	{$drop_action=$_POST["drop_action"];}
if (isset($_GET["dtmf_send_extension"]))	{$dtmf_send_extension=$_GET["dtmf_send_extension"];}
	elseif (isset($_POST["dtmf_send_extension"]))	{$dtmf_send_extension=$_POST["dtmf_send_extension"];}
if (isset($_GET["enable_fast_refresh"]))	{$enable_fast_refresh=$_GET["enable_fast_refresh"];}
	elseif (isset($_POST["enable_fast_refresh"]))	{$enable_fast_refresh=$_POST["enable_fast_refresh"];}
if (isset($_GET["enable_persistant_mysql"]))	{$enable_persistant_mysql=$_GET["enable_persistant_mysql"];}
	elseif (isset($_POST["enable_persistant_mysql"]))	{$enable_persistant_mysql=$_POST["enable_persistant_mysql"];}
if (isset($_GET["ext_context"]))	{$ext_context=$_GET["ext_context"];}
	elseif (isset($_POST["ext_context"]))	{$ext_context=$_POST["ext_context"];}
if (isset($_GET["extension"]))	{$extension=$_GET["extension"];}
	elseif (isset($_POST["extension"]))	{$extension=$_POST["extension"];}
if (isset($_GET["fast_refresh_rate"]))	{$fast_refresh_rate=$_GET["fast_refresh_rate"];}
	elseif (isset($_POST["fast_refresh_rate"]))	{$fast_refresh_rate=$_POST["fast_refresh_rate"];}
if (isset($_GET["force_logout"]))	{$force_logout=$_GET["force_logout"];}
	elseif (isset($_POST["force_logout"]))	{$force_logout=$_POST["force_logout"];}
if (isset($_GET["fronter_display"]))	{$fronter_display=$_GET["fronter_display"];}
	elseif (isset($_POST["fronter_display"]))	{$fronter_display=$_POST["fronter_display"];}
if (isset($_GET["full_name"]))	{$full_name=$_GET["full_name"];}
	elseif (isset($_POST["full_name"]))	{$full_name=$_POST["full_name"];}
if (isset($_GET["fullname"]))	{$fullname=$_GET["fullname"];}
	elseif (isset($_POST["fullname"]))	{$fullname=$_POST["fullname"];}
if (isset($_GET["get_call_launch"]))	{$get_call_launch=$_GET["get_call_launch"];}
	elseif (isset($_POST["get_call_launch"]))	{$get_call_launch=$_POST["get_call_launch"];}
if (isset($_GET["group_color"]))	{$group_color=$_GET["group_color"];}
	elseif (isset($_POST["group_color"]))	{$group_color=$_POST["group_color"];}
if (isset($_GET["group_id"]))	{$group_id=$_GET["group_id"];}
	elseif (isset($_POST["group_id"]))	{$group_id=$_POST["group_id"];}
if (isset($_GET["group_name"]))	{$group_name=$_GET["group_name"];}
	elseif (isset($_POST["group_name"]))	{$group_name=$_POST["group_name"];}
if (isset($_GET["groups"]))	{$groups=$_GET["groups"];}
	elseif (isset($_POST["groups"]))	{$groups=$_POST["groups"];}
if (isset($_GET["XFERgroups"]))	{$XFERgroups=$_GET["XFERgroups"];}
	elseif (isset($_POST["XFERgroups"]))	{$XFERgroups=$_POST["XFERgroups"];}
if (isset($_GET["HKstatus"]))	{$HKstatus=$_GET["HKstatus"];}
	elseif (isset($_POST["HKstatus"]))	{$HKstatus=$_POST["HKstatus"];}
if (isset($_GET["hopper_level"]))	{$hopper_level=$_GET["hopper_level"];}
	elseif (isset($_POST["hopper_level"]))	{$hopper_level=$_POST["hopper_level"];}
if (isset($_GET["hotkey"]))	{$hotkey=$_GET["hotkey"];}
	elseif (isset($_POST["hotkey"]))	{$hotkey=$_POST["hotkey"];}
if (isset($_GET["hotkeys_active"]))	{$hotkeys_active=$_GET["hotkeys_active"];}
	elseif (isset($_POST["hotkeys_active"]))	{$hotkeys_active=$_POST["hotkeys_active"];}
if (isset($_GET["install_directory"]))	{$install_directory=$_GET["install_directory"];}
	elseif (isset($_POST["install_directory"]))	{$install_directory=$_POST["install_directory"];}
if (isset($_GET["lead_filter_comments"]))	{$lead_filter_comments=$_GET["lead_filter_comments"];}
	elseif (isset($_POST["lead_filter_comments"]))	{$lead_filter_comments=$_POST["lead_filter_comments"];}
if (isset($_GET["lead_filter_id"]))	{$lead_filter_id=$_GET["lead_filter_id"];}
	elseif (isset($_POST["lead_filter_id"]))	{$lead_filter_id=$_POST["lead_filter_id"];}
if (isset($_GET["lead_filter_name"]))	{$lead_filter_name=$_GET["lead_filter_name"];}
	elseif (isset($_POST["lead_filter_name"]))	{$lead_filter_name=$_POST["lead_filter_name"];}
if (isset($_GET["lead_filter_sql"]))	{$lead_filter_sql=$_GET["lead_filter_sql"];}
	elseif (isset($_POST["lead_filter_sql"]))	{$lead_filter_sql=$_POST["lead_filter_sql"];}
if (isset($_GET["lead_order"]))	{$lead_order=$_GET["lead_order"];}
	elseif (isset($_POST["lead_order"]))	{$lead_order=$_POST["lead_order"];}
if (isset($_GET["list_id"]))	{$list_id=$_GET["list_id"];}
	elseif (isset($_POST["list_id"]))	{$list_id=$_POST["list_id"];}
if (isset($_GET["list_name"]))	{$list_name=$_GET["list_name"];}
	elseif (isset($_POST["list_name"]))	{$list_name=$_POST["list_name"];}
if (isset($_GET["load_leads"]))	{$load_leads=$_GET["load_leads"];}
	elseif (isset($_POST["load_leads"]))	{$load_leads=$_POST["load_leads"];}
if (isset($_GET["local_call_time"]))	{$local_call_time=$_GET["local_call_time"];}
	elseif (isset($_POST["local_call_time"]))	{$local_call_time=$_POST["local_call_time"];}
if (isset($_GET["local_gmt"]))	{$local_gmt=$_GET["local_gmt"];}
	elseif (isset($_POST["local_gmt"]))	{$local_gmt=$_POST["local_gmt"];}
if (isset($_GET["local_web_callerID_URL"]))	{$local_web_callerID_URL=$_GET["local_web_callerID_URL"];}
	elseif (isset($_POST["local_web_callerID_URL"]))	{$local_web_callerID_URL=$_POST["local_web_callerID_URL"];}
if (isset($_GET["login"]))	{$login=$_GET["login"];}
	elseif (isset($_POST["login"]))	{$login=$_POST["login"];}
if (isset($_GET["login_campaign"]))	{$login_campaign=$_GET["login_campaign"];}
	elseif (isset($_POST["login_campaign"]))	{$login_campaign=$_POST["login_campaign"];}
if (isset($_GET["login_pass"]))	{$login_pass=$_GET["login_pass"];}
	elseif (isset($_POST["login_pass"]))	{$login_pass=$_POST["login_pass"];}
if (isset($_GET["login_user"]))	{$login_user=$_GET["login_user"];}
	elseif (isset($_POST["login_user"]))	{$login_user=$_POST["login_user"];}
if (isset($_GET["log_recording_access"]))	{$log_recording_access=$_GET["log_recording_access"];}
	elseif (isset($_POST["log_recording_access"]))	{$log_recording_access=$_POST["log_recording_access"];}
if (isset($_GET["max_vicidial_trunks"]))	{$max_vicidial_trunks=$_GET["max_vicidial_trunks"];}
	elseif (isset($_POST["max_vicidial_trunks"]))	{$max_vicidial_trunks=$_POST["max_vicidial_trunks"];}
if (isset($_GET["modify_call_times"]))	{$modify_call_times=$_GET["modify_call_times"];}
	elseif (isset($_POST["modify_call_times"]))	{$modify_call_times=$_POST["modify_call_times"];}
if (isset($_GET["modify_leads"]))	{$modify_leads=$_GET["modify_leads"];}
	elseif (isset($_POST["modify_leads"]))	{$modify_leads=$_POST["modify_leads"];}
if (isset($_GET["export_gdpr_leads"]))	{$export_gdpr_leads=$_GET["export_gdpr_leads"];}
	elseif (isset($_POST["export_gdpr_leads"]))	{$export_gdpr_leads=$_POST["export_gdpr_leads"];}
if (isset($_GET["monitor_prefix"]))	{$monitor_prefix=$_GET["monitor_prefix"];}
	elseif (isset($_POST["monitor_prefix"]))	{$monitor_prefix=$_POST["monitor_prefix"];}
if (isset($_GET["new_extension"]))	{$new_extension=$_GET["new_extension"];}
	elseif (isset($_POST["new_extension"]))	{$new_extension=$_POST["new_extension"];}
if (isset($_GET["new_dialplan_number"]))	{$new_dialplan_number=$_GET["new_dialplan_number"];}
	elseif (isset($_POST["new_dialplan_number"]))	{$new_dialplan_number=$_POST["new_dialplan_number"];}
if (isset($_GET["new_voicemail_id"]))	{$new_voicemail_id=$_GET["new_voicemail_id"];}
	elseif (isset($_POST["new_voicemail_id"]))	{$new_voicemail_id=$_POST["new_voicemail_id"];}
if (isset($_GET["new_outbound_cid"]))	{$new_outbound_cid=$_GET["new_outbound_cid"];}
	elseif (isset($_POST["new_outbound_cid"]))	{$new_outbound_cid=$_POST["new_outbound_cid"];}
if (isset($_GET["new_server_ip"]))	{$new_server_ip=$_GET["new_server_ip"];}
	elseif (isset($_POST["new_server_ip"]))	{$new_server_ip=$_POST["new_server_ip"];}
if (isset($_GET["new_login"]))	{$new_login=$_GET["new_login"];}
	elseif (isset($_POST["new_login"]))	{$new_login=$_POST["new_login"];}
if (isset($_GET["new_pass"]))	{$new_pass=$_GET["new_pass"];}
	elseif (isset($_POST["new_pass"]))	{$new_pass=$_POST["new_pass"];}
if (isset($_GET["new_conf_secret"]))	{$new_conf_secret=$_GET["new_conf_secret"];}
	elseif (isset($_POST["new_conf_secret"]))	{$new_conf_secret=$_POST["new_conf_secret"];}
if (isset($_GET["new_fullname"]))	{$new_fullname=$_GET["new_fullname"];}
	elseif (isset($_POST["new_fullname"]))	{$new_fullname=$_POST["new_fullname"];}
if (isset($_GET["next_agent_call"]))	{$next_agent_call=$_GET["next_agent_call"];}
	elseif (isset($_POST["next_agent_call"]))	{$next_agent_call=$_POST["next_agent_call"];}
if (isset($_GET["number_of_lines"]))	{$number_of_lines=$_GET["number_of_lines"];}
	elseif (isset($_POST["number_of_lines"]))	{$number_of_lines=$_POST["number_of_lines"];}
if (isset($_GET["old_campaign_id"]))	{$old_campaign_id=$_GET["old_campaign_id"];}
	elseif (isset($_POST["old_campaign_id"]))	{$old_campaign_id=$_POST["old_campaign_id"];}
if (isset($_GET["old_conf_exten"]))	{$old_conf_exten=$_GET["old_conf_exten"];}
	elseif (isset($_POST["old_conf_exten"]))	{$old_conf_exten=$_POST["old_conf_exten"];}
if (isset($_GET["old_extension"]))	{$old_extension=$_GET["old_extension"];}
	elseif (isset($_POST["old_extension"]))	{$old_extension=$_POST["old_extension"];}
if (isset($_GET["old_server_id"]))	{$old_server_id=$_GET["old_server_id"];}
	elseif (isset($_POST["old_server_id"]))	{$old_server_id=$_POST["old_server_id"];}
if (isset($_GET["old_server_ip"]))	{$old_server_ip=$_GET["old_server_ip"];}
	elseif (isset($_POST["old_server_ip"]))	{$old_server_ip=$_POST["old_server_ip"];}
if (isset($_GET["OLDuser_group"]))	{$OLDuser_group=$_GET["OLDuser_group"];}
	elseif (isset($_POST["OLDuser_group"]))	{$OLDuser_group=$_POST["OLDuser_group"];}
if (isset($_GET["omit_phone_code"]))	{$omit_phone_code=$_GET["omit_phone_code"];}
	elseif (isset($_POST["omit_phone_code"]))	{$omit_phone_code=$_POST["omit_phone_code"];}
if (isset($_GET["outbound_cid"]))	{$outbound_cid=$_GET["outbound_cid"];}
	elseif (isset($_POST["outbound_cid"]))	{$outbound_cid=$_POST["outbound_cid"];}
if (isset($_GET["park_ext"]))	{$park_ext=$_GET["park_ext"];}
	elseif (isset($_POST["park_ext"]))	{$park_ext=$_POST["park_ext"];}
if (isset($_GET["park_file_name"]))	{$park_file_name=$_GET["park_file_name"];}
	elseif (isset($_POST["park_file_name"]))	{$park_file_name=$_POST["park_file_name"];}
if (isset($_GET["park_on_extension"]))	{$park_on_extension=$_GET["park_on_extension"];}
	elseif (isset($_POST["park_on_extension"]))	{$park_on_extension=$_POST["park_on_extension"];}
if (isset($_GET["pass"]))	{$pass=$_GET["pass"];}
	elseif (isset($_POST["pass"]))	{$pass=$_POST["pass"];}
if (isset($_GET["phone_defaults_container"]))	{$phone_defaults_container=$_GET["phone_defaults_container"];}
	elseif (isset($_POST["phone_defaults_container"]))	{$phone_defaults_container=$_POST["phone_defaults_container"];}
if (isset($_GET["phone_ip"]))	{$phone_ip=$_GET["phone_ip"];}
	elseif (isset($_POST["phone_ip"]))	{$phone_ip=$_POST["phone_ip"];}
if (isset($_GET["phone_login"]))	{$phone_login=$_GET["phone_login"];}
	elseif (isset($_POST["phone_login"]))	{$phone_login=$_POST["phone_login"];}
if (isset($_GET["phone_number"]))	{$phone_number=$_GET["phone_number"];}
	elseif (isset($_POST["phone_number"]))	{$phone_number=$_POST["phone_number"];}
if (isset($_GET["phone_pass"]))	{$phone_pass=$_GET["phone_pass"];}
	elseif (isset($_POST["phone_pass"]))	{$phone_pass=$_POST["phone_pass"];}
if (isset($_GET["phone_type"]))	{$phone_type=$_GET["phone_type"];}
	elseif (isset($_POST["phone_type"]))	{$phone_type=$_POST["phone_type"];}
if (isset($_GET["picture"]))	{$picture=$_GET["picture"];}
	elseif (isset($_POST["picture"]))	{$picture=$_POST["picture"];}
if (isset($_GET["protocol"]))	{$protocol=$_GET["protocol"];}
	elseif (isset($_POST["protocol"]))	{$protocol=$_POST["protocol"];}
if (isset($_GET["QUEUE_ACTION_enabled"]))	{$QUEUE_ACTION_enabled=$_GET["QUEUE_ACTION_enabled"];}
	elseif (isset($_POST["QUEUE_ACTION_enabled"]))	{$QUEUE_ACTION_enabled=$_POST["QUEUE_ACTION_enabled"];}
if (isset($_GET["recording_exten"]))	{$recording_exten=$_GET["recording_exten"];}
	elseif (isset($_POST["recording_exten"]))	{$recording_exten=$_POST["recording_exten"];}
if (isset($_GET["remote_agent_id"]))	{$remote_agent_id=$_GET["remote_agent_id"];}
	elseif (isset($_POST["remote_agent_id"]))	{$remote_agent_id=$_POST["remote_agent_id"];}
if (isset($_GET["reset_hopper"]))	{$reset_hopper=$_GET["reset_hopper"];}
	elseif (isset($_POST["reset_hopper"]))	{$reset_hopper=$_POST["reset_hopper"];}
if (isset($_GET["reset_list"]))	{$reset_list=$_GET["reset_list"];}
	elseif (isset($_POST["reset_list"]))	{$reset_list=$_POST["reset_list"];}
if (isset($_GET["safe_harbor_exten"]))	{$safe_harbor_exten=$_GET["safe_harbor_exten"];}
	elseif (isset($_POST["safe_harbor_exten"]))	{$safe_harbor_exten=$_POST["safe_harbor_exten"];}
if (isset($_GET["scheduled_callbacks"]))	{$scheduled_callbacks=$_GET["scheduled_callbacks"];}
	elseif (isset($_POST["scheduled_callbacks"]))	{$scheduled_callbacks=$_POST["scheduled_callbacks"];}
if (isset($_GET["script_comments"]))	{$script_comments=$_GET["script_comments"];}
	elseif (isset($_POST["script_comments"]))	{$script_comments=$_POST["script_comments"];}
if (isset($_GET["script_id"]))	{$script_id=$_GET["script_id"];}
	elseif (isset($_POST["script_id"]))	{$script_id=$_POST["script_id"];}
if (isset($_GET["script_name"]))	{$script_name=$_GET["script_name"];}
	elseif (isset($_POST["script_name"]))	{$script_name=$_POST["script_name"];}
if (isset($_GET["script_text"]))	{$script_text=$_GET["script_text"];}
	elseif (isset($_POST["script_text"]))	{$script_text=$_POST["script_text"];}
if (isset($_GET["selectable"]))	{$selectable=$_GET["selectable"];}
	elseif (isset($_POST["selectable"]))	{$selectable=$_POST["selectable"];}
if (isset($_GET["server_description"]))	{$server_description=$_GET["server_description"];}
	elseif (isset($_POST["server_description"]))	{$server_description=$_POST["server_description"];}
if (isset($_GET["server_id"]))	{$server_id=$_GET["server_id"];}
	elseif (isset($_POST["server_id"]))	{$server_id=$_POST["server_id"];}
if (isset($_GET["server_ip"]))	{$server_ip=$_GET["server_ip"];}
	elseif (isset($_POST["server_ip"]))	{$server_ip=$_POST["server_ip"];}
if (isset($_GET["source_phone"]))	{$source_phone=$_GET["source_phone"];}
	elseif (isset($_POST["source_phone"]))	{$source_phone=$_POST["source_phone"];}
if (isset($_GET["stage"]))	{$stage=$_GET["stage"];}
	elseif (isset($_POST["stage"]))	{$stage=$_POST["stage"];}
if (isset($_GET["state_call_time_state"]))	{$state_call_time_state=$_GET["state_call_time_state"];}
	elseif (isset($_POST["state_call_time_state"]))	{$state_call_time_state=$_POST["state_call_time_state"];}
if (isset($_GET["state_rule"]))	{$state_rule=$_GET["state_rule"];}
	elseif (isset($_POST["state_rule"]))	{$state_rule=$_POST["state_rule"];}
if (isset($_GET["status"]))	{$status=$_GET["status"];}
	elseif (isset($_POST["status"]))	{$status=$_POST["status"];}
if (isset($_GET["status_id"]))	{$status_id=$_GET["status_id"];}
	elseif (isset($_POST["status_id"]))	{$status_id=$_POST["status_id"];}
if (isset($_GET["status_name"]))	{$status_name=$_GET["status_name"];}
	elseif (isset($_POST["status_name"]))	{$status_name=$_POST["status_name"];}
if (isset($_GET["submit"]))	{$submit=$_GET["submit"];}
	elseif (isset($_POST["submit"]))	{$submit=$_POST["submit"];}
if (isset($_GET["SUBMIT"]))	{$SUBMIT=$_GET["SUBMIT"];}
	elseif (isset($_POST["SUBMIT"]))	{$SUBMIT=$_POST["SUBMIT"];}
if (isset($_GET["sys_perf_log"]))	{$sys_perf_log=$_GET["sys_perf_log"];}
	elseif (isset($_POST["sys_perf_log"]))	{$sys_perf_log=$_POST["sys_perf_log"];}
if (isset($_GET["telnet_host"]))	{$telnet_host=$_GET["telnet_host"];}
	elseif (isset($_POST["telnet_host"]))	{$telnet_host=$_POST["telnet_host"];}
if (isset($_GET["telnet_port"]))	{$telnet_port=$_GET["telnet_port"];}
	elseif (isset($_POST["telnet_port"]))	{$telnet_port=$_POST["telnet_port"];}
if (isset($_GET["updater_check_enabled"]))	{$updater_check_enabled=$_GET["updater_check_enabled"];}
	elseif (isset($_POST["updater_check_enabled"]))	{$updater_check_enabled=$_POST["updater_check_enabled"];}
if (isset($_GET["use_internal_dnc"]))	{$use_internal_dnc=$_GET["use_internal_dnc"];}
	elseif (isset($_POST["use_internal_dnc"]))	{$use_internal_dnc=$_POST["use_internal_dnc"];}
if (isset($_GET["use_campaign_dnc"]))	{$use_campaign_dnc=$_GET["use_campaign_dnc"];}
	elseif (isset($_POST["use_campaign_dnc"]))	{$use_campaign_dnc=$_POST["use_campaign_dnc"];}
if (isset($_GET["user"]))	{$user=$_GET["user"];}
	elseif (isset($_POST["user"]))	{$user=$_POST["user"];}
if (isset($_GET["user_group"]))	{$user_group=$_GET["user_group"];}
	elseif (isset($_POST["user_group"]))	{$user_group=$_POST["user_group"];}
if (isset($_GET["user_level"]))	{$user_level=$_GET["user_level"];}
	elseif (isset($_POST["user_level"]))	{$user_level=$_POST["user_level"];}
if (isset($_GET["user_start"]))	{$user_start=$_GET["user_start"];}
	elseif (isset($_POST["user_start"]))	{$user_start=$_POST["user_start"];}
if (isset($_GET["user_switching_enabled"]))	{$user_switching_enabled=$_GET["user_switching_enabled"];}
	elseif (isset($_POST["user_switching_enabled"]))	{$user_switching_enabled=$_POST["user_switching_enabled"];}
if (isset($_GET["vd_server_logs"]))	{$vd_server_logs=$_GET["vd_server_logs"];}
	elseif (isset($_POST["vd_server_logs"]))	{$vd_server_logs=$_POST["vd_server_logs"];}
if (isset($_GET["VDstop_rec_after_each_call"]))	{$VDstop_rec_after_each_call=$_GET["VDstop_rec_after_each_call"];}
	elseif (isset($_POST["VDstop_rec_after_each_call"]))	{$VDstop_rec_after_each_call=$_POST["VDstop_rec_after_each_call"];}
if (isset($_GET["VICIDIAL_park_on_extension"]))	{$VICIDIAL_park_on_extension=$_GET["VICIDIAL_park_on_extension"];}
	elseif (isset($_POST["VICIDIAL_park_on_extension"]))	{$VICIDIAL_park_on_extension=$_POST["VICIDIAL_park_on_extension"];}
if (isset($_GET["VICIDIAL_park_on_filename"]))	{$VICIDIAL_park_on_filename=$_GET["VICIDIAL_park_on_filename"];}
	elseif (isset($_POST["VICIDIAL_park_on_filename"]))	{$VICIDIAL_park_on_filename=$_POST["VICIDIAL_park_on_filename"];}
if (isset($_GET["vicidial_recording"]))	{$vicidial_recording=$_GET["vicidial_recording"];}
	elseif (isset($_POST["vicidial_recording"]))	{$vicidial_recording=$_POST["vicidial_recording"];}
if (isset($_GET["vicidial_transfers"]))	{$vicidial_transfers=$_GET["vicidial_transfers"];}
	elseif (isset($_POST["vicidial_transfers"]))	{$vicidial_transfers=$_POST["vicidial_transfers"];}
if (isset($_GET["VICIDIAL_web_URL"]))	{$VICIDIAL_web_URL=$_GET["VICIDIAL_web_URL"];}
	elseif (isset($_POST["VICIDIAL_web_URL"]))	{$VICIDIAL_web_URL=$_POST["VICIDIAL_web_URL"];}
if (isset($_GET["voicemail_button_enabled"]))	{$voicemail_button_enabled=$_GET["voicemail_button_enabled"];}
	elseif (isset($_POST["voicemail_button_enabled"]))	{$voicemail_button_enabled=$_POST["voicemail_button_enabled"];}
if (isset($_GET["voicemail_dump_exten"]))	{$voicemail_dump_exten=$_GET["voicemail_dump_exten"];}
	elseif (isset($_POST["voicemail_dump_exten"]))	{$voicemail_dump_exten=$_POST["voicemail_dump_exten"];}
if (isset($_GET["voicemail_ext"]))	{$voicemail_ext=$_GET["voicemail_ext"];}
	elseif (isset($_POST["voicemail_ext"]))	{$voicemail_ext=$_POST["voicemail_ext"];}
if (isset($_GET["voicemail_exten"]))	{$voicemail_exten=$_GET["voicemail_exten"];}
	elseif (isset($_POST["voicemail_exten"]))	{$voicemail_exten=$_POST["voicemail_exten"];}
if (isset($_GET["voicemail_id"]))	{$voicemail_id=$_GET["voicemail_id"];}
	elseif (isset($_POST["voicemail_id"]))	{$voicemail_id=$_POST["voicemail_id"];}
if (isset($_GET["web_form_address"]))	{$web_form_address=$_GET["web_form_address"];}
	elseif (isset($_POST["web_form_address"]))	{$web_form_address=$_POST["web_form_address"];}
if (isset($_GET["wrapup_message"]))	{$wrapup_message=$_GET["wrapup_message"];}
	elseif (isset($_POST["wrapup_message"]))	{$wrapup_message=$_POST["wrapup_message"];}
if (isset($_GET["wrapup_seconds"]))	{$wrapup_seconds=$_GET["wrapup_seconds"];}
	elseif (isset($_POST["wrapup_seconds"]))	{$wrapup_seconds=$_POST["wrapup_seconds"];}
if (isset($_GET["xferconf_a_dtmf"]))	{$xferconf_a_dtmf=$_GET["xferconf_a_dtmf"];}
	elseif (isset($_POST["xferconf_a_dtmf"]))	{$xferconf_a_dtmf=$_POST["xferconf_a_dtmf"];}
if (isset($_GET["xferconf_a_number"]))	{$xferconf_a_number=$_GET["xferconf_a_number"];}
	elseif (isset($_POST["xferconf_a_number"]))	{$xferconf_a_number=$_POST["xferconf_a_number"];}
if (isset($_GET["xferconf_b_dtmf"]))	{$xferconf_b_dtmf=$_GET["xferconf_b_dtmf"];}
	elseif (isset($_POST["xferconf_b_dtmf"]))	{$xferconf_b_dtmf=$_POST["xferconf_b_dtmf"];}
if (isset($_GET["xferconf_b_number"]))	{$xferconf_b_number=$_GET["xferconf_b_number"];}
	elseif (isset($_POST["xferconf_b_number"]))	{$xferconf_b_number=$_POST["xferconf_b_number"];}
if (isset($_GET["vicidial_balance_active"]))	{$vicidial_balance_active=$_GET["vicidial_balance_active"];}
	elseif (isset($_POST["vicidial_balance_active"]))	{$vicidial_balance_active=$_POST["vicidial_balance_active"];}
if (isset($_GET["balance_trunks_offlimits"]))	{$balance_trunks_offlimits=$_GET["balance_trunks_offlimits"];}
	elseif (isset($_POST["balance_trunks_offlimits"]))	{$balance_trunks_offlimits=$_POST["balance_trunks_offlimits"];}
if (isset($_GET["dedicated_trunks"]))	{$dedicated_trunks=$_GET["dedicated_trunks"];}
	elseif (isset($_POST["dedicated_trunks"]))	{$dedicated_trunks=$_POST["dedicated_trunks"];}
if (isset($_GET["trunk_restriction"]))	{$trunk_restriction=$_GET["trunk_restriction"];}
	elseif (isset($_POST["trunk_restriction"]))	{$trunk_restriction=$_POST["trunk_restriction"];}
if (isset($_GET["campaigns"]))						{$campaigns=$_GET["campaigns"];}
	elseif (isset($_POST["campaigns"]))				{$campaigns=$_POST["campaigns"];}
if (isset($_GET["dial_level_override"]))			{$dial_level_override=$_GET["dial_level_override"];}
	elseif (isset($_POST["dial_level_override"]))	{$dial_level_override=$_POST["dial_level_override"];}
if (isset($_GET["concurrent_transfers"]))			{$concurrent_transfers=$_GET["concurrent_transfers"];}
	elseif (isset($_POST["concurrent_transfers"]))	{$concurrent_transfers=$_POST["concurrent_transfers"];}
if (isset($_GET["auto_alt_dial"]))			{$auto_alt_dial=$_GET["auto_alt_dial"];}
	elseif (isset($_POST["auto_alt_dial"]))	{$auto_alt_dial=$_POST["auto_alt_dial"];}
if (isset($_GET["modify_users"]))				{$modify_users=$_GET["modify_users"];}
	elseif (isset($_POST["modify_users"]))		{$modify_users=$_POST["modify_users"];}
if (isset($_GET["modify_campaigns"]))			{$modify_campaigns=$_GET["modify_campaigns"];}
	elseif (isset($_POST["modify_campaigns"]))	{$modify_campaigns=$_POST["modify_campaigns"];}
if (isset($_GET["modify_lists"]))				{$modify_lists=$_GET["modify_lists"];}
	elseif (isset($_POST["modify_lists"]))		{$modify_lists=$_POST["modify_lists"];}
if (isset($_GET["modify_scripts"]))				{$modify_scripts=$_GET["modify_scripts"];}
	elseif (isset($_POST["modify_scripts"]))	{$modify_scripts=$_POST["modify_scripts"];}
if (isset($_GET["modify_filters"]))				{$modify_filters=$_GET["modify_filters"];}
	elseif (isset($_POST["modify_filters"]))	{$modify_filters=$_POST["modify_filters"];}
if (isset($_GET["modify_ingroups"]))			{$modify_ingroups=$_GET["modify_ingroups"];}
	elseif (isset($_POST["modify_ingroups"]))	{$modify_ingroups=$_POST["modify_ingroups"];}
if (isset($_GET["modify_usergroups"]))			{$modify_usergroups=$_GET["modify_usergroups"];}
	elseif (isset($_POST["modify_usergroups"]))	{$modify_usergroups=$_POST["modify_usergroups"];}
if (isset($_GET["modify_remoteagents"]))			{$modify_remoteagents=$_GET["modify_remoteagents"];}
	elseif (isset($_POST["modify_remoteagents"]))	{$modify_remoteagents=$_POST["modify_remoteagents"];}
if (isset($_GET["modify_servers"]))				{$modify_servers=$_GET["modify_servers"];}
	elseif (isset($_POST["modify_servers"]))	{$modify_servers=$_POST["modify_servers"];}
if (isset($_GET["view_reports"]))				{$view_reports=$_GET["view_reports"];}
	elseif (isset($_POST["view_reports"]))		{$view_reports=$_POST["view_reports"];}
if (isset($_GET["agent_pause_codes_active"]))			{$agent_pause_codes_active=$_GET["agent_pause_codes_active"];}
	elseif (isset($_POST["agent_pause_codes_active"]))	{$agent_pause_codes_active=$_POST["agent_pause_codes_active"];}
if (isset($_GET["pause_code"]))					{$pause_code=$_GET["pause_code"];}
	elseif (isset($_POST["pause_code"]))		{$pause_code=$_POST["pause_code"];}
if (isset($_GET["pause_code_name"]))			{$pause_code_name=$_GET["pause_code_name"];}
	elseif (isset($_POST["pause_code_name"]))	{$pause_code_name=$_POST["pause_code_name"];}
if (isset($_GET["billable"]))					{$billable=$_GET["billable"];}
	elseif (isset($_POST["billable"]))			{$billable=$_POST["billable"];}
if (isset($_GET["campaign_description"]))			{$campaign_description=$_GET["campaign_description"];}
	elseif (isset($_POST["campaign_description"]))	{$campaign_description=$_POST["campaign_description"];}
if (isset($_GET["campaign_stats_refresh"]))			{$campaign_stats_refresh=$_GET["campaign_stats_refresh"];}
	elseif (isset($_POST["campaign_stats_refresh"])){$campaign_stats_refresh=$_POST["campaign_stats_refresh"];}
if (isset($_GET["list_description"]))			{$list_description=$_GET["list_description"];}
	elseif (isset($_POST["list_description"]))	{$list_description=$_POST["list_description"];}
if (isset($_GET["vicidial_recording_override"]))		{$vicidial_recording_override=$_GET["vicidial_recording_override"];}	
	elseif (isset($_POST["vicidial_recording_override"]))	{$vicidial_recording_override=$_POST["vicidial_recording_override"];}
if (isset($_GET["use_non_latin"]))				{$use_non_latin=$_GET["use_non_latin"];}
	elseif (isset($_POST["use_non_latin"]))		{$use_non_latin=$_POST["use_non_latin"];}
if (isset($_GET["webroot_writable"]))			{$webroot_writable=$_GET["webroot_writable"];}
	elseif (isset($_POST["webroot_writable"]))	{$webroot_writable=$_POST["webroot_writable"];}
if (isset($_GET["enable_queuemetrics_logging"]))	{$enable_queuemetrics_logging=$_GET["enable_queuemetrics_logging"];}
	elseif (isset($_POST["enable_queuemetrics_logging"]))	{$enable_queuemetrics_logging=$_POST["enable_queuemetrics_logging"];}
if (isset($_GET["queuemetrics_server_ip"]))				{$queuemetrics_server_ip=$_GET["queuemetrics_server_ip"];}
	elseif (isset($_POST["queuemetrics_server_ip"]))	{$queuemetrics_server_ip=$_POST["queuemetrics_server_ip"];}
if (isset($_GET["queuemetrics_dbname"]))			{$queuemetrics_dbname=$_GET["queuemetrics_dbname"];}
	elseif (isset($_POST["queuemetrics_dbname"]))	{$queuemetrics_dbname=$_POST["queuemetrics_dbname"];}
if (isset($_GET["queuemetrics_login"]))				{$queuemetrics_login=$_GET["queuemetrics_login"];}
	elseif (isset($_POST["queuemetrics_login"]))	{$queuemetrics_login=$_POST["queuemetrics_login"];}
if (isset($_GET["queuemetrics_pass"]))			{$queuemetrics_pass=$_GET["queuemetrics_pass"];}
	elseif (isset($_POST["queuemetrics_pass"]))	{$queuemetrics_pass=$_POST["queuemetrics_pass"];}
if (isset($_GET["queuemetrics_url"]))			{$queuemetrics_url=$_GET["queuemetrics_url"];}
	elseif (isset($_POST["queuemetrics_url"]))	{$queuemetrics_url=$_POST["queuemetrics_url"];}
if (isset($_GET["queuemetrics_log_id"]))			{$queuemetrics_log_id=$_GET["queuemetrics_log_id"];}
	elseif (isset($_POST["queuemetrics_log_id"]))	{$queuemetrics_log_id=$_POST["queuemetrics_log_id"];}
if (isset($_GET["dial_status"]))				{$dial_status=$_GET["dial_status"];}
	elseif (isset($_POST["dial_status"]))		{$dial_status=$_POST["dial_status"];}
if (isset($_GET["queuemetrics_eq_prepend"]))			{$queuemetrics_eq_prepend=$_GET["queuemetrics_eq_prepend"];}
	elseif (isset($_POST["queuemetrics_eq_prepend"]))	{$queuemetrics_eq_prepend=$_POST["queuemetrics_eq_prepend"];}
if (isset($_GET["vicidial_agent_disable"]))				{$vicidial_agent_disable=$_GET["vicidial_agent_disable"];}
	elseif (isset($_POST["vicidial_agent_disable"]))	{$vicidial_agent_disable=$_POST["vicidial_agent_disable"];}
if (isset($_GET["disable_alter_custdata"]))				{$disable_alter_custdata=$_GET["disable_alter_custdata"];}
	elseif (isset($_POST["disable_alter_custdata"]))	{$disable_alter_custdata=$_POST["disable_alter_custdata"];}
if (isset($_GET["alter_custdata_override"]))			{$alter_custdata_override=$_GET["alter_custdata_override"];}
	elseif (isset($_POST["alter_custdata_override"]))	{$alter_custdata_override=$_POST["alter_custdata_override"];}
if (isset($_GET["no_hopper_leads_logins"]))				{$no_hopper_leads_logins=$_GET["no_hopper_leads_logins"];}
	elseif (isset($_POST["no_hopper_leads_logins"]))	{$no_hopper_leads_logins=$_POST["no_hopper_leads_logins"];}
if (isset($_GET["enable_sipsak_messages"]))				{$enable_sipsak_messages=$_GET["enable_sipsak_messages"];}
	elseif (isset($_POST["enable_sipsak_messages"]))	{$enable_sipsak_messages=$_POST["enable_sipsak_messages"];}
if (isset($_GET["allow_sipsak_messages"]))				{$allow_sipsak_messages=$_GET["allow_sipsak_messages"];}
	elseif (isset($_POST["allow_sipsak_messages"]))		{$allow_sipsak_messages=$_POST["allow_sipsak_messages"];}
if (isset($_GET["admin_home_url"]))				{$admin_home_url=$_GET["admin_home_url"];}
	elseif (isset($_POST["admin_home_url"]))	{$admin_home_url=$_POST["admin_home_url"];}
if (isset($_GET["list_order_mix"]))				{$list_order_mix=$_GET["list_order_mix"];}
	elseif (isset($_POST["list_order_mix"]))	{$list_order_mix=$_POST["list_order_mix"];}
if (isset($_GET["vcl_id"]))						{$vcl_id=$_GET["vcl_id"];}
	elseif (isset($_POST["vcl_id"]))			{$vcl_id=$_POST["vcl_id"];}
if (isset($_GET["vcl_name"]))					{$vcl_name=$_GET["vcl_name"];}
	elseif (isset($_POST["vcl_name"]))			{$vcl_name=$_POST["vcl_name"];}
if (isset($_GET["list_mix_container"]))				{$list_mix_container=$_GET["list_mix_container"];}
	elseif (isset($_POST["list_mix_container"]))	{$list_mix_container=$_POST["list_mix_container"];}
if (isset($_GET["mix_method"]))					{$mix_method=$_GET["mix_method"];}
	elseif (isset($_POST["mix_method"]))		{$mix_method=$_POST["mix_method"];}
if (isset($_GET["human_answered"]))				{$human_answered=$_GET["human_answered"];}
	elseif (isset($_POST["human_answered"]))	{$human_answered=$_POST["human_answered"];}
if (isset($_GET["category"]))					{$category=$_GET["category"];}
	elseif (isset($_POST["category"]))			{$category=$_POST["category"];}
if (isset($_GET["vsc_id"]))						{$vsc_id=$_GET["vsc_id"];}
	elseif (isset($_POST["vsc_id"]))			{$vsc_id=$_POST["vsc_id"];}
if (isset($_GET["vsc_name"]))					{$vsc_name=$_GET["vsc_name"];}
	elseif (isset($_POST["vsc_name"]))			{$vsc_name=$_POST["vsc_name"];}
if (isset($_GET["vsc_description"]))			{$vsc_description=$_GET["vsc_description"];}
	elseif (isset($_POST["vsc_description"]))	{$vsc_description=$_POST["vsc_description"];}
if (isset($_GET["tovdad_display"]))				{$tovdad_display=$_GET["tovdad_display"];}
	elseif (isset($_POST["tovdad_display"]))	{$tovdad_display=$_POST["tovdad_display"];}
if (isset($_GET["mix_container_item"]))				{$mix_container_item=$_GET["mix_container_item"];}
	elseif (isset($_POST["mix_container_item"]))	{$mix_container_item=$_POST["mix_container_item"];}
if (isset($_GET["enable_agc_xfer_log"]))			{$enable_agc_xfer_log=$_GET["enable_agc_xfer_log"];}
	elseif (isset($_POST["enable_agc_xfer_log"]))	{$enable_agc_xfer_log=$_POST["enable_agc_xfer_log"];}
if (isset($_GET["after_hours_action"]))				{$after_hours_action=$_GET["after_hours_action"];}
	elseif (isset($_POST["after_hours_action"]))	{$after_hours_action=$_POST["after_hours_action"];}
if (isset($_GET["after_hours_message_filename"]))			{$after_hours_message_filename=$_GET["after_hours_message_filename"];}
	elseif (isset($_POST["after_hours_message_filename"]))	{$after_hours_message_filename=$_POST["after_hours_message_filename"];}
if (isset($_GET["after_hours_exten"]))				{$after_hours_exten=$_GET["after_hours_exten"];}
	elseif (isset($_POST["after_hours_exten"]))		{$after_hours_exten=$_POST["after_hours_exten"];}
if (isset($_GET["after_hours_voicemail"]))			{$after_hours_voicemail=$_GET["after_hours_voicemail"];}
	elseif (isset($_POST["after_hours_voicemail"]))	{$after_hours_voicemail=$_POST["after_hours_voicemail"];}
if (isset($_GET["welcome_message_filename"]))			{$welcome_message_filename=$_GET["welcome_message_filename"];}
	elseif (isset($_POST["welcome_message_filename"]))	{$welcome_message_filename=$_POST["welcome_message_filename"];}
if (isset($_GET["moh_context"]))					{$moh_context=$_GET["moh_context"];}
	elseif (isset($_POST["moh_context"]))			{$moh_context=$_POST["moh_context"];}
if (isset($_GET["onhold_prompt_filename"]))				{$onhold_prompt_filename=$_GET["onhold_prompt_filename"];}
	elseif (isset($_POST["onhold_prompt_filename"]))	{$onhold_prompt_filename=$_POST["onhold_prompt_filename"];}
if (isset($_GET["prompt_interval"]))				{$prompt_interval=$_GET["prompt_interval"];}
	elseif (isset($_POST["prompt_interval"]))		{$prompt_interval=$_POST["prompt_interval"];}
if (isset($_GET["agent_alert_exten"]))				{$agent_alert_exten=$_GET["agent_alert_exten"];}
	elseif (isset($_POST["agent_alert_exten"]))		{$agent_alert_exten=$_POST["agent_alert_exten"];}
if (isset($_GET["agent_alert_delay"]))				{$agent_alert_delay=$_GET["agent_alert_delay"];}
	elseif (isset($_POST["agent_alert_delay"]))		{$agent_alert_delay=$_POST["agent_alert_delay"];}
if (isset($_GET["group_rank"]))					{$group_rank=$_GET["group_rank"];}
	elseif (isset($_POST["group_rank"]))		{$group_rank=$_POST["group_rank"];}
if (isset($_GET["campaign_allow_inbound"]))				{$campaign_allow_inbound=$_GET["campaign_allow_inbound"];}
	elseif (isset($_POST["campaign_allow_inbound"]))	{$campaign_allow_inbound=$_POST["campaign_allow_inbound"];}
if (isset($_GET["old_campaign_allow_inbound"]))				{$old_campaign_allow_inbound=$_GET["old_campaign_allow_inbound"];}
	elseif (isset($_POST["old_campaign_allow_inbound"]))	{$old_campaign_allow_inbound=$_POST["old_campaign_allow_inbound"];}
if (isset($_GET["manual_dial_list_id"]))				{$manual_dial_list_id=$_GET["manual_dial_list_id"];}
	elseif (isset($_POST["manual_dial_list_id"]))		{$manual_dial_list_id=$_POST["manual_dial_list_id"];}
if (isset($_GET["campaign_rank"]))				{$campaign_rank=$_GET["campaign_rank"];}
	elseif (isset($_POST["campaign_rank"]))		{$campaign_rank=$_POST["campaign_rank"];}
if (isset($_GET["source_campaign_id"]))				{$source_campaign_id=$_GET["source_campaign_id"];}
	elseif (isset($_POST["source_campaign_id"]))	{$source_campaign_id=$_POST["source_campaign_id"];}
if (isset($_GET["source_user_id"]))				{$source_user_id=$_GET["source_user_id"];}
	elseif (isset($_POST["source_user_id"]))	{$source_user_id=$_POST["source_user_id"];}
if (isset($_GET["source_group_id"]))			{$source_group_id=$_GET["source_group_id"];}
	elseif (isset($_POST["source_group_id"]))	{$source_group_id=$_POST["source_group_id"];}
if (isset($_GET["default_xfer_group"]))				{$default_xfer_group=$_GET["default_xfer_group"];}
	elseif (isset($_POST["default_xfer_group"]))	{$default_xfer_group=$_POST["default_xfer_group"];}
if (isset($_GET["qc_enabled"]))					{$qc_enabled=$_GET["qc_enabled"];}
	elseif (isset($_POST["qc_enabled"]))		{$qc_enabled=$_POST["qc_enabled"];}
if (isset($_GET["qc_user_level"]))				{$qc_user_level=$_GET["qc_user_level"];}
	elseif (isset($_POST["qc_user_level"]))		{$qc_user_level=$_POST["qc_user_level"];}
if (isset($_GET["qc_pass"]))					{$qc_pass=$_GET["qc_pass"];}
	elseif (isset($_POST["qc_pass"]))			{$qc_pass=$_POST["qc_pass"];}
if (isset($_GET["qc_finish"]))					{$qc_finish=$_GET["qc_finish"];}
	elseif (isset($_POST["qc_finish"]))			{$qc_finish=$_POST["qc_finish"];}
if (isset($_GET["qc_commit"]))					{$qc_commit=$_GET["qc_commit"];}
	elseif (isset($_POST["qc_commit"]))			{$qc_commit=$_POST["qc_commit"];}
if (isset($_GET["qc_campaigns"]))				{$qc_campaigns=$_GET["qc_campaigns"];}
	elseif (isset($_POST["qc_campaigns"]))		{$qc_campaigns=$_POST["qc_campaigns"];}
if (isset($_GET["qc_groups"]))					{$qc_groups=$_GET["qc_groups"];}
	elseif (isset($_POST["qc_groups"]))			{$qc_groups=$_POST["qc_groups"];}
if (isset($_GET["qc_display_group_type"]))					{$qc_display_group_type=$_GET["qc_display_group_type"];}
	elseif (isset($_POST["qc_display_group_type"]))			{$qc_display_group_type=$_POST["qc_display_group_type"];}
if (isset($_GET["qc_claim_limit"]))					{$qc_claim_limit=$_GET["qc_claim_limit"];}
	elseif (isset($_POST["qc_claim_limit"]))			{$qc_claim_limit=$_POST["qc_claim_limit"];}
if (isset($_GET["qc_expire_days"]))					{$qc_expire_days=$_GET["qc_expire_days"];}
	elseif (isset($_POST["qc_expire_days"]))			{$qc_expire_days=$_POST["qc_expire_days"];}
if (isset($_GET["queue_priority"]))				{$queue_priority=$_GET["queue_priority"];}
	elseif (isset($_POST["queue_priority"]))	{$queue_priority=$_POST["queue_priority"];}
if (isset($_GET["drop_inbound_group"]))				{$drop_inbound_group=$_GET["drop_inbound_group"];}
	elseif (isset($_POST["drop_inbound_group"]))	{$drop_inbound_group=$_POST["drop_inbound_group"];}
if (isset($_GET["qc_statuses"]))			{$qc_statuses=$_GET["qc_statuses"];}
	elseif (isset($_POST["qc_statuses"]))	{$qc_statuses=$_POST["qc_statuses"];}
if (isset($_GET["qc_lists"]))				{$qc_lists=$_GET["qc_lists"];}
	elseif (isset($_POST["qc_lists"]))		{$qc_lists=$_POST["qc_lists"];}
if (isset($_GET["qc_statuses"]))			{$qc_statuses=$_GET["qc_statuses"];}
	elseif (isset($_POST["qc_statuses"]))	{$qc_statuses=$_POST["qc_statuses"];}
if (isset($_GET["qc_statuses_id"]))				{$qc_statuses_id=$_GET["qc_statuses_id"];}
	elseif (isset($_POST["qc_statuses_id"]))		{$qc_statuses_id=$_POST["qc_statuses_id"];}
if (isset($_GET["qc_get_record_launch"]))			{$qc_get_record_launch=$_GET["qc_get_record_launch"];}
	elseif (isset($_POST["qc_get_record_launch"]))	{$qc_get_record_launch=$_POST["qc_get_record_launch"];}
if (isset($_GET["qc_show_recording"]))				{$qc_show_recording=$_GET["qc_show_recording"];}
	elseif (isset($_POST["qc_show_recording"]))		{$qc_show_recording=$_POST["qc_show_recording"];}
if (isset($_GET["qc_shift_id"]))				{$qc_shift_id=$_GET["qc_shift_id"];}
	elseif (isset($_POST["qc_shift_id"]))		{$qc_shift_id=$_POST["qc_shift_id"];}
if (isset($_GET["qc_web_form_address"]))				{$qc_web_form_address=$_GET["qc_web_form_address"];}
	elseif (isset($_POST["qc_web_form_address"]))	{$qc_web_form_address=$_POST["qc_web_form_address"];}
if (isset($_GET["qc_scorecard_id"]))						{$qc_scorecard_id=$_GET["qc_scorecard_id"];}
	elseif (isset($_POST["qc_scorecard_id"]))				{$qc_scorecard_id=$_POST["qc_scorecard_id"];}
if (isset($_GET["qc_script"]))						{$qc_script=$_GET["qc_script"];}
	elseif (isset($_POST["qc_script"]))				{$qc_script=$_POST["qc_script"];}
if (isset($_GET["ingroup_recording_override"]))		{$ingroup_recording_override=$_GET["ingroup_recording_override"];}	
	elseif (isset($_POST["ingroup_recording_override"]))	{$ingroup_recording_override=$_POST["ingroup_recording_override"];}
if (isset($_GET["code"]))				{$code=$_GET["code"];}	
	elseif (isset($_POST["code"]))		{$code=$_POST["code"];}
if (isset($_GET["code_name"]))			{$code_name=$_GET["code_name"];}	
	elseif (isset($_POST["code_name"]))	{$code_name=$_POST["code_name"];}
if (isset($_GET["afterhours_xfer_group"]))			{$afterhours_xfer_group=$_GET["afterhours_xfer_group"];}	
	elseif (isset($_POST["afterhours_xfer_group"]))	{$afterhours_xfer_group=$_POST["afterhours_xfer_group"];}
if (isset($_GET["alias_id"]))				{$alias_id=$_GET["alias_id"];}	
	elseif (isset($_POST["alias_id"]))		{$alias_id=$_POST["alias_id"];}
if (isset($_GET["alias_name"]))				{$alias_name=$_GET["alias_name"];}	
	elseif (isset($_POST["alias_name"]))		{$alias_name=$_POST["alias_name"];}
if (isset($_GET["logins_list"]))				{$logins_list=$_GET["logins_list"];}	
	elseif (isset($_POST["logins_list"]))		{$logins_list=$_POST["logins_list"];}
if (isset($_GET["shift_id"]))				{$shift_id=$_GET["shift_id"];}	
	elseif (isset($_POST["shift_id"]))		{$shift_id=$_POST["shift_id"];}
if (isset($_GET["shift_name"]))				{$shift_name=$_GET["shift_name"];}	
	elseif (isset($_POST["shift_name"]))		{$shift_name=$_POST["shift_name"];}
if (isset($_GET["shift_start_time"]))			{$shift_start_time=$_GET["shift_start_time"];}	
	elseif (isset($_POST["shift_start_time"]))	{$shift_start_time=$_POST["shift_start_time"];}
if (isset($_GET["shift_length"]))				{$shift_length=$_GET["shift_length"];}	
	elseif (isset($_POST["shift_length"]))		{$shift_length=$_POST["shift_length"];}
if (isset($_GET["shift_weekdays"]))				{$shift_weekdays=$_GET["shift_weekdays"];}	
	elseif (isset($_POST["shift_weekdays"]))	{$shift_weekdays=$_POST["shift_weekdays"];}
if (isset($_GET["group_shifts"]))			{$group_shifts=$_GET["group_shifts"];}	
	elseif (isset($_POST["group_shifts"]))	{$group_shifts=$_POST["group_shifts"];}
if (isset($_GET["timeclock_end_of_day"]))			{$timeclock_end_of_day=$_GET["timeclock_end_of_day"];}	
	elseif (isset($_POST["timeclock_end_of_day"]))	{$timeclock_end_of_day=$_POST["timeclock_end_of_day"];}
if (isset($_GET["survey_first_audio_file"]))			{$survey_first_audio_file=$_GET["survey_first_audio_file"];}	
	elseif (isset($_POST["survey_first_audio_file"]))	{$survey_first_audio_file=$_POST["survey_first_audio_file"];}
if (isset($_GET["survey_dtmf_digits"]))					{$survey_dtmf_digits=$_GET["survey_dtmf_digits"];}	
	elseif (isset($_POST["survey_dtmf_digits"]))		{$survey_dtmf_digits=$_POST["survey_dtmf_digits"];}
if (isset($_GET["survey_ni_digit"]))					{$survey_ni_digit=$_GET["survey_ni_digit"];}	
	elseif (isset($_POST["survey_ni_digit"]))			{$survey_ni_digit=$_POST["survey_ni_digit"];}
if (isset($_GET["survey_opt_in_audio_file"]))			{$survey_opt_in_audio_file=$_GET["survey_opt_in_audio_file"];}	
	elseif (isset($_POST["survey_opt_in_audio_file"]))	{$survey_opt_in_audio_file=$_POST["survey_opt_in_audio_file"];}
if (isset($_GET["survey_ni_audio_file"]))				{$survey_ni_audio_file=$_GET["survey_ni_audio_file"];}	
	elseif (isset($_POST["survey_ni_audio_file"]))		{$survey_ni_audio_file=$_POST["survey_ni_audio_file"];}
if (isset($_GET["survey_method"]))						{$survey_method=$_GET["survey_method"];}	
	elseif (isset($_POST["survey_method"]))				{$survey_method=$_POST["survey_method"];}
if (isset($_GET["survey_no_response_action"]))			{$survey_no_response_action=$_GET["survey_no_response_action"];}	
	elseif (isset($_POST["survey_no_response_action"]))	{$survey_no_response_action=$_POST["survey_no_response_action"];}
if (isset($_GET["survey_ni_status"]))					{$survey_ni_status=$_GET["survey_ni_status"];}	
	elseif (isset($_POST["survey_ni_status"]))			{$survey_ni_status=$_POST["survey_ni_status"];}
if (isset($_GET["survey_response_digit_map"]))			{$survey_response_digit_map=$_GET["survey_response_digit_map"];}	
	elseif (isset($_POST["survey_response_digit_map"]))	{$survey_response_digit_map=$_POST["survey_response_digit_map"];}
if (isset($_GET["survey_xfer_exten"]))					{$survey_xfer_exten=$_GET["survey_xfer_exten"];}	
	elseif (isset($_POST["survey_xfer_exten"]))			{$survey_xfer_exten=$_POST["survey_xfer_exten"];}
if (isset($_GET["survey_camp_record_dir"]))				{$survey_camp_record_dir=$_GET["survey_camp_record_dir"];}	
	elseif (isset($_POST["survey_camp_record_dir"]))	{$survey_camp_record_dir=$_POST["survey_camp_record_dir"];}
if (isset($_GET["add_timeclock_log"]))				{$add_timeclock_log=$_GET["add_timeclock_log"];}	
	elseif (isset($_POST["add_timeclock_log"]))		{$add_timeclock_log=$_POST["add_timeclock_log"];}
if (isset($_GET["modify_timeclock_log"]))			{$modify_timeclock_log=$_GET["modify_timeclock_log"];}	
	elseif (isset($_POST["modify_timeclock_log"]))	{$modify_timeclock_log=$_POST["modify_timeclock_log"];}
if (isset($_GET["delete_timeclock_log"]))			{$delete_timeclock_log=$_GET["delete_timeclock_log"];}	
	elseif (isset($_POST["delete_timeclock_log"]))	{$delete_timeclock_log=$_POST["delete_timeclock_log"];}
if (isset($_GET["phone_numbers"]))					{$phone_numbers=$_GET["phone_numbers"];}	
	elseif (isset($_POST["phone_numbers"]))			{$phone_numbers=$_POST["phone_numbers"];}
if (isset($_GET["vdc_header_date_format"]))					{$vdc_header_date_format=$_GET["vdc_header_date_format"];}	
	elseif (isset($_POST["vdc_header_date_format"]))		{$vdc_header_date_format=$_POST["vdc_header_date_format"];}
if (isset($_GET["vdc_customer_date_format"]))				{$vdc_customer_date_format=$_GET["vdc_customer_date_format"];}	
	elseif (isset($_POST["vdc_customer_date_format"]))		{$vdc_customer_date_format=$_POST["vdc_customer_date_format"];}
if (isset($_GET["vdc_header_phone_format"]))				{$vdc_header_phone_format=$_GET["vdc_header_phone_format"];}	
	elseif (isset($_POST["vdc_header_phone_format"]))		{$vdc_header_phone_format=$_POST["vdc_header_phone_format"];}
if (isset($_GET["disable_alter_custphone"]))			{$disable_alter_custphone=$_GET["disable_alter_custphone"];}	
	elseif (isset($_POST["disable_alter_custphone"]))	{$disable_alter_custphone=$_POST["disable_alter_custphone"];}
if (isset($_GET["alter_custphone_override"]))			{$alter_custphone_override=$_GET["alter_custphone_override"];}	
	elseif (isset($_POST["alter_custphone_override"]))	{$alter_custphone_override=$_POST["alter_custphone_override"];}
if (isset($_GET["vdc_agent_api_access"]))				{$vdc_agent_api_access=$_GET["vdc_agent_api_access"];}	
	elseif (isset($_POST["vdc_agent_api_access"]))		{$vdc_agent_api_access=$_POST["vdc_agent_api_access"];}
if (isset($_GET["vdc_agent_api_active"]))				{$vdc_agent_api_active=$_GET["vdc_agent_api_active"];}	
	elseif (isset($_POST["vdc_agent_api_active"]))		{$vdc_agent_api_active=$_POST["vdc_agent_api_active"];}
if (isset($_GET["display_queue_count"]))				{$display_queue_count=$_GET["display_queue_count"];}	
	elseif (isset($_POST["display_queue_count"]))		{$display_queue_count=$_POST["display_queue_count"];}
if (isset($_GET["sale_category"]))				{$sale_category=$_GET["sale_category"];}	
	elseif (isset($_POST["sale_category"]))		{$sale_category=$_POST["sale_category"];}
if (isset($_GET["dead_lead_category"]))				{$dead_lead_category=$_GET["dead_lead_category"];}	
	elseif (isset($_POST["dead_lead_category"]))	{$dead_lead_category=$_POST["dead_lead_category"];}
if (isset($_GET["manual_dial_filter"]))				{$manual_dial_filter=$_GET["manual_dial_filter"];}	
	elseif (isset($_POST["manual_dial_filter"]))	{$manual_dial_filter=$_POST["manual_dial_filter"];}
if (isset($_GET["agent_clipboard_copy"]))			{$agent_clipboard_copy=$_GET["agent_clipboard_copy"];}	
	elseif (isset($_POST["agent_clipboard_copy"]))	{$agent_clipboard_copy=$_POST["agent_clipboard_copy"];}
if (isset($_GET["agent_extended_alt_dial"]))			{$agent_extended_alt_dial=$_GET["agent_extended_alt_dial"];}	
	elseif (isset($_POST["agent_extended_alt_dial"]))	{$agent_extended_alt_dial=$_POST["agent_extended_alt_dial"];}
if (isset($_GET["play_place_in_line"]))				{$play_place_in_line=$_GET["play_place_in_line"];}	
	elseif (isset($_POST["play_place_in_line"]))	{$play_place_in_line=$_POST["play_place_in_line"];}
if (isset($_GET["play_estimate_hold_time"]))			{$play_estimate_hold_time=$_GET["play_estimate_hold_time"];}	
	elseif (isset($_POST["play_estimate_hold_time"]))	{$play_estimate_hold_time=$_POST["play_estimate_hold_time"];}
if (isset($_GET["hold_time_option"]))				{$hold_time_option=$_GET["hold_time_option"];}	
	elseif (isset($_POST["hold_time_option"]))		{$hold_time_option=$_POST["hold_time_option"];}
if (isset($_GET["hold_time_option_seconds"]))			{$hold_time_option_seconds=$_GET["hold_time_option_seconds"];}	
	elseif (isset($_POST["hold_time_option_seconds"]))	{$hold_time_option_seconds=$_POST["hold_time_option_seconds"];}
if (isset($_GET["hold_time_option_exten"]))				{$hold_time_option_exten=$_GET["hold_time_option_exten"];}	
	elseif (isset($_POST["hold_time_option_exten"]))	{$hold_time_option_exten=$_POST["hold_time_option_exten"];}
if (isset($_GET["hold_time_option_voicemail"]))				{$hold_time_option_voicemail=$_GET["hold_time_option_voicemail"];}	
	elseif (isset($_POST["hold_time_option_voicemail"]))	{$hold_time_option_voicemail=$_POST["hold_time_option_voicemail"];}
if (isset($_GET["hold_time_option_xfer_group"]))			{$hold_time_option_xfer_group=$_GET["hold_time_option_xfer_group"];}	
	elseif (isset($_POST["hold_time_option_xfer_group"]))	{$hold_time_option_xfer_group=$_POST["hold_time_option_xfer_group"];}
if (isset($_GET["hold_time_option_callback_filename"]))				{$hold_time_option_callback_filename=$_GET["hold_time_option_callback_filename"];}	
	elseif (isset($_POST["hold_time_option_callback_filename"]))	{$hold_time_option_callback_filename=$_POST["hold_time_option_callback_filename"];}
if (isset($_GET["hold_time_option_callback_list_id"]))				{$hold_time_option_callback_list_id=$_GET["hold_time_option_callback_list_id"];}	
	elseif (isset($_POST["hold_time_option_callback_list_id"]))		{$hold_time_option_callback_list_id=$_POST["hold_time_option_callback_list_id"];}
if (isset($_GET["hold_recall_xfer_group"]))				{$hold_recall_xfer_group=$_GET["hold_recall_xfer_group"];}	
	elseif (isset($_POST["hold_recall_xfer_group"]))	{$hold_recall_xfer_group=$_POST["hold_recall_xfer_group"];}
if (isset($_GET["no_delay_call_route"]))			{$no_delay_call_route=$_GET["no_delay_call_route"];}	
	elseif (isset($_POST["no_delay_call_route"]))	{$no_delay_call_route=$_POST["no_delay_call_route"];}
if (isset($_GET["play_welcome_message"]))			{$play_welcome_message=$_GET["play_welcome_message"];}	
	elseif (isset($_POST["play_welcome_message"]))	{$play_welcome_message=$_POST["play_welcome_message"];}
if (isset($_GET["did_id"]))					{$did_id=$_GET["did_id"];}	
	elseif (isset($_POST["did_id"]))		{$did_id=$_POST["did_id"];}
if (isset($_GET["source_did"]))				{$source_did=$_GET["source_did"];}	
	elseif (isset($_POST["source_did"]))	{$source_did=$_POST["source_did"];}
if (isset($_GET["did_pattern"]))			{$did_pattern=$_GET["did_pattern"];}	
	elseif (isset($_POST["did_pattern"]))	{$did_pattern=$_POST["did_pattern"];}
if (isset($_GET["did_description"]))			{$did_description=$_GET["did_description"];}	
	elseif (isset($_POST["did_description"]))	{$did_description=$_POST["did_description"];}
if (isset($_GET["did_active"]))				{$did_active=$_GET["did_active"];}	
	elseif (isset($_POST["did_active"]))	{$did_active=$_POST["did_active"];}
if (isset($_GET["did_route"]))				{$did_route=$_GET["did_route"];}	
	elseif (isset($_POST["did_route"]))		{$did_route=$_POST["did_route"];}
if (isset($_GET["exten_context"]))			{$exten_context=$_GET["exten_context"];}	
	elseif (isset($_POST["exten_context"]))	{$exten_context=$_POST["exten_context"];}
if (isset($_GET["phone"]))					{$phone=$_GET["phone"];}	
	elseif (isset($_POST["phone"]))			{$phone=$_POST["phone"];}
if (isset($_GET["user_unavailable_action"]))			{$user_unavailable_action=$_GET["user_unavailable_action"];}	
	elseif (isset($_POST["user_unavailable_action"]))	{$user_unavailable_action=$_POST["user_unavailable_action"];}
if (isset($_GET["user_route_settings_ingroup"]))			{$user_route_settings_ingroup=$_GET["user_route_settings_ingroup"];}	
	elseif (isset($_POST["user_route_settings_ingroup"]))	{$user_route_settings_ingroup=$_POST["user_route_settings_ingroup"];}
if (isset($_GET["call_handle_method"]))				{$call_handle_method=$_GET["call_handle_method"];}	
	elseif (isset($_POST["call_handle_method"]))	{$call_handle_method=$_POST["call_handle_method"];}
if (isset($_GET["agent_search_method"]))			{$agent_search_method=$_GET["agent_search_method"];}	
	elseif (isset($_POST["agent_search_method"]))	{$agent_search_method=$_POST["agent_search_method"];}
if (isset($_GET["phone_code"]))				{$phone_code=$_GET["phone_code"];}	
	elseif (isset($_POST["phone_code"]))	{$phone_code=$_POST["phone_code"];}
if (isset($_GET["email"]))					{$email=$_GET["email"];}	
	elseif (isset($_POST["email"]))			{$email=$_POST["email"];}
if (isset($_GET["modify_inbound_dids"]))			{$modify_inbound_dids=$_GET["modify_inbound_dids"];}	
	elseif (isset($_POST["modify_inbound_dids"]))	{$modify_inbound_dids=$_POST["modify_inbound_dids"];}
if (isset($_GET["delete_inbound_dids"]))			{$delete_inbound_dids=$_GET["delete_inbound_dids"];}	
	elseif (isset($_POST["delete_inbound_dids"]))	{$delete_inbound_dids=$_POST["delete_inbound_dids"];}
if (isset($_GET["three_way_call_cid"]))				{$three_way_call_cid=$_GET["three_way_call_cid"];}	
	elseif (isset($_POST["three_way_call_cid"]))	{$three_way_call_cid=$_POST["three_way_call_cid"];}
if (isset($_GET["three_way_dial_prefix"]))			{$three_way_dial_prefix=$_GET["three_way_dial_prefix"];}
	elseif (isset($_POST["three_way_dial_prefix"]))	{$three_way_dial_prefix=$_POST["three_way_dial_prefix"];}
if (isset($_GET["forced_timeclock_login"]))				{$forced_timeclock_login=$_GET["forced_timeclock_login"];}
	elseif (isset($_POST["forced_timeclock_login"]))	{$forced_timeclock_login=$_POST["forced_timeclock_login"];}
if (isset($_GET["answer_sec_pct_rt_stat_one"]))				{$answer_sec_pct_rt_stat_one=$_GET["answer_sec_pct_rt_stat_one"];}
	elseif (isset($_POST["answer_sec_pct_rt_stat_one"]))	{$answer_sec_pct_rt_stat_one=$_POST["answer_sec_pct_rt_stat_one"];}
if (isset($_GET["answer_sec_pct_rt_stat_two"]))				{$answer_sec_pct_rt_stat_two=$_GET["answer_sec_pct_rt_stat_two"];}
	elseif (isset($_POST["answer_sec_pct_rt_stat_two"]))	{$answer_sec_pct_rt_stat_two=$_POST["answer_sec_pct_rt_stat_two"];}
if (isset($_GET["list_active_change"]))				{$list_active_change=$_GET["list_active_change"];}
	elseif (isset($_POST["list_active_change"]))	{$list_active_change=$_POST["list_active_change"];}
if (isset($_GET["web_form_target"]))			{$web_form_target=$_GET["web_form_target"];}
	elseif (isset($_POST["web_form_target"]))	{$web_form_target=$_POST["web_form_target"];}
if (isset($_GET["alt_server_ip"]))				{$alt_server_ip=$_GET["alt_server_ip"];}
	elseif (isset($_POST["alt_server_ip"]))	{$alt_server_ip=$_POST["alt_server_ip"];}
if (isset($_GET["recording_web_link"]))				{$recording_web_link=$_GET["recording_web_link"];}
	elseif (isset($_POST["recording_web_link"]))	{$recording_web_link=$_POST["recording_web_link"];}
if (isset($_GET["enable_vtiger_integration"]))			{$enable_vtiger_integration=$_GET["enable_vtiger_integration"];}
	elseif (isset($_POST["enable_vtiger_integration"]))	{$enable_vtiger_integration=$_POST["enable_vtiger_integration"];}
if (isset($_GET["vtiger_server_ip"]))			{$vtiger_server_ip=$_GET["vtiger_server_ip"];}
	elseif (isset($_POST["vtiger_server_ip"]))	{$vtiger_server_ip=$_POST["vtiger_server_ip"];}
if (isset($_GET["vtiger_dbname"]))				{$vtiger_dbname=$_GET["vtiger_dbname"];}
	elseif (isset($_POST["vtiger_dbname"]))		{$vtiger_dbname=$_POST["vtiger_dbname"];}
if (isset($_GET["vtiger_login"]))			{$vtiger_login=$_GET["vtiger_login"];}
	elseif (isset($_POST["vtiger_login"]))	{$vtiger_login=$_POST["vtiger_login"];}
if (isset($_GET["vtiger_pass"]))			{$vtiger_pass=$_GET["vtiger_pass"];}
	elseif (isset($_POST["vtiger_pass"]))	{$vtiger_pass=$_POST["vtiger_pass"];}
if (isset($_GET["vtiger_url"]))				{$vtiger_url=$_GET["vtiger_url"];}
	elseif (isset($_POST["vtiger_url"]))	{$vtiger_url=$_POST["vtiger_url"];}
if (isset($_GET["vtiger_search_category"]))				{$vtiger_search_category=$_GET["vtiger_search_category"];}
	elseif (isset($_POST["vtiger_search_category"]))	{$vtiger_search_category=$_POST["vtiger_search_category"];}
if (isset($_GET["vtiger_create_call_record"]))			{$vtiger_create_call_record=$_GET["vtiger_create_call_record"];}
	elseif (isset($_POST["vtiger_create_call_record"]))	{$vtiger_create_call_record=$_POST["vtiger_create_call_record"];}
if (isset($_GET["vtiger_create_lead_record"]))			{$vtiger_create_lead_record=$_GET["vtiger_create_lead_record"];}
	elseif (isset($_POST["vtiger_create_lead_record"]))	{$vtiger_create_lead_record=$_POST["vtiger_create_lead_record"];}
if (isset($_GET["vtiger_screen_login"]))			{$vtiger_screen_login=$_GET["vtiger_screen_login"];}
	elseif (isset($_POST["vtiger_screen_login"]))	{$vtiger_screen_login=$_POST["vtiger_screen_login"];}
if (isset($_GET["qc_features_active"]))				{$qc_features_active=$_GET["qc_features_active"];}
	elseif (isset($_POST["qc_features_active"]))	{$qc_features_active=$_POST["qc_features_active"];}
if (isset($_GET["outbound_autodial_active"]))			{$outbound_autodial_active=$_GET["outbound_autodial_active"];}
	elseif (isset($_POST["outbound_autodial_active"]))	{$outbound_autodial_active=$_POST["outbound_autodial_active"];}
if (isset($_GET["cpd_amd_action"]))				{$cpd_amd_action=$_GET["cpd_amd_action"];}
	elseif (isset($_POST["cpd_amd_action"]))	{$cpd_amd_action=$_POST["cpd_amd_action"];}
if (isset($_GET["download_lists"]))				{$download_lists=$_GET["download_lists"];}
	elseif (isset($_POST["download_lists"]))	{$download_lists=$_POST["download_lists"];}
if (isset($_GET["active_asterisk_server"]))				{$active_asterisk_server=$_GET["active_asterisk_server"];}
	elseif (isset($_POST["active_asterisk_server"]))	{$active_asterisk_server=$_POST["active_asterisk_server"];}
if (isset($_GET["generate_vicidial_conf"]))				{$generate_vicidial_conf=$_GET["generate_vicidial_conf"];}
	elseif (isset($_POST["generate_vicidial_conf"]))	{$generate_vicidial_conf=$_POST["generate_vicidial_conf"];}
if (isset($_GET["rebuild_conf_files"]))				{$rebuild_conf_files=$_GET["rebuild_conf_files"];}
	elseif (isset($_POST["rebuild_conf_files"]))	{$rebuild_conf_files=$_POST["rebuild_conf_files"];}
if (isset($_GET["template_id"]))			{$template_id=$_GET["template_id"];}
	elseif (isset($_POST["template_id"]))	{$template_id=$_POST["template_id"];}
if (isset($_GET["conf_override"]))			{$conf_override=$_GET["conf_override"];}
	elseif (isset($_POST["conf_override"]))	{$conf_override=$_POST["conf_override"];}
if (isset($_GET["template_name"]))			{$template_name=$_GET["template_name"];}
	elseif (isset($_POST["template_name"]))	{$template_name=$_POST["template_name"];}
if (isset($_GET["template_contents"]))			{$template_contents=$_GET["template_contents"];}
	elseif (isset($_POST["template_contents"]))	{$template_contents=$_POST["template_contents"];}
if (isset($_GET["carrier_id"]))			{$carrier_id=$_GET["carrier_id"];}
	elseif (isset($_POST["carrier_id"]))	{$carrier_id=$_POST["carrier_id"];}
if (isset($_GET["carrier_name"]))			{$carrier_name=$_GET["carrier_name"];}
	elseif (isset($_POST["carrier_name"]))	{$carrier_name=$_POST["carrier_name"];}
if (isset($_GET["registration_string"]))			{$registration_string=$_GET["registration_string"];}
	elseif (isset($_POST["registration_string"]))	{$registration_string=$_POST["registration_string"];}
if (isset($_GET["account_entry"]))			{$account_entry=$_GET["account_entry"];}
	elseif (isset($_POST["account_entry"]))	{$account_entry=$_POST["account_entry"];}
if (isset($_GET["globals_string"]))				{$globals_string=$_GET["globals_string"];}
	elseif (isset($_POST["globals_string"]))	{$globals_string=$_POST["globals_string"];}
if (isset($_GET["dialplan_entry"]))				{$dialplan_entry=$_GET["dialplan_entry"];}
	elseif (isset($_POST["dialplan_entry"]))	{$dialplan_entry=$_POST["dialplan_entry"];}
if (isset($_GET["group_alias_id"]))				{$group_alias_id=$_GET["group_alias_id"];}
	elseif (isset($_POST["group_alias_id"]))	{$group_alias_id=$_POST["group_alias_id"];}
if (isset($_GET["group_alias_name"]))				{$group_alias_name=$_GET["group_alias_name"];}
	elseif (isset($_POST["group_alias_name"]))	{$group_alias_name=$_POST["group_alias_name"];}
if (isset($_GET["caller_id_number"]))				{$caller_id_number=$_GET["caller_id_number"];}
	elseif (isset($_POST["caller_id_number"]))	{$caller_id_number=$_POST["caller_id_number"];}
if (isset($_GET["caller_id_name"]))				{$caller_id_name=$_GET["caller_id_name"];}
	elseif (isset($_POST["caller_id_name"]))	{$caller_id_name=$_POST["caller_id_name"];}
if (isset($_GET["agent_allow_group_alias"]))			{$agent_allow_group_alias=$_GET["agent_allow_group_alias"];}
	elseif (isset($_POST["agent_allow_group_alias"]))	{$agent_allow_group_alias=$_POST["agent_allow_group_alias"];}
if (isset($_GET["default_group_alias"]))				{$default_group_alias=$_GET["default_group_alias"];}
	elseif (isset($_POST["default_group_alias"]))		{$default_group_alias=$_POST["default_group_alias"];}
if (isset($_GET["outbound_calls_per_second"]))				{$outbound_calls_per_second=$_GET["outbound_calls_per_second"];}
	elseif (isset($_POST["outbound_calls_per_second"]))		{$outbound_calls_per_second=$_POST["outbound_calls_per_second"];}
if (isset($_GET["shift_enforcement"]))				{$shift_enforcement=$_GET["shift_enforcement"];}
	elseif (isset($_POST["shift_enforcement"]))		{$shift_enforcement=$_POST["shift_enforcement"];}
if (isset($_GET["agent_shift_enforcement_override"]))			{$agent_shift_enforcement_override=$_GET["agent_shift_enforcement_override"];}
	elseif (isset($_POST["agent_shift_enforcement_override"]))	{$agent_shift_enforcement_override=$_POST["agent_shift_enforcement_override"];}
if (isset($_GET["manager_shift_enforcement_override"]))				{$manager_shift_enforcement_override=$_GET["manager_shift_enforcement_override"];}
	elseif (isset($_POST["manager_shift_enforcement_override"]))	{$manager_shift_enforcement_override=$_POST["manager_shift_enforcement_override"];}
if (isset($_GET["export_reports"]))				{$export_reports=$_GET["export_reports"];}
	elseif (isset($_POST["export_reports"]))	{$export_reports=$_POST["export_reports"];}
if (isset($_GET["delete_from_dnc"]))			{$delete_from_dnc=$_GET["delete_from_dnc"];}
	elseif (isset($_POST["delete_from_dnc"]))	{$delete_from_dnc=$_POST["delete_from_dnc"];}
if (isset($_GET["vtiger_search_dead"]))				{$vtiger_search_dead=$_GET["vtiger_search_dead"];}
	elseif (isset($_POST["vtiger_search_dead"]))	{$vtiger_search_dead=$_POST["vtiger_search_dead"];}
if (isset($_GET["vtiger_status_call"]))				{$vtiger_status_call=$_GET["vtiger_status_call"];}
	elseif (isset($_POST["vtiger_status_call"]))	{$vtiger_status_call=$_POST["vtiger_status_call"];}
if (isset($_GET["sale"]))				{$sale=$_GET["sale"];}
	elseif (isset($_POST["sale"]))		{$sale=$_POST["sale"];}
if (isset($_GET["dnc"]))				{$dnc=$_GET["dnc"];}
	elseif (isset($_POST["dnc"]))		{$dnc=$_POST["dnc"];}
if (isset($_GET["customer_contact"]))			{$customer_contact=$_GET["customer_contact"];}
	elseif (isset($_POST["customer_contact"]))	{$customer_contact=$_POST["customer_contact"];}
if (isset($_GET["not_interested"]))				{$not_interested=$_GET["not_interested"];}
	elseif (isset($_POST["not_interested"]))	{$not_interested=$_POST["not_interested"];}
if (isset($_GET["unworkable"]))					{$unworkable=$_GET["unworkable"];}
	elseif (isset($_POST["unworkable"]))		{$unworkable=$_POST["unworkable"];}
if (isset($_GET["user_code"]))					{$user_code=$_GET["user_code"];}
	elseif (isset($_POST["user_code"]))			{$user_code=$_POST["user_code"];}
if (isset($_GET["territory"]))					{$territory=$_GET["territory"];}
	elseif (isset($_POST["territory"]))			{$territory=$_POST["territory"];}
if (isset($_GET["survey_third_digit"]))				{$survey_third_digit=$_GET["survey_third_digit"];}
	elseif (isset($_POST["survey_third_digit"]))	{$survey_third_digit=$_POST["survey_third_digit"];}
if (isset($_GET["survey_fourth_digit"]))			{$survey_fourth_digit=$_GET["survey_fourth_digit"];}
	elseif (isset($_POST["survey_fourth_digit"]))	{$survey_fourth_digit=$_POST["survey_fourth_digit"];}
if (isset($_GET["survey_third_audio_file"]))			{$survey_third_audio_file=$_GET["survey_third_audio_file"];}
	elseif (isset($_POST["survey_third_audio_file"]))	{$survey_third_audio_file=$_POST["survey_third_audio_file"];}
if (isset($_GET["survey_fourth_audio_file"]))			{$survey_fourth_audio_file=$_GET["survey_fourth_audio_file"];}
	elseif (isset($_POST["survey_fourth_audio_file"]))	{$survey_fourth_audio_file=$_POST["survey_fourth_audio_file"];}
if (isset($_GET["survey_third_status"]))				{$survey_third_status=$_GET["survey_third_status"];}
	elseif (isset($_POST["survey_third_status"]))		{$survey_third_status=$_POST["survey_third_status"];}
if (isset($_GET["survey_fourth_status"]))				{$survey_fourth_status=$_GET["survey_fourth_status"];}
	elseif (isset($_POST["survey_fourth_status"]))		{$survey_fourth_status=$_POST["survey_fourth_status"];}
if (isset($_GET["survey_third_exten"]))					{$survey_third_exten=$_GET["survey_third_exten"];}
	elseif (isset($_POST["survey_third_exten"]))		{$survey_third_exten=$_POST["survey_third_exten"];}
if (isset($_GET["survey_fourth_exten"]))				{$survey_fourth_exten=$_GET["survey_fourth_exten"];}
	elseif (isset($_POST["survey_fourth_exten"]))		{$survey_fourth_exten=$_POST["survey_fourth_exten"];}
if (isset($_GET["menu_id"]))				{$menu_id=$_GET["menu_id"];}
	elseif (isset($_POST["menu_id"]))		{$menu_id=$_POST["menu_id"];}
if (isset($_GET["menu_name"]))				{$menu_name=$_GET["menu_name"];}
	elseif (isset($_POST["menu_name"]))		{$menu_name=$_POST["menu_name"];}
if (isset($_GET["menu_prompt"]))			{$menu_prompt=$_GET["menu_prompt"];}
	elseif (isset($_POST["menu_prompt"]))	{$menu_prompt=$_POST["menu_prompt"];}
if (isset($_GET["menu_timeout"]))			{$menu_timeout=$_GET["menu_timeout"];}
	elseif (isset($_POST["menu_timeout"]))	{$menu_timeout=$_POST["menu_timeout"];}
if (isset($_GET["menu_timeout_prompt"]))			{$menu_timeout_prompt=$_GET["menu_timeout_prompt"];}
	elseif (isset($_POST["menu_timeout_prompt"]))	{$menu_timeout_prompt=$_POST["menu_timeout_prompt"];}
if (isset($_GET["menu_invalid_prompt"]))			{$menu_invalid_prompt=$_GET["menu_invalid_prompt"];}
	elseif (isset($_POST["menu_invalid_prompt"]))	{$menu_invalid_prompt=$_POST["menu_invalid_prompt"];}
if (isset($_GET["menu_repeat"]))				{$menu_repeat=$_GET["menu_repeat"];}
	elseif (isset($_POST["menu_repeat"]))		{$menu_repeat=$_POST["menu_repeat"];}
if (isset($_GET["menu_time_check"]))			{$menu_time_check=$_GET["menu_time_check"];}
	elseif (isset($_POST["menu_time_check"]))	{$menu_time_check=$_POST["menu_time_check"];}
if (isset($_GET["track_in_vdac"]))				{$track_in_vdac=$_GET["track_in_vdac"];}
	elseif (isset($_POST["track_in_vdac"]))		{$track_in_vdac=$_POST["track_in_vdac"];}
if (isset($_GET["source_menu"]))			{$source_menu=$_GET["source_menu"];}
	elseif (isset($_POST["source_menu"]))	{$source_menu=$_POST["source_menu"];}
if (isset($_GET["agentonly_callback_campaign_lock"]))			{$agentonly_callback_campaign_lock=$_GET["agentonly_callback_campaign_lock"];}
	elseif (isset($_POST["agentonly_callback_campaign_lock"]))	{$agentonly_callback_campaign_lock=$_POST["agentonly_callback_campaign_lock"];}
if (isset($_GET["sounds_central_control_active"]))			{$sounds_central_control_active=$_GET["sounds_central_control_active"];}
	elseif (isset($_POST["sounds_central_control_active"]))	{$sounds_central_control_active=$_POST["sounds_central_control_active"];}
if (isset($_GET["sounds_web_server"]))				{$sounds_web_server=$_GET["sounds_web_server"];}
	elseif (isset($_POST["sounds_web_server"]))		{$sounds_web_server=$_POST["sounds_web_server"];}
if (isset($_GET["sounds_web_directory"]))			{$sounds_web_directory=$_GET["sounds_web_directory"];}
	elseif (isset($_POST["sounds_web_directory"]))	{$sounds_web_directory=$_POST["sounds_web_directory"];}
if (isset($_GET["sounds_update"]))			{$sounds_update=$_GET["sounds_update"];}
	elseif (isset($_POST["sounds_update"]))	{$sounds_update=$_POST["sounds_update"];}
if (isset($_GET["active_voicemail_server"]))			{$active_voicemail_server=$_GET["active_voicemail_server"];}
	elseif (isset($_POST["active_voicemail_server"]))	{$active_voicemail_server=$_POST["active_voicemail_server"];}
if (isset($_GET["auto_dial_limit"]))			{$auto_dial_limit=$_GET["auto_dial_limit"];}
	elseif (isset($_POST["auto_dial_limit"]))	{$auto_dial_limit=$_POST["auto_dial_limit"];}
if (isset($_GET["user_territories_active"]))			{$user_territories_active=$_GET["user_territories_active"];}
	elseif (isset($_POST["user_territories_active"]))	{$user_territories_active=$_POST["user_territories_active"];}
if (isset($_GET["list_status_modification_confirmation"]))	{$list_status_modification_confirmation=$_GET["list_status_modification_confirmation"];}
	elseif (isset($_POST["list_status_modification_confirmation"]))	{$list_status_modification_confirmation=$_POST["list_status_modification_confirmation"];}
if (isset($_GET["vicidial_recording_limit"]))			{$vicidial_recording_limit=$_GET["vicidial_recording_limit"];}
	elseif (isset($_POST["vicidial_recording_limit"]))	{$vicidial_recording_limit=$_POST["vicidial_recording_limit"];}
if (isset($_GET["phone_context"]))				{$phone_context=$_GET["phone_context"];}
	elseif (isset($_POST["phone_context"]))		{$phone_context=$_POST["phone_context"];}
if (isset($_GET["carrier_logging_active"]))				{$carrier_logging_active=$_GET["carrier_logging_active"];}
	elseif (isset($_POST["carrier_logging_active"]))	{$carrier_logging_active=$_POST["carrier_logging_active"];}
if (isset($_GET["drop_lockout_time"]))				{$drop_lockout_time=$_GET["drop_lockout_time"];}
	elseif (isset($_POST["drop_lockout_time"]))		{$drop_lockout_time=$_POST["drop_lockout_time"];}
if (isset($_GET["allow_custom_dialplan"]))				{$allow_custom_dialplan=$_GET["allow_custom_dialplan"];}
	elseif (isset($_POST["allow_custom_dialplan"]))		{$allow_custom_dialplan=$_POST["allow_custom_dialplan"];}
if (isset($_GET["custom_dialplan_entry"]))				{$custom_dialplan_entry=$_GET["custom_dialplan_entry"];}
	elseif (isset($_POST["custom_dialplan_entry"]))		{$custom_dialplan_entry=$_POST["custom_dialplan_entry"];}
if (isset($_GET["phone_ring_timeout"]))					{$phone_ring_timeout=$_GET["phone_ring_timeout"];}
	elseif (isset($_POST["phone_ring_timeout"]))		{$phone_ring_timeout=$_POST["phone_ring_timeout"];}
if (isset($_GET["conf_secret"]))					{$conf_secret=$_GET["conf_secret"];}
	elseif (isset($_POST["conf_secret"]))			{$conf_secret=$_POST["conf_secret"];}
if (isset($_GET["tracking_group"]))					{$tracking_group=$_GET["tracking_group"];}
	elseif (isset($_POST["tracking_group"]))		{$tracking_group=$_POST["tracking_group"];}
if (isset($_GET["no_agent_no_queue"]))				{$no_agent_no_queue=$_GET["no_agent_no_queue"];}
	elseif (isset($_POST["no_agent_no_queue"]))		{$no_agent_no_queue=$_POST["no_agent_no_queue"];}
if (isset($_GET["no_agent_action"]))				{$no_agent_action=$_GET["no_agent_action"];}
	elseif (isset($_POST["no_agent_action"]))		{$no_agent_action=$_POST["no_agent_action"];}
if (isset($_GET["no_agent_action_value"]))			{$no_agent_action_value=$_GET["no_agent_action_value"];}
	elseif (isset($_POST["no_agent_action_value"]))	{$no_agent_action_value=$_POST["no_agent_action_value"];}
if (isset($_GET["quick_transfer_button"]))			{$quick_transfer_button=$_GET["quick_transfer_button"];}
	elseif (isset($_POST["quick_transfer_button"]))	{$quick_transfer_button=$_POST["quick_transfer_button"];}
if (isset($_GET["prepopulate_transfer_preset"]))			{$prepopulate_transfer_preset=$_GET["prepopulate_transfer_preset"];}
	elseif (isset($_POST["prepopulate_transfer_preset"]))	{$prepopulate_transfer_preset=$_POST["prepopulate_transfer_preset"];}
if (isset($_GET["enable_tts_integration"]))				{$enable_tts_integration=$_GET["enable_tts_integration"];}
	elseif (isset($_POST["enable_tts_integration"]))	{$enable_tts_integration=$_POST["enable_tts_integration"];}
if (isset($_GET["tts_id"]))							{$tts_id=$_GET["tts_id"];}
	elseif (isset($_POST["tts_id"]))				{$tts_id=$_POST["tts_id"];}
if (isset($_GET["tts_name"]))						{$tts_name=$_GET["tts_name"];}
	elseif (isset($_POST["tts_name"]))				{$tts_name=$_POST["tts_name"];}
if (isset($_GET["tts_text"]))						{$tts_text=$_GET["tts_text"];}
	elseif (isset($_POST["tts_text"]))				{$tts_text=$_POST["tts_text"];}
if (isset($_GET["drop_rate_group"]))				{$drop_rate_group=$_GET["drop_rate_group"];}
	elseif (isset($_POST["drop_rate_group"]))		{$drop_rate_group=$_POST["drop_rate_group"];}
if (isset($_GET["agent_status_viewable_groups"]))			{$agent_status_viewable_groups=$_GET["agent_status_viewable_groups"];}
	elseif (isset($_POST["agent_status_viewable_groups"]))	{$agent_status_viewable_groups=$_POST["agent_status_viewable_groups"];}
if (isset($_GET["agent_status_view_time"]))				{$agent_status_view_time=$_GET["agent_status_view_time"];}
	elseif (isset($_POST["agent_status_view_time"]))	{$agent_status_view_time=$_POST["agent_status_view_time"];}
if (isset($_GET["view_calls_in_queue"]))			{$view_calls_in_queue=$_GET["view_calls_in_queue"];}
	elseif (isset($_POST["view_calls_in_queue"]))	{$view_calls_in_queue=$_POST["view_calls_in_queue"];}
if (isset($_GET["view_calls_in_queue_launch"]))				{$view_calls_in_queue_launch=$_GET["view_calls_in_queue_launch"];}
	elseif (isset($_POST["view_calls_in_queue_launch"]))	{$view_calls_in_queue_launch=$_POST["view_calls_in_queue_launch"];}
if (isset($_GET["grab_calls_in_queue"]))			{$grab_calls_in_queue=$_GET["grab_calls_in_queue"];}
	elseif (isset($_POST["grab_calls_in_queue"]))	{$grab_calls_in_queue=$_POST["grab_calls_in_queue"];}
if (isset($_GET["call_requeue_button"]))			{$call_requeue_button=$_GET["call_requeue_button"];}
	elseif (isset($_POST["call_requeue_button"]))	{$call_requeue_button=$_POST["call_requeue_button"];}
if (isset($_GET["pause_after_each_call"]))			{$pause_after_each_call=$_GET["pause_after_each_call"];}
	elseif (isset($_POST["pause_after_each_call"]))	{$pause_after_each_call=$_POST["pause_after_each_call"];}
if (isset($_GET["no_hopper_dialing"]))				{$no_hopper_dialing=$_GET["no_hopper_dialing"];}
	elseif (isset($_POST["no_hopper_dialing"]))		{$no_hopper_dialing=$_POST["no_hopper_dialing"];}
if (isset($_GET["agent_dial_owner_only"]))			{$agent_dial_owner_only=$_GET["agent_dial_owner_only"];}
	elseif (isset($_POST["agent_dial_owner_only"]))	{$agent_dial_owner_only=$_POST["agent_dial_owner_only"];}
if (isset($_GET["reset_time"]))						{$reset_time=$_GET["reset_time"];}
	elseif (isset($_POST["reset_time"]))			{$reset_time=$_POST["reset_time"];}
if (isset($_GET["allow_alerts"]))					{$allow_alerts=$_GET["allow_alerts"];}
	elseif (isset($_POST["allow_alerts"]))			{$allow_alerts=$_POST["allow_alerts"];}
if (isset($_GET["agent_display_dialable_leads"]))			{$agent_display_dialable_leads=$_GET["agent_display_dialable_leads"];}
	elseif (isset($_POST["agent_display_dialable_leads"]))	{$agent_display_dialable_leads=$_POST["agent_display_dialable_leads"];}
if (isset($_GET["vicidial_balance_rank"]))			{$vicidial_balance_rank=$_GET["vicidial_balance_rank"];}
	elseif (isset($_POST["vicidial_balance_rank"]))	{$vicidial_balance_rank=$_POST["vicidial_balance_rank"];}
if (isset($_GET["agent_script_override"]))			{$agent_script_override=$_GET["agent_script_override"];}
	elseif (isset($_POST["agent_script_override"]))	{$agent_script_override=$_POST["agent_script_override"];}
if (isset($_GET["inbound_list_script_override"]))			{$inbound_list_script_override=$_GET["inbound_list_script_override"];}
	elseif (isset($_POST["inbound_list_script_override"]))	{$inbound_list_script_override=$_POST["inbound_list_script_override"];}
if (isset($_GET["moh_id"]))				{$moh_id=$_GET["moh_id"];}
	elseif (isset($_POST["moh_id"]))	{$moh_id=$_POST["moh_id"];}
if (isset($_GET["moh_name"]))			{$moh_name=$_GET["moh_name"];}
	elseif (isset($_POST["moh_name"]))	{$moh_name=$_POST["moh_name"];}
if (isset($_GET["random"]))				{$random=$_GET["random"];}
	elseif (isset($_POST["random"]))	{$random=$_POST["random"];}
if (isset($_GET["filename"]))			{$filename=$_GET["filename"];}
	elseif (isset($_POST["filename"]))	{$filename=$_POST["filename"];}
if (isset($_GET["rank"]))				{$rank=$_GET["rank"];}
	elseif (isset($_POST["rank"]))		{$rank=$_POST["rank"];}
if (isset($_GET["rebuild_music_on_hold"]))				{$rebuild_music_on_hold=$_GET["rebuild_music_on_hold"];}
	elseif (isset($_POST["rebuild_music_on_hold"]))		{$rebuild_music_on_hold=$_POST["rebuild_music_on_hold"];}
if (isset($_GET["active_agent_login_server"]))			{$active_agent_login_server=$_GET["active_agent_login_server"];}
	elseif (isset($_POST["active_agent_login_server"]))	{$active_agent_login_server=$_POST["active_agent_login_server"];}
if (isset($_GET["enable_second_webform"]))			{$enable_second_webform=$_GET["enable_second_webform"];}
	elseif (isset($_POST["enable_second_webform"]))	{$enable_second_webform=$_POST["enable_second_webform"];}
if (isset($_GET["web_form_address_two"]))			{$web_form_address_two=$_GET["web_form_address_two"];}
	elseif (isset($_POST["web_form_address_two"]))	{$web_form_address_two=$_POST["web_form_address_two"];}
if (isset($_GET["waitforsilence_options"]))			{$waitforsilence_options=$_GET["waitforsilence_options"];}
	elseif (isset($_POST["waitforsilence_options"]))	{$waitforsilence_options=$_POST["waitforsilence_options"];}
if (isset($_GET["campaign_cid_override"]))			{$campaign_cid_override=$_GET["campaign_cid_override"];}
	elseif (isset($_POST["campaign_cid_override"]))	{$campaign_cid_override=$_POST["campaign_cid_override"];}
if (isset($_GET["am_message_exten_override"]))			{$am_message_exten_override=$_GET["am_message_exten_override"];}
	elseif (isset($_POST["am_message_exten_override"]))	{$am_message_exten_override=$_POST["am_message_exten_override"];}
if (isset($_GET["drop_inbound_group_override"]))			{$drop_inbound_group_override=$_GET["drop_inbound_group_override"];}
	elseif (isset($_POST["drop_inbound_group_override"]))	{$drop_inbound_group_override=$_POST["drop_inbound_group_override"];}
if (isset($_GET["agent_select_territories"]))			{$agent_select_territories=$_GET["agent_select_territories"];}
	elseif (isset($_POST["agent_select_territories"]))	{$agent_select_territories=$_POST["agent_select_territories"];}
if (isset($_GET["agent_choose_territories"]))			{$agent_choose_territories=$_GET["agent_choose_territories"];}
	elseif (isset($_POST["agent_choose_territories"]))	{$agent_choose_territories=$_POST["agent_choose_territories"];}
if (isset($_GET["carrier_description"]))			{$carrier_description=$_GET["carrier_description"];}
	elseif (isset($_POST["carrier_description"]))	{$carrier_description=$_POST["carrier_description"];}
if (isset($_GET["delete_vm_after_email"]))			{$delete_vm_after_email=$_GET["delete_vm_after_email"];}
	elseif (isset($_POST["delete_vm_after_email"]))	{$delete_vm_after_email=$_POST["delete_vm_after_email"];}
if (isset($_GET["custom_one"]))					{$custom_one=$_GET["custom_one"];}
	elseif (isset($_POST["custom_one"]))		{$custom_one=$_POST["custom_one"];}
if (isset($_GET["custom_two"]))					{$custom_two=$_GET["custom_two"];}
	elseif (isset($_POST["custom_two"]))		{$custom_two=$_POST["custom_two"];}
if (isset($_GET["custom_three"]))				{$custom_three=$_GET["custom_three"];}
	elseif (isset($_POST["custom_three"]))		{$custom_three=$_POST["custom_three"];}
if (isset($_GET["custom_four"]))				{$custom_four=$_GET["custom_four"];}
	elseif (isset($_POST["custom_four"]))		{$custom_four=$_POST["custom_four"];}
if (isset($_GET["custom_five"]))				{$custom_five=$_GET["custom_five"];}
	elseif (isset($_POST["custom_five"]))		{$custom_five=$_POST["custom_five"];}
if (isset($_GET["crm_popup_login"]))			{$crm_popup_login=$_GET["crm_popup_login"];}
	elseif (isset($_POST["crm_popup_login"]))	{$crm_popup_login=$_POST["crm_popup_login"];}
if (isset($_GET["crm_login_address"]))			{$crm_login_address=$_GET["crm_login_address"];}
	elseif (isset($_POST["crm_login_address"]))	{$crm_login_address=$_POST["crm_login_address"];}
if (isset($_GET["timer_action"]))					{$timer_action=$_GET["timer_action"];}
	elseif (isset($_POST["timer_action"]))			{$timer_action=$_POST["timer_action"];}
if (isset($_GET["timer_action_message"]))			{$timer_action_message=$_GET["timer_action_message"];}
	elseif (isset($_POST["timer_action_message"]))	{$timer_action_message=$_POST["timer_action_message"];}
if (isset($_GET["timer_action_seconds"]))			{$timer_action_seconds=$_GET["timer_action_seconds"];}
	elseif (isset($_POST["timer_action_seconds"]))	{$timer_action_seconds=$_POST["timer_action_seconds"];}
if (isset($_GET["start_call_url"]))				{$start_call_url=$_GET["start_call_url"];}
	elseif (isset($_POST["start_call_url"]))	{$start_call_url=$_POST["start_call_url"];}
if (isset($_GET["dispo_call_url"]))				{$dispo_call_url=$_GET["dispo_call_url"];}
	elseif (isset($_POST["dispo_call_url"]))	{$dispo_call_url=$_POST["dispo_call_url"];}
if (isset($_GET["xferconf_c_number"]))			{$xferconf_c_number=$_GET["xferconf_c_number"];}
	elseif (isset($_POST["xferconf_c_number"]))	{$xferconf_c_number=$_POST["xferconf_c_number"];}
if (isset($_GET["xferconf_d_number"]))			{$xferconf_d_number=$_GET["xferconf_d_number"];}
	elseif (isset($_POST["xferconf_d_number"]))	{$xferconf_d_number=$_POST["xferconf_d_number"];}
if (isset($_GET["xferconf_e_number"]))			{$xferconf_e_number=$_GET["xferconf_e_number"];}
	elseif (isset($_POST["xferconf_e_number"]))	{$xferconf_e_number=$_POST["xferconf_e_number"];}
if (isset($_GET["record_call"]))				{$record_call=$_GET["record_call"];}
	elseif (isset($_POST["record_call"]))		{$record_call=$_POST["record_call"];}
if (isset($_GET["ignore_list_script_override"]))			{$ignore_list_script_override=$_GET["ignore_list_script_override"];}
	elseif (isset($_POST["ignore_list_script_override"]))	{$ignore_list_script_override=$_POST["ignore_list_script_override"];}
if (isset($_GET["external_server_ip"]))			{$external_server_ip=$_GET["external_server_ip"];}
	elseif (isset($_POST["external_server_ip"])){$external_server_ip=$_POST["external_server_ip"];}
if (isset($_GET["is_webphone"]))				{$is_webphone=$_GET["is_webphone"];}
	elseif (isset($_POST["is_webphone"]))		{$is_webphone=$_POST["is_webphone"];}
if (isset($_GET["use_external_server_ip"]))			{$use_external_server_ip=$_GET["use_external_server_ip"];}
	elseif (isset($_POST["use_external_server_ip"])){$use_external_server_ip=$_POST["use_external_server_ip"];}
if (isset($_GET["default_webphone"]))			{$default_webphone=$_GET["default_webphone"];}
	elseif (isset($_POST["default_webphone"]))	{$default_webphone=$_POST["default_webphone"];}
if (isset($_GET["default_external_server_ip"]))			{$default_external_server_ip=$_GET["default_external_server_ip"];}
	elseif (isset($_POST["default_external_server_ip"])){$default_external_server_ip=$_POST["default_external_server_ip"];}
if (isset($_GET["webphone_url"]))				{$webphone_url=$_GET["webphone_url"];}
	elseif (isset($_POST["webphone_url"]))		{$webphone_url=$_POST["webphone_url"];}
if (isset($_GET["enable_agc_dispo_log"]))			{$enable_agc_dispo_log=$_GET["enable_agc_dispo_log"];}
	elseif (isset($_POST["enable_agc_dispo_log"]))	{$enable_agc_dispo_log=$_POST["enable_agc_dispo_log"];}
if (isset($_GET["agent_call_log_view"]))			{$agent_call_log_view=$_GET["agent_call_log_view"];}
	elseif (isset($_POST["agent_call_log_view"]))	{$agent_call_log_view=$_POST["agent_call_log_view"];}
if (isset($_GET["agent_call_log_view_override"]))			{$agent_call_log_view_override=$_GET["agent_call_log_view_override"];}
	elseif (isset($_POST["agent_call_log_view_override"]))	{$agent_call_log_view_override=$_POST["agent_call_log_view_override"];}
if (isset($_GET["use_custom_cid"]))				{$use_custom_cid=$_GET["use_custom_cid"];}
	elseif (isset($_POST["use_custom_cid"]))	{$use_custom_cid=$_POST["use_custom_cid"];}
if (isset($_GET["scheduled_callbacks_alert"]))			{$scheduled_callbacks_alert=$_GET["scheduled_callbacks_alert"];}
	elseif (isset($_POST["scheduled_callbacks_alert"]))	{$scheduled_callbacks_alert=$_POST["scheduled_callbacks_alert"];}
if (isset($_GET["scheduled_callbacks_email_alert"]))			{$scheduled_callbacks_email_alert=$_GET["scheduled_callbacks_email_alert"];}
	elseif (isset($_POST["scheduled_callbacks_email_alert"]))	{$scheduled_callbacks_email_alert=$_POST["scheduled_callbacks_email_alert"];}
if (isset($_GET["queuemetrics_loginout"]))			{$queuemetrics_loginout=$_GET["queuemetrics_loginout"];}
	elseif (isset($_POST["queuemetrics_loginout"]))	{$queuemetrics_loginout=$_POST["queuemetrics_loginout"];}
if (isset($_GET["callcard_enabled"]))				{$callcard_enabled=$_GET["callcard_enabled"];}
	elseif (isset($_POST["callcard_enabled"]))		{$callcard_enabled=$_POST["callcard_enabled"];}
if (isset($_GET["callcard_admin"]))					{$callcard_admin=$_GET["callcard_admin"];}
	elseif (isset($_POST["callcard_admin"]))		{$callcard_admin=$_POST["callcard_admin"];}
if (isset($_GET["agent_xfer_consultative"]))				{$agent_xfer_consultative=$_GET["agent_xfer_consultative"];}
	elseif (isset($_POST["agent_xfer_consultative"]))		{$agent_xfer_consultative=$_POST["agent_xfer_consultative"];}
if (isset($_GET["agent_xfer_dial_override"]))				{$agent_xfer_dial_override=$_GET["agent_xfer_dial_override"];}
	elseif (isset($_POST["agent_xfer_dial_override"]))		{$agent_xfer_dial_override=$_POST["agent_xfer_dial_override"];}
if (isset($_GET["agent_xfer_vm_transfer"]))					{$agent_xfer_vm_transfer=$_GET["agent_xfer_vm_transfer"];}
	elseif (isset($_POST["agent_xfer_vm_transfer"]))		{$agent_xfer_vm_transfer=$_POST["agent_xfer_vm_transfer"];}
if (isset($_GET["agent_xfer_blind_transfer"]))				{$agent_xfer_blind_transfer=$_GET["agent_xfer_blind_transfer"];}
	elseif (isset($_POST["agent_xfer_blind_transfer"]))		{$agent_xfer_blind_transfer=$_POST["agent_xfer_blind_transfer"];}
if (isset($_GET["agent_xfer_dial_with_customer"]))			{$agent_xfer_dial_with_customer=$_GET["agent_xfer_dial_with_customer"];}
	elseif (isset($_POST["agent_xfer_dial_with_customer"]))	{$agent_xfer_dial_with_customer=$_POST["agent_xfer_dial_with_customer"];}
if (isset($_GET["agent_xfer_park_customer_dial"]))			{$agent_xfer_park_customer_dial=$_GET["agent_xfer_park_customer_dial"];}
	elseif (isset($_POST["agent_xfer_park_customer_dial"]))	{$agent_xfer_park_customer_dial=$_POST["agent_xfer_park_customer_dial"];}
if (isset($_GET["agent_fullscreen"]))			{$agent_fullscreen=$_GET["agent_fullscreen"];}
	elseif (isset($_POST["agent_fullscreen"]))	{$agent_fullscreen=$_POST["agent_fullscreen"];}
if (isset($_GET["extension_id"]))				{$extension_id=$_GET["extension_id"];}
	elseif (isset($_POST["extension_id"]))		{$extension_id=$_POST["extension_id"];}
if (isset($_GET["extension_group_id"]))				{$extension_group_id=$_GET["extension_group_id"];}
	elseif (isset($_POST["extension_group_id"]))	{$extension_group_id=$_POST["extension_group_id"];}
if (isset($_GET["campaign_groups"]))			{$campaign_groups=$_GET["campaign_groups"];}
	elseif (isset($_POST["campaign_groups"]))	{$campaign_groups=$_POST["campaign_groups"];}
if (isset($_GET["extension_group"]))			{$extension_group=$_GET["extension_group"];}
	elseif (isset($_POST["extension_group"]))	{$extension_group=$_POST["extension_group"];}
if (isset($_GET["agent_choose_blended"]))			{$agent_choose_blended=$_GET["agent_choose_blended"];}
	elseif (isset($_POST["agent_choose_blended"]))	{$agent_choose_blended=$_POST["agent_choose_blended"];}
if (isset($_GET["queuemetrics_callstatus"]))			{$queuemetrics_callstatus=$_GET["queuemetrics_callstatus"];}
	elseif (isset($_POST["queuemetrics_callstatus"]))	{$queuemetrics_callstatus=$_POST["queuemetrics_callstatus"];}
if (isset($_GET["extension_appended_cidname"]))				{$extension_appended_cidname=$_GET["extension_appended_cidname"];}
	elseif (isset($_POST["extension_appended_cidname"]))	{$extension_appended_cidname=$_POST["extension_appended_cidname"];}
if (isset($_GET["scheduled_callbacks_count"]))			{$scheduled_callbacks_count=$_GET["scheduled_callbacks_count"];}
	elseif (isset($_POST["scheduled_callbacks_count"]))	{$scheduled_callbacks_count=$_POST["scheduled_callbacks_count"];}
if (isset($_GET["realtime_block_user_info"]))			{$realtime_block_user_info=$_GET["realtime_block_user_info"];}
	elseif (isset($_POST["realtime_block_user_info"]))	{$realtime_block_user_info=$_POST["realtime_block_user_info"];}
if (isset($_GET["manual_dial_override"]))			{$manual_dial_override=$_GET["manual_dial_override"];}
	elseif (isset($_POST["manual_dial_override"]))	{$manual_dial_override=$_POST["manual_dial_override"];}
if (isset($_GET["blind_monitor_warning"]))			{$blind_monitor_warning=$_GET["blind_monitor_warning"];}
	elseif (isset($_POST["blind_monitor_warning"]))	{$blind_monitor_warning=$_POST["blind_monitor_warning"];}
if (isset($_GET["blind_monitor_message"]))			{$blind_monitor_message=$_GET["blind_monitor_message"];}
	elseif (isset($_POST["blind_monitor_message"]))	{$blind_monitor_message=$_POST["blind_monitor_message"];}
if (isset($_GET["blind_monitor_filename"]))				{$blind_monitor_filename=$_GET["blind_monitor_filename"];}
	elseif (isset($_POST["blind_monitor_filename"]))	{$blind_monitor_filename=$_POST["blind_monitor_filename"];}
if (isset($_GET["uniqueid_status_display"]))			{$uniqueid_status_display=$_GET["uniqueid_status_display"];}
	elseif (isset($_POST["uniqueid_status_display"]))	{$uniqueid_status_display=$_POST["uniqueid_status_display"];}
if (isset($_GET["uniqueid_status_prefix"]))				{$uniqueid_status_prefix=$_GET["uniqueid_status_prefix"];}
	elseif (isset($_POST["uniqueid_status_prefix"]))	{$uniqueid_status_prefix=$_POST["uniqueid_status_prefix"];}
if (isset($_GET["default_codecs"]))				{$default_codecs=$_GET["default_codecs"];}
	elseif (isset($_POST["default_codecs"]))	{$default_codecs=$_POST["default_codecs"];}
if (isset($_GET["codecs_list"]))			{$codecs_list=$_GET["codecs_list"];}
	elseif (isset($_POST["codecs_list"]))	{$codecs_list=$_POST["codecs_list"];}
if (isset($_GET["codecs_with_template"]))			{$codecs_with_template=$_GET["codecs_with_template"];}
	elseif (isset($_POST["codecs_with_template"]))	{$codecs_with_template=$_POST["codecs_with_template"];}
if (isset($_GET["custom_fields_modify"]))			{$custom_fields_modify=$_GET["custom_fields_modify"];}
	elseif (isset($_POST["custom_fields_modify"]))	{$custom_fields_modify=$_POST["custom_fields_modify"];}
if (isset($_GET["hold_time_option_minimum"]))			{$hold_time_option_minimum=$_GET["hold_time_option_minimum"];}
	elseif (isset($_POST["hold_time_option_minimum"]))	{$hold_time_option_minimum=$_POST["hold_time_option_minimum"];}
if (isset($_GET["source_carrier"]))				{$source_carrier=$_GET["source_carrier"];}
	elseif (isset($_POST["source_carrier"]))	{$source_carrier=$_POST["source_carrier"];}
if (isset($_GET["hold_time_option_press_filename"]))			{$hold_time_option_press_filename=$_GET["hold_time_option_press_filename"];}
	elseif (isset($_POST["hold_time_option_press_filename"]))	{$hold_time_option_press_filename=$_POST["hold_time_option_press_filename"];}
if (isset($_GET["hold_time_option_callmenu"]))			{$hold_time_option_callmenu=$_GET["hold_time_option_callmenu"];}
	elseif (isset($_POST["hold_time_option_callmenu"]))	{$hold_time_option_callmenu=$_POST["hold_time_option_callmenu"];}
if (isset($_GET["inbound_queue_no_dial"]))			{$inbound_queue_no_dial=$_GET["inbound_queue_no_dial"];}
	elseif (isset($_POST["inbound_queue_no_dial"]))	{$inbound_queue_no_dial=$_POST["inbound_queue_no_dial"];}
if (isset($_GET["default_afterhours_filename_override"]))			{$default_afterhours_filename_override=$_GET["default_afterhours_filename_override"];}
	elseif (isset($_POST["default_afterhours_filename_override"]))	{$default_afterhours_filename_override=$_POST["default_afterhours_filename_override"];}
if (isset($_GET["sunday_afterhours_filename_override"]))			{$sunday_afterhours_filename_override=$_GET["sunday_afterhours_filename_override"];}
	elseif (isset($_POST["sunday_afterhours_filename_override"]))	{$sunday_afterhours_filename_override=$_POST["sunday_afterhours_filename_override"];}
if (isset($_GET["monday_afterhours_filename_override"]))			{$monday_afterhours_filename_override=$_GET["monday_afterhours_filename_override"];}
	elseif (isset($_POST["monday_afterhours_filename_override"]))	{$monday_afterhours_filename_override=$_POST["monday_afterhours_filename_override"];}
if (isset($_GET["tuesday_afterhours_filename_override"]))			{$tuesday_afterhours_filename_override=$_GET["tuesday_afterhours_filename_override"];}
	elseif (isset($_POST["tuesday_afterhours_filename_override"]))	{$tuesday_afterhours_filename_override=$_POST["tuesday_afterhours_filename_override"];}
if (isset($_GET["wednesday_afterhours_filename_override"]))			{$wednesday_afterhours_filename_override=$_GET["wednesday_afterhours_filename_override"];}
	elseif (isset($_POST["wednesday_afterhours_filename_override"]))	{$wednesday_afterhours_filename_override=$_POST["wednesday_afterhours_filename_override"];}
if (isset($_GET["thursday_afterhours_filename_override"]))			{$thursday_afterhours_filename_override=$_GET["thursday_afterhours_filename_override"];}
	elseif (isset($_POST["thursday_afterhours_filename_override"]))	{$thursday_afterhours_filename_override=$_POST["thursday_afterhours_filename_override"];}
if (isset($_GET["friday_afterhours_filename_override"]))			{$friday_afterhours_filename_override=$_GET["friday_afterhours_filename_override"];}
	elseif (isset($_POST["friday_afterhours_filename_override"]))	{$friday_afterhours_filename_override=$_POST["friday_afterhours_filename_override"];}
if (isset($_GET["saturday_afterhours_filename_override"]))			{$saturday_afterhours_filename_override=$_GET["saturday_afterhours_filename_override"];}
	elseif (isset($_POST["saturday_afterhours_filename_override"]))	{$saturday_afterhours_filename_override=$_POST["saturday_afterhours_filename_override"];}
if (isset($_GET["onhold_prompt_no_block"]))				{$onhold_prompt_no_block=$_GET["onhold_prompt_no_block"];}
	elseif (isset($_POST["onhold_prompt_no_block"]))	{$onhold_prompt_no_block=$_POST["onhold_prompt_no_block"];}
if (isset($_GET["onhold_prompt_seconds"]))			{$onhold_prompt_seconds=$_GET["onhold_prompt_seconds"];}
	elseif (isset($_POST["onhold_prompt_seconds"]))	{$onhold_prompt_seconds=$_POST["onhold_prompt_seconds"];}
if (isset($_GET["hold_time_option_no_block"]))			{$hold_time_option_no_block=$_GET["hold_time_option_no_block"];}
	elseif (isset($_POST["hold_time_option_no_block"]))	{$hold_time_option_no_block=$_POST["hold_time_option_no_block"];}
if (isset($_GET["hold_time_option_prompt_seconds"]))			{$hold_time_option_prompt_seconds=$_GET["hold_time_option_prompt_seconds"];}
	elseif (isset($_POST["hold_time_option_prompt_seconds"]))	{$hold_time_option_prompt_seconds=$_POST["hold_time_option_prompt_seconds"];}
if (isset($_GET["admin_web_directory"]))			{$admin_web_directory=$_GET["admin_web_directory"];}
	elseif (isset($_POST["admin_web_directory"]))	{$admin_web_directory=$_POST["admin_web_directory"];}
if (isset($_GET["tts_voice"]))				{$tts_voice=$_GET["tts_voice"];}
	elseif (isset($_POST["tts_voice"]))		{$tts_voice=$_POST["tts_voice"];}
if (isset($_GET["label_title"]))					{$label_title=$_GET["label_title"];}
	elseif (isset($_POST["label_title"]))			{$label_title=$_POST["label_title"];}
if (isset($_GET["label_first_name"]))				{$label_first_name=$_GET["label_first_name"];}
	elseif (isset($_POST["label_first_name"]))		{$label_first_name=$_POST["label_first_name"];}
if (isset($_GET["label_middle_initial"]))			{$label_middle_initial=$_GET["label_middle_initial"];}
	elseif (isset($_POST["label_middle_initial"]))	{$label_middle_initial=$_POST["label_middle_initial"];}
if (isset($_GET["label_last_name"]))				{$label_last_name=$_GET["label_last_name"];}
	elseif (isset($_POST["label_last_name"]))		{$label_last_name=$_POST["label_last_name"];}
if (isset($_GET["label_address1"]))					{$label_address1=$_GET["label_address1"];}
	elseif (isset($_POST["label_address1"]))		{$label_address1=$_POST["label_address1"];}
if (isset($_GET["label_address2"]))					{$label_address2=$_GET["label_address2"];}
	elseif (isset($_POST["label_address2"]))		{$label_address2=$_POST["label_address2"];}
if (isset($_GET["label_address3"]))					{$label_address3=$_GET["label_address3"];}
	elseif (isset($_POST["label_address3"]))		{$label_address3=$_POST["label_address3"];}
if (isset($_GET["label_city"]))						{$label_city=$_GET["label_city"];}
	elseif (isset($_POST["label_city"]))			{$label_city=$_POST["label_city"];}
if (isset($_GET["label_state"]))					{$label_state=$_GET["label_state"];}
	elseif (isset($_POST["label_state"]))			{$label_state=$_POST["label_state"];}
if (isset($_GET["label_province"]))					{$label_province=$_GET["label_province"];}
	elseif (isset($_POST["label_province"]))		{$label_province=$_POST["label_province"];}
if (isset($_GET["label_postal_code"]))				{$label_postal_code=$_GET["label_postal_code"];}
	elseif (isset($_POST["label_postal_code"]))		{$label_postal_code=$_POST["label_postal_code"];}
if (isset($_GET["label_vendor_lead_code"]))			{$label_vendor_lead_code=$_GET["label_vendor_lead_code"];}
	elseif (isset($_POST["label_vendor_lead_code"])){$label_vendor_lead_code=$_POST["label_vendor_lead_code"];}
if (isset($_GET["label_gender"]))					{$label_gender=$_GET["label_gender"];}
	elseif (isset($_POST["label_gender"]))			{$label_gender=$_POST["label_gender"];}
if (isset($_GET["label_phone_number"]))				{$label_phone_number=$_GET["label_phone_number"];}
	elseif (isset($_POST["label_phone_number"]))	{$label_phone_number=$_POST["label_phone_number"];}
if (isset($_GET["label_phone_code"]))				{$label_phone_code=$_GET["label_phone_code"];}
	elseif (isset($_POST["label_phone_code"]))		{$label_phone_code=$_POST["label_phone_code"];}
if (isset($_GET["label_alt_phone"]))				{$label_alt_phone=$_GET["label_alt_phone"];}
	elseif (isset($_POST["label_alt_phone"]))		{$label_alt_phone=$_POST["label_alt_phone"];}
if (isset($_GET["label_security_phrase"]))			{$label_security_phrase=$_GET["label_security_phrase"];}
	elseif (isset($_POST["label_security_phrase"]))	{$label_security_phrase=$_POST["label_security_phrase"];}
if (isset($_GET["label_email"]))					{$label_email=$_GET["label_email"];}
	elseif (isset($_POST["label_email"]))			{$label_email=$_POST["label_email"];}
if (isset($_GET["label_comments"]))					{$label_comments=$_GET["label_comments"];}
	elseif (isset($_POST["label_comments"]))		{$label_comments=$_POST["label_comments"];}
if (isset($_GET["custom_fields_enabled"]))			{$custom_fields_enabled=$_GET["custom_fields_enabled"];}
	elseif (isset($_POST["custom_fields_enabled"]))	{$custom_fields_enabled=$_POST["custom_fields_enabled"];}
if (isset($_GET["slave_db_server"]))				{$slave_db_server=$_GET["slave_db_server"];}
	elseif (isset($_POST["slave_db_server"]))		{$slave_db_server=$_POST["slave_db_server"];}
if (isset($_GET["reports_use_slave_db"]))			{$reports_use_slave_db=$_GET["reports_use_slave_db"];}
	elseif (isset($_POST["reports_use_slave_db"]))	{$reports_use_slave_db=$_POST["reports_use_slave_db"];}
if (isset($_GET["custom_reports_use_slave_db"]))			{$custom_reports_use_slave_db=$_GET["custom_reports_use_slave_db"];}
	elseif (isset($_POST["custom_reports_use_slave_db"]))	{$custom_reports_use_slave_db=$_POST["custom_reports_use_slave_db"];}
if (isset($_GET["hold_time_second_option"]))			{$hold_time_second_option=$_GET["hold_time_second_option"];}
	elseif (isset($_POST["hold_time_second_option"]))	{$hold_time_second_option=$_POST["hold_time_second_option"];}
if (isset($_GET["hold_time_third_option"]))				{$hold_time_third_option=$_GET["hold_time_third_option"];}
	elseif (isset($_POST["hold_time_third_option"]))	{$hold_time_third_option=$_POST["hold_time_third_option"];}
if (isset($_GET["wait_hold_option_priority"]))			{$wait_hold_option_priority=$_GET["wait_hold_option_priority"];}
	elseif (isset($_POST["wait_hold_option_priority"]))	{$wait_hold_option_priority=$_POST["wait_hold_option_priority"];}
if (isset($_GET["wait_time_option"]))					{$wait_time_option=$_GET["wait_time_option"];}
	elseif (isset($_POST["wait_time_option"]))			{$wait_time_option=$_POST["wait_time_option"];}
if (isset($_GET["wait_time_second_option"]))			{$wait_time_second_option=$_GET["wait_time_second_option"];}
	elseif (isset($_POST["wait_time_second_option"]))	{$wait_time_second_option=$_POST["wait_time_second_option"];}
if (isset($_GET["wait_time_third_option"]))				{$wait_time_third_option=$_GET["wait_time_third_option"];}
	elseif (isset($_POST["wait_time_third_option"]))	{$wait_time_third_option=$_POST["wait_time_third_option"];}
if (isset($_GET["wait_time_option_seconds"]))			{$wait_time_option_seconds=$_GET["wait_time_option_seconds"];}
	elseif (isset($_POST["wait_time_option_seconds"]))	{$wait_time_option_seconds=$_POST["wait_time_option_seconds"];}
if (isset($_GET["wait_time_option_exten"]))				{$wait_time_option_exten=$_GET["wait_time_option_exten"];}
	elseif (isset($_POST["wait_time_option_exten"]))	{$wait_time_option_exten=$_POST["wait_time_option_exten"];}
if (isset($_GET["wait_time_option_voicemail"]))			{$wait_time_option_voicemail=$_GET["wait_time_option_voicemail"];}
	elseif (isset($_POST["wait_time_option_voicemail"]))	{$wait_time_option_voicemail=$_POST["wait_time_option_voicemail"];}
if (isset($_GET["wait_time_option_xfer_group"]))			{$wait_time_option_xfer_group=$_GET["wait_time_option_xfer_group"];}
	elseif (isset($_POST["wait_time_option_xfer_group"]))	{$wait_time_option_xfer_group=$_POST["wait_time_option_xfer_group"];}
if (isset($_GET["wait_time_option_callmenu"]))				{$wait_time_option_callmenu=$_GET["wait_time_option_callmenu"];}
	elseif (isset($_POST["wait_time_option_callmenu"]))		{$wait_time_option_callmenu=$_POST["wait_time_option_callmenu"];}
if (isset($_GET["wait_time_option_callback_filename"]))				{$wait_time_option_callback_filename=$_GET["wait_time_option_callback_filename"];}
	elseif (isset($_POST["wait_time_option_callback_filename"]))	{$wait_time_option_callback_filename=$_POST["wait_time_option_callback_filename"];}
if (isset($_GET["wait_time_option_callback_list_id"]))			{$wait_time_option_callback_list_id=$_GET["wait_time_option_callback_list_id"];}
	elseif (isset($_POST["wait_time_option_callback_list_id"]))	{$wait_time_option_callback_list_id=$_POST["wait_time_option_callback_list_id"];}
if (isset($_GET["wait_time_option_press_filename"]))			{$wait_time_option_press_filename=$_GET["wait_time_option_press_filename"];}
	elseif (isset($_POST["wait_time_option_press_filename"]))	{$wait_time_option_press_filename=$_POST["wait_time_option_press_filename"];}
if (isset($_GET["wait_time_option_no_block"]))			{$wait_time_option_no_block=$_GET["wait_time_option_no_block"];}
	elseif (isset($_POST["wait_time_option_no_block"]))	{$wait_time_option_no_block=$_POST["wait_time_option_no_block"];}
if (isset($_GET["wait_time_option_prompt_seconds"]))			{$wait_time_option_prompt_seconds=$_GET["wait_time_option_prompt_seconds"];}
	elseif (isset($_POST["wait_time_option_prompt_seconds"]))	{$wait_time_option_prompt_seconds=$_POST["wait_time_option_prompt_seconds"];}
if (isset($_GET["timer_action_destination"]))			{$timer_action_destination=$_GET["timer_action_destination"];}
	elseif (isset($_POST["timer_action_destination"]))	{$timer_action_destination=$_POST["timer_action_destination"];}
if (isset($_GET["allowed_reports"]))			{$allowed_reports=$_GET["allowed_reports"];}
	elseif (isset($_POST["allowed_reports"]))	{$allowed_reports=$_POST["allowed_reports"];}
if (isset($_GET["allowed_custom_reports"]))			{$allowed_custom_reports=$_GET["allowed_custom_reports"];}
	elseif (isset($_POST["allowed_custom_reports"]))	{$allowed_custom_reports=$_POST["allowed_custom_reports"];}
if (isset($_GET["filter_phone_group_id"]))			{$filter_phone_group_id=$_GET["filter_phone_group_id"];}
	elseif (isset($_POST["filter_phone_group_id"]))	{$filter_phone_group_id=$_POST["filter_phone_group_id"];}
if (isset($_GET["filter_phone_group_name"]))			{$filter_phone_group_name=$_GET["filter_phone_group_name"];}
	elseif (isset($_POST["filter_phone_group_name"]))	{$filter_phone_group_name=$_POST["filter_phone_group_name"];}
if (isset($_GET["filter_phone_group_description"]))				{$filter_phone_group_description=$_GET["filter_phone_group_description"];}
	elseif (isset($_POST["filter_phone_group_description"]))	{$filter_phone_group_description=$_POST["filter_phone_group_description"];}
if (isset($_GET["filter_inbound_number"]))			{$filter_inbound_number=$_GET["filter_inbound_number"];}
	elseif (isset($_POST["filter_inbound_number"]))	{$filter_inbound_number=$_POST["filter_inbound_number"];}
if (isset($_GET["filter_url"]))				{$filter_url=$_GET["filter_url"];}
	elseif (isset($_POST["filter_url"]))	{$filter_url=$_POST["filter_url"];}
if (isset($_GET["filter_action"]))			{$filter_action=$_GET["filter_action"];}
	elseif (isset($_POST["filter_action"]))	{$filter_action=$_POST["filter_action"];}
if (isset($_GET["filter_extension"]))			{$filter_extension=$_GET["filter_extension"];}
	elseif (isset($_POST["filter_extension"]))	{$filter_extension=$_POST["filter_extension"];}
if (isset($_GET["filter_exten_context"]))			{$filter_exten_context=$_GET["filter_exten_context"];}
	elseif (isset($_POST["filter_exten_context"]))	{$filter_exten_context=$_POST["filter_exten_context"];}
if (isset($_GET["filter_voicemail_ext"]))			{$filter_voicemail_ext=$_GET["filter_voicemail_ext"];}
	elseif (isset($_POST["filter_voicemail_ext"]))	{$filter_voicemail_ext=$_POST["filter_voicemail_ext"];}
if (isset($_GET["filter_phone"]))			{$filter_phone=$_GET["filter_phone"];}
	elseif (isset($_POST["filter_phone"]))	{$filter_phone=$_POST["filter_phone"];}
if (isset($_GET["filter_server_ip"]))			{$filter_server_ip=$_GET["filter_server_ip"];}
	elseif (isset($_POST["filter_server_ip"]))	{$filter_server_ip=$_POST["filter_server_ip"];}
if (isset($_GET["filter_user"]))			{$filter_user=$_GET["filter_user"];}
	elseif (isset($_POST["filter_user"]))	{$filter_user=$_POST["filter_user"];}
if (isset($_GET["filter_user_unavailable_action"]))				{$filter_user_unavailable_action=$_GET["filter_user_unavailable_action"];}
	elseif (isset($_POST["filter_user_unavailable_action"]))	{$filter_user_unavailable_action=$_POST["filter_user_unavailable_action"];}
if (isset($_GET["filter_user_route_settings_ingroup"]))				{$filter_user_route_settings_ingroup=$_GET["filter_user_route_settings_ingroup"];}
	elseif (isset($_POST["filter_user_route_settings_ingroup"]))	{$filter_user_route_settings_ingroup=$_POST["filter_user_route_settings_ingroup"];}
if (isset($_GET["filter_group_id"]))			{$filter_group_id=$_GET["filter_group_id"];}
	elseif (isset($_POST["filter_group_id"]))	{$filter_group_id=$_POST["filter_group_id"];}
if (isset($_GET["filter_call_handle_method"]))			{$filter_call_handle_method=$_GET["filter_call_handle_method"];}
	elseif (isset($_POST["filter_call_handle_method"]))	{$filter_call_handle_method=$_POST["filter_call_handle_method"];}
if (isset($_GET["filter_agent_search_method"]))				{$filter_agent_search_method=$_GET["filter_agent_search_method"];}
	elseif (isset($_POST["filter_agent_search_method"]))	{$filter_agent_search_method=$_POST["filter_agent_search_method"];}
if (isset($_GET["filter_list_id"]))				{$filter_list_id=$_GET["filter_list_id"];}
	elseif (isset($_POST["filter_list_id"]))	{$filter_list_id=$_POST["filter_list_id"];}
if (isset($_GET["filter_campaign_id"]))				{$filter_campaign_id=$_GET["filter_campaign_id"];}
	elseif (isset($_POST["filter_campaign_id"]))	{$filter_campaign_id=$_POST["filter_campaign_id"];}
if (isset($_GET["filter_phone_code"]))			{$filter_phone_code=$_GET["filter_phone_code"];}
	elseif (isset($_POST["filter_phone_code"]))	{$filter_phone_code=$_POST["filter_phone_code"];}
if (isset($_GET["filter_menu_id"]))				{$filter_menu_id=$_GET["filter_menu_id"];}
	elseif (isset($_POST["filter_menu_id"]))	{$filter_menu_id=$_POST["filter_menu_id"];}
if (isset($_GET["filter_clean_cid_number"]))			{$filter_clean_cid_number=$_GET["filter_clean_cid_number"];}
	elseif (isset($_POST["filter_clean_cid_number"]))	{$filter_clean_cid_number=$_POST["filter_clean_cid_number"];}
if (isset($_GET["webphone_url_override"]))			{$webphone_url_override=$_GET["webphone_url_override"];}
	elseif (isset($_POST["webphone_url_override"]))	{$webphone_url_override=$_POST["webphone_url_override"];}
if (isset($_GET["calculate_estimated_hold_seconds"]))			{$calculate_estimated_hold_seconds=$_GET["calculate_estimated_hold_seconds"];}
	elseif (isset($_POST["calculate_estimated_hold_seconds"]))	{$calculate_estimated_hold_seconds=$_POST["calculate_estimated_hold_seconds"];}
if (isset($_GET["enable_xfer_presets"]))			{$enable_xfer_presets=$_GET["enable_xfer_presets"];}
	elseif (isset($_POST["enable_xfer_presets"]))	{$enable_xfer_presets=$_POST["enable_xfer_presets"];}
if (isset($_GET["hide_xfer_number_to_dial"]))			{$hide_xfer_number_to_dial=$_GET["hide_xfer_number_to_dial"];}
	elseif (isset($_POST["hide_xfer_number_to_dial"]))	{$hide_xfer_number_to_dial=$_POST["hide_xfer_number_to_dial"];}
if (isset($_GET["preset_name"]))			{$preset_name=$_GET["preset_name"];}
	elseif (isset($_POST["preset_name"]))	{$preset_name=$_POST["preset_name"];}
if (isset($_GET["preset_number"]))			{$preset_number=$_GET["preset_number"];}
	elseif (isset($_POST["preset_number"]))	{$preset_number=$_POST["preset_number"];}
if (isset($_GET["preset_dtmf"]))			{$preset_dtmf=$_GET["preset_dtmf"];}
	elseif (isset($_POST["preset_dtmf"]))	{$preset_dtmf=$_POST["preset_dtmf"];}
if (isset($_GET["preset_hide_number"]))				{$preset_hide_number=$_GET["preset_hide_number"];}
	elseif (isset($_POST["preset_hide_number"]))	{$preset_hide_number=$_POST["preset_hide_number"];}
if (isset($_GET["manual_dial_prefix"]))				{$manual_dial_prefix=$_GET["manual_dial_prefix"];}
	elseif (isset($_POST["manual_dial_prefix"]))	{$manual_dial_prefix=$_POST["manual_dial_prefix"];}
if (isset($_GET["webphone_systemkey"]))				{$webphone_systemkey=$_GET["webphone_systemkey"];}
	elseif (isset($_POST["webphone_systemkey"]))	{$webphone_systemkey=$_POST["webphone_systemkey"];}
if (isset($_GET["webphone_dialpad"]))			{$webphone_dialpad=$_GET["webphone_dialpad"];}
	elseif (isset($_POST["webphone_dialpad"]))	{$webphone_dialpad=$_POST["webphone_dialpad"];}
if (isset($_GET["webphone_systemkey_override"]))			{$webphone_systemkey_override=$_GET["webphone_systemkey_override"];}
	elseif (isset($_POST["webphone_systemkey_override"]))	{$webphone_systemkey_override=$_POST["webphone_systemkey_override"];}
if (isset($_GET["webphone_dialpad_override"]))			{$webphone_dialpad_override=$_GET["webphone_dialpad_override"];}
	elseif (isset($_POST["webphone_dialpad_override"]))	{$webphone_dialpad_override=$_POST["webphone_dialpad_override"];}
if (isset($_GET["force_change_password"]))			{$force_change_password=$_GET["force_change_password"];}
	elseif (isset($_POST["force_change_password"]))	{$force_change_password=$_POST["force_change_password"];}
if (isset($_GET["first_login_trigger"]))			{$first_login_trigger=$_GET["first_login_trigger"];}
	elseif (isset($_POST["first_login_trigger"]))	{$first_login_trigger=$_POST["first_login_trigger"];}
if (isset($_GET["default_phone_registration_password"]))			{$default_phone_registration_password=$_GET["default_phone_registration_password"];}
	elseif (isset($_POST["default_phone_registration_password"]))	{$default_phone_registration_password=$_POST["default_phone_registration_password"];}
if (isset($_GET["default_phone_login_password"]))			{$default_phone_login_password=$_GET["default_phone_login_password"];}
	elseif (isset($_POST["default_phone_login_password"]))	{$default_phone_login_password=$_POST["default_phone_login_password"];}
if (isset($_GET["default_server_password"]))			{$default_server_password=$_GET["default_server_password"];}
	elseif (isset($_POST["default_server_password"]))	{$default_server_password=$_POST["default_server_password"];}
if (isset($_GET["customer_3way_hangup_logging"]))			{$customer_3way_hangup_logging=$_GET["customer_3way_hangup_logging"];}
	elseif (isset($_POST["customer_3way_hangup_logging"]))	{$customer_3way_hangup_logging=$_POST["customer_3way_hangup_logging"];}
if (isset($_GET["customer_3way_hangup_seconds"]))			{$customer_3way_hangup_seconds=$_GET["customer_3way_hangup_seconds"];}
	elseif (isset($_POST["customer_3way_hangup_seconds"]))	{$customer_3way_hangup_seconds=$_POST["customer_3way_hangup_seconds"];}
if (isset($_GET["customer_3way_hangup_action"]))			{$customer_3way_hangup_action=$_GET["customer_3way_hangup_action"];}
	elseif (isset($_POST["customer_3way_hangup_action"]))	{$customer_3way_hangup_action=$_POST["customer_3way_hangup_action"];}
if (isset($_GET["add_lead_url"]))			{$add_lead_url=$_GET["add_lead_url"];}
	elseif (isset($_POST["add_lead_url"]))	{$add_lead_url=$_POST["add_lead_url"];}
if (isset($_GET["ivr_park_call"]))			{$ivr_park_call=$_GET["ivr_park_call"];}
	elseif (isset($_POST["ivr_park_call"]))	{$ivr_park_call=$_POST["ivr_park_call"];}
if (isset($_GET["ivr_park_call_agi"]))			{$ivr_park_call_agi=$_GET["ivr_park_call_agi"];}
	elseif (isset($_POST["ivr_park_call_agi"]))	{$ivr_park_call_agi=$_POST["ivr_park_call_agi"];}
if (isset($_GET["manual_preview_dial"]))			{$manual_preview_dial=$_GET["manual_preview_dial"];}
	elseif (isset($_POST["manual_preview_dial"]))	{$manual_preview_dial=$_POST["manual_preview_dial"];}
if (isset($_GET["eht_minimum_prompt_filename"]))			{$eht_minimum_prompt_filename=$_GET["eht_minimum_prompt_filename"];}
	elseif (isset($_POST["eht_minimum_prompt_filename"]))	{$eht_minimum_prompt_filename=$_POST["eht_minimum_prompt_filename"];}
if (isset($_GET["eht_minimum_prompt_no_block"]))			{$eht_minimum_prompt_no_block=$_GET["eht_minimum_prompt_no_block"];}
	elseif (isset($_POST["eht_minimum_prompt_no_block"]))	{$eht_minimum_prompt_no_block=$_POST["eht_minimum_prompt_no_block"];}
if (isset($_GET["eht_minimum_prompt_seconds"]))				{$eht_minimum_prompt_seconds=$_GET["eht_minimum_prompt_seconds"];}
	elseif (isset($_POST["eht_minimum_prompt_seconds"]))	{$eht_minimum_prompt_seconds=$_POST["eht_minimum_prompt_seconds"];}
if (isset($_GET["realtime_agent_time_stats"]))				{$realtime_agent_time_stats=$_GET["realtime_agent_time_stats"];}
	elseif (isset($_POST["realtime_agent_time_stats"]))		{$realtime_agent_time_stats=$_POST["realtime_agent_time_stats"];}
if (isset($_GET["admin_modify_refresh"]))			{$admin_modify_refresh=$_GET["admin_modify_refresh"];}
	elseif (isset($_POST["admin_modify_refresh"]))	{$admin_modify_refresh=$_POST["admin_modify_refresh"];}
if (isset($_GET["nocache_admin"]))			{$nocache_admin=$_GET["nocache_admin"];}
	elseif (isset($_POST["nocache_admin"]))	{$nocache_admin=$_POST["nocache_admin"];}
if (isset($_GET["generate_cross_server_exten"]))			{$generate_cross_server_exten=$_GET["generate_cross_server_exten"];}
	elseif (isset($_POST["generate_cross_server_exten"]))	{$generate_cross_server_exten=$_POST["generate_cross_server_exten"];}
if (isset($_GET["queuemetrics_addmember_enabled"]))				{$queuemetrics_addmember_enabled=$_GET["queuemetrics_addmember_enabled"];}
	elseif (isset($_POST["queuemetrics_addmember_enabled"]))	{$queuemetrics_addmember_enabled=$_POST["queuemetrics_addmember_enabled"];}
if (isset($_GET["modify_page"]))			{$modify_page=$_GET["modify_page"];}
	elseif (isset($_POST["modify_page"]))	{$modify_page=$_POST["modify_page"];}
if (isset($_GET["modify_url"]))				{$modify_url=$_GET["modify_url"];}
	elseif (isset($_POST["modify_url"]))	{$modify_url=$_POST["modify_url"];}
if (isset($_GET["use_auto_hopper"]))			{$use_auto_hopper=$_GET["use_auto_hopper"];}
	elseif (isset($_POST["use_auto_hopper"]))	{$use_auto_hopper=$_POST["use_auto_hopper"];}
if (isset($_GET["auto_hopper_multi"]))			{$auto_hopper_multi=$_GET["auto_hopper_multi"];}
	elseif (isset($_POST["auto_hopper_multi"]))	{$auto_hopper_multi=$_POST["auto_hopper_multi"];}
if (isset($_GET["auto_trim_hopper"]))			{$auto_trim_hopper=$_GET["auto_trim_hopper"];}
	elseif (isset($_POST["auto_trim_hopper"]))	{$auto_trim_hopper=$_POST["auto_trim_hopper"];}
if (isset($_GET["api_manual_dial"]))			{$api_manual_dial=$_GET["api_manual_dial"];}
	elseif (isset($_POST["api_manual_dial"]))	{$api_manual_dial=$_POST["api_manual_dial"];}
if (isset($_GET["manual_dial_call_time_check"]))			{$manual_dial_call_time_check=$_GET["manual_dial_call_time_check"];}
	elseif (isset($_POST["manual_dial_call_time_check"]))	{$manual_dial_call_time_check=$_POST["manual_dial_call_time_check"];}
if (isset($_GET["queuemetrics_dispo_pause"]))			{$queuemetrics_dispo_pause=$_GET["queuemetrics_dispo_pause"];}
	elseif (isset($_POST["queuemetrics_dispo_pause"]))	{$queuemetrics_dispo_pause=$_POST["queuemetrics_dispo_pause"];}
if (isset($_GET["lead_order_randomize"]))			{$lead_order_randomize=$_GET["lead_order_randomize"];}
	elseif (isset($_POST["lead_order_randomize"]))	{$lead_order_randomize=$_POST["lead_order_randomize"];}
if (isset($_GET["lead_order_secondary"]))			{$lead_order_secondary=$_GET["lead_order_secondary"];}
	elseif (isset($_POST["lead_order_secondary"]))	{$lead_order_secondary=$_POST["lead_order_secondary"];}
if (isset($_GET["per_call_notes"]))				{$per_call_notes=$_GET["per_call_notes"];}
	elseif (isset($_POST["per_call_notes"]))	{$per_call_notes=$_POST["per_call_notes"];}
if (isset($_GET["my_callback_option"]))				{$my_callback_option=$_GET["my_callback_option"];}
	elseif (isset($_POST["my_callback_option"]))	{$my_callback_option=$_POST["my_callback_option"];}
if (isset($_GET["agent_lead_search"]))			{$agent_lead_search=$_GET["agent_lead_search"];}
	elseif (isset($_POST["agent_lead_search"]))	{$agent_lead_search=$_POST["agent_lead_search"];}
if (isset($_GET["agent_lead_search_method"]))			{$agent_lead_search_method=$_GET["agent_lead_search_method"];}
	elseif (isset($_POST["agent_lead_search_method"]))	{$agent_lead_search_method=$_POST["agent_lead_search_method"];}
if (isset($_GET["queuemetrics_phone_environment"]))				{$queuemetrics_phone_environment=$_GET["queuemetrics_phone_environment"];}
	elseif (isset($_POST["queuemetrics_phone_environment"]))	{$queuemetrics_phone_environment=$_POST["queuemetrics_phone_environment"];}
if (isset($_GET["active_twin_server_ip"]))			{$active_twin_server_ip=$_GET["active_twin_server_ip"];}
	elseif (isset($_POST["active_twin_server_ip"]))	{$active_twin_server_ip=$_POST["active_twin_server_ip"];}
if (isset($_GET["on_hook_agent"]))			{$on_hook_agent=$_GET["on_hook_agent"];}
	elseif (isset($_POST["on_hook_agent"]))	{$on_hook_agent=$_POST["on_hook_agent"];}
if (isset($_GET["on_hook_ring_time"]))			{$on_hook_ring_time=$_GET["on_hook_ring_time"];}
	elseif (isset($_POST["on_hook_ring_time"]))	{$on_hook_ring_time=$_POST["on_hook_ring_time"];}
if (isset($_GET["auto_pause_precall"]))			{$auto_pause_precall=$_GET["auto_pause_precall"];}
	elseif (isset($_POST["auto_pause_precall"]))	{$auto_pause_precall=$_POST["auto_pause_precall"];}
if (isset($_GET["auto_resume_precall"]))			{$auto_resume_precall=$_GET["auto_resume_precall"];}
	elseif (isset($_POST["auto_resume_precall"]))	{$auto_resume_precall=$_POST["auto_resume_precall"];}
if (isset($_GET["auto_pause_precall_code"]))			{$auto_pause_precall_code=$_GET["auto_pause_precall_code"];}
	elseif (isset($_POST["auto_pause_precall_code"]))	{$auto_pause_precall_code=$_POST["auto_pause_precall_code"];}
if (isset($_GET["audit_comments"]))                    {$audit_comments=$_GET["audit_comments"];}
	elseif (isset($_POST["audit_comments"]))        {$audit_comments=$_POST["audit_comments"];}
if (isset($_GET["reload_dialplan_on_servers"]))				{$reload_dialplan_on_servers=$_GET["reload_dialplan_on_servers"];}
	elseif (isset($_POST["reload_dialplan_on_servers"]))	{$reload_dialplan_on_servers=$_POST["reload_dialplan_on_servers"];}
if (isset($_GET["manual_dial_cid"]))			{$manual_dial_cid=$_GET["manual_dial_cid"];}
	elseif (isset($_POST["manual_dial_cid"]))	{$manual_dial_cid=$_POST["manual_dial_cid"];}
if (isset($_GET["post_phone_time_diff_alert"]))				{$post_phone_time_diff_alert=$_GET["post_phone_time_diff_alert"];}
	elseif (isset($_POST["post_phone_time_diff_alert"]))	{$post_phone_time_diff_alert=$_POST["post_phone_time_diff_alert"];}
if (isset($_GET["custom_3way_button_transfer"]))			{$custom_3way_button_transfer=$_GET["custom_3way_button_transfer"];}
	elseif (isset($_POST["custom_3way_button_transfer"]))	{$custom_3way_button_transfer=$_POST["custom_3way_button_transfer"];}
if (isset($_GET["available_only_tally_threshold"]))				{$available_only_tally_threshold=$_GET["available_only_tally_threshold"];}
	elseif (isset($_POST["available_only_tally_threshold"]))	{$available_only_tally_threshold=$_POST["available_only_tally_threshold"];}
if (isset($_GET["available_only_tally_threshold_agents"]))			{$available_only_tally_threshold_agents=$_GET["available_only_tally_threshold_agents"];}
	elseif (isset($_POST["available_only_tally_threshold_agents"]))	{$available_only_tally_threshold_agents=$_POST["available_only_tally_threshold_agents"];}
if (isset($_GET["dial_level_threshold"]))			{$dial_level_threshold=$_GET["dial_level_threshold"];}
	elseif (isset($_POST["dial_level_threshold"]))	{$dial_level_threshold=$_POST["dial_level_threshold"];}
if (isset($_GET["dial_level_threshold_agents"]))			{$dial_level_threshold_agents=$_GET["dial_level_threshold_agents"];}
	elseif (isset($_POST["dial_level_threshold_agents"]))	{$dial_level_threshold_agents=$_POST["dial_level_threshold_agents"];}
if (isset($_GET["time_zone_setting"]))			{$time_zone_setting=$_GET["time_zone_setting"];}
	elseif (isset($_POST["time_zone_setting"]))	{$time_zone_setting=$_POST["time_zone_setting"];}
if (isset($_GET["safe_harbor_audio"]))			{$safe_harbor_audio=$_GET["safe_harbor_audio"];}
	elseif (isset($_POST["safe_harbor_audio"]))	{$safe_harbor_audio=$_POST["safe_harbor_audio"];}
if (isset($_GET["safe_harbor_menu_id"]))			{$safe_harbor_menu_id=$_GET["safe_harbor_menu_id"];}
	elseif (isset($_POST["safe_harbor_menu_id"]))	{$safe_harbor_menu_id=$_POST["safe_harbor_menu_id"];}
if (isset($_GET["dtmf_log"]))			{$dtmf_log=$_GET["dtmf_log"];}
	elseif (isset($_POST["dtmf_log"]))	{$dtmf_log=$_POST["dtmf_log"];}
if (isset($_GET["webphone_auto_answer"]))			{$webphone_auto_answer=$_GET["webphone_auto_answer"];}
	elseif (isset($_POST["webphone_auto_answer"]))	{$webphone_auto_answer=$_POST["webphone_auto_answer"];}
if (isset($_GET["survey_menu_id"]))				{$survey_menu_id=$_GET["survey_menu_id"];}
	elseif (isset($_POST["survey_menu_id"]))	{$survey_menu_id=$_POST["survey_menu_id"];}
if (isset($_GET["callback_days_limit"]))			{$callback_days_limit=$_GET["callback_days_limit"];}
	elseif (isset($_POST["callback_days_limit"]))	{$callback_days_limit=$_POST["callback_days_limit"];}
if (isset($_GET["dl_diff_target_method"]))			{$dl_diff_target_method=$_GET["dl_diff_target_method"];}
	elseif (isset($_POST["dl_diff_target_method"]))	{$dl_diff_target_method=$_POST["dl_diff_target_method"];}
if (isset($_GET["disable_dispo_screen"]))			{$disable_dispo_screen=$_GET["disable_dispo_screen"];}
	elseif (isset($_POST["disable_dispo_screen"]))	{$disable_dispo_screen=$_POST["disable_dispo_screen"];}
if (isset($_GET["disable_dispo_status"]))			{$disable_dispo_status=$_GET["disable_dispo_status"];}
	elseif (isset($_POST["disable_dispo_status"]))	{$disable_dispo_status=$_POST["disable_dispo_status"];}
if (isset($_GET["screen_labels"]))			{$screen_labels=$_GET["screen_labels"];}
	elseif (isset($_POST["screen_labels"]))	{$screen_labels=$_POST["screen_labels"];}
if (isset($_GET["label_hide_field_logs"]))			{$label_hide_field_logs=$_GET["label_hide_field_logs"];}
	elseif (isset($_POST["label_hide_field_logs"]))	{$label_hide_field_logs=$_POST["label_hide_field_logs"];}
if (isset($_GET["label_id"]))			{$label_id=$_GET["label_id"];}
	elseif (isset($_POST["label_id"]))	{$label_id=$_POST["label_id"];}
if (isset($_GET["label_name"]))				{$label_name=$_GET["label_name"];}
	elseif (isset($_POST["label_name"]))	{$label_name=$_POST["label_name"];}
if (isset($_GET["status_display_fields"]))			{$status_display_fields=$_GET["status_display_fields"];}
	elseif (isset($_POST["status_display_fields"]))	{$status_display_fields=$_POST["status_display_fields"];}
if (isset($_GET["queuemetrics_pe_phone_append"]))			{$queuemetrics_pe_phone_append=$_GET["queuemetrics_pe_phone_append"];}
	elseif (isset($_POST["queuemetrics_pe_phone_append"]))	{$queuemetrics_pe_phone_append=$_POST["queuemetrics_pe_phone_append"];}
if (isset($_GET["test_campaign_calls"]))			{$test_campaign_calls=$_GET["test_campaign_calls"];}
	elseif (isset($_POST["test_campaign_calls"]))	{$test_campaign_calls=$_POST["test_campaign_calls"];}
if (isset($_GET["agents_calls_reset"]))				{$agents_calls_reset=$_GET["agents_calls_reset"];}
	elseif (isset($_POST["agents_calls_reset"]))	{$agents_calls_reset=$_POST["agents_calls_reset"];}
if (isset($_GET["voicemail_timezone"]))				{$voicemail_timezone=$_GET["voicemail_timezone"];}
	elseif (isset($_POST["voicemail_timezone"]))	{$voicemail_timezone=$_POST["voicemail_timezone"];}
if (isset($_GET["voicemail_options"]))			{$voicemail_options=$_GET["voicemail_options"];}
	elseif (isset($_POST["voicemail_options"]))	{$voicemail_options=$_POST["voicemail_options"];}
if (isset($_GET["default_voicemail_timezone"]))				{$default_voicemail_timezone=$_GET["default_voicemail_timezone"];}
	elseif (isset($_POST["default_voicemail_timezone"]))	{$default_voicemail_timezone=$_POST["default_voicemail_timezone"];}
if (isset($_GET["default_local_gmt"]))			{$default_local_gmt=$_GET["default_local_gmt"];}
	elseif (isset($_POST["default_local_gmt"]))	{$default_local_gmt=$_POST["default_local_gmt"];}
if (isset($_GET["na_call_url"]))			{$na_call_url=$_GET["na_call_url"];}
	elseif (isset($_POST["na_call_url"]))	{$na_call_url=$_POST["na_call_url"];}
if (isset($_GET["on_hook_cid"]))			{$on_hook_cid=$_GET["on_hook_cid"];}
	elseif (isset($_POST["on_hook_cid"]))	{$on_hook_cid=$_POST["on_hook_cid"];}
if (isset($_GET["form_end"]))			{$form_end=$_GET["form_end"];}
	elseif (isset($_POST["form_end"]))	{$form_end=$_POST["form_end"];}
if (isset($_GET["noanswer_log"]))			{$noanswer_log=$_GET["noanswer_log"];}
	elseif (isset($_POST["noanswer_log"]))	{$noanswer_log=$_POST["noanswer_log"];}
if (isset($_GET["alt_log_server_ip"]))			{$alt_log_server_ip=$_GET["alt_log_server_ip"];}
	elseif (isset($_POST["alt_log_server_ip"]))	{$alt_log_server_ip=$_POST["alt_log_server_ip"];}
if (isset($_GET["alt_log_dbname"]))			{$alt_log_dbname=$_GET["alt_log_dbname"];}
	elseif (isset($_POST["alt_log_dbname"]))	{$alt_log_dbname=$_POST["alt_log_dbname"];}
if (isset($_GET["alt_log_login"]))			{$alt_log_login=$_GET["alt_log_login"];}
	elseif (isset($_POST["alt_log_login"]))	{$alt_log_login=$_POST["alt_log_login"];}
if (isset($_GET["alt_log_pass"]))			{$alt_log_pass=$_GET["alt_log_pass"];}
	elseif (isset($_POST["alt_log_pass"]))	{$alt_log_pass=$_POST["alt_log_pass"];}
if (isset($_GET["tables_use_alt_log_db"]))			{$tables_use_alt_log_db=$_GET["tables_use_alt_log_db"];}
	elseif (isset($_POST["tables_use_alt_log_db"]))	{$tables_use_alt_log_db=$_POST["tables_use_alt_log_db"];}
if (isset($_GET["did_agent_log"]))			{$did_agent_log=$_GET["did_agent_log"];}
	elseif (isset($_POST["did_agent_log"]))	{$did_agent_log=$_POST["did_agent_log"];}
if (isset($_GET["survey_recording"]))			{$survey_recording=$_GET["survey_recording"];}
	elseif (isset($_POST["survey_recording"]))	{$survey_recording=$_POST["survey_recording"];}
if (isset($_GET["campaign_cid_areacodes_enabled"]))				{$campaign_cid_areacodes_enabled=$_GET["campaign_cid_areacodes_enabled"];}
	elseif (isset($_POST["campaign_cid_areacodes_enabled"]))	{$campaign_cid_areacodes_enabled=$_POST["campaign_cid_areacodes_enabled"];}
if (isset($_GET["areacode"]))			{$areacode=$_GET["areacode"];}
	elseif (isset($_POST["areacode"]))	{$areacode=$_POST["areacode"];}
if (isset($_GET["cid_description"]))			{$cid_description=$_GET["cid_description"];}
	elseif (isset($_POST["cid_description"]))	{$cid_description=$_POST["cid_description"];}
if (isset($_GET["pllb_grouping"]))			{$pllb_grouping=$_GET["pllb_grouping"];}
	elseif (isset($_POST["pllb_grouping"]))	{$pllb_grouping=$_POST["pllb_grouping"];}
if (isset($_GET["pllb_grouping_limit"]))			{$pllb_grouping_limit=$_GET["pllb_grouping_limit"];}
	elseif (isset($_POST["pllb_grouping_limit"]))	{$pllb_grouping_limit=$_POST["pllb_grouping_limit"];}
if (isset($_GET["description"]))			{$description=$_GET["description"];}
	elseif (isset($_POST["description"]))	{$description=$_POST["description"];}
if (isset($_GET["did_ra_extensions_enabled"]))			{$did_ra_extensions_enabled=$_GET["did_ra_extensions_enabled"];}
	elseif (isset($_POST["did_ra_extensions_enabled"]))	{$did_ra_extensions_enabled=$_POST["did_ra_extensions_enabled"];}
if (isset($_GET["modify_shifts"]))			{$modify_shifts=$_GET["modify_shifts"];}
	elseif (isset($_POST["modify_shifts"]))	{$modify_shifts=$_POST["modify_shifts"];}
if (isset($_GET["modify_phones"]))			{$modify_phones=$_GET["modify_phones"];}
	elseif (isset($_POST["modify_phones"]))	{$modify_phones=$_POST["modify_phones"];}
if (isset($_GET["modify_carriers"]))			{$modify_carriers=$_GET["modify_carriers"];}
	elseif (isset($_POST["modify_carriers"]))	{$modify_carriers=$_POST["modify_carriers"];}
if (isset($_GET["modify_labels"]))			{$modify_labels=$_GET["modify_labels"];}
	elseif (isset($_POST["modify_labels"]))	{$modify_labels=$_POST["modify_labels"];}
if (isset($_GET["modify_statuses"]))			{$modify_statuses=$_GET["modify_statuses"];}
	elseif (isset($_POST["modify_statuses"]))	{$modify_statuses=$_POST["modify_statuses"];}
if (isset($_GET["modify_voicemail"]))			{$modify_voicemail=$_GET["modify_voicemail"];}
	elseif (isset($_POST["modify_voicemail"]))	{$modify_voicemail=$_POST["modify_voicemail"];}
if (isset($_GET["modify_audiostore"]))			{$modify_audiostore=$_GET["modify_audiostore"];}
	elseif (isset($_POST["modify_audiostore"]))	{$modify_audiostore=$_POST["modify_audiostore"];}
if (isset($_GET["modify_moh"]))				{$modify_moh=$_GET["modify_moh"];}
	elseif (isset($_POST["modify_moh"]))	{$modify_moh=$_POST["modify_moh"];}
if (isset($_GET["modify_tts"]))				{$modify_tts=$_GET["modify_tts"];}
	elseif (isset($_POST["modify_tts"]))	{$modify_tts=$_POST["modify_tts"];}
if (isset($_GET["action_xfer_cid"]))			{$action_xfer_cid=$_GET["action_xfer_cid"];}
	elseif (isset($_POST["action_xfer_cid"]))	{$action_xfer_cid=$_POST["action_xfer_cid"];}
if (isset($_GET["drop_callmenu"]))			{$drop_callmenu=$_GET["drop_callmenu"];}
	elseif (isset($_POST["drop_callmenu"]))	{$drop_callmenu=$_POST["drop_callmenu"];}
if (isset($_GET["after_hours_callmenu"]))			{$after_hours_callmenu=$_GET["after_hours_callmenu"];}
	elseif (isset($_POST["after_hours_callmenu"]))	{$after_hours_callmenu=$_POST["after_hours_callmenu"];}
if (isset($_GET["dtmf_field"]))			{$dtmf_field=$_GET["dtmf_field"];}
	elseif (isset($_POST["dtmf_field"]))	{$dtmf_field=$_POST["dtmf_field"];}
if (isset($_GET["call_count_limit"]))			{$call_count_limit=$_GET["call_count_limit"];}
	elseif (isset($_POST["call_count_limit"]))	{$call_count_limit=$_POST["call_count_limit"];}
if (isset($_GET["call_count_target"]))			{$call_count_target=$_GET["call_count_target"];}
	elseif (isset($_POST["call_count_target"]))	{$call_count_target=$_POST["call_count_target"];}
if (isset($_GET["completed"]))			{$completed=$_GET["completed"];}
	elseif (isset($_POST["completed"]))	{$completed=$_POST["completed"];}
if (isset($_GET["expanded_list_stats"]))			{$expanded_list_stats=$_GET["expanded_list_stats"];}
	elseif (isset($_POST["expanded_list_stats"]))	{$expanded_list_stats=$_POST["expanded_list_stats"];}
if (isset($_GET["report_option"]))			{$report_option=$_GET["report_option"];}
	elseif (isset($_POST["report_option"]))	{$report_option=$_POST["report_option"];}
if (isset($_GET["preset_contact_search"]))			{$preset_contact_search=$_GET["preset_contact_search"];}
	elseif (isset($_POST["preset_contact_search"]))	{$preset_contact_search=$_POST["preset_contact_search"];}
if (isset($_GET["contacts_enabled"]))			{$contacts_enabled=$_GET["contacts_enabled"];}
	elseif (isset($_POST["contacts_enabled"]))	{$contacts_enabled=$_POST["contacts_enabled"];}
if (isset($_GET["contact_id"]))				{$contact_id=$_GET["contact_id"];}
	elseif (isset($_POST["contact_id"]))	{$contact_id=$_POST["contact_id"];}
if (isset($_GET["first_name"]))				{$first_name=$_GET["first_name"];}
	elseif (isset($_POST["first_name"]))	{$first_name=$_POST["first_name"];}
if (isset($_GET["last_name"]))				{$last_name=$_GET["last_name"];}
	elseif (isset($_POST["last_name"]))		{$last_name=$_POST["last_name"];}
if (isset($_GET["office_num"]))				{$office_num=$_GET["office_num"];}
	elseif (isset($_POST["office_num"]))	{$office_num=$_POST["office_num"];}
if (isset($_GET["cell_num"]))				{$cell_num=$_GET["cell_num"];}
	elseif (isset($_POST["cell_num"]))		{$cell_num=$_POST["cell_num"];}
if (isset($_GET["other_num1"]))				{$other_num1=$_GET["other_num1"];}
	elseif (isset($_POST["other_num1"]))	{$other_num1=$_POST["other_num1"];}
if (isset($_GET["other_num2"]))				{$other_num2=$_GET["other_num2"];}
	elseif (isset($_POST["other_num2"]))	{$other_num2=$_POST["other_num2"];}
if (isset($_GET["modify_contacts"]))			{$modify_contacts=$_GET["modify_contacts"];}
	elseif (isset($_POST["modify_contacts"]))	{$modify_contacts=$_POST["modify_contacts"];}
if (isset($_GET["bu_name"]))			{$bu_name=$_GET["bu_name"];}
	elseif (isset($_POST["bu_name"]))	{$bu_name=$_POST["bu_name"];}
if (isset($_GET["department"]))				{$department=$_GET["department"];}
	elseif (isset($_POST["department"]))	{$department=$_POST["department"];}
if (isset($_GET["job_title"]))			{$job_title=$_GET["job_title"];}
	elseif (isset($_POST["job_title"]))	{$job_title=$_POST["job_title"];}
if (isset($_GET["location"]))			{$location=$_GET["location"];}
	elseif (isset($_POST["location"]))	{$location=$_POST["location"];}
if (isset($_GET["callback_hours_block"]))			{$callback_hours_block=$_GET["callback_hours_block"];}
	elseif (isset($_POST["callback_hours_block"]))	{$callback_hours_block=$_POST["callback_hours_block"];}
if (isset($_GET["callback_list_calltime"]))				{$callback_list_calltime=$_GET["callback_list_calltime"];}
	elseif (isset($_POST["callback_list_calltime"]))	{$callback_list_calltime=$_POST["callback_list_calltime"];}
if (isset($_GET["modify_same_user_level"]))				{$modify_same_user_level=$_GET["modify_same_user_level"];}
	elseif (isset($_POST["modify_same_user_level"]))	{$modify_same_user_level=$_POST["modify_same_user_level"];}
if (isset($_GET["admin_hide_lead_data"]))			{$admin_hide_lead_data=$_GET["admin_hide_lead_data"];}
	elseif (isset($_POST["admin_hide_lead_data"]))	{$admin_hide_lead_data=$_POST["admin_hide_lead_data"];}
if (isset($_GET["admin_hide_phone_data"]))			{$admin_hide_phone_data=$_GET["admin_hide_phone_data"];}
	elseif (isset($_POST["admin_hide_phone_data"]))	{$admin_hide_phone_data=$_POST["admin_hide_phone_data"];}
if (isset($_GET["admin_viewable_groups"]))			{$admin_viewable_groups=$_GET["admin_viewable_groups"];}
	elseif (isset($_POST["admin_viewable_groups"]))	{$admin_viewable_groups=$_POST["admin_viewable_groups"];}
if (isset($_GET["admin_viewable_call_times"]))			{$admin_viewable_call_times=$_GET["admin_viewable_call_times"];}
	elseif (isset($_POST["admin_viewable_call_times"]))	{$admin_viewable_call_times=$_POST["admin_viewable_call_times"];}
if (isset($_GET["max_calls_method"]))			{$max_calls_method=$_GET["max_calls_method"];}
	elseif (isset($_POST["max_calls_method"]))	{$max_calls_method=$_POST["max_calls_method"];}
if (isset($_GET["max_calls_count"]))			{$max_calls_count=$_GET["max_calls_count"];}
	elseif (isset($_POST["max_calls_count"]))	{$max_calls_count=$_POST["max_calls_count"];}
if (isset($_GET["max_calls_action"]))			{$max_calls_action=$_GET["max_calls_action"];}
	elseif (isset($_POST["max_calls_action"]))	{$max_calls_action=$_POST["max_calls_action"];}
if (isset($_GET["territory_reset"]))			{$territory_reset=$_GET["territory_reset"];}
	elseif (isset($_POST["territory_reset"]))	{$territory_reset=$_POST["territory_reset"];}
if (isset($_GET["hopper_vlc_dup_check"]))			{$hopper_vlc_dup_check=$_GET["hopper_vlc_dup_check"];}
	elseif (isset($_POST["hopper_vlc_dup_check"]))	{$hopper_vlc_dup_check=$_POST["hopper_vlc_dup_check"];}
if (isset($_GET["download_max_system_stats_metric"]))			{$download_max_system_stats_metric=$_GET["download_max_system_stats_metric"];}
	elseif (isset($_POST["download_max_system_stats_metric"]))	{$download_max_system_stats_metric=$_POST["download_max_system_stats_metric"];}
if (isset($_GET["download_max_system_stats_metric_name"]))			{$download_max_system_stats_metric_name=$_GET["download_max_system_stats_metric_name"];}
	elseif (isset($_POST["download_max_system_stats_metric_name"]))	{$download_max_system_stats_metric_name=$_POST["download_max_system_stats_metric_name"];}
if (isset($_GET["inventory_report"]))			{$inventory_report=$_GET["inventory_report"];}
	elseif (isset($_POST["inventory_report"]))	{$inventory_report=$_POST["inventory_report"];}
if (isset($_GET["report_rank"]))			{$report_rank=$_GET["report_rank"];}
	elseif (isset($_POST["report_rank"]))	{$report_rank=$_POST["report_rank"];}
if (isset($_GET["in_group_dial"]))			{$in_group_dial=$_GET["in_group_dial"];}
	elseif (isset($_POST["in_group_dial"]))	{$in_group_dial=$_POST["in_group_dial"];}
if (isset($_GET["in_group_dial_select"]))			{$in_group_dial_select=$_GET["in_group_dial_select"];}
	elseif (isset($_POST["in_group_dial_select"]))	{$in_group_dial_select=$_POST["in_group_dial_select"];}
if (isset($_GET["dial_ingroup_cid"]))			{$dial_ingroup_cid=$_GET["dial_ingroup_cid"];}
	elseif (isset($_POST["dial_ingroup_cid"]))	{$dial_ingroup_cid=$_POST["dial_ingroup_cid"];}
if (isset($_GET["allow_emails"]))			{$allow_emails=$_GET["allow_emails"];}
	elseif (isset($_POST["allow_emails"]))	{$allow_emails=$_POST["allow_emails"];}
if (isset($_GET["allow_chats"]))			{$allow_chats=$_GET["allow_chats"];}
	elseif (isset($_POST["allow_chats"]))	{$allow_chats=$_POST["allow_chats"];}
if (isset($_GET["chat_url"]))			{$chat_url=$_GET["chat_url"];}
	elseif (isset($_POST["chat_url"]))	{$chat_url=$_POST["chat_url"];}
if (isset($_GET["chat_timeout"]))			{$chat_timeout=$_GET["chat_timeout"];}
	elseif (isset($_POST["chat_timeout"]))	{$chat_timeout=$_POST["chat_timeout"];}
if (isset($_GET["manager_chat_id"]))			{$manager_chat_id=$_GET["manager_chat_id"];}
	elseif (isset($_POST["manager_chat_id"]))	{$manager_chat_id=$_POST["manager_chat_id"];}
if (isset($_GET["group_handling"]))			{$group_handling=$_GET["group_handling"];}
	elseif (isset($_POST["group_handling"]))	{$group_handling=$_POST["group_handling"];}
if (isset($_GET["agentcall_email"]))			{$agentcall_email=$_GET["agentcall_email"];}
	elseif (isset($_POST["agentcall_email"]))	{$agentcall_email=$_POST["agentcall_email"];}
if (isset($_GET["agentcall_chat"]))			{$agentcall_chat=$_GET["agentcall_chat"];}
	elseif (isset($_POST["agentcall_chat"]))	{$agentcall_chat=$_POST["agentcall_chat"];}
if (isset($_GET["modify_email_accounts"]))			{$modify_email_accounts=$_GET["modify_email_accounts"];}
	elseif (isset($_POST["modify_email_accounts"]))	{$modify_email_accounts=$_POST["modify_email_accounts"];}
if (isset($_GET["safe_harbor_audio_field"]))			{$safe_harbor_audio_field=$_GET["safe_harbor_audio_field"];}
	elseif (isset($_POST["safe_harbor_audio_field"]))	{$safe_harbor_audio_field=$_POST["safe_harbor_audio_field"];}
if (isset($_GET["query_date"]))			{$query_date=$_GET["query_date"];}
	elseif (isset($_POST["query_date"]))	{$query_date=$_POST["query_date"];}
if (isset($_GET["end_date"]))			{$end_date=$_GET["end_date"];}
	elseif (isset($_POST["end_date"]))	{$end_date=$_POST["end_date"];}
if (isset($_GET["call_menu_qualify_enabled"]))			{$call_menu_qualify_enabled=$_GET["call_menu_qualify_enabled"];}
	elseif (isset($_POST["call_menu_qualify_enabled"]))	{$call_menu_qualify_enabled=$_POST["call_menu_qualify_enabled"];}
if (isset($_GET["qualify_sql"]))			{$qualify_sql=$_GET["qualify_sql"];}
	elseif (isset($_POST["qualify_sql"]))	{$qualify_sql=$_POST["qualify_sql"];}
if (isset($_GET["admin_list_counts"]))			{$admin_list_counts=$_GET["admin_list_counts"];}
	elseif (isset($_POST["admin_list_counts"]))	{$admin_list_counts=$_POST["admin_list_counts"];}
if (isset($_GET["voicemail_greeting"]))				{$voicemail_greeting=$_GET["voicemail_greeting"];}
	elseif (isset($_POST["voicemail_greeting"]))	{$voicemail_greeting=$_POST["voicemail_greeting"];}
if (isset($_GET["old_voicemail_greeting"]))				{$old_voicemail_greeting=$_GET["old_voicemail_greeting"];}
	elseif (isset($_POST["old_voicemail_greeting"]))	{$old_voicemail_greeting=$_POST["old_voicemail_greeting"];}
if (isset($_GET["allow_voicemail_greeting"]))			{$allow_voicemail_greeting=$_GET["allow_voicemail_greeting"];}
	elseif (isset($_POST["allow_voicemail_greeting"]))	{$allow_voicemail_greeting=$_POST["allow_voicemail_greeting"];}
if (isset($_GET["show_vm_on_summary"]))			{$show_vm_on_summary=$_GET["show_vm_on_summary"];}
	elseif (isset($_POST["show_vm_on_summary"]))	{$show_vm_on_summary=$_POST["show_vm_on_summary"];}
if (isset($_GET["pause_after_next_call"]))			{$pause_after_next_call=$_GET["pause_after_next_call"];}
	elseif (isset($_POST["pause_after_next_call"]))	{$pause_after_next_call=$_POST["pause_after_next_call"];}
if (isset($_GET["owner_populate"]))				{$owner_populate=$_GET["owner_populate"];}
	elseif (isset($_POST["owner_populate"]))	{$owner_populate=$_POST["owner_populate"];}
if (isset($_GET["queuemetrics_socket"]))			{$queuemetrics_socket=$_GET["queuemetrics_socket"];}
	elseif (isset($_POST["queuemetrics_socket"]))	{$queuemetrics_socket=$_POST["queuemetrics_socket"];}
if (isset($_GET["queuemetrics_socket_url"]))			{$queuemetrics_socket_url=$_GET["queuemetrics_socket_url"];}
	elseif (isset($_POST["queuemetrics_socket_url"]))	{$queuemetrics_socket_url=$_POST["queuemetrics_socket_url"];}
if (isset($_GET["holiday_id"]))					{$holiday_id=$_GET["holiday_id"];}
	elseif (isset($_POST["holiday_id"]))		{$holiday_id=$_POST["holiday_id"];}
if (isset($_GET["holiday_name"]))				{$holiday_name=$_GET["holiday_name"];}
	elseif (isset($_POST["holiday_name"]))		{$holiday_name=$_POST["holiday_name"];}
if (isset($_GET["holiday_comments"]))			{$holiday_comments=$_GET["holiday_comments"];}
	elseif (isset($_POST["holiday_comments"]))	{$holiday_comments=$_POST["holiday_comments"];}
if (isset($_GET["holiday_date"]))				{$holiday_date=$_GET["holiday_date"];}
	elseif (isset($_POST["holiday_date"]))		{$holiday_date=$_POST["holiday_date"];}
if (isset($_GET["holiday_status"]))				{$holiday_status=$_GET["holiday_status"];}
	elseif (isset($_POST["holiday_status"]))	{$holiday_status=$_POST["holiday_status"];}
if (isset($_GET["holiday_rule"]))				{$holiday_rule=$_GET["holiday_rule"];}
	elseif (isset($_POST["holiday_rule"]))		{$holiday_rule=$_POST["holiday_rule"];}
if (isset($_GET["expiration_date"]))			{$expiration_date=$_GET["expiration_date"];}
	elseif (isset($_POST["expiration_date"]))	{$expiration_date=$_POST["expiration_date"];}
if (isset($_GET["use_other_campaign_dnc"]))				{$use_other_campaign_dnc=$_GET["use_other_campaign_dnc"];}
	elseif (isset($_POST["use_other_campaign_dnc"]))	{$use_other_campaign_dnc=$_POST["use_other_campaign_dnc"];}
if (isset($_GET["enhanced_disconnect_logging"]))			{$enhanced_disconnect_logging=$_GET["enhanced_disconnect_logging"];}
	elseif (isset($_POST["enhanced_disconnect_logging"]))	{$enhanced_disconnect_logging=$_POST["enhanced_disconnect_logging"];}
if (isset($_GET["amd_inbound_group"]))			{$amd_inbound_group=$_GET["amd_inbound_group"];}
	elseif (isset($_POST["amd_inbound_group"]))	{$amd_inbound_group=$_POST["amd_inbound_group"];}
if (isset($_GET["amd_callmenu"]))				{$amd_callmenu=$_GET["amd_callmenu"];}
	elseif (isset($_POST["amd_callmenu"]))		{$amd_callmenu=$_POST["amd_callmenu"];}
if (isset($_GET["level_8_disable_add"]))			{$level_8_disable_add=$_GET["level_8_disable_add"];}
	elseif (isset($_POST["level_8_disable_add"]))	{$level_8_disable_add=$_POST["level_8_disable_add"];}
if (isset($_GET["survey_wait_sec"]))			{$survey_wait_sec=$_GET["survey_wait_sec"];}
	elseif (isset($_POST["survey_wait_sec"]))	{$survey_wait_sec=$_POST["survey_wait_sec"];}
if (isset($_GET["queuemetrics_record_hold"]))			{$queuemetrics_record_hold=$_GET["queuemetrics_record_hold"];}
	elseif (isset($_POST["queuemetrics_record_hold"]))	{$queuemetrics_record_hold=$_POST["queuemetrics_record_hold"];}
if (isset($_GET["country_code_list_stats"]))			{$country_code_list_stats=$_GET["country_code_list_stats"];}
	elseif (isset($_POST["country_code_list_stats"]))	{$country_code_list_stats=$_POST["country_code_list_stats"];}
if (isset($_GET["manual_dial_lead_id"]))			{$manual_dial_lead_id=$_GET["manual_dial_lead_id"];}
	elseif (isset($_POST["manual_dial_lead_id"]))	{$manual_dial_lead_id=$_POST["manual_dial_lead_id"];}
if (isset($_GET["auto_restart_asterisk"]))			{$auto_restart_asterisk=$_GET["auto_restart_asterisk"];}
	elseif (isset($_POST["auto_restart_asterisk"]))	{$auto_restart_asterisk=$_POST["auto_restart_asterisk"];}
if (isset($_GET["asterisk_temp_no_restart"]))			{$asterisk_temp_no_restart=$_GET["asterisk_temp_no_restart"];}
	elseif (isset($_POST["asterisk_temp_no_restart"]))	{$asterisk_temp_no_restart=$_POST["asterisk_temp_no_restart"];}
if (isset($_GET["dead_max"]))					{$dead_max=$_GET["dead_max"];}
	elseif (isset($_POST["dead_max"]))			{$dead_max=$_POST["dead_max"];}
if (isset($_GET["dispo_max"]))					{$dispo_max=$_GET["dispo_max"];}
	elseif (isset($_POST["dispo_max"]))			{$dispo_max=$_POST["dispo_max"];}
if (isset($_GET["pause_max"]))					{$pause_max=$_GET["pause_max"];}
	elseif (isset($_POST["pause_max"]))			{$pause_max=$_POST["pause_max"];}
if (isset($_GET["dead_max_dispo"]))				{$dead_max_dispo=$_GET["dead_max_dispo"];}
	elseif (isset($_POST["dead_max_dispo"]))	{$dead_max_dispo=$_POST["dead_max_dispo"];}
if (isset($_GET["dispo_max_dispo"]))			{$dispo_max_dispo=$_GET["dispo_max_dispo"];}
	elseif (isset($_POST["dispo_max_dispo"]))	{$dispo_max_dispo=$_POST["dispo_max_dispo"];}
if (isset($_GET["voicemail_dump_exten_no_inst"]))			{$voicemail_dump_exten_no_inst=$_GET["voicemail_dump_exten_no_inst"];}
	elseif (isset($_POST["voicemail_dump_exten_no_inst"]))	{$voicemail_dump_exten_no_inst=$_POST["voicemail_dump_exten_no_inst"];}
if (isset($_GET["voicemail_instructions"]))				{$voicemail_instructions=$_GET["voicemail_instructions"];}
	elseif (isset($_POST["voicemail_instructions"]))	{$voicemail_instructions=$_POST["voicemail_instructions"];}
if (isset($_GET["alter_admin_interface_options"]))			{$alter_admin_interface_options=$_GET["alter_admin_interface_options"];}
	elseif (isset($_POST["alter_admin_interface_options"]))	{$alter_admin_interface_options=$_POST["alter_admin_interface_options"];}
if (isset($_GET["filter_dnc_campaign"]))			{$filter_dnc_campaign=$_GET["filter_dnc_campaign"];}
	elseif (isset($_POST["filter_dnc_campaign"]))	{$filter_dnc_campaign=$_POST["filter_dnc_campaign"];}
if (isset($_GET["filter_url_did_redirect"]))			{$filter_url_did_redirect=$_GET["filter_url_did_redirect"];}
	elseif (isset($_POST["filter_url_did_redirect"]))	{$filter_url_did_redirect=$_POST["filter_url_did_redirect"];}
if (isset($_GET["max_inbound_calls"]))			{$max_inbound_calls=$_GET["max_inbound_calls"];}
	elseif (isset($_POST["max_inbound_calls"]))	{$max_inbound_calls=$_POST["max_inbound_calls"];}
if (isset($_GET["manual_dial_search_checkbox"]))			{$manual_dial_search_checkbox=$_GET["manual_dial_search_checkbox"];}
	elseif (isset($_POST["manual_dial_search_checkbox"]))	{$manual_dial_search_checkbox=$_POST["manual_dial_search_checkbox"];}
if (isset($_GET["hide_call_log_info"]))				{$hide_call_log_info=$_GET["hide_call_log_info"];}
	elseif (isset($_POST["hide_call_log_info"]))	{$hide_call_log_info=$_POST["hide_call_log_info"];}
if (isset($_GET["modify_custom_dialplans"]))			{$modify_custom_dialplans=$_GET["modify_custom_dialplans"];}
	elseif (isset($_POST["modify_custom_dialplans"]))	{$modify_custom_dialplans=$_POST["modify_custom_dialplans"];}
if (isset($_GET["queuemetrics_pause_type"]))			{$queuemetrics_pause_type=$_GET["queuemetrics_pause_type"];}
	elseif (isset($_POST["queuemetrics_pause_type"]))	{$queuemetrics_pause_type=$_POST["queuemetrics_pause_type"];}
if (isset($_GET["frozen_server_call_clear"]))			{$frozen_server_call_clear=$_GET["frozen_server_call_clear"];}
	elseif (isset($_POST["frozen_server_call_clear"]))	{$frozen_server_call_clear=$_POST["frozen_server_call_clear"];}
if (isset($_GET["timer_alt_seconds"]))			{$timer_alt_seconds=$_GET["timer_alt_seconds"];}
	elseif (isset($_POST["timer_alt_seconds"]))	{$timer_alt_seconds=$_POST["timer_alt_seconds"];}
if (isset($_GET["wrapup_seconds_override"]))			{$wrapup_seconds_override=$_GET["wrapup_seconds_override"];}
	elseif (isset($_POST["wrapup_seconds_override"]))	{$wrapup_seconds_override=$_POST["wrapup_seconds_override"];}
if (isset($_GET["no_agent_ingroup_redirect"]))			{$no_agent_ingroup_redirect=$_GET["no_agent_ingroup_redirect"];}
	elseif (isset($_POST["no_agent_ingroup_redirect"]))	{$no_agent_ingroup_redirect=$_POST["no_agent_ingroup_redirect"];}
if (isset($_GET["no_agent_ingroup_id"]))			{$no_agent_ingroup_id=$_GET["no_agent_ingroup_id"];}
	elseif (isset($_POST["no_agent_ingroup_id"]))	{$no_agent_ingroup_id=$_POST["no_agent_ingroup_id"];}
if (isset($_GET["no_agent_ingroup_extension"]))			{$no_agent_ingroup_extension=$_GET["no_agent_ingroup_extension"];}
	elseif (isset($_POST["no_agent_ingroup_extension"]))	{$no_agent_ingroup_extension=$_POST["no_agent_ingroup_extension"];}
if (isset($_GET["pre_filter_phone_group_id"]))			{$pre_filter_phone_group_id=$_GET["pre_filter_phone_group_id"];}
	elseif (isset($_POST["pre_filter_phone_group_id"]))	{$pre_filter_phone_group_id=$_POST["pre_filter_phone_group_id"];}
if (isset($_GET["pre_filter_extension"]))			{$pre_filter_extension=$_GET["pre_filter_extension"];}
	elseif (isset($_POST["pre_filter_extension"]))	{$pre_filter_extension=$_POST["pre_filter_extension"];}
if (isset($_GET["wrapup_bypass"]))			{$wrapup_bypass=$_GET["wrapup_bypass"];}
	elseif (isset($_POST["wrapup_bypass"]))	{$wrapup_bypass=$_POST["wrapup_bypass"];}
if (isset($_GET["wrapup_after_hotkey"]))			{$wrapup_after_hotkey=$_GET["wrapup_after_hotkey"];}
	elseif (isset($_POST["wrapup_after_hotkey"]))	{$wrapup_after_hotkey=$_POST["wrapup_after_hotkey"];}
if (isset($_GET["callback_time_24hour"]))			{$callback_time_24hour=$_GET["callback_time_24hour"];}
	elseif (isset($_POST["callback_time_24hour"]))	{$callback_time_24hour=$_POST["callback_time_24hour"];}
if (isset($_GET["callback_active_limit"]))			{$callback_active_limit=$_GET["callback_active_limit"];}
	elseif (isset($_POST["callback_active_limit"]))	{$callback_active_limit=$_POST["callback_active_limit"];}
if (isset($_GET["callback_active_limit_override"]))				{$callback_active_limit_override=$_GET["callback_active_limit_override"];}
	elseif (isset($_POST["callback_active_limit_override"]))	{$callback_active_limit_override=$_POST["callback_active_limit_override"];}
if (isset($_GET["comments_all_tabs"]))			{$comments_all_tabs=$_GET["comments_all_tabs"];}
	elseif (isset($_POST["comments_all_tabs"]))	{$comments_all_tabs=$_POST["comments_all_tabs"];}
if (isset($_GET["comments_dispo_screen"]))			{$comments_dispo_screen=$_GET["comments_dispo_screen"];}
	elseif (isset($_POST["comments_dispo_screen"]))	{$comments_dispo_screen=$_POST["comments_dispo_screen"];}
if (isset($_GET["comments_callback_screen"]))			{$comments_callback_screen=$_GET["comments_callback_screen"];}
	elseif (isset($_POST["comments_callback_screen"]))	{$comments_callback_screen=$_POST["comments_callback_screen"];}
if (isset($_GET["qc_comment_history"]))				{$qc_comment_history=$_GET["qc_comment_history"];}
	elseif (isset($_POST["qc_comment_history"]))	{$qc_comment_history=$_POST["qc_comment_history"];}
if (isset($_GET["show_previous_callback"]))				{$show_previous_callback=$_GET["show_previous_callback"];}
	elseif (isset($_POST["show_previous_callback"]))	{$show_previous_callback=$_POST["show_previous_callback"];}
if (isset($_GET["clear_script"]))				{$clear_script=$_GET["clear_script"];}
	elseif (isset($_POST["clear_script"]))	{$clear_script=$_POST["clear_script"];}
if (isset($_GET["modify_languages"]))			{$modify_languages=$_GET["modify_languages"];}
	elseif (isset($_POST["modify_languages"]))	{$modify_languages=$_POST["modify_languages"];}
if (isset($_GET["enable_languages"]))			{$enable_languages=$_GET["enable_languages"];}
	elseif (isset($_POST["enable_languages"]))	{$enable_languages=$_POST["enable_languages"];}
if (isset($_GET["cpd_unknown_action"]))				{$cpd_unknown_action=$_GET["cpd_unknown_action"];}
	elseif (isset($_POST["cpd_unknown_action"]))	{$cpd_unknown_action=$_POST["cpd_unknown_action"];}
if (isset($_GET["selected_language"]))			{$selected_language=$_GET["selected_language"];}
	elseif (isset($_POST["selected_language"]))	{$selected_language=$_POST["selected_language"];}
if (isset($_GET["user_choose_language"]))			{$user_choose_language=$_GET["user_choose_language"];}
	elseif (isset($_POST["user_choose_language"]))	{$user_choose_language=$_POST["user_choose_language"];}
if (isset($_GET["language_method"]))			{$language_method=$_GET["language_method"];}
	elseif (isset($_POST["language_method"]))	{$language_method=$_POST["language_method"];}
if (isset($_GET["ignore_group_on_search"]))				{$ignore_group_on_search=$_GET["ignore_group_on_search"];}
	elseif (isset($_POST["ignore_group_on_search"]))	{$ignore_group_on_search=$_POST["ignore_group_on_search"];}
if (isset($_GET["manual_dial_search_filter"]))			{$manual_dial_search_filter=$_GET["manual_dial_search_filter"];}
	elseif (isset($_POST["manual_dial_search_filter"]))	{$manual_dial_search_filter=$_POST["manual_dial_search_filter"];}
if (isset($_GET["meetme_enter_login_filename"]))			{$meetme_enter_login_filename=$_GET["meetme_enter_login_filename"];}
	elseif (isset($_POST["meetme_enter_login_filename"]))	{$meetme_enter_login_filename=$_POST["meetme_enter_login_filename"];}
if (isset($_GET["meetme_enter_leave3way_filename"]))			{$meetme_enter_leave3way_filename=$_GET["meetme_enter_leave3way_filename"];}
	elseif (isset($_POST["meetme_enter_leave3way_filename"]))	{$meetme_enter_leave3way_filename=$_POST["meetme_enter_leave3way_filename"];}
if (isset($_GET["enable_did_entry_list_id"]))			{$enable_did_entry_list_id=$_GET["enable_did_entry_list_id"];}
	elseif (isset($_POST["enable_did_entry_list_id"]))	{$enable_did_entry_list_id=$_POST["enable_did_entry_list_id"];}
if (isset($_GET["entry_list_id"]))			{$entry_list_id=$_GET["entry_list_id"];}
	elseif (isset($_POST["entry_list_id"]))	{$entry_list_id=$_POST["entry_list_id"];}
if (isset($_GET["filter_entry_list_id"]))			{$filter_entry_list_id=$_GET["filter_entry_list_id"];}
	elseif (isset($_POST["filter_entry_list_id"]))	{$filter_entry_list_id=$_POST["filter_entry_list_id"];}
if (isset($_GET["allow_chats"]))			{$allow_chats=$_GET["allow_chats"];}
	elseif (isset($_POST["allow_chats"]))	{$allow_chats=$_POST["allow_chats"];}
if (isset($_GET["enable_third_webform"]))			{$enable_third_webform=$_GET["enable_third_webform"];}
	elseif (isset($_POST["enable_third_webform"]))	{$enable_third_webform=$_POST["enable_third_webform"];}
if (isset($_GET["web_form_address_three"]))			{$web_form_address_three=$_GET["web_form_address_three"];}
	elseif (isset($_POST["web_form_address_three"]))	{$web_form_address_three=$_POST["web_form_address_three"];}
if (isset($_GET["enable_international_dncs"]))			{$enable_international_dncs=$_GET["enable_international_dncs"];}
	elseif (isset($_POST["enable_international_dncs"]))	{$enable_international_dncs=$_POST["enable_international_dncs"];}
if (isset($_GET["api_list_restrict"]))			{$api_list_restrict=$_GET["api_list_restrict"];}
	elseif (isset($_POST["api_list_restrict"]))	{$api_list_restrict=$_POST["api_list_restrict"];}
if (isset($_GET["api_allowed_functions"]))			{$api_allowed_functions=$_GET["api_allowed_functions"];}
	elseif (isset($_POST["api_allowed_functions"]))	{$api_allowed_functions=$_POST["api_allowed_functions"];}
if (isset($_GET["manual_dial_override_field"]))			{$manual_dial_override_field=$_GET["manual_dial_override_field"];}
	elseif (isset($_POST["manual_dial_override_field"]))	{$manual_dial_override_field=$_POST["manual_dial_override_field"];}
if (isset($_GET["status_display_ingroup"]))			{$status_display_ingroup=$_GET["status_display_ingroup"];}
	elseif (isset($_POST["status_display_ingroup"]))	{$status_display_ingroup=$_POST["status_display_ingroup"];}
if (isset($_GET["populate_lead_ingroup"]))			{$populate_lead_ingroup=$_GET["populate_lead_ingroup"];}
	elseif (isset($_POST["populate_lead_ingroup"]))	{$populate_lead_ingroup=$_POST["populate_lead_ingroup"];}
if (isset($_GET["script_color"]))			{$script_color=$_GET["script_color"];}
	elseif (isset($_POST["script_color"]))	{$script_color=$_POST["script_color"];}
if (isset($_GET["customer_gone_seconds"]))			{$customer_gone_seconds=$_GET["customer_gone_seconds"];}
	elseif (isset($_POST["customer_gone_seconds"]))	{$customer_gone_seconds=$_POST["customer_gone_seconds"];}
if (isset($_GET["max_queue_ingroup_calls"]))			{$max_queue_ingroup_calls=$_GET["max_queue_ingroup_calls"];}
	elseif (isset($_POST["max_queue_ingroup_calls"]))	{$max_queue_ingroup_calls=$_POST["max_queue_ingroup_calls"];}
if (isset($_GET["max_queue_ingroup_id"]))			{$max_queue_ingroup_id=$_GET["max_queue_ingroup_id"];}
	elseif (isset($_POST["max_queue_ingroup_id"]))	{$max_queue_ingroup_id=$_POST["max_queue_ingroup_id"];}
if (isset($_GET["max_queue_ingroup_extension"]))			{$max_queue_ingroup_extension=$_GET["max_queue_ingroup_extension"];}
	elseif (isset($_POST["max_queue_ingroup_extension"]))	{$max_queue_ingroup_extension=$_POST["max_queue_ingroup_extension"];}
if (isset($_GET["agent_debug_logging"]))			{$agent_debug_logging=$_GET["agent_debug_logging"];}
	elseif (isset($_POST["agent_debug_logging"]))	{$agent_debug_logging=$_POST["agent_debug_logging"];}
if (isset($_GET["agent_display_fields"]))			{$agent_display_fields=$_GET["agent_display_fields"];}
	elseif (isset($_POST["agent_display_fields"]))	{$agent_display_fields=$_POST["agent_display_fields"];}
if (isset($_GET["default_language"]))			{$default_language=$_GET["default_language"];}
	elseif (isset($_POST["default_language"]))	{$default_language=$_POST["default_language"];}
if (isset($_GET["agent_whisper_enabled"]))			{$agent_whisper_enabled=$_GET["agent_whisper_enabled"];}
	elseif (isset($_POST["agent_whisper_enabled"]))	{$agent_whisper_enabled=$_POST["agent_whisper_enabled"];}
if (isset($_GET["drop_lead_reset"]))			{$drop_lead_reset=$_GET["drop_lead_reset"];}
	elseif (isset($_POST["drop_lead_reset"]))	{$drop_lead_reset=$_POST["drop_lead_reset"];}
if (isset($_GET["after_hours_lead_reset"]))				{$after_hours_lead_reset=$_GET["after_hours_lead_reset"];}
	elseif (isset($_POST["after_hours_lead_reset"]))	{$after_hours_lead_reset=$_POST["after_hours_lead_reset"];}
if (isset($_GET["nanq_lead_reset"]))			{$nanq_lead_reset=$_GET["nanq_lead_reset"];}
	elseif (isset($_POST["nanq_lead_reset"]))	{$nanq_lead_reset=$_POST["nanq_lead_reset"];}
if (isset($_GET["wait_time_lead_reset"]))			{$wait_time_lead_reset=$_GET["wait_time_lead_reset"];}
	elseif (isset($_POST["wait_time_lead_reset"]))	{$wait_time_lead_reset=$_POST["wait_time_lead_reset"];}
if (isset($_GET["hold_time_lead_reset"]))			{$hold_time_lead_reset=$_GET["hold_time_lead_reset"];}
	elseif (isset($_POST["hold_time_lead_reset"]))	{$hold_time_lead_reset=$_POST["hold_time_lead_reset"];}
if (isset($_GET["container_id"]))			{$container_id=$_GET["container_id"];}
	elseif (isset($_POST["container_id"]))	{$container_id=$_POST["container_id"];}
if (isset($_GET["container_notes"]))			{$container_notes=$_GET["container_notes"];}
	elseif (isset($_POST["container_notes"]))	{$container_notes=$_POST["container_notes"];}
if (isset($_GET["container_type"]))				{$container_type=$_GET["container_type"];}
	elseif (isset($_POST["container_type"]))	{$container_type=$_POST["container_type"];}
if (isset($_GET["container_entry"]))			{$container_entry=$_GET["container_entry"];}
	elseif (isset($_POST["container_entry"]))	{$container_entry=$_POST["container_entry"];}
if (isset($_GET["admin_cf_show_hidden"]))			{$admin_cf_show_hidden=$_GET["admin_cf_show_hidden"];}
	elseif (isset($_POST["admin_cf_show_hidden"]))	{$admin_cf_show_hidden=$_POST["admin_cf_show_hidden"];}
if (isset($_GET["user_hide_realtime_enabled"]))				{$user_hide_realtime_enabled=$_GET["user_hide_realtime_enabled"];}
	elseif (isset($_POST["user_hide_realtime_enabled"]))	{$user_hide_realtime_enabled=$_POST["user_hide_realtime_enabled"];}
if (isset($_GET["user_hide_realtime"]))				{$user_hide_realtime=$_GET["user_hide_realtime"];}
	elseif (isset($_POST["user_hide_realtime"]))	{$user_hide_realtime=$_POST["user_hide_realtime"];}
if (isset($_GET["did_carrier_description"]))			{$did_carrier_description=$_GET["did_carrier_description"];}
	elseif (isset($_POST["did_carrier_description"]))	{$did_carrier_description=$_POST["did_carrier_description"];}
if (isset($_GET["status_group_id"]))			{$status_group_id=$_GET["status_group_id"];}
	elseif (isset($_POST["status_group_id"]))	{$status_group_id=$_POST["status_group_id"];}
if (isset($_GET["status_group_notes"]))				{$status_group_notes=$_GET["status_group_notes"];}
	elseif (isset($_POST["status_group_notes"]))	{$status_group_notes=$_POST["status_group_notes"];}
if (isset($_GET["min_sec"]))				{$min_sec=$_GET["min_sec"];}
	elseif (isset($_POST["min_sec"]))		{$min_sec=$_POST["min_sec"];}
if (isset($_GET["max_sec"]))				{$max_sec=$_GET["max_sec"];}
	elseif (isset($_POST["max_sec"]))		{$max_sec=$_POST["max_sec"];}
if (isset($_GET["usacan_phone_dialcode_fix"]))				{$usacan_phone_dialcode_fix=$_GET["usacan_phone_dialcode_fix"];}
	elseif (isset($_POST["usacan_phone_dialcode_fix"]))		{$usacan_phone_dialcode_fix=$_POST["usacan_phone_dialcode_fix"];}
if (isset($_GET["am_message_wildcards"]))				{$am_message_wildcards=$_GET["am_message_wildcards"];}
	elseif (isset($_POST["am_message_wildcards"]))		{$am_message_wildcards=$_POST["am_message_wildcards"];}
if (isset($_GET["cache_carrier_stats_realtime"]))				{$cache_carrier_stats_realtime=$_GET["cache_carrier_stats_realtime"];}
	elseif (isset($_POST["cache_carrier_stats_realtime"]))		{$cache_carrier_stats_realtime=$_POST["cache_carrier_stats_realtime"];}
if (isset($_GET["unavail_dialplan_fwd_exten"]))					{$unavail_dialplan_fwd_exten=$_GET["unavail_dialplan_fwd_exten"];}
	elseif (isset($_POST["unavail_dialplan_fwd_exten"]))		{$unavail_dialplan_fwd_exten=$_POST["unavail_dialplan_fwd_exten"];}
if (isset($_GET["unavail_dialplan_fwd_context"]))				{$unavail_dialplan_fwd_context=$_GET["unavail_dialplan_fwd_context"];}
	elseif (isset($_POST["unavail_dialplan_fwd_context"]))		{$unavail_dialplan_fwd_context=$_POST["unavail_dialplan_fwd_context"];}
if (isset($_GET["nva_call_url"]))				{$nva_call_url=$_GET["nva_call_url"];}
	elseif (isset($_POST["nva_call_url"]))		{$nva_call_url=$_POST["nva_call_url"];}
if (isset($_GET["nva_search_method"]))				{$nva_search_method=$_GET["nva_search_method"];}
	elseif (isset($_POST["nva_search_method"]))		{$nva_search_method=$_POST["nva_search_method"];}
if (isset($_GET["nva_error_filename"]))				{$nva_error_filename=$_GET["nva_error_filename"];}
	elseif (isset($_POST["nva_error_filename"]))	{$nva_error_filename=$_POST["nva_error_filename"];}
if (isset($_GET["nva_new_list_id"]))				{$nva_new_list_id=$_GET["nva_new_list_id"];}
	elseif (isset($_POST["nva_new_list_id"]))		{$nva_new_list_id=$_POST["nva_new_list_id"];}
if (isset($_GET["nva_new_phone_code"]))				{$nva_new_phone_code=$_GET["nva_new_phone_code"];}
	elseif (isset($_POST["nva_new_phone_code"]))	{$nva_new_phone_code=$_POST["nva_new_phone_code"];}
if (isset($_GET["nva_new_status"]))					{$nva_new_status=$_GET["nva_new_status"];}
	elseif (isset($_POST["nva_new_status"]))		{$nva_new_status=$_POST["nva_new_status"];}
if (isset($_GET["gather_asterisk_output"]))				{$gather_asterisk_output=$_GET["gather_asterisk_output"];}
	elseif (isset($_POST["gather_asterisk_output"]))	{$gather_asterisk_output=$_POST["gather_asterisk_output"];}
if (isset($_GET["manual_dial_timeout"]))			{$manual_dial_timeout=$_GET["manual_dial_timeout"];}
	elseif (isset($_POST["manual_dial_timeout"]))	{$manual_dial_timeout=$_POST["manual_dial_timeout"];}
if (isset($_GET["agent_allowed_chat_groups"]))			{$agent_allowed_chat_groups=$_GET["agent_allowed_chat_groups"];}
	elseif (isset($_POST["agent_allowed_chat_groups"]))	{$agent_allowed_chat_groups=$_POST["agent_allowed_chat_groups"];}
if (isset($_GET["routing_initiated_recordings"]))			{$routing_initiated_recordings=$_GET["routing_initiated_recordings"];}
	elseif (isset($_POST["routing_initiated_recordings"]))	{$routing_initiated_recordings=$_POST["routing_initiated_recordings"];}
if (isset($_GET["on_hook_cid_number"]))				{$on_hook_cid_number=$_GET["on_hook_cid_number"];}
	elseif (isset($_POST["on_hook_cid_number"]))	{$on_hook_cid_number=$_POST["on_hook_cid_number"];}
if (isset($_GET["manual_dial_hopper_check"]))			{$manual_dial_hopper_check=$_GET["manual_dial_hopper_check"];}
	elseif (isset($_POST["manual_dial_hopper_check"]))	{$manual_dial_hopper_check=$_POST["manual_dial_hopper_check"];}
if (isset($_GET["report_default_format"]))			{$report_default_format=$_GET["report_default_format"];}
	elseif (isset($_POST["report_default_format"]))	{$report_default_format=$_POST["report_default_format"];}
if (isset($_GET["alt_ivr_logging"]))				{$alt_ivr_logging=$_GET["alt_ivr_logging"];}
	elseif (isset($_POST["alt_ivr_logging"]))		{$alt_ivr_logging=$_POST["alt_ivr_logging"];}
if (isset($_GET["question"]))						{$question=$_GET["question"];}
	elseif (isset($_POST["question"]))				{$question=$_POST["question"];}
if (isset($_GET["alt_dtmf_log"]))					{$alt_dtmf_log=$_GET["alt_dtmf_log"];}
	elseif (isset($_POST["alt_dtmf_log"]))			{$alt_dtmf_log=$_POST["alt_dtmf_log"];}
if (isset($_GET["web_socket_url"]))					{$web_socket_url=$_GET["web_socket_url"];}
	elseif (isset($_POST["web_socket_url"]))		{$web_socket_url=$_POST["web_socket_url"];}
if (isset($_GET["webphone_dialbox"]))				{$webphone_dialbox=$_GET["webphone_dialbox"];}
	elseif (isset($_POST["webphone_dialbox"]))		{$webphone_dialbox=$_POST["webphone_dialbox"];}
if (isset($_GET["webphone_mute"]))					{$webphone_mute=$_GET["webphone_mute"];}
	elseif (isset($_POST["webphone_mute"]))			{$webphone_mute=$_POST["webphone_mute"];}
if (isset($_GET["webphone_volume"]))				{$webphone_volume=$_GET["webphone_volume"];}
	elseif (isset($_POST["webphone_volume"]))		{$webphone_volume=$_POST["webphone_volume"];}
if (isset($_GET["webphone_debug"]))					{$webphone_debug=$_GET["webphone_debug"];}
	elseif (isset($_POST["webphone_debug"]))		{$webphone_debug=$_POST["webphone_debug"];}
if (isset($_GET["callback_useronly_move_minutes"]))				{$callback_useronly_move_minutes=$_GET["callback_useronly_move_minutes"];}
	elseif (isset($_POST["callback_useronly_move_minutes"]))	{$callback_useronly_move_minutes=$_POST["callback_useronly_move_minutes"];}
if (isset($_GET["default_phone_code"]))				{$default_phone_code=$_GET["default_phone_code"];}
	elseif (isset($_POST["default_phone_code"]))	{$default_phone_code=$_POST["default_phone_code"];}
if (isset($_GET["admin_row_click"]))			{$admin_row_click=$_GET["admin_row_click"];}
	elseif (isset($_POST["admin_row_click"]))	{$admin_row_click=$_POST["admin_row_click"];}
if (isset($_GET["colors_id"]))			{$colors_id=$_GET["colors_id"];}
	elseif (isset($_POST["colors_id"]))	{$colors_id=$_POST["colors_id"];}
if (isset($_GET["colors_name"]))			{$colors_name=$_GET["colors_name"];}
	elseif (isset($_POST["colors_name"]))	{$colors_name=$_POST["colors_name"];}
if (isset($_GET["menu_background"]))			{$menu_background=$_GET["menu_background"];}
	elseif (isset($_POST["menu_background"]))	{$menu_background=$_POST["menu_background"];}
if (isset($_GET["frame_background"]))			{$frame_background=$_GET["frame_background"];}
	elseif (isset($_POST["frame_background"]))	{$frame_background=$_POST["frame_background"];}
if (isset($_GET["std_row1_background"]))			{$std_row1_background=$_GET["std_row1_background"];}
	elseif (isset($_POST["std_row1_background"]))	{$std_row1_background=$_POST["std_row1_background"];}
if (isset($_GET["std_row2_background"]))			{$std_row2_background=$_GET["std_row2_background"];}
	elseif (isset($_POST["std_row2_background"]))	{$std_row2_background=$_POST["std_row2_background"];}
if (isset($_GET["std_row3_background"]))			{$std_row3_background=$_GET["std_row3_background"];}
	elseif (isset($_POST["std_row3_background"]))	{$std_row3_background=$_POST["std_row3_background"];}
if (isset($_GET["std_row4_background"]))			{$std_row4_background=$_GET["std_row4_background"];}
	elseif (isset($_POST["std_row4_background"]))	{$std_row4_background=$_POST["std_row4_background"];}
if (isset($_GET["std_row5_background"]))			{$std_row5_background=$_GET["std_row5_background"];}
	elseif (isset($_POST["std_row5_background"]))	{$std_row5_background=$_POST["std_row5_background"];}
if (isset($_GET["alt_row1_background"]))			{$alt_row1_background=$_GET["alt_row1_background"];}
	elseif (isset($_POST["alt_row1_background"]))	{$alt_row1_background=$_POST["alt_row1_background"];}
if (isset($_GET["alt_row2_background"]))			{$alt_row2_background=$_GET["alt_row2_background"];}
	elseif (isset($_POST["alt_row2_background"]))	{$alt_row2_background=$_POST["alt_row2_background"];}
if (isset($_GET["alt_row3_background"]))			{$alt_row3_background=$_GET["alt_row3_background"];}
	elseif (isset($_POST["alt_row3_background"]))	{$alt_row3_background=$_POST["alt_row3_background"];}
if (isset($_GET["button_color"]))			{$button_color=$_GET["button_color"];}
	elseif (isset($_POST["button_color"]))	{$button_color=$_POST["button_color"];}
if (isset($_GET["modify_colors"]))			{$modify_colors=$_GET["modify_colors"];}
	elseif (isset($_POST["modify_colors"]))	{$modify_colors=$_POST["modify_colors"];}
if (isset($_GET["admin_screen_colors"]))			{$admin_screen_colors=$_GET["admin_screen_colors"];}
	elseif (isset($_POST["admin_screen_colors"]))	{$admin_screen_colors=$_POST["admin_screen_colors"];}
if (isset($_GET["web_logo"]))			{$web_logo=$_GET["web_logo"];}
	elseif (isset($_POST["web_logo"]))	{$web_logo=$_POST["web_logo"];}
if (isset($_GET["ofcom_uk_drop_calc"]))				{$ofcom_uk_drop_calc=$_GET["ofcom_uk_drop_calc"];}
	elseif (isset($_POST["ofcom_uk_drop_calc"]))	{$ofcom_uk_drop_calc=$_POST["ofcom_uk_drop_calc"];}
if (isset($_GET["answering_machine"]))				{$answering_machine=$_GET["answering_machine"];}
	elseif (isset($_POST["answering_machine"]))		{$answering_machine=$_POST["answering_machine"];}
if (isset($_GET["outbound_alt_cid"]))				{$outbound_alt_cid=$_GET["outbound_alt_cid"];}
	elseif (isset($_POST["outbound_alt_cid"]))		{$outbound_alt_cid=$_POST["outbound_alt_cid"];}
if (isset($_GET["agent_screen_colors"]))			{$agent_screen_colors=$_GET["agent_screen_colors"];}
	elseif (isset($_POST["agent_screen_colors"]))	{$agent_screen_colors=$_POST["agent_screen_colors"];}
if (isset($_GET["script_remove_js"]))			{$script_remove_js=$_GET["script_remove_js"];}
	elseif (isset($_POST["script_remove_js"]))	{$script_remove_js=$_POST["script_remove_js"];}
if (isset($_GET["user_nickname"]))			{$user_nickname=$_GET["user_nickname"];}
	elseif (isset($_POST["user_nickname"]))	{$user_nickname=$_POST["user_nickname"];}
if (isset($_GET["manual_auto_next"]))			{$manual_auto_next=$_GET["manual_auto_next"];}
	elseif (isset($_POST["manual_auto_next"]))	{$manual_auto_next=$_POST["manual_auto_next"];}
if (isset($_GET["manual_auto_show"]))			{$manual_auto_show=$_GET["manual_auto_show"];}
	elseif (isset($_POST["manual_auto_show"]))	{$manual_auto_show=$_POST["manual_auto_show"];}
if (isset($_GET["customer_chat_screen_colors"]))			{$customer_chat_screen_colors=$_GET["customer_chat_screen_colors"];}
	elseif (isset($_POST["customer_chat_screen_colors"]))	{$customer_chat_screen_colors=$_POST["customer_chat_screen_colors"];}
if (isset($_GET["customer_chat_survey_link"]))			{$customer_chat_survey_link=$_GET["customer_chat_survey_link"];}
	elseif (isset($_POST["customer_chat_survey_link"]))	{$customer_chat_survey_link=$_POST["customer_chat_survey_link"];}
if (isset($_GET["customer_chat_survey_text"]))			{$customer_chat_survey_text=$_GET["customer_chat_survey_text"];}
	elseif (isset($_POST["customer_chat_survey_text"]))	{$customer_chat_survey_text=$_POST["customer_chat_survey_text"];}
if (isset($_GET["user_new_lead_limit"]))			{$user_new_lead_limit=$_GET["user_new_lead_limit"];}
	elseif (isset($_POST["user_new_lead_limit"]))	{$user_new_lead_limit=$_POST["user_new_lead_limit"];}
if (isset($_GET["allow_required_fields"]))			{$allow_required_fields=$_GET["allow_required_fields"];}
	elseif (isset($_POST["allow_required_fields"]))	{$allow_required_fields=$_POST["allow_required_fields"];}
if (isset($_GET["agent_xfer_park_3way"]))			{$agent_xfer_park_3way=$_GET["agent_xfer_park_3way"];}
	elseif (isset($_POST["agent_xfer_park_3way"]))	{$agent_xfer_park_3way=$_POST["agent_xfer_park_3way"];}
if (isset($_GET["agent_soundboards"]))			{$agent_soundboards=$_GET["agent_soundboards"];}
	elseif (isset($_POST["agent_soundboards"]))	{$agent_soundboards=$_POST["agent_soundboards"];}
if (isset($_GET["web_loader_phone_length"]))			{$web_loader_phone_length=$_GET["web_loader_phone_length"];}
	elseif (isset($_POST["web_loader_phone_length"]))	{$web_loader_phone_length=$_POST["web_loader_phone_length"];}
if (isset($_GET["agent_script"]))				{$agent_script=$_GET["agent_script"];}
	elseif (isset($_POST["agent_script"]))		{$agent_script=$_POST["agent_script"];}
if (isset($_GET["agent_chat_screen_colors"]))			{$agent_chat_screen_colors=$_GET["agent_chat_screen_colors"];}
	elseif (isset($_POST["agent_chat_screen_colors"]))	{$agent_chat_screen_colors=$_POST["agent_chat_screen_colors"];}
if (isset($_GET["conf_qualify"]))			{$conf_qualify=$_GET["conf_qualify"];}
	elseif (isset($_POST["conf_qualify"]))	{$conf_qualify=$_POST["conf_qualify"];}
if (isset($_GET["populate_lead_province"]))				{$populate_lead_province=$_GET["populate_lead_province"];}
	elseif (isset($_POST["populate_lead_province"]))	{$populate_lead_province=$_POST["populate_lead_province"];}
if (isset($_GET["api_only_user"]))				{$api_only_user=$_GET["api_only_user"];}
	elseif (isset($_POST["api_only_user"]))		{$api_only_user=$_POST["api_only_user"];}
if (isset($_GET["dead_to_dispo"]))				{$dead_to_dispo=$_GET["dead_to_dispo"];}
	elseif (isset($_POST["dead_to_dispo"]))		{$dead_to_dispo=$_POST["dead_to_dispo"];}
if (isset($_GET["areacode_filter"]))				{$areacode_filter=$_GET["areacode_filter"];}
	elseif (isset($_POST["areacode_filter"]))		{$areacode_filter=$_POST["areacode_filter"];}
if (isset($_GET["areacode_filter_seconds"]))			{$areacode_filter_seconds=$_GET["areacode_filter_seconds"];}
	elseif (isset($_POST["areacode_filter_seconds"]))	{$areacode_filter_seconds=$_POST["areacode_filter_seconds"];}
if (isset($_GET["areacode_filter_action"]))				{$areacode_filter_action=$_GET["areacode_filter_action"];}
	elseif (isset($_POST["areacode_filter_action"]))	{$areacode_filter_action=$_POST["areacode_filter_action"];}
if (isset($_GET["areacode_list"]))			{$areacode_list=$_GET["areacode_list"];}
	elseif (isset($_POST["areacode_list"]))	{$areacode_list=$_POST["areacode_list"];}
if (isset($_GET["areacode_filter_action_value"]))			{$areacode_filter_action_value=$_GET["areacode_filter_action_value"];}
	elseif (isset($_POST["areacode_filter_action_value"]))	{$areacode_filter_action_value=$_POST["areacode_filter_action_value"];}
if (isset($_GET["enable_auto_reports"]))			{$enable_auto_reports=$_GET["enable_auto_reports"];}
	elseif (isset($_POST["enable_auto_reports"]))	{$enable_auto_reports=$_POST["enable_auto_reports"];}
if (isset($_GET["modify_auto_reports"]))			{$modify_auto_reports=$_GET["modify_auto_reports"];}
	elseif (isset($_POST["modify_auto_reports"]))	{$modify_auto_reports=$_POST["modify_auto_reports"];}
if (isset($_GET["report_id"]))			{$report_id=$_GET["report_id"];}
	elseif (isset($_POST["report_id"]))	{$report_id=$_POST["report_id"];}
if (isset($_GET["report_name"]))			{$report_name=$_GET["report_name"];}
	elseif (isset($_POST["report_name"]))	{$report_name=$_POST["report_name"];}
if (isset($_GET["report_server"]))			{$report_server=$_GET["report_server"];}
	elseif (isset($_POST["report_server"]))	{$report_server=$_POST["report_server"];}
if (isset($_GET["report_times"]))			{$report_times=$_GET["report_times"];}
	elseif (isset($_POST["report_times"]))	{$report_times=$_POST["report_times"];}
if (isset($_GET["report_weekdays"]))			{$report_weekdays=$_GET["report_weekdays"];}
	elseif (isset($_POST["report_weekdays"]))	{$report_weekdays=$_POST["report_weekdays"];}
if (isset($_GET["report_monthdays"]))			{$report_monthdays=$_GET["report_monthdays"];}
	elseif (isset($_POST["report_monthdays"]))	{$report_monthdays=$_POST["report_monthdays"];}
if (isset($_GET["report_destination"]))			{$report_destination=$_GET["report_destination"];}
	elseif (isset($_POST["report_destination"]))	{$report_destination=$_POST["report_destination"];}
if (isset($_GET["email_from"]))			{$email_from=$_GET["email_from"];}
	elseif (isset($_POST["email_from"]))	{$email_from=$_POST["email_from"];}
if (isset($_GET["email_to"]))			{$email_to=$_GET["email_to"];}
	elseif (isset($_POST["email_to"]))	{$email_to=$_POST["email_to"];}
if (isset($_GET["email_subject"]))			{$email_subject=$_GET["email_subject"];}
	elseif (isset($_POST["email_subject"]))	{$email_subject=$_POST["email_subject"];}
if (isset($_GET["ftp_server"]))				{$ftp_server=$_GET["ftp_server"];}
	elseif (isset($_POST["ftp_server"]))	{$ftp_server=$_POST["ftp_server"];}
if (isset($_GET["ftp_user"]))			{$ftp_user=$_GET["ftp_user"];}
	elseif (isset($_POST["ftp_user"]))	{$ftp_user=$_POST["ftp_user"];}
if (isset($_GET["ftp_pass"]))			{$ftp_pass=$_GET["ftp_pass"];}
	elseif (isset($_POST["ftp_pass"]))	{$ftp_pass=$_POST["ftp_pass"];}
if (isset($_GET["ftp_directory"]))			{$ftp_directory=$_GET["ftp_directory"];}
	elseif (isset($_POST["ftp_directory"]))	{$ftp_directory=$_POST["ftp_directory"];}
if (isset($_GET["report_url"]))				{$report_url=$_GET["report_url"];}
	elseif (isset($_POST["report_url"]))	{$report_url=$_POST["report_url"];}
if (isset($_GET["run_now_trigger"]))			{$run_now_trigger=$_GET["run_now_trigger"];}
	elseif (isset($_POST["run_now_trigger"]))	{$run_now_trigger=$_POST["run_now_trigger"];}
if (isset($_GET["agent_xfer_validation"]))			{$agent_xfer_validation=$_GET["agent_xfer_validation"];}
	elseif (isset($_POST["agent_xfer_validation"]))	{$agent_xfer_validation=$_POST["agent_xfer_validation"];}
if (isset($_GET["populate_state_areacode"]))			{$populate_state_areacode=$_GET["populate_state_areacode"];}
	elseif (isset($_POST["populate_state_areacode"]))	{$populate_state_areacode=$_POST["populate_state_areacode"];}
if (isset($_GET["enable_pause_code_limits"]))			{$enable_pause_code_limits=$_GET["enable_pause_code_limits"];}
	elseif (isset($_POST["enable_pause_code_limits"]))	{$enable_pause_code_limits=$_POST["enable_pause_code_limits"];}
if (isset($_GET["time_limit"]))				{$time_limit=$_GET["time_limit"];}
	elseif (isset($_POST["time_limit"]))	{$time_limit=$_POST["time_limit"];}
if (isset($_GET["enable_drop_lists"]))			{$enable_drop_lists=$_GET["enable_drop_lists"];}
	elseif (isset($_POST["enable_drop_lists"]))	{$enable_drop_lists=$_POST["enable_drop_lists"];}
if (isset($_GET["dl_id"]))			{$dl_id=$_GET["dl_id"];}
	elseif (isset($_POST["dl_id"]))	{$dl_id=$_POST["dl_id"];}
if (isset($_GET["dl_name"]))			{$dl_name=$_GET["dl_name"];}
	elseif (isset($_POST["dl_name"]))	{$dl_name=$_POST["dl_name"];}
if (isset($_GET["last_run"]))			{$last_run=$_GET["last_run"];}
	elseif (isset($_POST["last_run"]))	{$last_run=$_POST["last_run"];}
if (isset($_GET["dl_server"]))			{$dl_server=$_GET["dl_server"];}
	elseif (isset($_POST["dl_server"]))	{$dl_server=$_POST["dl_server"];}
if (isset($_GET["dl_times"]))			{$dl_times=$_GET["dl_times"];}
	elseif (isset($_POST["dl_times"]))	{$dl_times=$_POST["dl_times"];}
if (isset($_GET["dl_weekdays"]))			{$dl_weekdays=$_GET["dl_weekdays"];}
	elseif (isset($_POST["dl_weekdays"]))	{$dl_weekdays=$_POST["dl_weekdays"];}
if (isset($_GET["dl_monthdays"]))			{$dl_monthdays=$_GET["dl_monthdays"];}
	elseif (isset($_POST["dl_monthdays"]))	{$dl_monthdays=$_POST["dl_monthdays"];}
if (isset($_GET["drop_status"]))			{$drop_status=$_GET["drop_status"];}
	elseif (isset($_POST["drop_status"]))	{$drop_status=$_POST["drop_status"];}
if (isset($_GET["duplicate_check"]))			{$duplicate_check=$_GET["duplicate_check"];}
	elseif (isset($_POST["duplicate_check"]))	{$duplicate_check=$_POST["duplicate_check"];}
if (isset($_GET["allow_ip_lists"]))				{$allow_ip_lists=$_GET["allow_ip_lists"];}
	elseif (isset($_POST["allow_ip_lists"]))	{$allow_ip_lists=$_POST["allow_ip_lists"];}
if (isset($_GET["system_ip_blacklist"]))			{$system_ip_blacklist=$_GET["system_ip_blacklist"];}
	elseif (isset($_POST["system_ip_blacklist"]))	{$system_ip_blacklist=$_POST["system_ip_blacklist"];}
if (isset($_GET["modify_ip_lists"]))			{$modify_ip_lists=$_GET["modify_ip_lists"];}
	elseif (isset($_POST["modify_ip_lists"]))	{$modify_ip_lists=$_POST["modify_ip_lists"];}
if (isset($_GET["ignore_ip_list"]))			{$ignore_ip_list=$_GET["ignore_ip_list"];}
	elseif (isset($_POST["ignore_ip_list"]))	{$ignore_ip_list=$_POST["ignore_ip_list"];}
if (isset($_GET["admin_ip_list"]))			{$admin_ip_list=$_GET["admin_ip_list"];}
	elseif (isset($_POST["admin_ip_list"]))	{$admin_ip_list=$_POST["admin_ip_list"];}
if (isset($_GET["agent_ip_list"]))			{$agent_ip_list=$_GET["agent_ip_list"];}
	elseif (isset($_POST["agent_ip_list"]))	{$agent_ip_list=$_POST["agent_ip_list"];}
if (isset($_GET["api_ip_list"]))			{$api_ip_list=$_GET["api_ip_list"];}
	elseif (isset($_POST["api_ip_list"]))	{$api_ip_list=$_POST["api_ip_list"];}
if (isset($_GET["ip_list_id"]))			{$ip_list_id=$_GET["ip_list_id"];}
	elseif (isset($_POST["ip_list_id"]))	{$ip_list_id=$_POST["ip_list_id"];}
if (isset($_GET["ip_list_name"]))			{$ip_list_name=$_GET["ip_list_name"];}
	elseif (isset($_POST["ip_list_name"]))	{$ip_list_name=$_POST["ip_list_name"];}
if (isset($_GET["ip_address"]))				{$ip_address=$_GET["ip_address"];}
	elseif (isset($_POST["ip_address"]))	{$ip_address=$_POST["ip_address"];}
if (isset($_GET["dl_minutes"]))				{$dl_minutes=$_GET["dl_minutes"];}
	elseif (isset($_POST["dl_minutes"]))	{$dl_minutes=$_POST["dl_minutes"];}
if (isset($_GET["ready_max_logout"]))			{$ready_max_logout=$_GET["ready_max_logout"];}
	elseif (isset($_POST["ready_max_logout"]))	{$ready_max_logout=$_POST["ready_max_logout"];}
if (isset($_GET["routing_prefix"]))				{$routing_prefix=$_GET["routing_prefix"];}
	elseif (isset($_POST["routing_prefix"]))	{$routing_prefix=$_POST["routing_prefix"];}
if (isset($_GET["callback_display_days"]))			{$callback_display_days=$_GET["callback_display_days"];}
	elseif (isset($_POST["callback_display_days"]))	{$callback_display_days=$_POST["callback_display_days"];}
if (isset($_GET["three_way_record_stop"]))			{$three_way_record_stop=$_GET["three_way_record_stop"];}
	elseif (isset($_POST["three_way_record_stop"]))	{$three_way_record_stop=$_POST["three_way_record_stop"];}
if (isset($_GET["hangup_xfer_record_start"]))			{$hangup_xfer_record_start=$_GET["hangup_xfer_record_start"];}
	elseif (isset($_POST["hangup_xfer_record_start"]))	{$hangup_xfer_record_start=$_POST["hangup_xfer_record_start"];}
if (isset($_GET["agent_push_events"]))			{$agent_push_events=$_GET["agent_push_events"];}
	elseif (isset($_POST["agent_push_events"]))	{$agent_push_events=$_POST["agent_push_events"];}
if (isset($_GET["agent_push_url"]))				{$agent_push_url=$_GET["agent_push_url"];}
	elseif (isset($_POST["agent_push_url"]))	{$agent_push_url=$_POST["agent_push_url"];}
if (isset($_GET["hide_inactive_lists"]))			{$hide_inactive_lists=$_GET["hide_inactive_lists"];}
	elseif (isset($_POST["hide_inactive_lists"]))	{$hide_inactive_lists=$_POST["hide_inactive_lists"];}
if (isset($_GET["inbound_survey"]))			{$inbound_survey=$_GET["inbound_survey"];}
	elseif (isset($_POST["inbound_survey"]))	{$inbound_survey=$_POST["inbound_survey"];}
if (isset($_GET["inbound_survey_filename"]))			{$inbound_survey_filename=$_GET["inbound_survey_filename"];}
	elseif (isset($_POST["inbound_survey_filename"]))	{$inbound_survey_filename=$_POST["inbound_survey_filename"];}
if (isset($_GET["inbound_survey_accept_digit"]))			{$inbound_survey_accept_digit=$_GET["inbound_survey_accept_digit"];}
	elseif (isset($_POST["inbound_survey_accept_digit"]))	{$inbound_survey_accept_digit=$_POST["inbound_survey_accept_digit"];}
if (isset($_GET["inbound_survey_question_filename"]))			{$inbound_survey_question_filename=$_GET["inbound_survey_question_filename"];}
	elseif (isset($_POST["inbound_survey_question_filename"]))	{$inbound_survey_question_filename=$_POST["inbound_survey_question_filename"];}
if (isset($_GET["inbound_survey_callmenu"]))			{$inbound_survey_callmenu=$_GET["inbound_survey_callmenu"];}
	elseif (isset($_POST["inbound_survey_callmenu"]))	{$inbound_survey_callmenu=$_POST["inbound_survey_callmenu"];}
if (isset($_GET["allow_manage_active_lists"]))			{$allow_manage_active_lists=$_GET["allow_manage_active_lists"];}
	elseif (isset($_POST["allow_manage_active_lists"]))	{$allow_manage_active_lists=$_POST["allow_manage_active_lists"];}
if (isset($_GET["filename_override"]))			{$filename_override=$_GET["filename_override"];}
	elseif (isset($_POST["filename_override"]))	{$filename_override=$_POST["filename_override"];}
if (isset($_GET["expired_lists_inactive"]))				{$expired_lists_inactive=$_GET["expired_lists_inactive"];}
	elseif (isset($_POST["expired_lists_inactive"]))	{$expired_lists_inactive=$_POST["expired_lists_inactive"];}
if (isset($_GET["enable_gdpr_download_deletion"]))				{$enable_gdpr_download_deletion=$_GET["enable_gdpr_download_deletion"];}
	elseif (isset($_POST["enable_gdpr_download_deletion"]))	{$enable_gdpr_download_deletion=$_POST["enable_gdpr_download_deletion"];}
if (isset($_GET["did_system_filter"]))			{$did_system_filter=$_GET["did_system_filter"];}
	elseif (isset($_POST["did_system_filter"]))	{$did_system_filter=$_POST["did_system_filter"];}
if (isset($_GET["webphone_layout"]))			{$webphone_layout=$_GET["webphone_layout"];}
	elseif (isset($_POST["webphone_layout"]))	{$webphone_layout=$_POST["webphone_layout"];}
if (isset($_GET["max_inbound_calls_outcome"]))			{$max_inbound_calls_outcome=$_GET["max_inbound_calls_outcome"];}
	elseif (isset($_POST["max_inbound_calls_outcome"]))	{$max_inbound_calls_outcome=$_POST["max_inbound_calls_outcome"];}
if (isset($_GET["manual_auto_next_options"]))			{$manual_auto_next_options=$_GET["manual_auto_next_options"];}
	elseif (isset($_POST["manual_auto_next_options"]))	{$manual_auto_next_options=$_POST["manual_auto_next_options"];}
if (isset($_GET["agent_screen_time_display"]))			{$agent_screen_time_display=$_GET["agent_screen_time_display"];}
	elseif (isset($_POST["agent_screen_time_display"]))	{$agent_screen_time_display=$_POST["agent_screen_time_display"];}
if (isset($_GET["next_dial_my_callbacks"]))				{$next_dial_my_callbacks=$_GET["next_dial_my_callbacks"];}
	elseif (isset($_POST["next_dial_my_callbacks"]))	{$next_dial_my_callbacks=$_POST["next_dial_my_callbacks"];}
if (isset($_GET["anyone_callback_inactive_lists"]))				{$anyone_callback_inactive_lists=$_GET["anyone_callback_inactive_lists"];}
	elseif (isset($_POST["anyone_callback_inactive_lists"]))	{$anyone_callback_inactive_lists=$_POST["anyone_callback_inactive_lists"];}
if (isset($_GET["inbound_no_agents_no_dial_container"]))			{$inbound_no_agents_no_dial_container=$_GET["inbound_no_agents_no_dial_container"];}
	elseif (isset($_POST["inbound_no_agents_no_dial_container"]))	{$inbound_no_agents_no_dial_container=$_POST["inbound_no_agents_no_dial_container"];}
if (isset($_GET["inbound_no_agents_no_dial_threshold"]))			{$inbound_no_agents_no_dial_threshold=$_GET["inbound_no_agents_no_dial_threshold"];}
	elseif (isset($_POST["inbound_no_agents_no_dial_threshold"]))	{$inbound_no_agents_no_dial_threshold=$_POST["inbound_no_agents_no_dial_threshold"];}
if (isset($_GET["icbq_expiration_hours"]))			{$icbq_expiration_hours=$_GET["icbq_expiration_hours"];}
	elseif (isset($_POST["icbq_expiration_hours"]))	{$icbq_expiration_hours=$_POST["icbq_expiration_hours"];}
if (isset($_GET["closing_time_action"]))			{$closing_time_action=$_GET["closing_time_action"];}
	elseif (isset($_POST["closing_time_action"]))	{$closing_time_action=$_POST["closing_time_action"];}
if (isset($_GET["closing_time_now_trigger"]))			{$closing_time_now_trigger=$_GET["closing_time_now_trigger"];}
	elseif (isset($_POST["closing_time_now_trigger"]))	{$closing_time_now_trigger=$_POST["closing_time_now_trigger"];}
if (isset($_GET["closing_time_filename"]))			{$closing_time_filename=$_GET["closing_time_filename"];}
	elseif (isset($_POST["closing_time_filename"]))	{$closing_time_filename=$_POST["closing_time_filename"];}
if (isset($_GET["closing_time_end_filename"]))			{$closing_time_end_filename=$_GET["closing_time_end_filename"];}
	elseif (isset($_POST["closing_time_end_filename"]))	{$closing_time_end_filename=$_POST["closing_time_end_filename"];}
if (isset($_GET["closing_time_lead_reset"]))			{$closing_time_lead_reset=$_GET["closing_time_lead_reset"];}
	elseif (isset($_POST["closing_time_lead_reset"]))	{$closing_time_lead_reset=$_POST["closing_time_lead_reset"];}
if (isset($_GET["closing_time_option_exten"]))			{$closing_time_option_exten=$_GET["closing_time_option_exten"];}
	elseif (isset($_POST["closing_time_option_exten"]))	{$closing_time_option_exten=$_POST["closing_time_option_exten"];}
if (isset($_GET["closing_time_option_callmenu"]))			{$closing_time_option_callmenu=$_GET["closing_time_option_callmenu"];}
	elseif (isset($_POST["closing_time_option_callmenu"]))	{$closing_time_option_callmenu=$_POST["closing_time_option_callmenu"];}
if (isset($_GET["closing_time_option_voicemail"]))			{$closing_time_option_voicemail=$_GET["closing_time_option_voicemail"];}
	elseif (isset($_POST["closing_time_option_voicemail"]))	{$closing_time_option_voicemail=$_POST["closing_time_option_voicemail"];}
if (isset($_GET["closing_time_option_xfer_group"]))				{$closing_time_option_xfer_group=$_GET["closing_time_option_xfer_group"];}
	elseif (isset($_POST["closing_time_option_xfer_group"]))	{$closing_time_option_xfer_group=$_POST["closing_time_option_xfer_group"];}
if (isset($_GET["closing_time_option_callback_list_id"]))			{$closing_time_option_callback_list_id=$_GET["closing_time_option_callback_list_id"];}
	elseif (isset($_POST["closing_time_option_callback_list_id"]))	{$closing_time_option_callback_list_id=$_POST["closing_time_option_callback_list_id"];}
if (isset($_GET["icbq_call_time_id"]))			{$icbq_call_time_id=$_GET["icbq_call_time_id"];}
	elseif (isset($_POST["icbq_call_time_id"]))	{$icbq_call_time_id=$_POST["icbq_call_time_id"];}
if (isset($_GET["add_lead_timezone"]))			{$add_lead_timezone=$_GET["add_lead_timezone"];}
	elseif (isset($_POST["add_lead_timezone"]))	{$add_lead_timezone=$_POST["add_lead_timezone"];}
if (isset($_GET["icbq_dial_filter"]))			{$icbq_dial_filter=$_GET["icbq_dial_filter"];}
	elseif (isset($_POST["icbq_dial_filter"]))	{$icbq_dial_filter=$_POST["icbq_dial_filter"];}
if (isset($_GET["cid_group_id"]))			{$cid_group_id=$_GET["cid_group_id"];}
	elseif (isset($_POST["cid_group_id"]))	{$cid_group_id=$_POST["cid_group_id"];}
if (isset($_GET["cid_group_notes"]))			{$cid_group_notes=$_GET["cid_group_notes"];}
	elseif (isset($_POST["cid_group_notes"]))	{$cid_group_notes=$_POST["cid_group_notes"];}
if (isset($_GET["cid_group_type"]))				{$cid_group_type=$_GET["cid_group_type"];}
	elseif (isset($_POST["cid_group_type"]))	{$cid_group_type=$_POST["cid_group_type"];}
if (isset($_GET["pause_max_dispo"]))			{$pause_max_dispo=$_GET["pause_max_dispo"];}
	elseif (isset($_POST["pause_max_dispo"]))	{$pause_max_dispo=$_POST["pause_max_dispo"];}
if (isset($_GET["script_top_dispo"]))			{$script_top_dispo=$_GET["script_top_dispo"];}
	elseif (isset($_POST["script_top_dispo"]))	{$script_top_dispo=$_POST["script_top_dispo"];}
if (isset($_GET["source_id_display"]))			{$source_id_display=$_GET["source_id_display"];}
	elseif (isset($_POST["source_id_display"]))	{$source_id_display=$_POST["source_id_display"];}
if (isset($_GET["require_mgr_approval"]))			{$require_mgr_approval=$_GET["require_mgr_approval"];}
	elseif (isset($_POST["require_mgr_approval"]))	{$require_mgr_approval=$_POST["require_mgr_approval"];}
if (isset($_GET["pause_code_approval"]))			{$pause_code_approval=$_GET["pause_code_approval"];}
	elseif (isset($_POST["pause_code_approval"]))	{$pause_code_approval=$_POST["pause_code_approval"];}
if (isset($_GET["populate_lead_source"]))			{$populate_lead_source=$_GET["populate_lead_source"];}
	elseif (isset($_POST["populate_lead_source"]))	{$populate_lead_source=$_POST["populate_lead_source"];}
if (isset($_GET["populate_lead_vendor"]))			{$populate_lead_vendor=$_GET["populate_lead_vendor"];}
	elseif (isset($_POST["populate_lead_vendor"]))	{$populate_lead_vendor=$_POST["populate_lead_vendor"];}
if (isset($_GET["max_hopper_calls"]))			{$max_hopper_calls=$_GET["max_hopper_calls"];}
	elseif (isset($_POST["max_hopper_calls"]))	{$max_hopper_calls=$_POST["max_hopper_calls"];}
if (isset($_GET["max_hopper_calls_hour"]))			{$max_hopper_calls_hour=$_GET["max_hopper_calls_hour"];}
	elseif (isset($_POST["max_hopper_calls_hour"]))	{$max_hopper_calls_hour=$_POST["max_hopper_calls_hour"];}
if (isset($_GET["waiting_call_url_on"]))			{$waiting_call_url_on=$_GET["waiting_call_url_on"];}
	elseif (isset($_POST["waiting_call_url_on"]))	{$waiting_call_url_on=$_POST["waiting_call_url_on"];}
if (isset($_GET["waiting_call_url_off"]))			{$waiting_call_url_off=$_GET["waiting_call_url_off"];}
	elseif (isset($_POST["waiting_call_url_off"]))	{$waiting_call_url_off=$_POST["waiting_call_url_off"];}
if (isset($_GET["enter_ingroup_url"]))			{$enter_ingroup_url=$_GET["enter_ingroup_url"];}
	elseif (isset($_POST["enter_ingroup_url"]))	{$enter_ingroup_url=$_POST["enter_ingroup_url"];}
if (isset($_GET["dead_trigger_seconds"]))			{$dead_trigger_seconds=$_GET["dead_trigger_seconds"];}
	elseif (isset($_POST["dead_trigger_seconds"]))	{$dead_trigger_seconds=$_POST["dead_trigger_seconds"];}
if (isset($_GET["dead_trigger_action"]))			{$dead_trigger_action=$_GET["dead_trigger_action"];}
	elseif (isset($_POST["dead_trigger_action"]))	{$dead_trigger_action=$_POST["dead_trigger_action"];}
if (isset($_GET["dead_trigger_repeat"]))			{$dead_trigger_repeat=$_GET["dead_trigger_repeat"];}
	elseif (isset($_POST["dead_trigger_repeat"]))	{$dead_trigger_repeat=$_POST["dead_trigger_repeat"];}
if (isset($_GET["dead_trigger_filename"]))			{$dead_trigger_filename=$_GET["dead_trigger_filename"];}
	elseif (isset($_POST["dead_trigger_filename"]))	{$dead_trigger_filename=$_POST["dead_trigger_filename"];}
if (isset($_GET["dead_trigger_url"]))			{$dead_trigger_url=$_GET["dead_trigger_url"];}
	elseif (isset($_POST["dead_trigger_url"]))	{$dead_trigger_url=$_POST["dead_trigger_url"];}
if (isset($_GET["cid_cb_confirm_number"]))			{$cid_cb_confirm_number=$_GET["cid_cb_confirm_number"];}
	elseif (isset($_POST["cid_cb_confirm_number"]))	{$cid_cb_confirm_number=$_POST["cid_cb_confirm_number"];}
if (isset($_GET["cid_cb_invalid_filter_phone_group"]))			{$cid_cb_invalid_filter_phone_group=$_GET["cid_cb_invalid_filter_phone_group"];}
	elseif (isset($_POST["cid_cb_invalid_filter_phone_group"]))	{$cid_cb_invalid_filter_phone_group=$_POST["cid_cb_invalid_filter_phone_group"];}
if (isset($_GET["cid_cb_valid_length"]))			{$cid_cb_valid_length=$_GET["cid_cb_valid_length"];}
	elseif (isset($_POST["cid_cb_valid_length"]))	{$cid_cb_valid_length=$_POST["cid_cb_valid_length"];}
if (isset($_GET["cid_cb_valid_filename"]))			{$cid_cb_valid_filename=$_GET["cid_cb_valid_filename"];}
	elseif (isset($_POST["cid_cb_valid_filename"]))	{$cid_cb_valid_filename=$_POST["cid_cb_valid_filename"];}
if (isset($_GET["cid_cb_confirmed_filename"]))			{$cid_cb_confirmed_filename=$_GET["cid_cb_confirmed_filename"];}
	elseif (isset($_POST["cid_cb_confirmed_filename"]))	{$cid_cb_confirmed_filename=$_POST["cid_cb_confirmed_filename"];}
if (isset($_GET["cid_cb_enter_filename"]))			{$cid_cb_enter_filename=$_GET["cid_cb_enter_filename"];}
	elseif (isset($_POST["cid_cb_enter_filename"]))	{$cid_cb_enter_filename=$_POST["cid_cb_enter_filename"];}
if (isset($_GET["cid_cb_you_entered_filename"]))			{$cid_cb_you_entered_filename=$_GET["cid_cb_you_entered_filename"];}
	elseif (isset($_POST["cid_cb_you_entered_filename"]))	{$cid_cb_you_entered_filename=$_POST["cid_cb_you_entered_filename"];}
if (isset($_GET["cid_cb_press_to_confirm_filename"]))			{$cid_cb_press_to_confirm_filename=$_GET["cid_cb_press_to_confirm_filename"];}
	elseif (isset($_POST["cid_cb_press_to_confirm_filename"]))	{$cid_cb_press_to_confirm_filename=$_POST["cid_cb_press_to_confirm_filename"];}
if (isset($_GET["cid_cb_invalid_filename"]))			{$cid_cb_invalid_filename=$_GET["cid_cb_invalid_filename"];}
	elseif (isset($_POST["cid_cb_invalid_filename"]))	{$cid_cb_invalid_filename=$_POST["cid_cb_invalid_filename"];}
if (isset($_GET["cid_cb_reenter_filename"]))			{$cid_cb_reenter_filename=$_GET["cid_cb_reenter_filename"];}
	elseif (isset($_POST["cid_cb_reenter_filename"]))	{$cid_cb_reenter_filename=$_POST["cid_cb_reenter_filename"];}
if (isset($_GET["cid_cb_error_filename"]))			{$cid_cb_error_filename=$_GET["cid_cb_error_filename"];}
	elseif (isset($_POST["cid_cb_error_filename"]))	{$cid_cb_error_filename=$_POST["cid_cb_error_filename"];}
if (isset($_GET["agent_logout_link"]))			{$agent_logout_link=$_GET["agent_logout_link"];}
	elseif (isset($_POST["agent_logout_link"]))	{$agent_logout_link=$_POST["agent_logout_link"];}
if (isset($_GET["scheduled_callbacks_force_dial"]))				{$scheduled_callbacks_force_dial=$_GET["scheduled_callbacks_force_dial"];}
	elseif (isset($_POST["scheduled_callbacks_force_dial"]))	{$scheduled_callbacks_force_dial=$_POST["scheduled_callbacks_force_dial"];}
if (isset($_GET["scheduled_callbacks_auto_reschedule"]))			{$scheduled_callbacks_auto_reschedule=$_GET["scheduled_callbacks_auto_reschedule"];}
	elseif (isset($_POST["scheduled_callbacks_auto_reschedule"]))	{$scheduled_callbacks_auto_reschedule=$_POST["scheduled_callbacks_auto_reschedule"];}
if (isset($_GET["scheduled_callbacks_timezones_container"]))			{$scheduled_callbacks_timezones_container=$_GET["scheduled_callbacks_timezones_container"];}
	elseif (isset($_POST["scheduled_callbacks_timezones_container"]))	{$scheduled_callbacks_timezones_container=$_POST["scheduled_callbacks_timezones_container"];}
if (isset($_GET["daily_reset_limit"]))			{$daily_reset_limit=$_GET["daily_reset_limit"];}
	elseif (isset($_POST["daily_reset_limit"]))	{$daily_reset_limit=$_POST["daily_reset_limit"];}
if (isset($_GET["three_way_volume_buttons"]))			{$three_way_volume_buttons=$_GET["three_way_volume_buttons"];}
	elseif (isset($_POST["three_way_volume_buttons"]))	{$three_way_volume_buttons=$_POST["three_way_volume_buttons"];}
if (isset($_GET["callback_dnc"]))			{$callback_dnc=$_GET["callback_dnc"];}
	elseif (isset($_POST["callback_dnc"]))	{$callback_dnc=$_POST["callback_dnc"];}
if (isset($_GET["external_web_socket_url"]))			{$external_web_socket_url=$_GET["external_web_socket_url"];}
	elseif (isset($_POST["external_web_socket_url"]))	{$external_web_socket_url=$_POST["external_web_socket_url"];}
if (isset($_GET["manual_dial_validation"]))			{$manual_dial_validation=$_GET["manual_dial_validation"];}
	elseif (isset($_POST["manual_dial_validation"]))	{$manual_dial_validation=$_POST["manual_dial_validation"];}
if (isset($_GET["place_in_line_caller_number_filename"]))			{$place_in_line_caller_number_filename=$_GET["place_in_line_caller_number_filename"];}
	elseif (isset($_POST["place_in_line_caller_number_filename"]))	{$place_in_line_caller_number_filename=$_POST["place_in_line_caller_number_filename"];}
if (isset($_GET["place_in_line_you_next_filename"]))			{$place_in_line_you_next_filename=$_GET["place_in_line_you_next_filename"];}
	elseif (isset($_POST["place_in_line_you_next_filename"]))	{$place_in_line_you_next_filename=$_POST["place_in_line_you_next_filename"];}
if (isset($_GET["mute_recordings"]))			{$mute_recordings=$_GET["mute_recordings"];}
	elseif (isset($_POST["mute_recordings"]))	{$mute_recordings=$_POST["mute_recordings"];}
if (isset($_GET["user_admin_redirect"]))			{$user_admin_redirect=$_GET["user_admin_redirect"];}
	elseif (isset($_POST["user_admin_redirect"]))	{$user_admin_redirect=$_POST["user_admin_redirect"];}
if (isset($_GET["user_admin_redirect_url"]))			{$user_admin_redirect_url=$_GET["user_admin_redirect_url"];}
	elseif (isset($_POST["user_admin_redirect_url"]))	{$user_admin_redirect_url=$_POST["user_admin_redirect_url"];}
if (isset($_GET["sip_event_logging"]))			{$sip_event_logging=$_GET["sip_event_logging"];}
	elseif (isset($_POST["sip_event_logging"]))	{$sip_event_logging=$_POST["sip_event_logging"];}
if (isset($_GET["call_quota_lead_ranking"]))			{$call_quota_lead_ranking=$_GET["call_quota_lead_ranking"];}
	elseif (isset($_POST["call_quota_lead_ranking"]))	{$call_quota_lead_ranking=$_POST["call_quota_lead_ranking"];}
if (isset($_GET["auto_active_list_new"]))			{$auto_active_list_new=$_GET["auto_active_list_new"];}
	elseif (isset($_POST["auto_active_list_new"]))	{$auto_active_list_new=$_POST["auto_active_list_new"];}
if (isset($_GET["auto_active_list_rank"]))			{$auto_active_list_rank=$_GET["auto_active_list_rank"];}
	elseif (isset($_POST["auto_active_list_rank"]))	{$auto_active_list_rank=$_POST["auto_active_list_rank"];}
if (isset($_GET["max_inbound_filter_enabled"]))				{$max_inbound_filter_enabled=$_GET["max_inbound_filter_enabled"];}
	elseif (isset($_POST["max_inbound_filter_enabled"]))	{$max_inbound_filter_enabled=$_POST["max_inbound_filter_enabled"];}
if (isset($_GET["max_inbound_filter_statuses"]))			{$max_inbound_filter_statuses=$_GET["max_inbound_filter_statuses"];}
	elseif (isset($_POST["max_inbound_filter_statuses"]))	{$max_inbound_filter_statuses=$_POST["max_inbound_filter_statuses"];}
if (isset($_GET["max_inbound_filter_ingroups"]))			{$max_inbound_filter_ingroups=$_GET["max_inbound_filter_ingroups"];}
	elseif (isset($_POST["max_inbound_filter_ingroups"]))	{$max_inbound_filter_ingroups=$_POST["max_inbound_filter_ingroups"];}
if (isset($_GET["max_inbound_filter_min_sec"]))				{$max_inbound_filter_min_sec=$_GET["max_inbound_filter_min_sec"];}
	elseif (isset($_POST["max_inbound_filter_min_sec"]))	{$max_inbound_filter_min_sec=$_POST["max_inbound_filter_min_sec"];}
if (isset($_GET["enable_second_script"]))			{$enable_second_script=$_GET["enable_second_script"];}
	elseif (isset($_POST["enable_second_script"]))	{$enable_second_script=$_POST["enable_second_script"];}
if (isset($_GET["ingroup_script_two"]))				{$ingroup_script_two=$_GET["ingroup_script_two"];}
	elseif (isset($_POST["ingroup_script_two"]))	{$ingroup_script_two=$_POST["ingroup_script_two"];}
if (isset($_GET["campaign_script_two"]))			{$campaign_script_two=$_GET["campaign_script_two"];}
	elseif (isset($_POST["campaign_script_two"]))	{$campaign_script_two=$_POST["campaign_script_two"];}
if (isset($_GET["leave_vm_message_group_id"]))			{$leave_vm_message_group_id=$_GET["leave_vm_message_group_id"];}
	elseif (isset($_POST["leave_vm_message_group_id"]))	{$leave_vm_message_group_id=$_POST["leave_vm_message_group_id"];}
if (isset($_GET["leave_vm_message_group_notes"]))			{$leave_vm_message_group_notes=$_GET["leave_vm_message_group_notes"];}
	elseif (isset($_POST["leave_vm_message_group_notes"]))	{$leave_vm_message_group_notes=$_POST["leave_vm_message_group_notes"];}
if (isset($_GET["audio_filename"]))			{$audio_filename=$_GET["audio_filename"];}
	elseif (isset($_POST["audio_filename"]))	{$audio_filename=$_POST["audio_filename"];}
if (isset($_GET["audio_name"]))			{$audio_name=$_GET["audio_name"];}
	elseif (isset($_POST["audio_name"]))	{$audio_name=$_POST["audio_name"];}
if (isset($_GET["time_start"]))			{$time_start=$_GET["time_start"];}
	elseif (isset($_POST["time_start"]))	{$time_start=$_POST["time_start"];}
if (isset($_GET["time_end"]))			{$time_end=$_GET["time_end"];}
	elseif (isset($_POST["time_end"]))	{$time_end=$_POST["time_end"];}
if (isset($_GET["leave_vm_no_dispo"]))			{$leave_vm_no_dispo=$_GET["leave_vm_no_dispo"];}
	elseif (isset($_POST["leave_vm_no_dispo"]))	{$leave_vm_no_dispo=$_POST["leave_vm_no_dispo"];}
if (isset($_GET["leave_vm_message_group_id"]))			{$leave_vm_message_group_id=$_GET["leave_vm_message_group_id"];}
	elseif (isset($_POST["leave_vm_message_group_id"]))	{$leave_vm_message_group_id=$_POST["leave_vm_message_group_id"];}
if (isset($_GET["dial_timeout_lead_container"]))			{$dial_timeout_lead_container=$_GET["dial_timeout_lead_container"];}
	elseif (isset($_POST["dial_timeout_lead_container"]))	{$dial_timeout_lead_container=$_POST["dial_timeout_lead_container"];}
if (isset($_GET["amd_type"]))			{$amd_type=$_GET["amd_type"];}
	elseif (isset($_POST["amd_type"]))	{$amd_type=$_POST["amd_type"];}
if (isset($_GET["recording_buttons"]))			{$recording_buttons=$_GET["recording_buttons"];}
	elseif (isset($_POST["recording_buttons"]))	{$recording_buttons=$_POST["recording_buttons"];}
if (isset($_GET["enable_first_webform"]))			{$enable_first_webform=$_GET["enable_first_webform"];}
	elseif (isset($_POST["enable_first_webform"]))	{$enable_first_webform=$_POST["enable_first_webform"];}
if (isset($_GET["vmm_daily_limit"]))			{$vmm_daily_limit=$_GET["vmm_daily_limit"];}
	elseif (isset($_POST["vmm_daily_limit"]))	{$vmm_daily_limit=$_POST["vmm_daily_limit"];}
if (isset($_GET["cid_auto_rotate_minutes"]))			{$cid_auto_rotate_minutes=$_GET["cid_auto_rotate_minutes"];}
	elseif (isset($_POST["cid_auto_rotate_minutes"]))	{$cid_auto_rotate_minutes=$_POST["cid_auto_rotate_minutes"];}
if (isset($_GET["cid_auto_rotate_minimum"]))			{$cid_auto_rotate_minimum=$_GET["cid_auto_rotate_minimum"];}
	elseif (isset($_POST["cid_auto_rotate_minimum"]))	{$cid_auto_rotate_minimum=$_POST["cid_auto_rotate_minimum"];}
if (isset($_GET["opensips_cid_name"]))			{$opensips_cid_name=$_GET["opensips_cid_name"];}
	elseif (isset($_POST["opensips_cid_name"]))	{$opensips_cid_name=$_POST["opensips_cid_name"];}
if (isset($_GET["require_password_length"]))			{$require_password_length=$_GET["require_password_length"];}
	elseif (isset($_POST["require_password_length"]))	{$require_password_length=$_POST["require_password_length"];}
if (isset($_GET["amd_agent_route_options"]))			{$amd_agent_route_options=$_GET["amd_agent_route_options"];}
	elseif (isset($_POST["amd_agent_route_options"]))	{$amd_agent_route_options=$_POST["amd_agent_route_options"];}
if (isset($_GET["user_account_emails"]))			{$user_account_emails=$_GET["user_account_emails"];}
	elseif (isset($_POST["user_account_emails"]))	{$user_account_emails=$_POST["user_account_emails"];}
if (isset($_GET["outbound_cid_any"]))			{$outbound_cid_any=$_GET["outbound_cid_any"];}
	elseif (isset($_POST["outbound_cid_any"]))	{$outbound_cid_any=$_POST["outbound_cid_any"];}
if (isset($_GET["entries_per_page"]))			{$entries_per_page=$_GET["entries_per_page"];}
	elseif (isset($_POST["entries_per_page"]))	{$entries_per_page=$_POST["entries_per_page"];}
if (isset($_GET["start_count"]))			{$start_count=$_GET["start_count"];}
	elseif (isset($_POST["start_count"]))	{$start_count=$_POST["start_count"];}
if (isset($_GET["browser_call_alerts"]))			{$browser_call_alerts=$_GET["browser_call_alerts"];}
	elseif (isset($_POST["browser_call_alerts"]))	{$browser_call_alerts=$_POST["browser_call_alerts"];}
if (isset($_GET["browser_alert_sound"]))			{$browser_alert_sound=$_GET["browser_alert_sound"];}
	elseif (isset($_POST["browser_alert_sound"]))	{$browser_alert_sound=$_POST["browser_alert_sound"];}
if (isset($_GET["browser_alert_volume"]))			{$browser_alert_volume=$_GET["browser_alert_volume"];}
	elseif (isset($_POST["browser_alert_volume"]))	{$browser_alert_volume=$_POST["browser_alert_volume"];}
if (isset($_GET["three_way_record_stop_exception"]))			{$three_way_record_stop_exception=$_GET["three_way_record_stop_exception"];}
	elseif (isset($_POST["three_way_record_stop_exception"]))	{$three_way_record_stop_exception=$_POST["three_way_record_stop_exception"];}
if (isset($_GET["queuemetrics_pausereason"]))			{$queuemetrics_pausereason=$_GET["queuemetrics_pausereason"];}
	elseif (isset($_POST["queuemetrics_pausereason"]))	{$queuemetrics_pausereason=$_POST["queuemetrics_pausereason"];}
if (isset($_GET["inbound_answer_config"]))			{$inbound_answer_config=$_GET["inbound_answer_config"];}
	elseif (isset($_POST["inbound_answer_config"]))	{$inbound_answer_config=$_POST["inbound_answer_config"];}
if (isset($_GET["inbound_route_answer"]))			{$inbound_route_answer=$_GET["inbound_route_answer"];}
	elseif (isset($_POST["inbound_route_answer"]))	{$inbound_route_answer=$_POST["inbound_route_answer"];}
if (isset($_GET["answer_signal"]))			{$answer_signal=$_GET["answer_signal"];}
	elseif (isset($_POST["answer_signal"]))	{$answer_signal=$_POST["answer_signal"];}
if (isset($_GET["inbound_drop_voicemail"]))				{$inbound_drop_voicemail=$_GET["inbound_drop_voicemail"];}
	elseif (isset($_POST["inbound_drop_voicemail"]))	{$inbound_drop_voicemail=$_POST["inbound_drop_voicemail"];}
if (isset($_GET["inbound_after_hours_voicemail"]))			{$inbound_after_hours_voicemail=$_GET["inbound_after_hours_voicemail"];}
	elseif (isset($_POST["inbound_after_hours_voicemail"]))	{$inbound_after_hours_voicemail=$_POST["inbound_after_hours_voicemail"];}
if (isset($_GET["web_loader_phone_strip"]))				{$web_loader_phone_strip=$_GET["web_loader_phone_strip"];}
	elseif (isset($_POST["web_loader_phone_strip"]))	{$web_loader_phone_strip=$_POST["web_loader_phone_strip"];}
if (isset($_GET["manual_dial_phone_strip"]))			{$manual_dial_phone_strip=$_GET["manual_dial_phone_strip"];}
	elseif (isset($_POST["manual_dial_phone_strip"]))	{$manual_dial_phone_strip=$_POST["manual_dial_phone_strip"];}
if (isset($_GET["pause_max_exceptions"]))			{$pause_max_exceptions=$_GET["pause_max_exceptions"];}
	elseif (isset($_POST["pause_max_exceptions"]))	{$pause_max_exceptions=$_POST["pause_max_exceptions"];}
if (isset($_GET["no_agent_delay"]))				{$no_agent_delay=$_GET["no_agent_delay"];}
	elseif (isset($_POST["no_agent_delay"]))	{$no_agent_delay=$_POST["no_agent_delay"];}
if (isset($_GET["hopper_drop_run_trigger"]))			{$hopper_drop_run_trigger=$_GET["hopper_drop_run_trigger"];}
	elseif (isset($_POST["hopper_drop_run_trigger"]))	{$hopper_drop_run_trigger=$_POST["hopper_drop_run_trigger"];}
if (isset($_GET["hopper_drop_run_trigger_all"]))			{$hopper_drop_run_trigger_all=$_GET["hopper_drop_run_trigger_all"];}
	elseif (isset($_POST["hopper_drop_run_trigger_all"]))	{$hopper_drop_run_trigger_all=$_POST["hopper_drop_run_trigger_all"];}
if (isset($_GET["daily_call_count_limit"]))				{$daily_call_count_limit=$_GET["daily_call_count_limit"];}
	elseif (isset($_POST["daily_call_count_limit"]))	{$daily_call_count_limit=$_POST["daily_call_count_limit"];}
if (isset($_GET["daily_limit_manual"]))				{$daily_limit_manual=$_GET["daily_limit_manual"];}
	elseif (isset($_POST["daily_limit_manual"]))	{$daily_limit_manual=$_POST["daily_limit_manual"];}
if (isset($_GET["transfer_button_launch"]))				{$transfer_button_launch=$_GET["transfer_button_launch"];}
	elseif (isset($_POST["transfer_button_launch"]))	{$transfer_button_launch=$_POST["transfer_button_launch"];}
if (isset($_GET["allow_shared_dial"]))			{$allow_shared_dial=$_GET["allow_shared_dial"];}
	elseif (isset($_POST["allow_shared_dial"]))	{$allow_shared_dial=$_POST["allow_shared_dial"];}
if (isset($_GET["shared_dial_rank"]))			{$shared_dial_rank=$_GET["shared_dial_rank"];}
	elseif (isset($_POST["shared_dial_rank"]))	{$shared_dial_rank=$_POST["shared_dial_rank"];}
if (isset($_GET["mobile_number"]))			{$mobile_number=$_GET["mobile_number"];}
	elseif (isset($_POST["mobile_number"]))	{$mobile_number=$_POST["mobile_number"];}
if (isset($_GET["two_factor_auth_hours"]))			{$two_factor_auth_hours=$_GET["two_factor_auth_hours"];}
	elseif (isset($_POST["two_factor_auth_hours"]))	{$two_factor_auth_hours=$_POST["two_factor_auth_hours"];}
if (isset($_GET["two_factor_container"]))			{$two_factor_container=$_GET["two_factor_container"];}
	elseif (isset($_POST["two_factor_container"]))	{$two_factor_container=$_POST["two_factor_container"];}
if (isset($_GET["two_factor_override"]))			{$two_factor_override=$_GET["two_factor_override"];}
	elseif (isset($_POST["two_factor_override"]))	{$two_factor_override=$_POST["two_factor_override"];}
if (isset($_GET["auth_entry"]))				{$auth_entry=$_GET["auth_entry"];}
	elseif (isset($_POST["auth_entry"]))	{$auth_entry=$_POST["auth_entry"];}
if (isset($_GET["clear_form"]))				{$clear_form=$_GET["clear_form"];}
	elseif (isset($_POST["clear_form"]))	{$clear_form=$_POST["clear_form"];}
if (isset($_GET["agent_hidden_sound"]))				{$agent_hidden_sound=$_GET["agent_hidden_sound"];}
	elseif (isset($_POST["agent_hidden_sound"]))	{$agent_hidden_sound=$_POST["agent_hidden_sound"];}
if (isset($_GET["agent_hidden_sound_volume"]))			{$agent_hidden_sound_volume=$_GET["agent_hidden_sound_volume"];}
	elseif (isset($_POST["agent_hidden_sound_volume"]))	{$agent_hidden_sound_volume=$_POST["agent_hidden_sound_volume"];}
if (isset($_GET["agent_hidden_sound_seconds"]))				{$agent_hidden_sound_seconds=$_GET["agent_hidden_sound_seconds"];}
	elseif (isset($_POST["agent_hidden_sound_seconds"]))	{$agent_hidden_sound_seconds=$_POST["agent_hidden_sound_seconds"];}
if (isset($_GET["leave_3way_start_recording"]))				{$leave_3way_start_recording=$_GET["leave_3way_start_recording"];}
	elseif (isset($_POST["leave_3way_start_recording"]))	{$leave_3way_start_recording=$_POST["leave_3way_start_recording"];}
if (isset($_GET["leave_3way_start_recording_exception"]))			{$leave_3way_start_recording_exception=$_GET["leave_3way_start_recording_exception"];}
	elseif (isset($_POST["leave_3way_start_recording_exception"]))	{$leave_3way_start_recording_exception=$_POST["leave_3way_start_recording_exception"];}
if (isset($_GET["populate_lead_comments"]))				{$populate_lead_comments=$_GET["populate_lead_comments"];}
	elseif (isset($_POST["populate_lead_comments"]))	{$populate_lead_comments=$_POST["populate_lead_comments"];}
if (isset($_GET["agent_screen_timer"]))				{$agent_screen_timer=$_GET["agent_screen_timer"];}
	elseif (isset($_POST["agent_screen_timer"]))	{$agent_screen_timer=$_POST["agent_screen_timer"];}
if (isset($_GET["calls_waiting_vl_one"]))				{$calls_waiting_vl_one=$_GET["calls_waiting_vl_one"];}
	elseif (isset($_POST["calls_waiting_vl_one"]))	{$calls_waiting_vl_one=$_POST["calls_waiting_vl_one"];}
if (isset($_GET["calls_waiting_vl_two"]))				{$calls_waiting_vl_two=$_GET["calls_waiting_vl_two"];}
	elseif (isset($_POST["calls_waiting_vl_two"]))	{$calls_waiting_vl_two=$_POST["calls_waiting_vl_two"];}
if (isset($_GET["label_lead_id"]))				{$label_lead_id=$_GET["label_lead_id"];}
	elseif (isset($_POST["label_lead_id"]))		{$label_lead_id=$_POST["label_lead_id"];}
if (isset($_GET["label_list_id"]))				{$label_list_id=$_GET["label_list_id"];}
	elseif (isset($_POST["label_list_id"]))		{$label_list_id=$_POST["label_list_id"];}
if (isset($_GET["label_entry_date"]))			{$label_entry_date=$_GET["label_entry_date"];}
	elseif (isset($_POST["label_entry_date"]))	{$label_entry_date=$_POST["label_entry_date"];}
if (isset($_GET["label_gmt_offset_now"]))			{$label_gmt_offset_now=$_GET["label_gmt_offset_now"];}
	elseif (isset($_POST["label_gmt_offset_now"]))	{$label_gmt_offset_now=$_POST["label_gmt_offset_now"];}
if (isset($_GET["label_source_id"]))				{$label_source_id=$_GET["label_source_id"];}
	elseif (isset($_POST["label_source_id"]))		{$label_source_id=$_POST["label_source_id"];}
if (isset($_GET["label_called_since_last_reset"]))			{$label_called_since_last_reset=$_GET["label_called_since_last_reset"];}
	elseif (isset($_POST["label_called_since_last_reset"]))	{$label_called_since_last_reset=$_POST["label_called_since_last_reset"];}
if (isset($_GET["label_status"]))			{$label_status=$_GET["label_status"];}
	elseif (isset($_POST["label_status"]))	{$label_status=$_POST["label_status"];}
if (isset($_GET["label_user"]))				{$label_user=$_GET["label_user"];}
	elseif (isset($_POST["label_user"]))	{$label_user=$_POST["label_user"];}
if (isset($_GET["label_date_of_birth"]))			{$label_date_of_birth=$_GET["label_date_of_birth"];}
	elseif (isset($_POST["label_date_of_birth"]))	{$label_date_of_birth=$_POST["label_date_of_birth"];}
if (isset($_GET["label_country_code"]))				{$label_country_code=$_GET["label_country_code"];}
	elseif (isset($_POST["label_country_code"]))	{$label_country_code=$_POST["label_country_code"];}
if (isset($_GET["label_last_local_call_time"]))				{$label_last_local_call_time=$_GET["label_last_local_call_time"];}
	elseif (isset($_POST["label_last_local_call_time"]))	{$label_last_local_call_time=$_POST["label_last_local_call_time"];}
if (isset($_GET["label_called_count"]))				{$label_called_count=$_GET["label_called_count"];}
	elseif (isset($_POST["label_called_count"]))	{$label_called_count=$_POST["label_called_count"];}
if (isset($_GET["label_rank"]))				{$label_rank=$_GET["label_rank"];}
	elseif (isset($_POST["label_rank"]))	{$label_rank=$_POST["label_rank"];}
if (isset($_GET["label_owner"]))			{$label_owner=$_GET["label_owner"];}
	elseif (isset($_POST["label_owner"]))	{$label_owner=$_POST["label_owner"];}
if (isset($_GET["label_entry_list_id"]))			{$label_entry_list_id=$_GET["label_entry_list_id"];}
	elseif (isset($_POST["label_entry_list_id"]))	{$label_entry_list_id=$_POST["label_entry_list_id"];}
if (isset($_GET["calls_inqueue_count_one"]))			{$calls_inqueue_count_one=$_GET["calls_inqueue_count_one"];}
	elseif (isset($_POST["calls_inqueue_count_one"]))	{$calls_inqueue_count_one=$_POST["calls_inqueue_count_one"];}
if (isset($_GET["calls_inqueue_count_two"]))			{$calls_inqueue_count_two=$_GET["calls_inqueue_count_two"];}
	elseif (isset($_POST["calls_inqueue_count_two"]))	{$calls_inqueue_count_two=$_POST["calls_inqueue_count_two"];}
if (isset($_GET["mohsuggest"]))				{$mohsuggest=$_GET["mohsuggest"];}
	elseif (isset($_POST["mohsuggest"]))	{$mohsuggest=$_POST["mohsuggest"];}
if (isset($_GET["drop_call_seconds_override"]))				{$drop_call_seconds_override=$_GET["drop_call_seconds_override"];}
	elseif (isset($_POST["drop_call_seconds_override"]))	{$drop_call_seconds_override=$_POST["drop_call_seconds_override"];}
if (isset($_GET["in_man_dial_next_ready_seconds"]))				{$in_man_dial_next_ready_seconds=$_GET["in_man_dial_next_ready_seconds"];}
	elseif (isset($_POST["in_man_dial_next_ready_seconds"]))	{$in_man_dial_next_ready_seconds=$_POST["in_man_dial_next_ready_seconds"];}
if (isset($_GET["in_man_dial_next_ready_seconds_override"]))			{$in_man_dial_next_ready_seconds_override=$_GET["in_man_dial_next_ready_seconds_override"];}
	elseif (isset($_POST["in_man_dial_next_ready_seconds_override"]))	{$in_man_dial_next_ready_seconds_override=$_POST["in_man_dial_next_ready_seconds_override"];}
if (isset($_GET["transfer_no_dispo"]))			{$transfer_no_dispo=$_GET["transfer_no_dispo"];}
	elseif (isset($_POST["transfer_no_dispo"]))	{$transfer_no_dispo=$_POST["transfer_no_dispo"];}
if (isset($_GET["call_limit_24hour_method"]))			{$call_limit_24hour_method=$_GET["call_limit_24hour_method"];}
	elseif (isset($_POST["call_limit_24hour_method"]))	{$call_limit_24hour_method=$_POST["call_limit_24hour_method"];}
if (isset($_GET["call_limit_24hour_scope"]))			{$call_limit_24hour_scope=$_GET["call_limit_24hour_scope"];}
	elseif (isset($_POST["call_limit_24hour_scope"]))	{$call_limit_24hour_scope=$_POST["call_limit_24hour_scope"];}
if (isset($_GET["call_limit_24hour"]))			{$call_limit_24hour=$_GET["call_limit_24hour"];}
	elseif (isset($_POST["call_limit_24hour"]))	{$call_limit_24hour=$_POST["call_limit_24hour"];}
if (isset($_GET["call_limit_24hour_override"]))			{$call_limit_24hour_override=$_GET["call_limit_24hour_override"];}
	elseif (isset($_POST["call_limit_24hour_override"]))	{$call_limit_24hour_override=$_POST["call_limit_24hour_override"];}
if (isset($_GET["cid_group_id_two"]))			{$cid_group_id_two=$_GET["cid_group_id_two"];}
	elseif (isset($_POST["cid_group_id_two"]))	{$cid_group_id_two=$_POST["cid_group_id_two"];}
if (isset($_GET["allowed_sip_stacks"]))				{$allowed_sip_stacks=$_GET["allowed_sip_stacks"];}
	elseif (isset($_POST["allowed_sip_stacks"]))	{$allowed_sip_stacks=$_POST["allowed_sip_stacks"];}
if (isset($_GET["populate_lead_owner"]))			{$populate_lead_owner=$_GET["populate_lead_owner"];}
	elseif (isset($_POST["populate_lead_owner"]))	{$populate_lead_owner=$_POST["populate_lead_owner"];}
if (isset($_GET["incall_tally_threshold_seconds"]))				{$incall_tally_threshold_seconds=$_GET["incall_tally_threshold_seconds"];}
	elseif (isset($_POST["incall_tally_threshold_seconds"]))	{$incall_tally_threshold_seconds=$_POST["incall_tally_threshold_seconds"];}
if (isset($_GET["in_queue_nanque"]))			{$in_queue_nanque=$_GET["in_queue_nanque"];}
	elseif (isset($_POST["in_queue_nanque"]))	{$in_queue_nanque=$_POST["in_queue_nanque"];}
if (isset($_GET["in_queue_nanque_exceptions"]))				{$in_queue_nanque_exceptions=$_GET["in_queue_nanque_exceptions"];}
	elseif (isset($_POST["in_queue_nanque_exceptions"]))	{$in_queue_nanque_exceptions=$_POST["in_queue_nanque_exceptions"];}
if (isset($_GET["user_location"]))			{$user_location=$_GET["user_location"];}
	elseif (isset($_POST["user_location"]))	{$user_location=$_POST["user_location"];}
if (isset($_GET["queue_group"]))			{$queue_group=$_GET["queue_group"];}
	elseif (isset($_POST["queue_group"]))	{$queue_group=$_POST["queue_group"];}
if (isset($_GET["queue_group_name"]))			{$queue_group_name=$_GET["queue_group_name"];}
	elseif (isset($_POST["queue_group_name"]))	{$queue_group_name=$_POST["queue_group_name"];}
if (isset($_GET["included_campaigns"]))				{$included_campaigns=$_GET["included_campaigns"];}
	elseif (isset($_POST["included_campaigns"]))	{$included_campaigns=$_POST["included_campaigns"];}
if (isset($_GET["included_inbound_groups"]))			{$included_inbound_groups=$_GET["included_inbound_groups"];}
	elseif (isset($_POST["included_inbound_groups"]))	{$included_inbound_groups=$_POST["included_inbound_groups"];}
if (isset($_GET["allowed_queue_groups"]))			{$allowed_queue_groups=$_GET["allowed_queue_groups"];}
	elseif (isset($_POST["allowed_queue_groups"]))	{$allowed_queue_groups=$_POST["allowed_queue_groups"];}
if (isset($_GET["reports_header_override"]))			{$reports_header_override=$_GET["reports_header_override"];}
	elseif (isset($_POST["reports_header_override"]))	{$reports_header_override=$_POST["reports_header_override"];}
if (isset($_GET["queue_groups"]))			{$queue_groups=$_GET["queue_groups"];}
	elseif (isset($_POST["queue_groups"]))	{$queue_groups=$_POST["queue_groups"];}
if (isset($_GET["auto_alt_threshold"]))				{$auto_alt_threshold=$_GET["auto_alt_threshold"];}
	elseif (isset($_POST["auto_alt_threshold"]))	{$auto_alt_threshold=$_POST["auto_alt_threshold"];}
if (isset($_GET["download_invalid_files"]))				{$download_invalid_files=$_GET["download_invalid_files"];}
	elseif (isset($_POST["download_invalid_files"]))	{$download_invalid_files=$_POST["download_invalid_files"];}
if (isset($_GET["pause_max_url"]))			{$pause_max_url=$_GET["pause_max_url"];}
	elseif (isset($_POST["pause_max_url"]))	{$pause_max_url=$_POST["pause_max_url"];}
if (isset($_GET["agent_hide_hangup"]))			{$agent_hide_hangup=$_GET["agent_hide_hangup"];}
	elseif (isset($_POST["agent_hide_hangup"]))	{$agent_hide_hangup=$_POST["agent_hide_hangup"];}
if (isset($_GET["allow_web_debug"]))			{$allow_web_debug=$_GET["allow_web_debug"];}
	elseif (isset($_POST["allow_web_debug"]))	{$allow_web_debug=$_POST["allow_web_debug"];}

$DB=preg_replace("/[^0-9a-zA-Z]/","",$DB);

if (isset($script_id)) {$script_id= mb_strtoupper($script_id,'utf-8');}
if (isset($lead_filter_id)) {$lead_filter_id = mb_strtoupper($lead_filter_id,'utf-8');}

if (strlen($dial_status) > 0) 
	{
	$ADD='28';
	$status = $dial_status;
	}


#############################################
##### START SYSTEM_SETTINGS LOOKUP #####
$stmt = "SELECT use_non_latin,enable_queuemetrics_logging,enable_vtiger_integration,qc_features_active,outbound_autodial_active,sounds_central_control_active,enable_second_webform,user_territories_active,custom_fields_enabled,admin_web_directory,webphone_url,first_login_trigger,hosted_settings,default_phone_registration_password,default_phone_login_password,default_server_password,test_campaign_calls,active_voicemail_server,voicemail_timezones,default_voicemail_timezone,default_local_gmt,campaign_cid_areacodes_enabled,pllb_grouping_limit,did_ra_extensions_enabled,expanded_list_stats,contacts_enabled,alt_log_server_ip,alt_log_dbname,alt_log_login,alt_log_pass,tables_use_alt_log_db,call_menu_qualify_enabled,admin_list_counts,allow_voicemail_greeting,svn_revision,allow_emails,level_8_disable_add,pass_key,pass_hash_enabled,disable_auto_dial,country_code_list_stats,frozen_server_call_clear,active_modules,allow_chats,enable_languages,language_method,meetme_enter_login_filename,meetme_enter_leave3way_filename,enable_did_entry_list_id,enable_third_webform,default_language,user_hide_realtime_enabled,log_recording_access,alt_ivr_logging,admin_row_click,admin_screen_colors,ofcom_uk_drop_calc,agent_screen_colors,script_remove_js,manual_auto_next,user_new_lead_limit,agent_xfer_park_3way,agent_soundboards,web_loader_phone_length,agent_script,enable_auto_reports,enable_pause_code_limits,enable_drop_lists,allow_ip_lists,system_ip_blacklist,hide_inactive_lists,allow_manage_active_lists,expired_lists_inactive,did_system_filter,enable_gdpr_download_deletion,mute_recordings,user_admin_redirect,list_status_modification_confirmation,sip_event_logging,call_quota_lead_ranking,enable_second_script,enable_first_webform,recording_buttons,opensips_cid_name,require_password_length,user_account_emails,outbound_cid_any,entries_per_page,browser_call_alerts,inbound_answer_config,enable_international_dncs,daily_call_count_limit,allow_shared_dial,agent_search_method,admin_home_url,qc_claim_limit,qc_expire_days,two_factor_auth_hours,two_factor_container,call_limit_24hour,allowed_sip_stacks,agent_hide_hangup,allow_web_debug FROM system_settings;";
$rslt=mysql_to_mysqli($stmt, $link);
#if ($DB) {echo "$stmt\n";}
$qm_conf_ct = mysqli_num_rows($rslt);
if ($qm_conf_ct > 0)
	{
	$row=mysqli_fetch_row($rslt);
	$non_latin =							$row[0];
	$SSenable_queuemetrics_logging =		$row[1];
	$SSenable_vtiger_integration =			$row[2];
	$SSqc_features_active =					$row[3];
	$SSoutbound_autodial_active =			$row[4];
	$SSsounds_central_control_active =		$row[5];
	$SSenable_second_webform =				$row[6];
	$SSuser_territories_active =			$row[7];
	$SScustom_fields_enabled =				$row[8];
	$SSadmin_web_directory =				$row[9];
	$SSwebphone_url =						$row[10];
	$SSfirst_login_trigger =				$row[11];
	$SShosted_settings =					$row[12];
	$SSdefault_phone_registration_password =$row[13];
	$SSdefault_phone_login_password =		$row[14];
	$SSdefault_server_password =			$row[15];
	$SStest_campaign_calls =				$row[16];
	$SSactive_voicemail_server =			$row[17];
	$SSvoicemail_timezones =				$row[18];
	$SSdefault_voicemail_timezone =			$row[19];
	$SSdefault_local_gmt =					$row[20];
	$SScampaign_cid_areacodes_enabled =		$row[21];
	$SSpllb_grouping_limit =				$row[22];
	$SSdid_ra_extensions_enabled =			$row[23];
	$SSexpanded_list_stats =				$row[24];
	$SScontacts_enabled =					$row[25];
	$SSalt_log_server_ip =					$row[26];
	$SSalt_log_dbname =						$row[27];
	$SSalt_log_login =						$row[28];
	$SSalt_log_pass =						$row[29];
	$SStables_use_alt_log_db =				$row[30];
	$SScall_menu_qualify_enabled =			$row[31];
	$SSadmin_list_counts =					$row[32];
	$SSallow_voicemail_greeting =			$row[33];
	$SSsvn_revision =						$row[34];
	$SSallow_emails =						$row[35];
	$SSlevel_8_disable_add =				$row[36];
	$SSpass_key =							$row[37];
	$SSpass_hash_enabled =					$row[38];
	$SSdisable_auto_dial =					$row[39];
	$SScountry_code_list_stats =			$row[40];
	$SSfrozen_server_call_clear =			$row[41];
	$SSactive_modules =						$row[42];
	$SSallow_chats =						$row[43];
	$SSenable_languages =					$row[44];
	$SSlanguage_method =					$row[45];
	$SSmeetme_enter_login_filename =		$row[46];
	$SSmeetme_enter_leave3way_filename =	$row[47];
	$SSenable_did_entry_list_id =			$row[48];
	$SSenable_third_webform =				$row[49];
	$SSdefault_language =					$row[50];
	$SSuser_hide_realtime_enabled =			$row[51];
	$SSlog_recording_access =				$row[52];
	$SSalt_ivr_logging =					$row[53];
	$SSadmin_row_click =					$row[54];
	$SSadmin_screen_colors =				$row[55];
	$SSofcom_uk_drop_calc =					$row[56];
	$SSagent_screen_colors =				$row[57];
	$SSscript_remove_js =					$row[58];
	$SSmanual_auto_next =					$row[59];
	$SSuser_new_lead_limit =				$row[60];
	$SSagent_xfer_park_3way =				$row[61];
	$SSagent_soundboards =					$row[62];
	$SSweb_loader_phone_length =			$row[63];
	$SSagent_script =						$row[64];
	$SSenable_auto_reports =				$row[65];
	$SSenable_pause_code_limits =			$row[66];
	$SSenable_drop_lists =					$row[67];
	$SSallow_ip_lists =						$row[68];
	$SSsystem_ip_blacklist =				$row[69];
	$SShide_inactive_lists =				$row[70];
	$SSallow_manage_active_lists =			$row[71];
	$SSexpired_lists_inactive =				$row[72];
	$SSdid_system_filter =					$row[73];
	$SSenable_gdpr_download_deletion =		$row[74];
	$SSmute_recordings =					$row[75];
	$SSuser_admin_redirect =				$row[76];
	$SSlist_status_modification_confirmation =	$row[77];
	$SSsip_event_logging =					$row[78];
	$SScall_quota_lead_ranking =			$row[79];
	$SSenable_second_script =				$row[80];
	$SSenable_first_webform =				$row[81];
	$SSrecording_buttons =					$row[82];
	$SSopensips_cid_name =					$row[83];
	$SSrequire_password_length =			$row[84];
	$SSuser_account_emails =				$row[85];
	$SSoutbound_cid_any =					$row[86];
	$SSentries_per_page =					$row[87];
	$SSbrowser_call_alerts =				$row[88];
	$SSinbound_answer_config =				$row[89];
	$SSenable_international_dncs =			$row[90];
	$SSdaily_call_count_limit =				$row[91];
	$SSallow_shared_dial =					$row[92];
	$SSagent_search_method =				$row[93];
	$SSadmin_home_url =						$row[94];
	$SSqc_claim_limit =						$row[95];
	$SSqc_expire_days =						$row[96];
	$SStwo_factor_auth_hours =				$row[97];
	$SStwo_factor_container =				$row[98];
	$SScall_limit_24hour =					$row[99];
	$SSallowed_sip_stacks =					$row[100];
	$SSagent_hide_hangup =					$row[101];
	$SSallow_web_debug =					$row[102];
	}
if ($SSallow_web_debug < 1) {$DB=0;}
##### END SETTINGS LOOKUP #####
###########################################

### populate pass_key if not set
if ( ($qm_conf_ct > 0) and (strlen($SSpass_key)<16) )
	{
	$SSpass_key = '';
	$possible = "0123456789abcdefghijklmnpqrstvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ";  
	$i = 0; 
	$length = 16;
	while ($i < $length) 
		{ 
		$char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
		$SSpass_key .= $char;
		$i++;
		}
	$stmt="UPDATE system_settings set pass_key='$SSpass_key' where ( (pass_key is NULL) or (pass_key='') );";
	if ($DB) {echo "|$stmt|\n";}
	$rslt=mysql_to_mysqli($stmt, $link);
	}
if ($non_latin > 0)
	{
	if (!mysqli_set_charset($link,"utf8")) {printf("Error loading character set utf8: %s\n", mysqli_error());}
#	else {printf("Current character set: %s\n", mysqli_character_set_name($link));}
	$rslt=mysql_to_mysqli("SET NAMES 'UTF8'", $link);
	}

######################################################################################################
######################################################################################################
#######   Form variable filtering for security and data integrity
######################################################################################################
######################################################################################################

### DIGITS ONLY ###
$adaptive_latest_server_time = preg_replace('/[^0-9]/','',$adaptive_latest_server_time);
$admin_hangup_enabled = preg_replace('/[^0-9]/','',$admin_hangup_enabled);
$admin_hijack_enabled = preg_replace('/[^0-9]/','',$admin_hijack_enabled);
$admin_monitor_enabled = preg_replace('/[^0-9]/','',$admin_monitor_enabled);
$AFLogging_enabled = preg_replace('/[^0-9]/','',$AFLogging_enabled);
$agent_choose_ingroups = preg_replace('/[^0-9]/','',$agent_choose_ingroups);
$agentcall_manual = preg_replace('/[^0-9]/','',$agentcall_manual);
$agentonly_callbacks = preg_replace('/[^0-9]/','',$agentonly_callbacks);
$AGI_call_logging_enabled = preg_replace('/[^0-9]/','',$AGI_call_logging_enabled);
$allcalls_delay = preg_replace('/[^0-9]/','',$allcalls_delay);
$alter_agent_interface_options = preg_replace('/[^0-9]/','',$alter_agent_interface_options);
$answer_transfer_agent = preg_replace('/[^0-9]/','',$answer_transfer_agent);
$ast_admin_access = preg_replace('/[^0-9]/','',$ast_admin_access);
$ast_delete_phones = preg_replace('/[^0-9]/','',$ast_delete_phones);
$attempt_delay = preg_replace('/[^0-9]/','',$attempt_delay);
$attempt_maximum = preg_replace('/[^0-9]/','',$attempt_maximum);
$auto_dial_next_number = preg_replace('/[^0-9]/','',$auto_dial_next_number);
$balance_trunks_offlimits = preg_replace('/[^0-9]/','',$balance_trunks_offlimits);
$call_parking_enabled = preg_replace('/[^0-9]/','',$call_parking_enabled);
$CallerID_popup_enabled = preg_replace('/[^0-9]/','',$CallerID_popup_enabled);
$campaign_detail = preg_replace('/[^0-9]/','',$campaign_detail);
$campaign_rec_exten = preg_replace('/[^0-9]/','',$campaign_rec_exten);
$campaign_vdad_exten = preg_replace('/[^0-9]/','',$campaign_vdad_exten);
$change_agent_campaign = preg_replace('/[^0-9]/','',$change_agent_campaign);
$closer_default_blended = preg_replace('/[^0-9]/','',$closer_default_blended);
$conf_exten = preg_replace('/[^0-9]/','',$conf_exten);
$conf_on_extension = preg_replace('/[^0-9]/','',$conf_on_extension);
$conferencing_enabled = preg_replace('/[^0-9]/','',$conferencing_enabled);
$ct_default_start = preg_replace('/[^0-9]/','',$ct_default_start);
$ct_default_stop = preg_replace('/[^0-9]/','',$ct_default_stop);
$ct_friday_start = preg_replace('/[^0-9]/','',$ct_friday_start);
$ct_friday_stop = preg_replace('/[^0-9]/','',$ct_friday_stop);
$ct_monday_start = preg_replace('/[^0-9]/','',$ct_monday_start);
$ct_monday_stop = preg_replace('/[^0-9]/','',$ct_monday_stop);
$ct_saturday_start = preg_replace('/[^0-9]/','',$ct_saturday_start);
$ct_saturday_stop = preg_replace('/[^0-9]/','',$ct_saturday_stop);
$ct_sunday_start = preg_replace('/[^0-9]/','',$ct_sunday_start);
$ct_sunday_stop = preg_replace('/[^0-9]/','',$ct_sunday_stop);
$ct_thursday_start = preg_replace('/[^0-9]/','',$ct_thursday_start);
$ct_thursday_stop = preg_replace('/[^0-9]/','',$ct_thursday_stop);
$ct_tuesday_start = preg_replace('/[^0-9]/','',$ct_tuesday_start);
$ct_tuesday_stop = preg_replace('/[^0-9]/','',$ct_tuesday_stop);
$ct_wednesday_start = preg_replace('/[^0-9]/','',$ct_wednesday_start);
$ct_wednesday_stop = preg_replace('/[^0-9]/','',$ct_wednesday_stop);
$DBX_port = preg_replace('/[^0-9]/','',$DBX_port);
$DBY_port = preg_replace('/[^0-9]/','',$DBY_port);
$dedicated_trunks = preg_replace('/[^0-9]/','',$dedicated_trunks);
$delete_call_times = preg_replace('/[^0-9]/','',$delete_call_times);
$delete_campaigns = preg_replace('/[^0-9]/','',$delete_campaigns);
$delete_filters = preg_replace('/[^0-9]/','',$delete_filters);
$delete_ingroups = preg_replace('/[^0-9]/','',$delete_ingroups);
$delete_lists = preg_replace('/[^0-9]/','',$delete_lists);
$delete_remote_agents = preg_replace('/[^0-9]/','',$delete_remote_agents);
$delete_scripts = preg_replace('/[^0-9]/','',$delete_scripts);
$delete_user_groups = preg_replace('/[^0-9]/','',$delete_user_groups);
$delete_users = preg_replace('/[^0-9]/','',$delete_users);
$dial_timeout = preg_replace('/[^0-9]/','',$dial_timeout);
$dialplan_number = preg_replace('/[^0-9]/','',$dialplan_number);
$enable_fast_refresh = preg_replace('/[^0-9]/','',$enable_fast_refresh);
$enable_persistant_mysql = preg_replace('/[^0-9]/','',$enable_persistant_mysql);
$fast_refresh_rate = preg_replace('/[^0-9]/','',$fast_refresh_rate);
$hopper_level = preg_replace('/[^0-9]/','',$hopper_level);
$hotkey = preg_replace('/[^0-9]/','',$hotkey);
$hotkeys_active = preg_replace('/[^0-9]/','',$hotkeys_active);
$list_id = preg_replace('/[^0-9]/','',$list_id);
$load_leads = preg_replace('/[^0-9]/','',$load_leads);
$max_vicidial_trunks = preg_replace('/[^0-9]/','',$max_vicidial_trunks);
$modify_call_times = preg_replace('/[^0-9]/','',$modify_call_times);
$modify_users = preg_replace('/[^0-9]/','',$modify_users);
$modify_campaigns = preg_replace('/[^0-9]/','',$modify_campaigns);
$modify_lists = preg_replace('/[^0-9]/','',$modify_lists);
$modify_scripts = preg_replace('/[^0-9]/','',$modify_scripts);
$modify_filters = preg_replace('/[^0-9]/','',$modify_filters);
$modify_ingroups = preg_replace('/[^0-9]/','',$modify_ingroups);
$modify_usergroups = preg_replace('/[^0-9]/','',$modify_usergroups);
$modify_remoteagents = preg_replace('/[^0-9]/','',$modify_remoteagents);
$modify_servers = preg_replace('/[^0-9]/','',$modify_servers);
$view_reports = preg_replace('/[^0-9]/','',$view_reports);
$modify_leads = preg_replace('/[^0-9]/','',$modify_leads);
$export_gdpr_leads = preg_replace('/[^0-9]/','',$export_gdpr_leads);
$monitor_prefix = preg_replace('/[^0-9]/','',$monitor_prefix);
$new_dialplan_number = preg_replace('/[^0-9]/','',$new_dialplan_number);
$new_outbound_cid = preg_replace('/[^0-9]/','',$new_outbound_cid);
$number_of_lines = preg_replace('/[^0-9]/','',$number_of_lines);
$old_conf_exten = preg_replace('/[^0-9]/','',$old_conf_exten);
$outbound_cid = preg_replace('/[^0-9]/','',$outbound_cid);
$park_ext = preg_replace('/[^0-9]/','',$park_ext);
$park_on_extension = preg_replace('/[^0-9]/','',$park_on_extension);
$phone_number = preg_replace('/[^0-9]/','',$phone_number);
$QUEUE_ACTION_enabled = preg_replace('/[^0-9]/','',$QUEUE_ACTION_enabled);
$recording_exten = preg_replace('/[^0-9]/','',$recording_exten);
$remote_agent_id = preg_replace('/[^0-9]/','',$remote_agent_id);
$telnet_port = preg_replace('/[^0-9]/','',$telnet_port);
$updater_check_enabled = preg_replace('/[^0-9]/','',$updater_check_enabled);
$user_level = preg_replace('/[^0-9]/','',$user_level);
$user_switching_enabled = preg_replace('/[^0-9]/','',$user_switching_enabled);
$VDstop_rec_after_each_call = preg_replace('/[^0-9]/','',$VDstop_rec_after_each_call);
$VICIDIAL_park_on_extension = preg_replace('/[^0-9]/','',$VICIDIAL_park_on_extension);
$vicidial_recording = preg_replace('/[^0-9]/','',$vicidial_recording);
$vicidial_transfers = preg_replace('/[^0-9]/','',$vicidial_transfers);
$voicemail_button_enabled = preg_replace('/[^0-9]/','',$voicemail_button_enabled);
$voicemail_dump_exten = preg_replace('/[^0-9]/','',$voicemail_dump_exten);
$voicemail_dump_exten_no_inst = preg_replace('/[^0-9]/','',$voicemail_dump_exten_no_inst);
$voicemail_exten = preg_replace('/[^0-9]/','',$voicemail_exten);
$wrapup_seconds = preg_replace('/[^0-9]/','',$wrapup_seconds);
$use_non_latin = preg_replace('/[^0-9]/','',$use_non_latin);
$webroot_writable = preg_replace('/[^0-9]/','',$webroot_writable);
$enable_queuemetrics_logging = preg_replace('/[^0-9]/','',$enable_queuemetrics_logging);
$enable_sipsak_messages = preg_replace('/[^0-9]/','',$enable_sipsak_messages);
$allow_sipsak_messages = preg_replace('/[^0-9]/','',$allow_sipsak_messages);
$mix_container_item = preg_replace('/[^0-9]/','',$mix_container_item);
$prompt_interval = preg_replace('/[^0-9]/','',$prompt_interval);
$agent_alert_delay = preg_replace('/[^0-9]/','',$agent_alert_delay);
$manual_dial_list_id = preg_replace('/[^0-9]/','',$manual_dial_list_id);
$qc_user_level = preg_replace('/[^0-9]/','',$qc_user_level);
$qc_pass = preg_replace('/[^0-9]/','',$qc_pass);
$qc_finish = preg_replace('/[^0-9]/','',$qc_finish);
$qc_commit = preg_replace('/[^0-9]/','',$qc_commit);
$shift_start_time = preg_replace('/[^0-9]/','',$shift_start_time);
$timeclock_end_of_day = preg_replace('/[^0-9]/','',$timeclock_end_of_day);
$survey_xfer_exten = preg_replace('/[^0-9]/','',$survey_xfer_exten);
$add_timeclock_log = preg_replace('/[^0-9]/','',$add_timeclock_log);
$modify_timeclock_log = preg_replace('/[^0-9]/','',$modify_timeclock_log);
$delete_timeclock_log = preg_replace('/[^0-9]/','',$delete_timeclock_log);
$vdc_agent_api_access = preg_replace('/[^0-9]/','',$vdc_agent_api_access);
$vdc_agent_api_active = preg_replace('/[^0-9]/','',$vdc_agent_api_active);
$hold_time_option_seconds = preg_replace('/[^0-9]/','',$hold_time_option_seconds);
$hold_time_option_callback_list_id = preg_replace('/[^0-9]/','',$hold_time_option_callback_list_id);
$source_did = preg_replace('/[^0-9]/','',$source_did);
$modify_inbound_dids = preg_replace('/[^0-9]/','',$modify_inbound_dids);
$delete_inbound_dids = preg_replace('/[^0-9]/','',$delete_inbound_dids);
$answer_sec_pct_rt_stat_one = preg_replace('/[^0-9]/','',$answer_sec_pct_rt_stat_one);
$answer_sec_pct_rt_stat_two = preg_replace('/[^0-9]/','',$answer_sec_pct_rt_stat_two);
$enable_vtiger_integration = preg_replace('/[^0-9]/','',$enable_vtiger_integration);
$qc_features_active = preg_replace('/[^0-9]/','',$qc_features_active);
$outbound_autodial_active = preg_replace('/[^0-9]/','',$outbound_autodial_active);
$download_lists = preg_replace('/[^0-9]/','',$download_lists);
$caller_id_number = preg_replace('/[^0-9]/','',$caller_id_number);
$outbound_calls_per_second = preg_replace('/[^0-9]/','',$outbound_calls_per_second);
$manager_shift_enforcement_override = preg_replace('/[^0-9]/','',$manager_shift_enforcement_override);
$export_reports = preg_replace('/[^0-9]/','',$export_reports);
$delete_from_dnc = preg_replace('/[^0-9]/','',$delete_from_dnc);
$menu_timeout = preg_replace('/[^0-9]/','',$menu_timeout);
$menu_time_check = preg_replace('/[^0-9]/','',$menu_time_check);
$track_in_vdac = preg_replace('/[^0-9]/','',$track_in_vdac);
$menu_repeat = preg_replace('/[^0-9]/','',$menu_repeat);
$agentonly_callback_campaign_lock = preg_replace('/[^0-9]/','',$agentonly_callback_campaign_lock);
$sounds_central_control_active = preg_replace('/[^0-9]/','',$sounds_central_control_active);
$user_territories_active = preg_replace('/[^0-9]/','',$user_territories_active);
$vicidial_recording_limit = preg_replace('/[^0-9]/','',$vicidial_recording_limit);
$allow_custom_dialplan = preg_replace('/[^0-9]/','',$allow_custom_dialplan);
$phone_ring_timeout = preg_replace('/[^0-9]/','',$phone_ring_timeout);
$enable_tts_integration = preg_replace('/[^0-9]/','',$enable_tts_integration);
$allow_alerts = preg_replace('/[^0-9]/','',$allow_alerts);
$vicidial_balance_rank = preg_replace('/[^0-9]/','',$vicidial_balance_rank);
$rank = preg_replace('/[^0-9]/','',$rank);
$enable_second_webform = preg_replace('/[^0-9]/','',$enable_second_webform);
$campaign_cid_override = preg_replace('/[^0-9]/','',$campaign_cid_override);
$agent_choose_territories = preg_replace('/[^0-9]/','',$agent_choose_territories);
$timer_action_seconds = preg_replace('/[^0-9]/','',$timer_action_seconds);
$default_webphone = preg_replace('/[^0-9]/','',$default_webphone);
$default_external_server_ip = preg_replace('/[^0-9]/','',$default_external_server_ip);
$enable_agc_xfer_log = preg_replace('/[^0-9]/','',$enable_agc_xfer_log);
$enable_agc_dispo_log = preg_replace('/[^0-9]/','',$enable_agc_dispo_log);
$callcard_enabled = preg_replace('/[^0-9]/','',$callcard_enabled);
$callcard_admin = preg_replace('/[^0-9]/','',$callcard_admin);
$extension_id = preg_replace('/[^0-9]/','',$extension_id);
$agent_choose_blended = preg_replace('/[^0-9]/','',$agent_choose_blended);
$realtime_block_user_info = preg_replace('/[^0-9]/','',$realtime_block_user_info);
$codecs_with_template = preg_replace('/[^0-9]/','',$codecs_with_template);
$custom_fields_modify = preg_replace('/[^0-9]/','',$custom_fields_modify);
$hold_time_option_minimum = preg_replace('/[^0-9]/','',$hold_time_option_minimum);
$onhold_prompt_seconds = preg_replace('/[^0-9]/','',$onhold_prompt_seconds);
$hold_time_option_prompt_seconds = preg_replace('/[^0-9]/','',$hold_time_option_prompt_seconds);
$custom_fields_enabled = preg_replace('/[^0-9]/','',$custom_fields_enabled);
$wait_time_option_seconds = preg_replace('/[^0-9]/','',$wait_time_option_seconds);
$wait_time_option_callback_list_id = preg_replace('/[^0-9]/','',$wait_time_option_callback_list_id);
$wait_time_option_prompt_seconds = preg_replace('/[^0-9]/','',$wait_time_option_prompt_seconds);
$filter_list_id = preg_replace('/[^0-9]/','',$filter_list_id);
$calculate_estimated_hold_seconds = preg_replace('/[^0-9]/','',$calculate_estimated_hold_seconds);
$customer_3way_hangup_seconds = preg_replace('/[^0-9]/','',$customer_3way_hangup_seconds);
$eht_minimum_prompt_seconds = preg_replace('/[^0-9]/','',$eht_minimum_prompt_seconds);
$admin_modify_refresh = preg_replace('/[^0-9]/','',$admin_modify_refresh);
$nocache_admin = preg_replace('/[^0-9]/','',$nocache_admin);
$generate_cross_server_exten = preg_replace('/[^0-9]/','',$generate_cross_server_exten);
$queuemetrics_addmember_enabled = preg_replace('/[^0-9]/','',$queuemetrics_addmember_enabled);
$modify_page = preg_replace('/[^0-9]/','',$modify_page);
$on_hook_ring_time = preg_replace('/[^0-9]/','',$on_hook_ring_time);
$reload_dialplan_on_servers = preg_replace('/[^0-9]/','',$reload_dialplan_on_servers);
$available_only_tally_threshold_agents = preg_replace('/[^0-9]/','',$available_only_tally_threshold_agents);
$incall_tally_threshold_seconds = preg_replace('/[^0-9]/','',$incall_tally_threshold_seconds);
$dial_level_threshold_agents = preg_replace('/[^0-9]/','',$dial_level_threshold_agents);
$dtmf_log = preg_replace('/[^0-9]/','',$dtmf_log);
$callback_days_limit = preg_replace('/[^0-9]/','',$callback_days_limit);
$queuemetrics_pe_phone_append = preg_replace('/[^0-9]/','',$queuemetrics_pe_phone_append);
$test_campaign_calls = preg_replace('/[^0-9]/','',$test_campaign_calls);
$agents_calls_reset = preg_replace('/[^0-9]/','',$agents_calls_reset);
$campaign_cid_areacodes_enabled = preg_replace('/[^0-9]/','',$campaign_cid_areacodes_enabled);
$pllb_grouping_limit = preg_replace('/[^0-9]/','',$pllb_grouping_limit);
$did_ra_extensions_enabled = preg_replace('/[^0-9]/','',$did_ra_extensions_enabled);
$modify_shifts = preg_replace('/[^0-9]/','',$modify_shifts);
$modify_phones = preg_replace('/[^0-9]/','',$modify_phones);
$modify_carriers = preg_replace('/[^0-9]/','',$modify_carriers);
$modify_labels = preg_replace('/[^0-9]/','',$modify_labels);
$modify_colors = preg_replace('/[^0-9]/','',$modify_colors);
$modify_statuses = preg_replace('/[^0-9]/','',$modify_statuses);
$modify_voicemail = preg_replace('/[^0-9]/','',$modify_voicemail);
$modify_audiostore = preg_replace('/[^0-9]/','',$modify_audiostore);
$modify_moh = preg_replace('/[^0-9]/','',$modify_moh);
$modify_tts = preg_replace('/[^0-9]/','',$modify_tts);
$call_count_limit = preg_replace('/[^0-9]/','',$call_count_limit);
$call_count_target = preg_replace('/[^0-9]/','',$call_count_target);
$expanded_list_stats = preg_replace('/[^0-9]/','',$expanded_list_stats);
$contacts_enabled = preg_replace('/[^0-9]/','',$contacts_enabled);
$contact_id = preg_replace('/[^0-9]/','',$contact_id);
$office_num = preg_replace('/[^0-9]/','',$office_num);
$cell_num = preg_replace('/[^0-9]/','',$cell_num);
$other_num1 = preg_replace('/[^0-9]/','',$other_num1);
$other_num2 = preg_replace('/[^0-9]/','',$other_num2);
$modify_contacts = preg_replace('/[^0-9]/','',$modify_contacts);
$callback_hours_block = preg_replace('/[^0-9]/','',$callback_hours_block);
$modify_same_user_level = preg_replace('/[^0-9]/','',$modify_same_user_level);
$admin_hide_lead_data = preg_replace('/[^0-9]/','',$admin_hide_lead_data);
$max_calls_count = preg_replace('/[^0-9]/','',$max_calls_count);
$report_rank = preg_replace('/[^0-9]/','',$report_rank);
$dial_ingroup_cid = preg_replace('/[^0-9]/','',$dial_ingroup_cid);
$call_menu_qualify_enabled = preg_replace('/[^0-9]/','',$call_menu_qualify_enabled);
$admin_list_counts = preg_replace('/[^0-9]/','',$admin_list_counts);
$allow_voicemail_greeting = preg_replace('/[^0-9]/','',$allow_voicemail_greeting);
$enhanced_disconnect_logging = preg_replace('/[^0-9]/','',$enhanced_disconnect_logging);
$level_8_disable_add = preg_replace('/[^0-9]/','',$level_8_disable_add);
$survey_wait_sec = preg_replace('/[^0-9]/','',$survey_wait_sec);
$queuemetrics_record_hold = preg_replace('/[^0-9]/','',$queuemetrics_record_hold);
$country_code_list_stats = preg_replace('/[^0-9]/','',$country_code_list_stats);
$dead_max = preg_replace('/[^0-9]/','',$dead_max);
$dispo_max = preg_replace('/[^0-9]/','',$dispo_max);
$pause_max = preg_replace('/[^0-9]/','',$pause_max);
$alter_admin_interface_options = preg_replace('/[^0-9]/','',$alter_admin_interface_options);
$max_inbound_calls = preg_replace('/[^0-9]/','',$max_inbound_calls);
$modify_custom_dialplans = preg_replace('/[^0-9]/','',$modify_custom_dialplans);
$queuemetrics_pause_type = preg_replace('/[^0-9]/','',$queuemetrics_pause_type);
$frozen_server_call_clear = preg_replace('/[^0-9]/','',$frozen_server_call_clear);
$callback_time_24hour = preg_replace('/[^0-9]/','',$callback_time_24hour);
$callback_active_limit = preg_replace('/[^0-9]/','',$callback_active_limit);
$modify_languages = preg_replace('/[^0-9]/','',$modify_languages);
$enable_languages = preg_replace('/[^0-9]/','',$enable_languages);
$user_choose_language = preg_replace('/[^0-9]/','',$user_choose_language);
$ignore_group_on_search = preg_replace('/[^0-9]/','',$ignore_group_on_search);
$enable_did_entry_list_id = preg_replace('/[^0-9]/','',$enable_did_entry_list_id);
$entry_list_id = preg_replace('/[^0-9]/','',$entry_list_id);
$filter_entry_list_id = preg_replace('/[^0-9]/','',$filter_entry_list_id);
$enable_third_webform = preg_replace('/[^0-9]/','',$enable_third_webform);
$api_list_restrict = preg_replace('/[^0-9]/','',$api_list_restrict);
$customer_gone_seconds = preg_replace('/[^0-9]/','',$customer_gone_seconds);
$agent_whisper_enabled = preg_replace('/[^0-9]/','',$agent_whisper_enabled);
$admin_cf_show_hidden = preg_replace('/[^0-9]/','',$admin_cf_show_hidden);
$agentcall_chat = preg_replace('/[^0-9]/','',$agentcall_chat);
$user_hide_realtime_enabled = preg_replace('/[^0-9]/','',$user_hide_realtime_enabled);
$user_hide_realtime = preg_replace('/[^0-9]/','',$user_hide_realtime);
$min_sec = preg_replace('/[^0-9]/','',$min_sec);
$max_sec = preg_replace('/[^0-9]/','',$max_sec);
$usacan_phone_dialcode_fix = preg_replace('/[^0-9]/','',$usacan_phone_dialcode_fix);
$cache_carrier_stats_realtime = preg_replace('/[^0-9]/','',$cache_carrier_stats_realtime);
$nva_new_list_id = preg_replace('/[^0-9]/','',$nva_new_list_id);
$nva_new_phone_code = preg_replace('/[^0-9]/','',$nva_new_phone_code);
$manual_dial_timeout = preg_replace('/[^0-9]/','',$manual_dial_timeout);
$alt_ivr_logging = preg_replace('/[^0-9]/','',$alt_ivr_logging);
$question = preg_replace('/[^0-9]/','',$question);
$alt_dtmf_log = preg_replace('/[^0-9]/','',$alt_dtmf_log);
$callback_useronly_move_minutes = preg_replace('/[^0-9]/','',$callback_useronly_move_minutes);
$default_phone_code = preg_replace('/[^0-9]/','',$default_phone_code);
$admin_row_click = preg_replace('/[^0-9]/','',$admin_row_click);
$outbound_alt_cid = preg_replace('/[^0-9]/','',$outbound_alt_cid);
$script_remove_js = preg_replace('/[^0-9]/','',$script_remove_js);
$manual_auto_next = preg_replace('/[^0-9]/','',$manual_auto_next);
$agent_soundboards = preg_replace('/[^0-9]/','',$agent_soundboards);
$api_only_user = preg_replace('/[^0-9]/','',$api_only_user);
$areacode_filter_seconds = preg_replace('/[^0-9]/','',$areacode_filter_seconds);
$enable_auto_reports = preg_replace('/[^0-9]/','',$enable_auto_reports);
$modify_auto_reports = preg_replace('/[^0-9]/','',$modify_auto_reports);
$report_weekdays = preg_replace('/[^0-9]/','',$report_weekdays);
$enable_pause_code_limits = preg_replace('/[^0-9]/','',$enable_pause_code_limits);
$time_limit = preg_replace('/[^0-9]/','',$time_limit);
$enable_drop_lists = preg_replace('/[^0-9]/','',$enable_drop_lists);
$dl_weekdays = preg_replace('/[^0-9]/','',$dl_weekdays);
$allow_ip_lists = preg_replace('/[^0-9]/','',$allow_ip_lists);
$modify_ip_lists = preg_replace('/[^0-9]/','',$modify_ip_lists);
$ignore_ip_list = preg_replace('/[^0-9]/','',$ignore_ip_list);
$dl_minutes = preg_replace('/[^0-9]/','',$dl_minutes);
$callback_display_days = preg_replace('/[^0-9]/','',$callback_display_days);
$agent_push_events = preg_replace('/[^0-9]/','',$agent_push_events);
$hide_inactive_lists = preg_replace('/[^0-9]/','',$hide_inactive_lists);
$inbound_survey_accept_digit = preg_replace('/[^0-9]/','',$inbound_survey_accept_digit);
$allow_manage_active_lists = preg_replace('/[^0-9]/','',$allow_manage_active_lists);
$expired_lists_inactive = preg_replace('/[^0-9]/','',$expired_lists_inactive);
$enable_gdpr_download_deletion = preg_replace('/[^0-9]/','',$enable_gdpr_download_deletion);
$did_system_filter = preg_replace('/[^0-9]/','',$did_system_filter);
$icbq_expiration_hours = preg_replace('/[^0-9]/','',$icbq_expiration_hours);
$source_id_display = preg_replace('/[^0-9]/','',$source_id_display);
$pause_code_approval = preg_replace('/[^0-9]/','',$pause_code_approval);
$max_hopper_calls = preg_replace('/[^0-9]/','',$max_hopper_calls);
$max_hopper_calls_hour = preg_replace('/[^0-9]/','',$max_hopper_calls_hour);
$agent_logout_link = preg_replace('/[^0-9]/','',$agent_logout_link);
$user_admin_redirect = preg_replace('/[^0-9]/','',$user_admin_redirect);
$list_status_modification_confirmation = preg_replace('/[^0-9]/','',$list_status_modification_confirmation);
$max_inbound_filter_enabled = preg_replace('/[^0-9]/','',$max_inbound_filter_enabled);
$enable_second_script = preg_replace('/[^0-9]/','',$enable_second_script);
$time_start = preg_replace('/[^0-9]/','',$time_start);
$time_end = preg_replace('/[^0-9]/','',$time_end);
$enable_first_webform = preg_replace('/[^0-9]/','',$enable_first_webform);
$vmm_daily_limit = preg_replace('/[^0-9]/','',$vmm_daily_limit);
$cid_auto_rotate_minutes = preg_replace('/[^0-9]/','',$cid_auto_rotate_minutes);
$cid_auto_rotate_minimum = preg_replace('/[^0-9]/','',$cid_auto_rotate_minimum);
$require_password_length = preg_replace('/[^0-9]/','',$require_password_length);
$entries_per_page = preg_replace('/[^0-9]/','',$entries_per_page);
$start_count = preg_replace('/[^0-9]/','',$start_count);
$browser_call_alerts = preg_replace('/[^0-9]/','',$browser_call_alerts);
$browser_alert_volume = preg_replace('/[^0-9]/','',$browser_alert_volume);
$inbound_answer_config = preg_replace('/[^0-9]/','',$inbound_answer_config);
$enable_international_dncs = preg_replace('/[^0-9]/','',$enable_international_dncs);
$daily_call_count_limit = preg_replace('/[^0-9]/','',$daily_call_count_limit);
$allow_shared_dial = preg_replace('/[^0-9]/','',$allow_shared_dial);
$shared_dial_rank = preg_replace('/[^0-9]/','',$shared_dial_rank);
$qc_claim_limit = preg_replace('/[^0-9]/','',$qc_claim_limit);
$qc_expire_days = preg_replace('/[^0-9]/','',$qc_expire_days);
$auth_entry = preg_replace('/[^0-9]/','',$auth_entry);
$agent_hidden_sound_volume = preg_replace('/[^0-9]/','',$agent_hidden_sound_volume);
$agent_hidden_sound_seconds = preg_replace('/[^0-9]/','',$agent_hidden_sound_seconds);
$in_man_dial_next_ready_seconds = preg_replace('/[^0-9]/','',$in_man_dial_next_ready_seconds);
$call_limit_24hour = preg_replace('/[^0-9]/','',$call_limit_24hour);
$download_invalid_files = preg_replace('/[^0-9]/','',$download_invalid_files);
$modify_email_accounts = preg_replace('/[^0-9]/','',$modify_email_accounts);
$access_recordings = preg_replace('/[^0-9]/','',$access_recordings);
$agentcall_email = preg_replace('/[^0-9]/','',$agentcall_email);
$allow_web_debug = preg_replace('/[^0-9]/','',$allow_web_debug);
$force_logout = preg_replace('/[^0-9]/','',$force_logout);
$log_recording_access = preg_replace('/[^0-9]/','',$log_recording_access);
$dial_level_override = preg_replace('/[^0-9]/','',$dial_level_override);

$user_new_lead_limit = preg_replace('/[^-0-9]/','',$user_new_lead_limit);
$drop_call_seconds = preg_replace('/[^-0-9]/','',$drop_call_seconds);
$timer_alt_seconds = preg_replace('/[^-0-9]/','',$timer_alt_seconds);
$wrapup_seconds_override = preg_replace('/[^-0-9]/','',$wrapup_seconds_override);
$max_queue_ingroup_calls = preg_replace('/[^-0-9]/','',$max_queue_ingroup_calls);
$ready_max_logout = preg_replace('/[^-0-9]/','',$ready_max_logout);
$inbound_no_agents_no_dial_threshold = preg_replace('/[^-0-9]/','',$inbound_no_agents_no_dial_threshold);
$dead_trigger_seconds = preg_replace('/[^-0-9]/','',$dead_trigger_seconds);
$cid_cb_valid_length = preg_replace('/[^-0-9]/','',$cid_cb_valid_length);
$daily_reset_limit = preg_replace('/[^-0-9]/','',$daily_reset_limit);
$auto_active_list_rank = preg_replace('/[^-0-9]/','',$auto_active_list_rank);
$max_inbound_filter_min_sec = preg_replace('/[^-0-9]/','',$max_inbound_filter_min_sec);
$no_agent_delay = preg_replace('/[^-0-9]/','',$no_agent_delay);
$two_factor_auth_hours = preg_replace('/[^-0-9]/','',$two_factor_auth_hours);
$auto_alt_threshold = preg_replace('/[^-0-9]/','',$auto_alt_threshold);

### DIGITS and COLONS
$shift_length = preg_replace('/[^\:0-9]/','',$shift_length);

### DIGITS and HASHES and STARS
$survey_dtmf_digits = preg_replace('/[^\#\*0-9]/','',$survey_dtmf_digits);
$survey_ni_digit = preg_replace('/[^\#\*0-9]/','',$survey_ni_digit);

### DIGITS and DASHES
$group_rank = preg_replace('/[^-0-9]/','',$group_rank);
$campaign_rank = preg_replace('/[^-0-9]/','',$campaign_rank);
$queue_priority = preg_replace('/[^-0-9]/','',$queue_priority);

### Y or N ONLY ###
$allow_closers = preg_replace('/[^NY]/','',$allow_closers);
$reset_hopper = preg_replace('/[^NY]/','',$reset_hopper);
$amd_send_to_vmx = preg_replace('/[^NY]/','',$amd_send_to_vmx);
$selectable = preg_replace('/[^NY]/','',$selectable);
$reset_list = preg_replace('/[^NY]/','',$reset_list);
$fronter_display = preg_replace('/[^NY]/','',$fronter_display);
$omit_phone_code = preg_replace('/[^NY]/','',$omit_phone_code);
$available_only_ratio_tally = preg_replace('/[^NY]/','',$available_only_ratio_tally);
$sys_perf_log = preg_replace('/[^NY]/','',$sys_perf_log);
$vicidial_balance_active = preg_replace('/[^NY]/','',$vicidial_balance_active);
$vd_server_logs = preg_replace('/[^NY]/','',$vd_server_logs);
$campaign_stats_refresh = preg_replace('/[^NY]/','',$campaign_stats_refresh);
$disable_alter_custdata = preg_replace('/[^NY]/','',$disable_alter_custdata);
$no_hopper_leads_logins = preg_replace('/[^NY]/','',$no_hopper_leads_logins);
$human_answered = preg_replace('/[^NY]/','',$human_answered);
$tovdad_display = preg_replace('/[^NY]/','',$tovdad_display);
$campaign_allow_inbound = preg_replace('/[^NY]/','',$campaign_allow_inbound);
$old_campaign_allow_inbound = preg_replace('/[^NY]/','',$old_campaign_allow_inbound);
$display_queue_count = preg_replace('/[^NY]/','',$display_queue_count);
$qc_show_recording = preg_replace('/[^NY]/','',$qc_show_recording);
$sale_category = preg_replace('/[^NY]/','',$sale_category);
$dead_lead_category = preg_replace('/[^NY]/','',$dead_lead_category);
$agent_extended_alt_dial  = preg_replace('/[^NY]/','',$agent_extended_alt_dial);
$play_place_in_line  = preg_replace('/[^NY]/','',$play_place_in_line);
$play_estimate_hold_time  = preg_replace('/[^NY]/','',$play_estimate_hold_time);
$no_delay_call_route  = preg_replace('/[^NY]/','',$no_delay_call_route);
$did_active  = preg_replace('/[^NY]/','',$did_active);
$active_asterisk_server = preg_replace('/[^NY]/','',$active_asterisk_server);
$generate_vicidial_conf = preg_replace('/[^NY]/','',$generate_vicidial_conf);
$rebuild_conf_files = preg_replace('/[^NY]/','',$rebuild_conf_files);
$agent_allow_group_alias = preg_replace('/[^NY]/','',$agent_allow_group_alias);
$vtiger_status_call = preg_replace('/[^NY]/','',$vtiger_status_call);
$sale = preg_replace('/[^NY]/','',$sale);
$dnc = preg_replace('/[^NY]/','',$dnc);
$customer_contact = preg_replace('/[^NY]/','',$customer_contact);
$not_interested = preg_replace('/[^NY]/','',$not_interested);
$unworkable = preg_replace('/[^NY]/','',$unworkable);
$sounds_update = preg_replace('/[^NY]/','',$sounds_update);
$carrier_logging_active = preg_replace('/[^NY]/','',$carrier_logging_active);
$agent_status_view_time = preg_replace('/[^NY]/','',$agent_status_view_time);
$no_hopper_dialing = preg_replace('/[^NY]/','',$no_hopper_dialing);
$agent_display_dialable_leads = preg_replace('/[^NY]/','',$agent_display_dialable_leads);
$random = preg_replace('/[^NY]/','',$random);
$rebuild_music_on_hold = preg_replace('/[^NY]/','',$rebuild_music_on_hold);
$active_agent_login_server = preg_replace('/[^NY]/','',$active_agent_login_server);
$agent_select_territories = preg_replace('/[^NY]/','',$agent_select_territories);
$delete_vm_after_email = preg_replace('/[^NY]/','',$delete_vm_after_email);
$crm_popup_login = preg_replace('/[^NY]/','',$crm_popup_login);
$ignore_list_script_override = preg_replace('/[^NY]/','',$ignore_list_script_override);
$use_external_server_ip = preg_replace('/[^NY]/','',$use_external_server_ip);
$agent_xfer_consultative = preg_replace('/[^NY]/','',$agent_xfer_consultative);
$agent_xfer_dial_override = preg_replace('/[^NY]/','',$agent_xfer_dial_override);
$agent_xfer_vm_transfer = preg_replace('/[^NY]/','',$agent_xfer_vm_transfer);
$agent_xfer_blind_transfer = preg_replace('/[^NY]/','',$agent_xfer_blind_transfer);
$agent_xfer_dial_with_customer = preg_replace('/[^NY]/','',$agent_xfer_dial_with_customer);
$agent_xfer_park_customer_dial = preg_replace('/[^NY]/','',$agent_xfer_park_customer_dial);
$agent_fullscreen = preg_replace('/[^NY]/','',$agent_fullscreen);
$onhold_prompt_no_block = preg_replace('/[^NY]/','',$onhold_prompt_no_block);
$hold_time_option_no_block = preg_replace('/[^NY]/','',$hold_time_option_no_block);
$wait_time_option_no_block = preg_replace('/[^NY]/','',$wait_time_option_no_block);
$preset_hide_number = preg_replace('/[^NY]/','',$preset_hide_number);
$use_auto_hopper = preg_replace('/[^NY]/','',$use_auto_hopper);
$auto_trim_hopper = preg_replace('/[^NY]/','',$auto_trim_hopper);
$force_change_password = preg_replace('/[^NY]/','',$force_change_password);
$first_login_trigger = preg_replace('/[^NY]/','',$first_login_trigger);
$eht_minimum_prompt_no_block = preg_replace('/[^NY]/','',$eht_minimum_prompt_no_block);
$lead_order_randomize = preg_replace('/[^NY]/','',$lead_order_randomize);
$on_hook_agent = preg_replace('/[^NY]/','',$on_hook_agent);
$auto_pause_precall = preg_replace('/[^NY]/','',$auto_pause_precall);
$auto_resume_precall = preg_replace('/[^NY]/','',$auto_resume_precall);
$webphone_auto_answer = preg_replace('/[^NY]/','',$webphone_auto_answer);
$noanswer_log = preg_replace('/[^NY]/','',$noanswer_log);
$did_agent_log = preg_replace('/[^NY]/','',$did_agent_log);
$completed = preg_replace('/[^NY]/','',$completed);
$report_option = preg_replace('/[^NY]/','',$report_option);
$hopper_vlc_dup_check = preg_replace('/[^NY]/','',$hopper_vlc_dup_check);
$inventory_report = preg_replace('/[^NY]/','',$inventory_report);
$manual_dial_lead_id = preg_replace('/[^NY]/','',$manual_dial_lead_id);
$auto_restart_asterisk = preg_replace('/[^NY]/','',$auto_restart_asterisk);
$asterisk_temp_no_restart = preg_replace('/[^NY]/','',$asterisk_temp_no_restart);
$voicemail_instructions = preg_replace('/[^NY]/','',$voicemail_instructions);
$filter_url_did_redirect = preg_replace('/[^NY]/','',$filter_url_did_redirect);
$callback_active_limit_override = preg_replace('/[^NY]/','',$callback_active_limit_override);
$drop_lead_reset = preg_replace('/[^NY]/','',$drop_lead_reset);
$after_hours_lead_reset = preg_replace('/[^NY]/','',$after_hours_lead_reset);
$nanq_lead_reset = preg_replace('/[^NY]/','',$nanq_lead_reset);
$wait_time_lead_reset = preg_replace('/[^NY]/','',$wait_time_lead_reset);
$hold_time_lead_reset = preg_replace('/[^NY]/','',$hold_time_lead_reset);
$am_message_wildcards = preg_replace('/[^NY]/','',$am_message_wildcards);
$gather_asterisk_output = preg_replace('/[^NY]/','',$gather_asterisk_output);
$routing_initiated_recordings = preg_replace('/[^NY]/','',$routing_initiated_recordings);
$manual_dial_hopper_check = preg_replace('/[^NY]/','',$manual_dial_hopper_check);
$webphone_dialbox = preg_replace('/[^NY]/','',$webphone_dialbox);
$webphone_mute = preg_replace('/[^NY]/','',$webphone_mute);
$webphone_volume = preg_replace('/[^NY]/','',$webphone_volume);
$webphone_debug = preg_replace('/[^NY]/','',$webphone_debug);
$answering_machine = preg_replace('/[^NY]/','',$answering_machine);
$manual_auto_show = preg_replace('/[^NY]/','',$manual_auto_show);
$allow_required_fields = preg_replace('/[^NY]/','',$allow_required_fields);
$conf_qualify = preg_replace('/[^NY]/','',$conf_qualify);
$run_now_trigger = preg_replace('/[^NY]/','',$run_now_trigger);
$agent_xfer_validation = preg_replace('/[^NY]/','',$agent_xfer_validation);
$three_way_record_stop = preg_replace('/[^NY]/','',$three_way_record_stop);
$hangup_xfer_record_start = preg_replace('/[^NY]/','',$hangup_xfer_record_start);
$scheduled_callbacks_email_alert = preg_replace('/[^NY]/','',$scheduled_callbacks_email_alert);
$closing_time_now_trigger = preg_replace('/[^NY]/','',$closing_time_now_trigger);
$closing_time_lead_reset = preg_replace('/[^NY]/','',$closing_time_lead_reset);
$script_top_dispo = preg_replace('/[^NY]/','',$script_top_dispo);
$scheduled_callbacks_force_dial = preg_replace('/[^NY]/','',$scheduled_callbacks_force_dial);
$inbound_route_answer = preg_replace('/[^NY]/','',$inbound_route_answer);

$qc_enabled = preg_replace('/[^0-9NY]/','',$qc_enabled);
$active = preg_replace('/[^0-9NY]/','',$active);
$ofcom_uk_drop_calc = preg_replace('/[^0-9NY]/','',$ofcom_uk_drop_calc);
$agent_xfer_park_3way = preg_replace('/[^0-9NY]/','',$agent_xfer_park_3way);
$manual_dial_validation = preg_replace('/[^0-9NY]/','',$manual_dial_validation);

### ALPHACAPS-NUMERIC
$xferconf_a_number = preg_replace('/[^0-9A-Z]/','',$xferconf_a_number);
$xferconf_b_number = preg_replace('/[^0-9A-Z]/','',$xferconf_b_number);
$xferconf_c_number = preg_replace('/[^0-9A-Z]/','',$xferconf_c_number);
$xferconf_d_number = preg_replace('/[^0-9A-Z]/','',$xferconf_d_number);
$xferconf_e_number = preg_replace('/[^0-9A-Z]/','',$xferconf_e_number);

### DIGITS and Dots
$new_server_ip = preg_replace('/[^\.0-9]/','',$new_server_ip);
$server_ip = preg_replace('/[^\.0-9]/','',$server_ip);
$auto_dial_level = preg_replace('/[^\.0-9]/','',$auto_dial_level);
$adaptive_maximum_level = preg_replace('/[^\.0-9]/','',$adaptive_maximum_level);
$phone_ip = preg_replace('/[^\.0-9]/','',$phone_ip);
$old_server_ip = preg_replace('/[^\.0-9]/','',$old_server_ip);
$computer_ip = preg_replace('/[^\.0-9]/','',$computer_ip);
$queuemetrics_server_ip = preg_replace('/[^\.0-9]/','',$queuemetrics_server_ip);
$vtiger_server_ip = preg_replace('/[^\.0-9]/','',$vtiger_server_ip);
$active_voicemail_server = preg_replace('/[^\.0-9]/','',$active_voicemail_server);
$auto_dial_limit = preg_replace('/[^\.0-9]/','',$auto_dial_limit);
$adaptive_dropped_percentage = preg_replace('/[^\.0-9]/','',$adaptive_dropped_percentage);
$drop_lockout_time = preg_replace('/[^\.0-9]/','',$drop_lockout_time);
$filter_server_ip = preg_replace('/[^\.0-9]/','',$filter_server_ip);
$auto_hopper_multi = preg_replace('/[^\.0-9]/','',$auto_hopper_multi);

# Settings alphanumeric, dash, underscore
$daily_limit_manual = preg_replace('/[^-_0-9a-zA-Z]/','',$daily_limit_manual);
$transfer_button_launch = preg_replace('/[^-_0-9a-zA-Z]/','',$transfer_button_launch);
$two_factor_override = preg_replace('/[^-_0-9a-zA-Z]/','',$two_factor_override);
$clear_form = preg_replace('/[^-_0-9a-zA-Z]/','',$clear_form);
$agent_hidden_sound = preg_replace('/[^-_0-9a-zA-Z]/','',$agent_hidden_sound);
$leave_3way_start_recording = preg_replace('/[^-_0-9a-zA-Z]/','',$leave_3way_start_recording);
$leave_3way_start_recording_exception = preg_replace('/[^-_0-9a-zA-Z]/','',$leave_3way_start_recording_exception);
$agent_screen_timer = preg_replace('/[^-_0-9a-zA-Z]/','',$agent_screen_timer);
$hopper_drop_run_trigger = preg_replace('/[^0-9a-zA-Z]/','',$hopper_drop_run_trigger);
$hopper_drop_run_trigger_all = preg_replace('/[^0-9a-zA-Z]/','',$hopper_drop_run_trigger_all);
$calls_waiting_vl_one = preg_replace('/[^-_0-9a-zA-Z]/','',$calls_waiting_vl_one);
$calls_waiting_vl_two = preg_replace('/[^-_0-9a-zA-Z]/','',$calls_waiting_vl_two);
$transfer_no_dispo = preg_replace('/[^-_0-9a-zA-Z]/','',$transfer_no_dispo);
$allowed_sip_stacks = preg_replace('/[^-_0-9a-zA-Z]/','',$allowed_sip_stacks);
$in_queue_nanque = preg_replace('/[^-_0-9a-zA-Z]/','',$in_queue_nanque);
$reports_header_override = preg_replace('/[^-_0-9a-zA-Z]/','',$reports_header_override);
$agent_hide_hangup = preg_replace('/[^-_0-9a-zA-Z]/','',$agent_hide_hangup);
$SUB = preg_replace('/[^-_0-9a-zA-Z]/','',$SUB);
$SUBMIT = preg_replace('/[^-_0-9a-zA-Z]/','',$SUBMIT);
$qc_display_group_type = preg_replace('/[^-_0-9a-zA-Z]/','',$qc_display_group_type);
$available_only_tally_threshold = preg_replace('/[^-_0-9a-zA-Z]/','',$available_only_tally_threshold);
$dial_level_threshold = preg_replace('/[^-_0-9a-zA-Z]/','',$dial_level_threshold);
$form_end = preg_replace('/[^-_0-9a-zA-Z]/','',$form_end);
$download_max_system_stats_metric = preg_replace('/[^- \+_0-9a-zA-Z]/','',$download_max_system_stats_metric);
$download_max_system_stats_metric_name = preg_replace('/[^- \+_0-9a-zA-Z]/','',$download_max_system_stats_metric_name);
$chat_timeout = preg_replace('/[^-_0-9a-zA-Z]/','',$chat_timeout);
$manager_chat_id = preg_replace('/[^-\._0-9a-zA-Z]/','',$manager_chat_id);
$group_handling = preg_replace('/[^-_0-9a-zA-Z]/','',$group_handling);
$query_date = preg_replace('/[^-_0-9a-zA-Z]/','',$query_date);
$end_date = preg_replace('/[^-_0-9a-zA-Z]/','',$end_date);
$show_vm_on_summary = preg_replace('/[^-_0-9a-zA-Z]/','',$show_vm_on_summary);
$admin_screen_colors = preg_replace('/[^-_0-9a-zA-Z]/','',$admin_screen_colors);
$last_run = preg_replace('/[^-_0-9a-zA-Z]/','',$last_run);
$closing_time_option_xfer_group = preg_replace('/[^-_0-9a-zA-Z]/','',$closing_time_option_xfer_group);
$user_account_emails = preg_replace('/[^-_0-9a-zA-Z]/','',$user_account_emails);
$outbound_cid_any = preg_replace('/[^-_0-9a-zA-Z]/','',$outbound_cid_any);
$enable_xfer_presets = preg_replace('/[^0-9a-zA-Z]/','',$enable_xfer_presets);

if ($non_latin < 1)
	{
	### ALPHA-NUMERIC ONLY ###
	$is_webphone = preg_replace('/[^-_0-9a-zA-Z]/','',$is_webphone);
	$agent_script_override = preg_replace('/[^0-9a-zA-Z]/','',$agent_script_override);
	$campaign_script = preg_replace('/[^0-9a-zA-Z]/','',$campaign_script);
	$submit = preg_replace('/[^0-9a-zA-Z]/','',$submit);
	$campaign_cid = preg_replace('/[^0-9a-zA-Z]/','',$campaign_cid);
	$campaign_recording = preg_replace('/[^0-9a-zA-Z]/','',$campaign_recording);
	$ADD = preg_replace('/[^0-9a-zA-Z]/','',$ADD);
	$dial_prefix = preg_replace('/[^0-9a-zA-Z]/','',$dial_prefix);
	$state_call_time_state = preg_replace('/[^0-9a-zA-Z]/','',$state_call_time_state);
	$scheduled_callbacks = preg_replace('/[^0-9a-zA-Z]/','',$scheduled_callbacks);
	$concurrent_transfers = preg_replace('/[^0-9a-zA-Z]/','',$concurrent_transfers);
	$billable = preg_replace('/[^0-9a-zA-Z]/','',$billable);
	$pause_code = preg_replace('/[^0-9a-zA-Z]/','',$pause_code);
	$vicidial_recording_override = preg_replace('/[^0-9a-zA-Z]/','',$vicidial_recording_override);
	$ingroup_recording_override = preg_replace('/[^0-9a-zA-Z]/','',$ingroup_recording_override);
	$queuemetrics_log_id = preg_replace('/[^0-9a-zA-Z]/','',$queuemetrics_log_id);
	$after_hours_exten = preg_replace('/[^0-9a-zA-Z]/','',$after_hours_exten);
	$after_hours_voicemail = preg_replace('/[^0-9a-zA-Z]/','',$after_hours_voicemail);
	$qc_script = preg_replace('/[^0-9a-zA-Z]/','',$qc_script);
	$code = preg_replace('/[^0-9a-zA-Z]/','',$code);
	$survey_no_response_action = preg_replace('/[^0-9a-zA-Z]/','',$survey_no_response_action);
	$survey_ni_status = preg_replace('/[^0-9a-zA-Z]/','',$survey_ni_status);
	$qc_get_record_launch = preg_replace('/[^0-9a-zA-Z]/','',$qc_get_record_launch);
	$agent_pause_codes_active = preg_replace('/[^0-9a-zA-Z]/','',$agent_pause_codes_active);
	$three_way_dial_prefix = preg_replace('/[^0-9a-zA-Z]/','',$three_way_dial_prefix);
	$agent_shift_enforcement_override = preg_replace('/[^0-9a-zA-Z]/','',$agent_shift_enforcement_override);
	$survey_third_status = preg_replace('/[^0-9a-zA-Z]/','',$survey_third_status);
	$survey_fourth_status = preg_replace('/[^0-9a-zA-Z]/','',$survey_fourth_status);
	$sounds_web_directory = preg_replace('/[^0-9a-zA-Z]/','',$sounds_web_directory);
	$disable_alter_custphone = preg_replace('/[^0-9a-zA-Z]/','',$disable_alter_custphone);
	$view_calls_in_queue = preg_replace('/[^0-9a-zA-Z]/','',$view_calls_in_queue);
	$view_calls_in_queue_launch = preg_replace('/[^0-9a-zA-Z]/','',$view_calls_in_queue_launch);
	$grab_calls_in_queue = preg_replace('/[^0-9a-zA-Z]/','',$grab_calls_in_queue);
	$call_requeue_button = preg_replace('/[^0-9a-zA-Z]/','',$call_requeue_button);
	$pause_after_each_call = preg_replace('/[^0-9a-zA-Z]/','',$pause_after_each_call);
	$use_internal_dnc = preg_replace('/[^0-9a-zA-Z]/','',$use_internal_dnc);
	$use_campaign_dnc = preg_replace('/[^0-9a-zA-Z]/','',$use_campaign_dnc);
	$voicemail_id = preg_replace('/[^0-9a-zA-Z]/','',$voicemail_id);
	$new_voicemail_id = preg_replace('/[^0-9a-zA-Z]/','',$new_voicemail_id);
	$status_id = preg_replace('/[^0-9a-zA-Z]/','',$status_id);
	$agent_call_log_view = preg_replace('/[^0-9a-zA-Z]/','',$agent_call_log_view);
	$agent_call_log_view_override = preg_replace('/[^0-9a-zA-Z]/','',$agent_call_log_view_override);
	$queuemetrics_loginout = preg_replace('/[^0-9a-zA-Z]/','',$queuemetrics_loginout);
	$queuemetrics_callstatus = preg_replace('/[^0-9a-zA-Z]/','',$queuemetrics_callstatus);
	$hide_xfer_number_to_dial = preg_replace('/[^0-9a-zA-Z]/','',$hide_xfer_number_to_dial);
	$manual_dial_prefix = preg_replace('/[^0-9a-zA-Z]/','',$manual_dial_prefix);
	$customer_3way_hangup_logging = preg_replace('/[^0-9a-zA-Z]/','',$customer_3way_hangup_logging);
	$customer_3way_hangup_action = preg_replace('/[^0-9a-zA-Z]/','',$customer_3way_hangup_action);
	$queuemetrics_dispo_pause = preg_replace('/[^0-9a-zA-Z]/','',$queuemetrics_dispo_pause);
	$per_call_notes = preg_replace('/[^0-9a-zA-Z]/','',$per_call_notes);
	$my_callback_option = preg_replace('/[^0-9a-zA-Z]/','',$my_callback_option);
	$auto_pause_precall_code = preg_replace('/[^0-9a-zA-Z]/','',$auto_pause_precall_code);
	$disable_dispo_status = preg_replace('/[^0-9a-zA-Z]/','',$disable_dispo_status);
	$action_xfer_cid = preg_replace('/[^0-9a-zA-Z]/','',$action_xfer_cid);
	$callback_list_calltime = preg_replace('/[^0-9a-zA-Z]/','',$callback_list_calltime);
	$pause_after_next_call = preg_replace('/[^0-9a-zA-Z]/','',$pause_after_next_call);
	$owner_populate = preg_replace('/[^0-9a-zA-Z]/','',$owner_populate);
	$dead_max_dispo = preg_replace('/[^0-9a-zA-Z]/','',$dead_max_dispo);
	$dispo_max_dispo = preg_replace('/[^0-9a-zA-Z]/','',$dispo_max_dispo);
	$wrapup_bypass = preg_replace('/[^0-9a-zA-Z]/','',$wrapup_bypass);
	$wrapup_after_hotkey = preg_replace('/[^0-9a-zA-Z]/','',$wrapup_after_hotkey);
	$show_previous_callback = preg_replace('/[^0-9a-zA-Z]/','',$show_previous_callback);
	$clear_script = preg_replace('/[^0-9a-zA-Z]/','',$clear_script);
	$allow_chats = preg_replace('/[^0-9a-zA-Z]/','',$allow_chats);
	$allow_emails = preg_replace('/[^0-9a-zA-Z]/','',$allow_emails);
	$status_display_ingroup = preg_replace('/[^0-9a-zA-Z]/','',$status_display_ingroup);
	$populate_lead_ingroup = preg_replace('/[^0-9a-zA-Z]/','',$populate_lead_ingroup);
	$nva_new_status = preg_replace('/[^0-9a-zA-Z]/','',$nva_new_status);
	$report_default_format = preg_replace('/[^0-9a-zA-Z]/','',$report_default_format);
	$menu_background = preg_replace('/[^0-9a-zA-Z]/','',$menu_background);
	$frame_background = preg_replace('/[^0-9a-zA-Z]/','',$frame_background);
	$std_row1_background = preg_replace('/[^0-9a-zA-Z]/','',$std_row1_background);
	$std_row2_background = preg_replace('/[^0-9a-zA-Z]/','',$std_row2_background);
	$std_row3_background = preg_replace('/[^0-9a-zA-Z]/','',$std_row3_background);
	$std_row4_background = preg_replace('/[^0-9a-zA-Z]/','',$std_row4_background);
	$std_row5_background = preg_replace('/[^0-9a-zA-Z]/','',$std_row5_background);
	$alt_row1_background = preg_replace('/[^0-9a-zA-Z]/','',$alt_row1_background);
	$alt_row2_background = preg_replace('/[^0-9a-zA-Z]/','',$alt_row2_background);
	$alt_row3_background = preg_replace('/[^0-9a-zA-Z]/','',$alt_row3_background);
	$button_color = preg_replace('/[^0-9a-zA-Z]/','',$button_color);
	$dead_to_dispo = preg_replace('/[^0-9a-zA-Z]/','',$dead_to_dispo);
	$routing_prefix = preg_replace('/[^0-9a-zA-Z]/','',$routing_prefix);
	$inbound_survey = preg_replace('/[^0-9a-zA-Z]/','',$inbound_survey);
	$inbound_list_script_override = preg_replace('/[^0-9a-zA-Z]/','',$inbound_list_script_override);
	$pause_max_dispo = preg_replace('/[^0-9a-zA-Z]/','',$pause_max_dispo);
	$areacode = preg_replace('/[^0-9a-zA-Z]/','',$areacode);
	$require_mgr_approval = preg_replace('/[^0-9a-zA-Z]/','',$require_mgr_approval);
	$mute_recordings = preg_replace('/[^0-9a-zA-Z]/','',$mute_recordings);
	$leave_vm_no_dispo = preg_replace('/[^0-9a-zA-Z]/','',$leave_vm_no_dispo);
	$amd_agent_route_options = preg_replace('/[^0-9a-zA-Z]/','',$amd_agent_route_options);

	### ALPHA-NUMERIC and spaces and hash and star and comma
	$xferconf_a_dtmf = preg_replace('/[^ \,\*\#0-9a-zA-Z]/','',trim($xferconf_a_dtmf));
	$xferconf_b_dtmf = preg_replace('/[^ \,\*\#0-9a-zA-Z]/','',trim($xferconf_b_dtmf));
	$xferconf_c_dtmf = preg_replace('/[^ \,\*\#0-9a-zA-Z]/','',trim($xferconf_c_dtmf));
	$xferconf_d_dtmf = preg_replace('/[^ \,\*\#0-9a-zA-Z]/','',trim($xferconf_d_dtmf));
	$xferconf_e_dtmf = preg_replace('/[^ \,\*\#0-9a-zA-Z]/','',trim($xferconf_e_dtmf));
	$survey_third_digit = preg_replace('/[^ \,\*\#0-9a-zA-Z]/','',$survey_third_digit);
	$survey_fourth_digit = preg_replace('/[^ \,\*\#0-9a-zA-Z]/','',$survey_fourth_digit);
	$survey_third_exten = preg_replace('/[^ \,\*\#0-9a-zA-Z]/','',$survey_third_exten);
	$survey_fourth_exten = preg_replace('/[^ \,\*\#0-9a-zA-Z]/','',$survey_fourth_exten);
	$preset_dtmf = preg_replace('/[^ \,\*\#0-9a-zA-Z]/','',$preset_dtmf);

	### ALPHA-NUMERIC and underscore and dash
	$agi_output = preg_replace('/[^-_0-9a-zA-Z]/','',$agi_output);
	$ASTmgrSECRET = preg_replace('/[^-_0-9a-zA-Z]/','',$ASTmgrSECRET);
	$ASTmgrUSERNAME = preg_replace('/[^-_0-9a-zA-Z]/','',$ASTmgrUSERNAME);
	$ASTmgrUSERNAMElisten = preg_replace('/[^-_0-9a-zA-Z]/','',$ASTmgrUSERNAMElisten);
	$ASTmgrUSERNAMEsend = preg_replace('/[^-_0-9a-zA-Z]/','',$ASTmgrUSERNAMEsend);
	$ASTmgrUSERNAMEupdate = preg_replace('/[^-_0-9a-zA-Z]/','',$ASTmgrUSERNAMEupdate);
	$call_time_id = preg_replace('/[^-_0-9a-zA-Z]/','',$call_time_id);
	$campaign_id = preg_replace('/[^-_0-9a-zA-Z]/','',$campaign_id);
	$CoNfIrM = preg_replace('/[^-_0-9a-zA-Z]/','',$CoNfIrM);
	$DBX_database = preg_replace('/[^-_0-9a-zA-Z]/','',$DBX_database);
	$DBX_pass = preg_replace('/[^-_0-9a-zA-Z]/','',$DBX_pass);
	$DBX_user = preg_replace('/[^-_0-9a-zA-Z]/','',$DBX_user);
	$DBY_database = preg_replace('/[^-_0-9a-zA-Z]/','',$DBY_database);
	$DBY_pass = preg_replace('/[^-_0-9a-zA-Z]/','',$DBY_pass);
	$DBY_user = preg_replace('/[^-_0-9a-zA-Z]/','',$DBY_user);
	$dial_method = preg_replace('/[^-_0-9a-zA-Z]/','',$dial_method);
	$dial_status_a = preg_replace('/[^-_0-9a-zA-Z]/','',$dial_status_a);
	$dial_status_b = preg_replace('/[^-_0-9a-zA-Z]/','',$dial_status_b);
	$dial_status_c = preg_replace('/[^-_0-9a-zA-Z]/','',$dial_status_c);
	$dial_status_d = preg_replace('/[^-_0-9a-zA-Z]/','',$dial_status_d);
	$dial_status_e = preg_replace('/[^-_0-9a-zA-Z]/','',$dial_status_e);
	$ext_context = preg_replace('/[^-_0-9a-zA-Z]/','',$ext_context);
	$group_id = preg_replace('/[^-_0-9a-zA-Z]/','',$group_id);
	$lead_filter_id = preg_replace('/[^-_0-9a-zA-Z]/','',$lead_filter_id);
	$local_call_time = preg_replace('/[^-_0-9a-zA-Z]/','',$local_call_time);
	$login = preg_replace('/[^-_0-9a-zA-Z]/','',$login);
	$login_campaign = preg_replace('/[^-_0-9a-zA-Z]/','',$login_campaign);
	$login_pass = preg_replace('/[^-_0-9a-zA-Z]/','',$login_pass);
	$login_user = preg_replace('/[^-_0-9a-zA-Z]/','',$login_user);
	$new_login = preg_replace('/[^-_0-9a-zA-Z]/','',$new_login);
	$new_pass = preg_replace('/[^-_0-9a-zA-Z]/','',$new_pass);
	$next_agent_call = preg_replace('/[^-_0-9a-zA-Z]/','',$next_agent_call);
	$old_campaign_id = preg_replace('/[^-_0-9a-zA-Z]/','',$old_campaign_id);
	$old_server_id = preg_replace('/[^-_0-9a-zA-Z]/','',$old_server_id);
	$OLDuser_group = preg_replace('/[^-_0-9a-zA-Z]/','',$OLDuser_group);
	$park_file_name = preg_replace('/[^-_0-9a-zA-Z]/','',$park_file_name);
	$pass = preg_replace('/[^-_0-9a-zA-Z]/','',$pass);
	$phone_login = preg_replace('/[^-_0-9a-zA-Z]/','',$phone_login);
	$phone_pass = preg_replace('/[^-_0-9a-zA-Z]/','',$phone_pass);
	$PHP_AUTH_PW = preg_replace('/[^-_0-9a-zA-Z]/','',$PHP_AUTH_PW);
	$PHP_AUTH_USER = preg_replace('/[^-_0-9a-zA-Z]/','',$PHP_AUTH_USER);
	$protocol = preg_replace('/[^-_0-9a-zA-Z]/','',$protocol);
	$server_id = preg_replace('/[^-_0-9a-zA-Z]/','',$server_id);
	$stage = preg_replace('/[^-_0-9a-zA-Z]/','',$stage);
	$state_rule = preg_replace('/[^-_0-9a-zA-Z]/','',$state_rule);
	$holiday_rule = preg_replace('/[^-_0-9a-zA-Z]/','',$holiday_rule);
	$trunk_restriction = preg_replace('/[^-_0-9a-zA-Z]/','',$trunk_restriction);
	$user = preg_replace('/[^-_0-9a-zA-Z]/','',$user);
	$user_group = preg_replace('/[^-_0-9a-zA-Z]/','',$user_group);
	$VICIDIAL_park_on_filename = preg_replace('/[^-_0-9a-zA-Z]/','',$VICIDIAL_park_on_filename);
	$auto_alt_dial = preg_replace('/[^-_0-9a-zA-Z]/','',$auto_alt_dial);
	$dial_status = preg_replace('/[^-_0-9a-zA-Z]/','',$dial_status);
	$queuemetrics_eq_prepend = preg_replace('/[^-_0-9a-zA-Z]/','',$queuemetrics_eq_prepend);
	$vicidial_agent_disable = preg_replace('/[^-_0-9a-zA-Z]/','',$vicidial_agent_disable);
	$alter_custdata_override = preg_replace('/[^-_0-9a-zA-Z]/','',$alter_custdata_override);
	$list_order_mix = preg_replace('/[^-_0-9a-zA-Z]/','',$list_order_mix);
	$vcl_id = preg_replace('/[^-_0-9a-zA-Z]/','',$vcl_id);
	$mix_method = preg_replace('/[^-_0-9a-zA-Z]/','',$mix_method);
	$category = preg_replace('/[^-_0-9a-zA-Z]/','',$category);
	$vsc_id = preg_replace('/[^-_0-9a-zA-Z]/','',$vsc_id);
	$moh_context = preg_replace('/[^-_0-9a-zA-Z]/','',$moh_context);
	$source_campaign_id = preg_replace('/[^-_0-9a-zA-Z]/','',$source_campaign_id);
	$source_user_id = preg_replace('/[^-_0-9a-zA-Z]/','',$source_user_id);
	$source_group_id = preg_replace('/[^-_0-9a-zA-Z]/','',$source_group_id);
	$default_xfer_group = preg_replace('/[^-_0-9a-zA-Z]/','',$default_xfer_group);
	$drop_exten = preg_replace('/[^-_0-9a-zA-Z]/','',$drop_exten);
	$safe_harbor_exten = preg_replace('/[^-_0-9a-zA-Z]/','',$safe_harbor_exten);
	$drop_action = preg_replace('/[^-_0-9a-zA-Z]/','',$drop_action);
	$drop_inbound_group = preg_replace('/[^-_0-9a-zA-Z]/','',$drop_inbound_group);
	$afterhours_xfer_group = preg_replace('/[^-_0-9a-zA-Z]/','',$afterhours_xfer_group);
	$after_hours_action = preg_replace('/[^-_0-9a-zA-Z]/','',$after_hours_action);
	$alias_id = preg_replace('/[^-_0-9a-zA-Z]/','',$alias_id);
	$shift_id = preg_replace('/[^-_0-9a-zA-Z]/','',$shift_id);
	$qc_shift_id = preg_replace('/[^-_0-9a-zA-Z]/','',$qc_shift_id);
	$survey_method = preg_replace('/[^-_0-9a-zA-Z]/','',$survey_method);
	$alter_custphone_override = preg_replace('/[^-_0-9a-zA-Z]/','',$alter_custphone_override);
	$manual_dial_filter = preg_replace('/[^-_0-9a-zA-Z]/','',$manual_dial_filter);
	$manual_dial_search_filter = preg_replace('/[^-_0-9a-zA-Z]/','',$manual_dial_search_filter);
	$agent_clipboard_copy = preg_replace('/[^-_0-9a-zA-Z]/','',$agent_clipboard_copy);
	$hold_time_option = preg_replace('/[^-_0-9a-zA-Z]/','',$hold_time_option);
	$hold_time_option_xfer_group = preg_replace('/[^-_0-9a-zA-Z]/','',$hold_time_option_xfer_group);
	$hold_recall_xfer_group = preg_replace('/[^-_0-9a-zA-Z]/','',$hold_recall_xfer_group);
	$play_welcome_message = preg_replace('/[^-_0-9a-zA-Z]/','',$play_welcome_message);
	$did_route = preg_replace('/[^-_0-9a-zA-Z]/','',$did_route);
	$user_unavailable_action = preg_replace('/[^-_0-9a-zA-Z]/','',$user_unavailable_action);
	$user_route_settings_ingroup = preg_replace('/[^-_0-9a-zA-Z]/','',$user_route_settings_ingroup);
	$call_handle_method = preg_replace('/[^-_0-9a-zA-Z]/','',$call_handle_method);
	$agent_search_method = preg_replace('/[^-_0-9a-zA-Z]/','',$agent_search_method);
	$hold_time_option_voicemail = preg_replace('/[^-_0-9a-zA-Z]/','',$hold_time_option_voicemail);
	$exten_context = preg_replace('/[^-_0-9a-zA-Z]/','',$exten_context);
	$three_way_call_cid = preg_replace('/[^-_0-9a-zA-Z]/','',$three_way_call_cid);
	$web_form_target = preg_replace('/[^-_0-9a-zA-Z]/','',$web_form_target);
	$recording_web_link = preg_replace('/[^-_0-9a-zA-Z]/','',$recording_web_link);
	$vtiger_search_category = preg_replace('/[^-_0-9a-zA-Z]/','',$vtiger_search_category);
	$vtiger_create_call_record = preg_replace('/[^-_0-9a-zA-Z]/','',$vtiger_create_call_record);
	$vtiger_create_lead_record = preg_replace('/[^-_0-9a-zA-Z]/','',$vtiger_create_lead_record);
	$vtiger_screen_login = preg_replace('/[^-_0-9a-zA-Z]/','',$vtiger_screen_login);
	$cpd_amd_action = preg_replace('/[^-_0-9a-zA-Z]/','',$cpd_amd_action);
	$cpd_unknown_action = preg_replace('/[^-_0-9a-zA-Z]/','',$cpd_unknown_action);
	$template_id = preg_replace('/[^-_0-9a-zA-Z]/','',$template_id);
	$carrier_id = preg_replace('/[^-_0-9a-zA-Z]/','',$carrier_id);
	$source_carrier = preg_replace('/[^-_0-9a-zA-Z]/','',$source_carrier);
	$group_alias_id = preg_replace('/[^-_0-9a-zA-Z]/','',$group_alias_id);
	$default_group_alias = preg_replace('/[^-_0-9a-zA-Z]/','',$default_group_alias);
	$vtiger_search_dead = preg_replace('/[^-_0-9a-zA-Z]/','',$vtiger_search_dead);
	$menu_id = preg_replace('/[^-_0-9a-zA-Z]/','',$menu_id);
	$source_menu = preg_replace('/[^-_0-9a-zA-Z]/','',$source_menu);
	$call_time_id = preg_replace('/[^-_0-9a-zA-Z]/','',$call_time_id);
	$phone_context = preg_replace('/[^-_0-9a-zA-Z]/','',$phone_context);
	$new_conf_secret = preg_replace('/[^-_0-9a-zA-Z]/','',$new_conf_secret);
	$conf_secret = preg_replace('/[^-_0-9a-zA-Z]/','',$conf_secret);
	$tracking_group = preg_replace('/[^-_0-9a-zA-Z]/','',$tracking_group);
	$no_agent_no_queue = preg_replace('/[^-_0-9a-zA-Z]/','',$no_agent_no_queue);
	$no_agent_action = preg_replace('/[^-_0-9a-zA-Z]/','',$no_agent_action);
	$quick_transfer_button = preg_replace('/[^-_0-9a-zA-Z]/','',$quick_transfer_button);
	$prepopulate_transfer_preset = preg_replace('/[^-_0-9a-zA-Z]/','',$prepopulate_transfer_preset);
	$tts_id = preg_replace('/[^-_0-9a-zA-Z]/','',$tts_id);
	$drop_rate_group = preg_replace('/[^-_0-9a-zA-Z]/','',$drop_rate_group);
	$agent_dial_owner_only = preg_replace('/[^-_0-9a-zA-Z]/','',$agent_dial_owner_only);
	$reset_time = preg_replace('/[^-_0-9a-zA-Z]/','',$reset_time);
	$moh_id = preg_replace('/[^-_0-9a-zA-Z]/','',$moh_id);
	$mohsuggest = preg_replace('/[^-_0-9a-zA-Z]/','',$mohsuggest);
	$drop_inbound_group_override = preg_replace('/[^-_0-9a-zA-Z]/','',$drop_inbound_group_override);
	$timer_action = preg_replace('/[^-_0-9a-zA-Z]/','',$timer_action);
	$record_call = preg_replace('/[^-_0-9a-zA-Z]/','',$record_call);
	$scheduled_callbacks_alert = preg_replace('/[^-_0-9a-zA-Z]/','',$scheduled_callbacks_alert);
	$extension_group_id = preg_replace('/[^-_0-9a-zA-Z]/','',$extension_group_id);
	$extension_group = preg_replace('/[^-_0-9a-zA-Z]/','',$extension_group);
	$scheduled_callbacks_count = preg_replace('/[^-_0-9a-zA-Z]/','',$scheduled_callbacks_count);
	$manual_dial_override = preg_replace('/[^-_0-9a-zA-Z]/','',$manual_dial_override);
	$blind_monitor_warning = preg_replace('/[^-_0-9a-zA-Z]/','',$blind_monitor_warning);
	$uniqueid_status_display = preg_replace('/[^-_0-9a-zA-Z]/','',$uniqueid_status_display);
	$hold_time_option_callmenu = preg_replace('/[^-_0-9a-zA-Z]/','',$hold_time_option_callmenu);
	$inbound_queue_no_dial = preg_replace('/[^-_0-9a-zA-Z]/','',$inbound_queue_no_dial);
	$hold_time_second_option = preg_replace('/[^-_0-9a-zA-Z]/','',$hold_time_second_option);
	$hold_time_third_option = preg_replace('/[^-_0-9a-zA-Z]/','',$hold_time_third_option);
	$wait_hold_option_priority = preg_replace('/[^-_0-9a-zA-Z]/','',$wait_hold_option_priority);
	$wait_time_option = preg_replace('/[^-_0-9a-zA-Z]/','',$wait_time_option);
	$wait_time_second_option = preg_replace('/[^-_0-9a-zA-Z]/','',$wait_time_second_option);
	$wait_time_third_option = preg_replace('/[^-_0-9a-zA-Z]/','',$wait_time_third_option);
	$wait_time_option_xfer_group = preg_replace('/[^-_0-9a-zA-Z]/','',$wait_time_option_xfer_group);
	$wait_time_option_callmenu = preg_replace('/[^-_0-9a-zA-Z]/','',$wait_time_option_callmenu);
	$wait_time_option_voicemail = preg_replace('/[^-_0-9a-zA-Z]/','',$wait_time_option_voicemail);
	$filter_phone_group_id = preg_replace('/[^-_0-9a-zA-Z]/','',$filter_phone_group_id);
	$filter_action = preg_replace('/[^-_0-9a-zA-Z]/','',$filter_action);
	$filter_user_unavailable_action = preg_replace('/[^-_0-9a-zA-Z]/','',$filter_user_unavailable_action);
	$filter_user_route_settings_ingroup = preg_replace('/[^-_0-9a-zA-Z]/','',$filter_user_route_settings_ingroup);
	$filter_agent_search_method = preg_replace('/[^-_0-9a-zA-Z]/','',$filter_agent_search_method);
	$filter_campaign_id = preg_replace('/[^-_0-9a-zA-Z]/','',$filter_campaign_id);
	$filter_group_id = preg_replace('/[^-_0-9a-zA-Z]/','',$filter_group_id);
	$filter_menu_id = preg_replace('/[^-_0-9a-zA-Z]/','',$filter_menu_id);
	$filter_call_handle_method = preg_replace('/[^-_0-9a-zA-Z]/','',$filter_call_handle_method);
	$filter_user = preg_replace('/[^-_0-9a-zA-Z]/','',$filter_user);
	$filter_exten_context = preg_replace('/[^-_0-9a-zA-Z]/','',$filter_exten_context);
	$webphone_systemkey = preg_replace('/[^-_0-9a-zA-Z]/','',$webphone_systemkey);
	$webphone_dialpad = preg_replace('/[^-_0-9a-zA-Z]/','',$webphone_dialpad);
	$webphone_systemkey_override = preg_replace('/[^-_0-9a-zA-Z]/','',$webphone_systemkey_override);
	$webphone_dialpad_override = preg_replace('/[^-_0-9a-zA-Z]/','',$webphone_dialpad_override);
	$default_phone_registration_password = preg_replace('/[^-_0-9a-zA-Z]/','',$default_phone_registration_password);
	$default_phone_login_password = preg_replace('/[^-_0-9a-zA-Z]/','',$default_phone_login_password);
	$default_server_password = preg_replace('/[^-_0-9a-zA-Z]/','',$default_server_password);
	$ivr_park_call = preg_replace('/[^-_0-9a-zA-Z]/','',$ivr_park_call);
	$manual_preview_dial = preg_replace('/[^-_0-9a-zA-Z]/','',$manual_preview_dial);
	$realtime_agent_time_stats = preg_replace('/[^-_0-9a-zA-Z]/','',$realtime_agent_time_stats);
	$api_manual_dial = preg_replace('/[^-_0-9a-zA-Z]/','',$api_manual_dial);
	$manual_dial_call_time_check = preg_replace('/[^-_0-9a-zA-Z]/','',$manual_dial_call_time_check);
	$lead_order_secondary = preg_replace('/[^-_0-9a-zA-Z]/','',$lead_order_secondary);
	$agent_lead_search = preg_replace('/[^-_0-9a-zA-Z]/','',$agent_lead_search);
	$agent_lead_search_method = preg_replace('/[^-_0-9a-zA-Z]/','',$agent_lead_search_method);
	$manual_dial_cid = preg_replace('/[^-_0-9a-zA-Z]/','',$manual_dial_cid);
	$post_phone_time_diff_alert = preg_replace('/[^-_0-9a-zA-Z]/','',$post_phone_time_diff_alert);
	$custom_3way_button_transfer = preg_replace('/[^-_0-9a-zA-Z]/','',$custom_3way_button_transfer);
	$available_only_tally_threshold_agents = preg_replace('/[^-_0-9a-zA-Z]/','',$available_only_tally_threshold_agents);
	$dial_level_threshold_agents = preg_replace('/[^-_0-9a-zA-Z]/','',$dial_level_threshold_agents);
	$time_zone_setting = preg_replace('/[^-_0-9a-zA-Z]/','',$time_zone_setting);
	$safe_harbor_menu_id = preg_replace('/[^-_0-9a-zA-Z]/','',$safe_harbor_menu_id);
	$survey_menu_id = preg_replace('/[^-_0-9a-zA-Z]/','',$survey_menu_id);
	$dl_diff_target_method = preg_replace('/[^-_0-9a-zA-Z]/','',$dl_diff_target_method);
	$disable_dispo_screen = preg_replace('/[^-_0-9a-zA-Z]/','',$disable_dispo_screen);
	$screen_labels = preg_replace('/[^-_0-9a-zA-Z]/','',$screen_labels);
	$label_hide_field_logs = preg_replace('/[^-_0-9a-zA-Z]/','',$label_hide_field_logs);
	$label_id = preg_replace('/[^-_0-9a-zA-Z]/','',$label_id);
	$status_display_fields = preg_replace('/[^-_0-9a-zA-Z]/','',$status_display_fields);
	$voicemail_timezone = preg_replace('/[^-_0-9a-zA-Z]/','',$voicemail_timezone);
	$default_voicemail_timezone = preg_replace('/[^-_0-9a-zA-Z]/','',$default_voicemail_timezone);
	$on_hook_cid = preg_replace('/[^-_0-9a-zA-Z]/','',$on_hook_cid);
	$pllb_grouping = preg_replace('/[^-_0-9a-zA-Z]/','',$pllb_grouping);
	$user_start = preg_replace('/[^-_0-9a-zA-Z]/','',$user_start);
	$drop_callmenu = preg_replace('/[^-_0-9a-zA-Z]/','',$drop_callmenu);
	$after_hours_callmenu = preg_replace('/[^-_0-9a-zA-Z]/','',$after_hours_callmenu);
	$survey_recording = preg_replace('/[^-_0-9a-zA-Z]/','',$survey_recording);
	$dtmf_field = preg_replace('/[^-_0-9a-zA-Z]/','',$dtmf_field);
	$preset_contact_search = preg_replace('/[^-_0-9a-zA-Z]/','',$preset_contact_search);
	$admin_hide_phone_data = preg_replace('/[^-_0-9a-zA-Z]/','',$admin_hide_phone_data);
	$max_calls_method = preg_replace('/[^-_0-9a-zA-Z]/','',$max_calls_method);
	$max_calls_action = preg_replace('/[^-_0-9a-zA-Z]/','',$max_calls_action);
	$in_group_dial = preg_replace('/[^-_0-9a-zA-Z]/','',$in_group_dial);
	$in_group_dial_select = preg_replace('/[^-_0-9a-zA-Z]/','',$in_group_dial_select);
	$queuemetrics_socket = preg_replace('/[^-_0-9a-zA-Z]/','',$queuemetrics_socket);
	$holiday_id = preg_replace('/[^-_0-9a-zA-Z]/','',$holiday_id);
	$holiday_date = preg_replace('/[^-_0-9a-zA-Z]/','',$holiday_date);
	$holiday_status = preg_replace('/[^-_0-9a-zA-Z]/','',$holiday_status);
	$expiration_date = preg_replace('/[^-_0-9a-zA-Z]/','',$expiration_date);
	$amd_inbound_group = preg_replace('/[^-_0-9a-zA-Z]/','',$amd_inbound_group);
	$amd_callmenu = preg_replace('/[^-_0-9a-zA-Z]/','',$amd_callmenu);
	$filter_inbound_number = preg_replace('/[^-_0-9a-zA-Z]/','',$filter_inbound_number);
	$filter_dnc_campaign = preg_replace('/[^-_0-9a-zA-Z]/','',$filter_dnc_campaign);
	$manual_dial_search_checkbox = preg_replace('/[^-_0-9a-zA-Z]/','',$manual_dial_search_checkbox);
	$alt_number_dialing = preg_replace('/[^-_0-9a-zA-Z]/','',$alt_number_dialing);
	$no_agent_ingroup_redirect = preg_replace('/[^-_0-9a-zA-Z]/','',$no_agent_ingroup_redirect);
	$no_agent_ingroup_id = preg_replace('/[^-_0-9a-zA-Z]/','',$no_agent_ingroup_id);
	$pre_filter_phone_group_id = preg_replace('/[^-_0-9a-zA-Z]/','',$pre_filter_phone_group_id);
	$shift_enforcement = preg_replace('/[^-_0-9a-zA-Z]/','',$shift_enforcement);
	$comments_all_tabs = preg_replace('/[^-_0-9a-zA-Z]/','',$comments_all_tabs);
	$comments_dispo_screen = preg_replace('/[^-_0-9a-zA-Z]/','',$comments_dispo_screen);
	$comments_callback_screen = preg_replace('/[^-_0-9a-zA-Z]/','',$comments_callback_screen);
	$qc_comment_history = preg_replace('/[^-_0-9a-zA-Z]/','',$qc_comment_history);
	$language_method = preg_replace('/[^-_0-9a-zA-Z]/','',$language_method);
	$manual_dial_override_field = preg_replace('/[^-_0-9a-zA-Z]/','',$manual_dial_override_field);
	$max_queue_ingroup_id = preg_replace('/[^-_0-9a-zA-Z]/','',$max_queue_ingroup_id);
	$agent_debug_logging = preg_replace('/[^-_0-9a-zA-Z]/','',$agent_debug_logging);
	$container_id = preg_replace('/[^-_0-9a-zA-Z]/','',$container_id);
	$phone_defaults_container = preg_replace('/[^-_0-9a-zA-Z]/','',$phone_defaults_container);
	$container_type = preg_replace('/[^-_0-9a-zA-Z]/','',$container_type);
	$status_group_id = preg_replace('/[^-_0-9a-zA-Z]/','',$status_group_id);
	$unavail_dialplan_fwd_exten = preg_replace('/[^-_0-9a-zA-Z]/','',$unavail_dialplan_fwd_exten);
	$unavail_dialplan_fwd_context = preg_replace('/[^-_0-9a-zA-Z]/','',$unavail_dialplan_fwd_context);
	$nva_search_method = preg_replace('/[^-_0-9a-zA-Z]/','',$nva_search_method);
	$on_hook_cid_number = preg_replace('/[^-_0-9a-zA-Z]/','',$on_hook_cid_number);
	$colors_id = preg_replace('/[^-_0-9a-zA-Z]/','',$colors_id);
	$agent_screen_colors = preg_replace('/[^-_0-9a-zA-Z]/','',$agent_screen_colors);
	$customer_chat_screen_colors = preg_replace('/[^-_0-9a-zA-Z]/','',$customer_chat_screen_colors);
	$web_loader_phone_length = preg_replace('/[^-_0-9a-zA-Z]/','',$web_loader_phone_length);
	$agent_chat_screen_colors = preg_replace('/[^-_0-9a-zA-Z]/','',$agent_chat_screen_colors);
	$populate_lead_province = preg_replace('/[^-_0-9a-zA-Z]/','',$populate_lead_province);
	$populate_lead_owner = preg_replace('/[^-_0-9a-zA-Z]/','',$populate_lead_owner);
	$areacode_filter = preg_replace('/[^-_0-9a-zA-Z]/','',$areacode_filter);
	$areacode_filter_action = preg_replace('/[^-_0-9a-zA-Z]/','',$areacode_filter_action);
	$report_id = preg_replace('/[^-_0-9a-zA-Z]/','',$report_id);
	$report_destination = preg_replace('/[^-_0-9a-zA-Z]/','',$report_destination);
	$report_times = preg_replace('/[^-_0-9a-zA-Z]/','',$report_times);
	$report_monthdays = preg_replace('/[^-_0-9a-zA-Z]/','',$report_monthdays);
	$populate_state_areacode = preg_replace('/[^-_0-9a-zA-Z]/','',$populate_state_areacode);
	$dl_id = preg_replace('/[^-_0-9a-zA-Z]/','',$dl_id);
	$duplicate_check = preg_replace('/[^-_0-9a-zA-Z]/','',$duplicate_check);
	$dl_times = preg_replace('/[^-_0-9a-zA-Z]/','',$dl_times);
	$dl_monthdays = preg_replace('/[^-_0-9a-zA-Z]/','',$dl_monthdays);
	$use_custom_cid = preg_replace('/[^-_0-9a-zA-Z]/','',$use_custom_cid);
	$system_ip_blacklist = preg_replace('/[^-_0-9a-zA-Z]/','',$system_ip_blacklist);
	$admin_ip_list = preg_replace('/[^-_0-9a-zA-Z]/','',$admin_ip_list);
	$agent_ip_list = preg_replace('/[^-_0-9a-zA-Z]/','',$agent_ip_list);
	$api_ip_list = preg_replace('/[^-_0-9a-zA-Z]/','',$api_ip_list);
	$ip_list_id = preg_replace('/[^-_0-9a-zA-Z]/','',$ip_list_id);
	$inbound_survey_callmenu = preg_replace('/[^-_0-9a-zA-Z]/','',$inbound_survey_callmenu);
	$filename_override = preg_replace('/[^-_0-9a-zA-Z]/','',$filename_override);
	$did_id = preg_replace('/[^-_0-9a-zA-Z]/','',$did_id);
	$extension_appended_cidname = preg_replace('/[^-_0-9a-zA-Z]/','',$extension_appended_cidname);
	$max_inbound_calls_outcome = preg_replace('/[^-_0-9a-zA-Z]/','',$max_inbound_calls_outcome);
	$manual_auto_next_options = preg_replace('/[^-_0-9a-zA-Z]/','',$manual_auto_next_options);
	$agent_screen_time_display = preg_replace('/[^-_0-9a-zA-Z]/','',$agent_screen_time_display);
	$get_call_launch = preg_replace('/[^-_0-9a-zA-Z]/','',$get_call_launch);
	$next_dial_my_callbacks = preg_replace('/[^-_0-9a-zA-Z]/','',$next_dial_my_callbacks);
	$anyone_callback_inactive_lists = preg_replace('/[^-_0-9a-zA-Z]/','',$anyone_callback_inactive_lists);
	$inbound_no_agents_no_dial_container = preg_replace('/[^-_0-9a-zA-Z]/','',$inbound_no_agents_no_dial_container);
	$closing_time_action = preg_replace('/[^-_0-9a-zA-Z]/','',$closing_time_action);
	$closing_time_option_exten = preg_replace('/[^-_0-9a-zA-Z]/','',$closing_time_option_exten);
	$closing_time_option_callmenu = preg_replace('/[^-_0-9a-zA-Z]/','',$closing_time_option_callmenu);
	$closing_time_option_voicemail = preg_replace('/[^-_0-9a-zA-Z]/','',$closing_time_option_voicemail);
	$closing_time_option_callback_list_id = preg_replace('/[^-_0-9a-zA-Z]/','',$closing_time_option_callback_list_id);
	$icbq_call_time_id = preg_replace('/[^-_0-9a-zA-Z]/','',$icbq_call_time_id);
	$add_lead_timezone = preg_replace('/[^-_0-9a-zA-Z]/','',$add_lead_timezone);
	$icbq_dial_filter = preg_replace('/[^-_0-9a-zA-Z]/','',$icbq_dial_filter);
	$cid_group_id = preg_replace('/[^-_0-9a-zA-Z]/','',$cid_group_id);
	$cid_group_id_two = preg_replace('/[^-_0-9a-zA-Z]/','',$cid_group_id_two);
	$cid_group_type = preg_replace('/[^-_0-9a-zA-Z]/','',$cid_group_type);
	$populate_lead_source = preg_replace('/[^-_0-9a-zA-Z]/','',$populate_lead_source);
	$dead_trigger_action = preg_replace('/[^-_0-9a-zA-Z]/','',$dead_trigger_action);
	$dead_trigger_repeat = preg_replace('/[^-_0-9a-zA-Z]/','',$dead_trigger_repeat);
	$cid_cb_confirm_number = preg_replace('/[^-_0-9a-zA-Z]/','',$cid_cb_confirm_number);
	$cid_cb_invalid_filter_phone_group = preg_replace('/[^-_0-9a-zA-Z]/','',$cid_cb_invalid_filter_phone_group);
	$scheduled_callbacks_auto_reschedule = preg_replace('/[^-_0-9a-zA-Z]/','',$scheduled_callbacks_auto_reschedule);
	$scheduled_callbacks_timezones_container = preg_replace('/[^-_0-9a-zA-Z]/','',$scheduled_callbacks_timezones_container);
	$three_way_volume_buttons = preg_replace('/[^-_0-9a-zA-Z]/','',$three_way_volume_buttons);
	$callback_dnc = preg_replace('/[^-_0-9a-zA-Z]/','',$callback_dnc);
	$hide_call_log_info = preg_replace('/[^-_0-9a-zA-Z]/','',$hide_call_log_info);
	$call_quota_lead_ranking = preg_replace('/[^-_0-9a-zA-Z]/','',$call_quota_lead_ranking);
	$sip_event_logging = preg_replace('/[^-_0-9a-zA-Z]/','',$sip_event_logging);
	$auto_active_list_new = preg_replace('/[^-_0-9a-zA-Z]/','',$auto_active_list_new);
	$script_id = preg_replace('/[^-_0-9a-zA-Z]/','',$script_id);
	$ingroup_script = preg_replace('/[^-_0-9a-zA-Z]/','',$ingroup_script);
	$ingroup_script_two = preg_replace('/[^-_0-9a-zA-Z]/','',$ingroup_script_two);
	$campaign_script = preg_replace('/[^-_0-9a-zA-Z]/','',$campaign_script);
	$campaign_script_two = preg_replace('/[^-_0-9a-zA-Z]/','',$campaign_script_two);
	$leave_vm_message_group_id = preg_replace('/[^-_0-9a-zA-Z]/','',$leave_vm_message_group_id);
	$dial_timeout_lead_container = preg_replace('/[^-_0-9a-zA-Z]/','',$dial_timeout_lead_container);
	$amd_type = preg_replace('/[^-_0-9a-zA-Z]/','',$amd_type);
	$recording_buttons = preg_replace('/[^-_0-9a-zA-Z]/','',$recording_buttons);
	$use_other_campaign_dnc = preg_replace('/[^-_0-9a-zA-Z]/','',$use_other_campaign_dnc);
	$browser_alert_sound = preg_replace('/[^-_0-9a-zA-Z]/','',$browser_alert_sound);
	$three_way_record_stop_exception = preg_replace('/[^-_0-9a-zA-Z]/','',$three_way_record_stop_exception);
	$queuemetrics_pausereason = preg_replace('/[^-_0-9a-zA-Z]/','',$queuemetrics_pausereason);
	$answer_signal = preg_replace('/[^-_0-9a-zA-Z]/','',$answer_signal);
	$inbound_drop_voicemail = preg_replace('/[^-_0-9a-zA-Z]/','',$inbound_drop_voicemail);
	$inbound_after_hours_voicemail = preg_replace('/[^-_0-9a-zA-Z]/','',$inbound_after_hours_voicemail);
	$pause_max_exceptions = preg_replace('/[^-_0-9a-zA-Z]/','',$pause_max_exceptions);
	$two_factor_container = preg_replace('/[^-_0-9a-zA-Z]/','',$two_factor_container);
	$calls_inqueue_count_one = preg_replace('/[^-_0-9a-zA-Z]/','',$calls_inqueue_count_one);
	$calls_inqueue_count_two = preg_replace('/[^-_0-9a-zA-Z]/','',$calls_inqueue_count_two);
	$drop_call_seconds_override = preg_replace('/[^-_0-9a-zA-Z]/','',$drop_call_seconds_override);
	$in_man_dial_next_ready_seconds_override = preg_replace('/[^-_0-9a-zA-Z]/','',$in_man_dial_next_ready_seconds_override);
	$call_limit_24hour_method = preg_replace('/[^-_0-9a-zA-Z]/','',$call_limit_24hour_method);
	$call_limit_24hour_scope = preg_replace('/[^-_0-9a-zA-Z]/','',$call_limit_24hour_scope);
	$call_limit_24hour_override = preg_replace('/[^-_0-9a-zA-Z]/','',$call_limit_24hour_override);
	$in_queue_nanque_exceptions = preg_replace('/[^-_0-9a-zA-Z]/','',$in_queue_nanque_exceptions);
	$queue_group = preg_replace('/[^-_0-9a-zA-Z]/','',$queue_group);

	### ALPHA-NUMERIC and underscore 
	$qc_statuses_id = preg_replace('/[^_0-9a-zA-Z]/','',$qc_statuses_id);

	### ALPHA-NUMERIC and underscore and dash and slash and dot
	$menu_timeout_prompt = preg_replace('/[^-\/\|\._0-9a-zA-Z]/','',$menu_timeout_prompt);
	$menu_invalid_prompt = preg_replace('/[^-\/\|\._0-9a-zA-Z]/','',$menu_invalid_prompt);
	$after_hours_message_filename = preg_replace('/[^-\/\|\._0-9a-zA-Z]/','',$after_hours_message_filename);
	$welcome_message_filename = preg_replace('/[^-\/\|\._0-9a-zA-Z]/','',$welcome_message_filename);
	$onhold_prompt_filename = preg_replace('/[^-\/\|\._0-9a-zA-Z]/','',$onhold_prompt_filename);
	$hold_time_option_callback_filename = preg_replace('/[^-\/\|\._0-9a-zA-Z]/','',$hold_time_option_callback_filename);
	$agent_alert_exten = preg_replace('/[^-\|\/\._0-9a-zA-Z]/','',$agent_alert_exten);
	$filename = preg_replace('/[^-\/\._0-9a-zA-Z]/','',$filename);
	$am_message_exten = preg_replace('/[^-\|\/\._0-9a-zA-Z]/','',$am_message_exten);
	$am_message_exten_override = preg_replace('/[^-\|\/\._0-9a-zA-Z]/','',$am_message_exten_override);
	$campaign_groups = preg_replace('/[^-\|\/\._0-9a-zA-Z]/','',$campaign_groups);
	$blind_monitor_filename = preg_replace('/[^-\|\/\._0-9a-zA-Z]/','',$blind_monitor_filename);
	$hold_time_option_press_filename = preg_replace('/[^-\|\/\._0-9a-zA-Z]/','',$hold_time_option_press_filename);
	$default_afterhours_filename_override = preg_replace('/[^-\|\/\._0-9a-zA-Z]/','',$default_afterhours_filename_override);
	$sunday_afterhours_filename_override = preg_replace('/[^-\|\/\._0-9a-zA-Z]/','',$sunday_afterhours_filename_override);
	$monday_afterhours_filename_override = preg_replace('/[^-\|\/\._0-9a-zA-Z]/','',$monday_afterhours_filename_override);
	$tuesday_afterhours_filename_override = preg_replace('/[^-\|\/\._0-9a-zA-Z]/','',$tuesday_afterhours_filename_override);
	$wednesday_afterhours_filename_override = preg_replace('/[^-\|\/\._0-9a-zA-Z]/','',$wednesday_afterhours_filename_override);
	$thursday_afterhours_filename_override = preg_replace('/[^-\|\/\._0-9a-zA-Z]/','',$thursday_afterhours_filename_override);
	$friday_afterhours_filename_override = preg_replace('/[^-\|\/\._0-9a-zA-Z]/','',$friday_afterhours_filename_override);
	$saturday_afterhours_filename_override = preg_replace('/[^-\|\/\._0-9a-zA-Z]/','',$saturday_afterhours_filename_override);
	$admin_web_directory = preg_replace('/[^-\|\/\._0-9a-zA-Z]/','',$admin_web_directory);
	$tts_voice = preg_replace('/[^-\|\/\._0-9a-zA-Z]/','',$tts_voice);
	$wait_time_option_callback_filename = preg_replace('/[^-\|\/\._0-9a-zA-Z]/','',$wait_time_option_callback_filename);
	$wait_time_option_press_filename = preg_replace('/[^-\|\/\._0-9a-zA-Z]/','',$wait_time_option_press_filename);
	$eht_minimum_prompt_filename = preg_replace('/[^-\|\/\._0-9a-zA-Z]/','',$eht_minimum_prompt_filename);
	$queuemetrics_phone_environment = preg_replace('/[^-\|\/\._0-9a-zA-Z]/','',$queuemetrics_phone_environment);
	$active_twin_server_ip = preg_replace('/[^-\|\/\._0-9a-zA-Z]/','',$active_twin_server_ip);
	$safe_harbor_audio = preg_replace('/[^-\/\|\._0-9a-zA-Z]/','',$safe_harbor_audio);
	$alt_log_server_ip = preg_replace('/[^-\/\|\._0-9a-zA-Z]/','',$alt_log_server_ip);
	$alt_log_dbname = preg_replace('/[^-\/\|\._0-9a-zA-Z]/','',$alt_log_dbname);
	$alt_log_login = preg_replace('/[^-\/\|\._0-9a-zA-Z]/','',$alt_log_login);
	$alt_log_pass = preg_replace('/[^-\/\|\._0-9a-zA-Z]/','',$alt_log_pass);
	$survey_first_audio_file = preg_replace('/[^-\/\|\._0-9a-zA-Z]/','',$survey_first_audio_file);
	$survey_opt_in_audio_file = preg_replace('/[^-\/\|\._0-9a-zA-Z]/','',$survey_opt_in_audio_file);
	$survey_ni_audio_file = preg_replace('/[^-\/\|\._0-9a-zA-Z]/','',$survey_ni_audio_file);
	$survey_third_audio_file = preg_replace('/[^-\/\|\._0-9a-zA-Z]/','',$survey_third_audio_file);
	$survey_fourth_audio_file = preg_replace('/[^-\/\|\._0-9a-zA-Z]/','',$survey_fourth_audio_file);
	$safe_harbor_audio_field = preg_replace('/[^-\/\|\._0-9a-zA-Z]/','',$safe_harbor_audio_field);
	$voicemail_greeting = preg_replace('/[^-\/\|\._0-9a-zA-Z]/','',$voicemail_greeting);
	$old_voicemail_greeting = preg_replace('/[^-\/\|\._0-9a-zA-Z]/','',$old_voicemail_greeting);
	$meetme_enter_login_filename = preg_replace('/[^-\/\|\._0-9a-zA-Z]/','',$meetme_enter_login_filename);
	$meetme_enter_leave3way_filename = preg_replace('/[^-\/\|\._0-9a-zA-Z]/','',$meetme_enter_leave3way_filename);
	$nva_error_filename = preg_replace('/[^-\/\|\._0-9a-zA-Z]/','',$nva_error_filename);
	$inbound_survey_filename = preg_replace('/[^-\/\|\._0-9a-zA-Z]/','',$inbound_survey_filename);
	$inbound_survey_question_filename = preg_replace('/[^-\/\|\._0-9a-zA-Z]/','',$inbound_survey_question_filename);
	$closing_time_filename = preg_replace('/[^-\/\|\._0-9a-zA-Z]/','',$closing_time_filename);
	$closing_time_end_filename = preg_replace('/[^-\/\|\._0-9a-zA-Z]/','',$closing_time_end_filename);
	$dead_trigger_filename = preg_replace('/[^-\/\|\._0-9a-zA-Z]/','',$dead_trigger_filename);
	$cid_cb_valid_filename = preg_replace('/[^-\/\|\._0-9a-zA-Z]/','',$cid_cb_valid_filename);
	$cid_cb_confirmed_filename = preg_replace('/[^-\/\|\._0-9a-zA-Z]/','',$cid_cb_confirmed_filename);
	$cid_cb_enter_filename = preg_replace('/[^-\/\|\._0-9a-zA-Z]/','',$cid_cb_enter_filename);
	$cid_cb_you_entered_filename = preg_replace('/[^-\/\|\._0-9a-zA-Z]/','',$cid_cb_you_entered_filename);
	$cid_cb_press_to_confirm_filename = preg_replace('/[^-\/\|\._0-9a-zA-Z]/','',$cid_cb_press_to_confirm_filename);
	$cid_cb_invalid_filename = preg_replace('/[^-\/\|\._0-9a-zA-Z]/','',$cid_cb_invalid_filename);
	$cid_cb_reenter_filename = preg_replace('/[^-\/\|\._0-9a-zA-Z]/','',$cid_cb_reenter_filename);
	$cid_cb_error_filename = preg_replace('/[^-\/\|\._0-9a-zA-Z]/','',$cid_cb_error_filename);
	$place_in_line_caller_number_filename = preg_replace('/[^-\/\|\._0-9a-zA-Z]/','',$place_in_line_caller_number_filename);
	$place_in_line_you_next_filename = preg_replace('/[^-\/\|\._0-9a-zA-Z]/','',$place_in_line_you_next_filename);
	$audio_filename = preg_replace('/[^-\/\|\._0-9a-zA-Z]/','',$audio_filename);

	### ALPHA-NUMERIC and underscore and dash and slash and dot and comma
	$menu_prompt = preg_replace('/[^-\/\|\,\._0-9a-zA-Z]/','',$menu_prompt);

	### ALPHA-NUMERIC and underscore and dash and comma
	$logins_list = preg_replace('/[^-\,\_0-9a-zA-Z]/','',$logins_list);
	$forced_timeclock_login = preg_replace('/[^-\,\_0-9a-zA-Z]/','',$forced_timeclock_login);
	$uniqueid_status_prefix = preg_replace('/[^-\,\_0-9a-zA-Z]/','',$uniqueid_status_prefix);

	### ALPHA-NUMERIC and spaces
	$lead_order = preg_replace('/[^ 0-9a-zA-Z]/','',$lead_order);
	### ALPHA-NUMERIC and spaces and dashes and underscores
	$preset_name = preg_replace('/[^- \_0-9a-zA-Z]/','',$preset_name);
	$selected_language = preg_replace('/[^- \_0-9a-zA-Z]/','',$selected_language);
	$default_language = preg_replace('/[^- \_0-9a-zA-Z]/','',$default_language);
	$opensips_cid_name = preg_replace('/[^- \_0-9a-zA-Z]/','',$opensips_cid_name);

	### ALPHA-NUMERIC and hash
	$group_color = preg_replace('/[^\#0-9a-zA-Z]/','',$group_color);
	$script_color = preg_replace('/[^\#0-9a-zA-Z]/','',$script_color);
	### ALPHA-NUMERIC and hash and star and dot and underscore
	$hold_time_option_exten = preg_replace('/[^\*\#\.\_0-9a-zA-Z]/','',$hold_time_option_exten);
	$voicemail_ext = preg_replace('/[^\*\#\.\_0-9a-zA-Z]/','',$voicemail_ext);
	$phone = preg_replace('/[^\*\#\.\_0-9a-zA-Z]/','',$phone);
	$phone_code = preg_replace('/[^\*\#\.\_0-9a-zA-Z]/','',$phone_code);
	$wait_time_option_exten = preg_replace('/[^\*\#\.\_0-9a-zA-Z]/','',$wait_time_option_exten);
	$filter_voicemail_ext = preg_replace('/[^\*\#\.\_0-9a-zA-Z]/','',$filter_voicemail_ext);
	$filter_phone_code = preg_replace('/[^\*\#\.\_0-9a-zA-Z]/','',$filter_phone_code);
	$filter_phone = preg_replace('/[^\*\#\.\_0-9a-zA-Z]/','',$filter_phone);
	$preset_number = preg_replace('/[^\*\#\.\_0-9a-zA-Z]/','',$preset_number);
	$no_agent_ingroup_extension = preg_replace('/[^\*\#\.\_0-9a-zA-Z]/','',$no_agent_ingroup_extension);
	$pre_filter_extension = preg_replace('/[^\*\#\.\_0-9a-zA-Z]/','',$pre_filter_extension);
	$max_queue_ingroup_extension = preg_replace('/[^\*\#\.\_0-9a-zA-Z]/','',$max_queue_ingroup_extension);
	$report_server = preg_replace('/[^\*\#\.\_0-9a-zA-Z]/','',$report_server);
	$dl_server = preg_replace('/[^\*\#\.\_0-9a-zA-Z]/','',$dl_server);

	### ALPHA-NUMERIC and hash and star and dot and underscore and colon and plus sign
	$did_pattern = preg_replace('/[^:\+\*\#\.\_0-9a-zA-Z]/','',$did_pattern);
	$web_loader_phone_strip = preg_replace('/[^:\+\*\#\.\_0-9a-zA-Z]/','',$web_loader_phone_strip);
	$manual_dial_phone_strip = preg_replace('/[^:\+\*\#\.\_0-9a-zA-Z]/','',$manual_dial_phone_strip);
	$mobile_number = preg_replace('/[^:\+\*\#\.\_0-9a-zA-Z]/','',$mobile_number);

	### ALPHA-NUMERIC and spaces dots, commas, dashes, underscores
	$adaptive_dl_diff_target = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$adaptive_dl_diff_target);
	$adaptive_intensity = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$adaptive_intensity);
	$asterisk_version = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$asterisk_version);
	$call_time_comments = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$call_time_comments);
	$call_time_name = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$call_time_name);
	$campaign_name = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$campaign_name);
	$campaign_rec_filename = preg_replace('/[^-\.\_0-9a-zA-Z]/','',$campaign_rec_filename);
	$ingroup_rec_filename = preg_replace('/[^-\.\_0-9a-zA-Z]/','',$ingroup_rec_filename);
	$company = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$company);
	$full_name = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$full_name);
	$fullname = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$fullname);
	$group_name = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$group_name);
	$HKstatus = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$HKstatus);
	$lead_filter_comments = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$lead_filter_comments);
	$lead_filter_name = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$lead_filter_name);
	$list_name = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$list_name);
	$local_gmt = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$local_gmt);
	$new_fullname = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$new_fullname);
	$phone_type = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$phone_type);
	$picture = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$picture);
	$script_comments = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$script_comments);
	$script_name = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$script_name);
	$server_description = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$server_description);
	$status = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$status);
	$status_name = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$status_name);
	$wrapup_message = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$wrapup_message);
	$pause_code_name = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$pause_code_name);
	$campaign_description = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$campaign_description);
	$list_description = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$list_description);
	$vcl_name = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$vcl_name);
	$vsc_name = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$vsc_name);
	$vsc_description = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$vsc_description);
	$code_name = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$code_name);
	$alias_name = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$alias_name);
	$shift_name = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$shift_name);
	$did_description = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$did_description);
	$template_name = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$template_name);
	$carrier_name = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$carrier_name);
	$group_alias_name = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$group_alias_name);
	$caller_id_name = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$caller_id_name);
	$user_code = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$user_code);
	$territory = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$territory);
	$tts_name = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$tts_name);
	$moh_name = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$moh_name);
	$timer_action_message = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$timer_action_message);
	$default_codecs = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$default_codecs);
	$codecs_list = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$codecs_list);
	$label_title = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$label_title);
	$label_first_name = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$label_first_name);
	$label_middle_initial = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$label_middle_initial);
	$label_last_name = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$label_last_name);
	$label_address1 = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$label_address1);
	$label_address2 = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$label_address2);
	$label_address3 = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$label_address3);
	$label_city = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$label_city);
	$label_state = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$label_state);
	$label_province = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$label_province);
	$label_postal_code = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$label_postal_code);
	$label_vendor_lead_code = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$label_vendor_lead_code);
	$label_gender = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$label_gender);
	$label_phone_number = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$label_phone_number);
	$label_phone_code = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$label_phone_code);
	$label_alt_phone = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$label_alt_phone);
	$label_security_phrase = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$label_security_phrase);
	$label_email = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$label_email);
	$label_comments = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$label_comments);
	$slave_db_server = preg_replace('/[^- \.\,\:\_0-9a-zA-Z]/','',$slave_db_server);
	$filter_phone_group_name = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$filter_phone_group_name);
	$filter_phone_group_description = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$filter_phone_group_description);
	$filter_clean_cid_number = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$filter_clean_cid_number);
	$label_name = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$label_name);
	$default_local_gmt = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$default_local_gmt);
	$cid_description = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$cid_description);
	$description = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$description);
	$first_name = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$first_name);
	$last_name = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$last_name);
	$bu_name = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$bu_name);
	$department = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$department);
	$group = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$group);
	$job_title = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$job_title);
	$location = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$location);
	$holiday_name = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$holiday_name);
	$holiday_comments = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$holiday_comments);
	$api_allowed_functions = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$api_allowed_functions);
	$agent_display_fields = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$agent_display_fields);
	$container_notes = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$container_notes);
	$did_carrier_description = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$did_carrier_description);
	$status_group_notes = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$status_group_notes);
	$colors_name = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$colors_name);
	$web_logo = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$web_logo);
	$user_nickname = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$user_nickname);
	$customer_chat_survey_text = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$customer_chat_survey_text);
	$agent_script = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$agent_script);
	$report_name = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$report_name);
	$dl_name = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$dl_name);
	$drop_status = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$drop_status);
	$ip_list_name = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$ip_list_name);
	$cid_group_notes = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$cid_group_notes);
	$populate_lead_vendor = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$populate_lead_vendor);
	$leave_vm_message_group_notes = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$leave_vm_message_group_notes);
	$audio_name = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$audio_name);
	$populate_lead_comments = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$populate_lead_comments);
	$label_lead_id = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$label_lead_id);
	$label_list_id = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$label_list_id);
	$label_entry_date = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$label_entry_date);
	$label_gmt_offset_now = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$label_gmt_offset_now);
	$label_source_id = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$label_source_id);
	$label_called_since_last_reset = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$label_called_since_last_reset);
	$label_status = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$label_status);
	$label_user = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$label_user);
	$label_date_of_birth = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$label_date_of_birth);
	$label_country_code = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$label_country_code);
	$label_last_local_call_time = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$label_last_local_call_time);
	$label_called_count = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$label_called_count);
	$label_rank = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$label_rank);
	$label_owner = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$label_owner);
	$label_entry_list_id = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$label_entry_list_id);
	$user_location = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$user_location);
	$queue_group_name = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$queue_group_name);
	$qc_scorecard_id = preg_replace('/[^- \.\,\_0-9a-zA-Z]/','',$qc_scorecard_id);

	### ALPHA-NUMERIC and underscore and dash and slash and at and dot
	$call_out_number_group = preg_replace('/[^-\.\:\/\@\_0-9a-zA-Z]/','',$call_out_number_group);
	$client_browser = preg_replace('/[^-\.\:\/\@\_0-9a-zA-Z]/','',$client_browser);
	$DBX_server = preg_replace('/[^-\.\:\/\@\_0-9a-zA-Z]/','',$DBX_server);
	$DBY_server = preg_replace('/[^-\.\:\/\@\_0-9a-zA-Z]/','',$DBY_server);
	$dtmf_send_extension = preg_replace('/[^-\.\:\/\@\_0-9a-zA-Z]/','',$dtmf_send_extension);
	$install_directory = preg_replace('/[^-\.\:\/\@\_0-9a-zA-Z]/','',$install_directory);
	$old_extension = preg_replace('/[^-\.\:\/\@\_0-9a-zA-Z]/','',$old_extension);
	$telnet_host = preg_replace('/[^-\.\:\/\@\_0-9a-zA-Z]/','',$telnet_host);
	$queuemetrics_dbname = preg_replace('/[^-\.\:\/\@\_0-9a-zA-Z]/','',$queuemetrics_dbname);
	$queuemetrics_login = preg_replace('/[^-\.\:\/\@\_0-9a-zA-Z]/','',$queuemetrics_login);
	$queuemetrics_pass = preg_replace('/[^-\.\:\/\@\_0-9a-zA-Z]/','',$queuemetrics_pass);
	$email = preg_replace('/[^-\.\:\/\@\_0-9a-zA-Z]/','',$email);
	$vtiger_dbname = preg_replace('/[^-\.\:\/\@\_0-9a-zA-Z]/','',$vtiger_dbname);
	$vtiger_login = preg_replace('/[^-\.\:\/\@\_0-9a-zA-Z]/','',$vtiger_login);
	$vtiger_pass = preg_replace('/[^-\.\:\/\@\_0-9a-zA-Z]/','',$vtiger_pass);
	$external_server_ip = preg_replace('/[^-\.\:\/\@\_0-9a-zA-Z]/','',$external_server_ip);
	$alt_server_ip = preg_replace('/[^-\.\:\/\@\_0-9a-zA-Z]/','',$alt_server_ip);
	$email_from = preg_replace('/[^-\.\:\/\@\_0-9a-zA-Z]/','',$email_from);
	$email_to = preg_replace('/[^-\.\:\/\@\_0-9a-zA-Z]/','',$email_to);
	$ftp_server = preg_replace('/[^-\.\:\/\@\_0-9a-zA-Z]/','',$ftp_server);
	$ftp_directory = preg_replace('/[^-\.\:\/\@\_0-9a-zA-Z]/','',$ftp_directory);

	### ALPHA-NUMERIC and underscore and dash and slash and at and dot and space
	$custom_one = preg_replace('/[^- \.\:\/\@\_0-9a-zA-Z]/','',$custom_one);
	$custom_two = preg_replace('/[^- \.\:\/\@\_0-9a-zA-Z]/','',$custom_two);
	$custom_three = preg_replace('/[^- \.\:\/\@\_0-9a-zA-Z]/','',$custom_three);
	$custom_four = preg_replace('/[^- \.\:\/\@\_0-9a-zA-Z]/','',$custom_four);
	$custom_five = preg_replace('/[^- \.\:\/\@\_0-9a-zA-Z]/','',$custom_five);
	$email_subject = preg_replace('/[^- \.\:\/\@\_0-9a-zA-Z]/','',$email_subject);

	### ALPHA-NUMERIC and underscore and dash and slash and at and dot and pound and star
	$extension = preg_replace('/[^-\*\#\.\:\/\@\_0-9a-zA-Z]/','',$extension);
	$new_extension = preg_replace('/[^-\*\#\.\:\/\@\_0-9a-zA-Z]/','',$new_extension);
	$timer_action_destination = preg_replace('/[^-\*\#\.\:\/\@\_0-9a-zA-Z]/','',$timer_action_destination);
	$filter_extension = preg_replace('/[^-\*\#\.\:\/\@\_0-9a-zA-Z]/','',$filter_extension);

	### ALPHA-NUMERIC and space and underscore and dash and slash and at and dot and pound and star and pipe and comma
	$ivr_park_call_agi = preg_replace('/[^- \*\#\.\,\:\/\|\@\_0-9a-zA-Z]/','',$ivr_park_call_agi);
	$source_phone = preg_replace('/[^- \*\#\.\,\:\/\|\@\_0-9a-zA-Z]/','',$source_phone);

	### ALPHA-NUMERIC and space and underscore and dash and slash and at and dot and pound and star and pipe and comma and equal
	$voicemail_options = preg_replace('/[^- \=\*\#\.\,\:\/\|\@\_0-9a-zA-Z]/','',$voicemail_options);

	### NUMERIC and comma and pipe
	$waitforsilence_options = preg_replace('/[^\|\,0-9a-zA-Z]/','',$waitforsilence_options);

	### value cleaning
	$no_agent_action_value = preg_replace('/[^-\/\|\_\#\*\,\.\_0-9a-zA-Z]/','',$no_agent_action_value);
	$areacode_filter_action_value = preg_replace('/[^-\/\|\_\#\*\,\.\_0-9a-zA-Z]/','',$areacode_filter_action_value);

	### ALPHA-NUMERIC and underscore and dash and slash and at and space and colon
	$vdc_header_date_format = preg_replace('/[^- \:\/\_0-9a-zA-Z]/','',$vdc_header_date_format);
	$vdc_customer_date_format = preg_replace('/[^- \:\/\_0-9a-zA-Z]/','',$vdc_customer_date_format);
	$menu_name = preg_replace('/[^- \:\/\_0-9a-zA-Z]/','',$menu_name);

	### ALPHA-NUMERIC and underscore and dash and at and space and parantheses
	$vdc_header_phone_format = preg_replace('/[^- \(\)\_0-9a-zA-Z]/', '',$vdc_header_phone_format);

	### ALPHA-NUMERIC and newlines
	$areacode_list = preg_replace('/[^\n0-9a-zA-Z]/', '',$areacode_list);

	### ALPHA-NUMERIC and newlines and period and colon
	$ip_address = preg_replace('/[^\n\.\:\0-9a-zA-Z]/', '',$ip_address);
	}
else
	{
	### ALPHA-NUMERIC ONLY ###
	$is_webphone = preg_replace('/[^-_0-9\p{L}]/u','',$is_webphone);
	$agent_script_override = preg_replace('/[^0-9\p{L}]/u','',$agent_script_override);
	$campaign_script = preg_replace('/[^0-9\p{L}]/u','',$campaign_script);
	$submit = preg_replace('/[^0-9\p{L}]/u','',$submit);
	$campaign_cid = preg_replace('/[^0-9\p{L}]/u','',$campaign_cid);
	$campaign_recording = preg_replace('/[^0-9\p{L}]/u','',$campaign_recording);
	$ADD = preg_replace('/[^0-9\p{L}]/u','',$ADD);
	$dial_prefix = preg_replace('/[^0-9\p{L}]/u','',$dial_prefix);
	$state_call_time_state = preg_replace('/[^0-9\p{L}]/u','',$state_call_time_state);
	$scheduled_callbacks = preg_replace('/[^0-9\p{L}]/u','',$scheduled_callbacks);
	$concurrent_transfers = preg_replace('/[^0-9\p{L}]/u','',$concurrent_transfers);
	$billable = preg_replace('/[^0-9\p{L}]/u','',$billable);
	$pause_code = preg_replace('/[^0-9\p{L}]/u','',$pause_code);
	$vicidial_recording_override = preg_replace('/[^0-9\p{L}]/u','',$vicidial_recording_override);
	$ingroup_recording_override = preg_replace('/[^0-9\p{L}]/u','',$ingroup_recording_override);
	$queuemetrics_log_id = preg_replace('/[^0-9\p{L}]/u','',$queuemetrics_log_id);
	$after_hours_exten = preg_replace('/[^0-9\p{L}]/u','',$after_hours_exten);
	$after_hours_voicemail = preg_replace('/[^0-9\p{L}]/u','',$after_hours_voicemail);
	$qc_script = preg_replace('/[^0-9\p{L}]/u','',$qc_script);
	$code = preg_replace('/[^0-9\p{L}]/u','',$code);
	$survey_no_response_action = preg_replace('/[^0-9\p{L}]/u','',$survey_no_response_action);
	$survey_ni_status = preg_replace('/[^0-9\p{L}]/u','',$survey_ni_status);
	$qc_get_record_launch = preg_replace('/[^0-9\p{L}]/u','',$qc_get_record_launch);
	$agent_pause_codes_active = preg_replace('/[^0-9\p{L}]/u','',$agent_pause_codes_active);
	$three_way_dial_prefix = preg_replace('/[^0-9\p{L}]/u','',$three_way_dial_prefix);
	$agent_shift_enforcement_override = preg_replace('/[^0-9\p{L}]/u','',$agent_shift_enforcement_override);
	$survey_third_status = preg_replace('/[^0-9\p{L}]/u','',$survey_third_status);
	$survey_fourth_status = preg_replace('/[^0-9\p{L}]/u','',$survey_fourth_status);
	$sounds_web_directory = preg_replace('/[^0-9\p{L}]/u','',$sounds_web_directory);
	$disable_alter_custphone = preg_replace('/[^0-9\p{L}]/u','',$disable_alter_custphone);
	$view_calls_in_queue = preg_replace('/[^0-9\p{L}]/u','',$view_calls_in_queue);
	$view_calls_in_queue_launch = preg_replace('/[^0-9\p{L}]/u','',$view_calls_in_queue_launch);
	$grab_calls_in_queue = preg_replace('/[^0-9\p{L}]/u','',$grab_calls_in_queue);
	$call_requeue_button = preg_replace('/[^0-9\p{L}]/u','',$call_requeue_button);
	$pause_after_each_call = preg_replace('/[^0-9\p{L}]/u','',$pause_after_each_call);
	$use_internal_dnc = preg_replace('/[^0-9\p{L}]/u','',$use_internal_dnc);
	$use_campaign_dnc = preg_replace('/[^0-9\p{L}]/u','',$use_campaign_dnc);
	$new_voicemail_id = preg_replace('/[^0-9\p{L}]/u','',$new_voicemail_id);
	$voicemail_id = preg_replace('/[^0-9a-zA-Z]/','',$voicemail_id);
	$status_id = preg_replace('/[^0-9\p{L}]/u','',$status_id);
	$agent_call_log_view = preg_replace('/[^0-9\p{L}]/u','',$agent_call_log_view);
	$agent_call_log_view_override = preg_replace('/[^0-9\p{L}]/u','',$agent_call_log_view_override);
	$queuemetrics_loginout = preg_replace('/[^0-9\p{L}]/u','',$queuemetrics_loginout);
	$queuemetrics_callstatus = preg_replace('/[^0-9\p{L}]/u','',$queuemetrics_callstatus);
	$hide_xfer_number_to_dial = preg_replace('/[^0-9\p{L}]/u','',$hide_xfer_number_to_dial);
	$manual_dial_prefix = preg_replace('/[^0-9\p{L}]/u','',$manual_dial_prefix);
	$customer_3way_hangup_logging = preg_replace('/[^0-9\p{L}]/u','',$customer_3way_hangup_logging);
	$customer_3way_hangup_action = preg_replace('/[^0-9\p{L}]/u','',$customer_3way_hangup_action);
	$queuemetrics_dispo_pause = preg_replace('/[^0-9\p{L}]/u','',$queuemetrics_dispo_pause);
	$per_call_notes = preg_replace('/[^0-9\p{L}]/u','',$per_call_notes);
	$my_callback_option = preg_replace('/[^0-9\p{L}]/u','',$my_callback_option);
	$auto_pause_precall_code = preg_replace('/[^0-9\p{L}]/u','',$auto_pause_precall_code);
	$disable_dispo_status = preg_replace('/[^0-9\p{L}]/u','',$disable_dispo_status);
	$action_xfer_cid = preg_replace('/[^0-9\p{L}]/u','',$action_xfer_cid);
	$callback_list_calltime = preg_replace('/[^0-9\p{L}]/u','',$callback_list_calltime);
	$pause_after_next_call = preg_replace('/[^0-9\p{L}]/u','',$pause_after_next_call);
	$owner_populate = preg_replace('/[^0-9\p{L}]/u','',$owner_populate);
	$dead_max_dispo = preg_replace('/[^0-9\p{L}]/u','',$dead_max_dispo);
	$dispo_max_dispo = preg_replace('/[^0-9\p{L}]/u','',$dispo_max_dispo);
	$wrapup_bypass = preg_replace('/[^0-9\p{L}]/u','',$wrapup_bypass);
	$wrapup_after_hotkey = preg_replace('/[^0-9\p{L}]/u','',$wrapup_after_hotkey);
	$show_previous_callback = preg_replace('/[^0-9\p{L}]/u','',$show_previous_callback);
	$clear_script = preg_replace('/[^0-9\p{L}]/u','',$clear_script);
	$allow_chats = preg_replace('/[^0-9\p{L}]/u','',$allow_chats);
	$allow_emails = preg_replace('/[^0-9\p{L}]/u','',$allow_emails);
	$status_display_ingroup = preg_replace('/[^0-9\p{L}]/u','',$status_display_ingroup);
	$populate_lead_ingroup = preg_replace('/[^0-9\p{L}]/u','',$populate_lead_ingroup);
	$nva_new_status = preg_replace('/[^0-9\p{L}]/u','',$nva_new_status);
	$report_default_format = preg_replace('/[^0-9\p{L}]/u','',$report_default_format);
	$menu_background = preg_replace('/[^0-9\p{L}]/u','',$menu_background);
	$frame_background = preg_replace('/[^0-9\p{L}]/u','',$frame_background);
	$std_row1_background = preg_replace('/[^0-9\p{L}]/u','',$std_row1_background);
	$std_row2_background = preg_replace('/[^0-9\p{L}]/u','',$std_row2_background);
	$std_row3_background = preg_replace('/[^0-9\p{L}]/u','',$std_row3_background);
	$std_row4_background = preg_replace('/[^0-9\p{L}]/u','',$std_row4_background);
	$std_row5_background = preg_replace('/[^0-9\p{L}]/u','',$std_row5_background);
	$alt_row1_background = preg_replace('/[^0-9\p{L}]/u','',$alt_row1_background);
	$alt_row2_background = preg_replace('/[^0-9\p{L}]/u','',$alt_row2_background);
	$alt_row3_background = preg_replace('/[^0-9\p{L}]/u','',$alt_row3_background);
	$button_color = preg_replace('/[^0-9\p{L}]/u','',$button_color);
	$dead_to_dispo = preg_replace('/[^0-9\p{L}]/u','',$dead_to_dispo);
	$routing_prefix = preg_replace('/[^0-9\p{L}]/u','',$routing_prefix);
	$inbound_survey = preg_replace('/[^0-9\p{L}]/u','',$inbound_survey);
	$inbound_list_script_override = preg_replace('/[^0-9\p{L}]/u','',$inbound_list_script_override);
	$pause_max_dispo = preg_replace('/[^0-9\p{L}]/u','',$pause_max_dispo);
	$areacode = preg_replace('/[^0-9\p{L}]/u','',$areacode);
	$require_mgr_approval = preg_replace('/[^0-9\p{L}]/u','',$require_mgr_approval);
	$mute_recordings = preg_replace('/[^0-9\p{L}]/u','',$mute_recordings);
	$leave_vm_no_dispo = preg_replace('/[^0-9\p{L}]/u','',$leave_vm_no_dispo);
	$amd_agent_route_options = preg_replace('/[^0-9\p{L}]/u','',$amd_agent_route_options);

	### ALPHA-NUMERIC and spaces and hash and star and comma
	$xferconf_a_dtmf = preg_replace('/[^ \,\*\#0-9\p{L}]/u','',trim($xferconf_a_dtmf));
	$xferconf_b_dtmf = preg_replace('/[^ \,\*\#0-9\p{L}]/u','',trim($xferconf_b_dtmf));
	$xferconf_c_dtmf = preg_replace('/[^ \,\*\#0-9\p{L}]/u','',trim($xferconf_c_dtmf));
	$xferconf_d_dtmf = preg_replace('/[^ \,\*\#0-9\p{L}]/u','',trim($xferconf_d_dtmf));
	$xferconf_e_dtmf = preg_replace('/[^ \,\*\#0-9\p{L}]/u','',trim($xferconf_e_dtmf));
	$survey_third_digit = preg_replace('/[^ \,\*\#0-9\p{L}]/u','',$survey_third_digit);
	$survey_fourth_digit = preg_replace('/[^ \,\*\#0-9\p{L}]/u','',$survey_fourth_digit);
	$survey_third_exten = preg_replace('/[^ \,\*\#0-9\p{L}]/u','',$survey_third_exten);
	$survey_fourth_exten = preg_replace('/[^ \,\*\#0-9\p{L}]/u','',$survey_fourth_exten);
	$preset_dtmf = preg_replace('/[^ \,\*\#0-9\p{L}]/u','',$preset_dtmf);

	### ALPHA-NUMERIC and underscore and dash
	$agi_output = preg_replace('/[^-_0-9\p{L}]/u','',$agi_output);
	$ASTmgrSECRET = preg_replace('/[^-_0-9\p{L}]/u','',$ASTmgrSECRET);
	$ASTmgrUSERNAME = preg_replace('/[^-_0-9\p{L}]/u','',$ASTmgrUSERNAME);
	$ASTmgrUSERNAMElisten = preg_replace('/[^-_0-9\p{L}]/u','',$ASTmgrUSERNAMElisten);
	$ASTmgrUSERNAMEsend = preg_replace('/[^-_0-9\p{L}]/u','',$ASTmgrUSERNAMEsend);
	$ASTmgrUSERNAMEupdate = preg_replace('/[^-_0-9\p{L}]/u','',$ASTmgrUSERNAMEupdate);
	$call_time_id = preg_replace('/[^-_0-9\p{L}]/u','',$call_time_id);
	$campaign_id = preg_replace('/[^-_0-9\p{L}]/u','',$campaign_id);
	$CoNfIrM = preg_replace('/[^-_0-9\p{L}]/u','',$CoNfIrM);
	$DBX_database = preg_replace('/[^-_0-9\p{L}]/u','',$DBX_database);
	$DBX_pass = preg_replace('/[^-_0-9\p{L}]/u','',$DBX_pass);
	$DBX_user = preg_replace('/[^-_0-9\p{L}]/u','',$DBX_user);
	$DBY_database = preg_replace('/[^-_0-9\p{L}]/u','',$DBY_database);
	$DBY_pass = preg_replace('/[^-_0-9\p{L}]/u','',$DBY_pass);
	$DBY_user = preg_replace('/[^-_0-9\p{L}]/u','',$DBY_user);
	$dial_method = preg_replace('/[^-_0-9\p{L}]/u','',$dial_method);
	$dial_status_a = preg_replace('/[^-_0-9\p{L}]/u','',$dial_status_a);
	$dial_status_b = preg_replace('/[^-_0-9\p{L}]/u','',$dial_status_b);
	$dial_status_c = preg_replace('/[^-_0-9\p{L}]/u','',$dial_status_c);
	$dial_status_d = preg_replace('/[^-_0-9\p{L}]/u','',$dial_status_d);
	$dial_status_e = preg_replace('/[^-_0-9\p{L}]/u','',$dial_status_e);
	$ext_context = preg_replace('/[^-_0-9\p{L}]/u','',$ext_context);
	$group_id = preg_replace('/[^-_0-9\p{L}]/u','',$group_id);
	$lead_filter_id = preg_replace('/[^-_0-9\p{L}]/u','',$lead_filter_id);
	$local_call_time = preg_replace('/[^-_0-9\p{L}]/u','',$local_call_time);
	$login = preg_replace('/[^-_0-9\p{L}]/u','',$login);
	$login_campaign = preg_replace('/[^-_0-9\p{L}]/u','',$login_campaign);
	$login_pass = preg_replace('/[^-_0-9\p{L}]/u','',$login_pass);
	$login_user = preg_replace('/[^-_0-9\p{L}]/u','',$login_user);
	$new_login = preg_replace('/[^-_0-9\p{L}]/u','',$new_login);
	$new_pass = preg_replace('/[^-_0-9\p{L}]/u','',$new_pass);
	$next_agent_call = preg_replace('/[^-_0-9\p{L}]/u','',$next_agent_call);
	$old_campaign_id = preg_replace('/[^-_0-9\p{L}]/u','',$old_campaign_id);
	$old_server_id = preg_replace('/[^-_0-9\p{L}]/u','',$old_server_id);
	$OLDuser_group = preg_replace('/[^-_0-9\p{L}]/u','',$OLDuser_group);
	$park_file_name = preg_replace('/[^-_0-9\p{L}]/u','',$park_file_name);
	$pass = preg_replace('/[^-_0-9\p{L}]/u','',$pass);
	$phone_login = preg_replace('/[^-_0-9\p{L}]/u','',$phone_login);
	$phone_pass = preg_replace('/[^-_0-9\p{L}]/u','',$phone_pass);
	$PHP_AUTH_PW = preg_replace('/[^-_0-9\p{L}]/u','',$PHP_AUTH_PW);
	$PHP_AUTH_USER = preg_replace('/[^-_0-9\p{L}]/u','',$PHP_AUTH_USER);
	$protocol = preg_replace('/[^-_0-9\p{L}]/u','',$protocol);
	$server_id = preg_replace('/[^-_0-9\p{L}]/u','',$server_id);
	$stage = preg_replace('/[^-_0-9\p{L}]/u','',$stage);
	$state_rule = preg_replace('/[^-_0-9\p{L}]/u','',$state_rule);
	$holiday_rule = preg_replace('/[^-_0-9\p{L}]/u','',$holiday_rule);
	$trunk_restriction = preg_replace('/[^-_0-9\p{L}]/u','',$trunk_restriction);
	$user = preg_replace('/[^-_0-9\p{L}]/u','',$user);
	$user_group = preg_replace('/[^-_0-9\p{L}]/u','',$user_group);
	$VICIDIAL_park_on_filename = preg_replace('/[^-_0-9\p{L}]/u','',$VICIDIAL_park_on_filename);
	$auto_alt_dial = preg_replace('/[^-_0-9\p{L}]/u','',$auto_alt_dial);
	$dial_status = preg_replace('/[^-_0-9\p{L}]/u','',$dial_status);
	$queuemetrics_eq_prepend = preg_replace('/[^-_0-9\p{L}]/u','',$queuemetrics_eq_prepend);
	$vicidial_agent_disable = preg_replace('/[^-_0-9\p{L}]/u','',$vicidial_agent_disable);
	$alter_custdata_override = preg_replace('/[^-_0-9\p{L}]/u','',$alter_custdata_override);
	$list_order_mix = preg_replace('/[^-_0-9\p{L}]/u','',$list_order_mix);
	$vcl_id = preg_replace('/[^-_0-9\p{L}]/u','',$vcl_id);
	$mix_method = preg_replace('/[^-_0-9\p{L}]/u','',$mix_method);
	$category = preg_replace('/[^-_0-9\p{L}]/u','',$category);
	$vsc_id = preg_replace('/[^-_0-9\p{L}]/u','',$vsc_id);
	$moh_context = preg_replace('/[^-_0-9\p{L}]/u','',$moh_context);
	$source_campaign_id = preg_replace('/[^-_0-9\p{L}]/u','',$source_campaign_id);
	$source_user_id = preg_replace('/[^-_0-9\p{L}]/u','',$source_user_id);
	$source_group_id = preg_replace('/[^-_0-9\p{L}]/u','',$source_group_id);
	$default_xfer_group = preg_replace('/[^-_0-9\p{L}]/u','',$default_xfer_group);
	$drop_exten = preg_replace('/[^-_0-9\p{L}]/u','',$drop_exten);
	$safe_harbor_exten = preg_replace('/[^-_0-9\p{L}]/u','',$safe_harbor_exten);
	$drop_action = preg_replace('/[^-_0-9\p{L}]/u','',$drop_action);
	$drop_inbound_group = preg_replace('/[^-_0-9\p{L}]/u','',$drop_inbound_group);
	$afterhours_xfer_group = preg_replace('/[^-_0-9\p{L}]/u','',$afterhours_xfer_group);
	$after_hours_action = preg_replace('/[^-_0-9\p{L}]/u','',$after_hours_action);
	$alias_id = preg_replace('/[^-_0-9\p{L}]/u','',$alias_id);
	$shift_id = preg_replace('/[^-_0-9\p{L}]/u','',$shift_id);
	$qc_shift_id = preg_replace('/[^-_0-9\p{L}]/u','',$qc_shift_id);
	$survey_method = preg_replace('/[^-_0-9\p{L}]/u','',$survey_method);
	$alter_custphone_override = preg_replace('/[^-_0-9\p{L}]/u','',$alter_custphone_override);
	$manual_dial_filter = preg_replace('/[^-_0-9\p{L}]/u','',$manual_dial_filter);
	$manual_dial_search_filter = preg_replace('/[^-_0-9\p{L}]/u','',$manual_dial_search_filter);
	$agent_clipboard_copy = preg_replace('/[^-_0-9\p{L}]/u','',$agent_clipboard_copy);
	$hold_time_option = preg_replace('/[^-_0-9\p{L}]/u','',$hold_time_option);
	$hold_time_option_xfer_group = preg_replace('/[^-_0-9\p{L}]/u','',$hold_time_option_xfer_group);
	$hold_recall_xfer_group = preg_replace('/[^-_0-9\p{L}]/u','',$hold_recall_xfer_group);
	$play_welcome_message = preg_replace('/[^-_0-9\p{L}]/u','',$play_welcome_message);
	$did_route = preg_replace('/[^-_0-9\p{L}]/u','',$did_route);
	$user_unavailable_action = preg_replace('/[^-_0-9\p{L}]/u','',$user_unavailable_action);
	$user_route_settings_ingroup = preg_replace('/[^-_0-9\p{L}]/u','',$user_route_settings_ingroup);
	$call_handle_method = preg_replace('/[^-_0-9\p{L}]/u','',$call_handle_method);
	$agent_search_method = preg_replace('/[^-_0-9\p{L}]/u','',$agent_search_method);
	$hold_time_option_voicemail = preg_replace('/[^-_0-9\p{L}]/u','',$hold_time_option_voicemail);
	$exten_context = preg_replace('/[^-_0-9\p{L}]/u','',$exten_context);
	$three_way_call_cid = preg_replace('/[^-_0-9\p{L}]/u','',$three_way_call_cid);
	$web_form_target = preg_replace('/[^-_0-9\p{L}]/u','',$web_form_target);
	$recording_web_link = preg_replace('/[^-_0-9\p{L}]/u','',$recording_web_link);
	$vtiger_search_category = preg_replace('/[^-_0-9\p{L}]/u','',$vtiger_search_category);
	$vtiger_create_call_record = preg_replace('/[^-_0-9\p{L}]/u','',$vtiger_create_call_record);
	$vtiger_create_lead_record = preg_replace('/[^-_0-9\p{L}]/u','',$vtiger_create_lead_record);
	$vtiger_screen_login = preg_replace('/[^-_0-9\p{L}]/u','',$vtiger_screen_login);
	$cpd_amd_action = preg_replace('/[^-_0-9\p{L}]/u','',$cpd_amd_action);
	$cpd_unknown_action = preg_replace('/[^-_0-9\p{L}]/u','',$cpd_unknown_action);
	$template_id = preg_replace('/[^-_0-9\p{L}]/u','',$template_id);
	$carrier_id = preg_replace('/[^-_0-9\p{L}]/u','',$carrier_id);
	$source_carrier = preg_replace('/[^-_0-9\p{L}]/u','',$source_carrier);
	$group_alias_id = preg_replace('/[^-_0-9\p{L}]/u','',$group_alias_id);
	$default_group_alias = preg_replace('/[^-_0-9\p{L}]/u','',$default_group_alias);
	$vtiger_search_dead = preg_replace('/[^-_0-9\p{L}]/u','',$vtiger_search_dead);
	$menu_id = preg_replace('/[^-_0-9\p{L}]/u','',$menu_id);
	$source_menu = preg_replace('/[^-_0-9\p{L}]/u','',$source_menu);
	$call_time_id = preg_replace('/[^-_0-9\p{L}]/u','',$call_time_id);
	$phone_context = preg_replace('/[^-_0-9\p{L}]/u','',$phone_context);
	$new_conf_secret = preg_replace('/[^-_0-9\p{L}]/u','',$new_conf_secret);
	$conf_secret = preg_replace('/[^-_0-9\p{L}]/u','',$conf_secret);
	$tracking_group = preg_replace('/[^-_0-9\p{L}]/u','',$tracking_group);
	$no_agent_no_queue = preg_replace('/[^-_0-9\p{L}]/u','',$no_agent_no_queue);
	$no_agent_action = preg_replace('/[^-_0-9\p{L}]/u','',$no_agent_action);
	$quick_transfer_button = preg_replace('/[^-_0-9\p{L}]/u','',$quick_transfer_button);
	$prepopulate_transfer_preset = preg_replace('/[^-_0-9\p{L}]/u','',$prepopulate_transfer_preset);
	$tts_id = preg_replace('/[^-_0-9\p{L}]/u','',$tts_id);
	$drop_rate_group = preg_replace('/[^-_0-9\p{L}]/u','',$drop_rate_group);
	$agent_dial_owner_only = preg_replace('/[^-_0-9\p{L}]/u','',$agent_dial_owner_only);
	$reset_time = preg_replace('/[^-_0-9\p{L}]/u','',$reset_time);
	$moh_id = preg_replace('/[^-_0-9\p{L}]/u','',$moh_id);
	$mohsuggest = preg_replace('/[^-_0-9\p{L}]/u','',$mohsuggest);
	$drop_inbound_group_override = preg_replace('/[^-_0-9\p{L}]/u','',$drop_inbound_group_override);
	$timer_action = preg_replace('/[^-_0-9\p{L}]/u','',$timer_action);
	$record_call = preg_replace('/[^-_0-9\p{L}]/u','',$record_call);
	$scheduled_callbacks_alert = preg_replace('/[^-_0-9\p{L}]/u','',$scheduled_callbacks_alert);
	$extension_group_id = preg_replace('/[^-_0-9\p{L}]/u','',$extension_group_id);
	$extension_group = preg_replace('/[^-_0-9\p{L}]/u','',$extension_group);
	$scheduled_callbacks_count = preg_replace('/[^-_0-9\p{L}]/u','',$scheduled_callbacks_count);
	$manual_dial_override = preg_replace('/[^-_0-9\p{L}]/u','',$manual_dial_override);
	$blind_monitor_warning = preg_replace('/[^-_0-9\p{L}]/u','',$blind_monitor_warning);
	$uniqueid_status_display = preg_replace('/[^-_0-9\p{L}]/u','',$uniqueid_status_display);
	$hold_time_option_callmenu = preg_replace('/[^-_0-9\p{L}]/u','',$hold_time_option_callmenu);
	$inbound_queue_no_dial = preg_replace('/[^-_0-9\p{L}]/u','',$inbound_queue_no_dial);
	$hold_time_second_option = preg_replace('/[^-_0-9\p{L}]/u','',$hold_time_second_option);
	$hold_time_third_option = preg_replace('/[^-_0-9\p{L}]/u','',$hold_time_third_option);
	$wait_hold_option_priority = preg_replace('/[^-_0-9\p{L}]/u','',$wait_hold_option_priority);
	$wait_time_option = preg_replace('/[^-_0-9\p{L}]/u','',$wait_time_option);
	$wait_time_second_option = preg_replace('/[^-_0-9\p{L}]/u','',$wait_time_second_option);
	$wait_time_third_option = preg_replace('/[^-_0-9\p{L}]/u','',$wait_time_third_option);
	$wait_time_option_xfer_group = preg_replace('/[^-_0-9\p{L}]/u','',$wait_time_option_xfer_group);
	$wait_time_option_callmenu = preg_replace('/[^-_0-9\p{L}]/u','',$wait_time_option_callmenu);
	$wait_time_option_voicemail = preg_replace('/[^-_0-9\p{L}]/u','',$wait_time_option_voicemail);
	$filter_phone_group_id = preg_replace('/[^-_0-9\p{L}]/u','',$filter_phone_group_id);
	$filter_action = preg_replace('/[^-_0-9\p{L}]/u','',$filter_action);
	$filter_user_unavailable_action = preg_replace('/[^-_0-9\p{L}]/u','',$filter_user_unavailable_action);
	$filter_user_route_settings_ingroup = preg_replace('/[^-_0-9\p{L}]/u','',$filter_user_route_settings_ingroup);
	$filter_agent_search_method = preg_replace('/[^-_0-9\p{L}]/u','',$filter_agent_search_method);
	$filter_campaign_id = preg_replace('/[^-_0-9\p{L}]/u','',$filter_campaign_id);
	$filter_group_id = preg_replace('/[^-_0-9\p{L}]/u','',$filter_group_id);
	$filter_menu_id = preg_replace('/[^-_0-9\p{L}]/u','',$filter_menu_id);
	$filter_call_handle_method = preg_replace('/[^-_0-9\p{L}]/u','',$filter_call_handle_method);
	$filter_user = preg_replace('/[^-_0-9\p{L}]/u','',$filter_user);
	$filter_exten_context = preg_replace('/[^-_0-9\p{L}]/u','',$filter_exten_context);
	$webphone_systemkey = preg_replace('/[^-_0-9\p{L}]/u','',$webphone_systemkey);
	$webphone_dialpad = preg_replace('/[^-_0-9\p{L}]/u','',$webphone_dialpad);
	$webphone_systemkey_override = preg_replace('/[^-_0-9\p{L}]/u','',$webphone_systemkey_override);
	$webphone_dialpad_override = preg_replace('/[^-_0-9\p{L}]/u','',$webphone_dialpad_override);
	$default_phone_registration_password = preg_replace('/[^-_0-9\p{L}]/u','',$default_phone_registration_password);
	$default_phone_login_password = preg_replace('/[^-_0-9\p{L}]/u','',$default_phone_login_password);
	$default_server_password = preg_replace('/[^-_0-9\p{L}]/u','',$default_server_password);
	$ivr_park_call = preg_replace('/[^-_0-9\p{L}]/u','',$ivr_park_call);
	$manual_preview_dial = preg_replace('/[^-_0-9\p{L}]/u','',$manual_preview_dial);
	$realtime_agent_time_stats = preg_replace('/[^-_0-9\p{L}]/u','',$realtime_agent_time_stats);
	$api_manual_dial = preg_replace('/[^-_0-9\p{L}]/u','',$api_manual_dial);
	$manual_dial_call_time_check = preg_replace('/[^-_0-9\p{L}]/u','',$manual_dial_call_time_check);
	$lead_order_secondary = preg_replace('/[^-_0-9\p{L}]/u','',$lead_order_secondary);
	$agent_lead_search = preg_replace('/[^-_0-9\p{L}]/u','',$agent_lead_search);
	$agent_lead_search_method = preg_replace('/[^-_0-9\p{L}]/u','',$agent_lead_search_method);
	$manual_dial_cid = preg_replace('/[^-_0-9\p{L}]/u','',$manual_dial_cid);
	$post_phone_time_diff_alert = preg_replace('/[^-_0-9\p{L}]/u','',$post_phone_time_diff_alert);
	$custom_3way_button_transfer = preg_replace('/[^-_0-9\p{L}]/u','',$custom_3way_button_transfer);
	$available_only_tally_threshold_agents = preg_replace('/[^-_0-9\p{L}]/u','',$available_only_tally_threshold_agents);
	$dial_level_threshold_agents = preg_replace('/[^-_0-9\p{L}]/u','',$dial_level_threshold_agents);
	$time_zone_setting = preg_replace('/[^-_0-9\p{L}]/u','',$time_zone_setting);
	$safe_harbor_menu_id = preg_replace('/[^-_0-9\p{L}]/u','',$safe_harbor_menu_id);
	$survey_menu_id = preg_replace('/[^-_0-9\p{L}]/u','',$survey_menu_id);
	$dl_diff_target_method = preg_replace('/[^-_0-9\p{L}]/u','',$dl_diff_target_method);
	$disable_dispo_screen = preg_replace('/[^-_0-9\p{L}]/u','',$disable_dispo_screen);
	$screen_labels = preg_replace('/[^-_0-9\p{L}]/u','',$screen_labels);
	$label_hide_field_logs = preg_replace('/[^-_0-9\p{L}]/u','',$label_hide_field_logs);
	$label_id = preg_replace('/[^-_0-9\p{L}]/u','',$label_id);
	$status_display_fields = preg_replace('/[^-_0-9\p{L}]/u','',$status_display_fields);
	$voicemail_timezone = preg_replace('/[^-_0-9\p{L}]/u','',$voicemail_timezone);
	$default_voicemail_timezone = preg_replace('/[^-_0-9\p{L}]/u','',$default_voicemail_timezone);
	$on_hook_cid = preg_replace('/[^-_0-9\p{L}]/u','',$on_hook_cid);
	$pllb_grouping = preg_replace('/[^-_0-9\p{L}]/u','',$pllb_grouping);
	$user_start = preg_replace('/[^-_0-9\p{L}]/u','',$user_start);
	$drop_callmenu = preg_replace('/[^-_0-9\p{L}]/u','',$drop_callmenu);
	$after_hours_callmenu = preg_replace('/[^-_0-9\p{L}]/u','',$after_hours_callmenu);
	$survey_recording = preg_replace('/[^-_0-9\p{L}]/u','',$survey_recording);
	$dtmf_field = preg_replace('/[^-_0-9\p{L}]/u','',$dtmf_field);
	$preset_contact_search = preg_replace('/[^-_0-9\p{L}]/u','',$preset_contact_search);
	$admin_hide_phone_data = preg_replace('/[^-_0-9\p{L}]/u','',$admin_hide_phone_data);
	$max_calls_method = preg_replace('/[^-_0-9\p{L}]/u','',$max_calls_method);
	$max_calls_action = preg_replace('/[^-_0-9\p{L}]/u','',$max_calls_action);
	$in_group_dial = preg_replace('/[^-_0-9\p{L}]/u','',$in_group_dial);
	$in_group_dial_select = preg_replace('/[^-_0-9\p{L}]/u','',$in_group_dial_select);
	$queuemetrics_socket = preg_replace('/[^-_0-9\p{L}]/u','',$queuemetrics_socket);
	$holiday_id = preg_replace('/[^-_0-9\p{L}]/u','',$holiday_id);
	$holiday_date = preg_replace('/[^-_0-9\p{L}]/u','',$holiday_date);
	$holiday_status = preg_replace('/[^-_0-9\p{L}]/u','',$holiday_status);
	$expiration_date = preg_replace('/[^-_0-9\p{L}]/u','',$expiration_date);
	$amd_inbound_group = preg_replace('/[^-_0-9\p{L}]/u','',$amd_inbound_group);
	$amd_callmenu = preg_replace('/[^-_0-9\p{L}]/u','',$amd_callmenu);
	$filter_inbound_number = preg_replace('/[^-_0-9\p{L}]/u','',$filter_inbound_number);
	$filter_dnc_campaign = preg_replace('/[^-_0-9\p{L}]/u','',$filter_dnc_campaign);
	$manual_dial_search_checkbox = preg_replace('/[^-_0-9\p{L}]/u','',$manual_dial_search_checkbox);
	$alt_number_dialing = preg_replace('/[^-_0-9\p{L}]/u','',$alt_number_dialing);
	$no_agent_ingroup_redirect = preg_replace('/[^-_0-9\p{L}]/u','',$no_agent_ingroup_redirect);
	$no_agent_ingroup_id = preg_replace('/[^-_0-9\p{L}]/u','',$no_agent_ingroup_id);
	$pre_filter_phone_group_id = preg_replace('/[^-_0-9\p{L}]/u','',$pre_filter_phone_group_id);
	$shift_enforcement = preg_replace('/[^-_0-9\p{L}]/u','',$shift_enforcement);
	$comments_all_tabs = preg_replace('/[^-_0-9\p{L}]/u','',$comments_all_tabs);
	$comments_dispo_screen = preg_replace('/[^-_0-9\p{L}]/u','',$comments_dispo_screen);
	$comments_callback_screen = preg_replace('/[^-_0-9\p{L}]/u','',$comments_callback_screen);
	$qc_comment_history = preg_replace('/[^-_0-9\p{L}]/u','',$qc_comment_history);
	$language_method = preg_replace('/[^-_0-9\p{L}]/u','',$language_method);
	$manual_dial_override_field = preg_replace('/[^-_0-9\p{L}]/u','',$manual_dial_override_field);
	$max_queue_ingroup_id = preg_replace('/[^-_0-9\p{L}]/u','',$max_queue_ingroup_id);
	$agent_debug_logging = preg_replace('/[^-_0-9\p{L}]/u','',$agent_debug_logging);
	$container_id = preg_replace('/[^-_0-9\p{L}]/u','',$container_id);
	$phone_defaults_container = preg_replace('/[^-_0-9\p{L}]/u','',$phone_defaults_container);
	$container_type = preg_replace('/[^-_0-9\p{L}]/u','',$container_type);
	$status_group_id = preg_replace('/[^-_0-9\p{L}]/u','',$status_group_id);
	$unavail_dialplan_fwd_exten = preg_replace('/[^-_0-9\p{L}]/u','',$unavail_dialplan_fwd_exten);
	$unavail_dialplan_fwd_context = preg_replace('/[^-_0-9\p{L}]/u','',$unavail_dialplan_fwd_context);
	$nva_search_method = preg_replace('/[^-_0-9\p{L}]/u','',$nva_search_method);
	$on_hook_cid_number = preg_replace('/[^-_0-9\p{L}]/u','',$on_hook_cid_number);
	$colors_id = preg_replace('/[^-_0-9\p{L}]/u','',$colors_id);
	$agent_screen_colors = preg_replace('/[^-_0-9\p{L}]/u','',$agent_screen_colors);
	$customer_chat_screen_colors = preg_replace('/[^-_0-9\p{L}]/u','',$customer_chat_screen_colors);
	$web_loader_phone_length = preg_replace('/[^-_0-9\p{L}]/u','',$web_loader_phone_length);
	$agent_chat_screen_colors = preg_replace('/[^-_0-9\p{L}]/u','',$agent_chat_screen_colors);
	$populate_lead_province = preg_replace('/[^-_0-9\p{L}]/u','',$populate_lead_province);
	$populate_lead_owner = preg_replace('/[^-_0-9\p{L}]/u','',$populate_lead_owner);
	$areacode_filter = preg_replace('/[^-_0-9\p{L}]/u','',$areacode_filter);
	$areacode_filter_action = preg_replace('/[^-_0-9\p{L}]/u','',$areacode_filter_action);
	$report_id = preg_replace('/[^-_0-9\p{L}]/u','',$report_id);
	$report_destination = preg_replace('/[^-_0-9\p{L}]/u','',$report_destination);
	$report_times = preg_replace('/[^-_0-9\p{L}]/u','',$report_times);
	$report_monthdays = preg_replace('/[^-_0-9\p{L}]/u','',$report_monthdays);
	$populate_state_areacode = preg_replace('/[^-_0-9\p{L}]/u','',$populate_state_areacode);
	$dl_id = preg_replace('/[^-_0-9\p{L}]/u','',$dl_id);
	$duplicate_check = preg_replace('/[^-_0-9\p{L}]/u','',$duplicate_check);
	$dl_times = preg_replace('/[^-_0-9\p{L}]/u','',$dl_times);
	$dl_monthdays = preg_replace('/[^-_0-9\p{L}]/u','',$dl_monthdays);
	$use_custom_cid = preg_replace('/[^-_0-9\p{L}]/u','',$use_custom_cid);
	$system_ip_blacklist = preg_replace('/[^-_0-9\p{L}]/u','',$system_ip_blacklist);
	$admin_ip_list = preg_replace('/[^-_0-9\p{L}]/u','',$admin_ip_list);
	$agent_ip_list = preg_replace('/[^-_0-9\p{L}]/u','',$agent_ip_list);
	$api_ip_list = preg_replace('/[^-_0-9\p{L}]/u','',$api_ip_list);
	$ip_list_id = preg_replace('/[^-_0-9\p{L}]/u','',$ip_list_id);
	$inbound_survey_callmenu = preg_replace('/[^-_0-9\p{L}]/u','',$inbound_survey_callmenu);
	$filename_override = preg_replace('/[^-_0-9\p{L}]/u','',$filename_override);
	$did_id = preg_replace('/[^-_0-9\p{L}]/u','',$did_id);
	$extension_appended_cidname = preg_replace('/[^-_0-9\p{L}]/u','',$extension_appended_cidname);
	$max_inbound_calls_outcome = preg_replace('/[^-_0-9\p{L}]/u','',$max_inbound_calls_outcome);
	$manual_auto_next_options = preg_replace('/[^-_0-9\p{L}]/u','',$manual_auto_next_options);
	$agent_screen_time_display = preg_replace('/[^-_0-9\p{L}]/u','',$agent_screen_time_display);
	$get_call_launch = preg_replace('/[^-_0-9\p{L}]/u','',$get_call_launch);
	$next_dial_my_callbacks = preg_replace('/[^-_0-9\p{L}]/u','',$next_dial_my_callbacks);
	$anyone_callback_inactive_lists = preg_replace('/[^-_0-9\p{L}]/u','',$anyone_callback_inactive_lists);
	$inbound_no_agents_no_dial_container = preg_replace('/[^-_0-9\p{L}]/u','',$inbound_no_agents_no_dial_container);
	$closing_time_action = preg_replace('/[^-_0-9\p{L}]/u','',$closing_time_action);
	$closing_time_option_exten = preg_replace('/[^-_0-9\p{L}]/u','',$closing_time_option_exten);
	$closing_time_option_callmenu = preg_replace('/[^-_0-9\p{L}]/u','',$closing_time_option_callmenu);
	$closing_time_option_voicemail = preg_replace('/[^-_0-9\p{L}]/u','',$closing_time_option_voicemail);
	$closing_time_option_callback_list_id = preg_replace('/[^-_0-9\p{L}]/u','',$closing_time_option_callback_list_id);
	$icbq_call_time_id = preg_replace('/[^-_0-9\p{L}]/u','',$icbq_call_time_id);
	$add_lead_timezone = preg_replace('/[^-_0-9\p{L}]/u','',$add_lead_timezone);
	$icbq_dial_filter = preg_replace('/[^-_0-9\p{L}]/u','',$icbq_dial_filter);
	$cid_group_id = preg_replace('/[^-_0-9\p{L}]/u','',$cid_group_id);
	$cid_group_id_two = preg_replace('/[^-_0-9\p{L}]/u','',$cid_group_id_two);
	$cid_group_type = preg_replace('/[^-_0-9\p{L}]/u','',$cid_group_type);
	$populate_lead_source = preg_replace('/[^-_0-9\p{L}]/u','',$populate_lead_source);
	$dead_trigger_action = preg_replace('/[^-_0-9\p{L}]/u','',$dead_trigger_action);
	$dead_trigger_repeat = preg_replace('/[^-_0-9\p{L}]/u','',$dead_trigger_repeat);
	$cid_cb_confirm_number = preg_replace('/[^-_0-9\p{L}]/u','',$cid_cb_confirm_number);
	$cid_cb_invalid_filter_phone_group = preg_replace('/[^-_0-9\p{L}]/u','',$cid_cb_invalid_filter_phone_group);
	$scheduled_callbacks_auto_reschedule = preg_replace('/[^-_0-9\p{L}]/u','',$scheduled_callbacks_auto_reschedule);
	$scheduled_callbacks_timezones_container = preg_replace('/[^-_0-9\p{L}]/u','',$scheduled_callbacks_timezones_container);
	$three_way_volume_buttons = preg_replace('/[^-_0-9\p{L}]/u','',$three_way_volume_buttons);
	$callback_dnc = preg_replace('/[^-_0-9\p{L}]/u','',$callback_dnc);
	$hide_call_log_info = preg_replace('/[^-_0-9\p{L}]/u','',$hide_call_log_info);
	$call_quota_lead_ranking = preg_replace('/[^-_0-9\p{L}]/u','',$call_quota_lead_ranking);
	$sip_event_logging = preg_replace('/[^-_0-9\p{L}]/u','',$sip_event_logging);
	$auto_active_list_new = preg_replace('/[^-_0-9\p{L}]/u','',$auto_active_list_new);
	$script_id = preg_replace('/[^-_0-9\p{L}]/u','',$script_id);
	$ingroup_script = preg_replace('/[^-_0-9\p{L}]/u','',$ingroup_script);
	$ingroup_script_two = preg_replace('/[^-_0-9\p{L}]/u','',$ingroup_script_two);
	$campaign_script = preg_replace('/[^-_0-9\p{L}]/u','',$campaign_script);
	$campaign_script_two = preg_replace('/[^-_0-9\p{L}]/u','',$campaign_script_two);
	$leave_vm_message_group_id = preg_replace('/[^-_0-9\p{L}]/u','',$leave_vm_message_group_id);
	$dial_timeout_lead_container = preg_replace('/[^-_0-9\p{L}]/u','',$dial_timeout_lead_container);
	$amd_type = preg_replace('/[^-_0-9\p{L}]/u','',$amd_type);
	$recording_buttons = preg_replace('/[^-_0-9\p{L}]/u','',$recording_buttons);
	$use_other_campaign_dnc = preg_replace('/[^-_0-9\p{L}]/u','',$use_other_campaign_dnc);
	$browser_alert_sound = preg_replace('/[^-_0-9\p{L}]/u','',$browser_alert_sound);
	$three_way_record_stop_exception = preg_replace('/[^-_0-9\p{L}]/u','',$three_way_record_stop_exception);
	$queuemetrics_pausereason = preg_replace('/[^-_0-9\p{L}]/u','',$queuemetrics_pausereason);
	$answer_signal = preg_replace('/[^-_0-9\p{L}]/u','',$answer_signal);
	$inbound_drop_voicemail = preg_replace('/[^-_0-9\p{L}]/u','',$inbound_drop_voicemail);
	$inbound_after_hours_voicemail = preg_replace('/[^-_0-9\p{L}]/u','',$inbound_after_hours_voicemail);
	$pause_max_exceptions = preg_replace('/[^-_0-9\p{L}]/u','',$pause_max_exceptions);
	$two_factor_container = preg_replace('/[^-_0-9\p{L}]/u','',$two_factor_container);
	$calls_inqueue_count_one = preg_replace('/[^-_0-9\p{L}]/u','',$calls_inqueue_count_one);
	$calls_inqueue_count_two = preg_replace('/[^-_0-9\p{L}]/u','',$calls_inqueue_count_two);
	$drop_call_seconds_override = preg_replace('/[^-_0-9\p{L}]/u','',$drop_call_seconds_override);
	$in_man_dial_next_ready_seconds_override = preg_replace('/[^-_0-9\p{L}]/u','',$in_man_dial_next_ready_seconds_override);
	$call_limit_24hour_method = preg_replace('/[^-_0-9\p{L}]/u','',$call_limit_24hour_method);
	$call_limit_24hour_scope = preg_replace('/[^-_0-9\p{L}]/u','',$call_limit_24hour_scope);
	$call_limit_24hour_override = preg_replace('/[^-_0-9\p{L}]/u','',$call_limit_24hour_override);
	$in_queue_nanque_exceptions = preg_replace('/[^-_0-9\p{L}]/u','',$in_queue_nanque_exceptions);
	$queue_group = preg_replace('/[^-_0-9\p{L}]/u','',$queue_group);

	### ALPHA-NUMERIC and underscore and dash and slash and dot
	$menu_timeout_prompt = preg_replace('/[^-\/\|\._0-9\p{L}]/u','',$menu_timeout_prompt);
	$menu_invalid_prompt = preg_replace('/[^-\/\|\._0-9\p{L}]/u','',$menu_invalid_prompt);
	$after_hours_message_filename = preg_replace('/[^-\/\|\._0-9\p{L}]/u','',$after_hours_message_filename);
	$welcome_message_filename = preg_replace('/[^-\/\|\._0-9\p{L}]/u','',$welcome_message_filename);
	$onhold_prompt_filename = preg_replace('/[^-\/\|\._0-9\p{L}]/u','',$onhold_prompt_filename);
	$hold_time_option_callback_filename = preg_replace('/[^-\/\|\._0-9\p{L}]/u','',$hold_time_option_callback_filename);
	$agent_alert_exten = preg_replace('/[^-\|\/\._0-9\p{L}]/u','',$agent_alert_exten);
	$filename = preg_replace('/[^-\/\._0-9\p{L}]/u','',$filename);
	$am_message_exten = preg_replace('/[^-\|\/\._0-9\p{L}]/u','',$am_message_exten);
	$am_message_exten_override = preg_replace('/[^-\|\/\._0-9\p{L}]/u','',$am_message_exten_override);
	$campaign_groups = preg_replace('/[^-\|\/\._0-9\p{L}]/u','',$campaign_groups);
	$blind_monitor_filename = preg_replace('/[^-\|\/\._0-9\p{L}]/u','',$blind_monitor_filename);
	$hold_time_option_press_filename = preg_replace('/[^-\|\/\._0-9\p{L}]/u','',$hold_time_option_press_filename);
	$default_afterhours_filename_override = preg_replace('/[^-\|\/\._0-9\p{L}]/u','',$default_afterhours_filename_override);
	$sunday_afterhours_filename_override = preg_replace('/[^-\|\/\._0-9\p{L}]/u','',$sunday_afterhours_filename_override);
	$monday_afterhours_filename_override = preg_replace('/[^-\|\/\._0-9\p{L}]/u','',$monday_afterhours_filename_override);
	$tuesday_afterhours_filename_override = preg_replace('/[^-\|\/\._0-9\p{L}]/u','',$tuesday_afterhours_filename_override);
	$wednesday_afterhours_filename_override = preg_replace('/[^-\|\/\._0-9\p{L}]/u','',$wednesday_afterhours_filename_override);
	$thursday_afterhours_filename_override = preg_replace('/[^-\|\/\._0-9\p{L}]/u','',$thursday_afterhours_filename_override);
	$friday_afterhours_filename_override = preg_replace('/[^-\|\/\._0-9\p{L}]/u','',$friday_afterhours_filename_override);
	$saturday_afterhours_filename_override = preg_replace('/[^-\|\/\._0-9\p{L}]/u','',$saturday_afterhours_filename_override);
	$admin_web_directory = preg_replace('/[^-\|\/\._0-9\p{L}]/u','',$admin_web_directory);
	$tts_voice = preg_replace('/[^-\|\/\._0-9\p{L}]/u','',$tts_voice);
	$wait_time_option_callback_filename = preg_replace('/[^-\|\/\._0-9\p{L}]/u','',$wait_time_option_callback_filename);
	$wait_time_option_press_filename = preg_replace('/[^-\|\/\._0-9\p{L}]/u','',$wait_time_option_press_filename);
	$eht_minimum_prompt_filename = preg_replace('/[^-\|\/\._0-9\p{L}]/u','',$eht_minimum_prompt_filename);
	$queuemetrics_phone_environment = preg_replace('/[^-\|\/\._0-9\p{L}]/u','',$queuemetrics_phone_environment);
	$active_twin_server_ip = preg_replace('/[^-\|\/\._0-9\p{L}]/u','',$active_twin_server_ip);
	$safe_harbor_audio = preg_replace('/[^-\/\|\._0-9\p{L}]/u','',$safe_harbor_audio);
	$alt_log_server_ip = preg_replace('/[^-\/\|\._0-9\p{L}]/u','',$alt_log_server_ip);
	$alt_log_dbname = preg_replace('/[^-\/\|\._0-9\p{L}]/u','',$alt_log_dbname);
	$alt_log_login = preg_replace('/[^-\/\|\._0-9\p{L}]/u','',$alt_log_login);
	$alt_log_pass = preg_replace('/[^-\/\|\._0-9\p{L}]/u','',$alt_log_pass);
	$survey_first_audio_file = preg_replace('/[^-\/\|\._0-9\p{L}]/u','',$survey_first_audio_file);
	$survey_opt_in_audio_file = preg_replace('/[^-\/\|\._0-9\p{L}]/u','',$survey_opt_in_audio_file);
	$survey_ni_audio_file = preg_replace('/[^-\/\|\._0-9\p{L}]/u','',$survey_ni_audio_file);
	$survey_third_audio_file = preg_replace('/[^-\/\|\._0-9\p{L}]/u','',$survey_third_audio_file);
	$survey_fourth_audio_file = preg_replace('/[^-\/\|\._0-9\p{L}]/u','',$survey_fourth_audio_file);
	$safe_harbor_audio_field = preg_replace('/[^-\/\|\._0-9\p{L}]/u','',$safe_harbor_audio_field);
	$voicemail_greeting = preg_replace('/[^-\/\|\._0-9\p{L}]/u','',$voicemail_greeting);
	$old_voicemail_greeting = preg_replace('/[^-\/\|\._0-9\p{L}]/u','',$old_voicemail_greeting);
	$meetme_enter_login_filename = preg_replace('/[^-\/\|\._0-9\p{L}]/u','',$meetme_enter_login_filename);
	$meetme_enter_leave3way_filename = preg_replace('/[^-\/\|\._0-9\p{L}]/u','',$meetme_enter_leave3way_filename);
	$nva_error_filename = preg_replace('/[^-\/\|\._0-9\p{L}]/u','',$nva_error_filename);
	$inbound_survey_filename = preg_replace('/[^-\/\|\._0-9\p{L}]/u','',$inbound_survey_filename);
	$inbound_survey_question_filename = preg_replace('/[^-\/\|\._0-9\p{L}]/u','',$inbound_survey_question_filename);
	$closing_time_filename = preg_replace('/[^-\/\|\._0-9\p{L}]/u','',$closing_time_filename);
	$closing_time_end_filename = preg_replace('/[^-\/\|\._0-9\p{L}]/u','',$closing_time_end_filename);
	$dead_trigger_filename = preg_replace('/[^-\/\|\._0-9\p{L}]/u','',$dead_trigger_filename);
	$cid_cb_valid_filename = preg_replace('/[^-\/\|\._0-9\p{L}]/u','',$cid_cb_valid_filename);
	$cid_cb_confirmed_filename = preg_replace('/[^-\/\|\._0-9\p{L}]/u','',$cid_cb_confirmed_filename);
	$cid_cb_enter_filename = preg_replace('/[^-\/\|\._0-9\p{L}]/u','',$cid_cb_enter_filename);
	$cid_cb_you_entered_filename = preg_replace('/[^-\/\|\._0-9\p{L}]/u','',$cid_cb_you_entered_filename);
	$cid_cb_press_to_confirm_filename = preg_replace('/[^-\/\|\._0-9\p{L}]/u','',$cid_cb_press_to_confirm_filename);
	$cid_cb_invalid_filename = preg_replace('/[^-\/\|\._0-9\p{L}]/u','',$cid_cb_invalid_filename);
	$cid_cb_reenter_filename = preg_replace('/[^-\/\|\._0-9\p{L}]/u','',$cid_cb_reenter_filename);
	$cid_cb_error_filename = preg_replace('/[^-\/\|\._0-9\p{L}]/u','',$cid_cb_error_filename);
	$place_in_line_caller_number_filename = preg_replace('/[^-\/\|\._0-9\p{L}]/u','',$place_in_line_caller_number_filename);
	$place_in_line_you_next_filename = preg_replace('/[^-\/\|\._0-9\p{L}]/u','',$place_in_line_you_next_filename);
	$audio_filename = preg_replace('/[^-\/\|\._0-9\p{L}]/u','',$audio_filename);

	### ALPHA-NUMERIC and underscore and dash and slash and dot and comma
	$menu_prompt = preg_replace('/[^-\/\|\,\._0-9\p{L}]/u','',$menu_prompt);

	### ALPHA-NUMERIC and underscore and dash and comma
	$logins_list = preg_replace('/[^-\,\_0-9\p{L}]/u','',$logins_list);
	$forced_timeclock_login = preg_replace('/[^-\,\_0-9\p{L}]/u','',$forced_timeclock_login);
	$uniqueid_status_prefix = preg_replace('/[^-\,\_0-9\p{L}]/u','',$uniqueid_status_prefix);

	### ALPHA-NUMERIC and spaces
	$lead_order = preg_replace('/[^ 0-9\p{L}]/u','',$lead_order);
	### ALPHA-NUMERIC and spaces and dashes and underscores
	$preset_name = preg_replace('/[^- \_0-9\p{L}]/u','',$preset_name);
	$selected_language = preg_replace('/[^- \_0-9\p{L}]/u','',$selected_language);
	$default_language = preg_replace('/[^- \_0-9\p{L}]/u','',$default_language);
	$opensips_cid_name = preg_replace('/[^- \_0-9\p{L}]/u','',$opensips_cid_name);

	### ALPHA-NUMERIC and hash
	$group_color = preg_replace('/[^\#0-9\p{L}]/u','',$group_color);
	$script_color = preg_replace('/[^\#0-9\p{L}]/u','',$script_color);
	### ALPHA-NUMERIC and hash and star and dot and underscore
	$hold_time_option_exten = preg_replace('/[^\*\#\.\_0-9\p{L}]/u','',$hold_time_option_exten);
	$voicemail_ext = preg_replace('/[^\*\#\.\_0-9\p{L}]/u','',$voicemail_ext);
	$phone = preg_replace('/[^\*\#\.\_0-9\p{L}]/u','',$phone);
	$phone_code = preg_replace('/[^\*\#\.\_0-9\p{L}]/u','',$phone_code);
	$wait_time_option_exten = preg_replace('/[^\*\#\.\_0-9\p{L}]/u','',$wait_time_option_exten);
	$filter_voicemail_ext = preg_replace('/[^\*\#\.\_0-9\p{L}]/u','',$filter_voicemail_ext);
	$filter_phone_code = preg_replace('/[^\*\#\.\_0-9\p{L}]/u','',$filter_phone_code);
	$filter_phone = preg_replace('/[^\*\#\.\_0-9\p{L}]/u','',$filter_phone);
	$preset_number = preg_replace('/[^\*\#\.\_0-9\p{L}]/u','',$preset_number);
	$no_agent_ingroup_extension = preg_replace('/[^\*\#\.\_0-9\p{L}]/u','',$no_agent_ingroup_extension);
	$pre_filter_extension = preg_replace('/[^\*\#\.\_0-9\p{L}]/u','',$pre_filter_extension);
	$max_queue_ingroup_extension = preg_replace('/[^\*\#\.\_0-9\p{L}]/u','',$max_queue_ingroup_extension);
	$report_server = preg_replace('/[^\*\#\.\_0-9\p{L}]/u','',$report_server);
	$dl_server = preg_replace('/[^\*\#\.\_0-9\p{L}]/u','',$dl_server);

	### ALPHA-NUMERIC and hash and star and dot and underscore and colon and plus sign
	$did_pattern = preg_replace('/[^:\+\*\#\.\_0-9\p{L}]/u','',$did_pattern);
	$web_loader_phone_strip = preg_replace('/[^:\+\*\#\.\_0-9\p{L}]/u','',$web_loader_phone_strip);
	$manual_dial_phone_strip = preg_replace('/[^:\+\*\#\.\_0-9\p{L}]/u','',$manual_dial_phone_strip);
	$mobile_number = preg_replace('/[^:\+\*\#\.\_0-9\p{L}]/u','',$mobile_number);

	### ALPHA-NUMERIC and spaces dots, commas, dashes, underscores
	$adaptive_dl_diff_target = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$adaptive_dl_diff_target);
	$adaptive_intensity = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$adaptive_intensity);
	$asterisk_version = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$asterisk_version);
	$call_time_comments = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$call_time_comments);
	$call_time_name = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$call_time_name);
	$campaign_name = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$campaign_name);
	$campaign_rec_filename = preg_replace('/[^-\.\_0-9\p{L}]/u','',$campaign_rec_filename);
	$ingroup_rec_filename = preg_replace('/[^-\.\_0-9\p{L}]/u','',$ingroup_rec_filename);
	$company = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$company);
	$full_name = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$full_name);
	$fullname = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$fullname);
	$group_name = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$group_name);
	$HKstatus = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$HKstatus);
	$lead_filter_comments = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$lead_filter_comments);
	$lead_filter_name = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$lead_filter_name);
	$list_name = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$list_name);
	$local_gmt = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$local_gmt);
	$new_fullname = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$new_fullname);
	$phone_type = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$phone_type);
	$picture = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$picture);
	$script_comments = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$script_comments);
	$script_name = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$script_name);
	$server_description = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$server_description);
	$status = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$status);
	$status_name = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$status_name);
	$wrapup_message = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$wrapup_message);
	$pause_code_name = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$pause_code_name);
	$campaign_description = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$campaign_description);
	$list_description = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$list_description);
	$vcl_name = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$vcl_name);
	$vsc_name = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$vsc_name);
	$vsc_description = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$vsc_description);
	$code_name = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$code_name);
	$alias_name = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$alias_name);
	$shift_name = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$shift_name);
	$did_description = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$did_description);
	$template_name = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$template_name);
	$carrier_name = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$carrier_name);
	$group_alias_name = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$group_alias_name);
	$caller_id_name = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$caller_id_name);
	$user_code = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$user_code);
	$territory = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$territory);
	$tts_name = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$tts_name);
	$moh_name = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$moh_name);
	$timer_action_message = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$timer_action_message);
	$default_codecs = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$default_codecs);
	$codecs_list = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$codecs_list);
	$label_title = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$label_title);
	$label_first_name = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$label_first_name);
	$label_middle_initial = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$label_middle_initial);
	$label_last_name = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$label_last_name);
	$label_address1 = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$label_address1);
	$label_address2 = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$label_address2);
	$label_address3 = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$label_address3);
	$label_city = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$label_city);
	$label_state = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$label_state);
	$label_province = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$label_province);
	$label_postal_code = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$label_postal_code);
	$label_vendor_lead_code = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$label_vendor_lead_code);
	$label_gender = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$label_gender);
	$label_phone_number = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$label_phone_number);
	$label_phone_code = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$label_phone_code);
	$label_alt_phone = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$label_alt_phone);
	$label_security_phrase = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$label_security_phrase);
	$label_email = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$label_email);
	$label_comments = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$label_comments);
	$slave_db_server = preg_replace('/[^- \.\,\:\_0-9\p{L}]/u','',$slave_db_server);
	$filter_phone_group_name = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$filter_phone_group_name);
	$filter_phone_group_description = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$filter_phone_group_description);
	$filter_clean_cid_number = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$filter_clean_cid_number);
	$label_name = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$label_name);
	$default_local_gmt = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$default_local_gmt);
	$cid_description = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$cid_description);
	$description = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$description);
	$first_name = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$first_name);
	$last_name = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$last_name);
	$bu_name = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$bu_name);
	$department = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$department);
	$group = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$group);
	$job_title = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$job_title);
	$location = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$location);
	$holiday_name = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$holiday_name);
	$holiday_comments = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$holiday_comments);
	$api_allowed_functions = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$api_allowed_functions);
	$agent_display_fields = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$agent_display_fields);
	$container_notes = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$container_notes);
	$did_carrier_description = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$did_carrier_description);
	$status_group_notes = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$status_group_notes);
	$colors_name = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$colors_name);
	$web_logo = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$web_logo);
	$user_nickname = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$user_nickname);
	$customer_chat_survey_text = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$customer_chat_survey_text);
	$agent_script = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$agent_script);
	$report_name = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$report_name);
	$dl_name = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$dl_name);
	$drop_status = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$drop_status);
	$ip_list_name = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$ip_list_name);
	$cid_group_notes = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$cid_group_notes);
	$populate_lead_vendor = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$populate_lead_vendor);
	$leave_vm_message_group_notes = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$leave_vm_message_group_notes);
	$audio_name = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$audio_name);
	$populate_lead_comments = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$populate_lead_comments);
	$label_lead_id = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$label_lead_id);
	$label_list_id = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$label_list_id);
	$label_entry_date = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$label_entry_date);
	$label_gmt_offset_now = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$label_gmt_offset_now);
	$label_source_id = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$label_source_id);
	$label_called_since_last_reset = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$label_called_since_last_reset);
	$label_status = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$label_status);
	$label_user = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$label_user);
	$label_date_of_birth = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$label_date_of_birth);
	$label_country_code = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$label_country_code);
	$label_last_local_call_time = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$label_last_local_call_time);
	$label_called_count = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$label_called_count);
	$label_rank = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$label_rank);
	$label_owner = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$label_owner);
	$label_entry_list_id = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$label_entry_list_id);
	$user_location = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$user_location);
	$queue_group_name = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$queue_group_name);
	$qc_scorecard_id = preg_replace('/[^- \.\,\_0-9\p{L}]/u','',$qc_scorecard_id);

	### ALPHA-NUMERIC and underscore and dash and slash and at and dot
	$call_out_number_group = preg_replace('/[^-\.\:\/\@\_0-9\p{L}]/u','',$call_out_number_group);
	$client_browser = preg_replace('/[^-\.\:\/\@\_0-9\p{L}]/u','',$client_browser);
	$DBX_server = preg_replace('/[^-\.\:\/\@\_0-9\p{L}]/u','',$DBX_server);
	$DBY_server = preg_replace('/[^-\.\:\/\@\_0-9\p{L}]/u','',$DBY_server);
	$dtmf_send_extension = preg_replace('/[^-\.\:\/\@\_0-9\p{L}]/u','',$dtmf_send_extension);
	$install_directory = preg_replace('/[^-\.\:\/\@\_0-9\p{L}]/u','',$install_directory);
	$old_extension = preg_replace('/[^-\.\:\/\@\_0-9\p{L}]/u','',$old_extension);
	$telnet_host = preg_replace('/[^-\.\:\/\@\_0-9\p{L}]/u','',$telnet_host);
	$queuemetrics_dbname = preg_replace('/[^-\.\:\/\@\_0-9\p{L}]/u','',$queuemetrics_dbname);
	$queuemetrics_login = preg_replace('/[^-\.\:\/\@\_0-9\p{L}]/u','',$queuemetrics_login);
	$queuemetrics_pass = preg_replace('/[^-\.\:\/\@\_0-9\p{L}]/u','',$queuemetrics_pass);
	$email = preg_replace('/[^-\.\:\/\@\_0-9\p{L}]/u','',$email);
	$vtiger_dbname = preg_replace('/[^-\.\:\/\@\_0-9\p{L}]/u','',$vtiger_dbname);
	$vtiger_login = preg_replace('/[^-\.\:\/\@\_0-9\p{L}]/u','',$vtiger_login);
	$vtiger_pass = preg_replace('/[^-\.\:\/\@\_0-9\p{L}]/u','',$vtiger_pass);
	$external_server_ip = preg_replace('/[^-\.\:\/\@\_0-9\p{L}]/u','',$external_server_ip);
	$alt_server_ip = preg_replace('/[^-\.\:\/\@\_0-9\p{L}]/u','',$alt_server_ip);
	$email_from = preg_replace('/[^-\.\:\/\@\_0-9\p{L}]/u','',$email_from);
	$email_to = preg_replace('/[^-\.\:\/\@\_0-9\p{L}]/u','',$email_to);
	$ftp_server = preg_replace('/[^-\.\:\/\@\_0-9\p{L}]/u','',$ftp_server);
	$ftp_directory = preg_replace('/[^-\.\:\/\@\_0-9\p{L}]/u','',$ftp_directory);

	### ALPHA-NUMERIC and underscore and dash and slash and at and dot and space
	$custom_one = preg_replace('/[^- \.\:\/\@\_0-9\p{L}]/u','',$custom_one);
	$custom_two = preg_replace('/[^- \.\:\/\@\_0-9\p{L}]/u','',$custom_two);
	$custom_three = preg_replace('/[^- \.\:\/\@\_0-9\p{L}]/u','',$custom_three);
	$custom_four = preg_replace('/[^- \.\:\/\@\_0-9\p{L}]/u','',$custom_four);
	$custom_five = preg_replace('/[^- \.\:\/\@\_0-9\p{L}]/u','',$custom_five);
	$email_subject = preg_replace('/[^- \.\:\/\@\_0-9\p{L}]/u','',$email_subject);

	### ALPHA-NUMERIC and underscore and dash and slash and at and dot and pound and star
	$extension = preg_replace('/[^-\*\#\.\:\/\@\_0-9\p{L}]/u','',$extension);
	$new_extension = preg_replace('/[^-\*\#\.\:\/\@\_0-9\p{L}]/u','',$new_extension);
	$timer_action_destination = preg_replace('/[^-\*\#\.\:\/\@\_0-9\p{L}]/u','',$timer_action_destination);
	$filter_extension = preg_replace('/[^-\*\#\.\:\/\@\_0-9\p{L}]/u','',$filter_extension);

	### ALPHA-NUMERIC and space and underscore and dash and slash and at and dot and pound and star and pipe and comma
	$ivr_park_call_agi = preg_replace('/[^- \*\#\.\,\:\/\|\@\_0-9\p{L}]/u','',$ivr_park_call_agi);
	$source_phone = preg_replace('/[^- \*\#\.\,\:\/\|\@\_0-9\p{L}]/u','',$source_phone);

	### ALPHA-NUMERIC and space and underscore and dash and slash and at and dot and pound and star and pipe and comma and equal
	$voicemail_options = preg_replace('/[^- \=\*\#\.\,\:\/\|\@\_0-9\p{L}]/u','',$voicemail_options);

	### NUMERIC and comma and pipe
	$waitforsilence_options = preg_replace('/[^\|\,0-9\p{L}]/u','',$waitforsilence_options);

	### value cleaning
	$no_agent_action_value = preg_replace('/[^-\/\|\_\#\*\,\.\_0-9\p{L}]/u','',$no_agent_action_value);
	$areacode_filter_action_value = preg_replace('/[^-\/\|\_\#\*\,\.\_0-9\p{L}]/u','',$areacode_filter_action_value);

	### ALPHA-NUMERIC and underscore and dash and slash and at and space and colon
	$vdc_header_date_format = preg_replace('/[^- \:\/\_0-9\p{L}]/u','',$vdc_header_date_format);
	$vdc_customer_date_format = preg_replace('/[^- \:\/\_0-9\p{L}]/u','',$vdc_customer_date_format);
	$menu_name = preg_replace('/[^- \:\/\_0-9\p{L}]/u','',$menu_name);

	### ALPHA-NUMERIC and underscore and dash and at and space and parantheses
	$vdc_header_phone_format = preg_replace('/[^- \(\)\_0-9\p{L}]/u', '',$vdc_header_phone_format);

	### ALPHA-NUMERIC and newlines
	$areacode_list = preg_replace('/[^\n0-9\p{L}]/u', '',$areacode_list);

	### ALPHA-NUMERIC and newlines and period and colon
	$ip_address = preg_replace('/[^\n\.\:\0-9\p{L}]/u', '',$ip_address);
	}

### remove semi-colons and other special characters ###
$lead_filter_sql = preg_replace('/;/','',$lead_filter_sql);
$list_mix_container = preg_replace('/;/','',$list_mix_container);
$survey_response_digit_map = preg_replace('/;/','',$survey_response_digit_map);
$survey_camp_record_dir = preg_replace('/;/','',$survey_camp_record_dir);
$conf_override = preg_replace('/;/','',$conf_override);
$template_contents = preg_replace('/;/','',$template_contents);
$registration_string = preg_replace('/;/','',$registration_string);
$account_entry = preg_replace('/;/','',$account_entry);
$account_entry = preg_replace('/\r/', '',$account_entry);
$globals_string = preg_replace('/;/','',$globals_string);
$dialplan_entry = preg_replace('/\\\\/', '',$dialplan_entry);
$dialplan_entry = preg_replace('/\'/', '',$dialplan_entry);
$dialplan_entry = preg_replace('/\r/', '',$dialplan_entry);
$custom_dialplan_entry = preg_replace('/\\\\/', '',$custom_dialplan_entry);
$custom_dialplan_entry = preg_replace('/\'/', '',$custom_dialplan_entry);
$custom_dialplan_entry = preg_replace('/\r/', '',$custom_dialplan_entry);
$tts_text = preg_replace('/\\\\/', '',$tts_text);
$tts_text = preg_replace('/;/','',$tts_text);
$tts_text = preg_replace('/\r/', '',$tts_text);
$tts_text = preg_replace('/\"/', '',$tts_text);
$carrier_description = preg_replace('/\\\\/', '',$carrier_description);
$carrier_description = preg_replace('/;/','',$carrier_description);
$carrier_description = preg_replace('/\r/', '',$carrier_description);
$carrier_description = preg_replace('/\"/', '',$carrier_description);
$blind_monitor_message = preg_replace('/\\\\/', '',$blind_monitor_message);
$blind_monitor_message = preg_replace('/;/','',$blind_monitor_message);
$blind_monitor_message = preg_replace('/\r/', '',$blind_monitor_message);
$blind_monitor_message = preg_replace('/\"/', '',$blind_monitor_message);
$modify_url = preg_replace('/\\\\/', '',$modify_url);
$modify_url = preg_replace('/;/','',$modify_url);
$modify_url = preg_replace('/\r/', '',$modify_url);
$modify_url = preg_replace('/\"/', '',$modify_url);
$qualify_sql = preg_replace('/\\\\/', '',$qualify_sql);
$qualify_sql = preg_replace('/;/','',$qualify_sql);
$qualify_sql = preg_replace('/\r/', '',$qualify_sql);
$qualify_sql = preg_replace('/\'/', "\"",$qualify_sql);
$queuemetrics_socket_url = preg_replace('/\\\\/', '',$queuemetrics_socket_url);
$queuemetrics_socket_url = preg_replace('/;/','',$queuemetrics_socket_url);
$queuemetrics_socket_url = preg_replace('/\r/', '',$queuemetrics_socket_url);
$queuemetrics_socket_url = preg_replace('/\'/', "\"",$queuemetrics_socket_url);
$agent_status_viewable_groups = preg_replace('/\\\\/', '',$agent_status_viewable_groups);
$agent_status_viewable_groups = preg_replace('/\\\\/', '',$agent_status_viewable_groups);
$agent_allowed_chat_groups = preg_replace('/\\\\/', '',$agent_allowed_chat_groups);
$agent_allowed_chat_groups = preg_replace('/\\\\/', '',$agent_allowed_chat_groups);
$report_url = preg_replace('/\\\\/', '',$report_url);
$report_url = preg_replace('/;/','',$report_url);
$report_url = preg_replace('/\r|\n/', '',$report_url);
$report_url = preg_replace('/\'/', '',$report_url);
$agent_push_url = preg_replace('/\\\\/', '',$agent_push_url);
$agent_push_url = preg_replace('/;/','',$agent_push_url);
$agent_push_url = preg_replace('/\r|\n/', '',$agent_push_url);
$agent_push_url = preg_replace('/\'/', '',$agent_push_url);
$waiting_call_url_on = preg_replace('/\\\\/', '',$waiting_call_url_on);
$waiting_call_url_on = preg_replace('/;/','',$waiting_call_url_on);
$waiting_call_url_on = preg_replace('/\r|\n/', '',$waiting_call_url_on);
$waiting_call_url_on = preg_replace('/\'/', '',$waiting_call_url_on);
$waiting_call_url_off = preg_replace('/\\\\/', '',$waiting_call_url_off);
$waiting_call_url_off = preg_replace('/;/','',$waiting_call_url_off);
$waiting_call_url_off = preg_replace('/\r|\n/', '',$waiting_call_url_off);
$waiting_call_url_off = preg_replace('/\'/', '',$waiting_call_url_off);
$sounds_web_server = preg_replace('/\\\\/', '',$sounds_web_server);
$sounds_web_server = preg_replace('/;/','',$sounds_web_server);
$sounds_web_server = preg_replace('/\r|\n/', '',$sounds_web_server);
$sounds_web_server = preg_replace('/\'/', '',$sounds_web_server);
$pause_max_url = preg_replace('/\\\\/', '',$pause_max_url);
$pause_max_url = preg_replace('/;/','',$pause_max_url);
$pause_max_url = preg_replace('/\r|\n/', '',$pause_max_url);
$pause_max_url = preg_replace('/\'/', '',$pause_max_url);

### VARIABLES TO BE mysqli_real_escape_string ###
# $web_form_address
# $queuemetrics_url
# $admin_home_url
# $qc_web_form_address
# $vtiger_url
# $web_form_address_two
# $crm_login_address
# $start_call_url
# $dispo_call_url
# $add_lead_url
# $webphone_url
# $webphone_url_override
# $filter_url
# $na_call_url
# $web_form_address_three
# $container_entry
# $nva_call_url
# $web_socket_url
# $external_web_socket_url
# $customer_chat_survey_link
# $ftp_user
# $ftp_pass
# $webphone_layout
# $enter_ingroup_url
# $dead_trigger_url
# $user_admin_redirect_url
# $local_web_callerID_URL
# $VICIDIAL_web_URL
# $audit_comments
# $chat_url

# filtered further down in the code
# $groups
# $XFERgroups
# $campaigns
# $qc_campaigns
# $qc_groups
# $qc_statuses
# $qc_lists
# $shift_weekdays
# $group_shifts
# $phone_numbers
# $list_active_change
# $reports_use_slave_db
# $custom_reports_use_slave_db
# $allowed_reports
# $allowed_custom_reports
# $tables_use_alt_log_db
# $admin_viewable_groups
# $admin_viewable_call_times
# $territory_reset
# $max_inbound_filter_statuses
# $max_inbound_filter_ingroups
# $included_campaigns
# $included_inbound_groups
# $allowed_queue_groups
# $queue_groups

### VARIABLES optionally filtered: ###

# $script_text JS filtering
$rjs_debug='';
if ($SSscript_remove_js > 0)
	{
	$rjs=0;   $rjs_ct=0;
	$temp_length_a = strlen($script_text);
	if ($temp_length_a > 7)
		{
		while ( ($rjs < 10000000000) and (preg_match("/<script\b[^>]*>/is",$script_text)) )
			{
			$temp_length_a = strlen($script_text);
			$script_text = preg_replace('/<script\b[^>]*>(.*?)<\/script\s*>/is','',$script_text);
			$temp_length_b = strlen($script_text);
			if ($temp_length_a != $temp_length_b) {$rjs_ct++;}
			else {$rjs=99999999999;}
			$rjs++;
			}
		$rjsb=0;
		while ( ($rjsb < 10000000000) and (preg_match("/<script\b[^>]*>/is",$script_text)) )
			{
			$temp_length_a = strlen($script_text);
			$script_text = preg_replace('/<script\b[^>]*>/is','',$script_text);
			$temp_length_b = strlen($script_text);
			if ($temp_length_a != $temp_length_b) {$rjs_ct++;}
			else {$rjsb=99999999999;}
			$rjsb++;
			}
		$rjsc=0;
		while ( ($rjsc < 10000000000) and (preg_match("/javascript:|onabort|onactivate|onafterprint|onafterupdate|onbeforeactivate|onbeforecopy|onbeforecut|onbeforedeactivate|onbeforeeditfocus|onbeforepaste|onbeforeprint|onbeforeunload|onbeforeupdate|onblur|onbounce|oncellchange|onchange|onclick|oncontextmenu|oncontrolselect|oncopy|oncut|ondataavaible|ondatasetchanged|ondatasetcomplete|ondblclick|ondeactivate|ondrag|ondragdrop|ondragend|ondragenter|ondragleave|ondragover|ondragstart|ondrop|onerror|onerrorupdate|onfilterupdate|onfinish|onfocus|onfocusin|onfocusout|onhelp|onkeydown|onkeypress|onkeyup|onlayoutcomplete|onload|onlosecapture|onmousedown|onmouseenter|onmouseleave|onmousemove|onmoveout|onmouseover|onmouseup|onmousewheel|onmove|onmoveend|onmovestart|onpaste|onpropertychange|onreadystatechange|onreset|onresize|onresizeend|onresizestart|onrowexit|onrowsdelete|onrowsinserted|onscroll|onselect|onselectionchange|onselectstart|onstart|onstop|onsubmit|onunload/is",$script_text)) )
			{
			$temp_length_a = strlen($script_text);
			$script_text = preg_replace('/javascript:|onabort|onactivate|onafterprint|onafterupdate|onbeforeactivate|onbeforecopy|onbeforecut|onbeforedeactivate|onbeforeeditfocus|onbeforepaste|onbeforeprint|onbeforeunload|onbeforeupdate|onblur|onbounce|oncellchange|onchange|onclick|oncontextmenu|oncontrolselect|oncopy|oncut|ondataavaible|ondatasetchanged|ondatasetcomplete|ondblclick|ondeactivate|ondrag|ondragdrop|ondragend|ondragenter|ondragleave|ondragover|ondragstart|ondrop|onerror|onerrorupdate|onfilterupdate|onfinish|onfocus|onfocusin|onfocusout|onhelp|onkeydown|onkeypress|onkeyup|onlayoutcomplete|onload|onlosecapture|onmousedown|onmouseenter|onmouseleave|onmousemove|onmoveout|onmouseover|onmouseup|onmousewheel|onmove|onmoveend|onmovestart|onpaste|onpropertychange|onreadystatechange|onreset|onresize|onresizeend|onresizestart|onrowexit|onrowsdelete|onrowsinserted|onscroll|onselect|onselectionchange|onselectstart|onstart|onstop|onsubmit|onunload/is','',$script_text);
			$temp_length_b = strlen($script_text);
			if ($temp_length_a != $temp_length_b) {$rjs_ct++;}
			else {$rjsc=99999999999;}
			$rjsc++;
			}
		if ($rjs_ct > 0) {$rjs_debug = "\n<BR><BR>Script Text JS Filtered: $rjs_ct<BR>\n";}
	#	$script_text = "PROCESSED:".date("U")."\n".$script_text;
		}
	}
##### END VARIABLE FILTERING FOR SECURITY #####


# ViciDial database administration
# admin.php
# 
# CHANGELOG:
# 50315-1110 - Added Custom Campaign Statuses
# 50317-1438 - Added Fronter Display var to inbound groups
# 50322-1355 - Added custom callerID per campaign
# 50517-1356 - Added user_groups sections and user_group to vicidial_users
# 50517-1440 - Added ability to logout (must click OK with empty user/pass)
# 50602-1622 - Added lead loader pages to load new files into vicidial_list
# 50620-1351 - Added custom vdad transfer AGI extension per campaign
# 50810-1414 - modified in groups to kick out spaces and dashes
# 50908-2136 - Added Custom Campaign HotKeys
# 50914-0950 - Fixed user search by user_group
# 50926-1358 - Modified to allow for language translation
# 50926-1615 - Added WeBRooTWritablE write controls
# 51020-1008 - Added editable web address and park ext - NEW dial campaigns
# 51020-1056 - Added fields and help for campaign recording control
# 51123-1335 - Altered code to function in php globals=off
# 51208-1038 - Added user_level changes, function controls and default user phones
# 51208-1556 - Added deletion of users/lists/campaigns/in groups/remote agents
# 51213-1706 - Added add/delete/modify vicidial scripts
# 51214-1737 - Added preview of vicidial script in popup window
# 51219-1225 - Added campaign and ingroups script selector and get_call_launch field
# 51222-1055 - Added am_message_exten to campaigns to allow for AM Message button
# 51222-1125 - Fixed new vicidial_campaigns default values not being assigned bug
# 51222-1156 - Added LOG OUT ALL AGENTS ON THIS CAMPAIGN button to campaign screen
# 60204-0659 - Fixed hopper reset bug
# 60207-1413 - Added AMD send to voicemail extension and xfer-conf dtmf presets
# 60213-1100 - Added several vicidial_users permissions fields
# 60215-1319 - Added On-hold CallBacks display and links
# 60227-1226 - Fixed vicidial_inbound_groups insert bug
# 60413-1308 - Fixed list display to have 1 row/status: count and time zone tables
#            - Added status name in selected dial statuses in campaign screen
# 60417-1416 - Added vicidial_lead_filters sections
#            - Changed the header links to color-coded sectional with sublinks below
#            - Added filter name and script name to campaign and in-group modify sections
#            - Added callback and alt dial options to campaigns section
#            - Added callback, alt dial and other options to users section
# 60419-1628 - Alter Callbacks display to include status and LIVE listings, reordered
# 60421-1441 - check GET/POST vars lines with isset to not trigger PHP NOTICES
# 60425-2355 - Added agent options to vicidial_users, reformatted user page
# 60502-1627 - Added drop_call_seconds and safe_harbor_ fields to campaign screen
# 60503-1228 - Added drop_call_seconds and drop_ fields to inbound groups screen
# 60505-1117 - Added initial framework for new local_call_times tables and definitions
# 60506-1033 - More revisions to the local_call_time section
# 60508-1354 - Finished call_times and state_call_times sections
#            - Added modify/delete options for call_times
# 60509-1311 - Functionalize campaign dialable leads calculation
#            - Change state_call_times selection from call_times to only allow one per state
#            - Added dialable leads count popup to campaign screen if auto-calc is disabled
#            - Added test dialable leads count popup to filter screen 
# 60510-1050 - Added Wrapup seconds and Wrapup message to campaigns screen
# 60608-1401 - Added allowable inbound_groups checkboxes to CLOSER campaign detail screen
# 60609-1051 - Added add-to-dnc in LISTS section
# 60613-1415 - Added lead recycling options to campaign detail screen
# 60619-1523 - Added variable filtering to eliminate SQL injection attack threat
# 60622-1216 - Fixed HotKey addition form issues and variable filtering
# 60623-1159 - Fixed Scheduled Callbacks over-filtering bug and filter_sql bug
# 60808-1147 - Changed filtering for and added instructions for consutative transfers
# 60816-1552 - Added allcalls_delay start delay for recordings in vicidial.php
# 60817-2226 - Fixed bug that would not allow lead recycling of non-selectable statuses
# 60821-1543 - Added option to Omit Phone Code while dialing in vicidial
# 60821-1625 - Added ALLFORCE recording option for campaign_recording
# 60823-1154 - Added fields for adaptive dialing
# 60824-1326 - Added adaptive_latest_target_gmt for ADAPT_TAPERED dial method
# 60825-1205 - Added adaptive_intensity for ADAPT_ dial methods
# 60828-1019 - Changed adaptive_latest_target_gmt to adaptive_latest_server_time
# 60828-1115 - Added adaptive_dl_diff_target and changed intensity dropdown
# 60927-1246 - Added astguiclient/admin.php functions under SERVERS tab
# 61002-1402 - Added fields for vicidial balance trunk controls
# 61003-1123 - Added functions for vicidial_server_trunks records
# 61109-1022 - Added Emergency VDAC Jam Clear function to Campaign Detail screen
# 61110-1502 - Add ability to select NONE in dial statuses, new list_id must not be < 100
# 61122-1228 - Added user group campaign restrictions
# 61122-1535 - Changed script_text to unfiltered and added more variables to SCRIPTS
# 61129-1028 - Added headers to Users and Phones with clickable order-by titles
# 70108-1405 - Added ADAPT OVERRIDE to allow for forced dial_level changes in ADAPT dial methods
#            - Screen width definable at top of script, merged server_stats into this script
# 70109-1638 - Added ALTPH2 and ADDR3 hotkey options for alt number dialing with HotKeys
# 70109-1716 - Added concurrent_transfers option to vicidial_campaigns
# 70115-1152 - Aded (CLOSER|BLEND|INBND|_C$|_B$|_I$) options for CLOSER-type campaigns
# 70115-1532 - Added auto_alt_dial field to campaign screen for auto-dialing of alt numbers
# 70116-1200 - Added auto_alt_dial_status functionality to campaign screen
# 70117-1235 - Added header formatting variables at top of script
#            - Moved Call Times and Phones/Server functions to Admin section
# 70118-1706 - Added new user group displays and links
# 70123-1519 - Added user permission settings for all sections
# 70124-1346 - Fixed spelling errors and formatting consistency
# 70202-1120 - Added agent_pause_codes section to campaigns
# 70205-1204 - Added memo, last dialed, timestamp and stats-refresh fields to vicidial_campaigns/lists
# 70206-1323 - Added user setting for vicidial_recording_override
# 70212-1412 - Added system settings section
# 70214-1226 - Added QueueMetrics Log ID field to system settings section
# 70219-1102 - Changed campaign dial statuses to be one string allowing for high limit
# 70223-0957 - Added queuemetrics_eq_prepend for custom ENTERQUEUE prepending of a field
# 70302-1111 - Fixed small bug in dialable leads calculation
# 70314-1133 - Added insert selection on script forms
# 70319-1423 - Added Alter Customer Data and agent disable display functions
# 70319-1625 - Added option to allow agents to login to outbound campaigns with no leads in the hopper
# 70322-1455 - Added sipsak messages parameters
# 70402-1157 - Added HOME link and entry to system_settings table, added QM link on reports section
# 70516-1628 - Started reformatting campaigns to use submenus to break up options
# 70529-1653 - Added help for list mix
# 70530-1354 - Added human_answered field to statuses, added system status modification
# 70530-1714 - Added lists for all campaign subsections
# 70531-1631 - Development on List mix admin interface
# 70601-1629 - More development on List mix admin interface, formatting, and added some javascript
# 70602-1300 - More development on List mix admin interface, more javascript
# 70608-1459 - Added option to set LIVE Callbacks to INACTIVE after one month
# 70612-1451 - Added Callback INACTIVE link for after one week, sort by user/group/entrydate
# 70614-0231 - Added Status Categories, ability to Modify Statuses, moved system statuses to sub-section
# 70623-1008 - List Mix section now allows modification of list mix entries
# 70629-1721 - List Mix section adding and removing of list entries active
# 70706-1636 - List Mix section cleanup and more error-checking
# 70908-0941 - Added agc logile enable system_settings
# 71020-1934 - Added inbound groups options: on-hold music, messages, call_times
# 71022-1343 - Added inbound group ranks for users
# 71029-1710 - Added option for campaign to be inbound and/or blended with no restrictions on the campaign_id name
#            - Added 5th NEW and 6th NEW to the dial order options
# 71030-2010 - Added Manual Dial List ID field to campaigns table
# 71103-2207 - Added inbound_group_rank and fewest_calls to the inbound groups call order options
# 71113-1521 - Added campaign_rank to agent options
#            - Added ability to Copy a campaign's setting to a new campaign
# 71113-2225 - Added ability to copy user and in-group settings to new users and in-groups
# 71116-0942 - Added campaign_rank and fewest_calls as methods for agent call routing
# 71122-1135 - Added default transfer group for campaigns and inbound groups
# 71125-1751 - Added allowable transfer groups to campaign detail screen
# 80107-1204 - Started framework for new QC section
# 80112-0242 - Added more options for lead order
# 80211-1901 - Added DB Schema Version to system settings display
# 80224-1334 - Added Queue Priority to in-groups and campaigns
# 80302-0232 - added drop_action and transfer to in-group for both in-groups and outbound
# 80310-1504 - added QC settings section to campaign screen
# 80317-2037 - Added Recording override settings to in-groups
# 80414-1505 - More work on QC, added vicidial_qc_codes
# 80424-0442 - Added non_latin system_settings lookup at top to override dbconnect setting
# 80505-0333 - Added phones_alias sections to allow for load-balanced-phone-logins
# 80512-1529 - Added auto-generate of User ID feature
# 80515-1345 - Added Shifts sub-section to Admin section
# 80528-0001 - Added campaign survey sub-section
# 80528-1102 - Added user timeclock edit options
# 80608-1304 - Changed add-to-DNC to allow for multiple entries per submission
# 80625-0032 - Added time/phone display format options to system settings
# 80703-0124 - Added alter cust phone and api settings
# 80715-1130 - Added Recycle leads limit count
# 80719-1351 - Changed QC settings in campaigns and In-Groups
# 80809-2305 - Added Sale and Dead Lead categories to status categories page
# 80815-1036 - Added manual dial filter to capaigns
# 80823-2124 - Added copy to clipboard campaign option
# 80829-2359 - Added EXTENDED auto_alt_dial options
# 80831-0406 - Added agent screen extended alt-dial option to campaigns
# 80909-0553 - Added campaign-specific DNC list option and add
# 81002-1101 - Added more in-group options and new DID section and user options
# 81007-0936 - Added three_way_call_cid option to campaigns
# 81012-1725 - Added INBOUND_MAN dial method allowing for manual list dialing with inbound calls
# 81030-0348 - Added campaign pause code force option
# 81030-2228 - Fixed DIDs creation issue
# 81103-1408 - Added 3way call dial prefix option
# 81107-1551 - Added Stats Percent of Calls Answered Within X seconds fields to in-groups
# 81118-0933 - Changed lists listing with links and more options
# 81119-0715 - Added ability to bulk enable/disable lists from modify campaign screen
# 81209-1538 - Added web_form_target to campaign screen
# 81210-1430 - Added http server IP and recording link options to servers
# 81222-0500 - Reformatted all listings to same format changed to field selects instead of *
# 81228-2300 - Added fields for vtiger integration and active vicidial_user display
# 90101-1216 - Added options for user synchronization with vtiger
# 90112-0335 - Added vtiger_create_lead_record and vtiger_create_lead_record options
# 90115-0502 - Activated AGENT DID routing option
# 90126-2256 - Added vtiger_screen_login campaign option and user agent alert option
# 90201-1503 - Added option to disable the viewing of inactive QC features
# 90202-0112 - Added option to disable outbound autodialing(or list dialing)
# 90202-0444 - Added cpd_amd_action option for processing of AMD messages
# 90209-1339 - Added download_lists option to allow downloading of lists
# 90210-1042 - Added options for auto-generation of asterisk conf files
# 90301-2026 - Added Vtiger group synchronization
# 90302-2046 - Changed Section heading to be on the left side of the screen
# 90303-0631 - Added web vars to agent campaign and in-group settings
# 90303-2047 - Added group aliases and default group aliases
# 90306-1214 - Added shift enforcement and server/system calls per second options
# 90308-0956 - Added server statistics
# 90309-0059 - Changed logging to admin_server_log
# 90310-2203 - Added export_reports option for call activity report data exports
# 90315-1010 - Changed revision for new trunk 2.2.0
# 90320-0424 - Fixed several small bugs conf records group alias and permissions
# 90322-0122 - Added ability to delete from the DNC lists
# 90322-1105 - Added new status settings and vtiger options
# 90409-2133 - Fixed special characters in SCRIPTS
# 90413-0755 - Fixed filter and script slashes issues
# 90417-0211 - Fixed filter and script slashes issues
# 90422-0613 - Added user_code, territory and email to vicidial_users
# 90429-0542 - Added 3rd&4th options to SURVEY campaigns
# 90430-0154 - Added RANDOM and LAST CALL TIME options to lead order for campaigns
# 90504-0901 - Added Call Menu feature, changed script to use long PHP tags
# 90511-0910 - Added agentonly_callback_campaign_lock to system_settings
# 90512-0440 - Added sounds settings to system_settings table
# 90514-0607 - Added select prompts from list in call menu and in-group screens
# 90521-0029 - Added user territories enable option
# 90522-0506 - Security fix for logins when using non-latin setting
# 90524-2307 - Changed Reports screen layout
# 90528-2055 - Added ViciDial recording limit field in servers and phone_context to phones
# 90530-1206 - Changed List Mix to allow for 40 mixes
# 90531-1802 - Added auto-generated options for users, campaigns, in-groups, etc..., added option to HIDE custphone
# 90531-2339 - Added Dynamic options for Call Menu
# 90605-0248 - Added carrier_logging_active servers option
# 90607-1716 - Changed drop percent limit to allow for 0.1 steps under 3%
# 90608-0944 - Added Drop Lockout Time feature to Campaign Detail Modification screen
# 90612-0909 - Added audio prompt selection feature to survey screen
# 90614-0827 - Added In-Group routing to Call Menu screen, Added pull-down Call Menu option to DID screen
# 90617-0733 - Added phone ring timeout and call menu custom dialplan entries
# 90621-0821 - Added phone Conf File Secret field to use a separate password from the user interface for a phone
# 90621-1220 - Added Call Menu logging tracking_group
# 90627-0547 - Added no-agent-no-queue options
# 90627-2333 - Added default transfer button and prepopulate preset options
# 90628-0924 - Added Text To Speech(TTS) fields
# 90628-2213 - Added Multi-campaign drop rate groups
# 90705-0926 - Added User Group agent view options
# 90710-1528 - Added Agent view and grab queue calls and every call pause options
# 90717-0646 - Added dialed_label and dialed_number to script variables
# 90721-1350 - Added RANK and OWNER as list order options and list screen display tables
# 90722-1235 - Added list reset time and campaign no hopper dialing, agent dial owner only options
# 90726-0153 - Added allow_alerts for users to disable agent browser alerts
# 90729-0555 - Added agent_display_dialable_leads and vicidial_balance_rank options
# 90808-0300 - Added longest_wait_time option for agent call routing
# 90827-1552 - Added agent_script_override option for lists
# 90830-2217 - Added Music On Hold section
# 90904-1536 - Added moh chooser option, timezone list ordering
# 90908-1207 - Added cross-listing linking for DIDs, CallMenus and In-groups
# 90916-1105 - Added second web form to ingroups and campaigns and added audio choose for answering machine message and waitforsilence_options
# 90917-1108 - Added Extra Voicemail boxes config in Admin section
# 90919-2251 - Removed all SELECT STAR instances in the code, code cleanup to conform to standard
# 90924-1645 - Added list_id overrides for cid, am_message and drop in-group
# 90930-2107 - Added agent territory selection options for ViciDial agents
# 91026-1050 - Added AREACODE DNC option for campaigns
# 91031-1232 - Added carrier_description field, campaigns links from in-group screen, server links on reports page, agent ranks listing active only
# 91121-0334 - Limited list called count display to 100+
# 91125-0628 - Added conf_secret for servers
# 91204-1652 - Added recording_filename and recording_id as script variables
# 91205-2231 - Added delete_vm_after_email voicemail option to phones and extra voicemail sections
# 91210-2038 - Added better logging of Campaign emergency logout
# 91211-1359 - Added custom user fields and campaign CRM login fields
# 91219-0719 - Changed some field backgrounds in the Campaign Modification screens
# 91223-1031 - Added VIDPROMPT options for in-group routing in DIDs
# 91228-1837 - Added timer action settings to in-groups and campaigns
# 100103-0727 - Added Start/Dispo call url, 3/4/5 conf number presets, Lists conf-number overrides
# 100104-1454 - Fixed in-group/campaign copy duplication issue
# 100116-0718 - Added presets to script select list
# 100122-0747 - Added NOT-LOGGED-IN-AGENTS option for User Groups
# 100123-1301 - Added DID record call option
# 100127-0601 - Added Vtiger ViciDial user_level role lookup
# 100127-1546 - Added ignore_list_script_override option for ingroups
# 100219-1309 - Added agent dispo log system settings option and user call_log options
# 100220-1411 - Added system settings and servers custom_dialplan_entry
# 100221-0924 - Added Custom CallerID capability in Campaign settings
# 100302-2133 - Added Scheduled Callbacks Alert option
# 100309-0510 - Added queuemetrics_loginout option
# 100311-2348 - Added CallCard links and settings
# 100313-0020 - Added User Group agent screen transfer-conf button display options
# 100317-1244 - Added User Group agent_fullscreen option
# 100401-0014 - Added agent_choose_blended option
# 100405-1425 - Added queuemetrics_callstatus option and full logging of user campaign/in-group settings
# 100414-1603 - Added extension_appended_cidname option to campaigns
# 100420-1010 - Added scheduled_callbacks_count campaign option
# 100423-1030 - Added realtime_block_user_info, manual dial campaign, blind monitor warnings, in-group callid, phones codecs features
# 100506-1807 - Added hidden settings for lists custom fields
# 100507-1102 - Added hold_time_option_minimum option to in-groups and copy carrier function
# 100512-1615 - Added more hold time press-1 options
# 100518-0643 - Added inbound_queue_no_dial and call time after hours override features
# 100523-0840 - Added inbound prompt and no-block options
# 100616-2232 - Added VIDPROMPT call menu options
# 100621-1010 - Added admin_web_directory system setting
# 100622-1700 - Added custom agent field names for default fields
# 100702-1142 - Added FORM get_call_launch option for custom list fields tab in agent interface
# 100703-1322 - Added LEADS ability to admin log display
# 100709-1025 - Added option for slave DB server to be used for selected reports
# 100718-2318 - Added Wait Time options to in-groups
# 100720-1332 - Small changes to Phone addition and modification pages
# 100723-1519 - Added LOCKED options for Quick Transfer Button in campaigns
# 100726-1017 - Added HANGUP, CALLMENU, EXTENSION and IN_GROUP timer actions to campaigns and in-groups
# 100802-2130 - Changed Admin links to point to links page instead of Phones listings, changed Remote Agents to allow 9-digit IDs
# 100803-1412 - Added allowed_reports option to User Groups, added CAMPLISTS_ALL for manual_dial_filter(issue #369)
#             - Added allowed_campaigns enforcement for Campaign listings
# 100804-2313 - Added filter phone groups section for inbound call filtering by incoming phone number when it comes into a DID
# 100805-1539 - Added option to clean up cid numbers when calls come into DIDs
# 100806-0607 - Added validation for remote agents settings, user_start must be valid user, number of lines must not overlap
# 100811-0827 - Added webphone_url_override to User Groups and calculate_estimated_hold_seconds to In-Groups
# 100813-0544 - Added campaign presets and option to hide xfer number to dial
# 100815-0802 - Added manual_dial_prefix campaign option
# 100817-1243 - Added checking for reserved menu_id on creation of Call Menus
# 100823-1501 - Added CallCard search as an available User Group report option
# 100827-1535 - Added webphone options for dialpad and systemkey
# 100901-2055 - Added password strength grading, force password change, password default settings and first login screen
# 100908-0926 - Added 3way hangup logging options to campaigns
# 100912-0842 - Several small changes, removed Emergency VDAC clear since it does not do anything anymore
# 100927-2321 - Added entry_list_id as a script, webform, dispo_call_url variable
# 100928-1634 - Moved Realtime Block User Info user setting into the new ADMIN REPORT OPTIONS section
# 100929-1203 - Added add_lead_url feature to In-Groups
# 101008-0349 - Added Estimated Hold Time Minimum options, Manual Dial Preview settings and two new variables for recording filenames
# 101022-1427 - Added ability to change user in-group prefs from in-group mod screen, added realtime_agent_time_stats campaign option
# 101106-1850 - Added admin refrech, no-cache, cross-server-exten, QM-addmember options
# 101109-1621 - Added Auto Hopper Level which allows Vicidial to adjust the hopper for a campaign as needed (MikeC)
#             - Added Auto Trim Hopper which will allow Vicidial to remove excess leads from the hopper (MikeC)
# 101115-1355 - Added more options for the concurrent transfer limit campaign setting
# 101123-2214 - Added api_manual_dial and manual_dial_call_time_check campaign options
# 101127-2232 - Added webform override options to lists
# 101208-0341 - Changed some descriptions and field names in Phones
# 101209-2027 - Added display_leads_count option for campaign modification screens
# 101216-1838 - Changed Realtime report links to go to new realtime_report
# 101227-1320 - Added dialplan off toggle options
# 110103-1135 - Added queuemetrics_dispo_pause and lead_order_randomize features
# 110111-1305 - Added sort by list name for list listings in list section and campaign screens
# 110124-1134 - Small query fix for large queue_log tables
# 110212-2048 - Added Scheduled Callback as status flag to allow for custom scheduled callback statuses
# 110214-0001 - Added campaign settings for lead_order_secondary, per_call_notes and my_callback_option
# 110215-1721 - Added add-a-new-lead link to the lists submenu
# 110215-2135 - Added agent_lead_search options to user and campaign
# 110222-2039 - Added USER, GROUP and TERRITORY restrictions to agent lead search
# 110224-1427 - Added queuemetrics_phone_environment and active_twin_server_ip options
# 110301-1206 - Added options for ring-all in-group next-agent-call
# 110304-1651 - Added DEFER options to the scheduled callbacks alert campaign feature
# 110310-0311 - Added pre-call auto-pause and resume with pause code, for auto-pausing of callback-check, lead search, etc...
# 110408-0433 - Added Multi-alt block code and system settings reload dialplan setting
# 110428-1108 - Added manual_dial_cid campaign option
# 110430-1642 - Added post_phone_time_diff_alert campaign option
# 110506-1537 - Added custom_3way_button_transfer campaign option
# 110514-1351 - Added dial level and available only tally threshold campaign settings, and time zone list setting
# 110524-1401 - Small help text fix, issue #486
# 110525-2109 - Added safe_harbor_audio, safe_harbor_menu_id campaign options and dtmf_log call menu option
# 110526-1715 - Added webphone_auto_answer option
# 110528-2304 - Added campaign survey callmenu option
# 110531-2009 - Added callback_days_limit campaign option
# 110602-0941 - Added dl_diff_target_method campaign option
# 110619-1942 - Added disable_dispo_ agent screen options
# 110624-0842 - Added Export Leads Report links and permissions
# 110624-2246 - Added Screen Labels subsection for Admin and status_display_fields feature
# 110625-2338 - Added queuemetrics_pe_phone_append option
# 110703-1400 - Added test_campaign_calls and agents_calls_reset features
# 110707-0725 - Added AGENTEXT notes for in-groups settings
# 110707-1402 - Added last_inbound_call_time and finish to next agent call options for in-groups
# 110727-0130 - Added more voicemail box options and default timezone and voicemail zone to system settings
# 110730-2249 - Added DISPO_SELECT_DISABLED option for the Dispo Disable setting in campaigns
# 110731-0245 - Added na_call_url options to campaigns and in-groups
# 110801-0833 - Added on_hook_cid option for in-groups
# 110802-2053 - Added links to Team Performance Detail Report
# 110809-1547 - Added no-answer log and alt-log server system settings
# 110815-2155 - Added the Campaign Status List Report
# 110822-1204 - Added did_agent_log System Settings option
# 110829-1600 - Added multiple invalid option to Call Menus
# 110829-2129 - Added survey recording option
# 110831-2038 - Added Campaign Areacode CID features
# 110920-1344 - Added pllb_grouping_limit settings
# 110922-1218 - Added new User admin permissions, Added DID Remote Agent extension override section
# 110923-0834 - Added option for in-group action transfer cid, and CALLMENU as drop and after-hours action options
# 110923-2043 - Added custom DID fields
# 111004-1539 - Added dtmf_field call menu option
# 111006-1403 - Added several new campaign and other options, call_count_limit, status flag, shift report flag, etc...
# 111015-1914 - Added Preset Contact Search options
# 111018-1535 - Added more contact fields
# 111021-1646 - Added callback_hours_block option
# 111024-1234 - Added callback_list_calltime option
# 111025-0728 - Added user group to all sections, more user settings
# 111102-1930 - Added in-group max_calls_ options
# 111106-1116 - Many fixes for user_group restrictions
# 111116-0207 - Added ALT and ADDR3 in-group handle methods
# 111122-1333 - Added Inbound Daily Report
# 111201-0939 - Added graded-random next-agent-call option
# 111223-0043 - Added max stats displays for in-groups and , fixed several ereg issues
# 111227-1938 - Added Timer Action for Dx_DIAL_QUIET options
# 120102-2125 - Added Dialer Inventory Report
# 120104-2024 - Changed copyright dates, other small fixes
# 120118-2113 - Fixed bugs in phone alias and conf template updates
# 120125-1234 - Added Maximum System Stats report and permissions for it and Max Stats Detail report
# 120125-2107 - Added User Group Active User In-Group Select function to User Group page
# 120207-1955 - Added List territory reset function
# 120213-1512 - Added remote agent max stats display and campaign VLC hopper dup check option
# 120221-0054 - Fixed Call Time and User Group restrictions on several pages
# 120221-1647 - Added inventory report options to lists and shifts
# 120316-1203 - Fixed DIALBLE counts for completed statuses
# 120402-2111 - Added lead loading template and two carrier log reports to the admin utils page
# 120409-1136 - Added Search Leads Logs as slave db option
# 120420-1620 - Forked 2.4 to branches, changing trunk to 2.6
# 120512-0844 - Added In-Group Manual Dial options to campaign screen
# 120514-0936 - Added Dial In-group CID override setting
# 120518-1456 - Added XFTAMM/LTMG special hotkeys for send to answering machine message
# 120526-0827 - Added User Group User Login Report
# 120529-2112 - Added safe_harbor_audio_field campaign option
# 120706-1255 - Added Max stats date range and call menu qualify_sql options
# 120713-2123 - Added max stats download link and extended_vl option
# 120810-1018 - Added Admin List Counts system settings option
# 120820-1104 - Added is_webphone option Y_API_LAUNCH
# 120831-1523 - Added vicidial_dial_log outbound call logging
# 121018-2321 - Added blank option to owner only dialing
# 121019-0520 - Added voicemail greeting audio chooser options to phones and voicemail boxes
# 121025-2339 - Added without-filter output to test filter function, added server option to test call
# 121027-2344 - Added servers versions page
# 121029-0109 - Added pause_after_next_call and owner_populate campaign options
# 121114-1923 - Added Basic Lead Management page link. Added INGROUP as a recording filename option
# 121116-1410 - Added QC functionality
# 121120-0824 - Added queuemetrics_socket functionality to system settings
# 121123-1208 - Added inbound holiday functions
# 121124-1957 - Added List Expiration Date feature and Campaign Other-DNC-List feature
# 121129-2319 - Added enhanced_disconnect_logging option
# 121130-1425 - Fixed user group permissions issue with allowed campaigns modifications of user groups
# 121205-1619 - Added parentheses around filter SQL when in SQL queries
# 121206-0630 - Added inbound lead search feature
# 121212-1529 - Standardization of list_id fields at 19 digits in forms
# 121222-2146 - Added new email features
# 130102-1135 - Small change to admin log viewing for email accounts
# 130124-1721 - Added Inbound Email report link, added Status Display LEADID options(issue #639)
# 130130-1207 - Added new CPD AMD options for In-Groups and CallMenus
# 130221-1736 - Added Level 8 Disable Add option to system settings and new Email Log Report link, DID exten made non-editable
# 130402-2322 - Added user_group script variable
# 130414-1924 - Added report logging and display
# 130424-1601 - Added survey_wait_sec campaign survey option
# 130425-0700 - Added DROP option for survey_no_response_action to go to campaign drop method
# 130503-1509 - Added red color to server table on reports page if asterisk out of sync
# 130508-2306 - Branched 2.7, trunk becomes 2.8
# 130510-1350 - Added outbound state call time holidays functionality
# 130605-0841 - Converted ereg to preg
#             - Added display of agent login information on User Modify screen, and reset of failed_logins on update
# 130615-2124 - Added login lockout for 15 minutes after 10 failed logins, and other security fixes
# 130627-0745 - Added url log, lagged log and user group login reports to admin utilities page
# 130709-1350 - Changes for encrypted password compatibility, added Dial Log Report
# 130711-2208 - Added SYSTEM SNAPSHOT STATS as new welcome screen, and added new 
# 130809-1410 - Small fixes for call times and holidays
# 130824-2319 - Changed to mysqli PHP functions
# 130915-0045 - Added counts for new nanpa prefix type tables
# 130926-1731 - Added queuemetrics_record_hold system setting
# 130928-1130 - Added country_code_list_stats system setting option
# 131003-1749 - Small fix for voicemail box duplication with phone account
# 131007-1234 - Fix for copy user on encrypted passwords systems
# 131016-2112 - Added manual_dial_lead_id campaign option, fixes some small issues
# 131019-0849 - Moved help section to help.php
# 131029-2008 - Added Asterisk auto-restart options to servers
# 131208-1626 - Added campaign options for max dead, dispo and pause time
# 131210-1741 - Added ability to define slave server with port number, issue #687
# 140108-0752 - Added webserver and hostname to report logging
# 140117-0840 - Added option for Lists Pass Report
# 140126-0939 - Added VMAIL_NO_INST options
# 140126-2253 - Added voicemail_instructions option for phones
# 140206-1357 - Filter dashes from new or copied campaigns and in-groups
# 140214-1643 - Added system settings dialplan reload timestamp
# 140302-0958 - Added Webserver-URL Report
# 140305-0846 - Bug fix for list modify admin logging issue
# 140313-0727 - Added links to Called Counts List IDs Report
# 140313-1014 - Added warning to in-groups if they are not set as allowed in any campaigns
# 140314-1134 - Added more strict enforcement of level 9 report and user permissions and definable max stats days
# 140404-1007 - Added new DID filter features for DNC matching and URL DID Redirects
# 140411-1434 - Added Performance Comparison Report
# 140418-0914 - Added users and campaigns max_inbound_calls
# 140423-1636 - Added campaign settings for manual_dial_search_checkbox and hide_call_log_info
# 140425-0906 - Added user permission for editing custom dialplan entries
# 140425-1257 - Added queuemetrics_pause_type system settings option, and added pause_type to agent logout
# 140509-2201 - Added frozen_server_call_clear system setting, used in admin.php and AST_timecheck.pl
# 140515-1610 - Added clear list option, Issue #763
# 140521-2101 - Added timer_alt_seconds and more Manual Auto Dial options
# 140612-2153 - branched 2.9 version, raised trunk to 2.10
# 140617-2017 - Added vicidial_users wrapup_seconds_override option
# 140621-2136 - Added DID pre-filter phone-group redirection and no-agent-ingroup redirection options
# 140623-2147 - Added wrapup_bypass and script_message changes
# 140625-1931 - Added wrapup_after_hotkey campaign option
# 140706-0829 - Incorporated QC includes into code
# 140706-0927 - Added callback_time_24hour system setting
# 140817-0928 - Added User Group report permission for the Front Page System Summary report
# 140822-1034 - Fixed minor voicemail chooser bug on DID modify page
# 140902-0816 - Added callback_active_limit and callback_active_limit_override
# 141111-0554 - Finalized adding QXZ translation to all admin files
# 141118-1541 - Added agent_email script and webform variable
# 141121-0116 - Added campaign options for comments and QC comment history display in agent screen
# 141124-2138 - Added show_previous_callback campaign option
# 141124-2226 - Added clear_script campaign option
# 141124-2352 - Allow spaces in user custom fields, issue #465
# 141128-0758 - Fixed carrier-related seccurity issue in carrier listings
# 141204-0559 - Fixed Contacts alt-db issue, Added user modify_languages user option and enable_languages system option
# 141211-1639 - Added cpd_unknown_action campaign option and na_call_url lists option
# 141212-0930 - Added selected_language,user_choose_language user options and language_method system option
# 141227-1008 - Trigger sounds update on voicemail server when phone record is updated
# 141229-1543 - Added code for on-the-fly language translations display
# 150101-1511 - Updated for 2015
# 150107-1938 - Added ignore_group_on_search user option
# 150111-1543 - Added Lists local call time option(Issue #812) and a campaign option for manual_dial_search_filter
# 150112-2005 - Added flag to delete voicemail greeting when changed from an audio file to empty
# 150114-2249 - Added Single Agent Daily Time report
# 150117-1416 - Added list local call time validation when calculating dialable
# 150117-1454 - Added NAME as status dialplay option
# 150119-0920 - Added more list local calltime safety, issue #812
# 150120-0749 - Prevent modification of user_group ID, Hide non-functional agent_extended_alt_dial campaign feature, Export Calls Report Carrier added
# 150210-0657 - Added LOCK options for manual_dial_search_checkbox campaign setting
# 150217-0702 - Added Show VM on Summary Screen option for phones and voicemail boxes
# 150218-0924 - Added link to callbacks bulk move, also now we will archive deleted callbacks
# 150302-0951 - Release of 2.11 stable branch and raising trunk to 2.12
# 150307-1914 - Added login and leave3way custom sounds system settings options
# 150313-0912 - Added DB Schema Version warning if mismatched with astguiclient.conf value
# 150404-0932 - Added enable_did_entry_list_id and related DID options
# 150421-2315 - Fixed bugs in allow_emails
# 150422-1953 - Don't allow dial_timeout of less than 4 seconds
# 150428-1705 - Added options for third webform
# 150429-1222 - Added new API user restrictions
# 150512-2225 - Fixed SQL for permissions
# 150603-2000 - Modified for chat settings
# 150608-1127 - Added manual dial filer and search options for ALT/ADDR3 numbers, Added manual dial override field campaign option
# 150609-1207 - Fixes for chat settings
# 150609-1216 - Added in-group and script display settings
# 150609-2142 - Changes for different types of in-groups
# 150610-0934 - Added customer_gone_seconds campaign setting
# 150701-1131 - Modified mysqli_error() to mysqli_connect_error() where appropriate
# 150703-2105 - Fixed field sizes in Issues #867 and #868
# 150706-0811 - Added user setting for lead_filter_id in no-hopper dialing
# 150708-2246 - Added max_queue_ingroup_ DID settings options
# 150710-1120 - Added options for alternate Dispo Call URLs
# 150717-1333 - Optimization for dialable lead count SQL
# 150724-0822 - Added agent_debug_logging SS option and report
# 150725-1341 - Added agent_display_fields campaign options
# 150727-0903 - Added default_language System Setting option
# 150728-1012 - Added $DB hidden variable in Filter Text form, Issue #845
# 150728-1048 - Added option for secondary sorting by vendor_lead_code, Issue #833
# 150804-1107 - Added agent_whisper_enabled system settings option
# 150804-1608 - Added inbound group _lead_reset options
# 150806-1348 - Added Admin -> Settings Containers
# 150903-1457 - Added options for encrypt hosted features
# 150909-0158 - Added Report Page Servers Summary and Admin Utilities Page options for User Group Allowed Reports
# 150909-1418 - Added $active_only_default_campaigns options.php option for Campaigns Listings
# 150915-2113 - Added x_ra_carrier module option
# 150917-1629 - Added more permission validation before deleting records, issue #893
# 150925-2126 - Added user_hide_realtime options
# 150927-0820 - Added did_carrier_description, sorting by columns in DID list page, integer sort for user list page
# 150928-1235 - Separated User Group permissions for Inbound Report report by in-group and by DID
# 150928-1817 - Added DNC logging and DNC phone number log search
# 151007-2224 - Added links and lists for DIDs and Call Menus in use in sections, Issue #835
# 151022-1404 - Added status groups admin, Added custom reports display and admin
# 151030-0636 - Added usacan_phone_dialcode_fix system setting option, executed by keepalive at timeclock end of day
# 151104-1518 - Added am_message_wildcards campaign option and amm-multi admin page
# 151124-1141 - Added cache_carrier_stats_realtime settings option
# 151125-0010 - Added oldest_logs_date display field to system settings
# 151203-2142 - Added links to search page from called counts within this list table of list modify page
# 151204-0615 - Added phone options to have call go to dialplan extension instead of voicemail if phone not answered
# 151211-0940 - Added phone options for NVA recording agi script
# 151216-1053 - Added links to Inbound Chat Report
# 151220-1545 - Added more phone NVA settings
# 151221-0750 - Changes to Chat In-group Modify page
# 151229-1653 - Added gather_asterisk_output server option
# 151229-2258 - Added campaign setting for manual_dial_timeout
# 151231-0009 - Fixed admin logging in several places
# 151231-0834 - Added agent_allowed_chat_groups to User Groups
# 160101-0928 - Added routing_initiated_recordings to in-group and campaign settings, and updated for 2016
# 160106-0751 - Added GROUP_AREACODE option to inbound did filters
# 160106-1342 - Added on_hook_cid_number setting to in-groups
# 160106-1733 - Fixed user modification issue with certain manager user settings
# 160108-2211 - Added manual_dial_hopper_check campaign option
# 160111-0626 - Fixed SQL issues with making changes, Issue #913
# 160116-1439 - Added options/permissions for accessing recordings and logging the access time
# 160122-1401 - Added report_default_format system setting, added agent count per server on reports page
# 160304-2348 - Added link to API log report
# 160305-2048 - Added alternate ivr(call menu) dtmf logging
# 160306-1053 - Added new webphone options, added option to have carriers on all active asterisk servers
# 160312-1931 - Added select/deselect all options to AC-CID modify page. Reworked max stats calculations
# 160313-0756 - Changed AC-CID changes to log to the same entry instead of one per record
# 160325-1435 - Changes for sidebar, added callback_useronly_move_minutes campaign feature
# 160327-0145 - Reworked System Summary Screen
# 160328-0316 - Added links to the real-time report from the summary screen
# 160330-1559 - Redesign of Admin sub-menu and added icons
# 160331-2204 - Made URL form input fields longer
# 160404-0940 - design changes
# 160414-1013 - Added default_phone_code to system_settings
# 160427-1656 - Added more detail on active servers column on reports page
# 160429-0835 - Added admin_row_click system settings option
# 160506-0644 - Fixed old mysql connector, issue #950
# 160508-1155 - Added screen colors admin section
# 160508-1948 - Changed lists view to default to not show leads counts, with link to click to show counts
# 160514-1437 - Added ofcom_uk_drop_calc option
# 160517-1927 - formatting fixes
# 160602-1450 - Hiding email group settings that are not needed
# 160611-2230 - Added diff to last change on admin change detail display
# 160621-1733 - Added agent_screen_colors and script_remove_js settings to system settings
# 160708-0745 - Added more Automatic Hopper Multiplier options, up to 4
# 160731-1026 - Added campaign option to automatically manual dial next number in agent	screen after X seconds
# 160801-2119 - Added Admin Bulk Tools page link from Admin Utilities page
# 160809-1339 - Added customer_chat_screen_colors, customer_chat_survey_link/text as Chat Groups options
# 160816-2113 - Added trim to transfer-conf numbers so they don't retain spaces at the beginning or end of the number
# 160827-0917 - Added the User Group Hourly Report
# 161014-0902 - Added List Merge utility and User List NEW Lead Limit options
# 161018-2249 - Added allow_required_fields campaign option
# 161021-1320 - Added Fronter - Closer Detail Report, Fixed admin logging bug
# 161028-1539 - Added agent_xfer_park_3way option to system settings and user groups
# 161029-2304 - Added rec_prompt_count display to system settings
# 161031-1415 - Added User Overall user_new_lead_limit
# 161102-1040 - Fixed QM partition problem
# 161103-2204 - Added web_loader_phone_length and agent soundboards
# 161106-2058 - Added agent_script
# 161113-0900 - Changed script_id to 20 characters max, other small script changes
# 161126-2157 - Release of 2.13 stable branch and raising trunk to 2.14
# 161128-1552 - Small fix for link on DID modify page with plus sign'+' in did pattern
# 161128-1746 - Updated 3 INSERT SQL queries to specify fields
# 161205-1650 - Added AGI container_type to settings containers
# 161207-1953 - Added Agent DID Report
# 161222-0841 - Added agent_chat_screen_colors
# 161226-2224 - Added conf_qualify servers option
# 170113-1637 - Added call menu in-group option DYNAMIC_INGROUP_VAR for use with cm_phonesearch.agi, and updated for 2017
# 170114-1356 - Added populate_lead_province in-group option
# 170118-0106 - Added OW options to populate_lead_province in-group option
# 170207-1317 - Added phone_number_log API function, added api_only_user User option
# 170211-1041 - Moved api_only_user option in User Modify screen
# 170217-1350 - Added dead_to_dispo campaign setting
# 170220-1209 - Added switch_lead Agent API function
# 170220-1632 - Added In-group areacode_filter feature
# 170221-1542 - Added more DNC options for campaign setting 'manual dial filter', added counts to DNC add/delete page
# 170223-0657 - Added warning for On Hold Message if too long, adjusted chooser placements
# 170226-0850 - Added recording override options to chat and email groups to disable recordings for those, issue #992
# 170227-2231 - Change to allow horizontal_bar_chart header to be translated, issue #991
# 170228-1621 - Changed emergency logout to hangup all agent session calls, and more logging
# 170304-1355 - Added Automated Reports section to Admin
# 170309-1209 - Added campaign agent_xfer_validation option and ingroup populate_state_areacode option
# 170311-0928 - Fixes for QC allowed campaign permissions, issue #1003
# 170313-1041 - Added CHAT options to inbound_queue_no_dial
# 170315-0633 - Fix in in-group copy SQL
# 170320-1340 - Added conf_qualify phones option for IAX
# 170321-1100 - Added pause code time limits warning feature
# 170327-0704 - Added Drop Lists section
# 170327-1655 - Added USER_CUSTOM_ options to campaign custom callerID setting
# 170330-0953 - Fixed translation phrases in callbacks list, issue #1006
# 170407-0744 - Added Agents count on server page
# 170409-0950 - Added IP Lists (white and black) functionality
# 170410-1326 - Added dl_minutes option for drop lists
# 170412-2222 - Added Agent Parked Call Report link in Admin Utilities
# 170416-1548 - Added ready_max_logout campaign/user setting and routing_prefix server setting
# 170425-1353 - Fixed issue with entries in this server lists
# 170428-1958 - Added Inbound and Advanced Forecasting Reports
# 170429-0807 - Added campaign setting callback_display_days
# 170430-1001 - Added three_way_record_stop and hangup_xfer_record_start campaign settings
# 170516-0632 - Added Real-Time Monitoring Log Report
# 170527-0041 - Added filtering of browser details before logging
# 170529-2320 - Added agent events push settings
# 170609-1529 - Added ccc_lead_info API function
# 170613-0851 - Added hide_inactive_lists system settings option
# 170623-2142 - Changed parameters for password recommendations
# 170717-1444 - Fix for empty agent_choose_territories value
# 170816-1240 - Added in-group survey options
# 170818-0741 - Added User Group Hourly Report v2(detail)
# 170819-0949 - Added allow_manage_active_lists system setting
# 170821-2009 - Fix for issue #1036
# 170825-1708 - Added filename_override option for Automated Reports, added more space for report_times
# 170828-2105 - Added Inbound DID Summary Report
# 170913-0908 - Added Agent Inbound Status Summary Report
# 170920-2153 - Added expired_lists_inactive system setting and functions
# 170923-1425 - Added did_system_filter system setting and functions
# 170926-1618 - Fix for Test Call function for Asterisk 13
# 170930-0853 - Added extension_appended_cidname options and custom reports variable display
# 171001-1544 - Moved user IP Lists permissions to new security section in Modify User page
# 171005-1707 - Fix for remote agent modify overlap issue
# 171006-2039 - Added inbound list script override, Issue #1038
# 171011-1450 - Added webphone_layout option to phones and user groups
# 171018-1314 - Added scheduled_callbacks_email_alert campaign option
# 171018-2234 - Added server function to clear agent conferences
# 171028-0913 - Added Real-Time Whiteboard Report
# 171114-1100 - Fixed issue with admin log viewer for logs of modifications made by deleted users
# 171124-1041 - Added max_inbound_calls_outcome campaign setting
# 171124-1349 - Added manual_auto_next_options campaign setting
# 171126-1413 - Changes to allow for Email groups to display script tab on get_call_launch
# 171130-0036 - Added agent_screen_time_display campaign setting
# 171214-2045 - Added PREVIEW_ options for get_call_launch
# 171224-1220 - Added List default_xfer_group override
# 171229-2309 - Added housecleaning code
# 180108-2011 - Added next_dial_my_callbacks campaign option, updated for 2018
# 180109-1316 - Added call_status_stats API function
# 180111-1544 - Added anyone_callback_inactive_lists system setting
# 180130-2309 - Added inbound_no_agents_no_dial options
# 180204-0208 - Added In-Group Wait-Time option PRESS_CALLBACK_QUEUE, and Closing-Time options
# 180211-1024 - Changed campaign dial statuses to allow List and allowed In-Group selected status group statuses
# 180211-1126 - Added Outbound Lead Source Report
# 180213-0010 - Added GDPR system and user settings
# 180215-1318 - Added CID Groups admin screens
# 180216-1332 - Fix for system summary screen, issue #1068
# 180216-1743 - Many translation strings and permissions fixes, issue #1065
# 180217-0934 - Added NO_READY option for no_agent_no_queue in-group feature, issue #1046
# 180219-2204 - Fixed issue with CID Groups
# 180222-0017 - Added higher hopper level options
# 180306-1718 - Added script_top_dispo feature
# 180310-2230 - Added bulk change function for campaign and ingroup ranks in user modify page
# 180310-2321 - Added source_id_display system option
# 180316-0751 - Translated phrases fixes, issue #1081
# 180330-1425 - Added download of CID Group records feature
# 180331-1715 - Added update_did non-agent API function
# 180410-1600 - Added pause code manager approval settings
# 180411-1647 - Added DISPO_FILTER as Settings Container type
# 180424-1521 - Added in-group populate_lead_source, populate_lead_vendor settings
# 180430-1834 - Added in-group park_file_name override
# 180512-0852 - New AJAX-based help interface 
# 180512-2217 - Added users-max_hopper_calls,max_hopper_calls_hour settings
# 180516-1246 - Added waiting_call_url_ feature to In-Groups
# 180520-1749 - Added enter_ingroup_url feature to In-Groups
# 180530-0017 - Small DID bug fix, added Call Menus list on Modify Call Time page
# 180610-2309 - Added Campaign settings for Dead Call Triggers
# 180613-0943 - Fix for issue #1108
# 180618-2300 - Modified calls to audio file chooser function
# 180806-0752 - Added link to Callmenu Survey Report, Added fields for In-Group Callback CID features
# 180807-0958 - Added change for admin change log for Admin Modify Lead to better show lead changes
# 180807-1653 - Added agent_logout_link credentials setting to System Settings
# 180809-1547 - Added scheduled_callbacks_force_dial campaign setting
# 180812-0902 - Added scheduled_callbacks_auto_reschedule campaign setting
# 180825-2100 - Added scheduled_callbacks_timezones_container campaign setting and timezones display
# 180904-1206 - Added copying of in-group user grades/ranks when copying an in-group
# 180908-1618 - Added force_fronter_leave_3way API function
# 180916-0824 - Added daily_reset_limit Lists feature(level 9 users only)
# 180922-0958 - Added copying of user selected in-groups in copying of an in-group
# 180923-2226 - Added three_way_volume_buttons campaign setting
# 180924-1731 - Added callback_dnc campaign setting
# 180927-0018 - Added _wait_time options for next agent call options in campaigns and in-groups
# 181003-1619 - Added external_web_socket_url server setting
# 181005-1738 - Added SYSTEM to Manual Dial Filter campaign options
# 181116-1133 - Fix for DID server IP de-assignment
# 190108-0806 - Added manual_dial_validation system and campaign options, update date for 2019
# 190121-2019 - Added RA_AGENT_PHONE on-hook agent option
# 190207-2301 - Fix for user-group, in-group and campaign allowed/permissions matching issues
# 190221-1831 - Added force_fronter_audio_stop API function
# 190223-0850 - Added static prompt fields for in-group play-place-in-line
# 190302-1745 - Added disclaimers for pure-knob code
# 190310-1909 - Added mute_recordings system setting and campaign/user options
# 190311-2153 - Added indicators for lists being assigned to non-existing campaigns
# 190312-0928 - Added more hide_call_log_info options
# 190327-2311 - Added READ_ONLY settings container type
# 190329-1909 - Added AMD Log Report
# 190406-1437 - Added user override option for next_dial_my_callbacks
# 190414-0924 - Added user_admin_redirect system setting and user option
# 190530-1014 - Added list_status_modification_confirmation feature
# 190530-1715 - Added sip_event_logging system setting
# 190607-1525 - Added SIP Event Report link
# 190627-1528 - Added new options for campaign agent_screen_time_display setting
# 190628-0835 - Added copying/deleting of vicidial_url_multi records when copying/deleting campaigns/in-groups
# 190628-1511 - Added API update_cid_group_entry function
# 190705-1012 - Added call_quota_lead_ranking settings
# 190722-1602 - Added ENABLED_EXTENDED_RANGE Agent Screen Time campaign option
# 190724-1603 - Added sip_event_logging campaign actions
# 190902-0839 - Fixes for PHP 7.2
# 190930-2110 - More PHP7 fixes
# 191014-1816 - Additional PHP7 fixes
# 191015-1620 - Added user inbound call count filters
# 191101-1149 - Added 2nd script tab, voicemail message groups and fixed translation issues
# 191106-0934 - Added several multi-campaign options to the add/delete DNC number page
# 191107-1150 - Added list_info as API function option
# 191107-2356 - Added Dial Timeout Lead Container functionality
# 191111-0833 - Added LTMGAD/XAMMAD Hotkey options
# 191111-1601 - Added additional user status group setting(status_group_id)
# 191113-1751 - Added add_dnc_phone add_fpg_phone API functions
# 191114-0923 - Added enable_first_webform and recording_buttons system settings
# 191121-2256 - Extended survey audio file lengths
# 191230-1001 - Added Voicemail Message Daily Limit
# 200108-0937 - Added CID Group Type of NONE, update date for 2020
# 200115-1702 - Added Caller ID Log Report to Admin Utilities
# 200122-0921 - Added CID Group auto-rotate feature settings
# 200127-1620 - Changes to HELP content
# 200204-2336 - Added opensips_cid_name settings
# 200206-2154 - Added require_password_length system setting and display of password length in modify pages
# 200210-1628 - Added link for KHOMP Admin Tool in admin utilities
# 200310-0946 - Added AGENT_PHONE_OVERRIDE campaign option, and amd_agent_route_options
# 200315-1126 - Added a SKIP option for the CID Group auto-rotate feature
# 200318-1330 - Added a default bgcolor to the servers table on the Reports page, Issue #1203
# 200327-1715 - Translation fixes
# 200331-1148 - Added list_custom_fields API function, and more translation fixes
# 200401-1448 - Added email_agent_login_link.php feature
# 200405-1805 - Added entries_per_page system setting option, fixed phone relocate conf file load issue
# 200405-2339 - Added warnings for inactive voicemail server
# 200406-0033 - Fix for Remote Agents where user deleted
# 200406-2319 - Small changes to entries_per_page display(w/ display all), also added it for DIDs
# 200407-1030 - Added browser_call_alerts system setting
# 200409-1719 - Reorganized Inbound admin section
# 200425-0949 - Added 2nd option for agentcall_manual to disable FAST DIAL
# 200508-1024 - Added feature to Call Menus to allow copying of previous option
# 200518-0828 - Fixed issue with Carrier custom dialplan allowing comments';'
# 200528-2126 - Added three_way_record_stop_exception campaign option
# 200601-2129 - Added link for Auto Reports FTP server if using SFTP or FTPSSL
# 200609-2257 - Added NONE_ options for the campaign manual_dial_filter
# 200619-1643 - Added queuemetrics_pausereason system settings option
# 200623-1957 - Added inbound answer configuration
# 200624-1939 - Added Callbacks Export report
# 200701-1525 - Added more concurrent_transfers options
# 200708-1033 - Added List overrides for some inbound settings
# 200711-1822 - Added EVERY_NEW_ADMINCALL option for QM PAUSEREASON system setting
# 200719-1645 - Added EVERY_NEW_ALLCALL option for QM PAUSEREASON system setting
# 200814-2249 - Added International DNC scrub options
# 200815-0015 - Added another modify_leads option for users
# 200816-0912 - Removed the ability to delete the 'default' DID entry
# 200912-1649 - Added more get_call_launch PREVIEW_ options
# 200913-0820 - Added UNSELECTED options for campaign alt_number_dialing
# 200916-0922 - Added more modify_leads options for users(modify log statuses)
# 200922-0924 - Added web_loader_phone_strip & manual_dial_phone_strip system settings
# 201002-1534 - Allowed for secure sounds_web_server setting
# 201004-1045 - Added campaign pause_max_exceptions setting, also fix for issue #1235
# 201101-1056 - Added In-Group setting for No-Agent-No-Queue delay
# 201106-2324 - Fix for issue with populate_lead_source menu
# 201111-1258 - Added campaigns hopper_drop_run_trigger setting
# 201111-1616 - Fix for CID Groups permissions issue #1234
# 201113-0754 - Changed Modify DID page variable population
# 201118-1057 - Better compatibility with non-latin data input
# 201123-2300 - Added daily_call_count_limit features
# 201201-1944 - Added transfer_button_launch campaign feature
# 201214-1545 - Fixes for PHP8 compatibility
# 210102-1651 - Added SHARED agent features for outbound dialing campaigns
# 210103-0856 - Added agent_search_method override settings
# 210124-0947 - Added copy_user Non-Agent API function
# 210207-0915 - Added Shared Debug Page to admin utilities
# 210210-1601 - Added add_did Non-Agent API function
# 210211-1145 - Added Matex use information
# 210226-1545 - Added Copy Phone functionality
# 210227-1126 - Variable filter changes
# 210302-1032 - Changed Logout to auto-logout through AJAX, with redirect to Admin Home URL
# 210304-1615 - Added User modify_leads = 5 option, for READONLY
# 210305-2159 - Added Default Phone Fields, Changed CLEAR LIST to remove custom fields for removed leads
# 210306-0840 - Added new QC module with QC scorecards, Quality Control Report, Settings Compare Utility
# 210309-2207 - Added Inbound main panel sub-links, fixed System Settings modify SQL
# 210312-1239 - Added Two-Factor Authentication system, Added mobile_number to User Modify screen
# 210312-1456 - Small change to Copy User page
# 210314-0919 - Added more enhanced_disconnect_logging options in System Settings
# 210315-1730 - Added clear_form campaign option, Issue #1179
# 210315-2118 - Added new manual_dial_filter CALLBACK options, Issue #1139
# 210316-0923 - Small fix for 2FA consistency
# 210317-0819 - Added lead_all_info Non-Agent API function, Changed lead-modify page links to javascript because of Chrome
# 210317-1211 - Fixes for better consistency in password change process, Issue #1261
# 210317-1736 - Added the ability to see orphan Remote Agent entries(with no valid User account)
# 210317-2329 - Added system settings for agent_hidden_sound and added more browser_alert_sounds
# 210321-0120 - Added classAudioFile PHP library
# 210324-0954 - Added leave_3way_start_recording campaign options
# 210325-2220 - Added populate_lead_comments in-group option
# 210406-1821 - Added hopper_drop_run_trigger_all option, moved dialable_leads function to functions.php
# 210417-1027 - Added calls_waiting_vl_X campaign settings
# 210421-2227 - Added more screen labels for non-form fields
# 210425-1506 - Added calls_inqueue_count_ campaign options
# 210429-1624 - Added mohsuggest phone config option
# 210519-1747 - Fix for Copy Phone conf rebuild, Require prompt be populated on Call Menu creation and modification
# 210608-2108 - Added In-Group Drop Seconds Override Container and Inbound Manual Dial Agent Forced Ready features
# 210615-1108 - Default security fixes, CVE-2021-28854
# 210624-1243 - Fix for Copy Phone issue
# 210702-0848 - Added transfer_no_dispo campaign setting
# 210705-1037 - Added User override for campaign manual_dial_filter setting
# 210706-0128 - Added display of Call Time Holidays to the agent screen Scheduled Callbacks calendar
# 210707-0731 - Added display of phone codes and postal codes, linked from System Settings page
# 210712-1733 - Allow brackets and spaces in Filter Phone Group numbers([ ])
# 210715-1248 - Added call_limit_24hour campaign settings
# 210729-2127 - Added CID Group Failover campaign setting(cid_group_id_two)
# 210804-0712 - Fix for closing time action issue #1321
# 210812-1609 - Added 'Phone Stats' to report permissions list
# 210827-0753 - Added allowed_sip_stacks system setting and PJSIP Phone and Carrier options
# 210901-2051 - Fix for User Modify page issue
# 210907-1901 - Added new OWNERCUSTOMx handle methods for menu options
# 210911-1958 - Added populate_lead_owner in-group option
# 210920-2159 - Added batch_update_lead API function
# 211012-0934 - Added incall_tally_threshold_seconds campaign feature
# 211027-1031 - Added lead_search Non-Agent API function
# 211106-1500 - Added In-Group in_queue_nanque settings
# 211208-1646 - Added user_location to User Modify page, Added Queue Groups to Admin pages
# 211213-1619 - Fix for new phone inserts template_id issue on some MySQL setups
# 211214-1157 - Fix for Queue Groups link issue #1343
# 211215-1806 - Added some User Group settings
# 211217-0732 - Fixes for PHP8, issue #1341
# 220118-1944 - Added auto_alt_threshold option for campaigns and override option for lists
# 220120-0902 - Added download_invalid_files user option
# 220122-1659 - Added more variable filtering, updated copyright year to 2022
# 220127-2915 - Added update_alt_url Non-Agent API function
# 220212-0758 - Added pause_max_url campaign setting
# 220215-1011 - Fix for XSS multi-script security issue
# 220215-1431 - Additional XSS script text variable filtering
# 220217-1727 - Added agent_hide_hangup system and campaign settings
# 220217-2022 - Added input variable filtering
# 220218-1656 - Added allow_web_debug system setting to disable $DB output by default
# 220307-1151 - Added 'update_presets' Non-Agent API function
# 220310-1007 - Added STAGING option for campaign presets
# 220311-0808 - Added List setting for Campaign CID Group Override
# 220312-0937 - Added vicidial_dial_cid_log logging
# 220328-1420 - Disallow adding 'INCALL','QUEUE' statuses in Auto-Alt-Dial and Lead Recycling
# 220429-1111 - Code cleanup and more optional DB output for queries
#

# make sure you have added a user to the vicidial_users MySQL table with at least user_level 9 to access this page the first time

$admin_version = '2.14-854a';
$build = '220429-1111';

$STARTtime = date("U");
$SQLdate = date("Y-m-d H:i:s");
$REPORTdate = date("Y-m-d");
$EXPtestdate = date("Ymd");
$CIDdate = date("mdHis");
$dateint = date("YmdHis");
while (strlen($CIDdate) > 9) {$CIDdate = substr("$CIDdate", 1);}

$MT[0]='';
$US='_';
$active_lists=0;
$inactive_lists=0;
$modify_refresh_set=0;
$modify_footer_refresh=0;
$check_time = ($STARTtime - 86400);
$SSanswer_transfer_agent =	'8368';
$add_copy_disabled=0;

$month_old = mktime(0, 0, 0, date("m")-1, date("d"),  date("Y"));
$past_month_date = date("Y-m-d H:i:s",$month_old);
$week_old = mktime(0, 0, 0, date("m"), date("d")-7,  date("Y"));
$past_week_date = date("Y-m-d H:i:s",$week_old);

$dtmf[0]='0';				$dtmf_key[0]='0';
$dtmf[1]='1';				$dtmf_key[1]='1';
$dtmf[2]='2';				$dtmf_key[2]='2';
$dtmf[3]='3';				$dtmf_key[3]='3';
$dtmf[4]='4';				$dtmf_key[4]='4';
$dtmf[5]='5';				$dtmf_key[5]='5';
$dtmf[6]='6';				$dtmf_key[6]='6';
$dtmf[7]='7';				$dtmf_key[7]='7';
$dtmf[8]='8';				$dtmf_key[8]='8';
$dtmf[9]='9';				$dtmf_key[9]='9';
$dtmf[10]='HASH';			$dtmf_key[10]='#';
$dtmf[11]='STAR';			$dtmf_key[11]='*';
$dtmf[12]='A';				$dtmf_key[12]='A';
$dtmf[13]='B';				$dtmf_key[13]='B';
$dtmf[14]='C';				$dtmf_key[14]='C';
$dtmf[15]='D';				$dtmf_key[15]='D';
$dtmf[16]='TIMECHECK';		$dtmf_key[16]=_QXZ('TIMECHECK');
$dtmf[17]='TIMEOUT';		$dtmf_key[17]=_QXZ('TIMEOUT');
$dtmf[18]='INVALID';		$dtmf_key[18]=_QXZ('INVALID');
$dtmf[19]='INVALID_2ND';	$dtmf_key[19]=_QXZ('INVALID_2ND');
$dtmf[20]='INVALID_3RD';	$dtmf_key[20]=_QXZ('INVALID_3RD');

$stmt="SELECT selected_language,user_admin_redirect_url from vicidial_users where user='$PHP_AUTH_USER';";
if ($DB) {echo "|$stmt|\n";}
$rslt=mysql_to_mysqli($stmt, $link);
$sl_ct = mysqli_num_rows($rslt);
if ($sl_ct > 0)
	{
	$row=mysqli_fetch_row($rslt);
	$VUselected_language =		$row[0];
	$VUuser_admin_redirect_url = $row[1];
	}

if ($force_logout)
	{
	if( (strlen($PHP_AUTH_USER)>0) or (strlen($PHP_AUTH_PW)>0) )
		{
		if ($SStwo_factor_auth_hours > 0)
			{
			$stmt="UPDATE vicidial_two_factor_auth SET auth_stage='2' where user='$PHP_AUTH_USER' and auth_stage='1';";
			if ($DB) {echo "|$stmt|\n";}
			$rslt=mysql_to_mysqli($stmt, $link);
			}
		echo "<html>\n";
		echo "<head>\n";
		echo "<!-- Logout screen $PHP_SELF -->\n";
		echo "<META NAME=\"ROBOTS\" CONTENT=\"NONE\">\n";
		echo "<META NAME=\"COPYRIGHT\" CONTENT=\"&copy; 2022 ViciDial Group\">\n";
		echo "<META NAME=\"AUTHOR\" CONTENT=\"ViciDial Group\">\n";
		?>
		<script type="text/javascript">

		function ajax_logout_now() 
			{
			var xmlhttp=false;
			/*@cc_on @*/
			/*@if (@_jscript_version >= 5)
			// JScript gives us Conditional compilation, we can cope with old IE versions.
			// and security blocked creation of the objects.
			 try {
			  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
			 } catch (e) {
			  try {
			   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			  } catch (E) {
			   xmlhttp = false;
			  }
			 }
			@end @*/
			if (!xmlhttp && typeof XMLHttpRequest!='undefined')
				{
				xmlhttp = new XMLHttpRequest();
				}
			if (xmlhttp) 
				{ 
				logout_query = "ADD=999999";
				xmlhttp.open('POST', 'admin.php',false,'AJAXviciLOGOUT','1234'); 
				xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
				xmlhttp.send(logout_query); 
				xmlhttp.onreadystatechange = function()
					{ 
					if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
						{
						var check_logout = null;
						check_logout = xmlhttp.responseText;
						alert(xmlhttp.responseText + "\n|" + check_DS_array[1] + "\n|" + check_DS_array[2] + "|");
						}
					}
				delete xmlhttp;
				}
			window.document.location='<?php echo $SSadmin_home_url ?>';
			}
		</script>
	<?php
		echo "</head>\n";
		echo "<BODY BGCOLOR=white marginheight=0 marginwidth=0 leftmargin=0 topmargin=0 onload=\"ajax_logout_now();\">\n";

	#	Header("WWW-Authenticate: Basic realm=\"CONTACT-CENTER-ADMIN\"");
	#	Header("HTTP/1.0 401 Unauthorized");
		}
	echo _QXZ("You have now logged out. Thank you")."\n<BR>"._QXZ("To log back in").", <a href=\"$PHP_SELF\">"._QXZ("click here")."</a>";
	exit;
	}
#############################################
##### START SYSTEM_SETTINGS LOOKUP #####
$stmt = "SELECT use_non_latin,auto_dial_limit,user_territories_active,allow_custom_dialplan,callcard_enabled,admin_modify_refresh,nocache_admin,webroot_writable,allow_emails,manual_dial_validation FROM system_settings;";
if ($DB) {echo "$stmt\n";}
$rslt=mysql_to_mysqli($stmt, $link);
$qm_conf_ct = mysqli_num_rows($rslt);
if ($qm_conf_ct > 0)
	{
	$row=mysqli_fetch_row($rslt);
	$non_latin =					$row[0];
	$SSauto_dial_limit =			$row[1];
	$SSuser_territories_active =	$row[2];
	$SSallow_custom_dialplan =		$row[3];
	$SScallcard_enabled =			$row[4];
	$SSadmin_modify_refresh =		$row[5];
	$SSnocache_admin =				$row[6];
	$SSwebroot_writable =			$row[7];
	$SSemail_enabled =				$row[8];
	$SSmanual_dial_validation =		$row[9];

	# slightly increase limit value, because PHP somehow thinks 2.8 > 2.8
	$SSauto_dial_limit = ($SSauto_dial_limit + 0.001);
	}
##### END SETTINGS LOOKUP #####
###########################################

$date = date("r");
$ip = getenv("REMOTE_ADDR");
$browser = getenv("HTTP_USER_AGENT");

$user_auth=0;
$auth=0;
$reports_auth=0;
$qc_auth=0;
$auth_message = user_authorization($PHP_AUTH_USER,$PHP_AUTH_PW,'QC',1,0);
if ($auth_message == 'GOOD')
	{$user_auth=1;}

if ($user_auth > 0)
	{
	$stmt="SELECT count(*) from vicidial_users where user='$PHP_AUTH_USER' and user_level > 7 and api_only_user != '1';";
	if ($DB) {echo "|$stmt|\n";}
	$rslt=mysql_to_mysqli($stmt, $link);
	$row=mysqli_fetch_row($rslt);
	$auth=$row[0];

	$stmt="SELECT count(*) from vicidial_users where user='$PHP_AUTH_USER' and user_level > 6 and view_reports='1' and api_only_user != '1';";
	if ($DB) {echo "|$stmt|\n";}
	$rslt=mysql_to_mysqli($stmt, $link);
	$row=mysqli_fetch_row($rslt);
	$reports_auth=$row[0];

	$stmt="SELECT count(*) from vicidial_users where user='$PHP_AUTH_USER' and user_level > 1 and qc_enabled='1' and api_only_user != '1';";
	if ($DB) {echo "|$stmt|\n";}
	$rslt=mysql_to_mysqli($stmt, $link);
	$row=mysqli_fetch_row($rslt);
	$qc_auth=$row[0];

	$reports_only_user=0;
	$qc_only_user=0;
	if ( ($reports_auth > 0) and ($auth < 1) )
		{
		$ADD=999999;
		$reports_only_user=1;
		}
	if ( ($qc_auth > 0) and ($reports_auth < 1) and ($auth < 1) )
		{
		if ( ($ADD != '881') and ($ADD != '100000000000000') )
			{
            $ADD=100000000000000;
			}
		$qc_only_user=1;
		}
	if ( ($qc_auth < 1) and ($reports_auth < 1) and ($auth < 1) )
		{
		$VDdisplayMESSAGE = _QXZ("You do not have permission to be here");
		Header ("Content-type: text/html; charset=utf-8");
		echo "$VDdisplayMESSAGE: |$PHP_AUTH_USER|$auth_message|\n";
		exit;
		}
	if ( (strlen($VUuser_admin_redirect_url) > 5) and ($SSuser_admin_redirect > 0) )
		{
		Header('Location: '.$VUuser_admin_redirect_url);
		echo"<TITLE>"._QXZ("Admin Redirect")."</TITLE>\n";
		echo"<META HTTP-EQUIV=\"Content-Type\" CONTENT=\"text/html; charset=iso-8859-1\">\n";
		echo"<META HTTP-EQUIV=Refresh CONTENT=\"0; URL=$VUuser_admin_redirect_url\">\n";
		echo"</HEAD>\n";
		echo"<BODY BGCOLOR=#FFFFFF marginheight=0 marginwidth=0 leftmargin=0 topmargin=0>\n";
		echo"<a href=\"$VUuser_admin_redirect_url\">"._QXZ("click here to continue").". . .</a>\n";
		exit;
		}
	}
else
	{
	$VDdisplayMESSAGE = _QXZ("Login incorrect, please try again");
	if ($auth_message == 'LOCK')
		{
		$VDdisplayMESSAGE = _QXZ("Too many login attempts, try again in 15 minutes");
		Header ("Content-type: text/html; charset=utf-8");
		echo "$VDdisplayMESSAGE: |$PHP_AUTH_USER|$auth_message|\n";
		exit;
		}
	if ($auth_message == 'IPBLOCK')
		{
		$VDdisplayMESSAGE = _QXZ("Your IP Address is not allowed") . ": $ip";
		Header ("Content-type: text/html; charset=utf-8");
		echo "$VDdisplayMESSAGE: |$PHP_AUTH_USER|$auth_message|\n";
		exit;
		}
	Header("WWW-Authenticate: Basic realm=\"CONTACT-CENTER-ADMIN\"");
	Header("HTTP/1.0 401 Unauthorized");
	echo "$VDdisplayMESSAGE: |$PHP_AUTH_USER|$PHP_AUTH_PW|$auth_message|\n";
	exit;
	}

$admin_lists_custom = 'admin_lists_custom.php';
$x_ra_carrier = 0;
if (preg_match("/x_ra_carrier/",$SSactive_modules))
	{$x_ra_carrier = 1;}

##############################################
# Include QC Agents with no other permission #
##############################################
//Get QC User permissions
$stmt="SELECT qc_enabled,qc_user_level,qc_pass,qc_finish,qc_commit from vicidial_users where user='$PHP_AUTH_USER' and user_level > 1 and active='Y' and qc_enabled='1';";
if ($DB) {echo "|$stmt|\n";}
$rslt=mysql_to_mysqli($stmt, $link);
$row=mysqli_fetch_row($rslt);
$qc_auth=$row[0];
//Not "qc_" as it will interfere with ADD=4A storage of modified user.
if ($qc_auth=='1') 
	{
    $qcuser_level=$row[1];
    $qcpass=$row[2];
    $qcfinish=$row[3];
    $qccommit=$row[4];
	}
//Modify menuing to allow qc users into the system (if they have no permission otherwise)
//Copied Reports-Only user setup for QC-Only user (Poundteam QC setup)
$qc_only_user=0;
if ( ($qc_auth > 0) and ($auth < 1) )
        {
        if ($ADD != '881')
			{
			$ADD=100000000000000;
		   }
        $qc_only_user=1;
        }

$stmt="SELECT user_id,user,pass,full_name,user_level,user_group,phone_login,phone_pass,delete_users,delete_user_groups,delete_lists,delete_campaigns,delete_ingroups,delete_remote_agents,load_leads,campaign_detail,ast_admin_access,ast_delete_phones,delete_scripts,modify_leads,hotkeys_active,change_agent_campaign,agent_choose_ingroups,closer_campaigns,scheduled_callbacks,agentonly_callbacks,agentcall_manual,vicidial_recording,vicidial_transfers,delete_filters,alter_agent_interface_options,closer_default_blended,delete_call_times,modify_call_times,modify_users,modify_campaigns,modify_lists,modify_scripts,modify_filters,modify_ingroups,modify_usergroups,modify_remoteagents,modify_servers,view_reports,vicidial_recording_override,alter_custdata_override,qc_enabled,qc_user_level,qc_pass,qc_finish,qc_commit,add_timeclock_log,modify_timeclock_log,delete_timeclock_log,alter_custphone_override,vdc_agent_api_access,modify_inbound_dids,delete_inbound_dids,active,alert_enabled,download_lists,agent_shift_enforcement_override,manager_shift_enforcement_override,shift_override_flag,export_reports,delete_from_dnc,email,user_code,territory,allow_alerts,callcard_admin,force_change_password,modify_shifts,modify_phones,modify_carriers,modify_labels,modify_statuses,modify_voicemail,modify_audiostore,modify_moh,modify_tts,modify_contacts,modify_same_user_level,alter_admin_interface_options,modify_custom_dialplans,modify_languages,selected_language,user_choose_language,modify_colors,api_only_user,modify_auto_reports,modify_ip_lists,export_gdpr_leads,mobile_number,two_factor_override from vicidial_users where user='$PHP_AUTH_USER';";
if ($DB) {echo "|$stmt|\n";}
$rslt=mysql_to_mysqli($stmt, $link);
$row=mysqli_fetch_row($rslt);
$LOGfull_name				=$row[3];
$LOGuser_level				=$row[4];
$LOGuser_group				=$row[5];
$LOGdelete_users			=$row[8];
$LOGdelete_user_groups		=$row[9];
$LOGdelete_lists			=$row[10];
$LOGdelete_campaigns		=$row[11];
$LOGdelete_ingroups			=$row[12];
$LOGdelete_remote_agents	=$row[13];
$LOGload_leads				=$row[14];
$LOGcampaign_detail			=$row[15];
$LOGast_admin_access		=$row[16];
$LOGast_delete_phones		=$row[17];
$LOGdelete_scripts			=$row[18];
$LOGmodify_leads			=$row[19];
$LOGdelete_filters			=$row[29];
$LOGalter_agent_interface	=$row[30];
$LOGdelete_call_times		=$row[32];
$LOGmodify_call_times		=$row[33];
$LOGmodify_users			=$row[34];
$LOGmodify_campaigns		=$row[35];
$LOGmodify_lists			=$row[36];
$LOGmodify_scripts			=$row[37];
$LOGmodify_filters			=$row[38];
$LOGmodify_ingroups			=$row[39];
$LOGmodify_usergroups		=$row[40];
$LOGmodify_remoteagents		=$row[41];
$LOGmodify_servers			=$row[42];
$LOGview_reports			=$row[43];
$LOGmodify_dids				=$row[56];
$LOGdelete_dids				=$row[57];
$LOGmanager_shift_enforcement_override=$row[61];
$LOGexport_reports			=$row[64];
$LOGdelete_from_dnc			=$row[65];
$LOGemail					=$row[66];
$LOGcallcard_admin			=$row[70];
$LOGforce_change_password	=$row[71];
$LOGmodify_shifts			=$row[72];
$LOGmodify_phones			=$row[73];
$LOGmodify_carriers			=$row[74];
$LOGmodify_labels			=$row[75];
$LOGmodify_statuses			=$row[76];
$LOGmodify_voicemail		=$row[77];
$LOGmodify_audiostore		=$row[78];
$LOGmodify_moh				=$row[79];
$LOGmodify_tts				=$row[80];
$LOGmodify_contacts			=$row[81];
$LOGmodify_same_user_level	=$row[82];
$LOGalter_admin_interface	=$row[83];
$LOGmodify_custom_dialplans =$row[84];
$LOGmodify_languages		=$row[85];
$LOGselected_language		=$row[86];
$LOGuser_choose_language	=$row[87];
$LOGmodify_colors			=$row[88];
$LOGapi_only_user			=$row[89];
$LOGmodify_auto_reports		=$row[90];
$LOGmodify_ip_lists			=$row[91];
$LOGexport_gdpr_leads		=$row[92];
$LOGmobile_number			=$row[93];
$LOGtwo_factor_override		=$row[94];

$stmt="SELECT allowed_campaigns,allowed_reports,admin_viewable_groups,admin_viewable_call_times,qc_allowed_campaigns,qc_allowed_inbound_groups,reports_header_override,admin_home_url,allowed_queue_groups from vicidial_user_groups where user_group='$LOGuser_group';";
if ($DB) {echo "|$stmt|\n";}
$rslt=mysql_to_mysqli($stmt, $link);
$row=mysqli_fetch_row($rslt);
$LOGallowed_campaigns =			$row[0];
$LOGallowed_reports =			$row[1];
$LOGadmin_viewable_groups =		$row[2];
$LOGadmin_viewable_call_times =	$row[3];
$LOGqc_allowed_campaigns =		$row[4];
$LOGqc_allowed_inbound_groups =	$row[5];
$LOGreports_header_override	=	$row[6];
$LOGadmin_home_url =			$row[7];
$LOGallowed_queue_groups	=	$row[8];

if (strlen($LOGadmin_home_url) > 5) {$SSadmin_home_url = $LOGadmin_home_url;}
$LOGallowed_campaignsSQL='';
$notLOGallowed_campaignsSQL = "and campaign_id IN('')";
$campLOGallowed_campaignsSQL='';
$whereLOGallowed_campaignsSQL='';
if ( (!preg_match('/\-ALL/i', $LOGallowed_campaigns)) )
	{
	$rawLOGallowed_campaignsSQL = preg_replace("/ -/",'',$LOGallowed_campaigns);
	$rawLOGallowed_campaignsSQL = preg_replace("/ /","','",$rawLOGallowed_campaignsSQL);
	$LOGallowed_campaignsSQL = "and campaign_id IN('$rawLOGallowed_campaignsSQL')";
	$notLOGallowed_campaignsSQL = "and campaign_id NOT IN('$rawLOGallowed_campaignsSQL')";
	$campLOGallowed_campaignsSQL = "and camp.campaign_id IN('$rawLOGallowed_campaignsSQL')";
	$whereLOGallowed_campaignsSQL = "where campaign_id IN('$rawLOGallowed_campaignsSQL')";
	}
$regexLOGallowed_campaigns = " $LOGallowed_campaigns ";

if (preg_match("/DRA/",$SShosted_settings))
	{$LOGmodify_remoteagents=0;}

$admin_viewable_groupsALL=0;
$LOGadmin_viewable_groupsSQL='';
$whereLOGadmin_viewable_groupsSQL='';
$valLOGadmin_viewable_groupsSQL='';
$vmLOGadmin_viewable_groupsSQL='';
if ( (!preg_match('/\-\-ALL\-\-/i',$LOGadmin_viewable_groups)) and (strlen($LOGadmin_viewable_groups) > 3) )
	{
	$rawLOGadmin_viewable_groupsSQL = preg_replace("/ -/",'',$LOGadmin_viewable_groups);
	$rawLOGadmin_viewable_groupsSQL = preg_replace("/ /","','",$rawLOGadmin_viewable_groupsSQL);
	$LOGadmin_viewable_groupsSQL = "and user_group IN('---ALL---','$rawLOGadmin_viewable_groupsSQL')";
	$whereLOGadmin_viewable_groupsSQL = "where user_group IN('---ALL---','$rawLOGadmin_viewable_groupsSQL')";
	$valLOGadmin_viewable_groupsSQL = "and val.user_group IN('---ALL---','$rawLOGadmin_viewable_groupsSQL')";
	$vmLOGadmin_viewable_groupsSQL = "and vm.user_group IN('---ALL---','$rawLOGadmin_viewable_groupsSQL')";
	}
else 
	{$admin_viewable_groupsALL=1;}
$regexLOGadmin_viewable_groups = " $LOGadmin_viewable_groups ";

$LOGadmin_viewable_call_timesSQL='';
$whereLOGadmin_viewable_call_timesSQL='';
if ( (!preg_match('/\-\-ALL\-\-/i', $LOGadmin_viewable_call_times)) and (strlen($LOGadmin_viewable_call_times) > 3) )
	{
	$rawLOGadmin_viewable_call_timesSQL = preg_replace("/ -/",'',$LOGadmin_viewable_call_times);
	$rawLOGadmin_viewable_call_timesSQL = preg_replace("/ /","','",$rawLOGadmin_viewable_call_timesSQL);
	$LOGadmin_viewable_call_timesSQL = "and call_time_id IN('---ALL---','$rawLOGadmin_viewable_call_timesSQL')";
	$whereLOGadmin_viewable_call_timesSQL = "where call_time_id IN('---ALL---','$rawLOGadmin_viewable_call_timesSQL')";
	}
$regexLOGadmin_viewable_call_times = " $LOGadmin_viewable_call_times ";

$UUgroups_list='';
if ($admin_viewable_groupsALL > 0)
	{$UUgroups_list .= "<option value=\"---ALL---\">"._QXZ("All Admin User Groups")."</option>\n";}
$stmt="SELECT user_group,group_name from vicidial_user_groups $whereLOGadmin_viewable_groupsSQL order by user_group;";
if ($DB) {echo "|$stmt|\n";}
$rslt=mysql_to_mysqli($stmt, $link);
$UUgroups_to_print = mysqli_num_rows($rslt);
$o=0;
while ($UUgroups_to_print > $o) 
	{
	$rowx=mysqli_fetch_row($rslt);
	$UUgroups_list .= "<option value=\"$rowx[0]\">$rowx[0] - $rowx[1]</option>\n";
	$o++;
	}

$LOGqc_allowed_campaignsSQL='';
$whereLOGqc_allowed_campaignsSQL='';
if ( (!preg_match('/\-ALL/i', $LOGqc_allowed_campaigns)) )
	{
	$rawLOGqc_allowed_campaignsSQL = preg_replace("/ -/",'',$LOGqc_allowed_campaigns);
	$rawLOGqc_allowed_campaignsSQL = preg_replace("/ /","','",$rawLOGqc_allowed_campaignsSQL);
	$LOGqc_allowed_campaignsSQL = "and campaign_id IN('$rawLOGqc_allowed_campaignsSQL')";
	$whereLOGqc_allowed_campaignsSQL = "where campaign_id IN('$rawLOGqc_allowed_campaignsSQL')";
	}

$LOGqc_allowed_inbound_groupsSQL='';
$whereLOGqc_allowed_inbound_groupsSQL='';
if ( (!preg_match('/\-ALL/i', $LOGqc_allowed_inbound_groups)) )
	{
	$rawLOGqc_allowed_inbound_groupsSQL = preg_replace("/ -/",'',$LOGqc_allowed_inbound_groups);
	$rawLOGqc_allowed_inbound_groupsSQL = preg_replace("/ /","','",$rawLOGqc_allowed_inbound_groupsSQL);
	$LOGqc_allowed_inbound_groupsSQL = "and group_id IN('$rawLOGqc_allowed_inbound_groupsSQL')";
	$whereLOGqc_allowed_inbound_groupsSQL = "where group_id IN('$rawLOGqc_allowed_inbound_groupsSQL')";
	}


$first_login_link=0;
$VALID_2FA=1;

# check for 2FA being active, and if so, see if there is a non-expired 2FA auth
if ( ($SStwo_factor_auth_hours > 0) and ($SStwo_factor_container != '') and ($SStwo_factor_container != '---DISABLED---') )
	{
	$stmt="SELECT count(*) from vicidial_two_factor_auth where user='$PHP_AUTH_USER' and auth_stage='1' and auth_exp_date > NOW();";
	if ($DB) {echo "$stmt\n";}
	$rslt=mysql_to_mysqli($stmt, $link);
	$auth_check_to_print = mysqli_num_rows($rslt);
	if ($auth_check_to_print < 1)
		{$VALID_2FA=0;}
	else
		{
		$row=mysqli_fetch_row($rslt);
		$VALID_2FA = $row[0];
		}
	}
if ($VALID_2FA < 1)
	{
	$ADD=99999701;
	$reports_only_user=1;
	}

if ($LOGforce_change_password=='Y')
	{
	$ADD=999997;
	$reports_only_user=1;
	}
if ($SSfirst_login_trigger=='Y')
	{
	if ($ADD==999996)
		{$reports_only_user=1;}
	else
		{
		$ADD=999995;
		$first_login_link=1;
		}
	}
if ($ADD==999995)
	{
	$reports_only_user=1;
	}

if (($LOGuser_level < 9) and ($SSlevel_8_disable_add > 0))
	{$add_copy_disabled++;}


$SSmenu_background='015B91';
$SSframe_background='D9E6FE';
$SSstd_row1_background='9BB9FB';
$SSstd_row2_background='B9CBFD';
$SSstd_row3_background='8EBCFD';
$SSstd_row4_background='B6D3FC';
$SSstd_row5_background='A3C3D6';
$SSalt_row1_background='BDFFBD';
$SSalt_row2_background='99FF99';
$SSalt_row3_background='CCFFCC';
$SSbutton_color='EFEFEF';
$SSweb_logo='default_old';

if ($SSadmin_screen_colors != 'default')
	{
	$stmt = "SELECT menu_background,frame_background,std_row1_background,std_row2_background,std_row3_background,std_row4_background,std_row5_background,alt_row1_background,alt_row2_background,alt_row3_background,web_logo,button_color FROM vicidial_screen_colors where colors_id='$SSadmin_screen_colors';";
	if ($DB) {echo "$stmt\n";}
	$rslt=mysql_to_mysqli($stmt, $link);
	$colors_ct = mysqli_num_rows($rslt);
	if ($colors_ct > 0)
		{
		$row=mysqli_fetch_row($rslt);
		$SSmenu_background =		$row[0];
		$SSframe_background =		$row[1];
		$SSstd_row1_background =	$row[2];
		$SSstd_row2_background =	$row[3];
		$SSstd_row3_background =	$row[4];
		$SSstd_row4_background =	$row[5];
		$SSstd_row5_background =	$row[6];
		$SSalt_row1_background =	$row[7];
		$SSalt_row2_background =	$row[8];
		$SSalt_row3_background =	$row[9];
		$SSweb_logo =				$row[10];
		$SSbutton_color =			$row[11];
		}
	}

$Mhead_color =	$SSstd_row5_background;
$Mmain_bgcolor = $SSmenu_background;
$Mhead_color =	$SSstd_row5_background;

if ($download_max_system_stats_metric_name) 
	{
	if (!$query_date) {$query_date=date("Y-m-d", time()-(29*86400));}
	if (!$end_date) 
		{
		$end_date=date("Y-m-d", time());
		}
	else if (strtotime($end_date)>strtotime(date("Y-m-d"))) 
		{
		$end_date=date("Y-m-d");
		}
	if ($query_date>$end_date) {$query_date=$end_date;}

	$num_graph_days = ceil(abs(strtotime($end_date) - strtotime($query_date)) / 86400)+1;
	$CSV_text="";

	if ($download_max_system_stats_metric_name=="ALL" || $download_max_system_stats_metric_name=="total call count in and out") 
		{
		download_max_system_stats($campaign_id,$num_graph_days,'system','total_calls','total call count in and out',$end_date);
		}
	if ($download_max_system_stats_metric_name=="ALL" || $download_max_system_stats_metric_name=="total inbound call count") 
		{
		download_max_system_stats($campaign_id,$num_graph_days,'system','total_calls_inbound_all','total inbound call count',$end_date);
		}
	if ($download_max_system_stats_metric_name=="ALL" || $download_max_system_stats_metric_name=="total outbound call count") 
		{
		download_max_system_stats($campaign_id,$num_graph_days,'system','total_calls_outbound_all','total outbound call count',$end_date);
		}
	if ($download_max_system_stats_metric_name=="ALL" || $download_max_system_stats_metric_name=="most concurrent calls in and out") 
		{
		download_max_system_stats($campaign_id,$num_graph_days,'system','(max_inbound + max_outbound)','most concurrent calls in and out',$end_date);
		}
	if ($download_max_system_stats_metric_name=="ALL" || $download_max_system_stats_metric_name=="most concurrent calls inbound total") 
		{
		download_max_system_stats($campaign_id,$num_graph_days,'system','max_inbound','most concurrent calls inbound total',$end_date);
		}
	if ($download_max_system_stats_metric_name=="ALL" || $download_max_system_stats_metric_name=="most concurrent calls outbound total") 
		{
		download_max_system_stats($campaign_id,$num_graph_days,'system','max_outbound','most concurrent calls outbound total',$end_date);
		}
	if ($download_max_system_stats_metric_name=="ALL" || $download_max_system_stats_metric_name=="most concurrent agents") 
		{
		download_max_system_stats($campaign_id,$num_graph_days,'system','max_agents','most concurrent agents',$end_date);
		}

	$FILE_TIME = date("Ymd-His");
	$CSVfilename = "MAX_SYSTEM_STATS_$US$FILE_TIME.csv";
	$CSV_text=preg_replace('/ +\"/', '"', $CSV_text);
	$CSV_text=preg_replace('/\" +/', '"', $CSV_text);
	header('Content-type: application/octet-stream');

	header("Content-Disposition: attachment; filename=\"$CSVfilename\"");
	header('Expires: 0');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	header('Pragma: public');
	ob_clean();
	flush();

	echo "$CSV_text";

	exit;
	}


######################################################################################################
######################################################################################################
#######   Header settings
######################################################################################################
######################################################################################################


header ("Content-type: text/html; charset=utf-8");
if ($SSnocache_admin=='1')
	{
	header ("Cache-Control: no-cache, must-revalidate");  // HTTP/1.1
	header ("Pragma: no-cache");                          // HTTP/1.0
	}
echo "<html>\n";
echo "<head>\n";
echo "<!-- VERSION: $admin_version   BUILD: $build   ADD: $ADD   PHP_SELF: $PHP_SELF-->\n";
echo "<META NAME=\"ROBOTS\" CONTENT=\"NONE\">\n";
echo "<META NAME=\"COPYRIGHT\" CONTENT=\"&copy; 2022 ViciDial Group\">\n";
echo "<META NAME=\"AUTHOR\" CONTENT=\"ViciDial Group\">\n";
echo "<script language=\"JavaScript\" src=\"calendar_db.js\"></script>\n";
echo "<script language=\"JavaScript\" src=\"help.js\"></script>\n";

/* scripts plantillado nuevo */
  /* Google Font: Source Sans Pro*/
echo "<link rel=\"stylesheet\" href=\"https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback\">\n";
  /* Font Awesome*/
echo "<link rel=\"stylesheet\" href=\"plugins/fontawesome-free/css/all.min.css\">\n";
  /* Ionicons*/
echo "<link rel=\"stylesheet\" href=\"https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css\">\n";
  /* Theme style*/
echo "<link rel=\"stylesheet\" href=\"dist/css/adminlte.min.css\">\n";

/* jQuery */
echo "<script language=\"JavaScript\" src=\"plugins/jquery/jquery.min.js\"></script>\n";
/* jQuery UI 1.11.4 */
echo "<script language=\"JavaScript\" src=\"plugins/jquery-ui/jquery-ui.min.js\"></script>\n";
/* Resolve conflict in jQuery UI tooltip with Bootstrap tooltip */
/* Bootstrap 4 */
echo "<script language=\"JavaScript\" src=\"plugins/bootstrap/js/bootstrap.bundle.min.js\"></script>\n";
/* AdminLTE App */
echo "<script language=\"JavaScript\" src=\"dist/js/adminlte.js\"></script>\n";

/* fin scripts plantillado nuevo */

echo "<div id='HelpDisplayDiv' class='help_info' style='display:none;'></div>";

echo "<link rel=\"stylesheet\" href=\"calendar.css\">\n";
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"vicidial_stylesheet.php\">\n";

if ($SSnocache_admin=='1')
	{
	echo "<META HTTP-EQUIV=\"Pragma\" CONTENT=\"no-cache\">\n";
	echo "<META HTTP-EQUIV=\"Expires\" CONTENT=\"-1\">\n";
	echo "<META HTTP-EQUIV=\"CACHE-CONTROL\" CONTENT=\"NO-CACHE\">\n";
	}
if ( ($SSadmin_modify_refresh > 1) and (preg_match("/^3/",$ADD)) )
	{
	$modify_refresh_set=1;
	if (preg_match("/^3/",$ADD)) {$modify_url = "$PHP_SELF?$QUERY_STRING";}
	echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"$SSadmin_modify_refresh;URL=$modify_url\">\n";
	}
echo "<META HTTP-EQUIV=\"Content-Type\" CONTENT=\"text/html; charset=utf-8\">\n";
echo "<title>"._QXZ("ADMINISTRATION").": ";

### set the default screen to the user list
if ( (!isset($ADD)) or (strlen($ADD)<1) )   {$ADD="999990";}
if ($ADD=='0') {$ADD="999990";}

### set the sections and headers

if ($ADD=="1")			{$hh='users';		$sh='new';	echo _QXZ("Add New User");}
if ($ADD=="1A")			{$hh='users';		$sh='copy';	echo _QXZ("Copy User");}
if ($ADD==11)			{$hh='campaigns';	$sh='basic';	echo _QXZ("Add New Campaign");}
if ($ADD==12)			{$hh='campaigns';	$sh='basic';	echo _QXZ("Copy Campaign");}
if ($ADD==111)			{$hh='lists';		$sh='new';	echo _QXZ("Add New List");}
if ($ADD==121)			{$hh='lists';		$sh='dnc';	echo _QXZ("Add New DNC");}
if ($ADD==131)			{$hh='lists';		$sh='droplist';	echo _QXZ("Add New Drop List");}
if ($ADD==171)			{$hh='ingroups';	$sh='addFPG';	echo _QXZ("Filter Phone Group Numbers");}
if ($ADD==1111)			{$hh='ingroups';	$sh='newIG';	echo _QXZ("Add New In-Group");}
if ($ADD==1211)			{$hh='ingroups';	$sh='copyIG';	echo _QXZ("Copy In-Group");}
if ($ADD==1311)			{$hh='ingroups';	$sh='newDID';	echo _QXZ("Add New DID");}
if ($ADD==1411)			{$hh='ingroups';	$sh='copyDID';	echo _QXZ("Copy DID");}
if ($ADD==1511)			{$hh='ingroups';	$sh='newCM';	echo _QXZ("Add Call Menu");}
if ($ADD==1611)			{$hh='ingroups';	$sh='copyCM';	echo _QXZ("Copy Call Menu");}
if ($ADD==1711)			{$hh='ingroups';	$sh='newFPG';	echo _QXZ("Add Filter Phone Group");}
if ($ADD==1811)			{$hh='ingroups';	$sh='newEG';	echo _QXZ("Add New EMAIL In-Group");}
if ($ADD==18111)		{$hh='ingroups';	$sh='newCG';	echo _QXZ("Add New CHAT In-Group");}
if ($ADD==1911)			{$hh='ingroups';	$sh='copyEG';	echo _QXZ("Copy EMAIL In-Group");}
if ($ADD==19111)		{$hh='ingroups';	$sh='copyCG';	echo _QXZ("Copy CHAT In-Group");}
if ($ADD==11111)		{$hh='remoteagent';	$sh='new';	echo _QXZ("Add New Remote Agents");}
if ($ADD==12111)		{$hh='remoteagent';	$sh='newEG';	echo _QXZ("Add Extension Group");}
if ($ADD==111111)		{$hh='usergroups';	$sh='new';	echo _QXZ("Add New Users Group");}
if ($ADD==1111111)		{$hh='scripts';	$sh='new';		echo _QXZ("Add New Script");}
if ($ADD==11111111)		{$hh='filters';	$sh='new';		echo _QXZ("Add New Filter");}
if ($ADD==111111111)	{$hh='admin';	$sh='times';	echo _QXZ("Add New Call Time");}
if ($ADD==131111111)	{$hh='admin';	$sh='shifts';	echo _QXZ("Add New Shift");}
if ($ADD==1111111111)	{$hh='admin';	$sh='times';	echo _QXZ("Add New State Call Time");}
if ($ADD==1211111111)	{$hh='admin';	$sh='times';	echo _QXZ("Add Holiday");}
if ($ADD==11111111111)	{$hh='admin';	$sh='phones';	echo _QXZ("ADD NEW PHONE");}
if ($ADD==12222222222)	{$hh='admin';	$sh='phones';	echo _QXZ("COPY NEW PHONE");}
if ($ADD==12111111111)	{$hh='admin';	$sh='phones';	echo _QXZ("ADD NEW PHONE ALIAS");}
if ($ADD==13111111111)	{$hh='admin';	$sh='phones';	echo _QXZ("ADD NEW GROUP ALIAS");}
if ($ADD==111111111111)	{$hh='admin';	$sh='server';	echo _QXZ("ADD NEW SERVER");}
if ($ADD==131111111111)	{$hh='admin';	$sh='templates';	echo _QXZ("ADD NEW CONF TEMPLATE");}
if ($ADD==141111111111)	{$hh='admin';	$sh='carriers';	echo _QXZ("ADD NEW CARRIER");}
if ($ADD==140111111111)	{$hh='admin';	$sh='carriers';	echo _QXZ("ADD COPIED CARRIER");}
if ($ADD==151111111111)	{$hh='admin';	$sh='tts';	echo _QXZ("ADD NEW TTS ENTRY");}
if ($ADD==161111111111)	{$hh='admin';	$sh='moh';	echo _QXZ("ADD NEW MUSIC ON HOLD ENTRY");}
if ($ADD==171111111111)	{$hh='admin';	$sh='vm';	echo _QXZ("ADD NEW VOICEMAIL BOX");}
if ($ADD==181111111111)	{$hh='admin';	$sh='label';	echo _QXZ("ADD NEW SCREEN LABEL");}
if ($ADD==182111111111)	{$hh='admin';	$sh='colors';	echo _QXZ("ADD NEW SCREEN COLORS");}
if ($ADD==191111111111)	{$hh='admin';	$sh='cts';	echo _QXZ("ADD NEW CONTACT");}
if ($ADD==192111111111)	{$hh='admin';	$sh='sc';	echo _QXZ("ADD SETTINGS CONTAINER");}
if ($ADD==193111111111)	{$hh='admin';	$sh='sg';	echo _QXZ("ADD STATUS GROUP");}
if ($ADD==194111111111)	{$hh='admin';	$sh='ar';	echo _QXZ("ADD AUTOMATED REPORT");}
if ($ADD==195111111111)	{$hh='admin';	$sh='il';	echo _QXZ("ADD IP LIST");}
if ($ADD==196111111111)	{$hh='admin';	$sh='cg';	echo _QXZ("ADD CID GROUP");}
if ($ADD==197111111111)	{$hh='admin';	$sh='vmmg';	echo _QXZ("ADD VM MESSAGE GROUP");}
if ($ADD==198111111111)	{$hh='admin';	$sh='qg';	echo _QXZ("ADD QUEUE GROUP");}
if ($ADD==1111111111111)	{$hh='admin';	$sh='conference';	echo _QXZ("ADD NEW CONFERENCE");}
if ($ADD==11111111111111)	{$hh='admin';	$sh='conference';	echo _QXZ("ADD NEW AGENT CONFERENCE");}
if ($ADD=='2')			{$hh='users';		$sh='new';	echo _QXZ("New User Addition");}
if ($ADD=='2A')			{$hh='users';		$sh='copy';	echo _QXZ("New Copied User Addition");}
if ($ADD==20)			{$hh='campaigns';	$sh='basic';	echo _QXZ("New Copied Campaign Addition");}
if ($ADD==21)			{$hh='campaigns';	$sh='basic';	echo _QXZ("New Campaign Addition");}
if ($ADD==22)			{$hh='campaigns';	$sh='status';	echo _QXZ("New Campaign Status Addition");}
if ($ADD==23)			{$hh='campaigns';	$sh='hotkey';	echo _QXZ("New Campaign HotKey Addition");}
if ($ADD==25)			{$hh='campaigns';	$sh='recycle';	echo _QXZ("New Campaign Lead Recycle Addition");}
if ($ADD==26)			{$hh='campaigns';	$sh='autoalt';	echo _QXZ("New Auto Alt Dial Status");}
if ($ADD==27)			{$hh='campaigns';	$sh='pause';	echo _QXZ("New Agent Pause Code");}
if ($ADD==28)			{$hh='campaigns';	$sh='dialstat';	echo _QXZ("Campaign Dial Status Added");}
if ($ADD==29)			{$hh='campaigns';	$sh='listmix';	echo _QXZ("Campaign List Mix Added");}
if ($ADD==201)			{$hh='campaigns';	$sh='preset';	echo _QXZ("Campaign Preset Added");}
if ($ADD==202)			{$hh='campaigns';	$sh='accid';	echo _QXZ("Campaign Areacode CID Modify");}
if ($ADD==211)			{$hh='lists';		$sh='new';	echo _QXZ("New List Addition");}
if ($ADD==231)			{$hh='lists';		$sh='droplist';	echo _QXZ("New Drop List Addition");}
if ($ADD==2111)			{$hh='ingroups';	$sh='newIG';	echo _QXZ("New In-Group Addition");}
if ($ADD==2011)			{$hh='ingroups';	$sh='copyIG';	echo _QXZ("New Copied In-Group Addition");}
if ($ADD==2311)			{$hh='ingroups';	$sh='newDID';	echo _QXZ("New DID Addition");}
if ($ADD==2411)			{$hh='ingroups';	$sh='copyDID';	echo _QXZ("New Copied DID Addition");}
if ($ADD==2511)			{$hh='ingroups';	$sh='newCM';	echo _QXZ("New Call Menu");}
if ($ADD==2611)			{$hh='ingroups';	$sh='copyCM';	echo _QXZ("New Call Menu");}
if ($ADD==2711)			{$hh='ingroups';	$sh='newFPG';	echo _QXZ("New Filter Phone Group");}
if ($ADD==2811)			{$hh='ingroups';	$sh='newEG';	echo _QXZ("New Email Group Addition");}
if ($ADD==2911)			{$hh='ingroups';	$sh='copyEG';	echo _QXZ("New Copied Email Group Addition");}
if ($ADD==29111)		{$hh='ingroups';	$sh='copyCG';	echo _QXZ("New Copied Chat Group Addition");}
if ($ADD==21111)		{$hh='remoteagent';	$sh='new';	echo _QXZ("New Remote Agents Addition");}
if ($ADD==22111)		{$hh='remoteagent';	$sh='newEG';	echo _QXZ("New Group Extension Addition");}
if ($ADD==211111)		{$hh='usergroups';	$sh='new';	echo _QXZ("New Users Group Addition");}
if ($ADD==2111111)		{$hh='scripts';	$sh='new';	echo _QXZ("New Script Addition");}
if ($ADD==21111111)		{$hh='filters';	$sh='new';	echo _QXZ("New Filter Addition");}
if ($ADD==211111111)	{$hh='admin';	$sh='times';	echo _QXZ("New Call Time Addition");}
if ($ADD==231111111)	{$hh='admin';	$sh='shifts';	echo _QXZ("New Shift Addition");}
if ($ADD==2111111111)	{$hh='admin';	$sh='times';	echo _QXZ("New State Call Time Addition");}
if ($ADD==2211111111)	{$hh='admin';	$sh='times';	echo _QXZ("New Holiday Addition");}
if ($ADD==21111111111)	{$hh='admin';	$sh='phones';	echo _QXZ("ADDING NEW PHONE");}
if ($ADD==21222222222)	{$hh='admin';	$sh='phones';	echo _QXZ("COPYING NEW PHONE");}
if ($ADD==22111111111)	{$hh='admin';	$sh='phones';	echo _QXZ("ADDING NEW PHONE ALIAS");}
if ($ADD==23111111111)	{$hh='admin';	$sh='phones';	echo _QXZ("ADDING NEW GROUP ALIAS");}
if ($ADD==211111111111)	{$hh='admin';	$sh='server';	echo _QXZ("ADDING NEW SERVER");}
if ($ADD==221111111111)	{$hh='admin';	$sh='server';	echo _QXZ("ADDING NEW SERVER TRUNK RECORD");}
if ($ADD==231111111111)	{$hh='admin';	$sh='templates';	echo _QXZ("ADDING NEW CONF TEMPLATE");}
if ($ADD==241111111111)	{$hh='admin';	$sh='carriers';	echo _QXZ("ADDING NEW CARRIER");}
if ($ADD==240111111111)	{$hh='admin';	$sh='carriers';	echo _QXZ("ADDING COPIED CARRIER");}
if ($ADD==251111111111)	{$hh='admin';	$sh='tts';	echo _QXZ("ADDING NEW TTS ENTRY");}
if ($ADD==261111111111)	{$hh='admin';	$sh='moh';	echo _QXZ("ADDING NEW MUSIC ON HOLD ENTRY");}
if ($ADD==271111111111)	{$hh='admin';	$sh='vm';	echo _QXZ("ADDING NEW VOICEMAIL BOX");}
if ($ADD==281111111111)	{$hh='admin';	$sh='label';	echo _QXZ("ADDING NEW SCREEN LABEL");}
if ($ADD==282111111111)	{$hh='admin';	$sh='colors';	echo _QXZ("ADDING NEW SCREEN COLORS");}
if ($ADD==291111111111)	{$hh='admin';	$sh='cts';	echo _QXZ("ADDING NEW CONTACT");}
if ($ADD==292111111111)	{$hh='admin';	$sh='sc';	echo _QXZ("ADDING NEW SETTINGS CONTAINER");}
if ($ADD==293111111111)	{$hh='admin';	$sh='sg';	echo _QXZ("ADDING NEW STATUS GROUP");}
if ($ADD==294111111111)	{$hh='admin';	$sh='ar';	echo _QXZ("ADDING NEW AUTOMATED REPORT");}
if ($ADD==295111111111)	{$hh='admin';	$sh='il';	echo _QXZ("ADDING NEW IP LIST");}
if ($ADD==296111111111)	{$hh='admin';	$sh='cg';	echo _QXZ("ADDING NEW CID GROUP");}
if ($ADD==297111111111)	{$hh='admin';	$sh='vmmg';	echo _QXZ("ADDING NEW VM MESSAGE GROUP");}
if ($ADD==298111111111)	{$hh='admin';	$sh='qg';	echo _QXZ("ADDING NEW QUEUE GROUP");}
if ($ADD==2111111111111)	{$hh='admin';	$sh='conference';	echo _QXZ("ADDING NEW CONFERENCE");}
if ($ADD==21111111111111)	{$hh='admin';	$sh='conference';	echo _QXZ("ADDING NEW AGENT CONFERENCE");}
if ($ADD==221111111111111)	{$hh='admin';	$sh='status';	echo _QXZ("ADDING SYSTEM STATUSES");}
if ($ADD==231111111111111)	{$hh='admin';	$sh='status';	echo _QXZ("ADDING STATUS CATEGORY");}
if ($ADD==241111111111111)	{$hh='admin';	$sh='status';	echo _QXZ("ADDING QC STATUS CODE");}
if ($ADD==3)			{$hh='users';		$sh='list';	echo _QXZ("Modify User");}
if ($ADD==30)			{$hh='campaigns';	echo _QXZ("Campaign Not Allowed");}
if ($ADD==31)			
	{
	$hh='campaigns';	$sh='detail';	echo _QXZ("Modify Campaign - Detail")." - $campaign_id";
	if ($SUB==22)	{echo " - "._QXZ("Statuses");}
	if ($SUB==23)	{echo " - "._QXZ("HotKeys");}
	if ($SUB==25)	{echo " - "._QXZ("Lead Recycle Entries");}
	if ($SUB==26)	{echo " - "._QXZ("Auto Alt Dial Statuses");}
	if ($SUB==27)	{echo " - "._QXZ("Agent Pause Codes");}
	if ($SUB==28)	{echo " - "._QXZ("QC");}
	if ($SUB==29)	{echo " - "._QXZ("List Mixes");}
	if ($SUB=='20A')	{echo " - "._QXZ("Survey");}
	if ($SUB==201)	{echo " - "._QXZ("Presets");}
	if ($SUB==202)	{echo " - "._QXZ("AC-CID");}
	}
if ($ADD==34)
	{
	$hh='campaigns';	$sh='basic';	echo _QXZ("Modify Campaign - Basic View")." - $campaign_id";
	if ($SUB==22)	{echo " - "._QXZ("Statuses");}
	if ($SUB==23)	{echo " - "._QXZ("HotKeys");}
	if ($SUB==25)	{echo " - "._QXZ("Lead Recycle Entries");}
	if ($SUB==26)	{echo " - "._QXZ("Auto Alt Dial Statuses");}
	if ($SUB==27)	{echo " - "._QXZ("Agent Pause Codes");}
	if ($SUB==28)	{echo " - "._QXZ("QC");}
	if ($SUB==29)	{echo " - "._QXZ("List Mixes");}
	if ($SUB=='20A')	{echo " - "._QXZ("Survey");}
	if ($SUB==201)	{echo " - "._QXZ("Presets");}
	if ($SUB==202)	{echo " - "._QXZ("AC-CID");}
	}
if ($ADD==32)			{$hh='campaigns';	$sh='status';	echo _QXZ("Campaign Statuses");}
if ($ADD==33)			{$hh='campaigns';	$sh='hotkey';	echo _QXZ("Campaign HotKeys");}
if ($ADD==35)			{$hh='campaigns';	$sh='recycle';	echo _QXZ("Campaign Lead Recycle Entries");}
if ($ADD==36)			{$hh='campaigns';	$sh='autoalt';	echo _QXZ("Campaign Auto Alt Dial Statuses");}
if ($ADD==37)			{$hh='campaigns';	$sh='pause';	echo _QXZ("Campaign Agent Pause Codes");}
if ($ADD==38)			{$hh='campaigns';	$sh='dialstat';	echo _QXZ("Campaign Dial Statuses");}
if ($ADD==39)			{$hh='campaigns';	$sh='listmix';	echo _QXZ("Campaign List Mixes");}
if ($ADD==301)			{$hh='campaigns';	$sh='preset';	echo _QXZ("Campaign Presets");}
if ($ADD==302)			{$hh='campaigns';	$sh='accid';	echo _QXZ("Campaign Areacode CID");}
if ($ADD==311)			{$hh='lists';		$sh='list';	echo _QXZ("Modify List");}
if ($ADD==331)			{$hh='lists';		$sh='droplist';	echo _QXZ("Modify Drop List");}
if ($ADD==333)			{$hh='lists';		$sh='droplist';	echo _QXZ("Modify Drop List Status");}
if ($ADD==3111)			{$hh='ingroups';	echo _QXZ("Modify In-Group");}
if ($ADD==3311)			{$hh='ingroups';	echo _QXZ("Modify DID");}
if ($ADD==3321)			{$hh='ingroups';	echo _QXZ("Modify DID RA Extension Overrides");}
if ($ADD==3511)			{$hh='ingroups';	echo _QXZ("Modify Call Menu");}
if ($ADD==3711)			{$hh='ingroups';	echo _QXZ("Modify Filter Phone Group");}
if ($ADD==3811)			{$hh='ingroups';	echo _QXZ("Modify EMAIL In-Group");}
if ($ADD==3911)			{$hh='ingroups';	echo _QXZ("Modify CHAT In-Group");}
if ($ADD==3211)			{$hh='ingroups';	echo _QXZ("Modify Areacode List");}
if ($ADD==31111)		{$hh='remoteagent';	echo _QXZ("Modify Remote Agents");}
if ($ADD==32111)		{$hh='remoteagent';	echo _QXZ("Modify Extension Group");}
if ($ADD==311111)		{$hh='usergroups';	echo _QXZ("Modify Users Groups");}
if ($ADD==3111111)		{$hh='scripts';		echo _QXZ("Modify Script");}
if ($ADD==31111111)		{$hh='filters';		echo _QXZ("Modify Filter");}
if ($ADD==311111111)	{$hh='admin';	$sh='times';	echo _QXZ("Modify Call Time");}
if ($ADD==321111111)	{$hh='admin';	$sh='times';	echo _QXZ("Modify Call Time State Definitions List");}
if ($ADD==322111111)	{$hh='admin';	$sh='times';	echo _QXZ("Modify Call Time State Holiday");}
if ($ADD==331111111)	{$hh='admin';	$sh='shifts';	echo _QXZ("Modify Shift");}
if ($ADD==3111111111)	{$hh='admin';	$sh='times';	echo _QXZ("Modify State Call Time");}
if ($ADD==3211111111)	{$hh='admin';	$sh='times';	echo _QXZ("Modify Holiday");}
if ($ADD==31111111111)	{$hh='admin';	$sh='phones';	echo _QXZ("MODIFY PHONE");}
if ($ADD==32111111111)	{$hh='admin';	$sh='phones';	echo _QXZ("MODIFY PHONE ALIAS");}
if ($ADD==33111111111)	{$hh='admin';	$sh='phones';	echo _QXZ("MODIFY GROUP ALIAS");}
if ($ADD==311111111111)	{$hh='admin';	$sh='server';	echo _QXZ("MODIFY SERVER");}
if ($ADD==331111111111)	{$hh='admin';	$sh='templates';	echo _QXZ("MODIFY CONF TEMPLATE");}
if ($ADD==341111111111)	{$hh='admin';	$sh='carriers';	echo _QXZ("MODIFY CARRIER");}
if ($ADD==351111111111)	{$hh='admin';	$sh='tts';	echo _QXZ("MODIFY TTS ENTRY");}
if ($ADD==361111111111)	{$hh='admin';	$sh='moh';	echo _QXZ("MODIFY MUSIC ON HOLD ENTRY");}
if ($ADD==371111111111)	{$hh='admin';	$sh='vm';	echo _QXZ("MODIFY VOICEMAIL BOX");}
if ($ADD==381111111111)	{$hh='admin';	$sh='label';	echo _QXZ("MODIFY SCREEN LABEL");}
if ($ADD==382111111111)	{$hh='admin';	$sh='colors';	echo _QXZ("MODIFY SCREEN COLORS");}
if ($ADD==391111111111)	{$hh='admin';	$sh='cts';	echo _QXZ("MODIFY CONTACT");}
if ($ADD==392111111111)	{$hh='admin';	$sh='sc';	echo _QXZ("MODIFY SETTINGS CONTAINER");}
if ($ADD==393111111111)	{$hh='admin';	$sh='sg';	echo _QXZ("MODIFY STATUS GROUP");}
if ($ADD==394111111111)	{$hh='admin';	$sh='ar';	echo _QXZ("MODIFY AUTOMATED REPORT");}
if ($ADD==395111111111)	{$hh='admin';	$sh='il';	echo _QXZ("MODIFY IP LIST");}
if ($ADD==396111111111)	{$hh='admin';	$sh='cg';	echo _QXZ("MODIFY CID GROUP");}
if ($ADD==397111111111)	{$hh='admin';	$sh='vmmg';	echo _QXZ("MODIFY VM MESSAGE GROUP");}
if ($ADD==398111111111)	{$hh='admin';	$sh='qg';	echo _QXZ("MODIFY QUEUE GROUP");}
if ($ADD==3111111111111)	{$hh='admin';	$sh='conference';	echo _QXZ("MODIFY CONFERENCE");}
if ($ADD==31111111111111)	{$hh='admin';	$sh='conference';	echo _QXZ("MODIFY AGENT CONFERENCE");}
if ($ADD==311111111111111)	{$hh='admin';	$sh='settings';	echo _QXZ("MODIFY SYSTEM SETTINGS");}
if ($ADD==321111111111111)	{$hh='admin';	$sh='status';	echo _QXZ("MODIFY SYSTEM STATUSES");}
if ($ADD==331111111111111)	{$hh='admin';	$sh='status';	echo _QXZ("MODIFY STATUS CATEGORY");}
if ($ADD==341111111111111)	{$hh='qc';	$sh='modify';	echo _QXZ("MODIFY QC STATUS CODE");}
if ($ADD=="4A")			{$hh='users';		$sh='list';	echo _QXZ("Modify User - Admin");}
if ($ADD=="4B")			{$hh='users';		$sh='list';	echo _QXZ("Modify User - Admin");}
if ($ADD==4)			{$hh='users';		$sh='list';	echo _QXZ("Modify User");}
if ($ADD==41)			{$hh='campaigns';	$sh='detail';	echo _QXZ("Modify Campaign");}
if ($ADD==42)			{$hh='campaigns';	$sh='status';	echo _QXZ("Modify Campaign Status");}
if ($ADD==43)			{$hh='campaigns';	$sh='hotkey';	echo _QXZ("Modify Campaign HotKey");}
if ($ADD==44)			{$hh='campaigns';	$sh='basic';	echo _QXZ("Modify Campaign - Basic View");}
if ($ADD==45)			{$hh='campaigns';	$sh='recycle';	echo _QXZ("Modify Campaign Lead Recycle");}
if ($ADD==47)			{$hh='campaigns';	$sh='pause';	echo _QXZ("Modify Agent Pause Code");}
if ($ADD==48)			{$hh='campaigns';	$sh='qc';	echo _QXZ("Modify Campaign QC Settings");}
if ($ADD==49)			{$hh='campaigns';	$sh='listmix';	echo _QXZ("Modify Campaign List Mix");}
if ($ADD==401)			{$hh='campaigns';	$sh='preset';	echo _QXZ("Modify Campaign Preset");}
if ($ADD=='40A')		{$hh='campaigns';	$sh='survey';	echo _QXZ("Modify Campaign Survey");}
if ($ADD==411)			{$hh='lists';		$sh='list';	echo _QXZ("Modify List");}
if ($ADD==431)			{$hh='lists';		$sh='droplist';	echo _QXZ("Modify Drop List");}
if ($ADD==4111)			{$hh='ingroups';	echo _QXZ("Modify In-Group");}
if ($ADD==4311)			{$hh='ingroups';	echo _QXZ("Modify DID");}
if ($ADD==4511)			{$hh='ingroups';	echo _QXZ("Modify Call Menu");}
if ($ADD==4711)			{$hh='ingroups';	echo _QXZ("Modify Filter Phone Group");}
if ($ADD==4811)			{$hh='ingroups';	echo _QXZ("Modify Email In-Group");}
if ($ADD==4911)			{$hh='ingroups';	echo _QXZ("Modify Chat In-Group");}
if ($ADD==41111)		{$hh='remoteagent';	echo _QXZ("Modify Remote Agents");}
if ($ADD==42111)		{$hh='remoteagent';	echo _QXZ("Modify Extension Group");}
if ($ADD==411111)		{$hh='usergroups';	echo _QXZ("Modify Users Groups");}
if ($ADD==4111111)		{$hh='scripts';		echo _QXZ("Modify Script");}
if ($ADD==41111111)		{$hh='filters';		echo _QXZ("Modify Filter");}
if ($ADD==411111111)	{$hh='admin';	$sh='times';	echo _QXZ("Modify Call Time");}
if ($ADD==431111111)	{$hh='admin';	$sh='shifts';	echo _QXZ("Modify Shift");}
if ($ADD==4111111111)	{$hh='admin';	$sh='times';	echo _QXZ("Modify State Call Time");}
if ($ADD==4211111111)	{$hh='admin';	$sh='times';	echo _QXZ("Modify Holiday");}
if ($ADD==41111111111)	{$hh='admin';	$sh='phones';	echo _QXZ("MODIFY PHONE");}
if ($ADD==42111111111)	{$hh='admin';	$sh='phones';	echo _QXZ("MODIFY PHONE ALIAS");}
if ($ADD==43111111111)	{$hh='admin';	$sh='phones';	echo _QXZ("MODIFY GROUP ALIAS");}
if ($ADD==411111111111)	{$hh='admin';	$sh='server';	echo _QXZ("MODIFY SERVER");}
if ($ADD==421111111111)	{$hh='admin';	$sh='server';	echo _QXZ("MODIFY SERVER TRUNK RECORD");}
if ($ADD==431111111111)	{$hh='admin';	$sh='templates';	echo _QXZ("MODIFY CONF TEMPLATE");}
if ($ADD==441111111111)	{$hh='admin';	$sh='carriers';	echo _QXZ("MODIFY CARRIER");}
if ($ADD==451111111111)	{$hh='admin';	$sh='tts';	echo _QXZ("MODIFY TTS ENTRY");}
if ($ADD==461111111111)	{$hh='admin';	$sh='moh';	echo _QXZ("MODIFY MUSIC ON HOLD ENTRY");}
if ($ADD==471111111111)	{$hh='admin';	$sh='vm';	echo _QXZ("MODIFY VOICEMAIL BOX");}
if ($ADD==481111111111)	{$hh='admin';	$sh='label';	echo _QXZ("MODIFY SCREEN LABEL");}
if ($ADD==482111111111)	{$hh='admin';	$sh='colors';	echo _QXZ("MODIFY SCREEN COLORS");}
if ($ADD==491111111111)	{$hh='admin';	$sh='cts';	echo _QXZ("MODIFY CONTACT");}
if ($ADD==492111111111)	{$hh='admin';	$sh='sc';	echo _QXZ("MODIFY SETTINGS CONTAINER");}
if ($ADD==493111111111)	{$hh='admin';	$sh='sg';	echo _QXZ("MODIFY STATUS GROUP");}
if ($ADD==494111111111)	{$hh='admin';	$sh='ar';	echo _QXZ("MODIFY AUTOMATED REPORT");}
if ($ADD==496111111111)	{$hh='admin';	$sh='cg';	echo _QXZ("MODIFY CID GROUP");}
if ($ADD==497111111111)	{$hh='admin';	$sh='vmmg';	echo _QXZ("MODIFY VM MESSAGE GROUP");}
if ($ADD==498111111111)	{$hh='admin';	$sh='qg';	echo _QXZ("MODIFY QUEUE GROUP");}
if ($ADD==4111111111111)	{$hh='admin';	$sh='conference';	echo _QXZ("MODIFY CONFERENCE");}
if ($ADD==41111111111111)	{$hh='admin';	$sh='conference';	echo _QXZ("MODIFY CONFERENCE");}
if ($ADD==411111111111111)	{$hh='admin';	$sh='settings';	echo _QXZ("MODIFY SYSTEM SETTINGS");}
if ($ADD==421111111111111)	{$hh='admin';	$sh='status';	echo _QXZ("MODIFY SYSTEM STATUSES");}
if ($ADD==431111111111111)	{$hh='admin';	$sh='status';	echo _QXZ("MODIFY STATUS CATEGORIES");}
if ($ADD==441111111111111)	{$hh='admin';	$sh='status';	echo _QXZ("MODIFY QC STATUS CODE");}
if ($ADD==5)			{$hh='users';		$sh='list';	echo _QXZ("Delete User");}
if ($ADD==51)			{$hh='campaigns';	$sh='detail';	echo _QXZ("Delete Campaign");}
if ($ADD==52)			{$hh='campaigns';	$sh='detail';	echo _QXZ("Logout Agents");}
if ($ADD==53)			{$hh='campaigns';	$sh='detail';	echo _QXZ("Emergency VDAC Jam Clear");}
if ($ADD==511)			{$hh='lists';		$sh='list';	echo _QXZ("Delete List");}
if ($ADD==512)			{$hh='lists';		$sh='list';	echo _QXZ("Clear List");}
if ($ADD==531)			{$hh='lists';		$sh='droplist';	echo _QXZ("Delete Drop List");}
if ($ADD==5111)			{$hh='ingroups';	echo _QXZ("Delete In-Group");}
if ($ADD==5311)			{$hh='ingroups';	echo _QXZ("Delete DID");}
if ($ADD==5511)			{$hh='ingroups';	echo _QXZ("Delete Call Menu");}
if ($ADD==5711)			{$hh='ingroups';	echo _QXZ("Delete Phone Filter Group");}
if ($ADD==51111)		{$hh='remoteagent';	echo _QXZ("Delete Remote Agents");}
if ($ADD==52111)		{$hh='remoteagent';	echo _QXZ("Delete Extension Group");}
if ($ADD==511111)		{$hh='usergroups';	echo _QXZ("Delete Users Group");}
if ($ADD==5111111)		{$hh='scripts';		echo _QXZ("Delete Script");}
if ($ADD==51111111)		{$hh='filters';		echo _QXZ("Delete Filter");}
if ($ADD==511111111)	{$hh='admin';	$sh='times';	echo _QXZ("Delete Call Time");}
if ($ADD==531111111)	{$hh='admin';	$sh='shifts';	echo _QXZ("Delete Shift");}
if ($ADD==5111111111)	{$hh='admin';	$sh='times';	echo _QXZ("Delete State Call Time");}
if ($ADD==5211111111)	{$hh='admin';	$sh='times';	echo _QXZ("Delete Holiday");}
if ($ADD==51111111111)	{$hh='admin';	$sh='phones';	echo _QXZ("DELETE PHONE");}
if ($ADD==52111111111)	{$hh='admin';	$sh='phones';	echo _QXZ("DELETE PHONE ALIAS");}
if ($ADD==53111111111)	{$hh='admin';	$sh='phones';	echo _QXZ("DELETE GROUP ALIAS");}
if ($ADD==511111111111)	{$hh='admin';	$sh='server';	echo _QXZ("DELETE SERVER");}
if ($ADD==521111111111)	{$hh='admin';	$sh='server';	echo _QXZ("CLEAR AGENT CONFERENCES");}
if ($ADD==531111111111)	{$hh='admin';	$sh='templates';	echo _QXZ("DELETE CONF TEMPLATE");}
if ($ADD==541111111111)	{$hh='admin';	$sh='carriers';	echo _QXZ("DELETE CARRIER");}
if ($ADD==551111111111)	{$hh='admin';	$sh='tts';	echo _QXZ("DELETE TTS ENTRY");}
if ($ADD==561111111111)	{$hh='admin';	$sh='moh';	echo _QXZ("DELETE MUSIC ON HOLD ENTRY");}
if ($ADD==571111111111)	{$hh='admin';	$sh='vm';	echo _QXZ("DELETE VOICEMAIL BOX");}
if ($ADD==581111111111)	{$hh='admin';	$sh='label';	echo _QXZ("DELETE SCREEN LABEL");}
if ($ADD==582111111111)	{$hh='admin';	$sh='colors';	echo _QXZ("DELETE SCREEN COLORS");}
if ($ADD==591111111111)	{$hh='admin';	$sh='cts';	echo _QXZ("DELETE CONTACT");}
if ($ADD==592111111111)	{$hh='admin';	$sh='sc';	echo _QXZ("DELETE SETTINGS CONTAINER");}
if ($ADD==593111111111)	{$hh='admin';	$sh='sg';	echo _QXZ("DELETE STATUS GROUP");}
if ($ADD==594111111111)	{$hh='admin';	$sh='ar';	echo _QXZ("DELETE AUTOMATED REPORT");}
if ($ADD==595111111111)	{$hh='admin';	$sh='il';	echo _QXZ("DELETE IP LIST");}
if ($ADD==596111111111)	{$hh='admin';	$sh='cg';	echo _QXZ("DELETE CID GROUP");}
if ($ADD==597111111111)	{$hh='admin';	$sh='vmmg';	echo _QXZ("DELETE VM MESSAGE GROUP");}
if ($ADD==598111111111)	{$hh='admin';	$sh='qg';	echo _QXZ("DELETE QUEUE GROUP");}
if ($ADD==5111111111111)	{$hh='admin';	$sh='conference';	echo _QXZ("DELETE CONFERENCE");}
if ($ADD==51111111111111)	{$hh='admin';	$sh='conference';	echo _QXZ("DELETE AGENT CONFERENCE");}
if ($ADD==6)			{$hh='users';		$sh='list';	echo _QXZ("Delete User");}
if ($ADD==61)			{$hh='campaigns';	$sh='detail';	echo _QXZ("Delete Campaign");}
if ($ADD==62)			{$hh='campaigns';	$sh='detail';	echo _QXZ("Logout Agents");}
if ($ADD==63)			{$hh='campaigns';	$sh='detail';	echo _QXZ("Emergency VDAC Jam Clear");}
if ($ADD==65)			{$hh='campaigns';	$sh='recycle';	echo _QXZ("Delete Lead Recycle");}
if ($ADD==66)			{$hh='campaigns';	$sh='autoalt';	echo _QXZ("Delete Auto Alt Dial Status");}
if ($ADD==67)			{$hh='campaigns';	$sh='pause';	echo _QXZ("Delete Agent Pause Code");}
if ($ADD==68)			{$hh='campaigns';	$sh='dialstat';	echo _QXZ("Campaign Dial Status Removed");}
if ($ADD==69)			{$hh='campaigns';	$sh='listmix';	echo _QXZ("Campaign List Mix Removed");}
if ($ADD==601)			{$hh='campaigns';	$sh='preset';	echo _QXZ("Campaign Preset Removed");}
if ($ADD==611)			{$hh='lists';		$sh='list';	echo _QXZ("Delete List");}
if ($ADD==612)			{$hh='lists';		$sh='list';	echo _QXZ("Clear List");}
if ($ADD==631)			{$hh='lists';		$sh='droplist';	echo _QXZ("Delete Drop List");}
if ($ADD==6111)			{$hh='ingroups';	echo _QXZ("Delete In-Group");}
if ($ADD==6311)			{$hh='ingroups';	echo _QXZ("Delete DID");}
if ($ADD==6511)			{$hh='ingroups';	echo _QXZ("Delete Call Menu");}
if ($ADD==6711)			{$hh='ingroups';	echo _QXZ("Delete Phone Filter Group");}
if ($ADD==61111)		{$hh='remoteagent';	echo _QXZ("Delete Remote Agents");}
if ($ADD==62111)		{$hh='remoteagent';	echo _QXZ("Delete Extension Group");}
if ($ADD==611111)		{$hh='usergroups';	echo _QXZ("Delete Users Group");}
if ($ADD==6111111)		{$hh='scripts';		echo _QXZ("Delete Script");}
if ($ADD==61111111)		{$hh='filters';		echo _QXZ("Delete Filter");}
if ($ADD==611111111)	{$hh='admin';	$sh='times';	echo _QXZ("Delete Call Time");}
if ($ADD==631111111)	{$hh='admin';	$sh='shifts';	echo _QXZ("Delete Shift");}
if ($ADD==6111111111)	{$hh='admin';	$sh='times';	echo _QXZ("Delete State Call Time");}
if ($ADD==6211111111)	{$hh='admin';	$sh='times';	echo _QXZ("Delete Holiday");}
if ($ADD==61111111111)	{$hh='admin';	$sh='phones';	echo _QXZ("DELETE PHONE");}
if ($ADD==62111111111)	{$hh='admin';	$sh='phones';	echo _QXZ("DELETE PHONE ALIAS");}
if ($ADD==63111111111)	{$hh='admin';	$sh='phones';	echo _QXZ("DELETE GROUP ALIAS");}
if ($ADD==611111111111)	{$hh='admin';	$sh='server';	echo _QXZ("DELETE SERVER");}
if ($ADD==622111111111)	{$hh='admin';	$sh='server';	echo _QXZ("CLEAR AGENT CONFERENCES");}
if ($ADD==621111111111)	{$hh='admin';	$sh='server';	echo _QXZ("DELETE SERVER TRUNK RECORD");}
if ($ADD==631111111111)	{$hh='admin';	$sh='templates';	echo _QXZ("DELETE CONF TEMPLATE");}
if ($ADD==641111111111)	{$hh='admin';	$sh='carriers';	echo _QXZ("DELETE CARRIER");}
if ($ADD==651111111111)	{$hh='admin';	$sh='tts';	echo _QXZ("DELETE TTS ENTRY");}
if ($ADD==661111111111)	{$hh='admin';	$sh='moh';	echo _QXZ("DELETE MUSIC ON HOLD ENTRY");}
if ($ADD==671111111111)	{$hh='admin';	$sh='vm';	echo _QXZ("DELETE VOICEMAIL BOX");}
if ($ADD==681111111111)	{$hh='admin';	$sh='label';	echo _QXZ("DELETE SCREEN LABEL");}
if ($ADD==682111111111)	{$hh='admin';	$sh='colors';	echo _QXZ("DELETE SCREEN COLORS");}
if ($ADD==691111111111)	{$hh='admin';	$sh='cts';	echo _QXZ("DELETE CONTACT");}
if ($ADD==692111111111)	{$hh='admin';	$sh='sc';	echo _QXZ("DELETE SETTINGS CONTAINER");}
if ($ADD==693111111111)	{$hh='admin';	$sh='sg';	echo _QXZ("DELETE STATUS GROUP");}
if ($ADD==694111111111)	{$hh='admin';	$sh='ar';	echo _QXZ("DELETE AUTOMATED REPORT");}
if ($ADD==695111111111)	{$hh='admin';	$sh='il';	echo _QXZ("DELETE IP LIST");}
if ($ADD==696111111111)	{$hh='admin';	$sh='cg';	echo _QXZ("DELETE CID GROUP");}
if ($ADD==697111111111)	{$hh='admin';	$sh='vmmg';	echo _QXZ("DELETE VM MESSAGE GROUP");}
if ($ADD==698111111111)	{$hh='admin';	$sh='qg';	echo _QXZ("DELETE QUEUE GROUP");}
if ($ADD==6111111111111)	{$hh='admin';	$sh='conference';	echo _QXZ("DELETE CONFERENCE");}
if ($ADD==61111111111111)	{$hh='admin';	$sh='conference';	echo _QXZ("DELETE AGENT CONFERENCE");}
if ($ADD==73)			{$hh='campaigns';	echo _QXZ("Dialable Lead Count");}
if ($ADD==7111111)		{$hh='scripts';	$sh='list';	echo _QXZ("Preview Script");}
if ($ADD==700000000000000)	{$hh='reports';	echo _QXZ("ADMIN CHANGE LOG");}
if ($ADD==710000000000000)	{$hh='reports';	echo _QXZ("USER ADMIN CHANGE LOG");}
if ($ADD==720000000000000)	{$hh='reports';	echo _QXZ("SECTION ADMIN CHANGE LOG");}
if ($ADD==730000000000000)	{$hh='reports';	echo _QXZ("DETAIL ADMIN CHANGE LOG");}
if ($ADD==800000000000000)	{$hh='reports';	echo _QXZ("ADMIN REPORT LOG");}
if ($ADD==810000000000000)	{$hh='reports';	echo _QXZ("USER ADMIN REPORT LOG");}
if ($ADD==830000000000000)	{$hh='reports';	echo _QXZ("DETAIL ADMIN REPORT LOG");}
if ($ADD=="0A")			{$hh='users';	$sh='list';		echo _QXZ("Users List");}
if ($ADD==8)			{$hh='users';	$sh='list';		echo _QXZ("CallBacks Within Agent");}
if ($ADD==81)			{$hh='campaigns';	$sh='list';	echo _QXZ("CallBacks Within Campaign");}
if ($ADD==811)			{$hh='lists';		$sh='list';	echo _QXZ("CallBacks Within List");}
if ($ADD==8111)			{$hh='usergroups';	echo _QXZ("CallBacks Within User Group");}
if ($ADD==10)			{$hh='campaigns';	$sh='list';	echo _QXZ("Campaigns");}
if ($ADD==100)			{$hh='lists';		$sh='list';	echo _QXZ("Lists");}
if ($ADD==130)			{$hh='lists';		$sh='droplist';	echo _QXZ("Drop Lists");}
if ($ADD==1001)			{$hh='ingroups';	$sh='sections';	echo _QXZ("Inbound");}
if ($ADD==1000)			{$hh='ingroups';	$sh='listIG';	echo _QXZ("In-Groups");}
if ($ADD==1300)			{$hh='ingroups';	$sh='listDID';	echo _QXZ("DIDs");}
if ($ADD==1320)			{$hh='ingroups';	$sh='didRA';	echo _QXZ("Modify DID RA Extension Overrides");}
if ($ADD==1500)			{$hh='ingroups';	$sh='listCM';	echo _QXZ("Call Menus");}
if ($ADD==1700)			{$hh='ingroups';	$sh='listFPG';	echo _QXZ("Filter Phone Groups");}
if ($ADD==1800)			{$hh='ingroups';	$sh='listEG';	echo _QXZ("Email In-Groups");}
if ($ADD==1900)			{$hh='ingroups';	$sh='listCG';	echo _QXZ("Chat In-Groups");}
if ($ADD==10000)		{$hh='remoteagent';	$sh='list';	echo _QXZ("Remote Agents");}
if ($ADD==12000)		{$hh='remoteagent';	$sh='listEG';	echo _QXZ("Extension Groups");}
if ($ADD==100000)		{$hh='usergroups';	$sh='list';	echo _QXZ("User Groups");}
if ($ADD==1000000)		{$hh='scripts';	$sh='list';	echo _QXZ("Scripts");}
if ($ADD==10000000)		{$hh='filters';	$sh='list';	echo _QXZ("Filters");}
if ($ADD==100000000)	{$hh='admin';	$sh='times';	echo _QXZ("Call Times");}
if ($ADD==130000000)	{$hh='admin';	$sh='shifts';	echo _QXZ("Shifts");}
if ($ADD==1000000000)	{$hh='admin';	$sh='times';	echo _QXZ("State Call Times");}
if ($ADD==1200000000)	{$hh='admin';	$sh='times';	echo _QXZ("Holidays");}
if ($ADD==10000000000)	{$hh='admin';	$sh='phones';	echo _QXZ("PHONE LIST");}
if ($ADD==12000000000)	{$hh='admin';	$sh='phones';	echo _QXZ("PHONE ALIAS LIST");}
if ($ADD==13000000000)	{$hh='admin';	$sh='phones';	echo _QXZ("GROUP ALIAS LIST");}
if ($ADD==100000000000)	{$hh='admin';	$sh='server';	echo _QXZ("SERVER LIST");}
if ($ADD==130000000000)	{$hh='admin';	$sh='templates';	echo _QXZ("CONF TEMPLATE LIST");}
if ($ADD==140000000000)	{$hh='admin';	$sh='carriers';	echo _QXZ("CARRIER LIST");}
if ($ADD==150000000000)	{$hh='admin';	$sh='tts';	echo _QXZ("TTS ENTRY LIST");}
if ($ADD==160000000000)	{$hh='admin';	$sh='moh';	echo _QXZ("MUSIC ON HOLD ENTRY LIST");}
if ($ADD==170000000000)	{$hh='admin';	$sh='vm';	echo _QXZ("VOICEMAIL BOXES LIST");}
if ($ADD==180000000000)	{$hh='admin';	$sh='label';	echo _QXZ("SCREEN LABELS LIST");}
if ($ADD==182000000000)	{$hh='admin';	$sh='colors';	echo _QXZ("SCREEN COLORS LIST");}
if ($ADD==190000000000)	{$hh='admin';	$sh='cts';	echo _QXZ("CONTACTS LIST");}
if ($ADD==192000000000)	{$hh='admin';	$sh='sc';	echo _QXZ("SETTINGS CONTAINTER LIST");}
if ($ADD==193000000000)	{$hh='admin';	$sh='sg';	echo _QXZ("STATUS GROUP LIST");}
if ($ADD==194000000000)	{$hh='admin';	$sh='ar';	echo _QXZ("AUTOMATED REPORTS LIST");}
if ($ADD==195000000000)	{$hh='admin';	$sh='il';	echo _QXZ("IP LISTS");}
if ($ADD==196000000000)	{$hh='admin';	$sh='cg';	echo _QXZ("CID GROUP LIST");}
if ($ADD==197000000000)	{$hh='admin';	$sh='vmmg';	echo _QXZ("VM MESSAGE GROUPS LIST");}
if ($ADD==198000000000)	{$hh='admin';	$sh='qg';	echo _QXZ("QUEUE GROUPS LIST");}
if ($ADD==1000000000000)	{$hh='admin';	$sh='conference';	echo _QXZ("CONFERENCE LIST");}
if ($ADD==10000000000000)	{$hh='admin';	$sh='conference';	echo _QXZ("AGENT CONFERENCE LIST");}
if ($ADD==100000000000000)	{$hh='qc';	$sh='campaign';	echo _QXZ("Quality Control");}
if ($ADD==881)          {$hh='qc';		$sh='enter';	echo _QXZ("Quality Control Campaign")," $campaign_id";}
if ($ADD==550)			{$hh='users';		$sh='search';	echo _QXZ("Search Form");}
if ($ADD==551)			{$hh='users';		echo _QXZ("SEARCH PHONES");}
if ($ADD==660)			{$hh='users';		echo _QXZ("Search Results");}
if ($ADD==661)			{$hh='users';		echo _QXZ("SEARCH PHONES RESULTS");}
if ($ADD==99999)		{$hh='users';		echo _QXZ("HELP");}
if ($ADD==999999)		{$hh='reports';		echo _QXZ("REPORTS");}
if ($ADD==999998)		{$hh='admin';		echo _QXZ("ADMIN");}
if ($ADD==999997)		{$hh='reports';		echo _QXZ("CHANGE PASSWORD");}
if ($ADD==99999701)		{$hh='reports';		echo _QXZ("TWO-FACTOR-AUTHENTICATION");}
if ($ADD==999996)		{$hh='reports';		echo _QXZ("INITIAL INSTALL WELCOME");}
if ($ADD==999995)		{$hh='reports';		echo _QXZ("COPYRIGHT TRADEMARK LICENSE");}
if ($ADD==999994)		{$hh='reports';		echo _QXZ("ADMIN UTILITIES");}
if ($ADD==999993)		{$hh='reports';		echo _QXZ("SUMMARY STATS");}
if ($ADD==999992)		{$hh='reports';		echo _QXZ("SYSTEM SUMMARY STATS");}
if ($ADD==999991)		{$hh='reports';		echo _QXZ("SERVERS VERSIONS");}
if ($ADD==999990)		{$hh='main';		echo _QXZ("SYSTEM SNAPSHOT STATS");}
if ($ADD==999989)		{$hh='reports';		echo _QXZ("USER CHANGE LANGUAGE");}
if ($ADD==999988)		{$hh='reports';		echo _QXZ("AVAILABLE TIMEZONES");}
if ($ADD==999987)		{$hh='reports';		echo _QXZ("PHONE CODES");}
if ($ADD==999986)		{$hh='reports';		echo _QXZ("POSTAL CODES");}

echo "</title>\n";

if ( ($ADD==999993) or ($ADD==999992) or ($ADD==730000000000000) or ($ADD==830000000000000) )
	{
	if ($ADD==999993)		{$report_name = "SUMMARY STATS";}
	if ($ADD==999992)		{$report_name = "SYSTEM SUMMARY STATS";}
	if ($ADD==730000000000000)	{$report_name = "DETAIL ADMIN CHANGE LOG";}
	if ($ADD==830000000000000)	{$report_name = "DETAIL ADMIN REPORT LOG";}

	##### BEGIN log visit to the vicidial_report_log table #####
	$LOGip = getenv("REMOTE_ADDR");
	$LOGbrowser = getenv("HTTP_USER_AGENT");
	$LOGscript_name = getenv("SCRIPT_NAME");
	$LOGserver_name = getenv("SERVER_NAME");
	$LOGserver_port = getenv("SERVER_PORT");
	$LOGrequest_uri = getenv("REQUEST_URI");
	$LOGhttp_referer = getenv("HTTP_REFERER");
	$LOGbrowser=preg_replace("/\'|\"|\\\\/","",$LOGbrowser);
	$LOGrequest_uri=preg_replace("/\'|\"|\\\\/","",$LOGrequest_uri);
	$LOGhttp_referer=preg_replace("/\'|\"|\\\\/","",$LOGhttp_referer);
	if (preg_match("/443/i",$LOGserver_port)) {$HTTPprotocol = 'https://';}
	else {$HTTPprotocol = 'http://';}
	if (($LOGserver_port == '80') or ($LOGserver_port == '443') ) {$LOGserver_port='';}
	else {$LOGserver_port = ":$LOGserver_port";}
	$LOGfull_url = "$HTTPprotocol$LOGserver_name$LOGserver_port$LOGrequest_uri";

	$LOGhostname = php_uname('n');
	if (strlen($LOGhostname)<1) {$LOGhostname='X';}
	if (strlen($LOGserver_name)<1) {$LOGserver_name='X';}

	$stmt="SELECT webserver_id FROM vicidial_webservers where webserver='$LOGserver_name' and hostname='$LOGhostname' LIMIT 1;";
	if ($DB) {echo "$stmt\n";}
	$rslt=mysql_to_mysqli($stmt, $link);
	$webserver_id_ct = mysqli_num_rows($rslt);
	if ($webserver_id_ct > 0)
		{
		$row=mysqli_fetch_row($rslt);
		$webserver_id = $row[0];
		}
	else
		{
		##### insert webserver entry
		$stmt="INSERT INTO vicidial_webservers (webserver,hostname) values('$LOGserver_name','$LOGhostname');";
		if ($DB) {echo "$stmt\n";}
		$rslt=mysql_to_mysqli($stmt, $link);
		$affected_rows = mysqli_affected_rows($link);
		$webserver_id = mysqli_insert_id($link);
		}

	$stmt="INSERT INTO vicidial_report_log set event_date=NOW(), user='$PHP_AUTH_USER', ip_address='$LOGip', report_name='$report_name', browser='$LOGbrowser', referer='$LOGhttp_referer', notes='$LOGserver_name:$LOGserver_port $LOGscript_name |$group, $query_date, $end_date, $shift, $stage, $report_display_type|', url='$LOGfull_url', webserver='$webserver_id';";
	$rslt=mysql_to_mysqli($stmt, $link);
	$report_log_id = mysqli_insert_id($link);
	if ($DB) {echo "$report_log_id|$stmt|\n";}
	##### END log visit to the vicidial_report_log table #####
	}

if ( ($ADD>2) and ($ADD < 99998) )
	{
	##### get scripts listing for dynamic pulldown
	$stmt="SELECT script_id,script_name from vicidial_scripts $whereLOGadmin_viewable_groupsSQL order by script_id;";
	$rslt=mysql_to_mysqli($stmt, $link);
	$scripts_to_print = mysqli_num_rows($rslt);
	if ($DB) {echo "$scripts_to_print|$stmt|\n";}
	$scripts_list="<option value=\"\">"._QXZ("NONE")."</option>\n";

	$o=0;
	while ($scripts_to_print > $o)
		{
		$rowx=mysqli_fetch_row($rslt);
		$scripts_list .= "<option value=\"$rowx[0]\">$rowx[0] - $rowx[1]</option>\n";
		$scriptname_list["$rowx[0]"] = "$rowx[1]";
		$o++;
		}

	##### get filters listing for dynamic pulldown
	$stmt="SELECT lead_filter_id,lead_filter_name,lead_filter_sql from vicidial_lead_filters $whereLOGadmin_viewable_groupsSQL order by lead_filter_id;";
	$rslt=mysql_to_mysqli($stmt, $link);
	$filters_to_print = mysqli_num_rows($rslt);
	if ($DB) {echo "$filters_to_print|$stmt|\n";}
	$filters_list="<option value=\"\">"._QXZ("NONE")."</option>\n";

	$o=0;
	while ($filters_to_print > $o)
		{
		$rowx=mysqli_fetch_row($rslt);
		$filters_list .= "<option value=\"$rowx[0]\">$rowx[0] - $rowx[1]</option>\n";
		$filtername_list["$rowx[0]"] = "$rowx[1]";
		$filtersql_list["$rowx[0]"] = "$rowx[2]";
		$o++;
		}

	##### get call_times listing for dynamic pulldown
	$stmt="SELECT call_time_id,call_time_name from vicidial_call_times $whereLOGadmin_viewable_call_timesSQL order by call_time_id;";
	$rslt=mysql_to_mysqli($stmt, $link);
	$times_to_print = mysqli_num_rows($rslt);
	if ($DB) {echo "$times_to_print|$stmt|\n";}

	$o=0;
	while ($times_to_print > $o)
		{
		$rowx=mysqli_fetch_row($rslt);
		$call_times_list .= "<option value=\"$rowx[0]\">$rowx[0] - $rowx[1]</option>\n";
		$call_timename_list["$rowx[0]"] = "$rowx[1]";
		$o++;
		}
	}

if ( ( (strlen($ADD)>4) and ($ADD < 99998) ) or ($ADD==3) or (($ADD>20) and ($ADD<70)) or ($ADD=="4A")  or ($ADD=="4B") or (strlen($ADD)==12) )
	{
	##### BEGIN get campaigns listing for rankings #####

	$h="9";
	$headRANKcampaigns_list='';
	while ($h>=-9)
		{
		$headRANKcampaigns_list .= "<option value=\"$h\">$h</option>";
		$h--;
		}
	$h="10";
	$headGRADEcampaigns_list='';
	while ($h>=1)
		{
		$headGRADEcampaigns_list .= "<option value=\"$h\">$h</option>";
		$h--;
		}

	$stmt="SELECT campaign_id,campaign_name from vicidial_campaigns $whereLOGallowed_campaignsSQL order by campaign_id";
	$rslt=mysql_to_mysqli($stmt, $link);
	$campaigns_to_print = mysqli_num_rows($rslt);
	if ($DB) {echo "$campaigns_to_print|$stmt|\n";}
	$campaigns_list='';
	$campaigns_value='';
	$RANKcampaigns_list='';
	$RANKcampaigns_list.="<tr bgcolor=#$SSmenu_background><td><font color=white> &nbsp; "._QXZ("CAMPAIGN")."</td>\n";
	$RANKcampaigns_list.="<td nowrap><font color=white> &nbsp; "._QXZ("RANK")." &nbsp; <br><select name=\"campaign_js_rank_select\" id=\"campaign_js_rank_select\" size=1 style=\"font-family: sans-serif; font-size: 10px; overflow: hidden;\"><option value=\"\">-></option>$headRANKcampaigns_list</select><a href=\"#\" onclick=\"campaign_rank_val_change();return false;\"><font size=1 color=white>"._QXZ("change")."</font></a></td>\n";
	$RANKcampaigns_list.="<td nowrap><font color=white> &nbsp; "._QXZ("GRADE")." &nbsp; <br><select name=\"campaign_js_grade_select\" id=\"campaign_js_grade_select\" size=1 style=\"font-family: sans-serif; font-size: 10px; overflow: hidden;\"><option value=\"\">-></option>$headGRADEcampaigns_list</select><a href=\"#\" onclick=\"campaign_grade_val_change();return false;\"><font size=1 color=white>"._QXZ("change")."</font></a></td>\n";
	$RANKcampaigns_list.="<td nowrap><font color=white> &nbsp; "._QXZ("CALLS")." &nbsp; </td><td ALIGN=CENTER><font color=white>"._QXZ("WEB VARS")."</td></tr>\n";

	$o=0;
	while ($campaigns_to_print > $o)
		{
		$rowx=mysqli_fetch_row($rslt);
		$campaigns_list .= "<option value=\"$rowx[0]\">$rowx[0] - $rowx[1]</option>\n";
		$campaign_id_values[$o] = $rowx[0];
		$campaign_name_values[$o] = $rowx[1];
		$o++;
		}

	$o=0;
	$stmt_grp_values='';
	$campaign_js_rank='';
	$campaign_js_grade='';
	$campaign_js_rank_ct=0;
	$campaign_js_grade_ct=0;

	while ($campaigns_to_print > $o)
		{
		$group_web_vars='';
		$campaign_web='';
		$stmt="SELECT campaign_rank,calls_today,group_web_vars,campaign_grade,hopper_calls_today,hopper_calls_hour from vicidial_campaign_agents where user='$user' and campaign_id='$campaign_id_values[$o]' $LOGallowed_campaignsSQL;";
		$rslt=mysql_to_mysqli($stmt, $link);
		$ranks_to_print = mysqli_num_rows($rslt);
		if ($DB) {echo "$ranks_to_print|$stmt|\n";}
		if ($ranks_to_print > 0)
			{
			$row=mysqli_fetch_row($rslt);
			$SELECT_campaign_rank =		$row[0];
			$calls_today =				$row[1];
			$group_web_vars =			$row[2];
			$SELECT_campaign_grade =	$row[3];
			$hopper_calls_today =		$row[4];
			$hopper_calls_hour =		$row[5];
			}
		else
			{$calls_today=0;   $SELECT_campaign_rank=0;   $SELECT_campaign_grade=1;   $group_web_vars='';}
		if ( ($ADD=="4A") or ($ADD=="4B") )
			{
			if (isset($_GET["RANK_$campaign_id_values[$o]"]))			{$campaign_rank=$_GET["RANK_$campaign_id_values[$o]"];}
				elseif (isset($_POST["RANK_$campaign_id_values[$o]"]))	{$campaign_rank=$_POST["RANK_$campaign_id_values[$o]"];}
			if (isset($_GET["WEB_$campaign_id_values[$o]"]))			{$campaign_web=$_GET["WEB_$campaign_id_values[$o]"];}
				elseif (isset($_POST["WEB_$campaign_id_values[$o]"]))	{$campaign_web=$_POST["WEB_$campaign_id_values[$o]"];}
			if (isset($_GET["GRADE_$campaign_id_values[$o]"]))			{$campaign_grade=$_GET["GRADE_$campaign_id_values[$o]"];}
				elseif (isset($_POST["GRADE_$campaign_id_values[$o]"]))	{$campaign_grade=$_POST["GRADE_$campaign_id_values[$o]"];}
			$campaign_rank = preg_replace('/[^-\_0-9]/','',$campaign_rank);
			$campaign_web = preg_replace("/;|\"|\'/","",$campaign_web);
			$campaign_grade = preg_replace('/[^-\_0-9]/','',$campaign_grade);

			if ($ranks_to_print > 0)
				{
				$stmt="UPDATE vicidial_campaign_agents set campaign_rank='$campaign_rank', campaign_weight='$campaign_rank', group_web_vars='$campaign_web',campaign_grade='$campaign_grade' where campaign_id='$campaign_id_values[$o]' and user='$user';";
				$rslt=mysql_to_mysqli($stmt, $link);
				$stmt_grp_values .= "$stmt|";
				}
			else
				{
				$stmt="INSERT INTO vicidial_campaign_agents set campaign_rank='$campaign_rank', campaign_weight='$campaign_rank', campaign_id='$campaign_id_values[$o]', user='$user', group_web_vars='$campaign_web',campaign_grade='$campaign_grade';";
				$rslt=mysql_to_mysqli($stmt, $link);
				$stmt_grp_values .= "$stmt|";
				}

			$stmt="UPDATE vicidial_live_agents set campaign_weight='$campaign_rank',campaign_grade='$campaign_grade' where campaign_id='$campaign_id_values[$o]' and user='$user';";
			$rslt=mysql_to_mysqli($stmt, $link);
			$stmt_grp_values .= "$stmt|";
			}
		else 
			{
			$campaign_rank = $SELECT_campaign_rank;
			$campaign_grade = $SELECT_campaign_grade;
			}

		$USER_hopper_calls_today = ($USER_hopper_calls_today + $hopper_calls_today);
		$USER_hopper_calls_hour = ($USER_hopper_calls_hour + $hopper_calls_hour);

		if (preg_match('/1$|3$|5$|7$|9$/i', $o))
			{$bgcolor='bgcolor="#'. $SSstd_row2_background .'"';} 
		else
			{$bgcolor='bgcolor="#' . $SSstd_row1_background . '"';}

		# disable non user-group allowable campaign ranks
		$stmt="SELECT user_group from vicidial_users where user='$user' $LOGadmin_viewable_groupsSQL;";
		$rslt=mysql_to_mysqli($stmt, $link);
		$row=mysqli_fetch_row($rslt);
		$Ruser_group =	$row[0];

		$stmt="SELECT allowed_campaigns from vicidial_user_groups where user_group='$Ruser_group' $LOGadmin_viewable_groupsSQL;";
		$rslt=mysql_to_mysqli($stmt, $link);
		$row=mysqli_fetch_row($rslt);
		$allowed_campaigns =	$row[0];
		$allowed_campaigns = preg_replace("/ -$/","",$allowed_campaigns);
		$UGcampaigns = explode(" ", $allowed_campaigns);

		$p=0;   $RANK_camp_active=0;   $GRADE_camp_active=0;   $CR_disabled = '';
		if (preg_match('/\-ALL\-CAMPAIGNS\-/i',$allowed_campaigns))
			{$RANK_camp_active++;   $GRADE_camp_active++;}
		else
			{
			$UGcampaign_ct = count($UGcampaigns);
			while ($p < $UGcampaign_ct)
				{
				if ($campaign_id_values[$o] === $UGcampaigns[$p]) 
					{$RANK_camp_active++;   $GRADE_camp_active++;}
				$p++;
				}
			}
		if ($RANK_camp_active < 1) 
			{$CR_disabled = 'DISABLED';}
		else
			{
			$campaign_js_rank_ct++;
			$campaign_js_grade_ct++;
			if (strlen($campaign_js_rank) > 1)
				{
				$campaign_js_rank .= ",";
				$campaign_js_grade .= ",";
				}
			$campaign_js_rank .= "'RANK_$campaign_id_values[$o]'";
			$campaign_js_grade .= "'GRADE_$campaign_id_values[$o]'";
			}

		$RANKcampaigns_list .= "<tr $bgcolor><td>";
		$campaigns_list .= "<a href=\"$PHP_SELF?ADD=31&campaign_id=$campaign_id_values[$o]\">$campaign_id_values[$o]</a> - $campaign_name_values[$o] <BR>\n";
		$RANKcampaigns_list .= "<a href=\"$PHP_SELF?ADD=31&campaign_id=$campaign_id_values[$o]\">$campaign_id_values[$o]</a> - $campaign_name_values[$o] </td>";
		$RANKcampaigns_list .= "<td> &nbsp; <select size=1 name=RANK_$campaign_id_values[$o] id=RANK_$campaign_id_values[$o] $CR_disabled>\n";
		$h="9";
		while ($h>=-9)
			{
			$RANKcampaigns_list .= "<option value=\"$h\"";
			if ($h==$campaign_rank)
				{$RANKcampaigns_list .= " SELECTED";}
			$RANKcampaigns_list .= ">$h</option>";
			$h--;
			}
		if ( (strlen($campaign_web) < 1) and (strlen($group_web_vars) > 0) )
			{$campaign_web=$group_web_vars;}
		$RANKcampaigns_list .= "</select></td>\n";
		$RANKcampaigns_list .= "<td> &nbsp; <select size=1 name=GRADE_$campaign_id_values[$o] id=GRADE_$campaign_id_values[$o] $CR_disabled>\n";
		$h="10";
		while ($h>=1)
			{
			$RANKcampaigns_list .= "<option value=\"$h\"";
			if ($h==$campaign_grade)
				{$RANKcampaigns_list .= " SELECTED";}
			$RANKcampaigns_list .= ">$h</option>";
			$h--;
			}
		if ( (strlen($campaign_web) < 1) and (strlen($group_web_vars) > 0) )
			{$campaign_web=$group_web_vars;}
		$RANKcampaigns_list .= "</select></td>\n";
		$RANKcampaigns_list .= "<td align=right> &nbsp; &nbsp; $calls_today</td>\n";
		$RANKcampaigns_list .= "<td> &nbsp; &nbsp; <input type=text size=25 maxlength=255 name=WEB_$campaign_id_values[$o] value=\"$campaign_web\"></td></tr>\n";
		$o++;
		}
	##### END get campaigns listing for rankings #####


	##### BEGIN get inbound groups listing for checkboxes #####
	$xfer_groupsSQL='';
	if ( (($ADD>20) and ($ADD<70)) and ($ADD!=41) or ( ($ADD==41) and ( (preg_match('/list_activation/i', $stage)) or (preg_match('/test_call/',$stage)) ) ) )
		{
		$stmt="SELECT closer_campaigns,xfer_groups from vicidial_campaigns where campaign_id='$campaign_id' $LOGallowed_campaignsSQL;";
		$rslt=mysql_to_mysqli($stmt, $link);
		$row=mysqli_fetch_row($rslt);
		$closer_campaigns =	$row[0];
			$closer_campaigns = preg_replace("/ -$/","",$closer_campaigns);
			$groups = explode(" ", $closer_campaigns);
		$xfer_groups =	$row[1];
			$xfer_groups = preg_replace("/ -$/","",$xfer_groups);
			$XFERgroups = explode(" ", $xfer_groups);
		$xfer_groupsSQL = preg_replace("/^ | -$/","",$xfer_groups);
		$xfer_groupsSQL = preg_replace("/ /","','",$xfer_groupsSQL);
		$xfer_groupsSQL = "WHERE group_id IN('$xfer_groupsSQL')";
		}
	if ($ADD==41)
		{
		$p=0;
		if (is_null($XFERgroups)) $XFERgroups = array();
		$XFERgroup_ct = count($XFERgroups);
		while ($p < $XFERgroup_ct)
			{
			$xfer_groups .= " $XFERgroups[$p]";
			$p++;
			}
		$xfer_groups = preg_replace("/\<|\>|\'|\"|\\\\|;/","",$xfer_groups);
		$xfer_groupsSQL = preg_replace("/^ | -$/","",$xfer_groups);
		$xfer_groupsSQL = preg_replace("/ /","','",$xfer_groupsSQL);
		$xfer_groupsSQL = "WHERE group_id IN('$xfer_groupsSQL')";
		}

	if ( (($ADD==31111) or ($ADD==31111)) and (count($groups)<1) )
		{
		$stmt="SELECT closer_campaigns from vicidial_remote_agents where remote_agent_id='$remote_agent_id';";
		$rslt=mysql_to_mysqli($stmt, $link);
		$row=mysqli_fetch_row($rslt);
		$closer_campaigns =	$row[0];
		$closer_campaigns = preg_replace("/ -$/","",$closer_campaigns);
		$groups = explode(" ", $closer_campaigns);
		}

	if ($ADD==3)
		{
		$stmt="SELECT closer_campaigns from vicidial_users where user='$user' $LOGadmin_viewable_groupsSQL;";
		$rslt=mysql_to_mysqli($stmt, $link);
		$row=mysqli_fetch_row($rslt);
		$closer_campaigns =	$row[0];
		$closer_campaigns = preg_replace("/ -$/","",$closer_campaigns);
		$groups = explode(" ", $closer_campaigns);
		}

	$h="9";
	$headRANKgroups_list='';
	while ($h>=-9)
		{
		$headRANKgroups_list .= "<option value=\"$h\">$h</option>";
		$h--;
		}
	$h="10";
	$headGRADEgroups_list='';
	while ($h>=1)
		{
		$headGRADEgroups_list .= "<option value=\"$h\">$h</option>";
		$h--;
		}


	$stmt="SELECT group_id,group_name from vicidial_inbound_groups $whereLOGadmin_viewable_groupsSQL order by group_id;";
#	$stmt="SELECT group_id,group_name from vicidial_inbound_groups where group_id NOT IN('AGENTDIRECT') order by group_id";
	$rslt=mysql_to_mysqli($stmt, $link);
	$groups_to_print = mysqli_num_rows($rslt);
	$groups_list='';
	$groups_value='';
	$XFERgroups_list='';
	$RANKgroups_list='';
	$RANKgroups_list.="<tr bgcolor=#$SSmenu_background><td><font color=white> &nbsp; "._QXZ("INBOUND GROUP")."</td>\n";
	$RANKgroups_list.="<td nowrap><font color=white> &nbsp; "._QXZ("RANK")." &nbsp; <br><select name=\"ingroup_js_rank_select\" id=\"ingroup_js_rank_select\" size=1 style=\"font-family: sans-serif; font-size: 10px; overflow: hidden;\"><option value=\"\">-></option>$headRANKgroups_list</select><a href=\"#\" onclick=\"ingroup_rank_val_change();return false;\"><font size=1 color=white>"._QXZ("change")."</font></a></td>\n";
	$RANKgroups_list.="<td nowrap><font color=white> &nbsp; "._QXZ("GRADE")." &nbsp; <br><select name=\"ingroup_js_grade_select\" id=\"ingroup_js_grade_select\" size=1 style=\"font-family: sans-serif; font-size: 10px; overflow: hidden;\"><option value=\"\">-></option>$headGRADEgroups_list</select><a href=\"#\" onclick=\"ingroup_grade_val_change();return false;\"><font size=1 color=white>"._QXZ("change")."</font></a></td>\n";
	$RANKgroups_list.="<td nowrap><font color=white> &nbsp; "._QXZ("CALLS")." &nbsp; </td><td ALIGN=CENTER><font color=white>"._QXZ("WEB VARS")."</td></tr>\n";

	$o=0;
	while ($groups_to_print > $o)
		{
		$rowx=mysqli_fetch_row($rslt);
		$group_id_values[$o] = $rowx[0];
		$group_name_values[$o] = $rowx[1];
		$o++;
		}

	$o=0;
	$USER_inbound_calls_today=0;
	$USER_inbound_calls_today_filtered=0;
	$ingroup_js_rank='';
	$ingroup_js_grade='';
	$ingroup_js_rank_ct=0;
	$ingroup_js_grade_ct=0;

	while ($groups_to_print > $o)
		{
		$group_web_vars='';
		$group_web='';
		$stmt="SELECT group_rank,calls_today,group_web_vars,group_grade,calls_today_filtered from vicidial_inbound_group_agents where user='$user' and group_id='$group_id_values[$o]';";
		$rslt=mysql_to_mysqli($stmt, $link);
		$ranks_to_print = mysqli_num_rows($rslt);
		if ($ranks_to_print > 0)
			{
			$row=mysqli_fetch_row($rslt);
			$SELECT_group_rank =	$row[0];
			$calls_today =			$row[1];
			$group_web_vars =		$row[2];
			$SELECT_group_grade =	$row[3];
			$calls_today_filtered =	$row[4];
			}
		else
			{$calls_today=0;   $SELECT_group_rank=0;   $SELECT_group_grade=1;   $calls_today_filtered=0;}
		if ( ($ADD=="4A") or ($ADD=="4B") )
			{
			if (isset($_GET["RANK_$group_id_values[$o]"]))			{$group_rank=$_GET["RANK_$group_id_values[$o]"];}
				elseif (isset($_POST["RANK_$group_id_values[$o]"]))	{$group_rank=$_POST["RANK_$group_id_values[$o]"];}
			if (isset($_GET["WEB_$group_id_values[$o]"]))			{$group_web=$_GET["WEB_$group_id_values[$o]"];}
				elseif (isset($_POST["WEB_$group_id_values[$o]"]))	{$group_web=$_POST["WEB_$group_id_values[$o]"];}
			if (isset($_GET["GRADE_$group_id_values[$o]"]))				{$group_grade=$_GET["GRADE_$group_id_values[$o]"];}
				elseif (isset($_POST["GRADE_$group_id_values[$o]"]))	{$group_grade=$_POST["GRADE_$group_id_values[$o]"];}

			$group_rank = preg_replace('/[^-\_0-9]/','',$group_rank);
			$group_web = preg_replace("/;|\"|\'/","",$group_web);
			$group_grade = preg_replace('/[^-\_0-9]/','',$group_grade);

			if ($ranks_to_print > 0)
				{
				$stmt="UPDATE vicidial_inbound_group_agents set group_rank='$group_rank', group_weight='$group_rank', group_web_vars='$group_web', group_grade='$group_grade' where group_id='$group_id_values[$o]' and user='$user';";
				$rslt=mysql_to_mysqli($stmt, $link);
				$stmt_grp_values .= "$stmt|";
				}
			else
				{
				$stmt="INSERT INTO vicidial_inbound_group_agents set group_rank='$group_rank', group_weight='$group_rank', group_id='$group_id_values[$o]', user='$user', group_web_vars='$group_web', group_grade='$group_grade';";
				$rslt=mysql_to_mysqli($stmt, $link);
				$stmt_grp_values .= "$stmt|";
				}

			$stmt="UPDATE vicidial_live_inbound_agents set group_weight='$group_rank', group_grade='$group_grade' where group_id='$group_id_values[$o]' and user='$user';";
			$rslt=mysql_to_mysqli($stmt, $link);
			$stmt_grp_values .= "$stmt|";
			}
		else 
			{
			$group_rank = $SELECT_group_rank;
			$group_grade = $SELECT_group_grade;
			}

		if (preg_match('/1$|3$|5$|7$|9$/i', $o))
			{$bgcolor='bgcolor="#'. $SSstd_row2_background .'"';} 
		else
			{$bgcolor='bgcolor="#' . $SSstd_row1_background . '"';}

		$groups_list .= "<input type=\"checkbox\" name=\"groups[]\" value=\"$group_id_values[$o]\"";
		$XFERgroups_list .= "<input type=\"checkbox\" name=\"XFERgroups[]\" value=\"$group_id_values[$o]\"";
		$RANKgroups_list .= "<tr $bgcolor><td><input type=\"checkbox\" name=\"groups[]\" value=\"$group_id_values[$o]\"";
		$p=0;
		if (is_array($groups)) {$group_ct = count($groups);} else {$group_ct=0;}
		while ($p < $group_ct)
			{
			if ($group_id_values[$o] === $groups[$p]) 
				{
				$groups_list .= " CHECKED";
				$RANKgroups_list .= " CHECKED";
				$groups_value .= " $group_id_values[$o]";
				}
			$p++;
			}
		$p=0;
		if (is_array($XFERgroups)) {$XFERgroup_ct = count($XFERgroups);} else {$XFERgroup_ct=0;}
		while ($p < $XFERgroup_ct)
			{
			if ($group_id_values[$o] === $XFERgroups[$p]) 
				{
				$XFERgroups_list .= " CHECKED";
				$XFERgroups_value .= " $group_id_values[$o]";
				}
			$p++;
			}
		$stmt="SELECT queue_priority from vicidial_inbound_groups where group_id='$group_id_values[$o]' $LOGadmin_viewable_groupsSQL;";
		$rslt=mysql_to_mysqli($stmt, $link);
		$row=mysqli_fetch_row($rslt);
		$VIG_priority =			$row[0];

		$ingroup_js_rank_ct++;
		$ingroup_js_grade_ct++;
		if (strlen($ingroup_js_rank) > 1)
			{
			$ingroup_js_rank .= ",";
			$ingroup_js_grade .= ",";
			}
		$ingroup_js_rank .= "'RANK_$group_id_values[$o]'";
		$ingroup_js_grade .= "'GRADE_$group_id_values[$o]'";

		$groups_list .= "> <a href=\"$PHP_SELF?ADD=3111&group_id=$group_id_values[$o]\">$group_id_values[$o]</a> - $group_name_values[$o] - $VIG_priority <BR>\n";
		$XFERgroups_list .= "> <a href=\"$PHP_SELF?ADD=3111&group_id=$group_id_values[$o]\">$group_id_values[$o]</a> - $group_name_values[$o] <BR>\n";
		$RANKgroups_list .= "> <a href=\"$PHP_SELF?ADD=3111&group_id=$group_id_values[$o]\">$group_id_values[$o]</a> - $group_name_values[$o] </td>";
		$RANKgroups_list .= "<td> &nbsp; <select size=1 name=RANK_$group_id_values[$o] id=RANK_$group_id_values[$o]>\n";
		$h="9";
		while ($h>=-9)
			{
			$RANKgroups_list .= "<option value=\"$h\"";
			if ($h==$group_rank)
				{$RANKgroups_list .= " SELECTED";}
			$RANKgroups_list .= ">$h</option>";
			$h--;
			}
		if ( (strlen($group_web) < 1) and (strlen($group_web_vars) > 0) )
			{$group_web=$group_web_vars;}
		$RANKgroups_list .= "</select></td>\n";
		$RANKgroups_list .= "<td> &nbsp; <select size=1 name=GRADE_$group_id_values[$o] id=GRADE_$group_id_values[$o]>\n";
		$h="10";
		while ($h>=1)
			{
			$RANKgroups_list .= "<option value=\"$h\"";
			if ($h==$group_grade)
				{$RANKgroups_list .= " SELECTED";}
			$RANKgroups_list .= ">$h</option>";
			$h--;
			}
		if ( (strlen($group_web) < 1) and (strlen($group_web_vars) > 0) )
			{$group_web=$group_web_vars;}
		$RANKgroups_list .= "</select></td>\n";
		$RANKgroups_list .= "<td align=right> &nbsp; &nbsp; $calls_today</td>\n";
		$RANKgroups_list .= "<td> &nbsp; &nbsp; <input type=text size=25 maxlength=255 name=WEB_$group_id_values[$o] value=\"$group_web\"></td></tr>\n";
		$o++;
		$USER_inbound_calls_today = ($USER_inbound_calls_today + $calls_today);
		$USER_inbound_calls_today_filtered = ($USER_inbound_calls_today_filtered + $calls_today_filtered);
		}
	if (strlen($groups_value)>2) {$groups_value .= " -";}
	if (strlen($XFERgroups_value)>2) {$XFERgroups_value .= " -";}
	}
	##### END get inbound groups listing for checkboxes #####


##### BEGIN get campaigns listing for checkboxes #####
if ( ($ADD==211111) or ($ADD==311111) or ($ADD==411111) or ($ADD==511111) or ($ADD==611111) )
	{
	if ( ($ADD==211111) or ($ADD==311111) or ($ADD==511111) or ($ADD==611111) )
		{
		$stmt="SELECT allowed_campaigns,qc_allowed_campaigns,qc_allowed_inbound_groups,allowed_queue_groups from vicidial_user_groups where user_group='$user_group' $LOGadmin_viewable_groupsSQL;";
		$rslt=mysql_to_mysqli($stmt, $link);
		$row=mysqli_fetch_row($rslt);
		$allowed_campaigns =			$row[0];
		$qc_allowed_campaigns =			$row[1];
		$qc_allowed_inbound_groups =	$row[2];
		$allowed_queue_groups =			$row[3];
		$allowed_campaigns = preg_replace("/ -$/","",$allowed_campaigns);
		$campaigns = explode(" ", $allowed_campaigns);
		$qc_allowed_campaigns = preg_replace("/ -$/","",$qc_allowed_campaigns);
		$qc_campaigns = explode(" ", $qc_allowed_campaigns);
		$qc_allowed_inbound_groups = preg_replace("/ -$/","",$qc_allowed_inbound_groups);
		$qc_groups = explode(" ", $qc_allowed_inbound_groups);
		$allowed_queue_groups = preg_replace("/ -$/","",$allowed_queue_groups);
		$queue_groups = explode(" ", $allowed_queue_groups);
		}

	$campaigns_value='';
	if ( (preg_match('/\-ALL/i', $LOGallowed_campaigns)) )
		{$campaigns_list='<B><input type="checkbox" name="campaigns[]" value="-ALL-CAMPAIGNS-"';}
	$qc_campaigns_value='';
	$qc_campaigns_list='<B><input type="checkbox" name="qc_campaigns[]" value="-ALL-CAMPAIGNS-"';
	$qc_groups_value='';
	$qc_groups_list='<B><input type="checkbox" name="qc_groups[]" value="-ALL-GROUPS-"';
	$queue_groups_value='';
	$queue_groups_list='<B><input type="checkbox" name="queue_groups[]" value="-ALL-GROUPS-"';
	$p=0;
	while ($p<2000)
		{
		if (preg_match('/ALL\-CAMPAIGNS/i',$campaigns[$p])) 
			{
			if ( (preg_match('/\-ALL/i', $LOGallowed_campaigns)) )
				{
				$campaigns_list.=" CHECKED";
				$campaigns_value .= " -ALL-CAMPAIGNS-";
				}
			}
		if (preg_match('/ALL\-CAMPAIGNS/i',$qc_campaigns[$p])) 
			{
			$qc_campaigns_list.=" CHECKED";
			$qc_campaigns_value .= " -ALL-CAMPAIGNS-";
			}
		if (preg_match('/ALL\-GROUPS/i',$qc_groups[$p])) 
			{
			$qc_groups_list.=" CHECKED";
			$qc_groups_value .= " -ALL-GROUPS-";
			}
		if (preg_match('/ALL\-GROUPS/i',$queue_groups[$p])) 
			{
			$queue_groups_list.=" CHECKED";
			$queue_groups_value .= " -ALL-GROUPS-";
			}
		$p++;
		}
	if ( (preg_match('/\-ALL/i', $LOGallowed_campaigns)) )
		{$campaigns_list.="> "._QXZ("ALL-CAMPAIGNS - USERS CAN VIEW ANY CAMPAIGN")."</B><BR>\n";}
	$qc_campaigns_list.="> "._QXZ("ALL-CAMPAIGNS - USERS CAN QC ANY CAMPAIGN")."</B><BR>\n";
	$qc_groups_list.="> "._QXZ("ALL-GROUPS - USERS CAN QC ANY INBOUND GROUP")."</B><BR>\n";
	$queue_groups_list.="> "._QXZ("ALL-GROUPS - USERS CAN VIEW ANY QUEUE GROUP")."</B><BR>\n";

	$stmt="SELECT campaign_id,campaign_name from vicidial_campaigns $whereLOGallowed_campaignsSQL order by campaign_id;";
	$rslt=mysql_to_mysqli($stmt, $link);
	$campaigns_to_print = mysqli_num_rows($rslt);

	$o=0;
	while ($campaigns_to_print > $o)
		{
		$rowx=mysqli_fetch_row($rslt);
		$campaign_id_value = $rowx[0];
		$campaign_name_value = $rowx[1];
		$campaigns_list .= "<input type=\"checkbox\" name=\"campaigns[]\" value=\"$campaign_id_value\"";
		$qc_campaigns_list .= "<input type=\"checkbox\" name=\"qc_campaigns[]\" value=\"$campaign_id_value\"";
		$p=0;
		while ($p<1000)
			{
			if ( ($campaign_id_value === $campaigns[$p]) and (strlen($campaign_id_value) > 1) )
				{
			#	echo "<!--  X $p|$campaign_id_value|$campaigns[$p]| -->";
				$campaigns_list .= " CHECKED";
				$campaigns_value .= " $campaign_id_value";
				}
			if ($campaign_id_value === $qc_campaigns[$p]) 
				{
				$qc_campaigns_list .= " CHECKED";
				$qc_campaigns_value .= " $campaign_id_value";
				}
		#	echo "<!--  O $p|$campaign_id_value|$campaigns[$p]| -->";
			$p++;
			}
		$campaigns_list .= "> $campaign_id_value - $campaign_name_value<BR>\n";
		$qc_campaigns_list .= "> $campaign_id_value - $campaign_name_value<BR>\n";
		$o++;
		}

	$stmt="SELECT group_id,group_name from vicidial_inbound_groups where group_id NOT IN('AGENTDIRECT') $LOGadmin_viewable_groupsSQL order by group_id;";
	$rslt=mysql_to_mysqli($stmt, $link);
	$groups_to_print = mysqli_num_rows($rslt);

	$o=0;
	while ($groups_to_print > $o)
		{
		$rowx=mysqli_fetch_row($rslt);
		$group_id_value = $rowx[0];
		$group_name_value = $rowx[1];
		$qc_groups_list .= "<input type=\"checkbox\" name=\"qc_groups[]\" value=\"$group_id_value\"";
		$p=0;
		while ($p<2000)
			{
			if ( ($group_id_value === $qc_groups[$p]) and (strlen($group_id_value) > 1) )
				{
				$qc_groups_list .= " CHECKED";
				$qc_groups_value .= " $group_id_value";
				}
			$p++;
			}
		$qc_groups_list .= "> $group_id_value - $group_name_value<BR>\n";
		$o++;
		}

	$stmt="SELECT queue_group,queue_group_name from vicidial_queue_groups where queue_group NOT IN('') $LOGadmin_viewable_groupsSQL order by queue_group;";
	$rslt=mysql_to_mysqli($stmt, $link);
	$groups_to_print = mysqli_num_rows($rslt);

	$o=0;
	while ($groups_to_print > $o)
		{
		$rowx=mysqli_fetch_row($rslt);
		$group_id_value = $rowx[0];
		$group_name_value = $rowx[1];
		$queue_groups_list .= "<input type=\"checkbox\" name=\"queue_groups[]\" value=\"$group_id_value\"";
		$p=0;
		while ($p<2000)
			{
			if ( ($group_id_value === $queue_groups[$p]) and (strlen($group_id_value) > 1) )
				{
				$queue_groups_list .= " CHECKED";
				$queue_groups_value .= " $group_id_value";
				}
			$p++;
			}
		$queue_groups_list .= "> $group_id_value - $group_name_value<BR>\n";
		$o++;
		}

	if (strlen($campaigns_value)>2) {$campaigns_value .= " -";}
	if (strlen($qc_campaigns_value)>2) {$qc_campaigns_value .= " -";}
	if (strlen($qc_groups_value)>2) {$qc_groups_value .= " -";}
	if (strlen($queue_groups_value)>2) {$queue_groups_value .= " -";}
	}
	##### END get campaigns listing for checkboxes #####

##### BEGIN Queue Groups campaigns/in-groups listings #####
if ( ($ADD==298111111111) or ($ADD==398111111111) or ($ADD==498111111111) or ($ADD==598111111111) or ($ADD==698111111111) )
	{
	if ( ($ADD==298111111111) or ($ADD==398111111111) or ($ADD==598111111111) or ($ADD==698111111111) )
		{
		$stmt="SELECT queue_group,queue_group_name,active,user_group,included_campaigns,included_inbound_groups from vicidial_queue_groups where queue_group='$queue_group' $LOGadmin_viewable_groupsSQL;";
		$rslt=mysql_to_mysqli($stmt, $link);
		$row=mysqli_fetch_row($rslt);
		$included_campaigns =		$row[4];
		$included_inbound_groups =	$row[5];

		$qg_allowed_campaigns = preg_replace("/ -$/","",$included_campaigns);
		$qg_campaigns = explode(" ", $qg_allowed_campaigns);
		$qg_allowed_inbound_groups = preg_replace("/ -$/","",$included_inbound_groups);
		$qg_groups = explode(" ", $qg_allowed_inbound_groups);
		}
	if ($ADD==498111111111)
		{
		$qg_campaigns = $included_campaigns;
		$qg_groups = $included_inbound_groups;
		}

	$qg_campaigns_value='';
	$qg_campaigns_list='';
	$qg_groups_value='';
	$qg_groups_list='';

	$stmt="SELECT campaign_id,campaign_name from vicidial_campaigns $whereLOGallowed_campaignsSQL order by campaign_id;";
	$rslt=mysql_to_mysqli($stmt, $link);
	$campaigns_to_print = mysqli_num_rows($rslt);

	$o=0;
	while ($campaigns_to_print > $o)
		{
		$rowx=mysqli_fetch_row($rslt);
		$campaign_id_value = $rowx[0];
		$campaign_name_value = $rowx[1];
		$qg_campaigns_list .= "<input type=\"checkbox\" name=\"included_campaigns[]\" value=\"$campaign_id_value\"";
		$p=0;
		while ($p<1000)
			{
			if ($campaign_id_value === $qg_campaigns[$p]) 
				{
				$qg_campaigns_list .= " CHECKED";
				$qg_campaigns_value .= " $campaign_id_value";
				}
		#	echo "<!--  O $p|$campaign_id_value|$campaigns[$p]| -->";
			$p++;
			}
		$qg_campaigns_list .= "> $campaign_id_value - $campaign_name_value<BR>\n";
		$o++;
		}

	$stmt="SELECT group_id,group_name from vicidial_inbound_groups where group_id NOT IN('AGENTDIRECT') $LOGadmin_viewable_groupsSQL order by group_id;";
	$rslt=mysql_to_mysqli($stmt, $link);
	$groups_to_print = mysqli_num_rows($rslt);

	$o=0;
	while ($groups_to_print > $o)
		{
		$rowx=mysqli_fetch_row($rslt);
		$group_id_value = $rowx[0];
		$group_name_value = $rowx[1];
		$qg_groups_list .= "<input type=\"checkbox\" name=\"included_inbound_groups[]\" value=\"$group_id_value\"";
		$p=0;
		while ($p<2000)
			{
			if ( ($group_id_value === $qg_groups[$p]) and (strlen($group_id_value) > 1) )
				{
				$qg_groups_list .= " CHECKED";
				$qg_groups_value .= " $group_id_value";
				}
			$p++;
			}
		$qg_groups_list .= "> $group_id_value - $group_name_value<BR>\n";
		$o++;
		}

	if (strlen($qg_campaigns_value)>2) {$qg_campaigns_value .= " -";}
	if (strlen($qg_groups_value)>2) {$qg_groups_value .= " -";}
	}
##### END Queue Groups campaigns/in-groups listings #####


if ( (strlen($ADD)==11) or (strlen($ADD)>12) or ( ($ADD > 1299) and ($ADD < 9999) ) or ($ADD=='141111111111') or ($ADD=='140111111111') or ($ADD=='341111111111') or ($ADD=='311111111111111') or ( (strlen($ADD)>4) and ($ADD < 99998) ) or ($ADD==3) or (($ADD>20) and ($ADD<70)) or ($ADD=="4A") or ($ADD=="4B") or (strlen($ADD)==12) )
	{
	##### get server listing for dynamic pulldown 
	$stmt="SELECT server_ip,server_description,external_server_ip,active,active_asterisk_server from servers order by server_ip";
	$rsltx=mysql_to_mysqli($stmt, $link);
	$servers_to_print = mysqli_num_rows($rsltx);
	$servers_list='';

	$o=0;
	while ($servers_to_print > $o)
		{
		$rowx=mysqli_fetch_row($rsltx);
		$servers_list .= "<option value=\"$rowx[0]\">$rowx[0] - $rowx[1] - $rowx[2] - "._QXZ("$rowx[3]")." - "._QXZ("$rowx[4]")."</option>\n";
		$o++;
		}
	}

$NWB = "<IMG SRC=\"help.png\" onClick=\"FillAndShowHelpDiv(event, '";
$NWE = "')\" WIDTH=20 HEIGHT=20 BORDER=0 ALT=\"HELP\" ALIGN=TOP>";



if ($ADD==99999)
	{
	echo "<META HTTP-EQUIV=\"Content-Type\" CONTENT=\"text/html; charset=iso-8859-1\">\n";
	echo "<META HTTP-EQUIV=Refresh CONTENT=\"0; URL=./help.php\">\n";
	echo "</HEAD>\n";
	echo "<BODY BGCOLOR=#FFFFFF marginheight=0 marginwidth=0 leftmargin=0 topmargin=0>\n";
	echo "<a href=\"./help.php\">"._QXZ("click here to continue").". . .</a>\n";
	exit;
	}


######################################################################################################
######################################################################################################
#######   7 series, filter count preview and script preview
######################################################################################################
######################################################################################################




######################
# ADD=73 view dialable leads from a filter and a campaign
######################
if ($ADD==73)
	{
	if ($LOGmodify_campaigns==1)
		{
		echo "</head>\n";
		echo "<BODY BGCOLOR=white marginheight=0 marginwidth=0 leftmargin=0 topmargin=0>\n";
		echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

		$stmt="SELECT dial_statuses,local_call_time,lead_filter_id,drop_lockout_time,call_count_limit from vicidial_campaigns where campaign_id='$campaign_id' $LOGallowed_campaignsSQL;";
		$rslt=mysql_to_mysqli($stmt, $link);
		$row=mysqli_fetch_row($rslt);
		$dial_statuses =		$row[0];
		$local_call_time =		$row[1];
		$drop_lockout_time =	$row[3];
		$call_count_limit =		$row[4];
		if ($lead_filter_id=='')
			{
			$lead_filter_id =	$row[2];
			if ($lead_filter_id=='') 
				{
				$lead_filter_id='NONE';
				}
			}

		$stmt="SELECT list_id,active,list_name from vicidial_lists where campaign_id='$campaign_id' $LOGallowed_campaignsSQL;";
		$rslt=mysql_to_mysqli($stmt, $link);
		$lists_to_print = mysqli_num_rows($rslt);
		$camp_lists='';
		$o=0;
		while ($lists_to_print > $o) 
			{
			$rowx=mysqli_fetch_row($rslt);
			$o++;
			if (preg_match('/Y/', $rowx[1])) {$camp_lists .= "'$rowx[0]',";}
			}
		$camp_lists = preg_replace('/.$/i','',$camp_lists);

		$filterSQL = $filtersql_list[$lead_filter_id];
		$filterSQL = preg_replace("/\\\\/","",$filterSQL);
		$filterSQL = preg_replace('/^and|and$|^or|or$/i', '',$filterSQL);
		if (strlen($filterSQL)>4)
			{$fSQL = "and ($filterSQL)";}
		else
			{$fSQL = '';}


		echo "<BR><BR>\n";
		echo "<B>"._QXZ("Show Dialable Leads Count")."</B> -<BR><BR>\n";
		echo "<B>"._QXZ("CAMPAIGN").":</B> $campaign_id<BR>\n";
		echo "<B>"._QXZ("LISTS").":</B> $camp_lists<BR>\n";
		echo "<B>"._QXZ("STATUSES").":</B> $dial_statuses<BR>\n";
		echo "<B>"._QXZ("FILTER").":</B> $lead_filter_id<BR>\n";
		echo "<B>"._QXZ("CALL LIMIT").":</B> $call_count_limit\n";
		echo "<B>"._QXZ("CALL TIME").":</B> $local_call_time<BR><BR>\n";
		echo "<B>"._QXZ("With Filter").":</B>\n";
		echo "<BR><BR>\n";

		### call function to calculate and print dialable leads
		$single_status=0;
		$only_return=0;
		dialable_leads($DB,$link,$local_call_time,$dial_statuses,$camp_lists,$drop_lockout_time,$call_count_limit,$single_status,$fSQL,$only_return);

		echo "<BR><BR>\n";
		echo "<B>"._QXZ("Without Filter").":</B>\n";
		echo "<BR><BR>\n";

		dialable_leads($DB,$link,$local_call_time,$dial_statuses,$camp_lists,$drop_lockout_time,$call_count_limit,$single_status,'',$only_return);

		echo "<BR><BR>\n";
		echo "</BODY></HTML>\n";

		exit;
		}
	else
		{
		echo _QXZ("You do not have permission to view this page")."\n";
		exit;
		}
	}


######################
# ADD=7111111 view sample script with test variables
######################
if ($ADD==7111111)
	{
	##### TEST VARIABLES #####
	$vendor_lead_code = 'VENDOR:LEAD;CODE';
	$list_id = 'LISTID';
	$list_name = 'LISTNAME';
	$list_description = 'LISTDESCRIPTION';
	$gmt_offset_now = 'GMTOFFSET';
	$phone_code = '1';
	$phone_number = '7275551212';
	$title = 'Mr.';
	$first_name = 'JOHN';
	$middle_initial = 'Q';
	$last_name = 'PUBLIC';
	$address1 = '1234 Main St.';
	$address2 = 'Apt. 3';
	$address3 = 'ADDRESS3';
	$city = 'CHICAGO';
	$state = 'IL';
	$province = 'PROVINCE';
	$postal_code = '33760';
	$country_code = 'USA';
	$gender = 'M';
	$date_of_birth = '1970-01-01';
	$alt_phone = '3125551111';
	$email = 'test@test.com';
	$security_phrase = 'SECUTIRY';
	$comments = 'COMMENTS FIELD';
	$RGfullname = 'JOE AGENT';
	$RGagent_email = 'Joe@agent.com';
	$RGuser = '6666';
	$RGlead_id = '1234';
	$RGcampaign = 'TESTCAMP';
	$RGphone_login = 'gs102';
	$RGgroup = 'TESTCAMP';
	$RGchannel_group = 'TESTCAMP';
	$RGSQLdate = date("Y-m-d H:i:s");
	$RGepoch = date("U");
	$RGuniqueid = '1163095830.4136';
	$RGcustomer_zap_channel = 'Zap/1-1';
	$RGserver_ip = '10.10.10.15';
	$RGSIPexten = 'SIP/gs102';
	$RGsession_id = '8600051';
	$RGdialed_number = '3125551111';
	$RGdialed_label = 'ALT';
	$RGrank = '99';
	$RGowner = '6666';
	$RGcamp_script = 'TESTSCRIPT';
	$RGin_script = '';
	$script_width = '600';
	$script_height = '400';
	$recording_filename = '20091204-1639_6666_7275551212';
	$recording_id = '1235';
	$user_custom_one = 'custom one';
	$user_custom_two = 'custom two';
	$user_custom_three = 'custom three';
	$user_custom_four = 'custom four';
	$user_custom_five = 'custom five';
	$preset_number_a = 'preset_a';
	$preset_number_b = 'preset_b';
	$preset_number_c = 'preset_c';
	$preset_number_d = 'preset_d';
	$preset_number_e = 'preset_e';
	$preset_number_f = 'preset_f';
	$preset_dtmf_a = 'preset_dtmf_a';
	$preset_dtmf_b = 'preset_dtmf_b';
	$did_id = 'did_id';
	$did_extension = 'did_extension';
	$did_pattern = 'did_pattern';
	$did_description = 'did_description';
	$closecallid = 'closecallid';
	$xfercallid = 'xfercallid';
	$agent_log_id = 'agent_log_id';
	$entry_list_id = 'entry_list_id';
	$call_id = 'call_id';
	$user_group = 'user_group';
	$called_count = '2';

	echo "</head>\n";
	echo "<BODY BGCOLOR=white marginheight=0 marginwidth=0 leftmargin=0 topmargin=0>\n";
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	$stmt="SELECT script_id,script_name,script_comments,script_text,active,script_color from vicidial_scripts where script_id='$script_id' $LOGadmin_viewable_groupsSQL;";
	$rslt=mysql_to_mysqli($stmt, $link);
	$row=mysqli_fetch_row($rslt);
	$script_name =		$row[1];
	$script_text =		stripslashes($row[3]);
	$script_color =		$row[5];

	if (preg_match('/iframe src/i',$script_text))
		{
		$vendor_lead_code = preg_replace('/\s/i', '+',$vendor_lead_code);
		$list_id = preg_replace('/\s/i', '+',$list_id);
		$list_name = preg_replace('/\s/i', '+',$list_name);
		$list_description = preg_replace('/\s/i', '+',$list_description);
		$gmt_offset_now = preg_replace('/\s/i', '+',$gmt_offset_now);
		$phone_code = preg_replace('/\s/i', '+',$phone_code);
		$phone_number = preg_replace('/\s/i', '+',$phone_number);
		$title = preg_replace('/\s/i', '+',$title);
		$first_name = preg_replace('/\s/i', '+',$first_name);
		$middle_initial = preg_replace('/\s/i', '+',$middle_initial);
		$last_name = preg_replace('/\s/i', '+',$last_name);
		$address1 = preg_replace('/\s/i', '+',$address1);
		$address2 = preg_replace('/\s/i', '+',$address2);
		$address3 = preg_replace('/\s/i', '+',$address2);
		$city = preg_replace('/\s/i', '+',$city);
		$state = preg_replace('/\s/i', '+',$state);
		$province = preg_replace('/\s/i', '+',$province);
		$postal_code = preg_replace('/\s/i', '+',$postal_code);
		$country_code = preg_replace('/\s/i', '+',$country_code);
		$gender = preg_replace('/\s/i', '+',$gender);
		$date_of_birth = preg_replace('/\s/i', '+',$date_of_birth);
		$alt_phone = preg_replace('/\s/i', '+',$alt_phone);
		$email = preg_replace('/\s/i', '+',$email);
		$security_phrase = preg_replace('/\s/i', '+',$security_phrase);
		$comments = preg_replace('/\s/i', '+',$comments);
		$source_id = preg_replace('/\s/i', '+',$source_id);
		$RGfullname = preg_replace('/\s/i', '+',$RGfullname);
		$RGagent_email = preg_replace('/\s/i', '+',$RGagent_email);
		$RGuser = preg_replace('/\s/i', '+',$RGuser);
		$RGlead_id = preg_replace('/\s/i', '+',$RGlead_id);
		$RGcampaign = preg_replace('/\s/i', '+',$RGcampaign);
		$RGphone_login = preg_replace('/\s/i', '+',$RGphone_login);
		$RGgroup = preg_replace('/\s/i', '+',$RGgroup);
		$RGchannel_group = preg_replace('/\s/i', '+',$RGchannel_group);
		$RGSQLdate = preg_replace('/\s/i', '+',$RGSQLdate);
		$RGepoch = preg_replace('/\s/i', '+',$RGepoch);
		$RGuniqueid = preg_replace('/\s/i', '+',$RGuniqueid);
		$RGcustomer_zap_channel = preg_replace('/\s/i', '+',$RGcustomer_zap_channel);
		$RGserver_ip = preg_replace('/\s/i', '+',$RGserver_ip);
		$RGSIPexten = preg_replace('/\s/i', '+',$RGSIPexten);
		$RGsession_id = preg_replace('/\s/i', '+',$RGsession_id);
		$RGdialed_number = preg_replace('/\s/i', '+',$RGdialed_number);
		$RGdialed_label = preg_replace('/\s/i', '+',$RGdialed_label);
		$RGrank = preg_replace('/\s/i', '+',$RGrank);
		$RGowner = preg_replace('/\s/i', '+',$RGowner);
		$RGcamp_script = preg_replace('/\s/i', '+',$RGcamp_script);
		$RGin_script = preg_replace('/\s/i', '+',$RGin_script);
		$script_width = preg_replace('/\s/i', '+',$script_width);
		$script_height = preg_replace('/\s/i', '+',$script_height);
		$recording_filename = preg_replace('/\s/i', '+',$recording_filename);
		$recording_id = preg_replace('/\s/i', '+',$recording_id);
		$user_custom_one = preg_replace('/\s/i', '+',$user_custom_one);
		$user_custom_two = preg_replace('/\s/i', '+',$user_custom_two);
		$user_custom_three = preg_replace('/\s/i', '+',$user_custom_three);
		$user_custom_four = preg_replace('/\s/i', '+',$user_custom_four);
		$user_custom_five = preg_replace('/\s/i', '+',$user_custom_five);
		$preset_number_a = preg_replace('/\s/i', '+',$preset_number_a);
		$preset_number_b = preg_replace('/\s/i', '+',$preset_number_b);
		$preset_number_c = preg_replace('/\s/i', '+',$preset_number_c);
		$preset_number_d = preg_replace('/\s/i', '+',$preset_number_d);
		$preset_number_e = preg_replace('/\s/i', '+',$preset_number_e);
		$preset_number_f = preg_replace('/\s/i', '+',$preset_number_f);
		$preset_dtmf_a = preg_replace('/\s/i', '+',$preset_dtmf_a);
		$preset_dtmf_b = preg_replace('/\s/i', '+',$preset_dtmf_b);
		$did_description = preg_replace('/\s/i', '+',$did_description);
		}

	$script_text = preg_replace('/\-\-A\-\-vendor_lead_code\-\-B\-\-/i', "$vendor_lead_code",$script_text);
	$script_text = preg_replace('/\-\-A\-\-list_id\-\-B\-\-/i', "$list_id",$script_text);
	$script_text = preg_replace('/\-\-A\-\-list_name\-\-B\-\-/i', "$list_name",$script_text);
	$script_text = preg_replace('/\-\-A\-\-list_description\-\-B\-\-/i', "$list_description",$script_text);
	$script_text = preg_replace('/\-\-A\-\-gmt_offset_now\-\-B\-\-/i', "$gmt_offset_now",$script_text);
	$script_text = preg_replace('/\-\-A\-\-phone_code\-\-B\-\-/i', "$phone_code",$script_text);
	$script_text = preg_replace('/\-\-A\-\-phone_number\-\-B\-\-/i', "$phone_number",$script_text);
	$script_text = preg_replace('/\-\-A\-\-title\-\-B\-\-/i', "$title",$script_text);
	$script_text = preg_replace('/\-\-A\-\-first_name\-\-B\-\-/i', "$first_name",$script_text);
	$script_text = preg_replace('/\-\-A\-\-middle_initial\-\-B\-\-/i', "$middle_initial",$script_text);
	$script_text = preg_replace('/\-\-A\-\-last_name\-\-B\-\-/i', "$last_name",$script_text);
	$script_text = preg_replace('/\-\-A\-\-address1\-\-B\-\-/i', "$address1",$script_text);
	$script_text = preg_replace('/\-\-A\-\-address2\-\-B\-\-/i', "$address2",$script_text);
	$script_text = preg_replace('/\-\-A\-\-address3\-\-B\-\-/i', "$address3",$script_text);
	$script_text = preg_replace('/\-\-A\-\-city\-\-B\-\-/i', "$city",$script_text);
	$script_text = preg_replace('/\-\-A\-\-state\-\-B\-\-/i', "$state",$script_text);
	$script_text = preg_replace('/\-\-A\-\-province\-\-B\-\-/i', "$province",$script_text);
	$script_text = preg_replace('/\-\-A\-\-postal_code\-\-B\-\-/i', "$postal_code",$script_text);
	$script_text = preg_replace('/\-\-A\-\-country_code\-\-B\-\-/i', "$country_code",$script_text);
	$script_text = preg_replace('/\-\-A\-\-gender\-\-B\-\-/i', "$gender",$script_text);
	$script_text = preg_replace('/\-\-A\-\-date_of_birth\-\-B\-\-/i', "$date_of_birth",$script_text);
	$script_text = preg_replace('/\-\-A\-\-alt_phone\-\-B\-\-/i', "$alt_phone",$script_text);
	$script_text = preg_replace('/\-\-A\-\-email\-\-B\-\-/i', "$email",$script_text);
	$script_text = preg_replace('/\-\-A\-\-security_phrase\-\-B\-\-/i', "$security_phrase",$script_text);
	$script_text = preg_replace('/\-\-A\-\-comments\-\-B\-\-/i', "$comments",$script_text);
	$script_text = preg_replace('/\-\-A\-\-source_id\-\-B\-\-/i', "$source_id",$script_text);
	$script_text = preg_replace('/\-\-A\-\-fullname\-\-B\-\-/i', "$RGfullname",$script_text);
	$script_text = preg_replace('/\-\-A\-\-agent_email\-\-B\-\-/i', "$RGagent_email",$script_text);
	$script_text = preg_replace('/\-\-A\-\-fronter\-\-B\-\-/i', "$RGuser",$script_text);
	$script_text = preg_replace('/\-\-A\-\-user\-\-B\-\-/i', "$RGuser",$script_text);
	$script_text = preg_replace('/\-\-A\-\-lead_id\-\-B\-\-/i', "$RGlead_id",$script_text);
	$script_text = preg_replace('/\-\-A\-\-campaign\-\-B\-\-/i', "$RGcampaign",$script_text);
	$script_text = preg_replace('/\-\-A\-\-phone_login\-\-B\-\-/i', "$RGphone_login",$script_text);
	$script_text = preg_replace('/\-\-A\-\-group\-\-B\-\-/i', "$RGgroup",$script_text);
	$script_text = preg_replace('/\-\-A\-\-channel_group\-\-B\-\-/i', "$RGchannel_group",$script_text);
	$script_text = preg_replace('/\-\-A\-\-SQLdate\-\-B\-\-/i', "$RGSQLdate",$script_text);
	$script_text = preg_replace('/\-\-A\-\-epoch\-\-B\-\-/i', "$RGepoch",$script_text);
	$script_text = preg_replace('/\-\-A\-\-uniqueid\-\-B\-\-/i', "$RGuniqueid",$script_text);
	$script_text = preg_replace('/\-\-A\-\-customer_zap_channel\-\-B\-\-/i', "$RGcustomer_zap_channel",$script_text);
	$script_text = preg_replace('/\-\-A\-\-server_ip\-\-B\-\-/i', "$RGserver_ip",$script_text);
	$script_text = preg_replace('/\-\-A\-\-SIPexten\-\-B\-\-/i', "$RGSIPexten",$script_text);
	$script_text = preg_replace('/\-\-A\-\-session_id\-\-B\-\-/i', "$RGsession_id",$script_text);
	$script_text = preg_replace('/\-\-A\-\-dialed_number\-\-B\-\-/i', "$RGdialed_number",$script_text);
	$script_text = preg_replace('/\-\-A\-\-dialed_label\-\-B\-\-/i', "$RGdialed_label",$script_text);
	$script_text = preg_replace('/\-\-A\-\-rank\-\-B\-\-/i', "$RGrank",$script_text);
	$script_text = preg_replace('/\-\-A\-\-owner\-\-B\-\-/i', "$RGowner",$script_text);
	$script_text = preg_replace('/\-\-A\-\-camp_script\-\-B\-\-/i', "$RGcamp_script",$script_text);
	$script_text = preg_replace('/\-\-A\-\-in_script\-\-B\-\-/i', "$RGin_script",$script_text);
	$script_text = preg_replace('/\-\-A\-\-script_width\-\-B\-\-/i', "$script_width",$script_text);
	$script_text = preg_replace('/\-\-A\-\-script_height\-\-B\-\-/i', "$script_height",$script_text);
	$script_text = preg_replace('/\-\-A\-\-recording_filename\-\-B\-\-/i', "$recording_filename",$script_text);
	$script_text = preg_replace('/\-\-A\-\-recording_id\-\-B\-\-/i', "$recording_id",$script_text);
	$script_text = preg_replace('/\-\-A\-\-user_custom_one\-\-B\-\-/i', "$user_custom_one",$script_text);
	$script_text = preg_replace('/\-\-A\-\-user_custom_two\-\-B\-\-/i', "$user_custom_two",$script_text);
	$script_text = preg_replace('/\-\-A\-\-user_custom_three\-\-B\-\-/i', "$user_custom_three",$script_text);
	$script_text = preg_replace('/\-\-A\-\-user_custom_four\-\-B\-\-/i', "$user_custom_four",$script_text);
	$script_text = preg_replace('/\-\-A\-\-user_custom_five\-\-B\-\-/i', "$user_custom_five",$script_text);
	$script_text = preg_replace('/\-\-A\-\-preset_number_a\-\-B\-\-/i', "$preset_number_a",$script_text);
	$script_text = preg_replace('/\-\-A\-\-preset_number_b\-\-B\-\-/i', "$preset_number_b",$script_text);
	$script_text = preg_replace('/\-\-A\-\-preset_number_c\-\-B\-\-/i', "$preset_number_c",$script_text);
	$script_text = preg_replace('/\-\-A\-\-preset_number_d\-\-B\-\-/i', "$preset_number_d",$script_text);
	$script_text = preg_replace('/\-\-A\-\-preset_number_e\-\-B\-\-/i', "$preset_number_e",$script_text);
	$script_text = preg_replace('/\-\-A\-\-preset_number_f\-\-B\-\-/i', "$preset_number_f",$script_text);
	$script_text = preg_replace('/\-\-A\-\-preset_dtmf_a\-\-B\-\-/i', "$preset_dtmf_a",$script_text);
	$script_text = preg_replace('/\-\-A\-\-preset_dtmf_b\-\-B\-\-/i', "$preset_dtmf_b",$script_text);
	$script_text = preg_replace('/\-\-A\-\-did_id\-\-B\-\-/i', "$did_id",$script_text);
	$script_text = preg_replace('/\-\-A\-\-did_extension\-\-B\-\-/i', "$RGdid_extension",$script_text);
	$script_text = preg_replace('/\-\-A\-\-did_pattern\-\-B\-\-/i', "$did_pattern",$script_text);
	$script_text = preg_replace('/\-\-A\-\-did_description\-\-B\-\-/i', "$RGdid_description",$script_text);
	$script_text = preg_replace('/\-\-A\-\-closecallid\-\-B\-\-/i', "$closecallid",$script_text);
	$script_text = preg_replace('/\-\-A\-\-xfercallid\-\-B\-\-/i', "$xfercallid",$script_text);
	$script_text = preg_replace('/\-\-A\-\-agent_log_id\-\-B\-\-/i', "$agent_log_id",$script_text);
	$script_text = preg_replace('/\-\-A\-\-entry_list_id\-\-B\-\-/i', "$entry_list_id",$script_text);
	$script_text = preg_replace('/\-\-A\-\-call_id\-\-B\-\-/i', "$call_id",$script_text);
	$script_text = preg_replace('/\-\-A\-\-user_group\-\-B\-\-/i', "$user_group",$script_text);
	$script_text = preg_replace('/\-\-A\-\-called_count\-\-B\-\-/i', "$called_count",$script_text);
	$script_text = preg_replace('/\n/i', "<BR>",$script_text);


	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	echo _QXZ("Preview Script").": $script_id<BR>\n";
	echo "<TABLE WIDTH=600";
	if (strlen($script_color)>1) {echo " bgcolor=\"$script_color\"";}
	echo "><TR><TD>\n";
	echo "<center><B>$script_name</B><BR></center>\n";
	echo "$script_text\n";
	echo "</TD></TR></TABLE></center>\n";

	echo "</BODY></HTML>\n";

	exit;
	}

$no_title=1;

$ADMIN=$PHP_SELF;
//aquitoy
require("admin_header.php");

if ( ($SSadmin_modify_refresh > 1) and (preg_match("/^3|^4/",$ADD)) )
	{
	echo "<span id=refresh_countdown></span><BR>";
	}


######################################################################################################
######################################################################################################
#######   1 series, ADD NEW forms for inserting new records into the database
######################################################################################################
######################################################################################################


######################
# ADD=1 display the ADD NEW USER FORM SCREEN
######################
if ($ADD=="1")
	{
	if ($LOGmodify_users==1)
		{
		##### BEGIN ID override optional section, if enabled it increments user by 1 ignoring entered value #####
		$stmt = "SELECT count(*) FROM vicidial_override_ids where id_table='vicidial_users' and active='1';";
		$rslt=mysql_to_mysqli($stmt, $link);
		$voi_ct = mysqli_num_rows($rslt);
		if ($voi_ct > 0)
			{
			$row=mysqli_fetch_row($rslt);
			$voi_count = "$row[0]";
			}
		##### END ID override optional section #####

		echo "<TABLE><TR><TD>\n";
		echo "<img src=\"images/icon_black_users.png\" alt=\"Users\" width=42 height=42> <FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

		echo "<br>"._QXZ("ADD A NEW USER")."<form action=$PHP_SELF method=POST name=userform id=userform>\n";
		echo "<input type=hidden name=ADD value=2>\n";
		echo "<input type=hidden name=user_toggle id=user_toggle value=0>\n";
		echo "<center><TABLE width=$section_width cellspacing=3>\n";
		if ($voi_count > 0)
			{
			echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("User Number").": </td><td align=left>"._QXZ("Auto-Generated")." <input type=hidden name=user id=user value=\"99999\">$NWB#users-user$NWE</td></tr>\n";
			}
		else
			{
			echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("User Number").": </td><td align=left><input type=text name=user id=user size=20 maxlength=20> <input style='background-color:#$SSbutton_color' type=button name=auto_user value=\""._QXZ("AUTO-GENERATE")."\" onClick=\"user_auto()\"> $NWB#users-user$NWE</td></tr>\n";
			}

		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Password").": </td><td align=left style=\"display:table-cell; vertical-align:middle;\" NOWRAP><input type=text id=reg_pass name=pass size=50 maxlength=100 onkeyup=\"return pwdChanged('reg_pass','reg_pass_img','pass_length','$SSrequire_password_length');\">$NWB#users-pass$NWE &nbsp; &nbsp; <font size=1> "._QXZ("Strength").":</font> <IMG id=reg_pass_img src='images/pixel.gif' style=\"vertical-align:middle;\" onLoad=\"return pwdChanged('reg_pass','reg_pass_img','pass_length','$SSrequire_password_length');\"> &nbsp; <font size=1>"._QXZ("Length").": <span id=pass_length name=pass_length>0</span></font></td></tr>\n";

		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Full Name").": </td><td align=left><input type=text name=full_name size=20 maxlength=100>$NWB#users-full_name$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("User Level").": </td><td align=left><select size=1 name=user_level>";
		$h=1;
		$count_user_level=$LOGuser_level;
		if ( ($LOGmodify_same_user_level < 1) and ($LOGuser_level > 8) )
			{$count_user_level=($LOGuser_level - 1);}
		while ($h<=$count_user_level)
			{
			echo "<option>$h</option>";
			$h++;
			}
		echo "</select>$NWB#users-user_level$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("User Group").": </td><td align=left><select size=1 name=user_group>\n";
		echo "$UUgroups_list";
		echo "</select>$NWB#users-user_group$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Phone Login").": </td><td align=left><input type=text name=phone_login size=20 maxlength=20>$NWB#users-phone_login$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Phone Pass").": </td><td align=left><input type=text name=phone_pass size=20 maxlength=20>$NWB#users-phone_pass$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=center colspan=2><input style='background-color:#$SSbutton_color' type=button name=SUBMIT value='"._QXZ("SUBMIT")."' onClick=\"user_submit()\"></td></tr>\n";
		echo "</TABLE></center>\n";
		}
	else
		{
		echo _QXZ("You do not have permission to view this page")."\n";
		exit;
		}
	}


######################
# ADD=1A display the COPY USER FORM SCREEN
######################
if ($ADD=="1A")
	{
	if ($LOGmodify_users==1)
		{
		##### BEGIN ID override optional section, if enabled it increments user by 1 ignoring entered value #####
		$stmt = "SELECT count(*) FROM vicidial_override_ids where id_table='vicidial_users' and active='1';";
		$rslt=mysql_to_mysqli($stmt, $link);
		$voi_ct = mysqli_num_rows($rslt);
		if ($voi_ct > 0)
			{
			$row=mysqli_fetch_row($rslt);
			$voi_count = "$row[0]";
			}
		##### END ID override optional section #####




		echo '<section class="content">';
		echo '<div class="container-fluid">';
			echo '<div class="row">';
				echo '<div class="col-12 text-center">';
					echo '<i class="fa fa-users fa-lg" aria-hidden="true"></i>';
					echo '<h2>'._QXZ("COPY USER").'</h2>';
				echo '</div>';
			echo '</div>';
			echo '<div class="row">';
				echo '<div class="col-12">';
					echo '<table class="table table-bordered">';
						echo '<tbody>';
							if ($voi_count > 0){
								echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("New User Number").": </td><td align=left>"._QXZ("Auto-Generated")." <input type=hidden name=user id=user value=\"99999\">$NWB#users-user$NWE</td></tr>\n";
							}
							else{
							echo '<tr>';
								echo '<td>';
								echo '<span align=right>'._QXZ("New User Number").'</span></td>';
								echo '<td align=left><span';
								echo '<div class="input-group mb-3">';
								echo '<input type="text" class="form-control" placeholder="Recipient username" aria-label="Recipient username" aria-describedby="basic-addon2" size=20 maxlength=20>';
									echo '<div class="input-group-append">';
										echo '<button class="btn btn-primary btn-sm" type="button">'._QXZ("AUTO-GENERATE").'</button>';
									echo '</div>';
								echo '</div>';
								echo '</span>';
								echo '</td>';
							echo '</tr>';
							}
							
							echo '<tr>';
								echo '<td><span class="p-2" align=right>'._QXZ("Password").'</span></td>';
								echo '<td><span class="p-2">';
								echo '<div class="input-group mb-3">';
									echo '<input type="text" class="form-control">';
									echo '<div class="input-group-append">';
										echo '<span class="input-group-text"><i class="fas fa-check"></i></span>';
									echo '</div>';
								echo '</div>';
								echo '</span></td>';
							echo '</tr>';
							echo '<tr>';
								echo '<td><span class="p-2" align=right></span>'._QXZ("Full Name").'</td>';
								echo '<td><span class="p-2">';
								echo '<div class="input-group mb-3">';
									echo '<input type="text" class="form-control">';
									echo '<div class="input-group-append">';
										echo '<span class="input-group-text"><i class="fas fa-check"></i></span>';
									echo '</div>';
								echo '</div>';
								echo '</span></td>';
							echo '</tr>';
							echo '<tr>';
								echo '<td><span class="p-2" align=right>'._QXZ("Source User").'</span></td>';
								echo '<td><span class="p-2">';
								echo '<select class="form-control">';
									echo '<option>option 1</option>';
									echo '<option>option 2</option>';
									echo '<option>option 3</option>';
									echo '<option>option 4</option>';
									echo '<option>option 5</option>';
								echo '</select>';
								echo '</span></td>';
							echo '</tr>';
						echo '</tbody>';
					echo '</table>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
	echo '</section>';

		echo "<TABLE><TR><TD>\n";
		echo "<img src=\"images/icon_black_users.png\" alt=\"Users\" width=42 height=42> <FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

		echo "<br>"._QXZ("COPY USER")."<form action=$PHP_SELF method=POST name=userform id=userform>\n";
		echo "<input type=hidden name=ADD value=2A>\n";
		echo "<input type=hidden name=user_toggle id=user_toggle value=0>\n";
		echo "<center><TABLE width=800 cellspacing=3>\n";
		if ($voi_count > 0)
			{
			echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("New User Number").": </td><td align=left>"._QXZ("Auto-Generated")." <input type=hidden name=user id=user value=\"99999\">$NWB#users-user$NWE</td></tr>\n";
			}
		else
			{
			echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("New User Number").": </td><td align=left><input type=text name=user id=user size=20 maxlength=20> <input style='background-color:#$SSbutton_color' type=button name=auto_user value=\""._QXZ("AUTO-GENERATE")."\" onClick=\"user_auto()\"> $NWB#users-user$NWE</td></tr>\n";
			}

		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Password").": </td><td align=left style=\"display:table-cell; vertical-align:middle;\" NOWRAP><input type=text id=reg_pass name=pass size=50 maxlength=100 onkeyup=\"return pwdChanged('reg_pass','reg_pass_img','pass_length','$SSrequire_password_length');\">$NWB#users-pass$NWE &nbsp; &nbsp; <font size=1>"._QXZ("Strength").":</font> <IMG id=reg_pass_img src='images/pixel.gif' style=\"vertical-align:middle;\" onLoad=\"return pwdChanged('reg_pass','reg_pass_img','pass_length','$SSrequire_password_length');\"> &nbsp; <font size=1> "._QXZ("Length").": <span id=pass_length name=pass_length>0</span></font></td></tr>\n";

		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Full Name").": </td><td align=left><input type=text name=full_name size=20 maxlength=100>$NWB#users-full_name$NWE</td></tr>\n";

		if ($LOGuser_level==9) {$levelMAX=10;}
		else {$levelMAX=$LOGuser_level;}

		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Source User").": </td><td align=left><select size=1 name=source_user_id>\n";

		$stmt="SELECT user,full_name from vicidial_users where user_level < $levelMAX $LOGadmin_viewable_groupsSQL order by full_name;";
		$rslt=mysql_to_mysqli($stmt, $link);
		$Uusers_to_print = mysqli_num_rows($rslt);
		$Uusers_list='';

		$o=0;
		while ($Uusers_to_print > $o) 
			{
			$rowx=mysqli_fetch_row($rslt);
			$Uusers_list .= "<option value=\"$rowx[0]\">$rowx[0] - $rowx[1]</option>\n";
			$o++;
			}
		echo "$Uusers_list";
		echo "</select>$NWB#users-user$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=center colspan=2><input style='background-color:#$SSbutton_color' type=button name=SUBMIT value='"._QXZ("SUBMIT")."' onClick=\"user_submit()\"></td></tr>\n";
		echo "</TABLE></center>\n";
		}
	else
		{
		echo _QXZ("You do not have permission to view this page")."\n";
		exit;
		}
	}


######################
# ADD=11 display the ADD NEW CAMPAIGN FORM SCREEN
######################
if ($ADD==11)
	{
	if ($LOGmodify_campaigns==1)
		{
		##### BEGIN ID override optional section, if enabled it increments user by 1 ignoring entered value #####
		$stmt = "SELECT count(*) FROM vicidial_override_ids where id_table='vicidial_campaigns' and active='1';";
		$rslt=mysql_to_mysqli($stmt, $link);
		$voi_ct = mysqli_num_rows($rslt);
		if ($voi_ct > 0)
			{
			$row=mysqli_fetch_row($rslt);
			$voi_count = "$row[0]";
			}
		##### END ID override optional section #####

		echo "<TABLE><TR><TD>\n";
		echo "<img src=\"images/icon_black_campaigns.png\" alt=\"Campaigns\" width=42 height=42> <FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

		echo "<br>"._QXZ("ADD A NEW CAMPAIGN")."<form action=$PHP_SELF method=POST>\n";
		echo "<input type=hidden name=ADD value=21>\n";
		echo "<input type=hidden name=park_ext value=''>\n";
		echo "<center><TABLE width=$section_width cellspacing=3>\n";
		if ($voi_count > 0)
			{
			echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Campaign ID").": </td><td align=left>"._QXZ("Auto-Generated")." $NWB#campaigns-campaign_id$NWE</td></tr>\n";
			}
		else
			{
			echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Campaign ID").": </td><td align=left><input type=text name=campaign_id size=10 maxlength=8>$NWB#campaigns-campaign_id$NWE</td></tr>\n";
			}
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Campaign Name").": </td><td align=left><input type=text name=campaign_name size=40 maxlength=40>$NWB#campaigns-campaign_name$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Campaign Description").": </td><td align=left><input type=text name=campaign_description size=40 maxlength=255>$NWB#campaigns-campaign_description$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Admin User Group").": </td><td align=left><select size=1 name=user_group>\n";
		echo "$UUgroups_list";
		echo "<option SELECTED value=\"---ALL---\">"._QXZ("All Admin User Groups")."</option>\n";
		echo "</select>$NWB#campaigns-user_group$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Active").": </td><td align=left><select size=1 name=active><option value='Y'>"._QXZ("Y")."</option><option value='N'>"._QXZ("N")."</option></select>$NWB#campaigns-active$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Park Music-on-Hold").": </td><td align=left><input type=text name=park_file_name id=park_file_name size=20 maxlength=100> <a href=\"javascript:launch_moh_chooser('park_file_name','moh');\">"._QXZ("moh chooser")."</a> $NWB#campaigns-park_ext$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Web Form").": </td><td align=left><input type=text name=web_form_address size=70 maxlength=9999>$NWB#campaigns-web_form_address$NWE"; if ($SSenable_first_webform < 1) {echo " <font color=red><b>"._QXZ("DISABLED")."</b></font>";} echo "</td></tr>\n";
		if ($SSoutbound_autodial_active > 0)
			{
			echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Allow Closers").": </td><td align=left><select size=1 name=allow_closers><option value='Y'>"._QXZ("Y")."</option><option value='N'>"._QXZ("N")."</option></select>$NWB#campaigns-allow_closers$NWE</td></tr>\n";
			echo "<tr bgcolor=#$SSstd_row3_background><td align=right>"._QXZ("Minimum Hopper Level").": </td><td align=left><select size=1 name=hopper_level><option>1</option><option>5</option><option>10</option><option>20</option><option>50</option><option>100</option><option>200</option><option>500</option><option>1000</option><option>2000</option><option>3000</option><option>4000</option><option>5000</option></select>$NWB#campaigns-hopper_level$NWE</td></tr>\n";
			echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Auto Dial Level").": </td><td align=left><select size=1 name=auto_dial_level><option selected>1</option><option>0</option>\n";
			$adl=0;
			while($adl <= $SSauto_dial_limit)
				{
				if ($adl < 1)
					{$adl = ($adl + 1);}
				else
					{
					if ($adl < 3)
						{$adl = ($adl + 0.1);}
					else
						{
						if ($adl < 4)
							{$adl = ($adl + 0.25);}
						else
							{
							if ($adl < 5)
								{$adl = ($adl + 0.5);}
							else
								{
								if ($adl < 20)
									{$adl = ($adl + 1);}
								else
									{
									if ($adl < 40)
										{$adl = ($adl + 2);}
									else
										{
										if ($adl < 100)
											{$adl = ($adl + 5);}
										else
											{
											if ($adl < 200)
												{$adl = ($adl + 10);}
											else
												{
												if ($adl < 400)
													{$adl = ($adl + 50);}
												else
													{
													if ($adl < 1000)
														{$adl = ($adl + 100);}
													else
														{$adl = ($adl + 1);}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				if ($adl > $SSauto_dial_limit) {$hmm=1;}
				else {echo "<option>$adl</option>\n";}
				}
			echo "</select>(0 = "._QXZ("off").")$NWB#campaigns-auto_dial_level$NWE</td></tr>\n";
			}
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Next Agent Call").": </td><td align=left><select size=1 name=next_agent_call><option value='random'>"._QXZ("random")."</option><option value='oldest_call_start'>"._QXZ("oldest_call_start")."</option><option value='oldest_call_finish'>"._QXZ("oldest_call_finish")."</option><option value='overall_user_level'>"._QXZ("overall_user_level")."</option><option value='campaign_rank'>"._QXZ("campaign_rank")."</option><option value='campaign_grade_random'>"._QXZ("campaign_grade_random")."</option><option value='fewest_calls'>"._QXZ("fewest_calls")."</option><option value='longest_wait_time'>"._QXZ("longest_wait_time")."</option><option value='overall_user_level_wait_time'>"._QXZ("overall_user_level_wait_time")."</option><option value='campaign_rank_wait_time'>"._QXZ("campaign_rank_wait_time")."</option><option value='fewest_calls_wait_time'>"._QXZ("fewest_calls_wait_time")."</option></select>$NWB#campaigns-next_agent_call$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Local Call Time").": </td><td align=left><select size=1 name=local_call_time>";
		echo "$call_times_list";
		echo "</select>$NWB#campaigns-local_call_time$NWE</td></tr>\n";

		if ($SSoutbound_autodial_active > 0)
			{
			echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Voicemail").": </td><td align=left><input type=text name=voicemail_ext size=10 maxlength=10 value=\"$voicemail_ext\">$NWB#campaigns-voicemail_ext$NWE</td></tr>\n";
			}
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Script").": </td><td align=left><select size=1 name=script_id>\n";
		echo "$scripts_list";
		echo "</select>$NWB#campaigns-campaign_script$NWE</td></tr>\n";
		if ($SSenable_second_script > 0)
			{
			echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Script Two").": </td><td align=left><select size=1 name=campaign_script_two>\n";
			echo "$scripts_list";
			echo "</select>$NWB#campaigns-campaign_script$NWE</td></tr>\n";
			}

		$eswHTML=''; $cfwHTML=''; $aemHTML=''; $achHTML='';
		if ($SSenable_second_script > 0)
			{$eswHTML .= "<option value='SCRIPTTWO'>"._QXZ("SCRIPTTWO")."</option>";}
		if ($SSenable_second_webform > 0)
			{$eswHTML .= "<option value='WEBFORMTWO'>"._QXZ("WEBFORMTWO")."</option>";}
		if ($SSenable_third_webform > 0)
			{$eswHTML .= "<option value='WEBFORMTHREE'>"._QXZ("WEBFORMTHREE")."</option>";}
		if ($SScustom_fields_enabled > 0)
			{$cfwHTML .= "<option value='FORM'>"._QXZ("FORM")."</option>";}
		if ($SSallow_emails > 0)
			{$aemHTML .= "<option value='EMAIL'>"._QXZ("EMAIL")."</option>";}
		if ($SSallow_chats > 0)
			{$achHTML .= "<option value='CHAT'>"._QXZ("CHAT")."</option>";}
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Get Call Launch").": </td><td align=left><select size=1 name=get_call_launch><option selected value='NONE'>"._QXZ("NONE")."</option><option value='SCRIPT'>"._QXZ("SCRIPT")."</option><option value='WEBFORM'>"._QXZ("WEBFORM")."</option>$eswHTML$cfwHTML$aemHTML$achHTML</select>$NWB#campaigns-get_call_launch$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=center colspan=2><input style='background-color:#$SSbutton_color' type=submit name=SUBMIT value='"._QXZ("SUBMIT")."'></td></tr>\n";
		echo "</TABLE></center>\n";
		}
	else
		{
		echo _QXZ("You do not have permission to view this page")."\n";
		exit;
		}
	}


######################
# ADD=12 display the COPY CAMPAIGN FORM SCREEN
######################
if ($ADD==12)
	{
	if ($LOGmodify_campaigns==1)
		{
		##### BEGIN ID override optional section, if enabled it increments user by 1 ignoring entered value #####
		$stmt = "SELECT count(*) FROM vicidial_override_ids where id_table='vicidial_campaigns' and active='1';";
		$rslt=mysql_to_mysqli($stmt, $link);
		$voi_ct = mysqli_num_rows($rslt);
		if ($voi_ct > 0)
			{
			$row=mysqli_fetch_row($rslt);
			$voi_count = "$row[0]";
			}
		##### END ID override optional section #####

		echo "<TABLE><TR><TD>\n";
		echo "<img src=\"images/icon_black_campaigns.png\" alt=\"Campaigns\" width=42 height=42> <FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

		echo "<br>"._QXZ("COPY A CAMPAIGN")."<form action=$PHP_SELF method=POST>\n";
		echo "<input type=hidden name=ADD value=20>\n";
		echo "<input type=hidden name=DB value=\"$DB\">\n";
		echo "<center><TABLE width=$section_width cellspacing=3>\n";
		if ($voi_count > 0)
			{
			echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Campaign ID").": </td><td align=left>"._QXZ("Auto-Generated")." $NWB#campaigns-campaign_id$NWE</td></tr>\n";
			}
		else
			{
			echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Campaign ID").": </td><td align=left><input type=text name=campaign_id size=10 maxlength=8>$NWB#campaigns-campaign_id$NWE</td></tr>\n";
			}
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Campaign Name").": </td><td align=left><input type=text name=campaign_name size=40 maxlength=40>$NWB#campaigns-campaign_name$NWE</td></tr>\n";

		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Source Campaign").": </td><td align=left><select size=1 name=source_campaign_id>\n";

		$stmt="SELECT campaign_id,campaign_name from vicidial_campaigns $whereLOGallowed_campaignsSQL order by campaign_id;";
		$rslt=mysql_to_mysqli($stmt, $link);
		$campaigns_to_print = mysqli_num_rows($rslt);
		$campaigns_list='';

		$o=0;
		while ($campaigns_to_print > $o) 
			{
			$rowx=mysqli_fetch_row($rslt);
			$campaigns_list .= "<option value=\"$rowx[0]\">$rowx[0] - $rowx[1]</option>\n";
			$o++;
			}
		echo "$campaigns_list";
		echo "</select>$NWB#campaigns-campaign_id$NWE</td></tr>\n";
		
		echo "<tr bgcolor=#$SSstd_row4_background><td align=center colspan=2><input style='background-color:#$SSbutton_color' type=submit name=SUBMIT value='"._QXZ("SUBMIT")."'></td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=center colspan=2>"._QXZ("NOTE: Copying a campaign will copy all settings from the master campaign you select, but it will not copy a campaign-specific DNC list if there was one on the selected master campaign.")."</td></tr>\n";
		echo "</TABLE></center>\n";
		}
	else
		{
		echo _QXZ("You do not have permission to view this page")."\n";
		exit;
		}
	}


######################
# ADD=111 display the ADD NEW LIST FORM SCREEN
######################
if ($ADD==111)
	{
	if ($LOGmodify_lists==1)
		{
		##### BEGIN ID override optional section, if enabled it increments user by 1 ignoring entered value #####
		$stmt = "SELECT count(*) FROM vicidial_override_ids where id_table='vicidial_lists' and active='1';";
		$rslt=mysql_to_mysqli($stmt, $link);
		$voi_ct = mysqli_num_rows($rslt);
		if ($voi_ct > 0)
			{
			$row=mysqli_fetch_row($rslt);
			$voi_count = "$row[0]";
			}
		##### END ID override optional section #####

		echo "<TABLE><TR><TD>\n";
		echo "<img src=\"images/icon_black_lists.png\" alt=\"Lists\" width=42 height=42> <FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

		echo "<br>"._QXZ("ADD A NEW LIST")."<form action=$PHP_SELF method=POST>\n";
		echo "<input type=hidden name=ADD value=211>\n";
		echo "<center><TABLE width=$section_width cellspacing=3>\n";
		if ($voi_count > 0)
			{
			echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("List ID").": </td><td align=left>"._QXZ("Auto-Generated")." $NWB#lists-list_id$NWE</td></tr>\n";
			}
		else
			{
			echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("List ID").": </td><td align=left><input type=text name=list_id size=19 maxlength=19> ("._QXZ("digits only").")$NWB#lists-list_id$NWE</td></tr>\n";
			}
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("List Name").": </td><td align=left><input type=text name=list_name size=30 maxlength=30>$NWB#lists-list_name$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("List Description").": </td><td align=left><input type=text name=list_description size=30 maxlength=255>$NWB#lists-list_description$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Campaign").": </td><td align=left><select size=1 name=campaign_id>\n";

		$stmt="SELECT campaign_id,campaign_name from vicidial_campaigns $whereLOGallowed_campaignsSQL order by campaign_id;";
		$rslt=mysql_to_mysqli($stmt, $link);
		$campaigns_to_print = mysqli_num_rows($rslt);
		$campaigns_list='';

		$o=0;
		while ($campaigns_to_print > $o) 
			{
			$rowx=mysqli_fetch_row($rslt);
			$campaigns_list .= "<option value=\"$rowx[0]\">$rowx[0] - $rowx[1]</option>\n";
			$o++;
			}
		echo "$campaigns_list";
		echo "<option SELECTED>$campaign_id</option>\n";
		echo "</select>$NWB#lists-campaign_id$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Active").": </td><td align=left><select size=1 name=active><option value='Y'>"._QXZ("Y")."</option><option value=\"N\" SELECTED>"._QXZ("N")."</option></select>$NWB#lists-active$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=center colspan=2><input style='background-color:#$SSbutton_color' type=submit name=SUBMIT value='"._QXZ("SUBMIT")."'></td></tr>\n";
		echo "</TABLE></center>\n";
		}
	else
		{
		echo _QXZ("You do not have permission to view this page")."\n";
		exit;
		}
	}


######################
# ADD=121 display the ADD NUMBER TO DNC FORM SCREEN and add a new number
######################
if ($ADD==121)
	{
	### filter for DIGITS and NEWLINES
	$phone_numbers = preg_replace('/[^X\n0-9]/', '',$phone_numbers);

	echo "<TABLE WIDTH=900><TR><TD>\n";
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	$campaigns_list = "<option SELECTED value=\"SYSTEM_INTERNAL\">"._QXZ("SYSTEM_INTERNAL - INTERNAL DNC LIST")."</option>\n";
	$campaigns_list .= "<option value=\"ALL_DNC_CAMPAIGNS\">"._QXZ("ALL_DNC_CAMPAIGNS - All campaign DNC lists with camp DNC active")."</option>\n";
	$campaigns_list .= "<option value=\"ALL_ACTIVE_CAMPAIGNS\">"._QXZ("ALL_ACTIVE_CAMPAIGNS - All campaign DNC lists for active campaigns")."</option>\n";
	$campaigns_list .= "<option value=\"ALL_ACTIVE_DNC_CAMPAIGNS\">"._QXZ("ALL_ACTIVE_DNC_CAMPAIGNS - All campaign DNC lists with camp DNC active for active campaigns")."</option>\n";
	$campaigns_list .= "<option value=\"ALL_CAMPAIGNS\">"._QXZ("ALL_CAMPAIGNS - All campaign DNC lists")."</option>\n";


	$stmt="SELECT campaign_id,campaign_name from vicidial_campaigns where use_campaign_dnc IN('Y','AREACODE') $LOGallowed_campaignsSQL order by campaign_id;";
	$rslt=mysql_to_mysqli($stmt, $link);
	$campaigns_to_print = mysqli_num_rows($rslt);

	$o=0;
	while ($campaigns_to_print > $o) 
		{
		$rowx=mysqli_fetch_row($rslt);
		$campaigns_list .= "<option value=\"$rowx[0]\">$rowx[0] - $rowx[1]</option>\n";
		$o++;
		}

	# DNC Log Search
	if (strlen($phone) > 2)
		{
		echo "<br>"._QXZ("SEARCHING FOR PHONE NUMBER IN DNC LIST LOGS").": <b>$phone</b><br><br>\n";

		$stmt = "SELECT campaign_id,action,action_date,user FROM vicidial_dnc_log where phone_number='$phone' order by action_date desc limit 1000;";
		$rslt=mysql_to_mysqli($stmt, $link);
		$vdl_ct = mysqli_num_rows($rslt);
		$i=0;
		if ($vdl_ct > 0)
			{
			echo "<center><TABLE width=400 cellspacing=0 cellpadding=1>\n";
			echo "<tr bgcolor=black>";
			echo "<td><font size=1 color=white align=left><B>"._QXZ("CAMPAIGN")."</B></td>";
			echo "<td><font size=1 color=white><B>"._QXZ("ACTION")."</B></td>";
			echo "<td><font size=1 color=white><B>"._QXZ("DATE")." &nbsp; </B></td>";
			echo "<td><font size=1 color=white><B>"._QXZ("USER")." &nbsp; </B></td></tr>\n";
			}
		else
			{
			echo _QXZ("No Results Found")."\n";
			}
		while ($vdl_ct > $i)
			{
			if (preg_match('/1$|3$|5$|7$|9$/i', $i))
				{$bgcolor='bgcolor="#'. $SSstd_row2_background .'"';} 
			else
				{$bgcolor='bgcolor="#' . $SSstd_row1_background . '"';}
			$row=mysqli_fetch_row($rslt);
			$vdl_campaign =		$row[0];
			$vdl_action =		$row[1];
			$vdl_action_date =	$row[2];
			$vdl_user =			$row[3];

			echo "<tr $bgcolor><td><font size=1>";
			if ($vdl_campaign == '-SYSINT-')
				{echo "$vdl_campaign";}
			else
				{echo "<a href=\"$PHP_SELF?ADD=31&campaign_id=$vdl_campaign\">$vdl_campaign</a>";}
			echo "</font></td>";
			echo "<td><font size=1> $vdl_action</td>";
			echo "<td><font size=1> $vdl_action_date</td>";
			echo "<td align=center><font size=1><a href=\"$PHP_SELF?ADD=3&user=$vdl_user\">$vdl_user</a></td></tr>\n";

			$i++;
			}

		echo "</TABLE></center>\n";
		echo "<br><br><br>\n";
		}

	# Add / Delete from DNC
	if (strlen($phone_numbers) > 2)
		{
		$PN = explode("\n",$phone_numbers);
		$PNct = count($PN);
		$p=0;   $DNCadded=0;   $DNCnotadded=0;   $DNCdeleted=0;   $DNCnotdeleted=0;
		while ($p < $PNct)
			{
			if ( (preg_match('/delete/',$stage)) and ($LOGdelete_from_dnc > 0) )
				{
				##### BEGIN DELETE FROM DNC #####
				if (preg_match('/SYSTEM_INTERNAL/',$campaign_id))
					{
					$stmt="SELECT count(*) from vicidial_dnc where phone_number='$PN[$p]';";
					$rslt=mysql_to_mysqli($stmt, $link);
					$row=mysqli_fetch_row($rslt);
					if ($row[0] < 1)
						{
						echo "<br>"._QXZ("DNC NOT DELETED - This phone number is not in the Do Not Call List").": $PN[$p]\n";
						$DNCnotdeleted++;
						}
					else
						{
						$stmt="DELETE FROM vicidial_dnc where phone_number='$PN[$p]';";
						$rslt=mysql_to_mysqli($stmt, $link);

						echo "<br><B>"._QXZ("DNC DELETED").": $PN[$p]</B>\n";
						$DNCdeleted++;

						### LOG INSERTION Admin Log Table ###
						$SQL_log = "$stmt|";
						$SQL_log = preg_replace('/;/', '', $SQL_log);
						$SQL_log = addslashes($SQL_log);
						$stmt="INSERT INTO vicidial_admin_log set event_date='$SQLdate', user='$PHP_AUTH_USER', ip_address='$ip', event_section='LISTS', event_type='DELETE', record_id='$PN[$p]', event_code='ADMIN DELETE NUMBER FROM DNC LIST', event_sql=\"$SQL_log\", event_notes='';";
						if ($DB) {echo "|$stmt|\n";}
						$rslt=mysql_to_mysqli($stmt, $link);

						$stmt="INSERT INTO vicidial_dnc_log SET phone_number='$PN[$p]', campaign_id='-SYSINT-', action='delete', action_date=NOW(), user='$PHP_AUTH_USER';";
						$rslt=mysql_to_mysqli($stmt, $link);
						}
					}
				### DELETE FROM ALL_CAMPAIGNS, ALL_DNC_CAMPAIGNS, ALL_ACTIVE_CAMPAIGNS, ALL_ACTIVE_DNC_CAMPAIGNS
				elseif (preg_match('/ALL_CAMPAIGNS|ALL_ACTIVE_CAMPAIGNS|ALL_DNC_CAMPAIGNS|ALL_ACTIVE_DNC_CAMPAIGNS/',$campaign_id))
					{
					echo "<br><i>"._QXZ("DNC DELETE PROCESS STARTED").": $PN[$p] $campaign_id</i>\n";
					$multi_stmts='';
					$camp_typeSQL='';
					$numberDNCnotdeleted=0;
					$numberDNCdeleted=0;
					if (preg_match('/ALL_DNC_CAMPAIGNS/',$campaign_id)) {$camp_typeSQL = "where use_campaign_dnc IN('Y','AREACODE')";}
					if (preg_match('/ALL_ACTIVE_CAMPAIGNS/',$campaign_id)) {$camp_typeSQL = "where active='Y'";}
					if (preg_match('/ALL_ACTIVE_DNC_CAMPAIGNS/',$campaign_id)) {$camp_typeSQL = "where active='Y' and use_campaign_dnc IN('Y','AREACODE')";}
					### gather all campaign IDs for selected group of campaigns
					$stmt = "SELECT campaign_id FROM vicidial_campaigns $camp_typeSQL order by campaign_id;";
					$rslt=mysql_to_mysqli($stmt, $link);
					$camp_ct = mysqli_num_rows($rslt);
					$cdnc=0;
					while ($camp_ct > $cdnc)
						{
						$row=mysqli_fetch_row($rslt);
						$camp_list[$cdnc] = $row[0];
						$cdnc++;
						}
					$cdnc=0;
					while ($camp_ct > $cdnc)
						{
						$temp_campaign_id = $camp_list[$cdnc];
						$stmt="SELECT count(*) from vicidial_campaign_dnc where phone_number='$PN[$p]' and campaign_id='$temp_campaign_id' $LOGallowed_campaignsSQL;";
						$rslt=mysql_to_mysqli($stmt, $link);
						$row=mysqli_fetch_row($rslt);
						if ($row[0] < 1)
							{
							echo "<br>"._QXZ("DNC NOT DELETED - This phone number is not in the Do Not Call List").": $PN[$p] $temp_campaign_id\n";
							$DNCnotdeleted++;
							$numberDNCnotdeleted++;
							}
						else
							{
							$stmt="DELETE FROM vicidial_campaign_dnc where phone_number='$PN[$p]' and campaign_id='$temp_campaign_id';";
							$rslt=mysql_to_mysqli($stmt, $link);
							$affected_rows = mysqli_affected_rows($link);
							$multi_stmts .= "$stmt|";

							echo "<br><B>"._QXZ("DNC DELETED").": $affected_rows - $PN[$p] $temp_campaign_id</B>\n";
							$DNCdeleted = ($DNCdeleted + $affected_rows);
							$numberDNCdeleted = ($numberDNCdeleted + $affected_rows);

							$stmt="INSERT INTO vicidial_dnc_log SET phone_number='$PN[$p]', campaign_id='$temp_campaign_id', action='delete', action_date=NOW(), user='$PHP_AUTH_USER';";
							$rslt=mysql_to_mysqli($stmt, $link);
							}
						$cdnc++;
						}

					if ($camp_ct > 0)
						{
						### LOG INSERTION Admin Log Table ###
						$SQL_log = "$multi_stmts|";
						$SQL_log = preg_replace('/;/', '', $SQL_log);
						$SQL_log = addslashes($SQL_log);
						$stmt="INSERT INTO vicidial_admin_log set event_date='$SQLdate', user='$PHP_AUTH_USER', ip_address='$ip', event_section='LISTS', event_type='DELETE', record_id='$PN[$p]', event_code='ADMIN DELETE NUMBER FROM CAMPAIGN DNC LIST $campaign_id', event_sql=\"$SQL_log\", event_notes='Deleted: $numberDNCdeleted   Not-Deleted: $numberDNCnotdeleted';";
						if ($DB) {echo "|$stmt|\n";}
						$rslt=mysql_to_mysqli($stmt, $link);
						}
					}
				else
					{
					$stmt="SELECT count(*) from vicidial_campaign_dnc where phone_number='$PN[$p]' and campaign_id='$campaign_id' $LOGallowed_campaignsSQL;";
					$rslt=mysql_to_mysqli($stmt, $link);
					$row=mysqli_fetch_row($rslt);
					if ($row[0] < 1)
						{
						echo "<br>"._QXZ("DNC NOT DELETED - This phone number is not in the Do Not Call List").": $PN[$p] $campaign_id\n";
						$DNCnotdeleted++;
						}
					else
						{
						$stmt="DELETE FROM vicidial_campaign_dnc where phone_number='$PN[$p]' and campaign_id='$campaign_id';";
						$rslt=mysql_to_mysqli($stmt, $link);

						echo "<br><B>"._QXZ("DNC DELETED").": $PN[$p] $campaign_id</B>\n";
						$DNCdeleted++;

						### LOG INSERTION Admin Log Table ###
						$SQL_log = "$stmt|";
						$SQL_log = preg_replace('/;/', '', $SQL_log);
						$SQL_log = addslashes($SQL_log);
						$stmt="INSERT INTO vicidial_admin_log set event_date='$SQLdate', user='$PHP_AUTH_USER', ip_address='$ip', event_section='LISTS', event_type='DELETE', record_id='$PN[$p]', event_code='ADMIN DELETE NUMBER FROM CAMPAIGN DNC LIST $campaign_id', event_sql=\"$SQL_log\", event_notes='';";
						if ($DB) {echo "|$stmt|\n";}
						$rslt=mysql_to_mysqli($stmt, $link);

						$stmt="INSERT INTO vicidial_dnc_log SET phone_number='$PN[$p]', campaign_id='$campaign_id', action='delete', action_date=NOW(), user='$PHP_AUTH_USER';";
						$rslt=mysql_to_mysqli($stmt, $link);
						}
					}
				##### END DELETE FROM DNC #####
				}
			else
				{
				##### BEGIN ADD TO DNC #####
				if (preg_match('/SYSTEM_INTERNAL/',$campaign_id))
					{
					$stmt="SELECT count(*) from vicidial_dnc where phone_number='$PN[$p]';";
					$rslt=mysql_to_mysqli($stmt, $link);
					$row=mysqli_fetch_row($rslt);
					if ($row[0] > 0)
						{
						echo "<br>"._QXZ("DNC NOT ADDED - This phone number is already in the Do Not Call List").": $PN[$p]\n";
						$DNCnotadded++;
						}
					else
						{
						$stmt="INSERT INTO vicidial_dnc (phone_number) values('$PN[$p]');";
						$rslt=mysql_to_mysqli($stmt, $link);

						echo "<br><B>"._QXZ("DNC ADDED").": $PN[$p]</B>\n";
						$DNCadded++;

						### LOG INSERTION Admin Log Table ###
						$SQL_log = "$stmt|";
						$SQL_log = preg_replace('/;/', '', $SQL_log);
						$SQL_log = addslashes($SQL_log);
						$stmt="INSERT INTO vicidial_admin_log set event_date='$SQLdate', user='$PHP_AUTH_USER', ip_address='$ip', event_section='LISTS', event_type='ADD', record_id='$PN[$p]', event_code='ADMIN ADD NUMBER TO DNC LIST', event_sql=\"$SQL_log\", event_notes='';";
						if ($DB) {echo "|$stmt|\n";}
						$rslt=mysql_to_mysqli($stmt, $link);

						$stmt="INSERT INTO vicidial_dnc_log SET phone_number='$PN[$p]', campaign_id='-SYSINT-', action='add', action_date=NOW(), user='$PHP_AUTH_USER';";
						$rslt=mysql_to_mysqli($stmt, $link);
						}
					}
				### ADD TO ALL_CAMPAIGNS, ALL_DNC_CAMPAIGNS, ALL_ACTIVE_CAMPAIGNS, ALL_ACTIVE_DNC_CAMPAIGNS
				elseif (preg_match('/ALL_CAMPAIGNS|ALL_ACTIVE_CAMPAIGNS|ALL_DNC_CAMPAIGNS|ALL_ACTIVE_DNC_CAMPAIGNS/',$campaign_id))
					{
					echo "<br><i>"._QXZ("DNC ADD PROCESS STARTED").": $PN[$p] $campaign_id</i>\n";
					$multi_stmts='';
					$camp_typeSQL='';
					$numberDNCnotadded=0;
					$numberDNCadded=0;
					if (preg_match('/ALL_DNC_CAMPAIGNS/',$campaign_id)) {$camp_typeSQL = "where use_campaign_dnc IN('Y','AREACODE')";}
					if (preg_match('/ALL_ACTIVE_CAMPAIGNS/',$campaign_id)) {$camp_typeSQL = "where active='Y'";}
					if (preg_match('/ALL_ACTIVE_DNC_CAMPAIGNS/',$campaign_id)) {$camp_typeSQL = "where active='Y' and use_campaign_dnc IN('Y','AREACODE')";}
					### gather all campaign IDs for selected group of campaigns
					$stmt = "SELECT campaign_id FROM vicidial_campaigns $camp_typeSQL order by campaign_id;";
					$rslt=mysql_to_mysqli($stmt, $link);
					$camp_ct = mysqli_num_rows($rslt);
					$cdnc=0;
					while ($camp_ct > $cdnc)
						{
						$row=mysqli_fetch_row($rslt);
						$camp_list[$cdnc] = $row[0];
						$cdnc++;
						}
					$cdnc=0;
					while ($camp_ct > $cdnc)
						{
						$temp_campaign_id = $camp_list[$cdnc];
						$stmt="SELECT count(*) from vicidial_campaign_dnc where phone_number='$PN[$p]' and campaign_id='$temp_campaign_id' $LOGallowed_campaignsSQL;";
						$rslt=mysql_to_mysqli($stmt, $link);
						$row=mysqli_fetch_row($rslt);
						if ($row[0] > 0)
							{
							echo "<br>"._QXZ("DNC NOT ADDED - This phone number is already in the Do Not Call List").": $PN[$p] $temp_campaign_id\n";
							$DNCnotadded++;
							$numberDNCnotadded++;
							}
						else
							{
							$stmt="INSERT INTO vicidial_campaign_dnc (phone_number,campaign_id) values('$PN[$p]','$temp_campaign_id');";
							$rslt=mysql_to_mysqli($stmt, $link);
							$affected_rows = mysqli_affected_rows($link);
							$multi_stmts .= "$stmt|";

							echo "<br><B>"._QXZ("DNC ADDED").": $affected_rows - $PN[$p] $temp_campaign_id</B>\n";
							$DNCadded = ($DNCadded + $affected_rows);
							$numberDNCadded = ($numberDNCadded + $affected_rows);

							$stmt="INSERT INTO vicidial_dnc_log SET phone_number='$PN[$p]', campaign_id='$temp_campaign_id', action='add', action_date=NOW(), user='$PHP_AUTH_USER';";
							$rslt=mysql_to_mysqli($stmt, $link);
							}
						$cdnc++;
						}

					if ($camp_ct > 0)
						{
						### LOG INSERTION Admin Log Table ###
						$SQL_log = "$multi_stmts|";
						$SQL_log = preg_replace('/;/', '', $SQL_log);
						$SQL_log = addslashes($SQL_log);
						$stmt="INSERT INTO vicidial_admin_log set event_date='$SQLdate', user='$PHP_AUTH_USER', ip_address='$ip', event_section='LISTS', event_type='ADD', record_id='$PN[$p]', event_code='ADMIN ADD NUMBER TO CAMPAIGN DNC LIST $campaign_id', event_sql=\"$SQL_log\", event_notes='Added: $numberDNCadded   Not-Added: $numberDNCnotadded';";
						if ($DB) {echo "|$stmt|\n";}
						$rslt=mysql_to_mysqli($stmt, $link);
						}
					}
				else
					{
					$stmt="SELECT count(*) from vicidial_campaign_dnc where phone_number='$PN[$p]' and campaign_id='$campaign_id' $LOGallowed_campaignsSQL;";
					$rslt=mysql_to_mysqli($stmt, $link);
					$row=mysqli_fetch_row($rslt);
					if ($row[0] > 0)
						{
						echo "<br>"._QXZ("DNC NOT ADDED - This phone number is already in the Do Not Call List").": $PN[$p] $campaign_id\n";
						$DNCnotadded++;
						}
					else
						{
						$stmt="INSERT INTO vicidial_campaign_dnc (phone_number,campaign_id) values('$PN[$p]','$campaign_id');";
						$rslt=mysql_to_mysqli($stmt, $link);

						echo "<br><B>"._QXZ("DNC ADDED").": $PN[$p] $campaign_id</B>\n";
						$DNCadded++;

						### LOG INSERTION Admin Log Table ###
						$SQL_log = "$stmt|";
						$SQL_log = preg_replace('/;/', '', $SQL_log);
						$SQL_log = addslashes($SQL_log);
						$stmt="INSERT INTO vicidial_admin_log set event_date='$SQLdate', user='$PHP_AUTH_USER', ip_address='$ip', event_section='LISTS', event_type='ADD', record_id='$PN[$p]', event_code='ADMIN ADD NUMBER TO CAMPAIGN DNC LIST $campaign_id', event_sql=\"$SQL_log\", event_notes='';";
						if ($DB) {echo "|$stmt|\n";}
						$rslt=mysql_to_mysqli($stmt, $link);

						$stmt="INSERT INTO vicidial_dnc_log SET phone_number='$PN[$p]', campaign_id='$campaign_id', action='add', action_date=NOW(), user='$PHP_AUTH_USER';";
						$rslt=mysql_to_mysqli($stmt, $link);
						}
					}
				##### END ADD TO DNC #####
				}
			$p++;
			}
		
		if ( ($DNCadded > 0) or ($DNCnotadded > 0) )
			{
			echo "<br>\n";
			echo "<br><B>"._QXZ("TOTAL NUMBERS ADDED TO DNC LIST").": $DNCadded</B>\n";
			echo "<br><B>"._QXZ("TOTAL NUMBERS NOT ADDED TO DNC LIST").": $DNCnotadded</B>\n";
			echo "<br>\n";
			}
		if ( ($DNCdeleted > 0) or ($DNCnotdeleted > 0) )
			{
			echo "<br>\n";
			echo "<br><B>"._QXZ("TOTAL NUMBERS DELETED FROM DNC LIST").": $DNCdeleted</B>\n";
			echo "<br><B>"._QXZ("TOTAL NUMBERS NOT DELETED FROM DNC LIST").": $DNCnotdeleted</B>\n";
			echo "<br>\n";
			}
		}

	if ($LOGdelete_from_dnc > 0)
		{echo "<br>"._QXZ("ADD OR DELETE NUMBERS FROM THE DNC LIST")."<form action=$PHP_SELF method=POST>\n";}
	else
		{echo "<br>"._QXZ("ADD NUMBERS TO THE DNC LIST")."<form action=$PHP_SELF method=POST>\n";}
	echo "<input type=hidden name=ADD value=121>\n";
	echo "<center><TABLE width=850 cellspacing=3>\n";
	echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("List").": </td><td align=left><select size=1 name=campaign_id>\n";
	echo "$campaigns_list";
	echo "</select></td></tr>\n";
	echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Phone Numbers").": <BR><BR> ("._QXZ("one phone number per line only").")<BR>$NWB#internal_list-dnc$NWE</td><td align=left><TEXTAREA name=phone_numbers ROWS=20 COLS=20></TEXTAREA></td></tr>\n";
	if ($LOGdelete_from_dnc > 0)
		{
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Add or Delete").": </td><td align=left><select size=1 name=stage><option value='add' SELECTED>"._QXZ("add")."</option><option value='delete'>"._QXZ("delete")."</option></select></td></tr>\n";
		}
	echo "<tr bgcolor=#$SSstd_row4_background><td align=center colspan=2><input style='background-color:#$SSbutton_color' type=submit name=SUBMIT value='"._QXZ("SUBMIT")."'></td></tr>\n";
	echo "</FORM></TABLE></center>\n";

	echo "<br>"._QXZ("DNC LOG SEARCH")."<BR><form action=$PHP_SELF method=POST>\n";
	echo "<input type=hidden name=ADD value=121>\n";
	echo "<center><TABLE width=400 cellspacing=3>\n";
	echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Phone Number").": </td><td align=left><input type=text name=phone size=12 maxlength=18></td></tr>\n";
	echo "<tr bgcolor=#$SSstd_row4_background><td align=center colspan=2><input style='background-color:#$SSbutton_color' type=submit name=SUBMIT value='"._QXZ("SEARCH")."'></td></tr>\n";
	echo "</FORM></TABLE></center>\n";

	if ( ($LOGuser_level >= 9) and ( (preg_match("/Download List/",$LOGallowed_reports)) or (preg_match("/ALL REPORTS/",$LOGallowed_reports)) ) )
		{
		echo "<br>"._QXZ("Download numbers in this list to a file").": <form action=\"list_download.php\" method=POST>\n";
		echo "<input type=hidden name=download_type value=dnc>\n";
		echo "<select size=1 name=group_id>\n";
		echo "$campaigns_list";
		echo "</select><input style='background-color:#$SSbutton_color' type=submit name=SUBMIT value='"._QXZ("SUBMIT")."'></FORM>\n";
		}
	}


######################
# ADD=131 display the ADD NEW DROP LIST FORM SCREEN
######################
if ($ADD==131)
	{
	if ($LOGmodify_lists==1)
		{
		##### BEGIN ID override optional section, if enabled it increments user by 1 ignoring entered value #####
		$stmt = "SELECT count(*) FROM vicidial_override_ids where id_table='vicidial_drop_lists' and active='1';";
		$rslt=mysql_to_mysqli($stmt, $link);
		$voi_ct = mysqli_num_rows($rslt);
		if ($voi_ct > 0)
			{
			$row=mysqli_fetch_row($rslt);
			$voi_count = "$row[0]";
			}
		##### END ID override optional section #####

		echo "<TABLE><TR><TD>\n";
		echo "<img src=\"images/icon_black_lists.png\" alt=\"Lists\" width=42 height=42> <FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

		echo "<br>"._QXZ("ADD A NEW DROP LIST")."<form action=$PHP_SELF method=POST>\n";
		echo "<input type=hidden name=ADD value=231>\n";
		echo "<center><TABLE width=$section_width cellspacing=3>\n";
		if ($voi_count > 0)
			{
			echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Drop List ID").": </td><td align=left>"._QXZ("Auto-Generated")." $NWB#drop_lists-dl_id$NWE</td></tr>\n";
			}
		else
			{
			echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Drop List ID").": </td><td align=left><input type=text name=dl_id size=20 maxlength=30> $NWB#drop_lists-dl_id$NWE</td></tr>\n";
			}
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Drop List Name").": </td><td align=left><input type=text name=dl_name size=30 maxlength=100>$NWB#drop_lists-dl_name$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=center colspan=2><input style='background-color:#$SSbutton_color' type=submit name=SUBMIT value='"._QXZ("SUBMIT")."'></td></tr>\n";
		echo "</TABLE></center>\n";
		}
	else
		{
		echo _QXZ("You do not have permission to view this page")."\n";
		exit;
		}
	}


######################
# ADD=171 display the ADD NUMBER TO Filter Phone Group FORM SCREEN and add a new number
######################
if ($ADD==171)
	{
	### filter for Letters DIGITS and NEWLINES
	if ($non_latin < 1)
		{
		$phone_numbers = preg_replace('/[^\n\[\] 0-9a-zA-Z]/', '',$phone_numbers);
		}
	else
		{
		$phone_numbers = preg_replace('/[^\n\[\] 0-9\p{L}]/u', '',$phone_numbers);
		}
	echo "<TABLE><TR><TD>\n";
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	$stmt="SELECT filter_phone_group_id,filter_phone_group_name from vicidial_filter_phone_groups $whereLOGadmin_viewable_groupsSQL order by filter_phone_group_id;";
	$rslt=mysql_to_mysqli($stmt, $link);
	$vfpg_to_print = mysqli_num_rows($rslt);

	$o=0;
	while ($vfpg_to_print > $o) 
		{
		$rowx=mysqli_fetch_row($rslt);
		$vfpg_list .= "<option value=\"$rowx[0]\">$rowx[0] - $rowx[1]</option>\n";
		$o++;
		}

	if (strlen($phone_numbers) > 2)
		{
		$PN = explode("\n",$phone_numbers);
		$PNct = count($PN);
		$p=0;
		while ($p < $PNct)
			{
			if ( (preg_match('/delete/',$stage)) and ($LOGdelete_from_dnc > 0) )
				{
				$stmt="SELECT count(*) from vicidial_filter_phone_numbers where phone_number='$PN[$p]' and filter_phone_group_id='$filter_phone_group_id';";
				$rslt=mysql_to_mysqli($stmt, $link);
				$row=mysqli_fetch_row($rslt);
				if ($row[0] < 1)
					{echo "<br>"._QXZ("FILTER PHONE GROUP NUMBER NOT DELETED - This phone number is not in the Filter Phone Group List").": $PN[$p] $filter_phone_group_id\n";}
				else
					{
					$stmt="DELETE FROM vicidial_filter_phone_numbers where phone_number='$PN[$p]' and filter_phone_group_id='$filter_phone_group_id';";
					$rslt=mysql_to_mysqli($stmt, $link);

					echo "<br><B>"._QXZ("FILTER PHONE GROUP NUMBER DELETED").": $PN[$p] $filter_phone_group_id</B>\n";

					### LOG INSERTION Admin Log Table ###
					$SQL_log = "$stmt|";
					$SQL_log = preg_replace('/;/', '', $SQL_log);
					$SQL_log = addslashes($SQL_log);
					$stmt="INSERT INTO vicidial_admin_log set event_date='$SQLdate', user='$PHP_AUTH_USER', ip_address='$ip', event_section='FILTERPHONEGROUPS', event_type='DELETE', record_id='$PN[$p]', event_code='ADMIN DELETE NUMBER FROM FILTER PHONE GROUP $filter_phone_group_id', event_sql=\"$SQL_log\", event_notes='';";
					if ($DB) {echo "|$stmt|\n";}
					$rslt=mysql_to_mysqli($stmt, $link);
					}
				}
			else
				{
				$stmt="SELECT count(*) from vicidial_filter_phone_numbers where phone_number='$PN[$p]' and filter_phone_group_id='$filter_phone_group_id';";
				$rslt=mysql_to_mysqli($stmt, $link);
				$row=mysqli_fetch_row($rslt);
				if ($row[0] > 0)
					{echo "<br>"._QXZ("FILTER PHONE GROUP NUMBER NOT ADDED - This phone number is already in the Filter Phone Group List").": $PN[$p] $filter_phone_group_id\n";}
				else
					{
					$stmt="INSERT INTO vicidial_filter_phone_numbers (phone_number,filter_phone_group_id) values('$PN[$p]','$filter_phone_group_id');";
					$rslt=mysql_to_mysqli($stmt, $link);

					echo "<br><B>"._QXZ("FILTER PHONE GROUP NUMBER ADDED").": $PN[$p] $filter_phone_group_id</B>\n";

					### LOG INSERTION Admin Log Table ###
					$SQL_log = "$stmt|";
					$SQL_log = preg_replace('/;/', '', $SQL_log);
					$SQL_log = addslashes($SQL_log);
					$stmt="INSERT INTO vicidial_admin_log set event_date='$SQLdate', user='$PHP_AUTH_USER', ip_address='$ip', event_section='FILTERPHONEGROUPS', event_type='ADD', record_id='$PN[$p]', event_code='ADMIN ADD NUMBER TO FILTER PHONE GROUP $filter_phone_group_id', event_sql=\"$SQL_log\", event_notes='';";
					if ($DB) {echo "|$stmt|\n";}
					$rslt=mysql_to_mysqli($stmt, $link);
					}
				}
			$p++;
			}
		}

	if ($LOGdelete_from_dnc > 0)
		{echo "<br>"._QXZ("ADD OR DELETE NUMBERS FROM THE FILTER PHONE GROUP LIST")."<form action=$PHP_SELF method=POST>\n";}
	else
		{echo "<br>"._QXZ("ADD NUMBERS TO THE FILTER PHONE GROUP LIST")."<form action=$PHP_SELF method=POST>\n";}
	echo "<input type=hidden name=ADD value=171>\n";
	echo "<center><TABLE width=$section_width cellspacing=3>\n";
	echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Filter Phone Group").": </td><td align=left><select size=1 name=filter_phone_group_id>\n";
	echo "$vfpg_list";
	echo "</select></td></tr>\n";
	echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Phone Numbers").": <BR><BR> ("._QXZ("one phone number per line only").")<BR>$NWB#filter-phone-list$NWE</td><td align=left><TEXTAREA name=phone_numbers ROWS=20 COLS=20></TEXTAREA></td></tr>\n";
	if ($LOGdelete_from_dnc > 0)
		{
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Add or Delete").": </td><td align=left><select size=1 name=stage><option SELECTED value='add'>"._QXZ("add")."</option><option value='delete'>"._QXZ("delete")."</option></select></td></tr>\n";
		}
	echo "<tr bgcolor=#$SSstd_row4_background><td align=center colspan=2><input style='background-color:#$SSbutton_color' type=submit name=SUBMIT value='"._QXZ("SUBMIT")."'></td></tr>\n";
	echo "</FORM></TABLE></center>\n";

	if ( ($LOGuser_level >= 9) and ( (preg_match("/Download List/",$LOGallowed_reports)) or (preg_match("/ALL REPORTS/",$LOGallowed_reports)) ) )
		{
		echo "<br>"._QXZ("Download numbers in this list to a file").": <form action=\"list_download.php\" method=POST>\n";
		echo "<input type=hidden name=download_type value=fpgn>\n";
		echo "<select size=1 name=group_id>\n";
		echo "$vfpg_list";
		echo "</select><input style='background-color:#$SSbutton_color' type=submit name=SUBMIT value='"._QXZ("SUBMIT")."'></FORM>\n";
		}

	}


######################
# ADD=3211 areacode list modification screen
######################
if ($ADD==3211)
	{
	echo "<TABLE><TR><TD>\n";
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	if ($LOGmodify_ingroups==1)
		{
		$stmt = "SELECT count(*) FROM vicidial_inbound_groups where group_id='$group_id';";
		$rslt=mysql_to_mysqli($stmt, $link);
		$row=mysqli_fetch_row($rslt);
		$vig_exists = $row[0];

		if ($vig_exists > 0)
			{
			### read in all areacodes in this in-group areacode filter list
			$stmt = "SELECT areacode FROM vicidial_areacode_filters where group_id='$group_id' order by areacode;";
			$rslt=mysql_to_mysqli($stmt, $link);
			$vaf_ct = mysqli_num_rows($rslt);
			$vaf=0;
			while ($vaf_ct > $vaf)
				{
				$row=mysqli_fetch_row($rslt);
				$vaf_list[$vaf] = $row[0];
				$vaf_count[$vaf] = 0;
				$vaf++;
				}

			if (strlen($areacode_list) > 2)
				{
				$PN = explode("\n",$areacode_list);
				$PNct = count($PN);
				$p=0;
				$stmt_log='';
				while ($p < $PNct)
					{
					if (strlen($PN[$p]) > 0)
						{
						$ac_found=0;
						$vaf=0;
						while ($vaf_ct > $vaf)
							{
							if ($PN[$p] == $vaf_list[$vaf]) 
								{
								$vaf_count[$vaf]++;
								$ac_found++;
								}
							$vaf++;
							}
						if ($ac_found < 1)
							{
							$stmt="SELECT count(*) from vicidial_areacode_filters where areacode='$PN[$p]' and group_id='$group_id';";
							$rslt=mysql_to_mysqli($stmt, $link);
							$row=mysqli_fetch_row($rslt);
							if ($row[0] < 1)
								{
								$stmt="INSERT INTO vicidial_areacode_filters (areacode,group_id) values('$PN[$p]','$group_id');";
								$rslt=mysql_to_mysqli($stmt, $link);
								$stmt_log .= "$stmt|";
								if ($DB > 0) {echo "Added areacode $PN[$p]<br>\n";}
								}
							else
								{if ($DB > 0) {echo "Skipped add, already exists: $PN[$p]<br>\n";}}
							}
						}
					$p++;
					}

				$vaf=0;
				while ($vaf_ct > $vaf)
					{
					if ($vaf_count[$vaf] < 1)
						{
						$stmt="SELECT count(*) from vicidial_areacode_filters where areacode='$vaf_list[$vaf]' and group_id='$group_id';";
						$rslt=mysql_to_mysqli($stmt, $link);
						$row=mysqli_fetch_row($rslt);
						if ($row[0] > 0)
							{
							$stmt="DELETE FROM vicidial_areacode_filters where areacode='$vaf_list[$vaf]' and group_id='$group_id';";
							$rslt=mysql_to_mysqli($stmt, $link);
							$stmt_log .= "$stmt|";
							if ($DB > 0) {echo "Removed areacode $vaf_list[$vaf]<br>\n";}
							}
						else
							{if ($DB > 0) {echo "Skipped delete, already removed: $vaf_list[$vaf]<br>\n";}}
						}
					$vaf++;
					}

				if (strlen($stmt_log) > 10)
					{
					### LOG INSERTION Admin Log Table ###
					$SQL_log = "$stmt_log|";
					$SQL_log = preg_replace('/;/', '', $SQL_log);
					$SQL_log = addslashes($SQL_log);
					$stmt="INSERT INTO vicidial_admin_log set event_date='$SQLdate', user='$PHP_AUTH_USER', ip_address='$ip', event_section='INGROUPS', event_type='MODIFY', record_id='$group_id', event_code='ADMIN MODIFY AREACODE FILTER', event_sql=\"$SQL_log\", event_notes='';";
					if ($DB) {echo "|$stmt|\n";}
					$rslt=mysql_to_mysqli($stmt, $link);
					}
				}

			### read in all areacodes in this in-group areacode filter list
			$stmt = "SELECT areacode FROM vicidial_areacode_filters where group_id='$group_id' order by areacode;";
			$rslt=mysql_to_mysqli($stmt, $link);
			$vaf_ct = mysqli_num_rows($rslt);
			$vaf=0;   $vaf_textarea='';
			while ($vaf_ct > $vaf)
				{
				$row=mysqli_fetch_row($rslt);
				$vaf_textarea .= "$row[0]\n";
				$vaf++;
				}

			echo "<br>"._QXZ("MODIFY AREACODE LIST")."<form action=$PHP_SELF method=POST>\n";
			echo "<input type=hidden name=ADD value=3211>\n";
			echo "<input type=hidden name=group_id value=\"$group_id\">\n";
			echo "<input type=hidden name=DB value=\"$DB\">\n";
			echo "<center><TABLE width=500 cellspacing=3>\n";
			echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("In-Group").": </td><td align=left><b>$group_id</b> - <a href=\"$PHP_SELF?ADD=3111&group_id=$group_id\">modify</a></td></tr>\n";
			echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Areacodes").": <BR><BR> ("._QXZ("one areacode per line only").")<BR>$NWB#internal_list-dnc$NWE</td><td align=left><TEXTAREA name=areacode_list ROWS=20 COLS=7>$vaf_textarea</TEXTAREA></td></tr>\n";
			echo "<tr bgcolor=#$SSstd_row4_background><td align=center colspan=2><input style='background-color:#$SSbutton_color' type=submit name=SUBMIT value='"._QXZ("SUBMIT")."'></td></tr>\n";
			echo "</FORM></TABLE></center>\n";
			}
		else
			{
			echo _QXZ("You must use a valid group")."\n";
			exit;
			}
		}
	else
		{
		echo _QXZ("You do not have permission to view this page")."\n";
		exit;
		}
	}


######################
# ADD=1111 display the ADD NEW INBOUND GROUP SCREEN
######################
if ($ADD==1111)
	{
	if ($LOGmodify_ingroups==1)
		{
		##### BEGIN ID override optional section, if enabled it increments user by 1 ignoring entered value #####
		$stmt = "SELECT count(*) FROM vicidial_override_ids where id_table='vicidial_inbound_groups' and active='1';";
		$rslt=mysql_to_mysqli($stmt, $link);
		$voi_ct = mysqli_num_rows($rslt);
		if ($voi_ct > 0)
			{
			$row=mysqli_fetch_row($rslt);
			$voi_count = "$row[0]";
			}
		##### END ID override optional section #####

		echo "<TABLE><TR><TD>\n";
		echo "<img src=\"images/icon_black_inbound.png\" alt=\"Inbound\" width=42 height=42> <FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

		echo "<br>"._QXZ("ADD A NEW INBOUND GROUP")."<form action=$PHP_SELF method=POST>\n";
		echo "<input type=hidden name=ADD value=2111>\n";
		echo "<center><TABLE width=$section_width cellspacing=3>\n";
		if ($voi_count > 0)
			{
			echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Group ID").": </td><td align=left>"._QXZ("Auto-Generated")." $NWB#inbound_groups-group_id$NWE</td></tr>\n";
			}
		else
			{
			echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Group ID").": </td><td align=left><input type=text name=group_id size=20 maxlength=20> ("._QXZ("no spaces").")$NWB#inbound_groups-group_id$NWE</td></tr>\n";
			}
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Group Name").": </td><td align=left><input type=text name=group_name size=30 maxlength=30>$NWB#inbound_groups-group_name$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Group Color").": </td><td align=left id=\"group_color_td\"><input type=text name=group_color size=7 maxlength=7>$NWB#inbound_groups-group_color$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Active").": </td><td align=left><select size=1 name=active><option value='Y' SELECTED>"._QXZ("Y")."</option><option value='N'>"._QXZ("N")."</option></select>$NWB#inbound_groups-active$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Admin User Group").": </td><td align=left><select size=1 name=user_group>\n";
		echo "$UUgroups_list";
		echo "<option SELECTED value=\"---ALL---\">"._QXZ("All Admin User Groups")."</option>\n";
		echo "</select>$NWB#inbound_groups-user_group$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Web Form").": </td><td align=left><input type=text name=web_form_address size=70 maxlength=9999 value=\"$web_form_address\">$NWB#inbound_groups-web_form_address$NWE"; if ($SSenable_first_webform < 1) {echo " <font color=red><b>"._QXZ("DISABLED")."</b></font>";} echo "</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Voicemail").": </td><td align=left><input type=text name=voicemail_ext size=10 maxlength=10 value=\"$voicemail_ext\">$NWB#inbound_groups-voicemail_ext$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Next Agent Call").": </td><td align=left><select size=1 name=next_agent_call><option value='random'>"._QXZ("random")."</option><option value='oldest_call_start'>"._QXZ("oldest_call_start")."</option><option value='oldest_call_finish'>"._QXZ("oldest_call_finish")."</option><option value='oldest_inbound_call_start'>"._QXZ("oldest_inbound_call_start")."</option><option value='oldest_inbound_call_finish'>"._QXZ("oldest_inbound_call_finish")."</option><option value='oldest_inbound_filtered_call_start'>"._QXZ("oldest_inbound_filtered_call_start")."</option><option value='oldest_inbound_filtered_call_finish'>"._QXZ("oldest_inbound_filtered_call_finish")."</option><option value='overall_user_level'>"._QXZ("overall_user_level")."</option><option value='inbound_group_rank'>"._QXZ("inbound_group_rank")."</option><option value='campaign_rank'>"._QXZ("campaign_rank")."</option><option value='ingroup_grade_random'>"._QXZ("ingroup_grade_random")."</option><option value='campaign_grade_random'>"._QXZ("campaign_grade_random")."</option><option value='fewest_calls'>"._QXZ("fewest_calls")."</option><option value='fewest_calls_campaign'>"._QXZ("fewest_calls_campaign")."</option><option value='longest_wait_time'>"._QXZ("longest_wait_time")."</option><option value='ring_all'>"._QXZ("ring_all")."</option><option value='overall_user_level_wait_time'>"._QXZ("overall_user_level_wait_time")."</option><option value='campaign_rank_wait_time'>"._QXZ("campaign_rank_wait_time")."</option><option value='fewest_calls_campaign_wait_time'>"._QXZ("fewest_calls_campaign_wait_time")."</option><option value='inbound_group_rank_wait_time'>"._QXZ("inbound_group_rank_wait_time")."</option><option value='fewest_calls_wait_time'>"._QXZ("fewest_calls_wait_time")."</option></select>$NWB#inbound_groups-next_agent_call$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Fronter Display").": </td><td align=left><select size=1 name=fronter_display><option value='Y' SELECTED>"._QXZ("Y")."</option><option value='N'>"._QXZ("N")."</option></select>$NWB#inbound_groups-fronter_display$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Script").": </td><td align=left><select size=1 name=script_id>\n";
		echo "$scripts_list";
		echo "</select>$NWB#inbound_groups-ingroup_script$NWE</td></tr>\n";
		if ($SSenable_second_script > 0)
			{
			echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Script Two").": </td><td align=left><select size=1 name=ingroup_script_two>\n";
			echo "$scripts_list";
			echo "</select>$NWB#inbound_groups-ingroup_script$NWE</td></tr>\n";
			}
		$eswHTML=''; $cfwHTML=''; $aemHTML=''; $achHTML='';
		if ($SSenable_second_script > 0)
			{$eswHTML .= "<option value='SCRIPTTWO'>"._QXZ("SCRIPTTWO")."</option>";}
		if ($SSenable_second_webform > 0)
			{$eswHTML .= "<option value='WEBFORMTWO'>"._QXZ("WEBFORMTWO")."</option>";}
		if ($SSenable_third_webform > 0)
			{$eswHTML .= "<option value='WEBFORMTHREE'>"._QXZ("WEBFORMTHREE")."</option>";}
		if ($SScustom_fields_enabled > 0)
			{$cfwHTML .= "<option value='FORM'>"._QXZ("FORM")."</option>";}
		if ($SSallow_emails > 0)
			{$aemHTML .= "<option value='EMAIL'>"._QXZ("EMAIL")."</option>";}
		if ($SSallow_chats > 0)
			{$achHTML .= "<option value='CHAT'>"._QXZ("CHAT")."</option>";}
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Get Call Launch").": </td><td align=left><select size=1 name=get_call_launch><option selected value='NONE'>"._QXZ("NONE")."</option><option value='SCRIPT'>"._QXZ("SCRIPT")."</option><option value='WEBFORM'>"._QXZ("WEBFORM")."</option>$eswHTML$cfwHTML$aemHTML$achHTML</select>$NWB#inbound_groups-get_call_launch$NWE</td></tr>\n";
/* Don't give an option (yet).  This is clearly for phones only. 
		if ($SSallow_emails>0 || $SSallow_chats > 0)
			{
			echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Group Handling").": </td><td align=left><select size=1 name=group_handling><option selected value='PHONE'>"._QXZ("PHONE")."</option>";
			if ($SSallow_emails>0) {echo "<option value='EMAIL'>"._QXZ("EMAIL")."</option>";}
			if ($SSallow_chats>0) {echo "<option value='CHAT'>"._QXZ("CHAT")."</option>";}			
			echo "</select>$NWB#inbound_groups-group_handling$NWE</td></tr>\n";
			}
		else
			{
*/
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right></td><td align=left><input type=hidden name=group_handling value='PHONE'></td></tr>\n";
#			}
		echo "<tr bgcolor=#$SSstd_row4_background><td align=center colspan=2><input style='background-color:#$SSbutton_color' type=submit name=SUBMIT value='"._QXZ("SUBMIT")."'></td></tr>\n";
		echo "</TABLE></center>\n";
		}
	else
		{
		echo _QXZ("You do not have permission to view this page")."\n";
		exit;
		}
	}


######################
# ADD=1811 display the ADD NEW EMAIL GROUP SCREEN
######################
if ($ADD==1811)
	{
	if ( ($LOGmodify_ingroups==1) and ($SSallow_emails>0) )
		{
		##### BEGIN ID override optional section, if enabled it increments user by 1 ignoring entered value #####
		$stmt = "SELECT count(*) FROM vicidial_override_ids where id_table='vicidial_inbound_groups' and active='1';";
		$rslt=mysql_to_mysqli($stmt, $link);
		$voi_ct = mysqli_num_rows($rslt);
		if ($voi_ct > 0)
			{
			$row=mysqli_fetch_row($rslt);
			$voi_count = "$row[0]";
			}
		##### END ID override optional section #####

		echo "<TABLE><TR><TD>\n";
		echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

		echo "<img src=\"images/icon_email.png\" alt=\"Email Groups\" width=42 height=42> "._QXZ("ADD A NEW EMAIL GROUP")."<form action=$PHP_SELF method=GET>\n";
		echo "<input type=hidden name=ADD value=2811>\n";
		echo "<center><TABLE width=$section_width cellspacing=3>\n";
		if ($voi_count > 0)
			{
			echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Group ID").": </td><td align=left>"._QXZ("Auto-Generated")." $NWB#inbound_groups-group_id$NWE</td></tr>\n";
			}
		else
			{
			echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Group ID").": </td><td align=left><input type=text name=group_id size=20 maxlength=20> ("._QXZ("no spaces").")$NWB#inbound_groups-group_id$NWE</td></tr>\n";
			}
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Group Name").": </td><td align=left><input type=text name=group_name size=30 maxlength=30>$NWB#inbound_groups-group_name$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Group Color").": </td><td align=left id=\"group_color_td\"><input type=text name=group_color size=7 maxlength=7>$NWB#inbound_groups-group_color$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Active").": </td><td align=left><select size=1 name=active><option value='Y' SELECTED>"._QXZ("Y")."</option><option value='N'>"._QXZ("N")."</option></select>$NWB#inbound_groups-active$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Admin User Group").": </td><td align=left><select size=1 name=user_group>\n";
		echo "$UUgroups_list";
		echo "<option SELECTED value=\"---ALL---\">"._QXZ("All Admin User Groups")."</option>\n";
		echo "</select>$NWB#inbound_groups-user_group$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Web Form").": </td><td align=left><input type=text name=web_form_address size=70 maxlength=9999 value=\"$web_form_address\">$NWB#inbound_groups-web_form_address$NWE"; if ($SSenable_first_webform < 1) {echo " <font color=red><b>"._QXZ("DISABLED")."</b></font>";} echo "</td></tr>\n";
		# echo "<tr bgcolor=#$SSstd_row4_background><td align=right>Voicemail: </td><td align=left><input type=text name=voicemail_ext size=10 maxlength=10 value=\"$voicemail_ext\">$NWB#inbound_groups-voicemail_ext$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Next Agent Email").": </td><td align=left><select size=1 name=next_agent_call><option value='random'>"._QXZ("random")."</option><option value='oldest_call_start'>"._QXZ("oldest_call_start")."</option><option value='oldest_call_finish'>"._QXZ("oldest_call_finish")."</option><option value='oldest_inbound_call_start'>"._QXZ("oldest_inbound_call_start")."</option><option value='oldest_inbound_call_finish'>"._QXZ("oldest_inbound_call_finish")."</option><option value='oldest_inbound_filtered_call_start'>"._QXZ("oldest_inbound_filtered_call_start")."</option><option value='oldest_inbound_filtered_call_finish'>"._QXZ("oldest_inbound_filtered_call_finish")."</option><option value='overall_user_level'>"._QXZ("overall_user_level")."</option><option value='inbound_group_rank'>"._QXZ("inbound_group_rank")."</option><option value='campaign_rank'>"._QXZ("campaign_rank")."</option><option value='ingroup_grade_random'>"._QXZ("ingroup_grade_random")."</option><option value='campaign_grade_random'>"._QXZ("campaign_grade_random")."</option><option value='fewest_calls'>"._QXZ("fewest_calls")."</option><option value='fewest_calls_campaign'>"._QXZ("fewest_calls_campaign")."</option><option value='longest_wait_time'>"._QXZ("longest_wait_time")."</option><option value='ring_all'>"._QXZ("ring_all")."</option><option value='overall_user_level_wait_time'>"._QXZ("overall_user_level_wait_time")."</option><option value='campaign_rank_wait_time'>"._QXZ("campaign_rank_wait_time")."</option><option value='fewest_calls_campaign_wait_time'>"._QXZ("fewest_calls_campaign_wait_time")."</option><option value='inbound_group_rank_wait_time'>"._QXZ("inbound_group_rank_wait_time")."</option><option value='fewest_calls_wait_time'>"._QXZ("fewest_calls_wait_time")."</option></select>$NWB#inbound_groups-next_agent_email$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Fronter Display").": </td><td align=left><select size=1 name=fronter_display><option value='Y' SELECTED>"._QXZ("Y")."</option><option value='N'>"._QXZ("N")."</option></select>$NWB#inbound_groups-fronter_display$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Script").": </td><td align=left><select size=1 name=script_id>\n";
		echo "$scripts_list";
		echo "</select>$NWB#inbound_groups-ingroup_script$NWE</td></tr>\n";
		if ($SSenable_second_script > 0)
			{
			echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Script Two").": </td><td align=left><select size=1 name=ingroup_script_two>\n";
			echo "$scripts_list";
			echo "</select>$NWB#inbound_groups-ingroup_script$NWE</td></tr>\n";
			}
		$eswHTML=''; $cfwHTML=''; $aemHTML=''; $achHTML='';
		if ($SSenable_second_script > 0)
			{$eswHTML .= "<option value='SCRIPTTWO'>"._QXZ("SCRIPTTWO")."</option>";}
		if ($SSenable_second_webform > 0)
			{$eswHTML .= "<option value='WEBFORMTWO'>"._QXZ("WEBFORMTWO")."</option>";}
		if ($SSenable_third_webform > 0)
			{$eswHTML .= "<option value='WEBFORMTHREE'>"._QXZ("WEBFORMTHREE")."</option>";}
		if ($SScustom_fields_enabled > 0)
			{$cfwHTML .= "<option value='FORM'>"._QXZ("FORM")."</option>";}
		if ($SSallow_emails > 0)
			{$aemHTML .= "<option value='EMAIL'>"._QXZ("EMAIL")."</option>";}
		if ($SSallow_chats > 0)
			{$achHTML .= "<option value='CHAT'>"._QXZ("CHAT")."</option>";}
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Get Call Launch").": </td><td align=left><select size=1 name=get_call_launch><option value='NONE' selected>"._QXZ("NONE")."</option><option value='SCRIPT'>"._QXZ("SCRIPT")."</option><option value='WEBFORM'>"._QXZ("WEBFORM")."</option>$eswHTML$cfwHTML$aemHTML$achHTML</select>$NWB#inbound_groups-get_call_launch$NWE</td></tr>\n";

		echo "<tr bgcolor=#$SSstd_row4_background><td align=right></td><td align=left><input type=hidden name=group_handling value='EMAIL'></td></tr>\n";
		
		echo "<tr bgcolor=#$SSstd_row4_background><td align=center colspan=2><input style='background-color:#$SSbutton_color' type=submit name=SUBMIT value='"._QXZ("SUBMIT")."'></td></tr>\n";
		echo "</TABLE></center>\n";
		}
	else
		{
		echo _QXZ("You do not have permission to view this page")."\n";
		exit;
		}
	}


######################
# ADD=18111 display the ADD NEW CHAT GROUP SCREEN
######################
if ($ADD==18111)
	{
	if ( ($LOGmodify_ingroups==1) and ($SSallow_chats>0) )
		{
		##### BEGIN ID override optional section, if enabled it increments user by 1 ignoring entered value #####
		$stmt = "SELECT count(*) FROM vicidial_override_ids where id_table='vicidial_inbound_groups' and active='1';";
		$rslt=mysql_to_mysqli($stmt, $link);
		$voi_ct = mysqli_num_rows($rslt);
		if ($voi_ct > 0)
			{
			$row=mysqli_fetch_row($rslt);
			$voi_count = "$row[0]";
			}
		##### END ID override optional section #####

		echo "<TABLE><TR><TD>\n";
		echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

		echo "<img src=\"images/icon_chat.png\" alt=\"Chat Groups\" width=42 height=42> "._QXZ("ADD A NEW CHAT GROUP")."<form action=$PHP_SELF method=GET>\n";
		echo "<input type=hidden name=ADD value=28111>\n";
		echo "<center><TABLE width=$section_width cellspacing=3>\n";
		if ($voi_count > 0)
			{
			echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Group ID").": </td><td align=left>"._QXZ("Auto-Generated")."$NWB#inbound_groups-group_id$NWE</td></tr>\n";
			}
		else
			{
			echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Group ID").": </td><td align=left><input type=text name=group_id size=20 maxlength=20> ("._QXZ("no spaces").")$NWB#inbound_groups-group_id$NWE</td></tr>\n";
			}
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Group Name").": </td><td align=left><input type=text name=group_name size=30 maxlength=30>$NWB#inbound_groups-group_name$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Group Color").": </td><td align=left id=\"group_color_td\"><input type=text name=group_color size=7 maxlength=7>$NWB#inbound_groups-group_color$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Active").": </td><td align=left><select size=1 name=active><option value='Y' SELECTED>"._QXZ("Y")."</option><option value='N'>"._QXZ("N")."</option></select>$NWB#inbound_groups-active$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Default List ID").": </td><td align=left><input type=text name=hold_time_option_callback_list_id size=19 maxlength=19 value=0>$NWB#inbound_groups-default_list_id$NWE</td></tr>";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Admin User Group").": </td><td align=left><select size=1 name=user_group>\n";
		echo "$UUgroups_list";
		echo "<option SELECTED value=\"---ALL---\">"._QXZ("All Admin User Groups")."</option>\n";
		echo "</select>$NWB#inbound_groups-user_group$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Web Form").": </td><td align=left><input type=text name=web_form_address size=70 maxlength=9999 value=\"$web_form_address\">$NWB#inbound_groups-web_form_address$NWE"; if ($SSenable_first_webform < 1) {echo " <font color=red><b>"._QXZ("DISABLED")."</b></font>";} echo "</td></tr>\n";
		# echo "<tr bgcolor=#$SSstd_row4_background><td align=right>Voicemail: </td><td align=left><input type=text name=voicemail_ext size=10 maxlength=10 value=\"$voicemail_ext\">$NWB#inbound_groups-voicemail_ext$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Next Agent Chat").": </td><td align=left><select size=1 name=next_agent_call><option value='random'>"._QXZ("random")."</option><option value='oldest_call_start'>"._QXZ("oldest_call_start")."</option><option value='oldest_call_finish'>"._QXZ("oldest_call_finish")."</option><option value='oldest_inbound_call_start'>"._QXZ("oldest_inbound_call_start")."</option><option value='oldest_inbound_call_finish'>"._QXZ("oldest_inbound_call_finish")."</option><option value='oldest_inbound_filtered_call_start'>"._QXZ("oldest_inbound_filtered_call_start")."</option><option value='oldest_inbound_filtered_call_finish'>"._QXZ("oldest_inbound_filtered_call_finish")."</option><option value='overall_user_level'>"._QXZ("overall_user_level")."</option><option value='inbound_group_rank'>"._QXZ("inbound_group_rank")."</option><option value='campaign_rank'>"._QXZ("campaign_rank")."</option><option value='ingroup_grade_random'>"._QXZ("ingroup_grade_random")."</option><option value='campaign_grade_random'>"._QXZ("campaign_grade_random")."</option><option value='fewest_calls'>"._QXZ("fewest_calls")."</option><option value='fewest_calls_campaign'>"._QXZ("fewest_calls_campaign")."</option><option value='longest_wait_time'>"._QXZ("longest_wait_time")."</option><option value='ring_all'>"._QXZ("ring_all")."</option><option value='overall_user_level_wait_time'>"._QXZ("overall_user_level_wait_time")."</option><option value='campaign_rank_wait_time'>"._QXZ("campaign_rank_wait_time")."</option><option value='fewest_calls_campaign_wait_time'>"._QXZ("fewest_calls_campaign_wait_time")."</option><option value='inbound_group_rank_wait_time'>"._QXZ("inbound_group_rank_wait_time")."</option><option value='fewest_calls_wait_time'>"._QXZ("fewest_calls_wait_time")."</option></select>$NWB#inbound_groups-next_agent_chat$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Fronter Display").": </td><td align=left><select size=1 name=fronter_display><option value='Y' SELECTED>"._QXZ("Y")."</option><option value='N'>"._QXZ("N")."</option></select>$NWB#inbound_groups-fronter_display$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Script").": </td><td align=left><select size=1 name=script_id>\n";
		echo "$scripts_list";
		echo "</select>$NWB#inbound_groups-ingroup_script$NWE</td></tr>\n";
		if ($SSenable_second_script > 0)
			{
			echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Script Two").": </td><td align=left><select size=1 name=ingroup_script_two>\n";
			echo "$scripts_list";
			echo "</select>$NWB#inbound_groups-ingroup_script$NWE</td></tr>\n";
			}
		$eswHTML=''; $cfwHTML=''; $aemHTML=''; $achHTML='';
		if ($SSenable_second_script > 0)
			{$eswHTML .= "<option value='SCRIPTTWO'>"._QXZ("SCRIPTTWO")."</option>";}
		if ($SSenable_second_webform > 0)
			{$eswHTML .= "<option value='WEBFORMTWO'>"._QXZ("WEBFORMTWO")."</option>";}
		if ($SSenable_third_webform > 0)
			{$eswHTML .= "<option value='WEBFORMTHREE'>"._QXZ("WEBFORMTHREE")."</option>";}
		if ($SScustom_fields_enabled > 0)
			{$cfwHTML .= "<option value='FORM'>"._QXZ("FORM")."</option>";}
		if ($SSallow_emails > 0)
			{$aemHTML .= "<option value='EMAIL'>"._QXZ("EMAIL")."</option>";}
		if ($SSallow_chats > 0)
			{$achHTML .= "<option value='CHAT'>"._QXZ("CHAT")."</option>";}
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Get Call Launch").": </td><td align=left><select size=1 name=get_call_launch><option value='NONE' selected>"._QXZ("NONE")."</option><option value='SCRIPT'>"._QXZ("SCRIPT")."</option><option value='WEBFORM'>"._QXZ("WEBFORM")."</option>$eswHTML$cfwHTML$aemHTML$achHTML</select>$NWB#inbound_groups-get_call_launch$NWE</td></tr>\n";

		echo "<tr bgcolor=#$SSstd_row4_background><td align=right></td><td align=left><input type=hidden name=group_handling value='CHAT'></td></tr>\n";
		
		echo "<tr bgcolor=#$SSstd_row4_background><td align=center colspan=2><input style='background-color:#$SSbutton_color' type=submit name=SUBMIT value='"._QXZ("SUBMIT")."'></td></tr>\n";
		echo "</TABLE></center>\n";
		}
	else
		{
		echo _QXZ("You do not have permission to view this page")."\n";
		exit;
		}
	}


######################
# ADD=1211 display the COPY INBOUND GROUP SCREEN
######################
if ($ADD==1211)
	{
	if ($LOGmodify_ingroups==1)
		{
		##### BEGIN ID override optional section, if enabled it increments user by 1 ignoring entered value #####
		$stmt = "SELECT count(*) FROM vicidial_override_ids where id_table='vicidial_inbound_groups' and active='1';";
		$rslt=mysql_to_mysqli($stmt, $link);
		$voi_ct = mysqli_num_rows($rslt);
		if ($voi_ct > 0)
			{
			$row=mysqli_fetch_row($rslt);
			$voi_count = "$row[0]";
			}
		##### END ID override optional section #####

		echo "<TABLE><TR><TD>\n";
		echo "<img src=\"images/icon_black_inbound.png\" alt=\"Inbound\" width=42 height=42> <FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

		echo "<br>"._QXZ("COPY INBOUND GROUP")."<form action=$PHP_SELF method=POST>\n";
		echo "<input type=hidden name=ADD value=2011>\n";
		echo "<center><TABLE width=$section_width cellspacing=3>\n";
		if ($voi_count > 0)
			{
			echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Group ID").": </td><td align=left>"._QXZ("Auto-Generated")." $NWB#inbound_groups-group_id$NWE</td></tr>\n";
			}
		else
			{
			echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Group ID").": </td><td align=left><input type=text name=group_id size=20 maxlength=20> ("._QXZ("no spaces").")$NWB#inbound_groups-group_id$NWE</td></tr>\n";
			}
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Group Name").": </td><td align=left><input type=text name=group_name size=30 maxlength=30>$NWB#inbound_groups-group_name$NWE</td></tr>\n";

		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Source Group ID").": </td><td align=left><select size=1 name=source_group_id>\n";

		$stmt="SELECT group_id,group_name from vicidial_inbound_groups where group_handling='PHONE' $LOGadmin_viewable_groupsSQL order by group_id;";
		$rslt=mysql_to_mysqli($stmt, $link);
		$groups_to_print = mysqli_num_rows($rslt);
		$groups_list='';

		$o=0;
		while ($groups_to_print > $o) 
			{
			$rowx=mysqli_fetch_row($rslt);
			$groups_list .= "<option value=\"$rowx[0]\">$rowx[0] - $rowx[1]</option>\n";
			$o++;
			}
		echo "$groups_list";
		echo "</select>$NWB#inbound_groups-group_id$NWE</td></tr>\n";

		echo "<tr bgcolor=#$SSstd_row4_background><td align=center colspan=2><input style='background-color:#$SSbutton_color' type=submit name=SUBMIT value='"._QXZ("SUBMIT")."'></td></tr>\n";
		echo "</TABLE></center>\n";
		}
	else
		{
		echo _QXZ("You do not have permission to view this page")."\n";
		exit;
		}
	}


######################
# ADD=1911 display the COPY EMAIL INBOUND GROUP SCREEN
######################
if ($ADD==1911)
	{
	if ( ($LOGmodify_ingroups==1) and ($SSallow_emails>0) )
		{
		##### BEGIN ID override optional section, if enabled it increments user by 1 ignoring entered value #####
		$stmt = "SELECT count(*) FROM vicidial_override_ids where id_table='vicidial_inbound_groups' and active='1';";
		$rslt=mysql_to_mysqli($stmt, $link);
		$voi_ct = mysqli_num_rows($rslt);
		if ($voi_ct > 0)
			{
			$row=mysqli_fetch_row($rslt);
			$voi_count = "$row[0]";
			}
		##### END ID override optional section #####

		echo "<TABLE><TR><TD>\n";
		echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

		echo "<img src=\"images/icon_email.png\" alt=\"Email Groups\" width=42 height=42> "._QXZ("COPY EMAIL GROUP")."<form action=$PHP_SELF method=POST>\n";
		echo "<input type=hidden name=ADD value=2911>\n";
		echo "<center><TABLE width=$section_width cellspacing=3>\n";
		if ($voi_count > 0)
			{
			echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Email Group ID").": </td><td align=left>"._QXZ("Auto-Generated")." $NWB#inbound_groups-group_id$NWE</td></tr>\n";
			}
		else
			{
			echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Email Group ID").": </td><td align=left><input type=text name=group_id size=20 maxlength=20> ("._QXZ("no spaces").")$NWB#inbound_groups-group_id$NWE</td></tr>\n";
			}
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Email Group Name").": </td><td align=left><input type=text name=group_name size=30 maxlength=30>$NWB#inbound_groups-group_name$NWE</td></tr>\n";

		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Source Email Group ID").": </td><td align=left><select size=1 name=source_group_id>\n";

		$stmt="SELECT group_id,group_name from vicidial_inbound_groups where group_handling='EMAIL' $LOGadmin_viewable_groupsSQL order by group_id;";
		$rslt=mysql_to_mysqli($stmt, $link);
		$groups_to_print = mysqli_num_rows($rslt);
		$groups_list='';

		$o=0;
		while ($groups_to_print > $o) 
			{
			$rowx=mysqli_fetch_row($rslt);
			$groups_list .= "<option value=\"$rowx[0]\">$rowx[0] - $rowx[1]</option>\n";
			$o++;
			}
		echo "$groups_list";
		echo "</select>$NWB#inbound_groups-group_id$NWE</td></tr>\n";

		echo "<tr bgcolor=#$SSstd_row4_background><td align=center colspan=2><input style='background-color:#$SSbutton_color' type=submit name=SUBMIT value='"._QXZ("SUBMIT")."'></td></tr>\n";
		echo "</TABLE></center>\n";
		}
	else
		{
		echo _QXZ("You do not have permission to view this page")."\n";
		exit;
		}
	}


######################
# ADD=19111 display the COPY CHAT INBOUND GROUP SCREEN
######################
if ($ADD==19111)
	{
	if ( ($LOGmodify_ingroups==1) and ($SSallow_chats>0) )
		{
		##### BEGIN ID override optional section, if enabled it increments user by 1 ignoring entered value #####
		$stmt = "SELECT count(*) FROM vicidial_override_ids where id_table='vicidial_inbound_groups' and active='1';";
		$rslt=mysql_to_mysqli($stmt, $link);
		$voi_ct = mysqli_num_rows($rslt);
		if ($voi_ct > 0)
			{
			$row=mysqli_fetch_row($rslt);
			$voi_count = "$row[0]";
			}
		##### END ID override optional section #####

		echo "<TABLE><TR><TD>\n";
		echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

		echo "<img src=\"images/icon_chat.png\" alt=\"Chat Groups\" width=42 height=42> "._QXZ("COPY CHAT GROUP")."<form action=$PHP_SELF method=POST>\n";
		echo "<input type=hidden name=ADD value=29111>\n";
		echo "<center><TABLE width=$section_width cellspacing=3>\n";
		if ($voi_count > 0)
			{
			echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Chat Group ID").": </td><td align=left>"._QXZ("Auto-Generated")." $NWB#inbound_groups-group_id$NWE</td></tr>\n";
			}
		else
			{
			echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Chat Group ID").": </td><td align=left><input type=text name=group_id size=20 maxlength=20> ("._QXZ("no spaces").")$NWB#inbound_groups-group_id$NWE</td></tr>\n";
			}
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Chat Group Name").": </td><td align=left><input type=text name=group_name size=30 maxlength=30>$NWB#inbound_groups-group_name$NWE</td></tr>\n";

		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Source Chat Group ID").": </td><td align=left><select size=1 name=source_group_id>\n";

		$stmt="SELECT group_id,group_name from vicidial_inbound_groups where group_handling='CHAT' $LOGadmin_viewable_groupsSQL order by group_id;";
		$rslt=mysql_to_mysqli($stmt, $link);
		$groups_to_print = mysqli_num_rows($rslt);
		$groups_list='';

		$o=0;
		while ($groups_to_print > $o) 
			{
			$rowx=mysqli_fetch_row($rslt);
			$groups_list .= "<option value=\"$rowx[0]\">$rowx[0] - $rowx[1]</option>\n";
			$o++;
			}
		echo "$groups_list";
		echo "</select>$NWB#inbound_groups-group_id$NWE</td></tr>\n";

		echo "<tr bgcolor=#$SSstd_row4_background><td align=center colspan=2><input style='background-color:#$SSbutton_color' type=submit name=SUBMIT value='"._QXZ("SUBMIT")."'></td></tr>\n";
		echo "</TABLE></center>\n";
		}
	else
		{
		echo _QXZ("You do not have permission to view this page")."\n";
		exit;
		}
	}


######################
# ADD=1311 display the ADD NEW DID SCREEN
######################
if ($ADD==1311)
	{
	if ($LOGmodify_dids==1)
		{
		echo "<TABLE><TR><TD>\n";
		echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

		echo "<img src=\"images/icon_cidgroups.png\" alt=\"DIDs\" width=42 height=42> "._QXZ("ADD A NEW DID")."<form action=$PHP_SELF method=POST>\n";
		echo "<input type=hidden name=ADD value=2311>\n";
		echo "<center><TABLE width=$section_width cellspacing=3>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("DID Extension").": </td><td align=left><input type=text name=did_pattern size=20 maxlength=50> ("._QXZ("no spaces or dashes").")$NWB#inbound_dids-did_pattern$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("DID Description").": </td><td align=left><input type=text name=did_description size=40 maxlength=50>$NWB#inbound_dids-did_description$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Admin User Group").": </td><td align=left><select size=1 name=user_group>\n";
		echo "$UUgroups_list";
		echo "<option SELECTED value=\"---ALL---\">"._QXZ("All Admin User Groups")."</option>\n";
		echo "</select>$NWB#inbound_dids-user_group$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=center colspan=2><input style='background-color:#$SSbutton_color' type=submit name=SUBMIT value='"._QXZ("SUBMIT")."'></td></tr>\n";
		echo "</TABLE></center>\n";
		}
	else
		{
		echo _QXZ("You do not have permission to view this page")."\n";
		exit;
		}
	}


######################
# ADD=1411 display the COPY DID SCREEN
######################
if ($ADD==1411)
	{
	if ($LOGmodify_dids==1)
		{
		echo "<TABLE><TR><TD>\n";
		echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

		echo "<img src=\"images/icon_cidgroups.png\" alt=\"DIDs\" width=42 height=42> "._QXZ("COPY DID")."<form action=$PHP_SELF method=POST>\n";
		echo "<input type=hidden name=ADD value=2411>\n";
		echo "<center><TABLE width=$section_width cellspacing=3>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("DID Extension").": </td><td align=left><input type=text name=did_pattern size=20 maxlength=50> ("._QXZ("no spaces or dashes").")$NWB#inbound_dids-did_pattern$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("DID Description").": </td><td align=left><input type=text name=did_description size=40 maxlength=50>$NWB#inbound_dids-did_description$NWE</td></tr>\n";

		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Source DID").": </td><td align=left><select size=1 name=source_did>\n";

		$stmt="SELECT did_id,did_pattern,did_description from vicidial_inbound_dids where did_pattern!='did_system_filter' $LOGadmin_viewable_groupsSQL order by did_pattern;";
		$rslt=mysql_to_mysqli($stmt, $link);
		$dids_to_print = mysqli_num_rows($rslt);
		$dids_list='';

		$o=0;
		while ($dids_to_print > $o) 
			{
			$rowx=mysqli_fetch_row($rslt);
			$dids_list .= "<option value=\"$rowx[0]\">$rowx[1] - $rowx[2]</option>\n";
			$o++;
			}
		echo "$dids_list";
		echo "</select>$NWB#inbound_dids-did_pattern$NWE</td></tr>\n";

		echo "<tr bgcolor=#$SSstd_row4_background><td align=center colspan=2><input style='background-color:#$SSbutton_color' type=submit name=SUBMIT value='"._QXZ("SUBMIT")."'></td></tr>\n";
		echo "</TABLE></center>\n";
		}
	else
		{
		echo _QXZ("You do not have permission to view this page")."\n";
		exit;
		}
	}


######################
# ADD=1511 display the ADD NEW CALL MENU SCREEN
######################
if ($ADD==1511)
	{
	if ($LOGmodify_dids==1)
		{
		##### BEGIN ID override optional section, if enabled it increments user by 1 ignoring entered value #####
		$stmt = "SELECT count(*) FROM vicidial_override_ids where id_table='vicidial_call_menu' and active='1';";
		$rslt=mysql_to_mysqli($stmt, $link);
		$voi_ct = mysqli_num_rows($rslt);
		if ($voi_ct > 0)
			{
			$row=mysqli_fetch_row($rslt);
			$voi_count = "$row[0]";
			}
		##### END ID override optional section #####

		echo "<TABLE><TR><TD>\n";
		echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

		echo "<img src=\"images/icon_callmenu.png\" alt=\"Call Menus\" width=42 height=42> "._QXZ("ADD A NEW CALL MENU")."<form action=$PHP_SELF method=POST>\n";
		echo "<input type=hidden name=ADD value=2511>\n";
		echo "<center><TABLE width=$section_width cellspacing=3>\n";
		if ($voi_count > 0)
			{
			echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Menu ID").": </td><td align=left>"._QXZ("Auto-Generated")." $NWB#call_menu-menu_id$NWE</td></tr>\n";
			}
		else
			{
			echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Menu ID").": </td><td align=left><input type=text name=menu_id size=40 maxlength=50> ("._QXZ("no spaces or special characters").")$NWB#call_menu-menu_id$NWE</td></tr>\n";
			}
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Menu Name").": </td><td align=left><input type=text name=menu_name size=50 maxlength=100>$NWB#call_menu-menu_name$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Admin User Group").": </td><td align=left><select size=1 name=user_group>\n";
		echo "$UUgroups_list";
		echo "<option SELECTED value=\"---ALL---\">"._QXZ("All Admin User Groups")."</option>\n";
		echo "</select>$NWB#call_menu-user_group$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=center colspan=2><input style='background-color:#$SSbutton_color' type=submit name=SUBMIT value='"._QXZ("SUBMIT")."'></td></tr>\n";
		echo "</TABLE></center>\n";
		}
	else
		{
		echo _QXZ("You do not have permission to view this page")."\n";
		exit;
		}
	}


######################
# ADD=1611 display the COPY CALL MENU SCREEN
######################
if ($ADD==1611)
	{
	if ($LOGmodify_dids==1)
		{
		##### BEGIN ID override optional section, if enabled it increments user by 1 ignoring entered value #####
		$stmt = "SELECT count(*) FROM vicidial_override_ids where id_table='vicidial_call_menu' and active='1';";
		$rslt=mysql_to_mysqli($stmt, $link);
		$voi_ct = mysqli_num_rows($rslt);
		if ($voi_ct > 0)
			{
			$row=mysqli_fetch_row($rslt);
			$voi_count = "$row[0]";
			}
		##### END ID override optional section #####

		echo "<TABLE><TR><TD>\n";
		echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

		echo "<img src=\"images/icon_callmenu.png\" alt=\"Call Menus\" width=42 height=42> "._QXZ("COPY CALL MENU")."<form action=$PHP_SELF method=POST>\n";
		echo "<input type=hidden name=ADD value=2611>\n";
		echo "<center><TABLE width=$section_width cellspacing=3>\n";
		if ($voi_count > 0)
			{
			echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Menu ID").": </td><td align=left>"._QXZ("Auto-Generated")." $NWB#call_menu-menu_id$NWE</td></tr>\n";
			}
		else
			{
			echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Menu ID").": </td><td align=left><input type=text name=menu_id size=40 maxlength=50> ("._QXZ("no spaces or special characters").")$NWB#call_menu-menu_id$NWE</td></tr>\n";
			}
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Menu Name").": </td><td align=left><input type=text name=menu_name size=50 maxlength=100>$NWB#call_menu-menu_name$NWE</td></tr>\n";

		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Source Menu").": </td><td align=left><select size=1 name=source_menu>\n";

		$stmt="SELECT menu_id,menu_name from vicidial_call_menu $whereLOGadmin_viewable_groupsSQL order by menu_id;";
		$rslt=mysql_to_mysqli($stmt, $link);
		$menus_to_print = mysqli_num_rows($rslt);
		$menus_list='';

		$o=0;
		while ($menus_to_print > $o) 
			{
			$rowx=mysqli_fetch_row($rslt);
			$menus_list .= "<option value=\"$rowx[0]\">$rowx[0] - $rowx[1]</option>\n";
			$o++;
			}
		echo "$menus_list";
		echo "</select>$NWB#call_menu-menu_id$NWE</td></tr>\n";

		echo "<tr bgcolor=#$SSstd_row4_background><td align=center colspan=2><input style='background-color:#$SSbutton_color' type=submit name=SUBMIT value='"._QXZ("SUBMIT")."'></td></tr>\n";
		echo "</TABLE></center>\n";
		}
	else
		{
		echo _QXZ("You do not have permission to view this page")."\n";
		exit;
		}
	}


######################
# ADD=1711 display the ADD NEW FILTER PHONE GROUP SCREEN
######################
if ($ADD==1711)
	{
	if ($LOGmodify_dids==1)
		{
		echo "<TABLE><TR><TD>\n";
		echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

		echo "<img src=\"images/icon_filterphonegroup.png\" alt=\"Filter Phone Groups\" width=42 height=42> "._QXZ("Add Filter Phone Group")."<form action=$PHP_SELF method=POST>\n";
		echo "<input type=hidden name=ADD value=2711>\n";
		echo "<center><TABLE width=$section_width cellspacing=3>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Filter Phone Group ID").": </td><td align=left><input type=text name=filter_phone_group_id size=20 maxlength=20> ("._QXZ("no spaces or special characters").")$NWB#filter_phone_groups-filter_phone_group_id$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Filter Phone Group Name").": </td><td align=left><input type=text name=filter_phone_group_name size=40 maxlength=40>$NWB#filter_phone_groups-filter_phone_group_name$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Filter Phone Group Description").": </td><td align=left><input type=text name=filter_phone_group_description size=60 maxlength=100>$NWB#filter_phone_groups-filter_phone_group_description$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Admin User Group").": </td><td align=left><select size=1 name=user_group>\n";
		echo "$UUgroups_list";
		echo "<option SELECTED value=\"---ALL---\">"._QXZ("All Admin User Groups")."</option>\n";
		echo "</select>$NWB#filter_phone_groups-user_group$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=center colspan=2><input style='background-color:#$SSbutton_color' type=submit name=SUBMIT value='"._QXZ("SUBMIT")."'></td></tr>\n";
		echo "</TABLE></center>\n";
		}
	else
		{
		echo _QXZ("You do not have permission to view this page")."\n";
		exit;
		}
	}


######################
# ADD=11111 display the ADD NEW REMOTE AGENTS SCREEN
######################
if ($ADD==11111)
	{
	if ( ($LOGmodify_remoteagents==1) and ($x_ra_carrier < 1) )
		{
		echo "<TABLE><TR><TD>\n";
		echo "<img src=\"images/icon_black_remoteagents.png\" alt=\"Remote Agents\" width=42 height=42> <FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

		echo "<br>"._QXZ("ADD NEW REMOTE AGENTS")."<form action=$PHP_SELF method=POST>\n";
		echo "<input type=hidden name=ADD value=21111>\n";
		echo "<center><TABLE width=$section_width cellspacing=3>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("User ID Start").": </td><td align=left><input type=text name=user_start size=9 maxlength=9> ("._QXZ("numbers only, incremented, must be an existing vicidial user").")$NWB#remote_agents-user_start$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Number of Lines").": </td><td align=left><input type=text name=number_of_lines size=3 maxlength=3> ("._QXZ("numbers only").")$NWB#remote_agents-number_of_lines$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Server IP").": </td><td align=left><select size=1 name=server_ip>\n";
		echo "$servers_list";
		echo "</select>$NWB#remote_agents-server_ip$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("External Extension").": </td><td align=left><input type=text name=conf_exten size=20 maxlength=20> ("._QXZ("dial plan number dialed to reach agents").")$NWB#remote_agents-conf_exten$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Status").": </td><td align=left><select size=1 name=status><option value='ACTIVE'>"._QXZ("ACTIVE")."</option><option value=\"INACTIVE\" SELECTED>"._QXZ("INACTIVE")."</option></select>$NWB#remote_agents-status$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Campaign").": </td><td align=left><select size=1 name=campaign_id>\n";
		echo "$campaigns_list";
		echo "</select>$NWB#remote_agents-campaign_id$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Inbound Groups").": </td><td align=left>\n";
		echo "$groups_list";
		echo "$NWB#remote_agents-closer_campaigns$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=center colspan=2><input style='background-color:#$SSbutton_color' type=submit name=SUBMIT value='"._QXZ("SUBMIT")."'></td></tr>\n";
		echo "</TABLE></center>\n";
		echo _QXZ("NOTE: It can take up to 30 seconds for changes submitted on this screen to go live")."\n";
		}
	else
		{
		echo _QXZ("You do not have permission to view this page")."\n";
		exit;
		}
	}


######################
# ADD=12111 display the ADD NEW EXTENSION GROUP SCREEN
######################
if ($ADD==12111)
	{
	if ($LOGmodify_remoteagents==1)
		{
		echo "<TABLE><TR><TD>\n";
		echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

		echo "<br>"._QXZ("Add Extension Group Entry")."<form action=$PHP_SELF method=POST>\n";
		echo "<input type=hidden name=ADD value=22111>\n";
		echo "<center><TABLE width=$section_width cellspacing=3>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Extension Group").": </td><td align=left><input type=text name=extension_group_id size=20 maxlength=20> ("._QXZ("no spaces").")$NWB#extension_groups-extension_group_id$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Extension").": </td><td align=left><input type=text name=extension size=18 maxlength=18> ("._QXZ("numbers only").")$NWB#extension_groups-extension$NWE</td></tr>\n";

		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Rank").": </td><td align=left><select size=1 name=rank>\n";
		$n=99; $rank=0;
		while ($n>=-99)
			{
			if ($n == $rank) 
				{echo "<option SELECTED value=\"$n\">$n</option>\n";}
			else
				{echo "<option value=\"$n\">$n</option>\n";}
			$n--;
			}
		echo "</select> $NWB#extension_groups-rank$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Campaigns Groups").": </td><td align=left><input type=text name=campaign_groups size=50 maxlength=255> ("._QXZ("pipe-delimited list").")$NWB#extension_groups-campaign_groups$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=center colspan=2><input style='background-color:#$SSbutton_color' type=submit name=SUBMIT value='"._QXZ("SUBMIT")."'></td></tr>\n";
		echo "</TABLE></center>\n";
		}
	else
		{
		echo _QXZ("You do not have permission to view this page")."\n";
		exit;
		}
	}


######################
# ADD=111111 display the ADD NEW USER GROUP SCREEN
######################
if ($ADD==111111)
	{
	if ($LOGmodify_usergroups==1)
		{
		##### BEGIN ID override optional section, if enabled it increments user by 1 ignoring entered value #####
		$stmt = "SELECT count(*) FROM vicidial_override_ids where id_table='vicidial_user_groups' and active='1';";
		$rslt=mysql_to_mysqli($stmt, $link);
		$voi_ct = mysqli_num_rows($rslt);
		if ($voi_ct > 0)
			{
			$row=mysqli_fetch_row($rslt);
			$voi_count = "$row[0]";
			}
		##### END ID override optional section #####

		echo "<TABLE><TR><TD>\n";
		echo "<img src=\"images/icon_black_usergroups.png\" alt=\"User Groups\" width=42 height=42> <FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

		echo "<br>"._QXZ("ADD NEW USERS GROUP")."<form action=$PHP_SELF method=POST>\n";
		echo "<input type=hidden name=ADD value=211111>\n";
		echo "<center><TABLE width=$section_width cellspacing=3>\n";
		if ($voi_count > 0)
			{
			echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Group").": </td><td align=left>"._QXZ("Auto-Generated")." $NWB#user_groups-user_group$NWE</td></tr>\n";
			}
		else
			{
			echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Group").": </td><td align=left><input type=text name=user_group size=15 maxlength=20> ("._QXZ("no spaces or punctuation").")$NWB#user_groups-user_group$NWE</td></tr>\n";
			}
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Description").": </td><td align=left><input type=text name=group_name size=40 maxlength=40> ("._QXZ("description of group").")$NWB#user_groups-group_name$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=center colspan=2><input style='background-color:#$SSbutton_color' type=submit name=SUBMIT value='"._QXZ("SUBMIT")."'></td></tr>\n";
		echo "</TABLE></center>\n";
		}
	else
		{
		echo _QXZ("You do not have permission to view this page")."\n";
		exit;
		}
	}


######################
# ADD=1111111 display the ADD NEW SCRIPT SCREEN
######################
if ($ADD==1111111)
	{
	if ($LOGmodify_scripts==1)
		{
		##### BEGIN ID override optional section, if enabled it increments user by 1 ignoring entered value #####
		$stmt = "SELECT count(*) FROM vicidial_override_ids where id_table='vicidial_scripts' and active='1';";
		$rslt=mysql_to_mysqli($stmt, $link);
		$voi_ct = mysqli_num_rows($rslt);
		if ($voi_ct > 0)
			{
			$row=mysqli_fetch_row($rslt);
			$voi_count = "$row[0]";
			}
		##### END ID override optional section #####

		echo "<TABLE><TR><TD>\n";
		echo "<img src=\"images/icon_black_scripts.png\" alt=\"Scripts\" width=42 height=42> <FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

		echo "<br>"._QXZ("ADD NEW SCRIPT")."<form name=scriptForm action=$PHP_SELF method=POST>\n";
		echo "<input type=hidden name=ADD value=2111111>\n";
		echo "<input type=hidden name=DB value=\"$DB\">\n";
		echo "<center><TABLE width=$section_width cellspacing=3>\n";
		if ($voi_count > 0)
			{
			echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Script ID").": </td><td align=left>"._QXZ("Auto-Generated")." $NWB#scripts-script_id$NWE</td></tr>\n";
			}
		else
			{
			echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Script ID").": </td><td align=left><input type=text name=script_id size=22 maxlength=20> ("._QXZ("no spaces or punctuation").")$NWB#scripts-script_id$NWE</td></tr>\n";
			}
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Script Name").": </td><td align=left><input type=text name=script_name size=40 maxlength=50> ("._QXZ("title of the script").")$NWB#scripts-script_name$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Script Comments").": </td><td align=left><input type=text name=script_comments size=50 maxlength=255> $NWB#scripts-script_comments$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Active").": </td><td align=left><select size=1 name=active><option value='Y' SELECTED>"._QXZ("Y")."</option><option value='N'>"._QXZ("N")."</option></select>$NWB#scripts-active$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Admin User Group").": </td><td align=left><select size=1 name=user_group>\n";
		echo "$UUgroups_list";
		echo "<option SELECTED value=\"---ALL---\">"._QXZ("All Admin User Groups")."</option>\n";
		echo "</select>$NWB#scripts-user_group$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Script Text").": </td><td align=left>";
		# BEGIN Insert Field
		echo "<select id=\"selectedField\" name=\"selectedField\">";
		echo "<option value=\"fullname\">"._QXZ("Agent Name")."(fullname)</option>";
		echo "<option>vendor_lead_code</option>";
		echo "<option>source_id</option>";
		echo "<option>list_id</option>";
		echo "<option>list_name</option>";
		echo "<option>list_description</option>";
		echo "<option>gmt_offset_now</option>";
		echo "<option>called_since_last_reset</option>";
		echo "<option>phone_code</option>";
		echo "<option>phone_number</option>";
		echo "<option>title</option>";
		echo "<option>first_name</option>";
		echo "<option>middle_initial</option>";
		echo "<option>last_name</option>";
		echo "<option>address1</option>";
		echo "<option>address2</option>";
		echo "<option>address3</option>";
		echo "<option>city</option>";
		echo "<option>state</option>";
		echo "<option>province</option>";
		echo "<option>postal_code</option>";
		echo "<option>country_code</option>";
		echo "<option>gender</option>";
		echo "<option>date_of_birth</option>";
		echo "<option>alt_phone</option>";
		echo "<option>email</option>";
		echo "<option>security_phrase</option>";
		echo "<option>comments</option>";
		echo "<option>lead_id</option>";
		echo "<option>campaign</option>";
		echo "<option>phone_login</option>";
		echo "<option>group</option>";
		echo "<option>channel_group</option>";
		echo "<option>SQLdate</option>";
		echo "<option>epoch</option>";
		echo "<option>uniqueid</option>";
		echo "<option>customer_zap_channel</option>";
		echo "<option>server_ip</option>";
		echo "<option>SIPexten</option>";
		echo "<option>session_id</option>";
		echo "<option>dialed_number</option>";
		echo "<option>dialed_label</option>";
		echo "<option>rank</option>";
		echo "<option>owner</option>";
		echo "<option>camp_script</option>";
		echo "<option>in_script</option>";
		echo "<option>script_width</option>";
		echo "<option>script_height</option>";
		echo "<option>recording_filename</option>";
		echo "<option>recording_id</option>";
		echo "<option>user_custom_one</option>";
		echo "<option>user_custom_two</option>";
		echo "<option>user_custom_three</option>";
		echo "<option>user_custom_four</option>";
		echo "<option>user_custom_five</option>";
		echo "<option>preset_number_a</option>";
		echo "<option>preset_number_b</option>";
		echo "<option>preset_number_c</option>";
		echo "<option>preset_number_d</option>";
		echo "<option>preset_number_e</option>";
		echo "<option>preset_number_f</option>";
		echo "<option>preset_dtmf_a</option>";
		echo "<option>preset_dtmf_b</option>";
		echo "<option>did_id</option>";
		echo "<option>did_extension</option>";
		echo "<option>did_pattern</option>";
		echo "<option>did_description</option>";
		echo "<option>closecallid</option>";
		echo "<option>xfercallid</option>";
		echo "<option>agent_log_id</option>";
		echo "<option>entry_list_id</option>";
		echo "<option>call_id</option>";
		echo "<option>user_group</option>";
		echo "<option>called_count</option>";
		echo "<option>TABLEper_call_notes</option>";
		echo "<option>agent_email</option>";
		echo "</select>";
		echo "<input type=\"button\" name=\"insertField\" value=\""._QXZ("Insert")."\" onClick=\"scriptInsertField();\"><BR>";
		# END Insert Field
		echo "<TEXTAREA NAME=script_text ROWS=20 COLS=50 value=\"\"></TEXTAREA> $NWB#scripts-script_text$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=center colspan=2><input style='background-color:#$SSbutton_color' type=submit name=SUBMIT value='"._QXZ("SUBMIT")."'></td></tr>\n";
		echo "</TABLE></center>\n";
		}
	else
		{
		echo _QXZ("You do not have permission to view this page")."\n";
		exit;
		}
	}


######################
# ADD=11111111 display the ADD NEW FILTER SCREEN
######################
if ($ADD==11111111)
	{
	if ($LOGmodify_filters==1)
		{
		##### BEGIN ID override optional section, if enabled it increments user by 1 ignoring entered value #####
		$stmt = "SELECT count(*) FROM vicidial_override_ids where id_table='vicidial_lead_filters' and active='1';";
		$rslt=mysql_to_mysqli($stmt, $link);
		$voi_ct = mysqli_num_rows($rslt);
		if ($voi_ct > 0)
			{
			$row=mysqli_fetch_row($rslt);
			$voi_count = "$row[0]";
			}
		##### END ID override optional section #####

		echo "<TABLE><TR><TD>\n";
		echo "<img src=\"images/icon_black_filters.png\" alt=\"Filters\" width=42 height=42> <FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

		echo "<br>"._QXZ("ADD NEW FILTER")."<form action=$PHP_SELF method=POST>\n";
		echo "<input type=hidden name=ADD value=21111111>\n";
		echo "<center><TABLE width=$section_width cellspacing=3>\n";
		if ($voi_count > 0)
			{
			echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Filter ID").": </td><td align=left>"._QXZ("Auto-Generated")." $NWB#lead_filters-lead_filter_id$NWE</td></tr>\n";
			}
		else
			{
			echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Filter ID").": </td><td align=left><input type=text name=lead_filter_id size=22 maxlength=20> ("._QXZ("no spaces or punctuation").")$NWB#lead_filters-lead_filter_id$NWE</td></tr>\n";
			}
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Filter Name").": </td><td align=left><input type=text name=lead_filter_name size=30 maxlength=30> ("._QXZ("short description of the filter").")$NWB#lead_filters-lead_filter_name$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Filter Comments").": </td><td align=left><input type=text name=lead_filter_comments size=50 maxlength=255> $NWB#lead_filters-lead_filter_comments$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Admin User Group").": </td><td align=left><select size=1 name=user_group>\n";
		echo "$UUgroups_list";
		echo "<option SELECTED value=\"---ALL---\">"._QXZ("All Admin User Groups")."</option>\n";
		echo "</select>$NWB#lead_filters-user_group$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Filter SQL").": </td><td align=left><TEXTAREA NAME=lead_filter_sql ROWS=20 COLS=50 value=\"\"></TEXTAREA> $NWB#lead_filters-lead_filter_sql$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=center colspan=2><input style='background-color:#$SSbutton_color' type=submit name=SUBMIT value='"._QXZ("SUBMIT")."'></td></tr>\n";
		echo "</TABLE></center>\n";
		}
	else
		{
		echo _QXZ("You do not have permission to view this page")."\n";
		exit;
		}
	}


######################
# ADD=111111111 display the ADD NEW CALL TIME SCREEN
######################
if ($ADD==111111111)
	{
	if ($LOGmodify_call_times==1)
		{
		echo "<TABLE><TR><TD>\n";
		echo "<img src=\"images/icon_calltimes.png\" alt=\"Call Times\" width=42 height=42> <FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

		echo "<br>"._QXZ("ADD NEW CALL TIME")."<form action=$PHP_SELF method=POST>\n";
		echo "<input type=hidden name=ADD value=211111111>\n";
		echo "<center><TABLE width=$section_width cellspacing=3>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Call Time ID").": </td><td align=left><input type=text name=call_time_id size=12 maxlength=10> ("._QXZ("no spaces or punctuation").")$NWB#call_times-call_time_id$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Call Time Name").": </td><td align=left><input type=text name=call_time_name size=30 maxlength=30> ("._QXZ("short description of the call time").")$NWB#call_times-call_time_name$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Call Time Comments").": </td><td align=left><input type=text name=call_time_comments size=50 maxlength=255> $NWB#call_times-call_time_comments$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Admin User Group").": </td><td align=left><select size=1 name=user_group>\n";
		echo "$UUgroups_list";
		echo "<option SELECTED value=\"---ALL---\">"._QXZ("All Admin User Groups")."</option>\n";
		echo "</select>$NWB#call_times-user_group$NWE</td></tr>\n";

		echo "<tr bgcolor=#$SSstd_row4_background><td align=center colspan=2>"._QXZ("Day and time options will appear once you have created the Call Time Definition")."</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=center colspan=2><input style='background-color:#$SSbutton_color' type=submit name=SUBMIT value='"._QXZ("SUBMIT")."'></td></tr>\n";
		echo "</TABLE></center>\n";
		}
	else
		{
		echo _QXZ("You do not have permission to view this page")."\n";
		exit;
		}
	}


######################
# ADD=1111111111 display the ADD NEW STATE CALL TIME SCREEN
######################
if ($ADD==1111111111)
	{
	if ($LOGmodify_call_times==1)
		{
		echo "<TABLE><TR><TD>\n";
		echo "<img src=\"images/icon_calltimes.png\" alt=\"State Call Times\" width=42 height=42> <FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

		echo "<br>"._QXZ("ADD NEW STATE CALL TIME")."<form action=$PHP_SELF method=POST>\n";
		echo "<input type=hidden name=ADD value=2111111111>\n";
		echo "<center><TABLE width=$section_width cellspacing=3>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("State Call Time ID").": </td><td align=left><input type=text name=call_time_id size=12 maxlength=10> ("._QXZ("no spaces or punctuation").")$NWB#call_times-call_time_id$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("State Call Time State").": </td><td align=left><input type=text name=state_call_time_state size=4 maxlength=2> ("._QXZ("no spaces or punctuation").")$NWB#call_times-state_call_time_state$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("State Call Time Name").": </td><td align=left><input type=text name=call_time_name size=30 maxlength=30> ("._QXZ("short description of the call time").")$NWB#call_times-call_time_name$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("State Call Time Comments").": </td><td align=left><input type=text name=call_time_comments size=50 maxlength=255> $NWB#call_times-call_time_comments$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Admin User Group").": </td><td align=left><select size=1 name=user_group>\n";
		echo "$UUgroups_list";
		echo "<option SELECTED value=\"---ALL---\">"._QXZ("All Admin User Groups")."</option>\n";
		echo "</select>$NWB#call_times-user_group$NWE</td></tr>\n";

		echo "<tr bgcolor=#$SSstd_row4_background><td align=center colspan=2>"._QXZ("Day and time options will appear once you have created the Call Time Definition")."</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=center colspan=2><input style='background-color:#$SSbutton_color' type=submit name=SUBMIT value='"._QXZ("SUBMIT")."'></td></tr>\n";
		echo "</TABLE></center>\n";
		}
	else
		{
		echo _QXZ("You do not have permission to view this page")."\n";
		exit;
		}
	}


######################
# ADD=1211111111 display the ADD NEW HOLIDAY SCREEN
######################
if ($ADD==1211111111)
	{
	if ($LOGmodify_call_times==1)
		{
		echo "<TABLE><TR><TD>\n";
		echo "<img src=\"images/icon_calltimes.png\" alt=\"Holidays\" width=42 height=42> <FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

		echo "<br>"._QXZ("ADD NEW STATE CALL TIME")."<form action=$PHP_SELF method=POST name=vicidial_report id=vicidial_report>\n";
		echo "<input type=hidden name=ADD value=2211111111>\n";
		echo "<center><TABLE width=$section_width cellspacing=3>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Holiday ID").": </td><td align=left><input type=text name=holiday_id size=20 maxlength=30> ("._QXZ("no spaces or punctuation").")$NWB#call_times-holiday_id$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Holiday Name").": </td><td align=left><input type=text name=holiday_name size=50 maxlength=100> ("._QXZ("short description of the holiday").")$NWB#call_times-holiday_name$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Holiday Comments").": </td><td align=left><input type=text name=holiday_comments size=50 maxlength=255> $NWB#call_times-holiday_comments$NWE</td></tr>\n";

		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Holiday Date").": </td><td align=left><input type=text name=holiday_date id=holiday_date size=10 maxlength=10> $NWB#call_times-holiday_date$NWE\n";
		echo "<script language=\"JavaScript\">\n";
		echo "var o_cal = new tcal ({\n";
		echo "	// form name\n";
		echo "	'formname': 'vicidial_report',\n";
		echo "	// input name\n";
		echo "	'controlname': 'holiday_date'\n";
		echo "});\n";
		echo "o_cal.a_tpl.yearscroll = false;\n";
		echo "// o_cal.a_tpl.weekstart = 1; // Monday week start\n";
		echo "</script></td></tr>\n";

		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Admin User Group").": </td><td align=left><select size=1 name=user_group>\n";
		echo "$UUgroups_list";
		echo "<option SELECTED value=\"---ALL---\">"._QXZ("All Admin User Groups")."</option>\n";
		echo "</select>$NWB#call_times-user_group$NWE</td></tr>\n";

		echo "<tr bgcolor=#$SSstd_row4_background><td align=center colspan=2>"._QXZ("Day and time options will appear once you have created the Holiday Definition")."</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=center colspan=2><input style='background-color:#$SSbutton_color' type=submit name=SUBMIT value='"._QXZ("SUBMIT")."'></td></tr>\n";
		echo "</TABLE></center>\n";
		}
	else
		{
		echo _QXZ("You do not have permission to view this page")."\n";
		exit;
		}
	}


######################
# ADD=131111111 display the ADD NEW SHIFT SCREEN
######################
if ($ADD==131111111)
	{
	if ( ($LOGmodify_call_times==1) or ($LOGmodify_shifts==1) )
		{
		echo "<TABLE><TR><TD>\n";
		echo "<img src=\"images/icon_shifts.png\" alt=\"Shifts\" width=42 height=42> <FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

		echo "<br>"._QXZ("ADD NEW SHIFT")."<form action=$PHP_SELF method=POST>\n";
		echo "<input type=hidden name=ADD value=231111111>\n";
		echo "<center><TABLE width=$section_width cellspacing=3>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Shift ID").": </td><td align=left><input type=text name=shift_id size=22 maxlength=20> ("._QXZ("no spaces or punctuation").")$NWB#shifts-shift_id$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Shift Name").": </td><td align=left><input type=text name=shift_name size=50 maxlength=50> ("._QXZ("short description of the shift").")$NWB#shifts-shift_name$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Admin User Group").": </td><td align=left><select size=1 name=user_group>\n";
		echo "$UUgroups_list";
		echo "<option SELECTED value=\"---ALL---\">"._QXZ("All Admin User Groups")."</option>\n";
		echo "</select>$NWB#shifts-user_group$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Shift Start Time").": </td><td align=left><input type=text name=shift_start_time size=5 maxlength=4 id=shift_start_time>\n";
		echo " &nbsp; "._QXZ("Shift End Time").": <input type=text name=shift_end_time size=5 maxlength=4 id=shift_end_time>\n";
		echo "<input style='background-color:#$SSbutton_color' type=button name=shift_calc value=\""._QXZ("Calculate Shift Length")."\" onClick=\"shift_time();\"> $NWB#shifts-shift_start_time$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Shift Length").": </td><td align=left><input type=text name=shift_length id=shift_length size=6 maxlength=5> $NWB#shifts-shift_length$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Shift Weekdays").": <BR>$NWB#shifts-shift_weekdays$NWE</td><td align=left>\n";
		echo "<input type=\"checkbox\" name=\"shift_weekdays[]\" value=\"0\">Sunday<BR>\n";
		echo "<input type=\"checkbox\" name=\"shift_weekdays[]\" value=\"1\">Monday<BR>\n";
		echo "<input type=\"checkbox\" name=\"shift_weekdays[]\" value=\"2\">Tuesday<BR>\n";
		echo "<input type=\"checkbox\" name=\"shift_weekdays[]\" value=\"3\">Wednesday<BR>\n";
		echo "<input type=\"checkbox\" name=\"shift_weekdays[]\" value=\"4\">Thursday<BR>\n";
		echo "<input type=\"checkbox\" name=\"shift_weekdays[]\" value=\"5\">Friday<BR>\n";
		echo "<input type=\"checkbox\" name=\"shift_weekdays[]\" value=\"6\">Saturday<BR>\n";
		echo "</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Report Option").": </td><td align=left><select size=1 name=report_option><option value='Y'>"._QXZ("Y")."</option><option value=\"N\" SELECTED>"._QXZ("N")."</option></select>$NWB#shifts-report_option$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=center colspan=2><input style='background-color:#$SSbutton_color' type=submit name=SUBMIT value='"._QXZ("SUBMIT")."'></td></tr>\n";
		echo "</TABLE></center>\n";
		}
	else
		{
		echo _QXZ("You do not have permission to view this page")."\n";
		exit;
		}
	}


######################
# ADD=11111111111 display the ADD NEW PHONE SCREEN
######################
if ($ADD==11111111111)
	{
	if ( ($LOGast_admin_access==1) or ($LOGmodify_phones==1) )
		{
		##### BEGIN ID override optional section, if enabled it increments user by 1 ignoring entered value #####
		$stmt = "SELECT count(*) FROM vicidial_override_ids where id_table='phones' and active='1';";
		$rslt=mysql_to_mysqli($stmt, $link);
		$voi_ct = mysqli_num_rows($rslt);
		if ($voi_ct > 0)
			{
			$row=mysqli_fetch_row($rslt);
			$voi_count = "$row[0]";
			}
		##### END ID override optional section #####

		echo "<TABLE><TR><TD>\n";
		echo "<img src=\"images/icon_phones.png\" alt=\"Phones\" width=42 height=42> <FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

		echo "<br>"._QXZ("ADD A NEW PHONE")."<form action=$PHP_SELF method=POST>\n";

		##### Lookup settings container #####
		$SScontainer_stmt="select phone_defaults_container from system_settings limit 1";
		$SScontainer_rslt=mysql_to_mysqli($SScontainer_stmt, $link);
		$SScontainer_row=mysqli_fetch_row($SScontainer_rslt);
		$dps=array(); # Default phone setting array
		if (!preg_match('/\-\-\-DISABLED\-\-\-/', $SScontainer_row[0]))
			{
			$container_stmt="select container_entry from vicidial_settings_containers where container_id='$SScontainer_row[0]'";
			$container_rslt=mysql_to_mysqli($container_stmt, $link);
			$container_entry="";
			if (mysqli_num_rows($container_rslt)>0)
				{
				echo "<B><font color='#F00'>"._QXZ("Using default phone setting container")." $SScontainer_row[0]...</font></B><BR>\n";
				$container_row=mysqli_fetch_row($container_rslt);
				$container_entry=$container_row[0];
				$container_entry_array=explode("\n", $container_entry);
				for ($c=0; $c<count($container_entry_array); $c++)
					{
					$container_line=trim($container_entry_array[$c]);
					if (!preg_match('/^\#/', $container_line))
						{
						$current_setting_array=explode("=>", $container_line);
						if (strlen(trim($current_setting_array[0]))>0 && strlen(trim($current_setting_array[1]))>0)
							{
							# $$current_setting_array[0]=$current_setting_array[1];
							$dps[trim($current_setting_array[0])]=trim($current_setting_array[1]);
							}
						}
					}
				}
			}

		echo "<input type=hidden name=ADD value=21111111111>\n";
		echo "<center><TABLE width=$section_width cellspacing=3>\n";

		echo "<center><TABLE width=$section_width cellspacing=3>\n";
		if ($voi_count > 0)
			{
			echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Phone Extension").": </td><td align=left>"._QXZ("Auto-Generated")." $NWB#phones-extension$NWE</td></tr>\n";
			}
		else
			{
			echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Phone Extension").": </td><td align=left><input type=text name=extension size=20 maxlength=100 value=\"\">$NWB#phones-extension$NWE</td></tr>\n";
			}
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Dial Plan Number").": </td><td align=left><input type=text name=dialplan_number size=15 maxlength=20> ("._QXZ("digits only").")$NWB#phones-dialplan_number$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Voicemail Box").": </td><td align=left><input type=text name=voicemail_id size=10 maxlength=10 value='".$dps["voicemail_id"]."'> ("._QXZ("digits only").")$NWB#phones-voicemail_id$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Outbound CallerID").": </td><td align=left><input type=text name=outbound_cid size=10 maxlength=20 value='".$dps["outbound_cid"]."'> ("._QXZ("digits only").")$NWB#phones-outbound_cid$NWE</td></tr>\n";
#		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>Phone IP address: </td><td align=left><input type=text name=phone_ip size=20 maxlength=15> (optional)$NWB#phones-phone_ip$NWE</td></tr>\n";
#		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>Computer IP address: </td><td align=left><input type=text name=computer_ip size=20 maxlength=15> (optional)$NWB#phones-computer_ip$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Admin User Group").": </td><td align=left><select size=1 name=user_group>\n";
		$s="SELECTED";
		if ($dps["user_group"])
			{
			echo "<option SELECTED value=\"".$dps["user_group"]."\">".$dps["user_group"]."</option>\n";
			$s="";
			}
		echo "$UUgroups_list";
		echo "<option $s value=\"---ALL---\">"._QXZ("All Admin User Groups")."</option>\n";
		echo "</select>$NWB#phones-user_group$NWE</td></tr>\n";

		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Server IP").": </td><td align=left><select size=1 name=server_ip>\n";
		if ($dps["server_ip"])
			{
			echo "<option SELECTED value=\"".$dps["server_ip"]."\">".$dps["server_ip"]."</option>\n";
			}
		echo "$servers_list";
		echo "</select>$NWB#phones-server_ip$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Agent Screen Login").": </td><td align=left><input type=text name=login size=15 maxlength=15>$NWB#phones-login$NWE</td></tr>\n";
		if ($dps["pass"])
			{
			$SSdefault_phone_login_password=$dps["pass"];
			}
		if ($dps["conf_secret"])
			{
			$SSdefault_phone_registration_password=$dps["conf_secret"];
			}
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Login Password").": </td><td align=left><input type=text name=pass size=40 maxlength=100 value=\"$SSdefault_phone_login_password\">$NWB#phones-pass$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Registration Password").": </td><td align=left style=\"display:table-cell; vertical-align:middle;\" NOWRAP><input type=text id=reg_pass name=conf_secret size=40 maxlength=100 value=\"$SSdefault_phone_registration_password\" onkeyup=\"return pwdChanged('reg_pass','reg_pass_img','pass_length','$SSrequire_password_length');\">$NWB#phones-conf_secret$NWE &nbsp; &nbsp; <font size=1>"._QXZ("Strength").":</font> <IMG id=reg_pass_img src='images/pixel.gif' style=\"vertical-align:middle;\" onLoad=\"return pwdChanged('reg_pass','reg_pass_img','pass_length','$SSrequire_password_length');\"> &nbsp; <font size=1> "._QXZ("Length").": <span id=pass_length name=pass_length>0</span></font></td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Status").": </td><td align=left><select size=1 name=status>";
		
		if ($dps["status"])
			{
			echo "<option value='".$dps["status"]."' SELECTED>".$dps["status"]."</option>";
			echo "<option value='ACTIVE'>"._QXZ("ACTIVE")."</option>";
			}
		else
			{
			echo "<option value='ACTIVE' SELECTED>"._QXZ("ACTIVE")."</option>";
			}
		echo "<option value='SUSPENDED'>"._QXZ("SUSPENDED")."</option><option value='CLOSED'>"._QXZ("CLOSED")."</option><option value='PENDING'>"._QXZ("PENDING")."</option><option value='ADMIN'>"._QXZ("ADMIN")."</option></select>$NWB#phones-status$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Active Account").": </td><td align=left><select size=1 name=active>";
		
		echo "<option value='Y' ".($dps["active"]!="N" ? "selected" : "").">"._QXZ("Y")."</option><option value='N' ".($dps["active"]=="N" ? "selected" : "").">"._QXZ("N")."</option></select>$NWB#phones-active$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Phone Type").": </td><td align=left><input type=text name=phone_type size=20 maxlength=50 value='".$dps["phone_type"]."'>$NWB#phones-phone_type$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Full Name").": </td><td align=left><input type=text name=fullname size=20 maxlength=50>$NWB#phones-fullname$NWE</td></tr>\n";
#		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>Company: </td><td align=left><input type=text name=company size=10 maxlength=10>$NWB#phones-company$NWE</td></tr>\n";
#		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>Picture: </td><td align=left><input type=text name=picture size=20 maxlength=19>$NWB#phones-picture$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Client Protocol").": </td><td align=left><select size=1 name=protocol>";
		$SIP_selected=0;
		if ($dps["protocol"])
			{
			echo "<option value='".$dps["protocol"]."' SELECTED>".$dps["protocol"]."</option>";
			if ( ($SSallowed_sip_stacks == 'SIP') or ($SSallowed_sip_stacks == 'SIP_and_PJSIP') ) {echo "<option>SIP</option>";}
			$SIP_selected++;
			}
		else
			{
			if ( ($SSallowed_sip_stacks == 'SIP') or ($SSallowed_sip_stacks == 'SIP_and_PJSIP') ) {echo "<option SELECTED>SIP</option>";   $SIP_selected++;}
			}
		$PJSIP_selected='';
		if ($SIP_selected < 1) {$PJSIP_selected = ' SELECTED';}
		if ( ($SSallowed_sip_stacks == 'PJSIP') or ($SSallowed_sip_stacks == 'SIP_and_PJSIP') ) {echo "<option$PJSIP_selected>PJSIP</option>";}
		echo "<option>Zap</option><option>IAX2</option><option value='EXTERNAL'>"._QXZ("EXTERNAL")."</option><option>DAHDI</option></select>$NWB#phones-protocol$NWE</td></tr>\n";
		if ($dps["local_gmt"])
			{
			$SSdefault_local_gmt=$dps["local_gmt"];
			}
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Local GMT").": </td><td align=left><select size=1 name=local_gmt><option>12.75</option><option>12.00</option><option>11.00</option><option>10.00</option><option>9.50</option><option>9.00</option><option>8.00</option><option>7.00</option><option>6.50</option><option>6.00</option><option>5.75</option><option>5.50</option><option>5.00</option><option>4.50</option><option>4.00</option><option>3.50</option><option>3.00</option><option>2.00</option><option>1.00</option><option>0.00</option><option>-1.00</option><option>-2.00</option><option>-3.00</option><option>-3.50</option><option>-4.00</option><option>-5.00</option><option>-6.00</option><option>-7.00</option><option>-8.00</option><option>-9.00</option><option>-10.00</option><option>-11.00</option><option>-12.00</option><option SELECTED>$SSdefault_local_gmt</option></select> ("._QXZ("Do NOT Adjust for DST").")$NWB#phones-local_gmt$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=center colspan=2><input style='background-color:#$SSbutton_color' type=submit name=submit value='"._QXZ("SUBMIT")."'</td></tr>\n";
		echo "</TABLE></center>\n";
		}
	else
		{
		echo _QXZ("You do not have permission to view this page")."\n";
		exit;
		}
	}

######################
# ADD=21222222222 adds copied new phone to the system
######################
if ($ADD==21222222222)
	{
	$source_phone_array=explode("|", $source_phone);
	$source_extension=$source_phone_array[0];
	$source_server_ip=$source_phone_array[1];
	if ($add_copy_disabled > 0)
		{
		echo "<br>"._QXZ("You do not have permission to add records on this system")." -system_settings-\n";
		}
	 else
		{
		$stmt="SELECT count(*) from phones where extension='$source_extension' and server_ip='$source_server_ip';";
		$rslt=mysql_to_mysqli($stmt, $link);
		$row=mysqli_fetch_row($rslt);
		if ($row[0] < 1)
			{
			echo "<br>"._QXZ("PHONE NOT COPIED - Your selected Source Phone does not exist")."\n";
			}
		 else
			{
			echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";
			$stmt="SELECT count(*) from phones where extension='$new_extension' and server_ip='$new_server_ip';";
			$rslt=mysql_to_mysqli($stmt, $link);
			$row=mysqli_fetch_row($rslt);
			if ($row[0] > 0)
				{echo "<br>"._QXZ("PHONE NOT COPIED - there is already a phone in the system with this extension/server")."\n";}
			else
				{
				$stmt="SELECT count(*) from phones where login='$new_login';";
				$rslt=mysql_to_mysqli($stmt, $link);
				$row=mysqli_fetch_row($rslt);
				if ($row[0] > 0)
					{echo "<br>"._QXZ("PHONE NOT COPIED - there is already a Phone in the system with this login")."\n";}
				else
					{
					$stmt="SELECT count(*) from phones_alias where alias_id='$new_login';";
					$rslt=mysql_to_mysqli($stmt, $link);
					$row=mysqli_fetch_row($rslt);
					if ($row[0] > 0)
						{echo "<br>"._QXZ("PHONE NOT COPIED - there is already a Phone alias in the system with this login")."\n";}
					else
						{
						$stmt="SELECT count(*) from vicidial_voicemail where voicemail_id='$new_voicemail_id';";
						$rslt=mysql_to_mysqli($stmt, $link);
						$row=mysqli_fetch_row($rslt);
						if ($row[0] > 0)
							{echo "<br>"._QXZ("PHONE NOT COPIED - there is already a Voicemail ID in the system with this ID")."\n";}
						else
							{
							if ( (strlen($new_extension) < 1) or (strlen($new_server_ip) < 7) or (strlen($new_dialplan_number) < 1) or (strlen($new_voicemail_id) < 1) or (strlen($new_login) < 1)  or (strlen($new_pass) < 1) or ( ($SSrequire_password_length > 0) and ($SSrequire_password_length > strlen($new_conf_secret)) ))
								{
								echo "<br>"._QXZ("PHONE NOT COPIED - Please go back and look at the data you entered")."\n";
								echo "<br>"._QXZ("The following fields must have data").": extension, server_ip, dialplan_number, voicemail_id, login, pass\n";
								if ($SSrequire_password_length > 0)
									{
									echo "<br>"._QXZ("registration password must be at least $SSrequire_password_length characters long")."\n";
									}
								}
							else
								{
								$ins_stmt="INSERT INTO phones(extension, dialplan_number, voicemail_id, phone_ip, computer_ip, server_ip, login, pass, status, active, phone_type, fullname, company, picture, messages, old_messages, protocol, local_gmt, ASTmgrUSERNAME, ASTmgrSECRET, login_user, login_pass, login_campaign, park_on_extension, conf_on_extension, VICIDIAL_park_on_extension, VICIDIAL_park_on_filename, monitor_prefix, recording_exten, voicemail_exten, voicemail_dump_exten, ext_context, dtmf_send_extension, call_out_number_group, client_browser, install_directory, local_web_callerID_URL, VICIDIAL_web_URL, AGI_call_logging_enabled, user_switching_enabled, conferencing_enabled, admin_hangup_enabled, admin_hijack_enabled, admin_monitor_enabled, call_parking_enabled, updater_check_enabled, AFLogging_enabled, QUEUE_ACTION_enabled, CallerID_popup_enabled, voicemail_button_enabled, enable_fast_refresh, fast_refresh_rate, enable_persistant_mysql, auto_dial_next_number, VDstop_rec_after_each_call, DBX_server, DBX_database, DBX_user, DBX_pass, DBX_port, DBY_server, DBY_database, DBY_user, DBY_pass, DBY_port, outbound_cid, enable_sipsak_messages, email, template_id, conf_override, phone_context, phone_ring_timeout, conf_secret, delete_vm_after_email, is_webphone, use_external_server_ip, codecs_list, codecs_with_template, webphone_dialpad, on_hook_agent, webphone_auto_answer, voicemail_timezone, voicemail_options, user_group, voicemail_greeting, voicemail_dump_exten_no_inst, voicemail_instructions, on_login_report, unavail_dialplan_fwd_exten, unavail_dialplan_fwd_context, nva_call_url, nva_search_method, nva_error_filename, nva_new_list_id, nva_new_phone_code, nva_new_status, webphone_dialbox, webphone_mute, webphone_volume, webphone_debug, outbound_alt_cid, conf_qualify, webphone_layout, mohsuggest) select '$new_extension', '$new_dialplan_number', '$new_voicemail_id', phone_ip, computer_ip, '$new_server_ip', '$new_login', '$new_pass', status, active, phone_type, '$new_fullname', company, picture, messages, old_messages, protocol, local_gmt, ASTmgrUSERNAME, ASTmgrSECRET, login_user, login_pass, login_campaign, park_on_extension, conf_on_extension, VICIDIAL_park_on_extension, VICIDIAL_park_on_filename, monitor_prefix, recording_exten, voicemail_exten, voicemail_dump_exten, ext_context, dtmf_send_extension, call_out_number_group, client_browser, install_directory, local_web_callerID_URL, VICIDIAL_web_URL, AGI_call_logging_enabled, user_switching_enabled, conferencing_enabled, admin_hangup_enabled, admin_hijack_enabled, admin_monitor_enabled, call_parking_enabled, updater_check_enabled, AFLogging_enabled, QUEUE_ACTION_enabled, CallerID_popup_enabled, voicemail_button_enabled, enable_fast_refresh, fast_refresh_rate, enable_persistant_mysql, auto_dial_next_number, VDstop_rec_after_each_call, DBX_server, DBX_database, DBX_user, DBX_pass, DBX_port, DBY_server, DBY_database, DBY_user, DBY_pass, DBY_port, '$new_outbound_cid', enable_sipsak_messages, email, template_id, conf_override, phone_context, phone_ring_timeout, '$new_conf_secret', delete_vm_after_email, is_webphone, use_external_server_ip, codecs_list, codecs_with_template, webphone_dialpad, on_hook_agent, webphone_auto_answer, voicemail_timezone, voicemail_options, user_group, voicemail_greeting, voicemail_dump_exten_no_inst, voicemail_instructions, on_login_report, unavail_dialplan_fwd_exten, unavail_dialplan_fwd_context, nva_call_url, nva_search_method, nva_error_filename, nva_new_list_id, nva_new_phone_code, nva_new_status, webphone_dialbox, webphone_mute, webphone_volume, webphone_debug, outbound_alt_cid, conf_qualify, webphone_layout, mohsuggest from phones where extension='$source_extension' and server_ip='$source_server_ip'";
								$ins_rslt=mysql_to_mysqli($ins_stmt, $link);
								$affected_rows = mysqli_affected_rows($link);
								if ($affected_rows>0)
									{
									echo "<br><B>"._QXZ("PHONE COPIED").": $new_extension, $new_server_ip - <a href='admin.php?ADD=31111111111&extension=$new_extension&server_ip=$new_server_ip'>VIEW HERE</a></B>.  <BR><BR>Please allow up to 1 minute for the server dialplan to update with the new phone.\n";

									$upd_stmt="UPDATE servers set rebuild_conf_files='Y' where server_ip='$new_server_ip';";
									$upd_rslt=mysql_to_mysqli($upd_stmt, $link);
									$affected_rowsS = mysqli_affected_rows($link);

									### LOG INSERTION Admin Log Table ###
									$SQL_log = "$ins_stmt|$upd_stmt";
									$SQL_log = preg_replace('/;/', '', $SQL_log);
									$SQL_log = addslashes($SQL_log);
									$stmt="INSERT INTO vicidial_admin_log set event_date='$SQLdate', user='$PHP_AUTH_USER', ip_address='$ip', event_section='PHONES', event_type='COPY', record_id='$new_extension-$new_server_ip', event_code='ADMIN COPY PHONE', event_sql=\"$SQL_log\", event_notes='$affected_rows,$affected_rowsS';";
									if ($DB) {echo "|$stmt|\n";}
									$rslt=mysql_to_mysqli($stmt, $link);

									}
								else
									{
									echo "<br>"._QXZ("UNKNOWN SQL ERROR - $ins_stmt")."\n";
									}
								}
							}
						}
					}
				}
			}
		}
	echo "</font>";
	$ADD=12222222222;
	}

######################
# ADD=12222222222 display the COPY PHONE SCREEN
######################
if ($ADD==12222222222)
	{
	if ($LOGmodify_phones==1)
		{
		##### BEGIN ID override optional section, if enabled it increments user by 1 ignoring entered value #####
		$stmt = "SELECT count(*) FROM vicidial_override_ids where id_table='vicidial_campaigns' and active='1';";
		$rslt=mysql_to_mysqli($stmt, $link);
		$voi_ct = mysqli_num_rows($rslt);
		if ($voi_ct > 0)
			{
			$row=mysqli_fetch_row($rslt);
			$voi_count = "$row[0]";
			}
		##### END ID override optional section #####

		echo "<TABLE><TR><TD>\n";
		echo "<img src=\"images/icon_phones.png\" alt=\"Phones\" width=42 height=42> <FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

		echo ""._QXZ("COPY A PHONE")."<form action=$PHP_SELF method=POST>\n";
		echo "<input type=hidden name=ADD value=21222222222>\n";
		echo "<input type=hidden name=DB value=\"$DB\">\n";
		echo "<center><TABLE width=$section_width cellspacing=3>\n";
		/*
		if ($voi_count > 0)
			{
			echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Campaign ID").": </td><td align=left>"._QXZ("Auto-Generated")." $NWB#campaigns-campaign_id$NWE</td></tr>\n";
			}
		else
			{
			echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Campaign ID").": </td><td align=left><input type=text name=campaign_id size=10 maxlength=8>$NWB#campaigns-campaign_id$NWE</td></tr>\n";
			}
		*/
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Phone Extension").": </td><td align=left><input type=text name=new_extension size=20 maxlength=100 value='$new_extension'>$NWB#phones-extension$NWE</td></tr>\n";

		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Dial Plan Number").": </td><td align=left><input type=text name=new_dialplan_number size=15 maxlength=20 value='$new_dialplan_number'> ("._QXZ("digits only").")$NWB#phones-dialplan_number$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Voicemail Box").": </td><td align=left><input type=text name=new_voicemail_id size=10 maxlength=10 value='$new_voicemail_id'> ("._QXZ("digits only").")$NWB#phones-voicemail_id$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Outbound CallerID").": </td><td align=left><input type=text name=new_outbound_cid size=10 maxlength=20 value='$new_outbound_cid'> ("._QXZ("digits only").")$NWB#phones-outbound_cid$NWE</td></tr>\n";

		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Server IP").": </td><td align=left><select size=1 name=new_server_ip>\n";
		if ($new_server_ip) {echo "<option value='$new_server_ip' selected>$new_server_ip</option>\n";}
		echo "$servers_list";
		echo "</select>$NWB#phones-server_ip$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Agent Screen Login").": </td><td align=left><input type=text name=new_login size=15 maxlength=15 value='$new_login'>$NWB#phones-login$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Login Password").": </td><td align=left><input type=text name=new_pass size=40 maxlength=100 value=\"".(!$new_pass ? $SSdefault_phone_login_password : $new_pass)."\">$NWB#phones-pass$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Registration Password").": </td><td align=left style=\"display:table-cell; vertical-align:middle;\" NOWRAP><input type=text id=reg_pass name=new_conf_secret size=40 maxlength=100 value=\"".(!$new_conf_secret ? $SSdefault_phone_registration_password : $new_conf_secret)."\" onkeyup=\"return pwdChanged('reg_pass','reg_pass_img','pass_length','$SSrequire_password_length');\">$NWB#phones-conf_secret$NWE &nbsp; &nbsp; <font size=1>"._QXZ("Strength").":</font> <IMG id=reg_pass_img src='images/pixel.gif' style=\"vertical-align:middle;\" onLoad=\"return pwdChanged('reg_pass','reg_pass_img','pass_length','$SSrequire_password_length');\"> &nbsp; <font size=1> "._QXZ("Length").": <span id=pass_length name=pass_length>0</span></font></td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Full Name").": </td><td align=left><input type=text name=new_fullname size=20 maxlength=50 value='$new_fullname'>$NWB#phones-fullname$NWE</td></tr>\n";

		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Source Phone").": </td><td align=left><select size=1 name=source_phone>\n";
		$stmt="SELECT extension, server_ip, fullname from phones $whereLOGadmin_viewable_groupsSQL order by extension, server_ip, fullname;";
		$rslt=mysql_to_mysqli($stmt, $link);
		$phones_to_print = mysqli_num_rows($rslt);
		$phones_list='';
		$phone_selected=0;
		$o=0;
		while ($phones_to_print > $o) 
			{
			$rowx=mysqli_fetch_row($rslt);
			if ($source_phone=="$rowx[0]|$rowx[1]") {$s=" selected";   $phone_selected++;} else {$s="";}
			$phones_list .= "<option value=\"$rowx[0]|$rowx[1]\"$s>$rowx[0], $rowx[1]</option>\n";
			$o++;
			}
		if ($phone_selected < 1)
			{echo "<option value=\"\" selected>-- Select a Phone (Extension, Server) --</option>\n";}
		echo "$phones_list";
		echo "</select>$NWB#campaigns-campaign_id$NWE</td></tr>\n";
		
		echo "<tr bgcolor=#$SSstd_row4_background><td align=center colspan=2><input style='background-color:#$SSbutton_color' type=submit name=SUBMIT value='"._QXZ("SUBMIT")."'></td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=center colspan=2>"._QXZ("NOTE: Copying a phone will copy all the settings from the selected source phone, except for the settings entered above.")."</td></tr>\n";
		echo "</TABLE></center>\n";
		}
	else
		{
		echo _QXZ("You do not have permission to view this page")."\n";
		exit;
		}
	}

######################
# ADD=12111111111 display the ADD NEW PHONE ALIAS SCREEN
######################
if ($ADD==12111111111)
	{
	if ( ($LOGast_admin_access==1) or ($LOGmodify_phones==1) )
		{
		echo "<TABLE><TR><TD>\n";
		echo "<img src=\"images/icon_phones.png\" alt=\"Phones\" width=42 height=42> <FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

		echo "<br>"._QXZ("ADD A NEW PHONE ALIAS")."<form action=$PHP_SELF method=POST>\n";
		echo "<input type=hidden name=ADD value=22111111111>\n";
		echo "<center><TABLE width=$section_width cellspacing=3>\n";

		echo "<center><TABLE width=$section_width cellspacing=3>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Alias ID").": </td><td align=left><input type=text name=alias_id size=20 maxlength=20 value=\"\">$NWB#phones-alias_id$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Alias Name").": </td><td align=left><input type=text name=alias_name size=30 maxlength=50> $NWB#phones-alias_name$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Admin User Group").": </td><td align=left><select size=1 name=user_group>\n";
		echo "$UUgroups_list";
		echo "<option SELECTED value=\"---ALL---\">"._QXZ("All Admin User Groups")."</option>\n";
		echo "</select>$NWB#phones-user_group$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Phone Logins List").": </td><td align=left><input type=text name=logins_list size=50 maxlength=255> ("._QXZ("comma separated").")$NWB#phones-logins_list$NWE</td></tr>\n";

		echo "<tr bgcolor=#$SSstd_row4_background><td align=center colspan=2><input style='background-color:#$SSbutton_color' type=submit name=submit value='"._QXZ("SUBMIT")."'</td></tr>\n";
		echo "</TABLE></center>\n";
		}
	else
		{
		echo _QXZ("You do not have permission to view this page")."\n";
		exit;
		}
	}


######################
# ADD=13111111111 display the ADD NEW GROUP ALIAS SCREEN
######################
if ($ADD==13111111111)
	{
	if ( ($LOGast_admin_access==1) or ($LOGmodify_phones==1) )
		{
		echo "<TABLE><TR><TD>\n";
		echo "<img src=\"images/icon_phones.png\" alt=\"Phones\" width=42 height=42> <FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

		echo "<br>"._QXZ("ADD A NEW GROUP ALIAS")."<form action=$PHP_SELF method=POST>\n";
		echo "<input type=hidden name=ADD value=23111111111>\n";
		echo "<center><TABLE width=$section_width cellspacing=3>\n";

		echo "<center><TABLE width=$section_width cellspacing=3>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Group Alias ID").": </td><td align=left><input type=text name=group_alias_id size=30 maxlength=30 value=\"\">$NWB#phones-group_alias_id$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Group Alias Name").": </td><td align=left><input type=text name=group_alias_name size=30 maxlength=50> $NWB#phones-group_alias_name$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("CallerID Number").": </td><td align=left><input type=text name=caller_id_number size=20 maxlength=20> $NWB#phones-caller_id_number$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("CallerID Name").": </td><td align=left><input type=text name=caller_id_name size=20 maxlength=20> $NWB#phones-caller_id_name$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Active").": </td><td align=left><select size=1 name=active><option value='Y'>"._QXZ("Y")."</option><option selected value='N'>"._QXZ("N")."</option></select></td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Admin User Group").": </td><td align=left><select size=1 name=user_group>\n";
		echo "$UUgroups_list";
		echo "<option SELECTED value=\"---ALL---\">"._QXZ("All Admin User Groups")."</option>\n";
		echo "</select>$NWB#phones-user_group$NWE</td></tr>\n";

		echo "<tr bgcolor=#$SSstd_row4_background><td align=center colspan=2><input style='background-color:#$SSbutton_color' type=submit name=submit value='"._QXZ("SUBMIT")."'</td></tr>\n";
		echo "</TABLE></center>\n";
		}
	else
		{
		echo _QXZ("You do not have permission to view this page")."\n";
		exit;
		}
	}


######################
# ADD=111111111111 display the ADD NEW SERVER SCREEN
######################
if ($ADD==111111111111)
	{
	if ($LOGmodify_servers==1)
		{
		echo "<TABLE><TR><TD>\n";
		echo "<img src=\"images/icon_servers.png\" alt=\"Servers\" width=42 height=42> <FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

		echo "<br>"._QXZ("ADD A NEW SERVER")."<form action=$PHP_SELF method=POST>\n";
		echo "<input type=hidden name=ADD value=211111111111>\n";
		echo "<center><TABLE width=$section_width cellspacing=3>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Server ID").": </td><td align=left><input type=text name=server_id size=10 maxlength=10>$NWB#servers-server_id$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Server Description").": </td><td align=left><input type=text name=server_description size=30 maxlength=255>$NWB#servers-server_description$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Server IP Address").": </td><td align=left><input type=text name=server_ip size=20 maxlength=15>$NWB#servers-server_ip$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Active").": </td><td align=left><select size=1 name=active><option value='Y'>"._QXZ("Y")."</option><option value='N'>"._QXZ("N")."</option></select>$NWB#servers-active$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Asterisk Version").": </td><td align=left><input type=text name=asterisk_version size=20 maxlength=20>$NWB#servers-asterisk_version$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Admin User Group").": </td><td align=left><select size=1 name=user_group>\n";
		echo "$UUgroups_list";
		echo "<option SELECTED value=\"---ALL---\">"._QXZ("All Admin User Groups")."</option>\n";
		echo "</select>$NWB#servers-user_group$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=center colspan=2><input style='background-color:#$SSbutton_color' type=submit name=submit value='"._QXZ("SUBMIT")."'</td></tr>\n";
		echo "</TABLE></center>\n";
		}
	else
		{
		echo _QXZ("You do not have permission to view this page")."\n";
		exit;
		}
	}


######################
# ADD=131111111111 display the ADD NEW CONF TEMPLATE SCREEN
######################
if ($ADD==131111111111)
	{
	if ($LOGmodify_servers==1)
		{
		echo "<TABLE><TR><TD>\n";
		echo "<img src=\"images/icon_templates.png\" alt=\"Templates\" width=42 height=42> <FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

		echo "<br>"._QXZ("ADD NEW CONF TEMPLATE")."<form action=$PHP_SELF method=POST>\n";
		echo "<input type=hidden name=ADD value=231111111111>\n";
		echo "<center><TABLE width=$section_width cellspacing=3>\n";

		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Template ID").": </td><td align=left><input type=text name=template_id size=15 maxlength=15>$NWB#conf_templates-template_id$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Template Name").": </td><td align=left><input type=text name=template_name size=40 maxlength=50>$NWB#conf_templates-template_name$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Admin User Group").": </td><td align=left><select size=1 name=user_group>\n";
		echo "$UUgroups_list";
		echo "<option SELECTED value=\"---ALL---\">"._QXZ("All Admin User Groups")."</option>\n";
		echo "</select>$NWB#conf_templates-user_group$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Template Contents").": </td><td align=left><TEXTAREA NAME=template_contents ROWS=12 COLS=70></TEXTAREA> $NWB#conf_templates-template_contents$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=center colspan=2><input style='background-color:#$SSbutton_color' type=submit name=submit value='"._QXZ("SUBMIT")."'</td></tr>\n";
		echo "</TABLE></center>\n";
		}
	else
		{
		echo _QXZ("You do not have permission to view this page")."\n";
		exit;
		}
	}


######################
# ADD=141111111111 display the ADD NEW CARRIER SCREEN
######################
if ($ADD==141111111111)
	{
	if ( ( ($LOGmodify_servers==1) or ($LOGmodify_carriers==1) ) and ($x_ra_carrier < 1) )
		{
		echo "<TABLE><TR><TD>\n";
		echo "<img src=\"images/icon_carriers.png\" alt=\"Carriers\" width=42 height=42> <FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

		echo "<br>"._QXZ("ADD NEW CARRIER")."<form action=$PHP_SELF method=POST>\n";
		echo "<input type=hidden name=ADD value=241111111111>\n";
		echo "<center><TABLE width=$section_width cellspacing=3>\n";

		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Carrier ID").": </td><td align=left><input type=text name=carrier_id size=15 maxlength=15>$NWB#server_carriers-carrier_id$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Carrier Name").": </td><td align=left><input type=text name=carrier_name size=40 maxlength=50>$NWB#server_carriers-carrier_name$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Carrier Description").": </td><td align=left><input type=text name=carrier_description size=70 maxlength=255>$NWB#server_carriers-carrier_description$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Admin User Group").": </td><td align=left><select size=1 name=user_group>\n";
		echo "$UUgroups_list";
		echo "<option SELECTED value=\"---ALL---\">"._QXZ("All Admin User Groups")."</option>\n";
		echo "</select>$NWB#server_carriers-user_group$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Registration String").": </td><td align=left><input type=text name=registration_string size=50 maxlength=255>$NWB#server_carriers-registration_string$NWE</td></tr>\n";

		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Template ID").": </td><td align=left><select size=1 name=template_id>\n";
		$stmt="SELECT template_id,template_name from vicidial_conf_templates $whereLOGadmin_viewable_groupsSQL order by template_id;";
		$rslt=mysql_to_mysqli($stmt, $link);
		$templates_to_print = mysqli_num_rows($rslt);
		$templates_list='<option value=\'--NONE--\' SELECTED>--'._QXZ("NONE").'--</option>';
		$o=0;
		while ($templates_to_print > $o) 
			{
			$rowx=mysqli_fetch_row($rslt);
			$templates_list .= "<option value=\"$rowx[0]\">$rowx[0] - $rowx[1]</option>\n";
			$o++;
			}
		echo "$templates_list";
		echo "</select>$NWB#server_carriers-template_id$NWE</td></tr>\n";

		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Account Entry").": </td><td align=left><TEXTAREA NAME=account_entry ROWS=10 COLS=70></TEXTAREA> $NWB#server_carriers-account_entry$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Protocol").": </td><td align=left><select size=1 name=protocol>";
		if ( ($SSallowed_sip_stacks == 'SIP') or ($SSallowed_sip_stacks == 'SIP_and_PJSIP') ) {echo "<option>SIP</option>";}
		if ( ($SSallowed_sip_stacks == 'PJSIP') or ($SSallowed_sip_stacks == 'SIP_and_PJSIP') ) {echo "<option>PJSIP</option><option>PJSIP_WIZ</option>";}
		echo "<option>Zap</option>";
		echo "<option>IAX2</option>";
		echo "<option value='EXTERNAL'>"._QXZ("EXTERNAL")."</option>";
		echo "</select>$NWB#server_carriers-protocol$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Globals String").": </td><td align=left><input type=text name=globals_string size=50 maxlength=255>$NWB#server_carriers-globals_string$NWE</td></tr>\n";

		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Dialplan Entry").": </td><td align=left><TEXTAREA NAME=dialplan_entry ROWS=10 COLS=70></TEXTAREA> $NWB#server_carriers-dialplan_entry$NWE</td></tr>\n";

		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Server IP").": </td><td align=left><select size=1 name=server_ip>\n";
		echo "$servers_list";
		echo "</select>$NWB#server_carriers-server_ip$NWE</td></tr>\n";

		echo "<tr bgcolor=#$SSstd_row4_background><td align=center colspan=2><input style='background-color:#$SSbutton_color' type=submit name=submit value='"._QXZ("SUBMIT")."'</td></tr>\n";
		echo "</TABLE></center>\n";
		}
	else
		{
		echo _QXZ("You do not have permission to view this page")."\n";
		exit;
		}
	}


######################
# ADD=140111111111 display the ADD COPIED CARRIER SCREEN
######################
if ($ADD==140111111111)
	{
	if ( ( ($LOGmodify_servers==1) or ($LOGmodify_carriers==1) ) and ($x_ra_carrier < 1) )
		{
		echo "<TABLE><TR><TD>\n";
		echo "<img src=\"images/icon_carriers.png\" alt=\"Carriers\" width=42 height=42> <FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

		echo "<br>"._QXZ("ADD COPIED CARRIER")."<form action=$PHP_SELF method=POST>\n";
		echo "<input type=hidden name=ADD value=240111111111>\n";
		echo "<center><TABLE width=$section_width cellspacing=3>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Carrier ID").": </td><td align=left><input type=text name=carrier_id size=15 maxlength=15>$NWB#server_carriers-carrier_id$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Carrier Name").": </td><td align=left><input type=text name=carrier_name size=40 maxlength=50>$NWB#server_carriers-carrier_name$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Server IP").": </td><td align=left><select size=1 name=server_ip>\n";
		echo "$servers_list";
		echo "</select>$NWB#server_carriers-server_ip$NWE</td></tr>\n";


		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Source Carrier").": </td><td align=left><select size=1 name=source_carrier>\n";

		$stmt="SELECT carrier_id,carrier_name,server_ip from vicidial_server_carriers $whereLOGadmin_viewable_groupsSQL order by carrier_id;";
		$rslt=mysql_to_mysqli($stmt, $link);
		$menus_to_print = mysqli_num_rows($rslt);
		$menus_list='';

		$o=0;
		while ($menus_to_print > $o) 
			{
			$rowx=mysqli_fetch_row($rslt);
			$menus_list .= "<option value=\"$rowx[0]\">$rowx[0] - $rowx[1] - $rowx[2]</option>\n";
			$o++;
			}
		echo "$menus_list";
		echo "</select>$NWB#server_carriers-carrier_id$NWE</td></tr>\n";

		echo "<tr bgcolor=#$SSstd_row4_background><td align=center colspan=2><input style='background-color:#$SSbutton_color' type=submit name=SUBMIT value='"._QXZ("SUBMIT")."'></td></tr>\n";
		echo "</TABLE></center>\n";
		}
	else
		{
		echo _QXZ("You do not have permission to view this page")."\n";
		exit;
		}
	}


######################
# ADD=151111111111 display the ADD NEW TTS ENTRY SCREEN
######################
if ($ADD==151111111111)
	{
	if ( ($LOGmodify_servers==1) or ($LOGmodify_tts==1) )
		{
		echo "<TABLE><TR><TD>\n";
		echo "<img src=\"images/icon_texttospeech.png\" alt=\"Text to Speech\" width=42 height=42> <FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

		echo "<br>"._QXZ("ADD NEW TTS ENTRY")."<form action=$PHP_SELF method=POST>\n";
		echo "<input type=hidden name=ADD value=251111111111>\n";
		echo "<center><TABLE width=$section_width cellspacing=3>\n";

		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("TTS ID").": </td><td align=left><input type=text name=tts_id size=30 maxlength=50>$NWB#tts_prompts-tts_id$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("TTS Name").": </td><td align=left><input type=text name=tts_name size=50 maxlength=100>$NWB#tts_prompts-tts_name$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Active").": </td><td align=left><select size=1 name=active><option value='N'>"._QXZ("N")."</option><option value='Y'>"._QXZ("Y")."</option>$NWB#tts_prompts-active$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Admin User Group").": </td><td align=left><select size=1 name=user_group>\n";
		echo "$UUgroups_list";
		echo "<option SELECTED value=\"---ALL---\">"._QXZ("All Admin User Groups")."</option>\n";
		echo "</select>$NWB#tts_prompts-user_group$NWE</td></tr>\n";

		echo "<tr bgcolor=#$SSstd_row4_background><td align=center colspan=2><input style='background-color:#$SSbutton_color' type=submit name=submit value='"._QXZ("SUBMIT")."'</td></tr>\n";
		echo "</TABLE></center>\n";
		}
	else
		{
		echo _QXZ("You do not have permission to view this page")."\n";
		exit;
		}
	}


######################
# ADD=161111111111 display the ADD NEW MUSIC ON HOLD ENTRY SCREEN
######################
if ($ADD==161111111111)
	{
	if ( ($LOGmodify_servers==1) or ($LOGmodify_moh==1) )
		{
		echo "<TABLE><TR><TD>\n";
		echo "<img src=\"images/icon_musiconhold.png\" alt=\"Music on Hold\" width=42 height=42> <FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

		echo "<br>"._QXZ("ADD NEW MUSIC ON HOLD ENTRY")."<form action=$PHP_SELF method=POST>\n";
		echo "<input type=hidden name=ADD value=261111111111>\n";
		echo "<center><TABLE width=$section_width cellspacing=3>\n";

		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Music On Hold ID").": </td><td align=left><input type=text name=moh_id size=50 maxlength=100>$NWB#music_on_hold-moh_id$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Music On Hold Name").": </td><td align=left><input type=text name=moh_name size=70 maxlength=255>$NWB#music_on_hold-moh_name$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Random Order").": </td><td align=left><select size=1 name=random><option value='N'>"._QXZ("N")."</option><option value='Y'>"._QXZ("Y")."</option>$NWB#music_on_hold-random$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Admin User Group").": </td><td align=left><select size=1 name=user_group>\n";
		echo "$UUgroups_list";
		echo "<option SELECTED value=\"---ALL---\">"._QXZ("All Admin User Groups")."</option>\n";
		echo "</select>$NWB#music_on_hold-user_group$NWE</td></tr>\n";

		echo "<tr bgcolor=#$SSstd_row4_background><td align=center colspan=2><input style='background-color:#$SSbutton_color' type=submit name=submit value='"._QXZ("SUBMIT")."'</td></tr>\n";
		echo "</TABLE></center>\n";
		}
	else
		{
		echo _QXZ("You do not have permission to view this page")."\n";
		exit;
		}
	}


######################
# ADD=171111111111 display the ADD NEW VOICEMAIL BOX SCREEN
######################
if ($ADD==171111111111)
	{
	if ( ($LOGmodify_servers==1) or ($LOGmodify_moh==1) )
		{
		echo "<TABLE><TR><TD>\n";
		echo "<img src=\"images/icon_voicemail.png\" alt=\"Voicemail\" width=42 height=42> <FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

		echo "<br>"._QXZ("ADD NEW VOICEMAIL BOX")."<form action=$PHP_SELF method=POST>\n";
		echo "<input type=hidden name=ADD value=271111111111>\n";
		echo "<center><TABLE width=$section_width cellspacing=3>\n";

		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Voicemail ID").": </td><td align=left><input type=text name=voicemail_id size=12 maxlength=10>$NWB#voicemail-voicemail_id$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Pass").": </td><td align=left><input type=text name=pass size=10 maxlength=10>$NWB#voicemail-pass$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Name").": </td><td align=left><input type=text name=fullname size=50 maxlength=100>$NWB#voicemail-fullname$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Active").": </td><td align=left><select size=1 name=active><option value='N'>"._QXZ("N")."</option><option value='Y'>"._QXZ("Y")."</option>$NWB#voicemail-active$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Email").": </td><td align=left><input type=text name=email size=50 maxlength=100>$NWB#voicemail-email$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Admin User Group").": </td><td align=left><select size=1 name=user_group>\n";
		echo "$UUgroups_list";
		echo "<option SELECTED value=\"---ALL---\">"._QXZ("All Admin User Groups")."</option>\n";
		echo "</select>$NWB#voicemail-user_group$NWE</td></tr>\n";

		echo "<tr bgcolor=#$SSstd_row4_background><td align=center colspan=2><input style='background-color:#$SSbutton_color' type=submit name=submit value='"._QXZ("SUBMIT")."'</td></tr>\n";
		echo "</TABLE></center>\n";
		}
	else
		{
		echo _QXZ("You do not have permission to view this page")."\n";
		exit;
		}
	}


######################
# ADD=181111111111 display the ADD NEW SCREEN LABEL SCREEN
######################
if ($ADD==181111111111)
	{
	if ( ($LOGmodify_servers==1) or ($LOGmodify_labels==1) )
		{
		echo "<TABLE><TR><TD>\n";
		echo "<img src=\"images/icon_screenlabels.png\" alt=\"Screen Labels\" width=42 height=42> <FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

		echo "<br>"._QXZ("ADD NEW SCREEN LABEL")."<form action=$PHP_SELF method=POST>\n";
		echo "<input type=hidden name=ADD value=281111111111>\n";
		echo "<center><TABLE width=$section_width cellspacing=3>\n";

		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Screen Label ID").": </td><td align=left><input type=text name=label_id size=21 maxlength=20>$NWB#screen_labels-label_id$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Screen Label Name").": </td><td align=left><input type=text name=label_name size=70 maxlength=100>$NWB#screen_labels-label_name$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Admin User Group").": </td><td align=left><select size=1 name=user_group>\n";
		echo "$UUgroups_list";
		echo "<option SELECTED value=\"---ALL---\">"._QXZ("All Admin User Groups")."</option>\n";
		echo "</select>$NWB#screen_labels-user_group$NWE</td></tr>\n";

		echo "<tr bgcolor=#$SSstd_row4_background><td align=center colspan=2><input style='background-color:#$SSbutton_color' type=submit name=submit value='"._QXZ("SUBMIT")."'</td></tr>\n";
		echo "</TABLE></center>\n";
		}
	else
		{
		echo _QXZ("You do not have permission to view this page")."\n";
		exit;
		}
	}


######################
# ADD=182111111111 display the ADD NEW SCREEN LABEL SCREEN
######################
if ($ADD==182111111111)
	{
	if ( ($LOGmodify_servers==1) or ($LOGmodify_colors==1) )
		{
		echo "<TABLE><TR><TD>\n";
		echo "<img src=\"images/icon_screencolors.png\" alt=\"Screen Colors\" width=42 height=42> <FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

		echo "<br>"._QXZ("ADD NEW SCREEN COLORS")."<form action=$PHP_SELF method=POST>\n";
		echo "<input type=hidden name=ADD value=282111111111>\n";
		echo "<center><TABLE width=$section_width cellspacing=3>\n";

		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Screen Colors ID").": </td><td align=left><input type=text name=colors_id size=21 maxlength=20>$NWB#screen_labels-label_id$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Screen Colors Name").": </td><td align=left><input type=text name=colors_name size=70 maxlength=100>$NWB#screen_labels-label_name$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Admin User Group").": </td><td align=left><select size=1 name=user_group>\n";
		echo "$UUgroups_list";
		echo "<option SELECTED value=\"---ALL---\">"._QXZ("All Admin User Groups")."</option>\n";
		echo "</select>$NWB#screen_labels-user_group$NWE</td></tr>\n";

		echo "<tr bgcolor=#$SSstd_row4_background><td align=center colspan=2><input style='background-color:#$SSbutton_color' type=submit name=submit value='"._QXZ("SUBMIT")."'</td></tr>\n";
		echo "</TABLE></center>\n";
		}
	else
		{
		echo _QXZ("You do not have permission to view this page")."\n";
		exit;
		}
	}


######################
# ADD=191111111111 display the ADD NEW CONTACT SCREEN
######################
if ($ADD==191111111111)
	{
	if ( ($LOGmodify_servers==1) or ($LOGmodify_contacts==1) )
		{
		echo "<TABLE><TR><TD>\n";
		echo "<img src=\"images/icon_contacts.png\" alt=\"Contacts\" width=42 height=42> <FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

		echo "<br>"._QXZ("ADD NEW CONTACT")."<form action=$PHP_SELF method=POST>\n";
		echo "<input type=hidden name=ADD value=291111111111>\n";
		echo "<center><TABLE width=$section_width cellspacing=3>\n";

		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("First Name").": </td><td align=left><input type=text name=first_name size=50 maxlength=50>$NWB#contact_information$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Last Name").": </td><td align=left><input type=text name=last_name size=50 maxlength=50>$NWB#contact_information$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Office Number").": </td><td align=left><input type=text name=office_num size=20 maxlength=20>$NWB#contact_information$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Cell Number").": </td><td align=left><input type=text name=cell_num size=20 maxlength=20>$NWB#contact_information$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Other Number")." 1: </td><td align=left><input type=text name=other_num1 size=20 maxlength=20>$NWB#contact_information$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Other Number")." 2: </td><td align=left><input type=text name=other_num2 size=20 maxlength=20>$NWB#contact_information$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("BU Name").": </td><td align=left><input type=text name=bu_name size=50 maxlength=100>$NWB#contact_information$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Department").": </td><td align=left><input type=text name=department size=50 maxlength=100>$NWB#contact_information$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Group").": </td><td align=left><input type=text name=group_name size=50 maxlength=100>$NWB#contact_information$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Job Title").": </td><td align=left><input type=text name=job_title size=50 maxlength=100>$NWB#contact_information$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Location").": </td><td align=left><input type=text name=location size=50 maxlength=100>$NWB#contact_information$NWE</td></tr>\n";

		echo "<tr bgcolor=#$SSstd_row4_background><td align=center colspan=2><input style='background-color:#$SSbutton_color' type=submit name=submit value='"._QXZ("SUBMIT")."'</td></tr>\n";
		echo "</TABLE></center>\n";
		}
	else
		{
		echo _QXZ("You do not have permission to view this page")."\n";
		exit;
		}
	}


######################
# ADD=192111111111 display the ADD NEW SETTINGS CONTAINER
######################
if ($ADD==192111111111)
	{
	if ($LOGmodify_servers==1)
		{
		echo "<TABLE><TR><TD>\n";
		echo "<img src=\"images/icon_settingscontainer.png\" alt=\"Settings Container\" width=42 height=42> <FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

		echo "<br>"._QXZ("ADD NEW SETTINGS CONTAINER")."<form action=$PHP_SELF method=POST>\n";
		echo "<input type=hidden name=ADD value=292111111111>\n";
		echo "<center><TABLE width=$section_width cellspacing=3>\n";

		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Container ID").": </td><td align=left><input type=text name=container_id size=40 maxlength=40>$NWB#settings_containers-container_id$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Container Notes").": </td><td align=left><input type=text name=container_notes size=50 maxlength=255>$NWB#settings_containers-container_notes$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Container Type").": </td><td align=left><select size=1 name=container_type>
		<option value='2FA_SETTINGS'>"._QXZ("2FA_SETTINGS")."</option>
		<option value='AGI'>"._QXZ("AGI")."</option>
		<option value='AMD_AGENT_OPTIONS'>"._QXZ("AMD_AGENT_OPTIONS")."</option>
		<option value='CALL_LIMITS_OVERRIDE'>"._QXZ("CALL_LIMITS_OVERRIDE")."</option>
		<option value='CALL_QUOTA'>"._QXZ("CALL_QUOTA")."</option>
		<option value='CALLS_IN_QUEUE_COUNT'>"._QXZ("CALLS_IN_QUEUE_COUNT")."</option>
		<option value='CAMPAIGN_LIST'>"._QXZ("CAMPAIGN_LIST")."</option>
		<option value='DIAL_TIMEOUTS'>"._QXZ("DIAL_TIMEOUTS")."</option>
		<option value='DISPO_FILTER'>"._QXZ("DISPO_FILTER")."</option>
		<option value='EMAIL_TEMPLATE'>"._QXZ("EMAIL_TEMPLATE")."</option>
		<option value='INGROUP_LIST'>"._QXZ("INGROUP_LIST")."</option>
		<option value='OTHER' SELECTED>"._QXZ("OTHER")."</option>
		<option value='PAUSE_CODES_LIST'>"._QXZ("PAUSE_CODES_LIST")."</option>
		<option value='PERL_CLI'>"._QXZ("PERL_CLI")."</option>
		<option value='PHONE_DEFAULTS'>"._QXZ("PHONE_DEFAULTS")."</option>
		<option value='PHONE_NUMBERS'>"._QXZ("PHONE_NUMBERS")."</option>
		<option value='QC_TEMPLATE'>"._QXZ("QC_TEMPLATE")."</option>
		<option value='READ_ONLY'>"._QXZ("READ_ONLY")."</option>
		<option value='SIP_EVENT_ACTIONS'>"._QXZ("SIP_EVENT_ACTIONS")."</option>
		<option value='TIMEZONE_LIST'>"._QXZ("TIMEZONE_LIST")."</option>
		<option value='WEEKDAY_TIMERANGE_SECONDS'>"._QXZ("WEEKDAY_TIMERANGE_SECONDS")."</option>
		</select>$NWB#settings_containers-container_type$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Admin User Group").": </td><td align=left><select size=1 name=user_group>\n";
		echo "$UUgroups_list";
		echo "<option SELECTED value=\"---ALL---\">"._QXZ("All Admin User Groups")."</option>\n";
		echo "</select>$NWB#settings_containers-user_group$NWE</td></tr>\n";

		echo "<tr bgcolor=#$SSstd_row4_background><td align=center colspan=2><input style='background-color:#$SSbutton_color' type=submit name=submit value='"._QXZ("SUBMIT")."'</td></tr>\n";
		echo "</TABLE></center>\n";
		}
	else
		{
		echo _QXZ("You do not have permission to view this page")."\n";
		exit;
		}
	}


######################
# ADD=193111111111 display the ADD NEW Statuses Group
######################
if ($ADD==193111111111)
	{
	if ($LOGmodify_statuses==1)
		{
		echo "<TABLE><TR><TD>\n";
		echo "<img src=\"images/icon_statusgroups.png\" alt=\"Status Groups\" width=42 height=42> <FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

		echo "<br>"._QXZ("ADD NEW STATUSES GROUP")."<form action=$PHP_SELF method=POST>\n";
		echo "<input type=hidden name=ADD value=293111111111>\n";
		echo "<center><TABLE width=$section_width cellspacing=3>\n";

		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Status Group ID").": </td><td align=left><input type=text name=status_group_id size=20 maxlength=20>$NWB#status_groups$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Status Group Notes").": </td><td align=left><input type=text name=status_group_notes size=50 maxlength=255>$NWB#status_groups$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Admin User Group").": </td><td align=left><select size=1 name=user_group>\n";
		echo "$UUgroups_list";
		echo "<option SELECTED value=\"---ALL---\">"._QXZ("All Admin User Groups")."</option>\n";
		echo "</select>$NWB#status_groups$NWE</td></tr>\n";

		echo "<tr bgcolor=#$SSstd_row4_background><td align=center colspan=2><input style='background-color:#$SSbutton_color' type=submit name=submit value='"._QXZ("SUBMIT")."'</td></tr>\n";
		echo "</TABLE></center>\n";
		}
	else
		{
		echo _QXZ("You do not have permission to view this page")."\n";
		exit;
		}
	}


######################
# ADD=194111111111 display the ADD NEW AUTOMATED REPORT screen
######################
if ($ADD==194111111111)
	{
	if ($LOGmodify_auto_reports==1)
		{
		echo "<TABLE><TR><TD>\n";
		echo "<img src=\"images/icon_autoreports.png\" alt=\"Automated Reports\" width=42 height=42> <FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

		echo "<br>"._QXZ("ADD NEW AUTOMATED REPORT")."<form action=$PHP_SELF method=POST>\n";
		echo "<input type=hidden name=ADD value=294111111111>\n";
		echo "<center><TABLE width=$section_width cellspacing=3>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Report ID").": </td><td align=left><input type=text name=report_id size=30 maxlength=30>$NWB#auto_reports-report_id$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Report Name").": </td><td align=left><input type=text name=report_name size=70 maxlength=100>$NWB#auto_reports-report_name$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Admin User Group").": </td><td align=left><select size=1 name=user_group>\n";
		echo "$UUgroups_list";
		echo "<option SELECTED value=\"---ALL---\">"._QXZ("All Admin User Groups")."</option>\n";
		echo "</select>$NWB#auto_reports-user_group$NWE</td></tr>\n";

		echo "<tr bgcolor=#$SSstd_row4_background><td align=center colspan=2><input style='background-color:#$SSbutton_color' type=submit name=submit value='"._QXZ("SUBMIT")."'</td></tr>\n";
		echo "</TABLE></center>\n";
		}
	else
		{
		echo _QXZ("You do not have permission to view this page")."\n";
		exit;
		}
	}


######################
# ADD=195111111111 display the ADD NEW IP LIST screen
######################
if ($ADD==195111111111)
	{
	if ($LOGmodify_ip_lists==1)
		{
		echo "<TABLE><TR><TD>\n";
		echo "<img src=\"images/icon_iplists.png\" alt=\"IP Lists\" width=42 height=42> <FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

		echo "<br>"._QXZ("ADD NEW IP LIST")."<form action=$PHP_SELF method=POST>\n";
		echo "<input type=hidden name=ADD value=295111111111>\n";
		echo "<center><TABLE width=$section_width cellspacing=3>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("IP List ID").": </td><td align=left><input type=text name=ip_list_id size=30 maxlength=30>$NWB#ip_lists-ip_list_id$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("IP List Name").": </td><td align=left><input type=text name=ip_list_name size=70 maxlength=100>$NWB#ip_lists-ip_list_name$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Admin User Group").": </td><td align=left><select size=1 name=user_group>\n";
		echo "$UUgroups_list";
		echo "<option SELECTED value=\"---ALL---\">"._QXZ("All Admin User Groups")."</option>\n";
		echo "</select>$NWB#ip_lists-user_group$NWE</td></tr>\n";

		echo "<tr bgcolor=#$SSstd_row4_background><td align=center colspan=2><input style='background-color:#$SSbutton_color' type=submit name=submit value='"._QXZ("SUBMIT")."'</td></tr>\n";
		echo "</TABLE></center>\n";
		}
	else
		{
		echo _QXZ("You do not have permission to view this page")."\n";
		exit;
		}
	}


######################
# ADD=196111111111 display the ADD NEW CID Group
######################
if ($ADD==196111111111)
	{
	if ($LOGmodify_statuses==1)
		{
		echo "<TABLE><TR><TD>\n";
		echo "<img src=\"images/icon_cidgroups.png\" alt=\"CID Groups\" width=42 height=42> <FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

		echo "<br>"._QXZ("ADD NEW CID GROUP")."<form action=$PHP_SELF method=POST>\n";
		echo "<input type=hidden name=ADD value=296111111111>\n";
		echo "<center><TABLE width=$section_width cellspacing=3>\n";

		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("CID Group ID").": </td><td align=left><input type=text name=cid_group_id size=20 maxlength=20>$NWB#cid_groups$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("CID Group Notes").": </td><td align=left><input type=text name=cid_group_notes size=50 maxlength=255>$NWB#cid_groups$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("CID Group Type").": </td><td align=left><select size=1 name=cid_group_type>\n";
		echo "<option SELECTED value=\"AREACODE\">"._QXZ("AREACODE")."</option>\n";
		echo "<option value=\"STATE\">"._QXZ("STATE")."</option>\n";
		echo "<option value=\"NONE\">"._QXZ("NONE")."</option>\n";
		echo "</select>$NWB#cid_groups$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Admin User Group").": </td><td align=left><select size=1 name=user_group>\n";
		echo "$UUgroups_list";
		echo "<option SELECTED value=\"---ALL---\">"._QXZ("All Admin User Groups")."</option>\n";
		echo "</select>$NWB#cid_groups$NWE</td></tr>\n";

		echo "<tr bgcolor=#$SSstd_row4_background><td align=center colspan=2><input style='background-color:#$SSbutton_color' type=submit name=submit value='"._QXZ("SUBMIT")."'</td></tr>\n";
		echo "</TABLE></center>\n";
		}
	else
		{
		echo _QXZ("You do not have permission to view this page")."\n";
		exit;
		}
	}


######################
# ADD=197111111111 display the ADD NEW VM MESSAGE Group
######################
if ($ADD==197111111111)
	{
	if ($LOGmodify_statuses==1)
		{
		echo "<TABLE><TR><TD>\n";
		echo "<img src=\"images/icon_vm_messages.png\" alt=\"VM Message Groups\" width=42 height=42> <FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

		echo "<br>"._QXZ("ADD NEW VM MESSAGE GROUP")."<form action=$PHP_SELF method=POST>\n";
		echo "<input type=hidden name=ADD value=297111111111>\n";
		echo "<center><TABLE width=$section_width cellspacing=3>\n";

		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("VM Message Group ID").": </td><td align=left><input type=text name=leave_vm_message_group_id size=40 maxlength=40>$NWB#vm_message_groups$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("VM Message Group Notes").": </td><td align=left><input type=text name=leave_vm_message_group_notes size=50 maxlength=255>$NWB#vm_message_groups$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Active").": </td><td align=left><select size=1 name=active>\n";
		echo "<option SELECTED value=\"N\">"._QXZ("No")."</option>\n";
		echo "<option value=\"Y\">"._QXZ("Yes")."</option>\n";
		echo "</select>$NWB#vm_message_groups$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Admin User Group").": </td><td align=left><select size=1 name=user_group>\n";
		echo "$UUgroups_list";
		echo "<option SELECTED value=\"---ALL---\">"._QXZ("All Admin User Groups")."</option>\n";
		echo "</select>$NWB#vm_message_groups$NWE</td></tr>\n";

		echo "<tr bgcolor=#$SSstd_row4_background><td align=center colspan=2><input style='background-color:#$SSbutton_color' type=submit name=submit value='"._QXZ("SUBMIT")."'</td></tr>\n";
		echo "</TABLE></center>\n";
		}
	else
		{
		echo _QXZ("You do not have permission to view this page")."\n";
		exit;
		}
	}


######################
# ADD=198111111111 display the ADD NEW Queue Group
######################
if ($ADD==198111111111)
	{
	if ($LOGmodify_statuses==1)
		{
		echo "<TABLE><TR><TD>\n";
		echo "<img src=\"images/icon_queuegroups.png\" alt=\"Queue Groups\" width=42 height=42> <FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

		echo "<br>"._QXZ("ADD NEW QUEUE GROUP")."<form action=$PHP_SELF method=POST>\n";
		echo "<input type=hidden name=ADD value=298111111111>\n";
		echo "<center><TABLE width=$section_width cellspacing=3>\n";

		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Queue Group ID").": </td><td align=left><input type=text name=queue_group size=20 maxlength=20>$NWB#queue_groups$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Queue Group Name").": </td><td align=left><input type=text name=queue_group_name size=40 maxlength=40>$NWB#queue_groups$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Active").": </td><td align=left><select size=1 name=active>\n";
		echo "<option SELECTED value=\"N\">"._QXZ("No")."</option>\n";
		echo "<option value=\"Y\">"._QXZ("Yes")."</option>\n";
		echo "</select>$NWB#queue_groups$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Admin User Group").": </td><td align=left><select size=1 name=user_group>\n";
		echo "$UUgroups_list";
		echo "<option SELECTED value=\"---ALL---\">"._QXZ("All Admin User Groups")."</option>\n";
		echo "</select>$NWB#queue_groups$NWE</td></tr>\n";

		echo "<tr bgcolor=#$SSstd_row4_background><td align=center colspan=2><input style='background-color:#$SSbutton_color' type=submit name=submit value='"._QXZ("SUBMIT")."'</td></tr>\n";
		echo "</TABLE></center>\n";
		}
	else
		{
		echo _QXZ("You do not have permission to view this page")."\n";
		exit;
		}
	}


######################
# ADD=1111111111111 display the ADD NEW CONFERENCE SCREEN
######################
if ($ADD==1111111111111)
	{
	if ($LOGast_admin_access==1)
		{
		echo "<TABLE><TR><TD>\n";
		echo "<img src=\"images/icon_conferences.png\" alt=\"Conferences\" width=42 height=42> <FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

		echo "<br>"._QXZ("ADD A NEW CONFERENCE")."<form action=$PHP_SELF method=POST>\n";
		echo "<input type=hidden name=ADD value=2111111111111>\n";
		echo "<center><TABLE width=$section_width cellspacing=3>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Conference Number").": </td><td align=left><input type=text name=conf_exten size=8 maxlength=7> ("._QXZ("digits only").")$NWB#conferences-conf_exten$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Server IP").": </td><td align=left><select size=1 name=server_ip>\n";
		echo "$servers_list";
		echo "</select>$NWB#conferences-server_ip$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=center colspan=2><input style='background-color:#$SSbutton_color' type=submit name=submit value='"._QXZ("SUBMIT")."'</td></tr>\n";
		echo "</TABLE></center>\n";
		}
	else
		{
		echo _QXZ("You do not have permission to view this page")."\n";
		exit;
		}
	}


######################
# ADD=11111111111111 display the ADD NEW VICIDIAL CONFERENCE SCREEN
######################
if ($ADD==11111111111111)
	{
	if ($LOGast_admin_access==1)
		{
		echo "<TABLE><TR><TD>\n";
		echo "<img src=\"images/icon_conferences.png\" alt=\"Conferences\" width=42 height=42> <FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

		echo "<br>"._QXZ("ADD A NEW AGENT CONFERENCE")."<form action=$PHP_SELF method=POST>\n";
		echo "<input type=hidden name=ADD value=21111111111111>\n";
		echo "<center><TABLE width=$section_width cellspacing=3>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Conference Number").": </td><td align=left><input type=text name=conf_exten size=8 maxlength=7> ("._QXZ("digits only").")$NWB#conferences-conf_exten$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=right>"._QXZ("Server IP").": </td><td align=left><select size=1 name=server_ip>\n";
		echo "$servers_list";
		echo "</select>$NWB#conferences-server_ip$NWE</td></tr>\n";
		echo "<tr bgcolor=#$SSstd_row4_background><td align=center colspan=2><input style='background-color:#$SSbutton_color' type=submit name=submit value='"._QXZ("SUBMIT")."'</td></tr>\n";
		echo "</TABLE></center>\n";
		}
	else
		{
		echo _QXZ("You do not have permission to view this page")."\n";
		exit;
		}
	}





######################################################################################################
######################################################################################################
#######   2 series, validates form data and inserts the new record into the database
######################################################################################################
######################################################################################################


######################
# ADD=2 adds the new user to the system
######################
if ($ADD=="2")
	{
	if ($add_copy_disabled > 0)
		{
		echo "<br>"._QXZ("You do not have permission to add records on this system")." -system_settings-\n";
		}
	else
		{
		##### BEGIN ID override optional section, if enabled it increments user by 1 ignoring entered value #####
		$stmt = "SELECT value FROM vicidial_override_ids where id_table='vicidial_users' and active='1';";
		$rslt=mysql_to_mysqli($stmt, $link);
		$voi_ct = mysqli_num_rows($rslt);
		if ($voi_ct > 0)
			{
			$row=mysqli_fetch_row($rslt);
			$user = ($row[0] + 1);

			$stmt="UPDATE vicidial_override_ids SET value='$user' where id_table='vicidial_users' and active='1';";
			$rslt=mysql_to_mysqli($stmt, $link);
			}
		##### END ID override optional section #####

		echo "<img src=\"images/icon_black_users.png\" alt=\"Users\" width=42 height=42> <FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";
		$stmt="SELECT count(*) from vicidial_users where user='$user';";
		$rslt=mysql_to_mysqli($stmt, $link);
		$row=mysqli_fetch_row($rslt);
		if ($row[0] > 0)
			{echo "<br>"._QXZ("USER NOT ADDED - there is already a user in the system with this user number")."\n";}
		else
			{
			if (preg_match('/AUTOGENERA/',$user))
				{
				$user = 'AUTOGENERA';
				}
			if ( (strlen($user) < 2) or (strlen($pass) < 2) or (strlen($full_name) < 2) or (strlen($user_group) < 2) or ( (mb_strlen($user,'utf-8') > 20) and (!preg_match('/AUTOGENERA/',$user)) ) or ( ($SSrequire_password_length > 0) and ($SSrequire_password_length > strlen($pass)) ) )
				{
				echo "<br>"._QXZ("USER NOT ADDED - Please go back and look at the data you entered")."\n";
				echo "<br>"._QXZ("user id must be between 2 and 20 characters long")."\n";
				if ($SSrequire_password_length > 0)
					{
					echo "<br>"._QXZ("full name must be at least 2 characters long")."\n";
					echo "<br>"._QXZ("password must be at least $SSrequire_password_length characters long")."\n";
					}
				else
					{echo "<br>"._QXZ("full name and password must be at least 2 characters long")."\n";}
				echo "<br>"._QXZ("you must select a user group")."\n";
				}
			else
				{
				if (preg_match('/AUTOGENERA/',$user))
					{
					$new_user=0;
					$auto_user_add_value=0;
					while ($new_user < 2)
						{
						if ($new_user < 1)
							{
							$stmt = "SELECT auto_user_add_value FROM system_settings;";
							$rslt=mysql_to_mysqli($stmt, $link);
							$ss_auav_ct = mysqli_num_rows($rslt);
							if ($ss_auav_ct > 0)
								{
								$row=mysqli_fetch_row($rslt);
								$auto_user_add_value = $row[0];
								}
							$new_user++;
							}
						$stmt = "SELECT count(*) FROM vicidial_users where user='$auto_user_add_value';";
						$rslt=mysql_to_mysqli($stmt, $link);
						$row=mysqli_fetch_row($rslt);
						if ($row[0] < 1)
							{
							$new_user++;
							}
						else 
							{
							echo "<!-- AG: $auto_user_add_value -->\n";
							$auto_user_add_value = ($auto_user_add_value + 7);
							}
						}
					$user = $auto_user_add_value;
					echo "<br><B>user_id "._QXZ("has been auto-generated").": $user</B><br>\n";

					$stmt="UPDATE system_settings SET auto_user_add_value='$user';";
					$rslt=mysql_to_mysqli($stmt, $link);
					}

				$pass_hash='';
				if ($SSpass_hash_enabled > 0)
					{
					$pass = preg_replace("/\'|\"|\\\\|;| /","",$pass);
					$pass_hash = exec("../agc/bp.pl --pass=$pass");
					$pass_hash = preg_replace("/PHASH: |\n|\r|\t| /",'',$pass_hash);
					$pass='';
					}

				echo "<br><B>"._QXZ("USER ADDED").": $user</B>\n";

				$stmt="INSERT INTO vicidial_users (user,pass,full_name,user_level,user_group,phone_login,phone_pass,pass_hash) values('$user','$pass','$full_name','$user_level','$user_group','$phone_login','$phone_pass','$pass_hash');";
				$rslt=mysql_to_mysqli($stmt, $link);

				### LOG INSERTION Admin Log Table ###
				$SQL_log = "$stmt|";
				$SQL_log = preg_replace('/;/', '', $SQL_log);
				$SQL_log = addslashes($SQL_log);
				$stmt="INSERT INTO vicidial_admin_log set event_date='$SQLdate', user='$PHP_AUTH_USER', ip_address='$ip', event_section='USERS', event_type='ADD', record_id='$user', event_code='ADMIN ADD USER', event_sql=\"$SQL_log\", event_notes='user: $user';";
				if ($DB) {echo "|$stmt|\n";}
				$rslt=mysql_to_mysqli($stmt, $link);

				###############################################################
				##### START SYSTEM_SETTINGS VTIGER CONNECTION INFO LOOKUP #####
				$stmt = "SELECT enable_vtiger_integration,vtiger_server_ip,vtiger_dbname,vtiger_login,vtiger_pass,vtiger_url FROM system_settings;";
				$rslt=mysql_to_mysqli($stmt, $link);
				if ($DB) {echo "$stmt\n";}
				$ss_conf_ct = mysqli_num_rows($rslt);
				if ($ss_conf_ct > 0)
					{
					$row=mysqli_fetch_row($rslt);
					$enable_vtiger_integration =	$row[0];
					$vtiger_server_ip	=			$row[1];
					$vtiger_dbname =				$row[2];
					$vtiger_login =					$row[3];
					$vtiger_pass =					$row[4];
					$vtiger_url =					$row[5];
					}
				##### END SYSTEM_SETTINGS VTIGER CONNECTION INFO LOOKUP #####
				#############################################################

				if ($enable_vtiger_integration > 0)
					{
					### connect to your vtiger database

					#$linkV=mysql_connect("$vtiger_server_ip", "$vtiger_login","$vtiger_pass");
					#if (!$linkV) {die("Could not connect: $vtiger_server_ip|$vtiger_dbname|$vtiger_login|$vtiger_pass" . mysqli_error());}
					#echo 'Connected successfully';
					#mysql_select_db("$vtiger_dbname", $linkV);

					$linkV=mysqli_connect("$vtiger_server_ip", "$vtiger_login", "$vtiger_pass", "$vtiger_dbname");
					if (!$linkV) 
						{
						die('MySQL '._QXZ("connect ERROR").': ' . mysqli_connect_error());
						}

					$user_name =		$user;
					$user_password =	$pass;
					$last_n