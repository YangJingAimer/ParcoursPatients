<?php

/**
 * \file      Ressource.php
 * \author    Guillaume Pochet
 * \version   1.0
 * \date      09 Mars 2017
 * \brief     Controller d'une ressource humaine ou matérielles
 *            
 *
 * \details   Contient les différentes méthodes de gestion du personnels et des matériaux (salles, objets, etc)
 */
class Ressource extends CI_Controller {

    function __construct() {
        parent::__construct();
        if ($this->session->userdata("username") === null)
            redirect('/Auth', 'refresh');
        if ($this->session->userdata("level") === "1")
            redirect('/AffichageSejour', 'refresh');
    }

    /**
     * \brief      Permet d'afficher toutes les ressources humaines et matérielles
     * \details    Méthode permettant la liaison entre la vue ressource et le modèle ressource
     *             Récupére toutes les ressources et les envoie à la vue qui se charge de les afficher
     * \param      Aucun
     */
    public function index() {

        $data = array();
        $data['chemin'] = '/ressource/ressource';
        $this->load->view('/V_generale', $data);
    }

    /**
     * \brief      Permet d'ajouter une ressource 
     * \details    Fonction permettant d'afficher la vue d'ajout d'une nouvelle ressource (humaine ou matérielle)
     * \param      Aucun
     */
    public function ajout() {

        $data = array();
        $data['chemin'] = '/ressource/formAjout';

        $this->load->view('/V_generale', $data);
    }

    /**
     * \brief      Permet d'afficher le planning d'une ressource 
     * \details    Affichage de l'emploi du temps d'une ressource
     * \param      $id : identifiant de la ressource
      $week : entier relatif égal à la différence de semaine entre la semaine actuelle et celle qu'on veut visualiser (exemple : semaine précédente = -1)
     */
    public function solo($id = 0, $week = 0) {
        // Le personnel médical n'a pas accès aux autres emplois du temps
        if ($this->session->userdata("level") === "2")
            $id = $this->session->userdata("id_individu");

        $this->load->model('M_Ressource');
        $data = array();
        $data['chemin'] = '/ressource/ressourceSolo';
        if (intval($id) != 0) {
            $data['id'] = intval($id);
            $data['week'] = intval($week);

            $data['activity'] = $this->M_Ressource->getWeekByIdRessource($data['id'], date("Y-m-d", strtotime("last Monday", strtotime($data['week'] . ' weeks'))));
            $data['nom_res'] = $this->M_Ressource->getNameByIdRessource($data['id']);
            $this->load->view('/V_generale', $data);
        } else {
            $data["heading"] = "Erreur";
            $data["message"] = "L'identifiant de la ressource n'est pas reconnu.";

            $this->load->view('/errors/html/error_general', $data);
        }
    }

}

?>