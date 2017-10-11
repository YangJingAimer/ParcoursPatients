<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * \file      M_DossierParcours.php
 * \author    Guillaume Pochet
 * \version   1.0
 * \date      09 Mars 2017
 * \brief     Définit les méthodes liées à la gestion des dossier parcours d'un patient
 *
 * \details   Ce fichier permet de définir les méthodes de gestion des dossiers parcours d'un patient
 *            Cette classe est nécessaire car on souhaite stoker les différentes informations sur les activités d'un patient dans son parcours
 *            Chaque dossier parcours est composé d'une liste d'onglets, eux même composer d'une liste de champs
 */
class M_DossierParcours extends CI_Model {

    /**
     * \brief      Récupérer les informations sur les dossiers parcours d'un patient
     * \details    Récupérer les informations sur les dossiers parcours d'un patient
     * \param      $idPatient : l'id du patient
     *             $idOnglet : l'id de l'onglet du dossier parcours
     *             $idDossierParcours : l'id du ossier parcours
     */
    public function getDossierByIdPatient($idPatient, $idOnglet, $idDossierParcours) {

        $txt_sql = "SELECT P.id_patient, P.txt_nom, P.txt_prenom, DP.id_dossierparcours, DP.date_creation_dossier, 
			DP.date_derniere_modification, CD.txt_valeur, O.id_onglet, O.txt_nom as txt_onglet, C.id_champ, C.txt_nom  as txt_champ, TC.txt_valeur  as txt_typeChamp
            FROM patient P
            LEFT JOIN dossierparcours DP
            ON P.id_patient = DP.id_patient
            LEFT JOIN constituerdossier CD
            ON CD.id_dossierparcours=DP.id_dossierparcours
            LEFT JOIN onglet O
            ON CD.id_onglet=O.id_onglet
            LEFT JOIN champ C
            ON CD.id_champ=C.id_Champ
            LEFT JOIN typechamp TC
            ON C.id_typechamp=TC.id_typechamp
			WHERE P.id_patient =" . $this->db->escape($idPatient) . "
			ORDER BY DP.id_dossierparcours, O.id_onglet, C.id_champ";

        $query = $this->db->query($txt_sql);
        $res = array();
        $nbTour = 0;
        $dossierParcours = array();
        $dossier = array();
        $onglet = array();
        $onglets = array();
        $champs = array();
        foreach ($query->result() as $row) {
            if ($nbTour == 0) {
                $res["id_patient"] = $row->id_patient;
                $res["txt_nom"] = $row->txt_nom;
                $res["txt_prenom"] = $row->txt_prenom;
                $dossier["id_dossierparcours"] = $row->id_dossierparcours;
                $dossier["date_creation_dossier"] = $row->date_creation_dossier;
                $dossier["date_derniere_modification"] = $row->date_derniere_modification;
                $onglet["id_onglet"] = $row->id_onglet;
                $onglet["txt_onglet"] = $row->txt_onglet;
                if ($idOnglet > 0) {
                    $res["id_onglet_afficher"] = $idOnglet;
                } else {
                    $res["id_onglet_afficher"] = $row->id_onglet;
                }
                if ($idDossierParcours > 0) {
                    $res["id_dparcour_afficher"] = $idDossierParcours;
                } else {
                    $res["id_dparcour_afficher"] = $row->id_dossierparcours;
                }
            } else {
                if ($onglet["id_onglet"] != $row->id_onglet) {
                    $onglet["champs"] = $champs;
                    $champs = array();
                    array_push($onglets, $onglet);
                    $onglet["id_onglet"] = $row->id_onglet;
                    $onglet["txt_onglet"] = $row->txt_onglet;
                }
                if ($dossier["id_dossierparcours"] != $row->id_dossierparcours) {
                    $dossier["onglets"] = $onglets;
                    array_push($dossierParcours, $dossier);
                    $dossier["id_dossierparcours"] = $row->id_dossierparcours;
                    $dossier["date_creation_dossier"] = $row->date_creation_dossier;
                    $dossier["date_derniere_modification"] = $row->date_derniere_modification;
                    $onglets = array();
                }
            }
            $champ = array();
            $champ["id_champ"] = $row->id_champ;
            $champ["txt_champ"] = $row->txt_champ;
            $champ["txt_valeur"] = $row->txt_valeur;
            $champ["txt_typeChamp"] = $row->txt_typeChamp;
            array_push($champs, $champ);
            $nbTour++;
        }
        $onglet["champs"] = $champs;
        array_push($onglets, $onglet);
        $dossier["onglets"] = $onglets;
        array_push($dossierParcours, $dossier);
        $res["dossierParcours"] = $dossierParcours;
        return $res;
    }

