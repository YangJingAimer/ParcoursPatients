<div class="div-content-onglet">

    <div class="jumbotron col-md-12">
        <h3><?php if ($id != -1) {
    echo 'Modifier';
} else {
    echo 'Ajouter';
} ?> une activité</h3>

        <div class="row">
            <fieldset class="col-md-12">

                <legend></legend>
                <div class="form-group">
                    <label for="nom" class="col-sm-2 control-label" >Nom Activité</label>
                    <div class="col-sm-10">
                        <input type="hidden" id="id" value="<?php echo $id; ?>">
                        <input type="text" class="form-control" id="nom" placeholder="Entrez le nom de l'activité"  value="<?php echo $nom; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="duree" class="col-sm-2 control-label">Durée (en minutes)</label>
                    <div class="col-sm-10">
                        <input type="number" min=0 class="form-control" id="duree" placeholder="Entrez la durée (en minutes)"  value="<?php echo $duree; ?>">
                    </div>
                </div> 

                <div class="form-group">
                    <label for="commentaire" class="col-sm-2 control-label">Commentaires</label>
                    <div class="col-sm-10">
                        <textarea  class="form-control" id="commentaire" placeholder="Entrez un commentaire"><?php echo $comm; ?></textarea>
                    </div>
                </div> 

            </fieldset>
        </div>

        <div class="row">
            <fieldset class="col-md-6">
                <legend>Personnels</legend>

                <div class="form-group">
                    <label for="typePerso" class="col-xs-4 control-label">Type Personnels</label>
                    <div class="col-xs-6">
                        <input type="text" class="form-control" name="typePerso" id="typePerso" placeholder="Entrez un type" value="">
                        <input type="hidden" name="idTypePerso" id="idTypePerso" value="-1">
                    </div>

                    <div class="col-xs-2">
                        <button class="btn btn-primary" id="submitAddPerso"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
                    </div>
                </div>
                <div>
                    <table name="perso" id="tablePerso" class="table table-responsive table-hover">
                        <thead>  <tr><th hidden></th><th class="col-sm-6">Nom type</th><th class="col-sm-2">Quantite</th><th class="col-sm-1"></th></tr> </thead>
                        <tbody>
<?php $i = 0; ?> <?php foreach ($personnels as $row) { ?>
                                <tr class="type">
                                    <td hidden><input class="idType" value="<?php echo $row['id_type'] ?>"></td>
                                    <td  class="col-sm-6"><?php echo $row["nom_type"] ?></td>
                                    <td  class="col-sm-2"><input type="number" min=1 class="qte form-control" required value="<?php echo $row["qte"] ?>"></td>
                                    <td class="col-sm-1"><button class="btn btn-danger submitDelPerso"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button></td>
                                </tr>
    <?php $i++;
} ?>
                        </tbody>
                    </table>
                    <div>
                    </div>
                </div>
            </fieldset>


            <fieldset class="col-md-6">
                <legend>Ressources Matérielles</legend>
                <div class="form-group">
                    <label for="typeRes" class="col-xs-4 control-label">Type Ressources Matérielles</label>
                    <div class="col-xs-6">
                        <input type="text" class="form-control" name="typeRes" id="typeRes" placeholder="Entrez un type" value="">
                        <input type="hidden" name="idTypeRes" id="idTypeRes" value="-1">           </div>

                    <div class="col-xs-2">
                        <button class="btn btn-primary  " id="submitAddRes"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
                    </div>
                </div>
                <div>
                    <table name="ressourceMat" id="tableRes" class="table table-responsive table-hover">
                        <thead>  <tr><th hidden></th><th class="col-sm-6">Nom type</th><th class="col-sm-2">Quantite</th><th class="col-sm-1"></th></tr><tr></tr> </thead>
                        <tbody>
