<?php
  include ('koneksi.php');
  include ('function.php');
?>
<?php
if(!empty($_GET['id']) && intval($_GET['id']) ){
    if(detail_foto(trim($_GET['id']))){
      $id=$row["id"];
    }else{
      die ("Data tidak ditemukan");
}}
else{
   die("Data kosong atau tidak ditemukan");
  }
?>

<?php
$berhasil_simpan = $berhasil_simpan_err = $id_err ="";   
  if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(empty(trim($_POST['id']))){
        $id_err = "id foto tidak boleh kosong";     
  }elseif(strlen($_POST['id'])>25){
        $id_err = "id foto tidak boleh lebih dari 25 karakter ";
  }else{
        $id=test_input($_POST['id']);
        $id=mysqli_real_escape_string($koneksi,$id);
}
  if(empty($id_err)){   
      if(delete_foto($id)){
        $berhasil_simpan = "Terhapus";
        echo "<meta http-equiv=\"refresh\"content=\"1;URL=lihat.php\"/>";
  }else{
      $berhasil_simpan_err = "Foto gagal disimpan";
  }}}
?>
<html>
<head>
      <title>Kumpulan Foto</title>
<link rel="stylesheet" href="min.css">
<style type="text/css">
.error-form {color: red;}
.sukses-form{color: #0081ff;}
</style>
</head>
<body>
<div class="container">
  <div class="row">
    <div class="col-md-4">    
        <p class="sukses-form"><?php echo $berhasil_simpan; ?></p>
        <p class="error-form"><?php echo $berhasil_simpan_err; ?></p>
          <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI']));?>" method="post">
            <div class="form-group <?php echo (!empty($id_err)) ? 'has-error' : ''; ?>">    
                <input type="hidden" name="id" class="form-control" id="id" placeholder="Masukan id Foto" value="<?php echo $id; ?>">
                <p>Yakin ingin menghapus Foto ?</p>
                <span><p class="error-form"><?php echo $id_err; ?></p></span>    
            </div>  
          <button type="submit" class="btn btn-danger">Delete</button>
        </form>
      </div>
    </div>
  </div>
</body>
</html>