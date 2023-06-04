<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://ijalfauzi.com
 * @since      1.0.0
 *
 * @package    Callee_WP
 * @subpackage Callee_WP/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<link rel="stylesheet" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
<script src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>





<style>
	.dataTables_wrapper .dataTables_length select{
		padding: 0px 20px !important;
	}
</style>

<h3>Data Kontak Kami</h3>

<div style="width: 1000px">
<table id="table_id">
    <thead>
    	<tr>
    		<td>ID</td>
    		<td>Nama</td>
    		<td>No wa</td>
    		<td>Email</td>
    		<td>Perusahaan</td>
    		<td>Domisili</td>
    		<td>Kebutuhan</td>
    		<td>Dikirim</td>
    	</tr>
    </thead>
    <tbody>
    	<?php foreach ($data as $key => $value): ?>
	    	<tr>
	            <td><?php echo $value->id ?></td>
	            <td><?php echo $value->name ?></td>
	            <td><?php echo $value->no_wa ?></td>
	            <td><?php echo $value->email ?></td>
	            <td><?php echo $value->perusahaan ?></td>
	            <td><?php echo $value->domisili ?></td>
	            <td><?php echo $value->kebutuhan ?></td>
	            <td><?php echo $value->created_at ?></td>
	        </tr>
    	<?php endforeach ?>
    </tbody>
</table>
</div>

<script>
    (function( $ ) {
        // $(document).ready( function () {
        //     $('#table_id').DataTable();
        // } );

        $(document).ready(function() {
            $('#table_id').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                "order": [
                [0, "desc"]
            ]
            } );
        } );
    })( jQuery );
</script>


