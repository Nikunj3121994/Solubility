<h2>Volumes</h2>
<div>
    <ul>
        <?php
        foreach($data as $volume) {
            $vol=$volume['Volume'];
            echo '<li>'.html_entity_decode($this->Html->link($vol['title'],'/volumes/view/'.$vol['vol'])).'</li>';
        }
        ?>
    </ul>
</div>
<p>&nbsp;</p>
<?php echo "Information obtained from ".$this->Html->link('The NIST Solubility Database',$base.'dataSeries.aspx',['target'=>'_blank']);?>