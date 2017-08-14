<?php

namespace App;

use Stringy\Stringy as S;

class UserInput {
	public $originalInput = null;
	public $cleanedUserInput = null;
	public $separatedCleanedUserInput = null;

	public $userInput = [];
	//separatedParts = [
	// "text1" => [
	// 		"original" => ""
	// 		"cleaned" => ""
	// 		"command" => {}
	// 	]
	// "text2" => []
	//]

	public function processUserInput($request) {
		$this->originalInput = $request["message"];
	
    	$this->separatedCleanedUserInput = $this->splitSentenceBetweenColons($this->originalInput);

    	foreach ($this->separatedCleanedUserInput as $index => &$part) {
    		$this->userInput[$index]['original'] = $part;
    		$this->userInput[$index]['cleaned'] = $this->cleanUserInput($part);
    	}

    	return $this->userInput;
	}

	public function splitSentenceBetweenColons($input) {
		$separateParts = explode(":", $input);

		return $separateParts;
	}

    public function cleanUserInput($userInput) {
    	$stringy = S::create($userInput); // 'fòôbàř'
    	$stringy = $stringy->toLowerCase();
    	$stringy = $stringy->toAscii();

    	return $stringy;
    }

}
