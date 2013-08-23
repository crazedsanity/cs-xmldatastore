<?php
/*
 * Created on Sep 9, 2009
 *
 *  SVN INFORMATION:::
 * -------------------
 * Last Author::::::::: $Author: crazedsanity $ 
 * Current Revision:::: $Revision: 6 $ 
 * Repository Location: $HeadURL: https://svn.code.sf.net/p/cs-xmldatastore/code/trunk/current/tests/testOfXMLDataStore.php $ 
 * Last Updated:::::::: $Date: 2009-09-09 15:47:04 -0500 (Wed, 09 Sep 2009) $
 */


//=============================================================================
class testOfCSXMLDataStore extends UnitTestCase {
	
	//-------------------------------------------------------------------------
	function setUp() {
		
		$this->gfObj = new cs_globalFunctions;
		$this->gfObj->debugPrintOpt=1;
		
		//create the object.
		$this->store = new cs_xmlDataStore();
		
		//load schema.
		$this->store->db->beginTrans();
		$this->store->load_schema();
	}//end setUp()
	//-------------------------------------------------------------------------
	
	
	
	//-------------------------------------------------------------------------
	function tearDown() {
		$this->store->db->rollbackTrans();
	}//end tearDown()
	//-------------------------------------------------------------------------
	
	
	
	//-------------------------------------------------------------------------
	function test_basics() {
		
	}//end test_basics()
	//-------------------------------------------------------------------------
	
}//end testOfCSXMLDataStore{}
//=============================================================================
?>
