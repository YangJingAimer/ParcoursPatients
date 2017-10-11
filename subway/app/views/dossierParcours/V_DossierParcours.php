<div class="container-fluid affichage-dossier-parcours"  data-patient="<?php echo $dossierParcours["id_patient"]; ?>">
    <?php
    $this->view('/dossierParcours/Div_DossierParcours');
    ?>

    <div class="div-ajout-champ-global hidden">
        <div class="div-ajout-champ">
            <h3>Ajout d'un nouveau champ.</h3>
            <br>
            <div class="form-horizontal col-md-12">	
                <div class="form-group row champ-dossier">
                    <label for="nom-champ" class="col-md-2 control-label">Nom</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" id="nom-champ" value="">
                    </div>
                </div>	
                <div class="form-group row champ-dossier">
                    <label for="type-champ" class="col-md-2 control-label">Type de champ</label>
                    <div class="col-md-10">
                        <select id="select-type-champ" name="select" class="form-control" >
                            <?php
                            $first = true;
                            foreach ($typeChamp as $type) {
                                if ($first) {
                                    ?>
                                    <option value="<?php echo $type["id_typechamp"]; ?>" selected><?php echo $type["txt_libelle"]; ?></option> 
                                    <?php
                                    $first = false;
                                } else {
                                    ?>
                                    <option value="<?php echo $type["id_typechamp"]; ?>"><?php echo $type["txt_libelle"]; ?></option> 
    <?php }
}
?>
                        </select>
                    </div>
                </div>
            </div>

            <input type="text" class="form-control hidden" id="id-champ" value="">
            <div class="pull-right col-md-2">
                <button class="btn btn-success ajouter-champ" ><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Ajouter</button>
            </div>
            <div class="pull-right col-md-2">
                <button class="btn btn-warning annuler-champ" ><span class="glyphicon glyphicon-cross" aria-hidden="true"></span> Annuler</button>
            </div>
        </div>

    </div> <!-- /container -->

    <script type="text/javascript">
        function callAjaxDossierParcours(idOnglet, idDossierParcours)
        {
            //console.log(idOnglet,idDossierParcours);
            $.ajax({
                type: "POST",
                //headers: { 'X-XSRF-TOKEN' : $_token }, 
                data: {"idOnglet": idOnglet, "idDossierParcours": idDossierParcours, "idPatient": $(".affichage-dossier-parcours").data('patient')},
                url: "<?php echo base_url(); ?>DossierParcours/loadOngletAndDossier", //La route
                dataType: "json", //Le type de donnée de retour
                success: function (data) { //La fonction qui est appelée si la requête a fonctionné.
                    //console.log(data);
                    $(".div-content-onglet").html(data);
                    //console.log("test");
                },
                error: function () { //La fonction qui est appelée si une erreur est survenue.
                    $("#post").html('Une erreur est survenue.');
                },
            });
        }

        $('body').on('submit', '#formDossierParcours', function (event) {

            var inputInDossier = [];
            $('.champ-dossier').each(function (index, el) {
                var inp = $(this).find('input');
                var inputDossier = {
                    id: inp.attr('id'),
                    val: inp.val()
                };
                inputInDossier.push(inputDossier);
            });
            var idOnglet = $(".onglet.active").data('onglet');
            var idDossierParcours = $(".dossier-parcours.active").data('dparcours');
            var idPatient = $(".affichage-dossier-parcours").data('patient');
            $.ajax({
                type: "POST",
                //headers: { 'X-XSRF-TOKEN' : $_token }, 
                data: {"inputInDossier": inputInDossier, "idOnglet": idOnglet, "idDossierParcours": idDossierParcours, "idPatient": idPatient},
                url: "<?php echo base_url(); ?>DossierParcours/modifierValeurs", //La route
                dataType: "json", //Le type de donnée de retour
                success: function (data) { //La fonction qui est appelée si la requête a fonctionné.
                    //console.log(data);
                    $(".div-content-onglet").html(data.divAffichage);
                    $(".pop-up-maj").html(data.divAlert);

                    //console.log("test");
                },
                error: function () { //La fonction qui est appelée si une erreur est survenue.
                    $("#post").html('Une erreur est survenue.');
                },
            });
        });

        $('#nom-champ').autocomplete({
            source: '<?php echo base_url(); ?>DossierParcours/getChamp',
            select: function (e, ui) {

                if (ui.item.id_champ > 0)
                {
                    $("#select-type-champ").val(ui.item.id_typechamp).attr('disabled', 'disabled');
                    $("#id-champ").val(ui.item.id_champ);
                } else
                {
                    ui.item.value = (ui.item.value).substring((ui.item.value).indexOf(":") + 2, (ui.item.value).length);
                    $("#select-type-champ").val(ui.item.id_typechamp).removeAttr('disabled');
                    $('#nom-champ').val(ui.item.value);
                    $("#id-champ").val(ui.item.id_champ);
                }
            }
        });


        $('body').on('click', '.ajouter-champ', function (event) {
            event.preventDefault();
            var idOnglet = $(".onglet.active").data('onglet');
            var idDossierParcours = $(".dossier-parcours.active").data('dparcours');
            var idPatient = $(".affichage-dossier-parcours").data('patient');
            var idChamp = $("#id-champ").val();
            var idTypeChamp = $("#select-type-champ").val();
            var nomChamp = $('#nom-champ').val();
            $.ajax({
                type: "POST",
                //headers: { 'X-XSRF-TOKEN' : $_token }, 
                data: {"idOnglet": idOnglet, "idDossierParcours": idDossierParcours,
                    "idChamp": idChamp, "idTypeChamp": idTypeChamp, "nomChamp": nomChamp, "idPatient": idPatient},
                url: "<?php echo base_url(); ?>DossierParcours/ajoutChampDossier", //La route
                dataType: "json", //Le type de donnée de retour
                success: function (data) { //La fonction qui est appelée si la requête a fonctionné.
                    //console.log(data);
                    $(".div-ajout-champ-global").addClass("hidden").removeClass('visibledivVerif');
                    callAjaxDossierParcours(idOnglet, idDossierParcours);
                    //console.log("test");
                },
                error: function () { //La fonction qui est appelée si une erreur est survenue.
                    $("#post").html('Une erreur est survenue.');
                },
            });

        });

    </script>