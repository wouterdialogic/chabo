<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\BulmaTableSpitter;

class Commands extends Model
{
    //column => readable name
    public $tableColumns = [
    	"id" => "Id",
    	"variable" => "Variable",
    	"description" => "Description",
    ];

	public function bulmaTableWithAllCommands() {
		$commands = $this->where('variable', '!=', null)->get();

		$bulmaTable = new BulmaTableSpitter;

		$bulmaTable->title = "All commands";
		$bulmaTable->subtitle = "If you want more information, type help!";

		$bulmaTable->setHeader($this->tableColumns);
		
		$bulmaTable->setBody($commands);

		$bulmaTable->contructTable();
		return $bulmaTable->fullTable;
	}

    public function getAllCommands() {
    	$commands = $this->all();	
    
    	$start = '
    	<table class="table">
    	   	<thead>
    			<tr>
    				<th>Id</th>
    				<th>Command</th>
    				<th>Description</th>
    			</tr>
  			</thead>
  			<tbody>
		';

 		$middle = '';
    	foreach ($commands as $index => $command) {
    		$middle .= '<tr>';
    		$middle .= '<td>'.$command->id.'</td>';
    		$middle .= '<td>'.$command->variable.'</td>';
    		$middle .= '<td>'.$command->description.'</td>';
    		$middle .= '</<tr>';
    	}
    
    	$end = "</tbody></div>";
    	return $start . $middle . $end;
    }
}
