<?php

class StatusPendaftaranHandler extends ProgramController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function updateStatusPendaftaran()
    {
        echo json_encode(parent::updateStatusPendaftaran());
    }
}

$statusPendaftaranHandler = new StatusPendaftaranHandler();
$statusPendaftaranHandler->updateStatusPendaftaran();