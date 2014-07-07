<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="keywords" content="jquery,ui,easy,easyui,web">
	<meta name="description" content="easyui help you build your web page easily!">
<title>.: Paud :.</title>
	<script type="text/javascript">
		var url;
		function newUser(){
			$('#dlg').dialog('open').dialog('setTitle','Input Paud');
			$('#fm').form('clear');
			url = 'module/paud/save_paud.php';
		}
		function editUser(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$('#dlg2').dialog('open').dialog('setTitle','Ubah PAUD');
				$('#fm2').form('load',row);
				url = 'module/paud/update_paud.php?id='+row.id_paud;
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
        		idpaud: $('#idpaud').val(),
        		longs: $('#long').val(),
				lats: $('#lat').val()
			})
		}
		
		function removeUser(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$.messager.confirm('Konfirmasi','Anda yakin akan menghapus data PAUD ini?',function(r){
					if (r){
						$.post('module/paud/remove_paud.php',{id:row.id_paud},function(result){
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
	<table id="dg" title="Data Jarak Paud" class="easyui-datagrid"
			url="module/paud/get_paud.php"
			toolbar="#toolbar" pagination="true"
			rownumbers="true" fitColumns="true" singleSelect="true">
	  <thead>
			<tr>
				<th field="id_paud" width="10">ID Paud</th>
				<th field="nama_paud" width="30">Nama Paud</th>
				<th field="Alamat_Paud" width="70">Alamat Paud</th>
                <th field="Latitude" width="30">Latitude</th>
                <th field="longitude" width="30">Longitude</th>
                <th field="jarak" width="30">Jarak (Km)</th>
            </tr>
		</thead>
	</table>
	<div id="toolbar">
		<!--<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">Input PAUD</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">Ubah PAUD</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="removeUser()">Hapus PAUD</a>
        
        <!-- SEARCH BOX --->
        <span>Id PAUD:</span>
    	<input id="idpaud" style="line-height:20px;border:1px solid #ccc">
    	<span>Longitude:</span>
    	<input id="long" style="line-height:26px;border:1px solid #ccc">
        <span>Latitude:</span>
    	<input id="lat" style="line-height:26px;border:1px solid #ccc">
    	<a href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="doSearch()">Search</a>
        <!-- END SEARCH BOX --->
    
    </div>
    
    <!-- INPUT BOX --->
    
	<div id="dlg" class="easyui-dialog" style="width:400px;height:400px;padding:10px 20px"
			closed="true" buttons="#dlg-buttons">
		<div class="ftitle">Input Paud</div>
		<form id="fm" method="post" novalidate>
            <div class="fitem">
            <label>Nama:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input class="easyui-validatebox" name="nama_paud" required style="width:150px">
            </div>
            <div class="fitem">
            <label>Jenis:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <select name="jenis_paud">
            <option value="">-- Pilih Jenis Sekolah --</option>
            <option value="PAUD">PAUD</option>
            <option value="TK">TK</option>
            <option value="RA">RAUDHATUL ANFAL</option>
            </select>
            </div>
            <div class="fitem">
            <label>Alamat Paud:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input class="easyui-validatebox" name="alamat_paud" required style="width:150px">
            </div>
            <div class="fitem">
            <label>Telepon Paud:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input class="easyui-validatebox" name="telepon_paud" required style="width:150px">
            </div>
            <div class="fitem">
            <label>Uang Pangkal:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input class="easyui-validatebox" name="uang_pangkal" required style="width:150px">
            </div>
            <div class="fitem">
            <label>SPP Paud:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input class="easyui-validatebox" name="spp" required style="width:150px">
            </div>
            <div class="fitem">
            <label>Latitude:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input class="easyui-validatebox" name="latitude" required style="width:150px">
            </div>
            <div class="fitem">
            <label>Longitude:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input class="easyui-validatebox" name="longitude" required style="width:150px">
            </div>
		</form>
	</div>
    
	<div id="dlg-buttons">
		<a href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveUser()">Save</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')">Cancel</a>
	</div>
    
    <!-- END OF INPUT BOX --->
    
    
    <!-- EDIT PAUD --->
    <div id="dlg2" class="easyui-dialog" style="width:400px;height:400px;padding:10px 20px"
			closed="true" buttons="#dlg-buttons">
		<div class="ftitle">Ubah PAUD</div>
		<form id="fm2" method="post" novalidate>
            <div class="fitem">
            <label>ID Paud:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input class="easyui-validatebox" name="id_paud" disabled="disabled" style="width:150px">
            </div>
			<div class="fitem">
            <label>Nama:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input class="easyui-validatebox" name="nama_paud" required style="width:150px">
            </div>
            <div class="fitem">
            <label>Jenis:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <select name="jenis_sekolah">
            <option value="">-- Pilih Jenis Sekolah --</option>
            <option value="PAUD">PAUD</option>
            <option value="TK">TK</option>
            <option value="RA">RAUDHATUL ANFAL</option>
            </select>
            </div>
            <div class="fitem">
            <label>Alamat Paud:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input class="easyui-validatebox" name="Alamat_Paud" required style="width:150px">
            </div>
            <div class="fitem">
            <label>Telepon Paud:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input class="easyui-validatebox" name="Telepon" required style="width:150px">
            </div>
            <div class="fitem">
            <label>Uang Pangkal:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input class="easyui-validatebox" name="Uang_Pangkal" required style="width:150px">
            </div>
            <div class="fitem">
            <label>SPP Paud:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input class="easyui-validatebox" name="Spp" required style="width:150px">
            </div>
            <div class="fitem">
            <label>Latitude:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input class="easyui-validatebox" name="Latitude" required style="width:150px">
            </div>
            <div class="fitem">
            <label>Longitude:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input class="easyui-validatebox" name="longitude" required style="width:150px">
            </div>
		</form>
	</div>
    <div id="dlg-buttons">
		<a href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveEditUser()">Save</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')">Cancel</a>
	</div>
    
    <!-- END OF EDIT PAUD --->
    
</body>
</html>