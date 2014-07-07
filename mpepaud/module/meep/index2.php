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
			url = 'module/meep/save_meep.php';
		}
		function editUser(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$('#dlg2').dialog('open').dialog('setTitle','Ubah PAUD');
				$('#fm2').form('load',row);
				url = 'module/meep/update_meep.php?id='+row.id_paud;
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
        		nmpaud: $('#nmpaud').val()
			})
		}
		
		function removeUser(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$.messager.confirm('Konfirmasi','Anda yakin akan menghapus data PAUD ini?',function(r){
					if (r){
						$.post('module/meep/remove_meep.php',{id:row.id_paud},function(result){
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
	<table id="tt" class="easyui-datagrid" title="Bobot Faktor" rownumbers="true" fitColumns="true" singleSelect="true">
    <thead>
        <tr>
            <th field="name1" width="100">Faktor</th>
            <th field="name2" width="100">Bobot Faktor</th>
            <th field="name3" width="100">Importance</th>
        </tr>                          
    </thead>                           
    <tbody>                            
        <tr>                           
            <td>Jarak</td>            
            <td>50%</td>            
            <td>0.5</td>                        
        </tr>
        <tr>                           
            <td>Biaya</td>            
            <td>30%</td>            
            <td>0.3</td>                        
        </tr> 
        <tr>                           
            <td>Fasilitas</td>            
            <td>10%</td>            
            <td>0.1</td>                        
        </tr>  
        <tr>                           
            <td>Pendidikan Guru</td>            
            <td>10%</td>            
            <td>0.1</td>                        
        </tr>
        <tr>                           
            <td>Total</td>   
            <td></td>          
            <td>1</td>                        
        </tr>                                                   
    </tbody>                           
</table>
    <br>
	<table id="dg" title="Data Jarak Paud" class="easyui-datagrid"
			url="module/meep/get_meep.php"
			toolbar="#toolbar" pagination="true"
			rownumbers="true" fitColumns="true" singleSelect="true">
	  <thead>
			<tr>
				<th field="id_paud" width="10">ID Paud</th>
				<th field="nama_paud" width="30">Nama Paud</th>
				<th field="nilai_jarak" width="70">Nilai Jarak</th>
                <th field="nilai_spp" width="30">Nilai SPP</th>
                <th field="nilai_uang_pangkal" width="30">Nilai Uang Pangkal</th>
                <th field="nilai_fas" width="30">Nilai Fasilitas</th>
                <th field="nilai_gur" width="30">Nilai Guru</th>
                <th field="nilai_total" width="30">Nilai Total</th>
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
    	<span>Nama Paud:</span>
    	<input id="nmpaud" style="line-height:26px;border:1px solid #ccc">
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