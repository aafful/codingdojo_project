<?php
	require("connection.php");
	session_start();

	
	class Processs extends Database
	{
		var $connection;
		
		function __construct()
		{
			$this->connection = new Database();
		
			if (isset($_POST['action']) && $_POST['action'] == "country_select")
			{
				$this->displayCountryInfo();			
			}
		}

		function displayCountryInfo(){
			 $query = "SELECT * FROM country 
                                          WHERE name='". $_POST['country_name'] ."'";
                        $country_info = $this->connection->fetch_record($query);
                        $country_data['country_data'] = '';

			$country_data['country_data'] .= "Country: {$country_info['Name']}<br>";
            $country_data['country_data'] .= "Continent: {$country_info['Continent']}<br>";
            $country_data['country_data'] .="Region: {$country_info['Region']}<br>";
            $country_data['country_data'] .="Population: {$country_info['Population']}<br>";
            $country_data['country_data'] .= "Life Expectancy: {$country_info['LifeExpectancy']}<br>";
            $country_data['country_data'] .="Government Form: {$country_info['GovernmentForm']}<br>";
             
           	$data['country_data'] = $country_data;
            echo json_encode($data);
		}
	}

	$process = new Processs();
?>