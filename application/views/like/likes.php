<h3 class='page-title'>收藏</h3>

<?php foreach($goals as $goal): ?>
<div class="goal-item">
	<div class="goal-title"><a href="<?= base_url('goal/'. $goal->GoalID) ?>"><?= $goal->Title ?></a></div>
	<div class="goal-content"><?= $goal->Content ?></div>
	<div class="goal-creator">by <a href="<?= base_url('person/'. $goal->UserID) ?>"><?= $goal->Username ?></a></div>
</div>
<?php endforeach; ?>