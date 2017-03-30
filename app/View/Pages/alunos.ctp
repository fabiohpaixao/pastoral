<!--state overview start-->
<div class="row state-overview">
	<?php foreach($dashboard as $item): ?>
	<div class="col-lg-3 col-sm-6">
		<section class="panel">
			<div class="follower">            
				<div class="panel-body">
					<div class="row">
						<div class="col-xs-12">
							<h5>
								<i class="icon-book"></i>
								<?php echo $item['Disciplina']['nome'] ?>
							</h5>
						</div>
					</div>
				</div>
			</div>

			<footer class="follower-foot">
				<ul>
					<li class="active">
						<h5>Presenças</h5>
						<?php echo $item['Disciplina']['Presenca'] ?>
					</li>
					<li>
						<h5>Nota</h5>
						<?php echo $item['Disciplina']['Nota'] ?>
					</li>	
				</ul>
			</footer>

		</section>
	</div>
	<?php endforeach; ?>
</div>
<!--state overview end-->