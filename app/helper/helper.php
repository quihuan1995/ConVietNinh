<?php
function showErrors($errors,$name){
    if ($errors->has($name)){
        echo '<div class="alert alert-danger" role="alert" >';
        echo '<strong>'.$errors->first($name).'</strong>';
        echo '</div>';
    }
}

function GetCate($mang,$name,$tab,$id_select){
    foreach($mang as $val){
        if($val->name==$name)
	    {
            if($val->id==$id_select){
                echo "<option selected value='$val->id'>".$tab.$val->categories."</option>";
            }else{
                echo "<option value='$val->id'>".$tab.$val->categories."</option>";
            }
		GetCate($mang,$val->id,$tab.'---|',$id_select);

	    }
    }
}
function OrderCate($mang,$name,$tab){
    foreach($mang as $val){
        if($val->name==$name){
             echo "<option value='$val->id'>",$tab.$val->categories."</option>";
             OrderCate($mang,$val->id,$tab.'---|',0);
        }
    }
}
function GetUserA($mang, $id_select)
{
    foreach ($mang as $val) {
        if ($val->id==$id_select) {
            echo "<option selected value='$val->id'>".$val->name."</option>";
        } else {
            echo "<option value='$val->id'>".$val->name."</option>";
        }
    }
}
function GetUserB($mang,$id_select){
    foreach($mang as $val){
        if($val->id==$id_select){
            echo "<option selected value='$val->id'>".$val->name."</option>";
        }else{
            echo "<option value='$val->id'>".$val->name."</option>";
        }
    }
}
function GetUserC($mang,$id_select){
    foreach($mang as $val){
        if($val->id==$id_select){
            echo "<option selected value='$val->id'>".$val->name."</option>";
        }else{
            echo "<option value='$val->id'>".$val->name."</option>";
        }
    }
}