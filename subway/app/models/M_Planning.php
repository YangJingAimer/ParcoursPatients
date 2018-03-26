<?php

/**
 * \file      M_Planning.php
 * \author    Guillaume Pochet
 * \version   1.0
 * \date      09 Mars 2017
 * \brief     Définit les méthodes liées au planning
 *
 * \details   Ce fichier permet de définir les méthodes de gestion du planning (ajout, suppression d'événements)
 */
class M_Planning extends CI_Model {

    /**
     * \brief      Récupére toutes les ressource humaines ou matérielles
     * \details    Récupére toutes les ressource humaines ou matérielles
     * \param      Aucun
     */
    public function getAllRessource() {
        // le personnel
        $txt_sql = "SELECT r.ID_RESSOURCE as id,P.txt_nom as nom, P.txt_prenom as prenom, TR.txt_nom as Type_nom
			FROM personnel P, typeressource TR, ressource R
			WHERE P.id_ressource = R.id_ressource
			AND R.id_typeressource = TR.id_typeressource";
        $query = $this->db->query($txt_sql);
        $res = array();

        foreach ($query->result() as $row) {
            $restemp = array();

            $restemp["id"] = $row->id;
            $restemp["title"] = $row->prenom . " " . $row->nom;
            $restemp["type_ressource"] = $row->Type_nom;
            array_push($res, $restemp);
        }

        // Les salles
        $txt_sql = "SELECT s.ID_RESSOURCE as id, s.TXT_NOM as nom, t.TXT_NOM as Type_nom
                    FROM salle s, ressource r, typeressource t
                    WHERE s.ID_RESSOURCE = r.ID_RESSOURCE
                    AND t.ID_TYPERESSOURCE = r.ID_TYPERESSOURCE";
        $query = $this->db->query($txt_sql);

        foreach ($query->result() as $row) {
            $restemp = array();

            $restemp["id"] = $row->id;
            $restemp["title"] = $row->nom;
            $restemp["type_ressource"] = $row->Type_nom;
            array_push($res, $restemp);
        }

        return $res;
    }

