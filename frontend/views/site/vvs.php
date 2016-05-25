<?php

$data = $query->vvs;

   $data = base64_decode($data);
    header("Content-type: application/pdf");
    header("Content-Length:" . strlen($data ));
    header("Content-Disposition: inline; filename=label.pdf");
    print $data;