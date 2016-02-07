<?php


// SLU output example
// to find a movie by an actor
//now lets see confidence 
$input = array("EAT" => "list", "object" => "movie",  "language" => "English","asrconf" => "90.9" ,
    "uttconf"=>"90.1", "conconf"=>"92.0", "concepts"=> array('actor.name'=>'Emma Stone'), "items" => array(array('name' => 'pluto'),
        array('name' => 'topolino')));/*
// to find movies by director name 
$input = array("EAT" => "list", "object" => "movie",  "language" => "English","asrconf" => "90.9" ,
    "uttconf"=>"90.1", "conconf"=>"92.0", "concepts"=> array('director.name'=>'James Cameron'), "items" => array(array('name' => 'pluto'),
        array('name' => 'topolino')));
//to find movies by producer name 
$input = array("EAT" => "list", "object" => "movie",  "language" => "English","asrconf" => "90.9" ,
    "uttconf"=>"90.1", "conconf"=>"92.0", "concepts"=> array('producer.name'=>'jon landau'), "items" => array(array('name' => 'pluto'),
        array('name' => 'topolino')));*/
// the class is actor now and searchin it by movie name
/*$input = array("EAT" => "list", "object" => "actor",  "language" => "English","asrconf" => "90.9" ,
    "uttconf"=>"90.1", "conconf"=>"92.0", "concepts"=> array('movie.name'=>'Harry Potter'), "items" => array(array('name' => 'pluto'),
        array('name' => 'topolino')));*/
// to get an actor by movie name and character name
//$input = array("EAT" => "list", "object" => "actor",  "language" => "English","asrconf" => "90.9" ,
//    "uttconf"=>"90.1", "conconf"=>"92.0", "concepts"=> array('movie.name'=>'Harry Potter','character.name'=>'Thor'), "items" => array(array('name' => 'pluto'),
//        array('name' => 'topolino')));
/*$input = array("EAT" => "list", "object" => "movie",  "language" => "English","asrconf" => "90.9" ,
    "uttconf"=>"90.1", "conconf"=>"92.0", "concepts"=> array('movie.name'=>'Titanic'), "items" => array(array('name' => 'pluto'),
        array('name' => 'topolino')));*/
// to get movie trailer by the name of the movie
/*$input = array("EAT" => "list", "object" => "trailer",  "language" => "English","asrconf" => "90.9" ,
    "uttconf"=>"90.1", "conconf"=>"92.0", "concepts"=> array('movie.name'=>'Titanic'), "items" => array(array('name' => 'pluto'),
        array('name' => 'topolino')));*/
//$input = array("EAT" => "list", "object" => "review",  "language" => "English","asrconf" => "90.9" ,
//    "uttconf"=>"90.1", "conconf"=>"92.0", "concepts"=> array('movie.name'=>'Titanic'), "items" => array(array('name' => 'pluto'),
//        array('name' => 'topolino')));
//*****************
//this one is to find awards for a movie based on title this also uses imdb data source
//$input = array("EAT" => "list", "object" => "awards",  "language" => "English","asrconf" => "90.9" ,
//    "uttconf"=>"90.1", "conconf"=>"92.0", "concepts"=> array('movie.name'=>'avatar'), "items" => array(array('name' => 'pluto'),
//        array('name' => 'topolino')));
//this is to find imdb rating for amovie based on the title of the movie 
//this is from the imdb data source
//$input = array("EAT" => "list", "object" => "imdb.rating",  "language" => "English","asrconf" => "90.9" ,
//    "uttconf"=>"90.1", "conconf"=>"92.0", "concepts"=> array('movie.name'=>'avatar'), "items" => array(array('name' => 'pluto'),
//        array('name' => 'topolino')));/*
//$input = array("EAT" => "list", "object" => "movie.count",  "language" => "English","asrconf" => "90.9" ,
//    "uttconf"=>"90.1", "conconf"=>"92.0", "concepts"=> array('actor.name'=>'Emma Stone'), "items" => array(array('name' => 'pluto'),
//        array('name' => 'topolino')));
//$input = array("EAT" => "list", "object" => "character",  "language" => "English","asrconf" => "90.9" ,
//    "uttconf"=>"90.1", "conconf"=>"92.0", "concepts"=> array('movie.name'=>'Titanic'), "items" => array(array('name' => 'pluto'),
//        array('name' => 'topolino')));
/*
$input = array("EAT" => "list", "object" => "character",  "language" => "English","asrconf" => "90.9" ,
    "uttconf"=>"90.1", "conconf"=>"92.0", "concepts"=> array('movie.name'=>'Thor','actor.name'=>'Thor'), "items" => array(array('name' => 'pluto'),
        array('name' => 'topolino')));
$input = array("EAT" => "list", "object" => "director",  "language" => "English","asrconf" => "90.9" ,
    "uttconf"=>"90.1", "conconf"=>"92.0", "concepts"=> array('movie.name'=>'Titanic'), "items" => array(array('name' => 'pluto'),
        array('name' => 'topolino')));*/
// concepts for a character
//$class     = 'character';
// = array('actor.name'=>'Thor','movie.name'=>'Thor');

//$inputt = $_POST["input"];
//$inputt = trim($inputt,'"');
//eval("\$input= \"$inputt\";");
//echo "$input";
// include main functions and objects
include_once('./functions.php');
include_once('./DialogManager.class.php');

// get previous state of the DialogManager
$has_state = DialogManager::restoreState('mystate');

// get the instance of the DialogManager
$dm = DialogManager::getInstance();

// if the previous state cannot be loaded, I set the concepts from SLU
if (!$has_state) {
	$dm->setInput($input);
}
else if($has_state)
{
    echo "state in use";
}
// set the filename of the conditions to verify
$dm->setConditionsFilename('conditions/conditions.xml');

//run confidence checker
$isConfident = $dm->checkConfidence();
// run the DialogManager and get the result
if($isConfident === true)
{
$myresult = $dm->run();

echo 'PROMPT: '.$myresult;
$arr = $dm->getResults();

 $var = $arr['head']['vars'][0]; // if 1
 
foreach ($arr['results']['bindings'] as $e) {
echo "<p>".$e[$var]['value'] . "\n</p>";
}
//echo $arr;    
}

else
    echo $isConfident;