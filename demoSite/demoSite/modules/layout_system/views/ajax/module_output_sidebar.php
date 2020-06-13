<?foreach ($objects as $object):?>
        <li><a class="select-output-<?=$block_id?>" object-id="<?=$object->id?>"><?=$object->name?></a></li>
<?endforeach;?>
