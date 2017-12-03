<div class="row">
<span style="float:left" class="link" data-target="javascript:window.history.back()"><span class="oi" data-glyph="chevron-left" title="chevron-left" aria-hidden="true"></span> Back</span>
<span style="float:right" class="link" data-target="/"><span class="oi" data-glyph="home" title="home" aria-hidden="true"></span> Home</span>
</div>

<hr>

<div class="avatar-xl" style="background: url(/files/<?=$r['user']?>.jpg)no-repeat center center;background-size: cover; margin: 20px auto"></div>

<h2 align="center "><?=userName($r['id'])?></h2>

<div class="box">

<div class="link box-item" data-target="/?v=messages&from_id=<?=$r['id']?>"><span class="oi" data-glyph="envelope-closed" title="envelope-closed" aria-hidden="true"></span> Messages</div>

<div class="link box-item" data-target="<?=$url_fl?>"><span class="oi" data-glyph="<?=$ic_fl?>" title="<?=$ic_fl?>" aria-hidden="true"></span> <?=$var_fl?></div>

<?php
if ($logged['level'] < 2) {
?>

<div class="link box-item" data-target="<?=$url_ban?>"><span class="oi" data-glyph="<?=$ic_ban?>" title="<?=$ic_ban?>" aria-hidden="true"></span> <?=$var_ban?></div>

<?php
}
?>

</div>

<div class="box">
<div class="box-title">Statistic</div>

<div class="box-item">
<span class="oi" data-glyph="person"></span> Level: <?=$level?>
</div>
<div class="box-item">
<span class="oi" data-glyph="document"></span> Posts: <?=$posts?>
</div>
<div class="box-item">
<span class="oi" data-glyph="chat"></span> Comments: <?=$comments?>
</div>
<div class="box-item">
<span class="oi" data-glyph="clock"></span> Last active: <?=timeFormat($last)?>
</div>

</div>

<div class="box">
<div class="box-title">About</div>
<div class="box-item">
	<div class="text"><?=$about?></div>
</div>