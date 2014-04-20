
<?php  $data = kite::getInstance('basket')->get('data'); 
		$save = ROOT.kite::route('interface/tools/save.json'); 
    $getcode = ROOT.kite::route('interface/tools/getcode.json'); 
?>

<link rel="stylesheet" href="<?php echo ROOT;?>lib/codemirror-3.21/theme/blackboard.css">
<script src="<?php echo ROOT;?>lib/codemirror-3.21/lib/codemirror.js"></script>
<link rel="stylesheet" href="<?php echo ROOT;?>lib/codemirror-3.21/lib/codemirror.css">
<script src="<?php echo ROOT;?>lib/codemirror-3.21/addon/edit/matchbrackets.js"></script>
<script src="<?php echo ROOT;?>lib/codemirror-3.21/addon/edit/matchtags.js"></script>
<script src="<?php echo ROOT;?>lib/codemirror-3.21/mode/htmlmixed/htmlmixed.js"></script>
<script src="<?php echo ROOT;?>lib/codemirror-3.21/mode/xml/xml.js"></script>
<script src="<?php echo ROOT;?>lib/codemirror-3.21/mode/javascript/javascript.js"></script>
<script src="<?php echo ROOT;?>lib/codemirror-3.21/mode/markdown/markdown.js"></script>
<script src="<?php echo ROOT;?>lib/codemirror-3.21/mode/css/css.js"></script>
<script src="<?php echo ROOT;?>lib/codemirror-3.21/mode/clike/clike.js"></script>
<script src="<?php echo ROOT;?>lib/codemirror-3.21/mode/php/php.js"></script>
<style type="text/css">
      .CodeMirror {padding-top:10px; height:800px;width:100%;overflow-y:auto; }
      dt {font-family: monospace; color: #666;}
      .save_block{
      	background:#2c3e50;
        color:white;
      	padding:20px;
        min-height:40px;
        height: 100%;
      }
      .ftr{
      	height:10px;
      	background:#2c3e50;
      }
      .btn{
        padding:10px 10px;
        background:#27ae60;
        color:white;
        font-weight:bold;
      }
      .rd{
        background:#c0392b;
      }
      .blu{
        background: #2980b9;
      }
      .inpu{
        width:60%;
        min-width:100px;
        opacity:0.8;
        color:white;
      }
      .saved{
        background:#7f8c8d;
        padding:10px;
        color:white;
        font-weight: bold;
      }

      .grn{
        background:#f1c40f;
      }
      .confirmation{
        background:#bdc3c7;
        border-radius:2px;
        
      }
</style>
  <div class="saved" style="display:none">Successfully saved</div>

<div class="save_block">
	<div class="file"> 
    <input type="text" name= "file" id="inpu" class="inpu" placeholder="File relative path" value="<?php echo kite::GetInstance('request')->get('file'); ?>" />
    <button class="btn blu get" >Get</button> <button class="btn save" >Save</button>

</div>
</div>
<textarea id="code" name="code" ><?php echo $data;?></textarea>
<div class="root" val="<?php echo ROOT; ?>"></div>
<div class="save_url" val="<?php echo $save; ?>"></div>
<div class="getcode" val="<?php echo $getcode; ?>"></div>
<div class="ftr">
	</div>
