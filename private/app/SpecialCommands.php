<?php

namespace App;

use App\Alternative_name;
use App\ChatbotResponse;
use App\Commands;
use App\Synonyms;
use Illuminate\Http\Request;

class SpecialCommands {

	public function addSynonym($UserInput, $request) {

		if (!empty($request['name']) && !empty($request['alternativename'])) {
			
			$alternative_name = New Alternative_name;
	
			$alternative_name->name = $request['name'];
			$alternative_name->alternative_name = $request['alternativename'];
			
			try {
				$result = $alternative_name->save();
			}
			
			catch (\Illuminate\Database\QueryException $e)
			{
			    $result = 0;
			}
	
    		if ($result == 1) {
    			$command = [];
    			$command['text'] = "Synoniem is succesvol toegevoegd.";
    		} else {
    			$command['text'] = "Let op! Record is niet succesvol toegevoegd. Waarschijnlijk bestaat het woord al.";
    		}

    	} else {
    			$command['text'] = "Let op! Record is niet succesvol toegevoegd. Vul zowel een naam als een alternatieve naam (synoniem) in.";

    	}
    	
    	return $command;
	}	

	//add group member
	public function addgm($UserInput, $request) {
		$result = $this->add($UserInput, $request);

		return $result;
	}

	//either its a group member and part of group should be filled, then variable is optional
	//or it is a variable and then part of group is optional
	public function areRequiredFieldsFilled($request) {
		if ( !empty($request['variable']) && empty($request['part_of_group'])) {
			return true;
		}		

		if ( empty($request['variable']) && !empty($request['part_of_group'])) {
			return true;
		}
		
		return false;
	}

	public function add($UserInput, $request) {

		if ($this->areRequiredFieldsFilled($request)) {
			
			$Command = New Commands;
	
			$Command->variable = $request['variable'];
			if (empty($request['variable'])) {
				$Command->word = $request['word'];
			} else {
				$Command->word = $request['variable'];
			}
			$Command->type = $request['type'];
			$Command->group_name = $request['group_name'];
			$Command->part_of_group = $request['part_of_group'];
			$Command->description = $request['description'];
			$Command->text = $request['text'];
			$Command->created_by = '';
			$Command->modified_by = '';
			
			try {
				$result = $Command->save();
			}
			
			catch (\Illuminate\Database\QueryException $e)
			{
			    $result['text'] = $e;
			}
	
			//woord toevoegen aan synoniemenlijst
    		if ($result == 1) {
    			$result = [];
    			if (!empty($result['variable'])) {
    				$result['text'] = "Command is succesvol toegevoegd.";
    				
    				$request = [];
    				$request["name"] = $Command->variable;
    				$request["alternativename"] = $Command->variable;
	
    				$resultOfAddingSynonym = $this->addSynonym($result, $request);
	
    				$result['text'] .= "<br><br>".$resultOfAddingSynonym['text'];
				} else {
					$result['text'] = "Group member is succesvol opgeslagen, er wordt geen keyword aangemaakt.";
				}

    		} 

    	} else {
    		$result['text'] = "Let op! Record is niet succesvol toegevoegd. Alleen bij een group member hoeft geen variable ingevuld te worden.";

    	}
    	
    	return $result;
	}

	public function showCommands() {
		$newCommand = new Commands;

		$command = [];
		
		$allCommands = $newCommand->bulmaTableWithAllCommands();

		$command['text'] = $allCommands;

		return $command;
	}	

	public function showSynonyms($UserInput, $request) {

		$synonym = new Synonyms;

		$command = [];
		
		$allCommands = $synonym->bulmaTableWithAllSynonyms();

		$command['text'] = $allCommands;

		return $command;
	}	

	public function show($UserInput) {
		//$this->printer($UserInput, "UserInput");

		$capitalizedFunction = ucfirst( $UserInput[1]['cleaned'] );
		$functionName = "show".$capitalizedFunction;
		
		if ( !method_exists($this, $functionName) ) {
			$command['text'] = "Hey! ".$UserInput[1]['cleaned']." is NOT a word that can be used in this combination!";

		} else {
			$command = $this->{"show".$capitalizedFunction}();
		}

		return $command;
	}

	public function printer($multipleInput, $title = null) {
    	if ($title) {
    		echo "<br>".$title.": ";
    	}

    	if (gettype($multipleInput) == "array") {
    		echo "<pre>";
    		print_r($multipleInput);
    		echo "</pre>";
    	} else {
    		echo "<br>".$multipleInput;
    	}
    }

}