    /**
     * \brief      Récupére toutes les activités à planifier en fonctin d'une date donné
     * \details    Récupére toutes les activités à planifier en fonctin d'une date donné
     * \param      $date : la date 
     */
    public function getActiviteAplanifier($date) {


        // activité à planifier (rendez vous dans la table patient )
        $txt_sql = "SELECT DISTINCT(A.ID_ACTIVITE) as id_activite, Pat.ID_PATIENT as id_patient, Par.ID_PARCOURS as id_parcours, A.TXT_NOM as nom_activite, Pat.TXT_NOM as nom_patient, Pat.TXT_PRENOM as prenom_patient, Par.TXT_NOM as nom_parcours, A.INT_DUREE as duree
                    FROM patient Pat, parcours Par, composer C, activite A, dossierparcours D
                    WHERE Pat.ID_PATIENT = D.ID_PATIENT
                    AND D.ID_PARCOURS = Par.ID_PARCOURS
                    AND Par.ID_PARCOURS = C.ID_PARCOURS
                    AND C.ID_ACTIVITE = A.ID_ACTIVITE
                    AND DATE(D.DATE_DISPONIBLE_DEBUT) =" . $this->db->escape($date);
        $query = $this->db->query($txt_sql);
        $res = array();

        foreach ($query->result() as $row) {
            $restemp = array();

            $restemp["activite_id"] = $row->id_activite;
            $restemp["patient_id"] = $row->id_patient;
            $restemp["parcours_id"] = $row->id_parcours;
            $restemp["nom_activite"] = $row->nom_patient . " " . $row->prenom_patient . " - " . $row->nom_activite . " - " . $row->nom_parcours;
            //Convertir durée en minutes en heure, minutes, seconde (hh:mm:ss)
            $secondes = $row->duree * 60;
            $temp = $secondes % 3600;
            $time[0] = ( $secondes - $temp ) / 3600;
            $time[2] = $temp % 60;
            $time[1] = ( $temp - $time[2] ) / 60;
            $restemp["duree"] = $time[0] . ":" . $time[1] . ":" . $time[2];
            $restemp["activite_precedente"] = $this->precedence($row->id_activite, $row->id_parcours);
            $restemp["necessite"] = $this->necessite($row->id_activite);
            array_push($res, $restemp);
        }

        // activité déja planifié
        $txt_sql2 = "SELECT DISTINCT(activite.ID_ACTIVITE) as id_activite, patient.ID_PATIENT as id_patient, parcours.ID_PARCOURS as id_parcours, activite.TXT_NOM as nom_activite, patient.TXT_NOM as nom_patient, patient.TXT_PRENOM as prenom_patient, parcours.TXT_NOM as nom_parcours, activite.INT_DUREE as duree
					FROM evenement, parcours, activite, patient
                	WHERE patient.ID_PATIENT = evenement.patientId
                	AND parcours.ID_PARCOURS = evenement.parcoursId
                	AND activite.ID_ACTIVITE = evenement.activiteId
                	and DATE(start) = " . $this->db->escape($date);
        $query2 = $this->db->query($txt_sql2);

        $res2 = array();
        foreach ($query2->result() as $row) {
            $restemp = array();

            $restemp["activite_id"] = $row->id_activite;
            $restemp["patient_id"] = $row->id_patient;
            $restemp["parcours_id"] = $row->id_parcours;
            $restemp["nom_activite"] = $row->nom_patient . " " . $row->prenom_patient . " - " . $row->nom_activite . " - " . $row->nom_parcours;
            //Convertir durée en minutes en heure, minutes, seconde (hh:mm:ss)
            $secondes = $row->duree * 60;
            $temp = $secondes % 3600;
            $time[0] = ( $secondes - $temp ) / 3600;
            $time[2] = $temp % 60;
            $time[1] = ( $temp - $time[2] ) / 60;
            $restemp["duree"] = $time[0] . ":" . $time[1] . ":" . $time[2];
            $restemp["activite_precedente"] = $this->precedence($row->id_activite, $row->id_parcours);
            $restemp["necessite"] = $this->necessite($row->id_activite);
            array_push($res2, $restemp);
        }

        //retiré du tableau les activités déja planifié
        foreach ($res as $i => &$value) {
            foreach ($res2 as $j => $value1) {
                // Si les deux actités, patient, parcours sont identiques alors on supprime cette activité du tableau $res
                if (($value["activite_id"] == $value1["activite_id"]) && ($value["patient_id"] == $value1["patient_id"]) && ($value["parcours_id"] == $value1["parcours_id"])) {
                    unset($res[$i]);
                }
            }
        }

        $res = array_merge($res);
        return $res;
    }

