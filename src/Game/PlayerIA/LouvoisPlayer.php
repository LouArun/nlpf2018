<?php

namespace Hackathon\PlayerIA;
use Hackathon\Game\Result;

/**
 * Class LouvoisPlayer
 * @package Hackathon\PlayerIA
 * @author Robin
 *
 */
class LouvoisPlayer extends Player
{
    protected $mySide;
    protected $opponentSide;
    protected $result;

    public function getChoice()
    {
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Choice           ?    $this->result->getLastChoiceFor($this->mySide) -- if 0 (first round)
        // How to get the opponent Last Choice ?    $this->result->getLastChoiceFor($this->opponentSide) -- if 0 (first round)
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Score            ?    $this->result->getLastScoreFor($this->mySide) -- if 0 (first round)
        // How to get the opponent Last Score  ?    $this->result->getLastScoreFor($this->opponentSide) -- if 0 (first round)
        // -------------------------------------    -----------------------------------------------------
        // How to get all the Choices          ?    $this->result->getChoicesFor($this->mySide)
        // How to get the opponent Last Choice ?    $this->result->getChoicesFor($this->opponentSide)
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Score            ?    $this->result->getLastScoreFor($this->mySide)
        // How to get the opponent Last Score  ?    $this->result->getLastScoreFor($this->opponentSide)
        // -------------------------------------    -----------------------------------------------------
        // How to get the stats                ?    $this->result->getStats()
        // How to get the stats for me         ?    $this->result->getStatsFor($this->mySide)
        //          array('name' => value, 'score' => value, 'friend' => value, 'foe' => value
        // How to get the stats for the oppo   ?    $this->result->getStatsFor($this->opponentSide)
        //          array('name' => value, 'score' => value, 'friend' => value, 'foe' => value
        // -------------------------------------    -----------------------------------------------------
        // How to get the number of round      ?    $this->result->getNbRound()
        // -------------------------------------    -----------------------------------------------------
        // How can i display the result of each round ? $this->prettyDisplay()
        // -------------------------------------    -----------------------------------------------------

        /*if ($this->result->getLastChoiceFor($this->opponentSide) === 'scissors')
        {
            return $rockchoice;
        }
        else if ($this->result->getLastChoiceFor($this->opponentSide) === 'paper')
        {
            return $scissorschoice;
        }
        else
        {
            return $paperchoice;
        }*/

        $choices[0] = parent::rockChoice();
        $choices[1] = parent::scissorsChoice();
        $choices[2] = parent::paperChoice();
        $opponentchoices = $this->result->getChoicesFor($this->opponentSide);


        if ($this->result->getNbRound() === 0)
            return $choices[0];
        $pcoef = 0;
        $scoef = 0;
        $rcoef = 0;
        
        if ($this->result->getLastChoiceFor($this->opponentSide) == $choices[1]
        && $this->result->getLastChoiceFor($this->mySide) == $choices[2])
            return $choices[0];
        else if ($this->result->getLastChoiceFor($this->opponentSide) == $choices[2]
        && $this->result->getLastChoiceFor($this->mySide) == $choices[0])
            return $choices[1];
        else if ($this->result->getLastChoiceFor($this->opponentSide) == $choices[2]
        && $this->result->getLastChoiceFor($this->mySide) == $choices[0])
            return $choices[2];

        foreach ($opponentchoices as $value) {
            if ($value === $choices[2])
                $pcoef++;
            if ($value === $choices[0])
                $rcoef++;
            if ($value === $choices[1])
                $scoef++;
        }

        if ($scoef == $rcoef && $scoef == $pcoef)
        {
            if ($this->result->getLastChoiceFor($this->opponentSide) == $choices[0])
                return $choices[2];
            return $choices[0];
        }
        if ($scoef == $rcoef && $scoef == $pcoef)
        {
            if ($this->result->getLastChoiceFor($this->opponentSide) == $choices[1])
                return $choices[0];
            return $choices[1];
        }
        if ($pcoef == $rcoef && $pcoef == $scoef)
        {  
            if ($this->result->getLastChoiceFor($this->opponentSide) == $choices[2])
                return $choices[1];
            return $choices[2];
        }
        return $choices[0];
/*
        if ($this->result->getLastChoiceFor($this->opponentSide) === 'scissors')
        {
            return $rockchoice;
        }
        else if ($this->result->getLastChoiceFor($this->opponentSide) === 'paper')
        {
            return $scissorschoice;
        }
        else
        {
            return $paperchoice;
        }*/
    }
};