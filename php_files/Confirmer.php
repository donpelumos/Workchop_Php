<?php

/**
 * Created by PhpStorm.
 * User: BALE
 * Date: 02/03/2017
 * Time: 2:18 AM
 */
class Confirmer
{
    public function returnRank($name){
        $name = strtolower($name);
        $rank =5.5;
        if(strpos(('sample'.$name),'mr')>0 || strpos(('sample'.$name),'mrs')>0 || strpos(('sample'.$name),'miss')>0){
            $rank = 6;
        }
		if(strpos(('sample'.$name), '(') > 0 || strpos('sample'.$name, ')') > 0 || strpos('sample'.$name, 'tailor') > 0 
		|| strpos('sample'.$name, 'gas') > 0 || strpos('sample'.$name, 'gas supplier') > 0 || strpos('sample'.$name, 'hair') > 0 
		|| strpos('sample'.$name, 'stylist') > 0 || strpos('sample'.$name, ')') > 0 || strpos('sample'.$name, 'hair stylist') > 0 
		|| strpos('sample'.$name, 'barber') > 0 || strpos('sample'.$name, 'barbing') > 0 || strpos('sample'.$name, ')') > 0 
		|| strpos('sample'.$name, 'makeup') > 0 || strpos('sample'.$name, 'make up') > 0 || strpos('sample'.$name, 'mua') > 0 
		|| strpos('sample'.$name, 'mech.') > 0 || strpos('sample'.$name, 'mechanic') > 0 || strpos('sample'.$name, 'car repair') > 0 
		|| strpos('sample'.$name, 'rewire') > 0 || strpos('sample'.$name, 'fashion') > 0 || strpos('sample'.$name, 'designer') > 0 ){
            $rank = 5;
        }
        if(strpos(('sample'.$name),'(')>0 ){
            $rank = 3;
        }
        if((strpos(('sample'.$name),'mr')>0 || strpos(('sample'.$name),'mrs')>0 || strpos(('sample'.$name),'miss')>0) &&
            strpos(('sample'.$name),'(')>0){
            $rank = 4;
        }
        if(strpos(('sample'.$name),'uncle')>0 || strpos(('sample'.$name),'bro')>0 || strpos(('sample'.$name),'brother')>0
            || strpos(('sample'.$name),'sis')>0  || strpos(('sample'.$name),'sister')>0  || strpos(('sample'.$name),'aunt')>0
            || strpos(('sample'.$name),'auntie')>0  ){
            $rank = 2;
        }
        if((strpos(('sample'.$name),'uncle')>0 || strpos(('sample'.$name),'bro')>0 || strpos(('sample'.$name),'brother')>0
            || strpos(('sample'.$name),'sis')>0  || strpos(('sample'.$name),'sister')>0  || strpos(('sample'.$name),'aunt')>0
            || strpos(('sample'.$name),'auntie')>0  ) && strpos(('sample'.$name),'(')>0 ){
            $rank = 1;
        }
        return $rank;
    }
    public function format($str){
		$string = strtolower($str);
        if(strpos(('sample'.$string), '(') > 0 || strpos('sample'.$string, ')') > 0 || strpos('sample'.$string, 'tailor') > 0 
		|| strpos('sample'.$string, 'gas') > 0 || strpos('sample'.$string, 'gas supplier') > 0 || strpos('sample'.$string, 'hair') > 0 
		|| strpos('sample'.$string, 'stylist') > 0 || strpos('sample'.$string, ')') > 0 || strpos('sample'.$string, 'hair stylist') > 0 
		|| strpos('sample'.$string, 'barber') > 0 || strpos('sample'.$string, 'barbing') > 0 || strpos('sample'.$string, ')') > 0 
		|| strpos('sample'.$string, 'makeup') > 0 || strpos('sample'.$string, 'make up') > 0 || strpos('sample'.$string, 'mua') > 0 
		|| strpos('sample'.$string, 'mech.') > 0 || strpos('sample'.$string, 'mechanic') > 0 || strpos('sample'.$string, 'car repair') > 0 
		|| strpos('sample'.$string, 'rewire') > 0 || strpos('sample'.$string, 'fashion') > 0 || strpos('sample'.$string, 'designer') > 0 ){
            return "";
        }
        else {
            return $str;
        }
    }
    public function adjustName($name, $rank){
        $newName = $name;
        $Name = explode(" ",$name);
        switch($rank){
            case 4:
                $newName = "";
                for($i=0; $i<(count($Name)-1); $i++){
                    $newName = $newName. $this->format($Name[$i])." ";
                }
                break;
            case 3:
                $newName = "";
                for($i=0; $i<(count($Name)-1); $i++){
                    $newName = $newName.$this->format($Name[$i])." ";
                }
                break;
            case 2:
                $newName = "";
                for($i=0; $i<(count($Name)); $i++){
                    $newName = $newName. $this->format($Name[$i])." ";
                }
                break;
            case 1:
                $newName = "";
                for($i=1; $i<(count($Name)-1); $i++){
                    $newName = $newName. $this->format($Name[$i])." ";
                }
                break;
			case 6:
				$newName = "";
                for($i=0; $i<(count($Name)); $i++){
                    $newName = $newName. $this->format($Name[$i])." ";
                }
                break;
        }
        return $newName;
    }
}