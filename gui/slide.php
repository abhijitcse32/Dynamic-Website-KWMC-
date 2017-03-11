<div id="slider" class="nivoSlider">
	<?php 
			$sql="SELECT * FROM slide ORDER BY SortID";
			$oResultUp=$oBasic->SqlQuery($sql);
	?>
	
	<?php
		for($i=0;$i<$oResultUp->num_rows;$i++){ ?>
			<img src="images/<?php echo $oResultUp->rows[$i]['Image']?>" alt="">
     <?php } ?>	           
            </div>
            <div id="htmlcaption" class="nivo-html-caption">
                <strong>This</strong> is an example of a <em>HTML</em> caption with <a href="#">a link</a>.
            </div>