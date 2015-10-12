
<div class="upload">
    <b>Multiple Upload form</b><br/>
    <?=$error?>
    <?=form_open_multipart('upload/');?> 
        <?php for ($i = 1; $i <=8; $i++): ?>
                <div class="form_element">
                    <label for="photo<?=$i?>">File <?=$i?></label>
                    <?=form_upload(array('name'     => 'userfile'.$i,
                                        'size'      => '36'))?>
                </div>
        <?php endfor ?>
        <input type="submit" value="Upload" name="go_upload"/>
    <?=form_close();?>  
</div>
<div>
    <?php
    $ret = '';
    if($result !=''){
        foreach ($result as $item){
            $image_filename = $item['file_name'];
            $image_size = $item['file_size'];
            $image_width = $item['image_width'];
            $image_height = $item['image_height'];
            
            $ret.='<div class="result">';
            $ret.= $image_filename.'<br/>';
            $ret.= img('images/uploaded/'.$image_filename);
            $ret.= '<br/>';
            $ret.= '<span style="">'.$image_width.' x '.$image_height.' ('.$image_size.'kb)</span>';
            $ret.='</div>';
        }
    }
    echo $ret;
    //print_r($result);
    ?>
</div>


