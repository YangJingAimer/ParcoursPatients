<?php

defined('BASEPATH') || exit('No direct script access allowed');

/**
 * \file      M_Champ.php
 * \author    Guillaume Pochet
 * \version   1.0
 * \date      09 Mars 2017
 * \brief     Définit les méthodes liées à la gestion des champs nécessaires à la construction d'un dossier parcours patient
 *
 * \details   Ce fichier permet de définir la méthode de gestion des champs (récupération, ajout)
 */
class M_Champ extends CI_Model {

    /**
     * \brief      Permet de récupérer la liste de tout les types champs
     * \details    Permet de récupérer la liste de tout les types champs (date, texte, texte multiligne, numérique)
     * \param      Aucun
     */
    public function getAllTypeChamp() {
        $txt_sql = "SELECT id_typechamp, txt_libelle
            FROM typechamp";

        $query = $this->db->query($txt_sql);
        $types = array();
        $type = array();
        foreach ($query->result() as $row) {
            $type["id_typechamp"] = $row->id_typechamp;
            $type["txt_libelle"] = $row->txt_libelle;
            array_push($types, $type);
        }
        return $types;
    }

    /**
     * \brief      Permet de récupérer la liste de tout les types champs avec une recherche par type
     * \details    Permet de récupérer la liste de tout les types champs  avec une recherche par type (date, texte, texte multiligne, numérique)
     * \param      $q : nom du champ à rechercher
     */
    public function getAllChampWith($q) {
        $txt_sql = "SELECT id_champ, txt_nom, id_typechamp
            FROM champ             
            WHERE txt_nom LIKE '%" . $this->db->escape_str(strtolower($q)) . "%'";

        $query = $this->db->query($txt_sql);
        $result = [];
        $new_row['value'] = "Votre saisie : " . $q;
        $new_row['id_champ'] = htmlentities(-1);
        $new_row['id_typechamp'] = htmlentities(1);
        $result[] = $new_row; //build an array
        foreach ($query->result() as $row) {
            $new_row['value'] = $row->txt_nom;
            $new_row['id_champ'] = $row->id_champ;
            $new_row['id_typechamp'] = $row->id_typechamp;
            $result[] = $new_row; //build an array
        }
        return $result;
    }

    /**
     * \brief      Ajout d'un nouveau champ
     * \details    Ajout d'un nouveau champ dans la base de données
     * \param      $idTypeChamp : type du champ, $nomChamp : nom du champ
     */
    public function addNewChamp($idTypeChamp, $nomChamp) {

        $query = $this->db->query('SELECT MAX(id_champ) AS id FROM champ LIMIT 1');

        $row = $query->row();
        $idChamp = $row->id + 1;

        $sql = "INSERT INTO champ (id_champ, id_typechamp, txt_nom) 
        VALUES (" . $this->db->escape($idChamp) . ", " . $this->db->escape($idTypeChamp) . ", " . $this->db->escape($nomChamp) . ")";

        $this->db->query($sql);

        return $idChamp;
    }

}
