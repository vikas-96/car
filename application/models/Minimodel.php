<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Minimodel extends CI_Model {

	public function getmanufacturer() {
		$query = $this->db->order_by('manufacturer_name','asc')->get('manufacturer');
		return $query->result();
	}

	public function addmanufacturer() {
		$query = $this->db->order_by('manufacturer_name','asc')->get('manufacturer');
		return $query->result();
	}

	public function insertdata($tablename, $data) {
        $query = $this->db->insert($tablename, $data);
        if ($this->db->affected_rows())
            return true;
        else {
            $this->log_error('InsertQuery', "Descripition:" . json_encode($this->db->error()));
            return false;
        }
    }

  //   public function selectdata($table,$where=null,$orderby=null){
  //   	($orderby != null)?$this->db->order_by($orderby,'asc'):'';
  //   	($where != null)?$this->db->where($where):'';
  //	 $this->db->get($table);
  //   }

    public function getmanufacturername($name){
        $query = $this->db->where(['manufacturer_name'=>$name])
                        ->get('manufacturer');
        return $query->num_rows();
    }

    public function getinventorydistinctdata($mid,$modelname){
    	$query = $this->db->where(['manufacturer_id'=>$mid,'model_name'=>$modelname,'status'=>'0'])
    					->get('model');
    	return $query->num_rows();
    }

    public function getinventorydata() {
        $this->make_inventory_query();
        if ($_POST["length"] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

	public function modeltablejoin(){
		$this->db->where('m.status','0');
		$this->db->join('manufacturer as mn',"mn.m_id = m.manufacturer_id",'inner');
		$this->db->from('model as m');
		$this->db->select('m.model_name,m.manufacturer_id,mn.manufacturer_name');
		$this->db->distinct('m.model_name,m.manufacturer_id');
	}

    public function make_inventory_query() {
        $this->modeltablejoin();
        if (isset($_POST["search"]["value"]) && !empty($_POST["search"]["value"])) {
            $this->db->group_start();
            $this->db->like("m.model_name", $_POST["search"]["value"]);
            $this->db->or_like("mn.manufacturer_name", $_POST["search"]["value"]);
            $this->db->group_end();
        }
        if (isset($_POST["order"])) {
            $columns = array(
                0 => 'm.model_name',
                1 => 'mn.manufacturer_name',
            );
            $columnName = $columns[$_POST['order']['0']['column']];

            if (array_key_exists(1, $columns)) {
                $this->db->order_by($columnName, $_POST['order']['0']['dir']);
            } else {
                $this->db->order_by('m.model_id', 'DESC');
            }
        } else {
            $this->db->order_by('m.model_id', 'DESC');
        }
    }

    public function get_filtered_inventory_data() {
        $this->make_inventory_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function get_all_inventory_data() {
        $this->modeltablejoin();
        return $this->db->count_all_results();
    }

    public function get_popupdata($modelname,$manufacturername)
    {
    	$query = $this->db->where(['model_name'=>$modelname,'manufacturer_id'=>$manufacturername,'status'=>'0'])
		    			->from('model')
		    			->select('model_id,model_name,manufacturing_year,color,registration_no,note,car_images');
		    			
		return $query->get()->result();

    }

    public function soldcarinventory($data,$modelid){
        $this->db->where('model_id',$modelid);
        return ($this->db->update('model',$data))?$this->db->affected_rows():false;
    }

}