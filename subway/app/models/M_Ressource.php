<?php

defined('BASEPATH') || exit('No direct script access allowed');

/**
 * \file      M_Ressource.php
 * \author    Guillaume Pochet
 * \version   1.0
 * \date      09 Mars 2017
 * \brief     Définit les méthodes liées aux ressources de manière générale (humaine et matérielle)
 *
 * \details   Ce fichier permet de définir les méthodes d'insertion, de récupération, d'affichage de planning, etc)
 */
class M_Ressource extends CI_Model {

    /**
     * \brief      Fonction de génération de couleur
     * \details    Fonction de génération de couleur, cette couleur sera utilisé pour l'affichage du planning des ressources
     * \param      Aucun
     */
    function random_color() {
        mt_srand((double) microtime() * 1000000);
        $c = '';
        while (strlen($c) < 6) {
            $c .= sprintf("%02X", mt_rand(0, 255));
        }
        return $c;
    }

    /**
     * \brief      Permet de récuperer les informations sur la planification d'une ressource en fonction d'une date et de son id
     * \details    Permet de récuperer les informations sur la planification d'une ressource en fonction d'une date et de son id
     * \param      $id_ressource : id de la ressource
     *             $date : date
     */
    function getWeekByIdRessource($id_ressource, $date) {
        $query = $this->db->query("SELECT 
            DATE(e.start) as date, 
            e.patientId, 
            e.activiteId, 
            e.start as start, 
            e.end as end, 
            a.txt_nom as act_nom, 
            p.txt_nom as pat_nom, 
            p.txt_prenom as pat_prenom 
            FROM ordonnancer e, activite a, patient p
            WHERE e.activiteId = a.id_activite 
            AND p.id_patient = e.patientId
            AND e.ressourceId = '" . $id_ressource . "'
            AND DATE(e.start) >= '" . $date . "'");

        $i = 0;

        $res = "[";
        $bool = true;
        foreach ($query->result() as $row) {
            $color = ["3399FF", "B22222", "006400", "9370DB"]; // Liste de couleurs potentielles
            if (!$bool) {
                $res .= ",";
            }
            $bool = false;
            $res .= "{\n";
            $res .= "id : 'E0" . ($i + 1) . "',\n";
            $res .= "title : '" . $row->act_nom . " (" . $row->pat_nom . " " . $row->pat_prenom . ")" . "',\n";
            $res .= "start : '" . date_format(new DateTime($row->start), "d-m-Y H:i:s") . "',\n";
            $res .= "end : '" . date_format(new DateTime($row->end), "d-m-Y H:i:s") . "',\n";
            $res .= "backgroundColor : '#" . $color[rand(0, count($color) - 1)] . "',\ntextColor : '#FFF'\n}\n";
            $i++;
        }
        $res .= "]";
        return $res;
    }

    /**
     * \brief      Fonction de récupération de l'id max des différentes ressources
     * \details    Fonction de récupération de l'id max des différentes ressources
     * \param      Aucun
     */
    public function getMaxIDRessource() {
        $txt_sql = "SELECT MAX(id_ressource) as id
                    FROM ressource";
        $query = $this->db->query($txt_sql);
        $row = $query->row_array();

        return $row['id'] + 1;
    }

    /**
     * \brief      Fonction de récupération du nom d'une ressource en fonction de son id
     * \details    Fonction de récupération du nom d'une ressource en fonction de son id
     * \param      îd : id de la ressource
     */
    public function getNameByIdRessource($id) {
        $txt_sql = "SELECT TXT_NOM, TXT_PRENOM FROM personnel WHERE ID_RESSOURCE = " . $this->db->escape($id);
        $query = $this->db->query($txt_sql);
        $result = $query->row_array();
        return $result["TXT_NOM"] . " " . $result["TXT_PRENOM"];
    }

    /**
     * \brief      Fonction d'insertion d'une nouvelle ressource
     * \details    Fonction d'insertion d'une nouvelle ressource,
     *             humaine ou matérielle
     * \param      $idType, type de la ressource à ajouter
     */
    public function insererRessource($idType) {
        $id = $this->getMaxIDRessource();
        $txt_sql = "INSERT INTO ressource(id_ressource,id_typeressource) VALUES(" . $id . "," . $this->db->escape($idType) . ")";
        $this->db->query($txt_sql);
        return $id;
    }

}
