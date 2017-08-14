<?php

namespace App;

class BulmaTableSpitter {
	public $title = null;
	public $subtitle = null;

	public $aHeaders = [];
	public $aBody = [];
	public $aFooters = [];

	public $header = null;
	public $body = null;
	public $footer = null;

	public $fullTable = null;

	public $class = null;
	public $id = null;
	public $options = [
		'header' => true,
		'footer' => false,
	];
	public $error = null;

	public function checkForErrors() {
		//body set?
		if (!$this->body) {
			$this->error = 'No body set. Use setBody to give some content';
		}
	}

	public function contructTable() {
		$table = '';

		//check for stupid errors
		$this->checkForErrors();

		if ($this->error) {
			return;
		}

		//title
		if ($this->title) {
			$table .= '<p class="title is-4">'.$this->title.'</p>';
		}		

		//subtitle
		if ($this->subtitle) {
			$table .= '<p class="subtitle is-5">'.$this->subtitle.'</p>';
		}		

		//setting up the table with optional class and id
		$table .= '<table ';
		if ($this->id) { 
			$table .= 'id="'.$this->id.'" ';
		}
		$table .= 'class="table';
		if ($this->class) { 
			$table .= ' '.$this->class;
		}		
		$table .= '">';

		//header
		if ($this->header) {
			$table .= $this->header;
		}		

		//body
		if ($this->body) {
			$table .= $this->body;
		}		

		//footer
		if ($this->footer) {
			$table .= $this->footer;
		}

		//closing the table
		$table .= '</table>';

		$this->fullTable = $table;
	}

    public function setHeader($headers) {
    	$this->headers = $headers;

        $this->header = '<thead><tr>';
        
        foreach ($headers as $header) {
        	$this->header .= '<th>'.$header.'</th>';
        }

        $this->header .= '</tr></thead>';
    }        

    public function setBody($body) {
        if (!$this->headers) {
        	$this->error = "Select which headers you want to add";
        
        	return;
        }

        $this->body = '<tbody>';
        
        foreach ($body as $row) {
        	$this->header .= '<tr>';

        	foreach ($this->headers as $tableRowName => $header) {
        		$this->header .= '<td>'.$row[$tableRowName].'</td>';
        	}

        	$this->header .= '</tr>';
        }

        $this->header .= '</tbody>';
    }    

    public function setFooter($footers) {
        $this->footer = '<tfoot><tr>';
        
        foreach ($footers as $footer) {
        	$this->footer .= '<th>'.$footer.'</th>';
        }

        $this->footer .= '</tr></tfoot>';
    }

}