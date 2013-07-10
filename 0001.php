<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php

mb_http_input("utf-8");

mb_http_output("utf-8");

?>
<script language="JavaScript">

</script>
<label>
        <select name="type" onchange="show()">
          <option>請選擇類型</option>
          <option value="0">A</option>
          <option value="1">B</option>
        </select>
        <id="type_A" style="position:absolute; z-index:1; visibility: hidden; ">
        <select name="type_value">
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>        
        </select>
        < id="type_B" style="position:absolute; z-index:1; visibility: hidden; ">
        <select name="type_value">
          <option value="4">4</option>
          <option value="5">5</option>
          <option value="6">6</option>          
        </select>
        
        </label>