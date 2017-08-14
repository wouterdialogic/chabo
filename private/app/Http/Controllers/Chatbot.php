<?php

//doen: keyup and keydown to scroll through given Commands

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Alternative_name;
use App\Commands;
use App\ChatbotResponse;
use App\UserInput;
use App\SpecialCommands;
use App\BulmaTableSpitter;
use Stringy\Stringy as S;

class Chatbot extends Controller
{
	public $request = null;
    public $separateSign = ";";
    public $separateSignForMultipleAnswers = " OR ";

	public function executSpecialCommand($command) {
    	$specialCommand = new SpecialCommands;
		$special_function = $command['variable'];

		$result = $specialCommand->$special_function($this->UserInput, $this->request);

		return $result;
	}

	public function processGroupCommand($command) {
		$result['text'] = $command['variable'].": is een groep. Dit zijn de deelnemers:";
                
        $allCommands = Commands::where('part_of_group', $command['group_name'])->get();

        $bulmaBody = [];
        foreach ($allCommands as $index => $test) {
           $bulmaBody[$index]['Member'] = $test['word'];
           $bulmaBody[$index]['Text'] = $test['text'];
           $bulmaBody[$index]['Edit'] = '<center><a href="\edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></center>';
           $bulmaBody[$index]['Delete'] = '<center><a href="\edit"><i class="fa fa-times" aria-hidden="true"></i></a></center>';

        }

        $bulmaTable = new BulmaTableSpitter;

        $bulmaTable->title = "Group: ".$command['group_name'].": ".$command['description'];
        $bulmaTable->subtitle = $command['text'];

        $bulmaTable->setHeader(["Member" => "Member", "Text" => "Text", "Edit" => "Edit", "Delete" => "Delete"]);
        
        $bulmaTable->setBody($bulmaBody);

        $bulmaTable->contructTable();
        
        $result['text'] = $bulmaTable->fullTable;

        return $result;
	}

	public function checkForSpecialFunctions($input) {

        if ($this->isThereACommand($input)) {
			$command = $input['command'];

            if ($this->isTheCommandAGroup($command)) {
                
            	$result = $this->processGroupCommand($command);

                return $result;
            }

    		if ($this->isTheCommandSpecial($command)) {
    			$result = $this->executSpecialCommand($command);
				
			} else {
				$result['text'] = $command['text'];

			}
			
			return $result;
		}
	}

    //returs true if a part of a user input can be linked to a command 
    public function isThereACommand($input) {
        if ( isset($input["command"]) ) {
            return true;
        }  
    }

    //returns true if a found command is of a special type
    public function isTheCommandSpecial($input) {
        if ($input["type"] == 'special') {
            return true;
        }
    }

    //returns true if a found command is a group
    public function isTheCommandAGroup($input) {
        if ($input["type"] == 'group') {
            return true;
        }
    }

    //pakt een willekeurig element uit een array, afhankelijk van het ingestelde scheidingsteken
    public function pickRandomAnswer($input) {
        $inputArray = explode($this->separateSignForMultipleAnswers, $input);

        return $inputArray[array_rand ( $inputArray , 1 )];
    }

	public function processOneMessage($input) {

		// $this->printer($input);

		if ($this->isThereACommand($input)) {
			$output = $this->checkForSpecialFunctions($input);

		} else {
			$output['text'] = "Ik kan hier niks mee, type wat anders";
		}

		return $output;
	}

    //we gaan er voor nu vanuit dat het eerste bericht een special message is en dat we de overige tekst meegeven aan dit specialcommand
    //mijn idee over hoe te bouwen verandert ook. Niet gelijk: wat is het beste hoe ik deze applicatie kan maken, maar: wat is een kleine verbetering die ik werkend kan maken. In dit geval is het zorgen dat het eerste woord als special type wordt verwerkt en de gebruiker feedback geven wanneer dit niet kan.

    public function processMultipleMessages() {

        //het eerste gedeelte verwerken:
        if ( $this->isThereACommand($this->UserInput[0]) ) {

        	$this->printer($this->UserInput[0]["command"], "command spcial");

            if ( $this->isTheCommandSpecial($this->UserInput[0]["command"]) ) {
            
                $output = $this->checkForSpecialFunctions($this->UserInput[0]);

            } else {
                $output['text'] = "please make sure the first word is a instruction, like add, show, ";
            }
        } else {
            $output['text'] = "no commands given, i do NOTHING!";
        }

        return $output;
    }

	public function userSendsMessage(Request $request) {

		$this->request = $request;

    	$this->UserInput = new UserInput;

    	$this->UserInput = $this->UserInput->processUserInput($request);

    	foreach ($this->UserInput as &$part) {
    		$part['command'] = $this->findBestMatch($part['cleaned']);
    	}

    	//bij 1 bericht kan deze gewoon verwerkt worden:
    	if ( count($this->UserInput) == 1 ) {
    		$output = $this->processOneMessage($this->UserInput[0]);
    	} else {
    		$output = $this->processMultipleMessages();
    	}

        if ($this->areThereMultipleAnswers($output['text'])) {
            $output['text'] = $this->pickRandomAnswer($output['text']);
        }

    	return $output;
    }

    public function areThereMultipleAnswers($input) {
        if (strstr($input, $this->separateSignForMultipleAnswers)) {
            return true;
        }
    }

    public function cleanUserInput($userInput) {
    	$stringy = S::create($userInput); // 'fòôbàř'
    	$stringy = $stringy->toLowerCase();
    	$stringy = $stringy->toAscii();

    	return $stringy;
    }

    //returns object if it finds it, null if nothing
    public function findBestMatch($userinput) {

    	$alternative_name = Alternative_name::where('alternative_name', $userinput)->first();

    	if ($alternative_name) {
    		$name = $alternative_name->name;

    		$command = Commands::where('variable', $name)->first();

            return $command;
    	} 
    	
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

