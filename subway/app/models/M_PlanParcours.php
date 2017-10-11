<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * \file      M_PlanParcours.php
 * \author    Guillaume Pochet
 * \version   1.0
 * \date      09 Mars 2017
 * \brief     Définit les méthodes liées aux nombre maximum de patients qu'un parcours peut accueillir par jour
 *
 * \details   Ce fichier permet de définir la méthode d'authentification
 */
class M_PlanParcours extends CI_Model {

    /**
     * \brief      Retourne toutes les informations de tous les parcours
     * \details    Retourne toutes les informations de tous les parcours
     * \param      Aucun
     */
    public function getAllPlanParcours() {
        $txt_sql = "SELECT PL.ID_PARCOURS, TXT_NOM, ID_JOUR, INT_NB_PATIENT
			FROM planparcours PL, parcours PA
			WHERE PL.ID_PARCOURS=PA.ID_PARCOURS
			";
        $query = $this->db->query($txt_sql);
        $res = array();

        foreach ($query->result() as $row) {
            $restemp = array();

            $restemp["id_parcours"] = $row->ID_PARCOURS;
            $restemp["nom_parcours"] = $row->TXT_NOM;
            $restemp["jour"] = $row->ID_JOUR;
            $restemp["nb_patient"] = $row->INT_NB_PATIENT;
            array_push($res, $restemp);
        }
        return $res;
    }

    /**
     * \brief      Retourne le nom de tous les parcours
     * \details    Retourne le nom de tous les parcours
     * \param      Aucun
     */
    public function getNomParcours() {
        $txt_sql = "SELECT DISTINCT PL.ID_PARCOURS, TXT_NOM
			FROM planparcours PL, parcours PA
			WHERE PL.ID_PARCOURS=PA.ID_PARCOURS
			";
        $query = $this->db->query($txt_sql);
        $res = array();

        foreach ($query->result() as $row) {
            $restemp = array();
            $restemp["id_parcours"] = $row->ID_PARCOURS;
            $restemp["nom_parcours"] = $row->TXT_NOM;
            array_push($res, $restemp);
        }
        return $res;
    }

    /**
     * \brief      Retourne toutes les informations d'un parcours en fonction de son id
     * \details    Retourne toutes les informations d'un parcours en fonction de son id
     * \param      $id : id du parcours
     */
    public function getPlanParcoursById($id) {
        $txt_sql = "SELECT PL.ID_PARCOURS, TXT_NOM, ID_JOUR, INT_NB_PATIENT
			FROM planparcours PL, parcours PA
			WHERE PL.ID_PARCOURS=PA.ID_PARCOURS AND PL.ID_PARCOURS=" . $id;

        $query = $this->db->query($txt_sql);
        $res = array();

        foreach ($query->result() as $row) {
            $restemp["id_parcours"] = $row->ID_PARCOURS;
            $restemp["nom_parcours"] = $row->TXT_NOM;
            $restemp["jour"] = $row->ID_JOUR;
            $restemp["nb_patient"] = $row->INT_NB_PATIENT;
            array_push($res, $restemp);
        }
        return $res;
    }

    /**
     * \brief      Retourne le nom d'un parcours en fonction de son id
     * \details    Retourne le nom d'un parcours en fonction de son id
     * \param      $id : id du parcours
     */
    public function getNomParcoursById($id) {
        $txt_sql = "SELECT TXT_NOM
		FROM parcours
		WHERE ID_PARCOURS = " . $id;

        $query = $this->db->query($txt_sql);
        $row = $query->row();
        $res = $row->TXT_NOM;

        return $res;
    }

    /**
     * \brief      Modifie un parcours en fonction de son id
     * \details    Modifie un parcours en fonction de son id
     * \param      $idParcours : id du parcours
     *             $data : les nouvelles données du parcours
     */
    public function modiferplanparcours($data, $idparcours) {
        $i = 0;
        while ($i < count($data['jour'])) {
            $txt_sql = "UPDATE planparcours
                    SET NB_PATIENT=" . $data['nbr'][$i] . "
                    WHERE JOUR='" . $data['jour'][$i] . "' AND ID_PARCOURS=" . $idparcours;
            $query = $this->db->query($txt_sql);
            $i++;
        }
        return $txt_sql;
    }

    /**
     * \brief      Modifie tout les parcours
     * \details    Modifie tout les parcours
     *             $data : les nouvelles données des parcours
     */
    public function modiferallplanparcours($data) {
        $i = 0;
        while ($i < count($data['jour'])) {
            $txt_sql = "UPDATE planparcours
                    SET INT_NB_PATIENT=" . $data['nbr'][$i] . "
                    WHERE ID_JOUR='" . $data['jour'][$i] . "' AND ID_PARCOURS=" . $data['idparcours'][$i];
            $query = $this->db->query($txt_sql);
            $i++;
        }
        return $txt_sql;
    }

}
