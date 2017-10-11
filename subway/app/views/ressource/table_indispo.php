<table id="mytable" class="table table-responsive table-hover" >

    <tbody id="dataform">
    <div>
        <?php
        $i = 0;
        foreach ($indispo as $row) {
            ?>
            <tr><!-- une ligne 'une indisponibilité"-->
                <td><!-- date début -->
                    <div class="form-group row ">
                        <label for="heureDebut" class="col-md-2 control-label">Date début</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control select-date" name="datedebut_<?php echo $i ?>" id="heureDebut"  value="<?php echo $row["date_debut"] ?>">
                        </div>
                    </div>
                </td>
                <td><!-- date fin -->
                    <div class="form-group row ">
                        <label for="heureFin" class="col-md-2 control-label">Date Fin</label>
                        <div class="col-md-8">
                            <input type="text" class="select-date form-control select-date" name="datefin_<?php echo $i ?>" id="datefin_<?php echo $i ?>"  value="<?php echo $row["date_fin"] ?>">
                        </div>
                    </div>
                </td>

                <td><button type="button" class="btn btn-default btn-xs" onclick="deleteIndispo(<?php echo $row["id_eindispo"] ?>)"><span class="glyphicon glyphicon-trash"></span></button></td>

                <!-- ces deux "input" sont pour enregistrer id_indisponiblité et id_personnel utilisés lors changement de BdD-->
            <input name="id_indispo_<?php echo $i ?>" type="hidden" value="<?php echo $row["id_eindispo"] ?>"/>
            <input name="id_personnel_<?php echo $i ?>" type="hidden" value="<?php echo $id_personnel ?>"/>
            </tr>
            <?php $i++;
        } ?>  
        <tr><input name="nb_indispo" type="hidden" value="<?php echo $i ?>"/></tr>
        <tr>
            <td><button type="button" class="btn btn-primary btn-xm" onclick="ajoutIndispo()"><span class="glyphicon glyphicon-plus"></span> Ajouter une indisponibilité</button>
            </td><td></td><td></td>
        </tr>

    </div>
</tbody>
</table>