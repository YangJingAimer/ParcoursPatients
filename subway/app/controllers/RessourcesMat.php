<?php

/**
 * \file      RessourceMat.php
 * \author    Guillaume Pochet
 * \version   1.0
 * \date      09 Mars 2017
 * \brief     Controller d'une ressource humaines
 *            
 *
 * \details   Contient les différentes méthodes de gestion des ressources matérielles
 */
class RessourcesMat extends CI_Controller {

    function __construct() {
        parent::__construct();
        if ($this->session->userdata("username") === null)
            redirect('/Auth', 'refresh');
        if ($this->session->userdata("level") === "1")
            redirect('/AffichageSejour', 'refresh');
    }

    /**
     * \brief      Permet d'afficher toutes les ressources matérielles
     * \details    Méthode permettant la liaison entre la vue des ressources matérielles et le modèle ressourceMat
     *             Récupére toutes les ressources matérielles et les envoie à la vue qui se charge de les afficher
     * \param      Aucun
     */
    public function index() {
        $this->load->model('M_RessourcesMat');
        $data = array();
        //	On lance une requête
        $data['ressources'] = $this->M_RessourcesMat->getAllRessourcesMat();

        $data['chemin'] = '/ressource/V_ressources';

        $this->load->view('/V_generale', $data);
    }

    /**
     * \brief      Permet d'ajouter une ressource matérielles 
     * \details    Fonction permettant d'afficher la vue d'ajout d'une nouvelle ressource matérielle
     * \param      Aucun
     */
    public function ajout() {
        $data['chemin'] = '/ressource/v_addRessource';
        $data['id'] = -1;
        $data['nom'] = '';
        $data['type'] = '';
        $data['idType'] = -1;
        $data['idRessource'] = -1;

        $this->load->view('/V_generale', $data);
    }

    /**
     * \brief      Permet d'afficher la vue de modification de la ressource matérielles
     * \details    Permet d'afficher la vue de modification d'une personne avec les informations de la ressource matériellese
     * \param      $id : identifiant de la ressource matérielles à modifier
     */
    public function modif($id) {
        $this->load->model('M_RessourcesMat');
        $data['chemin'] = '/ressource/v_addRessource';
        $ressource = $this->M_RessourcesMat->getRessourcesMatById($id);
        $data['id'] = $id;
        $data['nom'] = $ressource['txt_nom'];
        $data['type'] = $ressource['Type_nom'];
        $data['idType'] = $ressource['id_type'];
        $data['idRessource'] = $ressource['id_ressource'];

        $this->load->view('/V_generale', $data);
    }

    /**
     * \brief      Permet d'ajouter ou de modifier une ressource matérielle
     * \details    Permet d'ajouter ou de modifier une ressource matérielle
     *             Récupére la liste des informations une ressource matérielle (ajout ou modification) et les ajoute en base de données
     * \param      Aucun
     */
    public function confirmModif() {
        $this->load->model('M_RessourcesMat');
        $ressource = array();
        $ressource['nom'] = $_POST['nom'];
        $ressource['type'] = $_POST['type'];
        $ressource['id'] = $_POST['id'];
        $ressource['idType'] = $_POST['idType'];
        $ressource['idRessource'] = $_POST['idRessource'];

        if ($ressource['id'] == -1) {
            $this->M_RessourcesMat->ajouteRessourcesMat($ressource);
        } else {
            $this->M_RessourcesMat->ModifRessourcesMat($ressource);
        }

        $this->index();
    }
    /**
     * \brief      Permet de supprimer uune ressource matérielle
     * \details    Fonction permettant la suppression d'une ressource matérielle en fonction de son id
     * \param      $id : id de la ressource matérielle à supprimer
     */
    public function suppr($id) {
        $this->load->model('M_RessourcesMat');
        $this->M_RessourcesMat->supprRessourcesMat($id);

        $this->index();
    }
    /**
     * \brief      Permet de récupérer la liste de tout les type matérielles présents dans la base de données
     * \details    Permet de récupérer la liste de tout les type matérielles présents dans la base de données
     *             Retourne tout les types au format JSON
     * \param      Aucun
     */
    public function getTypes() {
        if (isset($_GET["term"])) {
            $this->load->model('M_TypeRessource');
            echo json_encode($this->M_TypeRessource->getTypesRessourcesMat(strtolower($_GET["term"])));
        }
    }
}

?>