    /**
     * \brief      Ajout d'un événement
     * \details    Ajout d'un événement dans la base de données
     * \param      $title : titre de l'événement
     *             $end : date et heure de fin de l'événement
     *             $start : date et heure de début
     *             $ressourceId : ressource lié à l'événement
     *             $activiteId : id de l'activité lié à l'événement
     *             $patientId : id du patient
     *             $parcoursId : id du parcours
     */
    public function addEvenement($title, $start, $end, $ressourceId, $activiteId, $patientId, $parcoursId) {
        // necessite
        $txt_sql = "SELECT t.ID_TYPERESSOURCE as id, quantite as quantite
                    FROM typeressource t, activite a, necessiter n
                    WHERE t.ID_TYPERESSOURCE = n.ID_TYPERESSOURCE
                    AND n.ID_ACTIVITE = a.ID_ACTIVITE
                    AND a.ID_ACTIVITE = " . $this->db->escape($activiteId);

        $query = $this->db->query($txt_sql);

        if ($query->num_rows() >= 1) {
            //Pour chaque besoins de l'activité, récupérer la première ressource disponible sinon la première
            foreach ($query->result() as $row) {
                $idRessource = $this->getRessourceByType($row->id, $row->quantite, $start, $end);
                for ($i = 0; $i < count($idRessource); $i++) {
                    if ($this->getCouleurEventPatient($patientId) != NULL) {
                        $txt_sql = "INSERT INTO `evenement`(`start`, `end`, `title`, `patientId`, `ressourceId`, `parcoursId`, `activiteId`, `color`) "
                                . "VALUES (" . $this->db->escape($start) . "," . $this->db->escape($end)
                                . "," . $this->db->escape($title)
                                . "," . $this->db->escape($patientId)
                                . "," . $this->db->escape($idRessource[$i])
                                . "," . $this->db->escape($parcoursId)
                                . "," . $this->db->escape($activiteId)
                                . "," . $this->db->escape($this->getCouleurEventPatient($patientId)) . ")";
                        $this->db->query($txt_sql);
                    } else {
                        $txt_sql = "INSERT INTO `evenement`(`start`, `end`, `title`, `patientId`, `ressourceId`, `parcoursId`, `activiteId`, `color`) "
                                . "VALUES (" . $this->db->escape($start) . "," . $this->db->escape($end)
                                . "," . $this->db->escape($title)
                                . "," . $this->db->escape($patientId)
                                . "," . $this->db->escape($idRessource[$i])
                                . "," . $this->db->escape($parcoursId)
                                . "," . $this->db->escape($activiteId)
                                . "," . $this->db->escape($this->couleur_aleatoire()) . ")";
                        $this->db->query($txt_sql);
                    }
                }
            }
        } else {
            if ($this->getCouleurEventPatient($patientId) != NULL) {
                $txt_sql = "INSERT INTO `evenement`(`start`, `end`, `title`, `patientId`, `ressourceId`, `parcoursId`, `activiteId`, `color`) "
                        . "VALUES (" . $this->db->escape($start) . "," . $this->db->escape($end)
                        . "," . $this->db->escape($title)
                        . "," . $this->db->escape($patientId)
                        . "," . $this->db->escape($ressourceId)
                        . "," . $this->db->escape($parcoursId)
                        . "," . $this->db->escape($activiteId)
                        . "," . $this->db->escape($this->getCouleurEventPatient($patientId)) . ")";
                $this->db->query($txt_sql);
            } else {
                $txt_sql = "INSERT INTO `evenement`(`start`, `end`, `title`, `patientId`, `ressourceId`, `parcoursId`, `activiteId`, `color`) "
                        . "VALUES (" . $this->db->escape($start) . "," . $this->db->escape($end)
                        . "," . $this->db->escape($title)
                        . "," . $this->db->escape($patientId)
                        . "," . $this->db->escape($ressourceId)
                        . "," . $this->db->escape($parcoursId)
                        . "," . $this->db->escape($activiteId)
                        . "," . $this->db->escape($this->couleur_aleatoire()) . ")";
                $this->db->query($txt_sql);
            }
        }
    }

    /**
     * \brief      Récupère tout les événement de la base de données
     * \details    Récupère tout les événement de la base de données
     * \param      Aucun
     */
    public function getAllEvenement() {

        $txt_sql = "SELECT `id`, `start`, `end`, `title`, `patientId`, `ressourceId`, `parcoursId`, `activiteId`, `color` FROM `evenement`";
        $query = $this->db->query($txt_sql);
        $res = array();

        foreach ($query->result() as $row) {
            $restemp = array();
            $restemp["id"] = $row->id;
            $restemp["resourceId"] = $row->ressourceId;
            $restemp["start"] = $row->start;
            $restemp["end"] = $row->end;
            $restemp["title"] = $row->title;
            $restemp["patientId"] = $row->patientId;
            $restemp["parcoursId"] = $row->parcoursId;
            $restemp["activiteId"] = $row->activiteId;
            if ($row->activiteId != NULL && $row->parcoursId != NULL) {
                $restemp["necessite"] = $this->necessite($row->activiteId);
                $restemp["activite_precedente"] = $this->precedence($row->activiteId, $row->parcoursId);
            }
            $restemp["color"] = $row->color;
            array_push($res, $restemp);
        }

        $txt_sql = "SELECT ID_RESSOURCE as ressourceId, DATE_DEBUT as start, DATE_FIN as end
		FROM etreindisponible";

        $query = $this->db->query($txt_sql);

        foreach ($query->result() as $row) {
            $restemp = array();
            $restemp["resourceId"] = $row->ressourceId;
            $restemp["activite_precedente"] = "";
            $restemp["id"] = -1;
            $restemp["title"] = "Indisponible";
            $restemp["start"] = $row->start;
            $restemp["end"] = $row->end;
            $restemp["color"] = "#000000";
            $restemp["editable"] = false;
            $restemp["eventOverlap"] = false;
            $restemp["patientId"] = null;
            $restemp["parcoursId"] = null;
            array_push($res, $restemp);
        }
        return $res;
    }

