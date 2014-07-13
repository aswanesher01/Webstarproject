<div class="page-header">
  <h3>Ubah Password</h3>
</div>
<form class="form-horizontal" role="form" action="ubah_password_process.php" method="post">
  <div class="form-group">
    <label for="inputPaud3" class="col-sm-2 control-label">Password Lama</label>
    <div class="col-sm-8">
      <input type="password" name="passLama" class="form-control" id="inputPaud3" placeholder="Password Lama">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPaud3" class="col-sm-2 control-label">Password Baru</label>
    <div class="col-sm-8">
      <input type="password" name="passBaru" class="form-control" id="inputPaud3" placeholder="Password Baru">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPaud3" class="col-sm-2 control-label">Verifikasi Password Baru</label>
    <div class="col-sm-8">
      <input type="password" name="passBarus" class="form-control" id="inputPaud3" placeholder="Ketik Ulang Password Baru">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary">Simpan</button>
      <a class="btn btn-danger" href="home.php" role="button">Batal</a>
    </div>
  </div>
</form>