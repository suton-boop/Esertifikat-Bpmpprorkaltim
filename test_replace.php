<?php
$f = 'c:/laragon/www/esertifikatv1/app/Jobs/SignCertificateJob.php';
$c = file_get_contents($f);
$c = str_replace(
    "'appearance_mode' => (\$this->appearance['tte_visible'] ?? true) ? 'visible' : 'hidden',\n                'appearance_page' => (int)(\$this->appearance['page'] ?? 1),\n                'appearance_x'    => (int)(\$this->appearance['x'] ?? 0),\n                'appearance_y'    => (int)(\$this->appearance['y'] ?? 0),\n                'appearance_w'    => (int)(\$this->appearance['w'] ?? 200),\n                'appearance_h'    => (int)(\$this->appearance['h'] ?? 80),",
    "'is_visible'     => (\$this->appearance['tte_visible'] ?? true),\n                'page'           => (int)(\$this->appearance['page'] ?? 1),\n                'pos_x'          => (int)(\$this->appearance['x'] ?? 0),\n                'pos_y'          => (int)(\$this->appearance['y'] ?? 0),\n                'width'          => (int)(\$this->appearance['w'] ?? 200),\n                'height'         => (int)(\$this->appearance['h'] ?? 80),",
    $c
);
file_put_contents($f, $c);
