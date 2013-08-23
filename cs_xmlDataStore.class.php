<?php
/*
 * Created on Aug 28, 2009
 *
 *  SVN INFORMATION:::
 * -------------------
 * Last Author::::::::: $Author: crazedsanity $ 
 * Current Revision:::: $Revision: 7 $ 
 * Repository Location: $HeadURL: https://svn.code.sf.net/p/cs-xmldatastore/code/trunk/current/cs_xmlDataStore.class.php $ 
 * Last Updated:::::::: $Date: 2009-09-10 12:36:03 -0500 (Thu, 10 Sep 2009) $
 */


class cs_xmlDataStore {
	
	public $db;
	protected $reader;
	protected $writer;
	protected $authTokenObj;
	
	
	//-------------------------------------------------------------------------
	public function __construct() {
		if(defined(__CLASS__ .'-DBTYPE')) {
			//create database handle.
			$params = array(
				'host'		=> constant(__CLASS__ .'-HOST'),
				'dbname'	=> constant(__CLASS__ .'-DBNAME'),
				'user'		=> constant(__CLASS__ .'-USER'),
				'password'	=> constant(__CLASS__ .'-PASSWORD'),
				'port'		=> constant(__CLASS__ .'-PORT')
			);
			
			$this->db = new cs_phpDB(constant(__CLASS__ .'-DBTYPE'));
			$this->db->connect($params);
			
			$this->authTokenObj = new cs_authToken($this->db);
		}
		else {
			throw new exception(__METHOD__ .": missing DBTYPE constant (". __CLASS__ .'_DBTYPE' .")");
		}
	}//end __construct()
	//-------------------------------------------------------------------------
	
	
	
	//-------------------------------------------------------------------------
	public function load_schema() {
		$schemaFile = dirname(__FILE__) .'/setup/schema.'. $this->db->get_dbtype() .'.sql';
		
		if(file_exists($schemaFile)) {
			$this->db->run_update(file_get_contents($schemaFile), true);
		}
		else {
			throw new exception(__METHOD__ .": db type (". $this->db->get_dbtype() .") not supported " .
					"or missing schema file(". $schemaFile .")");
		}
	}//end load_schema()
	//-------------------------------------------------------------------------
	
}

?>