<?php foreach ($ressourcesMat as $row) { ?>
                                <tr class="type">
                                    <td hidden><input class="idType" value="<?php echo $row['id_type'] ?>"></td>
                                    <td  class="col-xs-6"><?php echo $row["nom_type"] ?></td>
                                    <td  class="col-xs-2"><input type="number" min=1 class="qte form-control" required value="<?php echo $row["qte"] ?>"></td>
                                    <td class="col-xs-1"><button class="btn btn-danger submitDelRes"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button></td>
                                </tr>
<?php } ?>
                        </tbody>
                    </table>
                    <div>
                    </div>
            </fieldset>

        </div>

        <div class="row">
            <div class=" col-md-6 "></div>
            <div class="pull-right col-md-4">

                <button id= "validAddActivite" type="submit" class="btn btn-success" ><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Confirmer </button>
                <button id="resetAddActivite" class="btn btn-danger" ><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Annuler </button>

            </div>
        </div>

    </div>
</div>
</div>
</div>
<script type="text/javascript">
// Personnels

// autocomplete
    $('#typePerso').autocomplete({
        source: '<?php echo base_url("Activites/getTypesPerso"); ?>',
        select: function (event, ui) {
            $('#idTypePerso').attr('value', ui.item.id);
        }
    });

// Ajout d'une ressource au tableau
    $('body').on('click', "#submitAddPerso", function (event) {
        event.preventDefault();
        if ($("#idTypePerso")[0].value != -1 && !existsInPerso($("#idTypePerso")[0].value))
        {
            // on ajoute la ligne correspondante
            $('#tablePerso tbody').append("<tr>" +
                    "<td hidden><input class='idType' value='" + $("#idTypePerso")[0].value + "'></td>" +
                    "<td  class='col-sm-6 typePerso'>" + $("#typePerso")[0].value + "</td>" +
                    "<td  class='col-sm-2'><input type='number' min=1 class='form-control qte' required value=1></td>" +
                    "<td  class='col-sm-1'><button class='btn btn-danger submitDelPerso'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span></button></td>" +
                    "</tr>");
        }
        $('body').on('click', ".submitDelPerso", function (event) {
            event.preventDefault();
            $(this).parent().parent().remove();
        });

// suppression de la ressource
    });

// on vérifie si la ressource n'est pas déjà dans le tableau
    function existsInPerso(value)
    {
        res = false;
        $("#tablePerso > tbody > tr .idType").each(function ()
        {
            val = $(this)[0].value;
            if (value == val)
                res = true;
        });
        return res;
    }

// Ressources Matérielles
// autocomplete
    $('#typeRes').autocomplete({
        source: '<?php echo base_url("Activites/getTypesRessourcesMat"); ?>',
        select: function (event, ui) {
            $('#idTypeRes').attr('value', ui.item.id);
        }
    });

// Ajout d'une ressource au tableau
    $('body').on('click', "#submitAddRes", function (event) {
        event.preventDefault();
        if ($("#idTypeRes")[0].value != -1 && !existsInRes($("#idTypeRes")[0].value))
        {
            // on ajoute la ligne correspondante
            $('#tableRes tbody').append("<tr>" +
                    "<td hidden><input class='idType' value='" + $("#idTypeRes")[0].value + "'></td>" +
                    "<td  class='col-sm-6 typeRes'>" + $("#typeRes")[0].value + "</td>" +
                    "<td  class='col-sm-2'><input type='number' min=1 class='form-control qte' required value=1></td>" +
                    "<td  class='col-sm-1'><button class='btn btn-danger submitDelRes'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span></button></td>" +
                    "</tr>");
        }
    });

// suppression de la ressource
    $('body').on('click', ".submitDelRes", function (event) {
        event.preventDefault();
        $(this).parent().parent().remove();
    });

// on vérifie si la ressource n'est pas déjà dans le tableau
    function existsInRes(value)
    {
        res = false;
        $("#tableRes > tbody > tr .idType").each(function ()
        {
            val = $(this)[0].value;
            if (value == val)
                res = true;
        });
        return res;
    }




</script>
