<?php

header('Content-Type: application/json');

$Data = [[
            'nama' => 'Epong',
            'pekerjaan' => 'Software Engineer',
            'lokasi' => 'Lombok'
        ],
        [
            'nama' => 'Awi',
            'pekerjaan' => 'Data Scientist',
            'lokasi' => 'Wamena'
        ],
        [
            'nama' => 'Daopa',
            'pekerjaan' => 'Content Manager',
            'lokasi' => 'Tanggerang'
        ]
    ];
    
echo json_encode($Data);