    /**
     * \brief      Met à jour les informations sur les dossiers parcours d'un patient
     * \details    Met à jour  les informations sur les dossiers parcours d'un patient
     * \param      $inputInDossier : contient les nouvelles informations sur le dossier parcours
     *             $idOnglet : l'id de l'onglet du dossier parcours
     *             $idDossierParcours : l'id du ossier parcours
     */
    public function majDossierByIdPatient($idOnglet, $idDossierParcours, $inputInDossier) {
        $this->db->trans_begin();
        foreach ($inputInDossier as $input) {
            $txt_sql = "UPDATE constituerdossier 
						SET txt_valeur=" . $this->db->escape($input['val']) . " 
						WHERE id_champ=" . $this->db->escape($input['id']) . " and id_onglet=" . $this->db->escape($idOnglet) . " and id_dossierparcours=" . $this->db->escape($idDossierParcours);

            $this->db->query($txt_sql);
        }

        $dataAlert = array();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $dataAlert["level"] = "danger";
            $dataAlert["message"] = "Echec lors de la mise à jour du dossier parcours.";
            return $dataAlert;
        } else {
            $this->db->trans_commit();
            $dataAlert["level"] = "success";
            $dataAlert["message"] = "Le dossier parcours a bien été modifié.";
            return $dataAlert;
        }
    }

    /**
     * \brief      Ajoute un champ à un dossier parcours
     * \details    Ajoute un champ à un dossier parcours
     * \param      $idChamp : l'id du champ à ajouter dans l'onglet du dossier parcours
     *             $idOnglet : l'id de l'onglet du dossier parcours
     *             $idDossierParcours : l'id du ossier parcours
     */
    public function addChampAtDossier($idOnglet, $idDossierParcours, $idChamp) {
        $sql = "INSERT INTO constituerdossier (id_champ, id_onglet, id_dossierparcours, txt_valeur) 
        VALUES (" . $this->db->escape($idChamp) . ", " . $this->db->escape($idOnglet) . ", " . $this->db->escape($idDossierParcours) . ", null)";

        $this->db->query($sql);
    }

    /**
     * \brief      Obtenir le maxid de le table dossierParcours
     * \details    Obtenir le maxid de le table dossierParcours
     * \param      Aucun
     */
    public function getMaxIdDossierParcours() {
        $txt_sql = "SELECT MAX(id_dossierparcours) as maxId FROM dossierparcours";

        $query = $this->db->query($txt_sql);
        $row = $query->row();
        $maxId = $row->maxId;

        return $maxId + 1;
    }

    /**
     * \brief      Permet de créer un nouveau dossier parcours pour un patient
     * \details    Permet de créer un nouveau dossier parcours pour un patient
     * \param      $idPatient : id du patient
     *             $idParcours : id du parcours
     */
    public function nouvelleDossier($idPatient, $idParcours) {

        $idDossieParcours = $this->getMaxIdDossierParcours();

        $sql = "INSERT INTO dossierparcours (id_dossierparcours, id_patient, id_parcours, date_creation_dossier, date_derniere_modification) 
        VALUES (" . $this->db->escape($idDossieParcours) . ", " . $this->db->escape($idPatient) . ", " . $this->db->escape($idParcours) . ", CURDATE(), CURDATE())";

        $this->db->query($sql);
    }

}
