<?php

defined('BASEPATH') || exit('No direct script access allowed');

/**
 * \file      M_Compte.php
 * \author    Guillaume Pochet
 * \version   1.0
 * \date      09 Mars 2017
 * \brief     Définit les méthodes liées à a gestion des comptes utilisateurs
 *
 * \details   Ce fichier permet de définir la méthode d'insertion des comptes utilisateurs
 */
class M_Compte extends CI_Model {

    /**
     * \brief      Fonction de récupération de l'id max
     * \details    Fonction de récupération de l'id max
     *             Retourne l'id maximum de la table compte
     */
    public function getMaxIDCompte() {
        $txt_sql = "SELECT MAX(id_compte) as id
                    FROM compte";
        $query = $this->db->query($txt_sql);
        $row = $query->row_array();

        return $row['id'] + 1;
    }

    /**
     * \brief      Insére un nouveau compte dans la table compte (compte personnel uniquement)
     * \details    Insére un nouveau compte dans la table compte (compte personnel uniquement)
     *             Retourne l'id du compte
     * \param      $login : login, $password : mot de passe
     */
    public function insererCompte($login, $password) {
        $id = $this->getMaxIDCompte();
        $txt_sql = "INSERT INTO compte(id_compte,txt_login,txt_motdepasse,id_typecompte) VALUES(" . $id . "," . $this->db->escape($login) . "," . $this->db->escape($password) . ",2)";
        $this->db->query($txt_sql);
        return $id;
    }

}
