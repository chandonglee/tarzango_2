<?php

class Countries_model extends CI_Model {

		function __construct() {
// Call the Model constructor
				parent :: __construct();
		}



// Get all countries
		function get_all_countries() {
				$countriesData = json_decode(file_get_contents("application/json/countries.json"));
				usort($countriesData, array($this, "sortByName"));
				return $countriesData;
		}

        // Get all countries
		function Api_all_countries() {

				/*$this->db->select('short_name as name,iso2 as code');
				$this->db->where('country_status', '1');
				$this->db->order_by('short_name', 'asc');
				$q = $this->db->get('pt_countries')->result();
				return $q;*/
				
				$countries = $this->get_all_countries();
				$apiCountries = array();
				foreach($countries as $c){
				$apiCountries[] = (object)array('name' => $c->short_name,'code' => $c->iso2);	
				}
				return $apiCountries;
		}

		function sortByName($a, $b)
		{
		return strcmp($a->short_name, $b->short_name);
		}

}