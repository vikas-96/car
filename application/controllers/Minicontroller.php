<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Minicontroller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Minimodel');
	}

	public function index()
	{
		$data['load_page'] = 'dashboard/index';
		$this->load->view('kernel', $data);
	}

	public function manufacturer()
	{
		$data['load_page'] = 'dashboard/Addmanufacturer';
		$this->load->view('kernel', $data);
	}

	public function Addmodel()
	{
		$data['load_page'] = 'dashboard/Addmodel';
		$manufacturer = $this->Minimodel->getmanufacturer();
		$getmanu = array(); 
		$getmanu[''] = 'Select Manufacturer';
        foreach($manufacturer as $r) { 
            $getmanu[$r->m_id] = $r->manufacturer_name; 
        } 
        
        $data['manufacturer'] = $getmanu;
		$this->load->view('kernel', $data);
	}

    public function checkmanufacturername(){
        $name = $this->input->post('mname');
        $result = $this->Minimodel->getmanufacturername($name);
        if ($result == 0) {
            echo "true";  //good to register
        } else {
            echo "false"; //already registered
        }
    }

	public function Viewinventory()
	{
		$data['load_page'] = 'dashboard/Viewinventory';
		$this->load->view('kernel', $data);
	}

	public function Addmanufacturer(){
		if($this->form_validation->run('frmManu')){
			$name = $this->input->post('mname',TRUE);
			$data = [
				'manufacturer_name' => $name
			];
			$result = $this->Minimodel->insertdata('manufacturer',$data);
			if($result){
				echo json_encode(array('success' => 'Manufacturer Added successfully'));
			}else{
				echo json_encode(array('error' => 'Something went wrong'));
			}
		}else{
			echo json_encode(array('error' => 'Please fill all fields'));
		}
	}

	public function NameValidation($strs){
        $str = trim($strs);
        if (empty($str)) {
            $this->form_validation->set_message('NameValidation', 'The {field} field is required.');
            return FALSE;
        }
        if (!preg_match("/^[a-zA-Z ']+$/i", $str)) {
            $this->form_validation->set_message('NameValidation', 'The {field} field allow alphabet,space and apostrophe only');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    Public function Addmodels() {
        if ($this->form_validation->run('frmModel') == FALSE) {
        	// error
            echo json_encode(array('error' => 'Please Fill Mandatory Fields.'));
            exit;
        } else {
            $uploadDataArrayBanner = $this->processUpload('Image');  // call upload function
            // print_r($uploadDataArrayBanner);
            foreach ($uploadDataArrayBanner as $uploadData) {
                if ($uploadData['error'] == 'NA') {
                    echo json_encode(array('error' => 'No File Selected in Car image.'));
                    exit;
                } elseif ($uploadData['error'] == 'N') {
                    $file_path_banner[] = $uploadData['upload_data']['image_path'];
                } elseif ($uploadData['error'] == 'Y') {
                    echo json_encode(array('error' => $uploadData['error_msg']));
                    exit;
                } else {
                    echo json_encode(array('error' => 'Error while uploading Banner image.'));
                    exit;
                }
            }

            // input datas
            $data = array(
                'model_name' => $this->input->post('modelname',TRUE),
                'manufacturer_id' => $this->input->post('manufacturer'),
                'color' => $this->input->post('color',TRUE),
                'manufacturing_year' => $this->input->post('year',TRUE),
                'registration_no' => $this->input->post('Rnumber',TRUE),
                'note' => $this->input->post('note',TRUE),
                'car_images' => base64_encode(serialize($file_path_banner))
            );

            $result = $this->Minimodel->insertdata('model',$data);  // insert

            if ($result !== FALSE) {
            	//success
                echo json_encode(array('success' => 'Model added successfully.'));
            } else {
            	//error
                echo json_encode(array('error' => 'Something went wrong in adding model.'));
                exit;
            }
        }
    }

    private function processUpload($file_name = FALSE, $path = 'assets/upload') {
        $returnArr[] = array(
            "error" => "NA"
        );
        if (!empty($_FILES[$file_name]['name'])) {
            if (array_filter($_FILES[$file_name]['name'])) {
            	// file exist or not
                if (!is_dir($path . '/' . date('Y'))) {
                    mkdir($path . '/' . date('Y'));
                    chmod($path . '/' . date('Y'), 0777);
                }

                // config validation
                $config['upload_path'] = $path . '/' . date('Y');
                $config['allowed_types'] = 'jpg|jpeg|png';
                // $config['max_size'] = 15360;
                $config['encrypt_name'] = TRUE;

                $filesCount = count($_FILES[$file_name]['name']);
                for ($i = 0; $i < $filesCount; $i++) {
                	// geting all file data
                    $_FILES['userFile']['name'] = $_FILES[$file_name]['name'][$i];
                    $_FILES['userFile']['type'] = $_FILES[$file_name]['type'][$i];
                    $_FILES['userFile']['tmp_name'] = $_FILES[$file_name]['tmp_name'][$i];
                    $_FILES['userFile']['error'] = $_FILES[$file_name]['error'][$i];
                    $_FILES['userFile']['size'] = $_FILES[$file_name]['size'][$i];
                    $this->load->library('upload', $config);
                    //$this->upload->initialize($config);
                    if (!$this->upload->do_upload('userFile')) {
                    	// error
                        $returnArr[$i]['error'] = "Y";
                        $returnArr[$i]['error_msg'] = $this->upload->display_errors();
                    } else {
                    	// success
                        $returnArr[$i]['error'] = "N";
                        $returnArr[$i]['upload_data'] = $this->upload->data();
                        $returnArr[$i]['upload_data']['image_path'] = date('Y') . '/' . $returnArr[$i]['upload_data']['file_name'];
                    }
                }
            }
        }
        return $returnArr;
    }

    public function getinventorydata() {
        $fetch_data = $this->Minimodel->getinventorydata();
        $data = array();
        $i = 1;
        foreach ($fetch_data as $row) {
            $sub_array = array();
            $sub_array[] = '<span mn="'.$row->manufacturer_id.'" mdl="'.$row->model_name.'">'.$i.'</span>';
            $sub_array[] = $row->manufacturer_name;
            $sub_array[] = $row->model_name;
            $count = $this->Minimodel->getinventorydistinctdata($row->manufacturer_id,$row->model_name);
            $sub_array[] = $count;
            $data[] = $sub_array;
            $i++;
        }
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $this->Minimodel->get_all_inventory_data(),
            "recordsFiltered" => $this->Minimodel->get_filtered_inventory_data(),
            "data" => $data
        );
        echo json_encode($output);
    }

    public function popupinventory(){
    	$modelname = $this->input->post('mdl');
    	$manufacturername = $this->input->post('mn');
    	$result['data'] = $this->Minimodel->get_popupdata($modelname,$manufacturername);
        return $this->load->view('dashboard/ajax/Inventorydetail',$result);
    }

    public function soldinventory(){
        $modelid = base64_decode($this->input->post('rev'));
        $data = [
            'status' => '1'
        ];
        $result = $this->Minimodel->soldcarinventory($data,$modelid);
        if($result == 0)
            echo json_encode(array('error' => 'Something went wrong while solding model.'));
        else
            echo json_encode(array('success' => 'Sold successfully.'));
    }

}