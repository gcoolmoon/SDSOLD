<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FilmTrailer
 *
 * @author gebre
 */
class FilmTrailer {

    /**
    * Private variables for website interaction
    */
    private $movieName;
    private $movieYear;
    private $movieDirector;
    private $page;
    private $embed;
    private $matches;

    /**
    * Fetch movie trailer from YouTube
    *
    * @param $movie Movie Name
    * @param $year Movie Year
    * @return none
    */
    public function __construct($movie, $year=null, $director=null)
    {
        $this->movieName = str_replace(' ', '+', $movie);
        $this->movieYear = $year;
        $this->movieDirector = $director;
        $this->page = file_get_contents('http://www.youtube.com/results?search_query='.$this->movieName.'+'.$this->movieYear.'+'.$this->movieDirector.'+trailer&aq=1&hl=en');
        //$this->page = file_get_contents('http://www.youtube.com/results?search_query='.$this->movieName.'+trailer&aq=1&hl=en');

        if($this->page)
        {
            if(preg_match('~<a .*?href="/watch\?v=(.*?)".*?</div>~s', $this->page, $this->matches))
            {
                $this->embed = '<embed src="http://www.youtube.com/v/'.$this->matches[1].'&autoplay=1&fs=1" type="application/x-shockwave-flash" wmode="transparent" allowfullscreen="true" width="557" height="361"></embed>';
                echo $this->embed;
                //return $this->embed;
            }
        }
        else
        {
            echo "<b>check internet connection.....</b>";
        }
   
}
}
