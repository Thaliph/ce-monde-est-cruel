<?php

namespace Hackathon\PlayerIA;

use Hackathon\Game\Result;

/**
 * Class ScarifPlayers
 * @package Hackathon\PlayerIA
 * @author Alexis Merle
 */
class ScarifPlayer extends Player
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

        $foe_stats = $this->result->getStatsFor($this->opponentSide);
        $my_stats = $this->result->getStats();
        $round_number = $this->result->getNbRound();

        if ($foe_stats['score'] === 0){
            $my_play  = parent::rockChoice();
        } else {
            $rock = $foe_stats['rock'] / $round_number;
            $paper = $foe_stats['paper'] / $round_number;
            $scissor = $foe_stats['scissors'] / $round_number;
            if ($rock > $paper && $rock > $scissor) {
                $my_play = parent::paperChoice();
            } elseif ($paper > $rock && $paper > $scissor){
                $my_play = parent::scissorsChoice();
            } else {
                $my_play = parent::rockChoice();
            }
        }

        return $my_play;

    }
};
