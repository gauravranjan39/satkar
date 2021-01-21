<?php
/*  Created on 13-Jun-2018
 * Common component to which will contain all the Common methods we are using in all the Controllers
 *
 *
 *
 */

class CommonComponent extends Component {

    public $components = array('Session');
    
    /*
    // function to create insert query for bulk insert to insert data with just one query which will be much faster then each insert for one record.
        Params : 
            $fieldList : array of fields array('name'=> 'filed_name', 'type' => 'typename' ).
            $insertData : array of values to be inserted in the same order as in the field array.
            $tablename : name of the table where data need to be inserted.
        Return : (string) insert query text or error message in case of any empty values.
        Example : 
            $fieldList = array(array('name'=>"field1",'type'=>'string'),array('name'=>"field2",'type'=>'string'),array('name'=>"field3",'type'=>'int'),array('name'=>"field4",'type'=>'float'));
            $insertData = array(
                array('test1','test2',12,3.4),
                array('test11','test12',13,5.7),
                array('test43','test54',32,6.4),);
            $tablename = "table_new_1";
    */ 
    public function bulkInsert($fieldList,$insertData,$tablename){
        if (!empty($insertData) && !empty($fieldList) && !empty($tablename)) {

            $insertQuery = $tempInsertQuery = $rowInsertQuery = "";

            //list of field types where we need to add single quotes
            $stringTypesArr = array('string','varchar','char','enum','text','longtext','timestamp','datetime','date','decimal');

            //list of field types where we DOESN'T need to any single quotes
            $numberTypeArr = array('int','float','double','bigint','smallint','tinyint','boolean');
            
            $insertQuery = "INSERT INTO `".$tablename."` (";
            
            foreach ($fieldList as $fieldData) {
                $tempInsertQuery .= "`".$fieldData['name']."`,";
            }

            //remove last comma
            $insertQuery .= rtrim($tempInsertQuery, ',');
            $insertQuery .= ") VALUES ";

            foreach ($insertData as $recordArr) {
                if (!empty($recordArr)) {
                    $rowInsertQuery .= "(";
                    $tempRowQuery = "";
                    foreach ($recordArr as $key => $dataValue) {
                        //checking the type of the field and accordingly add single quotes or not
                        if (in_array($fieldList[$key]['type'], $numberTypeArr)) {
                            $tempRowQuery .= " ".$dataValue.",";
                        }elseif (in_array($fieldList[$key]['type'], $stringTypesArr)) {
                            $tempRowQuery .= " '".$dataValue."',";
                        }
                    }

                    //remove last comma
                    $rowInsertQuery .= rtrim($tempRowQuery, ',');
                    $rowInsertQuery .= "),";
                }
            }

            if (!empty($rowInsertQuery)) {
                //remove last comma
                $insertQuery .= rtrim($rowInsertQuery, ',');
                $insertQuery .= ";";
            }

            return $insertQuery;
        }else{
            return "All parameters are mandatory";
        }
    } 


}