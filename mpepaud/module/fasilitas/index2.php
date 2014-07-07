<? 
include 'inc/conn.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="keywords" content="jquery,ui,easy,easyui,web">
	<meta name="description" content="easyui help you build your web page easily!">
<title>.: MPE Paud | Fasilitas :.</title>
	<script type="text/javascript">
		var url;
		function newUser(){
			$('#dlg').dialog('open').dialog('setTitle','Input Fasilitas');
			$('#fm').form('clear');
			url = 'module/fasilitas/save_fasilitas.php';
		}
		function editUser(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$('#dlg2').dialog('open').dialog('setTitle','Ubah Fasilitas','fullScreen','true');
				$('#fm2').form('load',row);
				url = 'module/fasilitas/update_fasilitas.php?id='+row.Id_Fas;
			}
		}
		function saveUser(){
			$('#fm').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
						$('#dlg').dialog('close');		// close the dialog
						$('#dg').datagrid('reload');	// reload the user data
					} else {
						$.messager.show({
							title: 'Error',
							msg: result.msg
						});
					}
				}
			});
		}
        
        function saveEditUser(){
			$('#fm2').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
						$('#dlg2').dialog('close');		// close the dialog
						$('#dg').datagrid('reload');	// reload the user data
					} else {
						$.messager.show({
							title: 'Error',
							msg: result.msg
						});
					}
				}
			});
		}
		
		function doSearch(){
    		$('#dg').datagrid('load',{
        		paud: $('#pauds').val()
			})
		}
		
		function removeUser(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$.messager.confirm('Konfirmasi','Anda yakin akan menghapus data Fasilitas ini?',function(r){
					if (r){
						$.post('module/fasilitas/remove_fasilitas.php',{id:row.Id_Fas, id_paud:row.id_paud},function(result){
							if (result.success){
								$('#dg').datagrid('reload');	// reload the user data
							} else {
								$.messager.show({	// show error message
									title: 'Error',
									msg: result.msg
								});
							}
						},'json');
					}
				});
			}
		}
	</script>
    <script>
    function myformatter(date){
            var y = date.getFullYear();
            var m = date.getMonth()+1;
            var d = date.getDate();
            return y+'-'+(m<10?('0'+m):m)+'-'+(d<10?('0'+d):d);
        }
        function myparser(s){
            if (!s) return new Date();
            var ss = (s.split('-'));
            var y = parseInt(ss[0],10);
            var m = parseInt(ss[1],10);
            var d = parseInt(ss[2],10);
            if (!isNaN(y) && !isNaN(m) && !isNaN(d)){
                return new Date(y,m-1,d);
            } else {
                return new Date();
            }
        }
    </script>
</head>
<body>
	<table id="dg" title="Data Fasilitas" class="easyui-datagrid"
			url="module/fasilitas/get_fasilitas.php"
			toolbar="#toolbar" pagination="true"
			rownumbers="true" fitColumns="true" singleSelect="true">
	  <thead>
			<tr>
				<th field="Id_Fas" width="50">Id Fasilitas</th>
				<th field="Nama_fas" width="50">Nama Fasilitas</th>
                <th field="id_paud" width="50">Id Paud</th>
            </tr>
		</thead>
	</table>
	<div id="toolbar">
		<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">Input Fasilitas</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">Ubah Fasilitas</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="removeUser()">Hapus Fasilitas</a>
        <hr>
        <!-- SEARCH BOX --->
    	   <span>Paud:</span>
    	   <select name="pauds" id="pauds" class="easyui-validatebox" style="width: 200px; height:25px;">
            <option value="">--Pilih Paud--</option>
            <? 
            $sql=mysql_query("select id_paud, nama_paud from data_paud");
            while($data=mysql_fetch_array($sql)) {
            ?>
            <option value="<?=$data['id_paud']?>"><?=$data['nama_paud']?></option>
            <? } ?>
            </select>
    	<a href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="doSearch()">Search</a>
        <!-- END OF SEARCH BOX --->
        <hr>
	</div>
	<!-- INPUT BOX --->
    
	<div id="dlg" class="easyui-dialog" style="width:400px;height:300px;padding:10px 20px"
			closed="true" buttons="#dlg-buttons">
		<div class="ftitle">Input Fasilitas</div>
		<form id="fm" method="post" novalidate>
            <div class="fitem">
            <label>Fasilitas:</label>&nbsp;
            <input class="easyui-validatebox" name="fasilitas" required style="width:150px; height:18px;">
            </div>
            <div class="fitem">
            <label>PAUD:</label>&nbsp;
            <select name="paud" id="paud" class="easyui-validatebox" style="width: 200px; height:25px;">
            <option value="">--Pilih Paud--</option>
            <? 
            $sql=mysql_query("select id_paud, nama_paud from data_paud");
            while($data=mysql_fetch_array($sql)) {
            ?>
            <option value="<?=$data['id_paud']?>"><?=$data['nama_paud']?></option>
            <? } ?>
            </select>
            </div>
		</form>
	</div>
    
	<div id="dlg-buttons">
		<a href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveUser()">Save</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')">Cancel</a>
	</div>
    
    <!-- END OF INPUT BOX --->
    
    <!-- EDIT BOX --->
    
	<div id="dlg2" class="easyui-dialog" style="width:400px;height:300px;padding:10px 20px"
			closed="true" buttons="#dlg-buttons">
		<div class="ftitle">Ubah Fasilitas</div>
		<form id="fm2" method="post" novalidate>
            <div class="fitem">
            <label>Id:</label>&nbsp;
            <input class="easyui-validatebox" name="Id_Fas" readonly="readonly" required style="width:150px; height:18px;">
            </div>
            <div class="fitem">
            <label>Fasilitas:</label>&nbsp;
            <input class="easyui-validatebox" name="Nama_fas" required style="width:150px; height:18px;">
            </div>
            <div class="fitem">
            <label>PAUD:</label>&nbsp;
            <select name="id_paud" id="id_paud" class="easyui-validatebox" style="width: 200px; height:25px;">
            <option value="">--Pilih Paud--</option>
            <? 
            $sql=mysql_query("select id_paud, nama_paud from data_paud");
            while($data=mysql_fetch_array($sql)) {
            ?>
            <option value="<?=$data['id_paud']?>"><?=$data['nama_paud']?></option>
            <? } ?>
            </select>
            </div>
		</form>
	</div>
    
	<div id="dlg-buttons">
		<a href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveEditUser()">Save</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg2').dialog('close')">Cancel</a>
	</div>
    
    <!-- END OF EDIT BOX --->
    
</body>
</html>