<div class="row">
<a style="float:left" href="javascript:window.history.back()"><button><span class="oi" data-glyph="chevron-left" title="chevron-left" aria-hidden="true"></span> Back</button></a>
<a style="float:right" href="/"><button><span class="oi" data-glyph="home" title="home" aria-hidden="true"></span> Home</button></a>
</div>

<div class="profile_img" style="background: url(/files/<?=$r['user']?>.jpg)no-repeat center center;background-size: cover;"></div>
<center><h2><?=userName($r['id'])?></h2>

<a href="/?v=messages&from_id=<?=$r['id']?>"><span class="oi" data-glyph="envelope-closed" title="envelope-closed" aria-hidden="true"></span> Messages</a>
 &nbsp; &nbsp; 
<a href="<?=$url_fl?>"><span class="oi" data-glyph="<?=$ic_fl?>" title="<?=$ic_fl?>" aria-hidden="true"></span> <?=$var_fl?></a>

<?php
if ($logged['level'] < 2) {
?>

 &nbsp; &nbsp; 
<a href="<?=$url_ban?>"><span class="oi" data-glyph="<?=$ic_ban?>" title="<?=$ic_ban?>" aria-hidden="true"></span> <?=$var_ban?></a>

<?php
}
?>

</center>

<br/>
<div class="title row">
<a class="static">Statistic</a>
</div>
<div class="box">
<div class="item">
<span class="oi" data-glyph="person"></span> Level: <?=$level?>
</div>
<div class="item">
<span class="oi" data-glyph="document"></span> Posts: <?=$posts?>
</div>
<div class="item">
<span class="oi" data-glyph="chat"></span> Comments: <?=$comments?>
</div>
<div class="item">
<span class="oi" data-glyph="clock"></span> Last active: <?=timeFormat($last)?>
</div>
</div>

<div class="title row">
<a class="static">About</a>
</div>
<div class="box">
	<div class="text"><?=$about?></div>
</div>