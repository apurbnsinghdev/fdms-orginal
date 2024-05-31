<?php

namespace App\Traits;

use PhpOffice\PhpSpreadsheet\IOFactory;

trait PhpExcelFormater {

	private function getColNo($colLetters) {
		$limit = 3; //apply max no. of characters
		$colLetters = strtoupper($colLetters); //change to uppercase for easy char to integer conversion
		$strlen = strlen($colLetters); //get length of col string
		if ($strlen > $limit) {
			return "Column too long!";
		}
		//may catch out multibyte chars in first pass
		preg_match("/^[A-Z]+$/", $colLetters, $matches); //check valid chars
		if (!$matches) {
			return "Invalid characters!";
		}
		//should catch any remaining multibyte chars or empty string, numbers, symbols
		$it = 0;
		$vals = 0; //just start off the vars
		for ($i = $strlen - 1; $i > -1; $i--) { //countdown - add values from righthand side
			$vals += (ord($colLetters[$i]) - 64) * pow(26, $it); //cumulate letter value
			$it++; //simple counter
		}
		return $vals; //this is the answer
	}

	private function convertToLavel($string) {
		if (!empty($string)) {
			$parmasString = strtolower($string);
			$parmasString = trim(preg_replace('/[^A-Za-z0-9\-]/', ' ', $parmasString)); // Removes special chars.
			$parmasString = str_replace(' ', '_', $parmasString); // Replaces all spaces with hyphens.
			return preg_replace('/_+/', '_', $parmasString); // Replaces multiple hyphens with single one.
		} else {
			return '';
		}

	}

	//custom function
	public function dumptoarray($filepath, $sheet = 0) {

		$spreadsheet = IOFactory::load($filepath);
		$worksheet = $spreadsheet->getActiveSheet($sheet);
		$rowCount = $worksheet->getHighestRow();
		$columnCount = $this->getColNo($worksheet->getHighestColumn());
		if ($columnCount > 26) {
			return 'column is not greater than 26';
		}
		$alphabetRange = range('A', 'Z');
		//$data = $worksheet->toArray();
		//$spreadsheet->getActiveSheet($sheet)->getCell('B8')->getValue();

		$arr = array();
		$titleArr = array();

		for ($col = 1; $col <= $columnCount; $col++) {
			$titleArr[$col] = $this->convertToLavel($worksheet->getCell($alphabetRange[$col - 1] . '1')->getValue());
		}

		for ($row = 2; $row <= $rowCount; $row++) {
		    for ($col = 1; $col <= $columnCount; $col++) {
		        $arr[$row - 2][$titleArr[$col]] = htmlentities($worksheet->getCell($alphabetRange[$col - 1] . $row)->getFormattedValue());
			}
		}

		return $arr;
	}

}
?>