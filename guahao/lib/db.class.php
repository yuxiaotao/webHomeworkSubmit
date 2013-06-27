<?php
class db{
               protected $conn;
			   public $sqls;
			   
               function __construct(){
			               for($i = 0;$i < 21;$i++){
			                 $conn = @mysql_pconnect(DB_hostname,DB_username,DB_password);
							 if($conn)
			                   if(mysql_select_db(DB_datebase)){
						         $this->conn = $conn;
						         mysql_query("SET character_set_connection=".DB_charset.", character_set_results=".DB_charset.", character_set_client=binary;");
								 break;
							   }
						     if($i == 20)
							   exit("数据库连接失败。");
						   }
			   }
			   
			   function sql($sql){
				           return mysql_query($sql,$this->conn);
			   }
			   
			   function insert($sql = ""){
				        $this->sqls .= $sql."<br />";
				        //echo $sql."<br />";
			               if(empty($sql) or !$this->conn) 
						     return false;
			               $result = mysql_query($sql,$this->conn);
						   if(!$result)
						     return false;
						   $insert_id = mysql_insert_id($this->conn);
						   if($insert_id)
						     return $insert_id;
						   return true ;
			   }
			   
			   function select($sql = ""){
				        $this->sqls .= $sql."<br />";
				        //echo $sql."<br />";
			               if(empty($sql) or !$this->conn) 
						     return false;
						   $result = mysql_query($sql);
						   if(!$result)
						     return false;
						   $count = 0;
						   $date = array();
						   while($row = mysql_fetch_array($result))
						     $date[$count++] = $row;
						   mysql_free_result($result);
						   return $date;
			   }
			   
			   function update($sql){
				        $this->sqls .= $sql."<br />";
						//echo $sql;
			               if(empty($sql) or !$this->conn) 
						     return false;
						   return mysql_query($sql);
			   
			   }
			   
			   function delete($sql){
				        $this->sqls .= $sql."<br />";
			               if(empty($sql) or !$this->conn) 
						     return false;
						   return mysql_query($sql);
			   }
			   
			   function insertDate($table,$date){
						   $table = '`'.DB_pre.$table.'`';
			               $keys = array();
			               foreach($date as $key => $value)
						     $keys[] = "`".$key."`='".$value."'";
						   $keys = implode(", ",$keys);
						   $sql = "INSERT INTO ".$table." SET ".$keys;
						   return $this->insert($sql);
			   }
			   
			   function selectDate($table,$keys = "",$fields = "",$limit = "",$ord = "",$sort = "DESC"){
			               $where = "";
						   $table = '`'.DB_pre.$table.'`';
						   if(!empty($keys)){
			                 if(is_array($keys))
							   $keys = implode(" AND ",$keys);
							 
							 $where = " WHERE ".$keys;
						   }

						   $fields = ($fields == "") ? "*" : $fields;
						   $sql = "SELECT ".$fields." FROM ".$table.$where;
						   if($ord != "")
						     $sql .= " ORDER BY `".$ord."` ".$sort;
						   if($limit != "")
						     $sql .= " LIMIT ".$limit;
						   $result = $this->select($sql);
						   if(empty($result))
						     return false;
						   return $result;
			   }
			   
			   function selectOne($table,$keys = "",$fields = "",$ord = "",$sort = "DESC"){
				           $result = $this->selectDate($table,$keys,$fields,1,$ord,$sort);
						   if(empty($result))
						     return false;
						   return $result[0];
						}
			   
			   function updateDate($table,$keys = "",$date,$limit = ""){
						   $where = "";
						   $table = '`'.DB_pre.$table.'`';
						   if(!empty($keys)){
			                 if(is_array($keys))
							   $keys = implode(" AND ",$keys);
							 
							 $where = " WHERE ".$keys;
						   }
						   if(is_array($date)){
						     $dates = array();
						     foreach($date as $key => $value)
						       $dates[] = '`'.$key."` = '".$value."'";
						     $dates = implode(",",$dates);
						   $sql = "UPDATE ".$table." SET ".$dates.$where;
						   }
						   else
						     $sql = "UPDATE ".$table." SET ".$date.$where;
						   if($limit != "")
						     $sql .= " LIMIT ".$limit;
						   return $this->update($sql);
			   }
			   
			   function deleteDate($table,$keys,$limit = ""){
				           $where = '';
						   $table = '`'.DB_pre.$table.'`';
						   if(!empty($keys)){
			                 if(is_array($keys))
							   $keys = implode(" AND ",$keys);
							 
							 $where = " WHERE ".$keys;
						   }
						   $sql = "DELETE FROM ".$table.$where;
						   if($limit != "")
						     $sql .= " LIMIT ".$limit;
						   return $this->delete($sql);
			   }
			   
			   
			   function  getNum($table,$keys = ""){
				           $where = '';
						   $table = '`'.DB_pre.$table.'`';
						   if(!empty($keys)){
			                 if(is_array($keys))
							   $keys = implode(" AND ",$keys);
							 
							 $where = " WHERE ".$keys;
						   }
						   $sql = "SELECT COUNT(*) AS `num` FROM ".$table.$where;
						   $result = $this->select($sql);
						   if(!$result)
						     return 0;
						   return $result[0]['num'];
			  }
		  
		  
		  function  getSum($table,$field,$keys = ""){
		  $table = DB_pre.$table;
		  $sql = "SELECT sum(`".$field."`) AS count_num FROM ".$table;
		  if(!empty($keys)){
		    if(is_array($keys)){
			  $array = array();
			  foreach($keys as $key => $value)
			    $array[] = $key." = '".$value."'";
			  $where = implode(" and ",$array);
			  $sql .= " WHERE ".$where;
		    }
			else{
			  $sql .= " WHERE ".$keys;
			}
		  }
		  $result = $this->select($sql);
		  if(!$result || $result[0]['count_num'] == NULL)
			return 0;
		  return $result[0]['count_num'];
}
			   
			   function transaction_start(){
		          mysql_query("SET  AUTOCOMMIT=0");
		          mysql_query("BEGIN");
	           }

	           function rollback(){
	             mysql_query("ROOLBACK");
	           }

	           function commit(){
		         mysql_query("COMMIT");
	           }
			   
}
?>