<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>

<body>
	<h1>HALAMAN UTAMA</h1>
	<a href="<?php echo base_url('Home/kontak') ?>">halaman kontak</a>
	<pre>
		<?php echo validation_errors() ?>
	<?php echo form_open('Home/kirim_data') ?>
	Nama   : <input type="text" name="txtnama" placeholder="Silahkan input">
	<br>
	Alamat : <textarea name="txtalamat"></textarea>
	<br>
	No. HP : <input type="text" name="txtnohp" placeholder="Silahkan input nohp">
	<br>
	<button type="submit">kirim</button> <button type="reset">Batal</button>
	<?php echo form_close() ?>
	</pre>
</body>

</html>
