<?php 
class md_product extends CI_Model{

	function getKategory(){
		$data=$this->db->get('kategori');
		return $data;
	}

	function insertKategory($data){
		$res =$this->db->insert("kategori",$data);
    	return $res;
	}

	function getKategoryId($id){
		$data = $this->db->get_where('kategori', array('id_kategori' => $id));
        return $data;
	}

	function kategoryEdit($data,$where){
		$res =$this->db->update("kategori",$data,$where);
        return $res;
	}

	function delete_kategory_multiple($id){
		$res=$this->db->delete('kategori', array('id_kategori' => $id)); 
        return $res;
	}
}