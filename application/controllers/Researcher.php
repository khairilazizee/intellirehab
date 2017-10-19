<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Researcher extends CI_Controller {

	public function __construct(){

		parent::__construct();
		$this->load->helper("url");
		$this->load->model("researcher_model");
		$this->load->model("calendar_model");
		$this->load->model("follow_up_model");
		$this->load->model("profile_model");
		$this->load->model("stroke_model");

		if(!isset($_SESSION['login'])){
			redirect("login");
		} elseif($_SESSION['role_user']<>8 and $_SESSION['role_user']<>6 and $_SESSION['']<>3){
			redirect("login");
		}

	}

	public function index(){

		$data["dashboard"] = "";
		$data["icon_dashboard"] = "#fff";
		$data["managePatient"] = "";
		$data["icon_managePatient"] = "#ccc";
		$data["manageTheraphy"] = "";
		$data["followUP"] = "";
		$data["icon_followUP"] = "#ccc";
		$data["manageProfile"] = "";
		$data["icon_profile"] = "#ccc";
		$data["stroke"] = "";
		$data["icon_stroke"] = "#ccc;";

		$data["page"] = "Dashboard";
		$data["action"] = "";

		$data["maklumat_user"] = $this->profile_model->profile($_SESSION['id_user']);

		$data["jumlah_pesakit"] = $this->researcher_model->jumlahPatient($_SESSION['id_user']);

		$data["jumlah_followup"] = $this->follow_up_model->jumlahFollowup($_SESSION['id_user']);

		$data["maklumat_pesakit"] = $this->researcher_model->allPatient_dashboard($_SESSION['id_user']);
		$data["percentage"] = $this->researcher_model;

		$data["cal"] = $this->calendar_model->generate($_SESSION['id_user']);

		$data["schedule"] = $this->calendar_model->schedule($_SESSION['id_user']);

		$data["dah_hantar"] = $this->calendar_model->submit_approval($_SESSION['id_user'],1);
		$data["pending"] = $this->calendar_model->submit_approval($_SESSION['id_user'],2);

		$data["jumlah_approval"] = $this->researcher_model->kira_approval($_SESSION['id_user']);

		$data["jantina_lelaki"] = $this->researcher_model->kira_jantina($_SESSION['id_user'],1);
		$data["jantina_perempuan"] = $this->researcher_model->kira_jantina($_SESSION['id_user'],2);
		$data["jantina_others"] = $this->researcher_model->kira_jantina($_SESSION['id_user'],3);

		$this->load->view("main/header_view");
		$this->load->view("main/canvas_side_start");
		$this->load->view("therapist_researcher/sidebar_view", $data);
		$this->load->view("main/canvas_main_start");
		$this->load->view("therapist_researcher/topbar_view", $data);
		$this->load->view("therapist_researcher/dashboard_view", $data);
		$this->load->view("main/canvas_main_end");
		$this->load->view("main/canvas_side_end");
		$this->load->view("main/footer_view");
		
	}

	public function manage_patient(){

		$data["dashboard"] = "";
		$data["icon_dashboard"] = "#ccc";
		$data["managePatient"] = "";
		$data["icon_managePatient"] = "#fff";
		$data["manageTheraphy"] = "";
		$data["followUP"] = "";
		$data["icon_followUP"] = "#ccc";
		$data["manageProfile"] = "";
		$data["icon_profile"] = "#ccc";
		$data["stroke"] = "";
		$data["icon_stroke"] = "#ccc;";

		$data["page"] = "Patient";
		$data["action"] = "";

		$data["maklumat_therapy"] = $this->researcher_model->allTherapy($_SESSION['id_user']);

		$data["percentage"] = $this->researcher_model; // kira_percentage
		$data["atas"] = $this->researcher_model; // kira_table_ada_isi
		$data["bawah"] = $this->researcher_model->kira_table_semua();

		$this->load->view("main/header_view");
		$this->load->view("main/canvas_side_start");
		$this->load->view("therapist_researcher/sidebar_view", $data);
		$this->load->view("main/canvas_main_start");
		$this->load->view("therapist_researcher/topbar_view", $data);
		$this->load->view("therapist_researcher/manage_patient_view", $data);
		$this->load->view("main/canvas_main_end");
		$this->load->view("main/canvas_side_end");
		$this->load->view("main/footer_view");

	}

	public function manage_therapy($researchID,$session){

		$data["dashboard"] = "";
		$data["icon_dashboard"] = "#ccc";
		$data["managePatient"] = "";
		$data["icon_managePatient"] = "#fff";
		$data["manageTheraphy"] = "";
		$data["followUP"] = "";
		$data["icon_followUP"] = "#ccc";
		$data["manageProfile"] = "";
		$data["icon_profile"] = "#ccc";
		$data["stroke"] = "";
		$data["icon_stroke"] = "#ccc;";

		$data["page"] = "Theraphy";
		$data["action"] = $researchID;
		$data["idtherapy"] = $session;

		$data["new_session"] = $this->researcher_model->new_session($researchID);

		$data["maklumat_patient"] = $this->researcher_model->allPatient($_SESSION['id_user'],$researchID,$session);

		$data["percentage"] = $this->researcher_model->kira_percentage($researchID, $session);
		$data["atas"] = $this->researcher_model->kira_table_ada_isi($researchID,$session);
		$data["bawah"] = $this->researcher_model->kira_table_semua();

		$this->load->view("main/header_view");
		$this->load->view("main/canvas_side_start");
		$this->load->view("therapist_researcher/sidebar_view", $data);
		$this->load->view("main/canvas_main_start");
		$this->load->view("therapist_researcher/topbar_view", $data);
		$this->load->view("therapist_researcher/manage_therapy_list_view", $data);
		$this->load->view("main/canvas_main_end");
		$this->load->view("main/canvas_side_end");
		$this->load->view("main/footer_view");

	}

	public function patient_theraphy($researchID,$sessionNo){

		$data["dashboard"] = "";
		$data["icon_dashboard"] = "#ccc";
		$data["managePatient"] = "";
		$data["icon_managePatient"] = "#fff";
		$data["manageTheraphy"] = "";
		$data["followUP"] = "";
		$data["icon_followUP"] = "#ccc";
		$data["manageProfile"] = "";
		$data["icon_profile"] = "#ccc";
		$data["stroke"] = "";
		$data["icon_stroke"] = "#ccc;";

		$data["page"] = "Theraphy";
		$data["action"] = $researchID;
		$data["session"] = $sessionNo;

		$data["maklumat_minimum_data"] = $this->researcher_model->minimum_data($researchID);
		$data["pat_05"] = $this->researcher_model->pat_05($researchID);

		$data["clinicalD13"] = $this->researcher_model->panggil_data_clinical1($researchID,$sessionNo);
		$data["pat_23"] = $this->researcher_model->pat_23($researchID,$sessionNo);

		$data["clinicalD29"] = $this->researcher_model->panggil_data_clinical2($researchID,$sessionNo);
		$data["pat_29"] = $this->researcher_model->pat_29($researchID,$sessionNo);

		$data["clinicalD42"] = $this->researcher_model->panggil_data_clinical3($researchID,$sessionNo);

		$data["diagnostic"] = $this->researcher_model->panggil_data_diagnostic($researchID,$sessionNo);
		$data["pat_57"] = $this->researcher_model->pat_57($researchID,$sessionNo);

		$data["management"] = $this->researcher_model->panggil_data_mgt($researchID,$sessionNo);
		$data["pat_63"] = $this->researcher_model->pat_63($researchID,"63",$sessionNo);
		$data["pat_73a"] = $this->researcher_model->pat_63($researchID,"73a",$sessionNo);
		$data["pat_73b"] = $this->researcher_model->pat_63($researchID,"73b",$sessionNo);
		$data["pat_73c"] = $this->researcher_model->pat_63($researchID,"73c",$sessionNo);
		$data["pat_70"] = $this->researcher_model->pat_63($researchID,"70",$sessionNo);
		$data["pat_71"] = $this->researcher_model->pat_63($researchID,"71",$sessionNo);

		$data["otherinformation"] = $this->researcher_model->panggil_data_other_info($researchID,$sessionNo);
		$data["pat_72"] = $this->researcher_model->pat_72($researchID,"72",$sessionNo);
		$data["pat_72a"] = $this->researcher_model->pat_72($researchID,"72a",$sessionNo);
		$data["pat_72b"] = $this->researcher_model->pat_72($researchID,"72b",$sessionNo);
		$data["pat_72c"] = $this->researcher_model->pat_72($researchID,"72c",$sessionNo);

		$data["tab_1"] = $this->load->view("therapist_researcher/edit_patient_view", $data, TRUE);
		$data["tab_2"] = $this->load->view("therapist_researcher/manage_clinical_view_1", $data, TRUE);
		$data["tab_3"] = $this->load->view("therapist_researcher/manage_diagnostic_view", $data, TRUE);
		$data["tab_4"] = $this->load->view("therapist_researcher/manage_management_view", $data, TRUE);
		$data["tab_5"] = $this->load->view("therapist_researcher/manage_other_information_view", $data, TRUE);
		$data["tab_6"] = $this->load->view("therapist_researcher/manage_clinical_view_2", $data, TRUE);
		$data["tab_7"] = $this->load->view("therapist_researcher/manage_clinical_view_3", $data, TRUE);

		$this->load->view("main/header_view");
		$this->load->view("main/canvas_side_start");
		$this->load->view("therapist_researcher/sidebar_view", $data);
		$this->load->view("main/canvas_main_start");
		$this->load->view("therapist_researcher/topbar_view", $data);
		$this->load->view("therapist_researcher/manage_theraphy_view", $data);
		$this->load->view("main/canvas_main_end");
		$this->load->view("main/canvas_side_end");
		$this->load->view("main/footer_view");

	}

	public function follow_up(){

		$data["dashboard"] = "";
		$data["icon_dashboard"] = "#ccc";
		$data["managePatient"] = "";
		$data["icon_managePatient"] = "#ccc";
		$data["manageTheraphy"] = "";
		$data["followUP"] = "";
		$data["icon_followUP"] = "#fff";
		$data["manageProfile"] = "";
		$data["icon_profile"] = "#ccc";
		$data["stroke"] = "";
		$data["icon_stroke"] = "#ccc;";

		$data["page"] = "Follow UP";
		$data["action"] = "";

		$data["senarai_patient"] = $this->follow_up_model->semua_pesakit();
		$data["status_followup"] = $this->follow_up_model;

		$this->load->view("main/header_view");
		$this->load->view("main/canvas_side_start");
		$this->load->view("therapist_researcher/sidebar_view", $data);
		$this->load->view("main/canvas_main_start");
		$this->load->view("therapist_researcher/topbar_view", $data);
		$this->load->view("follow_up/manage_followup", $data);
		$this->load->view("main/canvas_main_end");
		$this->load->view("main/canvas_side_end");
		$this->load->view("main/footer_view");

	}

	public function manage_followup($researchID,$session){

		$data["dashboard"] = "";
		$data["icon_dashboard"] = "#ccc";
		$data["managePatient"] = "";
		$data["icon_managePatient"] = "#ccc";
		$data["manageTheraphy"] = "";
		$data["followUP"] = "";
		$data["icon_followUP"] = "#fff";
		$data["manageProfile"] = "";
		$data["icon_profile"] = "#ccc";
		$data["stroke"] = "";
		$data["icon_stroke"] = "#ccc;";

		$data["page"] = "Follow UP";
		$data["action"] = "";

		$data["researchID"] = $researchID;
		$data["researcherID"] = $researchID;
		$data["session"] = $session;

		$data["module"] = "researcher";
		$data["jenis"] = "9";

		$data["maklumat_follow1"] = $this->follow_up_model->followup($researchID,$session, "tbl_followupD74toD84");
		$data["followup74"] = $this->follow_up_model->followsub($researchID,$session,"74");
		$data["maklumat_follow2"] = $this->follow_up_model->followup($researchID,$session, "tbl_followupD85toD91");
		$data["followup85"] = $this->follow_up_model->followsub($researchID,$session,"85");

		$data["maklumat_arom"] = $this->stroke_model->stroke_view($researchID,$session,"arom",9);
		$data["maklumat_prom"] = $this->stroke_model->stroke_view($researchID,$session,"prom",9);
		$data["maklumat_msgarom"] = $this->stroke_model->stroke_view($researchID,$session,"msgarom",9);

		$data["tab_1"] = $this->load->view("follow_up/follow1", $data, TRUE);
		$data["tab_2"] = $this->load->view("follow_up/follow2", $data, TRUE);
		$data["tab_3"] = $this->load->view("stroke/arom_view", $data, TRUE);
		$data["tab_4"] = $this->load->view("stroke/prom_view", $data, TRUE);
		$data["tab_5"] = $this->load->view("stroke/muscle_arom_view", $data, TRUE);

		$this->load->view("main/header_view");
		$this->load->view("main/canvas_side_start");
		$this->load->view("therapist_researcher/sidebar_view", $data);
		$this->load->view("main/canvas_main_start");
		$this->load->view("therapist_researcher/topbar_view", $data);
		$this->load->view("follow_up/main_followup", $data);
		$this->load->view("main/canvas_main_end");
		$this->load->view("main/canvas_side_end");
		$this->load->view("main/footer_view");

	}

	public function manage_profile(){

		$data["dashboard"] = "";
		$data["icon_dashboard"] = "#ccc";
		$data["managePatient"] = "";
		$data["icon_managePatient"] = "#ccc";
		$data["manageTheraphy"] = "";
		$data["followUP"] = "";
		$data["icon_followUP"] = "#ccc";
		$data["manageProfile"] = "";
		$data["icon_profile"] = "#fff";
		$data["stroke"] = "";
		$data["icon_stroke"] = "#ccc;";

		$data["page"] = "Profile";
		$data["action"] = "";

		$data["data_profile"] = $this->profile_model->profile($_SESSION['id_user']);
		$data["data_role"] = $this->profile_model->allRole();

		$this->load->view("main/header_view");
		$this->load->view("main/canvas_side_start");
		$this->load->view("therapist_researcher/sidebar_view", $data);
		$this->load->view("main/canvas_main_start");
		$this->load->view("therapist_researcher/topbar_view", $data);
		$this->load->view("therapist_researcher/manage_profile", $data);
		$this->load->view("main/canvas_main_end");
		$this->load->view("main/canvas_side_end");
		$this->load->view("main/footer_view");

		// $this->load->view("errors/html/error_500");
		
	}

	public function page_process_profile(){

		$query = $this->profile_model->process_profile();

		if($query==1){
			redirect("researcher/manage_profile");
		}

	}


	public function new_patient(){

		$data["dashboard"] = "";
		$data["icon_dashboard"] = "#ccc";
		$data["managePatient"] = "";
		$data["icon_managePatient"] = "#fff";
		$data["manageTheraphy"] = "";
		$data["followUP"] = "";
		$data["icon_followUP"] = "#ccc";
		$data["manageProfile"] = "";
		$data["icon_profile"] = "#ccc";
		$data["stroke"] = "";
		$data["icon_stroke"] = "#ccc;";

		$data["page"] = "Patient";
		$data["action"] = "New Patient";

		$this->load->view("main/header_view");
		$this->load->view("main/canvas_side_start");
		$this->load->view("therapist_researcher/sidebar_view", $data);
		$this->load->view("main/canvas_main_start");
		$this->load->view("therapist_researcher/topbar_view", $data);
		$this->load->view("therapist_researcher/add_patient_view", $data);
		$this->load->view("main/canvas_main_end");
		$this->load->view("main/canvas_side_end");
		$this->load->view("main/footer_view");

	}

	public function manage_stroke(){

		$data["dashboard"] = "";
		$data["icon_dashboard"] = "#ccc";
		$data["managePatient"] = "";
		$data["icon_managePatient"] = "#ccc";
		$data["manageTheraphy"] = "";
		$data["followUP"] = "";
		$data["icon_followUP"] = "#ccc";
		$data["manageProfile"] = "";
		$data["icon_profile"] = "#ccc";
		$data["stroke"] = "";
		$data["icon_stroke"] = "#fff;";

		$data["page"] = "Stroke";
		$data["action"] = "";

		$data["senarai_patient"] = $this->researcher_model->allTherapy($_SESSION['id_user']);

		$this->load->view("main/header_view");
		$this->load->view("main/canvas_side_start");
		$this->load->view("therapist_researcher/sidebar_view", $data);
		$this->load->view("main/canvas_main_start");
		$this->load->view("therapist_researcher/topbar_view", $data);
		$this->load->view("therapist_researcher/manage_patient_stroke", $data);
		$this->load->view("main/canvas_main_end");
		$this->load->view("main/canvas_side_end");
		$this->load->view("main/footer_view");

	}

	public function new_stroke($researchID, $session){

		$data["dashboard"] = "";
		$data["icon_dashboard"] = "#ccc";
		$data["managePatient"] = "";
		$data["icon_managePatient"] = "#ccc";
		$data["manageTheraphy"] = "";
		$data["followUP"] = "";
		$data["icon_followUP"] = "#ccc";
		$data["manageProfile"] = "";
		$data["icon_profile"] = "#ccc";
		$data["stroke"] = "";
		$data["icon_stroke"] = "#fff;";

		$data["page"] = "Stroke";
		$data["action"] = "New";

		$data["module"] = "researcher";
		$data["researcherID"] = $researchID;
		$data["session"] = $session;
		$data["jenis"] = "4";

		$data["maklumat_arom"] = $this->stroke_model->stroke_view($researchID,$session,"arom",4);
		$data["maklumat_prom"] = $this->stroke_model->stroke_view($researchID,$session,"prom",4);
		$data["maklumat_msgarom"] = $this->stroke_model->stroke_view($researchID,$session,"msgarom",4);

		$data["tab_1"] = $this->load->view("stroke/arom_view", $data, TRUE);
		$data["tab_2"] = $this->load->view("stroke/prom_view", $data, TRUE);
		$data["tab_3"] = $this->load->view("stroke/muscle_arom_view", $data, TRUE);

		$this->load->view("main/header_view");
		$this->load->view("main/canvas_side_start");
		$this->load->view("therapist_researcher/sidebar_view", $data);
		$this->load->view("main/canvas_main_start");
		$this->load->view("therapist_researcher/topbar_view", $data);
		$this->load->view("stroke/manage_stroke", $data);
		$this->load->view("main/canvas_main_end");
		$this->load->view("main/canvas_side_end");
		$this->load->view("main/footer_view");

	}

	public function page_add_new_patient(){

		$researchID = "RID".$this->input->post("inpPatResearchID");

		$query = $this->researcher_model->addNewPatient();

		if($query==1){
			redirect("researcher/patient_theraphy/".$researchID."/1"); // sesi pertama
		}

	}

	public function counter_rid(){

		$data = $this->researcher_model->counter();

		echo $data;

	}

	public function page_edit_patient($researchID,$session){

		$tab = $this->input->post("hdnTab");

		$query = $this->researcher_model->process_edit_minimum($researchID,$session);

		if($query==1){
			redirect("researcher/patient_theraphy/".$researchID."/".$session."#$tab");
		}

	}

	public function page_process_clinical1($researchID,$session){

		$tab = $this->input->post("hdnTab");

		$query = $this->researcher_model->process_clinical1($researchID,$session);

		if($query==1){
			redirect("researcher/patient_theraphy/".$researchID."/".$session."#$tab");
		}

	}

	public function page_process_clinical2($researchID,$session){

		$tab = $this->input->post("hdnTab");

		$query = $this->researcher_model->process_clinical2($researchID,$session);

		if($query==1){
			redirect("researcher/patient_theraphy/".$researchID."/".$session."#$tab");
		}

	}

	public function page_process_clinical3($researchID,$session){

		$tab = $this->input->post("hdnTab");

		$query = $this->researcher_model->process_clinical3($researchID,$session);

		if($query==1){
			redirect("researcher/patient_theraphy/".$researchID."/".$session."#$tab");
		}

	}

	public function page_process_diagnostic($researchID,$session){

		$tab = $this->input->post("hdnTab");

		$query = $this->researcher_model->process_diagnostic($researchID,$session);

		if($query==1){
			redirect("researcher/patient_theraphy/".$researchID."/".$session."#$tab");
		}

	}

	public function page_process_management($researchID,$session){

		$tab = $this->input->post("hdnTab");

		$query = $this->researcher_model->process_management($researchID,$session);

		if($query==1){
			redirect("researcher/patient_theraphy/".$researchID."/".$session."#$tab");
		}

	}

	public function page_process_other_information($researchID,$session){

		$tab = $this->input->post("hdnTab");

		$query = $this->researcher_model->process_other_information($researchID,$session);

		if($query==1){
			redirect("researcher/patient_theraphy/".$researchID."/".$session."#$tab");
		}

	}

	public function send_mail() {
        
		$email = $this->researcher_model->hantar_email();

    }

    public function page_process_follow1($researchID,$session){

    	$panel = $this->input->post("hdnPanel");
    	$query = $this->follow_up_model->process_follow1($researchID,$session);

    	if($query==1){
    		redirect("researcher/manage_followup/".$researchID."/".$session."#$panel");
    	}

    }

    public function page_process_follow2($researchID, $session){

    	$panel = $this->input->post("hdnPanel");
    	$query = $this->follow_up_model->process_follow2($researchID,$session);

    	if($query==1){
    		redirect("researcher/manage_followup/".$researchID."/".$session."#$panel");
    	}

    }

    // ajax

    public function keterangan_patient(){

    	$query = $this->researcher_model->detailPatient();

    	echo $query;

    }

    public function maklumat_dob(){

    	$dob = $this->input->post("dob");
    	
    	$query = $this->researcher_model->maklumatDOB($dob);

    	echo $query;

    }

    public function page_process_arom($researchID, $session){

    	$panel = $this->input->post("hdnPanel");
    	$query = $this->researcher_model->process_arom($researchID, $session);

    	if($query==1){
    		redirect("researcher/new_stroke/$researchID/$session#$panel");
    	}

    }

    public function page_process_prom($researchID, $session){

    	$panel = $this->input->post("hdnPanel");
    	$query = $this->researcher_model->process_prom($researchID, $session);

    	if($query==1){
    		redirect("researcher/new_stroke/$researchID/$session#$panel");
    	}
    }

    public function page_process_msgarom($researchID, $session){

    	$panel = $this->input->post("hdnPanel");
    	$query = $this->researcher_model->process_msgarom($researchID, $session);

    	if($query==1){
    		redirect("researcher/new_stroke/$researchID/$session#$panel");
    	}
    }


}