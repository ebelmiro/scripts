<?php

$path = 'lojas/';
$dir = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path), RecursiveIteratorIterator::SELF_FIRST);

foreach($dir as $a=>$b)
{
	if($b->getBasename() != '.' && $b->getBasename() != '..')
	{
		echo $b->getBasename().'<br>';
		echo $b->getPathname().'<br>';		
		
		if(strtolower(substr($b->getBasename(),-3,3)) == 'jpg')
		{
			$im = imagecreatefromjpeg($b->getPathname());
			if($im && imagefilter($im, IMG_FILTER_GRAYSCALE))
			{			
				imagepng($im, 'lojas_pb/'.$b->getBasename());
				echo "Convertida com sucesso!<br>";
			}
			else
			{
				echo "Falha na converção <br>";
			}
			imagedestroy($im);			
		}
		else
		{
			$im = imagecreatefrompng($b->getPathname());
			if($im && imagefilter($im, IMG_FILTER_GRAYSCALE))
			{			
				imagepng($im, 'lojas_pb/'.$b->getBasename());
				echo "Convertida com sucesso!<br>";
			}
			else
			{
				echo "Falha na converção <br>";
			}
			imagedestroy($im);	
		}
		echo '<br>';
	}
}

?>