    /**
     * \brief      Récupère tout les événements d'un parcours pour un patient pout une date données
     * \details    Récupère tout les événements d'un parcours pour un patient pout une date données
     * \param      $date : date
     *             $patient : l'id du patient
     *             $parcours : id du parcours
     */
    public function getParcoursByDateAndPatient($date, $patient, $parcours) {
        $txt_sql = "select id, title, end, start, ressourceId, patientId, parcoursId, activiteId, color from evenement
                    WHERE parcoursId = " . $this->db->escape($parcours) . "
                    AND patientId = " . $this->db->escape($patient) . "
                    AND date(start) = " . $this->db->escape($date);
        $query = $this->db->query($txt_sql);
        $res = array();
        foreach ($query->result() as $row) {
            $restemp = array();
            $restemp["id"] = $row->id;
            $restemp["title"] = $row->title;
            $restemp["start"] = $row->start;
            $restemp["end"] = $row->end;
            $restemp["patientId"] = $row->patientId;
            $restemp["ressourceId"] = $row->ressourceId;
            $restemp["activiteId"] = $row->activiteId;
            array_push($res, $restemp);
        }

        return $res;
    }

    /**
     * \brief      Récupère tout les événement (juste le parcours) pour une date donné
     * \details   Récupère tout les événement (juste le parcours) pour une date donné
     * \param      $date : date
     */
    public function getParcoursByDate($date) {
        $txt_sql = "SELECT DISTINCT parcoursId, patientId
                    from evenement
                    WHERE date (start) = " . $this->db->escape($date);

        $query = $this->db->query($txt_sql);
        $res = array();
        foreach ($query->result() as $row) {
            $restemp = array();
            $restemp["parcoursId"] = $row->parcoursId;
            $restemp["patientId"] = $row->patientId;
            array_push($res, $restemp);
        }

        return $res;
    }

    /**
     * \brief      Récupère les détails d'un événement pour une activité, un parcours, un patient et une date donné
     * \details    Récupère les détails d'un événement pour une activité, un parcours, un patient et une date donné
     * \param      $date : date
     *             $idActivite : id de l'activité 
     *             $idParcours : id du parcours
     *             $idPatient : id du patient
     */
    public function getDetailEvenement($idActivite, $idParcours, $idPatient, $date) {
        $txt_sql = "select id, title, end, start, activiteId from evenement
                    WHERE activiteId = " . $this->db->escape($idActivite) . "
                    AND patientId = " . $this->db->escape($idPatient) . "
                    AND parcoursId = " . $this->db->escape($idParcours) . "
                    AND date(start) = " . $this->db->escape($date) . " LIMIT 1";
        $query = $this->db->query($txt_sql);
        $res = array();

        foreach ($query->result() as $row) {
            $restemp = array();
            $restemp["id"] = $row->id;
            $restemp["title"] = $row->title;
            $restemp["start"] = $row->start;
            $restemp["end"] = $row->end;
            $restemp["activiteId"] = $row->activiteId;
            array_push($res, $restemp);
        }

        return $res;
    }

