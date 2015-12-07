<?php
ob_start();

$filter = array();
$url = "index.php?module=admin";

if( !empty( $_REQUEST['page'] ) ){
	$filter['page'] = (int)$_REQUEST['page'];
	$page = $filter['page'];
}else{
	$page = 1;
}

// where
if( !empty( $_REQUEST['nama_pelajar'] ) ){
	$filter['nama_pelajar'] = trim( $_REQUEST['nama_pelajar'] );
	$url .= "&nama_pelajar=".urlencode( $filter['nama_pelajar'] );
}

if( !empty( $_REQUEST['sekolah'] ) ){
	$filter['sekolah'] = (int)$_REQUEST['sekolah'];
	$url .= "&sekolah=$filter[sekolah]";
}

// order
if( !empty( $_REQUEST['order'] ) ){
	$filter['order'] = $_REQUEST['order'];
	$url .= "&order=$filter[order]";
	
	if( !empty( $_REQUEST['by'] ) ){
		$filter['by'] = $_REQUEST['by'];
		$url .= "&by=$filter[by]";
	}
}

// limit+page
if( !empty( $_REQUEST['limit'] ) ){
	$filter['limit'] = (int)$_REQUEST['limit'];
	$itemPerPage = $filter['limit'];
}else{
	$itemPerPage = 10;
}
$url .= "&limit-$itemPerPage";

$applications = Application::all(null, $filter);
$senaraiSekolah = School::senaraiSekolah();
?>

