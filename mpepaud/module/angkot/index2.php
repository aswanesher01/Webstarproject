<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="keywords" content="jquery,ui,easy,easyui,web">
	<meta name="description" content="easyui help you build your web page easily!">
	<title>Anugrah Jaya Steel | User Management</title>
	<script type="text/javascript">
		var url;
		function newUser(){
			$('#dlg').dialog('open').dialog('setTitle','New User');
			$('#fm').form('clear');
			url = 'module/angkot/save_angkot.php';
		}
		function editUser(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$('#dlg2').dialog('open').dialog('setTitle','Edit User');
				$('#fm2').form('load',row);
				url = 'module/angkot/update_angkot.php?id='+row.Kode_ang;
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
        		rute: $('#rutes').val()
			})
		}
        
		function removeUser(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$.messager.confirm('Konfirmasi','Anda yakin akan menghapus jalur angkot ini?',function(r){
					if (r){
						$.post('module/angkot/remove_angkot.php',{id:row.Kode_ang},function(result){
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
</head>
<body>
	<table id="dg" title="Data Angkot" class="easyui-datagrid"
			url="module/angkot/get_angkot.php"
			toolbar="#toolbar" pagination="true"
			rownumbers="true" fitColumns="true" singleSelect="true">
	  <thead>
			<tr>
				<th field="Kode_ang" width="50">Kode Angkot</th>
				<th field="asal" width="50">Asal</th>
				<th field="Tiba" width="50">Tiba</th>
				<th field="Rute" width="50">Rute</th>
			</tr>
		</thead>
	</table>
	<div id="toolbar">
		<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">Input Jalur Angkot</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">Ubah Jalur Angkot</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="removeUser()">Hapus Jalur Angkot</a>
		<hr>
        <!-- SEARCH BOX --->
        <span>Cari Rute:</span>
    	<input id="rutes" style="line-height:20px;border:1px solid #ccc">
        <a href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="doSearch()">Search</a>
        <!-- END OF SEARCH BOX --->
    	<hr>
    </div>
    
    <!-- INPUT ANGKOT BOX --->
    
	<div id="dlg" class="easyui-dialog" style="width:400px;height:280px;padding:10px 20px"
			closed="true" buttons="#dlg-buttons">
		<div class="ftitle">Tambah Angkot</div>
		<form id="fm" method="post" novalidate>
			<div class="fitem">
				<label>Asal:</label>
				<input name="asal" class="easyui-validatebox" required="true">
			</div>
			<div class="fitem">
				<label>Tiba:</label>
				<input name="tiba" class="easyui-validatebox" required="true">
			</div>
            <div class="fitem">
				<label>Rute:</label>
				<input name="rute" class="easyui-validatebox" required="true">
			</div>
		</form>
	</div>
	<div id="dlg-buttons">
		<a href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveUser()">Save</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')">Cancel</a>
	</div>
    
    <!-- END OF INPUT ANGKOT BOX --->
    
    <!-- EDIT ANGKOT BOX --->
    
	<div id="dlg2" class="easyui-dialog" style="width:400px;height:280px;padding:10px 20px"
			closed="true" buttons="#dlg-buttons">
		<div class="ftitle">Ubah Angkot</div>
		<form id="fm2" method="post" novalidate>
            <div class="fitem">
				<label>Kode Angkot:</label>
				<input name="Kode_ang" readonly="readonly" class="easyui-validatebox" required="true">
			</div>
			<div class="fitem">
				<label>Asal:</label>
				<input name="asal" class="easyui-validatebox" required="true">
			</div>
			<div class="fitem">
				<label>Tiba:</label>
				<input name="Tiba" class="easyui-validatebox" required="true">
			</div>
            <div class="fitem">
				<label>Rute:</label>
				<input name="Rute" class="easyui-validatebox" required="true">
			</div>
		</form>
	</div>
	<div id="dlg-buttons">
		<a href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveEditUser()">Save</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg2').dialog('close')">Cancel</a>
	</div>
    
    <!-- END OF EDIT ANGKOT BOX --->
    
</body>
</html>