    /**
     * \brief      Récupère tout les événement (tout les attributs) de la base de données pour une date donné
     * \details    Récupère tout les événement (tout les attributs) de la base de données pour une date donné
     * \param      Aucun
     */
    public function getAllEvenementByDate($date) {

        $txt_sql = "SELECT `id`, `start`, `end`, `title`, `patientId`, `ressourceId`, `parcoursId`, `activiteId`, `color` FROM `evenement` WHERE date(start)=" . $this->db->escape($date);
        $query = $this->db->query($txt_sql);
        $res = array();

        foreach ($query->result() as $row) {
            $restemp = array();
            $restemp["id"] = $row->id;
            $restemp["resourceId"] = $row->ressourceId;
            $restemp["start"] = $row->start;
            $restemp["end"] = $row->end;
            $restemp["title"] = $row->title;
            $restemp["patientId"] = $row->patientId;
            $restemp["parcoursId"] = $row->parcoursId;
            $restemp["activiteId"] = $row->activiteId;
            if ($row->activiteId != NULL && $row->parcoursId != NULL) {
                $restemp["necessite"] = $this->necessite($row->activiteId);
                $restemp["activite_precedente"] = $this->precedence($row->activiteId, $row->parcoursId);
            }
            $restemp["color"] = $row->color;
            array_push($res, $restemp);
        }

        $txt_sql = "SELECT ID_RESSOURCE as ressourceId, DATE_DEBUT as start, DATE_FIN as end
		FROM etreindisponible
                WHERE date(DATE_DEBUT)=" . $this->db->escape($date);

        $query = $this->db->query($txt_sql);

        foreach ($query->result() as $row) {
            $restemp = array();
            $restemp["resourceId"] = $row->ressourceId;
            $restemp["activite_precedente"] = "";
            $restemp["id"] = -1;
            $restemp["title"] = "Indisponible";
            $restemp["start"] = $row->start;
            $restemp["end"] = $row->end;
            $restemp["color"] = "#000000";
            $restemp["editable"] = false;
            $restemp["eventOverlap"] = false;
            $restemp["patientId"] = null;
            $restemp["parcoursId"] = null;
            array_push($res, $restemp);
        }
        return $res;
    }

    /**
     * \brief      Supprime un événement de la base de données
     * \details    Supprime un événement de la base de données en fonction de l'id de son activité, l'id de son patient et l'id de son parcours
     * \param      $idActivite : id de l'activité
     *             $idPatient : id du patient
     *             $idParcours : id du parcours
     */
    public function deleteEvent($idActivite, $idPatient, $idParcours) {
        $txt_sql = "DELETE FROM evenement WHERE activiteId=" . $this->db->escape($idActivite) . " AND patientId=" . $this->db->escape($idPatient) . "AND parcoursId=" . $this->db->escape($idParcours);
        $this->db->query($txt_sql);
    }

    /**
     * \brief      Met à jour un événement de la base de données
     * \details    Met à jour un événement de la base de données
     * \param      $idActivite : id de l'activité
     *             $idPatient : id du patient
     *             $idParcours : id du parcours
     *             $idRessource : id de la ressource
     *             $start : date de début de l'événement
     *             $end : date de fin de l'activité
     *             $id : id de l'événement à modifier
     */
    public function updateEvent($start, $end, $idRessource, $idActivite, $idPatient, $idParcours, $id) {

        $ressourcePossible = $this->getRessourcePossiblePourUneActivite($idActivite);
        if ($ressourcePossible == null) {
            $possible = true;
        } else {
            $possible = false;
        }

        foreach ($ressourcePossible as $r) {
            if ($idRessource == $r["id"]) {
                $possible = true;
            }
        }

        if ($possible) {

            $txt_sql = "UPDATE evenement
                    SET ressourceId= " . $this->db->escape($idRessource) . " WHERE id=" . $this->db->escape($id);
            $this->db->query($txt_sql);

            $txt_sql = "UPDATE evenement
                    SET start = " . $this->db->escape($start) . ", end=" . $this->db->escape($end) . " WHERE activiteId=" . $this->db->escape($idActivite) . ""
                    . " AND patientId=" . $this->db->escape($idPatient) . "AND parcoursId=" . $this->db->escape($idParcours);
            $this->db->query($txt_sql);
        }
    }

