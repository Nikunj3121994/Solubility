<?php
//pr($data);//pr($type);
if(!is_array($data))
{
	echo "<h3>".$data."</h3>";
}
else
{
	$chemical=$data['Chemical'];
	$tables=[];
	if(isset($data['System']))
	{
		$systems=$data['System'];
		foreach($systems as $system)
		{
			if(isset($system['Table']))
			{
				foreach($system['Table'] as $table) { $tables[]=$table; }
			}
		}
	}
    echo "<div id='meta' style='float: left;width: 500px;'>";
    ?>
	<h2><?php echo $chemical['name']; ?></h2>
	<?php
	if(isset($chemical['formula']))		{ echo "<h4>Chemical Formula: ".$chemical['formula']."</h4>"; }
	if(isset($chemical['casrn']))		{ echo "<h4>CAS Registry Number: ".$chemical['casrn']."</h4>"; }
    if(isset($chemical['inchikey']))	{ echo "<h4>InChI Key: ".$chemical['inchikey']."</h4>"; }
    //if(isset($chemical['inchi']))		{ echo "<h4>InChI String: ".$chemical['inchi']."</h4>"; }
    // Systems
    if(isset($systems))
    {
        echo "<div style='margin-bottom: 10px;'>";
        echo "<h3>Solubility Data Sources</h3>\n";
        echo '<ul>';
        foreach($systems as $system)
        {
            echo "<li>".$this->Html->link($system['title'],'/systems/view/'.$system['sysID'])."</li>";
        }
        echo "</ul></div>";
    }
    // Download
    echo "<h3>Download This Data As</h3>\n";
    echo "<p>";
    echo $this->Html->link($this->Html->image('xml.png',['height'=>'50','alt'=>'XML']),$base.'chemicals/view/'.$chemical['id'].'/xml',['escape'=>false,'target'=>'_blank'])."&nbsp;&nbsp;&nbsp;";
    echo $this->Html->link($this->Html->image('json.png',['height'=>'50','alt'=>'JSON']),$base.'chemicals/view/'.$chemical['id'].'/json',['escape'=>false,'target'=>'_blank'])."&nbsp;&nbsp;&nbsp;";
    echo $this->Html->link($this->Html->image('jsonld.png',['height'=>'50','alt'=>'JSON-LD']),$base.'chemicals/view/'.$chemical['id'].'/jsonld',['escape'=>false,'target'=>'_blank']);
    echo "</p>";
    echo "</div>";
    echo "<div id='chemical' class='chemical' style='float: left'>";
	echo "<script type='text/javascript'>\n";
	echo "  var Info = { color: '#000000', height: 290, width: 300, use: 'HTML5', defaultModel: '$".$chemical['name']."', j2sPath: '/solubility/js/jsmol/j2s' };\n";
	echo "  Jmol.getTMApplet('chem', Info);\n";
	echo "</script>\n";
    echo "<p style='margin-top: 10px;'>View molecule on ";
    echo $this->Html->link('Webbook','http://webbook.nist.gov/cgi/cbook.cgi?ID='.$chemical['casrn'],['target'=>'_blank']).", ";
    echo $this->Html->link('ChemSpider','http://www.chemspider.com/Search.aspx?q='.$chemical['inchi'],['target'=>'_blank']);
    echo "</p>";
    echo "</div>";
	echo "<div class='floatreset'></div>";
	?>
	<p style="margin: 0px;font-style: italic;"><?php echo "<br>Information obtained from ".$this->Html->link('The NIST Solubility Database',$nist.'sol_casno.aspx?STR='.$chemical['casrn'].'&OPTION=CASNO&COMP=1',['target'=>'_blank']);?></p>
<?php
}
?>