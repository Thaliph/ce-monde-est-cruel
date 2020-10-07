<?php

namespace Hackathon\PlayerIA;

use Hackathon\Game\Result;

/**
 * Class ScarifPlayers
 * @package Hackathon\PlayerIA
 * @author Alexis Merle
 */

/**
*    Description
*
*    On va commencer par scissors car on commence par pierre en general
*    on va calculer les pourcentages d'utilisation des 3 actions
*    Dans le cas ou il y a une predominance > alpha on joue le counter
*    Dans le cas ou on est defavorable < alpha on considere que l'adversaire predis les mouvements
*    et donc on va jouer contre nous meme, contre un algo qui predit les couts
* */

class ScarifPlayer extends Player
{
    protected $mySide;
    protected $opponentSide;
    protected $result;

    public function getChoice()
    {
        $alpha = 0.55;
        $foe_stats = $this->result->getStatsFor($this->opponentSide);
        $my_stats = $this->result->getStats();
        $round_number = $this->result->getNbRound();

        if ($foe_stats['score'] === 0){
            $my_play  = parent::paperChoice();
        } else {
            $rock = $foe_stats['rock'] / $round_number;
            $paper = $foe_stats['paper'] / $round_number;
            $scissor = $foe_stats['scissors'] / $round_number;
            if ($scissor > $alpha || $paper > $alpha || $rock > $alpha){
                if ($rock > $paper && $rock > $scissor) {
                    $my_play = parent::paperChoice();
                } elseif ($paper > $rock && $paper > $scissor){
                    $my_play = parent::scissorsChoice();
                } else {
                    $my_play = parent::rockChoice();
                }
            } else {
                $my_rock = $my_stats[$this->mySide]['rock'] / $round_number;
                $my_paper = $my_stats[$this->mySide]['paper'] / $round_number;
                $my_scissor = $my_stats[$this->mySide]['scissors'] / $round_number;
                if ($my_rock > $my_paper && $my_rock > $my_scissor) {
                    $my_play = parent::scissorsChoice();
                } elseif ($my_paper > $my_rock && $my_paper > $my_scissor){
                    $my_play = parent::paperChoice();
                } else {
                    $my_play = parent::rockChoice();
                }
            }
        }

        return $my_play;

    }
};
