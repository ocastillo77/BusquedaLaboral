<?php

class PDF
{
    private $mpdf;
    private $css;

    public function __construct()
    {
        Load::library('MPDF/vendor/autoload');
        $this->mpdf = new \Mpdf\Mpdf([
            'margin_top' => 10,
            'margin_bottom' => 10,
            'margin_left' => 10,
            'margin_right' => 10
        ]);

        $this->css = "
            body {
                font-family: 'Helvetica', sans-serif;
            }
            h3, h4, h5, p {
                font-family: 'Helvetica', sans-serif;
            }
        ";
    }

    public function createPDF($html, $filename)
    {
        $filePath = DOC_PATH . $filename;
        $this->mpdf->WriteHTML($this->css, \Mpdf\HTMLParserMode::HEADER_CSS);
        $this->mpdf->WriteHTML($html);
        $this->mpdf->Output($filePath, \Mpdf\Output\Destination::INLINE);
    }
}
