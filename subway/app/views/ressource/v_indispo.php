<div class="container-fluid">
    <div class="jumbotron">
        <div class="container">
            <div style="padding-bottom:3%"><h3>Les indisponibiltés du personnel : <?php echo $nom_personnel ?></h3></div>
            <form id="newform" role="form" action="<?php echo base_url(); ?>EtreIndispo/savechanges" method="POST">
                <div id="table_indispo">
                    <?php
                    $this->view('/ressource/table_indispo');
                    ?>
                </div>


                <div class="row">
                    <div class="pull-right col-md-4">
                        <button id="btnSubmit" type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Sauvegarder </button>
                        <button type="reset" class="btn btn-danger" onclick="annulerTout()"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Annuler </button>
                    </div>
                </div>
            </form>


        </div>
    </div>
</div>

<script type="text/javascript">

    var nbclick = 1;
    $("body").delegate(".select-date", "focusin", function () {
        $('.select-date').datetimepicker({
            locale: 'fr',
            format: 'YYYY-MM-DD HH:mm:ss'
        });
    });



//supprimer une indisponiblité dans la BdD
    function deleteIndispo(i)
    {
        console.log("delete commence");
        var idPerso = $("input[name^='id_personnel_']").val();

        $.ajax({
            type: "POST",
            data: {"id": i, "idPerso": idPerso},
            url: "<?php echo base_url(); ?>EtreIndispo/supprimerIndispo", //La route
            dataType: "json", //Le type de donnée de retour
            success: function (data) { //La fonction qui est appelée si la requête a fonctionné.
                //console.log(data);
                $("#table_indispo").html(data);
            },
            error: function () { //La fonction qui est appelée si une erreur est survenue.
                $("#post").html('Une erreur est survenue.');
            },
        });
    }
    ;

//ajouter une indisponiblité, appellée en cliquant le bouton "ajouter une indisponibilité"
    function ajoutIndispo()
    {
        var txt =
                '<tr id="' + nbclick + '"><td><div class="form-group row "><label for="heureDebut" class="col-md-2 control-label">Date début</label><div class="col-md-8"><input name="newdatedebut[]" type="text" class="form-control select-date" name="heureDebut" id="heureDebut"></div></div></td><td><div class="form-group row "><label for="heureFin" class="col-md-2 control-label">Date Fin</label><div class="col-md-8"><input name="newdatefin[]" type="text" class="select-date form-control select-date" name="heureFin" id="heureFin"></div></div></td><td><button type="button" class="btn btn-default btn-xs" onclick="annuleAjout(' + nbclick + ')"><span class="glyphicon glyphicon-trash"></span></button></td><input name="id_indispo[]" type="hidden" /><input name="newidpersonnel[]" type="hidden" value=" <?php echo $id_personnel ?>"/></tr>'

        $("#dataform").append(txt);
        nbclick++;
    }

//annuler l'ajout d'une nouvelle indisponibilité
    function annuleAjout(id)
    {
        $('#' + id).remove();
    }

    function annulerTout()
    {
        window.location.reload();
    }

    function saveAll()
    {
        /***
         cette fonction n'est pas servie
         ***/
        var dataformu;
        var backup = $("#newform").html();


        //if( $("#newform").serialize()!="" ){ dataformu = $("#newform").serialize(); }
        //console.log($("#newform").serialize());
        $("#newform").html(" ");
        dataformu = $("#newform").serialize();
        //dataformu = $("#newform").html($('#dataform').html()).serialize();

            	var options = {
                    	url: '<?php echo base_url(); ?>EtreIndispo/savechanges',
                        type: 'post',
                        dataType: 'text',
                        data: dataformu,
            traditional: true,
                        success: function (data) {
                            	if (data.length > 0)
                                    	alert(data);
                        }
                };

        //$("#newform").ajaxSubmit(options);
                $.ajax(options);
        $("#newform").html(backup);

                return false;
    }
</script>