    /**
     * \brief      Récupére tout les besoins d'un événement en fonction de l'id de son activité
     * \details    Récupére tout les besoins d'un événement en fonction de l'id de son activité
     * \param      $idActivite : id de l'activité de l'événement
     */
    public function necessite($idActivite) {
        $txt_sql = "SELECT n.QUANTITE as quantite, t.TXT_NOM as nom
                    FROM necessiter n, activite a, typeressource t
                    WHERE n.ID_TYPERESSOURCE = t.ID_TYPERESSOURCE
                    and n.ID_ACTIVITE = a.ID_ACTIVITE
                    and a.ID_ACTIVITE = " . $idActivite;

        $query = $this->db->query($txt_sql);
        $necessite = "";
        $i = 0;

        foreach ($query->result() as $row) {
            if ($i == 0) {
                $necessite = $row->quantite . " " . $row->nom;
            } else {
                $necessite .= ", " . $row->quantite . " " . $row->nom;
            }
            $i++;
        }

        return $necessite;
    }

    /**
     * \brief      Récupére tout les précédences d'une activité d'un événement pour un parcours
     * \details    Récupére tout les précédences d'une activité d'un événement pour un parcours
     * \param      $idActivite : id de l'activité de l'événement
     *             $idParcours : id du parcours
     */
    public function precedence($idActivite, $idParcours) {
        $txt_sql = "SELECT a.TXT_NOM as precedent
                    FROM composer c, activite a, parcours p
                    Where a.ID_ACTIVITE = c.ID_ACTIVITE_PRECEDENTE
                    and p.ID_PARCOURS = c.ID_PARCOURS
                    and c.ID_ACTIVITE = " . $idActivite . "
                    and p.ID_PARCOURS = " . $idParcours;

        $query = $this->db->query($txt_sql);
        $precedent = "";

        $i = 0;

        foreach ($query->result() as $row) {
            if ($i == 0) {
                $precedent = $row->precedent;
            } else {
                $precedent .= ", " . $row->precedent;
            }
            $i++;
        }

        return $precedent;
    }

    /**
     * \brief      Récupére tout les ressource disponible entre deux date
     * \details    Récupére tout les ressource disponible entre deux date
     * \param      $id : id du type de ressource
     *             $quantite : retourne la quantite
     *             $start : date de début
     *             $end : date de fin
     */
    public function getRessourceByType($id, $quantite, $start, $end) {

        $res = array();
        // la première ressource disponible
        $txt_sql = "SELECT r.ID_RESSOURCE as id
                    FROM ressource r, typeressource tr
                    WHERE r.ID_TYPERESSOURCE = tr.ID_TYPERESSOURCE
                    AND tr.ID_TYPERESSOURCE = " . $id . "
                    AND r.ID_RESSOURCE not in (SELECT e.ressourceId 
							FROM evenement e
                                                        WHERE e.start BETWEEN " . $this->db->escape($start) . " AND " . $this->db->escape($end) . "
                                                        OR e.end BETWEEN " . $this->db->escape($start) . " AND " . $this->db->escape($end) . ")
                    LIMIT " . $quantite;

        $query = $this->db->query($txt_sql);

        foreach ($query->result() as $row) {
            array_push($res, $row->id);
        }

        if ($row == NULL) {
            // sinon la première ressource
            $txt_sql = "SELECT r.ID_RESSOURCE as id
                    FROM ressource r, typeressource t
                    WHERE r.ID_TYPERESSOURCE = t.ID_TYPERESSOURCE
                    AND t.ID_TYPERESSOURCE = " . $id . "
                    LIMIT " . $quantite;

            $query = $this->db->query($txt_sql);

            foreach ($query->result() as $row) {
                array_push($res, $row->id);
            }
        }

        return $res;
    }

    /**
     * \brief      Récupére la liste des ressource possible pour une activité d'un événement
     * \details    Récupére la liste des ressource possible pour une activité d'un événement
     * \param      $idActivite : id de l'activite
     */
    public function getRessourcePossiblePourUneActivite($idActivite) {
        $txt_sql = "SELECT r.ID_RESSOURCE as id
                    FROM necessiter n, ressource r
                    WHERE n.ID_TYPERESSOURCE = r.ID_TYPERESSOURCE
                    AND n.ID_ACTIVITE =" . $this->db->escape($idActivite);

        $query = $this->db->query($txt_sql);
        $res = array();

        foreach ($query->result() as $row) {
            $restemp = array();
            $restemp["id"] = $row->id;
            array_push($res, $restemp);
        }

        return $res;
    }

