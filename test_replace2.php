<?php
$f = 'c:/laragon/www/esertifikatv1/app/Jobs/SignCertificateJob.php';
$c = file_get_contents($f);
$c = str_replace(
    "'signed_by'          => \$this->signedBy,",
    "'signed_by'          => \$this->signedBy,\n                'document_hash'      => str_repeat('0', 64),\n                'signature_base64'   => base64_encode('DUMMY_SIGNATURE_DATA_FROM_LOCAL_TTE'),",
    $c
);
file_put_contents($f, $c);
