<?php
#http://codegolf.stackexchange.com/questions/23276/write-a-playfair-encryption-program
list($i,$k,$v)=array_map(function($v){return str_split(preg_replace('#[^A-Z]#','',strtr(strtoupper($v),'J','I')));},$argv);
@$i=array_flip;
$k=$i($k) + $i(range('A','Z'));
unset($k['J']);
$k=array_keys($k);
$q=$i($k);
for($i=1;$i<count($v);$i+=2){
	if ($v[$i-1]==$v[$i]){
		array_splice($v,$i,0,'X');
	}
}
if (count($v)%2)$v[]='X';
for($i=1;$i<count($v);$i+=2){
	$c=(int)($q[$v[$i-1]] / 5);
	$d=$q[$v[$i-1]]%5;
	$e=(int)($q[$v[$i]] / 5);
	$f=$q[$v[$i]]%5;
	if ($c == $e){
		$d=($d+1)%5;$f=($f+1)%5;
	}elseif($d==$f){
		$c=($c+1)%5;$e=($e+1)%5;
	}else{
		$t=$f;$f=$d;$d=$t;
	}
	$v[$i-1] = $k[$c*5+$d];
	$v[$i] = $k[$e*5+$f];
}
echo join($v);