<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 04/04/2019
 * Time: 08:42
 */

class Tournament_Model {
    private $tournament_id;
    private $name;
    private $nb_teams;

    public function __construct(array $tournament = null) {
        if($tournament != null) {
            $this->hydrate($tournament);
        }
    }

    function hydrate(array $tournament) {
        if(isset($tournament['tournament_id'])) {
            $this->setTournamentId($tournament['tournament_id']);
        }

        if(isset($tournament['name'])) {
            $this->setName($tournament['name']);
        }

        if(isset($tournament['nb_teams'])) {
            $this->setNbTeams($tournament['nb_teams']);
        }
    }

    public function setTournamentId($tournament_id) { $this->tournament_id = $tournament_id; }
    public function setName($name) { $this->name = $name; }
    public function setNbTeams($nb_teams) { $this->nb_teams = $nb_teams; }

    /**
     * @return mixed
     */
    public function getTournamentId()
    {
        return $this->tournament_id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getNbTeams()
    {
        return $this->nb_teams;
    }


}