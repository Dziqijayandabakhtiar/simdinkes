<?php
session_start();
include_once '../config/koneksi.php';
include_once 'class.bantuan.php';
?>
<?php if ($_SESSION['s_level'] == 'administrator' ) { ?><?php } ?>
<div id="alert"></div>
<div class="row-fluid">
<h3 class="header smaller lighter blue">Daftar Bantuan</h3>
	<div class="table-header">
		<a href="javascript:void(0)" onclick="tambahForm()" class="btn btn-primary" ><i class="icon-plus icon-white"></i>Tambah</a>
	 
	 <a href="javascript:void(0)" target="" onclick="window.open('../simdinkes/bantuan/print_bantuan.php','name','width=900,height=600')" class="btn btn-primary" ><i class="icon-print icon-white"></i>Print</a>
	 <a href="javascript:void(0)" target="" onclick="window.open('../simdinkes/bantuan/print_bantuan_pdf.php','name','width=900,height=600')" class="btn btn-primary" ><i class="icon-download icon-download"></i>Export PDF</a>
	 <a href="javascript:void(0)" onclick="window.open('../simdinkes/bantuan/print_bantuan_xls.php','name','width=900,height=600')" class="btn btn-primary" ><i class="icon-download icon-download"></i>Export Xls</a>
	</div>

<table id="tabeldata" class="table table-striped table-bordered table-hover" width="100%">
	<thead>
		<tr>
			<th width="50px">No</th>
			<th>Deskripsi</th>
			<th>QTY</th>
			<th>Satuan</th>
			<th>Keterangan</th>
			<th>Posko</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$bantuan = new bantuan($pdo);		
		$id 	= $_SESSION['id_posko'];
		if ($_SESSION['s_level'] == 'administrator'){
			$query = 	"SELECT
						bantuan.id_bantuan,
						bantuan.deskripsi,
						bantuan.qty,
						bantuan.satuan,
						bantuan.keterangan,
						bantuan.id_posko,
						bantuan.created_by,
						bantuan.created_at,
						bantuan.update_by,
						bantuan.update_at,
						posko.alamat_posko,
						users.id_posko
						FROM
						bantuan
						INNER JOIN posko ON bantuan.id_posko = posko.id_posko
						INNER JOIN users ON users.id_posko = posko.id_posko ";	
		}else{
			$query = 	"	SELECT
						bantuan.id_bantuan,
						bantuan.deskripsi,
						bantuan.qty,
						bantuan.satuan,
						bantuan.keterangan,
						bantuan.id_posko,
						bantuan.created_by,
						bantuan.created_at,
						bantuan.update_by,
						bantuan.update_at,
						posko.alamat_posko,
						users.id_posko
						FROM
						bantuan
						INNER JOIN posko ON bantuan.id_posko = posko.id_posko
						INNER JOIN users ON users.id_posko = posko.id_posko
						WHERE
						users.id_posko = $id ";	
		}
		$bantuan->view($query);
	?>
	</tbody>
</table>


