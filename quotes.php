<?php
session_start();


interface startInterface {

	public function getRandomNumber(array $quote);
	public function getAllQuotes();
}


class Quotes implements startInterface  {


	/*
	* Function starts all and gives random Quote from array
	* @returns array
	*/
	public function start() : array {


		$quote = self::getAllQuotes();
		
		$rand_num = self::getRandomNumber($quote);

		if(!isset($_SESSION['numbers'])) {
			$_SESSION['numbers'][$rand_num] = $rand_num;
		}
		$search_array = $_SESSION['numbers'];
		$broj_quote = count($quote);

		$z = 0;
		for ($i=0; $i < $broj_quote; $i++) {

			if(array_key_exists($rand_num, $search_array)) {

				$z++;
				$rand_num = self::getRandomNumber($quote);
				continue;
			
			} else {

				$_SESSION['numbers'][$rand_num] = $rand_num;
				break;
				
			}
		}
		if($z == $broj_quote) {
			return $selected = [];
		}

		return $selected = self::getAllQuotes()[$rand_num];

	}



	/*
	* Function returns random number based on 'getAllQuotes'
	* @returns int
	*/
	public function getRandomNumber(array $quote) : int {

		return array_rand($quote, 1);
	} 

	/*
	* Function returns list of available quotes
	* @returns array
	**/
	public function getAllQuotes() : array {
		return [
			'1' => [	
				'quote' => 'Monkeys are superior to men in this: when a monkey looks into a mirror, he sees a monkey.',
				'author' => 'Malcolm de Chazal'
			],
			'2' => [
				'quote' => 'They couldn\'t hit an elephant at this dist...',
				'author' => 'Gen. John Sedgwick'
			],
			'3' => [
				'quote' => 'Electronics need smoke to work. Proof: once the smoke comes out of them, they stop working.',
				'author' => 'Anonymous'
			],
			'4' => [
				'quote' => 'Giving up smoking is the easiest thing in the world. I know because I\'ve done it thousands of times.',
				'author' => 'Mark Twain'
			],
			'66' => [
				'quote' => 'I do not know with what weapons World War III will be fought, but World War IV will be fought with sticks and stones.',
				'author' => 'Albert Einstein'
			],
			'42' => [
				'quote' => 'Flying is learning how to throw yourself at the ground and miss.',
				'author' => 'Douglas Adams'
			],
			'8' => [
				'quote' => 'Do not look into laser beam with remaining eye.',
				'author' => 'Anonymous'
			],
			'6' => [
				'quote' => 'Ni jedno ljudsko biće ne može opstati samo, bez zajednice.',
				'author' => 'Dalai Lama'
			],
			'7' => [
				'quote' => 'Bolje živjeti 100 godina kao milijunaš, nego 7 dana u bijedi.',
				'author' => 'Alan Ford'
			],
			'5' => [
				'quote' => "- Have you ever heard of the Emancipation Proclamation?\n- I dont listen to hip-hop.",
				'author' => 'Chef vs General, South Park'
			],		
		];
	}

}



$q = new Quotes;
$selected = $q->start();
if(empty($selected)) {

	echo 0;
} else {

	$json = json_encode($selected);
	echo $json;
	
}


