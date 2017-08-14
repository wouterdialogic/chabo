<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\BulmaTableSpitter;

class Synonyms extends Model
{

    protected $table = 'alternative_names';

    //column => readable name
    public $tableColumns = [
    	"id" => "Id",
    	"name" => "Name",
    	"alternative_name" => "Synonym",
    ];

	public function bulmaTableWithAllSynonyms() {
		$commands = $this->all();	

		$bulmaTable = new BulmaTableSpitter;

		$bulmaTable->title = "All synonyms";
		$bulmaTable->subtitle = "If you want more information, type help!";

		$bulmaTable->setHeader($this->tableColumns);
		
		$bulmaTable->setBody($commands);

		$bulmaTable->contructTable();
		return $bulmaTable->fullTable;
	}

}
