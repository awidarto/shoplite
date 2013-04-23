<?php

class Pdf  
{
    public $workbook;
    public $papersize = 'a4';
    public $orientation = 'portrait';
    public $outputname = 'pdf_output.pdf';
    public $savename = 'pdf_save.pdf';
    public $dompdf;
    
    function __construct()
    {
        require_once('dompdf/dompdf_config.inc.php');
        $this->dompdf = new DOMPDF();
    }

    function set_paper($size, $orientation)
    {
        $this->papersize = $size;
        $this->orientation = $orientation;
    }

    function set_stream_name($name)
    {
        $this->outputname = $name;
    }

    function set_save_name($name)
    {
        $this->savename = $name;
    }
    
    function make($doc){
        $this->dompdf->load_html($doc);
        $this->dompdf->set_paper($this->papersize, $this->orientation );
        return true;
    }

    function render()
    {
        $this->dompdf->render();
    }

    function stream(){
        $this->dompdf->stream($this->outputname, array("Attachment" => false));
    }

    function save($filename = null)
    {
        if(is_null($filename)){
            $filename = $this->savename;
        }else{
            $filename = $filename;
        }

        $out = $this->dompdf->output();

        file_put_contents($filename, $out);

    }



}

?>