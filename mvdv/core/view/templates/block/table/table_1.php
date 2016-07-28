<!--<table <?php // if (isset($this->tableid)) {  ?>id="<?php //echo $data->table->id;  ?>" <?php //}  ?>class="DTtable">-->
<div <?php foreach($this->dataattributes as $key =>$value){?> data-<?php echo $key ?>="<?php echo $value?>"<?php }?>>
    
<table border="0" class="DTtable">
    <thead>
        <tr>
            <?php foreach ($this->columnnames as $columnname) { ?>
                <th>
                    <?php echo $columnname ?>
                </th>
            <?php } ?>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
</div>