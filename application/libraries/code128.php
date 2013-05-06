<?php

class Code128{

    function __construct()
    {

    }

    //+32=ASCII Total: 106.                   
    var $code128=array('212222', '222122', '222221', '121223', '121322', '131222', '122213', '122312', '132212', '221213', '221312', '231212', '112232', '122132', '122231', '113222', '123122', '123221', '223211', '221132', '221231', '213212', '223112', '312131', '311222', '321122', '321221', '312212', '322112', '322211', '212123', '212321', '232121', '111323', '131123', '131321', '112313', '132113', '132311', '211313', '231113', '231311', '112133', '112331', '132131', '113123', '113321', '133121', '313121', '211331', '231131', '213113', '213311', '213131', '311123', '311321', '331121', '312113', '312311', '332111', '314111', '221411', '431111', '111224', '111422', '121124', '121421', '141122', '141221', '112214', '112412', '122114', '122411', '142112', '142211', '241211', '221114', '413111', '241112', '134111', '111242', '121142', '121241', '114212', '124112', '124211', '411212', '421112', '421211', '212141', '214121', '412121', '111143', '111341', '131141', '114113', '114311', '411113', '411311', '113141', '114131', '311141', '411131', '211412', '211214', '211232', '2331112');
    
    //Congugure

    var $unit='px';//Unit
    var $bw=3;//bar width
    var $height=150;
    var $fs=24;//Font size
    var $yt=135;
    var $dx=6;
    var $x=15;
    var $y=7.5;
    var $bl=105;
    
    public function checksum($str){
        $cstr=str_split($str);
        $count=count($cstr);
        $sum=ord($cstr[0])-32;
        for ($i=0; $i<$count;$i++){
            $sum+=(ord($cstr[$i])-32)*$i;
        }
        $sum=$sum % 103;
        $sum+=32;
        return chr($sum);
    }
    
    public function draw($text,$type='B',$check=false){
        
        $type=preg_replace('/\W/','',$type);
        $type=substr($type,0,1);
        $type=strtoupper($type);
        $clong=(strlen($text)+4)*11;
        $width=$this->bw*$clong;
        switch($type){
            case'A':
            $start=$this->code128[103];
            break;
            case'B':
            $start=$this->code128[104];
            break;
            case'C':
            $start=$this->code128[105];
            break;
            default:
            $start=$this->code128[104];
            break;
            
        }
        $ctext=$start.$text;
        if ($check) {
        $text.=checksum($ctext);
        }
        $text=str_split($text);
        $img='';
        $img.= "<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"no\"?>\n<!DOCTYPE svg PUBLIC \"-//W3C//DTD SVG 1.1//EN\" \"http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd\">\n";
        $img.= "<svg width='$width$->thisunit' height='$this->height$->thisunit' version='1.1' xmlns='http://www.w3.org/2000/svg'>\n";
        //Draw Guard bar.
        $img.= "<desc>First Guard</desc>\n";
        //StartCode
        $img.=$this->drawchar($start);
        
        //Begin Content
        foreach($text as $char){
            $index=ord($char)-32;
            $xt=$this->x+$this->dx;
            $img.= "<desc>$char</desc>\n";
            $img.=$this->drawchar($this->code128[$index]);
            $img.= "<text x='$xt$->thisunit' y='$this->yt$->thisunit' font-family='Arial' font-size='$this->fs'>$char</text>\n";
        }
        //End guard bar.
        $img.=$this->drawchar($this->code128[106]);
        $img.='</svg>';
        return $img;
    }
    public function drawchar($char){
        
        $val=str_split($char);
        $img='';
        $j=0;
        foreach($val as $bar){
            $num=(int)$bar;
            $w=$this->bw*$num;
            if(!($j % 2)){
                $img.= "<rect x='$this->x$->thisunit' y='$this->y$->thisunit' width='$w$->thisunit' height='$this->bl$->thisunit' fill='black' stroke-width='0' />\n";
            }
            $this->x += $w;
            $j++;
        }
        return $img;
    }
}
?>
