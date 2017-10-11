<?php

/**
 * \file      DossierParcours.php
 * \author    Guillaume Pochet
 * \version   1.0
 * \date      09 Mars 2017
 * \brief     Controller d'affichage d'un dossier parcours
 *            
 *
 * \details   Contient les différentes méthodes de gestion Controller d'affichage d'un dossier parcours
 *            (Dossier parcours = remarques sur une activité d'un patient)
 */
class DossierParcours extends CI_Controller {

    function __construct() {
        parent::__construct();
        if ($this->session->userdata("username") === null)
            redirect('/Auth', 'refresh');
        if ($this->session->userdata("level") === "1")
            redirect('/AffichageSejour', 'refresh');
    }

    public function index() {
        
    }

    /**
     * \brief      Permet d'afficher un dossier parcours 
     * \details    La méthode permet de charger le dossier du patient avec identifiant en paramètre
     * \param      $idPatient :  identifiant du patient
     */
    public function dossier($idPatient) {
        $this->load->model('M_DossierParcours');
        $this->load->model('M_Champ');
        $data = array();
        //	On lance une requête
        $data['dossierParcours'] = $this->M_DossierParcours->getDossierByIdPatient($idPatient, -1, -1);
        $data['typeChamp'] = $this->M_Champ->getAllTypeChamp();
        //var_dump($data);
        $data['chemin'] = '/dossierParcours/V_DossierParcours';

        $this->load->view('/V_generale', $data);
    }

    /**
     * \brief      Permet d'afficher les différentes onglet d'un dossier parcours
     * \details    La méthode permet de charger les différentes onglets d'un dossier parcours du patient avec identifiant en paramètre
     * \param      Aucun
     */
    public function loadOngletAndDossier() {
        if (isset($_POST['idOnglet']) && isset($_POST['idDossierParcours']) && isset($_POST['idPatient'])) {
            $this->load->model('M_DossierParcours');
            $data = array();
            $data['dossierParcours'] = $this->M_DossierParcours->getDossierByIdPatient($_POST['idPatient'], $_POST['idOnglet'], $_POST['idDossierParcours']);
            echo json_encode($this->load->view('/dossierParcours/Div_DossierParcours', $data, TRUE));
        }
    }

    /**
     * \brief      Permet de modifier un dossier parcours
     * \details    La méthode permet de modifier un dossier parcours d'un patient
     * \param      Aucun
     */
    public function modifierValeurs() {
        $data = array();
        $res = array();
        $this->load->model('M_DossierParcours');
        $resUpdate = $this->M_DossierParcours->majDossierByIdPatient($_POST['idOnglet'], $_POST['idDossierParcours'], $_POST['inputInDossier']);
        $data['dossierParcours'] = $this->M_DossierParcours->getDossierByIdPatient($_POST['idPatient'], $_POST['idOnglet'], $_POST['idDossierParcours']);
        $res['divAlert'] = $this->load->view('/dossierParcours/Div_AlertDossierParcours', $resUpdate, TRUE);
        $res['divAffichage'] = $this->load->view('/dossierParcours/Div_DossierParcours', $data, TRUE);
        echo json_encode($res);
    }

    /**
     * \brief      Permet de récuperer la liste des champs lié à chaque onglet
     * \details    La méthode permet de récuperer la liste des champs lié à chaque onglet
     * \param      Aucun
     */
    public function getChamp() {
        if (isset($_GET['term'])) {
            $q = $_GET['term'];
            $this->load->model('M_Champ');
            $suggestions = $this->M_Champ->getAllChampWith($q);
            echo json_encode($suggestions);
        }
    }

    /**
     * \brief      Permet d'ajouter un nouveau champ à un dossier parcours
     * \details    La méthode permet d'ajouter un nouveau champ à un dossier parcours
     * \param      Aucun
     */
    public function ajoutChampDossier() {
        $idOnglet = $_POST["idOnglet"];
        $idDossierParcours = $_POST["idDossierParcours"];
        $idChamp = $_POST["idChamp"];
        $idTypeChamp = $_POST["idTypeChamp"];
        $nomChamp = $_POST["nomChamp"];

        if ($idChamp < 0) {
            $this->load->model('M_Champ');
            $idChamp = $this->M_Champ->addNewChamp($idTypeChamp, $nomChamp);
        }
        $this->load->model('M_DossierParcours');
        $this->M_DossierParcours->addChampAtDossier($idOnglet, $idDossierParcours, $idChamp);
        echo json_encode("ok");
    }

}

?>