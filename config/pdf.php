<?php

use Dompdf\Dompdf;
use Dompdf\Options;

require_once __DIR__ . '/../vendor/autoload.php';

if (!function_exists('render_pdf')) {
    /**
     * Render HTML menjadi PDF dan langsung kirim ke browser (download/inline).
     *
     * @param string $html HTML penuh (sudah ada <html> ... </html>)
     * @param string $filename Nama file PDF
     * @param string $orientation 'portrait' atau 'landscape'
     * @param string $paper Ukuran kertas, mis: 'A4'
     */
    function render_pdf(string $html, string $filename = 'dokumen.pdf', string $orientation = 'portrait', string $paper = 'A4'): void
    {
        $options = new Options();
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper($paper, $orientation);
        $dompdf->render();

        $dompdf->stream($filename, ['Attachment' => 0]); // 0 = tampil di browser, 1 = force download
        exit;
    }
}
