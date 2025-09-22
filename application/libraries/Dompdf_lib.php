<?php defined('BASEPATH') or exit('No direct script access allowed');

// Pastikan Anda telah mengekstrak dompdf ke application/libraries/dompdf
require_once APPPATH . 'libraries/dompdf/autoload.inc.php';

use Dompdf\Dompdf;
use Dompdf\Options;

class Dompdf_lib
{

    protected $ci;
    protected $dompdf;

    public function __construct()
    {
        $this->ci = &get_instance();
        $this->dompdf = new Dompdf();

        // Opsional: Konfigurasi Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true); // Aktifkan jika ada gambar dari URL eksternal
        $this->dompdf->setOptions($options);
    }

    public function create_pdf($html, $filename = '', $stream = TRUE, $paper = 'A4', $orientation = 'portrait')
    {
        $this->dompdf->loadHtml($html);
        $this->dompdf->setPaper($paper, $orientation);
        $this->dompdf->render();

        if ($stream) {
            $this->dompdf->stream($filename . ".pdf", array("Attachment" => 0));
        } else {
            return $this->dompdf->output();
        }
    }
}
