<?php 

namespace Models;

const PIXEL_WIDTH = 10;
const PIXEL_HEIGHT = 10;


class Labyrinthe
{

	private $size = 0;
	private $width = 0;
	private $height = 0;

	private $map = [];

	public function create($width,$height,$color){
		$this->width = $width;
		$this->height = $height;
		$this->size = $width*$height;

		$matrice_vertical = [];
		$matrice_horizontal = [];
		$matrice_id = [];


		for ($i=0; $i < $height; $i++) {
			for ($j=0; $j < $width+1; $j++) { 
				$matrice_vertical[$i][$j]= true;
			};						
		}

		for ($i=0; $i < $height+1; $i++) {
			for ($j=0; $j < $width; $j++) { 
				$matrice_horizontal[$i][$j] = true;
			};
		}
		
		for ($i=0; $i < $height; $i++) {
			for ($j=0; $j < $width; $j++) { 
				$matrice_id[$i][$j] = ($i*$width)+$j;
			};
		}

		while(1){ 
			begin: 

			$line = mt_rand(0,$this->height-1);
			$col = mt_rand(0,$this->width-1);

			$id = $matrice_id[$line][$col];
			
			$next_col = $col;
			$next_line = $line;
			$next_id = null;

			$vertical = mt_rand(0,1);

			$droite = mt_rand(0,1);

			if (!$vertical) {

				$line += $droite;
				$next_line += ($droite)? 1 : -1;

				if (!isset($matrice_id[$next_line][$next_col])) goto begin;

				$next_id = $matrice_id[$next_line][$next_col];

				if ($id != $next_id){
					if (isset($matrice_id[$line][$col]) && $line!= 0) {
						$matrice_horizontal[$line][$col] = 0;
					}
				}
			}else{

				$col+=$droite;
				$next_col += ($droite)? 1 : -1;

				if (!isset($matrice_id[$next_line][$next_col])) goto begin;

				$next_id = $matrice_id[$next_line][$next_col];

				if ($id != $next_id){
					if (isset($matrice_id[$line][$col]) && $col!= 0) {
						$matrice_vertical[$line][$col] = 0;
					}
				}
			}

			$allCell = $this->getRoomCells($matrice_id,$next_line,$next_col);
			
			for ($i=0; $i < count($allCell); $i++) { 
				$j = $allCell[$i]['x'];
				$k = $allCell[$i]['y'];
				$matrice_id[$j][$k] = $id;
			}

			if ($this->oneRoom($matrice_id)) break;
		}


		$this->map[] = $matrice_horizontal;
		$this->map[] = $matrice_vertical;

		return $this->map;
	}

	private function getRoomCells($table, $x, $y){
		$val = $table[$x][$y];
		$result = [];
		for ($i=0; $i < count($table); $i++) {
			for ($j=0; $j < count($table[$i]); $j++) { 
				if($table[$i][$j] == $val)
					$result[] = ['x'=>$i, 'y'=>$j];
			}
		}
		return $result;
	}
	
	private function oneRoom($table){
		$val = $table[0][0];
		for ($x=0; $x < count($table); $x++) { 
			for ($y=0; $y < count($table[$x]); $y++) { 
				if($table[$x][$y]!=$val) return(false);
			}
		}
		return(true);
	}
}