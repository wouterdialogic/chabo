<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Alternative_name;
use App\Commands;
use App\ChatbotResponse;
use App\UserInput;
use App\SpecialCommands;
use Stringy\Stringy as S;

class Chatbot extends Controller
{
	public $request = null;

	public function executSpecialCommand($command) {
    	$specialCommand = new SpecialCommands;
		$special_function = $command['variable'];
		$result = $specialCommand->$special_function($this->request);

		return $result;
	}

	public function checkForSpecialFunctions($input) {
		if (isset($input["command"])) {
			$command = $input['command'];

    		if ($command["type"] == 'special') {
    			$result = $this->executSpecialCommand($command);
				
			} else {
				$result['text'] = $command['text'];

			}
			
			return $result;
		}
	}

	public function processOneMessage($input) {

		if ($input["command"]) {

			$output = $this->checkForSpecialFunctions($input);

		} else {
			$output['text'] = "Ik kan hier niks mee, type wat anders";
		}

		return $output;
	}

	public function userSendsMessage(Request $request) {

		$this->request = $request;

    	$UserInput = new UserInput;

    	$processedUserInput = $UserInput->processUserInput($request);
    	
    	foreach ($processedUserInput as &$part) {
    		$part['command'] = $this->findBestMatch($part['cleaned']);
    	}

    	//bij 1 bericht kan deze gewoon verwerkt worden:
    	if ( count($processedUserInput) == 1 ) {
    		$output = $this->processOneMessage($processedUserInput[0]);
    	} else {
    		$output['text'] = 'theres more than 1 input, sucker';
    	}

    	return $output;
    }

    public function cleanUserInput($userInput) {
    	$stringy = S::create($userInput); // 'fòôbàř'
    	$stringy = $stringy->toLowerCase();
    	$stringy = $stringy->toAscii();

    	return $stringy;
    }

    public function findBestMatch($userinput) {

    	$alternative_name = Alternative_name::where('alternative_name', $userinput)->first();

    	if ($alternative_name) {
    		$name = $alternative_name->name;

    		$command = Commands::where('variable', $name)->first();
    	} else {
    		$command['text'] = "Not sure what you meant, type help or commands if you`re not sure what to do.";
    		
    		return $command;
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

