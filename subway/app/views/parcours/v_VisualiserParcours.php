<div class="container-fluid">
    <div class="jumbotron">
        <div class="row">
            <div class="col-md-12">
                <fieldset>
                    <legend>Visualiser précédence</legend>
                    <table id="visualiserRang" class="table table-responsive table-hover">
                        <thead>  <tr><th hidden></th><th class="col-sm-6">Activité</th><th class="col-sm-6">Activité Précédente</th></tr> </thead>
                        <tbody>
                            <?php
                            foreach ($activites as $a) {
                                ?>
                                <tr>
                                    <td hidden><input class='idActivites' name='idActivites[]' value='<?php echo $a['id_activite'] ?>'</td>
                                    <td class="col-sm-3"><?php echo $a['nom_activite'] ?></td>
                                    <td class="col-sm-3"><?php
                                        foreach ($a["prec"] as $prec) {
                                            echo $prec["nom_prec"] . " , ";
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </fieldset>
            </div>
            <div class="col-md-12">
                <fieldset>
                    <legend>Visualiser Parcours</legend>
                    <div id="myDiagramDiv" style="width:1000px; height:600px; background-color: #DAE4E4;"></div>
                </fieldset>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var $ = go.GraphObject.make;  // for more concise visual tree definitions
    var blue = "#0288D1";
    myDiagram =
            $(go.Diagram, "myDiagramDiv",
                    {
                        initialAutoScale: go.Diagram.Uniform,
                        initialContentAlignment: go.Spot.Center,
                        layout: $(go.LayeredDigraphLayout)
                    });

    myDiagram.nodeTemplate =
            $(go.Node, "Auto",
                    $(go.Shape, "Rectangle", // the border
                            {fill: "white", strokeWidth: 3},
                            new go.Binding("fill", "critical", function (b) {
                                return (b ? pinkfill : bluefill);
                            }),
                            new go.Binding("stroke", "critical", function (b) {
                                return (b ? pink : blue);
                            })),
                    $(go.Panel, "Table",
                            {padding: 0.5},
                            $(go.RowColumnDefinition, {column: 1, separatorStroke: "black"}),
                            $(go.RowColumnDefinition, {column: 2, separatorStroke: "black"}),
                            $(go.RowColumnDefinition, {row: 1, separatorStroke: "black", background: "white", coversSeparators: true}),
                            $(go.RowColumnDefinition, {row: 2, separatorStroke: "black"}),
                            $(go.TextBlock,
                                    new go.Binding("text", "text"),
                                    {row: 1, column: 0, columnSpan: 3, margin: 5,
                                        textAlign: "center", font: "bold 14px sans-serif"})
                            )  // end Table Panel
                    );  // end Node

    function linkColorConverter(linkdata, elt) {
        var link = elt.part;
        if (!link)
            return blue;
        var f = link.fromNode;
        if (!f || !f.data || !f.data.critical)
            return blue;
        var t = link.toNode;
        if (!t || !t.data || !t.data.critical)
            return blue;
        return pink;  // when both Link.fromNode.data.critical and Link.toNode.data.critical
    }

    myDiagram.linkTemplate =
            $(go.Link,
                    {toShortLength: 6, toEndSegmentLength: 20},
                    $(go.Shape,
                            {strokeWidth: 4},
                            new go.Binding("stroke", "", linkColorConverter)),
                    $(go.Shape, // arrowhead
                            {toArrow: "Triangle", stroke: null, scale: 1.5},
                            new go.Binding("fill", "", linkColorConverter))
                    );

    //activites
    var nodeDataArray = <?php echo $listeActivites; ?>;

    //listeActivites
    var linkDataArray = <?php echo $listePrecedences; ?>;

    myDiagram.model = new go.GraphLinksModel(nodeDataArray, linkDataArray);
</script>