    /**
     * \brief      Récupére la liste des activités à planifier pour une date donné en fonction du nom du patient
     * \details    Récupére la liste des activités à planifier pour une date donné en fonction du nom du patient
     * \param      $date : date
     *             $recherche : nom du patient à rechercher
     */
    public function getActiviteAplanifierRecherche($date, $recherche) {
        if ($recherche != "") {
            // activité à planifier (rendez vous dans la table patient )
            $txt_sql = "SELECT DISTINCT(activite.ID_ACTIVITE) as id_activite, patient.ID_PATIENT as id_patient, parcours.ID_PARCOURS as id_parcours, activite.TXT_NOM as nom_activite, patient.TXT_NOM as nom_patient, patient.TXT_PRENOM as prenom_patient, parcours.TXT_NOM as nom_parcours, activite.INT_DUREE as duree
                    FROM patient, parcours, composer, activite
                    WHERE patient.ID_PARCOURS_SUP = parcours.ID_PARCOURS
                    AND parcours.ID_PARCOURS = composer.ID_PARCOURS
                    AND composer.ID_ACTIVITE = activite.ID_ACTIVITE
                    AND DATE(DATE_DISPONIBLE_DEBUT) =" . $this->db->escape($date) . "
                    AND UPPER(patient.TXT_nom) like '%" . $this->db->escape_str(strtoupper($recherche)) . "%'";
            $query = $this->db->query($txt_sql);
            $res = array();

            foreach ($query->result() as $row) {
                $restemp = array();

                $restemp["activite_id"] = $row->id_activite;
                $restemp["patient_id"] = $row->id_patient;
                $restemp["parcours_id"] = $row->id_parcours;
                $restemp["nom_activite"] = $row->nom_patient . " " . $row->prenom_patient . " - " . $row->nom_activite . " - " . $row->nom_parcours;
                //Convertir durée en minutes en heure, minutes, seconde (hh:mm:ss)
                $secondes = $row->duree * 60;
                $temp = $secondes % 3600;
                $time[0] = ( $secondes - $temp ) / 3600;
                $time[2] = $temp % 60;
                $time[1] = ( $temp - $time[2] ) / 60;
                $restemp["duree"] = $time[0] . ":" . $time[1] . ":" . $time[2];
                $restemp["activite_precedente"] = $this->precedence($row->id_activite, $row->id_parcours);
                $restemp["necessite"] = $this->necessite($row->id_activite);
                array_push($res, $restemp);
            }

            // activité déja planifié
            $txt_sql2 = "SELECT DISTINCT(activite.ID_ACTIVITE) as id_activite, patient.ID_PATIENT as id_patient, parcours.ID_PARCOURS as id_parcours, activite.TXT_NOM as nom_activite, patient.TXT_NOM as nom_patient, patient.TXT_PRENOM as prenom_patient, parcours.TXT_NOM as nom_parcours, activite.INT_DUREE as duree
					FROM evenement, parcours, activite, patient
                	WHERE patient.ID_PATIENT = evenement.patientId
                	AND parcours.ID_PARCOURS = evenement.parcoursId
                	AND activite.ID_ACTIVITE = evenement.activiteId
                	AND DATE(start) = " . $this->db->escape($date) . "
                        AND UPPER (patient.TXT_nom) like '%" . $this->db->escape_str(strtoupper($recherche)) . "%'";
            $query2 = $this->db->query($txt_sql2);

            $res2 = array();
            foreach ($query2->result() as $row) {
                $restemp = array();
                $restemp["activite_id"] = $row->id_activite;
                $restemp["patient_id"] = $row->id_patient;
                $restemp["parcours_id"] = $row->id_parcours;
                $restemp["nom_activite"] = $row->nom_patient . " " . $row->prenom_patient . " - " . $row->nom_activite . " - " . $row->nom_parcours;
                //Convertir durée en minutes en heure, minutes, seconde (hh:mm:ss)
                $secondes = $row->duree * 60;
                $temp = $secondes % 3600;
                $time[0] = ( $secondes - $temp ) / 3600;
                $time[2] = $temp % 60;
                $time[1] = ( $temp - $time[2] ) / 60;
                $restemp["duree"] = $time[0] . ":" . $time[1] . ":" . $time[2];
                $restemp["activite_precedente"] = $this->precedence($row->id_activite, $row->id_parcours);
                $restemp["necessite"] = $this->necessite($row->id_activite);
                array_push($res2, $restemp);
            }

            //retiré du tableau les activités déja planifié
            foreach ($res as $i => &$value) {
                foreach ($res2 as $j => $value1) {
                    // Si les deux actités, patient, parcours sont identiques alors on supprime cette activité du tableau $res
                    if (($value["activite_id"] == $value1["activite_id"]) && ($value["patient_id"] == $value1["patient_id"]) && ($value["parcours_id"] == $value1["parcours_id"])) {
                        unset($res[$i]);
                    }
                }
            }
        } else {
            $res = $this->getActiviteAplanifier($date);
        }

        return array_merge($res);
    }

