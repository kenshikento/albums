<?php

	class albums
	{
		public function getData()   // Grabs the data from sample api
		{				

			$result = file_get_contents('https://jsonplaceholder.typicode.com/albums');
			$resultDecoded = json_decode($result,true);	
			return $resultDecoded;
		}
		
		public function A($userID)
		{	
			$result = $this->getData();
			$i=0;
			
			foreach($result as $data){ // Simple foreach getting userID and doing simple count
				if($data["userId"]=== $userID)
				{	
					$i++;					
				}
			}
			echo "The number of associated albums with user $userID  = $i albums.";	
		}
		
		public function B()
		{	
			$key=[];
			$result = $this->getData();
			
			foreach($result as $data){
				array_push($key,$data['userId']); // Grabs the values from userID and array pushes them all into array $keys to be sorted.
			}
			
			$result = array_keys(array_flip($key)); // Using array flip function it swaps all array values with their keys and because you cannot have duplicate keys you will end up with unique keys.			 
			$uniqueUsers=count($result);
			echo "The amount of unique users are $uniqueUsers .";

		}

		
		public function C()
		{
			$key=[];
			$result = $this->getData();
			
			foreach($result as $data){
				array_push($key,$data['title']);
			}			
			$maxTitle = $this->sort_by_length($key);

			echo "This is longest album name: $maxTitle[0].";
			
		}
		
		public function sort_by_length($array) // USORT // Using Usort and measuring character length comparison is made and indicated which one is higher whcih then returns the array in sorted manner. 
		{
			usort($array, function($a, $b) 
			{ 
			return strlen($b)-strlen($a); 
			});
			return $array;			
		}

	}



	$start = new albums();	
	//$start -> A(2);
	//$start -> B();
	//$start -> C();

 // A/ How many Albums are associated with User 2?
 //	B/How many unique Users are there?
 // C/What is the longest album name?
?>
