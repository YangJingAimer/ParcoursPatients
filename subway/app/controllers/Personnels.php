<?php

/**
 * \file      Personnels.php
 * \author    Guillaume Pochet
 * \version   1.0
 * \date      09 Mars 2017
 * \brief     Controller d'une ressource humaines
 *            
 *
 * \details   Contient les différentes méthodes de gestion du personnels
 */
class Personnels extends CI_Controller {

    function __construct() {
        parent::__construct();
        if ($this->session->userdata("username") === null)
            redirect('/Auth', 'refresh');
        if ($this->session->userdata("level") === "1")
            redirect('/AffichageSejour', 'refresh');
    }

    /**
     * \brief      Permet d'afficher toutes les ressources humaines
     * \details    Méthode permettant la liaison entre la vue du personnel et le modèle personnel
     *             Récupére tous le personnel et les envoie à la vue qui se charge de les afficher
     * \param      Aucun
     */
    public function index() {
        $this->load->model('M_Personnel');
        $data = array();
        $data['personnels'] = $this->M_Personnel->getAllPersonnes();

        $data['chemin'] = '/ressource/V_personnels';

        $this->load->view('/V_generale', $data);
    }

    /**
     * \brief      Permet d'ajouter une ressource humaine 
     * \details    Fonction permettant d'afficher la vue d'ajout d'une nouvelle personne
     * \param      Aucun
     */
    public function ajout() {
        $data['chemin'] = '/ressource/v_addPersonnel';
        $data['id'] = -1;
        $data['nom'] = '';
        $data['prenom'] = '';
        $data['type'] = '';

        $data['idRessource'] = -1;
        $data['idType'] = -1;

        $this->load->view('/V_generale', $data);
    }

    /**
     * \brief      Permet d'ajouter ou de modifier une personne
     * \details    Permet d'ajouter ou de modifier une personne
     *             Récupére la liste des informations d'une personne (ajout ou modification) et les ajoute en base de données
     * \param      Aucun
     */
    public function confirmModif() {
        $this->load->model('M_Personnel');
        $personne = array();
        $personne['nom'] = $_POST['nom'];
        $personne['prenom'] = $_POST['prenom'];
        $personne['type'] = $_POST['type'];
        $personne['id'] = $_POST['id'];
        $personne['idType'] = $_POST['idType'];
        $personne['idRessource'] = $_POST['idRessource'];
        if ($personne['id'] == -1) {
            $personne['login'] = $_POST['login'];
            $personne['password'] = $_POST['password'];
            $this->M_Personnel->ajoutePersonne($personne);
        } else {
            $this->M_Personnel->ModifPersonne($personne);
        }

        $this->index();
    }

    /**
     * \brief      Permet d'afficher la vue de modification d'une personne
     * \details    Permet d'afficher la vue de modification d'une personne avec les informations de la personne
     * \param      $id : identifiant de la personne à modifier
     */
    public function modif($id) {
        $this->load->model('M_Personnel');
        $data['chemin'] = '/ressource/v_addPersonnel';
        $data['id'] = $id;
        $personnel = $this->M_Personnel->getPersonneById($id);
        
        $data['nom'] = $personnel['txt_nom'];
        $data['prenom'] = $personnel['txt_prenom'];
        $data['type'] = $personnel['Type_nom'];
        $data['idRessource'] = $personnel['id_ressource'];
        $data['idType'] = $personnel['id_type'];
        
        

        $this->load->view('/V_generale', $data);
    }

    /**
     * \brief      Permet de supprimer une personne
     * \details    Fonction permettant la suppression d'une personne en fonction de son id
     * \param      $id : id de la personne à supprimer
     */
    public function suppr($id) {
        $this->load->model('M_Personnel');
        $this->M_Personnel->supprPersonne($id);

        $this->index();
    }

    /**
     * \brief      Permet de récupérer la liste de tout les type personnels présente dans la base de données
     * \details    Permet de récupérer la liste de tout les type personnels présente dans la base de données
     *             Retourne tout les types au format JSON
     * \param      Aucun
     */
    public function getTypes() {
        if (isset($_GET["term"])) {
            $this->load->model('M_TypeRessource');
            echo json_encode($this->M_TypeRessource->getTypesPersonnels(strtolower($_GET["term"])));
        }
    }

}

?>