<div>
	<div>
		<h1>Permohonan Pelajar</h1>
		<hr />
	</div>
	
	<form action="index.php?module=admin" method="get">
		<div class="row">
			<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<div class="input-group">
						<label for="nama_pelajar" class="input-group-addon">Nama Pelajar</label>
						<input type="text" id="nama_pelajar" name="nama_pelajar" placeholder="Nama Pelajar" class="form-control" />
					</div>
				</div>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<div class="input-group">
						<label for="sekolah" class="input-group-addon">Sekolah</label>
						<select name="sekolah" id="sekolah" class="form-control">
						<?php if( !empty( $senaraiSekolah ) ){
							foreach( $senaraiSekolah as $sekolah ){
								if( $filter['sekolah'] == $sekolah['id'] ){
									echo "<option value=\"$sekolah[id]\" selected=\"selected\">$sekolah[nama]</option>";
								}else{
									echo "<option value=\"$sekolah[id]\">$sekolah[nama]</option>";
								}
							}
						} ?>
						</select>
					</div>
				</div>
			</div>
		</div>
		
		<div class="form-group">
			<button type="submit" class="btn btn-md btn-primary">
				Cari
			</button>
		</div>
	</form>
	
	<?php
	if( empty( $applications ) ){
	?>
	<div class="alert alert-warning">
		<i class="fa fa-warning"></i> Tiada Permohonan Di Terima!
	</div>
	<?php
	}else{
		$totalItem = Application::$totalItem;
		$totalPages = ceil( $totalItem / $itemPerPage );
		
		$firstPage = 1;
		$lastPage = $totalPages;
		
		$distinct = 3;
		$firstCounter = $page-$distinct <= 0 ? $firstPage : $page-$distinct;
		$lastCounter = $page+$distinct < $lastPage ? $page+$distinct : $lastPage;
	?>
	<nav>
		<ul class="pagination">
			<li><a href="<?php echo $url."&page=$firstPage"; ?>"><?php echo $firstPage; ?></a></li>
			<?php
			if( $firstCounter - $firstPage > 1 ){
				echo "<li><a href=\"#\">...</a></li>";
			}
			
			for( $i=$firstCounter;$i < $lastCounter; $i++ ){
				$currentPage = $i;
				if( $currentPage != $firstPage && $currentPage != $lastPage ){
					?> <li><a href="<?php echo $url."&page=$currentPage"; ?>"><?php echo $currentPage; ?></a></li> <?php
				}
			}
			
			if( $lastPage - $lastCounter >= 1 ){
				echo "<li><a href=\"#\">...</a></li>";
			}
			?>
			<li><a href="<?php echo $url."&page=$lastPage"; ?>"><?php echo $lastPage; ?></a></li>
		</ul>
	</nav>
	
	<div class="list-group">
		<div class="list-group-item">
			<div class="row">
				<div class="col-md-1 col-md-1 col-xs-1">#</div>
				<div class="col-md-4 col-md-4 col-xs-11">Sekolah</div>
				<div class="col-md-2 col-md-2 col-xs-6">Tarikh Permohonan</div>
				<div class="col-md-2 col-md-2 col-xs-6">Kemaskini</div>
				<div class="col-md-3 col-md-3 col-xs-12">Tindakan</div>
			</div>
		</div>
	<?php
		$i = 1;
		foreach( $applications as $application ){
	?>
		<div class="list-group-item">
			<div class="row">
				<div class="col-md-1 col-md-1 col-xs-1"><?php echo ($itemPerPage*($page-1))+$i; ?></div>
				<div class="col-md-4 col-md-4 col-xs-11">
					<strong><?php echo empty( $application['nama_penuh'] ) ? $application['no_matrik'] : $application['nama_penuh']; ?></strong><br />
					<small><?php echo $application['nama_sekolah']; ?></small><br />
					<small><small class="text-muted"><?php echo $application['nama_subjek']; ?></small></small>
				</div>
				<div class="col-md-2 col-md-2 col-xs-6"><?php echo $application['tarikh_dibuat'] ?></div>
				<div class="col-md-2 col-md-2 col-xs-6"><?php echo $application['tarikh_kemaskini'] ?></div>
				<div class="col-md-3 col-md-3 col-xs-12">
					<div class="btn btn-group btn-group-xs">
					<?php if( $application['status'] == 1 ){ ?>
						<a class="btn btn-primary" href="index.php?module=admin&action=approve&id=<?php echo $application['id']; ?>">
							<i class="fa fa-check"></i> Lulus
						</a>
						
						<?php /* ?><a class="btn btn-default" data-href="index.php?module=application&action=info&id=<?php echo $application['id']; ?>" href="#edit-application" data-toggle="modal">
							<i class="fa fa-edit"></i> Edit
						</a><?php */ ?>
						
						<a class="btn btn-default" href="index.php?module=application&action=edit&id=<?php echo $application['id']; ?>">
							<i class="fa fa-edit"></i> Kemaskini
						</a>
						
						<a class="btn btn-danger" href="index.php?module=admin&action=reject&id=<?php echo $application['id']; ?>">
							<i class="fa fa-ban"></i> Gagal
						</a>
					<?php
						}else{
							if( $application['status'] == 2 ){
					?>
						<button type="button" disabled="disabled" class="btn btn-primary">
							<i class="fa fa-check"></i> Lulus
						</button>
					<?php
							}elseif( $application['status'] == 3 ){
					?>
						<button type="button" disabled="disabled" class="btn btn-danger">
							<i class="fa fa-ban"></i> Gagal
						</button>
					<?php
							}
						}
					?>
						<a class="btn btn-default" href="index.php?module=application&action=print&id=<?php echo $application['id']; ?>" target="_blank">
							<i class="fa fa-print"></i> Print
						</a>
					</div>
				</div>
			</div>
		</div>
	<?php
			$i++;
		}
	?>
	</div>
	<?php } ?>
</div>

<div class="modal" id="edit-application">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Tutup</span>
				</button>
				<h4 class="modal-title">Kemaskini Permohonan</h4>
			</div>
			<div class="modal-body">
				
			</div>
		</div>
	</div>
</div>


<?php
$content = ob_get_clean();
View::addContent( $content );

if( isset( $_SESSION['success'] ) ){
	View::addStylesheet('<link rel="stylesheet" href="/assets/plugins/bootstrap-toastr/toastr.min.css" />');
	View::addJavascript('<script type="text/javascript" src="/assets/plugins/bootstrap-toastr/toastr.min.js"></script>');

	$js = <<<JS
	<script type="text/javascript">
	jQuery(function($){
		toastr.success('$_SESSION[success]', 'Success Notification');
	});
	</script>
JS;
	unset( $_SESSION['success'] );
	View::addJavascript($js);
}
?>