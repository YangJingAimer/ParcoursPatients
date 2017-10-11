<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * \file      M_Necessiter.php
 * \author    Guillaume Pochet
 * \version   1.0
 * \date      09 Mars 2017
 * \brief     Définit les méthodes liés aux différents besoin d'une activité
 *
 * \details   Ce fichier permet de définir les méthodes d'ajout ou de suppression de besoin d'une activité
 */
class M_Necessiter extends CI_Model {

    /**
     * \brief      Supprime tout les besoins en type de ressource d'une activité
     * \details    Supprime tout les besoins en type de ressource d'une activité
     * \param      $idActivite : id de l'activité
     */
    public function deleteAllBesoin($idActivite) {
        $txt_sql = "DELETE FROM necessiter
			WHERE id_activite = " . $idActivite;
        $query = $this->db->query($txt_sql);
    }

    /**
     * \brief      Ajoute un besoin à une activité
     * \details    Ajoute un besoin à une activité (id de l'activité, idTypeRessource, quantité
     * \param      $idActivite : id de l'activité
     *             $idTypeRes : id du type de la ressource
     *             $qte : quantité nécessaire
     */
    public function addBesoin($idActivite, $idTypeRes, $qte) {

        $txt_sql = "INSERT INTO necessiter
        			(id_activite,id_typeressource,quantite)
                   VALUES(" . $idActivite . "," . $idTypeRes . "," . $qte . ")";
        $query = $this->db->query($txt_sql);
    }

}