    /**
     * \brief      Fonction de récupération d'une couleur aléatoire
     * \details    Fonction de récupération d'une couleur aléatoire
     * \param      Aucun
     */
    function couleur_aleatoire() {
        $couleur = array('#FF6633', '#ffcc99', '#99cccc', '#669999', '#CC9999', 'FFCCCC', '99CCCC', '#999999',
            '#00FFFF',
            '#000090',
            '#008C90',
            '#B88410',
            '#A8ACA8',
            '#006400',
            '#B8B868',
            '#880088',
            '#586C30',
            '#FF8C00',
            '#9830C8',
            '#880000',
            '#F09880',
            '#90BC90',
            '#483C88',
            '#305050',
            '#00D0D8',
            '#9800D8',
            '#FF1490',
            '#00BCFF',
            '#686868',
            '#2090FF');
        $valeur = rand(0, 29);
        return $couleur[$valeur];
    }

    /**
     * \brief      Fonction de suppression de tout les événement lié à un patient pour une date donné
     * \details    Fonction de suppression de tout les événement lié à un patient pour une date donné
     * \param      $idPatient : id du patient
     *             $date : date
     */
    function deleteAllEventPatient($idPatient, $date) {
        $txt_sql = "DELETE FROM evenement WHERE patientId=" . $this->db->escape($idPatient) . " AND DATE(start) =" . $this->db->escape($date);
        $this->db->query($txt_sql);
    }

    /**
     * \brief      Récupére la couleur d'un événement pour un patient
     * \details    Récupére la couleur d'un événement pour un patient
     * \param      $idPatient : id du patient
     */
    public function getCouleurEventPatient($idPatient) {
        $txt_sql = "SELECT color as couleur
                    FROM evenement e
                    WHERE e.patientId = " . $this->db->escape($idPatient);

        $query = $this->db->query($txt_sql);

        $row = $query->row_array();

        return $row['couleur'];
    }

    /**
     * \brief      Permet de sauvegarder le planning
     * \details    Sauvegarde le planning (suppresion des événement déha planifié)
     * \param      Aucun
     */
    public function sauvegarderPlanning() {
        $txt_sql = "DELETE FROM ordonnancer";
        $this->db->query($txt_sql);

        $txt_sql = "INSERT INTO ordonnancer SELECT * FROM evenement";
        $this->db->query($txt_sql);
    }

    /**
     * \brief      Permet de restaurer un planning (chargement de la dernière sauvegarder)
     * \details    La restauration d'un planning entraine la suppression des modifications non enregistrés
     * \param      Aucun
     */
    public function restaurerPlanning() {
        $txt_sql = "DELETE FROM evenement";
        $this->db->query($txt_sql);

        $txt_sql = "INSERT INTO evenement SELECT * FROM ordonnancer";
        $this->db->query($txt_sql);
    }

}
