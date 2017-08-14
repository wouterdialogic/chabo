<?php

namespace App;

use App\Alternative_name;
use App\ChatbotResponse;
use App\Commands;
use App\Synonyms;
use Illuminate\Http\Request;

class SpecialCommands {

	public function addSynonym($request) {
		    if ($request['message'] == "toevoegen:synoniem" && isset($request['name']) && isset($request['alternativename'])) {

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
    			$command['text'] = "Record is succesvol toegevoegd.";
    		} else {
    			$command['text'] = "Let op! Record is niet succesvol toegevoegd. Waarschijnlijk bestaat het woord al.";
    		}

    		return $command;
    	}
	}

	public function showCommands() {
		$newCommand = new Commands;

		$command = [];
		
		$allCommands = $newCommand->bulmaTableWithAllCommands();

		$command['text'] = $allCommands;

		return $command;
	}	

	public function showSynonyms() {
		$synonym = new Synonyms;

		$command = [];
		
		$allCommands = $synonym->bulmaTableWithAllSynonyms();

		$command['text'] = $allCommands;

		return $command;
	}

}