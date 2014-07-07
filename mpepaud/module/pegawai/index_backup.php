<? 
include 'inc/conn.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="keywords" content="jquery,ui,easy,easyui,web">
	<meta name="description" content="easyui help you build your web page easily!">
	<title>.: MPE Paud | Guru dan Karyawan :.</title>
	<script type="text/javascript">
		var url;
		function newUser(){
			$('#dlg').dialog('open').dialog('setTitle','Tambah Guru');
			$('#fm').form('clear');
			url = 'module/pegawai/save_pegawai.php';
		}
	
		
		function editUser(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$('#dlg2').dialog('open').dialog('setTitle','Edit Guru');
				$('#fm2').form('load',row);
				url = 'module/pegawai/update_pegawai.php?id='+row.Id_guru;
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
        		idgur: $('#idgur').val(),
        		pendidikans: $('#pendidikans').val(),
                pauds: $('#pauds').val()
			})
		}
		
		function removeUser(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$.messager.confirm('Konfirmasi','Anda yakin akan menghapus karyawan ini?',function(r){
					if (r){
						$.post('module/pegawai/remove_pegawai.php',{id:row.Id_guru, id_paud:row.id_paud},function(result){
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
	<table id="dg" title="Data Guru" class="easyui-datagrid"
			url="module/pegawai/get_pegawai.php"
			toolbar="#toolbar" pagination="true"
			rownumbers="true" fitColumns="true" singleSelect="true">
	  <thead>
			<tr>
				<th field="Id_guru" width="50">ID Guru</th>
				<th field="Nama_Guru" width="50">Nama Guru</th>
				<th field="Pendidikan" width="50">Pendidikan Terakhir</th>
				<th field="id_paud" width="50">ID Paud</th>
                <th field="nama_paud" width="50">Nama Paud</th>
            </tr>
		</thead>
	</table>
	<div id="toolbar">
		<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">Input Guru</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">Ubah Guru</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="removeUser()">Hapus Guru</a>
      <hr>
        <!-- SEARCH BOX --->
        <span>Id Guru:</span>
    	<input id="idgur" style="line-height:20px;border:1px solid #ccc">
    	<select name="pendidikans" id="pendidikans" class="easyui-validatebox" style="width: 200px; height:25px;">
        <option value="">--Pilih Pendidikan--</option>
            <option value="SMA">SMA</option>
            <option value="D3">DIPLOMA</option>
            <option value="S1">SARJANA</option>
        </select>
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
    
    <!-- INPUT GURU --->
    
	   <div id="dlg" class="easyui-dialog" style="width:400px;height:400px;padding:10px 20px"
			closed="true" buttons="#dlg-buttons">
		<div class="ftitle">Tambah Guru</div>
		<form id="fm" method="post" novalidate>
            <div class="fitem">
			<label for="select">Paud:</label>
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
			<div class="fitem">
				<label>Nama:</label>
				<input name="nama" class="easyui-validatebox" required="true" style="width: 190px; height:22px;">
			</div>
            <div class="fitem">
			<label for="select">Pendidikan:</label>
            <select name="pendidikan" id="pendidikan" class="easyui-validatebox" style="width: 200px; height:25px;">
            <option value="">--Pilih Pendidikan--</option>
            <option value="SMA">SMA</option>
            <option value="D3">DIPLOMA</option>
            <option value="S1">SARJANA</option>
            </select>
			</div>
		</form>
	</div>
	<div id="dlg-buttons">
		<a href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveUser()">Save</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')">Cancel</a>
	</div>
    
    <!-- END OF INPUT GURU --->
    
    <!-- EDIT PEGAWAI --->
    
    <div id="dlg2" class="easyui-dialog" style="width:400px;height:400px;padding:10px 20px"
			closed="true" buttons="#dlg-buttons">
		<div class="ftitle">Ubah Guru</div>
		<form id="fm2" method="post" novalidate>
            <div class="fitem">
			<label for="select">Paud:</label>
            <select name="id_paud" id="paud" class="easyui-validatebox" style="width: 200px; height:25px;">
            <option value="">--Pilih Paud--</option>
            <? 
            $sql=mysql_query("select id_paud, nama_paud from data_paud");
            while($data=mysql_fetch_array($sql)) {
            ?>
            <option value="<?=$data['id_paud']?>"><?=$data['nama_paud']?></option>
            <? } ?>
            </select>
			</div>
            <div class="fitem">
				<label>ID Guru:</label>
				<input name="Id_guru" class="easyui-validatebox" readonly="" required="true" style="width: 190px; height:22px;">
			</div>
			<div class="fitem">
				<label>Nama:</label>
				<input name="Nama_Guru" class="easyui-validatebox" required="true" style="width: 190px; height:22px;">
			</div>
            <div class="fitem">
			<label for="select">Pendidikan:</label>
            <select name="Pendidikan" id="pendidikan" class="easyui-validatebox" style="width: 200px; height:25px;">
            <option value="">--Pilih Pendidikan--</option>
            <option value="SMA">SMA</option>
            <option value="D3">DIPLOMA</option>
            <option value="S1">SARJANA</option>
            </select>
			</div>
		</form>
	</div>
	<div id="dlg-buttons">
		<a href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveEditUser()">Save</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')">Cancel</a>
	</div>
    
    <!-- END OF EDIT PEGAWAI --->
    
</body>
</html>