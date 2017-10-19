<div class="row">
	<div class="small-12 columns">
		<div class="row">
			<div class="small-12 columns">
				<div class="title-bar">
					<div class="title-bar-left">
						<div class="title-bar-title">
							Clinical
						</div>
					</div>
				</div>
				<table width="100%">
					<thead>
						<tr>
							<th width="3">#</th>
							<th>Research ID</th>
							<th>Submitted By</th>
							<th>Date Submitted</th>
							<th colspan="2">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php $bil = 0; foreach($clinical1 as $c1): $bil++;?>
							<tr>
								<td><?php echo $bil;?></td>
								<td><?php echo $c1->pat_researchID;?></td>
								<td><?php echo $c1->nama_user;?></td>
								<td><?php echo $c1->saved_date;?></td>
								<td width="10"><a href="<?php echo base_url();?>admin/view_clinical/<?php echo $c1->pat_researchID;?>/<?php echo $c1->session;?>/c1"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
								<td width="10"><i class="fa fa-trash" aria-hidden="true"></i></td>
							</tr>
						<?php endforeach;?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>