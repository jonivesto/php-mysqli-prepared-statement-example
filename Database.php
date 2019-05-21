<?php

class Database
{
	public function __construct()
	{
		// MySQL credentials
		$this->mysql_host = 'localhost';
		$this->mysql_user = 'root';
		$this->mysql_pass = '';
		$this->mysql_database = 'example_database';
	}
	
	function insert($values = NULL)
	{
		// Skip insert if there is nothing to insert
		if(!isset($values) || empty($values)) return;
		
		// Create connection
		$mysqli = new mysqli(
			$this->mysql_host, 
			$this->mysql_user, 
			$this->mysql_pass, 
			$this->mysql_database
		);
		
		// Check connection
		if ($mysqli->connect_error) {
			die($mysqli->connect_error);
		} 
		
		// Create prepared statement
		$sql = 'INSERT INTO example_table (value) VALUES (?)';
		$statement = $mysqli->prepare($sql);
		$statement->bind_param('s', $value);
		
		// Run statement multiple times
		foreach($values as $value){
			$statement->execute();
		}
		
		// Close statement and connection
		$statement->close();
		$mysqli->close();
	}
	
	function select()
	{
		// Create connection
		$mysqli = new mysqli(
			$this->mysql_host, 
			$this->mysql_user, 
			$this->mysql_pass, 
			$this->mysql_database
		);
		
		// Check connection
		if ($mysqli->connect_error) {
			die($mysqli->connect_error);
		} 
		
		// Run query
		$sql = 'SELECT * FROM example_table';
		$result = $mysqli->query($sql);
		
		// Print results
		if ($result->num_rows > 0) 
		{
			while($row = $result->fetch_assoc()) {
				echo '- ' . $row['value'] . '<br>';
			}
		} else {
			echo 'no results';
		}
		
		// Close connection
		$mysqli->close();
	}
}