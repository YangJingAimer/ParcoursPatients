<div class="div-content-onglet">

    <div class="jumbotron col-md-12">
        <h3>Dossier parcours de <?php echo $dossierParcours["txt_nom"] . " " . $dossierParcours["txt_prenom"]; ?></h3>

        <div class="pop-up-maj">

        </div>


        <div class="col-md-2">

            <ul class="nav nav-pills nav-stacked">
                <?php
                foreach ($dossierParcours["dossierParcours"] as $dossier) {
                    if ($dossier["id_dossierparcours"] == $dossierParcours["id_dparcour_afficher"]) {
                        ?>
                        <li class="active col-md-12 dossier-parcours" data-dparcours="<?php echo $dossier["id_dossierparcours"]; ?>"><a href="#"><?php echo $dossier["date_disponible_debut"]; ?></a></li>
                    <?php
                    } else {
                        ?>
                        <li class="col-md-12 dossier-parcours" data-dparcours="<?php echo $dossier["id_dossierparcours"]; ?>"><a href="#"><?php echo $dossier["date_disponible_fin"]; ?></a></li>
                    <?php }
                }
                ?>
            </ul>

        </div>
        <div class="col-md-10">
            <div class="row">
               
                <ul class="nav nav-tabs">
                    <?php
                    foreach ($dossierParcours["dossierParcours"] as $dossier) {
                        if ($dossier["id_dossierparcours"] == $dossierParcours["id_dparcour_afficher"]) {
                            foreach ($dossier["onglets"] as $onglet) {
                                if ($onglet["id_onglet"] == $dossierParcours["id_onglet_afficher"]) {
                                    ?> 
                                    <li class="active onglet" data-onglet="<?php echo $onglet["id_onglet"]; ?>"><a href="#"><?php echo $onglet["txt_onglet"]; ?></a></li>
                                <?php
                                } else {
                                    ?>
                                    <li class="onglet" data-onglet="<?php echo $onglet["id_onglet"]; ?>"><a href="#"><?php echo $onglet["txt_onglet"]; ?></a></li>
                                <?php
                                }
                            }
                        }
                    }
                    ?>
                </ul>
            </div>
            <div class="row">
                <form id="formDossierParcours" class="form-horizontal col-md-12">

                    <?php
                    foreach ($dossierParcours["dossierParcours"] as $dossier) {
                        if ($dossier["id_dossierparcours"] == $dossierParcours["id_dparcour_afficher"]) {
                            foreach ($dossier["onglets"] as $onglet) {
                                if ($onglet["id_onglet"] == $dossierParcours["id_onglet_afficher"]) {
                                    ?>
                                    <?php
                                    foreach ($onglet["champs"] as $champ) {
                                        echo str_replace("!!VALEUR!!", $champ["txt_valeur"], str_replace("!!NOM!!", $champ["txt_champ"], str_replace("!!ID!!", $champ["id_champ"], $champ["txt_typeChamp"])));
                                    }
                                    ?>
                                <?php
                                }
                            }
                        }
                    }
                    ?> 

                    <div class="form-group row">
                        <div class="col-md-10">
                            
                            <button class="btn btn-primary ajout-champ" ><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Ajouter un nouveau champ pour l'onglet</button>
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class=" col-md-10"></div>
                        <div class="pull-right col-md-2">
                            
                            
                                                                                
                            <button type="submit" class="btn btn-success" ><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Sauvegarder</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>