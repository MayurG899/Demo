<?php
/***********************************************************
* BuilderEngine Community Edition v1.0.0
* ---------------------------------
* BuilderEngine CMS Platform - BuilderEngine Limited
* Copyright BuilderEngine Limited 2012-2017. All Rights Reserved.
*
* http://www.builderengine.com
* Email: info@builderengine.com
* Time: 2017-01-17 | File version: 1.0.0
*
***********************************************************/
?>
<?php foreach($post as $entry):?>
    <div class="grid_4 main-content-thumb">
    <h4>&#151; <?=date("M d, Y",$entry->date_created)?></h4>
    <div class="image-link">
    <a  href="/index.php/module/blog/<?=$entry->id?>">
    </a>
    </div>
    <h3><a  href="/index.php/module/blog/<?=$entry->id?>"><?=$entry->title?></a></h3>
    <!-- <h3><a  href="/index.php/blog/jhgjhg-jhg/">jhgjhg jhg</a></h3> -->
    <p>
    <?=substr($entry->content,0,150)?>
            </p>
    
    </div>
    
<?php endforeach;?>